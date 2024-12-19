<?php

final class Element_Ready_Pro_Elementor_Extension {
	
	use \Element_Ready_Pro\Base\Traits\Helper;
	const VERSION                   = '2.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.4';
	const MINIMUM_PHP_VERSION       = '7.0';
	public  $service                  = null;
	private static $_instance         = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'init' ] );
		
	}
	
	public function init() {
		
       
		load_plugin_textdomain( 'quomodo-core' );
		/*---------------------------------
			Check if Elementor installed and activated
		-----------------------------------*/
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		$this->service = apply_filters( 'element_ready_pro_service', true );

		/*---------------------------------
			Check for required Elementor version
		----------------------------------*/
		if( !did_action( 'element_ready_loaded' )){
			
			add_action( 'admin_notices', [ $this, 'element_ready_load_notice' ] );
			return;
		}



		/*----------------------------------
			Check for required PHP version
		-----------------------------------*/
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		if (file_exists(dirname(__FILE__) . '/inc/helper_functions.php' )) {
			require_once(dirname(__FILE__) . '/inc/helper_functions.php' );
		}
        $this->includes();
		/*----------------------------------
			ADD NEW ELEMENTOR CATEGORIES
		------------------------------------*/
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );
		
		/*----------------------------------
			ADD PLUGIN WIDGETS ACTIONS
		-----------------------------------*/
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		
		/*----------------------------------
			ELEMENTOR REGISTER CONTROL
		-----------------------------------*/
		/*add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );*/	

		/*----------------------------------
			EDITOR STYLE
		----------------------------------*/
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'element_ready_editor_styles' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'element_ready_editor_script' ] );
		
		/*----------------------------------
			ENQUEUE DEFAULT SCRIPT
		-----------------------------------*/
		add_action( 'wp_enqueue_scripts', array ( $this, 'element_ready_default_scripts' ) );
		
	
		/*---------------------------------
			REGISTER FRONTEND SCRIPTS
		----------------------------------*/
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'element_ready_register_frontend_scripts' ] );
	
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'element_ready_register_frontend_styles' ]);
		
		/*--------------------------------
			ENQUEUE FRONTEND SCRIPTS
		---------------------------------*/
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'element_ready_enqueue_frontend_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'element_ready_enqueue_frontend_style' ],20 );
	
	}


	/*******************************
	 * 	ADD ASSETS
	 *******************************/

	public function element_ready_editor_styles(){

	
		wp_enqueue_style( 'element-ready-pro-editor', ELEMENT_READY_PRO_ROOT_CSS . 'element-raedy-pro-editor.css' );
		wp_register_style( 'select2', ELEMENT_READY_PRO_ROOT_CSS . 'select2.min.css' );
		
	}

	/**
	 * Enqueue Default Style and Scripts
	 *
	 * Enqueue custom Scripts required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function element_ready_default_scripts(){

		if( $this->element_ready_get_modules_option('blog_page_builder') ){

			wp_register_style( 'er-blog-post-comment', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-blog-comment.css',[], time() );
			wp_register_style( 'er-blog-post-navigation', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-post-navigation.css',[], time() );
			wp_register_style( 'er-blog-tags', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-blog-tags.css',[], time() );
			wp_register_style( 'er-blog-single-meta', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-blog-single-meta.css',[], time() );
			wp_register_style( 'er-blog-post-thumb', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-blog-post-thumb.css',[], time() );
			wp_register_style( 'er-blog-post-list', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-post-list.css',[], time() );
			wp_register_style( 'er-pro-blog-pagination', ELEMENT_READY_PRO_ROOT_CSS . 'widgets/er-pro-blog-pagination.css',[], time() );
			wp_register_style( 'er-blog-module', ELEMENT_READY_PRO_ROOT_CSS . 'er-pro-blogs.css',[], time() );
		
		}
		
		wp_register_script( 'select2', ELEMENT_READY_PRO_ROOT_JS . 'select2.min.js', array('jquery'), ELEMENT_READY_PRO_VERSION, true );
		wp_register_script( 'element-ready-pro-widget', ELEMENT_READY_PRO_ROOT_JS . 'pro.js', array('jquery'), time(), true );
		wp_register_style( 'element-ready-pro-widget', ELEMENT_READY_PRO_ROOT_CSS . 'pro.css');
		wp_register_style( 'jplayer-playlist', ELEMENT_READY_PRO_ROOT_CSS . 'jplayer-playlist.css');
		wp_register_style( 'jplayer-pink-flag', 'https://jplayer.org/latest/dist/skin/pink.flag/css/jplayer.pink.flag.min.css' );
        
		wp_register_script( 'jplayer', 'https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js', array('jquery'), '2.9.2', true );
        wp_register_script( 'jplayer-playlist', 'https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/add-on/jplayer.playlist.min.js', array('jquery'), '2.9.2', true );
	
	}

	public function element_ready_editor_script(){

		if( $this->element_ready_get_modules_option('live_copy') ) { 	

			wp_enqueue_script(
				'element-ready-pro-local-storage',
				ELEMENT_READY_PRO_ROOT_JS . 'element-ready-localstorage.js',
				null,
				1.0,
				true
			);

		// Cross-Site-Copy-Paste
			wp_enqueue_script(
				'element-raedy-pro-cp',
				ELEMENT_READY_PRO_ROOT_JS . 'el-cp.js',
				[ 'jquery', 'elementor-editor','element-ready-pro-local-storage' ],
				1.0,
				true
			);
	
			wp_enqueue_script( 'element-ready-pro-editor', ELEMENT_READY_PRO_ROOT_JS . 'element-raedy-pro-editor.js', array('jquery','elementor-editor'), ELEMENT_READY_PRO_VERSION, true );
		
			wp_localize_script( 'element-raedy-pro-cp', 'ercp', array(
				'ajaxurl'             => admin_url( 'admin-ajax.php' ),
				'script_url'          => 'https://plugins.quomodosoft.com/api.html',
				'copy'                => esc_html__( 'ER Copy', 'element-ready-pro' ),
				'paste'               => esc_html__( 'ER Paste', 'element-ready-pro' ),
				'copy_all'            => esc_html__( 'ER Copy All', 'element-ready-pro' ),
				'paste_all'           => esc_html__( 'ER Paste All', 'element-ready-pro' ),
				'live_paste'           => esc_html__( 'ER Live Paste', 'element-ready-pro' ),
				'elementorCompatible' => false
			
			) );
		}
	}

	/**
	 * Enqueue Widget Scripts
	 *
	 * Enqueue custom Scripts required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function element_ready_enqueue_frontend_scripts(){
		
		if( $this->element_ready_get_modules_option('live_copy') ) { 
			wp_enqueue_script( 'element-ready-global-live-copy', ELEMENT_READY_PRO_ROOT_JS . 'live-copy-btn.js', array('jquery','wp-util','element-ready-pro-local-storage'), ELEMENT_READY_VERSION, true );
			wp_localize_script( 'element-ready-global-live-copy', 'ercp', array(
				'script_url' => 'https://plugins.quomodosoft.com/api.html',
				'ajaxurl' => admin_url( 'admin-ajax.php' )
			) );
		}
		
	}


	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Skima Core.
	 *
	 * @since 1.6.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function element_ready_register_frontend_scripts() {

		if( $this->element_ready_get_modules_option('live_copy') ) { 

			wp_register_script(
				'element-ready-pro-local-storage',
				ELEMENT_READY_PRO_ROOT_JS . 'element-ready-localstorage.js',
				null,
				1.0,
				true
			);

		}

	}

	/**
	 * Enqueue Widget Styles
	 *
	 * Enqueue custom styles required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function element_ready_enqueue_frontend_style() {

		
	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	
	public function element_ready_register_frontend_styles(){
		
	}
	function plugin_activation_link_url($plugin='element-ready-lite/index.php')
	{
		// the plugin might be located in the plugin folder directly

		$activateUrl = sprintf(admin_url('plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1&s'), $plugin);

		// change the plugin request to the plugin to pass the nonce check
		$_REQUEST['plugin'] = $plugin;
		$activateUrl = wp_nonce_url($activateUrl, 'activate-plugin_' . $plugin);

		return $activateUrl;
	}

	/***************************
	 * 	VERSION CHECK
	 * *************************/
	public function element_ready_load_notice() {

		$con = esc_html__( 'Click to Install', 'element-ready-pro');
		if( file_exists(plugin_dir_path(__DIR__) .'element-ready-lite/index.php' ) ) {
			$er_url = $this->plugin_activation_link_url();
			$con = esc_html__( 'Click to Activate', 'element-ready-pro');
			
		}else{
			$con = esc_html__( 'Click to Install', 'element-ready-pro');
			$action = 'install-plugin';
			$slug = 'element-ready-lite';
			$er_url = wp_nonce_url(
				add_query_arg(
					array(
						'action' => $action,
						'plugin' => $slug
					),
					admin_url( 'update.php' )
				),
				$action.'_'.$slug
			);
		}
	
      
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		if ( in_array( 'element-ready-lite/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s"', 'element-ready-pro' ),
				'<strong>' . esc_html__( 'Element Ready Core', 'element-ready-pro' ) . '</strong>',
				'<strong>' . esc_html__( 'Element Ready Lite', 'element-ready-pro' ) . '</strong>'
			);
		}else{

			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" %3$s', 'element-ready-pro' ),
				'<strong>' . esc_html__( 'Element Ready Core', 'element-ready-pro' ) . '</strong>',
				'<strong>' . esc_html__( 'Element Ready Lite', 'element-ready-pro' ) . '</strong>',
				'<strong> <a href="'.$er_url.'">' . $con  . '</a></strong>'
				
			);
		}
	

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}


	/**************************
	 * 	MISSING NOTICE
	 ***************************/
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'element-ready-pro' ),
			'<strong>' . esc_html__( 'Element Ready Core', 'element-ready-pro' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'element-ready-pro' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/****************************
	 * 	PHP VERSION NOTICE
	 ****************************/
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'element-ready-pro' ),
			'<strong>' . esc_html__( 'Element Ready Core', 'element-ready-pro' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'element-ready-pro' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/****************************
	 * 	INIT WIDGETS
	 ****************************/
	public function init_widgets() {
		$this->element_ready_widgets();
		$this->element_ready_widgets_register();
	}

	public function element_ready_widgets(){
	
		/*
		** Autoload Widget class
		** 
		*/

		$widget_path = ELEMENT_READY_PRO_DIR_PATH."/inc/Widgets";
		$widgets     = element_ready_widgets_class_list($widget_path);
       
		if( is_array($widgets) ){

			// Register Widgets
			foreach($widgets as $widget_cls){
				
				$cls = '\Element_Ready_Pro\Widgets'.'\\'.$widget_cls;
				if( class_exists( $cls ) ):
					\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $cls() );
				endif;	
				
			}
		}

		$this->widget_modules();

	}
	
	public function element_ready_get_dir_list($path = 'Widgets'){

        $widgets_modules = [];
        $dir_path        = ELEMENT_READY_PRO_DIR_PATH."inc/".$path;
        $dir             = new \DirectoryIterator($dir_path);
         
         foreach ($dir as $fileinfo) {

             if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                 $widgets_modules[$fileinfo->getFilename()] = $fileinfo->getFilename();
                
            }
        }

        return apply_filters( 'element_ready_pro_widgets_modules', $widgets_modules);
    }

	public function widget_modules(){

		include( ELEMENT_READY_DIR_PATH . '/inc/dashboard/controls/active.php' );

		$return_active = apply_filters( 'element_ready_pro_active_widget', $return_active );
	    $widgets_modules = $this->element_ready_get_dir_list();
		
		foreach($widgets_modules as $path => $value) {

			$widget_path = ELEMENT_READY_PRO_DIR_PATH."/inc/Widgets/".$path;
			$widgets     = element_ready_widgets_class_list($widget_path);
				 	
			if( is_array($widgets) ){

				// Register Widgets
				foreach($widgets as $widget_cls){
				
					if(in_array($widget_cls,$return_active) ){
						
						$cls = '\Element_Ready_Pro\Widgets'.'\\'.$path.'\\'.$widget_cls;
						
						if(class_exists($cls) && $this->service):
							\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $cls() );
						endif;	
				    }
				
				}
			}

		}
	}

	public function element_ready_widgets_register(){

		/**
		 * NOTE: If you use ( use \Elementor\Plugin as Plugin; ) you need to set namespace before instansiate in widget register.
		 * Like Plugin::instance()->widgets_manager->register_widget_type( new Widget_Class() );
		 * and If you use ( namespace Elementor ) No need instansiate in widget register.
		 * Like Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_Class() );
		 */
	}

	/******************************
	 * 	INIT CONTROLS
	 ******************************/
	public function init_controls() {
		/*---------------------------
			Include Control files
		---------------------------*/
		//require_once( __DIR__ . '/controls/control.php' );

		/*---------------------------
			Register control
		---------------------------*/
		//Plugin::$instance->controls_manager->register_control( 'control-type-', new \Element_Ready_Control() );
	}

	/*******************************
	 * 	ADD CUSTOM CATEGORY
	 *******************************/
	public function add_elementor_category()
	{

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		\Elementor\Plugin::instance()->elements_manager->add_category( 'element-ready-pro', array(
			'title' => esc_html__( 'Element Ready Pro', 'element-ready-pro' ),
			'icon'  => 'fa fa-plug',
		), 1 );
	}


	/******************************
	 * 	ALL INCLUDES
	******************************/
	public function includes() {

	 
	   if ( class_exists( '\Element_Ready_Pro\\Init' ) ) {
	    
			\Element_Ready_Pro\Init::register_services();
			\Element_Ready_Pro\Init::register_modules();
		}
	}
}

Element_Ready_Pro_Elementor_Extension::instance();
