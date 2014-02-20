<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		Golevel, LLC
 * @author  		Chris Gaines
 * @package  		
 * @version 		
 */
?>
	<div id="dvs_get_price_container" style="display:none;">
		<div id="dvs_contact_container">
			<div id="dvs_contact_form">
				<form id="contact_dealer" name="contact_dealer">
					<table style="margin:5px;text-align:center;">
						<tr>
							<td style="margin-bottom:10px;font-weight:bold;text-align:center;">
								{phrase var='dvs.contact_dealer'}
							</td>
						</tr>
						<tr>
							<td style="margin-bottom:10px;">&nbsp;
								<div style="font-size:12px;"><p>Thanks for your interest in the <b><span class="vehicle_year">{$aFirstVideoMeta.year}</span> <span class="vehicle_make">{$aFirstVideoMeta.make}</span> <span class="vehicle_model">{$aFirstVideoMeta.model}</span></b>!</p>
								<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p></div>
							</td>
						</tr>
						<tr>
							<td style="margin-bottom:10px;">&nbsp;

							</td>
						</tr>
						<tr>
							
							<td class="dvs_add_td">
								<input type="text" name="val[contact_name]" id="contact_name" placeholder="{phrase var='dvs.get_price_placeholder_name'}" class="dvs_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="dvs_add_td">
								<input type="text" name="val[contact_email]" id="contact_email" placeholder="{phrase var='dvs.get_price_placeholder_email'}" class="dvs_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="dvs_add_td">
								<input type="text" name="val[contact_phone]" id="contact_phone" placeholder="{phrase var='dvs.get_price_placeholder_phone'}" class="dvs_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="dvs_add_td">
								<input type="text" name="val[contact_zip]" id="contact_zip" placeholder="{phrase var='dvs.get_price_placeholder_zip'}" class="dvs_text_field" />
							</td>
						</tr>
						
						<tr>
							
							<td class="dvs_add_td">
								<textarea id="comments" name="val[contact_comments]" cols="16" rows="3" placeholder="{phrase var='dvs.get_price_placeholder_comments'}" class="dvs_textarea_field"></textarea>
							</td>
						</tr>
						<tr>
							<td style="">&nbsp;</td>
						</tr>
						<tr>
							
							<td class="dvs_add_td">
								<input type="hidden" name="val[contact_video_ref_id]" id="contact_video_ref_id" value="{$aVideo.referenceId}"/>
								<input type="hidden" name="val[contact_dvs_id]" id="contact_dvs_id" value="{$aDvs.dvs_id}"/>
								<input type="button" value="{phrase var='dvs.send'}" class="dvs_form_button" onclick="$.ajaxCall('dvs.contactDealer', $('#contact_dealer').serialize());"/>
								&nbsp;
								 <input type="button" value="Cancel" class="dvs_form_button" onclick="$('#dvs_get_price_container').hide('fast');"/>
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
	</div>
	<div id="dvs_share_email_wrapper" style="display:none;"></div>