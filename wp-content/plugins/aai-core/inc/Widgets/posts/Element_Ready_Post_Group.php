<?php
namespace Element_Ready_Pro\Widgets\posts;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Ready_Post_Group extends Widget_Base {

    public function get_name() {
        return 'Element_Ready_Post_Group';
    }
    
    public function get_title() {
        return __( 'ER Post Group', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-posts-group';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'Post', 'Post Group', 'Blog Post', 'Post Grid' ];
    }

    public function get_script_depends() {
        return [
            'imagesloaded',
            'masonry',
            'element-ready-core',
        ];
    }

    public function get_style_depends() {

        wp_register_style( 'eready-post-blog' , ELEMENT_READY_ROOT_CSS. 'widgets/blog.css' );
        return[
            'eready-post-blog','element-ready-grid'
        ];
    }

    static function content_layout_style(){
        return[
            '1' => __( 'Layout One', 'element-ready-pro' ),
            '2' => __( 'Layout Two', 'element-ready-pro' ),
            '3' => __( 'Layout Three', 'element-ready-pro' ),
        ];
    }

    static function element_ready_get_post_types( $args = [] ) {
   
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];

        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }

        $_post_types = get_post_types( $post_type_args , 'objects' );

        $post_types  = [];
        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }

        return $post_types;
    }

    static function element_ready_get_taxonomies( $element_ready_texonomy = 'category' ){

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

        $this->start_controls_section(
            'post_content_section',
            [
                'label' => __( 'Post Content', 'element-ready-pro' ),
            ]
        );

            $this->add_control(
                'content_layout_style',
                [
                    'label'   => __( 'Layout', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => self::content_layout_style(),
                ]
            );

            $this->add_control(
                'post_masonry',
                [
                    'label'        => __( 'Post Masonry', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'element-ready-pro' ),
                    'label_off'    => __( 'Off', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            
        $this->end_controls_section();

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __( 'Post Option', 'element-ready-pro' ),
            ]
        );
            
            $this->add_control(
                'element_ready_post_type',
                [
                    'label'       => esc_html__( 'Content Sourse', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options'     => self::element_ready_get_post_types(),
                ]
            );

            $this->add_control(
                'posts_categories',
                [
                    'label'       => esc_html__( 'Categories', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::element_ready_get_taxonomies(),
                    'condition'   => [
                        'element_ready_post_type' => 'post',
                    ]
                ]
            );

            $this->add_control(
                'element_ready_prod_categories',
                [
                    'label'       => esc_html__( 'Categories', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::element_ready_get_taxonomies('product_cat'),
                    'condition'   => [
                        'element_ready_post_type' => 'product',
                    ]
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label'     => __('Limit', 'element-ready-pro'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 5,
                    'separator' => 'before',
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
                'postorder',
                [
                    'label'   => esc_html__( 'Order', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => esc_html__('Descending','element-ready-pro'),
                        'ASC'  => esc_html__('Ascending','element-ready-pro'),
                    ],
                    'condition' => [
                        'custom_order!' => 'yes',
                    ]
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
                'show_thumb',
                [
                    'label'        => esc_html__( 'Thumbnail', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'label'        => esc_html__( 'Thumb Size', 'element-ready-pro' ),
                    'name'    =>'thumb_size',
                    'default' => 'large',
                    'condition' => [
                        'show_thumb' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label'        => esc_html__( 'Category', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'show_author',
                [
                    'label'        => esc_html__( 'Author', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label'        => esc_html__( 'Date', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'date_type',
                [
                    'label'   => esc_html__( 'Date Type', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'date'     => esc_html__('Date','element-ready-pro'),
                        'time'     => esc_html__('Time','element-ready-pro'),
                        'time_ago' => esc_html__('Time Ago','element-ready-pro'),
                        'date_time' => esc_html__('Date and Time','element-ready-pro'),
                    ],
                    'condition' => [
                        'show_date' => 'yes',
                    ]
                ]
            );

             $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Title', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label'     => __( 'Title Length', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'step'      => 1,
                    'default'   => 5,
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_content',
                [
                    'label'        => esc_html__( 'Content', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'content_length',
                [
                    'label'     => __( 'Content Length', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'step'      => 1,
                    'default'   => 20,
                    'condition' => [
                        'show_content' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_read_more_btn',
                [
                    'label'        => esc_html__( 'Read More', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'read_more_txt',
                [
                    'label'       => __( 'Read More button text', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'Read More', 'element-ready-pro' ),
                    'placeholder' => __( 'Read More', 'element-ready-pro' ),
                    'label_block' => true,
                    'condition'   => [
                        'show_read_more_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'readmore_icon',
                [
                    'label'     => __( 'Readmore Icon', 'element-ready-pro' ),
                    'type'      => Controls_Manager::ICON,
                    'label_block' => true,
                    'condition' => [
                        'show_read_more_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'readmore_icon_position',
                [
                    'label'   => __( 'Icon Postion', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'  => __( 'Left', 'element-ready-pro' ),
                        'right' => __( 'Right', 'element-ready-pro' ),
                    ],
                    'condition'   => [
                        'readmore_icon!' => '',
                    ]
                ]
            );

            // Button Icon Margin
            $this->add_control(
                'readmore_icon_indent',
                [
                    'label' => __( 'Icon Spacing', 'element-ready-pro' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'condition' => [
                        'readmore_icon!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .readmore__btn .readmore_icon_right' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .readmore__btn .readmore_icon_left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Content Option End

        /*-----------------------
            BOX STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_content_box',
            [
                'label'     => __( 'Box', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'box_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post',
                ]
            );

            $this->add_control(
                'box_color',
                [
                    'label'  => __( 'Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'box_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .element__ready__single__post',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'box_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post',
                ]
            );

            $this->add_responsive_control(
                'box_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post' => 'overflow:hidden;border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',

                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'box_shadow',
                    'selector' => '{{WRAPPER}} .element__ready__single__post',
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-list' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'box_item_margin_vartically',
                [
                    'label'              => __( 'Item Margin Vartically', 'element-ready-pro' ),
                    'type'               => Controls_Manager::DIMENSIONS,
                    'size_units'         => [ 'px', '%', 'em' ],
                    'allowed_dimensions' => [ 'top', 'bottom'],
                    'selectors'          => [
                        '{{WRAPPER}} .element__ready__single__post' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom:{{BOTTOM}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_nth_child_margin',
                [
                    'label' => __( 'Nth Child 2 Margin Vartically', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
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
                        '{{WRAPPER}} .element__ready__single__post:nth-child(2n)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_item_hover_margin',
                [
                    'label' => __( 'Item Hover Margin Vartically', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
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
                        '{{WRAPPER}} .element__ready__single__post:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            BOX STYLE END
        -------------------------*/

        /*-----------------------
            CONTENT STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_content_style_section',
            [
                'label'     => __( 'Content', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'content_color',
                [
                    'label'  => __( 'Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post .post__content' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'content_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post .post__content',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_align',
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
                        '{{WRAPPER}} .element__ready__single__post .post__content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            CONTENT STYLE END
        -------------------------*/

        /*-----------------------
            TITLE STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_title_style_section',
            [
                'label'     => __( 'Title', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label'  => __( 'Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post .post__content .post__title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label'  => __( 'Hover Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post .post__content .post__title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'title_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post .post__content .post__title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__content .post__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__content .post__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
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
                        '{{WRAPPER}} .element__ready__single__post .post__content .post__title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            TITLE STYLE END
        -------------------------*/

        /*-----------------------
            CATEGORY STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_category_style_section',
            [
                'label'     => __( 'Category', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('category_style_tabs');

                $this->start_controls_tab(
                    'category_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'category_typography',
                            'label'    => __( 'Typography', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a',
                        ]
                    );

                    $this->add_control(
                        'category_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'category_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'category_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );


                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'category_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'category_hover_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__category li a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'category_hover_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__category li a:hover',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        /*-----------------------
            CATEGORY STYLE END
        -------------------------*/

        /*-----------------------
            META STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' => __( 'Meta', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'meta_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post ul.post__meta li',
                ]
            );

            $this->add_control(
                'meta_color',
                [
                    'label'  => __( 'Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta'                           => 'color: {{VALUE}}',
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_align',
                [
                    'label'   => __( 'Alignment', 'element-ready-pro' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => __( 'Left', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /*-----------------------
            META STYLE END
        -------------------------*/

        /*-----------------------
            READMORE STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_readmore_style_section',
            [
                'label'     => __( 'Read More', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more_btn' => 'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'readmore_typography',
                            'label'    => __( 'Typography', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'readmore_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'readmore_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn',
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'readmore_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'readmore_hover_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------
            READMORE STYLE END
        -------------------------*/
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $postorder       = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'element_ready_posts_wrap__area_attr', 'class', 'element__ready__post__content__layout-'.$settings['content_layout_style'] );
        $this->add_render_attribute( 'element_ready_post_item_attr', 'class', 'element__ready__single__post element__ready__post__layout__'.$settings['content_layout_style'] );

        $this->add_render_attribute( 'element_ready_posts_container_attr', 'class', 'row quomodo-row' );
        if ( 'yes' == $settings['post_masonry'] ) {
            $this->add_render_attribute( 'element_ready_posts_container_attr', 'id', 'posts__masonry' );
        }

        // POST SLIDER OPTIONS
        /*if( $settings['slider_on'] == 'yes' ){
            $this->add_render_attribute( 'element_ready_posts_container_attr', 'class', 'element-ready-carousel-activation' );
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
            $this->add_render_attribute( 'element_ready_posts_container_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }*/


        // Query
        $args = array(
            'post_type'           => !empty( $settings['element_ready_post_type'] ) ? $settings['element_ready_post_type'] : 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'               => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        if( !empty($settings['element_ready_prod_categories']) ){
            $get_categories = $settings['element_ready_prod_categories'];
        }else{
            $get_categories = $settings['posts_categories'];
        }

        $get_posts_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($get_posts_cats) && count($get_posts_cats) > 0 ){
                $field_name         = is_numeric( $get_posts_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query']  = array(
                    array(
                        'taxonomy'         => ( $settings['element_ready_post_type'] == 'product' ) ? 'product_cat' : 'category',
                        'terms'            => $get_posts_cats,
                        'field'            => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

    
        $query_post  = get_posts( $args );
        $counter     = 1;
        $single_data = array_slice($query_post,0,1)[0];
        unset($query_post[0]);

        if ( is_array($query_post) ) {
            $chunk_data = array_chunk( $query_post, 2 );
        }else{
            $chunk_data = array();
        }

        ?>
            <div <?php echo $this->get_render_attribute_string( 'element_ready_posts_wrap__area_attr' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'element_ready_posts_container_attr' ); ?>>

                    <?php if ( $single_data ) : ?>
                        <div class="quomodo-col-sm-12 col-sm-12 quomodo-col-md-6 col-md-6 single__masonry__item">
                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_item_attr' ); ?> >
                                <?php $this->element_ready_post_thumbnail($single_data->ID); ?>
                                <div class="post__content">
                                    <div class="post__inner">
                                        <?php $this->element_ready_post_meta($single_data->ID); ?>
                                        <?php $this->element_ready_post_category($single_data->ID); ?>
                                        <?php $this->element_ready_post_title($single_data->ID); ?>
                                        <?php $this->element_ready_post_content($single_data->ID); ?>
                                        <?php $this->element_ready_post_readmore($single_data->ID); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if( $chunk_data ) : ?>

                        <div class="quomodo-col-md-6 col-md-6">

                            <?php foreach($chunk_data as $key=> $single):  ?>

                                <div class="quomodo-row">

                                    <?php foreach($single as $sl => $item): ?>

                                        <div class="quomodo-col-md-6 col-md-6">                               
                                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_item_attr' ); ?> >
                                                <?php if ( 'yes' == $settings['show_thumb'] && has_post_thumbnail($item->ID) ) : ?>
                                                    <div class="post__thumb">
                                                        <a href="<?php echo get_the_permalink($item->ID);?>"><?php echo get_the_post_thumbnail( $item->ID, 'element_ready_grid_small_thumb' ); ?></a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="post__content">
                                                    <div class="post__inner">
                                                        <?php $this->element_ready_post_meta($item->ID); ?>
                                                        <?php $this->element_ready_post_category($item->ID); ?>
                                                        <?php $this->element_ready_post_title($item->ID); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            <?php endforeach; ?>
                            
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        <?php
    }

    // Loop Content
    public function element_ready_render_loop_content( $contetntstyle = NULL ){
        $settings   = $this->get_settings_for_display(); ?>

            <?php if( $contetntstyle == 1 ) : ?>

            <?php endif; ?>

        <?php
    }

    // Time Ago Content
    public function element_ready_time_ago(){
        return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago','element-ready-pro' );
    }

    public function element_ready_post_thumbnail($get_post_id){

        $settings   = $this->get_settings_for_display();
        $thumb_link  = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( $get_post_id ), 'thumb_size', $settings );
        ?>
        <?php if ( 'yes' == $settings['show_thumb'] && has_post_thumbnail($get_post_id) ) : ?>
            <div class="post__thumb">
                <a href="<?php echo get_the_permalink($get_post_id);?>"><img src="<?php echo esc_url( $thumb_link ) ?>" alt="<?php echo get_the_title($get_post_id); ?>"></a>
            </div>
        <?php endif;
    }

    public function element_ready_post_category($get_post_id){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_category'] == 'yes' ): ?>
            <ul class="post__category">
                <?php
                    foreach ( get_the_category($get_post_id) as $category ) {
                        $term_link = get_term_link( $category );
                        ?>
                            <li><a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a></li>
                        <?php
                    }
                ?>
            </ul>
        <?php endif;
    }

    public function element_ready_post_title($get_post_id){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_title'] == 'yes' ):?>
            <h3 class="post__title"><a href="<?php echo get_the_permalink($get_post_id);?>"><?php echo wp_trim_words( get_the_title($get_post_id), $settings['title_length'], '' ); ?></a></h3>
        <?php endif;
    }

    public function element_ready_post_content($get_post_id){
        $settings   = $this->get_settings_for_display();
        if( $settings['show_content'] == 'yes' ){
            echo '<p>'.wp_trim_words( get_the_content($get_post_id), $settings['content_length'], '' ).'</p>'; 
        }
    }

    public function element_ready_post_meta(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
            <ul class="post__meta">

                <?php if( $settings['show_author'] == 'yes' ): ?>
                    <li><i class="fa fa-user-circle"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author();?></a></li>
                <?php endif; ?>

                <?php if( $settings['show_date'] == 'yes' ):?>

                    <?php if( 'date'== $settings['date_type'] ) : ?>                                
                    <li><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','element-ready-pro'));?></li>
                    <?php endif; ?>

                    <?php if( 'time'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php the_time(); ?></li>
                    <?php endif; ?>

                    <?php if( 'time_ago'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php echo $this->element_ready_time_ago(); ?></li>
                    <?php endif; ?>
                    
                    <?php if( 'date_time'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php echo get_the_time( 'd F y - D g:i:a' ) ?></li>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>
        <?php endif;
    }

    public function element_ready_post_readmore($get_post_id){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_read_more_btn'] == 'yes' ): ?>
            <div class="post__btn">
                <?php if ( !empty( $settings['readmore_icon'] ) ) : ?>
                    <?php if( 'right'  == $settings['readmore_icon_position'] ) : ?>
                        <a class="readmore__btn" href="<?php echo get_the_permalink($get_post_id);?>"><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?> <i class="readmore_icon_right <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i></a>
                    <?php elseif( 'left'  == $settings['readmore_icon_position'] ): ?>
                        <a class="readmore__btn" href="<?php echo get_the_permalink($get_post_id);?>"><i class="readmore_icon_left <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="readmore__btn" href="<?php echo get_the_permalink($get_post_id);?>"><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?></a>
                <?php endif; ?>
            </div>
        <?php endif;
    }

}