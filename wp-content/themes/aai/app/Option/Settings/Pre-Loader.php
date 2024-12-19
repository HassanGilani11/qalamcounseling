<?php


// pre-loader
CSF::createSection(AAI_OPTION_KEY, array(

	'title'   => esc_html__('Preloader', 'aai'),
	'icon'   => 'fa fa-spinner',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__('Preloader Type', 'aai'),
		),
		array(
			'id'      => 'enable_preloader',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Preloader', 'aai'),
			'desc'    => esc_html__('If you want to enable or disable preloader you can set ( YES / NO )', 'aai'),
			'default' => true,
		),

		array(
			'id'      => 'enable_close_preloader',
			'type'    => 'switcher',
			'title'   => esc_html__('Enable Close Button', 'aai'),
			'desc'    => esc_html__('If you want to enable or disable preloader you can set ( YES / NO )', 'aai'),
			'default' => true,
		),

		array(
			'id'     => 'preloader_close_text',
			'type'   => 'text',
			'title'  => esc_html__('Close Text', 'aai'),
			'default' => esc_html__('Close', 'aai'),
			'dependency' => array('enable_close_preloader', '==', true),
		),

		array(
			'type'    => 'subheading',
			'content' => esc_html__('Preloader Background & Color', 'aai'),
		),

		array(
			'id'      => 'preloader_bg',
			'type'    => 'background',
			'title'   => esc_html__('Preloader Background', 'aai'),
			'output'  => '.loader-wrap .preloader',
			'desc'    => esc_html__('Upload a new background image or select color to set the preloader background.', 'aai'),
		),

		array(
			'id'      => 'preloader_overlay_bg',
			'type'    => 'background',
			'title'   => esc_html__('Preloader Background Overlay', 'aai'),
			'output'  => 'body .loader-wrap .layer .overlay',

		),

		array(
			'id'      => 'preloader_bg_icon',
			'type'    => 'background',
			'title'   => esc_html__('Preloader Close Icon', 'aai'),
			'output'  => 'body .preloader .preloader-close',
			'dependency' => array('enable_close_preloader', '==', true),

		),

		array(
			'id'     => 'preloader_text_colors',
			'type'   => 'color',
			'title'  => esc_html__('Close Color', 'aai'),
			'output' => 'body .preloader .preloader-close',
			'dependency' => array('enable_close_preloader', '==', true),
		),


	),
));
