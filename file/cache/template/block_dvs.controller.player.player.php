<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 8:05 pm */ ?>
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
		var bAutoAdvance = <?php if (isset ( $this->_aVars['aPlayer']['autoadvance'] ) && $this->_aVars['aPlayer']['autoadvance']): ?>true<?php else: ?>false<?php endif; ?>;
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
		modVid.setStyles('video-background:#000000;titleText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;buttons-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-rolloverIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-selectedIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-glow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-iconGlow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-rollover:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-selected:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;playheadWell-background:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playheadWell-watched:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playhead-face:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-track:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;volumeControl-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;linkText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-downState:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;');
<?php endif; ?>
	}

	function enableVideoSelectCarousel(){
	if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
		$('#overview_playlist').show();
		$("#overview_playlist").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev",
		circular: false,
		visible: 4,
		scroll: 3,
		speed: 900
	});
	}

	function enableInventoryCarousel(){
	if (bDebug) console.log("Player: enableInventoryCarousel called.");
		$('#overview_inventory').show();
		$("#overview_inventory").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev",
		circular: false,
		visible: 2,
		scroll: 1,
		speed: 900
	});
	}

	$Behavior.jCarousel = function() {
<?php if ($this->_aVars['aDvs']['inv_display_status']): ?>
		$("#overview_inventory").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev",
			circular: false,
			visible: 2,
			scroll: 2,
			speed: 900
		});
<?php else: ?>
<?php if ($this->_aVars['bIsDvs']): ?>
			$("#overview_playlist").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev",
			circular: false,
			visible: 4,
			scroll: 3,
			speed: 900
			});
<?php else: ?>
			$("#overview_playlist").jCarouselLite({
			btnNext: ".next",
			btnPrev: ".prev",
			circular: false,
			visible: <?php if (( $this->_aVars['bIsExternal'] || ( ! $this->_aVars['bIsDvs'] && isset ( $this->_aVars['iPlaylistThumbnails'] ) ) )):  echo $this->_aVars['iPlaylistThumbnails'];  else: ?>4<?php endif; ?>,
			scroll: <?php if (( $this->_aVars['bIsExternal'] || ( ! $this->_aVars['bIsDvs'] && isset ( $this->_aVars['iScrollAmt'] ) ) )):  echo $this->_aVars['iScrollAmt'];  else: ?>3<?php endif; ?>,
			speed: 900
			});
<?php endif; ?>
<?php endif; ?>
	}
</script>

<?php if (( $this->_aVars['bIsDvs'] && $this->_aVars['aOverviewVideos'] ) || ( ! $this->_aVars['bIsDvs'] && $this->_aVars['aVideos'] )): ?>
<section id="dvs_bc_player"<?php if ($this->_aVars['bIsDvs']): ?> itemscope itemtype="http://schema.org/VideoObject"<?php endif; ?>>
<?php if ($this->_aVars['bIsDvs']):  if (! $this->_aVars['bPreview']): ?>
<meta itemprop="creator" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_creator_meta']; ?>" />
<meta itemprop="productionCompany" content="<?php echo $this->_aVars['aDvs']['dealer_name']; ?>" />
<meta itemprop="contributor" content="<?php echo $this->_aVars['aDvs']['dealer_name']; ?>" />
<meta itemprop="url" content="<?php echo $this->_aVars['aFirstVideoMeta']['url']; ?>" id="schema_video_url"/>
<meta itemprop="thumbnailUrl" content="<?php echo $this->_aVars['aFirstVideoMeta']['thumbnail_url']; ?>"  id="schema_video_thumbnail_url"/>
<meta itemprop="image" content="<?php echo $this->_aVars['aFirstVideoMeta']['thumbnail_url']; ?>"  id="schema_video_image"/>
<meta itemprop="uploadDate" content="<?php echo $this->_aVars['aFirstVideoMeta']['upload_date']; ?>"  id="schema_video_upload_date"/>
<meta itemprop="duration" content="<?php echo $this->_aVars['aFirstVideoMeta']['duration']; ?>"  id="schema_video_duration"/>
<meta itemprop="name" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_name_meta']; ?>"  id="schema_video_name"/>
<meta itemprop="description" content="<?php echo $this->_aVars['aDvs']['phrase_overrides']['override_meta_itemprop_description_meta']; ?>"  id="schema_video_description"/>
<?php endif; ?>


<?php if ($this->_aVars['aPlayer']['custom_overlay_1_type']): ?>
<div id="dvs_overlay_1" class="dvs_overlay">
<?php if ($this->_aVars['aPlayer']['custom_overlay_1_type'] == 1): ?>
	<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="<?php echo $this->_aVars['sImagePath']; ?>overlay.png" alt="Contact Dealer" /></a>
<?php else: ?>
	<a href="<?php echo $this->_aVars['aPlayer']['custom_overlay_1_url']; ?>" target="_blank"><?php echo $this->_aVars['aPlayer']['custom_overlay_1_text']; ?></a>
<?php endif; ?>
</div>
<?php endif;  if ($this->_aVars['aPlayer']['custom_overlay_2_type']): ?>
<div id="dvs_overlay_2" class="dvs_overlay">
<?php if ($this->_aVars['aPlayer']['custom_overlay_2_type'] == 1): ?>
	<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="<?php echo $this->_aVars['sImagePath']; ?>overlay.png" alt="Contact Dealer" /></a>
<?php else: ?>
	<a href="<?php echo $this->_aVars['aPlayer']['custom_overlay_2_url']; ?>" target="_blank"><?php echo $this->_aVars['aPlayer']['custom_overlay_2_text']; ?></a>
<?php endif; ?>
</div>
<?php endif;  if ($this->_aVars['aPlayer']['custom_overlay_3_type']): ?>
<div id="dvs_overlay_3" class="dvs_overlay" >
<?php if ($this->_aVars['aPlayer']['custom_overlay_3_type'] == 1): ?>
	<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="<?php echo $this->_aVars['sImagePath']; ?>overlay.png"/></a>
<?php else: ?>
	<a href="<?php echo $this->_aVars['aPlayer']['custom_overlay_3_url']; ?>" target="_blank"><?php echo $this->_aVars['aPlayer']['custom_overlay_3_text']; ?></a>
<?php endif; ?>
</div>
<?php endif; ?>


<?php endif; ?>
<object id="myExperience" class="BrightcoveExperience">
	<param name="bgcolor" value="#FFFFFF" />
	<param name="wmode" value="transparent" />
<?php if ($this->_aVars['bIsDvs']): ?>
		<param name="width" value="720" />
		<param name="height" value="405" />
<?php else: ?>
		<param name="width" value="<?php echo $this->_aVars['iPlayerWidth']; ?>" />
		<param name="height" value="<?php echo $this->_aVars['iPlayerHeight']; ?>" />
<?php endif; ?>
<?php if ($this->_aVars['bIsExternal']): ?>
		<param name="playerID" value="<?php echo $this->_aVars['iPlayerId']; ?>" />
		<param name="playerKey" value="<?php echo $this->_aVars['sPlayerKey']; ?>" />
<?php else: ?>
		<param name="playerID" value="1418431455001" />
		<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
<?php endif; ?>
<?php if ($this->_aVars['bIsExternal']): ?>
		<!-- external player -->
		<param name="playerID" value="<?php echo $this->_aVars['iPlayerId']; ?>" />
		<param name="playerKey" value="<?php echo $this->_aVars['sPlayerKey']; ?>" />
<?php else: ?>
		<!-- default player -->
		<param name="playerID" value="1418431455001" />
		<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
<?php endif; ?>
	<param name="isVid" value="true" />
	<param name="isUI" value="true" />
	<param name="dynamicStreaming" value="true" />
<?php if (! $this->_aVars['bIsExternal'] && $this->_aVars['aPlayer']['preroll_file_id']): ?>
		<param name="adServerURL" value="<?php echo $this->_aVars['sPrerollXmlUrl']; ?>" />
<?php endif; ?>
<?php if (! $this->_aVars['bPreview'] && ! $this->_aVars['bIsExternal']): ?>
<?php if ($this->_aVars['bIsDvs']): ?>
			<param name="accountID" value="<?php echo $this->_aVars['aDvs']['dvs_google_id']; ?>" />
<?php else: ?>
			<param name="accountID" value="<?php echo $this->_aVars['aPlayer']['google_id']; ?>" />
<?php endif; ?>
<?php endif; ?>
	<param name="showNoContentMessage" value="false" />	
<?php if ($this->_aVars['sBrowser'] == 'ipad'): ?>
		<param name="includeAPI" value="true" />
		<param name="templateLoadHandler﻿" value="onTemplateLoad" />
		<param name="templateLoadHandler" value="onTemplateLoaded" />
		<param name="templateReadyHandler" value="onTemplateReady" />
<?php else: ?>
<?php if (! $this->_aVars['bPreview'] && ! $this->_aVars['bIsExternal']): ?>
			<param name="linkBaseURL" value="<?php echo $this->_aVars['sLinkBase']; ?>" id="bc_player_param_linkbase" />
<?php endif; ?>
<?php endif; ?>
</object>

<?php echo '
<script type="text/javascript">
	$Behavior.brightCoveCreateExp = function()
	{
		brightcove.createExperiences();
	}
</script>
'; ?>

<?php if ($this->_aVars['bIsDvs'] || ( ! $this->_aVars['bIsExternal'] && ! $this->_aVars['aPlayer']['player_type'] ) || ( $this->_aVars['bIsExternal'] && $this->_aVars['bShowPlaylist'] )): ?>
<section id="playlist_wrapper">
<?php if ($this->_aVars['aDvs']['inv_display_status']): ?>
<?php if ($this->_aVars['inventoryList']): ?>
			<div class="inventory_info_message">
<?php if (count($this->_aVars['inventoryList']) > 1): ?>
<?php echo count($this->_aVars['inventoryList']); ?> <?php echo $this->_aVars['aFirstVideo']['make']; ?> <?php echo $this->_aVars['aFirstVideo']['model']; ?>'s available in inventory! Select one below:
<?php elseif (count($this->_aVars['inventoryList']) == 1): ?>
<?php echo count($this->_aVars['inventoryList']); ?> <?php echo $this->_aVars['aFirstVideo']['make']; ?> <?php echo $this->_aVars['aFirstVideo']['model']; ?> available in inventory! Select it below:
<?php endif; ?>
			</div>
			<button class="prev playlist-button">&lt;</button>
			<div class="playlist_carousel" id="overview_inventory">
				<ul>
<?php if (count((array)$this->_aVars['inventoryList'])):  foreach ((array) $this->_aVars['inventoryList'] as $this->_aVars['invKey'] => $this->_aVars['inventoryItem']): ?>
						<li>
							<div class="inv_dvs_wrapper">
								<div class="inv_dvs_avatar">
									<a href="<?php echo $this->_aVars['inventoryItem']['link']; ?>" onclick="inventoryClickDvs();" target="_blank">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => $this->_aVars['inventoryItem']['image'],'max_width' => 145,'max_height' => 82)); ?>
									</a>
								</div>
								<div class="inv_dvs_info">
									<p><a href="<?php echo $this->_aVars['inventoryItem']['link']; ?>" onclick="inventoryClickDvs();" target="_blank"><?php echo $this->_aVars['inventoryItem']['title']; ?></a></p>
									<p><?php echo Phpfox::getPhrase('dvs.color'); ?>: <?php echo $this->_aVars['inventoryItem']['color']; ?></p>
									<p><?php echo Phpfox::getPhrase('dvs.msrp'); ?>: <?php echo $this->_aVars['inventoryItem']['price']; ?></p>
									<p class="view_details">
										<a href="<?php echo $this->_aVars['inventoryItem']['link']; ?>" onclick="inventoryClickDvs();" title="<?php echo Phpfox::getPhrase('dvs.view_details'); ?>" target="_blank"><?php echo Phpfox::getPhrase('dvs.view_details'); ?></a>
									</p>
								</div>
							</div>
						</li>
<?php endforeach; endif; ?>
				</ul>
			</div>
			<button class="next playlist-button">&gt;</button>
<?php else: ?>
			<div class="inventory_info_message">
<?php echo Phpfox::getPhrase('dvs.we_dont_have'); ?> <?php echo $this->_aVars['aFirstVideo']['make']; ?> <?php echo $this->_aVars['aFirstVideo']['model']; ?> <?php echo Phpfox::getPhrase('dvs.in_stock_at_this_time'); ?>. <a href="#" onclick="tb_show('Contact Dealer', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=<?php echo $this->_aVars['aFirstVideo']['referenceId']; ?>')); menuContact('Call To Action Menu Clicks'); return false;">Click here</a> to request this vehicle!
			</div>
<?php endif; ?>
<?php else: ?>
		<button class="prev playlist-button">&lt;</button>
		<div class="playlist_carousel" id="overview_playlist">
			<ul>
<?php if ($this->_aVars['bIsDvs']): ?>
<?php if (count((array)$this->_aVars['aOverviewVideos'])):  foreach ((array) $this->_aVars['aOverviewVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']): ?>
				<li>
					<a class="playlist_carousel_image_link" <?php if ($this->_aVars['aDvs']['gallery_target_setting'] == 1): ?>target="_blank" <?php endif; ?> onclick="thumbnailClick(<?php echo $this->_aVars['iKey']; ?>);thumbnailClickDvs();">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'brightcove/'.$this->_aVars['aVideo']['thumbnail_image'],'max_width' => 145,'max_height' => 82)); ?>
					<p><?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['model']; ?></p>
					</a>
				</li>
<?php endforeach; endif; ?>
				<li style='display: none;'></li>
<?php else: ?>
<?php if (count((array)$this->_aVars['aVideos'])):  foreach ((array) $this->_aVars['aVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']): ?>
				<li>
					<a class="playlist_carousel_image_link" onclick="thumbnailClick(<?php echo $this->_aVars['iKey']; ?>);thumbnailClickIDrive();">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'brightcove/'.$this->_aVars['aVideo']['thumbnail_image'],'max_width' => 145,'max_height' => 82)); ?>
					<p><?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['model']; ?></p>
					</a>
					
				</li>
<?php endforeach; endif; ?>
<?php echo $this->_aVars['sExtraLi']; ?>
<?php endif; ?>
			</ul>
		</div>
		<button class="next playlist-button">&gt;</button>
<?php endif; ?>
</section>
<?php endif; ?>
</section><?php else: ?><div class="player_error"><?php echo Phpfox::getPhrase('dvs.no_videos_error'); ?></div><?php endif; ?><section id="chapter_buttons">
	<button type="button" id="chapter_container_Intro" class="disabled display" onclick="changeCuePoint('Intro');"></button>
	<button type="button" id="chapter_container_Overview" class="disabled no_display" onclick="changeCuePoint('Overview');"></button>
	<button type="button" id="chapter_container_WhatsNew" class="disabled display" onclick="changeCuePoint('WhatsNew');"></button>
	<button type="button" id="chapter_container_Exterior" class="disabled display" onclick="changeCuePoint('Exterior');"></button>
	<button type="button" id="chapter_container_Interior" class="disabled display" onclick="changeCuePoint('Interior');"></button>
	<button type="button" id="chapter_container_Features" class="disabled no_display" onclick="changeCuePoint('Features');"></button>
	<button type="button" id="chapter_container_Power" class="disabled display" onclick="changeCuePoint('Power');"></button>
	<button type="button" id="chapter_container_Fuel" class="disabled display" onclick="changeCuePoint('Fuel');"></button>
	<button type="button" id="chapter_container_Safety" class="disabled display" onclick="changeCuePoint('Safety');"></button>
	<button type="button" id="chapter_container_Warranty" class="disabled display" onclick="changeCuePoint('Warranty');"></button>
	<button type="button" id="chapter_container_Performance" class="disabled no_display" onclick="changeCuePoint('Performance');"></button>
	<button type="button" id="chapter_container_MPG" class="disabled no_display" onclick="changeCuePoint('MPG');"></button>
	<button type="button" id="chapter_container_Honors" class="disabled no_display" onclick="changeCuePoint('Honors');"></button>
	<button type="button" id="chapter_container_Summary" class="disabled display" onclick="changeCuePoint('Summary');"></button>
<?php if (( Phpfox ::getParam('dvs.enable_subdomain_mode') && Phpfox ::getLib('request')->get('req2') == 'iframe' ) || ( ! Phpfox ::getParam('dvs.enable_subdomain_mode') && Phpfox ::getLib('request')->get('req3') == 'iframe' )): ?>
<?php else: ?>
<?php if ($this->_aVars['bIsDvs'] && ! $this->_aVars['bPreview']): ?>
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['iDvsId']; ?>&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPrice(); return false;"></button>
<?php elseif (! $this->_aVars['bIsExternal'] && ! $this->_aVars['bIsDvs'] && isset ( $this->_aVars['aPlayer']['email'] ) && $this->_aVars['aPlayer']['email']): ?>
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.contact_dealer'); ?>', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPriceIDrive(); return false;"></button>
<?php elseif ($this->_aVars['bIsExternal'] && $this->_aVars['bShowGetPrice']): ?>
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="getPriceExternal('<?php echo $this->_aVars['sEmail']; ?>');"></button>
<?php endif; ?>
<?php endif; ?>
</section>
<?php if ($this->_aVars['bIsExternal']):  echo '
<script type="text/javascript">

$Behavior.thumgs = function() {
var bAutoplay = false;
exteralthumbnailClick(1);
}
</script>
'; ?>

<?php endif; ?>

