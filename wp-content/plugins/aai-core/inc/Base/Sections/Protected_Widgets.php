<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use Element_Ready_Pro\Base\Traits\Helper as Utility;

class Protected_Widgets extends Protect_Content  {

    use Utility;  
    public function register(){
     
        if( $this->element_ready_get_modules_option('pro_protected_content') ) { 
           
            add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
            add_action( 'elementor/frontend/widget/should_render', [ $this, 'filter_section' ], 10,2 );
            add_action( 'elementor/frontend/widget/after_render', [ $this, 'after_render' ] );
        }
        add_filter( 'element_ready_pro_active_widget', [ $this ,'add_component'],12);
        
    }

    public function add_controls_section( Element_Base $element ){
                   
            $element->start_controls_section(
              'element_ready_widget_protected_section',
              [
                  'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
                  'label' => esc_html__( 'Protected Content', 'element-ready-pro' ),
              ]
            );

                $element->add_control(
                    'element_ready_pro_protected_active',
                    [
                        'label'        => esc_html__('Enable', 'element-ready-pro'),
                        'type'         => Controls_Manager::SWITCHER,
                        'default'      => '',
                        'return_value' => 'yes',
                    
                    ]
                );

                $element->add_control(
                    'elemnt_ready_pro_protected_content_enable_session',
                    [
                        'label' => esc_html__( 'Store password in user browser', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Show', 'element-ready' ),
                        'label_off' => esc_html__( 'Hide', 'element-ready' ),
                        'return_value' => 'yes',
                        'default' => '',
                        'description' => esc_html__( 'Password will be store in user agent browser when will be provided valid secrate key', 'element-ready' )
                    ]
                );


                $element->add_control(
                    'element_ready_pro_protected_password',
                    [
                        'label'       => esc_html__( 'Password', 'element-ready-pro' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => '',
                        'placeholder' => esc_html__( 'Password', 'element-ready-pro' ),
                        'description' => esc_html__( 'Provide password to reveal content', 'element-ready-pro' ),
                       
                    ]
                );

                $element->add_control(
                    'element_ready_pro_protected_button_text',
                    [
                        'label'       => esc_html__( 'Button Text', 'element-ready-pro' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => 'Submit',
                        'placeholder' => esc_html__( 'Submit', 'element-ready-pro' ),
                        
                       
                    ]
                );

                $element->add_control(
                    'element_ready_pro_protected_important_note',
                    [
                        'label' => esc_html__( 'Important Note', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::RAW_HTML,
                        'raw' => esc_html__( 'Please check change in frontend view, you will get button and input field ', 'element-ready-pro' ),
                       
                    ]
                );

            $element->end_controls_section();

            $element->start_controls_section(
                'element_ready_widget_protected_content_style_section',
                [
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    'label' => esc_html__( 'Protected Content', 'element-ready-pro' ),
                    'condition'    => [
                        'element_ready_pro_protected_active' => ['yes']
                    ]
                ]
              );

              $element->start_controls_tabs(
                'element_ready_pro_protected_style_tabs'
                
            );
        
                $element->start_controls_tab(
                    'element_ready_pro_protected_style_button_tab',
                    [
                        'label' => esc_html__( 'Button', 'element-ready-pro' ),
                        
                    ]
                );
        
                        $element->add_control(
                            'element_ready_pro_protected_button_text_color',
                            [
                                'label' => esc_html__( 'Color', 'element-ready-pro' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn' => 'color: {{VALUE}}',
                                ],
                            ]
                        );

                        
                        $element->add_group_control(
                            \Elementor\Group_Control_Typography::get_type(),
                            [
                                'name' => 'element_ready_button_bg_color_nt_typography',
                                'label' => __( 'Typography', 'element-ready-pro' ),
                                'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn',
                            ]
                        );

                        $element->add_group_control(
                            \Elementor\Group_Control_Background::get_type(),
                            [
                                'name' => 'element_ready_pro_protected_button_bg_color',
                                'label' => __( 'Background', 'element-ready-pro' ),
                                'types' => [ 'classic', 'gradient' ],
                                'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn',
                            ]
                        );
        
                        $element->add_control(
                            'element_ready_pro_protected_button_border_radious',
                            [
                                'label' => __( 'Border Radious', 'element-ready-pro' ),
                                'type' => Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%' ],
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 200,
                                        'step' => 5,
                                    ],
                                    '%' => [
                                        'min' => 0,
                                        'max' => 100,
                                    ],
                                ],
                                'default' => [
                                    'unit' => '%',
                                    'size' => 10,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                                ],
                            ]
                        );
        
                        $element->add_control(
                            'element_ready_pro_protected_button_margin',
                            [
                                'label' => __( 'Margin', 'element-ready-pro' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );
        
                        $element->add_control(
                            'element_ready_pro_protected_button_padding',
                            [
                                'label' => __( 'Padding', 'element-ready-pro' ),
                                'type' => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%', 'em' ],
                                'selectors' => [
                                    '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ]
                        );

                        $element->add_group_control(
                            \Elementor\Group_Control_Border::get_type(),
                            [
                                'name' => 'element_ready_pro_protectedbutton_border',
                                'label' => __( 'Border', 'element-ready-pr' ),
                                'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn',
                            ]
                        );

                           
                    $element->add_responsive_control(
                        'main_section_element_ready_protected_content_custom_css',
                        [
                            'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                            'type'      => \Elementor\Controls_Manager::CODE,
                            'rows'      => 20,
                            'language'  => 'css',
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-submit-btn' => '{{VALUE}};',
                              
                            ],
                            'separator' => 'before',
                        ]
                    );
        
                $element->end_controls_tab();
    
                $element->start_controls_tab(
                    'element_ready_pro_protected_input_style_tab',
                    [
                        'label' => esc_html__( 'Input', 'element-ready-pro' ),
                        'condition'    => [
                            'element_ready_pro_protected_active' => ['yes']
                        ]
                    ]
                );
        
                    $element->add_control(
                        'element_ready_pro_protected_input_text_color',
                        [
                            'label' => esc_html__( 'Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $element->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'element_ready_input_bg_color_nt_typography',
                            'label' => __( 'Typography', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl',
                        ]
                    );

                    $element->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'element_ready_pro_protected_input_bg_color',
                            'label' => __( 'Background', 'element-ready-pro' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl',
                        ]
                    );
    
                    $element->add_control(
                        'element_ready_pro_protected_input_border_radious',
                        [
                            'label' => __( 'Border Radious', 'element-ready-pro' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                    'step' => 5,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                                'size' => 10,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl' => 'border-radius: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
    
                    $element->add_control(
                        'element_ready_pro_protected_input_margin',
                        [
                            'label' => __( 'Margin', 'element-ready-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
    
                    $element->add_control(
                        'element_ready_pro_protected_input_padding',
                        [
                            'label' => __( 'Padding', 'element-ready-pro' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $element->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'element_ready_pro_protected_input_border',
                            'label' => __( 'Border', 'element-ready-pr' ),
                            'selector' => '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt .element-ready-pro-password-fl',
                        ]
                    );

                    $element->add_responsive_control(
                        '_section_element_ready_protected_content_inp_custom_css',
                        [
                            'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                            'type'      => \Elementor\Controls_Manager::CODE,
                            'rows'      => 20,
                            'language'  => 'css',
                            'selectors' => [
                                '{{WRAPPER}} .element_ready_pro_protected_content_button_cnt element-ready-pro-password-fl' => '{{VALUE}};',
                              
                            ],
                            'separator' => 'before',
                        ]
                    );
        
                $element->end_controls_tab();
    
            $element->end_controls_tabs();

            $element->end_controls_section();
    }

    public function filter_section($should , $widget){

        $settings = $widget->get_settings_for_display();
       
        return $this->is_active($settings,$widget->get_id());
    }

    
    public function after_render($widget){

        $settings    = $widget->get_settings();
        $password    = $settings['element_ready_pro_protected_password'];
        $submit_text = esc_html__( 'Submit', 'element-ready-pro' );
        
        if($settings['element_ready_pro_protected_button_text'] !=''){
            $submit_text = $settings['element_ready_pro_protected_button_text'];
        }
      
        if(!$this->is_active($settings,$widget->get_id())){
            echo '<div class="elementor-element elementor-element-'.$widget->get_id().' elementor-widget elementor-widget-'.$widget->get_name().'"  data-element_type="widget" data-widget_type="'.$widget->get_name().'">';
                echo '<div class="elementor-widget-container"> <form method="post">';
                    echo '<div class="element_ready_pro_protected_content_button_cnt">';
                            echo "<input value=" .$widget->get_id(). " type='hidden' name='element-ready-protected-id' />";
                            echo "<input name='element-ready-protected-number' class='element-ready-pro-password-fl' type='text' /> 
                            <button class='element-ready-submit-btn'>" .$submit_text. "</button>";  
                    echo "</div>";
                echo "</form> </div>";
            echo "</div>";
       } 
    }


    

   

}