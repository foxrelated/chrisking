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
				$('#title_url_display').html('Please enter a dealer name.');
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
{/literal}
<form method="post" action="{url link='dvs.index'}" id="add_dvs" name="add_dvs">
	<table class="dvs_add_table">
		<tr>
			<td class="dvs_add_td">
				{required}{phrase var='dvs.dealer_name'}:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[dealer_name]" value="{value type='input' id='dealer_name'}" id="dealer_name" maxlength=30 required "/>
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.dealer_name_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{required}{phrase var='dvs.showroom_name'}:
			</td>
			<td class="dvs_add_td">
				{if !$bIsEdit}
				<input type="text"  maxlength=30 required name="val[dvs_name]" value="{value type='input' id='dvs_name'}" id="dvs_name" />
				{/if}
				{if $bIsEdit && Phpfox::isAdmin()}
				<input type="text"  maxlength=30 required name="val[dvs_name]" value="{value type='input' id='dvs_name'}" id="dvs_name" />
				{/if}
				{if $bIsEdit && !Phpfox::isAdmin()}
				<p>&nbsp;{$aForms.dvs_name}</p>
				{/if}
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.showroom_name_phrase'}
			</td>
		</tr>
		
		{if !$bIsEdit || Phpfox::isAdmin()}
		<tr>
			<td class="dvs_add_td">
				{required}{phrase var='dvs.vanity_url'}:
			</td>
			<td class="dvs_add_td">
				{if $bIsEdit}
				<input type="text"  maxlength=30 required name="val[vanity_url]" value="{value type='input' id='title_url'}" id="vanity_url" />
				{else}
				<input type="text"  maxlength=30 required name="val[vanity_url]" value="{value type='input' id='vanity_url'}" id="vanity_url" />
				{/if}
			</td>
			<td class="dvs_add_td">
			</td>
		</tr>
		{/if}
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<span id="title_url_display">&nbsp;{if $bIsEdit}{if $bSubdomainMode}{url link=$aForms.title_url}{else}{url link='dvs'}{$aForms.title_url}{/if}{else}{phrase var='dvs.please_enter_a_vanity_url_above'}{/if}</span>
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{required}{phrase var='dvs.address'}:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[address]" value="{value type='input' id='address'}" id="address" maxlength=30 required />
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.address_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{required}{phrase var='dvs.city'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="text" name="val[city]" value="{value type='input' id='city'}" id="city" maxlength=30 required />
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{required}State:
			</td>
			<td colspan="2" class="dvs_add_td">
				{if $bIsEdit}
					{module name='core.country-child' country_child_id=$aForms.country_child_id}
				{else}
					{module name='core.country-child'}
				{/if}
			</td>
		</tr>
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.zip_code'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="text" name="val[postal_code]" value="{value type='input' id='postal_code'}" id="postal_code" size="5" maxlength="5" />
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.contact_phone'}:
			</td>
			<td class="dvs_add_td">
				<input type="tel" name="val[phone]" maxlength=11 value="{value type='input' id='phone'}" id="phone" />
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.phone_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.contact_email'}:
			</td>
			<td class="dvs_add_td">
				<input type="email" name="val[email]" value="{value type='input' id='email'}" id="email"  size="30" maxlength=30 />
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.contact_email_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.website_url'}:
			</td>
			<td class="dvs_add_td">
				<input type="url" name="val[url]" value="{value type='input' id='url'}" id="url" size="30" maxlength=60/>
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.website_url_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.inventory_url'}:
			</td>
			<td class="dvs_add_td">
				<input type="url" name="val[inventory_url]" value="{value type='input' id='inventory_url'}" id="inventory_url"  size="30" maxlength=60/>
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.inventory_url_phrase'}
			</td>
		</tr>

		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.dealer_specials_url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="url" name="val[specials_url]" value="{value type='input' id='specials_url'}" id="specials_url" size="30" maxlength=60 />
			</td>
		</tr>

		{*<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.youtube_url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="url" name="val[youtube_url]" value="{value type='input' id='youtube_url'}" id="youtube_url" size="30" maxlength=60 />
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.facebook_url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="url" name="val[facebook_url]" value="{value type='input' id='facebook_url'}" id="facebook_url" size="30" maxlength=60 />
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.twitter_url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="url" name="val[twitter_url]" value="{value type='input' id='twitter_url'}" id="twitter_url" size="30" maxlength=60 />
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.google_plus_url'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="url" name="val[google_url]" value="{value type='input' id='google_url'}" id="google_url" size="30" maxlength=60 />
			</td>
		</tr>
		*}
		<tr>
			<td colspan="2" class="dvs_add_td">
				{phrase var='dvs.welcome_greeting_max_char_max' max=$iWelcomeGreetingMaxChars}:
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.welcome_message_phrase'}
			</td>
		</tr>
		<tr>
			<td colspan="3" class="dvs_add_td">
				{editor id='welcome' rows='5'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.custom_seo_tags'}:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[seo_tags]" value="{value type='input' id='seo_tags'}" id="seo_tags" maxlength=100 />
			</td>
			<td class="dvs_add_td">
				{phrase var='dvs.seo_tags_phrase'}
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td">
				{phrase var='dvs.google_analytics_id'}:
			</td>
			<td colspan="2" class="dvs_add_td">
				<input type="text" name="val[dvs_google_id]" value="{value type='input' id='dvs_google_id'}" id="dvs_google_id" maxlength=30 />
			</td>
		</tr>
	</table>
	
	
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
						<input class="phrase_override_input" type="text" name="val[phrase_overrides][{$sPhraseVar}]" value="{if $sPhraseText}{$sPhraseText}{/if}" id="{$sPhraseVar}" size="60" maxlength=60 />
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
					<input class="phrase_override_input" type="text" name="val[1onone_override]" value="{if $bIsEdit && isset($aForms.1onone_override)}{$aForms.1onone_override}{/if}" id="1onone_override" size="60" maxlength=60 />
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
						<input class="phrase_override_input" type="text" name="val[new2u_override]" value="{if $bIsEdit && isset($aForms.new2u_override)}{$aForms.new2u_override}{/if}" id="new2u_override" size="60" maxlength=60 />
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
						<input class="phrase_override_input" type="text" name="val[top200_override]" value="{if $bIsEdit && isset($aForms.top200_override)}{$aForms.top200_override}{/if}" id="top200_override" size="60" maxlength=60 />
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
		<input type="submit" value="{if $bIsEdit && isset($aForms.dvs_id)}{phrase var='dvs.save_changes'}{else}{phrase var='dvs.save_and_continue'}{/if}" class="button"/>
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