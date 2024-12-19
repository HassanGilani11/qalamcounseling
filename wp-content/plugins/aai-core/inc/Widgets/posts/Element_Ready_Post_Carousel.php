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
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Ready_Post_Carousel extends Widget_Base {
    use \Elementor\Element_Ready_Box_Style;
    use \Elementor\Element_Ready_Common_Style;
    public function get_name() {
        return 'Element_Ready_Post_Carousel';
    }
    
    public function get_title() {
        return __( 'ER Post Carousel', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'Carousel', 'Post Carousel', 'Slider', 'post', 'blog' ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'element-ready-core',
        ];
    }

    public function get_style_depends() {
        wp_register_style( 'eready-post-blog' , ELEMENT_READY_ROOT_CSS. 'widgets/blog.css' );
        return[
            'slick','eready-post-blog'
        ];
    }

    static function content_layout_style(){
        return[
            '1' => __( 'Layout One', 'element-ready-pro' ),
            '2' => __( 'Layout Two', 'element-ready-pro' ),
            '3' => __( 'Layout Three', 'element-ready-pro' ),
            '4' => __( 'Layout Four', 'element-ready-pro' ),
            '5' => __( 'Layout Five', 'element-ready-pro' ),
            '6' => __( 'Layout Six', 'element-ready-pro' ),
            '7' => __( 'Layout Seven', 'element-ready-pro' ),
            '8' => __( 'Layout Eight', 'element-ready-pro' ),
            '9' => __( 'Layout Nine', 'element-ready-pro' ),
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
            'post_carousel_content',
            [
                'label' => __( 'Post carousel', 'element-ready-pro' ),
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
                'slider_on',
                [
                    'label'        => __( 'Carousel', 'element-ready-pro' ),
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
                'carousel_post_type',
                [
                    'label'       => esc_html__( 'Content Sourse', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options'     => self::element_ready_get_post_types(),
                ]
            );

            $this->add_control(
                'carousel_categories',
                [
                    'label'       => esc_html__( 'Categories', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::element_ready_get_taxonomies(),
                    'condition'   => [
                        'carousel_post_type' => 'post',
                    ]
                ]
            );

            $this->add_control(
                'carousel_prod_categories',
                [
                    'label'       => esc_html__( 'Categories', 'element-ready-pro' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::element_ready_get_taxonomies('product_cat'),
                    'condition'   => [
                        'carousel_post_type' => 'product',
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
                'inline_date',
                [
                    'label'        => esc_html__( 'Inline Date with category', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'condition' => [
                        'content_layout_style' => ['5']
                    ]
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
                'date_format',
                [
                    'label'   => esc_html__( 'Date Format', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'M d, Y',
                    'options' => [
                        'M d, Y'       => esc_html__('Nov 06, 2014','element-ready-pro'),
                        'F d, Y'       => esc_html__('November 06, 2014','element-ready-pro'),
                        'd M Y'        => esc_html__('01 Nov 2014','element-ready-pro'),
                        'd F Y'        => esc_html__('01 November 2014','element-ready-pro'),
                        'M d'          => esc_html__('Nov 01','element-ready-pro'),
                        'd M'          => esc_html__('01 Nov','element-ready-pro'),
                        'F d'          => esc_html__('November 01','element-ready-pro'),
                        
                        'F jS, Y'      => esc_html__('November 6th, 2014','element-ready-pro'),
                        'M jS, Y'      => esc_html__('Nov 6th, 2014','element-ready-pro'),
                        
                        'jS F, Y'      => esc_html__('6th November, 2014','element-ready-pro'),
                        'jS M, Y'      => esc_html__('6th Nov, 2014','element-ready-pro'),
                        
                        'l, F jS, Y'   => esc_html__('Thursday, November 6th, 2014','element-ready-pro'),
                        'D, F jS, Y'   => esc_html__('Thu, November 6th, 2014','element-ready-pro'),

                        'F j, Y g:i a' => esc_html__('November 6, 2010 12:50 am','element-ready-pro'),
                        'M j, Y g:i a' => esc_html__('Nov 6, 2010 12:50 am','element-ready-pro'),
                    ],
                    'condition' => [
                        'show_date' => 'yes',
                        'date_type' => 'date',
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
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'max' => 999,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
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

        $this->end_controls_section();

        $this->start_controls_section(
            'er_post_carousel_meta_icon',
            [
                'label' => __( 'Meta Icons', 'element-ready-pro' ),
            ]
        );
         
            $this->add_control(
                'author_icon',
                [ 
                    'label' => esc_html__( 'Author Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                ]
            );

            $this->add_control(
                'cat_icon',
                [
                    'label' => esc_html__( 'Category Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                ]
            );

            $this->add_control(
                'date_icon',
                [
                    'label' => esc_html__( 'Date Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                ]
            );

            $this->add_control(
                'comment_icon',
                [
                    'label' => esc_html__( 'Comment Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_widget_sort_item_section',
            [
                
                'label' => esc_html__( 'Sort Content', 'element-ready-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
          );
   
          $this->add_control(
            'er_meta_order',
            [
              'label'   => esc_html__( 'Meta', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__inner .post__meta' => 'order: {{VALUE}};',
             
              ],
               'condition' => [
                 'content_layout_style!' => ['5','6']
               ]
            ]
          ); 
          
          $this->add_control(
            'er_meta_cat_order',
            [
              'label'   => esc_html__( 'Meta Category', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__inner .er-qs-post-meta-cat' => 'order: {{VALUE}};',
             
              ],
            //   'condition' => [
            //     'content_layout_style' => ['1']
            //   ]
            ]
          );

          $this->add_control(
            'er_meta_date_order',
            [
              'label'   => esc_html__( 'Meta Date', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__inner .er-qs-post-meta-date' => 'order: {{VALUE}};',
             
              ],
              'condition' => [
                'content_layout_style' => ['5']
              ]
            ]
          );
          
          $this->add_control(
            'er_meta_author_order',
            [
              'label'   => esc_html__( 'Meta Author', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__inner .post__author__meta' => 'order: {{VALUE}};',
             
              ],
              'condition' => [
                'content_layout_style' => ['5']
              ]
            ]
          );
   
          $this->add_control(
            'er_title_order',
            [
              'label'   => esc_html__( 'Title', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__title' => 'order: {{VALUE}};',
             
              ],
              'condition' => [
                'content_layout_style!' => ['8']
              ]
            ]
          );
   
          $this->add_control(
            'er_content_order',
            [
              'label'   => esc_html__( 'Content', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__inner p' => 'order: {{VALUE}};',
             
              ],
            ]
          );
   
          $this->add_control(
            'er_readmore_order',
            [
              'label'   => esc_html__( 'Readmore', 'element-ready-pro' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => -100,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .post__btn' => 'order: {{VALUE}};',
             
              ],
            ]
          );
   
        $this->end_controls_section();

        $this->box_css(
            array(
               'title' => esc_html__('Inner Content','element-ready-pro'),
               'slug' => '_innerr_content_box_box_style',
               'element_name' => 'innerr_content_box_element_ready_',
               'selector' => '{{WRAPPER}} .post__inner',
              
            )
         );
       
      
        $this->box_css(
            array(
               'title' => esc_html__('Author Box','element-ready-pro'),
               'slug' => '_athor_content_box_box_style',
               'element_name' => 'authjor_content_box_element_ready_',
               'selector' => '{{WRAPPER}} .post__author__thumb__link',
               'condition' => [
                'content_layout_style' => ['5']
            ]
            )
         );
   
           $this->text_wrapper_css(
                  array(
                     'title' => esc_html__('Author name','element-ready-pro'),
                     'slug' => 'post_author_style',
                     'element_name' => 'post_aithor_element_ready_',
                     'selector' => '{{WRAPPER}} .post__author__thumb__link .author__link',
                     'hover_selector' => false,
                     'condition' => [
                        'content_layout_style' => ['5']
                    ]
                  )
            );
   
        /*-----------------------------------
            CONTENT OPTION END
        ------------------------------------*/

        /*----------------------------------
            CAROUSEL SETTING
        ------------------------------------*/
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
                    'min'       => 1,
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
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post' => 'margin: calc( {{VALUE}}px / 2 );',
                        '{{WRAPPER}} .slick-list' => 'margin: calc( -{{VALUE}}px / 2 );',
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
                        'inside_vertical_center_nav'  => __( 'Inside Vertical Center', 'element-ready-pro' ),
                        'outside_vertical_center_nav' => __( 'Outside Vertical Center', 'element-ready-pro' ),
                        'top_left_nav'                => __( 'Top Left', 'element-ready-pro' ),
                        'top_center_nav'              => __( 'Top Center', 'element-ready-pro' ),
                        'top_right_nav'               => __( 'Top Right', 'element-ready-pro' ),
                        'bottom_left_nav'             => __( 'Bottom Left', 'element-ready-pro' ),
                        'bottom_center_nav'           => __( 'Bottom Center', 'element-ready-pro' ),
                        'bottom_right_nav'            => __( 'Bottom Right', 'element-ready-pro' ),
                    ],
                    'condition' => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label'     => __( 'Previous icon', 'element-ready-pro' ),
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
                    'label'     => __( 'Next icon', 'element-ready-pro' ),
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
                    'label'   => __( 'Arrow Visibility', 'element-ready-pro' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'visibility:visible;opacity:1;',
                    'default'   => 'no',
                    'selectors'  => [
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
                    'label_off'    => __('No', 'element-ready-pro'),
                    'label_on'     => __('Yes', 'element-ready-pro'),
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'label'        => __('Pause on Hover?', 'element-ready-pro'),
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
                    'label'     => __('Autoplay speed', 'element-ready-pro'),
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
                    'label'     => __('Autoplay animation speed', 'element-ready-pro'),
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
                    'label'     => __('Slider item to scroll', 'element-ready-pro'),
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
                    'label'     => __( 'Tablet', 'element-ready-pro' ),
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
                    'label'     => __('Slider Items', 'element-ready-pro'),
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
                    'label'     => __('Slider item to scroll', 'element-ready-pro'),
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
                    'label'       => __('Tablet Resolution', 'element-ready-pro'),
                    'description' => __('The resolution to tablet.', 'element-ready-pro'),
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
                    'label'     => __( 'Mobile Phone', 'element-ready-pro' ),
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
                    'label'     => __('Slider Items', 'element-ready-pro'),
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
                    'label'     => __('Slider item to scroll', 'element-ready-pro'),
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
                    'label'       => __('Mobile Resolution', 'element-ready-pro'),
                    'description' => __('The resolution to mobile.', 'element-ready-pro'),
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

        /*-----------------------
            AREA STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_content_area',
            [
                'label'     => __( 'Content Area Style', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'width',
                [
                    'label' => __( 'Width', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'area_padding',
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
                'area_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            AREA STYLE END
        -------------------------*/

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
                            'icon'  => ' eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => ' eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'element-ready-pro' ),
                            'icon'  => ' eicon-text-align-justify',
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
            THUMBNAIL STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_thumbnail_style_section',
            [
                'label'     => __( 'Thumbnail', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_thumb' => 'yes',
                ]
            ]
        );
            $this->start_controls_tabs('thumbnail_style_tabs');
                $this->start_controls_tab(
                    'thumbnail_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'thumbnail_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__thumb' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'thumbnail_typography',
                            'label'    => __( 'Typography', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__thumb',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'thumbnail_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__thumb',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'thumbnail_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__thumb',
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post .post__thumb,{{WRAPPER}} .element__ready__single__post .post__thumb img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'thumbnail_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__thumb',
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'thumbnail_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'thumbnail_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'thumbnail_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post:hover .post__thumb',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'thumbnail_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__single__post:hover .post__thumb',
                        ]
                    );
                    $this->add_responsive_control(
                        'thumbnail_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__single__post:hover .post__thumb img,{{WRAPPER}} .element__ready__single__post:hover .post__thumb' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'thumbnail_hover_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__single__post:hover .post__thumb',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------
            THUMBNAIL STYLE END
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
                        '{{WRAPPER}} .element__ready__single__post .post__title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label'  => __( 'Hover Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post .post__title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'title_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post .post__title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__single__post .post__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .element__ready__single__post .post__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'icon'  => ' eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => ' eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'element-ready-pro' ),
                            'icon'  => ' eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post .post__title' => 'text-align: {{VALUE}};',
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
        $this->start_controls_section(
            'post_slider_comment_icon_style_section',
            [
                'label'     => __( 'Comment', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_layout_style' => '7',
                ]
            ]
        );

        $this->add_control(
            'comment_color',
            [
                'label'  => __( 'Color', 'element-ready-pro' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments__count'=> 'color: {{VALUE}}',
                   
                ],
            ]
        );

     

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'comment_typography',
                'label'    => __( 'Comment Typography', 'element-ready-pro' ),
                'selector' => '{{WRAPPER}} .comments__count',
            ]
        );

        $this->add_control(
			'comment_padding',
			[
				'label' => esc_html__( 'Content Padding', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .comments__count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'comment_icon_color',
            [
                'label'  => __( 'Icon Color', 'element-ready-pro' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments__count .comment--er--icon'=> 'color: {{VALUE}}',
                   
                ],
            ]
        );

        
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'comment_icon_typography',
                'label'    => __( 'Icon Typography', 'element-ready-pro' ),
                'selector' => '{{WRAPPER}} .comments__count .comment--er--icon',
            ]
        );

        $this->add_control(
			'comment_icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .comments__count .comment--er--icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        /*-----------------------
            CATEGORY STYLE END
        -------------------------*/
        $this->box_css(
            array(
               'title' => esc_html__('Date Category Wrapper','element-ready-pro'),
               'slug' => 'item_cate_cat_box_style',
               'element_name' => 'item_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .element-raedy-date-cat-inline,{{WRAPPER}} .element__ready__single__post.element__ready__post__layout__5',
               'condition' => [
                'content_layout_style' => ['5']
            ]
            )
        );
        
        $this->box_css(
            array(
               'title' => esc_html__('Date Wrapper','element-ready-pro'),
               'slug' => 'item_cate_wrapper_box_style',
               'element_name' => 'item_date_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .er-qs-post-meta-date',
               'condition' => [
                'content_layout_style' => ['5','6']
            ]
            )
        );
        
        $this->box_css(
            array(
               'title' => esc_html__('Category Wrapper','element-ready-pro'),
               'slug' => 'item_at_wrapper_box_style',
               'element_name' => 'item_cat_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .er-qs-post-meta-cat',
               'condition' => [
                'content_layout_style' => ['6']
            ]
            )
        );
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
            $this->add_control(
                'meta_color',
                [
                    'label'  => __( 'Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta'=> 'color: {{VALUE}}',
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'meta_icon_color',
                [
                    'label'  => __( 'Icon Color', 'element-ready-pro' ),
                    'type'   => Controls_Manager::COLOR,
                    'selectors' => [

                        '{{WRAPPER}} .element__ready__single__post ul.post__meta i' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'meta_typography',
                    'label'    => __( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post ul.post__meta li,.element__ready__single__post .post__author__thumb__link a',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'meta_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .element__ready__single__post ul.post__meta',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'meta_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__single__post ul.post__meta',
                ]
            );
            $this->add_responsive_control(
                'meta_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__single__post ul.post__meta' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-justify',
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

                $this->add_responsive_control(
                    '_section___section_show_hide_float',
                    [
                        'label' => esc_html__( 'Float', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'left'    => esc_html__( 'Left', 'element-ready-pro' ),
                            'right'   => esc_html__( 'Right', 'element-ready-pro' ),
                            'inherit' => esc_html__( 'inherit', 'element-ready-pro' ),
                        ],
                        'selectors' => [
                           '{{WRAPPER}} .post__btn'=> 'float: {{VALUE}};'
                      ],
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
                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__single__post .post__btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                $this->end_controls_tab();
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
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_hover_after_background',
                            'label'    => __( 'After Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__single__post .post__btn a.readmore__btn:hover:after',
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

        /*----------------------------
            SLIDER NAV WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_control_warp_style_section',
            [
                'label' => __( 'Slider Arrow Warp', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'slider_nav_warp_background',
                'label'    => __( 'Background', 'element-ready-pro' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'slider_nav_warp_border',
                'label'    => __( 'Border', 'element-ready-pro' ),
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Border Radius
        $this->add_control(
            'slider_nav_warp_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'slider_nav_warp_shadow',
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Display;
        $this->add_responsive_control(
            'slider_nav_warp_display',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
                ],
            ]
        );

        // Before Postion
        $this->add_responsive_control(
            'slider_nav_warp_position',
            [
                'label'   => __( 'Position', 'element-ready-pro' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                
                'options' => [
                    'initial'  => __( 'Initial', 'element-ready-pro' ),
                    'absolute' => __( 'Absulute', 'element-ready-pro' ),
                    'relative' => __( 'Relative', 'element-ready-pro' ),
                    'static'   => __( 'Static', 'element-ready-pro' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
                ],
            ]
        );

        // Postion From Left
        $this->add_responsive_control(
            'slider_nav_warp_position_from_left',
            [
                'label'      => __( 'From Left', 'element-ready-pro' ),
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

        // Postion From Right
        $this->add_responsive_control(
            'slider_nav_warp_position_from_right',
            [
                'label'      => __( 'From Right', 'element-ready-pro' ),
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

        // Postion From Top
        $this->add_responsive_control(
            'slider_nav_warp_position_from_top',
            [
                'label'      => __( 'From Top', 'element-ready-pro' ),
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

        // Postion From Bottom
        $this->add_responsive_control(
            'slider_nav_warp_position_from_bottom',
            [
                'label'      => __( 'From Bottom', 'element-ready-pro' ),
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

        // Align
        $this->add_responsive_control(
            'slider_nav_warp_align',
            [
                'label'   => __( 'Alignment', 'element-ready-pro' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'element-ready-pro' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'element-ready-pro' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'element-ready-pro' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'element-ready-pro' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
                ],
                'default' => '',
            ]
        );

        // Width
        $this->add_responsive_control(
            'slider_nav_warp_width',
            [
                'label'      => __( 'Width', 'element-ready-pro' ),
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

        // Height
        $this->add_responsive_control(
            'slider_nav_warp_height',
            [
                'label'      => __( 'Height', 'element-ready-pro' ),
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

        // Opacity
        $this->add_control(
            'slider_nav_warp_opacity',
            [
                'label' => __( 'Opacity', 'element-ready-pro' ),
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

        // Z-Index
        $this->add_control(
            'slider_nav_warp_zindex',
            [
                'label'     => __( 'Z-Index', 'element-ready-pro' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -99,
                'max'       => 99,
                'step'      => 1,
                'selectors' => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'slider_nav_warp_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'slider_nav_warp_padding',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
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
                'label'     => __( 'Arrow', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
                            'type'   => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label'      => __( 'Font Size', 'element-ready-pro' ),
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
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
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
                            'label'      => __( 'Height', 'element-ready-pro' ),
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
                            'label'      => __( 'Width', 'element-ready-pro' ),
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
                        'slider_arrow_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_position_from_left',
                        [
                            'label'      => __( 'Left Arrow Position From Left', 'element-ready-pro' ),
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

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_position_from_bottom',
                        [
                            'label'      => __( 'Left Arrow Position From Top', 'element-ready-pro' ),
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


                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_position_from_right',
                        [
                            'label'      => __( 'Right Arrow Position From Right', 'element-ready-pro' ),
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

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_position_from_top',
                        [
                            'label'      => __( 'Right Arrow Position From Top', 'element-ready-pro' ),
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

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label'  => __( 'Color', 'element-ready-pro' ),
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
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
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

                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_left',
                        [
                            'label'      => __( 'Left Arrow Position From Left', 'element-ready-pro' ),
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

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_bottom',
                        [
                            'label'      => __( 'Left Arrow Position From Top', 'element-ready-pro' ),
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


                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_right',
                        [
                            'label'      => __( 'Right Arrow Position From Right', 'element-ready-pro' ),
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

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_top',
                        [
                            'label'      => __( 'Right Arrow Position From Top', 'element-ready-pro' ),
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

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Slider arrow style end
        /*------------------------
             ARROW STYLE END
        --------------------------*/

        /*------------------------
             DOTS STYLE
        --------------------------*/
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label'     => __( 'Pagination', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'sldots'  => 'yes',
                ],
            ]
        );
            
            $this->start_controls_tabs('pagination_style_tabs');

                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
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
                            'label'      => __( 'Width', 'element-ready-pro' ),
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
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
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
                            'label'    => __( 'Border', 'element-ready-pro' ),
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
                            'label'      => __( 'Pagination Warp Margin', 'element-ready-pro' ),
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
                            'label'   => __( 'Pagination Warp Alignment', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'element-ready-pro' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'element-ready-pro' ),
                                    'icon'  => 'eicon-text-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'element-ready-pro' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
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

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        /*------------------------
             DOTS STYLE END
        --------------------------*/

    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $postorder       = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'element_ready_post_carousel', 'class', 'sldier-content-area element__ready__post__content__layout-'.$settings['content_layout_style']. ' '.$settings['nav_position'] );

        $this->add_render_attribute( 'element_ready_post_slider_item_attr', 'class', 'element__ready__single__post element__ready__post__layout__'.$settings['content_layout_style'] );


        // Slider options
        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'element_ready_post_slider_attr', 'class', 'element-ready-carousel-activation' );

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

            $this->add_render_attribute( 'element_ready_post_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }

    

        if( is_search() || element_ready_lite_is_blog() ){

            global $wp_query;
            $carousel_post = $wp_query;
            
        }else{

                // Query
                $args = array(
                    'post_type'           => !empty( $settings['carousel_post_type'] ) ? $settings['carousel_post_type'] : 'post',
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
                    'order'               => $postorder
                );

                // Custom Order
                if( $custom_order_ck == 'yes' ){
                    $args['orderby']    = $orderby;
                }

                if( !empty($settings['carousel_prod_categories']) ){
                    $get_categories = $settings['carousel_prod_categories'];
                }else{
                    $get_categories = $settings['carousel_categories'];
                }

                $carousel_cats = str_replace(' ', '', $get_categories);

                if (  !empty( $get_categories ) ) {
                    if( is_array($carousel_cats) && count($carousel_cats) > 0 ){
                        $field_name         = is_numeric( $carousel_cats[0] ) ? 'term_id' : 'slug';
                        $args['tax_query']  = array(
                            array(
                                'taxonomy'         => ( $settings['carousel_post_type'] == 'product' ) ? 'product_cat' : 'category',
                                'terms'            => $carousel_cats,
                                'field'            => $field_name,
                                'include_children' => false
                            )
                        );
                    }
                }

                $carousel_post = new \WP_Query( $args );

          }
        ?>
            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_carousel' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_attr' ); ?>>

                    <?php
                        if( $carousel_post->have_posts() ):
                        while( $carousel_post->have_posts() ): $carousel_post->the_post();
                    ?>

                        <?php if( $settings['content_layout_style'] == 1 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 1 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 2 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <div class="post__carousel__flex">
                                    <?php $this->element_ready_render_loop_content( 1 ); ?>
                                </div>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 4 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 4 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 5 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 5 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 6 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 6 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 7 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 7 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 8 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 8 ); ?>
                            </div>

                        <?php elseif( $settings['content_layout_style'] == 9 ): ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 9 ); ?>
                            </div>

                        <?php else: ?>

                            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_item_attr' ); ?> >
                                <?php $this->element_ready_render_loop_content( 1 ); ?>
                            </div>

                        <?php endif;?>

                    <?php endwhile; wp_reset_postdata(); wp_reset_query(); endif; ?>

                </div>

                <?php if( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) : ?>

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

    // Loop Content
    public function element_ready_render_loop_content( $contetntstyle = NULL ){
        $settings   = $this->get_settings_for_display(); ?>
           
            <?php if( $contetntstyle == 1 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                    <div class="post__inner">
                        <?php $this->element_ready_post_category(); ?>
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_meta(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 4 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                    <div class="post__inner">
                        <?php $this->element_ready_post_category(); ?>
                        <?php $this->element_ready_post_meta(); ?>
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 5 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content er-posr-qs">
                    <div class="post__inner">
                        <?php echo $settings['inline_date'] == 'yes'?'<div class="element-raedy-date-cat-inline">':''; ?>
                            <?php $this->element_ready_post_category(); ?>
                            <?php $this->element_ready_post_date(); ?>
                        <?php echo $settings['inline_date'] == 'yes'?'</div>':''; ?>
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_author(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 6 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                    <div class="post__inner">
                        <?php $this->element_ready_post_date(); ?>
                        <?php $this->element_ready_post_category(); ?>
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 7 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                    <div class="post__inner">
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_author_comments_date_meta(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 8 ) : ?>
                <?php $this->element_ready_post_title(); ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                        <?php $this->element_ready_only_date(); ?>
                    <div class="post__inner">
                        <?php $this->element_ready_post_category(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php elseif( $contetntstyle == 9 ) : ?>
                <?php $this->element_ready_post_thumbnail(); ?>
                <div class="post__content">
                        <?php $this->element_ready_only_date(); ?>
                    <div class="post__inner">
                        <?php $this->element_ready_post_category(); ?>
                        <?php $this->element_ready_post_title(); ?>
                        <?php $this->element_ready_post_content(); ?>
                        <?php $this->element_ready_post_readmore(); ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php
    }

    public function element_ready_time_ago() {
        return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago','element-ready-pro' );
    }

    public function element_ready_post_thumbnail(){
        global $post;
        $settings   = $this->get_settings_for_display();
        $thumb_link  = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_size', $settings );
        ?>
        <?php if ( 'yes' == $settings['show_thumb'] && has_post_thumbnail() ) : ?>
            <div class="post__thumb">
                <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $thumb_link ) ?>" alt="<?php the_title(); ?>"></a>
            </div>
        <?php endif;
    }

    public function element_ready_post_category(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_category'] == 'yes' ): ?>
            <ul class="post__category er-qs-post-meta-cat">
                <?php
                    foreach ( get_the_category() as $category ) {
                        $term_link = get_term_link( $category );
                        ?>
                            <li><a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a></li>
                        <?php
                    }
                ?>
            </ul>
        <?php endif;
    }

    public function element_ready_post_title(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_title'] == 'yes' ):?>
            <h3 class="post__title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h3>
        <?php endif;
    }

    public function element_ready_post_content(){
        $settings   = $this->get_settings_for_display();
        if( $settings['show_content'] == 'yes' ){
            echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>'; 
        }
    }

    public function element_ready_post_meta(){
        $settings   = $this->get_settings_for_display(); 
        $date_icon =  element_ready_render_icons( $settings['date_icon'] , 'date--er--icon' );
        $author_icon =  element_ready_render_icons( $settings['author_icon'] , 'author--er--icon' );
        ?>
        <?php if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
            <ul class="post__meta">

                <?php if( $settings['show_author'] == 'yes' ): ?>
                    <li>
                         <?php echo $author_icon; ?>
                         <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author();?></a>
                    </li>
                <?php endif; ?>

                <?php if( $settings['show_date'] == 'yes' ): ?>
                    <?php if( 'date' == $settings['date_type'] ) : ?>                                
                    <li>
                         <?php echo $date_icon; ?>
                        <?php the_time($settings['date_format']);?></li>
                    <?php endif; ?>

                    <?php if( 'time' == $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?>
                        <?php the_time(); ?></li>
                    <?php endif; ?>

                    <?php if( 'time_ago' == $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?> 
                        <?php echo $this->element_ready_time_ago(); ?></li>
                    <?php endif; ?>
                    
                    <?php if( 'date_time' == $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?> 
                        <?php echo get_the_time( 'd F y - D g:i:a' ) ?></li>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>
        <?php endif;
    }

    public function element_ready_post_date(){
        $settings   = $this->get_settings_for_display();
        $date_icon =  element_ready_render_icons( $settings['date_icon'] , 'date--er--icon' );
        $author_icon =  element_ready_render_icons( $settings['author_icon'] , 'author--er--icon' );
        ?>
        <?php if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
            <ul class="post__meta er-qs-post-meta-date">
                <?php if( $settings['show_date'] == 'yes' ):?>

                    <?php if( 'date'== $settings['date_type'] ) : ?>                                
                    <li>
                        <?php echo $date_icon; ?>
                        <?php the_time($settings['date_format']);?></li>
                    <?php endif; ?>

                    <?php if( 'time'== $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?>
                        <?php the_time(); ?></li>
                    <?php endif; ?>

                    <?php if( 'time_ago'== $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?>
                        <?php echo $this->element_ready_time_ago(); ?></li>
                    <?php endif; ?>
                    
                    <?php if( 'date_time'== $settings['date_type'] ) : ?>
                    <li>
                        <?php echo $date_icon; ?>
                        <?php echo get_the_time( 'd F y - D g:i:a' ) ?></li>
                    <?php endif; ?>

                <?php endif; ?>
            </ul>
        <?php endif;
    }

    public function element_ready_post_author(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_author'] == 'yes' ): ?>
        <div class="post__author__meta post__meta">
            <div class="post__author__thumb__link">
                <a class="post__author__thumb" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'email' ) ) ); ?>" alt="<?php the_author(); ?>"></a>
                <a class="author__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
            </div>
        </div>
        <?php endif; ?>
        <?php
    }

    public function element_ready_post_readmore(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_read_more_btn'] == 'yes' ): ?>
            <div class="post__btn">
                <?php if ( !empty( $settings['readmore_icon'] ) ) : ?>
                    <?php if( 'right'  == $settings['readmore_icon_position'] ) : ?>
                        <a class="readmore__btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?> <i class="readmore_icon_right <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i></a>
                    <?php elseif( 'left'  == $settings['readmore_icon_position'] ): ?>
                        <a class="readmore__btn" href="<?php the_permalink();?>"><i class="readmore_icon_left <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="readmore__btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'element-ready-pro' );?></a>
                <?php endif; ?>
            </div>
        <?php endif;
    }

    public function element_ready_post_author_comments_date_meta(){
        $settings   = $this->get_settings_for_display(); ?>
        <div class="post__author__comments_date__meta">
            <?php if( $settings['show_author'] == 'yes' ): ?>
            <a class="post__author__thumb" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'email' ) ) ); ?>" alt="<?php the_author(); ?>"></a>
            <div class="post__author__meta post__meta">
                <a class="author__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
                <div class="comments__counts__meta">
                    <?php $this->element_ready_only_date(); ?>|
                    <?php $this->element_ready_comment_count(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }

    public function element_ready_only_date(){

        $settings = $this->get_settings_for_display();
        $date_icon =  element_ready_render_icons( $settings['date_icon'] , 'date--er--icon' );
       
        ?>
        <?php if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
            <ul class="post__meta">
                <?php if( $settings['show_date'] == 'yes' ):?>

                    <?php if( 'date'== $settings['date_type'] ) : ?>                                
                    <li>
                        <?php echo $date_icon; ?>
                        <?php the_time($settings['date_format']);?>
                    </li>
                    <?php endif; ?>

                    <?php if( 'time' == $settings[ 'date_type' ] ) : ?>
                    <li>
                    <?php echo $date_icon; ?>
                        <?php the_time(); ?>
                    </li>
                    <?php endif; ?>

                    <?php if( 'time_ago'== $settings['date_type'] ) : ?>
                    <li>
                    <?php echo $date_icon; ?>
                        <?php echo $this->element_ready_time_ago(); ?>
                    </li>
                    <?php endif; ?>
                    
                    <?php if( 'date_time'== $settings['date_type'] ) : ?>
                    <li>
                    <?php echo $date_icon; ?>
                        <?php echo get_the_time( 'd F y - D g:i:a' ) ?>
                    </li>
                    <?php endif; ?>

                <?php endif; ?>
            </ul>
        <?php endif;
    }

    public function element_ready_comment_count(){
        $settings = $this->get_settings_for_display();
        $comment_icon = element_ready_render_icons( $settings['comment_icon'] , 'comment--er--icon' );

        if (! post_password_required() && ( comments_open() || get_comments_number() ) ) { 
            $comment_count = get_comments_number_text(esc_html__('No comment','themespace'),esc_html__('1 Comment','themespace'),esc_html__('% Comments','themespace'));
            echo '<div class="comments__count">'. $comment_icon .$comment_count.'</div>';
        }
    }

}