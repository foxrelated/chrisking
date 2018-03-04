<?php
defined('PHPFOX') or exit('No direct script access allowed.');
?>



<style type="text/css">
#dvs_bc_player {l}
        width: 716px;
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
    
.vjs-ended .vjs-poster{l}
    display: block;
    {if $aPlayer.video_endscreen_player == 1}
    opacity:0.3;
    {/if}
{r}
.vjs-ended video{l}
 visibility:hidden;
{r}

.vjs-ended .vjs-custom-overlay{l}
    background-color:transparent;  
    padding:0;
{r}

.endscr_title,.endscr_bottom_nvideo{l}
color:#fff !important;
font-size:20px;    
margin-bottom:10px;
{r}
.vjs-custom-overlay{l}
margin-top:85px;
{r}
.vjs-custom-overlay.vjs_dealer_form{l}
margin-top:0;
font-size:14px;
{r}
.vjs-custom-overlay p{l}
margin-top:20px;
{r}
.vjs-endscreen-overlay-content {l}
display:none;
{r}
.vjs-custom-overlay p a{l}
padding: 8px 25px;
background-color:#{$aDvs.button_background};
border:1px solid #{$aDvs.button_border};
background-image: -webkit-linear-gradient(top, #{$aDvs.button_top_gradient}, #{$aDvs.button_bottom_gradient}); */
background-image: -moz-linear-gradient( center top, #{$aDvs.button_top_gradient} 5%, #{$aDvs.button_bottom_gradient} 100% );
background-image: -ms-linear-gradient( bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100% );
background-image: linear-gradient(to bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100% );
background-image: -o-linear-gradient(bottom, #{$aDvs.button_top_gradient} 0%, #{$aDvs.button_bottom_gradient} 100% );
color:#{$aDvs.button_text};
font-size:20px;
border-radius:10px;
{r}
.vjs-custom-overlay p a:hover{l}
background-image: -webkit-linear-gradient(top, #{$aDvs.button_bottom_gradient}, #{$aDvs.button_top_gradient});
background-image: -moz-linear-gradient(center top, #{$aDvs.button_bottom_gradient} 5%, #{$aDvs.button_top_gradient} 100%);
background-image: -ms-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
background-image: linear-gradient(to bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
background-image: -o-linear-gradient(bottom, #{$aDvs.button_bottom_gradient} 0%, #{$aDvs.button_top_gradient} 100%);
{r}                                          
.vjs-custom-overlay .js_box{l}
    
    float: left !important;
    width: 100% !important;
    position: static !important;
    top: 0 !important;
    left: 0 !important;
    margin-top: 0 !important;
    margin-left: 0 !important;
{r}
.endscr_bottom_nvideo{l}
     position: absolute;
    bottom: 50px;
    width: 100%;
    text-align: center;

{r}
.uleft{l}
 float:left;
{r}
.uleft.cdtxt{l}
width:40%;
text-align:left;
{r}
.uleft.cdfields{l}
width:  40%;
float: right;
text-align:left;
{r}
.cdfields input, #contact_dealer .cdfields textarea{l}
     width:100%;
     color:#333 ;
{r}

.uleft.cdtxt p,.vjs-custom-overlay #dvs_contact_success{l}
color:#000;
{r}     
/*input:-ms-input-placeholder, textarea:-ms-input-placeholder{l}*/
:-ms-input-placeholder{l}
color:#666 !important;
{r}
 input[type="submit"]{l}
     float:right;
     font-size:18px;
{r}
.endscr_bottom_nvideo #nvideo_title{l}
 font-size:17px;
 margin-top:5px;
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

    .js_box {l}
       border-radius: 0;
       -webkit-border-radius: 0;
       width: 300px !important;
    {r}
    
    .bookTestDriveButton:hover {l} 
        background-color: #308c4a !important;
    {r}
    
    .bookTestDriveButton {l}
        font-family: Verdana, Geneva, sans-serif;
        background: none;
        background-color: #4FC26F !important;
        width: 100%;
        font-size: 11px !important;
        border-radius: 0.1rem !important;
        height: 24px;
        padding: 3px 6px;
        margin-bottom: 6px;
    {r}

    
</style>
<link rel="stylesheet" type="text/css" href="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.css">
<link href="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.css" rel='stylesheet'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--[if lte IE 9]>
<style type="text/css">
.vjs-custom-overlay{l}
    color:#000;
{r}
.vjs-custom-overlay .js_box_title {l}
color:#fff;
{r}
</style>
<![endif]-->

{if !empty($sJavascript)}{$sJavascript}{/if}
<script type="text/javascript">
    var contact_dealer = "{phrase var='dvs.contact_dealer'}";
    var bIsSupportVideo = !!document.createElement('video').canPlayType;
    var aMediaIds = [];
    var aOverviewMediaIds = [];
    var aTestDriveMediaIds = [];
    var aPoster = '';
    var bIsHtml5 = false;
    var ovdr = "preroll";
    var endscreen_player = 0;
    var cdContent = '';
    {if $aDvs.player_type}
        if (bIsSupportVideo) {l}
        var bIsHtml5 = true;
        {r}
    {/if}
    {if $aPlayer.video_endscreen_player == 1}
    
    endscreen_player = 1;                                                                            
    var endscreen_cform = {$aPlayer.video_endscreen_player_cform};
    var endscreen_inventory = {$aPlayer.video_endscreen_player_inventory};
    {if $aPlayer.video_endscreen_player_cform == 1}
    cdContent = '<p><a href="#" id="endscr_cform" class="endscr_btn gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));endscreenContact(\'Video End Screen\');">Contact Dealer</a></p>';
    {/if}
    {/if}
    
//    $("head").append('<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></scr'+'ipt>');
    
    //aPoster = {$aOverviewVideos[0].videoStillURL};
    
    //console.log('helo');
    

    {if $bIsDvs}
    
    {foreach from = $aOverviewVideos key = iKey item = aVideo}
        {if $iKey == 0}
            aPoster = '{$poster_img}';
            console.log(aPoster);
        {/if}
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


    
    {if $aPlayer.custom_overlay_1_type}
        if (bDebug) 
            console.log('Overlay: Overlay 1 is active. Type: {$aPlayer.custom_overlay_1_type}. Start: {$aPlayer.custom_overlay_1_start}. Duration: {$aPlayer.custom_overlay_1_duration}.');
        
        var bCustomOverlay1 = true;
        var bOverlay1Type = '{$aPlayer.custom_overlay_1_type}';
        
        {if $aPlayer.custom_overlay_1_type == 1 }
            var bCustomOverlay1Content = '<a href="#" class="gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
 
        
        //=== Custom Adding Type 4 By Won 03-01-2018 0538PM
        {elseif $aPlayer.custom_overlay_1_type == 4 }
            console.log("Test Overlay!");

            var bCustomOverlay1Content = 
                    '<div class="modal modal01" id="modal" style="width:38%; height:35%; margin:10px; margin-right: 6px; float:right; background-color:rgba(0,0,0,0.65); min-height:66px;">\n\
                        <button type="button" class="close" aria-label="Close" onclick="overlayClose();" style="float:right;"><span aria-hidden="true">&times;</span></button>\n\
                        <div style="width:21.33333333%; float:left;">\n\
                            <div style="display:flex; justify-content:center; align-items:center; min-height: 75px;">\n\
                                <img id="steeringwheelImg" style="margin-left: 15px; margin-top: 15px; margin-bottom: 15px;" src="{$sImagePath}icon-steeringwheel-button.png"/>\n\
                            </div>\n\
                        </div>\n\
                        <div style="width:78.66666667%; float:right;">\n\
                            <div style="font-family:Verdana, Geneva, sans-serif; text-align: left; margin-left: 15px; margin-top: 3px; margin-bottom: 10px; font-size:12px;">Book an Actual Test Drive</div>\n\
                            <div>\n\
                                <div style="float: left; margin-left: 15px; margin-bottom: 10px;" href="#" class="bookTDbtnConatiner" onclick="tb_show(\'Book an actual test drive\', $.ajaxBox(\'dvs.showGetContactFormForTestDrive\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                    <button class="bookTestDriveButton">Schedule your test drive &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
        //=== end of codes by Won
        
        
        {elseif $aPlayer.custom_overlay_1_type == 3}
            {if $aPlayer.custom_overlay_1_text != ''}
                var bCustomOverlay1Content = '<a href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_1_text}"></a>';
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
        var bOverlay2Type = '{$aPlayer.custom_overlay_2_type}';
        {if $aPlayer.custom_overlay_2_type == 1}
          var bCustomOverlay2Content =  '<a href="#" class="gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
        {elseif $aPlayer.custom_overlay_2_type == 3}
        {if $aPlayer.custom_overlay_2_text != ''}
         var bCustomOverlay2Content = '<a href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_2_text}"></a>';
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
        var bOverlay3Type = '{$aPlayer.custom_overlay_3_type}';
        {if $aPlayer.custom_overlay_3_type == 1}
           var bCustomOverlay3Content = '<a href="#" class="gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>'
        {elseif $aPlayer.custom_overlay_3_type == 3}
        {if $aPlayer.custom_overlay_3_text != ''}
         var bCustomOverlay3Content = '<a href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_3_text}"></a>';
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
//        var inventory_text = {if $aDvs.inventory_url} "{phrase var='dvs.show_inventory'}" {else} "" {/if};
        var inventory_text = {if $aDvs.inventory_url} "View Inventory" {else} "" {/if};
        
        
    {else}
        var bPreRoll = false;
        var iDvsId = 0;
        var bIdriveGetPrice = {if $bShowGetPrice}true{else}false{/if};
        var bPreview = false;
        var bAutoplay = {if $bAutoplay}true{else}false{/if};
            {if !$aDvs.is_active}bAutoplay = false;{/if}
        var bAutoAdvance = true;
    {/if}
    
    function overlayClose(){l}
        var m = document.getElementById('modal');
        m.style.display='none';
        m.parentNode.removeChild(m);
        {r}
        
    function contactFormClose(){l}
        var m = document.getElementByClass('js_box');
        m.style.display='none';
        m.parentNode.removeChild(m);
        {r}
    
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

<section id="dvs_bc_player"{if $bIsDvs} itemprop="video" itemscope itemtype="http://schema.org/VideoObject"{/if}>
{if $bIsDvs}
	{if !$bPreview}
	<meta itemprop="creator" content="{$aDvs.dealer_name}" />
	<meta itemprop="url" content="{$aFirstVideoMeta.url}" id="schema_video_url"/>
	<meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
	<meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
	<meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
	<meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
	<meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
	<meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
	{/if}
{/if}

<input type="hidden" id="bc_ref" value="{*aCurrentVideoMetaData.referenceId*}">
<input type="hidden" id="bc_oimgpath" value="{$sImagePath}">
<input type="hidden" id="bc_dvs" value="{$iDvsId}">
<!-- <video id="bcv2" data-account="607012070001" data-player="default" data-embed="default" class="video-js" controls preload playsinline width="100%" height="100%" ></video> -->

<video id="bcv2" data-account="607012070001" data-player="default" data-embed="default" class="video-js" controls="true"></video>
 
<section id="playlist_wrapper">
        <button class="prev playlist-button">&lt;</button>
        <div class="playlist_carousel" id="overview_playlist">
            <ul>
                {if $bIsDvs}
                {foreach from=$aOverviewVideos key=iKey item=aVideo}
                <li>
                    <a class="playlist_carousel_image_link" id="thumbnail_link_{$iKey}" onclick="thumbnailClickDvs();">
                        {img server_id=$aVideo.server_id path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                    <p>{$aVideo.year} {$aVideo.model}</p>
                    </a>
                </li>
                {/foreach}
                <li style='display: none;'></li>
                {else}
                {foreach from=$aVideos key=iKey item=aVideo}
                <li>
                    <a class="playlist_carousel_image_link" onclick="thumbnailClickIDrive();">
                        {img server_id=$aVideo.server_id path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
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
</section>

<section id="chapter_buttons">
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
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + myPlayer.mediainfo.reference_id)); return false;"></button>
        {elseif !$bIsExternal && !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;sRefId=' + myPlayer.mediainfo.reference_id));getPriceIDrive(); return false;"></button>
        {elseif $bIsExternal && $bShowGetPrice}
        <button type="button" id="chapter_container_Get_Price" class="disabled display" onclick="getPriceExternal('{$sEmail}');"></button>
        {/if}
    {/if}
</section>

<script src="//players.brightcove.net/607012070001/default_default/index.min.js"></script>
<script type="text/javascript" src="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.min.js"></script>
<script src="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.js"></script>

