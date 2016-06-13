<?php
defined('PHPFOX') or exit('No direct script access allowed.');
?>
<style type="text/css">
#dvs_bc_player {l}
        width: 717px;
        height: 526px;
        position: relative;
    {r}
#playlist_wrapper {l}
        position: absolute;
        bottom: 0px;
    {r}
 #bcv2 {l}
        display: block;
        {if $bIsDvs}
        width: 720px;
        height: 405px;
        {else}
        width: {$iPlayerWidth}px;
        height: {$iPlayerHeight}px;
        {/if}
    {r}  
#overview_playlist {l}
height: 110px !important;
{r}           
#overview_playlist ul li img {l}
width: 149px !important;
{r}    
#overview_playlist ul li {l}
width: 149px !important;
height: 106px !important;
{r}     
.vjs-overlay {l}
background:none !important;
width:100% !important;
padding-top:0 !important;
top:0 !important;
{r}     
.vjs-overlay-buttons {l}
    display:none !important;
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
    top: 125px !important;
    left: 280px !important;
{r}
</style>
<link rel="stylesheet" type="text/css" href="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.css">
<link href="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.css" rel='stylesheet'>
{if !empty($sJavascript)}{$sJavascript}{/if}
<script type="text/javascript">

    var bIsSupportVideo = !!document.createElement('video').canPlayType;
    var aMediaIds = [];
    var aOverviewMediaIds = [];
    var aTestDriveMediaIds = [];
    var bIsHtml5 = false;
    var ovdr = "preroll";
    {if $aDvs.player_type}
        if (bIsSupportVideo) {l}
        var bIsHtml5 = true;
        {r}
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
         var bCustomOverlay1Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
         {elseif $aPlayer.custom_overlay_1_type == 3}
         {if $aPlayer.custom_overlay_1_text != ''}
         var bCustomOverlay1Content = '<a href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="textOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_1_text}"></a>';
         {else}
         var bCustomOverlay1Content = '';
         bCustomOverlay1 = false;
         {/if}
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
          var bCustomOverlay2Content =  '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
        {elseif $aPlayer.custom_overlay_2_type == 3}
         {if $aPlayer.custom_overlay_2_text != ''}
         var bCustomOverlay2Content = '<a href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="textOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_2_text}"></a>';
         {else}
         var bCustomOverlay2Content = '';
     bCustomOverlay2 = false;
         {/if}
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
           var bCustomOverlay3Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>'
        {elseif $aPlayer.custom_overlay_3_type == 3}
         {if $aPlayer.custom_overlay_3_text != ''}
         var bCustomOverlay3Content = '<a href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="textOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_3_text}"></a>';
        {else}
        var bCustomOverlay3Content = ''; 
        bCustomOverlay3 = false;
        {/if} 
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
        var bAutoplay = {if (isset($aPlayer.autoplay) && $aPlayer.autoplay) || (isset($aPlayer.autoplay_baseurl) && $aPlayer.autoplay_baseurl && !$aBaseUrl) || (isset($aPlayer.autoplay_videourl) && $aPlayer.autoplay_videourl && $aBaseUrl)}true{else}false{/if};
            {if !$aDvs.is_active}bAutoplay = false;{/if}
        var iCurrentVideo = {$aCurrentVideo};
        var bAutoAdvance = {if isset($aPlayer.autoadvance) && $aPlayer.autoadvance}true{else}false{/if};
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
        $('#overview_playlist').show();
        $("#overview_playlist").jCarouselLite({l}
        btnNext: ".next",
        btnPrev: ".prev",
        circular: false,
        visible: 4,
        scroll: 3,
        speed: 900
    {r});
    {r}

    function enableInventoryCarousel(){l}
    if (bDebug) console.log("Player: enableInventoryCarousel called.");
        $('#overview_inventory').show();
        $("#overview_inventory").jCarouselLite({l}
        btnNext: ".next",
        btnPrev: ".prev",
        circular: false,
        visible: 2,
        scroll: 1,
        speed: 900
    {r});
    {r}

    $Behavior.jCarousel = function() {l}
    {if $aDvs.inv_display_status}
        $("#overview_inventory").jCarouselLite({l}
            btnNext: ".next",
            btnPrev: ".prev",
            circular: false,
            visible: 2,
            scroll: 2,
            speed: 900
        {r});
        {else}
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
            visible: {if ($bIsExternal || (!$bIsDvs && isset($iPlaylistThumbnails)))}{$iPlaylistThumbnails}{ else}4{/if},
            scroll: {if ($bIsExternal || (!$bIsDvs && isset($iScrollAmt)))}{$iScrollAmt}{ else}3{/if},
            speed: 900
            {r});
        {/if}
    {/if}
    {r}   

</script>

{if ($bIsDvs && $aOverviewVideos) || (!$bIsDvs && $aVideos)}
<section id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
{if $bIsDvs}
{if !$bPreview}
<meta itemprop="creator" content="{$aDvs.phrase_overrides.override_meta_itemprop_creator_meta}" />
<meta itemprop="url" content="{$aFirstVideoMeta.url}" id="schema_video_url"/>
<meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
<meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
<meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
<meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
<meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
<meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
{/if}
{/if}
<video id="bcv2" data-account="607012070001" data-player="0d15f8a3-b382-44ca-a53b-51870dd2ad3f" data-embed="default" class="video-js" controls="true" preload=""></video>
</section>
 
<!--<section id="playlist_wrapper{if $inventoryList} inventory_wrapper{/if}">
        <button class="prev playlist-button">&lt;</button>
        <div class="playlist_carousel" id="overview_playlist">
            <ul>
                {if $bIsDvs}
                {foreach from=$aOverviewVideos key=iKey item=aVideo}
                <li>
                    <a class="playlist_carousel_image_link" id="thumbnail_link_{$iKey}" {if $aDvs.gallery_target_setting==1}target="_blank" {/if}>
                        {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                    <p>{$aVideo.year} {$aVideo.model}</p>
                    </a>
                </li>
                {/foreach}
                <li style='display: none;'></li>
                {else}
                {foreach from=$aVideos key=iKey item=aVideo}
                <li>
                    <a class="playlist_carousel_image_link">
                        {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                    <p>{$aVideo.year} {$aVideo.model}</p>
                    </a>
                    
                </li>
                {/foreach}
                {$sExtraLi}
                {/if}
            </ul>
        </div>
        <button class="next playlist-button">&gt;</button>
</section>-->
{else}<div class="player_error">{phrase var='dvs.no_videos_error'}</div>{/if}<section id="chapter_buttons">
    <button type="button" id="chapter_container_Intro" class="disabled display"></button>
    <button type="button" id="chapter_container_Overview" class="disabled no_display"></button>
    <button type="button" id="chapter_container_WhatsNew" class="disabled display"></button>
    <button type="button" id="chapter_container_Exterior" class="disabled display"></button>
    <button type="button" id="chapter_container_Interior" class="disabled display"></button>
    <button type="button" id="chapter_container_Features" class="disabled no_display"></button>
    <button type="button" id="chapter_container_Power" class="disabled display"></button>
    <button type="button" id="chapter_container_Fuel" class="disabled display"></button>
    <button type="button" id="chapter_container_Safety" class="disabled display"></button>
    <button type="button" id="chapter_container_Warranty" class="disabled display"></button>
    <button type="button" id="chapter_container_Performance" class="disabled no_display"></button>
    <button type="button" id="chapter_container_MPG" class="disabled no_display"></button>
    <button type="button" id="chapter_container_Honors" class="disabled no_display"></button>
    <button type="button" id="chapter_container_Summary" class="disabled display"></button>
    {if (Phpfox::getParam('dvs.enable_subdomain_mode') && Phpfox::getLib('request')->get('req2') == 'iframe') || (!Phpfox::getParam('dvs.enable_subdomain_mode') && Phpfox::getLib('request')->get('req3') == 'iframe')}
    {else}
    {if $bIsDvs && !$bPreview}
    <button type="button" id="chapter_container_Get_Price" class="disabled no_display" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPrice(); return false;"></button>
    {elseif !$bIsExternal && !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}
    <button type="button" id="chapter_container_Get_Price" class="disabled no_display" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPriceIDrive(); return false;"></button>
    {elseif $bIsExternal && $bShowGetPrice}
    <button type="button" id="chapter_container_Get_Price" class="disabled no_display" onclick="getPriceExternal('{$sEmail}');"></button>
    {/if}
    {/if}
</section>
{if $bIsDvs || (!$bIsExternal && !$aPlayer.player_type) || ($bIsExternal && $bShowPlaylist)}
<section id="playlist_wrapper{if $inventoryList} inventory_wrapper{/if}">    
    <button class="prev playlist-button">&lt;</button>
    <div class="playlist_carousel" id="overview_playlist">
        <ul>
            {if $bIsDvs}
            {foreach from=$aOverviewVideos key=iKey item=aVideo}
            <li>
                <a class="playlist_carousel_image_link" id="thumbnail_link_{$iKey}" {if $aDvs.gallery_target_setting==1}target="_blank" {/if}>
                {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                <p>{$aVideo.year} {$aVideo.model}</p>
                </a>

            </li>
            {/foreach}
            <li style='display: none;'></li>
            {else}
            {foreach from=$aVideos key=iKey item=aVideo}
            <li>
                <a class="playlist_carousel_image_link" id="thumbnail_link_{$iKey}">
                    {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                <p>{$aVideo.year} {$aVideo.model}</p>
                </a>

            </li>
            {/foreach}
            {$sExtraLi}
            {/if}
        </ul>
    </div>
    <button class="next playlist-button">&gt;</button>
</section>
{/if}
<script src="//players.brightcove.net/607012070001/0d15f8a3-b382-44ca-a53b-51870dd2ad3f_default/index.min.js"></script> 
<script type="text/javascript" src="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.min.js"></script>
<script src="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.js"></script>
