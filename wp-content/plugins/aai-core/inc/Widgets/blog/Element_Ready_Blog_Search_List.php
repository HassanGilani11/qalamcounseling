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
class Element_Ready_Blog_Search_List extends  Widget_Base {

    public function get_name() {
        return 'element-ready-blog-search-posts';
    }

    public function get_keywords() {
		return ['blog post links','post link'];
	}

    public function get_title() {
        return esc_html__( 'ER Post List', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-navigation-horizontal';
    }
 
    public function get_style_depends() {
        
        return [
           'er-blog-post-list'
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

        $this->add_control(
			'is_search_page',
			[
				'label'        => esc_html__( 'Is Search Page', 'element-ready-pro' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'element-ready-pro' ),
				'label_off'    => esc_html__( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

        $this->end_controls_section();

        do_action( 'element_ready_section_general_blog_search_grid', $this, $this->get_name() );
        do_action( 'element_ready_section_data_exclude_tab', $this , $this->get_name() );  
        do_action( 'element_ready_section_date_filter_tab', $this , $this->get_name());  
        do_action( 'element_ready_section_taxonomy_filter_tab', $this , $this->get_name());  
        do_action( 'element_ready_section_sort_tab', $this , $this->get_name());  
        do_action( 'element_ready_section_sticky_tab', $this , $this->get_name());  
        
         /*---------------------------
            Title STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_style_section',
            [
                'label' => __( 'Title', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'input_box_tabs' );
                $this->start_controls_tab(
                    'title_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'title_box_typography',
                            'selector' => '
                                {{WRAPPER}} .post-title a
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'title_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .post-title a'   => 'color:{{VALUE}};'
                            
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'title_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .post-title
                            
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'title_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .post-title                              
                            ',
                            'separator' => 'before',
                        ]
                    );
   
              
                    $this->add_responsive_control(
                        'title_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .post-title'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'title_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .post-title'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'title_box_transition',
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
                                '{{WRAPPER}} .post-title a'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'title_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post-title:hover a'   => 'color:{{VALUE}};',
                           
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'title_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                            {{WRAPPER}} .post-title:hover
                          
                        ',
                    ]
                );

                $this->add_control(
                    'title_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post-title:hover'   => 'border-color:{{VALUE}};',
                          
                        ],
                    ]
                );

          
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            Title STYLE END
        -------------------------------*/
        
        /*---------------------------
            Content STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_content_style_section',
            [
                'label' => __( 'Content', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'content_box_tabs' );
                $this->start_controls_tab(
                    'content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .post-content p,
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .post-content p'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .post-content
                            
                            ',
                        ]
                    );

               

                    $this->add_responsive_control(
                        'content__box_margin',
                        [
                            'label'      => __( 'Content Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .post-content'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'content__box_transition',
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
                                '{{WRAPPER}} .post-content p'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'content__box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                $this->add_control(
                    'content_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post-content:hover p'   => 'color:{{VALUE}};',
                           
                        ],
                    ]
                );


                $this->add_control(
                    'content__box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post-content:hover'   => 'border-color:{{VALUE}};',
                          
                        ],
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_sticky_meta_content_style_section',
            [
                'label' => __( 'Sticky', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'sticky__content_box_tabs' );
                $this->start_controls_tab(
                    'sticky__content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'stickycontent_box_typography',
                            'selector' => '{{WRAPPER}} .sticky-meta-featured i'
                        ]
                    );

                    $this->add_control(
                        'sticky_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sticky-meta-featured i'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'sticky__content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .sticky-meta-featured
                            
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'sticky_content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .sticky-meta-featured                          
                            ',
                            'separator' => 'before',
                        ]
                    );
   
              
                    $this->add_responsive_control(
                        'sticky_content_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sticky-meta-featured'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'sticky_content__box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sticky-meta-featured'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'sticky__content__box_transition',
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
                                '{{WRAPPER}} .sticky-meta-featured'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'sticky_content_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'sticky_meta_content_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sticky-meta-featured:hover i'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'sticky_hovber_content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .sticky-meta-featured:hover
                            
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_category_meta_content_style_section',
            [
                'label' => __( 'Category', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'category__content_box_tabs' );
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
                                {{WRAPPER}} .single__random__category a
                             ',
                        ]
                    );

                    $this->add_control(
                        'category_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__random__category a'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .single__random__category a
                            
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category__content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .single__random__category a                          
                            ',
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
                                '{{WRAPPER}} .single__random__category a'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                '{{WRAPPER}} .single__random__category a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
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
                                '{{WRAPPER}} .single__random__category a'   => 'transition: {{SIZE}}s;',
                               
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
                                '{{WRAPPER}} .single__random__category a:hover'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .single__random__category a:hover
                            
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_creadmore__meta_content_style_section',
            [
                'label' => __( 'ReadMore', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'readmore___content_box_tabs' );
                $this->start_controls_tab(
                    'readmore___content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'readmore___content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .posts__readmore a
                             ',
                        ]
                    );

                    $this->add_control(
                        'readmore__content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .posts__readmore a'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        'readmore_icon_content_box_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .posts__readmore i'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore__content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .posts__readmore',             
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'readmore__content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .posts__readmore                         
                            ',
                            'separator' => 'before',
                        ]
                    );
   
              
                    $this->add_responsive_control(
                        'readmore__content_box_padding',
                        [
                            'label'      => __( 'Wrapper Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .posts__readmore'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_wr_content_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .posts__readmore a'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
   

                    $this->add_responsive_control(
                        'readmore__content__box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .posts__readmore a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_icon_content__box_margin',
                        [
                            'label'      => __( 'Icon Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .posts__readmore a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'readmore__content__box_transition',
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
                                '{{WRAPPER}} .posts__readmore a'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'readmore__content_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'readmore__meta_content_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .posts__readmore a:hover'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    
                    $this->add_control(
                        'readmore_icon_content_boxihover_text_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .posts__readmore:hover i'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_hovber_content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .posts__readmore:hover
                            
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
                'label' => __( 'Meta Content', 'element-ready-pro' ),
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
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'     => 'meta_content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .posts__bottom__meta.style1 a,
                                {{WRAPPER}} .posts__bottom__meta.style2 .er-meta a 
                             ',
                        ]
                    );

                    $this->add_control(
                        'meta_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style1 a'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style2 .er-meta a'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        'meta_content_box_text_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style2 i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-right > div i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-right > div svg path'   => 'fill:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div svg path'   => 'fill:{{VALUE}};'
                            
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

                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style2 i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-right > div i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-right > div svg path'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div svg path'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                {{WRAPPER}} .posts__bottom__meta
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'meta_content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .posts__bottom__meta                          
                            ',
                            'separator' => 'before',
                        ]
                    );
   
              
                    $this->add_responsive_control(
                        'meta_content_single_box_padding',
                        [
                            'label'      => __( 'Item Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .posts__bottom__meta .er-post-meta-left > div'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .posts__bottom__meta.style2 .er-meta'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
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
                                '{{WRAPPER}} .posts__bottom__meta'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
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
                                '{{WRAPPER}} .posts__bottom__meta'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'meta_content__box_transition',
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
                                '{{WRAPPER}} .posts__bottom__meta a'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'meta_content_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        's_meta_content_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style1 a:hover'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .element-ready-post-container-style1 .posts__bottom__meta.style2 .er-meta a:hover'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        's_meta_contenticon_box_hover_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div:hover i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style2 div:hover i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style1 .er-post-meta-left > div:hover svg path'   => 'fill:{{VALUE}};',
                                '{{WRAPPER}} .posts__bottom__meta.style2 div:hover svg path'   => 'fill:{{VALUE}};',
                            
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_form_content_style_wrapper_section',
            [
                'label' => __( 'Content Wrapper', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'content_wrapper_box_border',
                    'label'    => __( 'Wrapper Border', 'element-ready-pro' ),
                    'selector' => '
                        {{WRAPPER}} .post-details                             
                    ',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => '_content_wrapper_box_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '
                        {{WRAPPER}} .post-details
                    ',
                ]
            );

            $this->add_responsive_control(
                'content_wrapper_box_padding',
                [
                    'label'      => __( 'Wrapper Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .post-details'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_wrapper_box_background_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .post-details',
                ]
            );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_article_content_style_wrapper_section',
            [
                'label' => __( 'Article', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'article_wrapper_box_border',
                    'label'    => __( ' Border', 'element-ready-pro' ),
                    'selector' => '
                        {{WRAPPER}} .element-ready-post-container-style1 .single-post-item                             
                    ',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'article_wrapper_box_padding',
                [
                    'label'      => __( ' Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element-ready-post-container-style1 .single-post-item'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'article_wrapper_box_margin',
                [
                    'label'      => __( ' Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element-ready-post-container-style1 .single-post-item'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'article_wrapper_box_background_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element-ready-post-container-style1 .single-post-item',
                ]
            );
        
        $this->end_controls_section();



    }

    protected function render() {
 
      $settings = $this->get_settings();
      $is_search_page = $settings['is_search_page'];
      if(($is_search_page =='yes' && is_search()) || element_ready_lite_is_blog()){
        global $wp_query;
        $wp_query = $wp_query;
      }else{
        $data  = new Base_Modal($settings);
        $wp_query = $data->get();
       
      }
     
      if(!$wp_query){
        return;  
      }
     
       if ( file_exists( dirname( __FILE__ ) . '/template-parts/' . $settings['style'] . '.php' ) ) {

            include('template-parts/'.$settings['style'] . '.php');  

        } else {

            include('template-parts/style1.php');  

        }
     ?>
  
     <?php

    }

}