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
	$('#contact_dealer').submit(function(event){
		// cancels the form submission
		event.preventDefault();

		// do whatever you want here
		$.ajaxCall('dvs.contactDealer', $('#contact_dealer').serialize());
	});
{/literal}
</script>

<form id="contact_dealer" name="contact_dealer" action="javascript:void(0);">
	<fieldset>
		<p>Thank you for your interest in the <strong>{$aVideo.year} {$aVideo.make} {$aVideo.model}</strong>!</p>
		<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p>
		<ul>
			<li>
				<input type="text" name="val[contact_name]" id="name" placeholder="{phrase var='dvs.get_price_placeholder_name'}" required/>
			</li>
			<li>
				<input type="email" name="val[contact_email]" id="email" placeholder="{phrase var='dvs.get_price_placeholder_email'}" required/>
			</li>
			<li>
				<input type="text" name="val[contact_phone]" id="phone" placeholder="{phrase var='dvs.get_price_placeholder_phone'}" required/>
			</li>
			<li>
				<input type="text" name="val[contact_zip]" id="zip" placeholder="{phrase var='dvs.get_price_placeholder_zip'}" required/>
			</li>
			<li>
				<textarea id="comments" name="val[contact_comments]" cols="16" rows="3" placeholder="{phrase var='dvs.get_price_placeholder_comments'}" required></textarea>
			</li>
		</ul>

		<input type="hidden" name="val[contact_video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
		<input type="hidden" name="val[contact_dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
	</fieldset>
	<fieldset>
		<input type="submit" value="{phrase var='dvs.send'}" class="dvs_form_button" style="background:#{$aDvs.button_background};color:#{$aDvs.button_text};border:1px solid #{$aDvs.button_border};"/>
	</fieldset>
</form>
<div id="dvs_contact_success" style="display:none;">
	{phrase var='dvs.contact_request_sent_thank_you'}
</div>