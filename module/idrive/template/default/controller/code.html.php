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
			$(document).ready(function() {
				$('#player_message').show('slow');
				$('#player_message').animate({top: 0}, 500).hide('slow');
			});
		</script>
	{/literal}
	<div class="message" id="player_message" style="display:none;">
		{$sMessage}
	</div>
{/if}

<div id="players" style="margin:15px 0px 0px 0px;">
	<textarea id="player_code" rows="3" cols="80">&lt;iframe src="{url link='idrive.player' id=$aPlayer.player_id}width_880/height_505" scrolling="no" frameborder="0" width="880" height="505"&gt;&lt;/iframe&gt;</textarea>
</div>

{if Phpfox::getUserParam('idrive.show_advanced_url_parameters')}
	{phrase var='idrive.advanced_url_parameters'}
{/if}
