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
{$sJavascript}
<script type="text/javascript">
	var aMediaIds=[];
	aMediaIds[0]='{$sReferenceId}';
	var aOverviewMediaIds=[];
	var aTestDriveMediaIds=[];
	var bPreRoll = false;
	var iDvsId = 0;
	var bIdriveGetPrice = false;
	var bPreview = false;
	var bAutoplay = {if $aPlayer.autoplay}true{else}false{/if};
	var bAutoAdvance = false;
	
	function setPlayerStyle(){l}
		if (bDebug) 
		{l}
			console.log("Player: Setting player style and volume.");
			modVid.setVolume(0);
		{r}

		modVid.setStyles('video-background:#{$aPlayer.player_background};titleText-active:#{$aPlayer.player_text};titleText-disabled:#{$aPlayer.player_text};titleText-rollover:#{$aPlayer.player_text};titleText-selected:#{$aPlayer.player_text};bodyText-active:#{$aPlayer.player_text};bodyText-disabled:#{$aPlayer.player_text};bodyText-rollover:#{$aPlayer.player_text};bodyText-selected:#{$aPlayer.player_text};buttons-icons:#{$aPlayer.player_button_icons};buttons-rolloverIcons:#{$aPlayer.player_button_icons};buttons-selectedIcons:#{$aPlayer.player_button_icons};buttons-glow:#{$aPlayer.player_button_icons};buttons-iconGlow:#{$aPlayer.player_button_icons};buttons-face:#{$aPlayer.player_buttons};buttons-rollover:#{$aPlayer.player_buttons};buttons-selected:#{$aPlayer.player_buttons};playheadWell-background:#{$aPlayer.player_progress_bar};playheadWell-watched:#{$aPlayer.player_progress_bar};playhead-face:#{$aPlayer.player_button_icons};volumeControl-icons:#{$aPlayer.player_button_icons};volumeControl-track:#{$aPlayer.player_progress_bar};volumeControl-face:#{$aPlayer.player_buttons};linkText-active:#{$aPlayer.player_text};linkText-disabled:#{$aPlayer.player_text};linkText-rollover:#{$aPlayer.player_text};linkText-downState:#{$aPlayer.player_text};');
	{r}

</script>
<style>
	body {l}
		background-color: #{$aPlayer.player_background};
	{r}
	
	#playlist_wrapper button.playlist-button {l}
		background-color: #{$aPlayer.player_buttons};
		color: #{$aPlayer.playlist_arrows};
	{r}
	
	#playlist_wrapper button.playlist-button:hover {l}
		opacity: 0.5;
	{r}
	
	#overview_playlist li {l}
		border: 2px #{$aPlayer.playlist_border} solid;
	{r}
</style>
<div id="dvs_player_container">
	<div id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
		<div style="display:none;"></div>
		{if $sBrowser != 'desktop'}
			<object id="myExperience" class="BrightcoveExperience">
				<param name="includeAPI" value="true" />
				<param name="templateLoadHandler﻿" value="onTemplateLoad" />
				<param name="bgcolor" value="#FFFFFF" />
				{if $bIsDvs}
					<param name="width" value="720" />
					<param name="height" value="405" />
				{else}
					<param name="width" value="{$iPlayerWidth}" />
					<param name="height" value="{$iPlayerHeight}" />
				{/if}
				<param name="wmode" value="transparent" />
				<param name="playerID" value="1418431455001" />
				<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
				{if $aPlayer.google_id}
					<param name="accountID" value="{$aPlayer.google_id}" />
				{/if}
				<param name="templateLoadHandler" value="onTemplateLoaded" />
				<param name="templateReadyHandler" value="onTemplateReady" />
				<param name="showNoContentMessage" value="false" />
				<param name="@videoPlayer" value="{$sReferenceId}" />
			</object>
			<script type="text/javascript">brightcove.createExperiences();</script>
		{else}
			<object id="myExperience" class="BrightcoveExperience">
				<param name="wmode" value="transparent" />
				<param name="bgcolor" value="#FFFFFF" />
				{if $bIsDvs}
					<param name="width" value="720" />
					<param name="height" value="405" />
				{else}
					<param name="width" value="{$iPlayerWidth}" />
					<param name="height" value="{$iPlayerHeight}" />
				{/if}
				<param name="playerID" value="1418431455001" />
				<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
				{if $aPlayer.google_id}
					<param name="accountID" value="{$aPlayer.google_id}" />
				{/if}
				<param name="showNoContentMessage" value="false" />
			</object>
			<script type="text/javascript">brightcove.createExperiences();</script>
		{/if}
	</div>

	<div id="chapter_buttons">
		<!-- NOTE: The following parent DIVs (#chapter_container_Intro) are loaded in to a JS object and this div (#chapter_buttons) is cleared. No changes to the parent DIV objects will stick -->
		<div id="chapter_container_Intro" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Intro" style="display:none;">
					<img src="{$sImagePath}static_player/intro-active.png" alt="">
				</div>
				<div id="chapter_light_green_Intro" style="display:none;">
					<img src="{$sImagePath}static_player/intro-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Intro" style="display:none;">
					<img src="{$sImagePath}static_player/intro-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Intro">
					<img src="{$sImagePath}static_player/intro-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Setup" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Setup" style="display:none;">
					<img src="{$sImagePath}static_player/setup-active.png" alt="">
				</div>
				<div id="chapter_light_green_Setup" style="display:none;">
					<img src="{$sImagePath}static_player/setup-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Setup" style="display:none;">
					<img src="{$sImagePath}static_player/setup-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Setup">
					<img src="{$sImagePath}static_player/setup-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Interactive" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Interactive" style="display:none;">
					<img src="{$sImagePath}static_player/interactive-active.png" alt="">
				</div>
				<div id="chapter_light_green_Interactive" style="display:none;">
					<img src="{$sImagePath}static_player/interactive-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Interactive" style="display:none;">
					<img src="{$sImagePath}static_player/interactive-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Interactive">
					<img src="{$sImagePath}static_player/interactive-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Your_Leads" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Your_Leads" style="display:none;">
					<img src="{$sImagePath}static_player/your_leads-active.png" alt="">
				</div>
				<div id="chapter_light_green_Your_Leads" style="display:none;">
					<img src="{$sImagePath}static_player/your_leads-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Your_Leads" style="display:none;">
					<img src="{$sImagePath}static_player/your_leads-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Your_Leads">
					<img src="{$sImagePath}static_player/your_leads-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Sharing" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Sharing" style="display:none;">
					<img src="{$sImagePath}static_player/sharing-active.png" alt="">
				</div>
				<div id="chapter_light_green_Sharing" style="display:none;">
					<img src="{$sImagePath}static_player/sharing-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Sharing" style="display:none;">
					<img src="{$sImagePath}static_player/sharing-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Sharing">
					<img src="{$sImagePath}static_player/sharing-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Prospecting" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Prospecting" style="display:none;">
					<img src="{$sImagePath}static_player/prospecting-active.png" alt="">
				</div>
				<div id="chapter_light_green_Prospecting" style="display:none;">
					<img src="{$sImagePath}static_player/prospecting-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Prospecting" style="display:none;">
					<img src="{$sImagePath}static_player/prospecting-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Prospecting">
					<img src="{$sImagePath}static_player/prospecting-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Selling" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Selling" style="display:none;">
					<img src="{$sImagePath}static_player/selling-active.png" alt="">
				</div>
				<div id="chapter_light_green_Selling" style="display:none;">
					<img src="{$sImagePath}static_player/selling-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Selling" style="display:none;">
					<img src="{$sImagePath}static_player/selling-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Selling">
					<img src="{$sImagePath}static_player/selling-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Traffic_Building" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Traffic_Building" style="display:none;">
					<img src="{$sImagePath}static_player/traffic_building-active.png" alt="">
				</div>
				<div id="chapter_light_green_Traffic_Building" style="display:none;">
					<img src="{$sImagePath}static_player/traffic_building-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Traffic_Building" style="display:none;">
					<img src="{$sImagePath}static_player/traffic_building-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Traffic_Building">
					<img src="{$sImagePath}static_player/traffic_building-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Our_Support" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Our_Support" style="display:none;">
					<img src="{$sImagePath}static_player/our_support-active.png" alt="">
				</div>
				<div id="chapter_light_green_Our_Support" style="display:none;">
					<img src="{$sImagePath}static_player/our_support-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Our_Support" style="display:none;">
					<img src="{$sImagePath}static_player/our_support-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Our_Support">
					<img src="{$sImagePath}static_player/our_support-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Summary" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Summary" style="display:none;">
					<img src="{$sImagePath}static_player/summary-active.png" alt="">
				</div>
				<div id="chapter_light_green_Summary" style="display:none;">
					<img src="{$sImagePath}static_player/summary-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Summary" style="display:none;">
					<img src="{$sImagePath}static_player/summary-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Summary">
					<img src="{$sImagePath}static_player/summary-disabled.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>