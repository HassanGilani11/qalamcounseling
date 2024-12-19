<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;

class Widget_Backgound_After{
    use \Element_Ready_Pro\Base\Traits\Helper;

    public function register(){

        //if($this->element_ready_get_modules_option('section_custom_shapes')){
           // add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
        //}
    }

    public function add_controls_section( Element_Base $element ){
                  
        $element->start_controls_section(
            'element_ready_pro_widget__section',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__( 'ER Widget Background Overlay', 'element-ready-pro' ),
            ]
        );


        $element->start_controls_tabs(
			'ereadypro_widget_overlystyle_tabs'
		);

		$element->start_controls_tab(
			'er_pro_widget_bg_overlay_normal_tab',
			[
				'label' => __( 'Normal', 'element-ready-pro' ),
			]
		);

		
            $element->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'element_ready_pro_widget_overlay_background',
                    'label' => __( 'Background', 'element-ready-pro' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .elementor-widget-container::before',
                ]
            );

            $element->add_control(
                'ereadyprowidgetoverlayadvopacitycolor',
                [
                    'label'      => esc_html__( 'Opacity', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1,
                            'step' => 0.1,
                        ],
                    
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0.5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container::before' => 'opacity: {{SIZE}};',
                    ],
                ]
            );

            $element->add_control(
                'ereadyprowidgetoverloverlay_blend_mode',
                [
                    'label' => esc_html__( 'Blend Mode', 'element-ready-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__( 'Normal', 'element-ready-pro' ),
                        'multiply' => esc_html__( 'Multiply', 'element-ready-pro' ),
                        'screen' => esc_html__( 'Screen', 'element-ready-pro' ),
                        'overlay' => esc_html__( 'Overlay', 'element-ready-pro' ),
                        'darken' => esc_html__( 'Darken', 'element-ready-pro' ),
                        'lighten' => esc_html__( 'Lighten', 'element-ready-pro' ),
                        'color-dodge' => esc_html__( 'Color Dodge', 'element-ready-pro' ),
                        'saturation' => esc_html__( 'Saturation', 'element-ready-pro' ),
                        'color' => esc_html__( 'Color', 'element-ready-pro' ),
                        'luminosity' => esc_html__( 'Luminosity', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container::before' => 'mix-blend-mode: {{VALUE}}',
                    ],
                ]
            );

            $element->add_group_control(
                \Elementor\Group_Control_Css_Filter::get_type(),
                [
                'name'     => 'element_ready_pro_widget_overlay_advanced__filters',
                'selector' => '{{WRAPPER}} .elementor-widget-container::before',
                
                ]
            );

            $element->add_control(
                'er_pro_hovertoverlayadvopatransition',
                [
                    'label'      => esc_html__( 'Transition', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 20,
                            'step' => 0.1,
                        ],
                    
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0.5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container::before' => 'transition: all linear {{SIZE}}s;',
                    ],
                ]
            );

		$element->end_controls_tab();

		$element->start_controls_tab(
			'er_pro_bg_overlay_style_hover_tab',
			[
				'label' => __( 'Hover', 'element-ready' ),
			]
		);

            $element->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'er_pro_widget_bg_overlay_background',
                    'label' => __( 'Background', 'element-ready-pro' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .elementor-widget-container:hover::before',
                ]
            );

            $element->add_control(
                'er_pro_hovertoverlayadvopacitycolor',
                [
                    'label'      => esc_html__( 'Opacity', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 1,
                            'step' => 0.1,
                        ],
                    
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0.5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container:hover::before' => 'opacity: {{SIZE}};',
                    ],
                ]
            );

            $element->add_group_control(
                \Elementor\Group_Control_Css_Filter::get_type(),
                [
                'name'     => 'er_pro_widget_overlay_advanced_hover_filters',
                'selector' => '{{WRAPPER}} .elementor-widget-container:hover::before',
                
                ]
            );

		$element->end_controls_tab();

		$element->end_controls_tabs();


        $element->end_controls_section();

    }

}