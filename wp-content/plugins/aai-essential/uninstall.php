<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package quomodoform
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Access the database via SQL
global $wpdb;
