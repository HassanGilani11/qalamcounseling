<?php
// Blog
// footer a top-tab
CSF::createSection(AAI_OPTION_KEY, array(
    'id'    => 'banner_tab', // Set a unique slug-like ID
    'title'  => esc_html__('Banner', 'aai'),
    'icon'     => 'fa fa-cog',
));
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'banner_tab', // The slug id of the parent section
    'icon'   => 'fa fa-book',
    'title'  => esc_html__('Content Settings', 'aai'),
    'fields' => array(

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Blog Banner', 'aai'),
        ),

        array(
            'id'      => 'blog_banner_show',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Banner Show', 'aai'),
            'default' => true
        ),


        array(
            'id'      => 'blog_show_breadcrumb',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Breadcrumb', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'banner_blog_title',
            'type'    => 'text',
            'title'   => esc_html__('Blog title', 'aai'),

        ),

        array(

            'id'      => 'banner_blog_image',
            'type'    => 'background',
            'title'   => esc_html__('Upload Background', 'aai'),
            'desc'    => esc_html__('Upload main Image width 1200px and height 400px.', 'aai'),
            'output' => '.aai-page-title-area'
        ),

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Blog Post / Details', 'aai'),
        ),

        array(
            'id'      => 'blog_single_banner_show',
            'type'    => 'switcher',
            'title'   => esc_html__('Banner Show', 'aai'),
            'default' => true
        ),


        array(
            'id'      => 'blog_single_show_breadcrumb',
            'type'    => 'switcher',
            'title'   => esc_html__('Post Breadcrumb', 'aai'),
            'default' => true
        ),

        array(

            'id'      => 'banner_single_blog_image',
            'type'    => 'background',
            'title'   => esc_html__('Upload Background', 'aai'),
            'desc'    => esc_html__('Upload main Image width 1200px and height 400px.', 'aai'),
            'output' => '.single-post .aai-page-title-area'
        ),



        array(
            'type'    => 'subheading',
            'content' => esc_html__('Page Banner', 'aai'),
        ),

        array(

            'id'      => 'page_banner_show',
            'type'    => 'switcher',
            'title'   => esc_html__('Page Banner Show ', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'page_show_breadcrumb',
            'type'    => 'switcher',
            'title'   => esc_html__('Page Breadcrumb', 'aai'),
            'default' => true
        ),

        array(

            'id'      => 'banner_page_title',
            'type'    => 'text',
            'title'   => esc_html__('Page Title', 'aai'),
            'default' => ''
        ),

        array(

            'id'      => 'banner_page_image',
            'type'    => 'background',
            'title'   => esc_html__('Upload Background', 'aai'),
            'desc'    => esc_html__('Upload main Image width 1200px and height 400px.', 'aai'),
            'output' => '.page .aai-page-title-area'
        ),



    )
));
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'banner_tab', // The slug id of the parent section
    'icon'   => 'fa fa-book',
    'title'  => esc_html__('Style', 'aai'),
    'fields' => array(

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Blog Banner', 'aai'),
        ),

        array(
            'id'    => 'banner_blog_title_color',
            'type'  => 'color',
            'title' => esc_html__('Title Color', 'aai'),
            'output' => '.aai-page-title-item .title, .aai-page-title-item span'
        ),

        array(
            'id'     => 'banner_blog_breadcrumb_color',
            'type'   => 'color',
            'title'  => esc_html__('Breadcrumb Color', 'aai'),
            'output' => '.aai-page-title-item nav ol li, .aai-page-title-item nav ol li a',
            'output_important' => true
        ),

        array(
            'id'     => 'banner_blog_breadcrumb_icon_color',
            'type'   => 'color',
            'title'  => esc_html__('Breadcrumb Icon Color', 'aai'),
            'output' => '.aai-page-title-item nav ol li i',
            'output_important' => true
        ),


        array(
            'type'    => 'subheading',
            'content' => esc_html__('Blog Post', 'aai'),
        ),

        array(
            'id'    => 'banner_post_title_color',
            'type'  => 'color',
            'title' => esc_html__('Title Color', 'aai'),
            'output' => '.single-post .aai-page-title-item .title, .single-post .aai-page-title-item span'
        ),

        array(
            'id'     => 'banner_post_meta__color',
            'type'   => 'color',
            'title'  => esc_html__('Meta Color', 'aai'),
            'output' => '.single .aai-page-title-area .bp-meta a'
        ),

        array(
            'id'     => 'banner_post_meta_icon_color',
            'type'   => 'color',
            'title'  => esc_html__('Meta Color Icon', 'aai'),
            'output' => '.single .aai-page-title-area .bp-meta a i'
        ),

        array(
            'id'     => 'banner_post_breadcrumb_color',
            'type'   => 'color',
            'title'  => esc_html__('Breadcrumb ', 'aai'),
            'output' => '.single .aai-page-title-item nav ol li a,.single .aai-page-title-item nav ol li'
        ),

        array(
            'id'    => 'banner_post_breadcrumb_hover_color',
            'type'  => 'color',
            'title' => esc_html__('Breadcrumb Hover', 'aai'),
            'output' => '.single .aai-page-title-item nav ol li:hover a'
        ),

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Page Banner', 'aai'),
        ),

        array(
            'id'     => 'banner_page_title_color',
            'type'   => 'color',
            'title'  => esc_html__('Page Title Color', 'aai'),
            'output' => '.page .aai-page-title-item .title'
        ),

        array(
            'id'     => 'banner_page_breadcrumb_color',
            'type'   => 'color',
            'title'  => esc_html__('Page Breadcrumb Color', 'aai'),
            'output' => '.page .aai-page-title-item nav ol li, .page .aai-page-title-item nav ol li a',
            'output_important' => true
        ),

        array(
            'id'               => 'banner_page_breadcrumb_hover_color',
            'type'             => 'color',
            'title'            => esc_html__('Breadcrumb Hover Color', 'aai'),
            'output'           => '.page .aai-page-title-item nav ol li:hover a',
            'output_important' => true
        ),


    )
));
