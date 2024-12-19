<?php

/**
 * @package  aai-essential
 */

namespace AaiEssential\Base;

class Activate
{
	public static function activate()
	{
		flush_rewrite_rules();
	}
}
