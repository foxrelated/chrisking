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
{if $sBrowser == 'mobile'}
	{if $bDebug}
		<!--
			*********************
			*DVS Mobile Template*
			*********************
		-->
	{/if}
	{template file='dvs.controller.view-mobile}
{else}
	{if $bDebug}
		<!--
			**********************
			*DVS Desktop Template*{if $sBrowser == 'ipad'}: iPad Detected{/if}
			**********************
		-->
	{/if}
<!--	<div id="feedback">
	  <a href="https://docs.google.com/forms/d/1YTymYpPaBgT8ZKV46qTwWGhuuwK_9bs7jnPG00_nIVM/viewform" target="_blank">feedback</a>
	</div>-->

	<div id="dvs_background"></div>
	<div id="dvs_wrapper" itemscope itemtype="http://schema.org/AutoDealer">
		<div id="dvs_container">
			<div id="dvs_branding_container">
				{if $aDvs.branding_file_name}
					<a href="./">{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=1117 max_height=600}</a>
				{else}
					<h1>{$aDvs.dealer_name}</h1>
				{/if}
			</div>
			<div id="dvs_lower_container">
				<div id="dvs_menu_container">
					<a href="./" class="dvs_top_menu_link" onclick="menuHome('Top Menu Clicks');">{phrase var='dvs.home'}</a>&nbsp;|&nbsp;
					{if $aDvs.inventory_url}<a href="{$aDvs.inventory_url}" class="dvs_top_menu_link dvs_inventory_link" onclick="menuInventory('Top Menu Clicks');" rel="nofollow">{phrase var='dvs.show_inventory'}</a>&nbsp;|&nbsp;{/if}
					{if $aDvs.specials_url}<a href="{$aDvs.specials_url}" class="dvs_top_menu_link" onclick="menuOffers('Top Menu Clicks');" rel="nofollow">{phrase var='dvs.special_offers'}</a>&nbsp;|&nbsp;{/if}
					<a href="#" class="dvs_top_menu_link" onclick="menuContact('Top Menu Clicks');getPrice({$iDvsId});">{phrase var='dvs.contact_dealer'}</a>
					{if Phpfox::isUser()}
						&nbsp;|&nbsp;&nbsp;&nbsp;<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}share" class="dvs_top_menu_link" >{phrase var='dvs.dealer_share_links'}</a>
						{if Phpfox::getUserId() == $aDvs.user_id || Phpfox::isAdmin()}
							&nbsp;|&nbsp;&nbsp;&nbsp;<a href="{url link='dvs.salesteam' id=$aDvs.dvs_id}" class="dvs_top_menu_link" >{phrase var='dvs.manage_sales_team'}</a>
						{/if}
					{/if}
				</div>

				<div id="dvs_player_wrapper">
					{template file='dvs.controller.player.player}
				</div>

				{if $aVideoSelectYears && $sBrowser != 'ipad'}
					<div id="dvs_vehicle_select_container">
						{phrase var='dvs.choose_new_vehicle'}:

						<span id="dvs_vehicle_select_year_container">
							<div class="dvs_select_box_anchor" data-dropdown="#dvs_video_select_year" data-vertical-offset="15"><div class="dvs_select_box_anchor_text" id="dvs_select_box_year_text">{if isset($aVideoSelectYears.1)}{phrase var='dvs.select_year'}{else}{$aVideoSelectYears.0}{/if}</div></div>
							{if isset($aVideoSelectYears.1)}
								<div class="dropdown dvs_select_options_container dropdown-anchor-right dropdown-relative" id="dvs_video_select_year">
									<ul class="dropdown-menu">
										{foreach from=$aVideoSelectYears item=iYear}
											<li><a href="#" onclick="$('#dvs_select_box_year_text').html('{$iYear}');$('#dvs_video_select_year_input').val('{$iYear}');$.ajaxCall('dvs.getMakes', 'iYear={$iYear}');">{$iYear}</a></li>
										{/foreach}
									</ul>
								</div>
							{/if}
						</span>
						<input type="hidden" id="dvs_video_select_year_input" value=""/>

						<span id="dvs_vehicle_select_make_container">
							<div class="dvs_select_box_anchor" data-dropdown="#dvs_video_select_make" data-vertical-offset="15"><div class="dvs_select_box_anchor_text" id="dvs_select_box_make_text">{if isset($aValidVSMakes.1)}{phrase var='dvs.select_make'}{else}{if isset($aValidVSMakes.0)}{$aValidVSMakes.0.make}{else}{phrase var='dvs.select_make'}{/if}{/if}</div></div>
							<div class="dropdown dvs_select_options_container dropdown-anchor-right dropdown-relative" id="dvs_video_select_make">
								<ul class="dropdown-menu">
									{if isset($aValidVSMakes.0)}
										{foreach from=$aValidVSMakes item=aMake}
											<li><a href="#" onclick="$('#dvs_select_box_make_text').html('{$aMake.make}');$('#dvs_video_select_make_input').val('{$aMake.make}');$.ajaxCall('dvs.getModels', 'iYear={$aVideoSelectYears.0}&amp;sMake={$aMake.make}&amp;iDvsId={$Dvs.dvs_id}');">{$aMake.make}</a></li>
										{/foreach}
									{else}
										<li><a href="#">{phrase var='dvs.please_select_a_year_first'}</a></li>
									{/if}
								</ul>
							</div>
						</span>
						<input type="hidden" id="dvs_video_select_make_input" value=""/>

						<input type="hidden" id="dvs_playlist_border_color" value="{$aDvs.playlist_border}" />

						<span id="dvs_vehicle_select_model_container">
							<div class="dvs_select_box_anchor" data-dropdown="#dvs_video_select_model" data-vertical-offset="15"><div class="dvs_select_box_anchor_text" id="dvs_select_box_model_text">{phrase var='dvs.select_model'}</div></div>
							<div class="dropdown dvs_select_options_container dropdown-anchor-right dropdown-relative" id="dvs_video_select_model">
								<ul class="dropdown-menu">
									{if $aVideoSelectModels}
										{foreach from=$aVideoSelectModels item=aModel}
											<li><a href="#" onclick="$('#dvs_select_box_model_text').html('{$aModel.model}');$.ajaxCall('dvs.videoSelect', 'sModel={$aModel.model}&amp;iYear=' + $('#dvs_video_select_year_input').val() + '&amp;sMake=' + $('#dvs_video_select_make_input').val() + '&amp;sPlaylistBorder=' + $('#dvs_playlist_border_color').val());">{$aModel.year} {$aModel.model}</a></li>
										{/foreach}
									{else}
										<li id="dvs_vehicle_select_model_placeholder"><a href="#">{phrase var='dvs.please_select_a_year_first'}</a></li>
									{/if}
								</ul>
							</div>
						</span>
					</div>
				{elseif $aVideoSelectYears}
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
					<a href="./" class="dvs_c2a_button" onclick="menuHome('Call To Action Menu Clicks');">{phrase var='dvs.cta_home'}</a>
					{if $aDvs.inventory_url}<a href="{$aDvs.inventory_url}" class="dvs_c2a_button dvs_inventory_link" onclick="menuInventory('Call To Action Menu Clicks');" rel="nofollow">{phrase var='dvs.cta_inventory'}</a>{/if}
					{if $aDvs.specials_url}<a href="{$aDvs.specials_url}" class="dvs_c2a_button" onclick="menuOffers('Call To Action Menu Clicks');" rel="nofollow">{phrase var='dvs.cta_specials'}</a>{/if}
					<a href="#" class="dvs_c2a_button" onclick="menuContact('Call To Action Menu Clicks');getPrice({$iDvsId});">{phrase var='dvs.cta_contact'}</a>
				</div>
				
				<div id="dvs_share_container">
					<p style="font-size:16px;">Click to Share:</p> 
					<span id="email_button_wrapper">
						<a href="#" class="dvs_social_button_link" onclick="showShareEmail({$iDvsId});"><img src="{$sImagePath}email-share.png" alt="Share Via Email"/></a></span><br>					
					<span id="facebook_button_wrapper">
						<a href="#" class="dvs_social_button_link" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');facebookShareClick();return false;"><img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/></a></span><br>
					<span id="twitter_button_wrapper">
						<a href="https://twitter.com/share" class="twitter-share-button twitter_popup" data-size="large" data-count="none" id="dvs_twitter_share_link"></a>
					</span>
						<br />
					<span id="google_button_wrapper">
						<a href="#" class="dvs_social_button_link" onclick="window.open('https://plus.google.com/share?url='+encodeURIComponent(location.href));googleShareClick();return false;"><img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/></a></span>
					</span>
				</div>

				<div id="dvs_lower_text_container">
					<div id="dvs_video_information">
						<h3 id="video_name"><strong><a href="location.href">{$aDvs.phrase_overrides.override_video_name_display}</a></strong></h3>
						<div id="video_long_description"{if strlen($aDvs.phrase_overrides.override_video_name_display) > $iLongDescLimit} style="display:none;"{/if}><span id="video_long_description_text">{$aDvs.phrase_overrides.override_video_description_display}</span><span id="video_long_description_control"{if strlen($aDvs.phrase_overrides.override_video_name_display) <= $iLongDescLimit} style="display:none;"{/if}>[<a onclick="$('#video_long_description').hide();$('#video_long_description_shortened').show();" class="text_expander_links" href="#">less</a>]</span></div>
						<div id="video_long_description_shortened"{if strlen($aDvs.phrase_overrides.override_video_name_display) <= $iLongDescLimit} style="display:none;"{/if}><span id="video_long_description_shortened_text">{$aDvs.phrase_overrides.override_video_description_display|shorten:$iLongDescLimit:'...'}</span><span id="video_long_description_shortened_control">[<a onclick="$('#video_long_description_shortened').hide();$('#video_long_description').show();" class="text_expander_links" href="#">more</a>]</span></div>
					</div>
				
					{if isset($aOverrideVideo) && isset($aOverrideVideo.ko_id)}
					{else}
						<div id="dvs_welcome_container">
							<h1>{$aDvs.dealer_name} of {$aDvs.city}, {$aDvs.state_string}</h1>
							<span itemprop="description">{$aDvs.text_parsed}</span>
						</div>
					{/if}

					
				</div>
				
				<div id="dvs_geomap_container"></div>
				<div id="dvs_dealer_address">
					{if $aDvs.url}{phrase var='dvs.website'}: <a href="{$aDvs.url}" rel="nofollow" class="dvs_footer_link">{$aDvs.url}</a>{/if}
						{if $aDvs.phone}<br />{phrase var='dvs.phone'}: <span itemprop="telephone">{$aDvs.phone}</span>{/if}
						<div itemscope itemtype="http://schema.org/PostalAddress">
							{if $aDvs.address}Address: <span itemprop="streetAddress">{$aDvs.address}</span><br />{/if}
							<span itemprop="addressLocality">{$aDvs.city}</span>, <span itemprop="addressRegion">{$aDvs.state_string}</span>, {$aDvs.postal_code}
						</div>
					</div>

				<div id="dvs_footer_container">
					<br/>
					<br/>
					<div id="footer_video_list">
						<h1>{phrase var='dvs.more_videos'}</h1>
						<table width="100%">
							<tr>
								{foreach from=$aFooterLinks key=iKey item=aVideo name=videos}
									<td>
										<span class="footer_video_list_item">
											<a href="{if $bSubdomainMode}{url link=$aDvs.title_url}{else}{url link='dvs.'$aDvs.title_url}{/if}{$aVideo.video_title_url}" class="dvs_footer_link">{$aVideo.year} {$aVideo.make} {$aVideo.model}</a>
										</span>
									</td>
									{if is_int($phpfox.iteration.videos/4)}
										</tr><tr>
									{/if}
								{/foreach}
							</tr>
						</table>
					</div>
					<br /><br />	
				</div>
			</div>
		</div>
	</div>

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
{/if}

<script type="text/javascript">	
	$(document).ready(function() {l}

		function backgroundFix() {l}
		{if $bDebug}console.log("Page: Moving background to: " + pageBottom);{/if}			
			
			// Reset the stored bottom value
			pageBottom = $('#dvs_lower_container').position().top + $('#dvs_lower_container').outerHeight(true);

			// Fix the background container
			$('#dvs_background').css('height', 10 + pageBottom + 'px');
		{r}

		function checkBackground() {l}
			// If the lower container has moved, fix the background again.
			if (pageBottom != $('#dvs_lower_container').position().top + $('#dvs_lower_container').outerHeight(true)) {l}

				// More content has loaded in, fix the background
				backgroundFix();
			{r}
			// Update the stored position of the lower container and reset the timeout
			timerHandle = setTimeout(function() {l}
				checkBackground();
			{r}, 100);
		{r}

		// Store the initial lower container position and fix the background
		var pageBottom = $('#dvs_lower_container').position().top + $('#dvs_lower_container').outerHeight(true);
		backgroundFix();
	{r});
</script>