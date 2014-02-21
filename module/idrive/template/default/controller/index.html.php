<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		iDrive
 */

?>
{if isset($sMessage)}
	{literal}
		<script type="text/javascript">
			$Behavior.playMess = function() {
				$('#player_message').show('slow');
				$('#player_message').animate({top: 0}, 500).hide('slow');
			}
		</script>
	{/literal}
	<div class="message" id="player_message" style="display:none;">
		{$sMessage}
	</div>
{/if}
<div id="add_player_button" {if !$bCanAddPlayers}style="display:none;"{/if}>
	<a href="{url link='idrive.add'}" class="button-link" style="width:90px;height:10px;padding:2px 2px 15px 2px;margin:0px;">{phrase var='idrive.add_player'}</a>
	<div class="main_break"></div>
	<div class="main_break"></div>
</div>
{pager}
{if $aPlayers}
	<div id="players" {if $bCanAddPlayers}class="separate"{/if} style="margin:15px 0px 0px 0px;">
		<table style="border-collapse:collapse;">
			<tr>
				<th width="300" align="left" style="padding-bottom: .5em; padding-right: 1em;">
					Player Name
				</th>
				<th colspan="2"align="left" style="padding-bottom: .5em; padding-right: 1em;">
					Action
				</th>
			</tr>

			{foreach from=$aPlayers item=aPlayer}
			<tr id="player_{$aPlayer.player_id}">
				<td style="padding-bottom: .5em; padding-right: 1em;">
					<a href="{url link='idrive.code' id=$aPlayer.player_id}">{$aPlayer.player_name}</a>
				</td>
				<td style="padding-bottom: .5em; padding-right: 1em;">
					<a href="{url link='idrive.add' id=$aPlayer.player_id}">Edit</a>
				</td>
				<td style="padding-bottom: .5em; padding-right: 1em;">
					<a href="#" onclick="if (confirm('{phrase var='core.are_you_sure' phpfox_squote=true}')) {left_curly} $(this).parents('#players:first').find('#player_{$aPlayer.player_id}:first').hide('slow'); $.ajaxCall('idrive.deletePlayer', 'player_id={$aPlayer.player_id}');{right_curly}">Delete</a>
				</td>
			</tr>
			{/foreach}

		</table>
	</div>
{/if}