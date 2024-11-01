<?php
/**
 * WPtap option.
 *
 * @package WPtap
 * @subpackage admin
 */

function wptap_options_menu() {
	add_menu_page( __( 'WPtap Plugin', 'WPtap' ), 'WPtap', 8, 'wptap-options', 'wptap_set_page');
	add_submenu_page( 'wptap-options', __('Admin Panel', 'WPtap'), __('Admin Panel', 'WPtap'), 8, 'wptap-options', 'wptap_set_page' );
	wptap_themes_action();
	add_submenu_page( 'wptap-options', __('Get More Themes', 'WPtap'), __('Get More Themes', 'WPtap'), 8, 'wptap_more-theme', 'wptap_more_theme' );
}

function wptap_themes_action() {
	$current_theme = _wptap_current_theme();

	add_submenu_page( 'wptap-options', __('Theme Features', 'WPtap'), __('Theme Features', 'WPtap'), 8, 'wptap-options-theme', 'wptap_themes_manage' );
}

function _wptap_current_theme()
{
	$wptap_setting = wptap_get_settings();
	$current_theme = $wptap_setting['theme'];

	return $current_theme;
}

function wptap_set_page()
{
	$wptap_setting = wptap_get_settings();

	echo '<div><h1>WPtap Admin Panel (version: '. WPTAP_VERSION .')</h1>';

	require_once( WPTAP_INCLUDE_PATH . 'submit.php' );
?>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="wptap-form">
<?php
	require_once( WPTAP_HTML_PATH . 'tab.php' );
	require_once( WPTAP_HTML_PATH . 'base_settings.php' );
	require_once( WPTAP_HTML_PATH . 'header_settings.php' );
	require_once( WPTAP_HTML_PATH . 'post_setttings.php' );
	require_once( WPTAP_HTML_PATH . 'ad_settings.php' );
	require_once( WPTAP_HTML_PATH . 'about.php' );
?>
<p><input type="submit" name="submit" value="<?php _e('Save Options', 'Wptap' ); ?>" id="wptap-submit" /></p>
</form>

<?php
echo '</div>'; }

function wptap_themes_manage()
{
	$current_theme = _wptap_current_theme();

	$title = __('Manage ' .$current_theme);
?>
	<div class="wrap">
	<h2><?php echo esc_html( $title ); ?></h2>
	</div>
<?php
	if(file_exists(WPTAP_THEME_PATH . $current_theme .DS. 'functions.php')) {
		require_once (WPTAP_THEME_PATH . $current_theme .DS. 'functions.php');
	}
}

function wptap_more_theme()
{
	$title = __('Get More Themes');
	$dwp_request = new WP_Http;
	$result = $dwp_request->request(WPTAP_MORE_THEMES_URI);

	echo '<div class="wrap">';
	echo '<h2>' .esc_html( $title ). '</h2>';
	echo '</div>';
	
	if(!isset($result['body']) || !empty($result['body'])) {
		echo $result['body'];
	}
}

?>
