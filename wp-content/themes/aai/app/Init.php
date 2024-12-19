<?php

namespace Aai;

/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/custom/custom.php` to write your custom functions
 *
 * @package aai
 */



final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{
		return [

			Core\Hook\Options::class,
			Core\Tags::class,
			Core\Hook\Blog::class,
			Core\Hook\Required_Plugins::class,
			Core\Hook\Demo::class,
			Core\Sidebar::class,
			Core\Footer::class,
			Setup\Setup::class,
			Setup\Menus::class,
			Setup\Enqueue::class,
			Setup\InlineStyle::class,
			Custom\Extras::class,

		];
	}

	/**
	 * Loop through the classes, initialize them, and call the register() method if it exists
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

	/**
	 * Initialize the class
	 * @param  class $class 		class from the services array
	 * @return class instance 		new instance of the class
	 */
	private static function instantiate($class)
	{
		return new $class();
	}
}
