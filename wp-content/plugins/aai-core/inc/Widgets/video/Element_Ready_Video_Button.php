<?php

namespace Element_Ready_Pro\Widgets\video;

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

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Element_Ready_Video_Button extends Widget_Base
{

	public function get_name()
	{
		return 'Element_Ready_Video_Button';
	}

	public function get_title()
	{
		return __('ER Video Popup Button', 'element-ready-pro');
	}

	public function get_icon()
	{
		return 'eicon-youtube';
	}

	public function get_categories()
	{
		return array('element-ready-pro');
	}

	public function get_keywords()
	{
		return ['Video', 'Popup', 'Modal', 'Video Popup', 'Video Modal', 'play', 'player'];
	}

	public function get_script_depends()
	{
		return [
			'modal-video',
			'element-ready-core',
		];
	}

	public function get_style_depends()
	{

		wp_register_style('eready-video-button', ELEMENT_READY_ROOT_CSS . 'widgets/video-button.css');
		return ['eready-video-button', 'modal-video'];
	}


	public static function button_layout_style()
	{
		return [
			'button__layout__1'      => 'Button Style 1',
			'button__layout__2'      => 'Button Style 2',
			'button__layout__custom' => 'Custom Style',
		];
	}

	protected function register_controls()
	{

		/******************************
		 * 	CONTENT SECTION
		 ******************************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// Type
		$this->add_control(
			'button_layout_style',
			[
				'label'   => __('Button Type', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'button__layout__1',
				'options' => self::button_layout_style(),
			]
		);

		// Type
		$this->add_control(
			'get_video_from',
			[
				'label'   => __('Get Video Id From', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube'      => __('YouTube', 'element-ready-pro'),
					'vimeo'      => __('Vimeo', 'element-ready-pro'),
				]
			]
		);

		// Button Link
		$this->add_control(
			'youtube_video_id',
			[
				'label'         => __('Youtube Video Id', 'element-ready-pro'),
				'type'          => Controls_Manager::TEXT,
				'show_external' => true,
				'default'       => 'TmQOFWX9D3o',
				'condition' => [
					'get_video_from' => 'youtube',
				],
			]
		);

		// Button Link
		$this->add_control(
			'vimeo_video_id',
			[
				'label'         => __('Vimeo Video Id', 'element-ready-pro'),
				'type'          => Controls_Manager::TEXT,
				'show_external' => true,
				'default'       => '123051260',
				'condition' => [
					'get_video_from' => 'vimeo',
				],
			]
		);

		// Title
		$this->add_control(
			'title',
			[
				'label'       => __('Title', 'element-ready-pro'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __('Title', 'element-ready-pro'),
				'default'     => __('Watch Video', 'element-ready-pro'),
			]
		);


		// Subtitle
		$this->add_control(
			'subtitle',
			[
				'label'       => __('Subtitle', 'element-ready-pro'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __('Subtitle', 'element-ready-pro'),
			]
		);

		// Subtitle Position
		$this->add_control(
			'subtitle_position',
			[
				'label'   => __('Subtitle Position', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after_title',
				'options' => [
					'before_title' => __('Before title', 'element-ready-pro'),
					'after_title'  => __('After Title', 'element-ready-pro'),
				],
				'condition' => [
					'subtitle!' => '',
				]
			]
		);

		// Icon Toggle
		$this->add_control(
			'show_icon',
			[
				'label'        => __('Show Icon ?', 'element-ready-pro'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'element-ready-pro'),
				'label_off'    => __('Hide', 'element-ready-pro'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		// Icon Type
		$this->add_control(
			'icon_type',
			[
				'label'   => __('Icon Type', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_icon',
				'options' => [
					'font_icon'  => __('SVG / Font Icon', 'element-ready-pro'),
					'image_icon' => __('Image Icon', 'element-ready-pro'),
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		// Font Icon
		$this->add_control(
			'font_icon',
			[
				'label'     => __('SVG / Font Icons', 'element-ready-pro'),
				'type'      => Controls_Manager::ICONS,
				'label_block' => true,
				'condition' => [
					'icon_type' => 'font_icon',
					'show_icon' => 'yes',
				],
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'solid',
				],
			]
		);

		// Image Icon
		$this->add_control(
			'image_icon',
			[
				'label'   => __('Image Icon', 'element-ready-pro'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image_icon',
					'show_icon' => 'yes',
				],
			]
		);

		// Button Icon Align
		$this->add_control(
			'button_icon_align',
			[
				'label'   => __('Icon Position', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __('Before', 'element-ready-pro'),
					'right' => __('After', 'element-ready-pro'),
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		// Button Icon Margin
		$this->add_control(
			'button_icon_indent',
			[
				'label' => __('Icon Spacing', 'element-ready-pro'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'show_icon' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button .video__button_icon_right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .video__popup__button .video__button_icon_left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Align
		$this->add_responsive_control(
			'button_wrap_align',
			[
				'label'   => __('Alignment', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'element-ready-pro'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'element-ready-pro'),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'element-ready-pro'),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'element-ready-pro'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		/*********************************
		 * 		STYLE SECTION
		 *********************************/

		/*----------------------------
			ICON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => __('Icon', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Icon Typgraphy
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'icon_typography',
				'selector'  => '{{WRAPPER}} .button__icon',
				'condition' => [
					'icon_type' => ['font_icon']
				],
			]
		);

		// Icon Image Size
		$this->add_responsive_control(
			'icon_image_size',
			[
				'label'      => __('Icon Image Size', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button__icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);


		$this->start_controls_tabs('icon_tab_style');
		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'element-ready-pro'),
			]
		);

		// Icon Image Filter
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'      => 'icon_image_filters',
				'selector'  => '{{WRAPPER}} .button__icon img',
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Icon Color
		$this->add_control(
			'icon_color',
			[
				'label'     => __('Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .button__icon' => 'color: {{VALUE}};',
				],
			]
		);

		// Icon Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .button__icon,{{WRAPPER}} .button__icon:before',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .button__icon',
			]
		);

		// Icon Radius
		$this->add_control(
			'icon_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .button__icon',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Width
		$this->add_responsive_control(
			'icon_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Height
		$this->add_responsive_control(
			'icon_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr5',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		// Icon Display;
		$this->add_responsive_control(
			'icon_display',
			[
				'label'   => __('Display', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'initial'      => __('Initial', 'element-ready-pro'),
					'block'        => __('Block', 'element-ready-pro'),
					'inline-block' => __('Inline Block', 'element-ready-pro'),
					'flex'         => __('Flex', 'element-ready-pro'),
					'inline-flex'  => __('Inline Flex', 'element-ready-pro'),
					'none'         => __('none', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .button__icon' => 'display: {{VALUE}};',
				],
			]
		);

		// Icon Alignment
		$this->add_responsive_control(
			'icon_align',
			[
				'label'   => __('Alignment', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'element-ready-pro'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'element-ready-pro'),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'element-ready-pro'),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'element-ready-pro'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .button__icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Postion
		$this->add_responsive_control(
			'icon_position',
			[
				'label'   => __('Position', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'initial'  => __('Initial', 'element-ready-pro'),
					'absolute' => __('Absulute', 'element-ready-pro'),
					'relative' => __('Relative', 'element-ready-pro'),
					'static'   => __('Static', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .button__icon' => 'position: {{VALUE}};',
				],
			]
		);

		// Postion From Left
		$this->add_responsive_control(
			'icon_position_from_left',
			[
				'label'      => __('From Left', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Right
		$this->add_responsive_control(
			'icon_position_from_right',
			[
				'label'      => __('From Right', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Top
		$this->add_responsive_control(
			'icon_position_from_top',
			[
				'label'      => __('From Top', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Bottom
		$this->add_responsive_control(
			'icon_position_from_bottom',
			[
				'label'      => __('From Bottom', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial', 'static']
				],
			]
		);

		// Icon Transition
		$this->add_responsive_control(
			'icon_transition',
			[
				'label'      => __('Transition', 'element-ready-pro'),
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
					'{{WRAPPER}} .button__icon,{{WRAPPER}} .button__icon img' => 'transition: {{SIZE}}s;',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Margin
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Padding
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __('Padding', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button__icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .button__icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => __('Hover', 'element-ready-pro'),
			]
		);

		// Icon Image Filter
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'      => 'hover_icon_image_filters',
				'selector'  => '{{WRAPPER}} .video__popup__button:hover .button__icon img',
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Box Hover Icon Color
		$this->add_control(
			'hover_icon_color',
			[
				'label'     => __('Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover .button__icon, {{WRAPPER}} :focus .button__icon' => 'color: {{VALUE}};',
				],
			]
		);

		// Box Hover Icon Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_icon_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:hover .button__icon,{{WRAPPER}} .video__popup__button:hover .button__icon:before',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr4',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'hover_icon_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .video__popup__button:hover .button__icon,{{WRAPPER}} .video__popup__button:hover .button__icon',
			]
		);

		// Icon Radius
		$this->add_control(
			'hover_icon_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:hover .button__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hover_icon_shadow',
				'selector' => '{{WRAPPER}} .video__popup__button:hover .button__icon',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/


		/*----------------------------
			TITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __('Title', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .button__title',
			]
		);

		// Title Color
		$this->add_control(
			'title_text_color',
			[
				'label'     => __('Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .button__title' => 'color: {{VALUE}};',
				],
			]
		);

		// Box Hover Title Color
		$this->add_control(
			'box_hover_title_color',
			[
				'label'     => __('Box Hover Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover .button__title,{{WRAPPER}} .video__popup__button:focus .button__title' => 'color: {{VALUE}};',
				],
			]
		);

		// Title Margin
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/*----------------------------
			TITLE STYLE END
		-----------------------------*/

		/*----------------------------
			SUBTITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => __('Subtitle', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Subtitle Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .button__subtitle',
			]
		);

		// Subtitle Color
		$this->add_control(
			'subtitle_color',
			[
				'label'  => __('Color', 'element-ready-pro'),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		// Box Hover Subtitle Color
		$this->add_control(
			'box_hover_subtitle_color',
			[
				'label'  => __('Box Hover Color', 'element-ready-pro'),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover .button__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		// Subtitle Margin
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .button__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/*----------------------------
			SUBTITLE STYLE END
		-----------------------------*/

		/*----------------------------
			BUTTON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => __('Button', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Button Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .video__popup__button',
			]
		);

		// Before Display;
		$this->add_responsive_control(
			'button_display',
			[
				'label'   => __('Display', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'initial'      => __('Initial', 'element-ready-pro'),
					'block'        => __('Block', 'element-ready-pro'),
					'inline-block' => __('Inline Block', 'element-ready-pro'),
					'flex'         => __('Flex', 'element-ready-pro'),
					'inline-flex'  => __('Inline Flex', 'element-ready-pro'),
					'none'         => __('none', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button' => 'display: {{VALUE}};',
				],
			]
		);

		// Align
		$this->add_responsive_control(
			'button_align_redirection',
			[
				'label'   => __('Flex Direction', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => __('Row', 'element-ready-pro'),
						'icon'  => 'eicon-arrow-down',
					],
					'column' => [
						'title' => __('Column', 'element-ready-pro'),
						'icon'  => ' eicon-h-align-stretch',
					],
					'row-reverse' => [
						'title' => __('Row Reverse', 'element-ready-pro'),
						'icon'  => 'eicon-arrow-down',
					],
					'column-reverse' => [
						'title' => __('Column Reverse', 'element-ready-pro'),
						'icon'  => ' eicon-h-align-stretch',
					],
				],
				'condition' => [
					'button_display' => ['flex', 'inline-flex']
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button' => 'flex-direction: {{VALUE}};',

				],
				'separator' => 'before',
			]
		);

		// Button Hr
		$this->add_control(
			'hr50',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);


		$this->start_controls_tabs('button_tab_style');
		$this->start_controls_tab(
			'button_normal_tab',
			[
				'label' => __('Normal', 'element-ready-pro'),
			]
		);

		// Button Color
		$this->add_control(
			'button_color',
			[
				'label'     => __('Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.video__popup__button, {{WRAPPER}} .video__popup__button' => 'color: {{VALUE}};',
				],
			]
		);

		// Button Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button',
			]
		);

		// Button Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .video__popup__button',
			]
		);

		// Button Radius
		$this->add_control(
			'button_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .video__popup__button',
			]
		);

		// Align
		$this->add_responsive_control(
			'button_align',
			[
				'label'   => __('Alignment', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'element-ready-pro'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'element-ready-pro'),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'element-ready-pro'),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justify', 'element-ready-pro'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .video__popup__button' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		// Button Hr
		$this->add_control(
			'button_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Button Width
		$this->add_responsive_control(
			'button_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Button Height
		$this->add_responsive_control(
			'button_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Button Hr
		$this->add_control(
			'button_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Button Margin
		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button Padding
		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __('Padding', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			[
				'label' => __('Hover', 'element-ready-pro'),
			]
		);

		// Button Hover Color
		$this->add_control(
			'hover_button_color',
			[
				'label'     => __('Color', 'element-ready-pro'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover, {{WRAPPER}} a.video__popup__button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		// Button Hover BG
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_button_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:hover,{{WRAPPER}} .video__popup__button:focus',
			]
		);

		// Button Radius
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'hover_button_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .video__popup__button:hover,{{WRAPPER}} .video__popup__button:focus',
			]
		);

		// Button Hover Radius
		$this->add_control(
			'hover_button_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hover_button_shadow',
				'selector' => '{{WRAPPER}} .video__popup__button:hover',
			]
		);

		// Button Hover Animation
		$this->add_control(
			'button_hover_animation',
			[
				'label'    => __('Hover Animation', 'element-ready-pro'),
				'type'     => Controls_Manager::HOVER_ANIMATION,
				'selector' => '{{WRAPPER}} .video__popup__button:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		/*----------------------------
			BUTTON STYLE END
		-----------------------------*/

		/*----------------------------
			BOX BEFORE / AFTER
		-----------------------------*/
		$this->start_controls_section(
			'box_before_after_style_section',
			[
				'label' => __('Before / After', 'element-ready-pro'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('before_after_tab_style');
		$this->start_controls_tab(
			'before_tab',
			[
				'label' => __('BEFORE', 'element-ready-pro'),
			]
		);

		// Before Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'before_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:before',
			]
		);

		// Before Display;
		$this->add_responsive_control(
			'before_display',
			[
				'label'   => __('Display', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'initial'      => __('Initial', 'element-ready-pro'),
					'block'        => __('Block', 'element-ready-pro'),
					'inline-block' => __('Inline Block', 'element-ready-pro'),
					'flex'         => __('Flex', 'element-ready-pro'),
					'inline-flex'  => __('Inline Flex', 'element-ready-pro'),
					'none'         => __('none', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:before' => 'display: {{VALUE}};',
				],
			]
		);

		// Before Postion
		$this->add_responsive_control(
			'before_position',
			[
				'label'   => __('Position', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'initial'  => __('Initial', 'element-ready-pro'),
					'absolute' => __('Absulute', 'element-ready-pro'),
					'relative' => __('Relative', 'element-ready-pro'),
					'static'   => __('Static', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:before' => 'position: {{VALUE}};',
				],
			]
		);

		// Postion From Left
		$this->add_responsive_control(
			'before_position_from_left',
			[
				'label'      => __('From Left', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'before_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Right
		$this->add_responsive_control(
			'before_position_from_right',
			[
				'label'      => __('From Right', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'before_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Top
		$this->add_responsive_control(
			'before_position_from_top',
			[
				'label'      => __('From Top', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'before_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Bottom
		$this->add_responsive_control(
			'before_position_from_bottom',
			[
				'label'      => __('From Bottom', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'before_position!' => ['initial', 'static']
				],
			]
		);

		// Before Align
		$this->add_responsive_control(
			'before_align',
			[
				'label'   => __('Alignment', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'text-align:left' => [
						'title' => __('Left', 'element-ready-pro'),
						'icon'  => 'fa fa-align-left',
					],
					'margin: 0 auto' => [
						'title' => __('Center', 'element-ready-pro'),
						'icon'  => 'fa fa-align-center',
					],
					'float:right' => [
						'title' => __('Right', 'element-ready-pro'),
						'icon'  => 'fa fa-align-right',
					],
					'text-align:justify' => [
						'title' => __('Justify', 'element-ready-pro'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:before' => '{{VALUE}};',
				],
				'default' => 'text-align:left',
			]
		);

		// Before Width
		$this->add_responsive_control(
			'before_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Before Height
		$this->add_responsive_control(
			'before_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Before Opacity
		$this->add_control(
			'before_opacity',
			[
				'label' => __('Opacity', 'element-ready-pro'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'before_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .video__popup__button:before',
			]
		);
		$this->add_control(
			'before_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'before_shadow',
				'selector' => '{{WRAPPER}} .video__popup__button:before',
			]
		);

		// Before Z-Index
		$this->add_control(
			'before_zindex',
			[
				'label'     => __('Z-Index', 'element-ready-pro'),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -99,
				'max'       => 99,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:before' => 'z-index: {{SIZE}};',
				],
			]
		);

		// Before Margin
		$this->add_responsive_control(
			'before_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Transition
		$this->add_control(
			'before_transition',
			[
				'label'      => __('Transition', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'transition: {{SIZE}}s;',
				],
			]
		);

		// Scale
		$this->add_control(
			'before_scale',
			[
				'label'      => __('Scale', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'transform: scale({{SIZE}}{{UNIT}});',
				],
			]
		);

		// Rotate
		$this->add_control(
			'before_rotate',
			[
				'label'      => __('Rotate', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
				],
			]
		);

		/*----------------
			BEFORE HOVER
		-------------------*/
		$this->add_control(
			'before_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'before_hover_hr',
			[
				'label'     => __('Before Hover', 'element-ready-pro'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		// Before Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_before_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:hover:before',
			]
		);

		// Before Width
		$this->add_responsive_control(
			'hover_before_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Before Height
		$this->add_responsive_control(
			'hover_before_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Before Opacity
		$this->add_control(
			'hover_before_opacity',
			[
				'label' => __('Opacity', 'element-ready-pro'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover:before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'hover_before_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Scale
		$this->add_control(
			'hover_before_scale',
			[
				'label'      => __('Scale', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:before' => 'transform: scale({{SIZE}}{{UNIT}});',
				],
			]
		);

		// Rotate
		$this->add_control(
			'hover_before_rotate',
			[
				'label'      => __('Rotate', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'after_tab',
			[
				'label' => __('AFTER', 'element-ready-pro'),
			]
		);

		// After Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'after_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:after',
			]
		);

		// After Display;
		$this->add_responsive_control(
			'after_display',
			[
				'label'   => __('Display', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'initial'      => __('Initial', 'element-ready-pro'),
					'block'        => __('Block', 'element-ready-pro'),
					'inline-block' => __('Inline Block', 'element-ready-pro'),
					'flex'         => __('Flex', 'element-ready-pro'),
					'inline-flex'  => __('Inline Flex', 'element-ready-pro'),
					'none'         => __('none', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:after' => 'display: {{VALUE}};',
				],
			]
		);

		// After Postion
		$this->add_responsive_control(
			'after_position',
			[
				'label'   => __('Position', 'element-ready-pro'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'initial'  => __('Initial', 'element-ready-pro'),
					'absolute' => __('Absulute', 'element-ready-pro'),
					'relative' => __('Relative', 'element-ready-pro'),
					'static'   => __('Static', 'element-ready-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:after' => 'position: {{VALUE}};',
				],
			]
		);

		// Postion From Left
		$this->add_responsive_control(
			'after_position_from_left',
			[
				'label'      => __('From Left', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'after_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Right
		$this->add_responsive_control(
			'after_position_from_right',
			[
				'label'      => __('From Right', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'after_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Top
		$this->add_responsive_control(
			'after_position_from_top',
			[
				'label'      => __('From Top', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'after_position!' => ['initial', 'static']
				],
			]
		);

		// Postion From Bottom
		$this->add_responsive_control(
			'after_position_from_bottom',
			[
				'label'      => __('From Bottom', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'after_position!' => ['initial', 'static']
				],
			]
		);

		// After Align
		$this->add_responsive_control(
			'after_align',
			[
				'label'   => __('Alignment', 'element-ready-pro'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'text-align:left' => [
						'title' => __('Left', 'element-ready-pro'),
						'icon'  => 'fa fa-align-left',
					],
					'margin: 0 auto' => [
						'title' => __('Center', 'element-ready-pro'),
						'icon'  => 'fa fa-align-center',
					],
					'float:right' => [
						'title' => __('Right', 'element-ready-pro'),
						'icon'  => 'fa fa-align-right',
					],
					'text-align:justify' => [
						'title' => __('Justify', 'element-ready-pro'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:after' => '{{VALUE}};',
				],
				'default' => 'text-align:left',
			]
		);

		// After Width
		$this->add_responsive_control(
			'after_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// After Height
		$this->add_responsive_control(
			'after_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// After Opacity
		$this->add_control(
			'after_opacity',
			[
				'label' => __('Opacity', 'element-ready-pro'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:after' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'after_border',
				'label'    => __('Border', 'element-ready-pro'),
				'selector' => '{{WRAPPER}} .video__popup__button:after',
			]
		);

		$this->add_control(
			'after_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'after_shadow',
				'selector' => '{{WRAPPER}} .video__popup__button:after',
			]
		);

		// After Z-Index
		$this->add_control(
			'after_zindex',
			[
				'label'     => __('Z-Index', 'element-ready-pro'),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -99,
				'max'       => 99,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:after' => 'z-index: {{SIZE}};',
				],
			]
		);

		// After Margin
		$this->add_responsive_control(
			'after_margin',
			[
				'label'      => __('Margin', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Transition
		$this->add_control(
			'after_transition',
			[
				'label'      => __('Transition', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'transition: {{SIZE}}s;',
				],
			]
		);

		// Scale
		$this->add_control(
			'after_scale',
			[
				'label'      => __('Scale', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'transform: scale({{SIZE}}{{UNIT}});',
				],
			]
		);

		// Rotate
		$this->add_control(
			'after_rotate',
			[
				'label'      => __('Rotate', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
				],
			]
		);

		/*----------------
			AFTER HOVER
		-------------------*/
		$this->add_control(
			'after_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'after_hover_hr',
			[
				'label'     => __('After Hover', 'element-ready-pro'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		// After Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hover_after_background',
				'label'    => __('Background', 'element-ready-pro'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .video__popup__button:hover:after',
			]
		);

		// after Width
		$this->add_responsive_control(
			'hover_after_width',
			[
				'label'      => __('Width', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// after Height
		$this->add_responsive_control(
			'hover_after_height',
			[
				'label'      => __('Height', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// after Opacity
		$this->add_control(
			'hover_after_opacity',
			[
				'label' => __('Opacity', 'element-ready-pro'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video__popup__button:hover:after' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'hover_after_radius',
			[
				'label'      => __('Border Radius', 'element-ready-pro'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .video__popup__button:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Scale
		$this->add_control(
			'hover_after_scale',
			[
				'label'      => __('Scale', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:after' => 'transform: scale({{SIZE}}{{UNIT}});',
				],
			]
		);

		// Rotate
		$this->add_control(
			'hover_after_rotate',
			[
				'label'      => __('Rotate', 'element-ready-pro'),
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
					'{{WRAPPER}} .video__popup__button:hover:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		/*----------------------------
			BOX BEFORE / AFTER END
		-----------------------------*/
	}

	protected function render()
	{

		$settings  = $this->get_settings_for_display();

		// Button animation
		if ($settings['button_hover_animation']) {
			$button_animation = 'elementor-animation-' . $settings['button_hover_animation'];
		} else {
			$button_animation = '';
		}

		$random_id  = rand(5655, 5874);
		$parse_data = array(
			'random_id'    => $random_id,
			'channel_type' => $settings['get_video_from'],
		);
		$this->add_render_attribute('video_button_attr', 'data-value', wp_json_encode($parse_data));
		$this->add_render_attribute('video_button_attr', 'id', 'video__popup__button' . $random_id);

		if ('youtube' == $settings['get_video_from']) {
			if (!empty($settings['youtube_video_id'])) {
				$this->add_render_attribute('video_button_attr', 'data-video-id', $settings['youtube_video_id']);
			}
		} elseif ('vimeo' == $settings['get_video_from']) {
			if (!empty($settings['vimeo_video_id'])) {
				$this->add_render_attribute('video_button_attr', 'data-video-id', $settings['vimeo_video_id']);
			}
		}

		if ('button__layout__custom' != $settings['button_layout_style']) {
			$this->add_render_attribute('video_button_attr', 'class', $settings['button_layout_style']);
		}
		// Button Class & Link Attr
		$this->add_render_attribute('video_button_attr', 'class', 'video__popup__button');
		$this->add_render_attribute('video_button_attr', 'class', $button_animation);


		// Title
		if (!empty($settings['title'])) {
			$title = '<span class="button__title">' . esc_html($settings['title']) . '</span>';
		} else {
			$title = '';
		}

		// Subtitle
		if (!empty($settings['subtitle'])) {
			$subtitle = '<span class="button__subtitle">' . esc_html($settings['subtitle']) . '</span>';
		} else {
			$subtitle = '';
		}

		// Title Condition
		if (!empty($settings['subtitle_position'])) {
			if ('before_title' == $settings['subtitle_position']) {
				$title_subtitle = $subtitle . $title;
			} elseif ('after_title' == $settings['subtitle_position']) {
				$title_subtitle = $title . $subtitle;
			} elseif (empty($settings['subtitle'])) {
				$title_subtitle = $title . $subtitle;
			}
		} else {
			$title_subtitle = $title . $subtitle;
		}

		// Button
		if (!empty($settings['title']) || !empty($settings['youtube_video_id']) || !empty($settings['vimeo_video_id'])) {
			$button = '<div ' . $this->get_render_attribute_string('video_button_attr') . '>' . $title_subtitle . '</div>';
		} else {
			$button = '';
		}

		// Icon Condition
		if ('yes' == $settings['show_icon']) {

			if ('font_icon' == $settings['icon_type'] && !empty($settings['font_icon'])) {

				if ('left' == $settings['button_icon_align']) {

					$button = '<div ' . $this->get_render_attribute_string('video_button_attr') . '>
						<div class="button__icon video__button_icon_left">' . element_ready_render_icons($settings['font_icon']) . '</div>
						<div class="button__text">' . $title_subtitle . '</div>
					</div>';
				} elseif ('right' == $settings['button_icon_align']) {

					$button = '<div ' . $this->get_render_attribute_string('video_button_attr') . '>
						<div class="button__text">' . $title_subtitle . '</div>
						<div class="button__icon video__button_icon_right">' . element_ready_render_icons($settings['font_icon']) . '</div>
					</div>';
				}
			} elseif ('image_icon' == $settings['icon_type'] && !empty($settings['image_icon'])) {

				$icon_array = $settings['image_icon'];
				$icon_link = wp_get_attachment_image_url($icon_array['id'], 'thumbnail');

				if ('left' == $settings['button_icon_align']) {

					$button = '<div ' . $this->get_render_attribute_string('video_button_attr') . '>
						<div class="button__icon video__button_icon_left"><img src="' . esc_url($icon_link) . '" alt="" /></div>
						<div class="button__text">' . $title_subtitle . '</div>
					</div>';
				} elseif ('right' == $settings['button_icon_align']) {

					$button = '<div ' . $this->get_render_attribute_string('video_button_attr') . '>
						<div class="button__text">' . $title_subtitle . '</div>
						<div class="button__icon video__button_icon_right"><img src="' . esc_url($icon_link) . '" alt="" /></div>
					</div>';
				}
			}
		}

		echo '' . (isset($button) ? $button : '') . '';
	}
}
