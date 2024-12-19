<?php

// backup option
CSF::createSection(AAI_OPTION_KEY, array(

    'title'  => esc_html__('Style', 'aai'),
    'icon'   => 'fa fa-share-square-o',
    'fields' => array(
        array(
            'id'                    => 'body_bg_color',
            'type'                  => 'background',
            'title'                 => esc_html__('Body Background', 'aai'),
            'desc'                  => esc_html__('Set the body background color', 'aai'),
            'default'               => '',
            'background_image'      => true,
            'background_position'   => true,
            'background_repeat'     => true,
            'background_attachment' => true,
            'background_size'       => true,
            'output'                => 'body , .post-item-1',

        ),

        array(
            'id'     => 'body_text_color',
            'type'   => 'color',
            'title'  => esc_html__('Body Text Color', 'aai'),
            'desc'   => esc_html__('Set footer widgetbody content color form here.', 'aai'),
            'output' => '
              body ,
             .qomodo-post-navigation span,
             .qomodo-post-navigation i, 
             .bp-meta a ,
             .b-post-details a.read-more,
             .b-post-details p,
             .blog-sidebar .widget ul li a,
             .widget_text p,
             .blog-sidebar .widget ul li
             '

        ),

        array(
            'id'     => 'main_text_color',
            'type'   => 'color',
            'title'  => esc_html__('Main & Meta Color', 'aai'),
            'desc'   => esc_html__('Set main color form here.', 'aai'),
            'output' => '
            .comment-form input[type="submit"],
            .logged-in-as a,
            .blog a.read-more,
            .blog .bp-meta a,
            .blog-sidebar .widget_rss li .rss-date,
            .widget_rss li cite,
            .blog .bp-meta a i'
        ),

        array(
            'id'     => 'main_hover_color',
            'type'   => 'color',
            'title'  => esc_html__('Secondary Hover Color', 'aai'),
            'desc'   => esc_html__('Set Secondary color form here.', 'aai'),
            'output' => '
            .comment-form input[type="submit"]:hover,
            .logged-in-as a:hover,
            .blog a.read-more:hover,
            .blog .bp-meta a:hover,
            .blog-sidebar .widget_rss li .rss-date:hover,
            .blog-sidebar .widget ul li a:hover,
            .b-post-details h3:hover a,
            .blog .single-post-area .quomodo-entry-title:hover,
            .single-post-navigation .title-with-link h3:hover,
            .title-with-link span:hover,
            .post-tags a:hover,
            .widget_rss li:hover a, 
            .blog-sidebar .tagcloud a:hover,
            .footer-area .widget_archive ul li a:hover, 
            .footer-area .widget_categories ul li a:hover,
            .footer-area .widget_meta ul li a:hover,
            .footer-area .widget_pages ul li a:hover, 
            .footer-area .widget_meta ul li a:hover,
            .footer-area .widget_nav_menu ul li a:hover,
            .footer-area .widget_recent_comments li a:hover,
            .widget_recent_entries li a:hover,
            .footer-area .tagcloud a:hover,
            .qstm-pagination a:hover
           '
        ),

        array(
            'id'     => 'title_color',
            'type'   => 'color',
            'title'  => esc_html__('Title Color', 'aai'),
            'desc'   => esc_html__('Set blog title color form here.', 'aai'),
            'output' => '
            .single-post-navigation .title-with-link h3,
            .comments-title,
            .comments-area .comment-reply-title ,
             .blog .single-post-area .quomodo-entry-title, 
             .b-post-details h3 a,
             .blog-sidebar .widget .widget-title,
             .footer-area .widget .widget-title
              '
        ),

        array(
            'id'     => 'body_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Body Font', 'aai'),
            'output' => 'body'
        ),

        array(
            'id'     => 'h1_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H1 Font', 'aai'),
            'output' => 'h1'
        ),

        array(
            'id'     => 'h2_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H2 Font', 'aai'),
            'output' => 'h2'
        ),

        array(
            'id'     => 'h3_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H3 Font', 'aai'),
            'output' => 'h3'
        ),

        array(
            'id'     => 'h4_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H4 Font', 'aai'),
            'output' => 'h4'
        ),
        array(
            'id'     => 'h5_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H5 Font', 'aai'),
            'output' => 'h5'
        ),
        array(
            'id'     => 'h6_font_typho',
            'type'   => 'typography',
            'title'  => esc_html__('Heading H6 Font', 'aai'),
            'output' => 'h6'
        ),
    ),
));
