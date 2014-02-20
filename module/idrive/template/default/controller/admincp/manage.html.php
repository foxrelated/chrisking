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
		<th>Username</th>
		<th>Player</th>
		<th>Type</th>
		<th>Makes</th>
		<th>Domain</th>
		<th>Updated</th>
		<th>Logo</th>
		<th>Pre-Roll</th>
		<th>Remove</th>
		{foreach from=$aPlayers item=aPlayer}
			<tr id="player_row_{$aPlayer.player_id}" style="border-bottom:1px solid #CCCCCC">
				<td>
					{$aPlayer|user}
				</td>
				<td>
					{$aPlayer.player_name}
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
					{$aPlayer.domain}
				</td>
				<td>
					{$aPlayer.timestamp}
				</td>
				<td>
					{if $aPlayer.logo_id}
						<div id="logo_preview_link_{$aPlayer.player_id}">
							<a href="#" onclick="$('#logo_preview_link_{$aPlayer.player_id}').hide('slow');$('#logo_preview_{$aPlayer.player_id}').show('slow')">Show Logo</a>
						</div>
						<div id="logo_preview_{$aPlayer.player_id}" style="display:none">
							{img path='core.url_file' file='idrive/logo/'.$aPlayer.logo_file_name }
							<br />
							<a href="#" onclick="$('#logo_preview_link_{$aPlayer.player_id}').show('slow');$('#logo_preview_{$aPlayer.player_id}').hide('slow')">Hide Logo</a>
						</div>
						<br />
						Links to:
						<br />
						<a href="{$aPlayer.logo_branding_url}">{$aPlayer.logo_branding_url}</a>
					{else}
						No Logo
					{/if}
				</td>
				<td>
					{if $aPlayer.preroll_id}
						<div id="preroll_preview_link_{$aPlayer.player_id}">
							<a href="#" onclick="$('#preroll_preview_link_{$aPlayer.player_id}').hide('slow');$('#preroll_preview_{$aPlayer.player_id}').show('slow')">Show Pre-Roll</a>
						</div>
						<div id="preroll_preview_{$aPlayer.player_id}" style="display:none">
							<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
								<param name="allowfullscreen" value="true" />
								<param name="movie" value="{$sSwfUrl}player.swf" />
								<param name="flashvars" value="{$sIdriveUrl}preroll/{$aPlayer.preroll_file_name}" />
								<embed allowfullscreen="true" type="application/x-shockwave-flash" src="{$sSwfUrl}player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file={$sIdriveUrl}preroll/{$aPlayer.preroll_file_name}" />
							</object>
							<br />
							<a href="#" onclick="$('#preroll_preview_link_{$aPlayer.player_id}').show('slow');$('#preroll_preview_{$aPlayer.player_id}').hide('slow')">Hide Pre-Roll</a>
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
						$(this).parents('#player_list:first').find('#player_row_{$aPlayer.player_id}:first').hide();
						$.ajaxCall(
							'idrive.deletePlayer','player_id={$aPlayer.player_id}&from_admincp=1'
						);
						return false;
					   ">
						Remove
					</a>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
