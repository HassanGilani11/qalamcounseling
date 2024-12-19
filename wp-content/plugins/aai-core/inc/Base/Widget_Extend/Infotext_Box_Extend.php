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

class Infotext_Box_Extend extends BaseController{
    use Helper;
    public function register() {
        
        add_filter( 'element_ready_infotext_style_presets', [$this, 'infotext_style_presets'] );

        add_filter( 'element_ready_infotext_wrap_pro_message', [$this,'infotext_pro_message'], 10, 2 );
        add_action( 'element_ready_infotext_wrap_styles', [$this, 'infotext_wrap_pro_styles'] );

        add_filter( 'element_ready_infotext_header_pro_message', [$this,'infotext_pro_message'], 10, 2 );
        add_action( 'element_ready_infotext_header_styles', [$this, 'infotext_header_pro_styles'] );

        add_filter( 'element_ready_infotext_box_pro_message', [$this,'infotext_pro_message'], 10, 2 );
        add_action( 'element_ready_infotext_box_styles', [$this, 'infotext_box_pro_styles'] );

    }

    public function infotext_style_presets(){
        return [
            'infotex_box__style__1' => __( 'Style One', 'element-ready' ),
            'custom'                => __( 'Custom Style', 'element-ready' ),
        ];
    }

    public function infotext_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

    public function infotext_wrap_pro_styles( $element ){
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

    public function infotext_header_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'header_title_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .infotext__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_radius',
            [
                'label'      => __( 'Border Radius', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .infotext__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'header_title_shadow',
                'selector' => '{{WRAPPER}} .infotext__header__title h3',
            ]
        );
        $element->add_responsive_control(
            'header_title_margin',
            [
                'label'      => __( 'Margin', 'element-ready' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .infotext__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .infotext__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .infotext__header__title h3' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    }

    public function infotext_box_pro_styles( $element ){
        $element->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'box_border',
                'label'    => __( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .single__infotext__box',
            ]
        );
        $element->add_responsive_control(
            'box_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'element-ready' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .single__infotext__box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'after',
            ]
        );
        $element->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'      => 'box_box_shadow',
                'label'     => __( 'Box Shadow', 'element-ready' ),
                'selector'  => '{{WRAPPER}} .single__infotext__box',
                'separator' => 'before',
            ]
        );
        $element->add_group_control(
            Group_Control_Text_Shadow:: get_type(),
            [
                'name'     => 'box_text_shadow',
                'label'    => __( 'Text Shadow', 'element-ready' ),
                'selector' => '{{WRAPPER}} .single__infotext__box',
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
                    '{{WRAPPER}} .single__infotext__box' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .single__infotext__box' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .single__infotext__box' => 'position: {{VALUE}};',
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
                    '{{WRAPPER}} .single__infotext__box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single__infotext__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single__infotext__box' => 'transition: {{SIZE}}s;',
                ],
            ]
        );
    }

}