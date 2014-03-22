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
<div id="dvs_error_messages"></div>
{if $bCanAddPlayers || $bIsEdit}
<script type="text/javascript">
			var iSelectedMakes = 0;
	{if $bIsEdit}
	{foreach from = $aMakes item = aMake}
	{if isset($aMake.selected) && $aMake.selected}
	iSelectedMakes++;
	{/if}
	{/foreach}
	{/if}

	{if $bIsEdit}
	$Behavior.colorPick = function() {left_curly}
	$('#color_picker_player_background').ColorPickerSetColor('#{$aForms.player_background}');
			$('#color_picker_player_text').ColorPickerSetColor('#{$aForms.player_text}');
			$('#color_picker_player_buttons').ColorPickerSetColor('#{$aForms.player_buttons}');
			$('#color_picker_player_progress_bar').ColorPickerSetColor('#{$aForms.player_progress_bar}');
			$('#color_picker_player_button_icons').ColorPickerSetColor('#{$aForms.player_button_icons}');
			$('#color_picker_playlist_arrows').ColorPickerSetColor('#{$aForms.playlist_arrows}');
			$('#color_picker_playlist_border').ColorPickerSetColor('#{$aForms.playlist_border}');
	{if $aForms.player_type}
	iPreviewWidth = 640;
			iPreviewHeight = 360;
	{ else}
	iPreviewWidth = 920;
			iPreviewHeight = 522;
	{/if}
	{right_curly}
	{ else}
	$Behavior.colorPicker = function() {left_curly}
	$('#color_picker_player_background').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_player_text').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_player_buttons').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_player_progress_bar').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_player_button_icons').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_playlist_arrows').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_playlist_border').ColorPickerSetColor('#{$sDefaultColor}');
			iPreviewWidth = 910;
			iPreviewHeight = 522;
	{right_curly}
	{/if}

	{literal}
	$Behavior.multiSelect = function() {
	$("#makes").multiselect({
	header: false,
			click: function(event, ui){
			$('#make_select_' + ui.value).val((ui.checked ? 1 : 0));
					if (ui.checked)
			{
			iSelectedMakes++;
			}
			else
			{
			iSelectedMakes = iSelectedMakes - 1; ;
			}
			}
	});
	}
	function validateDvsForm()
	{
	clearErrors();
			if (iSelectedMakes <= 0)
	{
	validateError("{/literal}{phrase var='dvs.please_select_a_make_first'}{literal}", 'makes');
	}

	return window.bIsValid
	}

	{/literal}
</script>
<form id="add_player" method="post" action="{if $bIsDvs}{url link='dvs.player.add'}{else}{url link='idrive.add'}{/if}" onsubmit="return validateDvsForm();">

	<h3>{phrase var='dvs.player_info'}</h3>

	<fieldset>
		<ol>
			{if !$bIsDvs}
			<li>
				<label for="player_name">{phrase var='dvs.player_name'}:</label>
				<input type="text" name="val[player_name]" value="{value type='input' id='player_name'}" id="player_name" />
			</li>
			<li>
				<label for="player_type">{phrase var='idrive.player_type'}:</label>
				<select name="val[player_type]" id="player_type" onchange="newPlayerType($('#player_type').val())">
					{if Phpfox::getUserParam('idrive.enable_interactive_player')}<option value="0" {if isset($aForms) && $aForms.player_type == 0}selected="selected"{/if}}>{phrase var='idrive.interactive'}</option>{/if}
					{if Phpfox::getUserParam('idrive.single_player')}<option value="1" {if isset($aForms) && $aForms.player_type == 1}selected="selected"{/if}}>{phrase var='idrive.single'}</option>{/if}
				</select>
				<a href="#" onclick="tb_show('{phrase var='idrive.player_type' phpfox_squote=true}', $.ajaxBox('idrive.moreInfoPlayerType', 'height=180&amp;width=320')); return false;" />{phrase var='idrive.more_info'}</a>
			</li>
			<li>
				<label for="domain">{phrase var='idrive.domain_name'}:</label>
				<input type="text" name="val[domain]" value="{value type='input' id='domain'}" id="domain" size="40"/>
				<a href="#" onclick="tb_show('{phrase var='idrive.domain_name' phpfox_squote=true}', $.ajaxBox('idrive.moreInfoDomainName', 'height=180&amp;width=320')); return false;" />{phrase var='idrive.more_info'}</a>
			</li>
			{else}
			<input type="hidden" name="val[player_type]" value="0" />
			{/if}
			<li>
				<label for="makes">{phrase var='dvs.make'}:</label>
				<select name="val[makes]" id="makes" onchange="$.ajaxCall('dvs.getFeaturedModels', 'aMakes=' + $('#makes').val());" multiple="multiple">
					{foreach from=$aMakes item=aMake}
					<option value="{$aMake.make}"{if $bIsEdit && isset($aMake.selected)} selected="selected"{/if}>{$aMake.make}</option>
					{/foreach}
				</select>
				{foreach from=$aMakes item=aMake}
				<input type="hidden" value="{if $bIsEdit}{if isset($aMake.selected) && $aMake.selected}1{else}0{/if}{else}0{/if}" name="val[selected_makes][{$aMake.make}]" id="make_select_{$aMake.make}" class="player_make_select"/>
				{/foreach}
			</li>
			<li>
				<label for="featured_model">{phrase var='dvs.featured_model'}:</label>
				<div id="dvs_vehicle_select_model_container">
					<select id="featured_model" name="val[featured_model]">
						{if $bIsEdit}
						<option>{phrase var='dvs.select_model'}</option>
						{foreach from=$aModels item=aModel}
						<option value="{$aModel.year},{$aModel.make},{$aModel.model}"{if $aForms.featured_model == $aModel.model && $aForms.featured_year == $aModel.year}selected="selected"{/if}>{$aModel.year} {$aModel.make} {$aModel.model}</option>
						{/foreach}
						{else}
						<option>{phrase var='dvs.select_model'}</option>
						<option>{phrase var='dvs.please_select_a_make_first'}</option>
						{/if}
					</select>
				</div>
			</li>

			{if !$bIsDvs}
			<li>
				<label for="google_id">{phrase var='dvs.google_analytics_id'}:</label>
				<input type="text" name="val[google_id]" value="{value type='input' id='google_id'}" id="google_id" />
			</li>
			<li>
				<label for="email">{phrase var='idrive.email_address'}:</label>
				<input type="text" name="val[email]" value="{value type='input' id='email'}" id="email" />		
			</li>
			{/if}

			<li>
				<label for="autoplay">{phrase var='dvs.autoplay'}:</label>
				<input type="checkbox" name="val[autoplay]" id="autoplay" value="1" {if $bIsEdit}{if $aForms.autoplay}checked=checked{/if}{/if}/>
			</li>
			<li>
				<label for="autoadvance">{phrase var='dvs.auto_advance'}:</label>
				<input type="checkbox" name="val[autoadvance]" id="autoadvance" value="1" {if $bIsEdit}{if $aForms.autoadvance}checked=checked{/if}{/if}/>
			</li>
		</ol>
	</fieldset>

	<h3>{phrase var='dvs.player_colors'}</h3>

	<fieldset class="color_selectors">
		<legend>{phrase var='dvs.player'}</legend>
		<ol>
			<li>
				<label>{phrase var='dvs.background'}:</label>
				<div id="color_picker_player_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.player_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_player_background_input" name="val[player_background]" {if $bIsEdit}value="{$aForms.player_background}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
			<li>
				<label>{phrase var='dvs.text'}:</label>
				<div id="color_picker_player_text" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.player_text}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_player_text_input" name="val[player_text]"  {if $bIsEdit}value="{$aForms.player_text}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
		</ol>
	</fieldset>

	<fieldset>
		<legend>{phrase var='dvs.player_controls'}</legend>
		<ol>
			<li>
				<label>{phrase var='dvs.buttons'}:</label>
				<div id="color_picker_player_buttons" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.player_buttons}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_player_buttons_input" name="val[player_buttons]" {if $bIsEdit}value="{$aForms.player_buttons}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
			<li>
				<label>{phrase var='dvs.button_icons'}:</label>
				<div id="color_picker_player_button_icons" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.player_button_icons}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_player_button_icons_input" name="val[player_button_icons]" {if $bIsEdit}value="{$aForms.player_button_icons}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
			<li>
				<label>{phrase var='dvs.progress_bar'}:</label>
				<div id="color_picker_player_progress_bar" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.player_progress_bar}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_player_progress_bar_input" name="val[player_progress_bar]" {if $bIsEdit}value="{$aForms.player_progress_bar}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
		</ol>
	</fieldset>
	<fieldset>
		<legend>{phrase var='dvs.thumbnail_playlist'}</legend>
		<ol>
			<li>
				<label>{phrase var='dvs.prev_next_arrows'}:</label>
				<div id="color_picker_playlist_arrows" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.playlist_arrows}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_playlist_arrows_input" name="val[playlist_arrows]" {if $bIsEdit}value="{$aForms.playlist_arrows}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
			<li>
				<label>{phrase var='dvs.thumbnail_border'}:</label>
				<div id="color_picker_playlist_border" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.playlist_border}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_playlist_border_input" name="val[playlist_border]" {if $bIsEdit}value="{$aForms.playlist_border}"{else}value="{$sDefaultColor}"{/if}/>
			</li>
		</ol>
	</fieldset>

	<h3>{phrase var='dvs.player_branding'}</h3>

	<fieldset>
		<legend>Pre-Roll:</legend>
		<ol>
			<li>
				<a href="#" onclick="tb_show('{phrase var='dvs.pre_roll' phpfox_squote=true}', $.ajaxBox('dvs.moreInfoPrerollSwf', 'height=180&amp;width=320')); return false;">Pre-Roll Help</a>
			</li>
			<li>
				{if $bIsEdit}
				<label id="preroll_file_label">{phrase var='dvs.current_file'}:</label>
				{else}
				<label id="preroll_file_label">{phrase var='dvs.select_file'}:</label>
				{/if}

				<div id="js_preroll_file_upload_error" style="display:none;">
					<div class="error_message" id="js_preroll_file_upload_message"></div>		
					<div class="main_break"></div>
				</div>
				<iframe id="js_preroll_upload_frame" name="js_preroll_upload_frame" src="{if $bIsDvs}{url link='dvs.player.preroll-file-form'}{else}{url link='idrive.preroll-file-form'}{/if}{if $bIsEdit}current-preroll-id_{$aForms.preroll_file_id}{/if}" scrolling="no" frameborder="0" width="256" height="36" {if $bIsEdit}style="display:none;"{/if}></iframe>
				<div id="preroll_file_preview" {if !$bIsEdit}style="display: none"{/if}>
					 {if $bIsEdit}
					 {if $aForms.preroll_file_name}
					 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
						<param name="allowfullscreen" value="true" />
						<param name="movie" value="{$sSwfUrl}player.swf" />
						<param name="flashvars" value="{if $bIsDvs}{$sDvsUrl}{else}{$sIdriveUrl}{/if}preroll/{$aForms.preroll_file_name}" />	
						<param name="wmode" value="opaque" />
						<embed wmode="opaque" allowfullscreen="true" type="application/x-shockwave-flash" src="{$sSwfUrl}player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file={if $bIsDvs}{$sDvsUrl}{else}{$sIdriveUrl}{/if}preroll/{$aForms.preroll_file_name}" />
					</object>
					{else}
					{phrase var='dvs.no_pre_roll_swf'}
					{/if}
					<a href="#" onclick="window.parent.document.getElementById('preroll_file_label').innerHTML = '{phrase var='dvs.select_file'}:'; window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block'; window.parent.document.getElementById('preroll_file_preview').style.display = 'none'; return false;">{phrase var='dvs.change_pre_roll_swf'}</a> - <a href="#" onclick="if (confirm('Are you sure?')){l}window.parent.document.getElementById('preroll_file_label').innerHTML = '{phrase var='dvs.select_file'}:'; window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block'; window.parent.document.getElementById('preroll_file_preview').style.display = 'none'; window.parent.document.getElementById('preroll_file_id').value = 0; $.ajaxCall('{if $bIsDvs}dvs{else}idrive{/if}.removePrerollFile', 'iPrerollFileId={$aForms.preroll_file_id}'){r} return false;">{phrase var='dvs.remove_preroll_image'}</a>
					{/if}
				</div>
				<input type="hidden" id="preroll_file_id" name="val[preroll_file_id]" value="{if $bIsEdit}{$aForms.preroll_file_id}{else}0{/if}"/>
			</li>
			
			<li>
				<label for="preroll_duration">{phrase var='dvs.pre_roll_duration'}:</label>
				<input type="number" name="val[preroll_duration]" value="{value type='input' id='preroll_duration'}" id="preroll_duration" size="10" maxlength=3 />
			</li>
			<li>
				<label for="preroll_url">{phrase var='dvs.pre_roll_url'}:</label>
				<input type="text" name="val[preroll_url]" value="{value type='input' id='preroll_url'}" id="preroll_url" size="40"/>
				
			</li>
		</ol>
	</fieldset>

	{if $bIsDvs}
	<div id="custom_overlay_input_container">

		<h3>{phrase var='dvs.custom_video_overlays'}</h3>

		<fieldset>
			<legend>{phrase var='dvs.custom_overlay_1'}:</legend>
			<ol>
				<li>
					<label for="custom_overlay_1_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 0}checked="checked"{/if} value="0" name="val[custom_overlay_1_type]" id="custom_overlay_1_disabled" />

						   <label for="custom_overlay_1_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_1_type]" id="custom_overlay_1_price_overlay" />

						   <label for="custom_overlay_1_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').show('fast');" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 2 || !isset($aForms.custom_overlay_1_type)}checked="checked"{/if} value="2" name="val[custom_overlay_1_type]" id="custom_overlay_1_link_overlay" />
				</li>
				<li class="custom_overlay_1_extras {if isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type != 2}hidden{/if}">
					<label for="custom_overlay_1_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_1_text]" value="{value type='input' id='custom_overlay_1_text'}" id="custom_overlay_1_text" class="m_left_5"/>
				</li>
				<li class="custom_overlay_1_extras {if isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type != 2}hidden{/if}">
					<label for="custom_overlay_1_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_1_url]" value="{value type='input' id='custom_overlay_1_url'}" id="custom_overlay_1_url" class="m_top_left_5" />
				</li>
				<li>
					<label for="custom_overlay_1_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_1_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_1_start) && $aForms.custom_overlay_1_start}{$aForms.custom_overlay_1_start}{else}5{/if}" id="custom_overlay_1_start" class="m_top_left_5" size="5"/>
				</li>
				<li>
					<label for="custom_overlay_1_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_1_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_1_duration) && $aForms.custom_overlay_1_duration}{$aForms.custom_overlay_1_duration}{else}10{/if}" id="custom_overlay_1_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
		<fieldset>

			<legend>{phrase var='dvs.custom_overlay_2'}:</legend>
			<ol>
				<li>
					<label for="custom_overlay_2_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 0}checked="checked"{/if} value="0" name="val[custom_overlay_2_type]" id="custom_overlay_2_disabled" />

						   <label for="custom_overlay_2_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_2_type]" id="custom_overlay_2_price_overlay" />

						   <label for="custom_overlay_2_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').show('fast');" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 2 || !isset($aForms.custom_overlay_2_type)}checked="checked"{/if} value="2" name="val[custom_overlay_2_type]" id="custom_overlay_2_link_overlay" />
				</li>
				<li class="custom_overlay_2_extras {if isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type != 2}hidden{/if}">
					<label for="custom_overlay_2_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_2_text]" value="{value type='input' id='custom_overlay_2_text'}" id="custom_overlay_2_text" class="m_left_5" />
				</li>
				<li class="custom_overlay_2_extras {if isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type != 2}hidden{/if}">
					<label for="custom_overlay_2_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_2_url]" value="{value type='input' id='custom_overlay_2_url'}" id="custom_overlay_2_url" class="m_top_left_5" />
				</li>
				<li>
					<label for="custom_overlay_2_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_2_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_2_start) && $aForms.custom_overlay_2_start}{$aForms.custom_overlay_2_start}{else}35{/if}" id="custom_overlay_2_start" class="m_top_left_5" size="5"/>
				</li>
				<li>
					<label for="custom_overlay_2_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_2_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_2_duration) && $aForms.custom_overlay_2_duration}{$aForms.custom_overlay_2_duration}{else}10{/if}" id="custom_overlay_2_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
		<fieldset>
			<legend>{phrase var='dvs.custom_overlay_3'}:</legend>
			<ol>
				<li>

					<label for="custom_overlay_3_disabled" class="inline_radio">Disabled:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 0}checked="checked"{/if} value="0" name="val[custom_overlay_3_type]" id="custom_overlay_3_disabled" />

						   <label for="custom_overlay_3_price_overlay" class="inline_radio">Get Price Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').hide('fast');" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_3_type]" id="custom_overlay_3_price_overlay" />

						   <label for="custom_overlay_3_link_overlay" class="inline_radio">Link Overlay:</label> 
					<input type="radio" class="inline_radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').show('fast');" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 2 || !isset($aForms.custom_overlay_3_type)}checked="checked"{/if} value="2" name="val[custom_overlay_3_type]" id="custom_overlay_3_link_overlay" />
				</li>
				<li class="custom_overlay_3_extras {if isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type != 2}hidden{/if}">
					<label for="custom_overlay_3_text">Link Text:</label>
					<input type="text" name="val[custom_overlay_3_text]" value="{value type='input' id='custom_overlay_3_text'}" id="custom_overlay_3_text" class="m_left_5" />
				</li>
				<li class="custom_overlay_3_extras {if isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type != 2}hidden{/if}">
					<label for="custom_overlay_3_url">Link URL:</label>
					<input type="text" name="val[custom_overlay_3_url]" value="{value type='input' id='custom_overlay_3_url'}" id="custom_overlay_3_url" class="m_top_left_5" />
				</li>
				<li>
					<label for="custom_overlay_3_start">Start Time (seconds):</label>
					<input type="text" name="val[custom_overlay_3_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_3_start) && $aForms.custom_overlay_3_start}{$aForms.custom_overlay_3_start}{else}65{/if}" id="custom_overlay_3_start" class="m_top_left_5" size="5"/>
				</li>
				<li>
					<label for="custom_overlay_3_duration">Duration (seconds):</label>
					<input type="text" name="val[custom_overlay_3_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_3_duration) && $aForms.custom_overlay_3_duration}{$aForms.custom_overlay_3_duration}{else}10{/if}" id="custom_overlay_3_duration" class="m_top_left_5" size="5"/>
				</li>
			</ol>
		</fieldset>
	</div>
	{/if}
	<br>
	<fieldset>
		{if $bIsDvs}
		<input type="hidden" name="val[dvs_id]" value="{$iDvsId}">
		<input type="hidden" name="val[step]" value="player" />
		{else}
		<input type="hidden" name="val[action]" value="{if $bIsEdit && isset($aForms.player_id)}save{else}add{/if}" />
		<button class="button" onclick="$('#forward').val(1); $('#add_player').submit();" >{phrase var='idrive.get_code'}</button>
		{/if}
		<input type="hidden" name="val[forward]" id="forward" value="0" />
		{if $bIsEdit && isset($aForms.player_id)}<input type="hidden" name="val[player_id]" value="{$aForms.player_id}" />{/if}
		<button type="submit" class="button">{phrase var='dvs.save_settings'}</button>
		{if $bIsDvs}
		<button class="button" onclick='$.ajaxCall("dvs.previewPlayer",$("#add_player").serialize()); return false;'>{phrase var='dvs.save_and_preview'}</button>
		{else}
		<button class="button" onclick="tb_show('{phrase var='dvs.preview' phpfox_squote=true}', $.ajaxBox('idrive.previewPlayer', 'width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize())); return false;">{phrase var='idrive.preview_player'}</button>
		
		{/if}
	</fieldset>
</form>
{else}
<div class="error_message">
	{if $bIsEdit}
	{phrase var='dvs.error_editing_player'}
	{else}
	{phrase var='dvs.error_adding_player'}
	{/if}
</div>
{/if}