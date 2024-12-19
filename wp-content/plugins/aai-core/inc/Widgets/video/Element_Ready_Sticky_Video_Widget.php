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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Element_Ready_Sticky_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'Element_Ready_Sticky_Video_Widget';
	}

	public function get_title() {
		return __( 'ER Sticky Video', 'element-ready-pro' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return array('element-ready-pro');
	}

    public function get_keywords() {
        return [ 'Video', 'Popup', 'Modal', 'Sticky Video', 'play', 'player', 'sticky' ];
    }

	public function get_script_depends() {
		return[
			'sticky_video',
			'element-ready-core',
		];
	}

	public function get_style_depends() {
		return[
			'sticky_video'
		];
	}

	public static function content_layout_style(){
		return [
			'stiky__postion__left'   => 'Button Style 1',
			'stiky__postion__right'  => 'Button Style 2',
			'stiky__postion__custom' => 'Custom Style',
		];
	}

	protected function register_controls() {

		/******************************
		 * 	CONTENT SECTION
		 ******************************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'content_layout_style',
				[
					'label'   => __( 'Sticky Position', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'stiky__postion__right',
					'options' => self::content_layout_style(),
					'condition' => [
						'example' => 'yes',
					],
				]
			);
			$this->add_control(
				'get_video_from',
				[
					'label'   => __( 'Get Video From', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'youtube',
					'options' => [
						'youtube'      => __('YouTube', 'element-ready-pro'),
						'vimeo'      => __('Vimeo', 'element-ready-pro'),
					]
				]
			);
			$this->add_control(
				'youtube_video_url',
				[
					'label'         => __( 'Youtube Video Link', 'element-ready-pro' ),
					'type'          => Controls_Manager::TEXT,
					'show_external' => true,
					'default'       => 'https://www.youtube.com/watch?v=SSqgaFE9igo',
					'condition' => [
						'get_video_from' => 'youtube',
					],
				]
			);

			$this->add_control(
				'vimeo_video_url',
				[
					'label'         => __( 'Vimeo Video Link', 'element-ready-pro' ),
					'type'          => Controls_Manager::TEXT,
					'show_external' => true,
					'default'       => 'https://vimeo.com/183536539',
					'condition' => [
						'get_video_from' => 'vimeo',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_container_style_section',
			[
				'label' => __( 'Normal Video Container', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'video__width',
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
						'{{WRAPPER}} .sticky-container__video' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'video_max_width',
				[
					'label'      => __( 'Max Width', 'element-ready-pro' ),
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
						'{{WRAPPER}} .sticky-container__video' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_sticky_container_style_section',
			[
				'label' => __( 'Sticky Container', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'video_sticky_width',
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
						'{{WRAPPER}} .sticky-container_sticky .sticky-container__video' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'video_sticky_max_width',
				[
					'label'      => __( 'Max Width', 'element-ready-pro' ),
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
						'{{WRAPPER}} .sticky-container_sticky .sticky-container__video' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'video_sticky_position_style_section',
			[
				'label' => __( 'Sticky Position', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'video_sticky_pos_left',
				[
					'label'      => __( 'Left', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 2000,
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
						'{{WRAPPER}} .sticky-container_sticky .sticky-container__video' => 'left: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'video_sticky_pos_right',
				[
					'label'      => __( 'Right', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 2000,
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
						'{{WRAPPER}} .sticky-container_sticky .sticky-container__video' => 'right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'video_sticky_pos_bottom',
				[
					'label'      => __( 'Bottom', 'element-ready-pro' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 2000,
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
						'{{WRAPPER}} .sticky-container_sticky .sticky-container__video' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}
	
	protected function render() {

		$settings   = $this->get_settings_for_display();
		$random_id  = $this->get_id();
		$oembed_url = '';
		
       
		

		
		if ( 'youtube' == $settings['get_video_from'] ) {
			$oembed_url = $settings['youtube_video_url'];
		}elseif ( 'vimeo' == $settings['get_video_from'] ) {
			$oembed_url = $settings['vimeo_video_url'];
		}

		$this->add_render_attribute( 'sticky_video_attr', 'class', 'sticky__video__wrap');
		$this->add_render_attribute( 'sticky_video_attr', 'id', 'sticky__video__wrap__'.$random_id );

		?>
			<div <?php echo $this->get_render_attribute_string( 'sticky_video_attr' ); ?>>
				<?php 
					if( $oembed_url ){
						
						echo wp_oembed_get( $oembed_url);
						
					}
				?>
			</div>
		<?php
	}
}