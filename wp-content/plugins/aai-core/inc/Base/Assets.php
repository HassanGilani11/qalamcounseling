<?php 
namespace Element_Ready_Pro\Base;


Class Assets {
    
    public function register() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) ); 
        add_filter( 'element_ready_product', array( $this, '_product' ) ); 
        add_filter( 'element_ready_pro_template_status', array( $this, '_pro_status' ),19 ); 
    } 
   
    public function enqueue($api_data){
        
        wp_register_script('element-ready-matrix', ELEMENT_READY_PRO_ROOT_JS . 'qrcode.min.js', array('jquery'));
        wp_register_script('lottie-player', 'https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/lottie-player.js',['element-ready-core'],ELEMENT_READY_PRO_VERSION,true);
        wp_register_script('lottie-interactivity', 'https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js',['element-ready-core'],ELEMENT_READY_PRO_VERSION, true);
   }

   public function _product(){
       return 'pro';
   }

   public function _pro_status($data){
     
    //return always false from pro plugin
    return false;
   }
 

}