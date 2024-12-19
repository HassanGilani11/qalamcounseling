<?php
/**
 * @package  Element Ready
 */
namespace Element_Ready_Pro\Base\CPT;

use Element_Ready\Api\Callbacks\Custom_Post;
use Element_Ready_Pro\Base\Traits\Helper;

class Section_Custom_Shape extends Custom_Post
{
    use Helper;
    public $name         = '';
    public $menu         = 'Custom Shapes';
    public $textdomain   = '';
    public $posts        = array();
    public $public_quary = false;
    public $slug         = 'er_custom_shapes';
    public $search       = false;

    
    public function add_page(){
    
        add_submenu_page( 'element_ready_elements_dashboard_page', esc_html__('Custom Shapes','element-ready-pro'), esc_html__('Custom Shape','element-ready-pro'),
        'manage_options', 'edit.php?post_type='.$this->slug);
        
    }

	public function register() {
         
        //if( $this->element_ready_get_modules_option('custom_shapes') ) {
            $this->textdomain = 'element-ready-pro';
            $this->posts      = array();
            add_action( 'init', array( $this, 'create_post_type' ),10 );
            add_action( 'admin_menu', [ $this,'add_page' ],15 );
            add_filter('manage_'.$this->slug.'_posts_columns',[$this,'_cpt_columns']);
            add_action( 'manage_'.$this->slug.'_posts_custom_column' , [ $this,'custom_columns'], 10, 2 ); 
      // }

      
    }
 
    function _cpt_columns( $columns ) {
     
        $columns['custom_shape'] = esc_html__('Shape','element-ready-pro');
        return $columns;
    }
    
    function custom_columns( $column, $post_id ) {
        switch ( $column ) {

             case 'custom_shape':
                $shape_thumbnail_id = get_post_thumbnail_id( $post_id );
                if ( !empty( $shape_thumbnail_id ) ) {
			    	
			    	$shape_thumbnail_url = get_the_post_thumbnail_url( $post_id  );

                    echo sprintf("<img src='%s' width='100' height='100' />",$shape_thumbnail_url);
                }
               
                break;
        }
    }
  
    public function create_post_type(){

        $this->init( $this->slug , $this->name , $this->menu, array( 'menu_icon' => 'dashicons dashicons-admin-page',
            'supports'            => array( 'title','thumbnail' ),
            'exclude_from_search' => $this->search,
            'has_archive'         => false,                                               // Set to false hides Archive Pages
            'publicly_queryable'  => $this->public_quary,
            'show_in_menu'        => false
        )
       );

       $this->register_custom_post();
    }

}