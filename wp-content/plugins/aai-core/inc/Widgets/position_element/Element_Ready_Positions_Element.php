<?php

namespace Element_Ready_Pro\Widgets\position_element;

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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Element_Ready_Positions_Element extends Widget_Base {

	public function get_name() {
		return 'PositionElement';
	}

	public function get_title() {
		return esc_html__( 'ER Position Element', 'element-ready-pro' );
	}

	public function get_icon() {
		return 'eicon-drag-n-drop';
	}

	public function get_categories() {
		return array('element-ready-pro');
	}

    public function get_keywords() {
        return [ 'Position Element', 'Position' ];
    }
	public function get_style_depends() {

        wp_register_style( 'eready-position-element' , ELEMENT_READY_ROOT_CSS. 'widgets/position-element.css' );
        return [ 'eready-position-element' ];
    }
	

	public static function get_animation_style(){
		return [
			'Zoom_In_Out animated'        => esc_html__('Zoom_In_Out', 'element-ready-pro'),
			'Circle_Large animated'       => esc_html__('Circle_Large', 'element-ready-pro'),
			'Fade_In_Out animated'        => esc_html__('Fade_In_Out', 'element-ready-pro'),
			'littleCircle animated'       => esc_html__('littleCircle', 'element-ready-pro'),
			'bigCircle animated'          => esc_html__('bigCircle', 'element-ready-pro'),
			'Hoop animated'               => esc_html__('Hoop', 'element-ready-pro'),
			'triAngle animated'           => esc_html__('triAngle', 'element-ready-pro'),
			'littleSquare animated'       => esc_html__('littleSquare', 'element-ready-pro'),
			'bigSquare animated'          => esc_html__('bigSquare', 'element-ready-pro'),
			'fadeInRotate animated'       => esc_html__('fadeInRotate', 'element-ready-pro'),
			'fadeInBack animated'         => esc_html__('fadeInBack', 'element-ready-pro'),
			'blurFadeIn animated'         => esc_html__('blurFadeIn', 'element-ready-pro'),
			'blurFadeInOut animated'      => esc_html__('blurFadeInOut', 'element-ready-pro'),
			'ballBounce animated'         => esc_html__('ballBounce', 'element-ready-pro'),
			'zoomBounce animated'         => esc_html__('zoomBounce', 'element-ready-pro'),
			'FramesOne animated'          => esc_html__('FramesOne', 'element-ready-pro'),
			'FramesTwo animated'          => esc_html__('FramesTwo', 'element-ready-pro'),
			'FramesThree animated'        => esc_html__('FramesThree', 'element-ready-pro'),
			'FramesFour animated'         => esc_html__('FramesFour', 'element-ready-pro'),
			'FramesFive animated'         => esc_html__('FramesFive', 'element-ready-pro'),
			'scaleUpOne animated'         => esc_html__('scaleUpOne', 'element-ready-pro'),
			'scaleUpOne animated'         => esc_html__('scaleUpOne', 'element-ready-pro'),
			'scaleUpTwo animated'         => esc_html__('scaleUpTwo', 'element-ready-pro'),
			'scaleUpThree animated'       => esc_html__('scaleUpThree', 'element-ready-pro'),
			'prettyFade animated'         => esc_html__('prettyFade', 'element-ready-pro'),
			'fade_in animated'            => esc_html__('fade_in', 'element-ready-pro'),
			'scaleRight animated'         => esc_html__('scaleRight', 'element-ready-pro'),
			'scaleUpOne animated'         => esc_html__('scaleUpOne', 'element-ready-pro'),
			'bigSpin animated'            => esc_html__('bigSpin', 'element-ready-pro'),
			'rotated animated'            => esc_html__('rotated', 'element-ready-pro'),
			'rotatedHalf animated'        => esc_html__('rotatedHalf', 'element-ready-pro'),
			'rotatedHalfTwo animated'     => esc_html__('rotatedHalfTwo', 'element-ready-pro'),
			'jump animated'               => esc_html__('jump', 'element-ready-pro'),
			'imageBgAnim animated'        => esc_html__('imageBgAnim', 'element-ready-pro'),
			'bgMove animated'             => esc_html__('bgMove', 'element-ready-pro'),
			'gradientBG animated'         => esc_html__('gradientBG', 'element-ready-pro'),
			'rippleOutOne animated'       => esc_html__('rippleOutOne', 'element-ready-pro'),
			'rippleOuTwo animated'        => esc_html__('rippleOuTwo', 'element-ready-pro'),
			'bounce animated'             => esc_html__('bounce','element-ready-pro'),
			'flash animated'              => esc_html__('flash','element-ready-pro'),
			'pulse animated'              => esc_html__('pulse','element-ready-pro'),
			'rubberBand animated'         => esc_html__('rubberBand','element-ready-pro'),
			'shake animated'              => esc_html__('shake','element-ready-pro'),
			'headShake animated'          => esc_html__('headShake','element-ready-pro'),
			'swing animated'              => esc_html__('swing','element-ready-pro'),
			'tada animated'               => esc_html__('tada','element-ready-pro'),
			'wobble animated'             => esc_html__('wobble','element-ready-pro'),
			'jello animated'              => esc_html__('jello','element-ready-pro'),
			'heartBeat animated'          => esc_html__('heartBeat','element-ready-pro'),
			'bounceIn animated'           => esc_html__('bounceIn','element-ready-pro'),
			'bounceInDown animated'       => esc_html__('bounceInDown','element-ready-pro'),
			'bounceInLeft animated'       => esc_html__('bounceInLeft','element-ready-pro'),
			'bounceInRight animated'      => esc_html__('bounceInRight','element-ready-pro'),
			'bounceInUp animated'         => esc_html__('bounceInUp','element-ready-pro'),
			'bounceOut animated'          => esc_html__('bounceOut','element-ready-pro'),
			'bounceOutDown animated'      => esc_html__('bounceOutDown','element-ready-pro'),
			'bounceOutLeft animated'      => esc_html__('bounceOutLeft','element-ready-pro'),
			'bounceOutRight animated'     => esc_html__('bounceOutRight','element-ready-pro'),
			'bounceOutUp animated'        => esc_html__('bounceOutUp','element-ready-pro'),
			'fadeIn animated'             => esc_html__('fadeIn','element-ready-pro'),
			'fadeInDown animated'         => esc_html__('fadeInDown','element-ready-pro'),
			'fadeInDownBig animated'      => esc_html__('fadeInDownBig','element-ready-pro'),
			'fadeInLeft animated'         => esc_html__('fadeInLeft','element-ready-pro'),
			'fadeInLeftBig animated'      => esc_html__('fadeInLeftBig','element-ready-pro'),
			'fadeInRight animated'        => esc_html__('fadeInRight','element-ready-pro'),
			'fadeInRightBig animated'     => esc_html__('fadeInRightBig','element-ready-pro'),
			'fadeInUp animated'           => esc_html__('fadeInUp','element-ready-pro'),
			'fadeInUpBig animated'        => esc_html__('fadeInUpBig','element-ready-pro'),
			'fadeOut animated'            => esc_html__('fadeOut','element-ready-pro'),
			'fadeOutDown animated'        => esc_html__('fadeOutDown','element-ready-pro'),
			'fadeOutDownBig animated'     => esc_html__('fadeOutDownBig','element-ready-pro'),
			'fadeOutLeft animated'        => esc_html__('fadeOutLeft','element-ready-pro'),
			'fadeOutLeftBig animated'     => esc_html__('fadeOutLeftBig','element-ready-pro'),
			'fadeOutRight animated'       => esc_html__('fadeOutRight','element-ready-pro'),
			'fadeOutRightBig animated'    => esc_html__('fadeOutRightBig','element-ready-pro'),
			'fadeOutUp animated'          => esc_html__('fadeOutUp','element-ready-pro'),
			'fadeOutUpBig animated'       => esc_html__('fadeOutUpBig','element-ready-pro'),
			'flip animated'               => esc_html__('flip','element-ready-pro'),
			'flipInX animated'            => esc_html__('flipInX','element-ready-pro'),
			'flipInY animated'            => esc_html__('flipInY','element-ready-pro'),
			'flipOutX animated'           => esc_html__('flipOutX','element-ready-pro'),
			'flipOutY animated'           => esc_html__('flipOutY','element-ready-pro'),
			'lightSpeedIn animated'       => esc_html__('lightSpeedIn','element-ready-pro'),
			'lightSpeedOut animated'      => esc_html__('lightSpeedOut','element-ready-pro'),
			'rotateIn animated'           => esc_html__('rotateIn','element-ready-pro'),
			'rotateInDownLeft animated'   => esc_html__('rotateInDownLeft','element-ready-pro'),
			'rotateInDownRight animated'  => esc_html__('rotateInDownRight','element-ready-pro'),
			'rotateInUpLeft animated'     => esc_html__('rotateInUpLeft','element-ready-pro'),
			'rotateInUpRight animated'    => esc_html__('rotateInUpRight','element-ready-pro'),
			'rotateOut animated'          => esc_html__('rotateOut','element-ready-pro'),
			'rotateOutDownLeft animated'  => esc_html__('rotateOutDownLeft','element-ready-pro'),
			'rotateOutDownRight animated' => esc_html__('rotateOutDownRight','element-ready-pro'),
			'rotateOutUpLeft animated'    => esc_html__('rotateOutUpLeft','element-ready-pro'),
			'rotateOutUpRight animated'   => esc_html__('rotateOutUpRight','element-ready-pro'),
			'hinge animated'              => esc_html__('hinge','element-ready-pro'),
			'jackInTheBox animated'       => esc_html__('jackInTheBox','element-ready-pro'),
			'rollIn animated'             => esc_html__('rollIn','element-ready-pro'),
			'rollOut animated'            => esc_html__('rollOut','element-ready-pro'),
			'zoomIn animated'             => esc_html__('zoomIn','element-ready-pro'),
			'zoomInDown animated'         => esc_html__('zoomInDown','element-ready-pro'),
			'zoomInLeft animated'         => esc_html__('zoomInLeft','element-ready-pro'),
			'zoomInRight animated'        => esc_html__('zoomInRight','element-ready-pro'),
			'zoomInUp animated'           => esc_html__('zoomInUp','element-ready-pro'),
			'zoomOut animated'            => esc_html__('zoomOut','element-ready-pro'),
			'zoomOutDown animated'        => esc_html__('zoomOutDown','element-ready-pro'),
			'zoomOutLeft animated'        => esc_html__('zoomOutLeft','element-ready-pro'),
			'zoomOutRight animated'       => esc_html__('zoomOutRight','element-ready-pro'),
			'zoomOutUp animated'          => esc_html__('zoomOutUp','element-ready-pro'),
			'slideInDown animated'        => esc_html__('slideInDown','element-ready-pro'),
			'slideInLeft animated'        => esc_html__('slideInLeft','element-ready-pro'),
			'slideInRight animated'       => esc_html__('slideInRight','element-ready-pro'),
			'slideInUp animated'          => esc_html__('slideInUp','element-ready-pro'),
			'slideOutDown animated'       => esc_html__('slideOutDown','element-ready-pro'),
			'slideOutLeft animated'       => esc_html__('slideOutLeft','element-ready-pro'),
			'slideOutRight animated'      => esc_html__('slideOutRight','element-ready-pro'),
			'slideOutUp animated'         => esc_html__('slideOutUp','element-ready-pro'),
		];
	}

	protected function register_controls() {

		/******************************
		 * 	CONTENT SECTION
		 ******************************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// Icon Type
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Element Type', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_icon',
				'options' => [
					'font_icon'  => esc_html__( 'SVG / Font Icon', 'element-ready-pro' ),
					'image_icon' => esc_html__( 'Image Icon / Image', 'element-ready-pro' ),
					'text'       => esc_html__( 'Simple Text', 'element-ready-pro' ),
				],
			]
		);

		// Font Icon
		$this->add_control(
			'font_icon',
			[
				'label'     => esc_html__( 'SVG / Font Icons', 'element-ready-pro' ),
				'type'      => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'font_icon',
				],
			]
		);

		// Image Icon
		$this->add_control(
			'image_icon',
			[
				'label'   => esc_html__( 'Image Icon / Image', 'element-ready-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image_icon',
				],
			]
		);

		// Image size
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'icon_image_size',
				'default'   => 'thumbnail',
				'condition' => [
					'icon_type' => 'image_icon',
				],
			]
		);

		// Title
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'element-ready-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'element-ready-pro' ),
				'condition'   => [
					'icon_type' => 'text',
				],
			]
		);

		// Animation
		$this->add_control(
			'element_ready_animation',
			[
				'label'   => esc_html__( 'Element Animation', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => esc_html__( 'Yes', 'element-ready-pro' ),
					'no'  => esc_html__( 'No', 'element-ready-pro' ),
				],
			]
		);

		// Custom Animate
		$this->add_control(
			'element_ready_animation_type',
			[
				'label'   => esc_html__( 'Custom Animate Type', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => self::get_animation_style(),
				'condition' => [
					'element_ready_animation' => 'yes',
				]
			]
		);

		// Speed
		$this->add_control(
			'element_ready_animation_speed',
			[
				'label'   => esc_html__( 'Animation Speed', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'fast' => esc_html__( 'Fast', 'element-ready-pro' ),
					'faster' => esc_html__( 'Faster', 'element-ready-pro' ),
					'slow' => esc_html__( 'Slow', 'element-ready-pro' ),
					'slower' => esc_html__( 'Slower', 'element-ready-pro' ),
				],
				'condition' => [
					'element_ready_animation' => 'yes',
				]
			]
		);

		// Infinite
		$this->add_control(
			'element_ready_animation_infinite',
			[
				'label'   => esc_html__( 'Infine Animation', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'infinite' => esc_html__( 'Yes', 'element-ready-pro' ),
					'normal'  => esc_html__( 'No', 'element-ready-pro' ),
				],
				'condition' => [
					'element_ready_animation' => 'yes',
				]
			]
		);

		// Mode
		$this->add_control(
			'element_ready_animation_direction',
			[
				'label'   => esc_html__( 'Animation Direction', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal'  => esc_html__( 'Normal', 'element-ready-pro' ),
					'alternate' => esc_html__( 'Alternate', 'element-ready-pro' ),
					'reverse' => esc_html__( 'Reverse', 'element-ready-pro' ),
					'alternate-reverse' => esc_html__( 'Alternate Reverse', 'element-ready-pro' ),
				],
				'condition' => [
					'element_ready_animation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__ready__wrap' => '-webkit-animation-direction: {{VALUE}};  animation-direction: {{VALUE}};',
				],
			]
		);

		// Mode
		$this->add_control(
			'element_ready_animation_custom_speed',
			[
				'label' => esc_html__( 'Animation Custom Duration', 'element-ready-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.5,
						'max'  => 100,
						'step' => 0.5,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__ready__wrap' => '-webkit-animation-duration: {{SIZE}}s;  animation-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_section();

		/*********************************
		 * 		STYLE SECTION
		 *********************************/

		/*----------------------------
			ELEMENT STYLE
		-----------------------------*/
		$this->start_controls_section(
			'element_ready_style_section',
			[
				'label' => esc_html__( 'Position Element', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'warapper_width',
			[
				'label'      => esc_html__( 'Warapper Width', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vw' => [
						'min' => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__ready__wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'warapper_height',
			[
				'label'      => esc_html__( 'Warapper Height', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vw' => [
						'min' => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__ready__wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'warp_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		// Typgraphy
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'      => 'icon_typography',
				'selector'  => '{{WRAPPER}}',
				'condition' => [
					'icon_type' => ['font_icon','text']
				],
			]
		);

		// Image Size
		$this->add_responsive_control(
			'icon_image_size_width',
			[
				'label'      => esc_html__( 'Image Width', 'element-ready-pro' ),
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Image Size
		$this->add_responsive_control(
			'icon_image_size_height',
			[
				'label'      => esc_html__( 'Image Height', 'element-ready-pro' ),
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Image Filter
		$this->add_group_control(
			Group_Control_Css_Filter:: get_type(),
			[
				'name'      => 'icon_image_filters',
				'label'        => esc_html__( 'Image Filter', 'element-ready-pro' ),
				'selector'  => '{{WRAPPER}} img',
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Color
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'element-ready-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background:: get_type(),
			[
				'name'     => 'icon_background',
				'label'    => esc_html__( 'Background', 'element-ready-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border:: get_type(),
			[
				'name'     => 'icon_border',
				'label'    => esc_html__( 'Border', 'element-ready-pro' ),
				'selector' => '{{WRAPPER}}',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}, {{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		// Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow:: get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}}',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Width
		$this->add_responsive_control(
			'icon_width',
			[
				'label'      => esc_html__( 'Width', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px','vw','%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Height
		$this->add_responsive_control(
			'icon_height',
			[
				'label'      => esc_html__( 'Height', 'element-ready-pro' ),
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
					'{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr5',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Display;
		$this->add_responsive_control(
			'icon_display',
			[
				'label'   => esc_html__( 'Display', 'element-ready-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'initial'      => esc_html__( 'Initial', 'element-ready-pro' ),
					'block'        => esc_html__( 'Block', 'element-ready-pro' ),
					'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
					'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
					'inline-flex'  => esc_html__( 'Inline Flex', 'element-ready-pro' ),
					'none'         => esc_html__( 'none', 'element-ready-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'display: {{VALUE}};',
				],
			]
		);

		// Alignment
		$this->add_responsive_control(
			'icon_align',
			[
				'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'element-ready-pro' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'element-ready-pro' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'element-ready-pro' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'element-ready-pro' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Postion From Left
		$this->add_responsive_control(
			'icon_position_from_left',
			[
				'label'      => esc_html__( 'Horizontal Offset', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw','%' ],
				'range'      => [
					'px' => [
						'min'  => -2000,
						'max'  => 2000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'position:absolute; left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Postion From Top
		$this->add_responsive_control(
			'icon_position_from_top',
			[
				'label'      => esc_html__( 'Vertical Offset', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw','%' ],
				'range'      => [
					'px' => [
						'min'  => -2000,
						'max'  => 2000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Z-Index
		$this->add_responsive_control(
			'icon_zindex',
			[
				'label'     => esc_html__( 'Z-Index', 'element-ready-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -99,
				'max'       => 99,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}}' => 'z-index: {{SIZE}};',
				],
			]
		);

		// Opacity
		$this->add_responsive_control(
			'icon_opacity',
			[
				'label' => esc_html__( 'Opacity', 'element-ready-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'opacity: {{SIZE}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Padding
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/		
	}
	
	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'posiion__element__ready__wrap_attr', 'class', 'posiion__element__ready__wrap' );
		$this->add_render_attribute( 'posiion__element__ready__wrap_attr', 'class', $settings['element_ready_animation_type'] );
		$this->add_render_attribute( 'posiion__element__ready__wrap_attr', 'class', $settings['element_ready_animation_infinite'] );
		$this->add_render_attribute( 'posiion__element__ready__wrap_attr', 'class', $settings['element_ready_animation_speed'] );
		$this->add_render_attribute( 'posiion__element__ready__wrap_attr', 'class', $settings['element_ready_animation_infinite'] );

		// Icon Condition
		if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {
			$element = '<div class="posiion__element__ready__item">'.element_ready_render_icons( $settings['font_icon'] ).'</div>';
		}elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
			$element_ready_array = $settings['image_icon'];
			$element_ready_link  = wp_get_attachment_image_url( $element_ready_array['id'], 'thumbnail' );
			$image         = Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_image_size', 'image_icon');
			$element       = '<div class="posiion__element__ready__item">'.$image.'</div>';
		}elseif ( 'text' == $settings['icon_type'] && !empty( $settings['title'] ) ) {
			$element = '<div class="posiion__element__ready__item">'.esc_html( $settings['title'] ).'</div>';
		}else{
			$element = '';
		}

		echo '<div '.$this->get_render_attribute_string('posiion__element__ready__wrap_attr').'>
				'.( isset( $element ) ? $element : '' ).'
			</div>';

	}

	protected function content_template() {}
}