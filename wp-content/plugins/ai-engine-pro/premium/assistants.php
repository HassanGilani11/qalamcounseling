<?php

class MeowPro_MWAI_Assistants {
  private $core = null;
  private $namespace = 'mwai/v1/';

  function __construct( $core ) {
    $this->core = $core;
    add_action( 'rest_api_init', [ $this, 'rest_api_init' ] );
    add_action( 'mwai_ai_query_assistant', [ $this, 'query_assistant' ], 10, 2 );
  }

  #region REST API

  function rest_api_init() {
    register_rest_route( $this->namespace, '/openai/assistants/list', [
      'methods' => 'GET',
      'callback' => [ $this, 'rest_assistants_list' ],
    ] );
  }

  function rest_assistants_list( $request ) {
    try {
      $envId = $request->get_param( 'envId' );
      $openai = Meow_MWAI_Engines_Factory::get_openai( $this->core, $envId );
      $res = $openai->execute( 'GET', '/assistants', null, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );
      $data = $res['data'];
      // TODO: Should handle the "next" page.
      $assistants = array_map( function ( $assistant ) {
        $assistant['createdOn'] = date( 'Y-m-d H:i:s', $assistant['created_at'] );
        unset( $assistant['instructions'] );
        unset( $assistant['file_ids'] );
        unset( $assistant['metadata'] );
        return $assistant;
      }, $data);
      $this->core->update_ai_env( $envId, 'assistants', $assistants );
      return new WP_REST_Response([ 'success' => true, 'assistants' => $assistants ], 200 ); 
    }
    catch ( Exception $e ) {
			$message = apply_filters( 'mwai_ai_exception', $e->getMessage() );
			return new WP_REST_Response([ 'success' => false, 'message' => $message ], 500 );
		}
  }

  #endregion

  #region Chatbot or Forms Takeover by Assistant
  private function build_messages( $query ) {
    $messages = [];

    // If there is a context, we need to add it.
    if ( !empty( $query->context ) ) {
      $messages[] = [ 'role' => 'system', 'content' => $query->context ];
    }

    // Finally, we need to add the message, but if there is an image, we need to add it as a system message.
    $imageUrl = $query->get_image_url();
    if ( !empty( $imageUrl ) ) {
      $messages[] = [ 
        'role' => 'user',
        'content' => [
          [
            "type" => "text",
            "text" => $query->get_message()
          ],
          [
            "type" => "image_url",
            "image_url" => [ "url" => $imageUrl ]
          ]
        ]
      ];
    }
    else {
      $messages[] = [ 'role' => 'user', 'content' => $query->get_message() ];
    }

    return $messages;
  }

  function query_assistant( $reply, $query ) {
    $envId = $query->envId;
    $assistantId = $query->assistantId;
    // If it's a form, there is no chatId, a new one will be generated, and a new thread will be created.
    $chatId = !empty( $query->chatId ) ? $query->chatId : $this->core->get_random_id( 10 );
    if ( empty( $envId ) || empty( $assistantId ) ) {
      throw new Exception( 'Assistant requires an envId and an assistantId.' );
    }
    $assistant = $this->core->get_assistant( $envId, $assistantId );
    if ( empty( $assistant ) ) {
      throw new Exception( 'Assistant not found.' );
    }
    $query->set_model( $assistant['model'] );
    $openai = Meow_MWAI_Engines_Factory::get_openai( $this->core, $envId );

    // We will use the $chatId to see if there are any previous conversations. If not, we need to create a new thread.
    $chat = $this->core->discussions->get_discussion( $query->botId, $chatId );
    $threadId = $chat->threadId ?? null;
    
    // Create Thread
    if ( empty( $threadId ) ) {
      $body = [ 'metadata' => [ 'chatId' => $chatId ] ];
      $body['messages'] = [];
      $res = $openai->execute( 'POST', '/threads', $body, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );
      $threadId = $res['id'];
    }

    // Create Message
    $body = [ 'role' => 'user', 'content' => $query->message ];
    foreach ( $query->messages as $message ) {
      if ( !empty( $message['functions'] ) ) {
        $body['functions'] = $message['functions'];
        $body['function_call'] = $message['function_call'];
      }
    }
    $res = $openai->execute( 'POST', "/threads/{$threadId}/messages", $body, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );

    // Create Run
    $body = [ 'assistant_id' => $assistantId ];
    $res = $openai->execute( 'POST', "/threads/{$threadId}/runs", $body, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );
    $runId = $res['id'];
    $runStatus = $res['status'];

    while ( $runStatus === 'running' || $runStatus === 'queued' || $runStatus === 'in_progress' ) {
      sleep( 0.65 );
      $res = $openai->execute( 'GET', "/threads/{$threadId}/runs/{$runId}", null, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );
      $runStatus = $res['status'];
    }

    // Handle Errors
    if ( $runStatus === 'failed' ) {
      if ( isset( $res['last_error']['message'] ) ) {
        $message = $res['last_error']['message'];
        throw new Exception( $message );
      }
      else {
        throw new Exception( 'Unknown error.' );
      }
    }

    // Get Messages
    $res = $openai->execute( 'GET', "/threads/{$threadId}/messages", null, null, true, [ 'OpenAI-Beta' => 'assistants=v1' ] );
    $messages = $res['data'];
    $first = $messages[0];
    $content = $first['content'];
    $reply = null;
    foreach ( $content as $block ) {
      if ( $block['type'] === 'text' ) {
        $reply = $block['text']['value'];
        break;
      }
    }
    if ( !$reply) {
      throw new Exception( "No text reply from the assistant." );
    }

    // TODO: In fact, this threadId should probably be in the query.
    // The Discussions Module will also use that threadId. Currently, it's getting it from the $params.
    $query->setThreadId( $threadId );
    $reply = new Meow_MWAI_Reply( $query );
    $reply->set_choices( $content );
    $reply->set_type( 'assistant' );
    $in_tokens = Meow_MWAI_Core::estimate_tokens( $query->messages, $query->message );
    $out_tokens = Meow_MWAI_Core::estimate_tokens( $reply->result );
    $usage = $this->core->record_tokens_usage( $query->model, $in_tokens, $out_tokens );
    $reply->set_usage( $usage );
    return $reply;
  }
  #endregion
}