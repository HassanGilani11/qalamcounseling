<?php

/**
 * @package  quomodo
 */

namespace AaiEssential\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public function __construct()
	{
		$this->plugin_path = AAI_ESSENTIAL_PLUGIN_PATH;
		$this->plugin_url  = AAI_ESSENTIAL_PLUGIN_URL;
		$this->plugin      = AAI_ESSENTIAL_PLUGIN;
	}
}
