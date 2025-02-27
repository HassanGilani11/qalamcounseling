<?php
namespace Element_Ready_Pro\Base\Traits\Widget_Controls\Box;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

trait ERP_Position_Style {

    public function position_css($atts) {
        
        $atts_variable = shortcode_atts(
            array(
                'title'        => esc_html__('Box Position','element-ready-pro'),
                'slug'         => '_box_style',
                'element_name' => '_element_ready_',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',
            ), $atts );

        extract($atts_variable);    

        $widget = $this->get_name().'_'.element_ready_heading_camelize($slug);
        
        $tab_start_section_args =  [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_STYLE,
        ];

        if(is_array($condition)){
            $tab_start_section_args['condition'] = $condition;
        }
        
        /*----------------------------
            ELEMENT__STYLE
        -----------------------------*/
        $this->start_controls_section(
            $widget.'_style_section',
            $tab_start_section_args
        );
 
            $this->add_responsive_control(
                $widget.'_section__'.$element_name.'_position_type',
                [
                    'label' => esc_html__( 'Position', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'fixed'    => esc_html__('Fixed','element-ready-pro'),
                        'absolute' => esc_html__('Absolute','element-ready-pro'),
                        'relative' => esc_html__('Relative','element-ready-pro'),
                        'sticky'   => esc_html__('Sticky','element-ready-pro'),
                        'static'   => esc_html__('Static','element-ready-pro'),
                        'inherit'  => esc_html__('inherit','element-ready-pro'),
                        ''         => esc_html__('none','element-ready-pro'),
                    ],
                    'selectors' => [
                        $selector => 'position: {{VALUE}};',
                       
                    ],
                    
                ]
            );
    
            $this->add_responsive_control(
                $widget.'main_section_'.$element_name.'_position_left',
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
                        $selector => 'left: {{SIZE}}{{UNIT}};',
                       
                    ],
                ]
            );
    
            $this->add_responsive_control(
                $widget.'main_section_'.$element_name.'_r_position_top',
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
                        $selector => 'top: {{SIZE}}{{UNIT}};',
                      
                    ],
                ]
            );

            $this->add_responsive_control(
                $widget.'main_section_'.$element_name.'_r_position_bottom',
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
                        $selector => 'bottom: {{SIZE}}{{UNIT}};',
                       
                    ],
                ]
            );
            $this->add_responsive_control(
                $widget.'main_section_'.$element_name.'_r_position_right',
                [
                    'label' => esc_html__( 'Position Right', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -1600,
                            'max' => 3000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                   
                    'selectors' => [
                        $selector => 'right: {{SIZE}}{{UNIT}};',
                       
                    ],
                ]
            );


        $this->end_controls_section();
        /*----------------------------
            ELEMENT__STYLE END
        -----------------------------*/
    }

}