<?php
defined('PHPFOX') or exit('GO MICE!');
?>

<a href="{url link='admincp.dvs.blacklists.add'}">Add domain</a>

<div id="black_list">
	<table>
		<th>{phrase var='dvs.name'}</th>
		<th>{phrase var='dvs.remove'}</th>
		{foreach from=$aBlacklists item=aBlacklist}
			<tr id="theme_row_{$aBlacklist.id}">
				<td>
					<a href="{url link='admincp.dvs.blacklists.add'}id_{$aBlacklist.id}">{$aBlacklist.name}</a>
				</td>
				<td>
					<a href="#" onclick="
						$('#theme_row_{$aBlacklist.id}').remove();
						$.ajaxCall('dvs.deleteDomain','id={$aBlacklist.id}');return false;">
						{phrase var='dvs.remove'}
					</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
