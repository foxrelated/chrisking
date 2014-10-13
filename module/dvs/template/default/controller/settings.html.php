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
{if $bCanAddDvss || $bIsEdit}
{literal}
<script type="text/javascript">
	$Behavior.keyUp = function() {
		$('#vanity_url').keyup(function(){
			if($('#vanity_url').val()){
				{/literal}
					{if $bIsEdit && isset($aForms.dvs_id)}
						$.ajaxCall('dvs.updateTitleUrl','vanity_url='+this.value+'&dvs_id={$aForms.dvs_id}');
					{else}
						$.ajaxCall('dvs.updateTitleUrl','vanity_url='+this.value);
					{/if}
				{literal}
			}
			else
			{
				$('#title_url_display').html('Enter a vanity URL above to see a preview.');
			}
		});
		{/literal}
		{if !$bIsEdit}
		{literal}
		$('#js_country_child_id_value').attr('required','required');
		$('#js_country_child_id_value option:first').attr("value","");
		$('#js_country_child_id_value option:first').attr("selected",false);
		$('#js_country_child_id_value option:first').attr("selected",true);
		{/literal}
		{/if}
		{literal}
	}
</script>
<style type="text/css">
	{/literal}
		{if $aForms.inv_display_status == 0}
	{literal}
		.inv_display_row_wrapper{
			display: none;
		}
	{/literal}
		{/if}
	{literal}
</style>

<script type="text/javascript">

	var total = 100;
	var totalvideos = 100;
	var job = "asdf";
	var run=true;
	current_progress = 0;

	$Behavior.domReady = function(){
		$('#inventory_import_button_ajax').on('click', function(){
			$('.progress_bar_wrapper').show('slow');
			setInterval(function(){process_increase()}, 1000);
            {/literal}
            {if isset($aForms.dvs_id)}
                {literal}
                $.ajaxCall('dvs.instantImport',
                    'dvs_id={/literal}{$aForms.dvs_id}{literal}'
                );
                {/literal}
            {/if}
            {literal}
		});
		$('#inv_display_status_on').on('click', function(){
			var confirm_res = confirm("{/literal}{phrase var='dvs.inventory_settings_disclaimer'}{literal}");
			if (confirm_res == true) {
				$('.inv_display_row_wrapper').css('display', 'block');
				return true;
			} else {
				return false;
			}
		});
		$('#inv_display_status_off').on('click', function(){
			$('.inv_display_row_wrapper').css('display', 'none');
		});
	};

	function autoUpdate(offset){
		if (offset < total && run){
            {/literal}
            {if isset($aForms.dvs_id)}
                {literal}
                $.ajaxCall('dvs.instantImport',
                    'dvs_id={/literal}{$aForms.dvs_id}{literal}'
                );
                {/literal}
            {/if}
            {literal}
		};
		if (run == false){
			$("#progress_running").toggle("slow");
			$("#progress_stopped").toggle("slow");
		};
		if (offset >= total){
			$("#progress_running").hide("slow");
			$("#progress_outer").hide("slow");
			$("#progress_update").hide("slow");
			$("#progress_complete").show("slow");
			
			$('#dvs_message').show('slow');
		};

	};
	function restart(offset){
		$("#progress_running").show("slow");
		$("#progress_stopped").hide("slow");
		run=true;
		autoUpdate(offset);
	};

	function finishProgress(){
		alert('{/literal}{$sMessage}{literal}');
		current_progress = 100;
		$('#progress_inner').stop().animate({
			width: '100%'
		}, 300, function() {});
		$("#progress_percentage").html("100%");

		// $("#progress_running").hide("slow");
		// $("#progress_outer").hide("slow");
		// $("#progress_update").hide("slow");
		// $("#progress_complete").show("slow");
		
		$('#dvs_message').show('slow');
	}

	function process_increase(){
		if(current_progress >= 99){
			return false;
		}
		current_progress = current_progress + 1;
		$('#progress_inner').stop().animate({
			width: current_progress + '%'
		}, 300, function() {});
		$("#progress_percentage").html(current_progress + "%");
	};
</script>
<style type="text/css">
	#progress_outer{
		border: 1px solid #000;
		width: 600px;
		height: 15px;
	}
	#progress_inner{
		width: 0%;
		height: 15px;
		background: #ff8c22;
	}
	#progress_percentage{
		position: absolute;
		float: center;
		width: 600px;
		height:15px;
		color:#000;
		font-weight: bold;
		text-align: center;
		padding-top: 2px;
	}
</style>
{/literal}

{if isset($importInventoryRes) && $importInventoryRes}
	{literal}
		<script type="text/javascript">
			$Behavior.message = function() {
				$('#dvs_message').show('slow');
				// $('#dvs_message').animate({top: 0}, 1000).hide('slow');
			}
		</script>
	{/literal}
{/if}
<div class="message" id="dvs_message" style="display:none;">
	{$sMessage}
</div>

<form method="post" action="" id="import_dvs" name="import_dvs">
</form>
<form method="post" action="{url link='dvs.index'}" id="add_dvs" name="add_dvs">
	<fieldset>
		<ol>
			<li>
				<label for="dealer_name">{required}{phrase var='dvs.dealer_name'}:</label>
				<input type="text" name="val[dealer_name]" value="{value type='input' id='dealer_name'}" id="dealer_name" size="60" maxlength="60" required />
				{*phrase var='dvs.dealer_name_phrase'*}
			</li>
			<li>
				<label for="showroom_name">{required}{phrase var='dvs.showroom_name'}:</label>
				{if !$bIsEdit}
				<input type="text"  size="60" maxlength="60" required name="val[dvs_name]" value="{value type='input' id='dvs_name'}" id="dvs_name" />
				{/if}
				{if $bIsEdit && Phpfox::isAdmin()}
				<input type="text" size="60" maxlength="60" required name="val[dvs_name]" value="{value type='input' id='dvs_name'}" id="dvs_name" />
				{/if}
				{if $bIsEdit && !Phpfox::isAdmin()}
				&nbsp;{$aForms.dvs_name}
				{/if}
				{*phrase var='dvs.showroom_name_phrase'*}
			</li>
	
			{if !$bIsEdit || Phpfox::isAdmin()}
			<li>
				<label for="vanity_url">{required}{phrase var='dvs.vanity_url'}:</label>
				{if $bIsEdit}
				<input type="text" size="60" maxlength="60" required name="val[vanity_url]" value="{value type='input' id='title_url'}" id="vanity_url" />
				{else}
				<input type="text" size="60" maxlength="60" required name="val[vanity_url]" value="{value type='input' id='vanity_url'}" id="vanity_url" />
				{/if}
				{*phrase var='dvs.vanity_url_phrase'*}	
			</li>
			{/if}
	
			<li>
				<label for="preview_url">Preview URL{*phrase var='dvs.url'*}:</label>
				<span id="title_url_display">&nbsp;{if $bIsEdit}{if $bSubdomainMode}{url link=$aForms.title_url}{else}{url link='dvs'}{$aForms.title_url}{/if}{else}{phrase var='dvs.please_enter_a_vanity_url_above'}{/if}</span>
			</li>
	
			<li>
				<label for="address">{required}{phrase var='dvs.address'}:</label>
				<input type="text" name="val[address]" value="{value type='input' id='address'}" id="address"  size="60" maxlength="60" required />
				{*phrase var='dvs.address_phrase'*}
			</li>
	
			<li>
				<label for="city">{required}{phrase var='dvs.city'}:</label>
				<input type="text" name="val[city]" value="{value type='input' id='city'}" id="city" size="60" maxlength="60" required />
			</li>
	
			<li>
				<label for="state">{required}State:</label>
				{if $bIsEdit}
					{module name='core.country-child' country_child_id=$aForms.country_child_id}
				{else}
					{module name='core.country-child'}
				{/if}
			</li>
	
			<li>
				<label for="zip_code">{phrase var='dvs.zip_code'}:</label>
				<input type="text" name="val[postal_code]" value="{value type='input' id='postal_code'}" id="postal_code" size="60" maxlength="5" />
			</li>
	
			<li>
				<label for="contact_phone">{phrase var='dvs.contact_phone'}:</label>
				<input type="tel" name="val[phone]" size="60" maxlength="13" value="{value type='input' id='phone'}" id="phone" />
				{*phrase var='dvs.phone_phrase'*}
			</li>
	
			<li>
				<label for="contact_email">{phrase var='dvs.contact_email'}:</label>
				<input type="email" name="val[email]" value="{value type='input' id='email'}" id="email"  size="60" maxlength="200" />
				{*phrase var='dvs.contact_email_phrase'*}
			</li>
	
			<li>
				<label for="website_url">{phrase var='dvs.website_url'}:</label>
				<input type="url" name="val[url]" value="{value type='input' id='url'}" id="url" size="60" maxlength="300"/>
				{*phrase var='dvs.website_url_phrase'*}
			</li>
	
			<li>
				<label for="inventory_url">{phrase var='dvs.inventory_url'}:</label>
				<input type="url" name="val[inventory_url]" value="{value type='input' id='inventory_url'}" id="inventory_url" size="60" maxlength="300"/>
				{*phrase var='dvs.inventory_url_phrase'*}
			</li>
	
			<li>
				<label for="dealer_specials_url">{phrase var='dvs.dealer_specials_url'}:</label>
				<input type="url" name="val[specials_url]" value="{value type='input' id='specials_url'}" id="specials_url" size="60" maxlength="300" />
			</li>

            <li>
                <label for="dealer_id">Dealer ID:</label>
                <input type="text" name="val[dealer_id]" value="{value type='input' id='dealer_id'}" id="dealer_id" size="60" maxlength="75" />
            </li>
	
			<li>
				<label for="welcome_greeting" style="width:250px;">{phrase var='dvs.welcome_greeting_max_char_max' max=$iWelcomeGreetingMaxChars}:</label>
				{editor id='welcome' rows='5'}
				{*phrase var='dvs.welcome_message_phrase'*}
			</li>
	
			<li>
				<label for="custom_seo_tags">{phrase var='dvs.custom_seo_tags'}:</label>
				<input type="text" name="val[seo_tags]" value="{value type='input' id='seo_tags'}" id="seo_tags" size="60" maxlength="100" />
				&nbsp;Note: Separate tags with commas{*phrase var='dvs.seo_tags_phrase'*}
			</li>
	
			<li>
				<label for="google_analytics_id">{phrase var='dvs.google_analytics_id'}:</label>
				<input type="text" name="val[dvs_google_id]" value="{value type='input' id='dvs_google_id'}" id="dvs_google_id" size="60" maxlength="20" />
			</li>
		</ol>
		</fieldset>

		<div {if Phpfox::isAdmin()}{else}style="display:none;"{/if}>
		<h1>Admin Only Settings</h1>
		<h3>Layout Toggles</h3>
		<fieldset>
		<ol>
			<li>
				<label for="banner_toggle">{phrase var='dvs.banner_toggle'}:</label>
				<input type="radio" name="val[banner_toggle]" value="1" {if $bIsEdit && $aForms.banner_toggle == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
				<input type="radio" name="val[banner_toggle]" value="0" {if $bIsEdit && $aForms.banner_toggle == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
			</li>
			<li>
				<label for="top_menu_toggle">{phrase var='dvs.top_menu_toggle'}:</label>
				<input type="radio" name="val[topmenu_toggle]" value="1" {if $bIsEdit && $aForms.topmenu_toggle == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
				<input type="radio" name="val[topmenu_toggle]" value="0" {if $bIsEdit && $aForms.topmenu_toggle == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
			</li>
			<li>
				<label for="footer_toggle">{phrase var='dvs.footer_toggle'}:</label>
				<input type="radio" name="val[footer_toggle]" value="1" {if $bIsEdit && $aForms.footer_toggle == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
				<input type="radio" name="val[footer_toggle]" value="0" {if $bIsEdit && $aForms.footer_toggle == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
			</li>
		</ol>
		</fieldset>

		<h3>Gallery Link Target</h3>
		<fieldset>
		<ol>
			<li>
				<input type="radio" name="val[gallery_target_setting]" value="0" {if $bIsEdit && $aForms.gallery_target_setting == 0}checked="checked"{/if} {if !$bIsEdit}checked="checked"{/if}/>{phrase var='dvs.open_on_same_page'}
			</li>
		
			<li>
				<input type="radio" name="val[gallery_target_setting]" value="1" {if $bIsEdit && $aForms.gallery_target_setting == 1}checked="checked"{/if} />{phrase var='dvs.open_in_new_window'}
			</li>
		</ol>
		</fieldset>

		<h3>{phrase var='dvs.inventory_display_settings'}</h3>

		<fieldset>
		<ol>
			<li>
				<input type="radio" name="val[inv_display_status]" value="0" id="inv_display_status_off" {if $bIsEdit && $aForms.inv_display_status == 0}checked="checked"{/if} {if !$bIsEdit}checked="checked"{/if}/>{phrase var='dvs.dvs_inventory_status_off'}
				<input type="radio" name="val[inv_display_status]" value="1" id="inv_display_status_on" {if $bIsEdit && $aForms.inv_display_status == 1}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_on'}
			</li>
			<div class="inv_display_row_wrapper">
			<li>
				<label for="inventory_settings_feed_type">{phrase var='dvs.inventory_settings_feed_type'}:</label>
				<select name="val[inv_feed_type]" id="inv_feed_type">
					<option value=""></option>
					{if $connectors}
						{foreach from=$connectors item=connector name=iConnector}
							<option value="{$connector.connector_id}" {if $aForms.inv_feed_type == $connector.connector_id}selected="selected"{/if}>{$connector.title}</option>
						{/foreach}
					{/if}
				</select>
			</li>
			<li>
				<label for="inventory_settings_domain">{phrase var='dvs.inventory_settings_domain'}:</label>
				<input type="text" name="val[inv_domain]" value="{value type='input' id='inv_domain'}" id="inv_domain" maxlength=30 />
			</li>
			<li>
				<label for="dvs_inventory_schedule">{phrase var='dvs.dvs_inventory_shedule'}:</label>
				{phrase var='dvs.dvs_inventory_shedule_every'} <input type="text" name="val[inv_schedule_hours]" value="{value type='input' id='inv_schedule_hours'}" id="inv_schedule_hours" maxlength=3 style="width:20px;" /> {phrase var='dvs.dvs_inventory_shedule_hours'}
			</li>
			<li>
				<div class="import_button_wrapper">
					<button class="button" id="inventory_import_button_ajax" name="inventory_import_button_ajax">{phrase var='dvs.dvs_inventory_import'}</button>
				</div>
				<div class="progress_bar_wrapper">
					<div id="progress_outer">
						<div id="progress_percentage">0%</div>
						<div id="progress_inner"></div>
					</div>
					<div id="progress_update"></div>
				</div>
			</li>
			</div>
		</ol>
	</fieldset>

    <h3>Use Parent Url for Sitemap</h3>
    <fieldset>
        <ol>

            <li>
                {if !isset($aForms.parent_url)}
                <h1 style="background: #FF0000; color: #FFFFFF; padding-left: 10px; font-size: 14px; line-height: 25px; height: 25px;">You need to embed the iframe code on the dealer site first!</h1>
                {else}
                <h1 style="background: #00FF00; color: #000000; padding-left: 10px; font-size: 14px; line-height: 25px; height: 25px;">DVS iFrame integrated: <a href="{$aForms.parent_url}"><b>{$aForms.parent_url}</b></a></h1>
                {/if}

                <input type="radio" name="val[sitemap_parent_url]" value="0" {if !$bIsEdit || !isset($aForms.parent_url) || ($bIsEdit && $aForms.sitemap_parent_url == 0)}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
                <input {if !isset($aForms.parent_url)}disabled="disabled"{/if} type="radio" name="val[sitemap_parent_url]" value="1" {if $bIsEdit && $aForms.sitemap_parent_url == 1 && isset($aForms.parent_url)}checked="checked"{/if}/>{phrase var='dvs.dvs_inventory_status_on'}
            </li>
        </ol>
    </fieldset>

    <h3>Video Types</h3>
    <fieldset>
        <ol>
            <li>
                <label for="new_car_videos">New Car Videos:</label>
                <input type="radio" name="val[new_car_videos]" value="1" {if $bIsEdit && $aForms.new_car_videos == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[new_car_videos]" value="0" {if $bIsEdit && $aForms.new_car_videos == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>

            <li>
                <label for="used_car_videos">Used Car Videos:</label>
                <input type="radio" name="val[used_car_videos]" value="1" {if $bIsEdit && $aForms.used_car_videos == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[used_car_videos]" value="0" {if $bIsEdit && $aForms.used_car_videos == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>
        </ol>
    </fieldset>
	</div>
<br>
	<div id="phrase_override_toggle">
		<a href="#" onclick="if ($('#phrase_override_wrapper').is(':visible')){l}$('#phrase_override_wrapper').hide('slow');wtvlt='Show Phrase Overrides'{r}else{l}$('#phrase_override_wrapper').show('slow');wtvlt='Hide Phrase Overrides (values will still be saved)';{r}$(this).text(wtvlt);return false;" id="phrase_override_toggle_link">Show Phrase Overrides</a>
	</div>
	<div id="phrase_override_wrapper" style="display:none;">
		{foreach from=$aPhraseVars key=sPhraseVar item=sPhraseText}
			<div class="phrase_override_container">		
				<?php $this->_aVars["sDescriptionPhraseVar"]=str_replace("override_","",$this->_aVars["sPhraseVar"]); // Get descrition variable name, assign it to sDescriptionPhraseVar?>
				<div class="phrase_override_row phrase_override_container">
					<div class="phrase_override_label">
						{phrase var='dvs.'$sDescriptionPhraseVar}:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[phrase_overrides][{$sPhraseVar}]" value="{if $sPhraseText}{$sPhraseText}{/if}" id="{$sPhraseVar}" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
						{phrase var='dvs.default'}:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="{phrase var='dvs.'$sPhraseVar}" readonly/>
					</div>
				</div>
			</div>
		{/foreach}
		
		<h3>{phrase var='dvs.video_url_replacements'}</h3>
		
		<div class="phrase_override_container">		
			<div class="phrase_override_row phrase_override_container">
				<div class="phrase_override_label">
					{phrase var='dvs.new_car_videos'}:
				</div>
				<div class="phrase_override_input_container">
					<input class="phrase_override_input" type="text" name="val[1onone_override]" value="{if $bIsEdit && isset($aForms.1onone_override)}{$aForms.1onone_override}{/if}" id="1onone_override" size="60" />
				</div>
			</div>
			<div class="phrase_override_row default_phrase_override_container">
				<div class="phrase_override_label phrase_override_default_label">
					{phrase var='dvs.default'}:
				</div>
				<div class="phrase_override_default_input_container">
					<input class="phrase_override_default_input" type="text" value="{$s1onOneDefault}" readonly/>
				</div>
			</div>
			
			<div class="phrase_override_container">		
				<div class="phrase_override_row phrase_override_container">
					<div class="phrase_override_label">
						{phrase var='dvs.used_car_review_videos'}:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[new2u_override]" value="{if $bIsEdit && isset($aForms.new2u_override)}{$aForms.new2u_override}{/if}" id="new2u_override" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
						{phrase var='dvs.default'}:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="{$sNew2UDefault}" readonly/>
					</div>
				</div>
			</div>
						
			<div class="phrase_override_container">		
				<div class="phrase_override_row phrase_over{phrase var='dvs.test_drive_videos'}ride_container">
					<div class="phrase_override_label">
						{phrase var='dvs.test_drive_videos'}:
					</div>
					<div class="phrase_override_input_container">
						<input class="phrase_override_input" type="text" name="val[top200_override]" value="{if $bIsEdit && isset($aForms.top200_override)}{$aForms.top200_override}{/if}" id="top200_override" size="60" />
					</div>
				</div>
				<div class="phrase_override_row default_phrase_override_container">
					<div class="phrase_override_label phrase_override_default_label">
						{phrase var='dvs.default'}:
					</div>
					<div class="phrase_override_default_input_container">
						<input class="phrase_override_default_input" type="text" value="{$sTop200Default}" readonly/>
					</div>
				</div>
			</div>
		</div>	
	</div>
		

	<div id="dvs_settings_save_button_container">
		<input type="hidden" name="val[step]" value="settings" />
		<input type="hidden" name="val[title_url]" id="title_url" value="{if $bIsEdit}{$aForms.title_url}{/if}" />
		{if $bIsEdit && !Phpfox::isAdmin()}
		<input type="hidden" name="val[vanity_url]" id="vanity_url" value="{$aForms.title_url}" />
		{/if}
		{if $bIsEdit && !Phpfox::isAdmin()}
		<input type="hidden" name="val[dvs_name]" id="dvs_name" value="{$aForms.dvs_name}" />
		{/if}
		<input type="hidden" name="val[is_edit]" value="{if $bIsEdit && isset($aForms.dvs_id)}1{else}0{/if}" />
		{if $bIsEdit && isset($aForms.dvs_id)}<input type="hidden" name="val[dvs_id]" value="{$aForms.dvs_id}" />{/if}
		<button class="button">{if $bIsEdit && isset($aForms.dvs_id)}{phrase var='dvs.save_changes'}{else}{phrase var='dvs.save_and_continue'}{/if}</button>
	</div>
</form>

{else}

<div class="error_message">
	{if $bIsEdit}
		{phrase var='dvs.error_editing_dvs'}
	{else}
		{phrase var='dvs.error_adding_dvs'}
	{/if}
</div>
{/if}