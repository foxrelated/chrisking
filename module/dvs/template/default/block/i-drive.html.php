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
{if ($bIsExternal && $bShowGetPrice) || (!$bIsDvs && isset($aPlayer.email) && $aPlayer.email)}
	<div id="idrive_get_price_container" style="display:none;">
		<div id="idrive_contact_container">
			<div id="idrive_contact_form">
				<form id="contact_dealer" name="contact_dealer">
					<table style="margin:5px;text-align:center;">
						<tr>
							<td style="margin-bottom:10px;font-weight:bold;text-align:center;">
								{phrase var='dvs.contact_dealer'}
							</td>
						</tr>
						<tr>
							<td style="margin-bottom:10px;">&nbsp;
								<div style="font-size:12px;"><p>Thanks for your interest in the <b><span class="vehicle_year">{$aVideo.year}</span> <span class="vehicle_make">{$aVideo.make}</span> <span class="vehicle_model">{$aVideo.model}</span></b>!</p>
								<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p></div>
							</td>
						</tr>
						<tr>
							<td style="margin-bottom:10px;">&nbsp;

							</td>
						</tr>
						<tr>
							
							<td class="idrive_add_td">
								<input type="text" name="val[contact_name]" id="contact_name" placeholder="{phrase var='dvs.get_price_placeholder_name'}" class="idrive_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="idrive_add_td">
								<input type="text" name="val[contact_email]" id="contact_email" placeholder="{phrase var='dvs.get_price_placeholder_email'}" class="idrive_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="idrive_add_td">
								<input type="text" name="val[contact_phone]" id="contact_phone" placeholder="{phrase var='dvs.get_price_placeholder_phone'}" class="idrive_text_field" />
							</td>
						</tr>
						<tr>
							
							<td class="idrive_add_td">
								<input type="text" name="val[contact_zip]" id="contact_zip" placeholder="{phrase var='dvs.get_price_placeholder_zip'}" class="idrive_text_field" />
							</td>
						</tr>
						
						<tr>
							
							<td class="idrive_add_td">
								<textarea id="comments" name="val[contact_comments]" cols="16" rows="3" placeholder="{phrase var='dvs.get_price_placeholder_comments'}" class="idrive_textarea_field"></textarea>
							</td>
						</tr>
						<tr>
							<td style="">&nbsp;</td>
						</tr>
						<tr>
							
							<td class="idrive_add_td">
								<input type="hidden" name="val[contact_video_ref_id]" id="contact_video_ref_id" value="{$aFirstVideoMeta.referenceId}"/>
								{if !$bIsExternal}
									<input type="hidden" name="val[contact_idrive_id]" id="contact_idrive_id" value="{$aPlayer.player_id}"/>
								{else}
									<input type="hidden" name="val[contact_dealer_address]" id="contact_email_address" value="{$sEmail}"/>
								{/if}
								<input type="button" value="{phrase var='dvs.send'}" class="idrive_form_button" onclick="$.ajaxCall('idrive.contactDealer', $('#contact_dealer').serialize());"/>
								&nbsp;
								 <input type="button" value="Cancel" class="idrive_form_button" onclick="$('#idrive_get_price_container').hide('fast');"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="idrive_contact_success" style="display:none;">
				{phrase var='dvs.contact_request_sent_thank_you'}
				<br />
				<br />
				<input type="button" value="Continue" class="button" onclick="$('#idrive_get_price_container').hide('fast');"/>
			</div>
		</div>
	</div>
{/if}