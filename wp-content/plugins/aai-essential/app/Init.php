<?php

/**
 * @package  aai-essential
 */

namespace AaiEssential;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{
		return [

			Base\Enqueue::class,
			Base\Preloader::class,
			Api\ElementorQuomodoEssentialExtension::class,

			// WP widgets

			Base\WPWidgets\Gallery::class,


		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services()
	{
		foreach (self::get_services() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	public static function register_modules()
	{

		require_once dirname(__FILE__) . '/Utilities/Widgets/Social.php';
		require_once dirname(__FILE__) . '/Utilities/Widgets/Recent_Post.php';
		require_once dirname(__FILE__) . '/Utilities/Widgets/Contact_Info.php';
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate($class)
	{
		$service = new $class();

		return $service;
	}
}
