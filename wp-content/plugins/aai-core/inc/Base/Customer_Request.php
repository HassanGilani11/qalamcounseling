<?php 
namespace Element_Ready_Pro\Base;
use \Element_Ready_Pro\Base\Traits\Helper;
Class Customer_Request {
     use Helper;
    public function register() {

        if( !$this->element_ready_get_modules_option('customer_request') ){
            return;
        }
        
        add_action( 'init', array( $this, 'save_post_if_submitted' ) ); 
      
   } 
   
    
   public function save_post_if_submitted(){
  
     // Stop running function if form wasn't submitted
    if ( !isset($_POST['action']) ) {
        return;
    }

    if ( $_POST['action'] !='element_ready_customer_request_data'  ) {
        return;
    }
   
    // Check that the nonce was set and valid
    if( !wp_verify_nonce($_POST['_wpnonce'], 'element_ready_customer_request_nonce') ) {
      
        return;
    }
    
    
    if( !isset($_POST['er_customer_subject']) ){
      return;
    }
    
    if( !isset($_POST['er_customer_email']) ){
        $_SESSION['element_ready_customer_message'] = esc_html__('Provide Email','element-ready-pro');
      return;
    }

    if(!sanitize_email($_POST['er_customer_email'])){
        $_SESSION['element_ready_customer_message'] = esc_html__('Invalid Email','element-ready-pro');
        $location = $_SERVER['HTTP_REFERER'];
        wp_safe_redirect($location);
       return;
    }

    if( !isset($_POST['element_ready_customer_request_content']) ){
        return;
    }

    if( str_word_count($_POST['element_ready_customer_request_content']) < 9 ){
        $_SESSION['element_ready_customer_message'] = esc_html__('Write minimum 10 words','element-ready-pro');     
     }
    $content = wp_kses_post($_POST['element_ready_customer_request_content']);
    
    $new_post = array(
        'post_title' => esc_html($_POST['er_customer_subject']).' from '. $_POST['er_customer_email'],
        'post_content' => $content,
        'post_status' => 'draft',
        'post_date' => date('Y-m-d H:i:s'),
        'post_type' => 'cus_f_request',
        
    );
 
    if($post_id =  wp_insert_post($new_post)){
        update_post_meta( $post_id,'element_ready_customer_request_post_email' , $_POST['er_customer_email'] );
        // set category
        if(isset($_POST['element_ready_customer_r_type'])){ 

            $type_id = $_POST['element_ready_customer_r_type'];
            if($type_id !=''){
                wp_set_object_terms( $post_id , $type_id , 'er_cr_category');
            }
            
            $_SESSION['element_ready_customer_message'] = esc_html__('Submission Success','element-ready-pro');
        }

        // message
        if(session_id() == '') {
            session_start(['read_and_close' => true]);
        }
  
        if( isset($_POST[ 'to_email' ]) ){
            $headers[] = 'From: '. $_SERVER['HTTP_HOST']. '<'.$_POST['er_customer_email'].'>';
            $headers[] = 'Cc: <'.$_POST[ 'to_email' ].'>';
            wp_mail( $_POST[ 'to_email' ] , esc_html($_POST['er_customer_subject']).' from '. $_POST['er_customer_email'] , $content, $headers );
           
        } 
    }else{
        $_SESSION['element_ready_customer_message'] = esc_html__('Submission fail','element-ready-pro');
    }
   
    $location = $_SERVER['HTTP_REFERER'];
    wp_safe_redirect($location);
   

   }

 

}