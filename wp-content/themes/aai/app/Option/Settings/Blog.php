<?php

// Blog a top-tab
CSF::createSection(AAI_OPTION_KEY, array(
    'id'    => 'blog_tab', // Set a unique slug-like ID
    'title'  => esc_html__('Blog', 'aai'),
    'icon'     => 'fa fa-book',
));
// Blog
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'blog_tab', // The slug id of the parent section
    'icon'   => 'fa fa-book',
    'title'  => esc_html__('General', 'aai'),
    'fields' => array(

        array(
            'id'          => 'blog_sidebar',
            'type'        => 'select',
            'title'       => esc_html__('Blog Sidebar', 'aai'),
            'placeholder' => 'Select an option',
            'options'     => array(
                '1' => esc_html__('No sidebar', 'aai'),
                '2' => esc_html__('Left Sidebar', 'aai'),
                '3' => esc_html__('Right Sidebar', 'aai'),
            ),
            'default'     => '3'
        ),

        array(
            'id'      => 'blog_box_shadow',
            'type'    => 'switcher',
            'title'   => esc_html__('Box Shadow', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'blog_box_shadow_hover',
            'type'    => 'switcher',
            'title'   => esc_html__('Hover Box Shadow', 'aai'),
            'default' => true
        ),

        array(
            'id'          => 'blog_post_border_radious',
            'type'        => 'slider',
            'title'       => esc_html__('Blog Post Border Radius', 'aai'),
            'min'         => 0,
            'max'         => 300,
            'step'        => 1,
            'unit'        => 'px',
            'output_mode' => 'border-radius',
            'output'      => ' .blog .post-item-1'
        ),


        array(
            'id'      => 'blog_grid',
            'type'    => 'switcher',
            'title'   => esc_html__('Box grid / Two Column', 'aai'),
            'default' => false
        ),

        array(
            'id'      => 'blog_author',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Author', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'blog_author_image',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Author image', 'aai'),
            'default' => false
        ),

        array(
            'id'      => 'blog_date',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Date', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'blog_comment',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Comment', 'aai'),
            'default' => false
        ),

        array(
            'id'      => 'blog_category',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Category', 'aai'),
            'default' => true
        ),

        array(
            'id'      => 'blog_readmore',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Readmore', 'aai'),
            'default' => true
        ),
        array(
            'id'      => 'blog_readmore_text',
            'type'    => 'text',
            'title'   => esc_html__('Blog Readmore Text', 'aai'),
            'default' => esc_html__('Read More', 'aai'),
        ),

        array(
            'id'      => 'blog_post_nav',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Navigation', 'aai'),
            'default' => true
        ),

        array(
            'id'          => 'blog_post_nav_alignment',
            'type'        => 'select',
            'title'   => esc_html__('Navigation Alignment', 'aai'),
            'placeholder' => 'Select an option',
            'options'     => array(
                'justify-content-start'  => esc_html__('Left', 'aai'),
                'justify-content-center' => esc_html__('Center', 'aai'),
                'justify-content-end'    => esc_html__('Right', 'aai'),
            ),
            'default'     => 'justify-content-start'
        ),

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Blog & Page Default Options', 'aai'),
        ),

        array(
            'id'      => 'blog_excerpt',
            'type'    => 'switcher',
            'title'   => esc_html__('Blog Excerpt', 'aai'),
            'default' => true
        ),
        array(
            'id'      => 'blog_excerpt_word',
            'type'    => 'number',
            'title'   => esc_html__('Blog Excerpt Word', 'aai'),
            'desc'    => esc_html__('Set the words that how many words you want to show in every blog post item.', 'aai'),
            'default' => '30',
        ),


    )
));
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'blog_tab', // The slug id of the parent section  
    'title'  => esc_html__('Blog Style', 'aai'),
    'icon'   => 'fa fa-image',
    'fields' => array(

        array(
            'id'      => 'blog_post_bg',
            'type'    => 'background',
            'title'   => esc_html__('Blog List Background', 'aai'),
            'desc'    => esc_html__('Upload a new background image to set the footer background.', 'aai'),
            'default' => array(
                'image'      => '',
                'repeat'     => 'no-repeat',
                'position'   => 'center center',
                'attachment' => 'scroll',
                'size'       => 'cover',

            ),
            'output' => '.post .post-item-1'
        ),

        array(
            'id'          => 'blog_post__padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Post Padding', 'aai'),
            'output'      => '.post .post-item-1',
            'output_mode' => 'padding', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'blog_post__margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Post Margin', 'aai'),
            'output'      => '.post .post-item-1',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'blog_post_meta_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Meta Margin', 'aai'),
            'output'      => '.post .b-post-details .bp-meta',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'blog_post_meta_padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Meta Item Margin', 'aai'),
            'output'      => '.post .b-post-details .bp-meta a',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'blog_post_title_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Title Margin', 'aai'),
            'output'      => '.blog .b-post-details h3',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),


        array(
            'id'          => 'blog_post_content_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Content Margin', 'aai'),
            'output'      => '.post .b-post-details p',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'blog_post_readmore_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Reamore Margin', 'aai'),
            'output'      => '.post .b-post-details .read-more',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

    )
));
// Sidebar Style
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'blog_tab', // The slug id of the parent section  
    'title'  => esc_html__('Sidebar Style', 'aai'),
    'icon'   => 'fa fa-image',
    'fields' => array(

        array(
            'id'      => 'news__sidebars_bg',
            'type'    => 'background',
            'title'   => esc_html__('Sidebar Background', 'aai'),
            'desc'    => esc_html__('Upload a new background image to set the footer background.', 'aai'),
            'default' => array(
                'image'      => '',
                'repeat'     => 'no-repeat',
                'position'   => 'center center',
                'attachment' => 'scroll',
                'size'       => 'cover',

            ),
            'output' => '.blog-sidebar .widget'
        ),

        array(
            'id'          => 'news_blog_sidebars_padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Sidebar Padding', 'aai'),
            'output'      => '.blog-sidebar .widget ',
            'output_mode' => 'padding', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'news_blog_sidebars_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Sidebar margin', 'aai'),
            'output'      => '.blog-sidebar .widget ',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),



        array(
            'type'    => 'subheading',
            'content' => esc_html__('Text & Link Color', 'aai'),
        ),
        array(
            'id'      => 'news__sidebars_widget_title_color',
            'type'    => 'color',
            'title'   => esc_html__('Widget Title Color', 'aai'),
            'desc'    => esc_html__('Set Sideabr widget title color form here.', 'aai'),
            'output' => '.blog-sidebar .widget .widget-title'
        ),
        array(
            'id'      => 'news__sidebars_widget_content_color',
            'type'    => 'color',
            'title'   => esc_html__('Widget content Color', 'aai'),
            'desc'    => esc_html__('Set footer widget content color form here.', 'aai'),
            'output' => '.blog-sidebar select , .blog-sidebar .tagcloud a,.blog-sidebar ul li a.rsswidget,.blog-sidebar .widget,.blog-sidebar ul li a,.blog-sidebar .widget ul li a.url'
        ),
        array(
            'id'     => 'sidebar_border_color',
            'type'   => 'border',
            'title'  => esc_html__('Border Color', 'aai'),
            'output' => '.blog-sidebar ul li'
        ),


        array(
            'id'          => 'news_blog_sidebars_title_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Widget Title Margin', 'aai'),
            'output'      => '.blog-sidebar .widget .widget-title',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'      => 'sidebars_link_color',
            'type'    => 'color',
            'title'   => esc_html__('Sideber links color', 'aai'),
            'desc'    => esc_html__('Set the Sidebar area link color', 'aai'),
            'output' => '.blog-sidebar .single-blog-post a .blog-sidebar .tagcloud a, .blog-sidebar .widget a, .blog-sidebar .widget ul li a.url,.blog-sidebar .widget ul li a.rsswidget'
        ),

        array(
            'id'      => 'sidebar_link_hover',
            'type'    => 'color',
            'title'   => esc_html__('Sidebar links Hover color', 'aai'),
            'desc'    => esc_html__('Set the footer area link hover color', 'aai'),
            'output' => '.blog-sidebar .single-blog-post a:hover, .blog-sidebar .tagcloud a:hover, .blog-sidebar .widget a:hover, .blog-sidebar .widget ul li a.url:hover,.blog-sidebar .widget ul li a.rsswidget:hover'
        ),

    )
));
