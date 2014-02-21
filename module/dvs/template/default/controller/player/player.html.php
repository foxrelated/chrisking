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
	var aOverviewMediaIds=[];
	var aTestDriveMediaIds=[];
	
	{if $bIsDvs}

		{foreach from=$aOverviewVideos key=iKey item=aVideo}
			aOverviewMediaIds[{$iKey}] = {$aVideo.id};
		{/foreach}

		aMediaIds=aOverviewMediaIds;

		{if isset($aOverrideVideo.id)}
			if (bDebug) console.log('Media: Override is set. aMediaIds:');
			aMediaIds[0] = {$aOverrideVideo.id};
		{else}
			{if isset($aFeaturedVideo.id)}
				if (bDebug) console.log('Media: Featured Video is set. aMediaIds:');
				aMediaIds[0] = {$aFeaturedVideo.id};
			{else}
				if (bDebug) console.log('Media: No override or featuerd. aMediaIds:');
				aMediaIds = aOverviewMediaIds;
			{/if}
		{/if}
		if (bDebug) {l}
			console.log(aMediaIds);
		{r}
		
		{if $aPlayer.custom_overlay_1_type}
			if (bDebug) console.log('Overlay: Overlay 1 is active. Type: {$aPlayer.custom_overlay_1_type}. Start: {$aPlayer.custom_overlay_1_start}. Duration: {$aPlayer.custom_overlay_1_duration}.');
			var bCustomOverlay1 = true;
			var iCustomOverlay1Start = {$aPlayer.custom_overlay_1_start};
			var iCustomOverlay1Duration = {$aPlayer.custom_overlay_1_duration};
		{else}
			var bCustomOverlay1 = false;
			if (bDebug) console.log('Overlay: Overlay 1 is inactive.');
		{/if}
			
		{if $aPlayer.custom_overlay_2_type}
			if (bDebug) console.log('Overlay: Overlay 2 is active. Type: {$aPlayer.custom_overlay_2_type}. Start: {$aPlayer.custom_overlay_2_start}. Duration: {$aPlayer.custom_overlay_2_duration}.');
			var bCustomOverlay2 = true;
			var iCustomOverlay2Start = {$aPlayer.custom_overlay_2_start};
			var iCustomOverlay2Duration = {$aPlayer.custom_overlay_2_duration};
		{else}
			var bCustomOverlay2 = false;
			if (bDebug) console.log('Overlay: Overlay 2 is inactive.');
		{/if}
			
		{if $aPlayer.custom_overlay_3_type}
			if (bDebug) console.log('Overlay: Overlay 3 is active. Type: {$aPlayer.custom_overlay_3_type}. Start: {$aPlayer.custom_overlay_3_start}. Duration: {$aPlayer.custom_overlay_3_duration}.');
			var bCustomOverlay3 = true;
			var iCustomOverlay3Start = {$aPlayer.custom_overlay_3_start};
			var iCustomOverlay3Duration = {$aPlayer.custom_overlay_3_duration};
		{else}
			var bCustomOverlay3 = false;
			if (bDebug) console.log('Overlay: Overlay 3 is inactive.');
		{/if}
		
		
	{else}
		{foreach from=$aVideos key=iKey item=aVideo}
			aMediaIds[{$iKey}] = {$aVideo.id};
		{/foreach}
		
		{if isset($aFeaturedVideo.id)}
			aMediaIds[0] = {$aFeaturedVideo.id};
		{/if}
	{/if}
	
	{if !$bIsExternal}
		var bPreRoll = {if $aPlayer.preroll_file_id}true{else}false{/if};
		var iDvsId = {if $bIsDvs}{$iDvsId}{else}0{/if};
		var bIdriveGetPrice = {if !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}true{else}false{/if};
		var bPreview = {if $bPreview}true{else}false{/if};
		var bAutoplay ={if isset($aPlayer.autoplay) && $aPlayer.autoplay}true{else}false{/if};
		var bAutoAdvance ={if isset($aPlayer.autoadvance) && $aPlayer.autoadvance}true{else}false{/if};
	{else}
		var bPreRoll = false;
		var iDvsId = 0;
		var bIdriveGetPrice = {if $bShowGetPrice}true{else}false{/if};
		var bPreview = false;
		var bAutoplay = {if $bAutoplay}true{else}false{/if};
		var bAutoAdvance = true;
	{/if}
		
	function setPlayerStyle(){l}
		if (bDebug) 
		{l}
			console.log("Player: Setting player style and volume.");
			modVid.setVolume(0);
		{r}
		
		{if !$bIsExternal}
			modVid.setStyles('video-background:#{$aPlayer.player_background};titleText-active:#{$aPlayer.player_text};titleText-disabled:#{$aPlayer.player_text};titleText-rollover:#{$aPlayer.player_text};titleText-selected:#{$aPlayer.player_text};bodyText-active:#{$aPlayer.player_text};bodyText-disabled:#{$aPlayer.player_text};bodyText-rollover:#{$aPlayer.player_text};bodyText-selected:#{$aPlayer.player_text};buttons-icons:#{$aPlayer.player_button_icons};buttons-rolloverIcons:#{$aPlayer.player_button_icons};buttons-selectedIcons:#{$aPlayer.player_button_icons};buttons-glow:#{$aPlayer.player_button_icons};buttons-iconGlow:#{$aPlayer.player_button_icons};buttons-face:#{$aPlayer.player_buttons};buttons-rollover:#{$aPlayer.player_buttons};buttons-selected:#{$aPlayer.player_buttons};playheadWell-background:#{$aPlayer.player_progress_bar};playheadWell-watched:#{$aPlayer.player_progress_bar};playhead-face:#{$aPlayer.player_button_icons};volumeControl-icons:#{$aPlayer.player_button_icons};volumeControl-track:#{$aPlayer.player_progress_bar};volumeControl-face:#{$aPlayer.player_buttons};linkText-active:#{$aPlayer.player_text};linkText-disabled:#{$aPlayer.player_text};linkText-rollover:#{$aPlayer.player_text};linkText-downState:#{$aPlayer.player_text};');
		{/if}
	{r}
	
	function enableVideoSelectCarousel(){l}
		if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
		$('#video_select_playlist').show();
		$("#video_select_playlist").jCarouselLite({l}
					btnNext: ".next",
					btnPrev: ".prev",
					circular: false,
					visible: 4,
					scroll: 3,
					speed: 900
				{r});
	{r}

	$Behavior.jCarousel = function() {l}
	console.log('carousel');
		{if $bIsDvs}
			$("#overview_playlist").jCarouselLite({l}
				btnNext: ".next",
				btnPrev: ".prev",
				circular: false,
				visible: 4,
				scroll: 3,
				speed: 900
			{r});
		{else}
			$("#overview_playlist").jCarouselLite({l}
				btnNext: ".next",
				btnPrev: ".prev",
				circular: false,
				visible: {if ($bIsExternal || (!$bIsDvs && isset($iPlaylistThumbnails)))}{$iPlaylistThumbnails}{else}4{/if},
				scroll: {if ($bIsExternal || (!$bIsDvs && isset($iScrollAmt)))}{$iScrollAmt}{else}3{/if},
				speed: 900
			{r});
		{/if}
	{r}
</script>

{if ($bIsExternal || (!$bIsDvs && isset($iChapterButtonLeft)))}
	<style type="text/css">
		#chapter_buttons {l}
			left: {$iChapterButtonLeft}px;
		{r}
		#dvs_player_container {l}
			width: {$iBackgroundWidth}px;
			height: {$iBackgroundHeight}px;
		{r}
		#playlist_wrapper{l}
			width: {$iPlayerWidth}px;
		{r}
	</style>
{/if}

<div id="dvs_player_container">
	{if ($bIsDvs && $aOverviewVideos) || (!$bIsDvs && $aVideos)}
		<div id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
			{if $bIsDvs}
				{if !$bPreview}
					<meta itemprop="creator" content="{$aDvs.phrase_overrides.override_meta_itemprop_creator_meta}" />
					<meta itemprop="productionCompany" content="WheelsTV" />
					<meta itemprop="contributor" content="{$aDvs.dealer_name}" />
					<meta itemprop="url" content="{$aFirstVideoMeta.url}" id="schema_video_url"/>
					<meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
					<meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
					<meta itemprop="embedUrl" content="http://c.brightcove.com/services/viewer/federated_f9/1970101121001?isVid=1&amp;isUI=1&amp;domain=embed&amp;playerID=1970101121001&amp;publisherID=607012070001&amp;videoID={$aFirstVideoMeta.referenceId}" id="schema_video_embed_url"/>
					<meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
					<meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
					<meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
					<meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
				{/if}
				{if $aPlayer.custom_overlay_1_type || $aPlayer.custom_overlay_1_type || $aPlayer.custom_overlay_1_type}
					<div id="dvs_overlay_container">
						{if $aPlayer.custom_overlay_1_type}
							<div id="dvs_overlay_1" class="dvs_overlay" style="bottom:415px;">
								{if $aPlayer.custom_overlay_1_type == 1}
									<div class="dvs_image_overlay">	
										<a href="#" onclick="getPrice({$iDvsId});"><img src="{$sImagePath}overlay.png" /></a>
									</div>
								{else}
									<div class="dvs_link_overlay">
										<a href="{$aPlayer.custom_overlay_1_url}" target="_blank">{$aPlayer.custom_overlay_1_text}</a>
									</div>
								{/if}
							</div>
						{/if}
						{if $aPlayer.custom_overlay_2_type}
							<div id="dvs_overlay_2" class="dvs_overlay" style="bottom:415px;">
								{if $aPlayer.custom_overlay_2_type == 1}
									<div class="dvs_image_overlay">
										<a href="#" onclick="getPrice({$iDvsId});"><img src="{$sImagePath}overlay.png"/></a>
									</div>
								{else}
									<div class="dvs_link_overlay">
										<a href="{$aPlayer.custom_overlay_2_url}" target="_blank">{$aPlayer.custom_overlay_2_text}</a>
									</div>
								{/if}
							</div>
						{/if}
						{if $aPlayer.custom_overlay_3_type}
							<div id="dvs_overlay_3" class="dvs_overlay" style="bottom:415px;">
								{if $aPlayer.custom_overlay_3_type == 1}
									<div class="dvs_image_overlay">
										<a href="#" onclick="getPrice({$iDvsId});"><img src="{$sImagePath}overlay.png"/></a>
									</div>
								{else}
									<div class="dvs_link_overlay">
										<a href="{$aPlayer.custom_overlay_3_url}" target="_blank">{$aPlayer.custom_overlay_3_text}</a>
									</div>
								{/if}
							</div>
						{/if}
					</div>
				{/if}
			{/if}
			<div style="display:none;"></div>
			{if $sBrowser == 'ipad'}
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
					{if !$bIsExternal && $aPlayer.preroll_file_id}
						<param name="adServerURL" value="{$sPrerollXmlUrl}" />
					{/if}
					{if !$bPreview && !$bIsExternal}
						{if $bIsDvs}
							<param name="accountID" value="{$aDvs.dvs_google_id}" />
						{else if !$bIsExternal}
							<param name="accountID" value="{$aPlayer.google_id}" />
						{/if}
					{/if}
					<param name="templateLoadHandler" value="onTemplateLoaded" />
					<param name="templateReadyHandler" value="onTemplateReady" />
					<param name="showNoContentMessage" value="false" />
					<param name="linkBaseURL" value="{$sLinkBase}" id="bc_player_param_linkbase" />
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
					{if !$bIsExternal && $aPlayer.preroll_file_id}
						<param name="adServerURL" value="{$sPrerollXmlUrl}" />
					{/if}
					{if !$bPreview && !$bIsExternal}
						{if $bIsDvs}
							<param name="accountID" value="{$aDvs.dvs_google_id}" />
						{else if !$bIsExternal}
							<param name="accountID" value="{$aPlayer.google_id}" />
						{/if}
					{/if}
					<param name="showNoContentMessage" value="false" />
					{if !$bPreview && !$bIsExternal}
						<param name="linkBaseURL" value="{$sLinkBase}" id="bc_player_param_linkbase" />
					{/if}
				</object>
				<script type="text/javascript">brightcove.createExperiences();</script>
			{/if}
		</div>
	{else}
		<div class="player_error">{phrase var='dvs.no_videos_error'}</div>
	{/if}

	{if $bIsDvs || (!$bIsExternal && !$aPlayer.player_type) || ($bIsExternal && $bShowPlaylist)}
		<div id="playlist_wrapper">
			<div id="playlist_thumbnails" class="playlist_container">
				<div id="prev_button_container">
					<div id="prev_button">
						<a href="#" class="prev playlist-button">&lt;</a>
					</div>
				</div>
				{if $bIsDvs}
					<div class="playlist_carousel" style="float:left" id="overview_playlist">
						<ul>
							{foreach from=$aOverviewVideos key=iKey item=aVideo}
								<li>
									<div class="playlist_thumbnail_image_container">
										<a class="playlist_carousel_image_link" onclick="thumbnailClick({$iKey});">
											<div class="playlist_thumbnail_image_overlay"></div>
											<div class="playlist_thumbnail_image_overlay_text"><table class="playlist_thumbnail_image_overlay_text_table"><tr><td>{$aVideo.year} {$aVideo.model}</td></tr></table></div>
											{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
										</a>
									</div>
								</li>
							{/foreach}
							<li></li><li></li>
						</ul>
					</div>
					<div class="playlist_carousel" style="float:left;display:none;" id="video_select_playlist"></div>
				{else}
					<div class="playlist_carousel" style="float:left" id="overview_playlist">
						<ul>
							{foreach from=$aVideos key=iKey item=aVideo}
								<li>
									<div class="playlist_thumbnail_image_container">
										<a class="playlist_carousel_image_link" onclick="thumbnailClick({$iKey});">
											<div class="playlist_thumbnail_image_overlay"></div>
											<div class="playlist_thumbnail_image_overlay_text"><table class="playlist_thumbnail_image_overlay_text_table"><tr><td>{$aVideo.year} {$aVideo.model}</td></tr></table></div>
											{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
										</a>
									</div>
								</li>
							{/foreach}
							<li></li><li></li>
						</ul>
					</div>
				{/if}
				<div id="next_button_container">
					<div id="next_button" style="top:50%; height:35px; margin-top:19px">
						<a href="#" class="next playlist-button">&gt;</a>
					</div>
				</div>
			</div>
		</div>
	{/if}
	<div id="chapter_buttons">
		<button type="button" id="chapter_container_Intro" class="disabled display"></button>
		<button type="button" id="chapter_container_WhatsNew" class="disabled display"></button>
		<button type="button" id="chapter_container_Exterior" class="disabled no_display"></button>
		<button type="button" id="chapter_container_Interior" class="disabled no_display"></button>
		<button type="button" id="chapter_container_Power" class="disabled display"></button>
		<button type="button" id="chapter_container_Fuel" class="disabled display"></button>
		<button type="button" id="chapter_container_Features" class="disabled display"></button>
		<button type="button" id="chapter_container_Safety" class="disabled no_display"></button>
		<button type="button" id="chapter_container_Warranty" class="disabled display"></button>
		<button type="button" id="chapter_container_Summary" class="active display"></button>
		<button type="button" id="chapter_container_Performance" class="disabled no_display"></button>
		<button type="button" id="chapter_container_MPG" class="disabled no_display"></button>
		<button type="button" id="chapter_container_Honors" class="disabled no_display"></button>
		{if $bIsDvs && !$bPreview}
		<button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="tb_show('get price', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=600'));"></button>
		{elseif !$bIsExternal && !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}
		<button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="getPriceIDrive('{$aPlayer.player_id}');"></button>
		{elseif $bIsExternal && $bShowGetPrice}
		<button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="getPriceExternal('{$sEmail}');"></button>
		{/if}
	<!-- NOTE: The following parent DIVs (#chapter_container_Intro) are loaded in to a JS object and this div (#chapter_buttons) is cleared. No changes to the parent DIV objects will stick -->
	
<!--		<div id="chapter_container_Intro" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Intro" style="display:none;">
					<img src="{$sImagePath}intro-active.png" alt="">
				</div>
				<div id="chapter_light_green_Intro" style="display:none;">
					<img src="{$sImagePath}intro-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Intro" style="display:none;">
					<img src="{$sImagePath}intro-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Intro">
					<img src="{$sImagePath}intro-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_WhatsNew" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_WhatsNew" style="display:none;">
					<img src="{$sImagePath}whatsnew-active.png" alt="">
				</div>
				<div id="chapter_light_green_WhatsNew" style="display:none;">
					<img src="{$sImagePath}whatsnew-selected.png" alt="">
				</div>
				<div id="chapter_light_red_WhatsNew" style="display:none;">
					<img src="{$sImagePath}whatsnew-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_WhatsNew">
					<img src="{$sImagePath}whatsnew-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Exterior" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Exterior" style="display:none;">
					<img src="{$sImagePath}exterior-active.png" alt="">
				</div>
				<div id="chapter_light_green_Exterior" style="display:none;">
					<img src="{$sImagePath}exterior-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Exterior" style="display:none;">
					<img src="{$sImagePath}exterior-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Exterior">
					<img src="{$sImagePath}exterior-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Interior" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Interior" style="display:none;">
					<img src="{$sImagePath}interior-active.png" alt="">
				</div>
				<div id="chapter_light_green_Interior" style="display:none;">
					<img src="{$sImagePath}interior-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Interior" style="display:none;">
					<img src="{$sImagePath}interior-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Interior">
					<img src="{$sImagePath}interior-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Power" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Power" style="display:none;">
					<img src="{$sImagePath}power-active.png" alt="">
				</div>
				<div id="chapter_light_green_Power" style="display:none;">
					<img src="{$sImagePath}power-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Power" style="display:none;">
					<img src="{$sImagePath}power-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Power">
					<img src="{$sImagePath}power-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Fuel" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Fuel" style="display:none;">
					<img src="{$sImagePath}fuel-active.png" alt="">
				</div>
				<div id="chapter_light_green_Fuel" style="display:none;">
					<img src="{$sImagePath}fuel-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Fuel" style="display:none;">
					<img src="{$sImagePath}fuel-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Fuel">
					<img src="{$sImagePath}fuel-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Features" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Features" style="display:none;">
					<img src="{$sImagePath}features-active.png" alt="">
				</div>
				<div id="chapter_light_green_Features" style="display:none;">
					<img src="{$sImagePath}features-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Features" style="display:none;">
					<img src="{$sImagePath}features-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Features">
					<img src="{$sImagePath}features-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Safety" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Safety" style="display:none;">
					<img src="{$sImagePath}safety-active.png" alt="">
				</div>
				<div id="chapter_light_green_Safety" style="display:none;">
					<img src="{$sImagePath}safety-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Safety" style="display:none;">
					<img src="{$sImagePath}safety-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Safety">
					<img src="{$sImagePath}safety-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Pricing" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Pricing" style="display:none;">
					<img src="{$sImagePath}pricing-active.png" alt="">
				</div>
				<div id="chapter_light_green_Pricing" style="display:none;">
					<img src="{$sImagePath}pricing-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Pricing" style="display:none;">
					<img src="{$sImagePath}pricing-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Pricing">
					<img src="{$sImagePath}pricing-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Warranty" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_disabled_Warranty">
					<img src="{$sImagePath}warranty-disabled.png" alt="">
				</div>
				<div id="chapter_light_yellow_Warranty" style="display:none;">
					<img src="{$sImagePath}warranty-active.png" alt="">
				</div>
				<div id="chapter_light_green_Warranty" style="display:none;">
					<img src="{$sImagePath}warranty-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Warranty" style="display:none;">
					<img src="{$sImagePath}warranty-watched.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Summary" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Summary" style="display:none;">
					<img src="{$sImagePath}summary-active.png" alt="">
				</div>
				<div id="chapter_light_green_Summary" style="display:none;">
					<img src="{$sImagePath}summary-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Summary" style="display:none;">
					<img src="{$sImagePath}summary-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Summary">
					<img src="{$sImagePath}summary-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Overview" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Overview" style="display:none;">
					<img src="{$sImagePath}overview-active.png" alt="">
				</div>
				<div id="chapter_light_green_Overview" style="display:none;">
					<img src="{$sImagePath}overview-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Overview" style="display:none;">
					<img src="{$sImagePath}overview-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Overview">
					<img src="{$sImagePath}overview-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Performance" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Performance" style="display:none;">
					<img src="{$sImagePath}performance-active.png" alt="">
				</div>
				<div id="chapter_light_green_Performance" style="display:none;">
					<img src="{$sImagePath}performance-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Performance" style="display:none;">
					<img src="{$sImagePath}performance-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Performance">
					<img src="{$sImagePath}performance-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_MPG" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_MPG" style="display:none;">
					<img src="{$sImagePath}mpg-active.png" alt="">
				</div>
				<div id="chapter_light_green_MPG" style="display:none;">
					<img src="{$sImagePath}mpg-selected.png" alt="">
				</div>
				<div id="chapter_light_red_MPG" style="display:none;">
					<img src="{$sImagePath}mpg-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_MPG">
					<img src="{$sImagePath}mpg-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		<div id="chapter_container_Honors" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Honors" style="display:none;">
					<img src="{$sImagePath}honors-active.png" alt="">
				</div>
				<div id="chapter_light_green_Honors" style="display:none;">
					<img src="{$sImagePath}honors-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Honors" style="display:none;">
					<img src="{$sImagePath}honors-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Honors">
					<img src="{$sImagePath}honors-disabled.png" alt="">
				</div>
			</div>
		</div>-->

<!--		{if $bIsDvs && !$bPreview}
			
						<a href="#" onclick="getPrice({$iDvsId});"><img src="{$sImagePath}get-price.png" alt="get_price"/></a>
					
		{elseif !$bIsExternal && !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}
			<div id="chapter_container_Get_Price" style="display:none;">
				<div class="chapter_light">
					<div id="chapter_light_yellow_Get_Price">
						<a href="#" onclick="getPriceIDrive('{$aPlayer.player_id}');"><img src="{$sImagePath}get-price.png" alt="get_price"/></a>
					</div>
					<div id="chapter_light_disabled_Get_Price">
						<a href="#" onclick="getPriceIDrive('{$aPlayer.player_id}');"><img src="{$sImagePath}getprice-disabled.png" alt="get_price"/></a>
					</div>
				</div>
			</div>
		{elseif $bIsExternal && $bShowGetPrice}
			<div id="chapter_container_Get_Price" style="display:none;">
				<div class="chapter_light">
					<div id="chapter_light_yellow_Get_Price">
						<a href="#" onclick="getPriceExternal('{$sEmail}');"><img src="{$sImagePath}get-price.png" alt="get_price"/></a>
					</div>
					<div id="chapter_light_disabled_Get_Price">
						<a href="#" onclick="getPriceExternal('{$sEmail}');"><img src="{$sImagePath}getprice-disabled.png" alt="get_price"/></a>
					</div>
				</div>
			</div>
		{/if}-->
	</div>

</div>