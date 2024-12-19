<?php

namespace Element_Ready_Pro\Base\Widget_Extend;

use Element_Ready\Base\BaseController;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

class Counter_Extend extends BaseController
{

    public function register()
    {

        add_filter('element_ready_counter_icon_pro_message', [$this, 'counter_pro_message'], 10, 2);
        add_action('element_ready_counter_icon_styles', [$this, 'counter_icon_pro_styles']);

        add_filter('element_ready_counter_number_pro_message', [$this, 'counter_pro_message'], 10, 2);
        add_action('element_ready_counter_number_styles', [$this, 'counter_number_pro_styles']);

        add_filter('element_ready_counter_box_pro_message', [$this, 'counter_pro_message'], 10, 2);
        add_action('element_ready_counter_box_styles', [$this, 'counter_box_pro_styles']);
    }

    public function counter_pro_message($get_default, $merge)
    {

        $options = [];
        if ($merge) {
            $return_opt['controls'] = array_merge($options, $get_default['controls']);
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;
    }

    public function counter_icon_pro_styles($element)
    {
        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'label'    => __('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} .counter__icon',
            ]
        );

        $element->add_responsive_control(
            'icon_radius',
            [
                'label'      => __('Border Radius', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .counter__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .counter__icon',
            ]
        );

        $element->add_responsive_control(
            'icon_float',
            [
                'label'   => __('Float', 'element-ready'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  =>  __('Left', 'element-ready'),
                    'right' =>  __('Right', 'element-ready'),
                    'none'  =>  __('None', 'element-ready'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon' => 'float:{{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'icon_display',
            [
                'label'   => __('Display', 'element-ready'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'initial'      => __('Initial', 'element-ready'),
                    'block'        => __('Block', 'element-ready'),
                    'inline-block' => __('Inline Block', 'element-ready'),
                    'flex'         => __('Flex', 'element-ready'),
                    'inline-flex'  => __('Inline Flex', 'element-ready'),
                    'none'         => __('none', 'element-ready'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon' => 'display: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'icon_width',
            [
                'label'      => __('Width', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .counter__icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'icon_height',
            [
                'label'      => __('Height', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .counter__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'separator' => 'before',
            ]
        );

        $element->add_responsive_control(
            'icon_padding',
            [
                'label'      => __('Padding', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .counter__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'icon_align',
            [
                'label'   => __('Alignment', 'element-ready'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'element-ready'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'element-ready'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'element-ready'),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justify', 'element-ready'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $element->add_control(
            'icon_transition',
            [
                'label'      => __('Transition', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
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
                    '{{WRAPPER}} .counter__icon,{{WRAPPER}} .counter__icon img' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $element->add_control(
            'icon_opacity',
            [
                'label'      => __('Opacity', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon,{{WRAPPER}} .counter__icon img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $element->add_control(
            'icon_z_index',
            [
                'label'      => __('Z Index', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__icon,{{WRAPPER}} .counter__icon img' => 'z-index: {{SIZE}};',
                ],
            ]
        );
    }

    public function counter_number_pro_styles($element)
    {
        $element->add_responsive_control(
            'number_margin',
            [
                'label'      => __('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .counter__number__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'separator' => 'before',
            ]
        );

        $element->add_control(
            'number_transition',
            [
                'label'      => __('Transition', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
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
                    '{{WRAPPER}} .counter__number__wrapper' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $element->add_control(
            'number_opacity',
            [
                'label'      => __('Opacity', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__number__wrapper' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $element->add_control(
            'number_z_index',
            [
                'label'      => __('Z Index', 'element-ready'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter__number__wrapper' => 'z-index: {{SIZE}};',
                ],
            ]
        );
    }

    public function counter_box_pro_styles($element)
    {
        $element->start_controls_tabs('box_tabs_style');
        $element->start_controls_tab(
            'box_normal_tab',
            [
                'label' => __('Normal', 'element-ready'),
            ]
        );

        // Icon Color
        $element->add_control(
            'box_color',
            [
                'label'     => __('Color', 'element-ready'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .single__counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_background',
                'label'    => __('Background', 'element-ready'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .single__counter',
            ]
        );

        // Border
        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} .single__counter',
            ]
        );

        // Radius
        $element->add_responsive_control(
            'box_radius',
            [
                'label'      => __('Border Radius', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .single__counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .single__counter',
            ]
        );

        // Margin
        $element->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .single__counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $element->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .single__counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'box_align',
            [
                'label'   => __('Alignment', 'element-ready'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'element-ready'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'element-ready'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'element-ready'),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justify', 'element-ready'),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .single__counter' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab(
            'box_hover_tab',
            [
                'label' => __('Hover', 'element-ready'),
            ]
        );

        //Hover Color
        $element->add_control(
            'hover_box_color',
            [
                'label'     => __('Color', 'element-ready'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} :hover .single__counter, {{WRAPPER}} :focus .single__counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover Background
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hover_box_background',
                'label'    => __('Background', 'element-ready'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} :hover .single__counter,{{WRAPPER}} :focus .single__counter',
            ]
        );

        // Border
        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'hover_box_border',
                'label'    => __('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} :hover .single__counter,{{WRAPPER}} :hover .single__counter',
            ]
        );

        // Radius
        $element->add_responsive_control(
            'hover_box_radius',
            [
                'label'      => __('Border Radius', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} :hover .single__counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'hover_box_shadow',
                'selector' => '{{WRAPPER}} .single__counter:hover',
            ]
        );
        $element->end_controls_tab();
        $element->end_controls_tabs();
    }
}
