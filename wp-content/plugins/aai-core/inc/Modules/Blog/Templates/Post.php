<?php
namespace Element_Ready_Pro\Modules\Blog\Templates;

/**
 *  Blog Single Page Template
 *
 * @since 1.0
 */
class Post extends Base{

    public $tpl_type = 'post';
	
    /**
     * Page Not found
     * @varsion 1.1
     */
	public function register() {

        add_filter( 'single_template', [ $this , '_template_post' ],50 );
        add_action( 'element_ready_act_tpl_post', [ $this , 'dynamic_content' ],50 );
	}

    public function _template_post($template){

        $template_id   = $this->get_active_data();
    
        if( !is_numeric( $template_id ) ){
            return $template;
        }

        if(isset($_GET['ver']) && isset($_GET['elementor-preview']) && is_numeric($_GET['elementor-preview'])){
          
            if(isset($_GET['p']) && 'post'== get_post_type( $_GET['p'] )){
               
                return $template;
            }
        }
      
      
       $template_slug = get_page_template_slug( $template_id );
       $full_width    = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/post/full-width.php';
       $canvas_width  = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/post/offcanvas.php';
      
       if( $template_id > 1 && is_singular( 'post' )){
         
           if($template_slug == 'elementor_canvas' && file_exists($canvas_width)){
               return $canvas_width; 
           }
          
           if(file_exists($full_width)){
               return $full_width;
           }
        
       } 

       return $template; 
    }
}