<?php
namespace Element_Ready_Pro\Base\Settings;
use \Element_Ready_Pro\Base\Traits\Helper;
class Customer_Request {
    use Helper;
    public $links = [
        
    ];
    public function register() {

        $this->links[] = [
            'label' => esc_html__('Category','element-ready'), 
            'url' => 'edit-tags.php?taxonomy=er_cr_category&post_type=cus_f_request' 
        ];

        $this->links[] = [
            'label' => esc_html__('Email List','element-ready'), 
            'url' => 'admin.php?page=element-ready-pro-cemail-settings' 
        ];


        add_action( 'admin_menu', [ $this,'add_page' ],15 );
        add_action( 'views_edit-cus_f_request' , [ $this,'add_sub_links' ], 100); 
        add_action( 'admin_enqueue_scripts', [ $this,'add_admin_scripts' ] );
    }

   

    public function email_settings(){
      
       require_once( 'Templates/cr_email.php' );
    }

    public function add_sub_links($post) {
     
        $screen = get_current_screen(); 
         // Only edit customer request screen:
        if( isset($screen->parent_base) && 'element_ready_elements_dashboard_page' === $screen->parent_base && isset($screen->id) && $screen->id =='edit-cus_f_request' )
        {
            require_once( __DIR__ . '/Templates/customer_request.php' );     
        }
      
    }

    public function add_page(){


        if( $this->element_ready_get_modules_option('customer_request') ){
            add_submenu_page( 'element_ready_elements_dashboard_page', esc_html__('Customer Request','element-ready-pro'), esc_html__('Customer Request','element-ready-pro'),
            'manage_options', 'edit.php?post_type=cus_f_request');
            add_submenu_page( ELEMENT_READY_SETTING_PATH , 'Email List', 'Email List', 'manage_options', 'element-ready-pro-cemail-settings', [$this,'email_settings'] );
        }
    }

    
    public function add_admin_scripts($handle){

        $screen = get_current_screen(); 
       
         // Only edit portfolio screen:
        if( isset($screen->id) && $screen->id =='edit-cus_f_request' && isset($screen->post_type) && $screen->post_type =='cus_f_request' )
        {
          wp_enqueue_style( 'element-ready-admin', ELEMENT_READY_ROOT_CSS .'admin.css' );
        }

        if(isset($screen->id) && $screen->id == 'element-ready_page_element-ready-pro-cemail-settings'){
            
            wp_enqueue_style( 'datatables', ELEMENT_READY_ROOT_CSS .'datatables.min.css' );
            wp_enqueue_script( 'datatables', ELEMENT_READY_ROOT_JS . 'datatables.min.js', array('jquery'), ELEMENT_READY_PRO_VERSION, true );
            wp_enqueue_style( 'element-ready-grid', ELEMENT_READY_ROOT_CSS .'grid.css' );
            wp_enqueue_style( 'element-ready-admin', ELEMENT_READY_ROOT_CSS .'admin.css' );
        }
       
    }
    

}