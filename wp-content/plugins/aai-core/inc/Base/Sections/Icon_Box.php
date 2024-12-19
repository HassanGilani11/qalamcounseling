<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready\Controls\Custom_Controls_Manager;


class Icon_Box {

    use \Element_Ready_Pro\Base\Traits\Helper;
    public function register(){
    
        add_action( 'elementor/element/image-box/section_image/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
        add_action( 'elementor/element/icon/section_style_icon/after_section_end', [ $this, 'add_icon_widget_controls_section' ] ,12, 2);
       
    }

   

    public function add_icon_widget_controls_section( $element, $args ){
        $element->start_controls_section(
            'element_ready_pro_icon_widget_size_section',
            [
                
                'label' => esc_html__( 'ER SVG', 'element-ready-pro' ),
            ]
          );

            $element->add_control(
                'er_pro_icon_widgtet_svg_auto',
                [
                    'label' => esc_html__( 'Size', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'auto' => esc_html__( 'Auto', 'element-ready-pro' ),
                        'custom'  => esc_html__( 'Custom', 'element-ready-pro' ),
                    ],
                  
                ]
            );

            $element->add_control(
                'er_pro_icon_widgtet_svg_width',
                [
                    'label'      => esc_html__( 'Width', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px','%'],
                    'condition' => [
                        'er_pro_icon_widgtet_svg_auto' => ['custom']
                    ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 900,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                
                    'selectors'  => [
                        '{{WRAPPER}} .elementor-icon svg'=> 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .elementor-icon i'=> 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $element->add_control(
                'er_pro_icon_widgtet_svg_heigth',
                [
                    'label'      => esc_html__( 'height', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px','%'],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 800,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'condition' => [
                        'er_pro_icon_widgtet_svg_auto' => ['custom']
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .elementor-icon svg'=> 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .elementor-icon i'=> 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

          $element->end_controls_section();
    }
    public function add_controls_section( $element, $args ){
     
        $element->start_controls_section(
            'element_ready_widget_image_hover_effect_section',
            [
                
                'label' => esc_html__( 'Hover Effect', 'element-ready-pro' ),
            ]
          );

             
          $element->add_control(
			'widget_image_box_hover_effect_margin',
			[
				'label' => esc_html__( 'Margin', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $element->add_control(
            'ele_box__image_hover_boxtransition',
            [
                'label'      => esc_html__( 'Transition', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-wrapper' => 'transition: {{SIZE}}s;',

                ],
            ]
        );

        $element->add_control(
            'ele_box__image_hover_box_translatey',
            [
                'label'      => esc_html__( 'Translate Y', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ],
                ],
               
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-wrapper:hover'=> 'transform: translateY({{SIZE}}{{UNIT}});',

                ],
            ]
        );

        $element->add_control(
            'ele_box__image_hover_box_translate_x',
            [
                'label'      => esc_html__( 'Translate X', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ],
                ],
               
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-wrapper:hover'=> 'transform: translateX({{SIZE}}{{UNIT}});',

                ],
            ]
        );
       
        $element->end_controls_section();
    }

 
   
}