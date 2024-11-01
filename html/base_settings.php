<?php
/**
 * WPtap global set page.
 *
 * @package WPtap
 * @subpackage admin
 */

$themes = wptap_get_themes();
?>

<div class="wptap-setting-content" id="wptap-setting-global">
	<h3>Global Setting</h3>
	<table>
		<tr>
			<td>Home Page Title</td>
			<td width="50"></td>
			<td><input type="text" name="sitename" id="sitename" value="<?php if(isset($wptap_setting['name'])) echo $wptap_setting['name']; ?>"></td>
		</tr>
		<tr>
			<td>Title Font Color:</td>
			<td></td>
			<td><input type="text" name="header_font_color" id="header-font-color" size="7" value="<?php if(isset($wptap_setting['header_font_color'])) echo $wptap_setting['header_font_color']; ?>" class="setting-color"></td>
		</tr>
		<tr>
			<td>Current Theme</td>
			<td></td>
			<td>
				<select name="theme">
				<?php foreach($themes as $theme): ?>
					<option value="<?=$theme?>" <?php if($wptap_setting['theme'] == $theme) echo 'selected'; ?>><?=$theme?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr height="40">
			<td>Current Site Icon</td>
			<td></td>
			<td>
				<img src="<?php echo wptap_get_plugins_uri().'/images/icons/'.$wptap_setting['site_icon'].'.png'; ?>" alt="" id="current-icon">
				<input type="hidden" name="site_icon" id="site-icon" value="<?php echo $wptap_setting['site_icon']; ?>">
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Icon Library</td>
			<td></td>
			<td>
				<table>
					<tr height="40">
				<?php
					$icons = wptap_get_icons();
					$i = 1;
					foreach($icons as $name => $path):
				?>
					<td width="50"><img src="<?php echo $path; ?>" alt="<?php echo $name; ?>" id="icon-<?php echo $name; ?>"></td>
				<?php if($i%7==0): ?>
					</tr><tr height="40">
				<?php endif; ?>
				<?php $i++; endforeach; ?>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<hr>
</div>
