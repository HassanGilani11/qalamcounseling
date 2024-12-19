<?php 
namespace Element_Ready_Pro\Base\Sections;

class Protect_Content {
   /*
   * Widget 
   */
    public function add_component($items){

       if( element_ready_get_components_option('WP_protected_content') ){

          $items[] = 'WP_protected_content'; 
       }
       
       return $items;
    }

    public function add_widget_to_component($items){

        $items['WP_protected_content'] =  [
            'demo_link' => ELEMENT_READY_DEMO_URL.'protected-content',
            'lavel'     => esc_html__('Protected Content', 'element-ready'),
            'default'   => 0,
            'is_pro'    => 0,
        ];
        return $items;
     }

    public function is_active($settings,$id=''){
  
        if($settings['elemnt_ready_pro_protected_content_enable_session'] == 'yes'){

            if( isset( $_SESSION['element_ready_pro_protected_content_'.$id])){
                return true;
            }
        }
        
        $active   = $settings['element_ready_pro_protected_active'];
        $password = $settings['element_ready_pro_protected_password'];
        if( isset($_REQUEST['element-ready-protected-number']) && isset($_REQUEST['element-ready-protected-id']) ){
            
            $provider_pass = $_REQUEST['element-ready-protected-number'];
            $provider_id = $_REQUEST['element-ready-protected-id'];
            
            if($id==$provider_id && $password == $provider_pass ){
                $_SESSION['element_ready_pro_protected_content_'.$provider_id] = true;
              return true;
            }
        }

        if( $active =='yes' ){
            return false;
        }

        return true;
    }

  
}