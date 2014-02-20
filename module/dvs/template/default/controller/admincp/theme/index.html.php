<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */

?>

<a href="{url link='admincp.dvs.theme.add'}">Add Theme</a>

<div id="theme_list">
	<table>
		<th>{phrase var='dvs.name'}</th>
		<th>{phrase var='dvs.remove'}</th>
		{foreach from=$aThemes item=aTheme}
			<tr id="theme_row_{$aTheme.theme_id}">
				<td>
					<a href="{url link='admincp.dvs.theme.add'}theme-id_{$aTheme.theme_id}">{$aTheme.theme_name}</a>
				</td>
				<td>
					<a href="#" onclick="
						$('#theme_row_{$aTheme.theme_id}').remove();
						$.ajaxCall('dvs.deleteTheme','theme_id={$aTheme.theme_id}');return false;">
						{phrase var='dvs.remove'}
					</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
