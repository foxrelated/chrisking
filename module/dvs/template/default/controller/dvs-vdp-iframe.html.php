{literal}
<style type="text/css">
    #dvs_bc_player {
        width: 720px;
        height: 306px;
    }

    body {
        background-color: {/literal}#{$aDvs.player_background}{literal};
        padding-top: 15px;
    }

    #video_information {
        width: 100%;
        margin-top: 0px;
        width: 100%;
    }

    #video_information h3 {
        color: {/literal}#{$aPlayer.player_text}{literal};
        padding:0px;
        margin: 0px;
        margin-left:10px;
        font-size:18px;
    }
</style>
{/literal}
<article>
    <section id="video_information">
        <h3 id="video_name">
            {$aDvs.phrase_overrides.override_video_name_display}
        </h3>
    </section>
    <section id="player">
        {if !empty($sJavascript)}{$sJavascript}{/if}
        <script type="text/javascript">
            var aMediaIds = [];
            var aOverviewMediaIds = [];
            var aTestDriveMediaIds = [];

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
                {foreach from = $aVideos key = iKey item = aVideo}
                    aMediaIds[{$iKey}] = {$aVideo.id};
                {/foreach}
                {if isset($aFeaturedVideo.id)}
                    aMediaIds[0] = {$aFeaturedVideo.id};
                {/if}
            {/if}

            var bPreRoll = {if $aPlayer.preroll_file_id}true{else}false{/if};
            var iDvsId = {if $bIsDvs}{$iDvsId}{else}0{/if};
            var bIdriveGetPrice = {if !$bIsDvs && isset($aPlayer.email) && $aPlayer.email}true{else}false{/if};
            var bPreview = {if $bPreview}true{else}false{/if};
            {if $aDvs.is_active}
            var bAutoplay = {if (isset($aPlayer.autoplay) && $aPlayer.autoplay) || (isset($aPlayer.autoplay_baseurl) && $aPlayer.autoplay_baseurl && !$aBaseUrl) || (isset($aPlayer.autoplay_videourl) && $aPlayer.autoplay_videourl && $aBaseUrl)}true{else}false{/if};
            {else}
            var bAutoplay =false;
            {/if}
            var iCurrentVideo = {$aCurrentVideo};
            var bAutoAdvance = false;

            function setPlayerStyle(){l}
                if (bDebug) {l}
                    console.log("Player: Setting player style and volume.");
                    modVid.setVolume(0);
                {r}

                {if !$bIsExternal}
                    modVid.setStyles('video-background:#000000;titleText-active:#{$aPlayer.player_text};titleText-disabled:#{$aPlayer.player_text};titleText-rollover:#{$aPlayer.player_text};titleText-selected:#{$aPlayer.player_text};bodyText-active:#{$aPlayer.player_text};bodyText-disabled:#{$aPlayer.player_text};bodyText-rollover:#{$aPlayer.player_text};bodyText-selected:#{$aPlayer.player_text};buttons-icons:#{$aPlayer.player_button_icons};buttons-rolloverIcons:#{$aPlayer.player_button_icons};buttons-selectedIcons:#{$aPlayer.player_button_icons};buttons-glow:#{$aPlayer.player_button_icons};buttons-iconGlow:#{$aPlayer.player_button_icons};buttons-face:#{$aPlayer.player_buttons};buttons-rollover:#{$aPlayer.player_buttons};buttons-selected:#{$aPlayer.player_buttons};playheadWell-background:#{$aPlayer.player_progress_bar};playheadWell-watched:#{$aPlayer.player_progress_bar};playhead-face:#{$aPlayer.player_button_icons};volumeControl-icons:#{$aPlayer.player_button_icons};volumeControl-track:#{$aPlayer.player_progress_bar};volumeControl-face:#{$aPlayer.player_buttons};linkText-active:#{$aPlayer.player_text};linkText-disabled:#{$aPlayer.player_text};linkText-rollover:#{$aPlayer.player_text};linkText-downState:#{$aPlayer.player_text};');
                {/if}
            {r}

            function enableVideoSelectCarousel(){l}
                if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
                $('#overview_playlist').show();
                $("#overview_playlist").jCarouselLite({l}
                    btnNext: ".next",
                    btnPrev: ".prev",
                    circular: false,
                    visible: 5,
                    scroll: 3,
                    speed: 900
                {r});
            {r}

            $Behavior.jCarousel = function() {l}
                {if $bIsDvs}
                    $("#overview_playlist").jCarouselLite({l}
                        btnNext: ".next",
                        btnPrev: ".prev",
                        circular: false,
                        visible: 5,
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
            {r}
        </script>

        {if ($bIsDvs && $aOverviewVideos) || (!$bIsDvs && $aVideos)}
        <section id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
        {if $bIsDvs}
        {if !$bPreview}
        <meta itemprop="creator" content="{$aDvs.phrase_overrides.override_meta_itemprop_creator_meta}" />
        <meta itemprop="productionCompany" content="{$aDvs.dealer_name}" />
        <meta itemprop="contributor" content="{$aDvs.dealer_name}" />
        <meta itemprop="url" content="{$aFirstVideoMeta.url}" id="schema_video_url"/>
        <meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
        <meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
        <meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
        <meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
        <meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
        <meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
        {/if}


        {if $aPlayer.custom_overlay_1_type}
        <div id="dvs_overlay_1" class="dvs_overlay">
            {if $aPlayer.custom_overlay_1_type == 1}
            <a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>
            {else}
            <a href="{$aPlayer.custom_overlay_1_url}" target="_blank">{$aPlayer.custom_overlay_1_text}</a>
            {/if}
        </div>
        {/if}
        {if $aPlayer.custom_overlay_2_type}
        <div id="dvs_overlay_2" class="dvs_overlay">
            {if $aPlayer.custom_overlay_2_type == 1}
            <a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>
            {else}
            <a href="{$aPlayer.custom_overlay_2_url}" target="_blank">{$aPlayer.custom_overlay_2_text}</a>
            {/if}
        </div>
        {/if}
        {if $aPlayer.custom_overlay_3_type}
        <div id="dvs_overlay_3" class="dvs_overlay" >
            {if $aPlayer.custom_overlay_3_type == 1}
            <a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));"><img src="{$sImagePath}overlay.png"/></a>
            {else}
            <a href="{$aPlayer.custom_overlay_3_url}" target="_blank">{$aPlayer.custom_overlay_3_text}</a>
            {/if}
        </div>
        {/if}


        {/if}
        <object id="myExperience" class="BrightcoveExperience">
            <param name="bgcolor" value="#FFFFFF" />
            <param name="wmode" value="transparent" />
            <param name="width" value="720" />
            <param name="height" value="405" />
            <param name="playerID" value="1418431455001" />
            <param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
            <param name="isVid" value="true" />
            <param name="isUI" value="true" />
            <param name="dynamicStreaming" value="true" />
            <param name="accountID" value="{$aDvs.dvs_google_id}" />
            <param name="showNoContentMessage" value="false" />
            {if $sBrowser == 'ipad'}
            <param name="includeAPI" value="true" />
            <param name="templateLoadHandler﻿" value="onTemplateLoad" />
            <param name="templateLoadHandler" value="onTemplateLoaded" />
            <param name="templateReadyHandler" value="onTemplateReady" />
            {/if}
            <param name="linkBaseURL" value="{$sLinkBase}" id="bc_player_param_linkbase" />
        </object>

        {literal}
        <script type="text/javascript">
            $Behavior.brightCoveCreateExp = function()
            {
                brightcove.createExperiences();
            }
        </script>
        {/literal}
        </section>{else}<div class="player_error">{phrase var='dvs.no_videos_error'}</div>{/if}<section id="chapter_buttons">
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
        </section>
		{*
        {if $bIsDvs || (!$bIsExternal && !$aPlayer.player_type) || ($bIsExternal && $bShowPlaylist)}
        <section id="playlist_wrapper">
            <button class="prev playlist-button">&lt;</button>
            <div class="playlist_carousel" id="overview_playlist">
                <ul>
                    {if $bIsDvs}
                    {foreach from=$aOverviewVideos key=iKey item=aVideo}
                    <li>
                        <a class="playlist_carousel_image_link" {if $aDvs.gallery_target_setting==1}target="_blank" {/if} onclick="thumbnailClick({$iKey});thumbnailClickDvs();">
                        {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image max_width=145 max_height=82}
                        <p>{$aVideo.year} {$aVideo.model}</p>
                        </a>

                    </li>
                    {/foreach}
                    <li style='display: none;'></li>
                    {else}
                    {foreach from=$aVideos key=iKey item=aVideo}
                    <li>
                        <a class="playlist_carousel_image_link" onclick="thumbnailClick({$iKey});thumbnailClickIDrive();">
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
            {/if}
        </section>
        *}
        <p style="color:#{$aPlayer.player_text};font-size:10px;" align="center">Video may reflect features, options or conditions that are different from the vehicle for sale and does not depict actual vehicle for sale.</p>
    </section>
</article>

<iframe src="{$sVdpIframeUrl}" height="1" width="1"></iframe>
{if !$aDvs.is_active}
{template file='dvs.block.deactive'}
{*
<script type="text/javascript">
$Behavior.googleDvsDeactive = function() {l}
    {if $sBrowser == 'mobile'}
    sendToGoogle('DVS Mobile', 'DVS Deactivated', 'Deactivation Message Shown');
    {else}
    sendToGoogle('DVS Site', 'DVS Deactivated', 'Deactivation Message Shown');
    {/if}
{r}
</script>
*}
{/if}