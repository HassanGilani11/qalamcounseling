<?php
namespace Element_Ready_Pro\Widgets\countdown;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor counter widget.
 *
 * Elementor widget that displays stats and numbers in an escalating manner.
 *
 * @since 1.0.0
 */
class Element_Ready_Countdown_Circle_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Element_Ready_Countdown_Circle_Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'ER Circle Countdown', 'element-ready-pro' );
	}
    
        
	public function get_categories() {
		return [ 'element-ready-pro' ];
	}

    public function get_keywords() {
        return [ 'count down', 'comming soon' ];
    }

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 
			'TimeCircle',
			'element-ready-core'
		];
	}
	public function get_style_depends() {
		
		return[
			'TimeCircle',
		];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => __( 'Counter', 'element-ready-pro' ),
			]
		);

		$this->add_control(
			'countdown_date',
			[
				'label' => __( 'Target Date', 'element-ready-pro' ),
				'type' => Controls_Manager::DATE_TIME,
			]
		);

		$this->add_control(
			'circle_days_show',
			[
				'label'        => __( 'Show Days', 'element-ready-pro' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'element-ready-pro' ),
				'label_off'    => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'circle_days_title',
			[
				'label'   => __( 'Days', 'element-ready-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('days','element-ready-pro'),
				'condition' => [
					'circle_days_show' => ['yes'],
				],
			]
		);

		$this->add_control(
			'circle_hours_show',
			[
				'label' => __( 'Show hours', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'circle_hours_title',
			[
				'label'   => __( 'Hours', 'element-ready-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('hours','element-ready-pro'),
				'condition' => [
					'circle_hours_show' => ['yes'],
				],
			]
		);

		$this->add_control(
			'circle_mins_show',
			[
				'label' => __( 'Show Minutes', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'circle_mins_title',
			[
				'label'   => __( 'Minutes', 'element-ready-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('Minutes','element-ready-pro'),
				'condition' => [
					'circle_mins_show' => ['yes'],
				],
			]
		);

		$this->add_control(
			'circle_sec_show',
			[
				'label' => __( 'Show Seconds', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'element-ready-pro' ),
				'label_off' => __( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'circle_sec_title',
			[
				'label'   => __( 'Seconds', 'element-ready-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('Seconds','element-ready-pro'),
				'condition' => [
					'circle_mins_show' => ['yes'],
				]
			]
		);

		$this->add_control(
			'countdown_animation',
			[
				'label'     => __( 'Animation', 'element-ready-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options' => [
					'smooth' => __('Smooth','element-ready-pro'),
					'ticks'  => __('Ticks','element-ready-pro'),
				],
				'default' => 'smooth',
			]
		);

		$this->add_control(
			'start_angle',
			[
				'label'      => __( 'Start Angle', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				]
			]
		);

		$this->add_control(
			'circle_bg_color',
			[
				'label'   => __( 'Circle Bg Color', 'element-ready-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#f3f3f3',
			]
		);
        
		$this->add_control(
			'counter_width',
			[
				'label'      => __( 'Circle Width', 'element-ready-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0.01,
						'max'  => 0.15,
						'step' => 0.01,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.05,
				]
			]
		);

		$this->add_control(
			'bg_width',
			[
				'label'      => __( 'Background Width', 'element-ready-pro' ),
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
					'size' => 1,
				]
			]
		);

		$this->add_control(
			'days_circle_color',
			[
				'label'   => __( 'Days Circle Color', 'element-ready-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ef296c',
				'condition' => [
					'circle_days_show' => ['yes'],
				],
			]
		);

		$this->add_control(
			'hours_circle_color',
			[
				'label'   => __( 'Hours Circle Color', 'element-ready-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#18bfc3',
				'condition' => [
					'circle_hours_show' => ['yes'],
				]
			]
		);

		$this->add_control(
			'minutes_circle_color',
			[
				'label'   => __( 'Minutes Circle Color', 'element-ready-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffd200',
				'condition' => [
					'circle_mins_show' => ['yes'],
				]
			]
		);

		$this->add_control(
			'seconds_circle_color',
			[
				'label'   => __( 'Seconds Circle Color', 'element-ready-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#182eff',
				'condition' => [
					'circle_sec_show' => ['yes'],
				]
			]
		);

		$this->end_controls_section();
        
		$this->start_controls_section(
			'section_number',
			[
				'label' => __( 'Number', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'  => __( 'Color', 'element-ready-pro' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .time_circles > div > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'typography_number',
				'selector' => '{{WRAPPER}} .time_circles > div > span',
			]
		);

        $this->add_responsive_control(
            'number_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .time_circles > div > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'  => __( 'Color', 'element-ready-pro' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .time_circles > div > h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'typography_title',
				'selector' => '{{WRAPPER}} .time_circles > div > h4',
			]
		);
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .time_circles > div > h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
		$this->end_controls_section();
	}

	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'countdown_circle_wrap', [
			'class' => 'element__ready__circle__countdown',
		] );

		$random_id = rand(5655,5874);
		$date_time = '2022-01-30 00:08:00';
		if ( !empty( $settings['countdown_date'] ) ) {
			$date_time = $settings['countdown_date'].':00';   
		}
		
		if ( !empty( $settings['start_angle']['size'] ) ) {
			$start_angle = $settings['start_angle']['size'];
		}else{
			$start_angle = 0;
		}

		if ( !empty( $settings['circle_bg_color'] ) ) {
			$circle_bg_color = $settings['circle_bg_color'];
		}else{
			$circle_bg_color = '#f3f3f3';
		}

		if ( !empty( $settings['days_circle_color'] ) ) {
			$days_circle_color = $settings['days_circle_color'];
		}else{
			$days_circle_color = '#ef296c';
		}

		if ( !empty( $settings['hours_circle_color'] ) ) {
			$hours_circle_color = $settings['hours_circle_color'];
		}else{
			$hours_circle_color = '#18bfc3';
		}

		if ( !empty( $settings['minutes_circle_color'] ) ) {
			$minutes_circle_color = $settings['minutes_circle_color'];
		}else{
			$minutes_circle_color = '#ffd200';
		}

		if ( !empty( $settings['seconds_circle_color'] ) ) {
			$seconds_circle_color = $settings['seconds_circle_color'];
		}else{
			$seconds_circle_color = '#182eff';
		}
        
        if( !empty( $settings['bg_width']['size'] ) ){
            $bg_width = $settings['bg_width']['size'];
        }else{
            $bg_width = 1;
        }
        
        if( !empty( $settings['counter_width']['size'] ) ){
            $counter_width = $settings['counter_width']['size'];
        }else{
            $counter_width = 0.05;
        }
        
        if( !empty( $start_angle ) ){
            $start_angle = $start_angle;
        }else{
            $start_angle = 0;
        }

        $counter_options = [
			'random_id'            => $random_id,
			'animation'            => $settings['countdown_animation'],
			'start_angle'          => $start_angle,
			'circle_bg_color'      => $circle_bg_color,
			'counter_width'        => $counter_width,
			'bg_width'             => $bg_width,
			'days_circle_color'    => $days_circle_color,
			'hours_circle_color'   => $hours_circle_color,
			'minutes_circle_color' => $minutes_circle_color,
			'seconds_circle_color' => $seconds_circle_color,
			'circle_days_title'    => str_replace( ' ','-', $settings['circle_days_title'] ),
			'circle_days_show'     => $settings['circle_days_show'],
			'circle_hours_title'   => str_replace( ' ','-', $settings['circle_hours_title'] ),
			'circle_hours_show'     => $settings['circle_hours_show'],
			'circle_mins_title'    => str_replace( ' ','-', $settings['circle_mins_title']),
			'circle_mins_show'     => $settings['circle_mins_show'],
			'circle_sec_title'     => str_replace( ' ','-', $settings['circle_sec_title']),
			'circle_sec_show'      => $settings['circle_sec_show'],
        ];

        $this->add_render_attribute( 'countdown_circle_wrap', 'data-settings', wp_json_encode( $counter_options ) );
		?>

		<div <?php echo $this->get_render_attribute_string( 'countdown_circle_wrap' ); ?>>
			<div id="element__ready__circle__countdown__<?php echo esc_attr( $random_id ); ?>"  data-date="<?php echo esc_attr( $date_time ); ?>"></div>
		</div>
	<?php 
	} 
}