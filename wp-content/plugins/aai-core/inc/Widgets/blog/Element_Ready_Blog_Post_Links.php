<?php
namespace Element_Ready_Pro\Widgets\blog;

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
class Element_Ready_Blog_Post_Links extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-posts-link';
    }
    public function get_keywords() {
		return ['blog post links','post link'];
	}
    public function get_title() {
        return esc_html__( 'ER Blog Pagination', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-navigation-horizontal';
    }

    public function get_style_depends() {
    
        return [
           'er-pro-blog-pagination'
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
                    'style1' => esc_html__( 'Style1', 'element-ready-pro' )
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
            'next_text',
            [
                'label'       => esc_html__( 'Next', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Next', 'element-ready-pro' ),
                'placeholder' => esc_html__( 'Type next label here', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'prev_text',
            [
                'label'       => esc_html__( 'Prev', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Prev','element-ready-pro' ),
                'placeholder' => esc_html__( 'Type Previous Text here', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
			'next_icon',
			[
				'label' => esc_html__( 'Next Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-chevron-right',
					'library' => 'solid',
				],
                'label_block' => true,
			]
		);

        $this->add_control(
			'prev_icon',
			[
				'label' => esc_html__( 'Prev Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-chevron-left',
					'library' => 'solid',
				],
                'label_block' => true,
			]
		);

        $this->add_control(
			'mid_gap',
			[
				'label' => esc_html__( 'Gap', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 300,
				'step' => 2,
				'default' => 2,
			]
		);

        $this->add_responsive_control(
            'btyinput_next_io_icon_padding',
            [
                'label'      => __( 'Next Icon Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'btyinput_previo_icon_padding',
            [
                'label'      => __( 'Prev Icon Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );



        $this->end_controls_section();
   
        
         /*---------------------------
            INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_style_section',
            [
                'label' => __( 'Link', 'element-ready-pro' ),
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
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers
                            
                            ',
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
                           
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'height:{{SIZE}}{{UNIT}};',
                                
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
                           
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'width:{{SIZE}}{{UNIT}};',
                              
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers
                              
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
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers

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
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
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
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'input_box_active_tab',
                    [
                        'label' => __( 'Active', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'input_box_active_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.current'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'input_box_active_backkground',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.current                            
                            ',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'input_box_active_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.current
                              
                            ',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'input_box_active_shadow',
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.current
                           
                            ',
                        ]
                    );
                
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'input_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                $this->add_control(
                    'input_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers:hover'   => 'color:{{VALUE}};',
                           
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
                            {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers:hover
                          
                        ',
                    ]
                );
                $this->add_control(
                    'input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers:hover'   => 'border-color:{{VALUE}};',
                          
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers:hover,
                       
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
                'label' => __( 'Next Prev', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('submit_style_tabs');
                $this->start_controls_tab(
                    'submit_style_normal_tab',
                    [
                        'label' => __( 'Next', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_submit_typography',
                            'selector' => '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next'
                        ]
                    );

                   

                    $this->add_control(
                        'input_submit_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_control(
                        'input_submit_icon_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submit_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next'
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
                          
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next' => 'width:{{SIZE}}{{UNIT}};',
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
                          
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    
                    $this->add_responsive_control(
                        'input_submit_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );


                $this->end_controls_tab();
                $this->start_controls_tab(
                    'submit_style_hover_tab',
                    [
                        'label' => __( 'Prev', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'input_submithover_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_submit_icon_hover_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'input_prev_submit_width',
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
                          
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev' => 'width:{{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'inputprev_submit_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                          
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submithover_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_submithover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submithover_shadow',
                            'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev'
                        ]
                    );

                       
                    $this->add_responsive_control(
                        'btyinput_prev_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'input_prev_yu_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-pagination .nav-links .page-numbers.prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
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
 
       $settings = $this->get_settings();
       global $wp_query;

       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
         $wp_query->max_num_pages = 10; 
       }
      

          if($settings['style'] == 'style1' && $wp_query->max_num_pages > 1){

                the_posts_pagination( array(
                    'mid_size'  => $settings['mid_gap'],
                    'prev_text' => element_ready_render_icons($settings['prev_icon']) . $settings['prev_text'],
                    'next_text' => $settings['next_text'] .element_ready_render_icons($settings['next_icon']),
                    'class'     => 'element-ready-blog-pagination',
                ) ); 

          }elseif($settings['style'] == 'style2'){
                
              ?>
                <ul class="element-ready-blog-nav-posts">
                    <li class="er-blog-prev-link"><?php previous_post_link( '%link', element_ready_render_icons($settings['prev_icon']) . $settings['prev_text'] ); ?></li>
                    <li class="er-blog-next-link"><?php next_post_link( '%link', $settings['next_text'] .element_ready_render_icons($settings['next_icon']) ); ?></li>
                </ul>
            <?php

          }
               
		?>
    
	   

     <?php

    }

}