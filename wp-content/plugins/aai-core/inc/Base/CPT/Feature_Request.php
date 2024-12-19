<?php
/**
 * @package  Element Ready
 */
namespace Element_Ready_Pro\Base\CPT;
use Element_Ready\Api\Callbacks\Custom_Post;
use Element_Ready_Pro\Base\Traits\Helper;
class Feature_Request extends Custom_Post
{
    use Helper;
    public $name         = '';
    public $menu         = 'Customer Request';
    public $textdomain   = '';
    public $posts        = array();
    public $public_quary = false;
    public $slug         = 'er_frc_request';
    public $search       = false;


    public function element_ready_get_components_option($key = false){
        
        $this->name = esc_html__('Customer Request','element-ready-pro');
        $option = get_option('element_ready_components');
       
        if($option == false){
            return false;
        }
        
        return isset($option[$key]) ? $option[$key] == 'on'?true:false:false;
    }
    
    

	public function register() {

        if( $this->element_ready_get_modules_option('customer_request') ) {
            $this->textdomain = 'element-ready-pro';
            $this->posts      = array();
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_filter('manage_cus_f_request_posts_columns',[$this,'email_cpt_columns']);
            add_action( 'manage_cus_f_request_posts_custom_column' , [ $this,'custom_columns'], 10, 2 ); 
       }

      
    }
    function email_cpt_columns( $columns ) {
     
        $columns['customer_email'] = esc_html__('Email','element-ready-pro');
        return $columns;
    }
    
    function custom_columns( $column, $post_id ) {
        switch ( $column ) {

             case 'customer_email':
                echo get_post_meta( $post_id, 'element_ready_customer_request_post_email', true ); 
                break;
        }
    }

    public function create_post_type(){

        $this->init( 'cus_f_request', $this->name, $this->menu, array( 'menu_icon' => 'dashicons dashicons-admin-page',
            'supports'            => array( 'title','editor' ),
            'exclude_from_search' => $this->search,
            'has_archive'         => false,                                               // Set to false hides Archive Pages
            'publicly_queryable'  => $this->public_quary,
            'show_in_menu'        => false
        )
       );
       $this->register_custom_post();
    }

}