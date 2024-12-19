<?php
namespace Element_Ready_Pro\Widgets\woocommerce;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Element_Ready\Widget_Controls\Shopping_Cart_Style;

require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
if ( ! defined( 'ABSPATH' ) ) exit;


class Shopping_Cart extends Widget_Base {

     use Shopping_Cart_Style;
     use \Elementor\Element_Ready_Common_Style;
     use \Elementor\Element_ready_common_content;
     use \Elementor\Element_Ready_Box_Style;
    public $base;

    public function get_name() {
        return 'element-ready-wc-shopping-cart-popup';
    }

    public function get_keywords() {
		return ['element-ready-pro','popup','woocommerce','shopping','cart','shopping cart','er shooping cart'];
	}

    public function get_title() {
        return esc_html__( 'ER Woo Shopping Cart', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-cart';
    }

    public function get_script_depends() {
        return [
            'wp-util',
            'element-ready-core',
        ];
    }

    public function get_style_depends() {
        
        wp_register_style( 'eready-shopping-cart' , ELEMENT_READY_ROOT_CSS. 'widgets/shopping-cart.css' );
      
        return[
            'eready-shopping-cart'
       ];
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function layout(){
        return[
            
            'style1'   => esc_html__( 'style1', 'element-ready-pro' ),
        ];
    }
 
    protected function register_controls() {

        $this->start_controls_section(
			'menu_layout',
			[
				'label' => esc_html__( 'Layout', 'element-ready-pro' ),
			]
        );

        


            $this->add_control(
                '_style',
                [
                    'label' => esc_html__( 'Style', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => $this->layout()
                ]
            );

            $this->add_control(
                'modal_template_id',
                [
                    'label'     => esc_html__( 'Select Content Template', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '0',
                    'options'   => element_ready_elementor_template(),
                    'description' => esc_html__( 'Please select elementor templete from here, if not create elementor template from menu', 'element-ready-pro' )
                   
                ]
            );

           
            

        $this->end_controls_section();

        $this->start_controls_section(
            'section_interface_fields',
            [
                'label' => esc_html__('Interface', 'element-ready-pro'),
            ]
        );

            
            $this->add_control(
                'interface_icon',
                [
                    'label' => esc_html__( 'Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa fa-shopping-cart',
                        'library' => 'solid',
                    ],
                ]
            );

           
            $this->add_control(
                'interface_text',
                [
    
                    'label' => esc_html__( 'Cart Text', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'cart', 'element-ready-pro' ),
                    'default' => esc_html__('CART','element-ready-pro')
                    
                ]
            );

            $this->add_control(
                'cart_count_show',
                [
                    'label' => esc_html__( 'Cart count', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
                    'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'cart_count_text',
                [
    
                    'label' => esc_html__( 'Singular Count Text', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'product', 'element-ready-pro' ),
                    'default' => esc_html__('product','element-ready-pro')
                    
                ]
            );
            $this->add_control(
                'cart_counts_text',
                [
    
                    'label' => esc_html__( 'Prular Count Text', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'products', 'element-ready-pro' ),
                    'default' => esc_html__('products','element-ready-pro')
                    
                ]
            );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_popup_fields',
            [
                'label' => esc_html__('PopUp / offcanvas', 'element-ready-pro'),
            ]
        );

            $this->add_control(
                'offcanvas_container_direction',
                [
                    'label' => esc_html__( 'Direction left', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'element-ready-pro' ),
                    'label_off' => esc_html__( 'No', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'modal_heading_text',
                [

                    'label' => esc_html__( 'Modal Heading Text', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'placeholder' => esc_html__( 'Heading', 'element-ready-pro' ),
                    'default' => esc_html__('Logo','element-ready-pro'),
                    
                    
                ]
            );

            $this->add_control(
                'currency_after',
                [
                    'label' => esc_html__( 'Currency After Price', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'element-ready-pro' ),
                    'label_off' => esc_html__( 'No', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );

            $this->add_control(
                'sub_total_text',
                [

                    'label' => esc_html__( 'Sub Total Text', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'SubTotal', 'element-ready-pro' ),
                    'default' => esc_html__('Subtotal','element-ready-pro'),
                
                ]
            );

            

            $this->add_control(
                'view_cart_text',
                [

                    'label' => esc_html__( 'View Cart', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'View Cart', 'element-ready-pro' ),
                    'default' => esc_html__('View Cart','element-ready-pro'),
                
                ]
            );

            $this->add_control(
                'checkout_text',
                [

                    'label'       => esc_html__( 'Checkout Text', 'element-ready-pro' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'CheckOUt', 'element-ready-pro' ),
                    'default'     => esc_html__('Checkout','element-ready-pro'),
                
                ]
            );


        $this->end_controls_section();

        $this->icon_css( esc_html__('Interface Icon','element-ready-pro'));
        $this->interface_text_css( esc_html__('Interface Text','element-ready-pro'),'interface_text');
        $this->interface_cart_count_css( esc_html__('Interface Cart Count','element-ready-pro'),'interface_cart_count','cart_count_ele');
        $this->popup_css( esc_html__('PopUp box','element-ready-pro'),'popup_box_cont','pop_box_element');
        $this->box_minimum_css(
            array(
                'title' => esc_html__('Product Container','element-ready-pro'),
                'slug' => 'wrapper_produyct_containerbox_style',
                'element_name' => 'wrapper_product_body_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-single-shopping-cart .cart-content',
            )
        );

        $this->text_minimum_css(
            array(
                'title' => esc_html__('Product title','element-ready-pro'),
                'slug' => 'product_item_select_style',
                'element_name' => 'product_item_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-single-shopping-cart .cart-content h6 a',
                'hover_selector' => '{{WRAPPER}} .element-ready-single-shopping-cart .cart-content h6:hover a',
            
            )
        );

        $this->popup_overlay_css( esc_html__('PopUp Overlay box','element-ready-pro'),'popup_overlay_cont','pop_overlay_element');
        $this->checkout_button_css( esc_html__('View Button','element-ready-pro'),'view_button_cont','view_button__element');
        $this->view_cart_button_css( esc_html__('Checkout Cart','element-ready-pro'),'checkout_cart_cont','check_out_cart_element');
        
        $this->sub_total_css( esc_html__('Subtotal','element-ready-pro'),'sub_total_count_cont','sub_total_count__element');
        $this->sub_total_title_css( esc_html__('Subtotal Title','element-ready-pro'),'sub_total_h_cont','sub_total_h__element');
        $this->modal_heading_css( esc_html__('Modal Heading','element-ready-pro'),'modal_heading__cont','modal_heading__element');
    
     
        
    } //Register control end


    protected function render( ) { 

        $settings     = $this->get_settings();
        $widget_id    = 'element-ready-'.$this->get_id().'-';

        if( !class_exists( 'woocommerce' ) ){
            return;  
        }

        $element_ready_data = [
            'ajax_url'     => admin_url( 'admin-ajax.php' ),
            'loading_text' => esc_html__( 'loading','element-ready-pro' ),
            'is_editor' => \Elementor\Plugin::$instance->editor->is_edit_mode(),
           ];
           
        wp_localize_script( 'element-ready-core', 'element_ready_obj', $element_ready_data);
       
       ?>
     
        <?php if($settings['_style'] == 'style1'): ?>

            <?php include('layout/shoppingcart/style1.php'); ?>
            <script type="text/html" id="tmpl-element-ready-add-shopping-cart-item">
                <# _.each( data, function( cart ){ #>
                    <li>
                        <div class="element-ready-single-shopping-cart media">
                        
                                <# if(cart.image_url){ #>
                                    <div class="cart-image element-ready-cart-image">
                                        <img src="{{ cart.image_url }}" alt="{{cart.name}}">
                                    </div>
                                <# } #>
                                <div class="cart-content media-body pl-15">

                                    <h6><a href="{{ cart.link }}">{{ cart.name }}</a></h6>
                                    <span class="quality">{{ cart.quantity }}</span>

                                    {{{ cart.price }}}

                                    <a data-product="{{ cart.item_key }}" class="element-ready-cart-item-remove" href="javascript:void(0);">
                                        <i class="fa fa-times"></i>
                                    </a>

                                </div>
                        </div> <!-- single shopping cart -->
                    </li>
                <# }) #>
            </script>   
        <?php endif; ?>  

    <?php  

    }
    
    protected function content_template() { }
}