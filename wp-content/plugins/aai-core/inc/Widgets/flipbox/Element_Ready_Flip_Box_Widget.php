<?php
namespace Element_Ready_Pro\Widgets\flipbox;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Element_Ready\Controls\Custom_Controls_Manager;
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

class Element_Ready_Flip_Box_Widget extends Widget_Base {

	public function get_name() {
		return 'Element_Ready_Flip_Box_Widget';
	}

	public function get_title() {
		return __( 'ER Multitype Flip Box', 'element-ready-pro' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

	public function get_categories() {
		return array('element-ready-pro');
	}

    public function get_script_depends() {
		
        return [
            'flip',
            'element-ready-core',
        ];
    }

    public function get_style_depends() {

        return [
            'flip',
        ];
    }

    public function get_keywords() {
        return [ 'box', 'flip box', 'text box', 'service box', 'service', 'flip' ];
    }


    public static function box_layout_style(){
        return [
            'flip__animate__none'     => esc_html__('None', 'element-ready-pro'),
            'flip__animate__style__1' => esc_html__('Flip Animate 1', 'element-ready-pro'),
            'flip__animate__style__2' => esc_html__('Flip Animate 2', 'element-ready-pro'),
            'flip__animate__style__3' => esc_html__('Flip Animate 3', 'element-ready-pro'),
            'flip__animate__style__4' => esc_html__('Flip Animate 4', 'element-ready-pro'),
            'flip__animate__style__5' => esc_html__('Flip Animate 5', 'element-ready-pro'),
        ];
    }

	protected function register_controls() {

		/******************************
		 * 	CONTENT SECTION
		 ******************************/
		$this->start_controls_section(
			'option_section',
			[
				'label' => __( 'Fip Options', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'box_layout_style',
				[
					'label'   => __( 'Flip Text Animate', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'flip__animate__none',
					'options' => self::box_layout_style(),
				]
			);		
			$this->add_control(
				'flip_axis',
				[
					'label'   => __( 'Flip Axis', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'x' => esc_html__('X Axis', 'element-ready-pro'),
						'y' => esc_html__('Y Axis', 'element-ready-pro'),
					],
					'default' => 'x',
					'separator'    => 'before',
				]
			);		
			$this->add_control(
				'flip_trigger',
				[
					'label'   => __( 'Flip Trigger', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'hover' => esc_html__('On Hover', 'element-ready-pro'),
						'click' => esc_html__('On Click', 'element-ready-pro'),
					],
					'default' => 'hover',
					'separator'    => 'before',
				]
			);
			$this->add_control(
				'flip_reverse',
				[
					'label'        => __( 'Flip Reverse ?', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'element-ready-pro' ),
					'label_off'    => __( 'Hide', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'separator'    => 'before',
				]
			);
			$this->add_control(
				'flip_transition',
				[
					'label' => __( 'Flip Transition Time', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 5000,
							'min' => 500,
							'step' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 500,
					],
					'separator'    => 'before',
				]
			);

			$this->add_control(
				'active_box',
				[
					'label'        => __( 'Active Default ?', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'element-ready-pro' ),
					'label_off'    => __( 'Hide', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'separator'    => 'before',
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->start_controls_tabs( '_content_tabs');
				$this->start_controls_tab(
					'_content_front_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					// BOX BACKGROUND ICON TOGGLE
					$this->add_control(
						'show_box_bg_text_or_icon',
						[
							'label'        => __( 'Background Icon / Text ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Icon Type
					$this->add_control(
						'box_bg_icon_type',
						[
							'label'   => __( 'Icon Type', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'font_icon',
							'options' => [
								'font_icon'   => __( 'Font & SVG Icon', 'element-ready-pro' ),
								'image_icon'  => __( 'Image Icon', 'element-ready-pro' ),
								'simple_text' => __( 'Simple Text', 'element-ready-pro' ),
							],
							'condition' => [
								'show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Font Icon
					$this->add_control(
						'box_bg_font_icon',
						[
							'label'   => __( 'Font Icons', 'element-ready-pro' ),
							'type'    => Controls_Manager::ICONS,
							'default' => [
								'value'   => 'fas fa-star',
								'library' => 'solid',
							],
							'condition' => [
								'box_bg_icon_type'         => 'font_icon',
								'show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Image Icon
					$this->add_control(
						'box_bg_image_icon',
						[
							'label'   => __( 'Image Icon', 'element-ready-pro' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'box_bg_icon_type'         => 'image_icon',
								'show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Text Bg
					$this->add_control(
						'box_bg_text',
						[
							'label'       => __( 'Image Icon', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( '01', 'element-ready-pro' ),
							'condition'   => [
								'box_bg_icon_type'         => 'simple_text',
								'show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Icon Toggle
					$this->add_control(
						'show_box_image',
						[
							'label'        => __( 'Box Features Image ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Image 
					$this->add_control(
						'box_image',
						[
							'label'   => __( 'Box Image', 'element-ready-pro' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'show_box_image' => 'yes',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Image_Size:: get_type(),
						[
							'name'      => 'box_image_size',
							'exclude'   => [ 'custom' ],
							'default'   => 'large',
							'condition' => [
								'show_box_image' => 'yes',
							],
						]
					);
					$this->add_control(
						'box_image_postion',
						[
							'label'   => __( 'Image Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'before',
							'options' => [
								'before' => __( 'Before Content', 'element-ready-pro' ),
								'after'  => __( 'After Content', 'element-ready-pro' ),
							],
							'condition' => [
								'show_box_image' => 'yes',
							],
						]
					);

					// Icon Toggle
					$this->add_control(
						'show_icon',
						[
							'label'        => __( 'Show Icon ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'yes',
							'separator'    => 'before',
						]
					);

					// Icon Type
					$this->add_control(
						'icon_type',
						[
							'label'   => __( 'Icon Type', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'font_icon',
							'options' => [
								'font_icon'  => __( 'Font & SVG Icon', 'element-ready-pro' ),
								'image_icon' => __( 'Image Icon', 'element-ready-pro' ),
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
							'label'       => __( 'Font Icons', 'element-ready-pro' ),
							'type'        => Controls_Manager::ICONS,
							'label_block' => true,
							'default'     => [
								'value'   => 'fas fa-star',
								'library' => 'solid',
							],
							'condition' => [
								'icon_type' => 'font_icon',
								'show_icon' => 'yes',
							],
						]
					);

					// Image Icon
					$this->add_control(
						'image_icon',
						[
							'label'   => __( 'Image Icon', 'element-ready-pro' ),
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

					// Title
					$this->add_control(
						'title',
						[
							'label'       => __( 'Title', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Enter Your Title', 'element-ready-pro' ),
							'separator'   => 'before',
							'default'     => __('Your Title Here.', 'element-ready-pro'),
						]
					);

					// Title Tag
					$this->add_control(
						'title_tag',
						[
							'label'   => __( 'Title HTML Tag', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'h1'   => 'H1',
								'h2'   => 'H2',
								'h3'   => 'H3',
								'h4'   => 'H4',
								'h5'   => 'H5',
								'h6'   => 'H6',
								'div'  => 'div',
								'span' => 'span',
								'p'    => 'p',
							],
							'default'   => 'h3',
							'condition' => [
								'title!' => '',
							],
						]
					);

					// Title Link
					$this->add_control(
						'title_link',
						[
							'label'         => __( 'Linked Title ?', 'element-ready-pro' ),
							'type'          => Controls_Manager::URL,
							'placeholder'   => __( 'https://your-link.com', 'element-ready-pro' ),
							'show_external' => true,
							'default'       => [
								'url'         => '',
								'is_external' => false,
								'nofollow'    => false,
							],
							'condition' => [
								'title!' => '',
							],
						]
					);

					// Subtitle
					$this->add_control(
						'subtitle',
						[
							'label'       => __( 'Subtitle', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Subtitle', 'element-ready-pro' ),
							'separator'   => 'before',
						]
					);

					// Subtitle Position
					$this->add_control(
						'subtitle_position',
						[
							'label'   => __( 'Subtitle Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'after_title',
							'options' => [
								'before_title' => __( 'Before title', 'element-ready-pro' ),
								'after_title'  => __( 'After Title', 'element-ready-pro' ),
							],
							'condition' => [
								'subtitle!' => '',
							]
						]
					);

					// Description
					$this->add_control(
						'description',
						[
							'label'       => __( 'Description', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXTAREA,
							'placeholder' => __( 'Description.', 'element-ready-pro' ),
							'separator'   => 'before',
							'default'     => __( 'Type your content here what you want. then change all style for your own purpose.', 'element-ready-pro' ),
						]
					);

					// Button Toggle
					$this->add_control(
						'show_button',
						[
							'label'        => __( 'Show Button ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Button Title
					$this->add_control(
						'button_text',
						[
							'label'       => __( 'Button Title', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Button Text', 'element-ready-pro' ),
							'separator'   => 'before',
							'condition' => ['show_button' => 'yes'],
						]
					);

					// Button Link
					$this->add_control(
						'button_link',
						[
							'label'         => __( 'Button Link', 'element-ready-pro' ),
							'type'          => Controls_Manager::URL,
							'placeholder'   => __( 'https://your-link.com', 'element-ready-pro' ),
							'show_external' => true,
							'default'       => [
								'url'         => '',
								'is_external' => false,
								'nofollow'    => false,
							],
							'condition' => ['show_button' => 'yes'],
						]
					);

					// Button Icon Picker
					$this->add_control(
						'button_icon',
						[
							'label'       => __( 'Set Button Icon', 'element-ready-pro' ),
							'type'        => Controls_Manager::ICON,
							'label_block' => true,
							'default'     => '',
							'condition'   => ['show_button' => 'yes'],
							'separator'   => 'before',
						]
					);

					// Button Icon Align
					$this->add_control(
						'button_icon_align',
						[
							'label'   => __( 'Icon Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'left',
							'options' => [
								'left'  => __( 'Before', 'element-ready-pro' ),
								'right' => __( 'After', 'element-ready-pro' ),
							],
							'condition' => [
								'button_icon!' => '',
							],
						]
					);

					// Button Icon Margin
					$this->add_control(
						'button_icon_indent',
						[
							'label' => __( 'Icon Spacing', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max' => 50,
								],
							],
							'condition' => [
								'button_icon!' => '',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__button .flip__front__button_icon_right' => 'margin-left: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__front__button .flip__front__button_icon_left'  => 'margin-right: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'content_placement_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'content__left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'eicon-h-align-left',
								],
								'content__center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'eicon-v-align-top',
								],
								'content__right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'eicon-h-align-right',
								],
							],
							'separator' => 'before',
							'condition' => [
								'content_placement_type' => 'default',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'_content_back_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);

					// BOX BACKGROUND ICON TOGGLE
					$this->add_control(
						'back_show_box_bg_text_or_icon',
						[
							'label'        => __( 'Background Icon / Text ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Icon Type
					$this->add_control(
						'back_box_bg_icon_type',
						[
							'label'   => __( 'Icon Type', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'font_icon',
							'options' => [
								'font_icon'   => __( 'Font & SVG Icon', 'element-ready-pro' ),
								'image_icon'  => __( 'Image Icon', 'element-ready-pro' ),
								'simple_text' => __( 'Simple Text', 'element-ready-pro' ),
							],
							'condition' => [
								'back_show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Font Icon
					$this->add_control(
						'back_box_bg_font_icon',
						[
							'label'   => __( 'Font Icons', 'element-ready-pro' ),
							'type'    => Controls_Manager::ICONS,
							'default' => [
								'value'   => 'fas fa-star',
								'library' => 'solid',
							],
							'condition' => [
								'back_box_bg_icon_type'         => 'font_icon',
								'back_show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Image Icon
					$this->add_control(
						'back_box_bg_image_icon',
						[
							'label'   => __( 'Image Icon', 'element-ready-pro' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'back_box_bg_icon_type'         => 'image_icon',
								'back_show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					// Text Bg
					$this->add_control(
						'back_box_bg_text',
						[
							'label'       => __( 'Image Icon', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( '01', 'element-ready-pro' ),
							'condition'   => [
								'back_box_bg_icon_type'         => 'simple_text',
								'back_show_box_bg_text_or_icon' => 'yes',
							],
						]
					);

					$this->add_control(
						'back_show_box_image',
						[
							'label'        => __( 'Box Features Image ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Image 
					$this->add_control(
						'back_box_image',
						[
							'label'   => __( 'Box Image', 'element-ready-pro' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'back_show_box_image' => 'yes',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Image_Size:: get_type(),
						[
							'name'      => 'back_box_image_size',
							'exclude'   => [ 'custom' ],
							'default'   => 'large',
							'condition' => [
								'back_show_box_image' => 'yes',
							],
						]
					);
					$this->add_control(
						'back_box_image_postion',
						[
							'label'   => __( 'Image Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'before',
							'options' => [
								'before' => __( 'Before Content', 'element-ready-pro' ),
								'after'  => __( 'After Content', 'element-ready-pro' ),
							],
							'condition' => [
								'back_show_box_image' => 'yes',
							],
						]
					);

					// Icon Toggle
					$this->add_control(
						'back_show_icon',
						[
							'label'        => __( 'Show Icon ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'yes',
							'separator'    => 'before',
						]
					);

					// Icon Type
					$this->add_control(
						'back_icon_type',
						[
							'label'   => __( 'Icon Type', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'font_icon',
							'options' => [
								'font_icon'  => __( 'Font & SVG Icon', 'element-ready-pro' ),
								'image_icon' => __( 'Image Icon', 'element-ready-pro' ),
							],
							'condition' => [
								'back_show_icon' => 'yes',
							],
						]
					);

					// Font Icon
					$this->add_control(
						'back_font_icon',
						[
							'label'       => __( 'Font Icons', 'element-ready-pro' ),
							'type'        => Controls_Manager::ICONS,
							'label_block' => true,
							'default'     => [
								'value'   => 'fas fa-star',
								'library' => 'solid',
							],
							'condition' => [
								'back_icon_type' => 'font_icon',
								'back_show_icon' => 'yes',
							],
						]
					);

					// Image Icon
					$this->add_control(
						'back_image_icon',
						[
							'label'   => __( 'Image Icon', 'element-ready-pro' ),
							'type'    => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'condition' => [
								'back_icon_type' => 'image_icon',
								'back_show_icon' => 'yes',
							],
						]
					);

					// Title
					$this->add_control(
						'back_title',
						[
							'label'       => __( 'Title', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Enter Your Title', 'element-ready-pro' ),
							'separator'   => 'before',
							'default'     => __('Your Title Here.', 'element-ready-pro'),
						]
					);

					// Title Tag
					$this->add_control(
						'back_title_tag',
						[
							'label'   => __( 'Title HTML Tag', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'h1'   => 'H1',
								'h2'   => 'H2',
								'h3'   => 'H3',
								'h4'   => 'H4',
								'h5'   => 'H5',
								'h6'   => 'H6',
								'div'  => 'div',
								'span' => 'span',
								'p'    => 'p',
							],
							'default'   => 'h3',
							'condition' => [
								'back_title!' => '',
							],
						]
					);

					// Title Link
					$this->add_control(
						'back_title_link',
						[
							'label'         => __( 'Linked Title ?', 'element-ready-pro' ),
							'type'          => Controls_Manager::URL,
							'placeholder'   => __( 'https://your-link.com', 'element-ready-pro' ),
							'show_external' => true,
							'default'       => [
								'url'         => '',
								'is_external' => false,
								'nofollow'    => false,
							],
							'condition' => [
								'back_title!' => '',
							],
						]
					);

					// Subtitle
					$this->add_control(
						'back_subtitle',
						[
							'label'       => __( 'Subtitle', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Subtitle', 'element-ready-pro' ),
							'separator'   => 'before',
						]
					);

					// Subtitle Position
					$this->add_control(
						'back_subtitle_position',
						[
							'label'   => __( 'Subtitle Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'after_title',
							'options' => [
								'before_title' => __( 'Before title', 'element-ready-pro' ),
								'after_title'  => __( 'After Title', 'element-ready-pro' ),
							],
							'condition' => [
								'back_subtitle!' => '',
							]
						]
					);

					// Description
					$this->add_control(
						'back_description',
						[
							'label'       => __( 'Description', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXTAREA,
							'placeholder' => __( 'Description.', 'element-ready-pro' ),
							'separator'   => 'before',
							'default'     => __( 'Type your content here what you want. then change all style for your own purpose.', 'element-ready-pro' ),
						]
					);

					// Button Toggle
					$this->add_control(
						'back_show_button',
						[
							'label'        => __( 'Show Button ?', 'element-ready-pro' ),
							'type'         => Controls_Manager::SWITCHER,
							'label_on'     => __( 'Show', 'element-ready-pro' ),
							'label_off'    => __( 'Hide', 'element-ready-pro' ),
							'return_value' => 'yes',
							'default'      => 'no',
							'separator'    => 'before',
						]
					);

					// Button Title
					$this->add_control(
						'back_button_text',
						[
							'label'       => __( 'Button Title', 'element-ready-pro' ),
							'type'        => Controls_Manager::TEXT,
							'placeholder' => __( 'Button Text', 'element-ready-pro' ),
							'condition'   => ['back_show_button' => 'yes'],
							'separator'   => 'before',
						]
					);

					// Button Link
					$this->add_control(
						'back_button_link',
						[
							'label'         => __( 'Button Link', 'element-ready-pro' ),
							'type'          => Controls_Manager::URL,
							'placeholder'   => __( 'https://your-link.com', 'element-ready-pro' ),
							'show_external' => true,
							'default'       => [
								'url'         => '',
								'is_external' => false,
								'nofollow'    => false,
							],
							'condition' => ['back_show_button' => 'yes'],
						]
					);

					// Button Icon Picker
					$this->add_control(
						'back_button_icon',
						[
							'label'       => __( 'Set Button Icon', 'element-ready-pro' ),
							'type'        => Controls_Manager::ICON,
							'label_block' => true,
							'default'     => '',
							'condition'   => ['back_show_button' => 'yes'],
							'separator'   => 'before',
						]
					);

					// Button Icon Align
					$this->add_control(
						'back_button_icon_align',
						[
							'label'   => __( 'Icon Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'left',
							'options' => [
								'left'  => __( 'Before', 'element-ready-pro' ),
								'right' => __( 'After', 'element-ready-pro' ),
							],
							'condition' => [
								'back_button_icon!' => '',
							],
						]
					);

					// Button Icon Margin
					$this->add_control(
						'back_button_icon_indent',
						[
							'label' => __( 'Icon Spacing', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max' => 50,
								],
							],
							'condition' => [
								'button_icon!' => '',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__button .flip__back__button_icon_right' => 'margin-left: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__back__button .flip__back__button_icon_left'  => 'margin-right: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'back_content_placement_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'content__left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'eicon-h-align-left',
								],
								'content__center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'eicon-v-align-top',
								],
								'content__right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'eicon-h-align-right',
								],
							],
							'separator' => 'before',
							'condition' => [
								'back_content_placement_type' => 'default',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

		/*********************************
		 		STYLE SECTION
		**********************************/
		/*----------------------------
			ICON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'icon_style_section',
			[
				'label'     => __( 'Icon', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
			$this->start_controls_tabs( '_flipbox_icon_tabs',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'_flipbox_icon_front_tab',
					[
						'label' => __( 'Front Part Icon', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'      => 'icon_typography',
							'selector'  => '{{WRAPPER}} .flip__front__icon',
							'condition' => [
								'icon_type' => ['font_icon']
							],
						]
					);
					$this->add_responsive_control(
						'icon_image_size',
						[
							'label'      => __( 'SVG / Image Size', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon img' => 'width: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__front__icon svg' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'icon_image_filters',
							'selector'  => '{{WRAPPER}} .flip__front__icon img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'icon_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__front__icon' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'icon_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__front__icon',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'icon_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__front__icon',
							'separator' => 'before',
						]
					);
					$this->add_control(
						'icon_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'icon_shadow',
							'selector' => '{{WRAPPER}} .flip__front__icon',
						]
					);
					$this->add_responsive_control(
						'icon_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'icon_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__icon' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__icon' => 'display: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'icon_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__icon' => 'text-align: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__icon' => 'position: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'icon_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_control(
						'icon_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__icon,{{WRAPPER}} .flip__front__icon img' => 'transition: {{SIZE}}s;',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'icon_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'icon_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'icon_hover_heading',
						[
							'label' => __( 'Icon Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'hover_icon_image_filters',
							'selector'  => '{{WRAPPER}} :hover .flip__front__icon img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_icon_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__front__icon, {{WRAPPER}} :focus .flip__front__icon' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_icon_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} :hover .flip__front__icon,{{WRAPPER}} :focus .flip__front__icon',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_icon_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} :hover .flip__front__icon,{{WRAPPER}} :hover .flip__front__icon',
						]
					);
					$this->add_control(
						'hover_icon_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} :hover .flip__front__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_icon_shadow',
							'selector' => '{{WRAPPER}} :hover .flip__front__icon',
						]
					);
					$this->add_control(
						'icon_hover_animation',
						[
							'label'    => __( 'Hover Animation', 'element-ready-pro' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} :hover .flip__front__icon',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'_flipbox_icon_back_tab',
					[
						'label' => __( 'Back Part Icon', 'element-ready-pro' ),
					]
				);

					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'      => 'back_icon_typography',
							'selector'  => '{{WRAPPER}} .flip__back__icon',
							'condition' => [
								'back_icon_type' => ['font_icon']
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_image_size',
						[
							'label'      => __( 'SVG / Image Size', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon img' => 'width: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__back__icon svg' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'back_icon_image_filters',
							'selector'  => '{{WRAPPER}} .flip__back__icon img',
							'condition' => [
								'back_icon_type' => ['image_icon']
							],
							'separator' => 'before',
						]
					);

					$this->add_control(
						'back_icon_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__back__icon' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_icon_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__back__icon',
						]
					);

					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'back_icon_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__back__icon',
							'separator' => 'before',
						]
					);

					$this->add_control(
						'back_icon_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_icon_shadow',
							'selector' => '{{WRAPPER}} .flip__back__icon',
						]
					);
					
					$this->add_responsive_control(
						'back_icon_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);

					$this->add_responsive_control(
						'back_icon_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__icon' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__icon' => 'display: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);

					$this->add_control(
						'back_icon_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__icon' => 'text-align: {{VALUE}};',
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__icon' => 'position: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);

					$this->add_responsive_control(
						'back_icon_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_icon_position!' => ['initial','static']
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_icon_position!' => ['initial','static']
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_icon_position!' => ['initial','static']
							],
						]
					);

					$this->add_responsive_control(
						'back_icon_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_icon_position!' => ['initial','static']
							],
						]
					);

					$this->add_control(
						'back_icon_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__icon,{{WRAPPER}} .flip__back__icon img' => 'transition: {{SIZE}}s;',
							],
							'separator' => 'before',
						]
					);

					$this->add_responsive_control(
						'back_icon_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					
					$this->add_responsive_control(
						'back_icon_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_icon_hover_heading',
						[
							'label' => __( 'Icon Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'hover_back_icon_image_filters',
							'selector'  => '{{WRAPPER}} :hover .flip__back__icon img',
							'condition' => [
								'back_icon_type' => ['image_icon']
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_back_icon_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__back__icon, {{WRAPPER}} :focus .flip__back__icon' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_back_icon_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} :hover .flip__back__icon,{{WRAPPER}} :focus .flip__back__icon',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_back_icon_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} :hover .flip__back__icon,{{WRAPPER}} :hover .flip__back__icon',
						]
					);
					$this->add_control(
						'hover_back_icon_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} :hover .flip__back__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_back_icon_shadow',
							'selector' => '{{WRAPPER}} :hover .flip__back__icon',
						]
					);
					$this->add_control(
						'back_icon_hover_animation',
						[
							'label'    => __( 'Hover Animation', 'element-ready-pro' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} :hover .flip__back__icon',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/

		/*----------------------------
			BOX BG ICON TEXXT STYLE
		-----------------------------*/
		$this->start_controls_section(
			'bg_icon_text_style_section',
			[
				'label'     => __( 'BG ( Icon / Text )', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_box_bg_text_or_icon' => 'yes'
				]
			]
		);
			$this->start_controls_tabs( 'bg_icon_text_tab_style',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'bg_icon_text_normal_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'bg_icon_text_typography',
							'selector' => '{{WRAPPER}} .flip__bg__front__icon__text',
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_image_size',
						[
							'label'      => __( 'Svg / Image Size', 'element-ready-pro' ),
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
								'size' => '80',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text img' => 'width: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__bg__front__icon__text svg' => 'width: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_bg_icon_type!' => 'simple_text',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'bg_icon_text_image_filters',
							'selector' => '{{WRAPPER}} .flip__bg__front__icon__text img',
							'separator' => 'before',
						]
					);
					$this->add_control(
						'bg_icon_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'bg_icon_text_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__bg__front__icon__text',
						]
					);
					$this->add_control(
						'bg_icon_text_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'bg_icon_text_shadow',
							'selector' => '{{WRAPPER}} .flip__bg__front__icon__text',
						]
					);
					$this->add_control(
						'bg_icon_text_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'bg_icon_text_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'display: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'bg_icon_text_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'text-align: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'position: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_control(
						'bg_icon_text_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__front__icon__text,{{WRAPPER}} .flip__bg__front__icon__text img' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'bg_icon_text_opacity',
						[
							'label'      => __( 'Opacity', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'bg_icon_text_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__front__icon__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'bg_icon_text_hover_headomg',
						[
							'label' => __( 'Icon Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'hover_bg_icon_text_image_filters',
							'selector' => '{{WRAPPER}} :hover .flip__bg__front__icon__text img',
						]
					);
					$this->add_control(
						'hover_bg_icon_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__bg__front__icon__text, {{WRAPPER}} :focus .flip__bg__front__icon__text' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_bg_icon_text_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} :hover .flip__bg__front__icon__text,{{WRAPPER}} :focus .flip__bg__front__icon__text',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_bg_icon_text_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} :hover .flip__bg__front__icon__text,{{WRAPPER}} :hover .flip__bg__front__icon__text',
							'separator' => 'before',
						]
					);
					$this->add_control(
						'bg_icon_text_hover_opacity',
						[
							'label'      => __( 'Opacity', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} :hover .flip__bg__front__icon__text' => 'opacity: {{SIZE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'bg_icon_text_back_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'back_bg_icon_text_typography',
							'selector' => '{{WRAPPER}} .flip__bg__back__icon__text',
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_image_size',
						[
							'label'      => __( 'Svg / Image Size', 'element-ready-pro' ),
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
								'size' => '80',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text img' => 'width: {{SIZE}}{{UNIT}};',
								'{{WRAPPER}} .flip__bg__back__icon__text svg' => 'width: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_back_bg_icon_type!' => 'simple_text',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'back_bg_icon_text_image_filters',
							'selector' => '{{WRAPPER}} .flip__bg__back__icon__text img',
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_bg_icon_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_bg_icon_text_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__bg__back__icon__text',
						]
					);
					$this->add_control(
						'back_bg_icon_text_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_bg_icon_text_shadow',
							'selector' => '{{WRAPPER}} .flip__bg__back__icon__text',
						]
					);
					$this->add_control(
						'back_bg_icon_text_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_bg_icon_text_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'display: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_bg_icon_text_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'text-align: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'position: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_bg_icon_text_position!' => ['initial','static']
							],
						]
					);
					$this->add_control(
						'back_bg_icon_text_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__bg__back__icon__text,{{WRAPPER}} .flip__bg__back__icon__text img' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'back_bg_icon_text_opacity',
						[
							'label'      => __( 'Opacity', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'back_bg_icon_text_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__bg__back__icon__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_bg_icon_text_hover_headomg',
						[
							'label' => __( 'Icon Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'hover_back_bg_icon_text_image_filters',
							'selector' => '{{WRAPPER}} :hover .flip__bg__back__icon__text img',
						]
					);
					$this->add_control(
						'hover_back_bg_icon_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__bg__back__icon__text, {{WRAPPER}} :focus .flip__bg__back__icon__text' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_back_bg_icon_text_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} :hover .flip__bg__back__icon__text,{{WRAPPER}} :focus .flip__bg__back__icon__text',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_back_bg_icon_text_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} :hover .flip__bg__back__icon__text,{{WRAPPER}} :hover .flip__bg__back__icon__text',
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_bg_icon_text_hover_opacity',
						[
							'label'      => __( 'Opacity', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} :hover .flip__bg__back__icon__text' => 'opacity: {{SIZE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX BG ICON TEXXT STYLE END
		-----------------------------*/

		/*----------------------------
			BOX BIG IMG
		-----------------------------*/
		$this->start_controls_section(
			'big_img_style_section',
			[
				'label'     => __( 'Box Image', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_box_image' => 'yes'
				]
			]
		);
			$this->start_controls_tabs( '_flipbox_big_thumb_tabs',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'_flipbox_big_thumb_front_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'big_img_filters',
							'selector' => '{{WRAPPER}} .flip__front__big__thumb img',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'big_img_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__front__big__thumb',
						]
					);
					$this->add_control(
						'big_img_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__big__thumb,{{WRAPPER}} .flip__front__big__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'big_img_shadow',
							'selector' => '{{WRAPPER}} .flip__front__big__thumb',
						]
					);
					$this->add_responsive_control(
						'big_img_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__big__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'big_img_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__big__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'_flipbox_big_thumb_back_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'     => 'back_big_img_filters',
							'selector' => '{{WRAPPER}} .flip__back__big__thumb img',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_big_img_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__back__big__thumb',
						]
					);
					$this->add_control(
						'back_big_img_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__big__thumb,{{WRAPPER}} .flip__back__big__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_big_img_shadow',
							'selector' => '{{WRAPPER}} .flip__back__big__thumb',
						]
					);
					$this->add_responsive_control(
						'back_big_img_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__big__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_big_img_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__big__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX BIG IMG END
		-----------------------------*/

		/*----------------------------
			TITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'title_style_section',
			[
				'label'     => __( 'Title', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
				],
			]
		);
			$this->start_controls_tabs( 'title_tabs_style',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'title_front_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'title_typography',
							'selector' => '{{WRAPPER}} .flip__front__title',
						]
					);
					$this->add_control(
						'title_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__front__title, {{WRAPPER}} .flip__front__title a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'title_hover_headomg',
						[
							'label' => __( 'Title Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_title_color',
						[
							'label'     => __( 'Link Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__front__title a:hover, {{WRAPPER}} .flip__front__title a:focus' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'box_hover_title_color',
						[
							'label'     => __( 'Box Hover Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__front__title a, {{WRAPPER}} :focus .flip__front__title a, {{WRAPPER}} :hover .flip__front__title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'title_back_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'back_title_typography',
							'selector' => '{{WRAPPER}} .flip__back__title',
						]
					);
					$this->add_control(
						'back_title_text_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .flip__back__title, {{WRAPPER}} .flip__back__title a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_title_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_title_hover_headomg',
						[
							'label' => __( 'Title Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_back_title_color',
						[
							'label'     => __( 'Link Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__back__title a:hover, {{WRAPPER}} .flip__back__title a:focus' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'box_hover_back_title_color',
						[
							'label'     => __( 'Box Hover Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__back__title a, {{WRAPPER}} :focus .flip__back__title a, {{WRAPPER}} :hover .flip__back__title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
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
				'label'     => __( 'Subtitle', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'subtitle!' => '',
				],
			]
		);
			$this->start_controls_tabs( '_flipbox_subtitle_tabs',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'_flipbox_subtitle_front_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'subtitle_typography',
							'selector' => '{{WRAPPER}} .flip__front__subtitle',
						]
					);
					$this->add_control(
						'subtitle_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__front__subtitle' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						'box_hover_subtitle_color',
						[
							'label'     => __( 'Box Hover Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__front__subtitle' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'subtitle_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'_flipbox_subtitle_back_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'back_subtitle_typography',
							'selector' => '{{WRAPPER}} .flip__back__subtitle',
						]
					);
					$this->add_control(
						'back_subtitle_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__back__subtitle' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						'box_hover_back_subtitle_color',
						[
							'label'     => __( 'Box Hover Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .flip__back__subtitle' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'back_subtitle_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
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
				'label'     => __( 'Button', 'element-ready-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
			$this->start_controls_tabs( 'button_tabs_style',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'button_front_tab',
					[
						'label' => __( 'Front Button', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'button_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} a.flip__front__button, {{WRAPPER}} .flip__front__button' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'button_typography',
							'selector' => '{{WRAPPER}} .flip__front__button',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'button_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__front__button',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'button_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__front__button',
						]
					);
					$this->add_control(
						'button_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'button_shadow',
							'selector' => '{{WRAPPER}} .flip__front__button',
						]
					);
					$this->add_responsive_control(
						'button_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__button' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'button_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__front__button' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'button_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__front__button' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'button_vertical_position',
						[
							'label'      => __( 'Position Vertical', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
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
								'{{WRAPPER}} .flip__front__button' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'button_horizontal_position',
						[
							'label'      => __( 'Position Horizontal', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
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
								'{{WRAPPER}} .flip__front__button' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'button_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'button_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'button_hover_headomg',
						[
							'label' => __( 'Button Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_button_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__front__button:hover, {{WRAPPER}} a.flip__front__button:focus, {{WRAPPER}} .flip__front__button:focus' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_button_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__front__button:hover,{{WRAPPER}} .flip__front__button:focus',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_button_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__front__button:hover,{{WRAPPER}} .flip__front__button:focus',
						]
					);
					$this->add_control(
						'hover_button_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__front__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_button_shadow',
							'selector' => '{{WRAPPER}} .flip__front__button:hover',
						]
					);
					$this->add_control(
						'button_hover_animation',
						[
							'label'    => __( 'Hover Animation', 'element-ready-pro' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} .flip__front__button:hover',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'button_back_tab',
					[
						'label' => __( 'Back Button', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'back_button_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} a.flip__back__button, {{WRAPPER}} .flip__back__button' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'back_button_typography',
							'selector' => '{{WRAPPER}} .flip__back__button',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_button_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__back__button',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'back_button_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__back__button',
						]
					);
					$this->add_control(
						'back_button_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_button_shadow',
							'selector' => '{{WRAPPER}} .flip__back__button',
						]
					);
					$this->add_responsive_control(
						'back_button_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__button' => 'width: {{SIZE}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'back_button_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__back__button' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_button_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__back__button' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_button_vertical_position',
						[
							'label'      => __( 'Position Vertical', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
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
								'{{WRAPPER}} .flip__back__button' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_button_horizontal_position',
						[
							'label'      => __( 'Position Horizontal', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
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
								'{{WRAPPER}} .flip__back__button' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_button_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_responsive_control(
						'back_button_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_button_hover_headomg',
						[
							'label' => __( 'Button Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_back_button_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__back__button:hover, {{WRAPPER}} a.flip__back__button:focus, {{WRAPPER}} .flip__back__button:focus' => 'color: {{VALUE}};',
							],
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_back_button_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__back__button:hover,{{WRAPPER}} .flip__back__button:focus',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_back_button_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__back__button:hover,{{WRAPPER}} .flip__back__button:focus',
						]
					);
					$this->add_control(
						'hover_back_button_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__back__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_back_button_shadow',
							'selector' => '{{WRAPPER}} .flip__back__button:hover',
						]
					);
					$this->add_control(
						'back_button_hover_animation',
						[
							'label'    => __( 'Hover Animation', 'element-ready-pro' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} .flip__back__button:hover',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BUTTON STYLE END
		-----------------------------*/

		/*----------------------------
			BOX STYLE
		-----------------------------*/
		$this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'box_tabs_style',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'box_front_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'box_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'typography',
							'selector' => '{{WRAPPER}} .flip__box__front__part',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'box_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part',
						]
					);
					$this->add_responsive_control(
						'box_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part' => 'text-align: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'box_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__box__front__part',
						]
					);
					$this->add_control(
						'box_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'box_shadow',
							'selector' => '{{WRAPPER}} .flip__box__front__part',
						]
					);
					$this->add_control(
						'box_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_responsive_control(
						'box_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'box_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'box_hover_headomg',
						[
							'label' => __( 'Button Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_box_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover' => 'color: {{VALUE}}',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'hover_box_button_color',
						[
							'label'     => __( 'Button Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover .flip__front__button' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_box_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_box_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__box__front__part:hover',
						]
					);
					$this->add_control(
						'hover_box_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_box_shadow',
							'selector' => '{{WRAPPER}} .flip__box__front__part:hover',
						]
					);
					$this->add_control(
						'box_hover_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_box_transform',
						[
							'label'      => __( 'Transform Vartically', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => -100,
									'max'  => 100,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'box_back_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'back_box_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'back_box_typography',
							'selector' => '{{WRAPPER}} .flip__box__back__part',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_box_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part',
						]
					);
					$this->add_responsive_control(
						'back_box_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part' => 'text-align: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'back_box_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__box__back__part',
						]
					);
					$this->add_control(
						'back_box_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_box_shadow',
							'selector' => '{{WRAPPER}} .flip__box__back__part',
						]
					);
					$this->add_control(
						'back_box_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
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
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_responsive_control(
						'back_box_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_box_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_box_padding',
						[
							'label'      => __( 'Padding', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_box_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_box_hover_headomg',
						[
							'label' => __( 'Button Hover', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_hover_box_color',
						[
							'label'     => __( 'Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover' => 'color: {{VALUE}}',
							],
							'separator' => 'before',
						]
					);
					$this->add_control(
						'back_hover_box_button_color',
						[
							'label'     => __( 'Button Color', 'element-ready-pro' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover .flip__front__button' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_hover_box_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'back_hover_box_border',
							'label'    => __( 'Border', 'element-ready-pro' ),
							'selector' => '{{WRAPPER}} .flip__box__back__part:hover',
						]
					);
					$this->add_control(
						'back_hover_box_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_hover_box_shadow',
							'selector' => '{{WRAPPER}} .flip__box__back__part:hover',
						]
					);
					$this->add_control(
						'back_hover_box_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_hover_box_transform',
						[
							'label'      => __( 'Transform Vartically', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => -100,
									'max'  => 100,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX STYLE END
		-----------------------------*/

		/*----------------------------
			BOX BEFORE / AFTER
		-----------------------------*/
		$this->start_controls_section(
			'box_before_after_style_section',
			[
				'label' => __( 'Box ( Before / After )', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'before_after_tab_style',
				[
					'separator'    => 'after',
				]
			);
				$this->start_controls_tab(
					'before_tab',
					[
						'label' => __( 'Front Part', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'before_headomg',
						[
							'label' => __( 'Before Style', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'before_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part:before',
						]
					);
					$this->add_responsive_control(
						'before_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'before_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'before_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'before_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'before_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'before_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'before_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:before' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'before_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'before_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'      => 'before_border',
							'label'     => __( 'Border', 'element-ready-pro' ),
							'separator' => 'before',
							'selector'  => '{{WRAPPER}} .flip__box__front__part:before',
						]
					);
					$this->add_control(
						'before_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'before_shadow',
							'selector' => '{{WRAPPER}} .flip__box__front__part:before',
						]
					);
					$this->add_responsive_control(
						'before_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'before_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'before_zindex',
						[
							'label'     => __( 'Z-Index', 'element-ready-pro' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:before' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'before_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__box__front__part:before' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'before_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'before_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:before' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'before_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();

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
			                'label'     => __( 'Before Hover', 'element-ready-pro' ),
			                'type'      => Controls_Manager::HEADING,
			                'separator' => 'after',
			            ]
			        );
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_before_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part:hover:before',
						]
					);
					$this->add_responsive_control(
						'hover_before_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:hover:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'hover_before_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:hover:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_before_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'hover_before_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'before_hover_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);

					$this->start_popover();
						$this->add_control(
							'hover_before_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:hover:before' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'hover_before_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:hover:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
								],
								'separator' => 'after',
							]
						);
					$this->end_popover();
					$this->add_control(
						'after_headomg',
						[
							'label' => __( 'After Style', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'after',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'after_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part:after',
						]
					);
					$this->add_responsive_control(
						'after_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'after_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'after_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'after_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'after_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'after_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'after_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:after' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'after_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
			                'separator' => 'before',
			                'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'after_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'      => 'after_border',
							'label'     => __( 'Border', 'element-ready-pro' ),
							'separator' => 'before',
							'selector'  => '{{WRAPPER}} .flip__box__front__part:after',
						]
					);
					$this->add_control(
						'after_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'after_shadow',
							'selector' => '{{WRAPPER}} .flip__box__front__part:after',
						]
					);
					$this->add_responsive_control(
						'after_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'after_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'after_zindex',
						[
							'label'     => __( 'Z-Index', 'element-ready-pro' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:after' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'after_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__box__front__part:after' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'after_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'after_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:after' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'after_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();

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
			                'label'     => __( 'After Hover', 'element-ready-pro' ),
			                'type'      => Controls_Manager::HEADING,
			                'separator' => 'after',
			            ]
			        );
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_after_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__front__part:hover:after',
						]
					);
					$this->add_responsive_control(
						'hover_after_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:hover:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'hover_after_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__front__part:hover:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_after_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__front__part:hover:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'hover_after_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__front__part:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'after_hover_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'hover_after_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:hover:after' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'hover_after_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__front__part:hover:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();
				$this->end_controls_tab();
				$this->start_controls_tab(
					'after_tab',
					[
						'label' => __( 'Back Part', 'element-ready-pro' ),
					]
				);
					$this->add_control(
						'back_before_headomg',
						[
							'label' => __( 'Before Style', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_before_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part:before',
						]
					);
					$this->add_responsive_control(
						'back_before_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_before_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_before_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_before_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_before_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_before_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_before_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_before_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:before' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'back_before_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_before_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'      => 'back_before_border',
							'label'     => __( 'Border', 'element-ready-pro' ),
							'separator' => 'before',
							'selector'  => '{{WRAPPER}} .flip__box__back__part:before',
						]
					);
					$this->add_control(
						'back_before_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_before_shadow',
							'selector' => '{{WRAPPER}} .flip__box__back__part:before',
						]
					);
					$this->add_responsive_control(
						'back_before_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_before_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'back_before_zindex',
						[
							'label'     => __( 'Z-Index', 'element-ready-pro' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:before' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'back_before_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__box__back__part:before' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'back_before_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'back_before_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:before' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'back_before_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{back_before_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();

					/*----------------
						BEFORE HOVER
					-------------------*/
					$this->add_control(
						'back_before_hr',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_control(
						'back_before_hover_hr',
						[
							'label'     => __( 'Before Hover', 'element-ready-pro' ),
							'type'      => Controls_Manager::HEADING,
							'separator' => 'after',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_back_before_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part:hover:before',
						]
					);
					$this->add_responsive_control(
						'hover_back_before_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:hover:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'hover_back_before_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:hover:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_back_before_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'hover_back_before_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_before_hover_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);

					$this->start_popover();
						$this->add_control(
							'hover_back_before_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:hover:before' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'hover_back_before_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:hover:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{back_before_scale.SIZE || 1}});',
								],
								'separator' => 'after',
							]
						);
					$this->end_popover();
					$this->add_control(
						'back_after_headomg',
						[
							'label' => __( 'After Style', 'element-ready-pro' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'after',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'back_after_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part:after',
						]
					);
					$this->add_responsive_control(
						'back_after_display',
						[
							'label'   => __( 'Display', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'element-ready-pro' ),
								'block'        => __( 'Block', 'element-ready-pro' ),
								'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
								'flex'         => __( 'Flex', 'element-ready-pro' ),
								'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
								'none'         => __( 'none', 'element-ready-pro' ),
							],
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_after_position',
						[
							'label'   => __( 'Position', 'element-ready-pro' ),
							'type'    => Controls_Manager::SELECT,
							'options' => [
								'initial'  => __( 'Initial', 'element-ready-pro' ),
								'absolute' => __( 'Absulute', 'element-ready-pro' ),
								'relative' => __( 'Relative', 'element-ready-pro' ),
								'static'   => __( 'Static', 'element-ready-pro' ),
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_after_position_from_left',
						[
							'label'      => __( 'From Left', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_after_position_from_right',
						[
							'label'      => __( 'From Right', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_after_position_from_top',
						[
							'label'      => __( 'From Top', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_after_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'back_after_position!' => ['initial','static']
							],
						]
					);
					$this->add_responsive_control(
						'back_after_align',
						[
							'label'   => __( 'Alignment', 'element-ready-pro' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'element-ready-pro' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:after' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'back_after_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
							'separator' => 'before',
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'back_after_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'      => 'back_after_border',
							'label'     => __( 'Border', 'element-ready-pro' ),
							'separator' => 'before',
							'selector'  => '{{WRAPPER}} .flip__box__back__part:after',
						]
					);
					$this->add_control(
						'back_after_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'back_after_shadow',
							'selector' => '{{WRAPPER}} .flip__box__back__part:after',
						]
					);
					$this->add_responsive_control(
						'back_after_margin',
						[
							'label'      => __( 'Margin', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_after_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'back_after_zindex',
						[
							'label'     => __( 'Z-Index', 'element-ready-pro' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:after' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'back_after_transition',
						[
							'label'      => __( 'Transition', 'element-ready-pro' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
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
								'{{WRAPPER}} .flip__box__back__part:after' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'back_after_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'back_after_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:after' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'back_after_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{back_after_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();

					/*----------------
						AFTER HOVER
					-------------------*/
					$this->add_control(
						'back_after_hr',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_control(
						'back_after_hover_hr',
						[
							'label'     => __( 'After Hover', 'element-ready-pro' ),
							'type'      => Controls_Manager::HEADING,
							'separator' => 'after',
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_back_after_background',
							'label'    => __( 'Background', 'element-ready-pro' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .flip__box__back__part:hover:after',
						]
					);
					$this->add_responsive_control(
						'hover_back_after_width',
						[
							'label'      => __( 'Width', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:hover:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'hover_back_after_height',
						[
							'label'      => __( 'Height', 'element-ready-pro' ),
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
								'{{WRAPPER}} .flip__box__back__part:hover:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_back_after_opacity',
						[
							'label' => __( 'Opacity', 'element-ready-pro' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .flip__box__back__part:hover:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'hover_back_after_radius',
						[
							'label'      => __( 'Border Radius', 'element-ready-pro' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .flip__box__back__part:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'back_after_hover_popover_toggle',
						[
							'label' => __( 'Transform', 'element-ready-pro' ),
							'type'  => Controls_Manager::POPOVER_TOGGLE,
						]
					);
					$this->start_popover();
						$this->add_control(
							'hover_back_after_scale',
							[
								'label'      => __( 'Scale', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:hover:after' => 'transform: scale({{SIZE}}{{UNIT}});',
								],
							]
						);
						$this->add_control(
							'hover_back_after_rotate',
							[
								'label'      => __( 'Rotate', 'element-ready-pro' ),
								'type'       => Controls_Manager::SLIDER,
								'size_units' => [ 'px' ],
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
									'{{WRAPPER}} .flip__box__back__part:hover:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{back_after_scale.SIZE || 1}});',
								],
							]
						);
					$this->end_popover();
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX BEFORE / AFTER END
		-----------------------------*/

		$this->start_controls_section(
			'section_lottie_animation',
			[
				'label' => __( 'Lottie Animation Front', 'element-ready-pro' ),
			]
        );

		$this->add_control(
			'enable_lottie',
			[
				'label' => __( 'Enable', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $this->add_control(
			'file_link',
			[
				'label' => esc_html__( 'Select json file', 'element-ready-pro' ),
				'type'	=> Custom_Controls_Manager::MEDIAFILE,
			
				
			]
        );
        $this->add_control(
			'important_note',
			[
				'label' => __( 'Use:', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( 'Go to <a href="https://lottiefiles.com/44373-girl-cycling"> Lottie Site</a> and copy json file and paste above', 'element-ready-pro' ),
				
			]
		);

        $this->add_control(
			'control',
			[
				'label' => __( 'Controls', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'loop',
			[
				'label' => __( 'Enable Loop', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'element-ready-pro' ),
				'label_off' => __( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'autoplay',
			[
				'label' => __( 'Enable Autoplay', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'element-ready-pro' ),
				'label_off' => __( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        
        $this->add_control(
            'speed',
            [
                'label' => __( 'Speed', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
			'height',
			[
				'label' => __( 'Height', 'element-ready-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1900,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				
			]
		);

        $this->add_control(
			'width',
			[
				'label' => __( 'Width', 'element-ready-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1900,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				
			]
		);


        
        $this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				
			]
		);
     
		$this->end_controls_section();
		$this->start_controls_section(
			'section_lottie_animation_back',
			[
				'label' => __( 'Lottie Animation Back', 'element-ready-pro' ),
			]
        );

		$this->add_control(
			'enable_back_lottie',
			[
				'label' => __( 'Enable', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $this->add_control(
			'file_back_link',
			[
				'label' => esc_html__( 'Select json file', 'element-ready-pro' ),
				'type'	=> Custom_Controls_Manager::MEDIAFILE,
			
				
			]
        );
        $this->add_control(
			'important_back_note',
			[
				'label' => __( 'Use:', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( 'Go to <a href="https://lottiefiles.com/44373-girl-cycling"> Lottie Site</a> and copy json file and paste above', 'element-ready-pro' ),
				
			]
		);

        $this->add_control(
			'control_back',
			[
				'label' => __( 'Controls', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'loop_back',
			[
				'label' => __( 'Enable Loop', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'element-ready-pro' ),
				'label_off' => __( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'autoplay_back',
			[
				'label' => __( 'Enable Autoplay', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'element-ready-pro' ),
				'label_off' => __( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        
        $this->add_control(
            'speed_back',
            [
                'label' => __( 'Speed', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
			'height_back',
			[
				'label' => __( 'Height', 'element-ready-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1900,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				
			]
		);

        $this->add_control(
			'width_back',
			[
				'label' => __( 'Width', 'element-ready-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1900,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				
			]
		);


        
        $this->add_control(
			'bg_color_back',
			[
				'label' => esc_html__( 'Background', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				
			]
		);
     
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['enable_lottie'] == 'yes' ){

			wp_enqueue_script('lottie-player');
			wp_enqueue_script('lottie-interactivity');

			$random_id = $this->get_id();
			$bg_color  = $settings['bg_color'];
			$width     = $settings['width'];
			$height    = $settings['height'];
			$width     = $width['size'].$width['unit'];
			$height    = $height['size'].$height['unit'];

			$this->add_render_attribute( 'lottile_attr', 'src', $settings['file_link']);
			$this->add_render_attribute( 'lottile_attr', 'background', $bg_color);
			$this->add_render_attribute( 'lottile_attr', 'speed', $settings['speed']);
			
			
			if($settings['control']=='yes'){
				$this->add_render_attribute( 'lottile_attr', 'controls', 'controls');
			}
			
			if($settings['loop']=='yes'){
				$this->add_render_attribute( 'lottile_attr', 'loop', 'loop');
			}
			
			if($settings['autoplay']=='yes'){
				$this->add_render_attribute( 'lottile_attr', 'autoplay', 'autoplay');
			}
	
			$lottie_style = 'style="height:'.esc_attr( $height ).';width:'.esc_attr( $width ).';"';

			$lottie_content =  '<lottie-player '. $this->get_render_attribute_string( 'lottile_attr' ) .$lottie_style. '>'.'</lottie-player>'; 
		}

		if( $settings['enable_back_lottie'] == 'yes' ){

			wp_enqueue_script('lottie-player');
			wp_enqueue_script('lottie-interactivity');

			$random_id = $this->get_id();
			$bg_color  = $settings['bg_color_back'];
			$width     = $settings['width_back'];
			$height    = $settings['height_back'];
			$width     = $width['size'].$width['unit'];
			$height    = $height['size'].$height['unit'];

			$this->add_render_attribute( 'lottile_attr_back', 'src', $settings['file_back_link']);
			$this->add_render_attribute( 'lottile_attr_back', 'background', $bg_color);
			$this->add_render_attribute( 'lottile_attr_back', 'speed', $settings['speed_back']);
		
			
			if($settings['control_back']=='yes'){
				$this->add_render_attribute( 'lottile_attr_back', 'controls', 'controls');
			}
			
			if($settings['loop_back']=='yes'){
				$this->add_render_attribute( 'lottile_attr_back', 'loop', 'loop');
			}
			
			if($settings['autoplay_back']=='yes'){
				$this->add_render_attribute( 'lottile_attr_back', 'autoplay', 'autoplay');
			}
	
			$lottie_style_back = 'style="height:'.esc_attr( $height ).';width:'.esc_attr( $width ).';"';

			$lottie_content_back =  '<lottie-player '. $this->get_render_attribute_string( 'lottile_attr_back' ) .$lottie_style_back. '>'.'</lottie-player>'; 
		}

		
		/*------------------------------
			BOX BACKGROUND ICON OR TEXT
		--------------------------------*/
		if ( 'yes' == $settings['show_box_bg_text_or_icon'] ) {
			if ( 'font_icon' == $settings['box_bg_icon_type'] && !empty( $settings['box_bg_font_icon'] ) ) {

				$box_iocn_or_text = '<div class="flip__bg__front__icon__text">'.element_ready_render_icons($settings['box_bg_font_icon']).'</div>';

			}elseif( 'image_icon' == $settings['box_bg_icon_type'] && !empty( $settings['box_bg_image_icon'] ) ){
				$icon_array = $settings['box_bg_image_icon'];
				$icon_link = wp_get_attachment_image_url( $icon_array['id'], 'full' );
				$box_iocn_or_text = '<div class="flip__bg__front__icon__text"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}elseif( 'simple_text' == $settings['box_bg_icon_type'] && !empty( $settings['box_bg_text'] ) ){
				$box_iocn_or_text = '<div class="flip__bg__front__icon__text">'. esc_html( $settings['box_bg_text'] ) .'</div>';
			}
		}else{
			$box_iocn_or_text = '';
		}

		/*------------------------------
			BOX FEATURES IMAGE
		--------------------------------*/
		if ( 'yes' == $settings['show_box_image'] ) {
			$box_big_img = Group_Control_Image_Size::get_attachment_image_html( $settings, 'box_image_size', 'box_image' );
			$box_image = '<div class="flip__front__big__thumb">'.$box_big_img.'</div>';
		}else{
			$box_image = '';
		}

		/*--------------------------
			Icon Animation
		---------------------------*/
		if ( $settings['icon_hover_animation'] ) {
			$icon_animation = 'elementor-animation-' . $settings['icon_hover_animation'];
		}else{
			$icon_animation = '';
		}
		/*---------------------------
			Icon Condition
		----------------------------*/
		if ( 'yes' == $settings['show_icon'] ) {
			if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {

				$icon = '<div class="flip__front__icon '. esc_attr( $icon_animation ) .'">'.element_ready_render_icons($settings['font_icon']).'</div>';

			}elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
				$icon_array = $settings['image_icon'];
				$icon_link = wp_get_attachment_image_url( $icon_array['id'], 'full' );
				$icon = '<div class="flip__front__icon '. esc_attr( $icon_animation ) .'"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}
		}else{
			$icon = '';
		}

		/*-------------------------
			Title Link Attr
		--------------------------*/
		if ( ! empty( $settings['title_link']['url'] ) ) {
			$this->add_render_attribute( 'title_link', 'href', $settings['title_link']['url'] );

			if ( $settings['title_link']['is_external'] ) {
				$this->add_render_attribute( 'title_link', 'target', '_blank' );
			}

			if ( $settings['title_link']['nofollow'] ) {
				$this->add_render_attribute( 'title_link', 'rel', 'nofollow' );
			}
		}

		/*---------------------------
			Title Tag
		-----------------------------*/
		if ( !empty( $settings['title_tag'] ) ) {
			$title_tag = $settings['title_tag'];
		}else{
			$title_tag = 'h3';
		}

		/*---------------------------
			Title
		----------------------------*/
		if ( !empty( $settings['title'] ) ) {
			if ( !empty( $settings['title_link'] ) && !empty( $this->get_render_attribute_string( 'title_link' ) ) ) {
				$title = '<'.$title_tag.' class="flip__front__title"><a '.$this->get_render_attribute_string( 'title_link' ).'>'.esc_html( $settings['title'] ).'</a></'.$title_tag.'>';
			}else{
				$title = '<'.$title_tag.' class="flip__front__title">'.esc_html( $settings['title'] ).'</'.$title_tag.'>';
			}
		}else{
			$title = '';
		}

		/*----------------------------
			Subtitle
		-----------------------------*/
		if ( !empty( $settings['subtitle'] ) ) {
			$subtitle = '<div class="flip__front__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
		}else{
			$subtitle = '';
		}

		/*----------------------------
			TITLE CONDITION
		------------------------------*/
		if ( !empty($settings['subtitle_position']) ) {
			if ( 'before_title' == $settings['subtitle_position'] ) {
				$title_subtitle = $subtitle . $title;
			}elseif( 'after_title' == $settings['subtitle_position'] ){
				$title_subtitle = $title . $subtitle;
			}elseif( empty($settings['subtitle']) ){
				$title_subtitle = $title . $subtitle;
			}
		}else{
			$title_subtitle = $title . $subtitle;
		}

		/*----------------------------
			Description
		-----------------------------*/
		if ( !empty( $settings['description'] ) ) {
			$description = '<div class="box__description">'.wpautop( $settings['description'] ).'</div>';
		}else{
			$description = '';
		}

		/*--------------------------
			Button Link Attr
		---------------------------*/
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'more_button', 'href', $settings['button_link']['url'] );

			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'more_button', 'target', '_blank' );
			}

			if ( $settings['button_link']['nofollow'] ) {
				$this->add_render_attribute( 'more_button', 'rel', 'nofollow' );
			}
		}

		/*-------------------------
			Button animation
		---------------------------*/
		if ( $settings['button_hover_animation'] ) {
			$button_animation = 'elementor-animation-' . $settings['button_hover_animation'];
		}else{
			$button_animation = '';
		}

		/*----------------------------
			BUTTON
		-----------------------------*/
		if ( 'yes' == $settings['show_button'] && ( !empty($settings['button_text'] ) && !empty($settings['button_link'] ) ) ) {
			$button = '<a class="flip__front__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'more_button' ).'>'. esc_html( $settings['button_text'] ) .'</a>';
		}else{
			$button = '';
		}

		/*-----------------------------
			BUTTON WITH ICON
		------------------------------*/
		if ( !empty(  $settings['button_icon'] ) ) {
			if (  'left' == $settings['button_icon_align'] ) {
				$button = '<a class="flip__front__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'more_button' ).'><i class="flip__front__button_icon_left '.esc_attr($settings['button_icon']).'"></i>'. esc_html( $settings['button_text'] ) .'</a>';
			}elseif( 'right' == $settings['button_icon_align'] ){
				$button = '<a class="flip__front__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'more_button' ).'>'. esc_html( $settings['button_text'] ) .'<i class="flip__front__button_icon_right '.esc_attr($settings['button_icon']).'"></i></a>';
			}
		}

		/*--------------------------------
			BOX BACK PART
		---------------------------------*/

		/*------------------------------
			BOX BACKGROUND ICON OR TEXT
		--------------------------------*/
		if ( 'yes' == $settings['back_show_box_bg_text_or_icon'] ) {
			if ( 'font_icon' == $settings['back_box_bg_icon_type'] && !empty( $settings['back_box_bg_font_icon'] ) ) {

				$back_box_iocn_or_text = '<div class="flip__bg__back__icon__text">'.element_ready_render_icons($settings['back_box_bg_font_icon']).'</div>';

			}elseif( 'image_icon' == $settings['back_box_bg_icon_type'] && !empty( $settings['back_box_bg_image_icon'] ) ){
				$icon_array = $settings['back_box_bg_image_icon'];
				$icon_link = wp_get_attachment_image_url( $icon_array['id'], 'full' );
				$back_box_iocn_or_text = '<div class="flip__bg__back__icon__text"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}elseif( 'simple_text' == $settings['back_box_bg_icon_type'] && !empty( $settings['back_box_bg_text'] ) ){
				$back_box_iocn_or_text = '<div class="flip__bg__back__icon__text">'. esc_html( $settings['back_box_bg_text'] ) .'</div>';
			}
		}else{
			$back_box_iocn_or_text = '';
		}

		/*------------------------------
			BOX FEATURES IMAGE
		--------------------------------*/
		if ( 'yes' == $settings['back_show_box_image'] ) {
			$back_box_big_img = Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_box_image_size', 'back_box_image' );
			$back_box_image = '<div class="flip__back__big__thumb">'.$back_box_big_img.'</div>';
		}else{
			$back_box_image = '';
		}

		/*--------------------------
			Icon Animation
		---------------------------*/
		if ( $settings['icon_hover_animation'] ) {
			$icon_animation = 'elementor-animation-' . $settings['icon_hover_animation'];
		}else{
			$icon_animation = '';
		}

		/*---------------------------
			Icon Condition
		----------------------------*/
		if ( 'yes' == $settings['back_show_icon'] ) {
			if ( 'font_icon' == $settings['back_icon_type'] && !empty( $settings['back_font_icon'] ) ) {

				$back_icon = '<div class="flip__back__icon '. esc_attr( $icon_animation ) .'">'.element_ready_render_icons($settings['back_font_icon']).'</div>';

			}elseif( 'image_icon' == $settings['back_icon_type'] && !empty( $settings['back_image_icon'] ) ){
				$icon_array = $settings['back_image_icon'];
				$icon_link = wp_get_attachment_image_url( $icon_array['id'], 'full' );
				$back_icon = '<div class="flip__back__icon '. esc_attr( $icon_animation ) .'"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}
		}else{
			$back_icon = '';
		}

		/*-------------------------
			Title Link Attr
		--------------------------*/
		if ( ! empty( $settings['back_title_link']['url'] ) ) {
			$this->add_render_attribute( 'back_title_link', 'href', $settings['back_title_link']['url'] );

			if ( $settings['back_title_link']['is_external'] ) {
				$this->add_render_attribute( 'back_title_link', 'target', '_blank' );
			}

			if ( $settings['back_title_link']['nofollow'] ) {
				$this->add_render_attribute( 'back_title_link', 'rel', 'nofollow' );
			}
		}

		/*---------------------------
			Title Tag
		-----------------------------*/
		if ( !empty( $settings['back_title_tag'] ) ) {
			$back_title_tag = $settings['back_title_tag'];
		}else{
			$back_title_tag = 'h3';
		}

		/*---------------------------
			Title
		----------------------------*/
		if ( !empty( $settings['back_title'] ) ) {
			if ( !empty( $settings['back_title_link'] ) && !empty( $this->get_render_attribute_string( 'back_title_link' ) ) ) {
				$back_title = '<'.$back_title_tag.' class="flip__back__title"><a '.$this->get_render_attribute_string( 'back_title_link' ).'>'.esc_html( $settings['title'] ).'</a></'.$back_title_tag.'>';
			}else{
				$back_title = '<'.$back_title_tag.' class="flip__back__title">'.esc_html( $settings['back_title'] ).'</'.$back_title_tag.'>';
			}
		}else{
			$back_title = '';
		}

		/*----------------------------
			Subtitle
		-----------------------------*/
		if ( !empty( $settings['back_subtitle'] ) ) {
			$back_subtitle = '<div class="flip__back__subtitle">'.esc_html( $settings['back_subtitle'] ).'</div>';
		}else{
			$back_subtitle = '';
		}

		/*----------------------------
			TITLE CONDITION
		------------------------------*/
		if ( !empty($settings['back_subtitle_position']) ) {
			if ( 'before_title' == $settings['back_subtitle_position'] ) {
				$back_title_subtitle = $back_subtitle . $back_title;
			}elseif( 'after_title' == $settings['back_subtitle_position'] ){
				$back_title_subtitle = $back_title . $back_subtitle;
			}elseif( empty($settings['subtitle']) ){
				$back_title_subtitle = $back_title . $back_subtitle;
			}
		}else{
			$back_title_subtitle = $back_title . $back_subtitle;
		}

		/*----------------------------
			Description
		-----------------------------*/
		if ( !empty( $settings['back_description'] ) ) {
			$back_description = '<div class="box__description">'.wpautop( $settings['back_description'] ).'</div>';
		}else{
			$back_description = '';
		}
		
		/*--------------------------
			Button Link Attr
		---------------------------*/
		if ( ! empty( $settings['back_button_link']['url'] ) ) {
			$this->add_render_attribute( 'back_button_link', 'href', $settings['back_button_link']['url'] );

			if ( $settings['back_button_link']['is_external'] ) {
				$this->add_render_attribute( 'back_button_link', 'target', '_blank' );
			}

			if ( $settings['back_button_link']['nofollow'] ) {
				$this->add_render_attribute( 'back_button_link', 'rel', 'nofollow' );
			}
		}
		
		/*-------------------------
			Button animation
		---------------------------*/
		if ( $settings['button_hover_animation'] ) {
			$button_animation = 'elementor-animation-' . $settings['button_hover_animation'];
		}else{
			$button_animation = '';
		}

		/*----------------------------
			BUTTON
		-----------------------------*/
		if ( 'yes' == $settings['back_show_button'] && ( !empty($settings['back_button_text'] ) && !empty($settings['back_button_link'] ) ) ) {
			$back_button = '<a class="flip__back__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'back_button_link' ).'>'. esc_html( $settings['back_button_text'] ) .'</a>';
		}else{
			$back_button = '';
		}

		/*-----------------------------
			BUTTON WITH ICON
		------------------------------*/
		if ( !empty(  $settings['back_button_icon'] ) ) {
			if (  'left' == $settings['back_button_icon_align'] ) {
				$button = '<a class="flip__back__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'back_button_link' ).'><i class="flip__back__button_icon_left '.esc_attr($settings['back_button_icon']).'"></i>'. esc_html( $settings['back_button_text'] ) .'</a>';
			}elseif( 'right' == $settings['back_button_icon_align'] ){
				$button = '<a class="flip__back__button '. esc_attr( $button_animation ) .'" '.$this->get_render_attribute_string( 'back_button_link' ).'>'. esc_html( $settings['back_button_text'] ) .'<i class="flip__back__button_icon_right '.esc_attr($settings['back_button_icon']).'"></i></a>';
			}
		}

		$actve_id            = $this->get_id();
		$flip_layout_options = array(
			'actve_id'        => $actve_id,
			'flip_axis'       => $settings['flip_axis'],
			'flip_trigger'    => $settings['flip_trigger'],
			'flip_reverse'    => ( 'yes' === $settings['flip_reverse'] ),
			'flip_transition' => $settings['flip_transition']['size'],
		);
		$this->add_render_attribute( 'flip_box_parent_wrap_attr', 'class', 'element__ready__flipbox__activation' );
		$this->add_render_attribute( 'flip_box_parent_wrap_attr', 'data-options', json_encode( $flip_layout_options ) );
		$this->add_render_attribute( 'flip_box_parent_wrap_attr', 'id', 'element__ready__flipbox__activation__'.$actve_id );

		$this->add_render_attribute( 'flip_box_main_wrap_attr', 'class', 'flip__box__main__wrap' );
		$this->add_render_attribute( 'flip_box_main_wrap_attr', 'class', $settings['box_layout_style'] );
		
		/*if ( '_layout__custom' != $settings['box_layout_style'] ) {
			$this->add_render_attribute( 'flip_box_front_part_attr', 'class', $settings['box_layout_style'] );
			$this->add_render_attribute( 'flip_box_front_part_attr', 'class', $settings['content_placement_align'] );
		}*/
		
		$before_image = $after_image = '';
		if ( 'before' == $settings['box_image_postion'] ) {
			$before_image = $box_image;
		}elseif ( 'after' == $settings['box_image_postion'] ) {
			$after_image = $box_image;
		}
		
		$bback_efore_image = $back_after_image = '';
		if ( 'before' == $settings['back_box_image_postion'] ) {
			$back_before_image = $back_box_image;
		}elseif ( 'after' == $settings['back_box_image_postion'] ) {
			$back_after_image = $back_box_image;
		}
		

		if( 'yes' == $settings['show_box_image'] ){
			$this->add_render_attribute( 'flip_box_front_part_wrap_attr', 'class', 'flip__box__front__part' );
		}else{
			$this->add_render_attribute( 'flip_box_front_part_attr', 'class', 'flip__box__front__part' );
		}

		$image_wrap_start_tag = $image_wrap_end_tag = '';
		if( 'yes' == $settings['show_box_image'] ){
			$image_wrap_start_tag = '<div '.$this->get_render_attribute_string('flip_box_front_part_wrap_attr').'>';;
			$image_wrap_end_tag   = '</div>';
		}


		if( 'yes' == $settings['back_show_box_image'] ){
			$this->add_render_attribute( 'flip_box_back_part_wrap_attr', 'class', 'flip__box__back__part' );
		}else{
			$this->add_render_attribute( 'flip_box_back_part_attr', 'class', 'flip__box__back__part' );
		}
		
		$back_image_wrap_start_tag = $back_image_wrap_end_tag = '';
		if( 'yes' == $settings['back_show_box_image'] ){
			$back_image_wrap_start_tag = '<div '.$this->get_render_attribute_string('flip_box_back_part_wrap_attr').'>';
			$back_image_wrap_end_tag   = '</div>';
		}

		echo'
			<div '.$this->get_render_attribute_string('flip_box_parent_wrap_attr').'>
				<div '.$this->get_render_attribute_string('flip_box_main_wrap_attr').'>

					'.( isset( $image_wrap_start_tag ) ? $image_wrap_start_tag : '' ).'
						'.( isset( $before_image ) ? $before_image : '' ).'
						<div '.$this->get_render_attribute_string('flip_box_front_part_attr').'>
							'.( isset( $box_iocn_or_text ) ? $box_iocn_or_text : '' ).'
							'.( isset( $lottie_content ) ? $lottie_content : '' ).'
							'.( isset( $icon ) ? $icon : '' ).'
							'.( isset( $title_subtitle ) ? $title_subtitle : '' ).'
							'.( isset( $description ) ? $description : '' ).'
							'.( isset( $button ) ? $button : '' ).'
						</div>
						'.( isset( $after_image ) ? $after_image : '' ).'
					'.( isset( $image_wrap_end_tag ) ? $image_wrap_end_tag : '' ).'

					'.( isset( $back_image_wrap_start_tag ) ? $back_image_wrap_start_tag : '' ).'
						'.( isset( $back_before_image ) ? $back_before_image : '' ).'
						<div '.$this->get_render_attribute_string('flip_box_back_part_attr').'>
							'.( isset( $back_box_iocn_or_text ) ? $back_box_iocn_or_text : '' ).'
							'.( isset( $lottie_content_back ) ? $lottie_content_back : '' ).'
							'.( isset( $back_icon ) ? $back_icon : '' ).'
							'.( isset( $back_title_subtitle ) ? $back_title_subtitle : '' ).'
							'.( isset( $back_description ) ? $back_description : '' ).'
							'.( isset( $back_button ) ? $back_button : '' ).'
						</div>
						'.( isset( $back_after_image ) ? $back_after_image : '' ).'
					'.( isset( $back_image_wrap_end_tag ) ? $back_image_wrap_end_tag : '' ).'

				</div>
			</div>
		';
	}
	protected function content_template() {}
}