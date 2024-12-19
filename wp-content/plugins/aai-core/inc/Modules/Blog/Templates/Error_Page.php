<?php
namespace Element_Ready_Pro\Modules\Blog\Templates;

/**
 *  Error page Template
 *
 * @since 1.0
 */
class Error_Page extends Base{

    public $tpl_type = '404';
	
    /**
     * Page Not found
     * @varsion 1.1
     */
	public function register() {
      
        add_filter( '404_template', [ $this , '_template_four_zero_four_page' ],50 );
        add_action( 'element_ready_act_tpl_404', [ $this , 'dynamic_content' ],50 );
	}

    public function _template_four_zero_four_page($template){
       
       $template_id   = $this->get_active_data();
       $template_slug = get_page_template_slug( $template_id );
       $full_width    = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/error/full-width.php';
       $canvas_width  = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/error/offcanvas.php';

       if( $template_id > 1 && is_404()){
         
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