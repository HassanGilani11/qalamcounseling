<?php

namespace Aai\Setup;

/**
 * Enqueue.
 */
class Enqueue
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	public function enqueue_scripts()
	{


		// stylesheets
		// ::::::::::::::::::::::::::::::::::::::::::
		if (!is_admin()) {
			// wp_enqueue_style() $handle, $src, $deps, $version

			// 3rd party css
			wp_enqueue_style('aai-fonts', aai_google_fonts_url(['Sora:300,400,500,600,700,900']), null, AAI_VERSION);
			wp_enqueue_style('fontawesome', AAI_CSS . '/font-awesome.min.css', null, AAI_VERSION);
			wp_enqueue_style('bootstrap', AAI_CSS . '/bootstrap.min.css', null, AAI_VERSION);
			wp_enqueue_style('animate', AAI_CSS . '/animate.min.css', null, AAI_VERSION);
			wp_enqueue_style('slick', AAI_CSS . '/slick.min.css', null, AAI_VERSION);
			wp_enqueue_style('magnific-popup', AAI_CSS . '/magnific-popup.css', null, AAI_VERSION);
			// theme css
			wp_enqueue_style('aai-custom-animate', AAI_CSS . '/custom-animation.min.css', null, AAI_VERSION);
			wp_enqueue_style('aai-default', AAI_CSS . '/default.min.css', null, time());
			wp_enqueue_style('aai-style', AAI_CSS . '/style' . AAI_SCRIPT_VAR . 'css', null, time());
			wp_enqueue_style('aai-blog', AAI_CSS . '/blog' . AAI_SCRIPT_VAR . 'css', null, time());
			wp_enqueue_style('aai-responsive', AAI_CSS . '/responsive' . AAI_SCRIPT_VAR . 'css', null, time());
		}

		// javascripts
		// :::::::::::::::::::::::::::::::::::::::::::::::
		if (!is_admin()) {

			// 3rd party scripts
			wp_enqueue_script('popper', AAI_JS . '/popper.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('bootstrap', AAI_JS . '/bootstrap.min.js', array('jquery', 'popper'), AAI_VERSION, true);
			wp_enqueue_script('slick', AAI_JS . '/slick.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('magnific-popup', AAI_JS . '/jquery.magnific-popup.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('tweenmax', AAI_JS . '/TweenMax.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('waypoints', AAI_JS . '/waypoints.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('goodshare', AAI_JS . '/goodshare.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('gsap', AAI_JS . '/gsap.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('ScrollTrigger', AAI_JS . '/ScrollTrigger.min.js', array('jquery'), AAI_VERSION, true);
			wp_enqueue_script('wow', AAI_JS . '/wow.js', array('jquery'), AAI_VERSION, true);

			// theme scripts

			wp_enqueue_script('aai-main', AAI_JS . '/main' . AAI_SCRIPT_VAR . 'js', array('jquery', 'bootstrap', 'magnific-popup', 'wow', 'waypoints', 'slick', 'tweenmax'), time(), true);
			// Load WordPress Comment js
			if (is_singular() && comments_open() && get_option('thread_comments')) {
				wp_enqueue_script('comment-reply');
			}
		}
	}
}
