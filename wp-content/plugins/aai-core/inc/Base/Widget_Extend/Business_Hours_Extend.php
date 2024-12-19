<?php 
namespace Element_Ready_Pro\Base\Widget_Extend;
use Element_Ready\Base\BaseController;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use \Element_Ready_Pro\Base\Traits\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

class Business_Hours_Extend extends BaseController{
     use Helper;
    public function register() {
       
        add_filter( 'element_ready_business_hour_style_presets', [$this,'business_hour_style_presets'] );

        add_filter( 'element_ready_business_hour_wrap_pro_message', [$this,'business_hour_pro_message'], 10, 2 );
        add_action( 'element_ready_business_hour_wrap_styles', [$this, 'business_hour_wrap_pro_styles'] );

        add_filter( 'element_ready_business_hour_title_pro_message', [$this,'business_hour_pro_message'], 10, 2 );
        add_action( 'element_ready_business_hour_title_styles', [$this, 'business_hour_title_pro_styles'] );

        add_filter( 'element_ready_business_hour_day_pro_message', [$this,'business_hour_pro_message'], 10, 2 );
        add_action( 'element_ready_business_hour_day_styles', [$this, 'business_hour_day_pro_styles'] );

    }
       
    public function business_hour_style_presets(){
        return [
            'element__ready__business__hour__style__1' => __( 'Style One', 'element-ready' ),
            'element__ready__business__hour__style__2' => __( 'Style Two', 'element-ready' ),
            'element__ready__business__hour__style__3' => __( 'Style Three', 'element-ready' ),
            'custom'                                   => __( 'Custom Style', 'element-ready' ),
        ];
    }

    public function business_hour_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function business_hour_wrap_pro_styles( $element ){
      
        $element->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'wrapper_background',
                'label'    => __( 'Background', 'element-ready' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .element__ready__info__box__wrap',
            ]
        );
        $element->add_responsive_control(
            'wrapper_align',
            [
                'label'   => __( 'Alignment', 'element-ready' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'element-ready' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'element-ready' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'element-ready' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'element-ready' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element__ready__info__box__wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .element__ready__info__box__wrap',
            ]
        );
        $element->add_responsive_control(
            'wrapper_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__info__box__wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'wrapper_shadow',
                'selector' => '{{WRAPPER}} .element__ready__info__box__wrap',
            ]
        );

        $element->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__info__box__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__info__box__wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function business_hour_title_pro_styles( $element ){
       
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'header_title_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .business__hour__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .business__hour__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'header_title_shadow',
                'selector' => '{{WRAPPER}} .business__hour__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .business__hour__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'header_title_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .business__hour__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'header_title_align',
            [
                'label'   => __( 'Alignment', 'element-ready' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'element-ready' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'element-ready' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'element-ready' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'element-ready' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .business__hour__header__title h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    }

    public function business_hour_day_pro_styles( $element ){
        $element->start_controls_tabs( 'box_style_tabs' );
            $element->start_controls_tab(
                'box_style_normal_tab',
                [
                    'label' => __( 'Normal', 'element-ready' ),
                ]
            );
                $element->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'box_typography',
                        'selector' => '{{WRAPPER}} .single__business__hours',
                    ]
                );
                $element->add_control(
                    'box_color',
                    [
                        'label'     => __( 'Color', 'element-ready' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'box_background',
                        'label'    => __( 'Background', 'element-ready' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .single__business__hours',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'box_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__business__hours',
                    ]
                );
                $element->add_responsive_control(
                    'box_border_radius',
                    [
                        'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'after',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'      => 'box_box_shadow',
                        'label'     => __( 'Box Shadow', 'element-ready' ),
                        'selector'  => '{{WRAPPER}} .single__business__hours',
                        'separator' => 'before',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Text_Shadow:: get_type(),
                    [
                        'name'     => 'box_text_shadow',
                        'label'    => __( 'Text Shadow', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__business__hours',
                    ]
                );
                $element->add_responsive_control(
                    'business_day_width',
                    [
                        'label'      => __( 'Day Name Width', 'element-ready' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .business__hour__day' => 'min-width: {{SIZE}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_responsive_control(
                    'box_width',
                    [
                        'label'      => __( 'Width', 'element-ready' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_responsive_control(
                    'box_height',
                    [
                        'label'      => __( 'Height', 'element-ready' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'box_position',
                    [
                        'label'   => __( 'Position', 'element-ready' ),
                        'type'    => Controls_Manager::SELECT,
                        'options' => [
                            'initial'  => __( 'Initial', 'element-ready' ),
                            'absolute' => __( 'Absulute', 'element-ready' ),
                            'relative' => __( 'Relative', 'element-ready' ),
                            'static'   => __( 'Static', 'element-ready' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'box_margin',
                    [
                        'label'      => __( 'Margin', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__business__hours' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_responsive_control(
                    'box_padding',
                    [
                        'label'      => __( 'Padding', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__business__hours' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_control(
                    'box_transition',
                    [
                        'label'      => __( 'Transition', 'element-ready' ),
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
                            '{{WRAPPER}} .single__business__hours' => 'transition: {{SIZE}}s;',
                        ],
                    ]
                );
                $element->add_control(
                    'separator_hour_style_heading',
                    [
                        'label' => __( 'Separator Style', 'element-ready' ),
                        'type'  => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $element->add_control(
                    'separator_hour_size',
                    [
                        'label'      => __( 'Separator Size', 'element-ready' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min'  => 1,
                                'max'  => 1000,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .business__hour__separator' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .business__hour__separator i' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .business__hour__separator img' => 'width: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .business__hour__separator svg' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_responsive_control(
                    'separator_hour_margin',
                    [
                        'label'      => __( 'Separator Margin', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .business__hour__separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'separator_hour_padding',
                    [
                        'label'      => __( 'Separator Padding', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .business__hour__separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $element->end_controls_tab();
            $element->start_controls_tab(
                'box_style_hover_tab',
                [
                    'label' => __( 'Hover', 'element-ready' ),
                ]
            );
                $element->add_control(
                    'box_hover_color',
                    [
                        'label'     => __( 'Color', 'element-ready' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours:hover' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'box_hover_background',
                        'label'    => __( 'Background', 'element-ready' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .single__business__hours:hover',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'box_hover_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__business__hours:hover',
                    ]
                );
                $element->add_responsive_control(
                    'box_hover_border_radius',
                    [
                        'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'after',
                    ]
                );
            $element->end_controls_tab();
        $element->end_controls_tabs();
    }

}