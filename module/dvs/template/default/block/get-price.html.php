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
	#dvs_contact_container {left_curly}
		text-align: center;
	{right_curly}	
</style>

<div id="dvs_contact_container">
	<div id="dvs_contact_form">
		<form id="contact_dealer" name="contact_dealer">
			<table style="width:320px;margin:5px;">
				<tr>
					<td colspan="2" style="margin-bottom:10px;font-weight:bold;">
						{phrase var='dvs.contact_dealer'}
					</td>
				</tr>
				<tr>
					<td colspan="2" style="margin-bottom:10px;">&nbsp;
						<div style="font-size:11px;"><p>Thank you for your interest in the {$aVideo.year} {$aVideo.make} {$aVideo.model}!</p>
						<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p></div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="margin-bottom:10px;">&nbsp;
						
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right">
						{phrase var='dvs.name'}:
					</td>
					<td class="dvs_add_td">
						<input type="text" name="val[contact_name]" id="name" />
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right">
						{phrase var='dvs.email'}:
					</td>
					<td class="dvs_add_td">
						<input type="text" name="val[contact_email]" id="email" />
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right">
						{phrase var='dvs.phone'}:
					</td>
					<td class="dvs_add_td">
						<input type="text" name="val[contact_phone]" id="phone" />
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right">
						{phrase var='dvs.zip_code'}:
					</td>
					<td class="dvs_add_td">
						<input type="text" name="val[contact_zip]" id="zip" />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="margin-bottom:10px;">&nbsp;
						
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right" style="vertical-align:top;">
						{phrase var='dvs.comments'}:
					</td>
					<td class="dvs_add_td">
						<textarea id="comments" name="val[contact_comments]" cols="16" rows="3"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="margin-bottom:10px;">&nbsp;
						
					</td>
				</tr>
				<tr>
					<td class="dvs_add_td" align="right">&nbsp;
						
					</td>
					<td class="dvs_add_td">
						<input type="hidden" name="val[contact_video_ref_id]" id="video_ref_id" value="{$aVideo.referenceId}"/>
						<input type="hidden" name="val[contact_dvs_id]" id="dvs_id" value="{$aDvs.dvs_id}"/>
						<input type="button" value="{phrase var='dvs.send'}" class="dvs_form_button" onclick="$.ajaxCall('dvs.contactDealer', $('#contact_dealer').serialize());" style="background:#{$aDvs.button_background};color:#{$aDvs.button_text};border:1px solid #{$aDvs.button_border};"/>
						&nbsp;
						 <input type="button" value="Cancel" class="dvs_form_button" onclick="$('#dvs_get_price_container').hide('fast');" style="background:#{$aDvs.button_background};color:#{$aDvs.button_text};border:1px solid #{$aDvs.button_border};"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id="dvs_contact_success" style="display:none;">
		{phrase var='dvs.contact_request_sent_thank_you'}
		<br />
		<br />
		<input type="button" value="Continue" class="button" onclick="$('#dvs_get_price_container').hide('fast');" style="background:#{$aDvs.button_background};color:#{$aDvs.button_text};"/>
	</div>
</div>