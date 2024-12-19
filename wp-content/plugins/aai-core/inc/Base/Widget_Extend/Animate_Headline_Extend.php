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
use Elementor\Plugin;
use Elementor\Frontend;

class Animate_Headline_Extend extends BaseController{
       use Helper;
       public function register() {
             
              add_filter( 'element_ready_animate_headline_style_presets', [$this,'animate_headline_style_presets'] );

              add_filter( 'element_ready_animate_headline_heading_pro_message', [$this,'animate_headline_heading_pro_message'], 10, 2 );
              add_filter( 'element_ready_animate_headline_text_pro_message', [$this,'animate_headline_heading_pro_message'], 10, 2 );
              add_action( 'element_ready_animate_headline_heading_styles', [$this, 'animate_headline_heading_pro_styles'] );
              add_action( 'element_ready_animate_headline_text_styles', [$this, 'animate_headline_text_pro_styles'] );

       }
       
       public function animate_headline_style_presets(){
              return [
                     'clip'        => esc_html__('Clip Text','element-ready' ),
                     'rotate-2'    => esc_html__('Letter Rotate','element-ready' ),
                     'rotate-3'    => esc_html__('Letter Rotate 2','element-ready' ),
                     'type'        => esc_html__('Letter Typeing','element-ready' ),
                     'loading-bar' => esc_html__('Loading Bar','element-ready' ),
                     'slide'       => esc_html__('Slide Text','element-ready' ),
                     'zoom'        => esc_html__('Zoom Text','element-ready' ),
                     'scale'       => esc_html__('Letter Scale','element-ready' ),
                     'rotate-1'    => esc_html__('Text Rotate','element-ready' ),
                     'push'        => esc_html__('Text Push','element-ready' ),
              ];
       }

       public function animate_headline_heading_pro_message( $get_default, $merge ){

              $options = [];
              if( $merge ){
                     $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
                     return $return_opt;
              }
              $return_opt['controls'] = $options;
              return $return_opt;       
       }
       
       public function pro_message_with_mergeing_control_example( $get_default, $merge ){

              $options = [

                     'title_text_color'=> [
                            'label'     => __( 'Color', 'element-ready' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                   '{{WRAPPER}} .box__title, {{WRAPPER}} .box__title a' => 'color: {{VALUE}};',
                            ],
                     ],

              ];
              if( $merge ){
                     unset($get_default['controls']['title_pro_message']);
                     $return_opt['controls'] = array_merge( $options, $get_default['controls'] );


                     return $return_opt;
              }

              
              $return_opt['controls'] = $options;
              return $return_opt;       
       }

       public function animate_headline_heading_pro_styles( $element ){
            
              $element->add_group_control(
                     Group_Control_Border:: get_type(),
                     [
                         'name'     => '_heading_border',
                         'label'    => __( 'Border', 'element-ready' ),
                         'selector' => '{{WRAPPER}} .animate__text__headline',
                         'separator' => 'before',
                     ]
              );
              $element->add_responsive_control(
                     '_heading_radius',
                     [
                         'label'      => __( 'Border Radius', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
              );
              $element->add_group_control(
                     Group_Control_Box_Shadow:: get_type(),
                     [
                         'name'     => '_heading_shadow',
                         'selector' => '{{WRAPPER}} .animate__text__headline',
                     ]
              );
              $element->add_responsive_control(
                     '_heading_margin',
                     [
                         'label'      => __( 'Margin', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                         'separator' => 'before',
                     ]
              );
              $element->add_responsive_control(
                     '_heading_padding',
                     [
                         'label'      => __( 'Padding', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
              );
              $element->add_responsive_control(
                     '_heading_align',
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
                             '{{WRAPPER}} .animate__text__headline' => 'text-align: {{VALUE}};',
                         ],
                         'separator' => 'before',
                     ]
              );
       }

       public function animate_headline_text_pro_styles( $element ){
     
              $element->add_group_control(
                     Group_Control_Border:: get_type(),
                     [
                         'name'     => '_animate_text_border',
                         'label'    => __( 'Border', 'element-ready' ),
                         'selector' => '{{WRAPPER}} .animate__text__headline h1 .animate__main__text',
                         'separator' => 'before',
                     ]
                 );
                 $element->add_responsive_control(
                     '_animate_text_radius',
                     [
                         'label'      => __( 'Border Radius', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline h1 .animate__main__text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
                 );
                 $element->add_group_control(
                     Group_Control_Box_Shadow:: get_type(),
                     [
                         'name'     => '_animate_text_shadow',
                         'selector' => '{{WRAPPER}} .animate__text__headline h1 .animate__main__text',
                     ]
                 );
                 $element->add_responsive_control(
                     '_animate_text_margin',
                     [
                         'label'      => __( 'Margin', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline h1 .animate__main__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                         'separator' => 'before',
                     ]
                 );
                 $element->add_responsive_control(
                     '_animate_text_padding',
                     [
                         'label'      => __( 'Padding', 'element-ready' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .animate__text__headline h1 .animate__main__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
                 );
       }

}