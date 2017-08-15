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
	{if $bIsEdit}
		$(document).ready(function() {left_curly}
			$('#color_picker_menu_background').ColorPickerSetColor('#{$aForms.theme_menu_background}');
			$('#color_picker_menu_link').ColorPickerSetColor('#{$aForms.theme_menu_link}');
			$('#color_picker_page_background').ColorPickerSetColor('#{$aForms.theme_page_background}');
			$('#color_picker_page_text').ColorPickerSetColor('#{$aForms.theme_page_text}');
			$('#color_picker_button_background').ColorPickerSetColor('#{$aForms.theme_button_background}');
			$('#color_picker_button_text').ColorPickerSetColor('#{$aForms.theme_button_text}');
			$('#color_picker_button_top_gradient').ColorPickerSetColor('#{$aForms.theme_button_top_gradient}');
			$('#color_picker_button_bottom_gradient').ColorPickerSetColor('#{$aForms.theme_button_bottom_gradient}');
			$('#color_picker_button_border').ColorPickerSetColor('#{$aForms.theme_button_border}');
			$('#color_picker_text_link').ColorPickerSetColor('#{$aForms.theme_text_link}');
			$('#color_picker_footer_link').ColorPickerSetColor('#{$aForms.theme_footer_link}');
            $('#color_picker_player_background').ColorPickerSetColor('#{$aForms.player_background}');
            //$('#color_picker_player_text').ColorPickerSetColor('#{$aForms.player_text}');
//            $('#color_picker_player_buttons').ColorPickerSetColor('#{$aForms.player_buttons}');
//            $('#color_picker_player_icons').ColorPickerSetColor('#{$aForms.player_icons}');
//            $('#color_picker_player_progress_bar').ColorPickerSetColor('#{$aForms.player_progress_bar}');
//            $('#color_picker_player_arrows').ColorPickerSetColor('#{$aForms.player_arrows}');
//            $('#color_picker_player_thumbnail_border').ColorPickerSetColor('#{$aForms.player_thumbnail_border}');
		{right_curly});
	{else}
		$(document).ready(function() {left_curly}
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
            $('#color_picker_player_background').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_text').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_buttons').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_icons').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_progress_bar').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_arrows').ColorPickerSetColor('#{$sDefaultColor}');
            $('#color_picker_player_thumbnail_border').ColorPickerSetColor('#{$sDefaultColor}');
            
		{right_curly});	
	{/if}
</script>

<style type="text/css">
	#dvs_container {l}
		position:relative;
		width: 670px;
		height: 270px;
		margin-left: auto;
		margin-right: auto;
		color: #{if $bIsEdit}{$aForms.theme_page_background}{else}c5c5c5{/if};
		background: #{if $bIsEdit}{$aForms.theme_page_background}{else}c5c5c5{/if};
	{r}
	
	#preview_menu_container {l}
		top:0px;
		position:absolute;
		width: 670px;
		padding-left:10px;
		padding-top:3px;
		height:22px;
		text-align:left;
		background: none repeat scroll 0 0 #{if $bIsEdit}{$aForms.theme_menu_background}{else}c5c5c5{/if};
		font-size: 1.25em;
		font-weight:bold;
	{r}
	
	.dvs_top_menu_link {l}
		margin-right:10px;
	{r}
	
	#preview_vehicle_select_container {l}
		position: absolute;
		top: 30px;
		left:500px;
		width:160px;
		height:52px;
		color: #{if $bIsEdit}{$aForms.theme_page_text}{else}c5c5c5{/if};
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
		border: 1px solid #{if $bIsEdit}{$aForms.theme_button_border}{else}c5c5c5{/if};
		color: #{if $bIsEdit}{$aForms.theme_button_text}{else}c5c5c5{/if};
		background: #{if $bIsEdit}{$aForms.theme_button_background}{else}c5c5c5{/if};
	{r}
	
	#preview_cta_button_container {l}
		position: absolute;
		top: 87px;
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
		margin-right:7px;
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
		color:#222222;
		font-size:5em;
		font-weight:bold;
		letter-spacing:5px;
		padding-top:10px;
	{r}
	
	#preview_now_playing_container {l}
		position: relative;
		top: 140px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
		color: #{if $bIsEdit}{$aForms.theme_page_text}{else}c5c5c5{/if};
    {r}
	
	#preview_dealer_info {l}
		position: absolute;
		top: 180px;
		width:320px;
		text-align: left;
		overflow:hidden;
		text-overflow: ellipsis;
        white-space: nowrap;
		color: #{if $bIsEdit}{$aForms.theme_page_text}{else}c5c5c5{/if};
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
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if};), color-stop(1, #{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if}) );
		background:-moz-linear-gradient( center top, #{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if} 5%, #{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if} 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if}', endColorstr='#{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if}');
		background-color:#{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if};
		border:1px solid #{if $bIsEdit}{$aForms.theme_button_border}{else}000000{/if};
		color:#{if $bIsEdit}{$aForms.theme_button_text}{else}ffffff{/if};
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
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if}), color-stop(1, #{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if}) );
		background:-moz-linear-gradient( center top, #{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if} 5%, #{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if} 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if}', endColorstr='#{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}ffffff{/if}');
		background-color:#{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}000000{/if};
		text-decoration:none;
		color:#{if $bIsEdit}{$aForms.theme_button_text}{else}ffffff{/if};
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
		color: #{if $bIsEdit}{$aForms.theme_footer_link}{else}c5c5c5{/if};
	{r}
	
	.dvs_footer_link {l}
		margin-right:10px;
	{r}

</style>

<form method="post" action="{url link='admincp.dvs.theme.index'}" id="add_theme" name="add_theme">
	<table>
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.theme_name'}:
			</td>
			<td class="dvs_add_td">
				<input type="text" name="val[theme_name]" value="{value type='input' id='theme_name'}" id="theme_name" />
			</td>
		</tr>
	</table>
	<h3>{phrase var='dvs.page_styling'}</h3>
	<table>
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.menu_background'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_menu_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_menu_background_input" name="val[theme_menu_background]" {if $bIsEdit}value="{$aForms.theme_menu_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			<td rowspan="6" style="vertical-align:middle;">
				<div id="preview_wrapper">
					<div id="preview_container">
						<div id="dvs_container">
							<div id="preview_menu_container">
								<span class="dvs_top_menu_link">{phrase var='dvs.home'}</span>
								<span class="dvs_top_menu_link">{phrase var='dvs.watch_overviews'}</span>
								<span class="dvs_top_menu_link">{phrase var='dvs.view_test_drives'}</span>
								<span class="dvs_top_menu_link">{phrase var='dvs.see_inventory'}</span>
								<span class="dvs_top_menu_link">{phrase var='dvs.special_offers'}</span>
							</div>

							<div id="preview_player_container">
								<div id="player_mockup">Video Player</div>
							</div>

							<div id="preview_now_playing_container">
								<strong>{phrase var='dvs.now_playing_video_name_test_drive'}</strong><br/>
								{phrase var='dvs.video_description'}
							</div>
							
							<div id="preview_dealer_info">
								<strong>{phrase var='dvs.dealer_info'}</strong><br/>
								Dealer Name<br/>
								{phrase var='dvs.website'}: <span id="preview_dealer_website_link">{phrase var='dvs.dealer_website_text_link'}</span><br/>
								{phrase var='dvs.street_address'}
							</div>
							
							<div id="preview_vehicle_select_container">
								{phrase var='dvs.choose_new_vehicle'}:
								<select class="preview_select">
									<option>{phrase var='dvs.select_year'}</option>
									<option>2013</option>
									<option>2012</option>
									<option>2011</option>
									<option>2010</option>
									<option>2009</option>
								</select>
							</div>
							
							<div id="preview_cta_button_container">
								<a href="#" class="dvs_c2a_button">{phrase var='dvs.cta_home'}</a>
								<a href="#" class="dvs_c2a_button">{phrase var='dvs.cta_overviews'}</a>
								<a href="#" class="dvs_c2a_button">{phrase var='dvs.cta_test_drives'}</a>
								<a href="#" class="dvs_c2a_button">{phrase var='dvs.cta_inventory'}</a>
							</div>
							
							<div id="preview_social_button_container">
								<a href="#" class="dvs_social_button_link"><img src="{$sImagePath}google.png" alt="Google"/></a>
								<a href="#" class="dvs_social_button_link"><img src="{$sImagePath}facebook.png" alt="Facebook"/></a>
								<a href="#" class="dvs_social_button_link"><img src="{$sImagePath}twitter.png" alt="Twitter"/></a>																				
								<a href="#" class="dvs_social_button_link"><img src="{$sImagePath}youtube.png" alt="YoutTube"/></a>
							</div>
							
							<div id="preview_footer_container">
								<span class="dvs_footer_link">{phrase var='dvs.home'}</span>
								<span class="dvs_footer_link">{phrase var='dvs.watch_overviews'}</span>
								<span class="dvs_footer_link">{phrase var='dvs.view_test_drives'}</span>
								<span class="dvs_footer_link">{phrase var='dvs.see_inventory'}</span>
								<span class="dvs_footer_link">{phrase var='dvs.special_offers'}</span>
							</div>
						</div>
					</div>
				</div>	
			</td>
		</tr>
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.top_menu_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_menu_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_menu_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_menu_link_input" name="val[theme_menu_link]" {if $bIsEdit}value="{$aForms.theme_menu_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>

		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.page_background'}::
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_page_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_page_background_input" name="val[theme_page_background]" {if $bIsEdit}value="{$aForms.theme_page_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.page_text'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_page_text" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_page_text}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_page_text_input" name="val[theme_page_text]" {if $bIsEdit}value="{$aForms.theme_page_text}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.text_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_text_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_text_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_text_link_input" name="val[theme_text_link]" {if $bIsEdit}value="{$aForms.theme_text_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>
		
		<tr>
			<td class="dvs_add_td_label">
				{phrase var='dvs.footer_link'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_footer_link" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_footer_link}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_footer_link_input" name="val[theme_footer_link]" {if $bIsEdit}value="{$aForms.theme_footer_link}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
		</tr>
	</table>
	
	<h3>{phrase var='dvs.button_styling'}</h3>
	<table>
		<tr class="tr_interactive">
			<td class="dvs_add_td_label">
				{phrase var='dvs.background'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_background" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_button_background}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_background_input" name="val[theme_button_background]" {if $bIsEdit}value="{$aForms.theme_button_background}"{else}value="{$sDefaultColor}"{/if}/>
			</td>

			<td class="dvs_add_td_label">
				{phrase var='dvs.text'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_text" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_button_text}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_text_input" name="val[theme_button_text]" {if $bIsEdit}value="{$aForms.theme_button_text}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.top_gradient'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_top_gradient" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_button_top_gradient}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_top_gradient_input" name="val[theme_button_top_gradient]" {if $bIsEdit}value="{$aForms.theme_button_top_gradient}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.bottom_gradient'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_bottom_gradient" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_button_bottom_gradient}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_bottom_gradient_input" name="val[theme_button_bottom_gradient]" {if $bIsEdit}value="{$aForms.theme_button_bottom_gradient}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
			<td class="dvs_add_td_label">
				{phrase var='dvs.border'}:
			</td>
			<td class="dvs_add_td">
				<div id="color_picker_button_border" class="colorSelector">	
					<div style="background-color: #{if $bIsEdit}{$aForms.theme_button_border}{else}{$sDefaultColor}{/if}"></div>
				</div>
				<input type="hidden" id="color_picker_button_border_input" name="val[theme_button_border]" {if $bIsEdit}value="{$aForms.theme_button_border}"{else}value="{$sDefaultColor}"{/if}/>
			</td>
			
		</tr>
	</table>
    
<!--    <h3>{phrase var='dvs.button_styling'}</h3>-->
   <h3>{phrase var='dvs.player_colors'}</h3>
    <table>
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                {phrase var='dvs.background'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_background" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_background}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_background_input" name="val[player_background]" {if $bIsEdit}value="{$aForms.player_background}"{else}value="{$sDefaultColor}"{/if}/>
            </td>

            <td class="dvs_add_td_label">
                {phrase var='dvs.text'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_text" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_text}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_text_input" name="val[player_text]" {if $bIsEdit}value="{$aForms.player_text}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
        </tr> 
     </table>
     
     <h3>{phrase var='dvs.player_controls'}</h3>
     <table>
         <tr class="tr_interactive"> 
            <td class="dvs_add_td_label">
                {phrase var='dvs.buttons'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_buttons" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_buttons}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_buttons_input" name="val[player_buttons]" {if $bIsEdit}value="{$aForms.player_buttons}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            <td class="dvs_add_td_label">
                {phrase var='dvs.button_icons'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_button_icons" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_icons}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_button_icons_input" name="val[player_button_icons]" 
                {if $bIsEdit}value="{$aForms.player_icons}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            <td class="dvs_add_td_label">
                {phrase var='dvs.progress_bar'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_player_progress_bar" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_progress_bar}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_player_progress_bar_input" name="val[player_progress_bar]" {if $bIsEdit}value="{$aForms.player_progress_bar}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            
        </tr>
      </table>
      
      <h3>{phrase var='dvs.thumbnail_playlist'}</h3>
      <table>  
        <tr class="tr_interactive">
            <td class="dvs_add_td_label">
                {phrase var='dvs.prev_next_arrows'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_playlist_arrows" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_arrows}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_playlist_arrows_input" name="val[player_thumbnail_arrows]" 
                {if $bIsEdit}value="{$aForms.player_arrows}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
            
            <td class="dvs_add_td_label">
                {phrase var='dvs.thumbnail_border'}:
            </td>
            <td class="dvs_add_td">
                <div id="color_picker_playlist_border" class="colorSelector">    
                    <div style="background-color: #{if $bIsEdit}{$aForms.player_thumbnail_border}{else}{$sDefaultColor}{/if}"></div>
                </div>
                <input type="hidden" id="color_picker_playlist_border_input" name="val[player_thumbnail_border]" 
                {if $bIsEdit}value="{$aForms.player_thumbnail_border}"{else}value="{$sDefaultColor}"{/if}/>
            </td>
        </tr>
    </table>

	<input type="hidden" name="val[theme_is_edit]" value="{if $bIsEdit && isset($aForms.theme_dvs_id)}1{else}0{/if}" />
	<input type="hidden" name="val[theme_id]" value="{if $bIsEdit && isset($aForms.theme_id)}{$aForms.theme_id}{else}0{/if}" />
	<input type="button" value="{if $bIsEdit && isset($aForms.theme_id)}{phrase var='dvs.save_changes'}{else}{phrase var='dvs.save_and_continue'}{/if}" class="button" onclick="$('#add_theme').submit();" />
</form>
