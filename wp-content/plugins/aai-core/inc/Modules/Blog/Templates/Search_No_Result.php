<?php
namespace Element_Ready_Pro\Modules\Blog\Templates;

/**
 *  Post Search page Template
 *
 * @since 1.0
 */
class Search_No_Result extends Base{

    public $tpl_type = 'no_search_result';
	
    /**
     * Result Not found
     * @varsion 1.1
     */
	public function register() {
      
       add_filter( 'search_template', [ $this , '_template_search' ],52 );
       add_action( 'element_ready_act_tpl_search_no_result', [ $this , 'dynamic_content' ],51 );
	}

    public function _template_search($template){

       global $wp_query;
     
       if(isset($wp_query->found_posts) && $wp_query->found_posts){
           return $template; 
       }
     
       $template_id   = $this->get_active_data();
       $template_slug = get_page_template_slug( $template_id );
       $full_width    = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/search-no-result/full-width.php';
       $canvas_width  = ELEMENT_READY_BLOG_MODULE_PATH . '/Templates/search-no-result/offcanvas.php';
      

       if( $template_id > 1 ){
         
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