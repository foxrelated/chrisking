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
<script type="text/javascript">
    {literal}
    $Behavior.changeFontFamilyInit = function() {
        var aFontFamilies = [
            'Georgia, serif',
            '"Palatino Linotype", "Book Antiqua", Palatino, serif',
            '"Times New Roman", Times, serif',
            'Arial, Helvetica, sans-serif',
            '"Arial Black", Gadget, sans-serif',
            '"Comic Sans MS", cursive, sans-serif',
            'Impact, Charcoal, sans-serif',
            '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
            'Tahoma, Geneva, sans-serif',
            '"Trebuchet MS", Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif',
            '"Courier New", Courier, monospace','"Lucida Console", Monaco, monospace'
        ];

        var iStart = parseInt($('#font_family_id').val());
        $('#preview_wrapper').css('fontFamily', aFontFamilies.slice(iStart, iStart + 1).toString());


        $('#font_family_id').change(function() {
            iStart = parseInt($('#font_family_id').val());
            $('#preview_wrapper').css('fontFamily', aFontFamilies.slice(iStart, iStart + 1).toString());
        });
    };
    {/literal}


	{if $bIsEdit}
		$Behavior.colorPicker = function() {l}
			$('#color_picker_menu_background').ColorPickerSetColor('#{$aForms.menu_background}');
			$('#color_picker_menu_link').ColorPickerSetColor('#{$aForms.menu_link}');
			$('#color_picker_page_background').ColorPickerSetColor('#{$aForms.page_background}');
			$('#color_picker_page_text').ColorPickerSetColor('#{$aForms.page_text}');
			$('#color_picker_button_background').ColorPickerSetColor('#{$aForms.button_background}');
			$('#color_picker_button_text').ColorPickerSetColor('#{$aForms.button_text}');
			$('#color_picker_button_top_gradient').ColorPickerSetColor('#{$aForms.button_top_gradient}');
			$('#color_picker_button_bottom_gradient').ColorPickerSetColor('#{$aForms.button_bottom_gradient}');
			$('#color_picker_button_border').ColorPickerSetColor('#{$aForms.button_border}');
			$('#color_picker_text_link').ColorPickerSetColor('#{$aForms.text_link}');
			$('#color_picker_footer_link').ColorPickerSetColor('#{$aForms.footer_link}');
            $('#color_picker_iframe_background').ColorPickerSetColor('#{$aForms.iframe_background}');
            $('#color_picker_iframe_text').ColorPickerSetColor('#{$aForms.iframe_text}');
            $('#color_picker_iframe_contact_background').ColorPickerSetColor('#{$aForms.iframe_contact_background}');
            $('#color_picker_iframe_contact_text').ColorPickerSetColor('#{$aForms.iframe_contact_text}');
            $('#color_picker_vin_top_gradient').ColorPickerSetColor('#{$aForms.vin_top_gradient}');
            $('#color_picker_vin_bottom_gradient').ColorPickerSetColor('#{$aForms.vin_bottom_gradient}');
            $('#color_picker_vin_text_color').ColorPickerSetColor('#{$aForms.vin_text_color}');
            $('#color_picker_vin_text_color').ColorPickerSetColor('#{$aForms.vin_text_color}');
            
            $('#color_picker_player_background').ColorPickerSetColor('#{$aFormss.player_background}');
            $('#color_picker_player_text').ColorPickerSetColor('#{$aFormss.player_text}');
            $('#color_picker_player_buttons').ColorPickerSetColor('#{$aFormss.player_buttons}');
            $('#color_picker_player_progress_bar').ColorPickerSetColor('#{$aFormss.player_progress_bar}');
            $('#color_picker_player_button_icons').ColorPickerSetColor('#{$aFormss.player_button_icons}');
            $('#color_picker_playlist_arrows').ColorPickerSetColor('#{$aFormss.playlist_arrows}');
            $('#color_picker_playlist_border').ColorPickerSetColor('#{$aFormss.playlist_border}');
			{r}
	{else}
		$Behavior.colorPicker = function() {l}
			$('#color_picker_menu_background').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_menu_link').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_page_background').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_page_text').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_button_background').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_button_text').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_button_top_gradient').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_button_bottom_gradient').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_button_border').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_text_link').ColorPickerSetColor('#{$sDefaultColor}');
			$('#color_picker_footer_link').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_iframe_background').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_iframe_text').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_iframe_contact_background').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_iframe_contact_text').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_vin_top_gradient').ColorPickerSetColor('#A764C5');
            $('#color_picker_vin_bottom_gradient').ColorPickerSetColor('#451656');
            $('#color_picker_vin_text_color').ColorPickerSetColor('#451656');
            $('#color_picker_player_background').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_text').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_buttons').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_progress_bar').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_button_icons').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_playlist_arrows').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_playlist_border').ColorPickerSetColor('#{$sDefaultColor}');
		{r}
	{/if}
</script>

<style type="text/css">
	#dvs_container {l}
		position:relative;
		width: 670px;
		height: 270px;
		margin-left: auto;
		margin-right: auto;
		color: #{if $bIsEdit}{$aForms.page_background}{else}c5c5c5{/if};
		background: #{if $bIsEdit}{$aForms.page_background}{else}c5c5c5{/if};
	{r}
	
	#preview_menu_container {l}
		top:0px;
		position:absolute;
		width: 670px;
		padding-left:10px;
		padding-top:3px;
		height:22px;
		text-align:left;
		background: none repeat scroll 0 0 #{if $bIsEdit}{$aForms.menu_background}{else}c5c5c5{/if};
		font-size: 1.2em;
	{r}
	
	.dvs_top_menu_link {l}
		margin-right:10px;
		color: #{if $bIsEdit}{$aForms.menu_link}{else}{$sDefaultColor}{/if}
	{r}
	
	#preview_vehicle_select_container {l}
		position: absolute;
		top: 30px;
		left:500px;
		width:160px;
		height:52px;
		color: #{if $bIsEdit}{$aForms.page_text}{else}c5c5c5{/if};
		font-weight: bold;
	{r}
	
	.preview_select {l}
		width:160px;
		-webkit-border-top-left-radius: 10px;
		-webkit-border-bottom-left-radius: 10px;
		-webkit-border-top-right-radius: 10px;
		-webkit-border-bottom-right-radius: 10px;
		-moz-border-radius-topleft: 10px;
		-moz-border-radius-bottomleft: 10px;
		-moz-border-radius-topright: 10px;
		-moz-border-radius-bottomright: 10px;
		border-top-left-radius: 10px;
		border-bottom-left-radius: 10px;
		border-top-right-radius: 10px;
		border-bottom-right-radius: 10px;
		padding:5px;
		margin-bottom: 7px;
		font-weight:bold;
		border: 1px solid #{if $bIsEdit}{$aForms.button_border}{else}c5c5c5{/if};
		color: #{if $bIsEdit}{$aForms.button_text}{else}c5c5c5{/if};
		background: #{if $bIsEdit}{$aForms.button_background}{else}c5c5c5{/if};
	{r}
	
	#preview_cta_button_container {l}
		position: absolute;
		top: 30px;
		left:500px;
		width:160px;
		height:128px;
		font-weight: bold;
	{r}
	
	#preview_social_button_container {l}
		position: absolute;
		top: 215px;
		left:500px;
		width:160px;
		height:32px;
		font-weight: bold;
	{r}
	
	.dvs_social_button_link {l}
		margin-right:5px;
	{r}
	
	#preview_player_container {l}
		position: absolute;
		margin-left: 10px;
		margin-right: 10px;
		height:100px;
		top:30px;
		width:470px;
		text-align:left;
		background:#000;
		color:#ccc;
	{r}
	
	#player_mockup {l}
		text-align:center;
		color:#fff;
		font-size:2em;
		font-weight:bold;
		letter-spacing:1px;
		padding-top:25px;
	{r}
	
	#preview_now_playing_container {l}
		position: relative;
		top: 140px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
		color: #{if $bIsEdit}{$aForms.page_text}{else}c5c5c5{/if};
    {r}
	
	#preview_dealer_info_container {l}
		position: absolute;
		top: 180px;
		width:320px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
	{r}
	
	.preview_dealer_info {l}
		color: #{if $bIsEdit}{$aForms.page_text}{else}c5c5c5{/if};
	{r}
	
	#preview_dealer_website_link {l}
		color: #{if $bIsEdit}{$aForms.text_link}{else}c5c5c5{/if};
	{r}
	
	#preview_container {l}
		position: relative;
		text-align: left;
	{r}
	
	#preview_wrapper {l}
		margin-left:60px;
		overflow: hidden;
	{r}
	
	.dvs_c2a_button {l}
		background-color:#{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if};
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if};), color-stop(1, #{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if}) );
		background:-moz-linear-gradient( center top, #{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if} 5%, #{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if} 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if}', endColorstr='#{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if}');
		border:1px solid #{if $bIsEdit}{$aForms.button_border}{else}000000{/if};
		color:#{if $bIsEdit}{$aForms.button_text}{else}ffffff{/if};
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		border-radius:10px;
		display:inline-block;
		font-family:arial;
		font-size:1.5em;
		font-weight:bold;
		padding:2px 0px;
		text-decoration:none;
		width:160px;
		text-align:center;
		margin-bottom:3px;
	{r}

	.dvs_c2a_button:active {l}
		position:relative;
		top:1px;
	{r}

	.dvs_c2a_button:hover {l}
		background-color:#{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if};
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if}), color-stop(1, #{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if}) );
		background:-moz-linear-gradient( center top, #{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if} 5%, #{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if} 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#{if $bIsEdit}{$aForms.button_bottom_gradient}{else}000000{/if}', endColorstr='#{if $bIsEdit}{$aForms.button_top_gradient}{else}ffffff{/if}');
		
		text-decoration:none;
		color:#{if $bIsEdit}{$aForms.button_text}{else}ffffff{/if};
	{r}
	
	#preview_footer_container {l}
		top:250px;
		position:absolute;
		width: 670px;
		padding-left:10px;
		text-align:left;
		text-align:center;
		font-size: 1.25em;
		font-weight:bold;
		color: #{if $bIsEdit}{$aForms.footer_link}{else}c5c5c5{/if};
	{r}
	
	.dvs_footer_link {l}
		margin-right:10px;
	{r}

    /*Custom Css*/
    #add_dvs_customize legend{l}
        color: #333;
    font-size: 14px;
    font-weight: bold;
    padding-bottom: 10px;
    {r}
    #add_dvs_customize ol li{l}
/*            background: #999999;*/
    background: rgba(194,194,194,.1);
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -khtml-border-radius: 5px;
    border-radius: 5px;
    line-height: 30px;
    list-style: none;
    padding: 5px 10px;
    margin-bottom: 2px;
    {r}
    #add_dvs_customize fieldset{l}
    border:none;
    margin-bottom:10px;
    {r}
    #add_dvs_customize label {l}
    float: left;
    font-size: 13px;
    width: 150px;
    {r}
</style>
<form method="post" action="{url link='dvs.index'}" id="add_dvs_customize" name="add_dvs_customize">
	<h3>Branding</h3>
	<div id="error_message" class="error_message" style="display:none"></div>
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td">
				{phrase var='dvs.banner_image'}:
			</td>
			<td class="dvs_add_td">
				<span id="branding_file_label">
				{if $bIsEdit}
					{phrase var='dvs.current_image'}
				{else}
					{phrase var='dvs.select_file'}
				{/if}:
				</span>
				<iframe id="js_branding_upload_frame" name="js_branding_upload_frame" src="{url link='dvs.branding-file-form'}{if $bIsEdit}current-branding-id_{$aForms.branding_file_id}{/if}" scrolling="no" frameborder="0" width="250" height="35" {if $bIsEdit}style="display:none;"{/if}></iframe>
				<div id="branding_file_preview" {if !$bIsEdit}style="display: none"{/if}>
					 {if $bIsEdit}
						{if $aForms.branding_file_name}
							{img path='core.url_file' file='dvs/branding/'.$aForms.branding_file_name max_width=180 max_height=180}
						{else}
							{phrase var='dvs.no_branding_file'}
						{/if}
						 <br />
						<a href="#" onclick="window.parent.document.getElementById('branding_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_branding_upload_frame').style.display = 'block';window.parent.document.getElementById('branding_file_preview').style.display = 'none';">{phrase var='dvs.change_branding_image'}</a> - <a href="#" onclick="if (confirm('Are you sure?')){l}window.parent.document.getElementById('branding_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_branding_upload_frame').style.display = 'block';window.parent.document.getElementById('branding_file_preview').style.display = 'none';window.parent.document.getElementById('branding_file_id').value = 0;$.ajaxCall('dvs.removeBrandingFile','iBrandingFileId={$aForms.branding_file_id}'){r}">{phrase var='dvs.remove_branding_image'}</a>
					{/if}
				</div>
				<input type="hidden" id="branding_file_id" name="val[branding_file_id]" value="{if $bIsEdit}{$aForms.branding_file_id}{else}0{/if}"/>
			</td>
		</tr>
	</table>
	<!-- 
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td">
				{phrase var='dvs.background_image'}:
			</td>
			<td class="dvs_add_td">
				<span id="background_file_label">
				{if $bIsEdit}
					{phrase var='dvs.current_image'}
				{else}
					{phrase var='dvs.select_file'}
				{/if}:
				</span>
				<iframe id="js_background_upload_frame" name="js_background_upload_frame" src="{url link='dvs.background-file-form'}{if $bIsEdit}current-background-id_{$aForms.background_file_id}{/if}" scrolling="no" frameborder="0" width="250" height="35" {if $bIsEdit}style="display:none;"{/if}></iframe>
				<div id="background_file_preview" {if !$bIsEdit}style="display: none"{/if}>
					 {if $bIsEdit}
						{if $aForms.background_file_name}
							{img path='core.url_file' file='dvs/background/'.$aForms.background_file_name max_width=180 max_height=180}
						{else}
							{phrase var='dvs.no_background_file'}
						{/if}
						 <br />
						<a href="#" onclick="window.parent.document.getElementById('background_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_background_upload_frame').style.display = 'block';window.parent.document.getElementById('background_file_preview').style.display = 'none';">{phrase var='dvs.change_background_image'}</a> - <a href="#" onclick="if (confirm('Are you sure?')){l}window.parent.document.getElementById('background_file_label').innerHTML = '{phrase var='dvs.select_file'}:';window.parent.document.getElementById('js_background_upload_frame').style.display = 'block';window.parent.document.getElementById('background_file_preview').style.display = 'none';window.parent.document.getElementById('background_file_id').value = 0;$.ajaxCall('dvs.removeBackgroundFile','iBackgroundFileId={$aForms.background_file_id}'){r}">{phrase var='dvs.remove_background_image'}</a>
					{/if}
				</div>
				<input type="hidden" id="background_file_id" name="val[background_file_id]" value="{if $bIsEdit}{$aForms.background_file_id}{else}0{/if}"/>
			</td>
		</tr>

		<tr style="display: none;">
			<td class="dvs_add_td">
				{phrase var='dvs.background_opacity'}:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[background_opacity]" value="{value type='input' id='background_opacity'}" id="background_opacity" size="5"/>
			</td>
		</tr>
	</table>
	<table>
        <tr class="tr_interactive">
            <td class="dvs_add_td">
                Background Repeat:
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat" {if $bIsEdit}{if $aForms.background_repeat_type == 'repeat'}checked="checked"{/if}{else}checked="checked"{/if}>repeat<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="no-repeat" {if $bIsEdit && $aForms.background_repeat_type == 'no-repeat'}checked="checked"{/if}>no-repeat<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat-x" {if $bIsEdit && $aForms.background_repeat_type == 'repeat-x'}checked="checked"{/if}>repeat-x<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_repeat_type]" value="repeat-y" {if $bIsEdit && $aForms.background_repeat_type == 'repeat-y'}checked="checked"{/if}>repeat-y<br>
            </td>
        </tr>
    </table>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td">
                Background Attachment:
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_attachment_type]" value="scroll" {if $bIsEdit}{if $aForms.background_attachment_type == 'scroll'}checked="checked"{/if}{else}checked="checked"{/if}>scroll<br>
            </td>
            <td class="dvs_add_td_label">
                <input type="radio" name="val[background_attachment_type]" value="fixed" {if $bIsEdit && $aForms.background_attachment_type == 'fixed'}checked="checked"{/if}>fixed<br>
            </td>
        </tr>
    </table>
     -->
	<br>
	<div {if Phpfox::isAdmin()}{else}style="display:none;"{/if}>
	<h3>Page Styling</h3>

    <table>
        <tr>
            <td class="dvs_add_td_label">
                {phrase var='dvs.select_a_theme'}:
            </td>
            <td class="dvs_add_td">
                <select name="val[theme_select]" id="theme_select" onchange="$.ajaxCall('dvs.chooseTheme', 'theme_id='+this.value);">
                    <option value="0">Select a Theme</option>
                    {foreach from=$aThemes item=aTheme}
                    <option value="{$aTheme.theme_id}">{$aTheme.theme_name}</option>
                    {/foreach}
                </select>
            </td>
        </tr>

        <tr>
            <td class="dvs_add_td_label">
                Font Family:
            </td>
            <td>
                <select id="font_family_id" name="val[font_family_id]">
                    {foreach from=$aFontFamilies key=iKey item=sFontFamily}
                    <option value="{$iKey}" {if $bIsEdit && $aForms.font_family_id == $iKey}selected="selected"{elseif (!$bIsEdit) && ($aForms.font_family_id == 3) && ($iKey == 3)}selected="selected"{/if}>{$sFontFamily}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
    </table>

	<table style="margin-top:30px">
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.menu_background'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.menu_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_menu_background_input" name="val[menu_background]" {if $bIsEdit}value="{$aForms.menu_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			<!--<td rowspan="6" style="vertical-align:middle;">
				<div id="preview_wrapper">
				<h1 align="center">Live Preview</h1>
					<div id="preview_container">
						<div id="dvs_container">
							<div id="preview_menu_container">
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
								<span class="dvs_top_menu_link">Top Menu Link</span>
							</div>

							<div id="preview_player_container">
								<div id="player_mockup">Video Player</div>
							</div>

							<div id="preview_now_playing_container">
								<span class="preview_dealer_info">This is the Page Text color. This is the Page Text color.</span><br/><br>
								<span id="preview_dealer_website_link">This is the Text Link color.</span><br/>
							</div>
							
							<div id="preview_cta_button_container">
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								<a href="#" class="dvs_c2a_button">Button</a>
								
							</div>
							<div id="preview_footer_container">
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							<span class="dvs_footer_link">Footer Link</span>
							</div>
						</div>
					</div>
				</div>	
			</td>-->
		<!--</tr>
		
		<tr>-->
			<td class="dvs_add_td_label">
				{phrase var='dvs.top_menu_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.menu_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_menu_link_input" name="val[menu_link]" {if $bIsEdit}value="{$aForms.menu_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		<!--</tr>

		<tr class="tr_interactive">-->
			<td class="dvs_add_td_label">
				{phrase var='dvs.page_background'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.page_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_page_background_input" name="val[page_background]" {if $bIsEdit}value="{$aForms.page_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		<!--</tr>
		
		<tr>-->
			<td class="dvs_add_td_label">
				{phrase var='dvs.page_text'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_text" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.page_text}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_page_text_input" name="val[page_text]" {if $bIsEdit}value="{$aForms.page_text}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		<!--</tr>
		
		<tr>-->
			<td class="dvs_add_td_label">
				{phrase var='dvs.text_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_text_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.text_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_text_link_input" name="val[text_link]" {if $bIsEdit}value="{$aForms.text_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		<!--</tr>
		
		<tr>-->
			<td class="dvs_add_td_label">
				{phrase var='dvs.footer_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_footer_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.footer_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_footer_link_input" name="val[footer_link]" {if $bIsEdit}value="{$aForms.footer_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>
	</table>
	<br>
	<h3>{phrase var='dvs.button_styling'}</h3>
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td_label">
				{phrase var='dvs.background'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.button_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_background_input" name="val[button_background]" {if $bIsEdit}value="{$aForms.button_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>

			<td class="dvs_add_td_label">
				{phrase var='dvs.text'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_text" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.button_text}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_text_input" name="val[button_text]" {if $bIsEdit}value="{$aForms.button_text}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.top_gradient'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_top_gradient" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.button_top_gradient}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_top_gradient_input" name="val[button_top_gradient]" {if $bIsEdit}value="{$aForms.button_top_gradient}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.bottom_gradient'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_bottom_gradient" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.button_bottom_gradient}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_bottom_gradient_input" name="val[button_bottom_gradient]" {if $bIsEdit}value="{$aForms.button_bottom_gradient}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.border'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_border" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.button_border}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_border_input" name="val[button_border]" {if $bIsEdit}value="{$aForms.button_border}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
		</tr>
	</table>
	<br>
    <h3>iFrame Styling</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                iFrame Background:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_background" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.iframe_background}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_background_input" name="val[iframe_background]" {if $bIsEdit}value="{$aForms.iframe_background}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                iFrame Text:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_text" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.iframe_text}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_text_input" name="val[iframe_text]" {if $bIsEdit}value="{$aForms.iframe_text}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                Contact Form Background:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_contact_background" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.iframe_contact_background}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_contact_background_input" name="val[iframe_contact_background]" {if $bIsEdit}value="{$aForms.iframe_contact_background}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                Contact Form Text:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_iframe_contact_text" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.iframe_contact_text}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_iframe_contact_text_input" name="val[iframe_contact_text]" {if $bIsEdit}value="{$aForms.iframe_contact_text}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
        </tr>
    </table>
	<br>
	<h3>Player Styling</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                {phrase var='dvs.background'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_background" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.player_background}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_background_input" name="val[player_background]" {if $bIsEdit}value="{$aFormss.player_background}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                {phrase var='dvs.text'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_text" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.player_text}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_text_input" name="val[player_text]"  {if $bIsEdit}value="{$aFormss.player_text}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                {phrase var='dvs.buttons'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_buttons" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.player_buttons}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_buttons_input" name="val[player_buttons]" {if $bIsEdit}value="{$aFormss.player_buttons}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                {phrase var='dvs.button_icons'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_button_icons" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.player_button_icons}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_button_icons_input" name="val[player_button_icons]" {if $bIsEdit}value="{$aFormss.player_button_icons}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            </tr>
            </table>
            <table>
            <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                {phrase var='dvs.progress_bar'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_progress_bar" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.player_progress_bar}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_progress_bar_input" name="val[player_progress_bar]" {if $bIsEdit}value="{$aFormss.player_progress_bar}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            <td class="dvs_add_td_label">
                {phrase var='dvs.prev_next_arrows'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_playlist_arrows" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.playlist_arrows}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_playlist_arrows_input" name="val[playlist_arrows]" {if $bIsEdit}value="{$aFormss.playlist_arrows}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            <td class="dvs_add_td_label">
                {phrase var='dvs.thumbnail_border'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_playlist_border" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aFormss.playlist_border}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_playlist_border_input" name="val[playlist_border]" {if $bIsEdit}value="{$aFormss.playlist_border}"{else}value="{$sDefaultColor}"{/if}/>
            </td>            
        </tr>
    </table>
    <br>
    <h3>Virtual Test Drive Button</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                Top-gradient color:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_vin_top_gradient" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.vin_top_gradient}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_vin_top_gradient_input" name="val[vin_top_gradient]" {if $bIsEdit}value="{$aForms.vin_top_gradient}"{else}value="A764C5"{/if}/>
            </td>

            <td style="padding-left: 20px; width: 145px;" class="dvs_add_td_label">
                Bottom-gradient color:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_vin_bottom_gradient" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.vin_bottom_gradient}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_vin_bottom_gradient_input" name="val[vin_bottom_gradient]" {if $bIsEdit}value="{$aForms.vin_bottom_gradient}"{else}value="451656"{/if}/>
            </td>

            <td style="padding: 0 20px; width: 145px; text-align: right;" class="dvs_add_td_label">
                Text color:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_vin_text_color" class="colorSelector">
                    <div style="background-color: #{if $bIsEdit}{$aForms.vin_text_color}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_vin_text_color_input" name="val[vin_text_color]" {if $bIsEdit}value="{$aForms.vin_text_color}"{else}value="000000"{/if}/>
            </td>
        </tr>

        <tr style="line-height: 45px;" class="tr_interactive">
            <td class="dvs_add_td_label">
                Font-Size:
            </td>
            <td colspan="3" class="dvs_add_td">
                <input type="text" id="vin_font_size" name="val[vin_font_size]" {if $bIsEdit}value="{$aForms.vin_font_size}"{else}value="12px"{/if}/>
            </td>
        </tr>


        <tr style="line-height: 45px;" class="tr_interactive">
            <td class="dvs_add_td_label">
                Button label:
            </td>
            <td colspan="3" class="dvs_add_td">
                <input type="text" id="vin_button_label" name="val[vin_button_label]" {if $bIsEdit}value="{$aForms.vin_button_label}"{else}value="Virtual Test Drive"{/if}/>
            </td>
        </tr>

        <table>
            <tr class="tr_interactive">
                <td class="dvs_add_td">
                    Virtual Test Drive Button Image:
                </td>
                <td class="dvs_add_td">
				<span id="vdp_file_label">
				{if $bIsEdit}
					{phrase var='dvs.current_image'}
				{else}
					{phrase var='dvs.select_file'}
				{/if}:
				</span>
                    <iframe id="js_vdp_upload_frame" name="js_vdp_upload_frame" src="{url link='dvs.vdp-file-form'}{if $bIsEdit}current-vdp-id_{$aForms.vdp_file_id}{/if}" scrolling="no" frameborder="0" width="250" height="35" {if $bIsEdit}style="display:none;"{/if}></iframe>
                    <div id="vdp_file_preview" {if !$bIsEdit}style="display: none"{/if}>
                    {if $bIsEdit}
                    {if $aForms.vdp_file_name}
                    {img path='core.url_file' file='dvs/vdp/'.$aForms.vdp_file_name max_width=180 max_height=180}
                    {else}
                    No VDP Image
                    {/if}
                    <br />
                    <a href="#" onclick="
                    window.parent.document.getElementById('vdp_file_label').innerHTML = '{phrase var='dvs.select_file'}:';
                    window.parent.document.getElementById('js_vdp_upload_frame').style.display = 'block';
                    window.parent.document.getElementById('vdp_file_preview').style.display = 'none'; return false;">
                        Change VDP Image
                    </a>
                    -
                    <a href="#" onclick="
                    if (confirm('Are you sure?')){l}
                        window.parent.document.getElementById('vdp_file_label').innerHTML = '{phrase var='dvs.select_file'}:';
                        window.parent.document.getElementById('js_vdp_upload_frame').style.display = 'block';
                        window.parent.document.getElementById('vdp_file_preview').style.display = 'none';
                        window.parent.document.getElementById('vdp_file_id').value = 0;
                        $.ajaxCall('dvs.removeVdpFile','iVdpFileId={$aForms.vdp_file_id}')
                    {r} return false;">
                        Remove VDP Image
                    </a>
                    {/if}
                    </div>
                    <input type="hidden" id="vdp_file_id" name="val[vdp_file_id]" value="{if $bIsEdit}{$aForms.vdp_file_id}{else}0{/if}"/>
                </td>
            </tr>
        </table>
    </table>   
    </div>
    <br>
	<input type="hidden" name="val[step]" value="customize" />
	<input type="hidden" name="val[is_edit]" value="{if $bIsEdit && isset($aForms.dvs_id)}1{else}0{/if}" />
    <input type="hidden" name="val[dvs_id]" value="{$iDvsId}" />
    <input type="hidden" name="val[player_id]" value="{$iPlayerId}" />
	<input type="button" value="{if $bIsEdit && isset($aForms.dvs_id)}{phrase var='dvs.save_changes'}{else}{phrase var='dvs.save_and_continue'}{/if}" class="button" onclick="$('#add_dvs_customize').submit();" />
</form>

