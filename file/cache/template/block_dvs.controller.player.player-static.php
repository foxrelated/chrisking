<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 2:24 am */ ?>
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

 echo $this->_aVars['sJavascript']; ?>
<script type="text/javascript">
	var aMediaIds=[];
	aMediaIds[0]='<?php echo $this->_aVars['sReferenceId']; ?>';
	var aOverviewMediaIds=[];
	var aTestDriveMediaIds=[];
	var bPreRoll = false;
	var iDvsId = 0;
	var bIdriveGetPrice = false;
	var bPreview = false;
	var bAutoplay = <?php if ($this->_aVars['aPlayer']['autoplay']): ?>true<?php else: ?>false<?php endif; ?>;
	var bAutoAdvance = false;
	
	function setPlayerStyle(){
		if (bDebug) 
		{
			console.log("Player: Setting player style and volume.");
			modVid.setVolume(0);
		}

		modVid.setStyles('video-background:#<?php echo $this->_aVars['aPlayer']['player_background']; ?>;titleText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;titleText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;bodyText-selected:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;buttons-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-rolloverIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-selectedIcons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-glow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-iconGlow:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;buttons-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-rollover:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;buttons-selected:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;playheadWell-background:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playheadWell-watched:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;playhead-face:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-icons:#<?php echo $this->_aVars['aPlayer']['player_button_icons']; ?>;volumeControl-track:#<?php echo $this->_aVars['aPlayer']['player_progress_bar']; ?>;volumeControl-face:#<?php echo $this->_aVars['aPlayer']['player_buttons']; ?>;linkText-active:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-disabled:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-rollover:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;linkText-downState:#<?php echo $this->_aVars['aPlayer']['player_text']; ?>;');
	}

</script>
<style>
	#dvs_player_container {
		background-color: #<?php echo $this->_aVars['aPlayer']['player_background']; ?>;
	}
</style>
<div id="dvs_player_container">
	<div id="dvs_bc_player"<?php if ($this->_aVars['bIsDvs']): ?> itemscope itemtype="http://schema.org/VideoObject"<?php endif; ?>>
<?php if ($this->_aVars['sBrowser'] != 'desktop'): ?>
			<object id="myExperience" class="BrightcoveExperience">
				<param name="includeAPI" value="true" />
				<param name="templateLoadHandler﻿" value="onTemplateLoad" />
				<param name="bgcolor" value="#FFFFFF" />
<?php if ($this->_aVars['bIsDvs']): ?>
					<param name="width" value="720" />
					<param name="height" value="405" />
<?php else: ?>
					<param name="width" value="<?php echo $this->_aVars['iPlayerWidth']; ?>" />
					<param name="height" value="<?php echo $this->_aVars['iPlayerHeight']; ?>" />
<?php endif; ?>
				<param name="wmode" value="transparent" />
				<param name="playerID" value="1418431455001" />
				<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
<?php if ($this->_aVars['aPlayer']['google_id']): ?>
					<param name="accountID" value="<?php echo $this->_aVars['aPlayer']['google_id']; ?>" />
<?php endif; ?>
				<param name="templateLoadHandler" value="onTemplateLoaded" />
				<param name="templateReadyHandler" value="onTemplateReady" />
				<param name="showNoContentMessage" value="false" />
				<param name="@videoPlayer" value="<?php echo $this->_aVars['sReferenceId']; ?>" />
			</object>
			<script type="text/javascript">brightcove.createExperiences();</script>
<?php else: ?>
			<object id="myExperience" class="BrightcoveExperience">
				<param name="wmode" value="transparent" />
				<param name="bgcolor" value="#FFFFFF" />
<?php if ($this->_aVars['bIsDvs']): ?>
					<param name="width" value="720" />
					<param name="height" value="405" />
<?php else: ?>
					<param name="width" value="<?php echo $this->_aVars['iPlayerWidth']; ?>" />
					<param name="height" value="<?php echo $this->_aVars['iPlayerHeight']; ?>" />
<?php endif; ?>
				<param name="playerID" value="1418431455001" />
				<param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
				<param name="isVid" value="true" />
				<param name="isUI" value="true" />
				<param name="dynamicStreaming" value="true" />
<?php if ($this->_aVars['aPlayer']['google_id']): ?>
					<param name="accountID" value="<?php echo $this->_aVars['aPlayer']['google_id']; ?>" />
<?php endif; ?>
				<param name="showNoContentMessage" value="false" />
			</object>
			<script type="text/javascript">brightcove.createExperiences();</script>
<?php endif; ?>
	</div><div id="chapter_buttons">
		<!-- NOTE: The following parent DIVs (#chapter_container_Intro) are loaded in to a JS object and this div (#chapter_buttons) is cleared. No changes to the parent DIV objects will stick -->
		<div id="chapter_container_Intro" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Intro" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/intro-active.png" alt="">
				</div>
				<div id="chapter_light_green_Intro" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/intro-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Intro" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/intro-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Intro">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/intro-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Setup" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Setup" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/setup-active.png" alt="">
				</div>
				<div id="chapter_light_green_Setup" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/setup-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Setup" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/setup-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Setup">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/setup-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Interactive" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Interactive" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/interactive-active.png" alt="">
				</div>
				<div id="chapter_light_green_Interactive" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/interactive-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Interactive" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/interactive-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Interactive">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/interactive-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Your_Leads" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Your_Leads" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/your_leads-active.png" alt="">
				</div>
				<div id="chapter_light_green_Your_Leads" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/your_leads-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Your_Leads" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/your_leads-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Your_Leads">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/your_leads-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Sharing" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Sharing" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/sharing-active.png" alt="">
				</div>
				<div id="chapter_light_green_Sharing" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/sharing-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Sharing" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/sharing-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Sharing">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/sharing-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Prospecting" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Prospecting" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/prospecting-active.png" alt="">
				</div>
				<div id="chapter_light_green_Prospecting" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/prospecting-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Prospecting" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/prospecting-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Prospecting">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/prospecting-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Selling" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Selling" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/selling-active.png" alt="">
				</div>
				<div id="chapter_light_green_Selling" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/selling-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Selling" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/selling-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Selling">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/selling-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Traffic_Building" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Traffic_Building" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/traffic_building-active.png" alt="">
				</div>
				<div id="chapter_light_green_Traffic_Building" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/traffic_building-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Traffic_Building" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/traffic_building-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Traffic_Building">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/traffic_building-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Our_Support" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Our_Support" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/our_support-active.png" alt="">
				</div>
				<div id="chapter_light_green_Our_Support" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/our_support-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Our_Support" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/our_support-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Our_Support">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/our_support-disabled.png" alt="">
				</div>
			</div>
		</div>

		<div id="chapter_container_Summary" style="display:none;">
			<div class="chapter_light">
				<div id="chapter_light_yellow_Summary" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/summary-active.png" alt="">
				</div>
				<div id="chapter_light_green_Summary" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/summary-selected.png" alt="">
				</div>
				<div id="chapter_light_red_Summary" style="display:none;">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/summary-watched.png" alt="">
				</div>
				<div id="chapter_light_disabled_Summary">
					<img src="<?php echo $this->_aVars['sImagePath']; ?>static_player/summary-disabled.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
