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

class Copyright_Text_Extend extends BaseController{
     use Helper;
    public function register() {
        
        add_filter( 'element_ready_copyright_link_pro_message', [$this,'copyright_pro_message'], 10, 2 );
        add_action( 'element_ready_copyright_link_styles', [$this, 'copyright_link_pro_styles'] );

        add_filter( 'element_ready_copyright_box_pro_message', [$this,'copyright_pro_message'], 10, 2 );
        add_action( 'element_ready_copyright_box_styles', [$this, 'copyright_box_pro_styles'] );

    }

    public function copyright_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function copyright_link_pro_styles( $element ){
        
        $element->start_controls_tabs( 'copyright_link_style_tab' );
            $element->start_controls_tab(
                'copyright_link_normal_tab',
                [
                    'label' => __( 'Normal', 'element-ready' ),
                ]
            );
                $element->add_control(
                    'copyright_link_color',
                    [
                        'label'  => __( 'Color', 'element-ready' ),
                        'type'   => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .copyright__text__area a' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'copyright_link_typography',
                        'label'    => __( 'Typography', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .copyright__text__area a',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'copyright_link_background',
                        'label'    => __( 'Background', 'element-ready' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .copyright__text__area a',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'copyright_link_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .copyright__text__area a',
                    ]
                );
                $element->add_responsive_control(
                    'copyright_link_border_radius',
                    [
                        'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .copyright__text__area a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'copyright_link_shadow',
                        'selector' => '{{WRAPPER}} .copyright__text__area a',
                    ]
                );
                $element->add_responsive_control(
                    'copyright_link_margin',
                    [
                        'label'      => __( 'Margin', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .copyright__text__area a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $element->add_responsive_control(
                    'copyright_link_padding',
                    [
                        'label'      => __( 'Padding', 'element-ready' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .copyright__text__area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $element->end_controls_tab();
            $element->start_controls_tab(
                'copyright_link_hover_tab',
                [
                    'label' => __( 'Hover', 'element-ready' ),
                ]
            );
                $element->add_group_control(
                    Group_Control_Css_Filter:: get_type(),
                    [
                        'name'      => 'hover_copyright_link_image_filters',
                        'selector'  => '{{WRAPPER}} .copyright__text__area a:hover',
                    ]
                );
                $element->add_control(
                    'hover_copyright_link_color',
                    [
                        'label'     => __( 'Color', 'element-ready' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .copyright__text__area a:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $element->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'hover_copyright_link_background',
                        'label'    => __( 'Background', 'element-ready' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .copyright__text__area a:hover',
                    ]
                );
                $element->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'hover_copyright_link_border',
                        'label'    => __( 'Border', 'element-ready' ),
                        'selector' => '{{WRAPPER}} .copyright__text__area a:hover',
                    ]
                );
            $element->end_controls_tab();
        $element->end_controls_tabs();
    }

    public function copyright_box_pro_styles( $element ){
       
        $element->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'copyright_text_background',
                'label'    => __( 'Background', 'element-ready' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .copyright__text__area',
            ]
        );
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'copyright_text_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .copyright__text__area',
            ]
        );
        $element->add_responsive_control(
            'copyright_text_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .copyright__text__area' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'copyright_text_shadow',
                'selector' => '{{WRAPPER}} .copyright__text__area',
            ]
        );

        $element->add_responsive_control(
            'copyright_text_display',
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
                    '{{WRAPPER}} .copyright__text__area' => 'display: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'copyright_text_align',
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .copyright__text__area' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $element->add_responsive_control(
            'copyright_text_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .copyright__text__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'copyright_text_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .copyright__text__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

}