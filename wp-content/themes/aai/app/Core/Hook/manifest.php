<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

$manifest = array();

$manifest['name']         = esc_html__('aai', 'aai');
$manifest['uri']          = esc_url('https://quomodosoft.com/');
$manifest['description']  = esc_html__('Aai is a Business Consulting WordPress Theme', 'aai');
$manifest['version']      = '1.0';
$manifest['author']       = 'quomodotheme';
$manifest['author_uri']   = esc_url('https://themeforest.net/user/quomodotheme');
$manifest['requirements'] = array(
	'wordpress' => array(
		'min_version' => 5.0,
	),
);

$manifest['id'] = 'scratch';

$manifest['supported_extensions'] = array(
	'backups'		 => array(),
);
