<?php
namespace Element_Ready_Pro\Widgets\maps;

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

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Element_Ready_Maps_Widget extends Widget_Base {

	public function get_name() {
		return 'Element_Ready_Maps_Widget';
	}

	public function get_title() {
		return __( 'ER Maps', 'element-ready-pro' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'element-ready-pro' ];
	}

	public function get_keywords() {
		return [ 'mapbox', 'map', 'location', 'road map' ];
	}

    public function get_script_depends() {

        return [
            'mapbox-map',
            'element-ready-map',
        ];
    }
    
    public function get_style_depends() {
		
        return[
            'mapbox-map',
        ];
	}
	
	public static function content_layout_style(){
		return [
			'mapbox://styles/mapbox/streets-v11'                  => esc_html__( 'Map Style 1', 'element-ready-pro'),
			'mapbox://styles/mapbox/outdoors-v11'                 => esc_html__( 'Map Style 2', 'element-ready-pro'),
			'mapbox://styles/mapbox/light-v10'                    => esc_html__( 'Map Style 3', 'element-ready-pro'),
			'mapbox://styles/mapbox/dark-v10'                     => esc_html__( 'Map Style 4', 'element-ready-pro'),
			'mapbox://styles/mapbox/satellite-v9'                 => esc_html__( 'Map Style 5', 'element-ready-pro'),
			'mapbox://styles/mapbox/satellite-streets-v11'        => esc_html__( 'Map Style 6', 'element-ready-pro'),
			'mapbox://styles/mapbox/navigation-preview-day-v4'    => esc_html__( 'Map Style 7', 'element-ready-pro'),
			'mapbox://styles/mapbox/navigation-preview-night-v4'  => esc_html__( 'Map Style 8', 'element-ready-pro'),
			'mapbox://styles/mapbox/navigation-guidance-day-v4'   => esc_html__( 'Map Style 9', 'element-ready-pro'),
			'mapbox://styles/mapbox/navigation-guidance-night-v4' => esc_html__( 'Map Style 10', 'element-ready-pro'),
			'custom__style'                                       => esc_html__( 'Custom Style', 'element-ready-pro'),
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_map',
			[
				'label' => __( 'Map', 'element-ready-pro' ),
			]
		);

			$this->add_control(
				'content_layout_style',
				[
					'label'   => __( 'Mapbox Style', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'mapbox://styles/mapbox/streets-v11',
					'options' => self::content_layout_style(),
				]
			);
			
			$make_access_token_style  = '<a href="https://studio.mapbox.com/" target="_blank">Here</a>';
			$default_custom_style     = __( 'mapbox://styles/mehedidb/ckj2d4sqd2r8t19o4n23um890', 'element-ready-pro' );
			$description_custom_style = sprintf( __( 'Go Mapbox account %s and copy your custom style and paste here.', 'element-ready-pro' ), $make_access_token_style );
			$this->add_control(
				'mapbox_custom_style',
				[
					'label'       => __( 'Custom Style', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXTAREA,
					'placeholder' => $default_custom_style,
					'default'     => $default_custom_style,
					'condition'   => [
						'content_layout_style' => 'custom__style',
					],
					'separator'   => 'before',
					'description' => $description_custom_style,
				]
			);

			$default_access_token     = __( 'pk.eyJ1IjoibWVoZWRpZGIiLCJhIjoiY2tqMmQzbHE2MGVvMzJzcGtzMXNmeG8yZiJ9.zZd3XDwI30BdPTWiJiqiAg', 'element-ready-pro' );
			$description_access_token = sprintf( __( 'Go Mapbox account %s and copy your access token and paste here.', 'element-ready-pro' ), $make_access_token_style );
			$this->add_control(
				'mapbox_access_token',
				[
					'label'       => __( 'Access Token', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXTAREA,
					'placeholder' => $default_access_token,
					'default'     => $default_access_token,
					'label_block' => true,
					'separator'   => 'before',
					'description' => $description_access_token,
				]
			);

			$find_address         = 'https://developer.mapquest.com/documentation/tools/latitude-longitude-finder/';
			$default_latitude     = __( '23.792661', 'element-ready-pro' );
			$description_latitude = sprintf(__( 'Please set the latitude for showing your exact location in map, find your latitude and longitude %s', 'element-ready-pro' ), '<a href="'.$find_address.'" target="_blank">'.__( 'Here', 'element-ready-pro' ).'</a>' );
			$this->add_control(
				'mapbox_latitude',
				[
					'label'       => __( 'Latitude', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => $default_latitude,
					'default'     => $default_latitude,
					'label_block' => true,
					'separator'   => 'before',
					'description' => $description_latitude,
				]
			);

			$default_longitude     = __( '90.40577', 'element-ready-pro' );
			$description_longitude = sprintf(__( 'Please set the longitude for showing your exact location in map, find your latitude and longitude %s', 'element-ready-pro' ), '<a href="'.$find_address.'" target="_blank">'.__( 'Here', 'element-ready-pro' ).'</a>' );
			$this->add_control(
				'mapbox_longitude',
				[
					'label'       => __( 'Longitude', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => $default_longitude,
					'default'     => $default_longitude,
					'label_block' => true,
					'description' => $description_longitude,
				]
			);
			$this->add_control(
				'zoom',
				[
					'label' => __( 'Zoom', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 24,
						],
					],
					'default' => [
						'size' => 13,
					],
					'separator'   => 'before',
					'description' => esc_html__( 'The starting zoom level of the map (0-24).', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'minZoom',
				[
					'label' => __( 'minZoom', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 24,
						],
					],
					'default' => [
						'size' => 5,
					],
					'separator'   => 'before',
					'description' => esc_html__( 'The minimum zoom level of the map (0-24).', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'maxZoom',
				[
					'label' => __( 'maxZoom', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 24,
						],
					],
					'default' => [
						'size' => 10,
					],
					'separator'   => 'before',
					'description' => esc_html__( 'The maximum zoom level of the map (0-24).', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'scrollZoom',
				[
					'label'        => __( 'Zoom In Scrolling', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Enable', 'element-ready-pro' ),
					'label_off'    => __( 'Disable', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
					'description'  => esc_html__( 'You can enable or disable by selecting the option, if you are select enable then zoom will be disable with mouse scrolling.', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'hash',
				[
					'label'        => __( 'Hash', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Enable', 'element-ready-pro' ),
					'label_off'    => __( 'Disable', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'separator'    => 'before',
					'description'  => esc_html__( 'If trhe the map\'s position (zoom, center latitude, center longitude, bearing, and pitch will be synced with the hash fragment of the page\'s URL.', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'interactive',
				[
					'label'        => __( 'Interactive', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Enable', 'element-ready-pro' ),
					'label_off'    => __( 'Disable', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
					'description'  => esc_html__( 'If false , no mouse, touch, or keyboard listeners will be attached to the map, so it will not respond to interaction.', 'element-ready-pro'),
				]
			);

			$this->add_control(
				'marker',
				[
					'label'        => __( 'Enable Marker ?', 'element-ready-pro' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Enable', 'element-ready-pro' ),
					'label_off'    => __( 'Disable', 'element-ready-pro' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'separator'    => 'before',
					'description'  => esc_html__( 'If you want to show marker select enable for show.', 'element-ready-pro'),
				]
			);
			$this->add_control(
				'marker_type',
				[
					'label'   => __( 'Marker Type', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'marker',
					'options' => [
						'marker'            => esc_html__( 'Marker Only', 'element-ready-pro'),
						'popup'             => esc_html__( 'Popup Only', 'element-ready-pro'),
						'marker_with_popup' => esc_html__( 'Marker With Popup', 'element-ready-pro'),
					],
					'condition'   => [
						'marker' => 'yes',
					],
					'separator' => 'before',
				]
			);
            $this->add_control(
                'marker_color',
                [
                    'label'       => __( 'Marker Color', 'element-ready-pro' ),
                    'type'        => Controls_Manager::COLOR,
                    'description' => esc_html__( 'Set the marker pointer color.', 'element-ready-pro'),
                    'condition'   => [
						'marker'      => 'yes',
						'marker_type' => [ 'marker', 'marker_with_popup' ],
					],
					'separator' => 'before',
                ]
            );
			$this->add_control(
				'marker_scale',
				[
					'label' => __( 'Marker Scale', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'default' => [
						'size' => 1,
					],
					'separator'   => 'before',
					'description' => esc_html__( 'The maximum marker scale is 5.', 'element-ready-pro'),
					'condition'   => [
						'marker'      => 'yes',
						'marker_type' => [ 'marker', 'marker_with_popup' ],
					],
				]
			);
			$this->add_control(
				'marker_position',
				[
					'label'   => __( 'Popup Position', 'element-ready-pro' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'center',
					'options' => [
						'center'       => esc_html__( 'center', 'element-ready-pro'),
						'top'          => esc_html__( 'top', 'element-ready-pro'),
						'bottom'       => esc_html__( 'bottom', 'element-ready-pro'),
						'left'         => esc_html__( 'left', 'element-ready-pro'),
						'right'        => esc_html__( 'right', 'element-ready-pro'),
						'top-left'     => esc_html__( 'top-left', 'element-ready-pro'),
						'top-right'    => esc_html__( 'top-right', 'element-ready-pro'),
						'bottom-left'  => esc_html__( 'bottom-left', 'element-ready-pro'),
						'bottom-right' => esc_html__( 'bottom-right', 'element-ready-pro'),
					],
					'condition'   => [
						'marker'      => 'yes',
						'marker_type' => [ 'popup', 'marker_with_popup' ],
					],
					'separator' => 'before',
				]
			);
			$this->add_control(
				'popup_title',
				[
					'label'       => esc_html__( 'Popup Title', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Write Popup Title Here.', 'element-ready-pro' ),
					'separator'   => 'before',
					'default'     => esc_html__( 'QuomodoSoft LTD.', 'element-ready-pro'),
					'condition'   => [
						'marker'      => 'yes',
						'marker_type' => [ 'popup', 'marker_with_popup' ],
					],
				]
			);
			$this->add_control(
				'popup_content',
				[
					'label'       => esc_html__( 'Macker Popup Content', 'element-ready-pro' ),
					'type'        => Controls_Manager::TEXTAREA,
					'placeholder' => esc_html__( 'Write Popup Content Here.', 'element-ready-pro' ),
					'separator'   => 'before',
					'default'     => esc_html__( 'H-67C1, R-13/B, Banani, Dhaka, 1213, Bangladesh.', 'element-ready-pro'),
					'condition'   => [
						'marker'      => 'yes',
						'marker_type' => [ 'popup', 'marker_with_popup' ],
					],
				]
			);			
		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_style',
			[
				'label' => __( 'Map', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'map_height',
				[
					'label' => __( 'Map Height', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 100,
							'max'  => 1000,
							'step' => 10,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 300,
					],
					'selectors' => [
						'{{WRAPPER}} .element__ready__google__map__wrap' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'map_width',
				[
					'label' => __( 'Map Width', 'element-ready-pro' ),
					'type'  => Controls_Manager::SLIDER,
					'units' => [ '%', 'px' ],
					'range' => [
						'%' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
						'px' => [
							'min'  => 10,
							'max'  => 1000,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 100,
					],
					'selectors' => [
						'{{WRAPPER}} .element__ready__google__map__wrap' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();


		/*----------------------------
			POPUP TITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'_popup_title_style_section',
			[
				'label' => __( 'Popup Box Title', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => '_popup_title_typography',
					'selector' => '{{WRAPPER}} .map__marker__popup__content .popup__title',
				]
			);
			$this->add_control(
				'_popup_title_color',
				[
					'label'     => __( 'Color', 'element-ready-pro' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .map__marker__popup__content .popup__title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => '_popup_title_background',
					'label'    => __( 'Background', 'element-ready-pro' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .map__marker__popup__content .popup__title',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'      => '_popup_title_border',
					'label'     => __( 'Border', 'element-ready-pro' ),
					'selector'  => '{{WRAPPER}} .map__marker__popup__content .popup__title',
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'_popup_title_radius',
				[
					'label'      => __( 'Border Radius', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content .popup__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => '_popup_title_shadow',
					'selector' => '{{WRAPPER}} .map__marker__popup__content .popup__title',
				]
			);
			$this->add_responsive_control(
				'_popup_title_margin',
				[
					'label'      => __( 'Margin', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content .popup__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'_popup_title_padding',
				[
					'label'      => __( 'Padding', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content .popup__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			POPUP TITLE STYLE END
		-----------------------------*/

		/*----------------------------
			POPUP TITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'_popup_box_style_section',
			[
				'label' => __( 'Popup Box', 'element-ready-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => '_popup_box_typography',
					'selector' => '{{WRAPPER}} .map__marker__popup__content',
				]
			);
			$this->add_control(
				'_popup_box_color',
				[
					'label'     => __( 'Color', 'element-ready-pro' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .map__marker__popup__content' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => '_popup_box_background',
					'label'    => __( 'Background', 'element-ready-pro' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .map__marker__popup__content',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'      => '_popup_box_border',
					'label'     => __( 'Border', 'element-ready-pro' ),
					'selector'  => '{{WRAPPER}} .map__marker__popup__content',
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'_popup_box_radius',
				[
					'label'      => __( 'Border Radius', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => '_popup_box_shadow',
					'selector' => '{{WRAPPER}} .map__marker__popup__content',
				]
			);
			$this->add_responsive_control(
				'_popup_box_margin',
				[
					'label'      => __( 'Margin', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'_popup_box_padding',
				[
					'label'      => __( 'Padding', 'element-ready-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .map__marker__popup__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			POPUP TITLE STYLE END
		-----------------------------*/


	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$random_id = $this->get_id();

		$default_access_token = __( 'pk.eyJ1IjoibWVoZWRpZGIiLCJhIjoiY2tqMmQzbHE2MGVvMzJzcGtzMXNmeG8yZiJ9.zZd3XDwI30BdPTWiJiqiAg');
		$default_custom_style = __( 'mapbox://styles/mehedidb/ckj2d4sqd2r8t19o4n23um890', 'element-ready-pro' );
		$default_latitude     = __( '23.792661', 'element-ready-pro' );
		$default_longitude    = __( '90.40577', 'element-ready-pro' );

		if( 'custom__style' == $settings['content_layout_style'] && !empty($settings['mapbox_custom_style']) ){
			$style = $settings['mapbox_custom_style'];
		}elseif( 'custom__style' == $settings['content_layout_style'] && empty($settings['mapbox_custom_style']) ){
			$style = $default_custom_style;
		}else{
			$style = $settings['content_layout_style'];
		}

		$options = array(
			'access_token'    => $settings['mapbox_access_token'] ? $settings['mapbox_access_token'] : $default_access_token,
			'style'           => $style,
			'latitude'        => $settings['mapbox_latitude'] ? $settings['mapbox_latitude'] : $default_latitude,
			'longitude'       => $settings['mapbox_longitude'] ? $settings['mapbox_longitude'] : $default_longitude,
			'zoom'            => $settings['zoom']['size'] ? $settings['zoom']['size'] : 13,
			'minZoom'         => $settings['minZoom']['size'] ? $settings['minZoom']['size'] : 5,
			'maxZoom'         => $settings['maxZoom']['size'] ? $settings['maxZoom']['size'] : 5,
			'scrollZoom'      => ( 'yes' === $settings['scrollZoom'] ) ? true : false,
			'hash'            => ( 'yes' === $settings['hash'] ) ? true : false,
			'interactive'     => ( 'yes' === $settings['interactive'] ) ? true : false,
			'marker'          => ( 'yes' === $settings['marker'] ) ? true : false,
			'marker_type'     => $settings['marker_type'] ? $settings['marker_type'] : 'marker',
			'marker_color'    => $settings['marker_color'] ? $settings['marker_color'] : '#333333',
			'marker_scale'    => $settings['marker_scale'] ? $settings['marker_scale']['size'] : 1,
			'marker_position' => $settings['marker_position'] ? $settings['marker_position'] : 'center',
		);

		if( $settings['popup_title'] ){
			$popup_title = '<h4 class="popup__title">'. $settings['popup_title'] .'</h4>';
		}else{
			$popup_title = '';
		}

		if( $settings['popup_content'] ){
			$popup_content = '<div class="popup__content">'. $settings['popup_content'] .'</div>';
		}else{
			$popup_content = '';
		}
		
		if( !empty( $settings['popup_content'] ) || !empty( $settings['popup_title'] ) ){
			$macker_popup_content = '<div class="map__marker__popup__content">'. $popup_title . $popup_content .'</div>';
		}else{
			$macker_popup_content = '';
		}

		if( !empty( $macker_popup_content ) ){
			$options['popup_content'] = $macker_popup_content;
		}

		$this->add_render_attribute( 'google_map_wrap_attr', 'data-options', json_encode( $options ) );
		$this->add_render_attribute( 'google_map_wrap_attr', 'class', 'element__ready__google__map__wrap' );
		$this->add_render_attribute( 'google_map_wrap_attr', 'id', 'element__ready__google__map__'.$random_id  );

		?>
			<div <?php echo $this->get_render_attribute_string( 'google_map_wrap_attr' ); ?>></div>
		<?php
	}
}