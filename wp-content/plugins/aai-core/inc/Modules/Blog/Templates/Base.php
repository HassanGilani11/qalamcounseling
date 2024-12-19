<?php
namespace Element_Ready_Pro\Modules\Blog\Templates;
use WP_Meta_Query;
/**
 * Query
 * 404_template
 * archive_template
 * attachment_template
 * author_template
 * category_template
 * date_template
 * embed_template
 * frontpage_template
 * home_template
 * index_template
 * page_template
 * paged_template
 * privacypolicy_template
 * search_template
 * single_template
 * singular_template
 * tag_template
 * taxonomy_template
 * @since 1.0
 */
abstract class Base {

   public $type = ''; 
   public $post_tpl_id = ''; 
 
   abstract protected function register();
   public function dynamic_content(){
       
        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($this->post_tpl_id);
    
   }
   public function get_active_data(){
    
    
    $args = array(
        'post_type'   => 'er-blog-tpl',
        'numberposts' => 1,
        'meta_query'      => array(
            'relation' => 'AND',
            array(
                'key'     => 'er_blog_tpl_active',
                'value'   => 'active',
                'compare' => '=',
            ),
            array(
                'key'     => 'er_blog_tpl_type',
                'value'   => $this->tpl_type,
                'compare' => '=',
            ),
        )
    );

    $key_args = serialize($args);
    $query = get_posts( $args );
   
    if(empty( $query)){
        return false;
    } 
   
    if(isset($query[0]->ID)){
        $this->post_tpl_id =  $query[0]->ID; 
        return $query[0]->ID;
    }

    return false;

   }

}