<?php
/**
 * WPtap.
 */

if(!defined('THEME_URL')) {
	define('THEME_URL', WP_CONTENT_URL .'/'. $wptap_plugin_dir_name .'/'. 'WPtap/themes/Text%20Theme/');
}

$content = __('No extra Settings available for selected theme.');
?>
<?php if(is_admin()): ?>
<div style="border:1px #c3c3c3 solid; padding:5px;">
	<h4><?php _e($content); ?></h4>
	<p><?php _e(' For more infomation, please visit <a href="http://www.iphonemofo.net/index.php/wptap" target="_blank">http://www.iphonemofo.net/index.php/wptap</a>.'); ?></p>
</div>
<?php endif; ?>