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
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

class Dual_Text_Extend extends BaseController{

    public function register() {

        add_filter( 'element_ready_dual_text_first_pro_message', [$this,'dual_text_pro_message'], 10, 2 );
        add_action( 'element_ready_dual_text_first_styles', [$this, 'dual_text_first_pro_styles'] );

        add_filter( 'element_ready_dual_text_last_pro_message', [$this,'dual_text_pro_message'], 10, 2 );
        add_action( 'element_ready_dual_text_last_styles', [$this, 'dual_text_last_pro_styles'] );

        add_filter( 'element_ready_dual_text_box_pro_message', [$this,'dual_text_pro_message'], 10, 2 );
        add_action( 'element_ready_dual_text_box_styles', [$this, 'dual_text_box_pro_styles'] );

    }

    public function dual_text_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function dual_text_first_pro_styles( $element ){
        
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'dualtext_first_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .dual__text__first',
            ]
        );
        $element->add_responsive_control(
            'dualtext_first_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .dual__text__first' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'dualtext_first_shadow',
                'selector' => '{{WRAPPER}} .dual__text__first',
            ]
        );
        $element->add_responsive_control(
            'dualtext_first_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__first' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'dualtext_first_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__first' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function dual_text_last_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'dualtext_last_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .dual__text__last',
            ]
        );
        $element->add_responsive_control(
            'dualtext_last_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .dual__text__last' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'dualtext_last_shadow',
                'selector' => '{{WRAPPER}} .dual__text__last',
            ]
        );
        $element->add_responsive_control(
            'dualtext_last_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__last' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'dualtext_last_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__last' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    public function dual_text_box_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'dualtext_box_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .dual__text__area',
            ]
        );
        $element->add_responsive_control(
            'dualtext_box_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .dual__text__area' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'dualtext_box_shadow',
                'selector' => '{{WRAPPER}} .dual__text__area',
            ]
        );

        $element->add_responsive_control(
            'dualtext_box_display',
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
                    '{{WRAPPER}} .dual__text__area' => 'display: {{VALUE}};',
                ],
            ]
        );
        $element->add_responsive_control(
            'dualtext_box_align',
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
                    '{{WRAPPER}} .dual__text__area' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'dualtext_box_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->add_responsive_control(
            'dualtext_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dual__text__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

}