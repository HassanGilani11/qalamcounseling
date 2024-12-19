<?php

/**
 * @package  aai-essential
 */

namespace AaiEssential\Base;

class Deactivate
{
	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
