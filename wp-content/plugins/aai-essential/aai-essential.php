<?php
/*
* Plugin Name: AaiEssentials
* License - GNU/GPL V2 or Later
* Description: This is a essential plugin for Aai Wordpress theme.
* Version: 1.0.0
* text domain: aai-essential
*/

// If this file is calledd directly, abort!!!
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

// Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}
// Require option library
if (file_exists(dirname(__FILE__) . '/app/Framework/codestar-framework.php')) {
	require_once dirname(__FILE__) . '/app/Framework/codestar-framework.php';
}
/** 
 * plugin constant
 */

define('AAI_ESSENTIAL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('AAI_ESSENTIAL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AAI_ESSENTIAL_PLUGIN', plugin_basename(dirname(__FILE__)) . '/aai-essential.php');
define('AAI_ESSENTIAL_IMG', get_template_directory_uri() . '/assets/images');

/**
 * The code that runs during plugin activation
 */

function aai_activate_essential_plugin()
{
	AaiEssential\Base\Activate::activate();
}

register_activation_hook(__FILE__, 'aai_activate_essential_plugin');

/**
 * The code that runs during plugin deactivation
 */

function aai_deactivate_essential_plugin()
{
	AaiEssential\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'aai_deactivate_essential_plugin');

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('AaiEssential\\Init')) {

	AaiEssential\Init::register_services();
	AaiEssential\Init::register_modules();
}
