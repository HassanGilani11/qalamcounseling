<?php
namespace Element_Ready_Pro\Base\Settings;
use \Element_Ready_Pro\Base\Traits\Helper;
class Page {

    use Helper; 
    public $g_api_key       = 'AIzaSyBYXj4JzFv2nuCg49IJJJlI2935Mldbp-c';
    public $google_font_url = 'https://www.googleapis.com/webfonts/v1/webfonts';
    public $file_path       = ELEMENT_READY_PRO_DIR_URL.'bin/googleFonts.json';
    
    public function register() {
      
     
	    if ( !file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
         return;
      }

        add_action( 'admin_enqueue_scripts', [ $this,'add_admin_scripts' ] );
        add_action( 'admin_init', [ $this,'load_font' ],15 );
        add_action( 'admin_menu', [ $this,'add_page' ],15 );
        add_action( 'admin_post_element_ready_pro_google_fonts_options', [ $this,'components_options' ]); 
        add_action( 'init', [ $this,'load_front_end_fonts' ]); 
        add_action( 'wp_head', [ $this,'_custom_styles' ], 100);
        add_filter( 'element_ready/dashboard/modules', [ $this,'add_module' ], 100);
        add_filter( 'element_ready_active_widget', [ $this,'active_widget' ], 100);
    }
     
    function active_widget( $widgets ){
      
      $widgets[] = 'Element_Ready_Customer_Request';
      return $widgets;
    }
   
    public function add_module($modules){

      $modules['google_fonts'] = [
        'demo_link' => '#',
        'lavel'     => esc_html__('Google Fonts', 'element-ready-pro'),
        'default'   => 0,
        'is_pro'    => 0,
      ];

      // $modules['customer_request'] = [
      //   'demo_link' => '#',
      //   'lavel'     => esc_html__('Customer Request', 'element-ready-pro'),
      //   'default'   => 0,
      //   'is_pro'    => 0,
      // ];

      $modules['shortcode_builder'] = [
        'demo_link' => '#',
        'lavel'     => esc_html__('Shortcode Builder' , 'element-ready-pro'),
        'default'   => 0,
        'is_pro'    => 0,
      ];

      $modules['blog_page_builder'] = [
        'demo_link' => '#',
        'lavel'     => esc_html__('Blog Page Builder' , 'element-ready-pro'),
        'default'   => 0,
        'is_pro'    => 0,
      ];
  
      return $modules;
    }
    public function _custom_styles(){

      if( $this->element_ready_get_modules_option('google_fonts')){
        echo "<style>";
           echo implode(' ',$this->get_required_option());
        echo "</style>";
      }
       
    }

    public function get_required_option(){
        
      if( !$this->element_ready_get_modules_option('google_fonts')){
        return;
      }
        $fields = $this->components();

        $list = [];

        foreach( $fields as $item ) {

             if( $item['type'] == 'typhography' ) {
                $valid_font = [];
               // ['DM Sans:400'] 
               $data = json_decode($item['default'],true);

               if( isset( $data['font']  ) && trim($data['font'],' ') !='' ){

                 $valid_font[] = 'font-family: '."'".$data['font']."'";
               }

               if( isset( $data['weight']  ) && trim($data['weight'],' ') !=''){

                 if($data['weight'] == 'regular'){
                    $valid_font[] = 'font-weight: 400';
                 }else{
                    $valid_font[] = 'font-weight: '.$data["weight"];
                 }
                  
               }

               if( isset( $data['size']  ) && trim($data['size'],' ') !=''){

                $valid_font[] = 'font-size:'.$data['size'];
               }
              
               if( isset( $data['selector']  ) && trim($data['selector'],' ') !='' ){

                $list[] = trim($data['selector'],',').'{ '. implode(';',$valid_font) . ' } ';
               }

               
             }
        }  

        return $list;
    }
    public function load_front_end_fonts(){

        if( !$this->element_ready_get_modules_option('google_fonts')){
          return;
        }

        $list = [];

        if( !is_admin() ){
           
           $fields = $this->components();
         
           foreach( $fields as $key => $item ) {

                if( $item['type'] == 'switch' && $key == 'enable_google_fonts' ) {
                   if($item['default'] != '1'){
                      
                   }
                }

                if( $item['type'] == 'typhography' ) {

                   $valid_font = [];
                  // ['DM Sans:400'] 
                  $data = json_decode($item['default'],true);

                  if( isset( $data['font']  ) && trim($data['font'],' ') !='' ){
                    $valid_font[] = $data['font'];
                  }

                  if( isset( $data['weight']  ) && trim($data['weight'],' ') !=''){
                    $valid_font[] = $data['weight'] == 'regular'?400:$data['weight'];
                  }

                  if(!empty($valid_font)){
                    $list[] = implode(':',$valid_font);
                  }
                 

                }
           }
       
           if( !empty($list) ){
            element_ready_google_fonts_url($list);
           }
           
        }

       
    }
    public function load_font(){

        if( !$this->element_ready_get_modules_option('google_fonts')){
          return;
        }
        
        if ( false === ( $value = get_transient( 'element_ready_pro_google_fonts_update' ) ) ) {
           
                $url = add_query_arg( array(
                    'key' => $this->g_api_key,
                
                ), $this->google_font_url );
                
                $response = wp_remote_get( $url );
            
                if ( is_array( $response ) && ! is_wp_error( $response ) ) {

                    $path         = ELEMENT_READY_PRO_DIR_PATH.'bin/googleFonts.json';
                    $headers      = $response['headers'];                               // array of http header lines
                    $responseBody = wp_remote_retrieve_body( $response );
                
                    global $wp_filesystem;
                    // Initialize the WP filesystem, no more using 'file-put-contents' function
                    if (empty($wp_filesystem)) {
                        require_once (ABSPATH . '/wp-admin/includes/file.php');
                        WP_Filesystem();
                    }

                    $wp_filesystem->mkdir( ELEMENT_READY_PRO_DIR_PATH.'bin' ); // Make a new directory folder if folder not their
                    
                    if(!$wp_filesystem->put_contents( $path , $responseBody , 0644) ) {
                        return __('Failed to create json file');
                    }

                    set_transient( 'element_ready_pro_google_fonts_update', date('y-m-d'), 36 * HOUR_IN_SECONDS );
               
                }
        }
    }

    public function add_admin_scripts($handle){
      
        if( $handle == 'element-ready_page_element-ready-pro-settings' ){

          
            wp_enqueue_style( 'select2', ELEMENT_READY_PRO_ROOT_CSS . 'select2.min.css' );
            wp_enqueue_script( 'select2', ELEMENT_READY_PRO_ROOT_JS . 'select2.min.js', array('jquery'), ELEMENT_READY_PRO_VERSION, true );
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_style( 'element-ready-grid', ELEMENT_READY_ROOT_CSS .'grid.css' );
            wp_enqueue_style( 'element-ready-admin', ELEMENT_READY_ROOT_CSS .'admin.css' );
            wp_enqueue_script( 'element-ready-admin', ELEMENT_READY_ROOT_JS .'admin.js' ,array('jquery','jquery-ui-tabs'), ELEMENT_READY_PRO_VERSION, true );
            wp_localize_script( 'element-ready-admin', 'element_ready_obj', [
                'active' => isset($_GET['tabs'])?$_GET['tabs']:0,
            ]);
        }
      
   }
    public function add_page(){

        add_submenu_page( ELEMENT_READY_SETTING_PATH , 'Settings', 'Settings', 'manage_options', 'element-ready-pro-settings', [$this,'_settings'] );
    }

    public function _settings(){
      
       require_once( 'Templates/settings.php' );
    }

    function components_options(){
       
      
        // Verify if the nonce is valid
        if ( !isset($_POST['_element_ready_google_fonts_components']) || !wp_verify_nonce($_POST['_element_ready_google_fonts_components'], 'element-ready-google-fonts-components')) {
            wp_redirect($_SERVER["HTTP_REFERER"]);
        }
      
        if( !isset($_POST['element-ready-pro-google-fonts-options']) ){
            wp_redirect($_SERVER["HTTP_REFERER"]); 
        }
       
        // Save
        $validate_options = $this->validate_options($_POST['element-ready-pro-google-fonts-options']);
         
        update_option('element_ready_pro_google_fonts_options',$validate_options);
        
        if ( wp_doing_ajax() )
        {
          wp_die();
        }else{

            $url        = $_SERVER["HTTP_REFERER"];
            $return_url = add_query_arg( array(
                'tabs' => 1,
            ), $url );
          
            wp_redirect($return_url);
        
        }
        
    }

    public function validate_options($options = []){
        
        if(!is_array($options)){
            return $options;
        }

        $return_options = [];
        $config_feilds  = $this->default_fields();

        foreach( $options as $key => $value ){
          if( isset( $config_feilds[$key]['type'] ) && $config_feilds[$key]['type'] == 'typhography' ){
            $return_options[$key] = $value;
          }else{
            $return_options[$key] = sanitize_text_field($value);
          }
        
        }

        return $return_options;
    }

    public function default_fields(){

        $return_arr = [
          
            'body_fonts_typhography' => [
               
                'lavel'   => esc_html__('Body Typhography','element-ready'),
                'default' => ['font' => '','size'=>'12px','weight' => '500','selector'=>''],
                'type'    => 'typhography',
                
            ],

            'heading1_fonts_typhography' => [
               
                'lavel'   => esc_html__('Font h1','element-ready'),
                'default' => ['font' => '','size'=>'12px','weight' => '500','selector'=>''],
                'type'    => 'typhography',
                
            ],

            'heading2_fonts_typhography' => [
               
                'lavel'   => esc_html__('Font 2','element-ready'),
                'default' => ['font' => '','size'=>'12px','weight' => '500','selector'=>''],
                'type'    => 'typhography',
                
            ],
            'heading3_fonts_typhography' => [
               
                'lavel'   => esc_html__('Font 3','element-ready'),
                'default' => ['font' => '','size'=>'12px','weight' => '500','selector'=>''],
                'type'    => 'typhography',
                
            ],
            'heading4_fonts_typhography' => [
               
                'lavel'   => esc_html__('Font 4','element-ready'),
                'default' => ['font' => '','size'=>'12px','weight' => '500','selector'=>''],
                'type'    => 'typhography',
                
            ],
         

        ];

        return $return_arr;
    }
    public function components(){


        $return_arr = $this->get_transform_options($this->default_fields(),'element_ready_pro_google_fonts_options');
        
        return $return_arr;

    }

    public function get_transform_options($options = [], $key = false){

        if( !is_array($options) || $key == false ){
            return $options;
        }

        $db_option = get_option( $key );

        $return_options = $options;
        
        foreach( $options as $key => $value ){

          if($options[$key]['type'] =='switch'){
            if( isset($db_option[$key]) ){
                $return_options[$key]['default'] = 1;
              }else{
                $return_options[$key]['default'] = 0;
              } 
          } 

          if($options[$key]['type'] =='select'){

            if( isset($db_option[$key]) ){
                $return_options[$key]['default'] = $db_option[$key];
              }else{
                $return_options[$key]['default'] = '';
              } 

          }

          if($options[$key]['type'] =='select2'){

            if( isset($db_option[$key]) ){
                $return_options[$key]['default'] = $db_option[$key];
              }else{
                $return_options[$key]['default'] = '';
            } 

          }
          if($options[$key]['type'] =='typhography'){
            
            if( isset($db_option[$key]) ){
                $return_options[$key]['default'] = json_encode($db_option[$key]);
              }else{
                $return_options[$key]['default'] = json_encode(['font'=>'','size' => '','weight'=>'','selector'=>'']);
            } 

          }
             
        
        }
       
        return $return_options; 
    }

    public function get_google_fonts(){

        $path = ELEMENT_READY_PRO_DIR_PATH.'bin/googleFonts.json';
        global $wp_filesystem;
        // Initialize the WP filesystem, no more using 'file-put-contents' function
        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }
       
        $response = $wp_filesystem->get_contents( $path );
        return $response;

    }
    
}