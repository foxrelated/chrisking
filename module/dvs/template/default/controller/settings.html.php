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
				<label for="state">{required}Country:</label>
                <select id="country_iso" name="val[country_iso]">
                    {if $aCountries}
                    {foreach from=$aCountries item=aCountry name=sCountry}
                    <option class="js_country_option" id="js_country_iso_option_{$aCountry.country_iso}" value="{$aCountry.country_iso}" {if $aForms.country_iso == $aCountry.country_iso}selected="selected"{/if}>{$aCountry.name}</option>
                    {/foreach}
                    {/if}
                </select>
			</li>
			<li>
				<label for="state">{required}State:</label>
				{if $bIsEdit}
                    {if $aForms.country_iso}
                    {module name='core.country-child' country_child_value=$aForms.country_iso country_child_id=$aForms.country_child_id country_not_user=true}
                    {else}
                    {module name='core.country-child' country_child_value=US country_child_id=$aForms.country_child_id country_not_user=true}
                    {/if}
				{else}
					{module name='core.country-child'}
				{/if}
			</li>
	
			<li>
				<label for="zip_code">{phrase var='dvs.zip_code'}:</label>
				<input type="text" name="val[postal_code]" value="{value type='input' id='postal_code'}" id="postal_code" size="60" maxlength="10" />
			</li>
	
			<li>
				<label for="contact_phone">{phrase var='dvs.contact_phone'}:</label>
				<input type="tel" name="val[phone]" size="60" maxlength="20" value="{value type='input' id='phone'}" id="phone" />
				{*phrase var='dvs.phone_phrase'*}
			</li>
	
			<li>
				<label for="contact_email">{phrase var='dvs.contact_email'}:</label>
                <!--<input type="email" name="val[email]" value="{value type='input' id='email'}" id="email"  size="60" maxlength="200" />-->
				<input type="text" name="val[email]" value="{value type='input' id='email'}" id="email"  size="60" maxlength="200" />
				{*phrase var='dvs.contact_email_phrase'*}
			</li>
	
			<li>
				<label for="website_url">{phrase var='dvs.website_url'}:</label>
				<input type="url" name="val[url]" value="{value type='input' id='url'}" id="url" size="60" maxlength="300"/>
				{*phrase var='dvs.website_url_phrase'*}
			</li>
	
			<li>
				<label for="inventory_url">{phrase var='dvs.inventory_url'}:</label>
				<input type="url" name="val[inventory_url]" value="{value type='input' id='inventory_url'}" id="inventory_url" size="120" maxlength="300"/>
				{*phrase var='dvs.inventory_url_phrase'*} <strong>Supported variables: {literal}{$iYear}+{$sMake}+{$sModel}{/literal}</strong>
			</li>
	
			<li>
				<label for="dealer_specials_url">{phrase var='dvs.dealer_specials_url'}:</label>
				<input type="url" name="val[specials_url]" value="{value type='input' id='specials_url'}" id="specials_url" size="120" maxlength="300" />
			</li>
			</ol>
			<br />
			<h1>Custom ID Settings (optional)</h1>
			<ol>
			<li>
                <label for="cdk_id">CDK Web ID:</label>
                <input type="text" name="val[cdk_id]" value="{value type='input' id='cdk_id'}" id="cdk_id" maxlength=30 />
            </li>
            <li>
                <label for="dealer_id">Dealer ID:</label>
                <input type="text" name="val[dealer_id]" value="{value type='input' id='dealer_id'}" id="dealer_id" size="60" maxlength="255" />
            </li>
			<li>
				<label for="google_analytics_id">{phrase var='dvs.google_analytics_id'}:</label>
				<input type="text" name="val[dvs_google_id]" value="{value type='input' id='dvs_google_id'}" id="dvs_google_id" size="60" maxlength="20" />
			</li>
		</ol>
		</fieldset>

		<div {if Phpfox::isAdmin()}{else}style="display:none;"{/if}>
		<br />
		<h3 style="font-size:26px;">Admin Only Settings</h3>
		<fieldset>
		<ol>
			<li>
				<label for="contactform_toggle">iFrame Contact Form:</label>
                <input type="radio" name="val[iframe_contact_form]" value="1" {if $bIsEdit && $aForms.iframe_contact_form == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[iframe_contact_form]" value="0" {if $bIsEdit && $aForms.iframe_contact_form == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'} <p><strong>Note: The iFrame Contact Form must be set to <span style="color: #ff0000;">OFF</span> for all GM dealers (Buick, GMC, Cadillac, Chevrolet).</strong></p>
            </li>
            </ol>
		</fieldset>
    
    <h1>Virtual Test Drive Page</h1>
    <fieldset>
        <ol>
            <li>
                
				<label for="parenturl_toggle">Dealer's VTD Page: </label>
                
                {*
                <input {if !isset($aForms.parent_url)}disabled="disabled"{/if} type="radio" name="val[sitemap_parent_url]" value="1" {if $bIsEdit && $aForms.sitemap_parent_url == 1 && isset($aForms.parent_url)}checked="checked"{/if}/>{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[sitemap_parent_url]" value="0" {if !$bIsEdit || !isset($aForms.parent_url) || ($bIsEdit && $aForms.sitemap_parent_url == 0)}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
                
                {if !isset($aForms.parent_url)}
                
                <span style="background: #FF0000; color: #FFFFFF; padding:10px; font-size: 14px;">Alert! The DVS Embed code was not detected on the dealer's website.</span>
                
                {else}
                
                <span style="margin-left:20px;background: #00FF00; color: #000000; padding:5px; font-size: 14px;">Success! VTD page found at <a href="{$aForms.parent_url}"><b>{$aForms.parent_url}</b></a></span>
                
                {/if}
                *}
                
            	<input type="radio" name="val[sitemap_parent_url]" value="1" {if $bIsEdit && $aForms.sitemap_parent_url == 1 && isset($aForms.parent_url)}checked="checked"{/if}/>
            	{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[sitemap_parent_url]" value="0" {if !$bIsEdit || !isset($aForms.parent_url) || ($bIsEdit && $aForms.sitemap_parent_url == 0)}checked="checked"{/if}/>
                {phrase var='dvs.dvs_inventory_status_off'}
                
                {if !isset($aForms.parent_url)}
                
                <span style="background: #FF0000; color: #FFFFFF; padding:10px; font-size: 14px;">Alert! The DVS Embed code was not detected on the dealer's website.</span>
                
                {else}
                
                <span style="margin-left:20px;background: #00FF00; color: #000000; padding:5px; font-size: 14px;">Success! VTD page found at <a href="{$aForms.parent_url}"><b>{$aForms.parent_url}</b></a></span>
                
                {/if}
            
            
            </li>
			{*
			{if isset($aForms.parent_url)}
			*}
			<li>
				<label for="parent_url">VTD Page URL:</label>
				<input type="text" maxlength="255" size="60" style="width:600px;" id="parent_url" name="val[parent_url]" value="{value type='input' id='parent_url'}">
			</li>

			<li>
				<label for="parent_video_url">VTD Page Video URL:</label>
				<input type="text" maxlength="255" size="60" style="width:600px;" id="parent_video_url" name="val[parent_video_url]" value="{value type='input' id='parent_video_url'}">
				<p><strong>Note: VTD Page Video URL must end with:</strong><br/>
				For All Websites: <span style="color: #ff0000;font-weight:bold;">?video=WTVDVS_VIDEO_TEMP</span><br/>
				For CDK NextGen Websites: <span style="color: #ff0000;font-weight:bold;">?wtvVideo=WTVDVS_VIDEO_TEMP</span></p>
			</li>
			{*
			{else}
			{/if}
            *}
            <li>
                <label for="modal_player">Enable modal player window: </label>
                <input type="radio" name="val[modal_player]" value="1" {if $bIsEdit && isset($aForms.modal_player) && $aForms.modal_player == 1}checked="checked"{/if}/>{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[modal_player]" value="0" {if !$bIsEdit || !isset($aForms.modal_player) || ($bIsEdit && $aForms.modal_player == 0)}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>
        </ol>
    </fieldset>

    <h1>Inventory Overlay Player</h1>
    <fieldset>
        <ol>
            <li>
                <input type="radio" name="val[vpd_popup]" value="1" {if $bIsEdit && $aForms.vpd_popup == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[vpd_popup]" value="0" {if $bIsEdit && $aForms.vpd_popup == 0}checked="checked"{/if}  />{phrase var='dvs.dvs_inventory_status_off'}
            </li>
        </ol>
    </fieldset>

    <h1>Allowed Video Types</h1>
    <fieldset>
        <ol>
            <li>
                <label for="new_car_videos">New Car:</label>
                <input type="radio" name="val[new_car_videos]" value="1" {if $bIsEdit && $aForms.new_car_videos == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[new_car_videos]" value="0" {if $bIsEdit && $aForms.new_car_videos == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>

            <li>
                <label for="used_car_videos">Used Car:</label>
                <input type="radio" name="val[used_car_videos]" value="1" {if $bIsEdit && $aForms.used_car_videos == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[used_car_videos]" value="0" {if $bIsEdit && $aForms.used_car_videos == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>
        </ol>
    </fieldset> 
    
    <h1>SEO Settings</h1>
       <fieldset>                        
        <ol>
            <li>
                <label for="new_car_videos">Index:</label>
                <input type="radio" name="val[seo_index]" value="1" {if $bIsEdit && $aForms.seo_index == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />Index
                <input type="radio" name="val[seo_index]" value="0" {if $bIsEdit && $aForms.seo_index == 0}checked="checked"{/if} />No Index
            </li>

            <li>
                <label for="used_car_videos">Follow:</label>
                <input type="radio" name="val[seo_follow]" value="1" {if $bIsEdit && $aForms.seo_follow == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />Follow
                <input type="radio" name="val[seo_follow]" value="0" {if $bIsEdit && $aForms.seo_follow == 0}checked="checked"{/if} />No Follow
            </li>
        </ol>
    </fieldset>
    <h1>Email Lead Format</h1>
    <fieldset>
        <ol>
            <li>
                <input type="radio" name="val[email_format]" value="0" {if $aForms.email_format != 1}checked="checked"{/if} />Standard Email
                <input type="radio" name="val[email_format]" value="1" {if $bIsEdit && $aForms.email_format == 1}checked="checked"{/if} />ADF/XML
            </li>
        </ol>
    </fieldset>

    <h1>Reporting Settings</h1>
    <fieldset>
        <ol>
            <li>
                <input type="radio" name="val[reporting]" value="1" {if $bIsEdit && $aForms.reporting == 1}checked="checked"{/if} {if !$bIsEdit}checked="checked" {/if} />{phrase var='dvs.dvs_inventory_status_on'}
                <input type="radio" name="val[reporting]" value="0" {if $bIsEdit && $aForms.reporting == 0}checked="checked"{/if} />{phrase var='dvs.dvs_inventory_status_off'}
            </li>

            <li>
                <label for="reporting_email">Reporting Email:</label>
                <input type="text" maxlength="255" size="60" style="width:600px;" id="reporting_email" name="val[reporting_email]" value="{value type='input' id='reporting_email'}">
            </li>

            <li>
                <label for="reporting_time">Reporting Time:</label>
                <select name="val[reporting_time]" id="reporting_time">
                    <option value="weekly" {if $bIsEdit && $aForms.reporting_time=="weekly"}selected="selected"{/if}>Weekly</option>
                    <option value="monthly" {if $bIsEdit && $aForms.reporting_time=="monthly"}selected="selected"{/if}>Monthly</option>
                </select>
            </li>
        </ol>
    </fieldset>
	</div>
<br>
	{*
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
	*}
		

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