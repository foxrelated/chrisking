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
<meta name="viewport" content="width=600, initial-scale=0.5, maximum-scale=1.0, user-scalable=0">
<div id="dvs_wrapper" itemscope itemtype="http://schema.org/AutoDealer">
	<div id="dvs_container">
		<div id="dvs_branding_container">
			{if $aDvs.branding_file_name}
				{if $aDvs.url}<a href="./">{/if}{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=600 max_height=100 suffix='_600'}{if $aDvs.url}</a>{/if}
			{else}
				<h1>{$aDvs.dealer_name}</h1>
			{/if}
		</div>
		<div id="dvs_get_price_container" style="display:none;">
				<div id="dvs_contact_container">
					<div id="dvs_contact_form">
						<form id="contact_dealer" name="contact_dealer">
							<table style="width:560px;margin:5px;" align="center">
								<tr>
									<td colspan="2" style="margin-bottom:10px;font-weight:bold;">
										Get Your Best Price
									</td>
								</tr>
								<tr>
									<td style="margin-bottom:10px;">&nbsp;
										<div style="font-size:12px;"><p>Thanks for your interest in the <b><span class="vehicle_year">{$aFirstVideoMeta.year}</span> <span class="vehicle_make">{$aFirstVideoMeta.make}</span> <span class="vehicle_model">{$aFirstVideoMeta.model}</span></b>!</p>
										<p>We're happy to help you find your next car or answer any questions you might have. Please fill out the form below:</p></div>
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
									<td style="margin-bottom:10px;">&nbsp;\
									</td>
								</tr>
								<tr>
									
									<td class="dvs_add_td">
										<textarea id="comments" name="val[contact_comments]" cols="36" rows="3" placeholder="{phrase var='dvs.get_price_placeholder_comments'}" class="dvs_textarea_field"></textarea>
									</td>
								</tr>
								<tr>
									<td style="margin-bottom:10px;">&nbsp;

									</td>
								</tr>
								<tr>
										<td class="dvs_add_td">
										<input type="hidden" name="val[contact_video_ref_id]" id="contact_video_ref_id" value="{$aFirstVideoMeta.referenceId}"/>
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
						<input type="button" value="Continue" class="dvs_form_button" onclick="$('#dvs_get_price_container').hide('fast');"/>
					</div>
				</div>
			</div>
		<div id="dvs_middle_container">
			<div id="dvs_player_wrapper_mobile" style="background-color:none;">
				{template file='dvs.controller.player.player-mobile}
			</div>

			{if $aVideoSelectYears}
				<div id="dvs_vehicle_select_container">
					{phrase var='dvs.choose_new_vehicle'}:
					
					<span id="dvs_vehicle_select_year_container">
						<select class="dvs_select" id="dvs_video_select_year" onchange="$.ajaxCall('dvs.getMakes', 'iYear=' + $('#dvs_video_select_year').val());">
							{if isset($aVideoSelectYears.1)}
								<option value="">{phrase var='dvs.select_year'}</option>
								{foreach from=$aVideoSelectYears item=iYear}
									<option value="{$iYear}">{$iYear}</option>
								{/foreach}
							{else}
								<option value="{$aVideoSelectYears.0}">{$aVideoSelectYears.0}</option>
							{/if}
						</select>
					</span>

					<span id="dvs_vehicle_select_make_container">
						<select class="dvs_select" id="dvs_video_select_make" onchange="$.ajaxCall('dvs.getModels', 'sMake=' + $('#dvs_video_select_make').val() + '&iYear=' + $('#dvs_video_select_year').val());">
							{if isset($aValidVSMakes.1)}
								<option value="">{phrase var='dvs.select_make'}</option>
							{else}
								{if !isset($aValidVSMakes.0)}
									<option value="">{phrase var='dvs.select_make'}</option>
								{/if}
							{/if}
							{if isset($aValidVSMakes.0)}
								{foreach from=$aValidVSMakes item=aMake}
									<option value="{$aMake.make}">{$aMake.make}</option>
								{/foreach}
							{else}
								<li><a href="#">{phrase var='dvs.please_select_a_make_first'}</a></li>
							{/if}
						</select>
					</span>

					<span id="dvs_vehicle_select_model_container">
						<select class="dvs_select">
							<option>{phrase var='dvs.select_model'}</option>
							<option id="dvs_vehicle_select_model_placeholder">{phrase var='dvs.please_select_a_year_first'}</option>
						</select>
					</span>
				</div>
			{/if}
			<div id="dvs_cta_button_container">
				{if $aDvs.url}<a href="./" class="dvs_c2a_button" onclick="menuHome('Call To Action Menu Clicks');">{phrase var='dvs.cta_home'}</a>{/if}
				{if $aDvs.inventory_url}<a href="{$aDvs.inventory_url}" class="dvs_c2a_button dvs_inventory_link" onclick="menuInventory('Call To Action Menu Clicks');">{phrase var='dvs.cta_inventory'}</a>{/if}
				{if $aDvs.specials_url}<a href="{$aDvs.specials_url}" class="dvs_c2a_button" onclick="menuOffers('Call To Action Menu Clicks');">{phrase var='dvs.cta_specials'}</a>{/if}
				<a href="#" class="dvs_c2a_button" onclick="menuContact('Call To Action Menu Clicks');getPrice({$iDvsId});">Get Best Price</a>
			</div>
			
			
		</div>
		
		<div id="dvs_lower_container">
			<div id="dvs_video_information">
				<div id="video_name"><strong><a href="{$sLinkBase}">{$aDvs.phrase_overrides.override_video_name_display}</a></strong></div>
				<div id="video_long_description"{if strlen($aDvs.phrase_overrides.override_video_name_display) > $iLongDescLimit} style="display:none;"{/if}><span id="video_long_description_text">{$aDvs.phrase_overrides.override_video_description_display}</span><span id="video_long_description_control"{if strlen($aDvs.phrase_overrides.override_video_name_display) <= $iLongDescLimit} style="display:none;"{/if}>[<a onclick="$('#video_long_description').hide();$('#video_long_description_shortened').show();" class="text_expander_links" href="#">less</a>]</span></div>
				<div id="video_long_description_shortened"{if strlen($aDvs.phrase_overrides.override_video_name_display) <= $iLongDescLimit} style="display:none;"{/if}><span id="video_long_description_shortened_text">{$aDvs.phrase_overrides.override_video_description_display|shorten:$iLongDescLimit:'...'}</span><span id="video_long_description_shortened_control">[<a onclick="$('#video_long_description_shortened').hide();$('#video_long_description').show();" class="text_expander_links" href="#">more</a>]</span></div>
			</div>
			
			<div id="dvs_welcome_container">
				<strong>About {$aDvs.dealer_name}</strong><br/>
				<span itemprop="description">{$aDvs.text_parsed}</span>
			</div>

			<div id="dvs_dealer_info">
				<strong>{$aDvs.dealer_name} Contact Information</strong>
				{if $aDvs.url}<br />{phrase var='dvs.website'}: <a href="{$aDvs.url}">{$aDvs.url}</a>{/if}
				{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}
				<div itemscope itemtype="http://schema.org/PostalAddress">
					{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span><br />{/if}
					<span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, {$aDvs.postal_code}
				</div>
			</div>
			<div id="dvs_share_container">
			<span>Share this Page:</span><br>
				<a href="#" class="dvs_social_button_link" onclick="showShareEmail({$iDvsId});"><img src="{$sImagePath}email-share.png" alt="Share Via Email" width="250px;"/></a>
				<a href="#" class="dvs_social_button_link" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');facebookShareClick();return false;"><img src="{$sImagePath}facebook-share.png" alt="Facebook" width="250px;"/></a>
				<br>
				<span id="twitter_button_wrapper">
					<a href="https://twitter.com/share" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>
				</span>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
			</div>
			<div>&nbsp;</div>
			<div id="dvs_footer_container">
				<span class="dvs_footer_info">{if $aDvs.url}<a href="./" class="dvs_footer_link">{/if}{$aDvs.dealer_name} Video Showroom{if $aDvs.url}</a>{/if}</span>
				<br/>
				<br/>
				<span class="dvs_footer_info"><a href="http://wheelstvnetwork.com" class="dvs_footer_link">Powered By WheelsTV</a></span>
			</div>
		</div>
	</div>
	<div id="dvs_background" class="dvs_background dvs_background_image"></div>
</div>

<div id="dvs_share_email_wrapper" style="display:none;"></div>