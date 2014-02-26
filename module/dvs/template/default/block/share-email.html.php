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
<script>
	{literal}
	$('#share_email_dealer').submit(function(event){
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall('dvs.sendShareEmail', $('#share_email_dealer').serialize());
	});
{/literal}
</script>
<style type="text/css">
	#dvs_share_email_container {left_curly}
	text-align: center;
	{right_curly}	
</style>
<form id="share_email_dealer" name="share_email_dealer">
	<fieldset>
		<input type="text" name="val[share_name]" id="share_name" placeholder="{phrase var='dvs.friends_name'}" class="dvs_text_field" required />

		<input type="email" name="val[share_email]" id="share_email" placeholder="{phrase var='dvs.friends_email_address'}" class="dvs_text_field" required/>

		<input type="text" name="val[my_share_name]" id="my_share_name" placeholder="{phrase var='dvs.your_name'}" class="dvs_text_field" required/>

		<textarea id="share_message" name="val[share_message]" placeholder="{phrase var='dvs.message_to_friend'}" cols="18" rows="5" class="dvs_textarea_field" required></textarea>

		<input type="hidden" name="val[video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
		<input type="hidden" name="val[dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
	</fieldset>
	<fieldset>
		<input type="submit" value="{phrase var='dvs.send'}" class="dvs_form_button"/>
	</fieldset>
</form>
<div id="dvs_share_email_success" style="display:none;">
	{phrase var='dvs.email_has_been_sent'}
</div>
