<?php
namespace Element_Ready_Pro\Base\Crd;

class LiveCopy extends LiveCopy_Base
{

  
    public function register(){

        if ( !file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
            return;
		}
	  
		add_action( 'wp_ajax_element_ready_fetch_live_copy_data', [ $this, 'get_section_data'], 1);
		add_action( 'wp_ajax_nopriv_element_ready_fetch_live_copy_data', [ $this, 'get_section_data'], 1);
    }

    public function get_section_data(){
        
        if( isset( $_POST['action'] ) && isset( $_POST['post_id'] ) && isset( $_POST['section_id'] ) ){

            $this->section_id = sanitize_text_field($_POST['section_id']);
            $this->post_id    = sanitize_text_field($_POST['post_id']);
            $this->type       = sanitize_text_field($_POST['type']);

            if( $this->post_id != '' && $this->section_id != '' ){
                
               
                wp_send_json_success( [ 'elementCode'=> $this->get_direct_content(),'elementType'=> $this->type] );
            }

            wp_die();
        }

        wp_send_json_success('Section Copy fail');

        wp_die();
    }

}