<?php

namespace Element_Ready_Pro;

use Element_Ready_Pro\Modules\ShortCodeBuilder\Init as WidgetBuilder;
use Element_Ready_Pro\Modules\elefinder\Service as Elefinder;
use Element_Ready_Pro\Modules\Blog\Init as Blog;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{
		$a1 = [

			Base\Assets::class,

			Base\Sections\Conditional_Section::class,
			Base\Sections\Conditional_Widgets::class,
			Base\Sections\Image_Masking::class,
			Base\Sections\Icon_Box::class,
			Base\Sections\Widget_Custom_Control::class,

			Base\Sections\Protected_Widgets::class,
			Base\Sections\Custom_Shapes::class,
			Base\Sections\Widget_Text_Strok::class,
			Base\Sections\Heading::class,
			Base\Sections\Widget_Overlay::class,
			Base\Sections\Widget_Wrapper::class,

			Base\Sections\LiveCopy::class,
			Base\Crd\LiveCopy::class,
			Base\Settings\Page::class,

			Base\Crd\Clipboard::class,
			Base\Post\Generel_Controls::class,
			Base\Post\Blog_Search_List::class,
			Base\Post\Blog_Meta::class,
			Base\Post\Element_Ready_Post_Meta::class,

		];

		$a2 = [

			//elementor

			Base\Widget_Extend\Box_Widget_Extend::class,
			Base\Widget_Extend\Animate_Headline_Extend::class,
			Base\Widget_Extend\Advanced_Accordion_Extend::class,
			Base\Widget_Extend\Business_Hours_Extend::class,
			Base\Widget_Extend\Copyright_Text_Extend::class,
			Base\Widget_Extend\Counter_Extend::class,
			Base\Widget_Extend\Dual_Text_Extend::class,
			Base\Widget_Extend\Infobox_Extend::class,
			Base\Widget_Extend\Infotext_Box_Extend::class,
			Base\Widget_Extend\Price_Table_Extend::class,
			Base\Widget_Extend\Teams_Extend::class,
			Base\Widget_Extend\Testimonial_Extend::class,
			Base\Widget_Extend\Portfolio_Extend::class,

			// custom post type

			Base\CPT\Section_Custom_Shape::class,


		];

		$all = apply_filters('element_ready_pro_extend_modules', $a2);
		$w_class = array_merge($a1, $all);
		return $w_class;
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

		// if (self::element_ready_get_modules_option('shortcode_builder')) {

		// 	if (class_exists('Element_Ready_Pro\Modules\ShortCodeBuilder\Init')) {
		// 		WidgetBuilder::register_services();
		// 	}
		// }

		// Elefinder::register_services();

		if (self::element_ready_get_modules_option('blog_page_builder')) {
			Blog::register_services();
		}
	}

	static function element_ready_get_modules_option($key = false)
	{

		$option = get_option('element_ready_modules');
		if ($option == false) {
			return false;
		}
		return isset($option[$key]) && $option[$key] == 'on' ? true : false;
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
