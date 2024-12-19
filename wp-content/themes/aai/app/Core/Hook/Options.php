<?php

namespace Aai\Core\Hook;

/**
 * Option.
 */
class Options
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action('admin_menu', [$this, 'remove_fw_settings'], 999);
		add_filter('csf_welcome_page', '__return_false');
	}

	public function remove_fw_settings()
	{
		remove_submenu_page('themes.php', 'fw-settings');
	}
}
