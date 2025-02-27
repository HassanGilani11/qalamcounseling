<?php

class Meow_MWAI_Engines_OpenAI extends Meow_MWAI_Engines_Core
{
  // Base (OpenAI)
  protected $apiKey = null;
  protected $endpoint = null;

  // Azure
  private $azureDeployments = null;
  private $azureApiVersion = 'api-version=2023-12-01-preview';

  // Response
  protected $inModel = null;
  protected $inId = null;

  // Streaming
  private $streamTemporaryBuffer = "";
  private $streamBuffer = "";
  private $streamContent = "";
  private $streamFunctionCall = null;
  private $streamCallback = null;

  public function __construct( $core, $env )
  {
    parent::__construct( $core, $env );
    $this->set_environment();
  }

  protected function set_environment() {
    $env = $this->env;
    $this->apiKey = $env['apikey'];
    if ( $this->envType === 'openai' ) {
      $this->endpoint = apply_filters( 'mwai_openai_endpoint', 'https://api.openai.com/v1', $this->env );
    }
    else if ( $this->envType === 'azure' ) {
      $this->endpoint = isset( $env['endpoint'] ) ? $env['endpoint'] : null;
      $this->azureDeployments = isset( $env['deployments'] ) ? $env['deployments'] : [];
      $this->azureDeployments[] = [ 'model' => 'dall-e', 'name' => 'dall-e' ];
    }
    else {
      throw new Exception( 'Unknown environment type: ' . $this->envType );
    }
  }

  private function get_azure_deployment_name( $model ) {
    foreach ( $this->azureDeployments as $deployment ) {
      if ( $deployment['model'] === $model && !empty( $deployment['name'] ) ) {
        return $deployment['name'];
      }
    }
    throw new Exception( 'Unknown deployment for model: ' . $model );
  }

  protected function get_service_name() {
    return $this->envType === 'azure' ? 'Azure' : 'OpenAI';
  }

  // Check for a JSON-formatted error in the data, and throw an exception if it's the case.
  function check_for_error( $data ) {
    if ( strpos( $data, 'error' ) === false ) {
      return;
    }
    if ( strpos( $data, 'data: ' ) === 0 ) {
      $jsonPart = substr( $data, strlen( 'data: ' ) );
    }
    else {
      $jsonPart = $data;
    }
    $json = json_decode( $jsonPart, true );
    if ( json_last_error() === JSON_ERROR_NONE ) {
      if ( isset( $json['error'] ) ) {
        $error = $json['error'];
        $code = $error['code'];
        $message = $error['message'];
        throw new Exception( "Error $code: $message" );
      }
    }
  }

  private function build_prompt( $query ) {
    $prompt = "";
    if ( $query->mode === 'chat' ) {
      $prompt = $query->instructions . "\n\n";
      foreach ( $query->messages as $message ) {
        $role = $message['role'];
        $content = $message['content'];
        if ( $role === 'system' ) {
          $prompt .= "$content\n\n";
        }
        if ( $role === 'user' ) {
          $prompt .= "User: $content\n";
        }
        if ( $role === 'assistant' ) {
          $prompt .= "AI: $content\n";
        }
      }
      $prompt .= "AI: ";
    }
    else if ( $query->mode === 'completion' ) {
      $prompt = $query->get_message();
    }
    return $prompt;
  }

  private function build_messages( $query ) {
    $messages = [];

    // First, we need to add the first message (the instructions).
    if ( !empty( $query->instructions ) ) {
      $messages[] = [ 'role' => 'system', 'content' => $query->instructions ];
    }

    // Then, if any, we need to add the 'messages', they are already formatted.
    foreach ( $query->messages as $message ) {
      $messages[] = $message;
    }

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

  /*
    This used to be in the core.php, but since it's relative to OpenAI, it's better to have it here.
  */

  public function stream_handler( $handle, $args, $url ) {
    curl_setopt( $handle, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $handle, CURLOPT_SSL_VERIFYHOST, false );

    // Maybe we could get some info from headers, as for now, there is only the model.
    // curl_setopt( $handle, CURLOPT_HEADERFUNCTION, function( $curl, $headerLine ) {
    //   $line = trim( $headerLine );
    //   return strlen( $headerLine );
    // });

    curl_setopt( $handle, CURLOPT_WRITEFUNCTION, function ( $curl, $data ) {
      $length = strlen( $data );

      // FOR DEBUG:
      // preg_match_all( '/"content":"(.*?)"/', $data, $matches );
      // $contents = $matches[1];
      // foreach ( $contents as $content ) {
      //   error_log( "Content: $content" );
      // }

      // Error Management
      $this->check_for_error( $data );

      // Bufferize the unfinished stream (if it's the case)
      $this->streamTemporaryBuffer .= $data;
      $this->streamBuffer .= $data;
      $lines = explode( "\n", $this->streamTemporaryBuffer );
      if ( substr( $this->streamTemporaryBuffer, -1 ) !== "\n" ) {
        $this->streamTemporaryBuffer = array_pop( $lines );
      }
      else {
        $this->streamTemporaryBuffer = "";
      }

      foreach ( $lines as $line ) {
        if ( $line === "" ) {
          continue;
        }
        if ( strpos( $line, 'data: ' ) === 0 ) {
          $line = substr( $line, 6 );
          $json = json_decode( $line, true );

          if ( json_last_error() === JSON_ERROR_NONE ) {
            $content = null;

            // Get additional data from the JSON
            if ( isset( $json['model'] ) ) {
              $this->inModel = $json['model'];
            }
            if ( isset( $json['id'] ) ) {
              $this->inId = $json['id'];
            }

            // Get the content
            if ( isset( $json['choices'][0]['text'] ) ) {
              $content = $json['choices'][0]['text'];
            }
            else if ( isset( $json['choices'][0]['delta']['content'] ) ) {
              $content = $json['choices'][0]['delta']['content'];
            }
            else if ( isset( $json['choices'][0]['delta']['function_call'] ) ) {
              $function_call = $json['choices'][0]['delta']['function_call'];
              if ( empty( $this->streamFunctionCall ) ) {
                $this->streamFunctionCall = [ 'name' => "", 'arguments' => "" ];
              }
              if ( isset( $function_call['name'] ) ) {
                $this->streamFunctionCall['name'] .= $function_call['name'];
              }
              if ( isset( $function_call['arguments'] ) ) {
                $this->streamFunctionCall['arguments'] .= $function_call['arguments'];
              }
            }
            if ( $content !== null && $content !== "" ) {
              $this->streamContent .= $content;
              call_user_func( $this->streamCallback, $content );
            }
          }
          else {
            $this->streamTemporaryBuffer .= $line . "\n";
          }
        }
      }
      return $length;
    });
  }

  protected function build_headers( $query ) {
    if ( $query->apiKey ) {
      $this->apiKey = $query->apiKey;
    }
    if ( empty( $this->apiKey ) ) {
      throw new Exception( 'No API Key provided. Please visit the Settings.' );
    }
    $headers = array(
      'Content-Type' => 'application/json',
      'Authorization' => 'Bearer ' . $this->apiKey,
    );
    if ( $this->envType === 'azure' ) {
      $headers = array( 'Content-Type' => 'application/json', 'api-key' => $this->apiKey );
    }
    return $headers;
  }

  protected function build_options( $headers, $json = null, $forms = null, $method = 'POST' ) {
    $body = null;
    if ( !empty( $forms ) ) {
      $boundary = wp_generate_password ( 24, false );
      $headers['Content-Type'] = 'multipart/form-data; boundary=' . $boundary;
      $body = $this->build_form_body( $forms, $boundary );
    }
    else if ( !empty( $json ) ) {
      $body = json_encode( $json );
    }
    $options = array(
      'headers' => $headers,
      'method' => $method,
      'timeout' => MWAI_TIMEOUT,
      'body' => $body,
      'sslverify' => false
    );
    return $options;
  }

  public function run_query( $url, $options, $isStream = false ) {
    try {
      $options['stream'] = $isStream;
      if ( $isStream ) {
        $options['filename'] = tempnam( sys_get_temp_dir(), 'mwai-stream-' );
      }
      $res = wp_remote_get( $url, $options );

      if ( is_wp_error( $res ) ) {
        throw new Exception( $res->get_error_message() );
      }

      if ( $isStream ) {
        return [ 'stream' => true ]; 
      }

      $response = wp_remote_retrieve_body( $res );
      $headersRes = wp_remote_retrieve_headers( $res );
      $headers = $headersRes->getAll();

      // Check if Content-Type is 'multipart/form-data' or 'text/plain'
      // If so, we don't need to decode the response
      $normalizedHeaders = array_change_key_case( $headers, CASE_LOWER );
      $resContentType = $normalizedHeaders['content-type'] ?? '';
      if ( strpos( $resContentType, 'multipart/form-data' ) !== false || strpos( $resContentType, 'text/plain' ) !== false ) {
        return [ 'stream' => false, 'headers' => $headers, 'data' => $response ];
      }

      $data = json_decode( $response, true );
      $this->handle_response_errors( $data );
      return [ 'headers' => $headers, 'data' => $data ];
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      throw $e;
    }
  }

  private function get_audio( $url ) {
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    $tmpFile = tempnam( sys_get_temp_dir(), 'audio_' );
    file_put_contents( $tmpFile, file_get_contents( $url ) );
    $length = null;
    $metadata = wp_read_audio_metadata( $tmpFile );
    if ( isset( $metadata['length'] ) ) {
      $length = $metadata['length'];
    }
    $data = file_get_contents( $tmpFile );
    unlink( $tmpFile );
    return [ 'data' => $data, 'length' => $length ];
  }

  public function run_transcribe_query( $query ) {
    $modeEndpoint = $query->mode === 'translation' ? 'translations' : 'transcriptions';
    $url = 'https://api.openai.com/v1/audio/' . $modeEndpoint;

    // Check if the URL is valid.
    if ( !filter_var( $query->url, FILTER_VALIDATE_URL ) ) {
      throw new Exception( 'Invalid URL for transcription.' );
    }

    $audioData = $this->get_audio( $query->url );
    $body = array( 
      'prompt' => $query->message,
      'model' => $query->model,
      'response_format' => 'text',
      'file' => basename( $query->url ),
      'data' => $audioData['data']
    );
    $headers = $this->build_headers( $query );
    $options = $this->build_options( $headers, null, $body );

    // Perform the request
    try { 
      $res = $this->run_query( $url, $options );
      $data = $res['data'];
      if ( empty( $data ) ) {
        throw new Exception( 'Invalid data for transcription.' );
      }
      $this->check_for_error( $data );
      $usage = $this->core->record_audio_usage( $query->model, $audioData['length'] );
      $reply = new Meow_MWAI_Reply( $query );
      $reply->set_usage( $usage );
      $reply->set_choices( $data );
      return $reply;
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      $service = $this->get_service_name();
      throw new Exception( "From $service: " . $e->getMessage() );
    }
  }

  public function run_embedding_query( $query ) {
    $url = 'https://api.openai.com/v1/embeddings';
    $body = array( 'input' => $query->message, 'model' => $query->model );
    if ( $this->envType === 'azure' ) {
      $deployment_name = $this->get_azure_deployment_name( $query->model );
      $url = trailingslashit( $this->endpoint ) . 'openai/deployments/' .
        $deployment_name . '/embeddings?' . $this->azureApiVersion;
      $body = array( "input" => $query->message );
    }
    $headers = $this->build_headers( $query );
    $options = $this->build_options( $headers, $body );

    try {
      $res = $this->run_query( $url, $options );
      $data = $res['data'];
      if ( empty( $data ) || !isset( $data['data'] ) ) {
        throw new Exception( 'Invalid data for embedding.' );
      }
      $usage = $data['usage'];
      $this->core->record_tokens_usage( $query->model, $usage['prompt_tokens'] );
      $reply = new Meow_MWAI_Reply( $query );
      $reply->set_usage( $usage );
      $reply->set_choices( $data['data'] );
      return $reply;
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      $service = $this->get_service_name();
      throw new Exception( "From $service: " . $e->getMessage() );
    }
  }

  public function run_completion_query( $query, $streamCallback = null ) : Meow_MWAI_Reply {
    if ( !is_null( $streamCallback ) ) {
      $this->streamCallback = $streamCallback;
      add_action( 'http_api_curl', array( $this, 'stream_handler' ), 10, 3 );
    }
    if ( $query->mode !== 'chat' && $query->mode !== 'completion' ) {
      throw new Exception( 'Unknown mode for query: ' . $query->mode );
    }

    $body = array(
      "model" => $query->model,
      "n" => $query->maxResults,
      "max_tokens" => $query->maxTokens,
      "temperature" => $query->temperature,
      "stream" => !is_null( $streamCallback ),
    );

    if ( !empty( $query->stop ) ) {
      $body['stop'] = $query->stop;
    }

    if ( !empty( $query->responseFormat ) ) {
      if ( $query->responseFormat === 'json' ) {
        $body['response_format'] = [ 'type' => 'json_object' ];
      }
    }

    if ( !empty( $query->functions ) ) {
      if ( strpos( $query->model, 'ft:' ) === 0 ) {
        throw new Exception( 'OpenAI doesn\'t support Function Calling with fine-tuned models yet.' );
      }
      $body['functions'] = $query->functions;
      $body['function_call'] = $query->functionCall;
    }
    if ( $query->mode === 'chat' ) {
      $body['messages'] = $this->build_messages( $query );
    }
    else if ( $query->mode === 'completion' ) {
      $body['prompt'] = $this->build_prompt( $query );
    }

    $url = $this->endpoint;
    if ( $this->envType === 'azure' ) {
      $deployment_name = $this->get_azure_deployment_name( $query->model );
      $url = trailingslashit( $this->endpoint ) . 'openai/deployments/' . $deployment_name;
      if ( $query->mode === 'chat' ) {
        $url .= '/chat/completions?' . $this->azureApiVersion;
      }
      else if ($query->mode === 'completion') {
        $url .= '/completions?' . $this->azureApiVersion;
      }
    }
    else {
      if ( $query->mode === 'chat' ) {
        $url .= '/chat/completions';
      }
      else if ( $query->mode === 'completion' ) {
        $url .= '/completions';
      }
    }

    $headers = $this->build_headers( $query );
    $options = $this->build_options( $headers, $body );

    try {
      $res = $this->run_query( $url, $options, $streamCallback );
      $reply = new Meow_MWAI_Reply( $query );

      $returned_id = null;
      $returned_model = $this->inModel;
      $returned_in_tokens = null;
      $returned_out_tokens = null;
      $returned_choices = [];

      if ( !is_null( $streamCallback ) ) {
        // Streamed data
        if ( empty( $this->streamContent ) ) {
          $json = json_decode( $this->streamBuffer, true );
          if ( isset( $json['error']['message'] ) ) {
            throw new Exception( $json['error']['message'] );
          }
        }
        $returned_id = $this->inId;
        $returned_model = $this->inModel ? $this->inModel : $query->model;
        $returned_choices = [
          [ 
            'message' => [ 
              'content' => $this->streamContent,
              'function_call' => $this->streamFunctionCall
            ]
          ]
        ];
      }
      else {
        // Regular data
        $data = $res['data'];
        if ( empty( $data ) ) {
          throw new Exception( 'No content received (res is null).' );
        }
        if ( !$data['model'] ) {
          error_log( print_r( $data, 1 ) );
          throw new Exception( 'Invalid response (no model information).' );
        }
        $returned_id = $data['id'];
        $returned_model = $data['model'];
        $returned_in_tokens = isset( $data['usage']['prompt_tokens'] ) ? $data['usage']['prompt_tokens'] : null;
        $returned_out_tokens = isset( $data['usage']['completion_tokens'] ) ? $data['usage']['completion_tokens'] : null;
        $returned_choices = $data['choices'];
      }
      
      // Set the results.
      $reply->set_choices( $returned_choices );
      if ( !empty( $returned_id ) ) {
        $reply->set_id( $returned_id );
      }

      // Handle tokens.
      $this->handle_tokens_usage( $reply, $query, $returned_model, $returned_in_tokens, $returned_out_tokens );

      return $reply;
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      $service = $this->get_service_name();
      $message = "From $service: " . $e->getMessage();
      throw new Exception( $message );
    }
  }

  public function handle_tokens_usage( $reply, $query, $returned_model, $returned_in_tokens, $returned_out_tokens ) {
    $returned_in_tokens = !is_null( $returned_in_tokens ) ? $returned_in_tokens : $reply->get_in_tokens( $query );
    $returned_out_tokens = !is_null( $returned_out_tokens ) ? $returned_out_tokens : $reply->get_out_tokens();
    $usage = $this->core->record_tokens_usage( $returned_model, $returned_in_tokens, $returned_out_tokens );
    $reply->set_usage( $usage );
  }

  // Request to DALL-E API
  public function run_images_query( $query ) {
    $url = 'https://api.openai.com/v1/images/generations';
    $model = $query->model;
    $resolution = !empty( $query->resolution ) ? $query->resolution : '1024x1024';
    $body = array(
      "prompt" => $query->message,
      "n" => $query->maxResults,
      "size" => $resolution,
    );
    if ( $model === 'dall-e-3' ) { 
      $body['model'] = 'dall-e-3';
    }
    if ( $model === 'dall-e-3-hd' ) {
      $body['model'] = 'dall-e-3';
      $body['quality'] = 'hd';
    }
    if ( !empty( $query->style ) && strpos( $model, 'dall-e-3' ) === 0 ) {
      $body['style'] = $query->style;
    }
    if ( $this->envType === 'azure' ) {
      $deployment_name = $this->get_azure_deployment_name( $query->model );
      $url = trailingslashit( $this->endpoint ) . 'openai/deployments/' .
        $deployment_name . '/images/generations?' . $this->azureApiVersion;
    }
    $headers = $this->build_headers( $query );
    $options = $this->build_options( $headers, $body );

    try {
      $res = $this->run_query( $url, $options );
      $data = $res['data'];
      $choices = [];
      if ( $this->envType === 'azure' ) {
        foreach ( $data['data'] as $entry ) {
          $choices[] = [ 'url' => $entry['url'] ];
        }
      }
      else {
        $choices = $data['data'];
      }

      $reply = new Meow_MWAI_Reply( $query );
      $usage = $this->core->record_images_usage( $model, $resolution, $query->maxResults );
      $reply->set_usage( $usage );
      $reply->set_choices( $choices );
      $reply->set_type( 'images' );

      // Transfer the images to the local server if needed.
      $localDownload = $this->core->get_option( 'image_local_download' );
      $expiresDownload = $this->core->get_option( 'image_expires_download' );

      // if $localDownload is either uploads or library
      if ( $localDownload === 'uploads' || $localDownload === 'library' ) {
        foreach ( $reply->results as &$result ) {
          $fileId = $this->core->files->commit_file( $result, $localDownload, $expiresDownload );
          $fileUrl = $this->core->files->get_url( $fileId );
          $result = $fileUrl;
        }
      }

      // Convert the URLs into Markdown.
      $reply->result = "";
      foreach ( $reply->results as $result ) {
        $reply->result .= "![Image]($result)\n";
      }

      return $reply;
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      $service = $this->get_service_name();
      throw new Exception( "From $service: " . $e->getMessage() );
    }
  }

  /*
    This is the rest of the OpenAI API support, not related to the models directly.
  */

  // Check if there are errors in the response from OpenAI, and throw an exception if so.
  public function handle_response_errors( $data ) {
    if ( isset( $data['error'] ) ) {
      $message = $data['error']['message'];
      if ( preg_match( '/API key provided(: .*)\./', $message, $matches ) ) {
        $message = str_replace( $matches[1], '', $message );
      }
      throw new Exception( $message );
    }
  }

  public function list_files()
  {
    return $this->execute( 'GET', '/files' );
  }

  static function get_suffix_for_model($model)
  {
    // Legacy fine-tuned models
    preg_match( "/:([a-zA-Z0-9\-]{1,40})-([0-9]{4})-([0-9]{2})-([0-9]{2})/", $model, $matches);
    if ( count( $matches ) > 0 ) {
      return $matches[1];
    }

    // New fine-tuned models
    preg_match("/:([^:]+)(?=:[^:]+$)/", $model, $matches);
    if (count($matches) > 0) {
       return $matches[1];
    }

    return 'N/A';
  }

  static function get_finetune_base_model($model)
  {
    // New fine-tuned models
    preg_match("/^ft:([^:]+):/", $model, $matches);
    if (count($matches) > 0) {
      if ( preg_match( '/^gpt-3.5/', $matches[1] ) ) {
        return "gpt-3.5-turbo";
      }
      else if ( preg_match( '/^gpt-4/', $matches[1] ) ) {
        return "gpt-4";
      }
      return $matches[1];
    }

    // Legacy fine-tuned models
    preg_match('/^([a-zA-Z]{0,32}):/', $model, $matches );
    if ( count( $matches ) > 0 ) {
      return $matches[1];
    }

    return null;
  }

  public function list_deleted_finetunes( $envId = null, $legacy = false ) 
  {
    $finetunes = $this->list_finetunes( $legacy );
    $deleted = [];

    foreach ( $finetunes as $finetune ) {
      $name = $finetune['model'];
      $isSucceeded = $finetune['status'] === 'succeeded';
      if ( $isSucceeded ) {
        try {
          $finetune = $this->get_model( $name );
        }
        catch ( Exception $e ) {
          $deleted[] = $name;
        }
      }
    }
    if ( $legacy ) {
      $this->core->update_ai_env( $this->envId, 'legacy_finetunes_deleted', $deleted );
    }
    else {
      $this->core->update_ai_env( $this->envId, 'finetunes_deleted', $deleted );
    }
    return $deleted;
  }

  // public function listModels() {
  //   $res = $this->execute( 'GET', '/models' );
  //   // TODO: Not used by the UI.
  //   throw new Exception( 'Not implemented yet.' );
  // }

  // TODO: This was used to retrieve the fine-tuned models, but not sure this is how we should
  // retrieve all the models since Summer 2023, let's see! WIP.
  public function list_finetunes( $legacy = false )
  {
    if ( $legacy ) {
      $res = $this->execute( 'GET', '/fine-tunes' );
    }
    else {
      $res = $this->execute( 'GET', '/fine_tuning/jobs' );
    }
    $finetunes = $res['data'];

    // Add suffix
    $finetunes = array_map( function ( $finetune ) {
      $finetune['suffix'] = SELF::get_suffix_for_model( $finetune['fine_tuned_model'] );
      $finetune['createdOn'] = date( 'Y-m-d H:i:s', $finetune['created_at'] );
      $finetune['updatedOn'] = date( 'Y-m-d H:i:s', $finetune['updated_at'] );
      $finetune['base_model'] = $finetune['model'];
      $finetune['model'] = $finetune['fine_tuned_model'];
      unset( $finetune['object'] );
      unset( $finetune['hyperparams'] );
      unset( $finetune['result_files'] );
      unset( $finetune['training_files'] );
      unset( $finetune['validation_files'] );
      unset( $finetune['created_at'] );
      unset( $finetune['updated_at'] );
      unset( $finetune['fine_tuned_model'] );
      return $finetune;
    }, $finetunes);

    usort( $finetunes, function ( $a, $b ) {
      return strtotime( $b['createdOn'] ) - strtotime( $a['createdOn'] );
    });

    if ( $legacy ) {
      $this->core->update_ai_env( $this->envId, 'legacy_finetunes', $finetunes );
    }
    else {
      $this->core->update_ai_env( $this->envId, 'finetunes', $finetunes );
    }

    return $finetunes;
  }

  public function moderate( $input ) {
    $result = $this->execute('POST', '/moderations', [
      'input' => $input
    ]);
    return $result;
  }

  public function upload_file( $filename, $data )
  {
    $result = $this->execute('POST', '/files', null, [
      'purpose' => 'fine-tune',
      'data' => $data,
      'file' => $filename
    ] );
    return $result;
  }

  public function delete_file( $fileId )
  {
    return $this->execute( 'DELETE', '/files/' . $fileId );
  }

  public function get_model( $modelId )
  {
    return $this->execute( 'GET', '/models/' . $modelId );
  }

  public function cancel_finetune( $fineTuneId )
  {
    return $this->execute( 'POST', '/fine-tunes/' . $fineTuneId . '/cancel' );
  }

  public function delete_finetune( $modelId )
  {
    return $this->execute( 'DELETE', '/models/' . $modelId );
  }

  public function download_file( $fileId )
  {
    return $this->execute( 'GET', '/files/' . $fileId . '/content', null, null, false );
  }

  public function run_finetune( $fileId, $model, $suffix, $hyperparams = [], $legacy = false )
  {
    $n_epochs = isset( $hyperparams['nEpochs'] ) ? (int)$hyperparams['nEpochs'] : null;
    $batch_size = isset( $hyperparams['batchSize'] ) ? (int)$hyperparams['batchSize'] : null;
    $learning_rate_multiplier = isset( $hyperparams['learningRateMultiplier'] ) ? 
      (float)$hyperparams['learningRateMultiplier'] : null;
    $prompt_loss_weight = isset( $hyperparams['promptLossWeight'] ) ? 
      (float)$hyperparams['promptLossWeight'] : null;
    $arguments = [
      'training_file' => $fileId,
      'model' => $model,
      'suffix' => $suffix
    ];
    if ( $legacy ) {
      $result = $this->execute( 'POST', '/fine-tunes', $arguments );
    }
    else {
      if ( $n_epochs ) {
        $arguments['hyperparams'] = [];
        $arguments['hyperparams']['n_epochs'] = $n_epochs;
      }
      if ( $batch_size ) {
        if ( empty( $arguments['hyperparams'] ) ) {
          $arguments['hyperparams'] = [];
        }
        $arguments['hyperparams']['batch_size'] = $batch_size;
      }
      if ( $learning_rate_multiplier ) {
        if ( empty( $arguments['hyperparams'] ) ) {
          $arguments['hyperparams'] = [];
        }
        $arguments['hyperparams']['learning_rate_multiplier'] = $learning_rate_multiplier;
      }
      if ( $prompt_loss_weight ) {
        if ( empty( $arguments['hyperparams'] ) ) {
          $arguments['hyperparams'] = [];
        }
        $arguments['hyperparams']['prompt_loss_weight'] = $prompt_loss_weight;
      }
      if ( $model === 'turbo' ) {
        $arguments['model'] = 'gpt-3.5-turbo';
      }
      $result = $this->execute( 'POST', '/fine_tuning/jobs', $arguments );
    }
    return $result;
  }

  /**
    * Build the body of a form request.
    * If the field name is 'file', then the field value is the filename of the file to upload.
    * The file contents are taken from the 'data' field.
    *  
    * @param array $fields
    * @param string $boundary
    * @return string
   */
  public function build_form_body( $fields, $boundary )
  {
    $body = '';
    foreach ( $fields as $name => $value ) {
      if ( $name == 'data' ) {
        continue;
      }
      $body .= "--$boundary\r\n";
      $body .= "Content-Disposition: form-data; name=\"$name\"";
      if ( $name == 'file' ) {
        $body .= "; filename=\"{$value}\"\r\n";
        $body .= "Content-Type: application/json\r\n\r\n";
        $body .= $fields['data'] . "\r\n";
      }
      else {
        $body .= "\r\n\r\n$value\r\n";
      }
    }
    $body .= "--$boundary--\r\n";
    return $body;
  }

  /**
    * Run a request to the OpenAI API.
    * Fore more information about the $formFields, refer to the build_form_body method.
    *
    * @param string $method POST, PUT, GET, DELETE...
    * @param string $url The API endpoint
    * @param array $query The query parameters (json)
    * @param array $formFields The form fields (multipart/form-data)
    * @param bool $json Whether to return the response as json or not
    * @return array
   */
  public function execute( $method, $url, $query = null, $formFields = null, $json = true, $extraHeaders = null )
  {
    $headers = "Content-Type: application/json\r\n" . "Authorization: Bearer " . $this->apiKey . "\r\n";
    $body = $query ? json_encode( $query ) : null;
    if ( !empty( $formFields ) ) {
      $boundary = wp_generate_password( 24, false );
      $headers  = [
        'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
        'Authorization' => 'Bearer ' . $this->apiKey
      ];
      $body = $this->build_form_body( $formFields, $boundary );
    }

    // Maybe we should have headers always as an array... not sure why we have it as a string.
    if ( !empty( $extraHeaders ) ) {
      foreach ( $extraHeaders as $key => $value ) {
        if ( is_array( $headers ) ) {
          $headers[$key] = $value;
        }
        else {
          $headers .= "$key: $value\r\n";
        }
      }
    }

    $url = 'https://api.openai.com/v1' . $url;
    $options = [
      "headers" => $headers,
      "method" => $method,
      "timeout" => MWAI_TIMEOUT,
      "body" => $body,
      "sslverify" => false
    ];

    try {
      $response = wp_remote_request( $url, $options );
      if ( is_wp_error( $response ) ) {
        throw new Exception( $response->get_error_message() );
      }
      $response = wp_remote_retrieve_body( $response );
      $data = $json ? json_decode( $response, true ) : $response;
      $this->handle_response_errors( $data );
      return $data;
    }
    catch ( Exception $e ) {
      error_log( $e->getMessage() );
      throw new Exception( 'From OpenAI: ' . $e->getMessage() );
    }
  }

  public function get_models() {
    return apply_filters( 'mwai_openai_models', MWAI_OPENAI_MODELS );
  }

  static public function get_models_static() {
    return MWAI_OPENAI_MODELS;
  }

  private function calculate_price( $modelFamily, $inUnits, $outUnits, $option = null, $finetune = false )
  {
    // For fine-tuned models:
    $potentialBaseModel = SELF::get_finetune_base_model( $modelFamily );
    if ( !empty( $potentialBaseModel ) ) {
      $modelFamily = $potentialBaseModel;
      $finetune = true;
    }

    $models = $this->get_models();
    foreach ( $models as $currentModel ) {
      if ( $currentModel['model'] === $modelFamily || ( $finetune && $currentModel['family'] === $modelFamily ) ) {
        if ( $currentModel['type'] === 'image' ) {
          if ( !$option ) {
            error_log( "AI Engine: Image models require an option." );
            return null;
          }
          else {
            foreach ( $currentModel['options'] as $imageType ) {
              if ( $imageType['option'] == $option ) {
                return $imageType['price'] * $outUnits;
              }
            }
          }
        }
        else {
          if ( $finetune ) {

            if ( isset( $currentModel['finetune']['price'] ) ) {
              $currentModel['price'] = $currentModel['finetune']['price'];
            }
            else if ( isset( $currentModel['finetune']['in'] ) ) {
              $currentModel['price'] = [
                'in' => $currentModel['finetune']['in'],
                'out' => $currentModel['finetune']['out']
              ];
            }
          }
          $inPrice = $currentModel['price'];
          $outPrice = $currentModel['price'];
          if ( is_array( $currentModel['price'] ) ) {
            $inPrice = $currentModel['price']['in'];
            $outPrice = $currentModel['price']['out'];
          }
          $inTotalPrice = $inPrice * $currentModel['unit'] * $inUnits;
          $outTotalPrice = $outPrice * $currentModel['unit'] * $outUnits;
          return $inTotalPrice + $outTotalPrice;
        }
      }
    }
    error_log( "AI Engine: Invalid model ($modelFamily)." );
    return null;
  }

  public function get_price( Meow_MWAI_Query_Base $query, Meow_MWAI_Reply $reply )
  {
    $model = $query->model;
    $units = 0;
    $option = null;

    $finetune = false;
    if ( is_a( $query, 'Meow_MWAI_Query_Text' ) || is_a( $query, 'Meow_MWAI_Query_Assistant' ) ) {
      if ( preg_match('/^([a-zA-Z]{0,32}):/', $model, $matches ) ) {
        $finetune = true;
      }
      $inUnits = $reply->get_in_tokens( $query );
      $outUnits = $reply->get_out_tokens();
      return $this->calculate_price( $model, $inUnits, $outUnits, $option, $finetune );
    }
    else if ( is_a( $query, 'Meow_MWAI_Query_Image' ) ) {
      /** @var Meow_MWAI_Query_Image $query */
      $units = $query->maxResults;
      $option = $query->resolution;
      return $this->calculate_price( $model, 0, $units, $option, $finetune );
    }
    else if ( is_a( $query, 'Meow_MWAI_Query_Transcribe' ) ) {
      $model = 'whisper';
      $units = $reply->get_units();
      return $this->calculate_price( $model, 0, $units, $option, $finetune );
    }
    else if ( is_a( $query, 'Meow_MWAI_Query_Embed' ) ) {
      $units = $reply->get_total_tokens();
      return $this->calculate_price( $model, 0, $units, $option, $finetune );
    }
    error_log("AI Engine: Cannot calculate price for $model.");
    return null;
  }

  public function get_incidents() {
    $url = 'https://status.openai.com/history.rss';
    $response = wp_remote_get( $url );
    if ( is_wp_error( $response ) ) {
      throw new Exception( $response->get_error_message() );
    }
    $response = wp_remote_retrieve_body( $response );
    $xml = simplexml_load_string( $response );
    $incidents = array();
    $oneWeekAgo = time() - 5 * 24 * 60 * 60;
    foreach ( $xml->channel->item as $item ) {
      $date = strtotime( $item->pubDate );
      if ( $date > $oneWeekAgo ) {
        $incidents[] = array(
          'title' => (string) $item->title,
          'description' => (string) $item->description,
          'date' => $date
        );
      }
    }
    return $incidents;
  }
}
