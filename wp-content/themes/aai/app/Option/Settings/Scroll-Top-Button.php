<?php

// scroll
CSF::createSection(AAI_OPTION_KEY, array(
    'title'  => esc_html__('Scroll Top Button', 'aai'),
    'icon'   => 'fa fa-arrow-up',
    'fields' => array(
        array(
            'id'      => 'enable_scroll_top',
            'type'    => 'switcher',
            'title'   => esc_html__('Enable Scroll Top', 'aai'),
            'desc'    => esc_html__('If you want to enable or disable scroll to top button you can set ( YES / NO )', 'aai'),
            'default' => true,
        ),



        array(
            'type'    => 'subheading',
            'content' => esc_html__('Background & Color', 'aai'),
        ),

        array(
            'id'     => 'scroll_text_color',
            'type'   => 'color',
            'title'  => esc_html__('Color', 'aai'),
            'dependency' => array('enable_scroll_top', '==', true),
            'desc'   => esc_html__('Set color form here.', 'aai'),
            'output' => '.back-to-top a i '

        ),


        array(
            'id'      => 'scroll_bg',
            'type'    => 'background',
            'title'   => esc_html__('Background', 'aai'),
            'output'  => '.back-to-top a',
            'dependency' => array('enable_scroll_top', '==', true),
            'desc'    => esc_html__('Upload a new background image or select color to set the preloader background.', 'aai'),
        ),


    ),

));
