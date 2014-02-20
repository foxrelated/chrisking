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
			{foreach from=$aMakes item=aMake}
				{if isset($aMake.selected) && $aMake.selected}
					iSelectedMakes++;
				{/if}
			{/foreach}
		{/if}
			
		{if $bIsEdit}
			 $(document).ready(function() {left_curly}
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
				{else}
					iPreviewWidth = 920;
					iPreviewHeight = 522;
				{/if}
			 {right_curly});
		{else}
			 $(document).ready(function() {left_curly}
				 $('#color_picker_player_background').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_player_text').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_player_buttons').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_player_progress_bar').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_player_button_icons').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_playlist_arrows').ColorPickerSetColor('#{$sDefaultColor}');
				 $('#color_picker_playlist_border').ColorPickerSetColor('#{$sDefaultColor}');
				 
				iPreviewWidth = 910;
				iPreviewHeight = 522;
			 {right_curly});
		{/if}
			
		{literal}
			$(document).ready(function() {
				$("#makes").multiselect({
					header: false,
					click: function(event, ui){
						$('#make_select_'+ui.value).val((ui.checked ? 1 : 0));
						if (ui.checked)
						{
							iSelectedMakes++;
						}
						else
						{
							iSelectedMakes = iSelectedMakes - 1;;
						}
					}
				});
			});
			
			function validateDvsForm()
			{
				clearErrors();
				if (iSelectedMakes <= 0)
				{
					validateError("{/literal}{phrase var='dvs.please_select_a_make_first'}{literal}",'makes');
				}

				return window.bIsValid 
			}
		{/literal}
	</script>
	<h3>{phrase var='dvs.player_info'}</h3>
	<form method="post" action="{if $bIsDvs}{url link='dvs.player.add'}{else}{url link='idrive.add'}{/if}" onsubmit="return validateDvsForm();"  id="add_player" name="add_player">
		<table style="border-collapse: collapse;">
			{if !$bIsDvs}
				<tr>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						{phrase var='dvs.player_name'}:
					</td>
					<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<input type="text" name="val[player_name]" value="{value type='input' id='player_name'}" id="player_name" />
					</td>
				</tr>
			
				<tr>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						{phrase var='idrive.player_type'}:
					</td>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<select name="val[player_type]" id="player_type" onchange="newPlayerType($('#player_type').val())">
									{if Phpfox::getUserParam('idrive.enable_interactive_player')}<option value="0" {if isset($aForms) && $aForms.player_type == 0}selected="selected"{/if}}>{phrase var='idrive.interactive'}</option>{/if}
									{if Phpfox::getUserParam('idrive.single_player')}<option value="1" {if isset($aForms) && $aForms.player_type == 1}selected="selected"{/if}}>{phrase var='idrive.single'}</option>{/if}
						</select>
					</td>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<a href="#" onclick="tb_show('{phrase var='idrive.player_type' phpfox_squote=true}', $.ajaxBox('idrive.moreInfoPlayerType', 'height=180&amp;width=320'));" />{phrase var='idrive.more_info'}</a>
					</td>
				</tr>
				
				<tr>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						{phrase var='idrive.domain_name'}:
					</td>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<input type="text" name="val[domain]" value="{value type='input' id='domain'}" id="domain" size="40"/>
					</td>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<a href="#" onclick="tb_show('{phrase var='idrive.domain_name' phpfox_squote=true}', $.ajaxBox('idrive.moreInfoDomainName', 'height=180&amp;width=320'));" />{phrase var='idrive.more_info'}</a>
					</td>
				</tr>
			{else}
				<input type="hidden" name="val[player_type]" value="0" />
			{/if}

			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.make'}:
				</td>
				<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<select name="val[makes]" id="makes" onchange="$.ajaxCall('dvs.getFeaturedModels', 'aMakes=' + $('#makes').val());" multiple="multiple">
						{foreach from=$aMakes item=aMake}
							<option value="{$aMake.make}"{if $bIsEdit && isset($aMake.selected)} selected="selected"{/if}>{$aMake.make}</option>
						{/foreach}
					</select>
					{foreach from=$aMakes item=aMake}
						<input type="hidden" value="{if $bIsEdit}{if isset($aMake.selected) && $aMake.selected}1{else}0{/if}{else}0{/if}" name="val[selected_makes][{$aMake.make}]" id="make_select_{$aMake.make}" class="player_make_select"/>
					{/foreach}
				</td>
			</tr>
			
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.featured_model'}:
				</td>
				<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<span id="dvs_vehicle_select_model_container">
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
					</span>
				</td>
			</tr>
			
			{if !$bIsDvs}
				<tr>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						{phrase var='dvs.google_analytics_id'}:
					</td>
					<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<input type="text" name="val[google_id]" value="{value type='input' id='google_id'}" id="google_id" />
					</td>
				</tr>
				
				<tr>
					<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						{phrase var='idrive.email_address'}:
					</td>
					<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
						<input type="text" name="val[email]" value="{value type='input' id='email'}" id="email" />
					</td>
				</tr>
			{/if}
			
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.autoplay'}:
				</td>
				<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<input type="checkbox" name="val[autoplay]" id="autoplay" value="1" {if $bIsEdit}{if $aForms.autoplay}checked=checked{/if}{/if}/>
				</td>
			</tr>
			
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.auto_advance'}:
				</td>
				<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<input type="checkbox" name="val[autoadvance]" id="autoadvance" value="1" {if $bIsEdit}{if $aForms.autoadvance}checked=checked{/if}{/if}/>
				</td>
			</tr>
			
		</table>
		
		<br />
		<h3>{phrase var='dvs.player_colors'}</h3>
		
		<table>
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.player'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.background'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_player_background" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.player_background}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_player_background_input" name="val[player_background]" {if $bIsEdit}value="{$aForms.player_background}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.text'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_player_text" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.player_text}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_player_text_input" name="val[player_text]"  {if $bIsEdit}value="{$aForms.player_text}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
			</tr>

			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.player_controls'}
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.buttons'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_player_buttons" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.player_buttons}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_player_buttons_input" name="val[player_buttons]" {if $bIsEdit}value="{$aForms.player_buttons}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.button_icons'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_player_button_icons" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.player_button_icons}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_player_button_icons_input" name="val[player_button_icons]" {if $bIsEdit}value="{$aForms.player_button_icons}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
			</tr>

			<tr class="tr_interactive"{if $bIsEdit && $aForms.player_type} style="display:none;"{/if}>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					&nbsp;
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.progress_bar'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_player_progress_bar" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.player_progress_bar}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_player_progress_bar_input" name="val[player_progress_bar]" {if $bIsEdit}value="{$aForms.player_progress_bar}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					&nbsp;
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">

				</td>
			</tr>
			
			<tr class="tr_interactive"{if $bIsEdit && $aForms.player_type} style="display:none;"{/if}>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.thumbnail_playlist'}
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.prev_next_arrows'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_playlist_arrows" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.playlist_arrows}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_playlist_arrows_input" name="val[playlist_arrows]" {if $bIsEdit}value="{$aForms.playlist_arrows}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;">
					{phrase var='dvs.thumbnail_border'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<div id="color_picker_playlist_border" class="colorSelector">	
						<div style="background-color: #{if $bIsEdit}{$aForms.playlist_border}{else}{$sDefaultColor}{/if}"></div>
					</div>
					<input type="hidden" id="color_picker_playlist_border_input" name="val[playlist_border]" {if $bIsEdit}value="{$aForms.playlist_border}"{else}value="{$sDefaultColor}"{/if}/>
				</td>
			</tr>
		</table>

		<br />
		<h3>{phrase var='dvs.player_branding'}</h3>

		<table>
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.pre_roll'}:
				</td>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;" id="preroll_file_label">
					{if $bIsEdit}
						{phrase var='dvs.current_file'}
					{else}
						{phrase var='dvs.select_file'}
					{/if}:
				</td>
				<td colspan="2" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:middle">
					<div id="js_preroll_file_upload_error" style="display:none;">
						<div class="error_message" id="js_preroll_file_upload_message"></div>		
						<div class="main_break"></div>
					</div>
					<iframe id="js_preroll_upload_frame" name="js_preroll_upload_frame" src="{if $bIsDvs}{url link='dvs.player.preroll-file-form'}{else}{url link='idrive.preroll-file-form'}{/if}{if $bIsEdit}current-preroll-id_{$aForms.preroll_file_id}{/if}" scrolling="no" frameborder="0" width="180" height="24" {if $bIsEdit}style="display:none;"{/if}></iframe>
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
							<br />
							<a href="#" onclick="window.parent.document.getElementById('preroll_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block';window.parent.document.getElementById('preroll_file_preview').style.display = 'none';">{phrase var='dvs.change_pre_roll_swf'}</a> - <a href="#" onclick="if (confirm('Are you sure?')){l}window.parent.document.getElementById('preroll_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_preroll_upload_frame').style.display = 'block';window.parent.document.getElementById('preroll_file_preview').style.display = 'none';window.parent.document.getElementById('preroll_file_id').value = 0;$.ajaxCall('{if $bIsDvs}dvs{else}idrive{/if}.removePrerollFile','iPrerollFileId={$aForms.preroll_file_id}'){r}">{phrase var='dvs.remove_preroll_image'}</a>
						 {/if}
					</div>
					<input type="hidden" id="preroll_file_id" name="val[preroll_file_id]" value="{if $bIsEdit}{$aForms.preroll_file_id}{else}0{/if}"/>
				</td>
				<td>
					<a href="#" onclick="tb_show('{phrase var='dvs.pre_roll' phpfox_squote=true}', $.ajaxBox('dvs.moreInfoPrerollSwf', 'height=180&amp;width=320'));" />{phrase var='dvs.more_info'}</a>
				</td>
			</tr>

			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.pre_roll_duration'}:
				</td>
				<td colspan="4" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<input type="text" name="val[preroll_duration]" value="{value type='input' id='preroll_duration'}" id="preroll_duration" size="10"/>
				</td>
			</tr>
			
			<tr>
				<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					{phrase var='dvs.pre_roll_url'}:
				</td>
				<td colspan="3" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
					<input type="text" name="val[preroll_url]" value="{value type='input' id='preroll_url'}" id="preroll_url" size="40"/>
				</td>
				<td>
					<a href="#" onclick="tb_show('{phrase var='dvs.pre_roll' phpfox_squote=true}', $.ajaxBox('dvs.moreInfoPrerollDuration', 'height=180&amp;width=320'));" />{phrase var='dvs.more_info'}</a>
				</td>
			</tr>
		</table>
		
		{if $bIsDvs}
		<div id="custom_overlay_input_container">
			<h3>{phrase var='dvs.custom_video_overlays'}</h3>
			<table>
					<tr class="underline_tr">
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
							{phrase var='dvs.custom_overlay_1'}:
						</td>
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;" id="preroll_file_label">
							Disabled: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 0 || $bIsEdit && !isset($aForms.custom_overlay_1_type) || !isset($bEdit) || !$bEdit}checked="checked"{/if} value="0" name="val[custom_overlay_1_type]" /><br />
							Get Price Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_1_type]" /><br />
							Link Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_1_extras').show('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 2}checked="checked"{/if} value="2" name="val[custom_overlay_1_type]" /><br />
						</td>
						<td colspan="3" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:middle">
							<table>
								<tr class="custom_overlay_1_extras"{if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link Text:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_1_text]" value="{value type='input' id='custom_overlay_1_text'}" id="custom_overlay_1_text" class="m_left_5"/>
									</td>
								</tr>

								<tr class="custom_overlay_1_extras"{if $bIsEdit && isset($aForms.custom_overlay_1_type) && $aForms.custom_overlay_1_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link URL:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_1_url]" value="{value type='input' id='custom_overlay_1_url'}" id="custom_overlay_1_url" class="m_top_left_5" />
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Start Time (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_1_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_1_start) && $aForms.custom_overlay_1_start}{$aForms.custom_overlay_1_start}{else}5{/if}" id="custom_overlay_1_start" class="m_top_left_5" size="5"/>
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Duration (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_1_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_1_duration) && $aForms.custom_overlay_1_duration}{$aForms.custom_overlay_1_duration}{else}10{/if}" id="custom_overlay_1_duration" class="m_top_left_5" size="5"/>
									</td>
								</tr>
							</table>

						</td>
					</tr>

					<tr class="underline_tr">
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
							{phrase var='dvs.custom_overlay_2'}:
						</td>
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;" id="preroll_file_label">
							Disabled: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 0 || $bIsEdit && !isset($aForms.custom_overlay_2_type) || !isset($bEdit) || !$bEdit}checked="checked"{/if} value="0" name="val[custom_overlay_2_type]" /><br />
							Get Price Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_2_type]" /><br />
							Link Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_2_extras').show('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 2}checked="checked"{/if} value="2" name="val[custom_overlay_2_type]" /><br />
						</td>
						<td colspan="3" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:middle">
							<table>
								<tr class="custom_overlay_2_extras"{if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link Text:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_2_text]" value="{value type='input' id='custom_overlay_2_text'}" id="custom_overlay_2_text" class="m_left_5" />
									</td>
								</tr>

								<tr class="custom_overlay_2_extras"{if $bIsEdit && isset($aForms.custom_overlay_2_type) && $aForms.custom_overlay_2_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link URL:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_2_url]" value="{value type='input' id='custom_overlay_2_url'}" id="custom_overlay_2_url" class="m_top_left_5" />
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Start Time (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_2_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_2_start) && $aForms.custom_overlay_2_start}{$aForms.custom_overlay_2_start}{else}35{/if}" id="custom_overlay_2_start" class="m_top_left_5" size="5"/>
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Duration (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_2_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_2_duration) && $aForms.custom_overlay_2_duration}{$aForms.custom_overlay_2_duration}{else}10{/if}" id="custom_overlay_2_duration" class="m_top_left_5" size="5"/>
									</td>
								</tr>
							</table>

						</td>
					</tr>

					<tr class="underline_tr">
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;">
							{phrase var='dvs.custom_overlay_3'}:
						</td>
						<td style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:right;" id="preroll_file_label">
							Disabled: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 0 || $bIsEdit && !isset($aForms.custom_overlay_3_type) || !isset($bEdit) || !$bEdit}checked="checked"{/if} value="0" name="val[custom_overlay_3_type]" /><br />
							Get Price Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').hide('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 1}checked="checked"{/if} value="1" name="val[custom_overlay_3_type]" /><br />
							Link Overlay: <input type="radio" onchange="if ($(this).attr('checked') == 'checked')$('.custom_overlay_3_extras').show('fast');;" {if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 2}checked="checked"{/if} value="2" name="val[custom_overlay_3_type]" /><br />
						</td>
						<td colspan="3" style="padding-top: .5em; padding-bottom: .5em; padding-right: 1em;text-align:middle">
							<table>
								<tr class="custom_overlay_3_extras"{if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link Text:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_3_text]" value="{value type='input' id='custom_overlay_3_text'}" id="custom_overlay_3_text" class="m_left_5" />
									</td>
								</tr>

								<tr class="custom_overlay_3_extras"{if $bIsEdit && isset($aForms.custom_overlay_3_type) && $aForms.custom_overlay_3_type == 2}{else} style="display:none"{/if}>
									<td class="override_input_label_td">
										Link URL:
									</td>
									<td>
										<input type="text" name="val[custom_overlay_3_url]" value="{value type='input' id='custom_overlay_3_url'}" id="custom_overlay_3_url" class="m_top_left_5" />
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Start Time (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_3_start]" value="{if $bIsEdit && isset($aForms.custom_overlay_3_start) && $aForms.custom_overlay_3_start}{$aForms.custom_overlay_3_start}{else}65{/if}" id="custom_overlay_3_start" class="m_top_left_5" size="5"/>
									</td>
								</tr>

								<tr>
									<td class="override_input_label_td">
										Duration (seconds):
									</td>
									<td>
										<input type="text" name="val[custom_overlay_3_duration]" value="{if $bIsEdit && isset($aForms.custom_overlay_3_duration) && $aForms.custom_overlay_3_duration}{$aForms.custom_overlay_3_duration}{else}10{/if}" id="custom_overlay_3_duration" class="m_top_left_5" size="5"/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		{/if}
		
		{if $bIsDvs}
			<input type="hidden" name="val[dvs_id]" value="{$iDvsId}">
			<input type="hidden" name="val[step]" value="player" />
		{else}
			<input type="hidden" name="val[action]" value="{if $bIsEdit && isset($aForms.player_id)}save{else}add{/if}" />
			<input type="button" value="{phrase var='idrive.get_code'}" class="button" onclick="$('#forward').val(1);$('#add_player').submit();" />&nbsp;&nbsp;&nbsp;&nbsp;
		{/if}
		<input type="hidden" name="val[forward]" id="forward" value="0" />
		{if $bIsEdit && isset($aForms.player_id)}<input type="hidden" name="val[player_id]" value="{$aForms.player_id}" />{/if}
		<input type="button" value="{phrase var='dvs.save_settings'}" class="button" onclick="$('#add_player').submit();" />&nbsp;&nbsp;&nbsp;&nbsp;
		{if $bIsDvs}
			<input type="button" value="{phrase var='dvs.preview_player'}" class="button" onclick="tb_show('{phrase var='dvs.preview' phpfox_squote=true}', $.ajaxBox('dvs.previewPlayer', 'width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize()));" />
		{else}
			<input type="button" value="{phrase var='idrive.preview_player'}" class="button" onclick="tb_show('{phrase var='dvs.preview' phpfox_squote=true}', $.ajaxBox('idrive.previewPlayer', 'width=' + iPreviewWidth + '&amp;height=' + iPreviewHeight + '&amp;' + $('#add_player').serialize()));" />
		{/if}
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