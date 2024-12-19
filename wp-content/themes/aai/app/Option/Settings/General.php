<?php

CSF::createSection(AAI_OPTION_KEY, array(
    'icon'   => 'fa fa-book',
    'title'  => esc_html__('General', 'aai'),
    'fields' => array(

        array(
            'id'         => 'general_blog_title',
            'type'       => 'text',
            'title'      => esc_html__('Blog Title', 'aai'),
            'desc'       => esc_html__('Set global blog title', 'aai'),

        ),

        array(
            'id'         => 'general_breadcrumb_limit',
            'type'       => 'number',
            'title'      => esc_html__('Breadcrumb limit', 'aai'),
            'desc'       => esc_html__('Set the breadcrump text limit', 'aai'),
            'default'    => '50',
        ),

        array(
            'id'      => 'general_breadcrumb_post_title_show',
            'type'    => 'switcher',
            'title'   => esc_html__('Breadcrumb Post Title ?', 'aai'),
            'default' => false
        ),

        array(
            'id'      => 'general_breadcrumb_page_title_show',
            'type'    => 'switcher',
            'title'   => esc_html__('Breadcrumb Page Title ?', 'aai'),
            'default' => false
        ),

    )
));


CSF::createSection(AAI_OPTION_KEY, array(
    'icon'   => 'fa fa-cart',
    'title'  => esc_html__('Shop', 'aai'),
    'fields' => array(

        array(
            'id'         => 'shop_product_columns',
            'type'       => 'text',
            'title'      => esc_html__('Product Columns', 'aai'),


        ),

        array(
            'id'      => 'shop_product_sidebar_enable',
            'type'    => 'switcher',
            'title'   => esc_html__('Shop Sidebar?', 'aai'),
            'default' => false
        ),

        array(
            'id'          => 'shop_sidebar',
            'type'        => 'select',
            'title'       => esc_html__('Sidebar', 'aai'),
            'placeholder' => 'Select an option',
            'options'     => array(
                'no' => esc_html__('No sidebar', 'aai'),
                'left' => esc_html__('Left Sidebar', 'aai'),
                'right' => esc_html__('Right Sidebar', 'aai'),
            ),
            'default'     => '3'
        ),



    )
));
