<?php

namespace AaiEssential\Api;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class ElementorPlugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{

		wp_enqueue_script('aai-essential-elementor', AAI_ESSENTIAL_PLUGIN_URL . 'assets/js/elementor.js', ['jquery', 'aai-main'], 1.0, true);

		$aai_data = [
			'ajax_url'     => admin_url('admin-ajax.php'),
			'loading_text' => esc_html__('loading', 'aai-essential'),
		];

		wp_localize_script('aai-essential-elementor', 'aai_essential_obj', $aai_data);
	}


	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets()
	{

		$path    = AAI_ESSENTIAL_PLUGIN_PATH . "/app/Widgets";
		$widgets = aai_widgets_class_list($path);

		if (!is_array($widgets)) {
			return;
		}

		// Register Widgets
		foreach ($widgets as $widget_cls) {

			$cls = '\AaiEssential\Widgets' . '\\' . $widget_cls;
			if (class_exists($cls)) :

				\Elementor\Plugin::instance()->widgets_manager->register(new $cls());
			endif;
		}
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		add_action('elementor/init', array($this, 'add_category'));
		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);
	}

	public function add_category()
	{

		\Elementor\Plugin::$instance->elements_manager->add_category(
			'aai-elements',
			[
				'title' => esc_html__('aai-essential', 'aai-essential'),
				'icon' => 'fab fa-accusoft',
			],
			1
		);
	}
}

// Instantiate Plugin Class
