<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready_Pro\Base\Traits\Helper;

class Widget_Text_Strok {

    use Helper;
    public function register(){

        if($this->element_ready_get_modules_option('widget_text_stroke')){
            add_action( 'elementor/element/heading/section_title_style/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/text-editor/section_style/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/image-box/section_image/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/icon-box/section_style_icon/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/progress/section_progress_style/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/alert/section_type/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Area_Title_Widget/title_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/counter/section_title/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Animate_Headline/_heading_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Box_Widget/title_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Business_Hours_Widget/header_title_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Dual_Text/_dualtext_first_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Teams_Widget/name_style_section/after_section_end', [ $this, 'add_controls_section' ], 10 );
           
            add_action( 'elementor/element/image-box/section_image/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/icon-box/section_style_icon/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/alert/section_type/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Area_Title_Widget/title_style_section/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Box_Widget/title_style_section/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Dual_Text/_dualtext_last_style_section/after_section_end', [ $this, 'desc_controls_section' ], 10 );
            add_action( 'elementor/element/Element_Ready_Teams_Widget/description_style_section/after_section_end', [ $this, 'desc_controls_section' ], 10 );
        }
    }

   

    public function add_controls_section( Element_Base $element ){

        $element->start_controls_section(
            'element_ready_pro_widget_text_strok_section',
            [
                
                'label' => esc_html__( 'Text Stroke', 'element-ready-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
          );

          $element->add_control(
			'er_pro_text_strok_color',
			[
				'label' => __( 'Color', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-text-editor' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-image-box-title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-box-title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-alert-title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .area__title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .counter__title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .ah-headline' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .box__title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .business__hour__header__title' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .dual__text__first' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .member__name' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);

        $element->add_control(
            'er_pro_text_strok_width',
            [
                'label'      => esc_html__( 'Width', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-text-editor' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-image-box-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-icon-box-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-alert-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .area__title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .counter__title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ah-headline' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .box__title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .business__hour__header__title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dual__text__first' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .member__name' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
  
        $element->end_controls_section();
    }
    public function desc_controls_section( Element_Base $element ){

        $element->start_controls_section(
            'element_ready_pro_widget_text_strok_desc_section',
            [
                
                'label' => esc_html__( 'Desc Text Stroke', 'element-ready-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
          );

          $element->add_control(
			'er_pro_text_strok_desc_color',
			[
				'label' => __( 'Color', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-description' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-box-description' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-alert-description' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .area__description' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .box__description' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .dual__text__last' => '-webkit-text-stroke-color: {{VALUE}}',
					'{{WRAPPER}} .member__description' => '-webkit-text-stroke-color: {{VALUE}}',
				
				],
			]
		);

        $element->add_control(
            'er_pro_text_strok_desc_width',
            [
                'label'      => esc_html__( 'Width', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-icon-box-description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-alert-description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .area__description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .box__description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .dual__text__last' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .member__description' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
               
                ],
            ]
        );
  
        $element->end_controls_section();
    }

}