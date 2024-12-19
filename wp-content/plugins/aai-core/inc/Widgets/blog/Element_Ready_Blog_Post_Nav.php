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
 * Blog Post nav
 * @author quomodosoft.com
 */
class Element_Ready_Blog_Post_Nav extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-posts-nav';
    }
    public function get_keywords() {
		return ['er post navigation','post navigation'];
	}
    public function get_title() {
        return esc_html__( 'ER Blog Post Navigation', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-navigation-horizontal';
    }

    public function get_style_depends() {
    
        return [
           'er-blog-post-navigation'
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
                'post_id',
                [
                    'label' => esc_html__( 'Demo Post id', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => $this->get_latest_post(),
                    'placeholder' => esc_html__( 'Type your post id here', 'element-ready-pro' ),
                ]
            );


            $this->add_control(
                'word_limit',
                [
                    'label' => esc_html__( 'Word Limit', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 2,
                    'max' => 200,
                    'step' => 5,
                    'default' => 15,
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

            $this->add_responsive_control(
                'btyinput_next_io_icon_padding',
                [
                    'label'      => __( 'Next Icon Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .eready-post-navigation .post-next span i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .eready-post-navigation .post-next span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .eready-post-navigation .post-previous span i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .eready-post-navigation .post-previous span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => __( 'Post Title', 'element-ready-pro' ),
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
                                {{WRAPPER}} .eready-post-navigation .er-post-name
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .eready-post-navigation .er-post-name'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .eready-post-navigation .er-post-name
                            
                            ',
                        ]
                    );

              

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .eready-post-navigation .er-post-name
                              
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
                                '{{WRAPPER}} .eready-post-navigation .er-post-name'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .eready-post-navigation .er-post-name

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
                                '{{WRAPPER}} .eready-post-navigation .er-post-name'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                '{{WRAPPER}} .eready-post-navigation .er-post-name'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
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
                                '{{WRAPPER}} .eready-post-navigation .er-post-name'   => 'transition: {{SIZE}}s;',
                               
                            ],
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
                            '{{WRAPPER}} .eready-post-navigation .er-post-name:hover'   => 'color:{{VALUE}};',
                           
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
                            {{WRAPPER}} .eready-post-navigation .er-post-name:hover
                          
                        ',
                    ]
                );
                $this->add_control(
                    'input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .eready-post-navigation .er-post-name:hover'   => 'border-color:{{VALUE}};',
                          
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .eready-post-navigation .er-post-name:hover,
                       
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
                            'selector' => '{{WRAPPER}} .eready-post-navigation .post-next span'
                        ]
                    );

                   

                    $this->add_control(
                        'input_submit_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .eready-post-navigation .post-next span' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_control(
                        'input_submit_icon_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .eready-post-navigation .post-next span svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .eready-post-navigation .post-next span i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submit_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .eready-post-navigation .post-next'
                        ]
                    );

                   
                    $this->add_responsive_control(
                        'input_submit_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .eready-post-navigation .post-next span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .eready-post-navigation .post-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .eready-post-navigation .post-previous span' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_submit_icon_hover_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .eready-post-navigation .post-previous span svg path' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .eready-post-navigation .post-previous span i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submithover_background_color',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .eready-post-navigation .post-previous'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_submithover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .eready-post-navigation .post-previous'
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submithover_shadow',
                            'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .eready-post-navigation .post-previous'
                        ]
                    );

                       
                    $this->add_responsive_control(
                        'btyinput_prev_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .eready-post-navigation .post-previous span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .eready-post-navigation .post-previous' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_pro_mainstyle_section',
            [
                'label' => __( 'Main Wrapper', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'main_wrapper_subm_background_color',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .eready-post-navigation'
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'main_submithover_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .eready-post-navigation'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'main_watapper_submithover_shadow',
                    'label'    => __( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .eready-post-navigation'
                ]
            );

               
            $this->add_responsive_control(
                'maon_wrapper_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .eready-post-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'main_wrapper_yu_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .eready-post-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();
        /*----------------------------
            BUTTONS TYLE END
        ------------------------------*/



    }

    protected function render() {
 
       $settings = $this->get_settings();
       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
        $post_id = $settings['post_id'];
        $GLOBALS['post'] = get_post($post_id);
       }
        if($settings['style'] == 'style1'){

               $this->mediguss_post_nav(); 

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

    // display navigation to the next/previous set of posts
    // ----------------------------------------------------------------------------------------
  function mediguss_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
        $settings = $this->get_settings();
        $word_limit = $settings['word_limit'];
        $next_post	 = get_next_post();
        $pre_post	 = get_previous_post();
        if ( !$next_post && !$pre_post ) {
            return;
        }
    ?>
        <nav class="eready-post-navigation">
            <div class="post-previous">
                <?php if ( !empty( $pre_post ) ): ?>
                    <a href="<?php echo get_the_permalink( $pre_post->ID ); ?>">
                        <h3 class="er-post-name"><?php echo wp_trim_words( get_the_title( $pre_post->ID ), $word_limit,'' ) ?></h3>
                        <span><?php echo element_ready_render_icons($settings['prev_icon']) . $settings['prev_text'] ?></span>
                    </a>
                <?php endif; ?>
            </div>
            <div class="post-next">
                <?php if ( !empty( $next_post ) ): ?>
                    <a href="<?php echo get_the_permalink( $next_post->ID ); ?>">
                        <h3 class="er-post-name"><?php echo wp_trim_words( get_the_title( $next_post->ID ) ,$word_limit,'' ) ?></h3>
    
                        <span><?php echo $settings['next_text'] .element_ready_render_icons($settings['next_icon']); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    <?php }

    public function get_latest_post(){

        $thumbs = array(
            'meta_query' => array( 
                array(
                    'key' => '_thumbnail_id'
                ) 
            )
        );
        $post_id = '';
        $query = new \WP_Query($thumbs);
        if( $query->have_posts() ) { 
            while( $query->have_posts() ) { 
                $query->the_post();
                $post_id = get_the_id();   
                break; 
            } 
        } 
        wp_reset_postdata();
        return $post_id;
    }

}