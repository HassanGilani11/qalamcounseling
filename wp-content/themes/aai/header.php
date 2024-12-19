<?php

/**
 * The qomodo header template for the theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open();
    ?>

    <?php

    // header style option     
    $header_style             = aai_option('header_style', 'style1');
    $header_footer            = aai_option('disable_header_footer', false);
    $page_override_header     = aai_meta_option(get_the_ID(), 'header_style_override');
    $page_header_layout_style = aai_meta_option(get_the_ID(), 'header_style', 'style1');

    if ($page_override_header) :
        $header_style = $page_header_layout_style;
    endif;

    if (is_404()) {

        if (!$header_footer) {
            get_template_part('template-parts/headers/header', $header_style);
        }
    } else {
        get_template_part('template-parts/headers/header', $header_style);
    }


    ?>

    <div class="quomodo-body-innner-content">