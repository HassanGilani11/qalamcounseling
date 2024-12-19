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
 * Blog Post Title
 * @author quomodosoft.com
 */
class Element_Ready_Blog_Post_Image extends Widget_Base {

    public function get_name() {
        return 'element-ready-pro-blog-post-image';
    }
    public function get_keywords() {
		return ['post thumbnail','post image'];
	}
    public function get_title() {
        return esc_html__( 'ER Post thumbnail', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_style_depends() {
       
        return [
           'er-blog-post-thumb'
        ];
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
                    'label' => esc_html__( 'Demo Post Id', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => $this->get_latest_post(),
                    'placeholder' => '1'
                ]
            );

            
            $this->add_control(
                'show_cat',
                [
                    'label'        => esc_html__( 'Show Category', 'element-ready-pro' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'No', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            
            
            $this->add_control(
                'show_date',
                [
                    'label'        => esc_html__( 'Show Date', 'element-ready-pro' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'element-ready-pro' ),
                    'label_off'    => esc_html__( 'No', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );
      
            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'large',
                ]
            );
            $this->add_responsive_control(
                'title_align', [
                    'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [

                'left'		 => [
                    
                    'title' => esc_html__( 'Left', 'element-ready-pro' ),
                    'icon'  => 'eicon-text-align-left',
                
                ],
                    'center'	     => [
                    
                    'title' => esc_html__( 'Center', 'element-ready-pro' ),
                    'icon'  => 'eicon-text-align-center',
                
                ],
                'right'	 => [

                            'title' => esc_html__( 'Right', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-right',
                    
                        ],
                    'justify'	 => [

                            'title' => esc_html__( 'Justified', 'element-ready-pro' ),
                            'icon'  => 'eicon-text-align-justify',
                    
                        ],
                    ],
                'default' => 'left',
                
                    'selectors' => [
                        '{{WRAPPER}} .er-post-thumbnail-area' => 'text-align: {{VALUE}};',

                    ],
                ]
            );//Responsive control end

        $this->end_controls_section();
   
        
         /*---------------------------
            Category STYLE START
        ----------------------------*/
       

        $this->start_controls_section(
            'element_ready_category_meta_content_style_section',
            [
                'label' => __( 'Category', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['show_cat' => ['yes']]
            ]
        );
            $this->start_controls_tabs( 'category__content_box_tabs' );
                $this->start_controls_tab(
                    'mcategory__content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                $this->add_responsive_control(
                    'category_content_box_cat_r__position_left',
                    [
                        'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                       
                        'selectors' => [
                            '{{WRAPPER}} .single__random__category' => 'left: {{SIZE}}{{UNIT}};',
                           
                        ],
                    ]
                );
        
                $this->add_responsive_control(
                    'category_content_box_cat_r_position_top',
                    [
                        'label' => esc_html__( 'Position Top', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                       
                        'selectors' => [
                            '{{WRAPPER}} .single__random__category' => 'top: {{SIZE}}{{UNIT}};',
                          
                        ],
                    ]
                );
    
                    $this->add_responsive_control(
                        'category_content_box_cat_r_position_bottom',
                        [
                            'label' => esc_html__( 'Position Bottom', 'element-ready-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -2100,
                                    'max' => 3000,
                                    'step' => 5,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                        
                            'selectors' => [
                               '{{WRAPPER}} .single__random__category' => 'bottom: {{SIZE}}{{UNIT}};',
                            
                            ],
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
                        'cat_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__random__category a'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
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
            'element_ready_date_met_content_style_section',
            [
                'label' => __( 'Date', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['show_date' => ['yes']]
            ]
        );
            $this->start_controls_tabs( 'date__content_box_tabs' );
                $this->start_controls_tab(
                    'date__content_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                $this->add_responsive_control(
                    'date_content_box__r__position_left',
                    [
                        'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                       
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__thumb__date' => 'left: {{SIZE}}{{UNIT}};',
                           
                        ],
                    ]
                );
        
                $this->add_responsive_control(
                    'date_content_box_cat_r_position_top',
                    [
                        'label' => esc_html__( 'Position Top', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                       
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__thumb__date' => 'top: {{SIZE}}{{UNIT}};',
                          
                        ],
                    ]
                );
    
                    $this->add_responsive_control(
                        'date_content_box_cat_r_position_bottom',
                        [
                            'label' => esc_html__( 'Position Bottom', 'element-ready-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => -2100,
                                    'max' => 3000,
                                    'step' => 5,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                        
                            'selectors' => [
                               '{{WRAPPER}} .element__ready__thumb__date' => 'bottom: {{SIZE}}{{UNIT}};',
                            
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'date__content_box_typography',
                            'selector' => '
                                {{WRAPPER}} .element__ready__thumb__date a
                             ',
                        ]
                    );

                    $this->add_control(
                        'date_content_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__thumb__date a'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'date__content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element__ready__thumb__date a
                            
                            ',
                        ]
                    );
               
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'date__content_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .element__ready__thumb__date a                          
                            ',
                            'separator' => 'before',
                        ]
                    );


                    $this->add_responsive_control(
                        'date_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__thumb__date a'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );
   
              
                    $this->add_responsive_control(
                        'date__content_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__thumb__date a'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'date__content__box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__thumb__date a'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'date__content__box_transition',
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
                                '{{WRAPPER}} .element__ready__thumb__date a'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'date_content_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'date_meta_content_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__thumb__date a:hover'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'date_hovber_content_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .element__ready__thumb__date a:hover
                            
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render() {
 
       $settings       = $this->get_settings();
       $thumbnail_size = $settings['thumbnail_size'];
       $post_id        = get_the_id();
       
       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
        $post_id = $settings['post_id'];
        $GLOBALS['post'] = get_post($post_id);
       }
        
       if ( has_post_thumbnail() ) {

            echo '<div class="er-post-thumbnail-area">';
     
                    $categories = get_the_category();

                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                    
                        echo sprintf('<div class="single__random__category"><a href="%s">%s</a></div>',
                        get_term_link($categories[0]),
                        esc_html( $categories[0]->name )
                    );

                    if($settings['show_date'] == 'yes'){
                       echo sprintf('<div class="element__ready__thumb__date"> <a href="%s">%s</a></div>',
                        esc_url( get_day_link( get_the_time( 'Y' ),  get_the_time( 'm' ), get_the_time( 'd' ) )),
                        get_the_date(get_option( 'date_format' ))
                    ); 
                    }
                }
 
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbnail_size);
                if ( ! empty( $large_image_url[0] ) ) {
                    echo get_the_post_thumbnail( $post_id , $thumbnail_size ); 
                }

            echo '</div>';
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