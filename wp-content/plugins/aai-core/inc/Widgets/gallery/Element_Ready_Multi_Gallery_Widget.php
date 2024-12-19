<?php
namespace Element_Ready_Pro\Widgets\gallery;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
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

class Element_Ready_Multi_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'Element_Ready_Multi_Gallery_Widget';
    }
    
    public function get_title() {
        return __( 'ER Multi Type Gallery', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-posts-justified';
    }
    
	public function get_categories() {
		return [ 'element-ready-pro' ];
	}

    public function get_keywords() {
        return [ 'Gallery', 'Image Gallery', 'Multi Gallery' ];
    }


    public function get_script_depends() {

        return [
            'isotope',
            'masonry',
            'slick',
            'element-ready-core',
        ];
    }
    public function get_style_depends() {
        
        wp_register_style( 'eready-portfolio' , ELEMENT_READY_ROOT_CSS. 'widgets/portfolio.css' );
        wp_register_style( 'eready-gallery' , ELEMENT_READY_ROOT_CSS. 'widgets/gallaery.css' );
        return [ 'eready-gallery','slick','eready-portfolio' ];
    }


    static function content_layout_style(){
        return[
            'element__ready__gallery__layout__1'      => esc_html__( 'Style One', 'element-ready-pro' ),
            'element__ready__gallery__layout__2'      => esc_html__( 'Style Two', 'element-ready-pro' ),
            'element__ready__gallery__layout__3'      => esc_html__( 'Style Three', 'element-ready-pro' ),
            'element__ready__gallery__layout__custom' => esc_html__( 'Custom Style', 'element-ready-pro' ),
        ];
    }

    static function element_ready_gallery_layout_style(){
        return[
            'slider'         => esc_html__( 'Slider', 'element-ready-pro' ),
            'genaral'        => esc_html__( 'Genaral', 'element-ready-pro' ),
            'filtering'      => esc_html__( 'Filtering', 'element-ready-pro' ),
            'masonry'        => esc_html__( 'Masonry', 'element-ready-pro' ),
            'masonry_filter' => esc_html__( 'Masonry Filter', 'element-ready-pro' ),
            'genaral_filter' => esc_html__( 'Genaral Filter', 'element-ready-pro' ),
        ];
    }
    
    protected function register_controls() {

        /*---------------------------
            CONTENT SECTION
        -----------------------------*/
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content Section & Layout', 'element-ready-pro' ),
            ]
        );
            $this->add_control(
                'content_gallery_style_heading',
                [
                    'label' => esc_html__( 'Gallery Layout Style', 'element-ready-pro' ),
                    'type'  => Controls_Manager::HEADING,
                ]
            );
            $this->add_control(
                'content_layout_style',
                [
                    'label'     => esc_html__( 'Content Style', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'element__ready__gallery__layout__1',
                    'options'   => self::content_layout_style(),
                    'separator' => 'before',
                ]
            );
/*********************************************
    FILTER SETTING
**********************************************/
            $this->add_control(
                'content_gallery_type_heading',
                [
                    'label'     => esc_html__( 'Gallery Layout Style', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'gallery_type',
                [
                    'label'     => esc_html__( 'Gallery Style', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'genaral',
                    'options'   => self::element_ready_gallery_layout_style(),
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_gallery_slider_heading',
                [
                    'label'     => esc_html__( 'Slider Settings', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'gallery_type' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'slider_on',
                [
                    'label'        => esc_html__( 'Slider On', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                    'condition'    => [
                        'gallery_type' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'content_gallery_filter_heading',
                [
                    'label'     => esc_html__( 'Gallery Settings', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'gallery_type!' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'layout_mode',
                [
                    'label'   => esc_html__( 'Fitering Layout Mode', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'fitRows',
                    'options' => [
                        'masonry'           => esc_html__( 'Masonry', 'element-ready-pro' ),
                        'masonryHorizontal' => esc_html__( 'Masonry Horizontal', 'element-ready-pro' ),
                        'fitRows'           => esc_html__( 'Fit Rows', 'element-ready-pro' ),
                        'fitColumns'        => esc_html__( 'Fit Columns', 'element-ready-pro' ),
                        'cellsByColumn'     => esc_html__( 'Cells By Column', 'element-ready-pro' ),
                    ],
                    'separator' => 'before',
                    'condition' => [
                        'gallery_type!' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'gallery_menu',
                [
                    'label'        => esc_html__( 'Gallery Filtering Menu', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition'    => [
                        'gallery_type!' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'show_all_menu',
                [
                    'label'        => esc_html__( 'Show All Category', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition'    => [
                        'gallery_type!' => 'slider',
                    ]
                ]
            );
            $this->add_control(
                'active_menu_category',
                [
                    'label'       => esc_html__( 'Active Category', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'separator'   => 'before',
                    'description' => esc_html__( 'If you want to by default active a defferent cartegory, Please provide a category name which you provide in categoy as gallery item.','element-ready-pro' ),
                    'condition'   => [
                        'gallery_type!' => 'slider',
                    ]
                ]
            );
            $this->add_responsive_control(
                'gallery_columns',
                [
                    'label' => esc_html__( 'Columns', 'element-ready-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 6,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 3
                    ],
                    'condition'    => [
                        'gallery_type!' => 'slider',
                    ],
                    'separator' => 'before',
                ]
            );

            $columns_margin  = is_rtl() ? '0 0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}};' : '0 -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}} 0;';
            $columns_padding = is_rtl() ? '0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};' : '0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0;';

            $this->add_responsive_control(
                'gallery_gutter',
                [
                    'label'      => esc_html__( 'Columns Gutter', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30
                    ],
                    'selectors' => [
                        '(desktop){{WRAPPER}} .element__ready__gallery__item__parent' => 'max-width:calc( 100% / {{gallery_columns.size}} ); padding: ' . $columns_padding,
                        '(tablet){{WRAPPER}} .element__ready__gallery__item__parent'  => 'max-width:calc( 100% / {{gallery_columns_tablet.size}} ); padding: ' . $columns_padding,
                        '(mobile){{WRAPPER}} .element__ready__gallery__item__parent'  => 'max-width:calc( 100% / {{gallery_columns_mobile.size}} ); padding: ' . $columns_padding,

                        '(desktop){{WRAPPER}} .element-ready-filter-activation' => 'margin: ' . $columns_margin,
                        '(tablet){{WRAPPER}} .element-ready-filter-activation'  => 'margin: ' . $columns_margin,
                        '(mobile){{WRAPPER}} .element-ready-filter-activation'  => 'margin: ' . $columns_margin,
                    ],
                    'condition'    => [
                        'gallery_type!' => 'slider',
                    ],
                    'separator' => 'before',
                ]
            );
/*********************************************
    FILTER SETTING
**********************************************/
            $repeater = new Repeater();
            $repeater->add_control(
                'menu_category',
                [
                    'label'       => esc_html__( 'Menu Category', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'description' => esc_html__( 'Use the text as a category filter menu item, please don\'t use any space just set a speacific word for filtering.','element-ready-pro' ),
                ]
            );
            $repeater->add_control(
                'content_image',
                [
                    'label'   => esc_html__( 'Image', 'element-ready-pro' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'separator' => 'before',
                ]
            );
            $repeater->add_group_control(
                Group_Control_Image_Size:: get_type(),
                [
                    'name'      => 'content_imagesize',
                    'default'   => 'large',
                    'separator' => 'none',
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'content_image_title',
                [
                    'label'     => esc_html__( 'Title', 'element-ready-pro' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__('Example Title #1','element-ready-pro'),
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'content_description',
                [
                    'label'     => esc_html__( 'Description', 'element-ready-pro' ),
                    'type'      => Controls_Manager::WYSIWYG,
                    'separator' => 'before',
                ]
            );

            $repeater->add_control(
                'sale_flush',
                [
                    'label'        => esc_html__( 'Sale Flush', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
            $repeater->add_control(
                'sale_flush_text',
                [
                    'label'       => esc_html__( 'Sale Flush Text', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( '10% Off', 'element-ready-pro' ),
                    'default'     => esc_html__( '10% Off', 'element-ready-pro' ),
                    'separator'   => 'before',
                    'condition'   => [
                        'sale_flush' => 'yes',
                    ]
                ]
            );
            $repeater->add_control(
                'content_price',
                [
                    'label'        => esc_html__( 'Price Item On', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
            $repeater->add_control(
                'content_regular_price',
                [
                    'label'     => esc_html__( 'Regular Price', 'element-ready-pro' ),
                    'type'      => Controls_Manager::TEXT,
                    'separator' => 'before',
                    'condition' => [
                        'content_price' => 'yes',
                    ]
                ]
            );
            $repeater->add_control(
                'content_offer_price',
                [
                    'label'     => esc_html__( 'Offer Price', 'element-ready-pro' ),
                    'type'      => Controls_Manager::TEXT,
                    'condition' => [
                        'content_price' => 'yes',
                    ]
                ]
            );
            $repeater->add_control(
                'custom_link',
                [
                    'label'         => esc_html__( 'Custom Link', 'element-ready-pro' ),
                    'type'          => Controls_Manager::URL,
                    'placeholder'   => esc_html__( 'http://your-link.com', 'element-ready-pro' ),
                    'show_external' => true,
                    'default'       => [
                        'url'         => '#',
                        'is_external' => false,
                        'nofollow'    => false,
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_gallery_item_heading',
                [
                    'label'     => esc_html__( 'Gallery Items', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_image_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  =>  $repeater->get_controls(),
                    'default' => [
                        [
                            'content_image_title' => esc_html__('Title #1','element-ready-pro'),
                        ],
                    ],
                    'title_field' => '{{{ content_image_title }}}',
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'link_click_event',
                [
                    'label'   => esc_html__( 'Click Event', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'        => esc_html__( 'None', 'element-ready-pro' ),
                        'lightbox'    => esc_html__( 'Lightbox', 'element-ready-pro' ),
                        'custom_link' => esc_html__( 'Custom Link', 'element-ready-pro' ),
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_options_heading',
                [
                    'label'     => esc_html__( 'Content Options', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_content',
                [
                    'label'        => esc_html__( 'Show Content ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Show Title ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_description',
                [
                    'label'        => esc_html__( 'Show Description ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'content_size',
                [
                    'label'     => esc_html__( 'Content Total Words', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 50,
                    'step'      => 1,
                    'default'   => 10,
                    'condition' => [
                        'show_description' => 'yes',
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_price',
                [
                    'label'        => esc_html__( 'Show Price ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_sale_flush',
                [
                    'label'        => esc_html__( 'Show Sale Flush ?', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            CONTENT SECTION END
        -----------------------------*/
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
                        '{{WRAPPER}} .single__gallery__item' => 'margin: calc( {{VALUE}}px / 2 );',
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
        
        /*-------------------------
            AREA STYLE
        --------------------------*/
        $this->start_controls_section(
            'items_area_style_section',
            [
                'label' => esc_html__( 'Area Style', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'area_width',
                [
                    'label'      => esc_html__( 'Width', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'area_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();   
        /*-------------------------
            AREA STYLE END
        --------------------------*/

        /*-------------------------
            MENU WRAP STYLE
        ---------------------------*/
        $this->start_controls_section(
            'element_ready_tab_style_area',
            [
                'label' => __( 'Menu Wrap', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_type!' => 'slider',
                ],
            ]
        );
            $this->add_responsive_control(
                'element_ready_tab_section_display',
                [
                    'label'   => __( 'Display', 'element-ready-pro' ),
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
                        '{{WRAPPER}} .filter__menu' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menu_text_align',
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
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu ul' => 'text-align: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_float',
                [
                    'label'   => __( 'Float', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'left'     => __( 'Left', 'element-ready-pro' ),
                        'right'    => __( 'Right', 'element-ready-pro' ),
                        'inherit ' => __( 'Inherit', 'element-ready-pro' ),
                        'none'     => __( 'None', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => 'float: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .filter__menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'element_ready_tab_section_bg',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .filter__menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'element_ready_tab_section_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .filter__menu',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'element_ready_tab_section_shadow',
                    'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .filter__menu',
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_width',
                [
                    'label'      => __( 'Width', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_height',
                [
                    'label'      => __( 'Height', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'element_ready_tab_section_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'custom_tab_area_css',
                [
                    'label'     => __( 'Custom CSS', 'element-ready-pro' ),
                    'type'      => Controls_Manager::CODE,
                    'rows'      => 20,
                    'language'  => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .filter__menu' => '{{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            MENU WRAP STYLE END
        ---------------------------*/
        
        /*-------------------------
            MENU ITEM STYLE
        ---------------------------*/
        $this->start_controls_section(
            'tab_button_style_section',
            [
                'label' => __( 'Menu Item', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_type!' => 'slider',
                ],
            ]
        );
            $this->start_controls_tabs( 'tabs_button_style' );
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => __( 'Normal', 'element-ready-pro' ),
                ]
            );
                $this->add_responsive_control(
                    'tab_button_display',
                    [
                        'label'   => __( 'Display', 'element-ready-pro' ),
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
                            '{{WRAPPER}} .filter__menu li' => 'display: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_text_align',
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
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => 'text-align: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'tab_button_typography',
                        'selector' => '{{WRAPPER}} .filter__menu li',
                    ]
                );
                $this->add_control(
                    'tab_button_color',
                    [
                        'label'     => __( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => 'color: {{VALUE}};',
                        ],
                    ]
                );                
                $this->add_responsive_control(
                    'tab_button_width',
                    [
                        'label'      => __( 'Width', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'tab_button_background_color',
                        'label'    => __( 'Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .filter__menu li',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_margin',
                    [
                        'label'      => __( 'Margin', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_padding',
                    [
                        'label'   => __( 'Padding', 'element-ready-pro' ),
                        'type'    => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .filter__menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'tab_button_border',
                        'selector' => '{{WRAPPER}} .filter__menu li',
                    ]
                );
                $this->add_control(
                    'tab_button_radius',
                    [
                        'label'      => __( 'Border Radius', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_box_shadow',
                        'selector' => '{{WRAPPER}} .filter__menu li',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'element-ready-pro' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => __( 'Hover', 'element-ready-pro' ),
                ]
            );
                $this->add_control(
                    'tab_button_hover_color',
                    [
                        'label'     => __( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li:hover, {{WRAPPER}} .filter__menu li.active' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'tab_button_hover_background',
                        'label'    => __( 'Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .filter__menu li:hover, {{WRAPPER}} .filter__menu li.active',
                    ]
                );

                $this->add_control(
                    'tab_button_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li:hover, {{WRAPPER}} .filter__menu li.active' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .filter__menu li:hover, {{WRAPPER}} .filter__menu li.active',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_hover_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'element-ready-pro' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .filter__menu li' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
            $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-------------------------
            MENU ITEM STYLE END
        ---------------------------*/

        /*-------------------------
            ITEM PARENT STYLE
        --------------------------*/
        $this->start_controls_section(
            'item_grid_style_section',
            [
                'label'     => esc_html__( 'Column Style', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'item_grid_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'item_grid_padding',
                [
                    'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
    		$this->add_responsive_control(
    			'item_grid_width',
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
    						'min'  => 0,
    						'max'  => 100,
    						'step' => 0.1,
    					]
    				],
    				'default' => [
    					'unit' => '%',
    				],
    				'selectors' => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent' => 'width:calc( {{SIZE}}{{UNIT}} - {{gallery_gutter.size}}{{gallery_gutter.unit}} ) !important;',
    				],
    			]
    		);
        $this->end_controls_section();
        /*-------------------------
            ITEM PARENT STYLE END
        --------------------------*/

        /*-------------------------
            CENTER ITEM STYLE
        --------------------------*/
        $this->start_controls_section(
            'center_item_style_section',
            [
                'label'     => esc_html__( 'Center Item Style', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on'    => 'yes',
                    'slcentermode' => 'yes',
                ]
            ]
        );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'     => 'center_item_image_filters',
                    'selector' => '{{WRAPPER}} .element__ready__gallery__item__parent.slick-active.slick-center img',
                ]
            );
            
            $this->add_control(
                'center_item_opacity',
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
                        '{{WRAPPER}} .element__ready__gallery__item__parent.slick-active.slick-center'  => 'opacity:{{SIZE}};',
                        '{{WRAPPER}} .slick-active.slick-center .element__ready__gallery__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'center_item_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent.slick-active.slick-center'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .element__ready__gallery__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'center_item_padding',
                [
                    'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent.slick-active.slick-center'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .element__ready__gallery__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_scale',
                [
                    'label' => esc_html__( 'Scale', 'element-ready-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent.slick-active.slick-center'  => 'transform: scale({{SIZE}});',
                        '{{WRAPPER}} .slick-active.slick-center .element__ready__gallery__item__parent' => 'transform: scale({{SIZE}});',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_transition',
                [
                    'label' => esc_html__( 'Transition', 'element-ready-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 0.5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__gallery__item__parent' => 'transition: {{SIZE}}s;',
                        '{{WRAPPER}} .slick-slide'                     => 'transition: {{SIZE}}s;',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            END CENTER ITEM STYLE
        --------------------------*/

        /*-------------------------
            BOX STYLE
        --------------------------*/
        $this->start_controls_section(
            'element_ready_gallery_style_section',
            [
                'label' => esc_html__( 'Item Style', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'     => 'gallery_single_item_image_filters',
                    'selector' => '{{WRAPPER}} .single__gallery__item img',
                ]
            );
            $this->add_control(
                'gallery_single_item_opacity',
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
                        '{{WRAPPER}} .element__ready__gallery__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'box_typography',
                    'selector' => '{{WRAPPER}} .single__gallery__item',
                ]
            );
            $this->add_control(
                'box_color',
                [
                    'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__gallery__item' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'gallery_single_background',
                    'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__gallery__item',
                ]
            );
           $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'gallery_single_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .single__gallery__item',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'gallery_single_border',
                    'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .single__gallery__item',
                ]
            );
            $this->add_responsive_control(
                'gallery_single_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__gallery__item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'gallery_single_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__gallery__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'gallery_single_padding',
                [
                    'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__gallery__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'item_horizontal_align',
                [
                    'label'   => esc_html__( 'Vertical Align', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'align-items:center;',
                    'options' => [
                        'align-items:center;'     => esc_html__( 'Center', 'element-ready-pro' ),
                        'align-items:flex-start;' => esc_html__( 'Start', 'element-ready-pro' ),
                        'align-items:flex-end;'   => esc_html__( 'End', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slider .slick-track' => 'display: flex; {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'item_align',
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
                        '{{WRAPPER}} .single__gallery__item,{{WRAPPER}} .single__gallery__item img' => 'margin: 0 auto; text-align: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->add_responsive_control(
                'nth_child_margin',
                [
                    'label'      => esc_html__( 'Item Nth Child 2 Margin Vartically', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -200,
                            'max'  => 200,
                            'step' => 5,
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
                        '{{WRAPPER}} .element__ready__gallery__item__parent:nth-child(2n)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'item_transition',
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
                        '{{WRAPPER}} .single__gallery__item,{{WRAPPER}} .single__gallery__item img' => 'transition: {{SIZE}}s;',
                    ],
                ]
            );
            $this->add_control(
                'item_opacity',
                [
                    'label'      => esc_html__( 'Opacity', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__gallery__item' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_control(
                'item_hover_title',
                [
                    'label'     => esc_html__( 'Item Hover', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'heading_hr1',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'     => 'gallery_single_item_image_hover_filters',
                    'selector' => '{{WRAPPER}} .single__gallery__item:hover img',
                ]
            );
            $this->add_control(
                'item_hover_opacity',
                [
                    'label'      => esc_html__( 'Opacity', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__gallery__item:hover' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'item_hover_margin',
                [
                    'label'      => esc_html__( 'Item Hover Offset Vartically', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -200,
                            'max'  => 200,
                            'step' => 5,
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
                        '{{WRAPPER}} .element__ready__gallery__item__parent:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            BOX STYLE END
        --------------------------*/

        /*----------------------------
            IMAGE WRAP
        -----------------------------*/
        $this->start_controls_section(
            'image_wrap_style_section',
            [
                'label' => __( 'Thumbnail & Wrap', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'image_wrap_width',
                [
                    'label'      => esc_html__( 'Item Image Width', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .gallery__item__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'image_wrap_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__item__thumbnail',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'image_wrap_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .gallery__item__thumbnail',
                ]
            );
            $this->add_responsive_control(
                'image_wrap_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__item__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'image_wrap_shadow',
                    'selector' => '{{WRAPPER}} .gallery__item__thumbnail',
                ]
            );
            $this->add_responsive_control(
                'image_wrap_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__item__thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'image_wrap_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__item__thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            IMAGE WRAP END
        -----------------------------*/

        /*----------------------------
            SALE FLUSH STYLE
        -----------------------------*/
        $this->start_controls_section(
            'sale_flush_style_section',
            [
                'label'     => __( 'Sale Flush', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_sale_flush' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'sale_flush_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .gallery__sale__flush' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'sale_flush_typography',
                    'selector' => '{{WRAPPER}} .gallery__sale__flush',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'sale_flush_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__sale__flush',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'sale_flush_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .gallery__sale__flush',
                ]
            );
            $this->add_responsive_control(
                'sale_flush_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__sale__flush' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'sale_flush_shadow',
                    'selector' => '{{WRAPPER}} .gallery__sale__flush',
                ]
            );
            $this->add_responsive_control(
                'sale_flush_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__sale__flush' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'sale_flush_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__sale__flush' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            SALE FLUSH STYLE END
        -----------------------------*/

        /*----------------------------
            CONTENT WRAP STYLE
        -----------------------------*/
        $this->start_controls_section(
            'content_wrap_style_section',
            [
                'label' => __( 'Content Wrap', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'content_wrap_tabs_style' );
                $this->start_controls_tab(
                    'content_wrap_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'content_wrap_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .gallery__item__content' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'content_wrap_typography',
                            'selector' => '{{WRAPPER}} .gallery__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'content_wrap_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .gallery__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'content_wrap_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .gallery__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .gallery__item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'content_wrap_shadow',
                            'selector' => '{{WRAPPER}} .gallery__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .gallery__item__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .gallery__item__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'content_wrap_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'hover_content_wrap_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__gallery__item:hover .gallery__item__content' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__gallery__item:hover .gallery__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__gallery__item:hover .gallery__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_content_wrap_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__gallery__item:hover .gallery__item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_shadow',
                            'selector' => '{{WRAPPER}} .single__gallery__item:hover .gallery__item__content',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            CONTENT WRAP STYLE END
        -----------------------------*/
        
        /*-------------------------
            TITLE STYLE
        --------------------------*/
        $this->start_controls_section(
            'title_section_style',
            [
                'label'     => esc_html__( 'Title', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
            $this->start_controls_tabs('title_tabs_style');
            $this->start_controls_tab( 'title_tab_normal',
        			[
        				'label' => esc_html__( 'Normal', 'element-ready-pro' ),
        			]
        		);
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'title_typography',
                        'selector' => '{{WRAPPER}} .gallery__caption',
                    ]
                );
                $this->add_control(
                    'title_color',
                    [
                        'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .gallery__caption' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'title_background',
                        'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                        'default'  => '#ffffff',
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .gallery__caption',
                    ]
                );
                $this->add_responsive_control(
                    'title_margin',
                    [
                        'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .gallery__caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_responsive_control(
                    'title_padding',
                    [
                        'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .gallery__caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab( 'title_tab_hover',
    			[
    				'label' => esc_html__( 'Hover', 'element-ready-pro' ),
    			]
    		);
                $this->add_control(
                    'title_hover_color',
                    [
                        'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .gallery__caption:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'hover_title_background',
                        'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                        'default'  => '#ffffff',
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .gallery__caption:hover',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-------------------------
            TITLE STYLE END
        --------------------------*/

        /*----------------------------
            DESCRIPTION STYLE
        -----------------------------*/
        $this->start_controls_section(
            'description_style_section',
            [
                'label'     => __( 'Description', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'description_typography',
                    'selector' => '{{WRAPPER}} .gallery__description',
                ]
            );
            $this->add_control(
                'description_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .gallery__description' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'description_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__description',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'description_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .gallery__description',
                ]
            );
            $this->add_responsive_control(
                'description_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'description_shadow',
                    'selector' => '{{WRAPPER}} .gallery__description',
                ]
            );
            $this->add_responsive_control(
                'description_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            DESCRIPTION STYLE END
        -----------------------------*/

        /*----------------------------
            PRICE STYLE
        -----------------------------*/
        $this->start_controls_section(
            'price_style_section',
            [
                'label'     => __( 'Prices', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_price' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'price_wrap_hidding',
                [
                    'label' => __( 'Price Wrap Price', 'element-ready-pro' ),
                    'type'  => Controls_Manager::HEADING,
                ]
            );
            $this->add_responsive_control(
                'price_wrap_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__item__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'price_wrap_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__item__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'price_genaral_hidding',
                [
                    'label'     => __( 'Genaral Price', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'price_genaral_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .gallery__genaral__price' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'price_genaral_typography',
                    'selector' => '{{WRAPPER}} .gallery__genaral__price',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'price_genaral_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__genaral__price',
                ]
            );
            $this->add_responsive_control(
                'price_genaral_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__genaral__price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_genaral_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__genaral__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_genaral_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__genaral__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'price_regular_hidding',
                [
                    'label'     => __( 'Regular Price', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'price_regular_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .gallery__regular__price' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'price_regular_typography',
                    'selector' => '{{WRAPPER}} .gallery__regular__price',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'price_regular_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__regular__price',
                ]
            );
            $this->add_responsive_control(
                'price_regular_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__regular__price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_regular_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__regular__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_regular_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__regular__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'price_offer_hidding',
                [
                    'label'     => __( 'Offer Price', 'element-ready-pro' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'price_offer_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .gallery__offer__price' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'price_offer_typography',
                    'selector' => '{{WRAPPER}} .gallery__offer__price',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'price_offer_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .gallery__offer__price',
                ]
            );
            $this->add_responsive_control(
                'price_offer_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__offer__price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_offer_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__offer__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_offer_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .gallery__offer__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            PRICE STYLE END
        -----------------------------*/
        
        /*----------------------------
            SLIDER NAV WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_control_warp_style_section',
            [
                'label'     => esc_html__( 'Slider Arrow Warp', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
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
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
                ]
            );
            $this->add_control(
                'slider_nav_warp_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'slider_nav_warp_shadow',
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
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

        /*------------------------
            ARROW STYLE
        --------------------------*/
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'     => esc_html__( 'Arrow', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label'  => esc_html__( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label'      => esc_html__( 'Font Size', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_height',
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
                                'size' => 40,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_width',
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
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_position_from_left',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Left', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_position_from_bottom',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Top', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_position_from_right',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Right', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_position_from_top',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Top', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label'  => esc_html__( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_left',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Left', 'element-ready-pro' ),
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
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_bottom',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Top', 'element-ready-pro' ),
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
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_right',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Right', 'element-ready-pro' ),
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
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_top',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Top', 'element-ready-pro' ),
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
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*------------------------
             ARROW STYLE END
        --------------------------*/

        /*------------------------
             DOTS STYLE
        --------------------------*/
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label'     => esc_html__( 'Pagination', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'sldots'    => 'yes',
                ],
            ]
        );
            $this->start_controls_tabs('pagination_style_tabs');
                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_responsive_control(
                        'slider_pagination_height',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_pagination_width',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_warp_margin',
                        [
                            'label'      => esc_html__( 'Pagination Warp Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pagi_war_align',
                        [
                            'label'   => esc_html__( 'Pagination Warp Alignment', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .sldier-content-area .slick-dots' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_hover_background',
                            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_hover_border',
                            'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li.slick-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .sldier-content-area .slick-dots li:hover'        => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*------------------------
             DOTS STYLE END
        --------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $gallery_id = $this->get_id();
        // Carousel Aea Atrribute
        $this->add_render_attribute( 'content_main_wrap_attr', 'class', 'sldier-content-area' );
        $this->add_render_attribute( 'content_main_wrap_attr', 'class', $settings['nav_position'] );
        // Gallery Wrap Class
        $this->add_render_attribute( 'content_main_wrap_attr', 'class', 'gallery-content-area' );

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'content_items_wrap_attr', 'class', 'element-ready-carousel-activation' );
            $slideid = rand(2564,1245);

            $slider_settings = [
                'gallery_id'      => $gallery_id,
                'slideid'         => $slideid,
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
            $this->add_render_attribute( 'content_items_wrap_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else{
            $this->add_render_attribute( 'content_items_wrap_attr', 'class', 'element-ready-filter-activation' );            
            $this->add_render_attribute( 'content_items_wrap_attr', 'id', 'element__ready__gallery__activation__'.$gallery_id );

            $gallery_settings = [
                'gallery_id'           => $gallery_id,
                'gallery_type'         => $settings['gallery_type'],
                'layout_mode'          => $settings['layout_mode'],
                'active_menu_category' => $settings['active_menu_category'],
            ];
            $this->add_render_attribute( 'content_items_wrap_attr', 'data-settings', wp_json_encode( $gallery_settings ) );
        }

        if ( 'slider' == $settings['gallery_type'] ) {
            $gallery_settings = [
                'gallery_id'   => $gallery_id,
                'gallery_type' => $settings['gallery_type'],
            ];
            $this->add_render_attribute( 'content_items_wrap_attr', 'class', 'element-ready-filter-activation' );            
        }

        //$this->add_render_attribute( 'element_ready_carousel_item_parent_attr', 'class', 'element__ready__gallery__item__parent' );
        $this->add_render_attribute( 'content_single_item_attr', 'class', 'single__gallery__item' );
        $this->add_render_attribute( 'content_single_item_attr', 'class', $settings['content_layout_style'] );
        
        ?>
        <div <?php echo $this->get_render_attribute_string('content_main_wrap_attr'); ?>>

            <?php
                /**
                 *  FILTER MENU GALLERY
                 */
                $this->element_ready_gallery_filter_menu();
            ?>

            <div <?php echo $this->get_render_attribute_string('content_items_wrap_attr'); ?>>

                <?php foreach ( $settings['content_image_list'] as $single_item ): ?>

                    <div class="element__ready__grid__item__<?php echo esc_attr( $gallery_id ); ?> element__ready__gallery__item__parent <?php echo strtolower($single_item['menu_category']); ?>">
                        <div <?php echo $this->get_render_attribute_string('content_single_item_attr'); ?>>
                            <div class="gallery__item__thumbnail">
                                <?php 
                                    if( $settings['link_click_event'] == 'lightbox' ){
                                        echo '<a href="'.$single_item['content_image']['url'].'" class="lightbox"  >'.Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' ).'</a>';
                                    }elseif( $settings['link_click_event'] == 'custom_link' ){
                                        if ( ! empty( $single_item['custom_link']['url'] ) ) {
                                            $link_attr = 'href="'.esc_url($single_item['custom_link']['url']).'"';
                                            if ( $single_item['custom_link']['is_external'] ) {
                                                $link_attr .= ' target="_blank"';
                                            }
                                            if ( ! empty( $single_item['custom_link']['nofollow'] ) ) {
                                                $link_attr .= ' rel="nofollow"';
                                            }
                                            echo '<a '.$link_attr.' >'.Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' ).'</a>';
                                        }else{
                                            echo Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' );                  
                                        }
                                        unset($link_attr);
                                    }else{
                                        echo Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' );
                                    }
                                ?>
                                <?php if( 'yes' == $settings['show_sale_flush'] && 'yes' == $single_item['sale_flush'] ): ?>
                                    <div class="gallery__sale__flush"><?php echo esc_html( $single_item['sale_flush_text'] ); ?></div>
                                <?php endif; ?>

                            </div>
                            <?php if( 'yes' == $settings['show_content'] ) : ?>
                            <div class="gallery__item__content">

                                <?php if( $settings['show_title'] == 'yes' && !empty($single_item['content_image_title']) ): ?>
                                    <h3 class="gallery__caption"><?php echo esc_html($single_item['content_image_title']); ?></h3>
                                <?php endif; ?>

                                <?php if( 'yes' == $settings['show_description'] && !empty($single_item['content_description']) ): ?>
                                    <?php $description = wp_trim_words( $single_item['content_description'], $settings['content_size'] ); ?>
                                    <div class="gallery__description"><?php echo esc_html( $description ); ?></div>
                                <?php endif; ?>

                                <?php if( 'yes' == $settings['show_price'] && 'yes' == $single_item['content_price'] ): ?>
                                    <div class="gallery__item__price">
                                        <?php if( !empty( $single_item['content_regular_price'] ) && empty( $single_item['content_offer_price'] ) ): ?>
                                            <span class="gallery__genaral__price"><?php echo esc_html( $single_item['content_regular_price'] ); ?></span>
                                        <?php elseif( !empty( $single_item['content_regular_price'] ) && !empty( $single_item['content_offer_price'] ) ): ?>
                                            <span class="gallery__regular__price"><del><?php echo esc_html( $single_item['content_regular_price'] ); ?></del></span>
                                            <span class="gallery__offer__price"><?php echo esc_html( $single_item['content_offer_price'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endforeach; ?>

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

        </div>
    <?php
    }

    public function element_ready_gallery_filter_menu(){
        $settings   = $this->get_settings_for_display(); 
        $gallery_id = $this->get_id(); ?>
        <?php if( 'yes' == $settings['gallery_menu'] ) : ?>
            <div class="filter__menu" id="filter__menu__<?php echo esc_attr( $gallery_id ); ?>">
                <ul>
                    <?php if ( 'yes' == $settings['show_all_menu'] ) : ?>
                        <li class="filter active" data-filter="*"><?php esc_html_e( 'All', 'element-ready-pro' ); ?></li>
                    <?php endif; ?>
                    <?php
                        $menu_array = array();
                        foreach ( $settings['content_image_list'] as $single_item ) {
                            $menu_array[] = $single_item['menu_category'];
                        }
                        $menu_array = array_unique($menu_array); 
                    ?>
                    <?php  foreach ( $menu_array as $menu ) : ?>
                        <li class="filter" data-filter=".<?php echo esc_attr( strtolower($menu) ); ?>"><?php echo esc_html( $menu ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php        
    }
}