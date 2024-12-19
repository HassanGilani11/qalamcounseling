<?php

/**
 * Plugin Name: Aai Core
 * Description: Aai Core For Elementor is a full plugin for colleciton of elementor widgets.
 * Plugin URI: http://quomodosoft.com/plugins/element-ready-addon-elementor
 * Author: QuomodoSoft
 * Author URI: http://quomodosoft.com
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: element-ready
 * Domain Path: /languages/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (defined('ELEMENT_READY_PRO')) {
} else {

	// Require once the Composer Autoload
	if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
		require_once dirname(__FILE__) . '/vendor/autoload.php';
	}


	/**
	 * PUGINS MAIN PATH CONSTANT
	 */
	define('ELEMENT_READY_PRO_VERSION', '5.3');
	define('ELEMENT_READY_PRO', TRUE);
	define('ELEMENT_READY_PRO_ROOT', dirname(__FILE__));

	define('ELEMENT_READY_PRO_URL', plugins_url('/', __FILE__));
	define('ELEMENT_READY_PRO_ROOT_JS', plugins_url('/assets/js/', __FILE__));
	define('ELEMENT_READY_PRO_ROOT_CSS', plugins_url('/assets/css/', __FILE__));
	define('ELEMENT_READY_PRO_ROOT_ICON', plugins_url('/assets/icons/', __FILE__));
	define('ELEMENT_READY_PRO_ROOT_IMG', plugins_url('/assets/img/', __FILE__));

	define('ELEMENT_READY_PRO_DIR_URL', plugin_dir_url(__FILE__));
	define('ELEMENT_READY_PRO_DIR_PATH', plugin_dir_path(__FILE__));
	define('ELEMENT_READY_PRO_BASE', plugin_basename(ELEMENT_READY_PRO_ROOT));
	define('ELEMENT_READY_PRO_DEMO_URL', 'https://plugins.quomodosoft.com/element-ready/');

	do_action('element_ready_pro_init');
	require_once(ELEMENT_READY_PRO_DIR_PATH . '/boot.php');

	register_activation_hook(__FILE__, 'element_ready_pro_flush_rewrites');
	function element_ready_pro_flush_rewrites()
	{
		flush_rewrite_rules();
	}
}
