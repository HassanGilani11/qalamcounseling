<?php
namespace Element_Ready_Pro\Base\Crd;

class Clipboard extends Base
{
    public function register(){

        if ( !file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
            return;
		}

        		
		
		add_action( 'wp_ajax_element_ready_fetch_copy_paste_data', [ $this, 'get_data'], 1);
		
    }

    public function get_data(){

	    try{

			$data = !isset( $_POST['data'] ) ? '' : wp_unslash( $_POST['data'] );
			$type = !isset( $_POST['type'] ) ? '' : wp_unslash( $_POST['type'] );
	
			if ( $type == "multiple" ) {
	
				$json = json_decode( $data, true );
	
				$tmpl = [
					"status" => 'success',
					"code" => 200,
					"data" => [
						"template" => [
							"content" => $json
						]
					]
				];
	
			} else if ( $type == "single" ) {
				$tmpl = array( json_decode( $data, true ) );
				
			}
			
			if( isset($tmpl) ){

				$content = $this->get_import_ids($tmpl);
			
				$content = $this->get_import_content($tmpl, 'on_import');
				wp_send_json_success( $content );

			}else{
				throw new Exception("Content selection failed");
			}
			
		}catch (customException $e) {
				//display custom message
				wp_send_json_success($e->errorMessage());
		}
     

		
    }

   
	
   
}