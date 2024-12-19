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
 * Blog Post breadcrumb
 * @author quomodosoft.com
 */
class Element_Ready_Blog_BreadCrumb extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-breadcrumb';
    }
    public function get_keywords() {
		return ['blog breadcrumb','breadcrumb'];
	}
    public function get_title() {
        return esc_html__( 'ER Breadcrumbs', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-navigation-horizontal';
    }

    public function get_style_depends() {
  
        wp_register_style( 'er-blog-breadcrumb', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/blog-breadcrumb.css',[], time() );
        return [
           'er-blog-breadcrumb'
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
			'icon_type_sep',
			[
				'label'        => esc_html__( 'Icon Seperetor?', 'element-ready-pro' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'element-ready-pro' ),
				'label_off'    => esc_html__( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
       
        $this->add_control(
			'seperetor_icon',
			[
				'label' => esc_html__( 'Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-chevron-right',
					'library' => 'solid',
				],
               
                'label_block' => true,
                'condition' => [
                    'icon_type_sep' => ['yes']
                ]
			]
		);

        $this->add_control(
			'word_seperetor',
			[
				'label' => esc_html__( 'Seperetor', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '|',
                'condition' => [
                    'icon_type_sep!' => ['yes']
                ]
			]
		);

        $this->add_control(
			'word_limit',
			[
				'label'   => esc_html__( 'Word Limit', 'element-ready-pro' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 2,
				'max'     => 200,
				'step'    => 5,
				'default' => 15,
			]
		);

        $this->add_control(
			'home_icon',
			[
				'label' => esc_html__( 'Home Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			    'label_block' => true,
        	]
		);

        $this->add_responsive_control(
			'br_text_align',
			[
				'label' => esc_html__( 'Alignment', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'element-ready-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'element-ready-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'element-ready-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .er-blog-bread-page-link'   => 'text-align:{{VALUE}};',
                
                ],
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
                                {{WRAPPER}} .er-blog-bread-page-link a
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .er-blog-bread-page-link a'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .er-blog-bread-page-link a
                            
                            ',
                        ]
                    );

                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .er-blog-bread-page-link a
                              
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
                                '{{WRAPPER}} .er-blog-bread-page-link a'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .er-blog-bread-page-link a

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
                                '{{WRAPPER}} .er-blog-bread-page-link a'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                '{{WRAPPER}} .er-blog-bread-page-link a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
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
                                '{{WRAPPER}} .er-blog-bread-page-link a'   => 'transition: {{SIZE}}s;',
                               
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
                                '{{WRAPPER}} .er-blog-bread-page-link a:hover'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .er-blog-bread-page-link a:hover
                            
                            ',
                        ]
                    );

                    $this->add_control(
                        'input_box_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .er-blog-bread-page-link a:hover'   => 'border-color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'input_box_hover_shadow',
                            'selector' => '
                                {{WRAPPER}} .er-blog-bread-page-link a:hover,
                        
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
            Icon Sepetretor TYLE
        ------------------------------*/
        $this->start_controls_section(
            'element_ready_i_seperetor_style_section',
            [
                'label' => __( 'Icon Seperetor', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_type_sep' => ['yes']
                ]
            ]
        );
      
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'seperetor_box_typography',
                    'selector' => '
                        {{WRAPPER}} .er-blog-bread-page-link i
                    
                    ',
                ]
            );

            $this->add_control(
                'seperetor__box_text_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [

                        '{{WRAPPER}} .er-blog-bread-page-link i'   => 'color:{{VALUE}};',
                        '{{WRAPPER}} .er-blog-bread-page-link svg path'   => 'fill:{{VALUE}};'
                    
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'seperetor__box_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '

                        {{WRAPPER}} .er-blog-bread-page-link i
                    
                    ',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'seperetor__box_shadow',
                    'selector' => '
                        {{WRAPPER}} .er-blog-bread-page-link i

                    ',
                ]
            );

            $this->add_responsive_control(
                'seperetor__box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [

                        '{{WRAPPER}} .er-blog-bread-page-link i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'seperetor_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .er-blog-bread-page-link i'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                    ],
                    'separator' => 'before',
                ]
            );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_is_text_style_section',
            [
                'label' => __( 'Text', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'seperetor_text_box_typography',
                    'selector' => '
                        {{WRAPPER}} .er-blog-bread-page-link                    
                    ',
                ]
            );

            $this->add_control(
                'seperetor_text_box_text_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .er-blog-bread-page-link'   => 'color:{{VALUE}};',
                   
                    
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_is_section_style_section',
            [
                'label' => __( 'Section', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'section__box_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '
                        {{WRAPPER}} .er-blog-bread-page-link
                    
                    ',
                ]
            );

            $this->add_responsive_control(
                'section_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .er-blog-bread-page-link'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                    ],
                    'separator' => 'before',
                ]
            );
      
            $this->add_responsive_control(
                'section_box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .er-blog-bread-page-link'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'section_box_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '
                        {{WRAPPER}} .er-blog-bread-page-link
                    
                    ',
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();
        /*----------------------------
            Section TYLE END
        ------------------------------*/

    }

    protected function render() {
 
       $settings       = $this->get_settings();
      
       $icon_type_sep = $settings[ 'icon_type_sep' ];
       $word_limit = $settings[ 'word_limit' ];
     
       if($icon_type_sep == 'yes'){

        $word_seperetor =  element_ready_render_icons( $settings['seperetor_icon'] , 'breadcrumb--er--icon' );
        
       }else{
        $word_seperetor = $settings[ 'word_seperetor' ];
       } 
     
       if($settings['style'] == 'style1'){

            $this->mediguss_get_breadcrumbs( $word_seperetor , $word_limit );

          }
               
		?>
  
     <?php

    }

    function mediguss_get_breadcrumbs( $seperator = ' / ', $word = '' ) {

        $settings = $this->get_settings();
        $home_icon =  element_ready_render_icons( $settings['home_icon'] , 'home-er-icon' );
        echo '<div class="er-blog-bread-page-link">';
        if ( !is_home() ) {
            echo $home_icon;
            echo '<a href="';
            echo esc_url( get_home_url( '/' ) );
            echo '">';
            echo esc_html__( 'Home', 'element-ready-pro' );
            echo "</a>" . wp_kses_post( $seperator );
            if ( is_category() || is_single() ) {
                if(is_single()){
                    $category = get_the_category();
                    if(!empty($category)) {
                        $category = get_the_category()[0];
                    }
                 }else{
                    $category = get_category( get_query_var( 'cat' ) );
                 } 
    
                 if(isset($category->term_id)){
    
                    echo '<a href='.get_category_link($category->term_id). '>';
                    $post		 = get_queried_object();
                    $postType	 = get_post_type_object( get_post_type( $post ) );
                    if ( !empty( $category ) ) {
                       echo esc_html( $category->cat_name ) . '</a> ';
                    } else if ( $postType ) {
                       echo esc_html( $postType->labels->singular_name ) . '</a>';
                    }
    
                 }
                     
                 if ( is_single()  ) {
                  if(is_singular( 'post' )){
                    echo wp_kses_post( $seperator );
                  }
                 
                   echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
                    
                 }
    
            } elseif ( is_page() ) {
                
                echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
                
            }
        }
        if ( is_tag() ) {
            single_tag_title();
        } elseif ( is_day() ) {
            esc_html_e( 'Blogs for', 'element-ready-pro' ) . " ";
                the_time( 'F jS, Y' );
            
        } elseif ( is_month() ) {
             esc_html_e( 'Blogs for', 'element-ready-pro' ) . " ";
              the_time( 'F, Y' );
            
        } elseif ( is_year() ) {
            esc_html_e( 'Blogs for', 'element-ready-pro' ) . " ";
               the_time( 'Y' );
            
        } elseif ( is_author() ) {
             esc_html_e( 'Author Blogs', 'element-ready-pro' );
            
        } elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
             esc_html_e( 'Blogs', 'element-ready-pro' );
            
        } elseif ( is_search() ) {

             esc_html_e( 'Search Result', 'element-ready-pro' );
            
        } elseif ( is_404() ) {
             esc_html_e( '404 Not Found', 'element-ready-pro' );
            
        }
        echo '</div>';
    }

}