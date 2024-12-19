<?php
namespace Element_Ready_Pro\Modules\Blog;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
	
		return [
			Custom_Post_Type\Template_Type::class,
			Settings\Meta::class,
			Settings\Blog_Comment::class,
			Templates\Error_Page::class,
			Templates\Post::class,
			Templates\Blog::class,
			Templates\Archive::class,
			Templates\Tag::class,
			Templates\Author::class,
			Templates\Category::class,
			Templates\Search::class,
			Templates\Search_No_Result::class,
		];

	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		 
        self::defined_module_cons();
        
		foreach ( self::get_services() as $class ) {
			
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
			
		}
	}
 
	
	public static function defined_module_cons(){
      
		define( 'ELEMENT_READY_BLOG_MODULE_PATH', plugin_dir_path( __FILE__ ) );
		define( 'ELEMENT_READY_BLOG_MODULE_URL', plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();
		return $service;
	}
}



