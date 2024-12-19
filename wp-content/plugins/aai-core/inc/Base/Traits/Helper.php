<?php
namespace Element_Ready_Pro\Base\Traits;

trait Helper {
    
    static public $data = null;
    function element_ready_get_modules_option($key = false){
            
        $option = get_option('element_ready_modules');
    
        if( $option == false ){
            return false;
        }
        
        return isset($option[$key]) ? $option[$key] == 'on'?true:false:false;
    } 
    function local($whitelist = ['127.0.0.1', '::1','jaguarundi.net']) {

        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }

    function masking_image_shapes($path = 'svgs'){

        $widgets_modules = [];
        $dir_path        = ELEMENT_READY_PRO_DIR_PATH."assets/img/".$path;
        $url_path        = ELEMENT_READY_PRO_URL."assets/img/".$path;
        $dir             = new \DirectoryIterator( $dir_path );
        
         foreach ($dir as $fileinfo) {
             
             if ( !$fileinfo->isDot() ) {
                 $file_name = explode('.',$fileinfo->getFilename());   
                 $widgets_modules[$url_path.'/'.$fileinfo->getFilename()] = [
                    'title'      => $file_name[0],
                    'width'      => '33%',
                    'imagelarge' =>  $url_path.'/'.$fileinfo->getFilename(),
					'imagesmall' =>  $url_path.'/'.$fileinfo->getFilename(),
                 ]; 
                
             }
         }

        return $widgets_modules;
    }

    function custom_section_shapes($path = 'shapes'){

        $widgets_modules = [];
        $dir_path        = ELEMENT_READY_PRO_DIR_PATH."assets/img/".$path;
        $url_path        = ELEMENT_READY_PRO_URL."assets/img/".$path;
        $dir             = new \DirectoryIterator( $dir_path );
        
         foreach ($dir as $fileinfo) {
             
             if ( !$fileinfo->isDot() ) {
                 $file_name = explode('.',$fileinfo->getFilename());   
           
                 $widgets_modules[ $file_name[0] ] = [
                    'title'        => $file_name[0],
                    'path'         => $dir_path.'/'.$fileinfo->getFilename(),   // used in front
                    'url'          => $url_path.'/'.$fileinfo->getFilename(),   // used in editor
                    'has_flip'     => true,
                    'has_negative' => true
                ];
                
             }
         }

        return $widgets_modules;
    }

    function get_sw(){
        return true;
        if($this->local()){
            return true;
        }
         
        if( is_null(self::$data) ){
      
            self::$data = get_option('element_ready_pro_connect_data');
        }

        if(isset(self::$data['license']) && self::$data['license'] =='valid' && isset(self::$data['domain']) && self::$data['domain'] == $_SERVER['HTTP_HOST'] && self::$data['code'] == '200'){
            return true;
        }
   
        return false;
    }

    function ecollect(){
        
        try {
            global $wpdb;
            return $wpdb->get_results( "SELECT meta_key, meta_value as email FROM {$wpdb->prefix}postmeta WHERE meta_key = 'element_ready_customer_request_post_email'", OBJECT );
          
        } catch (Exception $e) {
            return [];
        }
      

    }

    

    
}