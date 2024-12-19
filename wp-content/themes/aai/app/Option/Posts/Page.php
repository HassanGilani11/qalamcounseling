<?php


$header_footer_url = admin_url('edit.php?post_type=qheader-footer');
// Control core classes for avoid errors
if (class_exists('CSF')) {

  //
  // Set a unique slug-like ID
  $post_prefix = 'aai_page_options';

  //
  // Create a metabox for post
  CSF::createMetabox($post_prefix, array(
    'title'  => esc_html__('Settings', 'aai'),
    'post_type' => 'page',
  ));

  // Generel section
  CSF::createSection($post_prefix, array(
    'title'  => esc_html__('Generel', 'aai'),
    'fields' => array(

      array(
        'id'      => 'enable_rtl',
        'type'    => 'switcher',
        'title'   => esc_html__('RTL', 'aai'),
        'desc'    => esc_html__('If you want to enable or Disable RTL you can set ( YES / NO )', 'aai'),
        'default' => false,
      ),


      array(
        'id'    => 'rtl_language',
        'type'  => 'text',
        'title'  =>  esc_html__('Language Code', 'aai'),
        'desc'  =>  __('Provide language code from <a href="https://cartflows.com/docs/complete-list-of-wordpress-locale-codes/" target="_blank"> Google </a>', 'aai'),
      ),


    )

  ));

  // Banner section
  CSF::createSection($post_prefix, array(
    'title'  => esc_html__('Banner', 'aai'),
    'fields' => array(

      array(

        'id'      => 'banner_page_title',
        'type'    => 'text',
        'title'   => esc_html__('Page Banner', 'aai'),

      ),

      array(

        'id'      => 'banner_single_blog_image',
        'type'    => 'background',
        'title'   => esc_html__('Upload Background', 'aai'),
        'desc'    => esc_html__('Upload main Image width 1200px and height 400px.', 'aai'),
        'output' => '.page .aai-page-title-area',
        'output_important' => true

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
        'output' => '.page .aai-page-title-item nav ol li',
        'output_important' => true
      ),

      array(

        'id'     => 'banner_page_breadcrumb_link_color',
        'type'   => 'color',
        'title'  => esc_html__('Page Breadcrumb Link Color', 'aai'),
        'output' => '.page .aai-page-title-item nav ol li a',
        'output_important' => true
      ),


    )
  ));

  //
  // Header section
  CSF::createSection($post_prefix, array(
    'title'  => 'Header',
    'fields' => array(

      array(
        'id'      => 'header_style_override',
        'type'    => 'switcher',
        'title'   => esc_html__('Override Header', 'aai'),
        'desc'    => esc_html__('If you want to override header style you can set ( YES / NO )', 'aai'),
        'default' => false,
      ),

      array(
        'id'      => 'header_style',
        'type'    => 'image_select',
        'title'   => esc_html__('Header Style', 'aai'),
        'desc'    => esc_html__('Select the header style which you want to show on your website.', 'aai'),
        'options' => array(
          'style1'       => AAI_IMG . '/dash/header_style1.png',
          // 'style2'       => AAI_IMG . '/dash/header_style1.png',

        ),
        'default' => 'style1',
        'dependency' => array('header_style_override', '==', 'true'),
      ),


      array(
        'id'      => 'enable_button_override',
        'type'    => 'switcher',
        'title'   => esc_html__('Enable cta button', 'aai'),
        'desc'    => esc_html__('If you want to override Button option you can set ( YES / NO )', 'aai'),
        'default' => false,
      ),

      array(
        'type'    => 'subheading',
        'content' => esc_html__('Button Styling', 'aai'),
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'     => 'button_one_text_color',
        'type'   => 'color',
        'title'  => esc_html__('Login Button Color', 'aai'),
        'output' => '.page .aai-btn-box .login-btn',
        'output_important' => true,
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'     => 'button_one_icon_text_color',
        'type'   => 'color',
        'title'  => esc_html__('Login Icon Color', 'aai'),
        'output' => '.page .aai-btn-box .login-btn i',
        'output_important' => true,
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'               => 'button_one_bg_color',
        'type'             => 'color',
        'output_important' => true,
        'title'            => esc_html__('Login Button Background Color', 'aai'),
        'output'           => '.page .aai-btn-box .login-btn',
        'output_mode'      => 'background-color',
        'dependency' => array('enable_button_override', '==', TRUE),
      ),



      array(
        'id'     => 'button_one_border',
        'type'   => 'border',
        'title'  => esc_html__('Login Button Border', 'aai'),
        'output' => '.page .aai-btn-box .login-btn',
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'     => 'button_cta_text_color',
        'type'   => 'color',
        'title'  => esc_html__('Cta Button Color', 'aai'),
        'output' => '.page .aai-btn-box .main-btn',
        'output_important' => true,
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'               => 'button_cta_bg_color',
        'type'             => 'color',
        'output_important' => true,
        'title'            => esc_html__('Cta Button Background Color', 'aai'),
        'output'           => '.page .aai-btn-box .main-btn',
        'output_mode'      => 'background-color',
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'     => 'button_cta_border',
        'type'   => 'border',
        'title'  => esc_html__('Cta Button Border', 'aai'),
        'output' => 'body .aai-btn-box .main-btn',
        'dependency' => array('enable_button_override', '==', TRUE),
      ),

      array(
        'id'      => 'logo',
        'type'    => 'upload',
        'title'   => esc_html__('Upload Main Logo', 'aai'),
        'desc'    => esc_html__('Upload main logo width 180px and height 65px.', 'aai'),
        'default' => '',
        'help'    => esc_html__('Note: Please use logo image max width: 250px and max height 100px.', 'aai'),
      ),

      array(
        'id'      => 'sticky_logo',
        'type'    => 'upload',
        'title'   => esc_html__('Upload Sticky Logo', 'aai'),
        'desc'    => esc_html__('Upload sticky logo width 180px and height 65px.', 'aai'),
        'default' => '',
        'help'    => esc_html__('Note: Please use logo image max width: 250px and max height 100px.', 'aai'),
      ),

      array(
        'type'    => 'subheading',
        'content' => esc_html__('Menu Box', 'aai'),
      ),

      array(
        'id'          => 'menu_header_padding',
        'type'        => 'spacing',
        'title'   => esc_html__('Post Padding', 'aai'),
        'output'      => '.page .aai-header-area',
        'output_mode' => 'padding', // or margin, relative
        'default'     => array(
          'unit'      => 'px',
        ),
      ),

      array(
        'type'    => 'subheading',
        'content' => esc_html__('Menu Background', 'aai'),
      ),

      array(
        'id'      => 'menu_bg',
        'type'    => 'background',
        'title'   => esc_html__('Menu Background', 'aai'),
        'desc'    => esc_html__('Set the menu background form here.', 'aai'),
        'default' => array(
          'image'      => '',
          'repeat'     => 'repeat',
          'position'   => 'center center',
          'attachment' => 'scroll',
          'size'       => '',
          'color'      => '',
        ),
        'output_important' => true,
        'output' => '.page header'
      ),

      array(
        'id'      => 'sticky_bg',
        'type'    => 'background',
        'title'   => esc_html__('Menu Sticky Background', 'aai'),
        'desc'    => esc_html__('Set the menu sticky background form here.', 'aai'),
        'default' => array(
          'image'      => '',
          'repeat'     => 'repeat',
          'position'   => 'center center',
          'attachment' => 'scroll',
          'size'       => '',
          'color'      => '',
        ),
        'output_important' => true,
        'output'      => '.page .aai-header-area.sticky',
      ),

      array(
        'type'    => 'subheading',
        'content' => esc_html__('Menu Color', 'aai'),
      ),

      array(
        'id'      => 'menu_color',
        'type'    => 'color',
        'title'   => esc_html__('Menu Color', 'aai'),
        'desc'    => esc_html__('Set the menu color by color picker', 'aai'),
        'default' => '',
        'output'  => '.page .aai-header-main-menu ul > li > a',


      ),

      array(
        'id'      => 'menu_hover',
        'type'    => 'color',
        'title'   => esc_html__('Menu Hover Color', 'aai'),
        'desc'    => esc_html__('Set the menu hover color by color picker', 'aai'),
        'default' => '',

        'output'  => '.page .aai-header-main-menu ul > li:hover > a',

      ),

      array(
        'type'    => 'subheading',
        'content' => esc_html__('Menu Sticky Color', 'aai'),
      ),

      array(
        'id'      => 'menu_sticky__color',
        'type'    => 'color',
        'title'   => esc_html__('Menu Sticky Color', 'aai'),
        'desc'    => esc_html__('Set the menu sticky color by color picker', 'aai'),
        'default' => '',
        'output'  => '.page .sticky .aai-header-main-menu ul > li > a',

      ),

      array(
        'id'      => 'menu_sticky_hover_color',
        'type'    => 'color',
        'title'   => esc_html__('Menu Sticky Hover Color', 'aai'),
        'desc'    => esc_html__('Set the menu sticky color by color picker', 'aai'),
        'default' => '',
        'output'  => '.page .sticky .aai-header-main-menu ul > li:hover > a',

      ),

    )
  ));



  // newslatter
  CSF::createSection($post_prefix, array(
    'title'  => esc_html__('Footer', 'aai'),
    'fields' => array(

      array(
        'id'      => 'newslatter_enable',
        'type'    => 'switcher',
        'title'   => esc_html__('Enable Newslatter', 'aai'),
        'desc'    => esc_html__('If you want to override Newslatter Settings  you can set ( YES / NO )', 'aai'),
        'default' => true,
      ),


      array(
        'id'      => 'override_footer',
        'type'    => 'switcher',
        'title'   => esc_html__('Override Footer style', 'aai'),
        'desc'    => esc_html__('If you want to override Footer  Settings  you can set ( YES / NO )', 'aai'),
        'default' => false,
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
          'color'      => '',
        ),
        'output' => '.page .footer-area',

      ),

      array(
        'id'          => 'footer_sidebars_padding',
        'type'        => 'spacing',
        'title'   => esc_html__('Footer Padding', 'aai'),
        'output'      => '.page .footer-area',
        'output_mode' => 'padding', // or margin, relative
        'default'     => array(
          'unit'      => 'px',
        ),
      ),

      array(
        'id'          => 'footer_sidebars_margin',
        'type'        => 'spacing',
        'title'   => esc_html__('Footer Margin', 'aai'),
        'output'      => '.page .footer-area',
        'output_mode' => 'margin', // or margin, relative
        'default'     => array(
          'unit'      => 'px',
        ),
      ),

      array(
        'id'        => 'footer_topbar_layout',
        'type'      => 'image_select',
        'title'   => esc_html__('Footer Topbar Layout', 'aai'),
        'options'   => array(

          'layout-1' => AAI_IMG . '/admin/footer/topbar.png',
          'layout-2' => AAI_IMG . '/admin/footer/topbar-mailchimp.png',


        ),
        'default'   => 'layout-1'
      ),

      array(
        'id'    => 'topbar_2_background_image',
        'type'  => 'background',
        'title' => esc_html__('Topbar Background', 'aai'),
        'output' => '.page .footer-area .cta-wrapper,.page .footer-area .cta-mailchimp'
      ),

      array(
        'id'      => 'footer_topbar_title_color',
        'type'    => 'color',
        'title'   => esc_html__('Heading Color', 'aai'),
        'desc'    => esc_html__('Set footer Top bar title color form here.', 'aai'),
        'output' => '.page .footer-area .cta-wrapper h3, .page .footer-area .cta-mailchimp h3'
      ),

      array(
        'id'      => 'footer_topbar_button_color',
        'type'    => 'color',
        'title'   => esc_html__('Button Color', 'aai'),
        'desc'    => esc_html__('Set footer Top bar content color form here.', 'aai'),
        'output' => '.page .footer-area .cta-wrapper .btn',
        'dependency' => array('footer_topbar_layout', '==', 'layout-1'),
      ),


    )
  ));
  /*-----------------------------------
          CUSTOM CSS SECTION
      ------------------------------------*/
  CSF::createSection(
    $post_prefix,
    array(
      'title'  => esc_html__('Custom CSS', 'aai'),
      'parent' => 'Page_Meta_Tab',
      'fields' => array(
        array(
          'type'    => 'subheading',
          'content' => esc_html__('Page Custom Css', 'aai'),
        ),
        array(
          'id'       => 'page_cs_css',
          'type'     => 'code_editor',
          'desc'     => esc_html__('Write custom css here with css selector. this css will be applied in this page.', 'aai'),
          'settings' => array(
            'mode'        => 'css',
            'theme'       => 'dracula',
            'tabSize'     => 4,
            'smartIndent' => true,
            'autocorrect' => true,
          ),
        ),
      )
    )
  );
}
