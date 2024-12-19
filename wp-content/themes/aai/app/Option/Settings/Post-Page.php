<?php


// Post Page
CSF::createSection(AAI_OPTION_KEY, array(
  'icon'   => 'fa fa-book',
  'title' => esc_html__('Post & Page', 'aai'),
  'fields' => array(

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Post Setting', 'aai'),
    ),

    array(
      'id'      => 'single_post_thumnnail',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Post Thumbnail', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable post Thumbnail Image you can set ( YES / NO )', 'aai'),
      'default' => true,
    ),
    array(
      'id'      => 'single_post_tags',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable Post tags', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable post tags you can set ( YES / NO )', 'aai'),
      'default' => true,
    ),


    array(
      'id'      => 'blog_single_author_box',
      'type'    => 'switcher',
      'title'   => esc_html__('Blog Author About', 'aai'),
      'default' => false
    ),


  ),
));

CSF::createSection(AAI_OPTION_KEY, array(
  'icon'   => 'fa fa-book',
  'title' => esc_html__('404', 'aai'),
  'fields' => array(

    array(
      'type'    => 'subheading',
      'content' => esc_html__('404 Error Page Setting', 'aai'),
    ),

    array(
      'id'      => 'disable_header_footer',
      'type'    => 'switcher',
      'title'   => esc_html__('Disable Header Footer', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable header footer you can set ( YES / NO )', 'aai'),
      'default' => false,
    ),

    array(
      'id'      => 'enable_404_transparent_header',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable 404 Transparent header', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable home page header you can set ( YES / NO )', 'aai'),
      'default' => false,
    ),

    array(
      'id'         => 'error_title',
      'type'       => 'text',
      'title'      => esc_html__('404 Error Page Text', 'aai'),
      'desc'       => esc_html__('Set your 404 error title.', 'aai'),
      'default'    => esc_html__('The page can’t be found.', 'aai')
    ),

    array(
      'id'     => 'error__text_color',
      'type'   => 'color',
      'title'  => esc_html__('404 Error Page Text Color', 'aai'),

      'output' => '
                .aai-error-content span
             '

    ),

    array(
      'id'     => 'error_title_text_color',
      'type'   => 'color',
      'title'  => esc_html__('404 Error Title Color', 'aai'),
      'default' => '#ffffff',
      'output' => '
               body .aai-error-area .aai-error-content h3
             '

    ),

    array(
      'id'         => 'error_text',
      'type'       => 'text',
      'title'      => esc_html__('404 Error Page description', 'aai'),
      'desc'       => esc_html__('Set your 404 error description.', 'aai'),
      'default'    => esc_html__("The page you're looking for isn't available. Try with another page or use the go home button below", 'aai')
    ),

    array(
      'id'     => 'error_descv_text_color',
      'type'   => 'color',
      'title'  => esc_html__('404 Error Desc Color', 'aai'),
      'default' => '#DADADA',
      'output' => '
                .aai-error-content p
             '
    ),

    array(
      'id'      => 'enable_404_return_home_button',
      'type'    => 'switcher',
      'title'   => esc_html__('Enable 404 Home Button', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable home page button you can set ( YES / NO )', 'aai'),
      'default' => true,
    ),

    array(
      'id'     => 'error_button_text_color',
      'type'   => 'color',
      'title'  => esc_html__('404 Error Button Color', 'aai'),
      'default' => '',
      'output' => '
                .aai-error-content a
             '
    ),

    array(
      'id'     => 'error_button_border_color',
      'type'   => 'border',
      'title'  => esc_html__('404 Error Button Border', 'aai'),
      'output' => '.aai-error-content a'
    ),

    array(
      'id'                              => 'error_404_button_image',
      'type'                            => 'background',
      'title'                           => esc_html__('Button Background', 'aai'),
      'background_gradient'             => true,
      'background_origin'               => true,
      'background_clip'                 => true,
      'background_blend_mode'           => true,
      'output'                => '.aai-error-content a',
    ),


    array(
      'id'      => 'error_404_image',
      'type'    => 'upload',
      'title'   => esc_html__('Upload 404 Image', 'aai'),
      'desc'    => esc_html__('Upload 404 image width 706px and height 431px.', 'aai'),
      'default' => '',

    ),

    array(
      'id'                              => 'error_404_body_image',
      'type'                            => 'background',
      'title'                           => esc_html__('Body Background', 'aai'),
      'background_gradient'             => true,
      'background_origin'               => true,
      'background_clip'                 => true,
      'background_blend_mode'           => true,
      'output'                => '.error404',
    ),


    array(
      'id'      => 'error_enable_main_container',
      'type'    => 'switcher',
      'title'   => esc_html__('Blog Container', 'aai'),
      'desc'    => esc_html__('If you want to enable or disable 404 page footer you can set ( YES / NO )', 'aai'),
      'default' => true,
    ),

  ),
));
