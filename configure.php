<?php
/**
 * WPtap options default setting.
 *
 * @package WPtap
 */

// options default setting
global $wptap_default_settings;
$wptap_default_settings = array(
	'name' => 'Wptap',
	'site_icon' => 'Default',

	'enable_home' => 1,
	'header_font_color' => '#0000ff',

	'menus' => array('enable_category', 'enable_pages', 'enable_search', 'enable_login'),
	'enable_category' => 1,
	'enable_pages' => 1,
	'enable_search' => 1,
	'enable_login' => 1,

	'show_author' => 1,
	'show_date' => 1,
	'show_cat' => 1,
	'show_tag' => 1,
	
	'ad_position' => 'top',
	'ad_post_position' => 'top',
	'ad_class' => 'google',
	'ad_type' => 1,
);
?>