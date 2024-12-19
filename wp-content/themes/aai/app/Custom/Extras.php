<?php

namespace Aai\Custom;

/**
 * Extras.
 */
class Extras
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_filter('body_class', array($this, 'body_class'));
		add_action('wp_head', array($this, 'pingback_header'));
	}

	public function body_class($classes)
	{

		// Adds a class of group-blog to blogs with more than 1 published author.
		if (is_multi_author()) {
			$classes[] = 'group-blog';
		}
		if (!is_singular()) {
			$classes[] = 'hfeed';
		}

		if (is_active_sidebar('sidebar-1')) {
			$classes[] = 'sidebar-active';
		} else {
			$classes[] = 'sidebar-inactive';
		}
		$header_footer = aai_option('disable_header_footer', false);

		if ($header_footer) {
			$classes[] = 'offcanvas-no-header-footer';
		}
		return $classes;
	}

	public function pingback_header()
	{
		if (is_singular() && pings_open()) {
			printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
		}
	}
}
