<?php
/**
 * @package WPtap
 */
/**
 Plugin Name: WPtap-Themes/Plugin (Beta)
 Plugin URI: http://www.iphonemofo.net/index.php/wptap/
 Description: A plugin/theme package that converts your wordpress site into a web-application, specially designed for Apple iPhone and Apple iPod touch, or Blackberry touch mobile device. Set options for the theme by visiting the WPtap admin panel.

 Version: 1.0.2
 Author: WPtap Development Team
 Author URI: http://www.iphonemofo.net/
*/

define('WPTAP_PLUGIN_NAME', 'wptap-news-press-themeplugin-for-iphone');
if(!defined('WPTAP_PLUGIN_PATH')) {
	define('WPTAP_PLUGIN_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

$wptap_plugin_dir_name = 'plugins'; // plugin dir name

require(WPTAP_PLUGIN_PATH . 'path.php'); // path define file
require(WPTAP_PLUGIN_PATH . 'configure.php'); // configure file

require(WPTAP_INCLUDE_PATH . 'function.php'); // general function file

require(WPTAP_INCLUDE_PATH . 'wptap.class.php'); // plugin kernel class

global $wptap_plugin;
$wptap_plugin = new WPtapPlugin();

require_once(WPTAP_INCLUDE_PATH . 'templates.php'); // template function file


add_action('wp_head', 'wptap_switch_css');
add_action('wp_footer', 'wptap_switch');

if(is_admin()) {
	require(WPTAP_INCLUDE_PATH . 'options.php'); // include options.php
	require(WPTAP_PLUGIN_ADMIN_PATH . 'loader.php');
	
	if(isset($_GET['page'])) {
		add_action('admin_head', 'wptap_admin_include_css');
		add_action('admin_head', 'wptap_admin_include_js');
	}
	add_action('admin_menu', 'wptap_options_menu');
}

// Activation of plugin
if(function_exists('register_activation_hook')) {
	register_activation_hook( __FILE__, 'wptap_init' );
}

// Uninstallation of plugin
if(function_exists('register_uninstall_hook')) {
	register_uninstall_hook(__FILE__, 'wptap_uninstall');
}
?>