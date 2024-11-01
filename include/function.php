<?php
/**
 * WPtap global function.
 *
 * @package WPtap
 * @subpackage libary
 */

/**
 * Activation of plugin
 * Initialize the plugin
 */
function wptap_init()
{

}

/**
 * Uninstallation of plugin
 */
function wptap_uninstall()
{

}

/**
 * If options does not exists, then use the default settings.
 *
 * @param array $settings submit options.
 */
function wptap_validate_settings(&$settings)
{
	global $wptap_default_settings;

	foreach($wptap_default_settings as $key => $value) {
		if(!isset($settings[$key])) {
			$settings[$key] = $value;
		}
	}

	if(!isset($settings['theme'])) {
		$themes = wptap_get_themes();
		$settings['theme'] = $themes[0];
	}
}


/**
 * get options
 *
 * @return array options array
 */
function wptap_get_settings()
{
	$v = get_option('wptap_iphone_pages');
	if (!$v) {
		$v = array();
	}
	
	if (!is_array($v)) {
		$v = unserialize($v);
	}

	wptap_validate_settings($v);

	return $v;
}

/**
 * get themes
 *
 * @return array themes array
 */
function wptap_get_themes()
{
	$theme_root = WPTAP_THEME_PATH;
	$themes = array();

	if(is_dir($theme_root)) {
		if($dh = opendir($theme_root)) {
			while(($file = readdir($dh)) != false) {
				if($file != '.' && $file != '..') {
					$theme = $theme_root . $file;
					if(wptap_is_themes_dir($theme)) {
						if(is_dir($theme)) {
							$themes[] = $file;
						}
					}
				}
			}
			closedir($dh);
		}
	}

	return $themes;
}

/**
 * Determine if dir is theme dir.
 *
 * @param string $theme_dir
 * @return boolean
 */
function wptap_is_themes_dir($theme_dir)
{
	//$is_theme = false;

	if(is_dir($theme_dir)) {
		if($dh = opendir($theme_dir)) {
			while(($file = readdir($dh)) != false) {
				if($file != '.' && $file != '..') {
					$file = $theme_dir .DS. $file;

					if($file == ($theme_dir .DS. 'style.css')) {
						return true;
					}
				}
			}
		}
	}

	return false;
}

/**
 * get icons
 *
 * @return array icons array
 */
function wptap_get_icons()
{
	$icon_root = WPTAP_ICON_PATH;
	$plugin_url = wptap_get_plugins_uri() . '/';
	$icons = array();

	if(is_dir($icon_root)) {
		if($dh = opendir($icon_root)) {
			while(false !== ($icon = readdir($dh))) {
				if(substr($icon, -4) == '.png') {
					$icons[substr($icon, 0, -4)] = $plugin_url . 'images/icons/' . $icon;
				}
			}
		}
	}

	return $icons;
}


/**
 * Determine if client is mobile phone.
 *
 * @return boolean
 */
function wptap_is_iphone() {
	global $wptap_plugin;
	return $wptap_plugin->applemobile;
}

/**
 * Plugin URL
 *
 * @return string
 */
function wptap_get_plugins_uri()
{
	global $wptap_plugin_dir_name;
	return WP_CONTENT_URL . '/' . $wptap_plugin_dir_name . '/' . WPTAP_PLUGIN_NAME;
}

/**
 * Switch mobile theme or PC theme
 */
function wptap_switch()
{
	if(wptap_is_iphone()) {
		echo '<div id="now_iphone">';
		echo '<h3><a href="'.get_option('siteurl').'?wptap_view=normal"></h3></a>';
		echo '</div>';
	} else {
		echo '<div id="now_pc">';
		echo '<h3><a href="'.get_option('siteurl').'?wptap_view=mobile"></a></h3>';
		echo '</div>';
	}
}

/**
 * Include WPtap switch css file.
 */
function wptap_switch_css()
{
	echo '<link rel="stylesheet" href="'.wptap_get_plugins_uri().'/css/switch-thems.css" type="text/css" media="screen" />';
}

/**
 * Get post thumb
 *
 * @param integer the thumb width
 * @param integer the thumb height
 * @return mixed
 */
function wptap_post_thumb($w = 630, $h = 250) {
	global $post;
	$thumbnail = get_post_meta($post->ID, 'thumb', true);
	
	if (!$thumbnail) {
		return false;
	} else {
		return wptap_get_plugins_uri() . '/include/timthumb.php?src=' . $thumbnail . '&amp;w=' . $w . '&amp;h=' . $h . '&amp;zc=1';
	}
}

/** 
 * Introduction for content
 *
 * @param string $content
 * @param integer $limit
 * @return string
 */
function wptap_strip_content($content, $limit) {
	$content = apply_filters('the_content', $content);
	
	$content = strip_tags($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	
	$words = explode(' ', $content, ($limit + 1));
	if(count($words) > $limit) {
		array_pop($words);
		return implode(' ', $words) . '...'; 
	} else {
		return implode(' ', $words); 
	}
}

/**
 * Introduction for title
 *
 * @param string $title
 * @param integer $limit
 * @return string
 */
function wptap_strip_title($title, $limit) {
	//$title = apply_filters('the_title', $title);
	
	$title = strip_tags($title);
	$title = str_replace(']]>', ']]&gt;', $title);
	
	$words = explode(' ', $title, ($limit + 1));
	if(count($words) > $limit) {
		array_pop($words);
		return implode(' ', $words) . '...'; 
	} else {
		return implode(' ', $words); 
	}
}

/**
 * WPtap current theme info
 */

function wptap_current_theme()
{
	$wptap_setting = wptap_get_settings();

	$current_theme_dir = WPTAP_THEME_PATH . $wptap_setting['theme'] .DS;

	if(!is_dir($current_theme_dir)) {
		return false;
	}
	
	return $wptap_setting['theme'];
}
?>