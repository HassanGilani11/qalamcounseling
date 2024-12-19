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
use Elementor\Frontend;
use \Element_Ready_Pro\Base\Traits\Helper;
class Advanced_Accordion_Extend extends BaseController{
     use Helper;
    public function register() {
       


        add_filter( 'element_ready_accordion_area_pro_message', [$this,'accordion_pro_message'], 10, 2 );
        add_action( 'element_ready_accordion_area_styles', [$this, 'accordion_area_pro_styles'] );

        add_filter( 'element_ready_accordion_item_pro_message', [$this,'accordion_pro_message'], 10, 2 );
        add_action( 'element_ready_accordion_item_styles', [$this, 'accordion_item_pro_styles'] );

        add_filter( 'element_ready_accordion_header_pro_message', [$this,'accordion_pro_message'], 10, 2 );
        add_action( 'element_ready_accordion_header_styles', [$this, 'accordion_header_pro_style'] );

        add_filter( 'element_ready_accordion_content_pro_message', [$this,'accordion_pro_message'], 10, 2 );
        add_action( 'element_ready_accordion_content_styles', [$this, 'accordion_content_pro_style'] );

    }

    public function accordion_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function accordion_area_pro_styles( $element ){
        
        $element->add_responsive_control(
            'element_ready_adv_accordion_padding',
            [
                'label'      => esc_html__('Padding', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__adv__accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_accordion_margin',
            [
                'label'      => esc_html__('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__adv__accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'element_ready_adv_accordion_border',
                'label'    => esc_html__('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} .element__ready__adv__accordion',
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_accordion_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__adv__accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'element_ready_adv_accordion_box_shadow',
                'selector' => '{{WRAPPER}} .element__ready__adv__accordion',
            ]
        );
    }

    public function accordion_item_pro_styles( $element ){
       
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'element_ready_adv_item_border',
                'label'    => esc_html__('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} .element__ready__accordion__list',
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__accordion__list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'element_ready_adv_item_box_shadow',
                'selector' => '{{WRAPPER}} .element__ready__accordion__list',
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_item_margin',
            [
                'label'      => esc_html__('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__accordion__list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_item_padding',
            [
                'label'      => esc_html__('Padding', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__accordion__list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function accordion_header_pro_style( $element ){
       
        $element->start_controls_tabs('element_ready_adv_accordion_header_tabs');
            # Normal State Tab
            $element->start_controls_tab('element_ready_adv_accordion_header_normal', ['label' => esc_html__('Normal', 'element-ready')]);
                $element->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'element_ready_adv_accordion_tab_title_typography',
                        'selector' => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header',
                    ]
                );
                $element->add_control(
                    'element_ready_adv_accordion_tab_color',
                    [
                        'label'     => esc_html__('Tab Background Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_control(
                    'element_ready_adv_accordion_tab_icon_color',
                    [
                        'label'     => esc_html__('Icon Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_control(
                    'element_ready_adv_accordion_tab_text_color',
                    [
                        'label'     => esc_html__('Text Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'element_ready_adv_accordion_tab_border',
                        'label'    => esc_html__('Border', 'element-ready'),
                        'selector' => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header',
                    ]
                );
                $element->add_responsive_control(
                    'element_ready_adv_accordion_tab_border_radius',
                    [
                        'label'      => esc_html__('Border Radius', 'element-ready'),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors'  => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'element_ready_adv_accordion_tab_padding',
                    [
                        'label'      => esc_html__('Padding', 'element-ready'),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors'  => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'element_ready_adv_accordion_tab_margin',
                    [
                        'label'      => esc_html__('Margin', 'element-ready'),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors'  => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $element->end_controls_tab();

            # Hover State Tab
            $element->start_controls_tab(
                'element_ready_adv_accordion_header_hover',
                [
                    'label' => esc_html__('Hover', 'element-ready'),
                ]
            );

                $element->add_control(
                    'element_ready_adv_accordion_tab_color_hover',
                    [
                        'label'     => esc_html__('Tab Background Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_adv_accordion_hover_tab_icon_color',
                    [
                        'label'     => esc_html__('Hover Icon Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover .element__ready__accordion__icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_adv_accordion_tab_text_color_hover',
                    [
                        'label'     => esc_html__('Text Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_control(
                    'element_ready_adv_accordion_tab_icon_color_hover',
                    [
                        'label'     => esc_html__('Icon Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover .fa' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'element_ready_adv_accordion_toggle_icon_show' => 'yes',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'element_ready_adv_accordion_tab_border_hover',
                        'label'    => esc_html__('Border', 'element-ready'),
                        'selector' => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover',
                    ]
                );
                $element->add_responsive_control(
                    'element_ready_adv_accordion_tab_border_radius_hover',
                    [
                        'label'      => esc_html__('Border Radius', 'element-ready'),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors'  => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $element->end_controls_tab();

            #Active State Tab
            $element->start_controls_tab(
                'element_ready_adv_accordion_header_active',
                [
                    'label' => esc_html__('Active', 'element-ready'),
                ]
            );

                $element->add_control(
                    'element_ready_adv_accordion_tab_color_active',
                    [
                        'label'     => esc_html__('Tab Background Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_adv_accordion_active_tab_icon_color',
                    [
                        'label'     => esc_html__('Active Icon Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active .element__ready__accordion__icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_adv_accordion_tab_text_color_active',
                    [
                        'label'     => esc_html__('Text Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_control(
                    'element_ready_adv_accordion_tab_icon_color_active',
                    [
                        'label'     => esc_html__('Icon Color', 'element-ready'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active .fa' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'element_ready_adv_accordion_toggle_icon_show' => 'yes',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'element_ready_adv_accordion_tab_border_active',
                        'label'    => esc_html__('Border', 'element-ready'),
                        'selector' => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active',
                    ]
                );
                $element->add_responsive_control(
                    'element_ready_adv_accordion_tab_border_radius_active',
                    [
                        'label'      => esc_html__('Border Radius', 'element-ready'),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors'  => [
                            '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $element->end_controls_tab();
        $element->end_controls_tabs();
    }

    public function accordion_content_pro_style( $element ){
         
        $element->add_responsive_control(
            'element_ready_adv_accordion_content_padding',
            [
                'label'      => esc_html__('Padding', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'element_ready_adv_accordion_content_margin',
            [
                'label'      => esc_html__('Margin', 'element-ready'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'element_ready_adv_accordion_content_border',
                'label'    => esc_html__('Border', 'element-ready'),
                'selector' => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__content',
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'      => 'element_ready_adv_accordion_content_shadow',
                'selector'  => '{{WRAPPER}} .element__ready__adv__accordion .element__ready__accordion__list .element__ready__accordion__content',
                'separator' => 'before',
            ]
        );
    }


}