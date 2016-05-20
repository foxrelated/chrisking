<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright        Konsort.org
 * @author          Konsort.org
 * @package         DVS
 */
?>

{if !empty($sJavascript)}{$sJavascript}{/if}
<script type="text/javascript">
    var aMediaIds = [];
    var aOverviewMediaIds = [];
    var aTestDriveMediaIds = [];
    var bIsHtml5 = false;
    {if $aDvs.player_type}
        var bIsHtml5 = true;
    {/if}
    {if $bIsDvs}

    {foreach from = $aOverviewVideos key = iKey item = aVideo}
        aOverviewMediaIds[{$iKey}] = {$aVideo.id};
    {/foreach}

    aMediaIds = aOverviewMediaIds;

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

  var contact_dealer = "{phrase var='dvs.contact_dealer'}";
    {if $aPlayer.custom_overlay_1_type}
        if (bDebug) console.log('Overlay: Overlay 1 is active. Type: {$aPlayer.custom_overlay_1_type}. Start: {$aPlayer.custom_overlay_1_start}. Duration: {$aPlayer.custom_overlay_1_duration}.');
        var bCustomOverlay1 = true;
        
        {if $aPlayer.custom_overlay_1_type == 1}
         var bCustomOverlay1Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=600&amp;width=520&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
        {else}
        var bCustomOverlay1Content = '<a href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_1_text}</a>';
        {/if}
        
        var iCustomOverlay1Start = {$aPlayer.custom_overlay_1_start};
        var iCustomOverlay1Duration = {$aPlayer.custom_overlay_1_duration};
    {else}
        var bCustomOverlay1 = false;
        if (bDebug) console.log('Overlay: Overlay 1 is inactive.');
    {/if}

    {if $aPlayer.custom_overlay_2_type}
        if (bDebug) console.log('Overlay: Overlay 2 is active. Type: {$aPlayer.custom_overlay_2_type}. Start: {$aPlayer.custom_overlay_2_start}. Duration: {$aPlayer.custom_overlay_2_duration}.');
        var bCustomOverlay2 = true;
        
        {if $aPlayer.custom_overlay_2_type == 1}
          var bCustomOverlay2Content =  '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=600&amp;width=520&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
        {else}
        var bCustomOverlay2Content = '<a href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_2_text}</a>';
        {/if}
        var iCustomOverlay2Start = {$aPlayer.custom_overlay_2_start};
        var iCustomOverlay2Duration = {$aPlayer.custom_overlay_2_duration};
    {else}
        var bCustomOverlay2 = false;
        if (bDebug) console.log('Overlay: Overlay 2 is inactive.');
    {/if}

    {if $aPlayer.custom_overlay_3_type}
        if (bDebug) console.log('Overlay: Overlay 3 is active. Type: {$aPlayer.custom_overlay_3_type}. Start: {$aPlayer.custom_overlay_3_start}. Duration: {$aPlayer.custom_overlay_3_duration}.');
        var bCustomOverlay3 = true;
        {if $aPlayer.custom_overlay_3_type == 1}
           var bCustomOverlay3Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=600&amp;width=520&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>'
        {else}
        var bCustomOverlay3Content = '<a href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_3_text}</a>';
        {/if}
        var iCustomOverlay3Start = {$aPlayer.custom_overlay_3_start};
        var iCustomOverlay3Duration = {$aPlayer.custom_overlay_3_duration};
    {else}
        var bCustomOverlay3 = false;
        if (bDebug) console.log('Overlay: Overlay 3 is inactive.');
    {/if}

    {else}
        {foreach from = $aVideos key = iKey item = aVideo}
            aMediaIds[{$iKey}] = {$aVideo.id};
        {/foreach}

        {if isset($aFeaturedVideo.id)}
            aMediaIds[0] = {$aFeaturedVideo.id};
        {/if}
    {/if}

    {if !$bIsExternal}
        var bPreRoll = {if $aPlayer.preroll_file_id}true{else}false{/if};
        var bPreRollUrl = {if $aPlayer.preroll_file_id}"{$prerollUrl}" {else}""{/if};
        var preRollUrl = {if $aPlayer.preroll_file_id}"{$prerollClickUrl}" {else}""{/if};
        var iDvsId = {if $bIsDvs}{$iDvsId}{else}0{/if};
        var bIdriveGetPrice = {if !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}true{else}false{/if};
        var bPreview = {if $bPreview}true{else}false{/if};
        var bAutoplay = {if (isset($aPlayer.autoplay) && $aPlayer.autoplay) || (isset($aPlayer.autoplay_baseurl) && $aPlayer.autoplay_baseurl && !$aBaseUrl) || (isset($aPlayer.autoplay_videourl) && $aPlayer.autoplay_videourl && $aBaseUrl)}true{ else}false{/if};
            {if !$aDvs.is_active}bAutoplay = false;{/if}
        var iCurrentVideo = {$aCurrentVideo};
        var bAutoAdvance ={if isset($aPlayer.autoadvance) && $aPlayer.autoadvance}true{else}false{/if};
        var inventory_btn = {if $aDvs.inventory_url} "{$aDvs.inventory_url}" {else} "" {/if};
        var inventory_text = {if $aDvs.inventory_url} "{phrase var='dvs.show_inventory'}" {else} "" {/if};
    {else}
        var bPreRoll = false;
        var iDvsId = 0;
        var bIdriveGetPrice = {if $bShowGetPrice}true{else}false{/if};
        var bPreview = false;
        var bAutoplay = {if $bAutoplay}true{else}false{/if};
            {if !$aDvs.is_active}bAutoplay = false;{/if}
        var bAutoAdvance = true;
    {/if}
    
    function enableVideoSelectCarousel(){l}
        if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
    {r}
</script>

{if ($bIsExternal || (!$bIsDvs && isset($iChapterButtonLeft)))}
    <style type="text/css">
        #chapter_buttons {l}
            left: {$iChapterButtonLeft}px;
            /*left: 50px;*/
        {r}
        #dvs_player_container {l}
            width: {$iBackgroundWidth}px;
            height: {$iBackgroundHeight}px;
            /*width: 100px;
            height: 100px;*/
        {r}
        #playlist_wrapper{l}
            width: {$iPlayerWidth}px;
        {r}
       
        
    </style>
{/if}
<style type="text/css">
.video-js {l}
        width: 100%;
        position: relative;
        height: auto !important;
    {r}
.bc-player-0d15f8a3-b382-44ca-a53b-51870dd2ad3f_default .vjs-tech {l}
position : relative !important;
height : 100%;
max-height:410px;
min-height:410px;
{r}

 .vjs-tech {l}
min-height:0 !important;
{r}
    
 .vjs-overlay-buttons {l}
    display:none !important;
{r}  
.vjs-overlay {l}
background:none !important;
width:100% !important;
padding-top:0 !important;
top:0 !important;
{r}

{if !$bIsExternal}    
.vjs-time-control {l}
color:#{$aPlayer.player_text}
{r}
.vjs-control-bar, .vjs-menu-content, .vjs-big-play-button {l}
background:#{$aPlayer.player_buttons} !important;
{r}
.vjs-play-control, .vjs-volume-menu-button, .vjs-fullscreen-control, .vjs-big-play-button:before {l}
color:#{$aPlayer.player_button_icons} !important;
{r} 

.vjs-play-progress, .vjs-volume-level {l}
background: #{$aPlayer.player_progress_bar} !important;
{r}
{/if}        
.vjs-big-play-button {l}
    top: 135px !important;
    left: 270px !important;
{r}
.vjs-fullscreen {l}
overflow : visible;
{r}
.vjs-fullscreen .vjs-control-bar {l}
position : fixed !important;
bottom : 0;
{r}


</style>
<link rel="stylesheet" type="text/css" href="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.css">
<link href="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.css" rel='stylesheet'>

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
                    <meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
                    <meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
                    <meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
                    <meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
                {/if}
            {/if}
            <div style="display:none;"></div>
            <video loop autoplay  id="bcv2" data-account="607012070001" data-setup="{}" data-player="0d15f8a3-b382-44ca-a53b-51870dd2ad3f" data-embed="default" class="video-js" controls="true" width="100%" height="100%" preload="">
 
             </video>
            
        </div>
    {else}
        <div class="player_error">{phrase var='dvs.no_videos_error'}</div>
    {/if}
</div>
<script src="//players.brightcove.net/607012070001/0d15f8a3-b382-44ca-a53b-51870dd2ad3f_default/index.min.js"></script> 
<script type="text/javascript" src="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.min.js"></script>
<script src="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.js"></script>
