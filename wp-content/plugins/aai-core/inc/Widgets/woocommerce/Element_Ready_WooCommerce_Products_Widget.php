<?php
namespace Element_Ready_Pro\Widgets\woocommerce;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'WooCommerce' ) ) {
    return;
}

class Element_Ready_WooCommerce_Products_Widget extends Widget_Base {

    public function get_name() {
        return 'Element_Ready_WooCommerce_Products_Widget';
    }
    
    public function get_title() {
        return esc_html__( 'ER Woo Products', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }
    
    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'WooCommerce', 'Product', 'Woo Product', 'Woocommerce Product', 'Slider', 'Tabs', 'Product tab' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'element-ready-core',
        ];
    }
    
    public function get_style_depends() {

        wp_register_style( 'eready-tab' , ELEMENT_READY_ROOT_CSS. 'widgets/tab.css' );
        wp_register_style( 'eready-woocommerce' , ELEMENT_READY_ROOT_CSS. 'widgets/woocommerce.css' );
        
        return[
            'slick',
            'element-ready-grid',
            'eready-tab',
            'eready-woocommerce'
        ];
        
    }

    public function content_layout_style(){
        return [
            '1'      => esc_html__( 'Layout One', 'element-ready-pro' ),
            '2'      => esc_html__( 'Layout Two', 'element-ready-pro' ),
            'custom' => esc_html__( 'Custom Layout', 'element-ready-pro' ),
        ];
    }

    public function element_ready_get_product_taxonomies( $element_ready_texonomy = 'product_cat' ){
        $terms = get_terms( array(
            'taxonomy'   => $element_ready_texonomy,
            'hide_empty' => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }

    protected function register_controls() {

        /*---------------------------
            PRODUCT CONTENT SECTION
        ----------------------------*/
        $this->start_controls_section(
            'element-ready-products',
            [
                'label' => esc_html__( 'Product Settings', 'element-ready-pro' ),
            ]
        );
            $this->add_control(
                'content_layout_style',
                [
                    'label'   => esc_html__( 'Product style', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => $this->content_layout_style(),
                ]
            );
            $this->add_control(
                'product_tabs',
                [
                    'label'        => esc_html__( 'Product Tab', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    =>'before',
                    'description'  => esc_html__('When you toggle the product tab you must set some category for filtering tabs content.','element-ready-pro'),
                ]
            );
            $this->add_control(
                'slider_on',
                [
                    'label'        => esc_html__( 'Product slider', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'description'  => esc_html__('When product tab is off then task slider.','element-ready-pro'),
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
                'element_ready_product_grid_product_filter',
                [
                    'label'   => esc_html__( 'Filter By', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent'       => esc_html__( 'Recent Products', 'element-ready-pro' ),
                        'featured'     => esc_html__( 'Featured Products', 'element-ready-pro' ),
                        'best_selling' => esc_html__( 'Best Selling Products', 'element-ready-pro' ),
                        'sale'         => esc_html__( 'Sale Products', 'element-ready-pro' ),
                        'top_rated'    => esc_html__( 'Top Rated Products', 'element-ready-pro' ),
                        'mixed_order'  => esc_html__( 'Mixed order Products', 'element-ready-pro' ),
                    ],
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
                'element_ready_product_grid_categories',
                [
                    'label'       => esc_html__( 'Product Categories', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => $this->element_ready_get_product_taxonomies(),
                    'description' => esc_html__('It also appear in tab menu items when tab mode is enabled.','element-ready-pro'),
                    'separator'   =>'before',
                ]
            );
            $this->add_control(
                'element_ready_product_grid_column',
                [
                    'label'   => esc_html__( 'Columns', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '4',
                    'options' => [
                        '1' => esc_html__( '1', 'element-ready-pro' ),
                        '2' => esc_html__( '2', 'element-ready-pro' ),
                        '3' => esc_html__( '3', 'element-ready-pro' ),
                        '4' => esc_html__( '4', 'element-ready-pro' ),
                        '5' => esc_html__( '5', 'element-ready-pro' ),
                        '6' => esc_html__( '6', 'element-ready-pro' ),
                    ],
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
              'element_ready_product_grid_row',
              [
                 'label'   => esc_html__( 'Rows', 'element-ready-pro' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 1,
                 'min'     => 1,
                 'max'     => 20,
                 'step'    => 1,
              ]
            );
            $this->add_control(
              'element_ready_product_grid_products_count',
              [
                 'label'   => esc_html__( 'Products Count', 'element-ready-pro' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 4,
                 'min'     => 1,
                 'max'     => 100,
                 'step'    => 1,
              ]
            );
            $this->add_control(
                'custom_order',
                [
                    'label'        => esc_html__( 'Custom order', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );
            $this->add_control(
                'orderby',
                [
                    'label'   => esc_html__( 'Orderby', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None','element-ready-pro'),
                        'ID'            => esc_html__('ID','element-ready-pro'),
                        'date'          => esc_html__('Date','element-ready-pro'),
                        'name'          => esc_html__('Name','element-ready-pro'),
                        'title'         => esc_html__('Title','element-ready-pro'),
                        'comment_count' => esc_html__('Comment count','element-ready-pro'),
                        'rand'          => esc_html__('Random','element-ready-pro'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'order',
                [
                    'label'   => esc_html__( 'order', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => esc_html__('Descending','element-ready-pro'),
                        'ASC'  => esc_html__('Ascending','element-ready-pro'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'more_options',
                [
                    'label' => __( 'Content & Buttons Options', 'element-ready-pro' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_saleflash',
                [
                    'label'        => esc_html__( 'Show Sale Flash ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_attribute',
                [
                    'label'        => esc_html__( 'Show Attributes ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Show Title ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'title_limit',
                [
                    'label' => esc_html__( 'Title Limit Word', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 5,
                    'separator' => 'before',
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_content',
                [
                    'label'        => esc_html__( 'Show Content ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'false',
                    'separator'    => 'before',
                ]
            );            
            $this->add_control(
                'content_limit',
                [
                    'label' => esc_html__( 'Content Limit Word', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 10,
                    'separator' => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_price',
                [
                    'label'        => esc_html__( 'Show Price ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_rating',
                [
                    'label'        => esc_html__( 'Show Rating ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'rating_type',
                [
                    'label'   => esc_html__( 'Rating Type', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'multiple_star',
                    'options' => [
                        'multiple_star' => esc_html__('Multiple Star','element-ready-pro'),
                        'single_star'   => esc_html__('Single Star','element-ready-pro'),
                    ],
                    'condition' => [
                        'show_rating' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'show_buttons',
                [
                    'label'        => esc_html__( 'Show Action Buttons ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_quickview',
                [
                    'label'        => esc_html__( 'Show Quick View Button ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_wishlist',
                [
                    'label'        => esc_html__( 'Show Wish List Button ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_buynow',
                [
                    'label'        => esc_html__( 'Show Buy Now Button ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_compare',
                [
                    'label'        => esc_html__( 'Show Compare Button ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            PRODUCT CONTENT SECTION END
        ----------------------------*/

        /*---------------------------
            CAROUSEL SETTING
        -----------------------------*/
        $this->start_controls_section(
            'slider_option',
            [
                'label'     => esc_html__( 'Carousel Option', 'element-ready-pro' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label'     => esc_html__( 'Slider Items', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 20,
                    'step'      => 1,
                    'default'   => 3,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrows',
                [
                    'label'     => esc_html__( 'Slider Rows', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 5,
                    'step'      => 1,
                    'default'   => 0,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slitemmargin',
                [
                    'label'     => esc_html__( 'Slider Item Margin', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 100,
                    'step'      => 1,
                    'default'   => 1,
                    'selectors' => [
                        '{{WRAPPER}} .single__product__item' => 'margin: calc( {{VALUE}}px / 2 );',
                        '{{WRAPPER}} .slick-list'            => 'margin: calc( -{{VALUE}}px / 2 );',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label'        => esc_html__( 'Slider Arrow', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'nav_position',
                [
                    'label'   => esc_html__( 'Arrow Position', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'outside_vertical_center_nav',
                    'options' => [
                        'inside_vertical_center_nav'  => esc_html__( 'Inside Vertical Center', 'element-ready-pro' ),
                        'outside_vertical_center_nav' => esc_html__( 'Outside Vertical Center', 'element-ready-pro' ),
                        'top_left_nav'                => esc_html__( 'Top Left', 'element-ready-pro' ),
                        'top_center_nav'              => esc_html__( 'Top Center', 'element-ready-pro' ),
                        'top_right_nav'               => esc_html__( 'Top Right', 'element-ready-pro' ),
                        'bottom_left_nav'             => esc_html__( 'Bottom Left', 'element-ready-pro' ),
                        'bottom_center_nav'           => esc_html__( 'Bottom Center', 'element-ready-pro' ),
                        'bottom_right_nav'            => esc_html__( 'Bottom Right', 'element-ready-pro' ),
                    ],
                    'condition' => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label'     => esc_html__( 'Previous icon', 'element-ready-pro' ),
                    'type'      => Controls_Manager::ICON,
                    'label_block' => true,
                    'default'   => 'fa fa-angle-left',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label'     => esc_html__( 'Next icon', 'element-ready-pro' ),
                    'type'      => Controls_Manager::ICON,
                    'label_block' => true,
                    'default'   => 'fa fa-angle-right',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'nav_visible',
                [
                    'label'        => esc_html__( 'Arrow Visibility', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'visibility:visible;opacity:1;',
                    'default'      => 'no',
                    'selectors'    => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav > div' => '{{VALUE}}',
                    ],
                    'condition'   => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label'        => esc_html__( 'Slider dots', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label_off'    => esc_html__('No', 'element-ready-pro'),
                    'label_on'     => esc_html__('Yes', 'element-ready-pro'),
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'label'        => esc_html__('Pause on Hover?', 'element-ready-pro'),
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label'        => esc_html__( 'Center Mode', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label'     => esc_html__( 'Center padding', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 500,
                    'step'      => 1,
                    'default'   => 50,
                    'condition' => [
                        'slider_on'    => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slfade',
                [
                    'label'        => esc_html__( 'Slider Fade', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slfocusonselect',
                [
                    'label'        => esc_html__( 'Focus On Select', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slvertical',
                [
                    'label'        => esc_html__( 'Vertical Slide', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slinfinite',
                [
                    'label'        => esc_html__( 'Infinite', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrtl',
                [
                    'label'        => esc_html__( 'RTL Slide', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label'        => esc_html__( 'Slider auto play', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label'     => esc_html__('Autoplay speed', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label'     => esc_html__('Autoplay animation speed', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label'     => esc_html__('Slider item to scroll', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 10,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label'     => esc_html__( 'Tablet', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label'     => esc_html__('Slider Items', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 8,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label'     => esc_html__('Slider item to scroll', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 8,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label'       => esc_html__('Tablet Resolution', 'element-ready-pro'),
                    'description' => esc_html__('The resolution to tablet.', 'element-ready-pro'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 750,
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label'     => esc_html__( 'Mobile Phone', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label'     => esc_html__('Slider Items', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 4,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label'     => esc_html__('Slider item to scroll', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 4,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label'       => esc_html__('Mobile Resolution', 'element-ready-pro'),
                    'description' => esc_html__('The resolution to mobile.', 'element-ready-pro'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 480,
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            SLIDER OPTIONS END
        -------------------------*/

		/*----------------------------
			SLIDER NAV WARP
		-----------------------------*/
		$this->start_controls_section(
			'slider_control_warp_style_section',
			[
				'label' => esc_html__( 'Slider Nav Warp', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slider_on' => 'yes',
                ]
			]
		);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => 'slider_nav_warp_background',
					'label'    => esc_html__( 'Background', 'element-ready-pro' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'slider_nav_warp_border',
					'label'    => esc_html__( 'Border', 'element-ready-pro' ),
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
				]
			);
			$this->add_control(
				'slider_nav_warp_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'slider_nav_warp_shadow',
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_display',
				[
					'label'   => esc_html__( 'Display', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => esc_html__( 'Initial', 'element-ready-pro' ),
						'block'        => esc_html__( 'Block', 'element-ready-pro' ),
						'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
						'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
						'inline-flex'  => esc_html__( 'Inline Flex', 'element-ready-pro' ),
						'none'         => esc_html__( 'none', 'element-ready-pro' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position',
				[
					'label'   => esc_html__( 'Position', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					
					'options' => [
						'initial'  => esc_html__( 'Initial', 'element-ready-pro' ),
						'absolute' => esc_html__( 'Absulute', 'element-ready-pro' ),
						'relative' => esc_html__( 'Relative', 'element-ready-pro' ),
						'static'   => esc_html__( 'Static', 'element-ready-pro' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_left',
				[
					'label'      => esc_html__( 'From Left', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_right',
				[
					'label'      => esc_html__( 'From Right', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_top',
				[
					'label'      => esc_html__( 'From Top', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_bottom',
				[
					'label'      => esc_html__( 'From Bottom', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_align',
				[
					'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justify', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
					],
					'default' => '',
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_width',
				[
					'label'      => esc_html__( 'Width', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_height',
				[
					'label'      => esc_html__( 'Height', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slider_nav_warp_opacity',
				[
					'label' => esc_html__( 'Opacity', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_control(
				'slider_nav_warp_zindex',
				[
					'label'     => esc_html__( 'Z-Index', 'element-ready-pro' ),
					'type'      => Controls_Manager::NUMBER,
					'min'       => -99,
					'max'       => 99,
					'step'      => 1,
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_margin',
				[
					'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_padding',
				[
					'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			SLIDER NAV WARP END
		-----------------------------*/

		/*----------------------------
			CONTROL BUTTON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'slider_control_style_section',
			[
				'label' => esc_html__( 'Slider Nav Button', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slider_on' => 'yes',
                ]
			]
		);
			$this->start_controls_tabs( 'slide_button_tab_style' );
			$this->start_controls_tab(
				'slide_button_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'element-ready-pro' ),
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'slide_button_typography',
						'selector'  => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr1',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_control(
					'slide_button_color',
					[
						'label'     => esc_html__( 'Color', 'element-ready-pro' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background:: get_type(),
					[
						'name'     => 'slide_button_background',
						'label'    => esc_html__( 'Background', 'element-ready-pro' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr2',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_group_control(
					Group_Control_Border:: get_type(),
					[
						'name'     => 'slide_button_border',
						'label'    => esc_html__( 'Border', 'element-ready-pro' ),
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow:: get_type(),
					[
						'name'     => 'slide_button_shadow',
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr3',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'slide_button_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'element-ready-pro' ),
				]
			);
				$this->add_control(
					'hover_slide_button_color',
					[
						'label'     => esc_html__( 'Color', 'element-ready-pro' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background:: get_type(),
					[
						'name'     => 'hover_slide_button_background',
						'label'    => esc_html__( 'Background', 'element-ready-pro' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'slide_button_hr4',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_group_control(
					Group_Control_Border:: get_type(),
					[
						'name'     => 'hover_slide_button_border',
						'label'    => esc_html__( 'Border', 'element-ready-pro' ),
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'hover_slide_button_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow:: get_type(),
					[
						'name'     => 'hover_slide_button_shadow',
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'slide_button_hr9',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'slide_button_width',
				[
					'label'      => esc_html__( 'Width', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slide_button_height',
				[
					'label'      => esc_html__( 'Height', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slide_button_hr5',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_display',
				[
					'label'   => esc_html__( 'Display', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',				
					'options' => [
						'initial'      => esc_html__( 'Initial', 'element-ready-pro' ),
						'block'        => esc_html__( 'Block', 'element-ready-pro' ),
						'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
						'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
						'inline-flex'  => esc_html__( 'Inline Flex', 'element-ready-pro' ),
						'none'         => esc_html__( 'none', 'element-ready-pro' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'slide_button_align',
				[
					'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justify', 'element-ready-pro' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'text-align: {{VALUE}};',
					],
					'default' => '',
				]
			);
			$this->add_control(
				'slide_button_hr6',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_position',
				[
					'label'   => esc_html__( 'Position', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',				
					'options' => [
						'initial'  => esc_html__( 'Initial', 'element-ready-pro' ),
						'absolute' => esc_html__( 'Absulute', 'element-ready-pro' ),
						'relative' => esc_html__( 'Relative', 'element-ready-pro' ),
						'static'   => esc_html__( 'Static', 'element-ready-pro' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'position: {{VALUE}};',
					],
				]
			);
			$this->start_controls_tabs( 'slide_button_item_tab_style');
			$this->start_controls_tab(
				'slide_button_left_nav_tab',
				[
					'label' => esc_html__( 'Left Button', 'element-ready-pro' ),
				]
			);
				$this->add_responsive_control(
					'slide_button_position_from_left',
					[
						'label'      => esc_html__( 'From Left', 'element-ready-pro' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_position_from_bottom',
					[
						'label'      => esc_html__( 'From Top', 'element-ready-pro' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_left_margin',
					[
						'label'      => esc_html__( 'Margin Left Button', 'element-ready-pro' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'slide_button_right_nav_tab',
				[
					'label' => esc_html__( 'Right Button', 'element-ready-pro' ),
				]
			);
				$this->add_responsive_control(
					'slide_button_position_from_right',
					[
						'label'      => esc_html__( 'From Right', 'element-ready-pro' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_position_from_top',
					[
						'label'      => esc_html__( 'From Top', 'element-ready-pro' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_right_margin',
					[
						'label'      => esc_html__( 'Margin Right Button', 'element-ready-pro' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'slide_button_hr7',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_control(
				'slide_button_transition',
				[
					'label'      => esc_html__( 'Transition', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0.1,
							'max'  => 3,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0.3,
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'transition: {{SIZE}}s;',
					],
				]
			);
			$this->add_control(
				'slide_button_hr8',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_padding',
				[
					'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			CONTROL BUTTON STYLE END
		-----------------------------*/

		/*----------------------------
			DOTS BUTTON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'slide_dots_button_style_section',
			[
				'label' => esc_html__( 'Slide Dots Style', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slider_on' => 'yes',
                ]
			]
		);
			$this->start_controls_tabs( 'button_tab_style' );
				$this->start_controls_tab(
					'slide_dots_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'slide_dots_width',
						[
							'label'      => esc_html__( 'Width', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'slide_dots_height',
						[
							'label'      => esc_html__( 'Height', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'slide_dots_background',
							'label'    => esc_html__( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'slide_dots_border',
							'label'    => esc_html__( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_control(
						'slide_dots_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'slide_dots_shadow',
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_control(
						'slide_dots_hr',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_control(
						'slide_dots_align',
						[
							'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => esc_html__( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => esc_html__( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => esc_html__( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => esc_html__( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots' => 'text-align: {{VALUE}};',
							],
							'default' => '',
						]
					);
					$this->add_control(
						'slide_dots_transition',
						[
							'label'      => esc_html__( 'Transition', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => 0.1,
									'max'  => 3,
									'step' => 0.1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 0.3,
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_responsive_control(
						'slide_dots_margin',
						[
							'label'      => esc_html__( 'Dot Item Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'slide_dots_warp_margin',
						[
							'label'      => esc_html__( 'Dot Warp Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'slide_dots_hover_tab',
					[
						'label' => esc_html__( 'Hover & Active', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'hover_slide_dots_width',
						[
							'label'      => esc_html__( 'Width', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_slide_dots_height',
						[
							'label'      => esc_html__( 'Height', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_slide_dots_background',
							'label'    => esc_html__( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_slide_dots_border',
							'label'    => esc_html__( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
					$this->add_control(
						'hover_slide_dots_radius',
						[
							'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_slide_dots_shadow',
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			DOTS BUTTON STYLE END
		-----------------------------*/

        /* *****************************
            STYLE SECTIONS
        ********************************/

        /*--------------------------
            PRODUCT TAB MENU
        ---------------------------*/
        $this->start_controls_section(
            'element-ready-products-tab-menu',
            [
                'label'     => esc_html__( 'Tab Menu Style', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'product_tabs' => 'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'tab_menu_wrap_align',
                [
                    'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product__tab__menu__list' => 'text-align: {{VALUE}};',
                    ],
                    'default'   => 'center',
                ]
            );
            $this->add_responsive_control(
                'tab_menu_wrap_display',
                [
                    'label'   => __( 'Display', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'initial'      => __( 'Initial', 'element-ready-pro' ),
                        'block'        => __( 'Block', 'element-ready-pro' ),
                        'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                        'flex'         => __( 'Flex', 'element-ready-pro' ),
                        'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                        'none'         => __( 'none', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product__tab__menu__list' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'tab_menu_wrap_border',
                    'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .product__tab__menu__list ul',
                ]
            );
            $this->add_responsive_control(
                'tab_menu_wrap_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__tab__menu__list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->start_controls_tabs(
                'product_tab_style_tabs',[
                    'separator'    =>'before',
                ]
            );
                // TAB MENU STYLE NORMAL
                $this->start_controls_tab(
                    'product_tab_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'     => 'tab_menu_typography',
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li a',
                        ]
                    );
                    $this->add_control(
                        'tab_menu_color',
                        [
                            'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .product__tab__menu__list li a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'tab_menu_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'tab_menu_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li a',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .product__tab__menu__list li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'tab_menu_box_shadow',
                            'selector' => '{{WRAPPER}} product__tab__menu__list li a',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__tab__menu__list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__tab__menu__list li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'product_tab_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'tab_menu_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .product__tab__menu__list li:hover a'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__tab__menu__list li.active a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li.active a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li:hover a',
                            'selector' => '{{WRAPPER}} .product__tab__menu__list li.active a',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .product__tab__menu__list li:hover a'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .product__tab__menu__list li.active a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_box_shadow',
                            'selector' => '{{WRAPPER}} product__tab__menu__list li a',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*--------------------------
            PRODUCT TAB MENU END
        ---------------------------*/

        /*----------------------------
            IMAGE THUMB WRAP
        -----------------------------*/
        $this->start_controls_section(
            'img_wrap_style_section',
            [
                'label' => __( 'Thumb Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            // Typgraphy
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'      => 'img_wrap_typography',
                    'selector'  => '{{WRAPPER}} .product__image__wrap',
                ]
            );

            // Icon Color
            $this->add_control(
                'img_wrap_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .product__image__wrap' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Background
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'img_wrap_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .product__image__wrap',
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'img_wrap_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .product__image__wrap',
                    'separator' => 'before',
                ]
            );

            // Radius
            $this->add_responsive_control(
                'img_wrap_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'img_wrap_shadow',
                    'selector' => '{{WRAPPER}} .product__image__wrap',
                ]
            );

            // Margin
            $this->add_responsive_control(
                'img_wrap_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Padding
            $this->add_responsive_control(
                'img_wrap_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            IMAGE THUMB WRAP END
        -----------------------------*/

        /*----------------------------
            IMAGE STYLE
        -----------------------------*/
        $this->start_controls_section(
            'product_thumb_style_section',
            [
                'label' => __( 'Thumb', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Background
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'product_thumb_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '
                        {{WRAPPER}} .product__item__inner .product__image__wrap img
                    ',
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'product_thumb_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .product__item__inner .product__image__wrap img',
                    'separator' => 'before',
                ]
            );

            // Radius
            $this->add_responsive_control(
                'product_thumb_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__item__inner .product__image__wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'product_thumb_shadow',
                    'selector' => '{{WRAPPER}} .product__item__inner .product__image__wrap img',
                ]
            );

            // Width
            $this->add_responsive_control(
                'product_thumb_width',
                [
                    'label'      => __( 'Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product__item__inner .product__image__wrap img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Height
            $this->add_responsive_control(
                'product_thumb_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product__item__inner .product__image__wrap img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Margin
            $this->add_responsive_control(
                'product_thumb_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Padding
            $this->add_responsive_control(
                'product_thumb_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			$this->add_control(
				'product_thumb_transition',
				[
					'label'      => esc_html__( 'Transition', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0.1,
							'max'  => 5,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0.3,
					],
					'selectors' => [
						'{{WRAPPER}} .product__image__wrap img' => 'transition: {{SIZE}}s;',
					],
                    'separator' => 'before',
				]
			);
			$this->add_control(
				'product_thumb_scale',
				[
					'label'      => esc_html__( 'Scale', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0.1,
							'max'  => 5,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .product__image__wrap img' => 'transform:scale({{SIZE}});',
					],
                    'separator' => 'before',
				]
			);
			$this->add_control(
				'product_thumb_hover_scale',
				[
					'label'      => esc_html__( 'Hover Scale', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0.1,
							'max'  => 5,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .single__product__item:hover .product__image__wrap img' => 'transform:scale({{SIZE}});',
					],
                    'separator' => 'before',
				]
			);
        $this->end_controls_section();
        /*----------------------------
            IMAGE STYLE END
        -----------------------------*/

        /*----------------------------
            CONTENT WRAP STYLE
        -----------------------------*/
        $this->start_controls_section(
            'content_wrap_style_section',
            [
                'label' => __( 'Content Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            // Typgraphy
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'      => 'content_wrap_typography',
                    'selector'  => '{{WRAPPER}} .product__information__area',
                ]
            );

            // Icon Color
            $this->add_control(
                'content_wrap_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .product__information__area' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Background
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'content_wrap_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .product__information__area',
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'content_wrap_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .product__information__area',
                    'separator' => 'before',
                ]
            );

            // Radius
            $this->add_responsive_control(
                'content_wrap_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__information__area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'content_wrap_shadow',
                    'selector' => '{{WRAPPER}} .product__information__area',
                ]
            );

            // Margin
            $this->add_responsive_control(
                'content_wrap_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__information__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Padding
            $this->add_responsive_control(
                'content_wrap_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__information__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            CONTENT WRAP STYLE END
        -----------------------------*/

        /*----------------------------
            SALE FLUSH
        -----------------------------*/
        $this->start_controls_section(
            'sale_flush_style_section',
            [
                'label' => __( 'Sale Flush', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Typgraphy
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'      => 'sale_flush_typography',
                    'selector'  => '{{WRAPPER}} .product__image__wrap .onsale',
                ]
            );

            // Icon Color
            $this->add_control(
                'sale_flush_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .product__image__wrap .onsale' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Background
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'sale_flush_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .product__image__wrap .onsale',
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'sale_flush_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .product__image__wrap .onsale',
                    'separator' => 'before',
                ]
            );

            // Radius
            $this->add_responsive_control(
                'sale_flush_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'sale_flush_shadow',
                    'selector' => '{{WRAPPER}} .product__image__wrap .onsale',
                ]
            );

            // Margin
            $this->add_responsive_control(
                'sale_flush_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Padding
            $this->add_responsive_control(
                'sale_flush_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__image__wrap .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sale_flash_position',
                [
                    'label'   => __( 'Position', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'initial'  => __( 'Initial', 'element-ready-pro' ),
                        'absolute' => __( 'Absulute', 'element-ready-pro' ),
                        'relative' => __( 'Relative', 'element-ready-pro' ),
                        'static'   => __( 'Static', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__product__item .onsale' => 'position: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'sale_flash_position_from_left',
                [
                        'label'      => __( 'From Left', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__product__item .onsale' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'sale_flash_position!' => ['initial','static']
                        ],
                ]
            );
            $this->add_responsive_control(
                'sale_flash_position_from_right',
                [
                        'label'      => __( 'From Right', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__product__item .onsale' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'sale_flash_position!' => ['initial','static']
                        ],
                ]
            );
             $this->add_responsive_control(
                'sale_flash_position_from_top',
                [
                        'label'      => __( 'From Top', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__product__item .onsale' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'sale_flash_position!' => ['initial','static']
                        ],
                ]
            );
            $this->add_responsive_control(
                'sale_flash_position_from_bottom',
                [
                    'label'      => __( 'From Bottom', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__product__item .onsale' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'sale_flash_position!' => ['initial','static']
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            SALE FLUSH END
        -----------------------------*/

        /*----------------------------
            TITLE STYLE
        -----------------------------*/
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __( 'Title', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'title_tabs_style' );
                $this->start_controls_tab(
                    'title_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'title_typography',
                            'selector'  => '{{WRAPPER}} .product__item__title',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'title_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__title a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'title_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__item__title',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'title_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__title',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'title_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'title_shadow',
                            'selector' => '{{WRAPPER}} .product__item__title',
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'title_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_title_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .product__item__title:hover a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_title_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__item__title:hover',
                        ]
                    );	

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_title_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__title:hover',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_title_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_title_shadow',
                            'selector' => '{{WRAPPER}} .product__item__title:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            TITLE STYLE END
        -----------------------------*/

        /*----------------------------
            DESCRIPTION
        -----------------------------*/
        $this->start_controls_section(
            'desc_style_section',
            [
                'label' => __( 'Description', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Typgraphy
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'      => 'desc_typography',
                    'selector'  => '{{WRAPPER}} .product__item__description',
                ]
            );

            // Icon Color
            $this->add_control(
                'desc_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .product__item__description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Background
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'desc_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .product__item__description',
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'desc_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .product__item__description',
                    'separator' => 'before',
                ]
            );

            // Radius
            $this->add_responsive_control(
                'desc_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__item__description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'desc_shadow',
                    'selector' => '{{WRAPPER}} .product__item__description',
                ]
            );

            // Margin
            $this->add_responsive_control(
                'desc_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__item__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            // Padding
            $this->add_responsive_control(
                'desc_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .product__item__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            DESCRIPTION END
        -----------------------------*/

        /*----------------------------
            PRICE STYLE
        -----------------------------*/
        $this->start_controls_section(
            'price_style_section',
            [
                'label' => __( 'Price', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'price_tabs_style' );
                $this->start_controls_tab(
                    'price_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    $this->add_control(
                        'default_pricing_heading',
                        [
                            'label'     => __( 'Default Price', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator'   => 'before',
                        ]
                    );
                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'price_typography',
                            'selector'  => '{{WRAPPER}} .product__item__price',
                            'separator'   => 'before',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'price_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__price' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'price_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__item__price',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'price_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__price',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'price_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'price_shadow',
                            'selector' => '{{WRAPPER}} .product__item__price',
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'price_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'price_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'offer_pricing_heading',
                        [
                            'label'     => __( 'Offer Price', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator'   => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'offer_price_typography',
                            'selector'  => '{{WRAPPER}} .product__item__price ins',
                            'separator'   => 'before',
                        ]
                    );
                    $this->add_control(
                        'offer_price_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__price ins' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'offer_price_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__price ins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'original_pricing_heading',
                        [
                            'label'     => __( 'Original Price', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator'   => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'original_price_typography',
                            'selector'  => '{{WRAPPER}} .product__item__price del',
                            'separator'   => 'before',
                        ]
                    );
                    $this->add_control(
                        'original_price_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__price del' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'original_price_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'price_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_price_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__product__item:hover .product__item__price' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_price_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__product__item:hover .product__item__price',
                        ]
                    );	

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_price_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__product__item:hover .product__item__price',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_price_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__product__item:hover .product__item__price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_price_shadow',
                            'selector' => '{{WRAPPER}} .single__product__item:hover .product__item__price',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            PRICE STYLE END
        -----------------------------*/

        /*----------------------------
            RATING STYLE
        -----------------------------*/
        $this->start_controls_section(
            'rating_style_section',
            [
                'label' => __( 'Rating & Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'rating_tabs_style' );
                $this->start_controls_tab(
                    'rating_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_responsive_control(
                        'rating_display',
                        [
                            'label'   => __( 'Rating Wrap Display', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,			
                            'options' => [
                                'initial'      => __( 'Initial', 'element-ready-pro' ),
                                'block'        => __( 'Block', 'element-ready-pro' ),
                                'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                                'flex'         => __( 'Flex', 'element-ready-pro' ),
                                'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                                'none'         => __( 'none', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__footer__area' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'rating_position',
                        [
                            'label'   => __( 'Position', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                'initial'  => __( 'Initial', 'element-ready-pro' ),
                                'absolute' => __( 'Absulute', 'element-ready-pro' ),
                                'relative' => __( 'Relative', 'element-ready-pro' ),
                                'static'   => __( 'Static', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review' => 'position: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_position_from_left',
                        [
                                'label'      => __( 'From Left', 'element-ready-pro' ),
                                'type'       => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range'      => [
                                    'px' => [
                                        'min'  => 0,
                                        'max'  => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .product__item__review' => 'left: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [
                                    'rating_position!' => ['initial','static']
                                ],
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_position_from_right',
                        [
                                'label'      => __( 'From Right', 'element-ready-pro' ),
                                'type'       => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range'      => [
                                    'px' => [
                                        'min'  => 0,
                                        'max'  => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .product__item__review' => 'right: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [
                                    'rating_position!' => ['initial','static']
                                ],
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_position_from_top',
                        [
                                'label'      => __( 'From Top', 'element-ready-pro' ),
                                'type'       => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range'      => [
                                    'px' => [
                                        'min'  => 0,
                                        'max'  => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => 'px',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .product__item__review' => 'top: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [
                                    'rating_position!' => ['initial','static']
                                ],
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_position_from_bottom',
                        [
                            'label'      => __( 'From Bottom', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'rating_position!' => ['initial','static']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_align',
                        [
                            'label'   => __( 'Alignment', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justify', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review' => 'text-align: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'rating_typography',
                            'selector'  => '{{WRAPPER}} .product__item__review',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'rating_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review .total__star__rating' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__review .single__star__icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'rating_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__item__review',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'rating_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__review',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'rating_shadow',
                            'selector' => '{{WRAPPER}} .product__item__review',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'rating_rated_tab',
                    [
                        'label' => __( 'Rated', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'rated_rating_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review .rated__stars' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__review .single__star__icon__rated' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'rating_counter_tab',
                    [
                        'label' => __( 'Counter', 'ultimate' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'rating_counter_typography',
                            'selector'  => '{{WRAPPER}} .product__item__review .total__review__count',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'rating_counter_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__review .total__review__count' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'rating_counter_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .product__item__review .total__review__count',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'rating_counter_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__review .total__review__count',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_counter_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review .total__review__count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'rating_counter_shadow',
                            'selector' => '{{WRAPPER}} .product__item__review .total__review__count',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_counter_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review .total__review__count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'rating_counter_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__review .total__review__count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            RATING STYLE END
        -----------------------------*/

        /*----------------------------
            BUTTON STYLE
        -----------------------------*/
        $this->start_controls_section(
            'buttons_style_section',
            [
                'label' => __( 'Buttons', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_buttons' => 'yes',
                ],
            ]
        );

            $this->start_controls_tabs( 'buttons_tabs_style' );
                $this->start_controls_tab(
                    'buttons_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'buttons_typography',
                            'selector'  => '{{WRAPPER}} .product__item__inner .product__item__buttons a',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'buttons_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'buttons_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .product__item__inner .product__item__buttons a i,
                                {{WRAPPER}} .product__item__inner .product__item__buttons a:before
                            ',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'buttons_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__inner .product__item__buttons a',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'buttons_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'buttons_shadow',
                            'selector' => '{{WRAPPER}} .product__item__inner .product__item__buttons a',
                        ]
                    );

                    // Width
                    $this->add_responsive_control(
                        'buttons_width',
                        [
                            'label'      => __( 'Width', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons > div' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Height
                    $this->add_responsive_control(
                        'buttons_height',
                        [
                            'label'      => __( 'Height', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons > div' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'buttons_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'buttons_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'buttons_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_buttons_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a:hover i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .product__item__inner .product__item__buttons a:hover:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_buttons_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .product__item__inner .product__item__buttons a:hover i,
                                {{WRAPPER}} .product__item__inner .product__item__buttons a:hover:before
                            ',
                        ]
                    );	

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_buttons_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .product__item__inner .product__item__buttons a:hover',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_buttons_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .product__item__inner .product__item__buttons > div:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_buttons_shadow',
                            'selector' => '{{WRAPPER}} .product__item__inner .product__item__buttons a:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            BUTTON STYLE END
        -----------------------------*/

        /*----------------------------
            BOX STYLE
        -----------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Box', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'box_tabs_style' );
                $this->start_controls_tab(
                    'box_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'box_typography',
                            'selector'  => '{{WRAPPER}} .single__product__item',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'box_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .single__product__item' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'box_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__product__item',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__product__item',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'box_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__product__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'box_shadow',
                            'selector' => '{{WRAPPER}} .single__product__item',
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'box_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__product__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'box_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__product__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'box_align',
                        [
                            'label'   => __( 'Alignment', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__product__item' => 'text-align: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'box_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_box_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__product__item:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_box_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__product__item:hover',
                        ]
                    );	

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__product__item:hover',
                            'separator' => 'before',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_box_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__product__item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_box_shadow',
                            'selector' => '{{WRAPPER}} .single__product__item:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            BOX STYLE END
        -----------------------------*/

    }

    protected function render( $instance = [] ) {

        $settings        = $this->get_settings_for_display();
        $product_type    = $this->get_settings_for_display('element_ready_product_grid_product_filter');
        $per_page        = $this->get_settings_for_display('element_ready_product_grid_products_count');
        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $order           = $this->get_settings_for_display('order');
        $grid_columns    = $this->get_settings_for_display('element_ready_product_grid_column');
        $rows            = $this->get_settings_for_display('element_ready_product_grid_row');
        $tab_uniqid      = $this->get_id();
        $slider_on       = $this->get_settings_for_display('slider_on');
        $product_tabs    = $this->get_settings_for_display('product_tabs');
        $id              = $this->get_id();

        $this->add_render_attribute( 'content_main_wrap_attr', 'class', 'element__ready__product__products__wrap' );

        $this->add_render_attribute( 'product_item_attr', 'class', 'single__product__item' );
        $this->add_render_attribute( 'product_item_attr', 'class', 'element__ready__product__layout__'.$settings['content_layout_style'] );

        if( 'yes' == $slider_on ){
            $this->add_render_attribute( 'content_main_wrap_attr', 'class', 'sldier-content-area' );
            $this->add_render_attribute( 'content_main_wrap_attr', 'class', $settings['nav_position'] );
        }
        
        if( 'yes' == $product_tabs ){
            $this->add_render_attribute( 'content_main_wrap_attr', 'class', 'tabs__area' );
            $this->add_render_attribute( 'content_main_wrap_attr', 'id', 'tabs__area__'.$id );
        }

        if( ( $slider_on != 'yes' ) && ( $product_tabs != 'yes' ) ){        
            $this->add_render_attribute( 'product_items_wrap_attr', 'class', 'quomodo-row' );
        }

        // Slider options
        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'product_items_wrap_attr', 'class', 'element-ready-carousel-activation' );

            $slideid = rand(2564,1245);

            $slider_settings = [
                'slideid'          => $slideid,
                'arrows'          => ('yes' === $settings['slarrows']),
                'arrow_prev_txt'  => $settings['slprevicon'],
                'arrow_next_txt'  => $settings['slnexticon'],
                'dots'            => ('yes' === $settings['sldots']),
                'autoplay'        => ('yes' === $settings['slautolay']),
                'autoplay_speed'  => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover'  => ('yes' === $settings['slpause_on_hover']),
                'center_mode'     => ( 'yes' === $settings['slcentermode']),
                'center_padding'  => absint($settings['slcenterpadding']),
                'rows'            => absint($settings['slrows']),
                'fade'            => ( 'yes' === $settings['slfade']),
                'focusonselect'   => ( 'yes' === $settings['slfocusonselect']),
                'vertical'        => ( 'yes' === $settings['slvertical']),
                'rtl'             => ( 'yes' === $settings['slrtl']),
                'infinite'        => ( 'yes' === $settings['slinfinite']),
            ];

            $slider_responsive_settings = [
                'display_columns'        => $settings['slitems'],
                'scroll_columns'         => $settings['slscroll_columns'],
                'tablet_width'           => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns'  => $settings['sltablet_scroll_columns'],
                'mobile_width'           => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns'  => $settings['slmobile_scroll_columns'],

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

            $this->add_render_attribute( 'product_items_wrap_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }

        // WooCommerce Category
        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $per_page,
        );

        switch( $product_type ){
            case 'sale': 
                $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            break;
            case 'featured': 
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
            break;
            case 'best_selling': 
                $args['meta_key'] = 'total_sales';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'desc';
            break;
            case 'top_rated': 
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'desc';
            break;
            case 'mixed_order': 
                $args['orderby'] = 'rand';
            break;
            default:   /* Recent */
                $args['orderby'] = 'date';
                $args['order']   = 'desc';
            break;
        }

        /* Custom Order */
        if( $custom_order_ck == 'yes' ){
            $args['orderby'] = $orderby;
            $args['order']   = $order;
        }

        $get_product_categories = $settings['element_ready_product_grid_categories'];  // get custom field value
        $product_cats           = str_replace(' ', '', $get_product_categories);

        if ( "0" != $get_product_categories) {
            if( is_array($product_cats) && count($product_cats) > 0 ){
                      $field_name  = is_numeric($product_cats[0])?'term_id':'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy'         => 'product_cat',
                        'terms'            => $product_cats,
                        'field'            => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $products_query = new \WP_Query( $args );

        if( ( $slider_on == 'yes' ) && ( $product_tabs != 'yes' ) ){
            $columns = 'product__slide__item quomodo-col-xs-12';
        }else{
            $columns = 'quomodo-col-lg-3 quomodo-col-md-6 quomodo-col-sm-6 quomodo-col-xs-12 mb50';
            if( $grid_columns != '' ){
                if( $grid_columns == 5 ){
                    $columns = 'cus-quomodo-col-5 ul-quomodo-col-md-6 quomodo-col-sm-6 quomodo-col-xs-12 mb-50';
                }else{
                    $colwidth = round( 12 / $grid_columns );
                    $columns  = 'quomodo-col-lg-'.$colwidth.' quomodo-col-md-6 quomodo-col-sm-6 quomodo-col-xs-12 mb50';
                }
            }
        }
    ?>

        <div <?php echo $this->get_render_attribute_string( 'content_main_wrap_attr' ); ?>>

            <?php

                /**
                 *  PRODUCT FILTER MENU
                 */
                if ( $product_tabs == 'yes' ) {
                    $this->element_ready_product_filter_menu();
                }
            ?>

            <?php if( is_array( $product_cats ) && (count( $product_cats ) > 0) && ( $product_tabs == 'yes' ) ): ?>
                
                <div class="tab-content product__tab__content tab_content__area">
                    <?php
                        /**
                         *  SINGLE CATEGORY QUERY
                         */
                        $default = 0;
                        foreach( $product_cats as $cats ):
                            $default++;
                            $field_name        = is_numeric($product_cats[0])?'term_id':'slug';
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy'         => 'product_cat',
                                    'terms'            => $cats,
                                    'field'            => $field_name,
                                    'include_children' => false
                                )
                            );
                            $products_query = new \WP_Query( $args ); ?>
                            <div class="single__tab__item tab-pane <?php if( $default == 1 ){echo 'active';} ?>" id="<?php echo 'unique_id-'.$tab_uniqid.$default;?>">
                                <div class="quomodo-row">
                                    <div class="<?php echo esc_attr( $columns );?>"><!-- DEFAULT COLUMNS COUNTER -->
                                    <?php
                                        $item_count = 1;
                                        if( $products_query->have_posts() ): while( $products_query->have_posts() ) : $products_query->the_post(); 
                                            $this->element_ready_product_item_loop_content();  ?>
                                    <?php if ( $item_count % $rows == 0 && ( $products_query->post_count != $item_count ) ) : ?>
                                    <!-- ITEM ROW COUNT -->
                                    </div>
                                <div class="<?php echo esc_attr( $columns );?>">
                                    <!-- ITEM ROW COUNT END -->
                                    <?php endif; $item_count++; endwhile; wp_reset_postdata(); endif; ?>
                                    </div> <!-- DEFAULT COLUMNS COUNTER END-->
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif( ( $slider_on == 'yes' ) && ( $product_tabs != 'yes' ) ): ?>

                <div <?php echo $this->get_render_attribute_string( 'product_items_wrap_attr' ); ?>>
                    <?php if( $products_query->have_posts() ): ?>
                        <?php while( $products_query->have_posts() ): $products_query->the_post(); ?>
                            <?php $this->element_ready_product_item_loop_content(); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
                <?php if( ( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) && 'yes' == $settings['slider_on'] ) : ?>
                    <!-- CUSTOM SLIDER CONTROL -->
                    <div class="owl-controls">
                    <?php if( $settings['slarrows'] == 'yes' ) : ?>
                        <div class="element-ready-carousel-nav<?php echo esc_attr( $slideid ); ?> owl-nav"></div>
                    <?php endif; ?>
                    <?php if( $settings['sldots'] == 'yes' ) : ?>
                        <div class="element-ready-carousel-dots<?php echo esc_attr( $slideid ); ?> owl-dots"></div>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>

                <div <?php echo $this->get_render_attribute_string( 'product_items_wrap_attr' ); ?>>
                    <?php if( $products_query->have_posts() ): ?>
                        <?php while( $products_query->have_posts() ): $products_query->the_post(); ?>
                                
                            <?php if( ( $slider_on != 'yes' ) && ( $product_tabs != 'yes' ) ) : ?>
                            <div class="<?php echo $columns ?>">
                            <?php endif; ?>

                            <?php $this->element_ready_product_item_loop_content(); ?>

                            <?php if( ( $slider_on != 'yes' ) && ( $product_tabs != 'yes' ) ) : ?>
                            </div>
                            <?php endif; ?>

                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        </div> 
    <?php
    }

    /*------------------------------------------
        PRODUCT LOOP CONTENT
    -------------------------------------------*/
    public function element_ready_product_item_loop_content(){
        $settings = $this->get_settings_for_display();  
        
        $product_layout = $settings['content_layout_style'];
        
        ?>
            <?php if( '1' == $product_layout ) : ?>

                <div <?php echo $this->get_render_attribute_string( 'product_item_attr' ); ?>>
                    <div class="product__item__inner">
                        <div class="product__image__wrap">
                            <a href="<?php the_permalink();?>" class="product__image__and__sale_flush">
                                <?php 
                                    $this->element_ready_sale_flush();
                                    $this->element_ready_product_thumb();
                                ?>
                            </a>
                        </div>
                        <div class="product__information__area">
                            <?php $this->element_ready_product_content(); ?>
                        </div>
                    </div>
                </div>

            <?php else : ?>

                <div <?php echo $this->get_render_attribute_string( 'product_item_attr' ); ?>>
                    <div class="product__item__inner">
                        <div class="product__image__wrap">
                            <a href="<?php the_permalink();?>" class="product__image__and__sale_flush">
                                <?php 
                                    $this->element_ready_sale_flush();
                                    $this->element_ready_product_thumb();
                                ?>
                            </a>
                            <?php $this->element_ready_product_action_buttons(); ?>
                        </div>
                        <div class="product__information__area">
                            <?php $this->element_ready_product_content(); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php 
    }

    /*------------------------------------------
        PRODUCT CONTENT
    -------------------------------------------*/
    public function element_ready_product_content(){
        $settings = $this->get_settings_for_display(); ?>
        <div class="product__item__content">
            <?php $this->element_ready_product_title(); ?>
            <?php $this->element_ready_product_description(); ?>
            <div class="product__footer__area">           
                <?php $this->element_ready_product_price(); ?>
                <?php element_ready_woocommerce_review_count( $settings ); ?>
            </div>
        </div>
    <?php
    }

    /*-----------------------------------------
        SALE FLUSH
    -----------------------------------------*/
    public function element_ready_product_thumb(){
        woocommerce_template_loop_product_thumbnail();
    }

    /*-----------------------------------------
        SALE FLUSH
    -----------------------------------------*/
    public function element_ready_sale_flush(){
        $settings = $this->get_settings_for_display();
        if ( 'yes' == $settings['show_saleflash'] ){
            woocommerce_show_product_loop_sale_flash();
        }
    }

    /*-----------------------------------------
        PRODUCT TITLE
    -----------------------------------------*/
    public function element_ready_product_title(){
        $settings      = $this->get_settings_for_display();
        $title_content = wp_trim_words( get_the_title(), $settings['title_limit'] );
        ?>
        <?php if ( 'yes' == $settings['show_title'] ): ?>
            <h4 class="product__item__title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title_content );?></a></h4>
        <?php endif; ?>
    <?php
    }

    /*-----------------------------------------
        PRODUCT CONTENT
    -----------------------------------------*/
    public function element_ready_product_description(){
        $settings = $this->get_settings_for_display();
        $content  = wp_trim_words( get_the_content(), $settings['content_limit'] );
        ?>
        <?php if ( 'yes' == $settings['show_content'] ): ?>
            <p class="product__item__description"><?php echo esc_html( $content );?></p>
        <?php endif; ?>
    <?php
    }

    /*-----------------------------------------
        PRODUCT PRICE
    -----------------------------------------*/
    public function element_ready_product_price(){
        $settings = $this->get_settings_for_display(); ?>
        <?php if ( 'yes' == $settings['show_price'] ): ?>
        <div class="product__item__price">
            <?php woocommerce_template_loop_price(); ?>
        </div>
        <?php endif; ?>
    <?php
    }
    

    /*------------------------------------------
        PRODUCT ACTION BUTTON
    -------------------------------------------*/
    public function element_ready_product_action_buttons(){
        $settings = $this->get_settings_for_display(); ?>
        <?php if( 'yes' == $settings['show_buttons'] ): ?>
        <div class="product__item__buttons">
            <?php
                if ( 'yes' == $settings['show_quickview'] ) {
                    if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
                        element_ready_quick_view_button();
                    }
                }
                if ( 'yes' == $settings['show_wishlist'] ) {
                    if ( class_exists( 'YITH_WCWL' ) ) {
                        element_ready_add_to_wishlist_button();
                    }
                }
                if ( 'yes' == $settings['show_compare'] ) {
                    if ( class_exists( 'YITH_Woocompare' ) && !Plugin::instance()->editor->is_edit_mode() ) {
                        element_ready_woocommerce_compare_button();
                    }
                }
                if ( 'yes' == $settings['show_buynow'] ) {
                    if ( function_exists('element_ready_woocommerce_addcart') ) {
                        element_ready_woocommerce_addcart();
                    }
                }
            ?>
        </div>
        <?php endif; ?>
    <?php
    }

    /*------------------------------------------
        PRODUCT ATTRIBUTE
    -------------------------------------------*/
    public function element_ready_product_attribute(){
        $settings = $this->get_settings_for_display();
        if ( 'yes' == $settings['show_attribute'] ) {
            global $product; 
            $attributes = $product->get_attributes();

            if( $attributes ) : ?>
                <div class="product__item__attributes">
                    <?php foreach ( $attributes as $attribute ) : ?>
                        <?php $name = $attribute->get_name(); ?>
                        <ul>
                            <li class="attribute_label"><?php echo wc_attribute_label( $attribute->get_name() ).esc_html__(':','element-ready-pro'); ?></li>
                            <?php
                                if ( $attribute->is_taxonomy() ) {
                                    global $wc_product_attributes;
                                    $product_terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
                                    foreach ( $product_terms as $product_term ) {
                                        $product_term_name = esc_html( $product_term->name );
                                        $link              = get_term_link( $product_term->term_id, $name );
                                        $color             = get_term_meta( $product_term->term_id, 'color', true );
                                        if ( ! empty ( $wc_product_attributes[ $name ]->attribute_public ) ) {
                                            echo '<li><a href="' . esc_url( $link  ) . '" rel="tag">' . $product_term_name . '</a></li>';
                                        }else{
                                            if(!empty($color)){
                                                echo '<li class="color_attribute" style="background-color: '.$color.';">&nbsp;</li>';
                                            }else{
                                                echo '<li>' . $product_term_name . '</li>';
                                            } 
                                        }
                                    }
                                }
                            ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;
        }
    }

    /*------------------------------------------
        PRODUCT FILTER LIST
    -------------------------------------------*/
    public function element_ready_product_filter_menu(){
        $settings   = $this->get_settings_for_display();
        $tab_uniqid = $this->get_id();?>
        <!-- CATEGORY RETRIVE FOR FILTERING -->
        <div class="product__tab__menu__list">
            <ul class="nav-tabs tab__nav">
                <?php
                    $get_product_categories = $settings['element_ready_product_grid_categories'];  /*get custom field value*/
                    $product_cats           = str_replace(' ', '', $get_product_categories);
                    $default = 0;
                    if( is_array( $product_cats ) && count( $product_cats ) > 0 ){

                        // Category Retrive
                        $catargs = array(
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                            'slug'       => $product_cats,
                        );
                        $prod_categories = get_terms( 'product_cat', $catargs);
                        foreach( $prod_categories as $prod_cats ){ $default++; ?>
                            <li class="<?php if($default==1){echo 'active';} ?>">
                                <a data-toggle="tab" href="#unique_id-<?php echo $tab_uniqid.esc_attr( $default );?>"><?php echo esc_attr( $prod_cats->name,'element-ready-pro' );?></a>
                            </li>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- CATEGORY RETRIVE FOR FILTERING -->
    <?php
    }
}