<?php
namespace Element_Ready_Pro\Widgets\search;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
/**
 * Blog Post Search Form
 * @author quomodosoft.com
 */
class Element_Ready_Search_Form extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-search';
    }
    public function get_keywords() {
		return ['blog search','search'];
	}
    public function get_title() {
        return esc_html__( 'ER Blog Search', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-search';
    }

    public function get_script_depends() {

        wp_register_script( 'er-blog-tpl', ELEMENT_READY_PRO_ROOT_JS . 'er-blog.js', array('jquery'), ELEMENT_READY_PRO_VERSION, true );
        return [
            'er-blog-tpl','nice-select'
        ];
    }

    public function get_style_depends() {

        wp_register_style( 'er-blog-module', ELEMENT_READY_PRO_ROOT_CSS . 'er-pro-blogs.css',[], time() );
        return [
            'er-blog-module','nice-select'
        ];
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'layout_contents_section',
            [
                'label' => esc_html__( 'Layout Options', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => esc_html__( 'Layout', 'element-ready-pro' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Layout One', 'element-ready-pro' ),
                    'style2' => esc_html__( 'Layout Two', 'element-ready-pro' ),
                    'style3' => esc_html__( 'Layout Three', 'element-ready-pro' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wready_content_cart_section',
            [
                'label' => esc_html__( 'Settings', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    
        $this->add_control(
            'search_button_label',
            [
                'label'       => esc_html__( 'Button Label', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Search', 'element-ready-pro' ),
                'placeholder' => esc_html__( 'Type Search label here', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'search_palceholder',
            [
                'label'       => esc_html__( 'Search PlaceHolder', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Search Products&hellip','element-ready-pro' ),
                'placeholder' => esc_html__( 'Search Products&hellip;', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
			'search_icon',
			[
				'label' => esc_html__( 'Search Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-search',
					'library' => 'solid',
				],
                'label_block' => true,
			]
		);

    
        $this->add_control(
            'category',
            [
                'label'        => __( 'Category?', 'element-ready-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'element-ready-pro' ),
                'label_off'    => __( 'No', 'element-ready-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'button_inline',
            [
                'label'        => __( 'Button Inline?', 'element-ready-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'element-ready-pro' ),
                'label_off'    => __( 'No', 'element-ready-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'category_content_section',
            [
                'label'     => __( 'Category', 'element-ready-pro' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'category' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'all_cats',
            [
                'label'       => __( 'All Category Label', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'All Category', 'element-ready-pro' ),
                'placeholder' => __( 'Type option label here', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'exclude_cats',
            [
                'label'    => __( 'Exclude Categories', 'element-ready-pro' ),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => element_ready_get_post_category(),

            ]
        );

        $this->add_control(
            'cats_margin',
            [
                'label'      => __( 'Category Container Margin', 'element-ready-pro' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wooready_input_wrapper .wooready_nice_select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'_container_style_section',
			[
				'label' => esc_html__( 'Container', 'element-ready-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'element_ready_border',
                    'label' => esc_html__( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .wooready_input_wrapper',
                ]
            );

		$this->end_controls_section();
        
         /*---------------------------
            INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_style_section',
            [
                'label' => __( 'Input', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'input_box_tabs' );
                $this->start_controls_tab(
                    'input_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_box_typography',
                            'selector' => '
                                {{WRAPPER}} .wooready_input_wrapper input[type*="text"],
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .wooready_input_wrapper .wooready_input_box input[type="text"]
                            
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]::-moz-placeholder'            => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]:-ms-input-placeholder'        => 'color: {{VALUE}};',
                        
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'height:{{SIZE}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'width:{{SIZE}}{{UNIT}};',
                              
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .wooready_input_wrapper input[type*="text"]
                              
                            ',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .wooready_input_wrapper input[type*="text"]

                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'input_box_transition',
                        [
                            'label'      => __( 'Transition', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'input_box_hover_tabs',
                    [
                        'label' => __( 'Focus', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'input_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]:focus'   => 'color:{{VALUE}};',
                           
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'input_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                            {{WRAPPER}} .wooready_input_wrapper input[type*="text"]  : focus
                          
                        ',
                    ]
                );
                $this->add_control(
                    'input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wooready_input_wrapper input[type*="text"]:focus'   => 'border-color:{{VALUE}};',
                          
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .wooready_input_wrapper input[type*="text"]:focus
                       
                        ',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

          /*----------------------------
            BUTTONS TYLE
        ------------------------------*/
        $this->start_controls_section(
            'element_ready_input_submit_style_section',
            [
                'label' => __( 'Button', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('submit_style_tabs');
                $this->start_controls_tab(
                    'submit_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_submit_typography',
                            'selector' => '{{WRAPPER}} button',
                        ]
                    );

                   

                    $this->add_control(
                        'input_submit_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} button' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_control(
                        'input_submit_icon_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} button svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} button i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'input_submit_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} button,{{WRAPPER}} .element_ready_search_layout_1 .wooready_input_wrapper .wooready_input_box button',
                        ]
                    );

                    $this->add_responsive_control(
                        'input_submit_width',
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
                                'size' => 200,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} button' => 'width:{{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'      => 'input_submit_border',
                            'label'     => __( 'Border', 'element-ready-pro' ),
                            'selector'  => '{{WRAPPER}} button',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submit_box_shadow',
                            'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} button',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'input_submit_transition',
                        [
                            'label'      => __( 'Transition', 'element-ready-pro' ),
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
                                '{{WRAPPER}} button' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_floting',
                        [
                            'label'   => __( 'Button Floating', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'float:left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => 'eicon-h-align-left',
                                ],
                                'display:block;margin-left:auto;margin-right:auto' => [
                                    'title' => __( 'None', 'element-ready-pro' ),
                                    'icon'  => 'eicon-v-align-top',
                                ],
                                'float:right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} button' => '{{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_text_align',
                        [
                            'label'   => __( 'Text Align', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => ' eicon-h-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'None', 'element-ready-pro' ),
                                    'icon'  => 'eicon-h-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} button' => 'text-align: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_position',
                        [
                            'label' => esc_html__( 'Enable Position', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'position: absolute'  => esc_html__( 'Yes', 'element-ready-pro' ),
                                'position: unset' => esc_html__( 'No', 'element-ready-pro' ),
                                '' => esc_html__( 'default', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} button' => '{{VALUE}} !important;',
                                '{{WRAPPER}} .wooready_input_box' => 'display:flex; align-items:center; gap: 0px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_flwx_positiontoph',
                        [
                            'label' => esc_html__( 'Top', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 5,
                                ],
                               
                            ],

                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: absolute'
                                ]
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} form .wooready_input_box button' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_flwx_position_right',
                        [
                            'label' => esc_html__( 'Right', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 5,
                                ],
                               
                            ],

                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: absolute'
                                ]
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} form .wooready_input_box button' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_flwx_position_left',
                        [
                            'label' => esc_html__( 'Left', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 5,
                                ],
                               
                            ],

                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: absolute'
                                ]
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} form .wooready_input_box button' => 'left: {{SIZE}}{{UNIT}};right: unset;',

                            ],
                        ]
                    );


                    $this->add_control(
                        'er_enable_button_flwx_gapwidth',
                        [
                            'label' => esc_html__( 'Gap', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 5,
                                ],
                               
                            ],

                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: unset'
                                ]
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} form .wooready_input_box' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_direction',
                        [
                            'label' => esc_html__( 'Direction', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'column'  => esc_html__( 'Column', 'element-ready-pro' ),
                                'column-reverse' => esc_html__( 'Column Reverse', 'element-ready-pro' ),
                                'row' => esc_html__( 'Row', 'element-ready-pro' ),
                                'row-reverse' => esc_html__( 'Row Reverse', 'element-ready-pro' ),
                            
                            ],
                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: unset'
                                ]
                            ],
                            'selectors' => [
                              
                                '{{WRAPPER}} form .wooready_input_box' => 'flex-direction: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'er_enable_button_align_items',
                        [
                            'label' => esc_html__( 'Align', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'flex-start'  => esc_html__( 'Start', 'element-ready-pro' ),
                                'flex-end' => esc_html__( 'End', 'element-ready-pro' ),
                                'center' => esc_html__( 'Center', 'element-ready-pro' ),
                               
                            
                            ],
                            'condition' => [
                                'er_enable_button_position' => [
                                    'position: unset'
                                ]
                            ],
                            'selectors' => [
                              
                                '{{WRAPPER}} form .wooready_input_box' => 'align-items: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'submit_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'input_submithover_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} button:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_submit_icon_hover_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} button:hover svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} button:hover i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submithover_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} button:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_submithover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} button:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submithover_shadow',
                            'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} button:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            BUTTONS TYLE END
        ------------------------------*/



    }

    protected function render() {
 
      $settings       = $this->get_settings();
      $search_icon   = element_ready_render_icons($settings['search_icon']);
      $exclude_cats = $settings['exclude_cats'];
      $button_inline =  $settings['button_inline'] == 'yes'  ? '' : 'position:static' ;
        $defaults = array(
            'show_option_all'   => '',
            'show_option_none'  => '',
            'orderby'           => 'id',
            'order'             => 'ASC',
            'show_count'        => 0,
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => $exclude_cats,
            'echo'              => 1,
            'selected'          => 0,
            'hierarchical'      => 3,
            'name'              => 'cat',
            'id'                => '',
            'class'             => 'postform',
            'depth'             => 0,
            'tab_index'         => 0,
            'taxonomy'          => 'category',
            'hide_if_empty'     => false,
            'option_none_value' => -1,
            'value_field'       => 'term_id',
            'required'          => false,
        );
  



        if ( file_exists( dirname( __FILE__ ) . '/layout/search-form/' . $settings['style'] . '.php' ) ) {

            include('layout/search-form/'.$settings['style'] . '.php');  

        } else {

            include('layout/search-form/style1.php');  

        }

    }

}