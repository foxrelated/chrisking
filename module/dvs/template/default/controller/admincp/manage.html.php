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
<div id="player_list">
	{pager}
	<table>
		<th>{phrase var='dvs.username'}</th>
		<th>{phrase var='dvs.dvs'}</th>
		<th>{phrase var='dvs.type'}</th>
		<th>{phrase var='dvs.make'}s</th>
		<th>{phrase var='dvs.updated'}</th>
		<th>{phrase var='dvs.pre_roll'}</th>
		<th>{phrase var='dvs.remove'}</th>
		{foreach from=$aPlayers item=aPlayer}
			<tr id="player_row_{$aPlayer.dvs_id}" style="border-bottom:1px solid #CCCCCC">
				<td>
					{$aPlayer|user}
				</td>
				<td>
					{if (Phpfox::getParam('dvs.enable_subdomain_mode'))}
						<a href="{url link=$aPlayer.title_url}" target="_blank">{$aPlayer.dvs_name}</a>
					{else}
						<a href="{url link='dvs'}{$aPlayer.title_url}" target="_blank">{$aPlayer.dvs_name}</a>
					{/if}
				</td>
				<td>
					{if $aPlayer.player_type}
						Single
					{else}
						Interactive
					{/if}
				</td>
				<td>
					{foreach from=$aPlayer.makes item=aMake}
						{$aMake.make}<br />
					{/foreach}
				</td>
				<td>
					{$aPlayer.timestamp|date:'core.extended_global_time_stamp'}
				</td>
				<td>
					{if $aPlayer.preroll_id}
						<div id="preroll_preview_link_{$aPlayer.dvs_id}">
							<a href="#" onclick="$('#preroll_preview_link_{$aPlayer.dvs_id}').hide('slow');$('#preroll_preview_{$aPlayer.dvs_id}').show('slow')">Show Pre-Roll</a>
						</div>
						<div id="preroll_preview_{$aPlayer.dvs_id}" style="display:none">
							<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
								<param name="allowfullscreen" value="true" />
								<param name="movie" value="{$sSwfUrl}player.swf" />
								<param name="flashvars" value="{$sDvsUrl}preroll/{$aPlayer.preroll_file_name}" />
								<embed allowfullscreen="true" type="application/x-shockwave-flash" src="{$sSwfUrl}player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file={$sDvsUrl}preroll/{$aPlayer.preroll_file_name}" />
							</object>
							<br />
							<a href="#" onclick="$('#preroll_preview_link_{$aPlayer.dvs_id}').show('slow');$('#preroll_preview_{$aPlayer.dvs_id}').hide('slow')">Hide Pre-Roll</a>
						</div>
						<br />
						Links to:
						<br />
						<a href="{$aPlayer.preroll_url}">{$aPlayer.preroll_url}</a>
					{else}
						No Logo
					{/if}
				</td>
				<td>
					<a href="#" onclick="
						$(this).parents('#player_list:first').find('#player_row_{$aPlayer.dvs_id}:first').hide();
						$.ajaxCall(
							'dvs.deletePlayer','dvs_id={$aPlayer.dvs_id}&from_admincp=1'
						);
						return false;
					   ">
						{phrase var='dvs.remove'}
					</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
