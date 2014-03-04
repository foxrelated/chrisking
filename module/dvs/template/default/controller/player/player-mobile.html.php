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

<div id="dvs_player_container_mobile">
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
			{/if}
			<div style="display:none;"></div>
			<object id="myExperience" class="BrightcoveExperience">
				<param name="includeAPI" value="true" />
				<param name="templateLoadHandlerï»¿" value="onTemplateLoad" />
				<param name="bgcolor" value="#FFFFFF" />
				{if $bIsDvs}
					<param name="width" value="580" />
					<param name="height" value="320" />
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
				{if !$bPreview}
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
		</div>
	{else}
		<div class="player_error">{phrase var='dvs.no_videos_error'}</div>
	{/if}
</div>