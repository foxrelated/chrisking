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
 * @package 		DVS
 */

?>
<style type="text/css">
	#dvs_share_email_container {left_curly}
		text-align: center;
	{right_curly}	
</style>

<div id="dvs_share_email_container">
	<div id="dvs_share_email_form">
		<form id="share_email_dealer" name="share_email_dealer">
			<table style="margin:5px;">
				<tr>
					<td style="margin-bottom:10px;font-weight:bold;text-align:center;">
								{phrase var='dvs.share_via_email'}
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td">
						<input type="text" name="val[share_name]" id="share_name" placeholder="{phrase var='dvs.friends_name'}" class="dvs_text_field" />
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td">
						<input type="text" name="val[share_email]" id="share_email" placeholder="{phrase var='dvs.friends_email_address'}" class="dvs_text_field" />
					</td>
				</tr>
				
				<tr>
					<td class="dvs_add_td">
						<input type="text" name="val[my_share_name]" id="my_share_name" placeholder="{phrase var='dvs.your_name'}" class="dvs_text_field" />
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td">
						<textarea id="share_message" name="val[share_message]" placeholder="{phrase var='dvs.message_to_friend'}" cols="18" rows="5" class="dvs_textarea_field"></textarea>
					</td>
				</tr>
				<tr>
					<td style="margin-bottom:10px;">&nbsp;
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td">
						<input type="hidden" name="val[video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
						<input type="hidden" name="val[dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
						<input type="button" value="{phrase var='dvs.send'}" class="dvs_form_button" onclick="$.ajaxCall('dvs.sendShareEmail', $('#share_email_dealer').serialize());"/>
						&nbsp;
						 <input type="button" value="Cancel" class="dvs_form_button" onclick="$('#dvs_share_email_container').hide('fast');"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="dvs_share_email_success" style="display:none;">
		<br />
		<br />
		{phrase var='dvs.email_has_been_sent'}
		<br />
		<br />
		<input type="button" class="dvs_form_button" value="Close" onclick="$('#dvs_share_email_container').hide('fast');"/>
	</div>
</div>