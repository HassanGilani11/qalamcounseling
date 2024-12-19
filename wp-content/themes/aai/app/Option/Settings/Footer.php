<?php

// footer a top-tab
CSF::createSection(AAI_OPTION_KEY, array(
    'id'    => 'footer_tab',                         // Set a unique slug-like ID
    'title' => esc_html__('Footer', 'aai'),
    'icon'  => 'fa fa-cog',
));

// Footer
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'footer_tab', // The slug id of the parent section
    'title'  => esc_html__('Footer Color & Background', 'aai'),
    'icon'   => 'fa fa-paint-brush',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => esc_html__('Footer Settings', 'aai'),
        ),



        array(
            'id'      => 'footer_style',
            'type'    => 'image_select',
            'title'   => esc_html__('Footer Style', 'aai'),
            'desc'    => esc_html__('Select the Footer style which you want to show on your website.', 'aai'),
            'options' => array(
                'style1'       => AAI_IMG . '/dash/footer_style1.jpg',
            ),
            'default' => 'style1',
        ),


        array(
            'id'      => 'footer_bg',
            'type'    => 'background',
            'title'   => esc_html__('Footer Background ', 'aai'),
            'desc'    => esc_html__('Upload a new background image to set the footer background.', 'aai'),
            'default' => array(
                'image'      => '',
                'repeat'     => 'no-repeat',
                'position'   => 'center center',
                'attachment' => 'scroll',
                'size'       => 'cover',
                'color'      => '#182044',
            ),
            'output' => '.footer-area',
            'dependency' => array('footer_style', '==', 'style1'),
        ),

        array(
            'id'      => 'footer_copyright__bg',
            'type'    => 'background',
            'title'   => esc_html__('Footer Background ', 'aai'),
            'desc'    => esc_html__('Upload a new background image to set the footer background.', 'aai'),
            'default' => array(
                'image'      => '',
                'repeat'     => 'no-repeat',
                'position'   => 'center center',
                'attachment' => 'scroll',
                'size'       => 'cover',
                'color'      => '#182044',
            ),
            'output' => '.footer-area',

        ),


        array(
            'id'          => 'news_footer_sidebars_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer Margin', 'aai'),
            'output'      => '.footer-area',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'news_footer_sidebars_padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer Padding', 'aai'),
            'output'      => '.footer-area',
            'output_mode' => 'padding', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__('Widget Title', 'aai'),
        ),
        array(
            'id'          => 'news_footer_widget_title_sidebars_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer Widget Title Margin', 'aai'),
            'output'      => '.footer-area .widget .widget-title',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'news_footer_widget_title_sidebars_padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer Widget Title Padding', 'aai'),
            'output'      => '.footer-area .widget .widget-title',
            'output_mode' => 'padding', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__('Widget Content', 'aai'),
        ),
        array(
            'id'          => 'news_footer_widget_sidebars_padding',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer widget Padding', 'aai'),
            'output'      => '.footer-area .widget',
            'output_mode' => 'padding', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'          => 'news_footer_widget_sidebars_margin',
            'type'        => 'spacing',
            'title'   => esc_html__('Footer widget Margin', 'aai'),
            'output'      => '.footer-area .widget',
            'output_mode' => 'margin', // or margin, relative
            'default'     => array(
                'unit'      => 'px',
            ),
        ),

        array(
            'id'     => 'footer_border_color',
            'type'   => 'border',
            'title'  => esc_html__('Border', 'aai'),
            'output' => '.footer-area .widget',

        ),

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Footer Text & Link Color', 'aai'),
        ),
        array(
            'id'      => 'footer_widget_title_color',
            'type'    => 'color',
            'title'   => esc_html__('Widget Title Color', 'aai'),
            'desc'    => esc_html__('Set footer widget title color form here.', 'aai'),
            'output' => '.footer-area .widget .widget-title'
        ),

        array(
            'id'     => 'footer_widghet_title_border_color',
            'type'   => 'border',
            'title'  => esc_html__('Widget Title Border', 'aai'),
            'output' => '.footer-area .widget .widget-title',

        ),
        array(
            'id'      => 'footer_widget_content_color',
            'type'    => 'color',
            'title'   => esc_html__('Widget content Color', 'aai'),
            'desc'    => esc_html__('Set footer widget content color form here.', 'aai'),
            'output' => '.footer-area .widget, .footer-area .comment-author-link a.url, .footer-area .recentcomments,.footer-area .tagcloud a, .footer-area .widget_archive ul li a, .footer-area .widget_categories ul li a, .footer-area .widget_meta ul li a,footer .widget ul li,select option,.footer-area .widget_pages ul li a,.footer-area .widget_rss li .rss-date,.footer-area .widget_rss li cite,.footer-area .widget_nav_menu ul li a '
        ),


        array(
            'id'      => 'footer_link_color',
            'type'    => 'color',
            'title'   => esc_html__('Footer links color', 'aai'),
            'desc'    => esc_html__('Set the footer area link color', 'aai'),
            'output' => '.quomodo-body-innner-content .footer-area .single-blog-post a ,.quomodo-body-innner-content .footer-area .tagcloud a,.quomodo-body-innner-content .footer-area .widget a,.quomodo-body-innner-content .footer-area .widget ul li a.url, .quomodo-body-innner-content .footer-area .widget ul li a.rsswidget'
        ),

        array(
            'id'      => 'footer_link_hover',
            'type'    => 'color',
            'title'   => esc_html__('Footer links Hover color', 'aai'),
            'desc'    => esc_html__('Set the footer area link hover color', 'aai'),
            'output'  => '.quomodo-body-innner-content .footer-area .single-blog-post a:hover,.quomodo-body-innner-content .footer-area .tagcloud a:hover, .quomodo-body-innner-content .footer-area .widget a:hover, .quomodo-body-innner-content .footer-area .widget ul li a.url:hover,.quomodo-body-innner-content .footer-area .widget ul li a.rsswidget:hover'
        ),

        array(
            'type'    => 'subheading',
            'content' => esc_html__('Copyright & Back Button', 'aai'),
        ),

        array(
            'id'      => 'copyright_padding_top',
            'type'    => 'slider',
            'title'   => esc_html__('Copyright Padding top', 'aai'),
            'min'     => 0,
            'max'     => 300,
            'step'    => 1,
            'unit'    => 'px',

        ),

        array(
            'id'      => 'copyright_padding_bottom',
            'type'    => 'slider',
            'title'   => esc_html__('Copyright Padding Bottom', 'aai'),
            'min'     => 0,
            'max'     => 300,
            'step'    => 1,
            'unit'    => 'px',
        ),

        array(
            'id'      => 'copyright_margin_top',
            'type'    => 'slider',
            'title'   => esc_html__('Copyright margin top', 'aai'),
            'min'     => 0,
            'max'     => 300,
            'step'    => 1,
            'unit'    => 'px',

        ),

        array(
            'id'      => 'footer_copyright_color',
            'type'    => 'color',
            'title'   => esc_html__('Copyright Text Color', 'aai'),
            'desc'    => esc_html__('Set footer copyright text color form here.', 'aai'),
            'output'  => '.footer-area .copyright-text p'
        ),

        array(
            'id'      => 'footer_copyright_link_color',
            'type'    => 'color',
            'title'   => esc_html__('Copyright Link Color', 'aai'),
            'desc'    => esc_html__('Set footer copyright link color form here.', 'aai'),
            'output'  => '.footer-area .copyright-text p a'
        ),

        array(

            'id'                    => 'copyright_background_color',
            'type'                  => 'background',
            'title'                 => esc_html__('Copyright Background', 'aai'),
            'background_gradient'   => true,
            'background_origin'     => true,
            'background_clip'       => true,
            'background_blend_mode' => true,
            'default'               => array(
                'background-color'              => '',
                'background-gradient-color'     => '',
                'background-gradient-direction' => 'to bottom',
                'background-size'               => 'cover',
                'background-position'           => 'center center',
                'background-repeat'             => 'repeat',
            ),
            'output' => '.footer-area .copyright-text p'
        ),

        array(
            'id'     => 'footer_copyright_border',
            'type'   => 'border',
            'title'   => esc_html__('Copyright Border', 'aai'),
            'output'  => '.footer-area .copyright-text'
        ),

        // back button
        array(
            'id'      => 'footer_back_top_button',
            'type'    => 'switcher',
            'title'   => esc_html__('Enable Back to Button', 'aai'),
            'default' => true
        ),
        array(
            'id'     => 'footer_copyright_back_button',
            'type'   => 'border',
            'title'  => esc_html__('Back Button Border', 'aai'),
            'output' => '.back-to-top'
        ),
        array(
            'id'      => 'footer_copyright_back_button_color',
            'type'    => 'color',
            'title'   => esc_html__('Back Button Color', 'aai'),
            'desc'    => esc_html__('Set footer Back Button icon color form here.', 'aai'),
            'output' => 'body .back-to-top a',
            'output_mode' => 'background-color'
        ),
        array(
            'id'      => 'footer_copyright_icon_color',
            'type'    => 'color',
            'title'   => esc_html__('Back Button Icon Color', 'aai'),
            'desc'    => esc_html__('Set footer Back Button icon color form here.', 'aai'),
            'output' => '.back-to-top a i'
        ),

    ),

));

// copyright
CSF::createSection(AAI_OPTION_KEY, array(
    'parent' => 'footer_tab', // The slug id of the parent section
    'title'  => esc_html__('Footer Copyright && Buttons', 'aai'),
    'icon'   => 'fa fa-copyright',
    'fields' => array(

        array(
            'id'           => 'footer_multi_buttons',
            'type'         => 'group',
            'title'        => esc_html__('Footer Button', 'aai'),
            'button_title' => esc_html__('Add New Item', 'aai'),

            'fields'       => array(

                array(
                    'id'      => 'icon',
                    'type'    => 'icon',
                    'title'   => esc_html__('Icon ', 'aai'),
                    'desc'    => esc_html__('Set the icon ', 'aai'),
                    'default' => 'fal fa-envelope'
                ),

                array(
                    'id'      => 'link',
                    'type'    => 'text',
                    'title'   => esc_html__('Link', 'aai'),
                ),

                array(
                    'id'      => 'content',
                    'type'    => 'text',
                    'title'   => esc_html__('Label', 'aai'),

                ),

            ),
        ),

        array(
            'id'       => 'copyright_text',
            'type'     => 'wp_editor',
            'title'    => esc_html__('Footer Copyright', 'aai'),
            'desc'     => esc_html__('Set the footer copyright text', 'aai'),
            'settings' => array(
                'textarea_rows' => 10,
                'tinymce'       => true,
                'media_buttons' => false,
            ),
            'default' => 'Copryright &copy; QuomodoTheme All Right Reserved.',
        ),

    ),

));
