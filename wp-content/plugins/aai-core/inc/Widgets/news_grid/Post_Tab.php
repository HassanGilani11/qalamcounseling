<?php
namespace Element_Ready_Pro\Widgets\news_grid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );

if ( ! defined( 'ABSPATH' ) ) exit;

class Post_Tab extends Widget_Base {

   use \Elementor\Element_Ready_Common_Style;
   use \Elementor\Element_ready_common_content;
   use \Elementor\Element_Ready_Box_Style;
	public function get_name() {
		return 'element-ready-news-post-tab';
	}

	public function get_title() {
		return esc_html__( 'ER Post tab', 'element-ready-pro' );
	}

	public function get_icon() {
		return "eicon-tabs";
	}

	public function get_categories() {
		return [ 'element-ready-pro' ];
    }
   
    public function get_style_depends(){
            
        return [
            'element-ready-news-grid',

        ];
    }
    
    public function get_script_depends() {
        return [
            'element-ready-core',
        ];
    }

	protected function register_controls() {
        
        $this->start_controls_section(
            'section_layouts_tab',
            [
                'label' => esc_html__('Layout', 'element-ready-pro'),
            ]
        );

                $this->add_control(
                    'block_style',
                    [
                        'label' => esc_html__( 'Style', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'style1',
                        'options' => [
                            'style1' => esc_html__( 'Style 1', 'element-ready-pro' ),
                            'style2' => esc_html__( 'Style 2', 'element-ready-pro' )
                        ],
                    ]
                );

       $this->end_controls_section();
      $this->start_controls_section(
         'section_tab',
         [
             'label' => esc_html__('Post', 'element-ready-pro'),
         ]
     );
   
            $this->add_control(
                'post_count',
                [
                'label'   => esc_html__( 'Post count', 'element-ready-pro' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '8',
                ]
            );
            
            $this->add_control(
                'post_title_crop',
                [
                    'label'   => esc_html__( 'Post title crop', 'element-ready-pro' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => '50',
                ]
            );    

            $this->add_control(
                'show_image',
                [
                    'label'     => esc_html__('Show image', 'element-ready-pro'),
                    'type'      => Controls_Manager::SWITCHER,
                    'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                    'label_off' => esc_html__('No', 'element-ready-pro'),
                    'default'   => 'yes',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'label'        => esc_html__( 'Thumb Size', 'element-ready-pro' ),
                    'name'    =>'thumb_size',
                    'default' => 'large',
                    'condition' => [
                        'show_image' => 'yes',
                    ]
                ]
            );


        

            $this->add_control(
               'show_post_meta',
               [
                   'label'     => esc_html__('Show Meta', 'element-ready-pro'),
                   'type'      => Controls_Manager::SWITCHER,
                   'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                   'label_off' => esc_html__('No', 'element-ready-pro'),
                   'default'   => 'yes',
               ]
             );
            $this->add_control(
                    'show_author',
                    [
                        'label'     => esc_html__('Show Author', 'element-ready-pro'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                        'label_off' => esc_html__('No', 'element-ready-pro'),
                        'default'   => 'no',
                    ]
            );

            $this->add_control(
                'show_author_avator',
                    [
                        'label'     => esc_html__('Show Author image', 'element-ready-pro'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                        'label_off' => esc_html__('No', 'element-ready-pro'),
                        'default'   => 'no',
                    ]
            );
    
            $this->add_responsive_control(
                'author_avator_custom_dimension',
                [
                    'label' => esc_html__( 'Avatar image size', 'element-ready-pro' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                        'min' => 0,
                        'max' => 100,
                        ],
                    ],
                    'condition'       => [ 'show_author_avator' => ['yes'] ],
                    'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => 45,
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'size' => 45,
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'size' => 45,
                        'unit' => 'px',
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 45,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .author-avatar img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                    
                    ],
                ]
            ); 


            $this->add_control(
                    'show_date',
                    [
                        'label'     => esc_html__('Show Date', 'element-ready-pro'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                        'label_off' => esc_html__('No', 'element-ready-pro'),
                        'default'   => 'yes',
                    ]
            );

            $this->add_control(
                'show_cat',
                [
                    'label'     => esc_html__('Show Category', 'element-ready-pro'),
                    'type'      => Controls_Manager::SWITCHER,
                    'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                    'label_off' => esc_html__('No', 'element-ready-pro'),
                    'default'   => 'no',
                    
                ]
            );


            $this->add_control(
               'show_comment',
               [
                   'label'     => esc_html__('Show Comment', 'element-ready-pro'),
                   'type'      => Controls_Manager::SWITCHER,
                   'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                   'label_off' => esc_html__('No', 'element-ready-pro'),
                   'default'   => 'no',
                   
               ]
           );


         $this->end_controls_section();

        
        $this->start_controls_section(
            'section_tab_settings',
            [
                'label' => esc_html__('Tabs Settings', 'element-ready-pro'),
            ]
        );

           $repeater = new \Elementor\Repeater();

           $repeater->add_control(
                'title', [
                           
                            'label'   => esc_html__( 'Tab title', 'element-ready-pro' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => 'Latest post',
                ]
            );

            $repeater->add_control(
                'post_format', [
                   
                    'label'   => esc_html__('Select Post Format', 'element-ready-pro'),
                    'type'    => Controls_Manager::SELECT2,
                    'options' => [
                        
                        'post-format-video' => esc_html__( 'Video', 'element-ready-pro' ),
                        'post-format-image' => esc_html__( 'Image', 'element-ready-pro' ),
                        'post-format-audio' => esc_html__( 'Audio', 'element-ready-pro' ),
                    ],
                    'default'     => [],
                    'label_block' => true,
                    'multiple'    => true,
                ]
            );

            $repeater->add_control(
                'post_cats', [
                   
                    'label'     => esc_html__('Select Categories', 'element-ready-pro'),
                    'type'        => Controls_Manager::SELECT2,
                    'options'     => element_ready_get_post_category(),
                    'label_block' => true,
                    'multiple'    => true,
                ]
            );

            $repeater->add_control(
                'post_tags', [
                            'label'       => esc_html__('Select tags', 'element-ready-pro'),
                            'type'        => Controls_Manager::SELECT2,
                            'options'     => element_ready_get_post_tags(),
                            'label_block' => true,
                            'multiple'    => true,
                ]
            );

            $repeater->add_control(
                'post_sortby', [
                    'name'    => 'post_sortby',
                    'label'   => esc_html__( 'Post sort by', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'latestpost',
                    'options' => 
                        [
                            'latestpost'    => esc_html__( 'Latest posts', 'element-ready-pro' ),
                            'popularposts'  => esc_html__( 'Popular posts', 'element-ready-pro' ),
                            'mostdiscussed' => esc_html__( 'Most discussed', 'element-ready-pro' ),
                            'tranding'      => esc_html__( 'Tranding', 'element-ready-pro' ),
                            'share'         => esc_html__( 'Most FB share', 'element-ready-pro' ),
                        ],
                ]
            );

            
            $repeater->add_control(
                'post_order', [
                    'name'    => 'post_order',
                    'label'   => esc_html__( 'Post order', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                            'DESC' => esc_html__( 'Descending', 'element-ready-pro' ),
                            'ASC'  => esc_html__( 'Ascending', 'element-ready-pro' ),
                        ],
                ]
            );
            $repeater->add_control(
                'offset_enable', [
                    'label'     => esc_html__( 'Post Skip', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                    'label_off' => esc_html__('No', 'element-ready-pro'),
                ]
            );

            $repeater->add_control(
                'offset_item_num', [
                    'label'     => esc_html__( 'Skip post count', 'element-ready-pro' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => '1',
                    'condition' => [ 'offset_enable' => 'yes' ]
                ]
            );


            $this->add_control(
                'element_ready_post_tabs',
                [
                    'label'   => esc_html__('Tabs', 'element-ready-pro'),
                    'type'    => Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'tab_title' => esc_html__('Add Tab', 'element-ready-pro'),
                            'post_cats' => 1,
                        ],
                    ],
                    'fields' => $repeater->get_controls(),
                   
                ]
            );

     $this->end_controls_section();

     $this->content_text([
      'title' => esc_html__('Meta Icon','element-ready-pro'),
      'slug' => '_meta_icons_content',
      'condition' => '',
      'controls' => [
      
          'meta_icon'=> [
            'label'         => esc_html__( 'Meta Icon', 'element-ready-pro' ),
            'type' => \Elementor\Controls_Manager::ICONS,
          ],

          'meta_cat_icon'=> [
            'label'         => esc_html__( 'Meta Category Icon', 'element-ready-pro' ),
            'type' => \Elementor\Controls_Manager::ICONS,
          ],

          'meta_author_icon'=> [
            'label'         => esc_html__( 'Meta Author Icon', 'element-ready-pro' ),
            'type' => \Elementor\Controls_Manager::ICONS,
          ],

          'meta_date_icon'=> [
            'label'         => esc_html__( 'Meta Date Icon', 'element-ready-pro' ),
            'type' => \Elementor\Controls_Manager::ICONS,
          ],

          'meta_comment_icon'=> [
            'label'         => esc_html__( 'Meta Comment Icon', 'element-ready-pro' ),
            'type' => \Elementor\Controls_Manager::ICONS,
          ],

          
      ]
   ]);


     $this->start_controls_section('element_ready_style_block_section',
      [
         'label' => esc_html__( 'Tab Menu', 'element-ready-pro' ),
         'tab'   => Controls_Manager::TAB_STYLE,
      ]
     );

            $this->add_group_control(
                \Elementor\Group_Control_Border:: get_type(),
                [
                    'name'      => 'menu_tab_border',
                    'label'     => esc_html__( 'Nav Wrapper Border', 'newsprk-essentia' ),
                    'selector'  => '{{WRAPPER}} .widget_tab ul',
                  
                ]
            );

            $this->add_control(
            'block_title_color',
            [
                'label'     => esc_html__('Color', 'element-ready-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_tab ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background:: get_type(),
			[
				'name'     => 'tabs_normal_background',
				'label'    => esc_html__( 'Tab Background', 'element-ready-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .widget_tab ul li a',
			]
		);

        $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'block',
                    'label'    => esc_html__( 'Typography', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .widget_tab ul li a',
                   
                ]
        );
   
        $this->add_responsive_control(
			'tab_title_padding',
			[
				'label'      => esc_html__( 'Tab Item padding', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [
					'{{WRAPPER}} .widget_tab ul li a'                 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
					
				],
			]
        );

        $this->add_responsive_control(
			'tab_menu_margin',
			[
				'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [
					'{{WRAPPER}} .widget_tab ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
					
				],
			]
        );
    

        $this->add_responsive_control(
         'nav_border__radius',
         [
             'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px', '%', 'em' ],
             'selectors'  => [
               '{{WRAPPER}} .widget_tab ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
             ],
         ]
        );

        $this->add_control(
            'tab_background_heading',
            [
                'label'     => esc_html__( 'Nav Background', 'element-ready-pro' ),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
  
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name'      => 'tab_s_background',
                    'label'     => esc_html__( 'Tab Background', 'element-ready-pro' ),
                    'types'     => [ 'classic', 'gradient' ],
                    'condition' => [ 'block_style' => ['style1','style2'] ],
                    'selector'  => '{{WRAPPER}} .widget_tab ul li a',
                ]
            );
            
            $this->add_control(
                'tab_background_wr_heading',
                [
                    'label'     => esc_html__( 'Nav Wrapper', 'element-ready-pro' ),
                    'type'      => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name'      => 'tab__background',
                    'label'     => esc_html__( 'Tab Background', 'element-ready-pro' ),
                    'types'     => [ 'classic', 'gradient' ],
                    'condition' => [ 'block_style' => ['style1','style2'] ],
                    'selector'  => '{{WRAPPER}} .widget_tab .nav',
                ]
            );
    
      
        $this->add_control(
			'tab_active_background_heading',
			[
				'label'     => esc_html__( 'Active Tab Color', 'element-ready-pro' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );

        $this->add_control(
            'tab_active_title_color',
            [
                'label'     => esc_html__('Color', 'element-ready-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_tab ul li a.active,{{WRAPPER}} .widget_tab ul li.active a' => 'color: {{VALUE}};',
                   
                ],
            ]
        );
     
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'tab_active_background',
				'label'    => esc_html__( 'Active Tab Background', 'element-ready-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .widget_tab ul li a.active, {{WRAPPER}} .widget_tab ul li.active a',
			]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_active_title_border',
				'label' => esc_html__( 'Active Border', 'element-ready-pro' ),
				'selector' => '{{WRAPPER}} .widget_tab ul li a.active, {{WRAPPER}} .widget_tab ul li.active a',
			]
        );

 
        
     $this->end_controls_section();
     $this->start_controls_section('element_ready_tab_content_section',
     [
        'label' => esc_html__( 'Tab content', 'element-ready-pro' ),
        'tab'   => Controls_Manager::TAB_STYLE,
     ]
    );
       
        $this->add_group_control(
            \Elementor\Group_Control_Background:: get_type(),
            [
                'name'     => 'tab_content_background',
                'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tab-content',
            ]
        );

        $this->add_responsive_control(
			'tab_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [
						'{{WRAPPER}} .tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
			]
        );

        $this->add_responsive_control(
			'tab_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [

					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				
				],
			]
        );
     $this->end_controls_section();


     $this->start_controls_section('element_ready_style_section',
      [
         'label' => esc_html__( 'Post Title', 'element-ready-pro' ),
         'tab'   => Controls_Manager::TAB_STYLE,
      ]
     );

        $this->add_responsive_control(
            'title_wrap_align',
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
                    '{{WRAPPER}} .element-ready-trending-news-content h5' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .element-ready-trending-news-content h4' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
        'post_title_color',
            [
                'label'     => esc_html__('Color', 'element-ready-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .element-ready-trending-news-content h4 a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .element-ready-trending-news-content h5 a' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
        'post_title_color_hv',
            [
                'label'     => esc_html__('Hover color', 'element-ready-pro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .element-ready-trending-news-content h4 a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .element-ready-trending-news-content h5 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'post_title_typography',
				'label'    => __( 'Title Typography', 'element-ready-pro' ),
				'selector' => '{{WRAPPER}} .element-ready-trending-news-content h4 a,{{WRAPPER}} .element-ready-trending-news-content h5 a',
			]
		);
        $this->add_responsive_control(
			'post_title_margin',
			[
				'label'      => esc_html__( 'Title Margin', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [
					'{{WRAPPER}} .element-ready-trending-news-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .element-ready-trending-news-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
			]
        );
        $this->add_responsive_control(
			'post_title_padding',
			[
				'label'      => esc_html__( 'Title Padding', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%'],
				'selectors'  => [
					'{{WRAPPER}} .element-ready-trending-news-content h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .element-ready-trending-news-content h5 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
			]
        );
     $this->end_controls_section();

     $this->start_controls_section('element_ready__image_style_section',
     [
        'label' => esc_html__( 'Image', 'element-ready-pro' ),
        'tab'   => Controls_Manager::TAB_STYLE,
     ]
    );

        
    $this->add_responsive_control(
        'box_image_width',
        [
        'label'      => esc_html__( 'Image width', 'element-ready-pro' ),
        'type'       => Controls_Manager::SLIDER,
        
        'size_units' => [ 'px','%' ],
        'range'      => [
            'px' => [
                'min'  => 0,
                'max'  => 1600,
                'step' => 1,
            ],
            '%' => [
                'min' => 0,
                'max' => 100,
            ],
            
        ],
        
        'selectors' => [
            '{{WRAPPER}} .element-ready-thumb' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
            'show_image' => ['yes']
        ]
        ]
    );

    $this->add_responsive_control(
        'post_image__wrapper_margin',
        [
            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .element-ready-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               
                
            ],
        ]
    );

    $this->add_responsive_control(
        'post_image__wrapper_padding',
        [
            'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .element-ready-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

     $this->text_minimum_css(
            array(
               'title' => esc_html__('Category','element-ready-pro'),
               'slug' => 'post_cat_style',
               'element_name' => 'post_cat_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-cat',
               'hover_selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-cat:hover',
               // 'condition' => [
               //    'title_hide' => '',
               // ],
            )
      );

      $this->text_wrapper_css(
         array(
            'title' => esc_html__('Date','element-ready-pro'),
            'slug' => 'post_datre_style',
            'element_name' => 'post_date_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-date',
            'hover_selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-date:hover',
            // 'condition' => [
            //    'title_hide' => '',
            // ],
         )
      );

      
      $this->text_wrapper_css(
         array(
            'title' => esc_html__('Author','element-ready-pro'),
            'slug' => 'post_author_style',
            'element_name' => 'post_authr_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-author',
            'hover_selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-author:hover',
            // 'condition' => [
            //    'title_hide' => '',
            // ],
         )
      );

      $this->text_wrapper_css(
         array(
            'title' => esc_html__('Comment','element-ready-pro'),
            'slug' => 'post_comment_style',
            'element_name' => 'post_comment_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-comment',
            'hover_selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list .element-ready-comment:hover',
            // 'condition' => [
            //    'title_hide' => '',
            // ],
         )
      );


   $this->box_css(
         array(
            'title' => esc_html__('Post Meta','element-ready-pro'),
            'slug' => 'post_meta_wrapper_box_style',
            'element_name' => 'post_meta_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-post-meta',
         )
   );

   $this->box_css(
    array(
       'title' => esc_html__('Content Container','element-ready-pro'),
       'slug' => 'post_content_contaiuner_box_style',
       'element_name' => 'post_item_content_element_ready_',
       'selector' => '{{WRAPPER}} .element-ready-trending-news-content',
    )
  );

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
                    '{{WRAPPER}} .element-ready-post-meta' => 'order: {{VALUE}};',
                
                ],
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
                    '{{WRAPPER}} h4' => 'order: {{VALUE}};',
                    '{{WRAPPER}} h5' => 'order: {{VALUE}};',
                
                ],
                ]
            );

            $this->end_controls_section();

        $this->element_before_psudocode([
            'title'           => esc_html__('Meta Seperator','element-ready-pro'),
            'slug'            => 'post_meta_separetor_box_style',
            'element_name'    => 'post_meta_separetor_element_ready_',
            'selector'        => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list::before',
            'selector_parent' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list',
        ]);

        $this->text_wrapper_css(
            array(
               'title'          => esc_html__('Meta Icon','element-ready-pro'),
               'slug'           => 'meta_icon_style',
               'element_name'   => 'meta_icon_element_ready_',
               'selector'       => '{{WRAPPER}} .element-ready-meta-list i',
               'hover_selector' => false,
              
            )
        );

   $this->box_css(
         array(
            'title'        => esc_html__('Item','element-ready-pro'),
            'slug'         => 'post_item_wrapper_box_style',
            'element_name' => 'post_item_wrapper_element_ready_',
            'selector'     => '{{WRAPPER}} .gallery_item,{{WRAPPER}} .post-style-tab-post .tab-pane .most-view-style-2',
         )
   );

   $this->box_css(
      array(
         'title'        => esc_html__('Item Border','element-ready-pro'),
         'slug'         => 'post_item_borderr_box_style',
         'element_name' => 'post_item_border_element_ready_',
         'selector'     => '{{WRAPPER}} .gallery_item::before,{{WRAPPER}} .post-gallery-style-2 .post-gallery-content::before',
      )
    );
    
    $this->start_controls_section('element_ready_section',
    [
       'label' => esc_html__( 'Section', 'element-ready-pro' ),
       'tab'   => Controls_Manager::TAB_STYLE,
    ]
   );

    $this->add_group_control(
        \Elementor\Group_Control_Background:: get_type(),
        [
            'name'     => 'section_background',
            'label'    => esc_html__( 'Background', 'element-ready-pro' ),
            'types'    => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .widget_tab',
        ]
    );
    $this->add_responsive_control(
        'tab_section_margin',
        [
            'label'      => esc_html__( 'Tab section margin', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .widget_tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .tab4'       => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
            ],
        ]
    );
    $this->add_responsive_control(
        'tab_section_padding',
        [
            'label'      => esc_html__( 'Tab section padding', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .widget_tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .tab4'       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
            ],
        ]
    );
    $this->end_controls_section();
   
	}

	protected function render( ) {

        $settings   = $this->get_settings();

        $show_cat                = $settings['show_cat'];
        $show_date               = $settings['show_date'];
        $show_image              = $settings['show_image'];
        $post_title_crop         = $settings['post_title_crop'];
        $post_count              = $settings['post_count'];
        $id                      = $this->get_id();
        $show_author             = $settings['show_author'];
        $element_ready_post_tabs = $settings['element_ready_post_tabs'];
        $post_tab_count          = count($element_ready_post_tabs);
        $show_author_avator      = isset( $settings['show_author_avator'] ) ? $settings['show_author_avator'] : 'no';
        $id                      = $this->get_id();
        
        $this->add_render_attribute( 'tabs_area_attr', 'id', 'tabs__area__'.$id );
        $this->add_render_attribute( 'tabs_area_attr', 'class', 'tabs__area' );

        if($settings['block_style'] == 'style1'){
            $this->add_render_attribute( 'tabs_area_attr', 'class', 'post_gallery_sidebar widget_tab' );
        }

        if($settings['block_style'] =='style2'){
            $this->add_render_attribute( 'tabs_area_attr', 'class', 'post-style-tab-post widget_tab' );
        }

    ?>
	<!--TAB WIDGET START-->
    <?php if($settings['block_style'] == 'style1'): ?>
        <div <?php echo $this->get_render_attribute_string( 'tabs_area_attr' ); ?>>
            <ul class="nav nav-pills tab__nav" id="pills-tab" role="tablist">
                <?php foreach($element_ready_post_tabs as $key => $tab): ?>
                    <li class="nav-item <?php echo esc_attr($key==0?'active':''); ?>"><a class="nav-link" data-toggle="pill" href="#<?php echo esc_attr('post-'.$key.$id); ?>"> <?php echo esc_html($tab['title']); ?> </a>
                    </li>
                <?php endforeach; ?> 
            </ul>
            <div class="tab__content__area tab-content" id="pills-tabContent">
                <?php foreach($element_ready_post_tabs as $sl => $tab_content): ?>
                    <div class="single__tab__item tab-pane <?php echo esc_attr($sl==0?'active ':''); ?>" id="<?php echo esc_attr('post-'.$sl.$id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr('post-'.$sl.$id); ?>">
                        <div class="post_gallery_items">
                                <?php

                                    $query = array(
                                        'post_type'   => array( 'post' ),
                                        'post_status' => array( 'publish' ),
                                        'orderby'     => 'date',
                                        'order'       => 'DESC',
                                        'numberposts' => $post_count,
                                    ); 

                                    
                                    if( isset( $tab_content['post_order'] ) && $tab_content['post_order'] !=''){
                                        $query['order']  = $tab_content['post_order'];
                                    }

                                    if( isset( $tab_content['post_sortby'] ) && $tab_content['post_sortby'] !=''){
                                        
                                        if($tab_content['post_sortby'] == 'mostdiscussed') {
                                                $query['orderby'] = 'comment_count';
                                        }
                                        
                                    
                                        if(isset($tab_content['post_cats']) && is_array($tab_content['post_cats'])){ 
                                                $query['category__in'] = $tab_content['post_cats'];  
                                        }

                                        if(isset($tab_content['post_tags']) && is_array($tab_content['post_tags'])){ 
                                                $query['tag__in'] = $tab_content['post_tags'];  
                                        }
                                    
                                        if($tab_content['post_sortby'] == 'popularposts') {
                                                $query['meta_key'] = 'element_ready_post_views_count';
                                                $query['orderby']  = 'meta_value_num';
                                        } 
                                        
                                        if($tab_content['post_sortby'] == 'share') {
                                                $query['meta_key'] = 'element_ready_most_share_post';
                                                $query['orderby']  = 'meta_value_num';
                                        }

                                        if($tab_content['post_sortby'] == 'tranding') {
                                                $query['meta_query'][] = [
                                                'key'     => '_element_ready_trending',
                                                'value'   => 'yes',
                                                'compare' => '=',
                                                ];
                                        }
                                            
                                    }
                                    if( isset($tab_content['post_format']) && is_array($tab_content['post_format']) && count($tab_content['post_format']) > 0 ) {

                                        $query['tax_query'] = array(
                                                array(
                                                    'taxonomy' => 'post_format',
                                                    'field'    => 'slug',
                                                    'terms'    => $tab_content['post_format'],
                                                    'operator' => 'IN'
                                                ) 
                                            );
            
                                    } 

                                    if($tab_content['offset_enable']=='yes') {
                                        $query['offset'] = $tab_content['offset_item_num'];
                                    }
                                    
                                    $data = get_posts($query);
                                    $last = count($data)-1;

                                ?> 
                                <?php foreach($data as $sl => $post): ?>
                                    <div class="gallery_item">
                                        <?php if($show_image == 'yes' && has_post_thumbnail($post->ID)): ?>
                                            <div class="gallery_item_thumb element-ready-thumb">
                                            <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb_size', $settings ); ?>
                                                <img src="<?php echo esc_url( $thumb_link ); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="gallery_item_content element-ready-trending-news-content">
                                            <?php include('parts/meta-3.php');  ?>
                                            <h4> <a href="<?php echo esc_url(get_post_permalink($post->ID)); ?>"> <?php echo wp_trim_words( $post->post_title, $post_title_crop,'' ); ?></a> </h4>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?> 
            </div>
        </div>
    <?php endif; ?>
    <?php if($settings['block_style'] =='style2'): ?>
        <div <?php echo $this->get_render_attribute_string( 'tabs_area_attr' ); ?>>
            <div class="tab-btn">
                    <ul class="nav nav-pills tab__nav" id="pills-tab" role="tablist">
                    <?php foreach($element_ready_post_tabs as $key => $tab): ?>
                        <li class="nav-item <?php echo esc_attr($key==0?'active':''); ?>" role="presentation">
                            <a class="nav-link" data-toggle="pill" href="#<?php echo esc_attr('post'.$key.$id); ?>"><?php echo esc_html($tab['title']); ?> </a>
                        </li>
                    <?php endforeach; ?> 
                    </ul>
            </div>
            <div class="tab__content__area tab-content" id="pills-tabContent">
                <?php foreach($element_ready_post_tabs as $sl => $tab_content): ?>
                    <div class="single__tab__item tab-pane <?php echo esc_attr($sl==0?'active ':''); ?>" id="<?php echo esc_attr('post'.$sl.$id); ?>">

                    <?php
                        
                        $query = array(
                            'post_type'   => array( 'post' ),
                            'post_status' => array( 'publish' ),
                            'orderby'     => 'date',
                            'order'       => 'DESC',
                            'numberposts' => $post_count,
                        ); 

                        
                        if( isset( $tab_content['post_order'] ) && $tab_content['post_order'] !=''){
                            $query['order']  = $tab_content['post_order'];
                        }

                        if( isset( $tab_content['post_sortby'] ) && $tab_content['post_sortby'] !=''){
                            
                            if($tab_content['post_sortby'] == 'mostdiscussed') {
                                    $query['orderby'] = 'comment_count';
                            }
                            
                        
                            if(isset($tab_content['post_cats']) && is_array($tab_content['post_cats'])){ 
                                    $query['category__in'] = $tab_content['post_cats'];  
                            }

                            if(isset($tab_content['post_tags']) && is_array($tab_content['post_tags'])){ 
                                    $query['tag__in'] = $tab_content['post_tags'];  
                            }
                        
                            if($tab_content['post_sortby'] == 'popularposts') {
                                    $query['meta_key'] = 'element_ready_post_views_count';
                                    $query['orderby']  = 'meta_value_num';
                            } 
                            
                            if($tab_content['post_sortby'] == 'share') {
                                    $query['meta_key'] = 'element_ready_most_share_post';
                                    $query['orderby']  = 'meta_value_num';
                            }

                            if($tab_content['post_sortby'] == 'tranding') {
                                    $query['meta_query'][] = [
                                    'key'     => '_element_ready_trending',
                                    'value'   => 'yes',
                                    'compare' => '=',
                                    ];
                            }
                                
                        }
                        if( isset($tab_content['post_format']) && is_array($tab_content['post_format']) && count($tab_content['post_format']) > 0 ) {

                            $query['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'post_format',
                                        'field'    => 'slug',
                                        'terms'    => $tab_content['post_format'],
                                        'operator' => 'IN'
                                    ) 
                                );

                        } 

                        if($tab_content['offset_enable']=='yes') {
                            $query['offset'] = $tab_content['offset_item_num'];
                        }
                        
                        $data = get_posts($query);
                        $last = count($data)-1;

                        ?> 
                        <div class="post-style-items">
                            <?php foreach($data as $sl => $post): ?>
                                <div class="post-gallery-style-2 most-view-style-2">
                                    
                                    <?php if($show_image == 'yes' && has_post_thumbnail($post->ID)): ?>
                                        <div class="post-gallery-thumb element-ready-thumb">
                                        <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumb_size', $settings ); ?>
                                            <img src="<?php echo esc_url( $thumb_link ); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-gallery-content element-ready-trending-news-content">
                                    <h5> <a href="<?php echo esc_url(get_post_permalink($post->ID)); ?>"> <?php echo wp_trim_words( $post->post_title, $post_title_crop,'' ); ?></a> </h5>
                                        <div class="meta-post-2-style element-ready-post-meta">
                                                <?php if($settings['show_author'] == 'yes'): ?>
                                                        <div class="meta-author element-ready-meta-author element-ready-meta-list">
                                                        
                                                            <?php if($settings['meta_author_icon']['library'] !=''): ?>
                                                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_author_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                            <?php else: ?>
                                                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                            <?php endif; ?>

                                                        <?php
                                                            
                                                            if($settings['show_author_avator'] =='yes'){
                                                                    printf(
                                                                    '<a href="%2$s">%1$s %3$s</a>',
                                                                    get_avatar( get_the_author_meta( 'ID' ), 55 ), 
                                                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                                                                    get_the_author()
                                                                    );
                                                            }else{
                                                                    printf(
                                                                    '<a class="element-ready-author" href="%1$s">%2$s</a>',
                                                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                                                                    get_the_author()
                                                                    ); 
                                                            }    
                                                            
                                                                    
                                                                    
                                                        ?>
                                                        </div>
                                                <?php endif; ?>

                                                <?php  $categories = get_the_category($post->ID);
                                                        if(! empty( $categories) && $settings['show_cat'] == 'yes' ): ?>
                                                        <div class="meta-post-categores element-ready-meta-categories element-ready-meta-list">
                                                        
                                                            <?php if($settings['meta_cat_icon']['library'] !=''): ?>
                                                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_cat_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                            <?php else: ?>
                                                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                            <?php endif; ?>

                                                        <?php
                                                                    
                                                            echo '<a class="element-ready-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                                                    
                                                        ?>
                                                        </div>
                                                <?php endif; ?>
                                                <?php if($settings['show_date'] =='yes'): ?>    
                                                        <div class="meta-date element-ready-meta-date element-ready-meta-list">
                                                
                                                        <?php if($settings['meta_date_icon']['library'] !=''): ?>
                                                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_date_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        <?php else: ?>
                                                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        <?php endif; ?>

                                                        <span class="element-ready-date"><?php echo get_the_date(get_option( 'date_format' ),$post->ID); ?></span>
                                                        </div>
                                                <?php endif; ?>
                                                <?php if($settings['show_comment'] =='yes'): ?>    
                                                        <div class="element-ready-meta-comment element-ready-meta-list">
                                                        <?php if($settings['meta_comment_icon']['library'] !=''): ?>
                                                            <?php \Elementor\Icons_Manager::render_icon( $settings['meta_comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        <?php else: ?>
                                                            <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                        <?php endif; ?>
                                                        <span class="element-ready-comment"> <?php echo get_comments_number($post->ID); ?></span>
                                                        </div>
                                                <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                    </div>
                    <?php endforeach; ?> 
            </div>
        </div>
    <?php endif; ?>
      
	<?php }

}

