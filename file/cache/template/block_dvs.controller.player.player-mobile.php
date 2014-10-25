<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:13 pm */ ?>
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

 if (! empty ( $this->_aVars['sJavascript'] )):  echo $this->_aVars['sJavascript'];  endif; ?>
<script type="text/javascript">
	var aMediaIds = [];
			var aOverviewMediaIds = [];
			var aTestDriveMediaIds = [];
	
<?php if ($this->_aVars['bIsDvs']): ?>

<?php if (count((array)$this->_aVars['aOverviewVideos'])):  foreach ((array) $this->_aVars['aOverviewVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']): ?>
		aOverviewMediaIds[<?php echo $this->_aVars['iKey']; ?>] = <?php echo $this->_aVars['aVideo']['id']; ?>;
<?php endforeach; endif; ?>

	aMediaIds = aOverviewMediaIds;

<?php if (isset ( $this->_aVars['aOverrideVideo']['id'] )): ?>
		if (bDebug) console.log('Media: Override is set. aMediaIds:');
		aMediaIds[0] = <?php echo $this->_aVars['aOverrideVideo']['id']; ?>;
<?php else: ?>
<?php if (isset ( $this->_aVars['aFeaturedVideo']['id'] )): ?>
			if (bDebug) console.log('Media: Featured Video is set. aMediaIds:');
				aMediaIds[0] = <?php echo $this->_aVars['aFeaturedVideo']['id']; ?>;
<?php else: ?>
			if (bDebug) console.log('Media: No override or featuerd. aMediaIds:');
			aMediaIds = aOverviewMediaIds;
<?php endif; ?>
<?php endif; ?>
	if (bDebug) {
		console.log(aMediaIds);
	}
	
<?php if ($this->_aVars['aPlayer']['custom_overlay_1_type']): ?>
		if (bDebug) console.log('Overlay: Overlay 1 is active. Type: <?php echo $this->_aVars['aPlayer']['custom_overlay_1_type']; ?>. Start: <?php echo $this->_aVars['aPlayer']['custom_overlay_1_start']; ?>. Duration: <?php echo $this->_aVars['aPlayer']['custom_overlay_1_duration']; ?>.');
		var bCustomOverlay1 = true;
		var iCustomOverlay1Start = <?php echo $this->_aVars['aPlayer']['custom_overlay_1_start']; ?>;
		var iCustomOverlay1Duration = <?php echo $this->_aVars['aPlayer']['custom_overlay_1_duration']; ?>;
<?php else: ?>
		var bCustomOverlay1 = false;
		if (bDebug) console.log('Overlay: Overlay 1 is inactive.');
<?php endif; ?>
		
<?php if ($this->_aVars['aPlayer']['custom_overlay_2_type']): ?>
		if (bDebug) console.log('Overlay: Overlay 2 is active. Type: <?php echo $this->_aVars['aPlayer']['custom_overlay_2_type']; ?>. Start: <?php echo $this->_aVars['aPlayer']['custom_overlay_2_start']; ?>. Duration: <?php echo $this->_aVars['aPlayer']['custom_overlay_2_duration']; ?>.');
		var bCustomOverlay2 = true;
		var iCustomOverlay2Start = <?php echo $this->_aVars['aPlayer']['custom_overlay_2_start']; ?>;
		var iCustomOverlay2Duration = <?php echo $this->_aVars['aPlayer']['custom_overlay_2_duration']; ?>;
<?php else: ?>
		var bCustomOverlay2 = false;
		if (bDebug) console.log('Overlay: Overlay 2 is inactive.');
<?php endif; ?>
		
<?php if ($this->_aVars['aPlayer']['custom_overlay_3_type']): ?>
		if (bDebug) console.log('Overlay: Overlay 3 is active. Type: <?php echo $this->_aVars['aPlayer']['custom_overlay_3_type']; ?>. Start: <?php echo $this->_aVars['aPlayer']['custom_overlay_3_start']; ?>. Duration: <?php echo $this->_aVars['aPlayer']['custom_overlay_3_duration']; ?>.');
		var bCustomOverlay3 = true;
		var iCustomOverlay3Start = <?php echo $this->_aVars['aPlayer']['custom_overlay_3_start']; ?>;
		var iCustomOverlay3Duration = <?php echo $this->_aVars['aPlayer']['custom_overlay_3_duration']; ?>;
<?php else: ?>
		var bCustomOverlay3 = false;
		if (bDebug) console.log('Overlay: Overlay 3 is inactive.');
<?php endif; ?>
			
<?php else: ?>
<?php if (count((array)$this->_aVars['aVideos'])):  foreach ((array) $this->_aVars['aVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']): ?>
			aMediaIds[<?php echo $this->_aVars['iKey']; ?>] = <?php echo $this->_aVars['aVideo']['id']; ?>;
<?php endforeach; endif; ?>
		
<?php if (isset ( $this->_aVars['aFeaturedVideo']['id'] )): ?>
			aMediaIds[0] = <?php echo $this->_aVars['aFeaturedVideo']['id']; ?>;
<?php endif; ?>
<?php endif; ?>
	
<?php if (! $this->_aVars['bIsExternal']): ?>
		var bPreRoll = <?php if ($this->_aVars['aPlayer']['preroll_file_id']): ?>true<?php else: ?>false<?php endif; ?>;
		var iDvsId = <?php if ($this->_aVars['bIsDvs']):  echo $this->_aVars['iDvsId'];  else: ?>0<?php endif; ?>;
		var bIdriveGetPrice = <?php if (! $this->_aVars['bIsDvs'] && isset ( $this->_aVars['aPlayer']['email'] ) && $this->_aVars['aPlayer']['email']): ?>true<?php else: ?>false<?php endif; ?>;
		var bPreview = <?php if ($this->_aVars['bPreview']): ?>true<?php else: ?>false<?php endif; ?>;
		var bAutoplay = <?php if (( isset ( $this->_aVars['aPlayer']['autoplay'] ) && $this->_aVars['aPlayer']['autoplay'] ) || ( isset ( $this->_aVars['aPlayer']['autoplay_baseurl'] ) && $this->_aVars['aPlayer']['autoplay_baseurl'] && ! $this->_aVars['aBaseUrl'] ) || ( isset ( $this->_aVars['aPlayer']['autoplay_videourl'] ) && $this->_aVars['aPlayer']['autoplay_videourl'] && $this->_aVars['aBaseUrl'] )): ?>true<?php else: ?>false<?php endif; ?>;
		//var bAutoplay =true;
		var iCurrentVideo = <?php echo $this->_aVars['aCurrentVideo']; ?>;
		var bAutoAdvance =<?php if (isset ( $this->_aVars['aPlayer']['autoadvance'] ) && $this->_aVars['aPlayer']['autoadvance']): ?>true<?php else: ?>false<?php endif; ?>;
<?php else: ?>
		var bPreRoll = false;
		var iDvsId = 0;
		var bIdriveGetPrice = <?php if ($this->_aVars['bShowGetPrice']): ?>true<?php else: ?>false<?php endif; ?>;
		var bPreview = false;
		var bAutoplay = <?php if ($this->_aVars['bAutoplay']): ?>true<?php else: ?>false<?php endif; ?>;
		var bAutoAdvance = true;
<?php endif; ?>
		
	function setPlayerStyle(){
		if (bDebug) 
		{
			console.log("Player: Setting player style and volume.");
			modVid.setVolume(0);
		}
		
<?php if (! $this->_aVars['bIsExternal']): ?>
			modVid.setStyles('video-background:#<?php echo $this->_aVars['aPlayer']['player_background']; ?>;titleText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;buttons-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-rolloverIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-selectedIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-glow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-iconGlow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-rollover:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-selected:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;playheadWell-background:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playheadWell-watched:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playhead-face:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-track:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;volumeControl-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;linkText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-downState:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;');
<?php endif; ?>
	}
	
	function enableVideoSelectCarousel(){
		if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
	}
</script>

<?php if (( $this->_aVars['bIsExternal'] || ( ! $this->_aVars['bIsDvs'] && isset ( $this->_aVars['iChapterButtonLeft'] ) ) )): ?>
	<style type="text/css">
		#chapter_buttons {
			left: <?php echo $this->_aVars['iChapterButtonLeft']; ?>px;
		}
		#dvs_player_container {
			width: <?php echo $this->_aVars['iBackgroundWidth']; ?>px;
			height: <?php echo $this->_aVars['iBackgroundHeight']; ?>px;
		}
		#playlist_wrapper{
			width: <?php echo $this->_aVars['iPlayerWidth']; ?>px;
		}
	</style>
<?php endif; ?>

<div id="dvs_player_container_mobile">
<?php if (( $this->_aVars['bIsDvs'] && $this->_aVars['aOverviewVideos'] ) || ( ! $this->_aVars['bIsDvs'] && $this->_aVars['aVideos'] )): ?>
		<div id="dvs_bc_player"<?php if ($this->_aVars['bIsDvs']): ?> itemscope itemtype="http://schema.org/VideoObject"<?php endif; ?>>
<?php if ($this->_aVars['bIsDvs']): ?>
<?php if (! $this->_aVars['bPreview']): ?>
					<meta itemprop="creator" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_creator_meta']; ?>" />
					<meta itemprop="productionCompany" content="WheelsTV" />
					<meta itemprop="contributor" content="<?php echo $this->_aVars['aDvs']['dealer_name']; ?>" />
					<meta itemprop="url" content="<?php echo $this->_aVars['aFirstVideoMeta']['url']; ?>" id="schema_video_url"/>
					<meta itemprop="thumbnailUrl" content="<?php echo $this->_aVars['aFirstVideoMeta']['thumbnail_url']; ?>"  id="schema_video_thumbnail_url"/>
					<meta itemprop="image" content="<?php echo $this->_aVars['aFirstVideoMeta']['thumbnail_url']; ?>"  id="schema_video_image"/>
					<meta itemprop="embedUrl" content="http://c.brightcove.com/services/viewer/federated_f9/1970101121001?isVid=1&amp;isUI=1&amp;domain=embed&amp;playerID=1970101121001&amp;publisherID=607012070001&amp;videoID=<?php echo $this->_aVars['aFirstVideoMeta']['referenceId']; ?>" id="schema_video_embed_url"/>
					<meta itemprop="uploadDate" content="<?php echo $this->_aVars['aFirstVideoMeta']['upload_date']; ?>"  id="schema_video_upload_date"/>
					<meta itemprop="duration" content="<?php echo $this->_aVars['aFirstVideoMeta']['duration']; ?>"  id="schema_video_duration"/>
					<meta itemprop="name" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_name_meta']; ?>"  id="schema_video_name"/>
					<meta itemprop="description" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_description_meta']; ?>"  id="schema_video_description"/>
<?php endif; ?>
<?php endif; ?>
			<div style="display:none;"></div>
			<object id="myExperience" class="BrightcoveExperience">
				<param name="bgcolor" value="#000000" />
<?php if ($this->_aVars['bIsFindWidth']): ?>
                    <param name="width" value="<?php echo $this->_aVars['iMaxPlayerWidth']; ?>" />
                    <param name="height" value="<?php echo $this->_aVars['iMaxPlayerHeight']; ?>" />
<?php elseif ($this->_aVars['bIsDvs']): ?>
                    <param name="width" value="580" />
                    <param name="height" value="320" />
<?php else: ?>
					<param name="width" value="<?php echo $this->_aVars['iPlayerWidth']; ?>" />
					<param name="height" value="<?php echo $this->_aVars['iPlayerHeight']; ?>" />
<?php endif; ?>
				<param name="wmode" value="transparent" />
<?php if ($this->_aVars['bIsExternal']): ?>
				<param name="playerID" value="<?php echo $this->_aVars['iPlayerId']; ?>" />
				<param name="playerKey" value="<?php echo $this->_aVars['sPlayerKey']; ?>" />
<?php else: ?>
				<param name="playerID" value="1418431455001" />
				<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
<?php endif; ?>
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
<?php if (! $this->_aVars['bIsExternal'] && $this->_aVars['aPlayer']['preroll_file_id']): ?>
					<param name="adServerURL" value="<?php echo $this->_aVars['sPrerollXmlUrl']; ?>" />
<?php endif; ?>
<?php if (! $this->_aVars['bPreview']): ?>
<?php if ($this->_aVars['bIsDvs']): ?>
						<param name="accountID" value="<?php echo $this->_aVars['aDvs']['dvs_google_id']; ?>" />
<?php else: ?>
						<param name="accountID" value="<?php echo $this->_aVars['aPlayer']['google_id']; ?>" />
<?php endif; ?>
<?php endif; ?>
				<param name="includeAPI" value="true" />
				<param name="templateLoadHandler" value="onTemplateLoad" />
				<param name="templateLoadHandler" value="onTemplateLoaded" />
				<param name="templateReadyHandler" value="onTemplateReady" />
				<param name="showNoContentMessage" value="false" />
				<param name="linkBaseURL" value="<?php echo $this->_aVars['sLinkBase']; ?>" id="bc_player_param_linkbase" />
			</object>
		</div>
<?php else: ?>
		<div class="player_error"><?php echo Phpfox::getPhrase('dvs.no_videos_error'); ?></div>
<?php endif; ?>
</div>
