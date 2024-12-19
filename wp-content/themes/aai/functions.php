<?php
/*----------------------------------------------------
LOAD COMPOSER PSR - 4
-----------------------------------------------------*/
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) :
    require_once dirname(__FILE__) . '/vendor/autoload.php';
endif;

/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME VERSION
-----------------------------------------------------*/
define('AAI_DEV_MODE', false);
if (AAI_DEV_MODE) {
    define('AAI_VERSION', time());
    define('AAI_SCRIPT_VAR', '.');
} else {
    define('AAI_VERSION', '1.0');
    define('AAI_SCRIPT_VAR', '.min.');
}


/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME ASSETS URL
-----------------------------------------------------*/
define('AAI_THEME_URI', get_template_directory_uri());
define('AAI_IMG', AAI_THEME_URI . '/assets/images');
define('AAI_CSS', AAI_THEME_URI . '/assets/css');
define('AAI_JS', AAI_THEME_URI . '/assets/js');

/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME ASSETS DIRECTORY PATH
-----------------------------------------------------*/
define('AAI_THEME_DIR', get_template_directory());
define('AAI_IMG_DIR', AAI_THEME_DIR . '/assets/images');
define('AAI_CSS_DIR', AAI_THEME_DIR . '/assets/css');
define('AAI_JS_DIR', AAI_THEME_DIR . '/assets/js');

// option prefix
define('AAI_OPTION_KEY', 'aai_settings');
/*----------------------------------------------------
SET UP THE CONTENT WIDTH VALUE BASED ON THE THEME'S DESIGN
-----------------------------------------------------*/

// hooks for unyson framework
// ----------------------------------------------------------------------------------------
function aai_framework_customizations_dir_rel_path($rel_path)
{

    return '/app/Core/Hook';
}
add_filter('fw_framework_customizations_dir_rel_path', 'aai_framework_customizations_dir_rel_path');

if (!isset($content_width)) {
    $content_width = 800;
}
if (class_exists('Aai\\Init')) :
    Aai\Init::register_services();
endif;

/*----------------------------------------------------
Remove core plugin after theme deactivated
-----------------------------------------------------*/

add_action('switch_theme', 'remove_plugin');

function remove_plugin()
{
    $essential_plugin = 'aai-essential/aai-essential.php';
    $core_plugin = 'aai-core/index.php';

    if (in_array($essential_plugin, apply_filters('active_plugins', get_option('active_plugins'))) && in_array($core_plugin, apply_filters('active_plugins', get_option('active_plugins')))) {
        deactivate_plugins([$essential_plugin, $core_plugin]);
    }
}

/*----------------------------------------------------
Set permalink to post after theme activated
-----------------------------------------------------*/

add_action('after_setup_theme', 'reset_permalinks');
function reset_permalinks()
{
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}


/*----------------------------------------------------
UTILITY
-----------------------------------------------------*/
require_once AAI_THEME_DIR . '/app/Utility/global.php';
require_once AAI_THEME_DIR . '/app/Utility/Helpers.php';
require_once AAI_THEME_DIR . '/app/Utility/template-tags.php';

/*----------------------------------------------------
option init
-----------------------------------------------------*/
require_once AAI_THEME_DIR . '/app/Option/Init.php';
require_once AAI_THEME_DIR . '/woocommerce/woo-setup.php';
