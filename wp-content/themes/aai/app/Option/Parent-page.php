<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {


  CSF::createOptions(AAI_OPTION_KEY, array(

    // framework title
    'framework_title'         => esc_html__('Aai Theme', 'aai'),
    'framework_class'         => 'aai',

    // menu settings
    'menu_title'              => esc_html__('Aai Theme', 'aai'),
    'menu_slug'               => 'aai-theme',
    'menu_type'               => 'menu',
    'menu_capability'         => 'manage_options',
    'menu_icon'               => null,
    'menu_position'           => 30,
    'menu_hidden'             => false,

    // menu extras
    'show_bar_menu'           => true,
    'show_sub_menu'           => true,
    'show_in_network'         => true,
    'show_in_customizer'      => false,

    'show_search'             => true,
    'show_reset_all'          => true,
    'show_reset_section'      => true,
    'show_footer'             => true,
    'show_all_options'        => true,
    'show_form_warning'       => true,
    'sticky_header'           => true,
    'save_defaults'           => true,
    'ajax_save'               => true,


    // footer
    'footer_credit'           => esc_html__('Credited by quomodotheme', 'aai'),
    'transient_time'          => 0,

    // typography options
    'enqueue_webfont'         => true,
    'async_webfont'           => true,

    // others
    'output_css'              => true,



  ));
}
