<?php
namespace Element_Ready_Pro\Widgets\blog;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Element_Ready\Base\Repository\Base_Modal;
/**
 * Blog Post Search Form
 * @author quomodosoft.com
 */
class Element_Ready_Blog_Post_Tags extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-posts-tags';
    }
    public function get_keywords() {
		return ['blog post tags','post tags','er tags'];
	}
    public function get_title() {
        return esc_html__( 'ER Post Tags', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-post';
    }
 
    public function get_style_depends() {
        
       
        return [
           'er-blog-tags'
        ];
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'layout_contents_section',
            [
                'label' => esc_html__( 'Options', 'element-ready-pro' ),
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

         
        $this->add_control(
            'show_heading',
            [
                'label'        => esc_html__( 'Show Heading', 'element-ready-pro' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'element-ready-pro' ),
                'label_off'    => esc_html__( 'No', 'element-ready-pro' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Tags', 'element-ready-pro' ),
				'placeholder' => esc_html__( 'Type your tags here', 'element-ready-pro' ),
			]
		);

        $this->add_control(
            'heading_icon',
            [
                'label'         => esc_html__( 'Heading icon', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                
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

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_category_main_style_section',
            [
                'label' => __( 'Tags Wrapper', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_gap_content__box_n',
            [
                'label'      => __( 'Gap', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 80,
                        'step' => 2,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-ready-blog-post-tags-style1'   => 'gap: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );


        $this->end_controls_section();



        $this->start_controls_section(
            'element_ready_category_meta_content_style_section',
            [
                'label' => __( 'Tags', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'tags__content_box_tabs' );
                $this->start_controls_tab(
                    'mcategory__content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'category__content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-style1 a
                             ',
                        ]
                    );

                    $this->add_control(
                        'category_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category__content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-style1 a
                            
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category__content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-style1 a                          
                            ',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'category___box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [

                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
              
                    $this->add_responsive_control(
                        'category__content_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'category__content__box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'category__content__box_transition',
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
                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'category_content_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'category_meta_content_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-style1 a:hover'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category_hovber_content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-style1 a:hover
                            
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        /*---------------------------
            Meta STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_meta_content_style_section',
            [
                'label' => __( 'Heading', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'meta_content_box_tabs' );
                $this->start_controls_tab(
                    'meta_content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_responsive_control(
                        'tag_heading_width',
                        [
                            'label' => esc_html__( 'Width', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
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
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading' => 'flex-basis: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'     => 'meta_content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading
                             ',
                        ]
                    );

                    $this->add_control(
                        'meta_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        'meta_content_box_text_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading svg path'   => 'fill:{{VALUE}};'
                            
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'meta_content_icon_box_padding',
                        [
                            'label'      => __( 'Icon Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [

                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading svg path'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );


                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'meta_content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'meta_content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading                         
                            ',
                            'separator' => 'before',
                        ]
                    );
   
                

                    $this->add_responsive_control(
                        'meta_content_box_padding',
                        [
                            'label'      => __( 'Wrapper Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'meta_content_icon_box_paddingws',
                        [
                            'label'      => __( 'Icon Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'meta_content__box_margin',
                        [
                            'label'      => __( 'Wrapper Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element-ready-blog-post-tags-container .er-tags-heading'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                

                $this->end_controls_tab();
              

                  
            $this->end_controls_tabs();
        $this->end_controls_section();


    }

    protected function render() {
 
       $settings = $this->get_settings();
       $post_id = get_the_id();

       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
        $post_id = $settings['post_id'];
        $GLOBALS['post'] = get_post($post_id);
       }

       if ( file_exists( dirname( __FILE__ ) . '/template-parts/tags/' . $settings['style'] . '.php' ) ) {

            include('template-parts/tags/'.$settings['style'] . '.php');  

        } else {

            include('template-parts/tags/style1.php');  

        }
     ?>
  
     <?php

    }

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