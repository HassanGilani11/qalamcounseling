<?php
/**
 * Elementor Template
 * override from elementor elementor/modules/pagetemplates/canvas
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-canvas' );

?>
<!DOCTYPE html>

    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
            <title> <?php echo esc_html(wp_get_document_title()); ?> </title>
        <?php endif; ?>
        <?php
         wp_head();
         echo \Elementor\Utils::get_meta_viewport( 'canvas' );
         ?>
    </head>

    <body <?php body_class('element-ready-offcanvas'); ?>>
        <?php

         Elementor\Modules\PageTemplates\Module::body_open();

        /**
         * Before canvas page template content.
         *
         * Fires before the content of Elementor canvas page template.
         *
         * @since 1.0.0
         */
        do_action( 'elementor/page_templates/canvas/before_content' );

        do_action( 'element_ready_act_tpl_search' );

        ?>

        <?php 
        /**
	 * After canvas page template content.
	 *
	 * Fires after the content of Elementor canvas page template.
	 *
	 * @since 1.0.0
	 */
        do_action( 'elementor/page_templates/canvas/after_content' );

        wp_footer();

	?>

	</body>
</html>