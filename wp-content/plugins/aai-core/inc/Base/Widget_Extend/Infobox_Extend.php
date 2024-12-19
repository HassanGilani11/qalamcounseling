<?php 
namespace Element_Ready_Pro\Base\Widget_Extend;
use Element_Ready\Base\BaseController;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

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

class Infobox_Extend extends BaseController{

    public function register() {

        add_filter( 'element_ready_infobox_style_presets', [$this, 'infobox_style_presets'] );

        add_filter( 'element_ready_infobox_wrap_pro_message', [$this,'infobox_pro_message'], 10, 2 );
        add_action( 'element_ready_infobox_wrap_styles', [$this, 'infobox_wrap_pro_styles'] );

        add_filter( 'element_ready_infobox_header_pro_message', [$this,'infobox_pro_message'], 10, 2 );
        add_action( 'element_ready_infobox_header_styles', [$this, 'infobox_header_pro_styles'] );

        add_filter( 'element_ready_infobox_icon_pro_message', [$this,'infobox_pro_message'], 10, 2 );
        add_action( 'element_ready_infobox_icon_styles', [$this, 'infobox_icon_pro_styles'] );

        add_filter( 'element_ready_infobox_icon_hover_pro_message', [$this,'infobox_pro_message'], 10, 2 );
        add_action( 'element_ready_infobox_icon_hover_styles', [$this, 'infobox_icon_hover_pro_styles'] );

        add_filter( 'element_ready_infobox_box_pro_message', [$this,'infobox_pro_message'], 10, 2 );
        add_action( 'element_ready_infobox_box_styles', [$this, 'infobox_box_pro_styles'] );

    }

    public function infobox_style_presets(){
        return [
            'element__ready__infobox__style__1' => __( 'Style One', 'element-ready' ),
            'element__ready__infobox__style__2' => __( 'Style Two', 'element-ready' ),
            'element__ready__infobox__style__3' => __( 'Style Three', 'element-ready' ),
            'custom'                      => __( 'Custom Style', 'element-ready' ),
        ];
    }

    public function infobox_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function infobox_wrap_pro_styles( $element ){
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

    public function infobox_header_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'header_title_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .info__box__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info__box__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'header_title_shadow',
                'selector' => '{{WRAPPER}} .info__box__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info__box__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .info__box__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .info__box__header__title h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    }

    public function infobox_icon_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'icon_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .info__box__icon',
            ]
        );
        $element->add_responsive_control(
            'icon_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info__box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .info__box__icon',
            ]
        );
        $element->add_responsive_control(
            'icon_align',
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
                    '{{WRAPPER}} .info__box__icon' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_display',
            [
                'label'   => __( 'Display', 'element-ready' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'initial'      => __( 'Initial', 'element-ready' ),
                    'block'        => __( 'Block', 'element-ready' ),
                    'inline-block' => __( 'Inline Block', 'element-ready' ),
                    'flex'         => __( 'Flex', 'element-ready' ),
                    'inline-flex'  => __( 'Inline Flex', 'element-ready' ),
                    'none'         => __( 'none', 'element-ready' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .info__box__icon' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $element->add_responsive_control(
            'icon_position',
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
                    '{{WRAPPER}} .info__box__icon' => 'position: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_position_from_left',
            [
                'label'      => __( 'From Left', 'element-ready' ),
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
                    '{{WRAPPER}} .info__box__icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => ['absolute','relative']
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_position_from_right',
            [
                'label'      => __( 'From Right', 'element-ready' ),
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
                    '{{WRAPPER}} .info__box__icon' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => ['absolute','relative']
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_position_from_top',
            [
                'label'      => __( 'From Top', 'element-ready' ),
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
                    '{{WRAPPER}} .info__box__icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => ['absolute','relative']
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_position_from_bottom',
            [
                'label'      => __( 'From Bottom', 'element-ready' ),
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
                    '{{WRAPPER}} .info__box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => ['absolute','relative']
                ],
            ]
        );
        $element->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info__box__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $element->add_responsive_control(
            'icon_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info__box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_control(
            'icon_transition',
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
                    '{{WRAPPER}} .info__box__icon' => 'transition: {{SIZE}}s;',
                ],
            ]
        );
    }

    public function infobox_icon_hover_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'hover_icon_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .single__info__box:hover .info__box__icon',
            ]
        );
        $element->add_responsive_control(
            'hover_icon_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .single__info__box:hover .info__box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'hover_icon_shadow',
                'selector' => '{{WRAPPER}} .single__info__box:hover .info__box__icon',
            ]
        );
    }

    public function infobox_box_pro_styles( $element ){
        $element->start_controls_tabs( 'box_style_tabs' );
            $element->start_controls_tab(
                'box_style_normal_tab',
                [
                    'label' => __( 'Normal', 'element-ready' ),
                ]
            );

                $element->add_responsive_control(
                    'box_style_text_align',
                    [
                        'label' => esc_html__( 'Alignment', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'options' => [
                            'left' => [
                                'title' => esc_html__( 'Left', 'element-ready' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'element-ready' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => esc_html__( 'Right', 'element-ready' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'default' => 'center',
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box .info__details' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );

                $element->add_responsive_control(
                    '_detail__display',
                    [
                        'label'   => __( 'Display', 'element-ready' ),
                        'type'    => Controls_Manager::SELECT,
                        'options' => [
                            'initial'      => __( 'Initial', 'element-ready' ),
                            'block'        => __( 'Block', 'element-ready' ),
                            'inline-block' => __( 'Inline Block', 'element-ready' ),
                            'flex'         => __( 'Flex', 'element-ready' ),
                            'inline-flex'  => __( 'Inline Flex', 'element-ready' ),
                            'none'         => __( 'none', 'element-ready' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box' => 'display: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );

                $element->add_responsive_control(
                    '_detail__display_gap',
                    [
                        'label' => esc_html__( 'Gap', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                                'step' => 5,
                            ],
                           
                        ],
                       
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box' => 'gap: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            '_detail__display' => [
                                'flex','inline-flex'
                            ]
                        ]
                    ]
                );

                $element->add_responsive_control(
                    'er_pro_exten_flex_align',
                    [
                        'label' => esc_html__( 'Horizontal Alignment', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                            'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                            'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                            'space-around'  => esc_html__( 'Space Around', 'element-ready-pro' ),
                            'space-between' => esc_html__( 'Space Between', 'element-ready-pro' ),
                            'space-evenly'  => esc_html__( 'Space Evenly', 'element-ready-pro' ),
                            ''              => esc_html__( 'inherit', 'element-ready-pro' ),
                        ],

                        'condition' => [
                            '_detail__display' => [
                                'flex','inline-flex'
                            ]
                        ],

                        'selectors' => [
                            '{{WRAPPER}} .single__info__box' => 'justify-content: {{VALUE}};'
                    ],
                    ]
                    
                );

                $element->add_responsive_control(
                    'er_pro_exten_flex_align_items',
                    [
                        'label' => esc_html__( 'Vertical Alignment', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'flex-start'    => esc_html__( 'Start', 'element-ready-pro' ),
                            'flex-end'      => esc_html__( 'End', 'element-ready-pro' ),
                            'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                            'baseline'        => esc_html__( 'Baseline', 'element-ready-pro' ),
                            ''              => esc_html__( 'inherit', 'element-ready-pro' ),
                        ],

                        'condition' => [
                            '_detail__display' => [
                                'flex','inline-flex'
                            ]
                        ],

                        'selectors' => [
                            '{{WRAPPER}} .single__info__box' => 'align-items: {{VALUE}};'
                    ],
                    ]
                    
                );
                 
                $element->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'box_typography',
                        'selector' => '{{WRAPPER}} .single__info__box .info__details',
                    ]
                );
                $element->add_control(
                    'box_color',
                    [
                        'label'     => __( 'Color', 'element-ready' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box .info__details' => 'color: {{VALUE}};',
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
                        'selector' => '{{WRAPPER}} .single__info__box',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'box_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__info__box',
                    ]
                );
                $element->add_responsive_control(
                    'box_border_radius',
                    [
                        'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'after',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'      => 'box_box_shadow',
                        'label'     => __( 'Box Shadow', 'element-ready' ),
                        'selector'  => '{{WRAPPER}} .single__info__box',
                        'separator' => 'before',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Text_Shadow:: get_type(),
                    [
                        'name'     => 'box_text_shadow',
                        'label'    => __( 'Text Shadow', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__info__box',
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
                            '{{WRAPPER}} .single__info__box' => 'width: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .single__info__box' => 'height: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .single__info__box' => 'position: {{VALUE}};',
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
                            '{{WRAPPER}} .single__info__box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );

                $element->add_responsive_control(
                    'box_inner_content_margin',
                    [
                        'label'      => __( 'Title Content Margin', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .info__details p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .single__info__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .single__info__box' => 'transition: {{SIZE}}s;',
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
                            '{{WRAPPER}} .single__info__box:hover' => 'color: {{VALUE}};',
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
                        'selector' => '{{WRAPPER}} .single__info__box:hover',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'box_hover_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .single__info__box:hover',
                    ]
                );
                $element->add_responsive_control(
                    'box_hover_border_radius',
                    [
                        'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'after',
                    ]
                );
            $element->end_controls_tab();
        $element->end_controls_tabs();
    }

}