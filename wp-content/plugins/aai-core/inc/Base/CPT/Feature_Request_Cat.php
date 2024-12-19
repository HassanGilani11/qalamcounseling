<?php

/**
 * @package  Element Ready
 */
namespace Element_Ready_Pro\Base\CPT;
use Element_Ready\Api\Callbacks\Custom_Taxonomy;

class Feature_Request_Cat extends Custom_Taxonomy
{
    public $name         = '';
    public $menu         = 'category';
    public $textdomain   = '';
    public $posts        = array('cus_f_request');
    public $public_quary = false;
    public $slug         = 'er_cr_category';
    public $search       = true;

	public function register() {
        
        $this->name = esc_html__('Categories', 'element-ready-pro');
    	add_action( 'init', array( $this, 'create_taxonomy' ) );
    }

    public function create_taxonomy(){
        $this->init('er_cr_category', esc_html__('Category','element-ready-pro'), esc_html__('Category','element-ready-pro'), $this->posts);
        $this->register_taxonomy();
    }
    
}