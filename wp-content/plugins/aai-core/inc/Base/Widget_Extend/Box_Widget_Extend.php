<?php

namespace Element_Ready_Pro\Base\Widget_Extend;

use Element_Ready\Base\BaseController;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Element_Ready_Pro\Base\Traits\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;

class Box_Widget_Extend extends BaseController
{

       use Helper;
       public function register()
       {

              add_filter('element_ready_box_style_presets', [$this, 'box_style_presets']);

              add_filter('element_ready_box_icon_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_icon_styles', [$this, 'box_icon_pro_styles']);

              add_filter('element_ready_box_icon_before_after_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_icon_before_after_styles', [$this, 'box_icon_before_after_styles']);

              add_filter('element_ready_box_bg_tex_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_bg_text_styles', [$this, 'box_bg_text_styles']);

              add_filter('element_ready_box_big_thumb_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_big_thumb_styles', [$this, 'box_big_thub_styles']);

              add_filter('element_ready_box_title_before_after_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_title_before_after_styles', [$this, 'box_title_before_after_styles']);

              add_filter('element_ready_box_title_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_title_styles', [$this, 'box_title_styles']);

              add_filter('element_ready_box_button_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_button_styles', [$this, 'box_button_styles']);

              add_filter('element_ready_box_before_after_pro_message', [$this, 'box_icon_access_style'], 10, 2);
              add_action('element_ready_box_before_after_styles', [$this, 'box_before_after_styles']);
       }

       public function box_style_presets()
       {
              return [
                     'single__box__layout__1'      => esc_html__('Box Style 1', 'element-ready'),
                     'single__box__layout__2'      => esc_html__('Box Style 2', 'element-ready'),
                     'single__box__layout__3'      => esc_html__('Box Style 3', 'element-ready'),
                     'single__box__layout__4'      => esc_html__('Box Style 4', 'element-ready'),
                     'single__box__layout__5'      => esc_html__('Box Style 5', 'element-ready'),
                     'single__box__layout__6'      => esc_html__('Box Style 6', 'element-ready'),
                     'single__box__layout__7'      => esc_html__('Box Style 7', 'element-ready'),
                     'single__box__layout__8'      => esc_html__('Box Style 8', 'element-ready'),
                     'single__box__layout__9'      => esc_html__('Box Style 9', 'element-ready'),
                     'single__box__layout__10'     => esc_html__('Box Style 10', 'element-ready'),
                     'single__box__layout__11'     => esc_html__('Box Style 11', 'element-ready'),
                     'single__box__layout__12'     => esc_html__('Box Style 12', 'element-ready'),
                     'single__box__layout__13'     => esc_html__('Box Style 13', 'element-ready'),
                     'single__box__layout__14'     => esc_html__('Box Style 14', 'element-ready'),
                     'single__box__layout__15'     => esc_html__('Box Style 15', 'element-ready'),
                     'single__box__layout__16'     => esc_html__('Box Style 16 ', 'element-ready'),
                     'single__box__layout__17'     => esc_html__('Box Style 17 ', 'element-ready'),
                     'single__box__layout__18'     => esc_html__('Box Style 18 ', 'element-ready'),
                     'single__box__layout__19'     => esc_html__('Box Style 19 ', 'element-ready'),
                     'single__box__layout__20'     => esc_html__('Box Style 20 ', 'element-ready'),
                     'single__box__layout__21'     => esc_html__('Box Style 21 ', 'element-ready'),
                     'single__box__layout__22'     => esc_html__('Box Style 22 ', 'element-ready'),
                     'single__box__layout__23'     => esc_html__('Box Style 23 ', 'element-ready'),
                     'single__box__layout__24'     => esc_html__('Box Style 24 ', 'element-ready'),
                     'single__box__layout__25'     => esc_html__('Box Style 25 ', 'element-ready'),
                     'single__box__layout__26'     => esc_html__('Box Style 26 ', 'element-ready'),
                     'single__box__layout__27'     => esc_html__('Box Style 27 ', 'element-ready'),
                     'single__box__layout__28'     => esc_html__('Box Style 28 ', 'element-ready'),
                     'single__box__layout__29'     => esc_html__('Box Style 29 ', 'element-ready'),
                     'single__box__layout__30'     => esc_html__('Box Style 30 ', 'element-ready'),
                     'single__box__layout__custom' => esc_html__('Custom Style', 'element-ready'),
              ];
       }
       public function box_icon_access_style($get_default, $merge)
       {

              $options = [];
              if ($merge) {
                     $return_opt['controls'] = array_merge($options, $get_default['controls']);
                     return $return_opt;
              }
              $return_opt['controls'] = $options;
              return $return_opt;
       }

       public function box_title_access_style($get_default, $merge)
       {

              $options = [

                     'title_text_color' => [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title, {{WRAPPER}} .box__title a' => 'color: {{VALUE}};',
                            ],
                     ],

              ];
              if ($merge) {
                     unset($get_default['controls']['title_pro_message']);
                     $return_opt['controls'] = array_merge($options, $get_default['controls']);


                     return $return_opt;
              }


              $return_opt['controls'] = $options;
              return $return_opt;
       }

       public function box_icon_pro_styles($element)
       {

              $element->start_controls_tabs('icon_tab_style');
              $element->start_controls_tab(
                     'icon_normal_tab',
                     [
                            'label' => __('Normal', 'element-ready'),
                     ]
              );
              // Icon Typgraphy
              $element->add_group_control(
                     Group_Control_Typography::get_type(),
                     [
                            'name'      => 'icon_typography',
                            'selector'  => '{{WRAPPER}} .box__icon',
                            'condition' => [
                                   'icon_type' => ['font_icon']
                            ],
                     ]
              );

              // Icon Image Size
              $element->add_responsive_control(
                     'icon_image_size',
                     [
                            'label'      => __('SVG / Image Size', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon img' => 'width: {{SIZE}}{{UNIT}};',
                                   '{{WRAPPER}} .box__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr1',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              // Icon Image Filter
              $element->add_group_control(
                     Group_Control_Css_Filter::get_type(),
                     [
                            'name'      => 'icon_image_filters',
                            'selector'  => '{{WRAPPER}} .box__icon img',
                            'condition' => [
                                   'icon_type' => ['image_icon']
                            ],
                     ]
              );

              // Icon Color
              $element->add_control(
                     'icon_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon' => 'color: {{VALUE}};',
                            ],
                     ]
              );

              // Icon Background
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'icon_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__icon',
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr2',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Border
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'icon_border',
                            'label'    => __('Border', 'element-ready'),
                            'selector' => '{{WRAPPER}} .box__icon',
                     ]
              );

              // Icon Radius
              $element->add_control(
                     'icon_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Shadow
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'icon_shadow',
                            'selector' => '{{WRAPPER}} .box__icon',
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr3',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Width
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
                                   '{{WRAPPER}} .box__icon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Height
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
                                   '{{WRAPPER}} .box__icon' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr5',
                     [
                            'type' => Controls_Manager::DIVIDER
                     ]
              );

              // Icon Display;
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
                                   '{{WRAPPER}} .box__icon' => 'display: {{VALUE}};',
                            ],
                     ]
              );

              // Icon Alignment
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
                                   '{{WRAPPER}} .box__icon' => 'text-align: {{VALUE}};',
                            ],
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr6',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Postion
              $element->add_responsive_control(
                     'icon_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon' => 'position: {{VALUE}};',
                            ],
                     ]
              );

              // Postion From Left
              $element->add_responsive_control(
                     'icon_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );

              // Postion From Right
              $element->add_responsive_control(
                     'icon_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );

              // Postion From Top
              $element->add_responsive_control(
                     'icon_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );

              // Postion From Bottom
              $element->add_responsive_control(
                     'icon_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );

              // Icon Transition
              $element->add_responsive_control(
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
                                   '{{WRAPPER}} .box__icon,{{WRAPPER}} .box__icon img' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr7',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Margin
              $element->add_responsive_control(
                     'icon_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr8',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Padding
              $element->add_responsive_control(
                     'icon_padding',
                     [
                            'label'      => __('Padding', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'icon_hover_tab',
                     [
                            'label' => __('Hover', 'element-ready'),
                     ]
              );
              // Icon Image Filter
              $element->add_group_control(
                     Group_Control_Css_Filter::get_type(),
                     [
                            'name'      => 'hover_icon_image_filters',
                            'selector'  => '{{WRAPPER}} :hover .box__icon img',
                            'condition' => [
                                   'icon_type' => ['image_icon']
                            ],
                     ]
              );

              // Box Hover Icon Color
              $element->add_control(
                     'hover_icon_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                   '{{WRAPPER}} :hover .box__icon, {{WRAPPER}} :focus .box__icon' => 'color: {{VALUE}};',
                            ],
                     ]
              );

              // Box Hover Icon Background
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_icon_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} :hover .box__icon,{{WRAPPER}} :focus .box__icon',
                     ]
              );

              // Icon Hr
              $element->add_control(
                     'icon_hr4',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );

              // Icon Border
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'hover_icon_border',
                            'label'    => __('Border', 'element-ready'),
                            'selector' => '{{WRAPPER}} :hover .box__icon,{{WRAPPER}} :hover .box__icon',
                     ]
              );

              // Icon Radius
              $element->add_control(
                     'hover_icon_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} :hover .box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );

              // Icon Shadow
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'hover_icon_shadow',
                            'selector' => '{{WRAPPER}} :hover .box__icon',
                     ]
              );

              // Icon Hover Animation
              $element->add_control(
                     'icon_hover_animation',
                     [
                            'label'    => __('Hover Animation', 'element-ready'),
                            'type'     => Controls_Manager::HOVER_ANIMATION,
                            'selector' => '{{WRAPPER}} :hover .box__icon',
                     ]
              );
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }

       public function box_icon_before_after_styles($element)
       {

              $element->start_controls_tabs('icon_before_after_tab_style');
              $element->start_controls_tab(
                     'icon_before_tab',
                     [
                            'label' => __('BEFORE', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'icon_before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__icon:before',
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:before' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:before' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => '{{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'icon_before_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .box__icon:before',
                     ]
              );
              $element->add_control(
                     'icon_before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'icon_before_shadow',
                            'selector' => '{{WRAPPER}} .box__icon:before',
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'icon_before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{icon_before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   BEFORE HOVER
                            -------------------*/
              $element->add_control(
                     'hover_icon_before_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_heading',
                     [
                            'label'     => __('Before Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_icon_before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover .box__icon:before',
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_width',
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
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );

              $element->start_popover();
              $element->add_control(
                     'hover_icon_before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{icon_before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'icon_after_tab',
                     [
                            'label' => __('AFTER', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'icon_after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__icon:after',
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:after' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:after' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:after' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__icon:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => '{{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'icon_after_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .box__icon:after',
                     ]
              );
              $element->add_control(
                     'icon_after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'icon_after_shadow',
                            'selector' => '{{WRAPPER}} .box__icon:after',
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__icon:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'icon_after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'icon_after_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'icon_after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'icon_after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__icon:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{icon_after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   AFTER HOVER
                            -------------------*/
              $element->add_control(
                     'hover_icon_after_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'hover_icon_after_heading',
                     [
                            'label'     => __('After Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_icon_after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover .box__icon:after',
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_after_width',
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
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_hover_icon_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_responsive_control(
                     'hover_icon_after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_icon_after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__icon:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{hover_icon_after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }

       public function box_bg_text_styles($element)
       {
              $element->add_group_control(
                     Group_Control_Typography::get_type(),
                     [
                            'name'      => 'bg_icon_text_typography',
                            'selector'  => '{{WRAPPER}} .box__bg__icon__text',
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_image_size',
                     [
                            'label'      => __('Svg / Image Size', 'element-ready'),
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
                                   'size' => '80',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__bg__icon__text img' => 'width: {{SIZE}}{{UNIT}};',
                                   '{{WRAPPER}} .box__bg__icon__text svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'box_bg_icon_type!' => 'simple_text',
                            ],
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr1',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->start_controls_tabs('bg_icon_text_tab_style');
              $element->start_controls_tab(
                     'bg_icon_text_normal_tab',
                     [
                            'label' => __('Normal', 'element-ready'),
                     ]
              );
              // Icon Image Filter
              $element->add_group_control(
                     Group_Control_Css_Filter::get_type(),
                     [
                            'name'      => 'bg_icon_text_image_filters',
                            'selector'  => '{{WRAPPER}} .box__bg__icon__text img',
                     ]
              );
              $element->add_control(
                     'bg_icon_text_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'color: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'bg_icon_text_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__bg__icon__text',
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr2',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'bg_icon_text_shadow',
                            'selector' => '{{WRAPPER}} .box__bg__icon__text',
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr3',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_width',
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_height',
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr5',
                     [
                            'type' => Controls_Manager::DIVIDER
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_display',
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_align',
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'text-align: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr6',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'bg_icon_text_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'bg_icon_text_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'bg_icon_text_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__bg__icon__text' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'bg_icon_text_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_transition',
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
                                   '{{WRAPPER}} .box__bg__icon__text,{{WRAPPER}} .box__bg__icon__text img' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_opacity',
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
                                   'size' => 0.1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr7',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr8',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_padding',
                     [
                            'label'      => __('Padding', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__bg__icon__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'bg_icon_text_hover_tab',
                     [
                            'label' => __('Hover', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Css_Filter::get_type(),
                     [
                            'name'      => 'hover_bg_icon_text_image_filters',
                            'selector'  => '{{WRAPPER}} :hover .box__bg__icon__text img',
                     ]
              );
              $element->add_control(
                     'hover_bg_icon_text_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                   '{{WRAPPER}} :hover .box__bg__icon__text, {{WRAPPER}} :focus .box__bg__icon__text' => 'color: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_bg_icon_text_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} :hover .box__bg__icon__text,{{WRAPPER}} :focus .box__bg__icon__text',
                     ]
              );
              $element->add_control(
                     'bg_icon_text_hr4',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'hover_bg_icon_text_border',
                            'label'    => __('Border', 'element-ready'),
                            'selector' => '{{WRAPPER}} :hover .box__bg__icon__text,{{WRAPPER}} :hover .box__bg__icon__text',
                     ]
              );
              $element->add_responsive_control(
                     'bg_icon_text_hover_opacity',
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
                                   'size' => 0.1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} :hover .box__bg__icon__text' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }

       public function box_big_thub_styles($element)
       {
              $element->add_group_control(
                     Group_Control_Css_Filter::get_type(),
                     [
                            'name'      => 'big_img_filters',
                            'selector'  => '{{WRAPPER}} .box__big__thumb img',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'big_img_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__big__thumb',
                     ]
              );
              $element->add_control(
                     'big_img_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__big__thumb,{{WRAPPER}} .box__big__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'big_img_shadow',
                            'selector' => '{{WRAPPER}} .box__big__thumb',
                     ]
              );
              $element->add_responsive_control(
                     'big_img_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__big__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'big_img_padding',
                     [
                            'label'      => __('Padding', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__big__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
       }

       public function box_title_styles($element)
       {
              $element->add_responsive_control(
                     'title_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
       }

       public function box_title_before_after_styles($element)
       {
              $element->start_controls_tabs('title_before_after_tab_style');
              $element->start_controls_tab(
                     'title_before_tab',
                     [
                            'label' => __('BEFORE', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'title_before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__title:before',
                     ]
              );
              $element->add_responsive_control(
                     'title_before_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:before' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:before' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => '{{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'title_before_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .box__title:before',
                     ]
              );
              $element->add_control(
                     'title_before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__title:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'title_before_shadow',
                            'selector' => '{{WRAPPER}} .box__title:before',
                     ]
              );
              $element->add_responsive_control(
                     'title_before_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__title:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_before_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_before_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_control(
                     'title_before_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'title_before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'title_before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{title_before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   BEFORE HOVER
                            -------------------*/
              $element->add_control(
                     'hover_title_before_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'hover_title_before_heading',
                     [
                            'label'     => __('Before Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_title_before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover .box__title:before',
                     ]
              );
              $element->add_responsive_control(
                     'hover_title_before_width',
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
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_title_before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_before_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );

              $element->start_popover();
              $element->add_control(
                     'hover_title_before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{title_before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'title_after_tab',
                     [
                            'label' => __('AFTER', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'title_after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__title:after',
                     ]
              );
              $element->add_responsive_control(
                     'title_after_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:after' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:after' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:after' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .box__title:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'title_after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => '{{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'title_after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'title_after_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .box__title:after',
                     ]
              );
              $element->add_control(
                     'title_after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'title_after_shadow',
                            'selector' => '{{WRAPPER}} .box__title:after',
                     ]
              );
              $element->add_responsive_control(
                     'title_after_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__title:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_after_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'title_after_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_control(
                     'title_after_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'title_after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'title_after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__title:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{title_after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   AFTER HOVER
                            -------------------*/
              $element->add_control(
                     'hover_title_after_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'hover_title_after_heading',
                     [
                            'label'     => __('After Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_title_after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover .box__title:after',
                     ]
              );
              $element->add_responsive_control(
                     'hover_title_after_width',
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
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_title_after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'after_hover_title_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'hover_title_after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_title_after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover .box__title:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{hover_title_after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }

       public function box_button_styles($element)
       {
              $element->start_controls_tabs('button_tab_style');
              $element->start_controls_tab(
                     'button_normal_tab',
                     [
                            'label' => __('Normal', 'element-ready'),
                     ]
              );
              $element->add_control(
                     'button_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                   '{{WRAPPER}} a.box__button, {{WRAPPER}} .box__button' => 'color: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Typography::get_type(),
                     [
                            'name'     => 'button_typography',
                            'selector' => '{{WRAPPER}} .box__button',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'button_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__button',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'button_border',
                            'label'    => __('Border', 'element-ready'),
                            'selector' => '{{WRAPPER}} .box__button',
                     ]
              );
              $element->add_control(
                     'button_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'button_shadow',
                            'selector' => '{{WRAPPER}} .box__button',
                     ]
              );
              $element->add_control(
                     'button_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'button_width',
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
                                   '{{WRAPPER}} .box__button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'button_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'button_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__button' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'button_vertical_position',
                     [
                            'label'      => __('Position Vertical', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -1000,
                                          'max'  => 1000,
                                          'step' => 1,
                                   ],
                                   '%' => [
                                          'min' => -100,
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__button' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'button_horizontal_position',
                     [
                            'label'      => __('Position Horizontal', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px', '%'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -1000,
                                          'max'  => 1000,
                                          'step' => 1,
                                   ],
                                   '%' => [
                                          'min' => -100,
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .box__button' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'icon_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_control(
                     'button_hr2',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_responsive_control(
                     'button_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'button_padding',
                     [
                            'label'      => __('Padding', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'button_hover_tab',
                     [
                            'label' => __('Hover', 'element-ready'),
                     ]
              );
              $element->add_control(
                     'hover_button_color',
                     [
                            'label'     => __('Color', 'element-ready'),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                   '{{WRAPPER}} .box__button:hover, {{WRAPPER}} a.box__button:focus, {{WRAPPER}} .box__button:focus' => 'color: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_button_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .box__button:hover,{{WRAPPER}} .box__button:focus',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'hover_button_border',
                            'label'    => __('Border', 'element-ready'),
                            'selector' => '{{WRAPPER}} .box__button:hover,{{WRAPPER}} .box__button:focus',
                     ]
              );
              $element->add_control(
                     'hover_button_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .box__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'hover_button_shadow',
                            'selector' => '{{WRAPPER}} .box__button:hover',
                     ]
              );
              $element->add_control(
                     'button_hover_animation',
                     [
                            'label'    => __('Hover Animation', 'element-ready'),
                            'type'     => Controls_Manager::HOVER_ANIMATION,
                            'selector' => '{{WRAPPER}} .box__button:hover',
                     ]
              );
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }

       public function box_before_after_styles($element)
       {
              $element->start_controls_tabs('before_after_tab_style');
              $element->start_controls_tab(
                     'before_tab',
                     [
                            'label' => __('BEFORE', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:before',
                     ]
              );
              $element->add_responsive_control(
                     'before_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:before' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:before' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'before_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => '{{VALUE}};',
                            ],
                            'default' => 'text-align:left',
                     ]
              );
              $element->add_responsive_control(
                     'before_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'before_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .single__box:before',
                     ]
              );
              $element->add_control(
                     'before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'before_shadow',
                            'selector' => '{{WRAPPER}} .single__box:before',
                     ]
              );
              $element->add_responsive_control(
                     'before_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'before_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'before_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_control(
                     'before_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   BEFORE HOVER
                            -------------------*/
              $element->add_control(
                     'before_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'before_hover_hr',
                     [
                            'label'     => __('Before Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_before_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover:before',
                     ]
              );
              $element->add_responsive_control(
                     'hover_before_width',
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
                                   '{{WRAPPER}} .single__box:hover:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_before_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_before_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:before' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_before_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'before_hover_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );

              $element->start_popover();
              $element->add_control(
                     'hover_before_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_before_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->start_controls_tab(
                     'after_tab',
                     [
                            'label' => __('AFTER', 'element-ready'),
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:after',
                     ]
              );
              $element->add_responsive_control(
                     'after_display',
                     [
                            'label'   => __('Display', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                   'initial'      => __('Initial', 'element-ready'),
                                   'block'        => __('Block', 'element-ready'),
                                   'inline-block' => __('Inline Block', 'element-ready'),
                                   'flex'         => __('Flex', 'element-ready'),
                                   'inline-flex'  => __('Inline Flex', 'element-ready'),
                                   'none'         => __('none', 'element-ready'),
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'display: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_position',
                     [
                            'label'   => __('Position', 'element-ready'),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                   'initial'  => __('Initial', 'element-ready'),
                                   'absolute' => __('Absulute', 'element-ready'),
                                   'relative' => __('Relative', 'element-ready'),
                                   'static'   => __('Static', 'element-ready'),
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'position: {{VALUE}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_position_from_left',
                     [
                            'label'      => __('From Left', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:after' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_position_from_right',
                     [
                            'label'      => __('From Right', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:after' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_position_from_top',
                     [
                            'label'      => __('From Top', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:after' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_position_from_bottom',
                     [
                            'label'      => __('From Bottom', 'element-ready'),
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
                                   '{{WRAPPER}} .single__box:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                   'after_position!' => ['initial', 'static']
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_align',
                     [
                            'label'   => __('Alignment', 'element-ready'),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                   'text-align:left' => [
                                          'title' => __('Left', 'element-ready'),
                                          'icon'  => 'fa fa-align-left',
                                   ],
                                   'margin: 0 auto' => [
                                          'title' => __('Center', 'element-ready'),
                                          'icon'  => 'fa fa-align-center',
                                   ],
                                   'float:right' => [
                                          'title' => __('Right', 'element-ready'),
                                          'icon'  => 'fa fa-align-right',
                                   ],
                                   'text-align:justify' => [
                                          'title' => __('Justify', 'element-ready'),
                                          'icon'  => 'fa fa-align-justify',
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => '{{VALUE}};',
                            ],
                            'default' => 'text-align:left',
                     ]
              );
              $element->add_responsive_control(
                     'after_width',
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
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                            'name'     => 'after_border',
                            'label'    => __('Border', 'element-ready'),
                            'separator' => 'before',
                            'selector' => '{{WRAPPER}} .single__box:after',
                     ]
              );
              $element->add_control(
                     'after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                     [
                            'name'     => 'after_shadow',
                            'selector' => '{{WRAPPER}} .single__box:after',
                     ]
              );
              $element->add_responsive_control(
                     'after_margin',
                     [
                            'label'      => __('Margin', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'separator' => 'before',
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'after_zindex',
                     [
                            'label'     => __('Z-Index', 'element-ready'),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'z-index: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'after_transition',
                     [
                            'label'      => __('Transition', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0.1,
                                          'max'  => 5,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0.3,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'transition: {{SIZE}}s;',
                            ],
                     ]
              );
              $element->add_control(
                     'after_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();

              /*----------------
                                   AFTER HOVER
                            -------------------*/
              $element->add_control(
                     'after_hr',
                     [
                            'type' => Controls_Manager::DIVIDER,
                     ]
              );
              $element->add_control(
                     'after_hover_hr',
                     [
                            'label'     => __('After Hover', 'element-ready'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                     ]
              );
              $element->add_group_control(
                     Group_Control_Background::get_type(),
                     [
                            'name'     => 'hover_after_background',
                            'label'    => __('Background', 'element-ready'),
                            'types'    => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .single__box:hover:after',
                     ]
              );
              $element->add_responsive_control(
                     'hover_after_width',
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
                                   '{{WRAPPER}} .single__box:hover:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_responsive_control(
                     'hover_after_height',
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
                                          'max' => 100,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_after_opacity',
                     [
                            'label' => __('Opacity', 'element-ready'),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                   'px' => [
                                          'max'  => 1,
                                          'min'  => 0.10,
                                          'step' => 0.01,
                                   ],
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:after' => 'opacity: {{SIZE}};',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_after_radius',
                     [
                            'label'      => __('Border Radius', 'element-ready'),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors'  => [
                                   '{{WRAPPER}} .single__box:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                     ]
              );
              $element->add_control(
                     'after_hover_popover_toggle',
                     [
                            'label' => __('Transform', 'element-ready'),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                     ]
              );
              $element->start_popover();
              $element->add_control(
                     'hover_after_scale',
                     [
                            'label'      => __('Scale', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => 0,
                                          'max'  => 20,
                                          'step' => 0.1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 1,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                     ]
              );
              $element->add_control(
                     'hover_after_rotate',
                     [
                            'label'      => __('Rotate', 'element-ready'),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range'      => [
                                   'px' => [
                                          'min'  => -360,
                                          'max'  => 360,
                                          'step' => 1,
                                   ],
                            ],
                            'default' => [
                                   'unit' => 'px',
                                   'size' => 0,
                            ],
                            'selectors' => [
                                   '{{WRAPPER}} .single__box:hover:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
                            ],
                     ]
              );
              $element->end_popover();
              $element->end_controls_tab();
              $element->end_controls_tabs();
       }
}
