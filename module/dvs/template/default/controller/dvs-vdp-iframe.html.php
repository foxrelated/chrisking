<style type="text/css">
    #dvs_bc_player {l}
        width: {if $sBrowser == 'mobile'}{$iPlayerWidth}px{else}717px{/if};
        height: {if $sBrowser == 'mobile'}{$iPlayerHeight}px{else}406px{/if};
    {r}

    body {l}
        background-color: #{$aDvs.player_background};
        padding-top: 15px;
    {r}

    #video_information {l}
        width: 100%;
        margin-top: 0px;
        width: 100%;
    {r}

    #video_information h3 {l}
        color: #{$aPlayer.player_text};
        padding:0px;
        margin: 0px;
        margin-left:10px;
        font-size:{if $sBrowser == 'mobile'}{$iHeaderTextFontSize}px{else}18px{/if};
    {r}
    
    #video_information a {l}
        font-size:inherit;
    {r}
</style>
{if $player_type == 2}
<style type="text/css">
    #bcv2 {l}
        display: block;
        {if $bIsDvs}
/*        width: 720px;*/
/*        height: 405px;*/
          width:100%;
          height:100%;
        {else}
        width: {$iPlayerWidth}px;
        height: {$iPlayerHeight}px;
        {/if}
    {r}  
.vjs-overlay-buttons {l}
display:none !important;
{r}  
.vjs-using-native-controls .vjs-poster,.vjs-using-native-controls .vjs-big-play-button  {l}
display:inline-block;
{r}
.vjs-has-started .vjs-poster,.vjs-has-started .vjs-big-play-button {l}
display:none !important;
{r}
        
.vjs-overlay {l}
background:none !important;
width:100% !important;
padding-top:0 !important;
top:0 !important;
{r}

.vjs-ended .vjs-poster{l}
    display: block !important;
    {if $aPlayer.video_endscreen_overlay == 1}
    opacity:0.3;
    {/if}
{r}
.vjs-ended .vjs-custom-overlay{l}
    background-color:transparent;  
    padding:0;
{r}
.endscr_title,.endscr_bottom_nvideo{l}
color:#fff;
font-size:20px;    
margin-bottom:10px;
{r}
.vjs-custom-overlay{l}
margin-top:85px;
{r}
.vjs-custom-overlay p{l}
margin-top:20px;
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

.endscr_bottom_nvideo{l}
     position: absolute;
    bottom: 50px;
    width: 100%;
    text-align: center;

{r}
.endscr_bottom_nvideo #nvideo_title{l}
 font-size:17px;
 margin-top:5px;
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
   /* .vjs-big-play-button {l}
    top: 125px !important;
    left: 280px !important;
    margin-left:0 !important;
    margin-top:0 !important;
    width:3em !important;
    height:1.5em !important;
    line-height:1.5em !important;
    border-radius:0.3em !important;
    color:#fff !important;*/
    .vjs-custom-overlay {l}
		position: absolute;
		color: #fff;
		font-size: 36px;
		top: 35%;
		right: 0;
		bottom: 0;
		left: 0;
		padding: 1em 2em;
		text-align: center;
		letter-spacing: 1px;
		background-color: #000;
    {r}
{r}
</style>
<link rel="stylesheet" type="text/css" href="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.css">
<link href="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.css" rel='stylesheet'>
<article>
    <section id="video_information">
        <h3 id="video_name">
            {$aDvs.phrase_overrides.override_video_name_display}
        </h3>
    </section>
    <section id="player">
        {if !empty($sJavascript)}{$sJavascript}{/if}
        <script type="text/javascript">
            var bIsSupportVideo = !!document.createElement('video').canPlayType;
            var aMediaIds = [];
            var aOverviewMediaIds = [];
            var aTestDriveMediaIds = [];
            var aPoster = '';
            var bIsHtml5 = false;
            var ovdr = "preroll";
            var endscreen_player = 0;
            {if $aDvs.player_type}
                if (bIsSupportVideo) {l}
                var bIsHtml5 = true;
                {r}
            {/if}
            {if $aPlayer.video_endscreen_overlay == 1}
                endscreen_player = 1;
            {/if}
            {if $bIsDvs}
                {foreach from = $aOverviewVideos key = iKey item = aVideo}
                    {if $iKey == 0}
                        aPoster = '{$poster_img}';
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
                 
        var contact_dealer = "{phrase var='dvs.contact_dealer'}";
            {if $aPlayer.custom_overlay_1_type}
                if (bDebug) console.log('Overlay: Overlay 1 is active. Type: {$aPlayer.custom_overlay_1_type}. Start: {$aPlayer.custom_overlay_1_start}. Duration: {$aPlayer.custom_overlay_1_duration}.');
                var bCustomOverlay1 = true;
                
                {if $aPlayer.custom_overlay_1_type == 1}
                 var bCustomOverlay1Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
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
                
                {if $aPlayer.custom_overlay_2_type == 1}
                  var bCustomOverlay2Content =  '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
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
                {if $aPlayer.custom_overlay_3_type == 1}
                   var bCustomOverlay3Content = '<a href="#" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';
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

            var bPreRoll = {if $aPlayer.preroll_file_id}true{else}false{/if};
            var bPreRollUrl = {if $aPlayer.preroll_file_id}"{$prerollUrl}" {else}""{/if};
            var preRollUrl = {if $aPlayer.preroll_file_id}"{$prerollClickUrl}" {else}""{/if};   
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
            var inventory_btn = {if $aDvs.inventory_url} "{$aDvs.inventory_url}" {else} "" {/if};
//        var inventory_text = {if $aDvs.inventory_url} "{phrase var='dvs.show_inventory'}" {else} "" {/if};
        var inventory_text = {if $aDvs.inventory_url} "View Inventory" {else} "" {/if};
            
        </script>

        {if ($bIsDvs && $aOverviewVideos) || (!$bIsDvs && $aVideos)}
        <section id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
        {if $bIsDvs}
        {if !$bPreview}
        <meta itemprop="creator" content="{$aDvs.dealer_name}" />
        <meta itemprop="productionCompany" content="Dealer Video Showroom" />
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
        

<!--       <video id="bcv2" data-account="607012070001" data-player="0d15f8a3-b382-44ca-a53b-51870dd2ad3f" data-embed="default" class="video-js" controls></video>-->
       <video id="bcv2" data-account="607012070001" data-player="default" data-embed="default" class="video-js" controls></video>
       
        </section>{else}<div class="player_error">{phrase var='dvs.no_videos_error'}</div>{/if}
        {if $sBrowser != 'mobile'}<section id="chapter_buttons">
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
        </section>
        {/if}
        <p id="video_warning_text" style="padding-top:10px;color:#{$aPlayer.player_text};font-size:{$iWarningTextFontSize}px;">Video may reflect features, options or conditions that are different from the vehicle for sale and does not depict actual vehicle for sale.</p>
    </section>
</article>
<!--<script src="//players.brightcove.net/607012070001/0d15f8a3-b382-44ca-a53b-51870dd2ad3f_default/index.min.js"></script> -->
<script src="//players.brightcove.net/607012070001/default_default/index.min.js"></script> 
<script type="text/javascript" src="https://players.brightcove.net/videojs-custom-endscreen/dist/videojs-custom-endscreen.min.js"></script>
<script src="//players.brightcove.net/videojs-overlay/lib/videojs-overlay.js"></script>


{else}
<article>
    <section id="video_information">
        <h3 id="video_name">
            {$aDvs.phrase_overrides.override_video_name_display}
        </h3>
    </section>
    <section id="player">
        {if !empty($sJavascript)}{$sJavascript}{/if}
        <script type="text/javascript">
            var bIsSupportVideo = !!document.createElement('video').canPlayType;
            var aMediaIds = [];
            var aOverviewMediaIds = [];
            var aTestDriveMediaIds = [];
            var bIsHtml5 = false;
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

        </script>

        {if ($bIsDvs && $aOverviewVideos) || (!$bIsDvs && $aVideos)}
        <section id="dvs_bc_player"{if $bIsDvs} itemscope itemtype="http://schema.org/VideoObject"{/if}>
        {if $bIsDvs}
        {if !$bPreview}
        <meta itemprop="creator" content="{$aDvs.dealer_name}" />
        <meta itemprop="productionCompany" content="Dealer Video Showroom" />
        <meta itemprop="contributor" content="{$aDvs.dealer_name}" />
        <meta itemprop="url" content="{$aFirstVideoMeta.url}" id="schema_video_url"/>
        <meta itemprop="thumbnailUrl" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_thumbnail_url"/>
        <meta itemprop="image" content="{$aFirstVideoMeta.thumbnail_url}"  id="schema_video_image"/>
        <meta itemprop="uploadDate" content="{$aFirstVideoMeta.upload_date}"  id="schema_video_upload_date"/>
        <meta itemprop="duration" content="{$aFirstVideoMeta.duration}"  id="schema_video_duration"/>
        <meta itemprop="name" content="{$aDvs.phrase_overrides.override_meta_itemprop_name_meta}"  id="schema_video_name"/>
        <meta itemprop="description" content="{$aDvs.phrase_overrides.override_meta_itemprop_description_meta}"  id="schema_video_description"/>
        {/if}
			{if $sBrowser != 'mobile'}
			{if $aPlayer.custom_overlay_1_type}
			
				{if $aPlayer.custom_overlay_1_type == 1}
                <div id="dvs_overlay_1" class="dvs_overlay">
				<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>
                </div>
                {elseif $aPlayer.custom_overlay_1_type == 3}
                {if $aPlayer.custom_overlay_1_text != ''}
                 <div id="dvs_overlay_1" class="dvs_overlay" style="left:0;width:84% !important;">
                 <a href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/preroll/{$aPlayer.custom_overlay_1_text}"></a>
                 </div>
                {/if}
				{else}
                <div id="dvs_overlay_1" class="dvs_overlay">
				<a href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_1_text}</a>
                </div>
				{/if}
			
			{/if}
			{if $aPlayer.custom_overlay_2_type}
			
				{if $aPlayer.custom_overlay_2_type == 1}
                <div id="dvs_overlay_2" class="dvs_overlay">
				<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>
                </div>
                {elseif $aPlayer.custom_overlay_2_type == 3}
                {if $aPlayer.custom_overlay_2_text != ''}
                
                 <div id="dvs_overlay_2" class="dvs_overlay" style="left:0;width:84% !important;">
                 <a href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/preroll/{$aPlayer.custom_overlay_2_text}"></a>
                 </div>
                {/if}
				{else}
				<div id="dvs_overlay_2" class="dvs_overlay">
                <a href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_2_text}</a>
                </div>
				{/if}
			
			{/if}
			{if $aPlayer.custom_overlay_3_type}
			
				{if $aPlayer.custom_overlay_3_type == 1}
                <div id="dvs_overlay_3" class="dvs_overlay" >
				<a href="#" onclick="tb_show('{phrase var='dvs.contact_dealer'}', $.ajaxBox('dvs.showGetPriceForm', 'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png"/></a>
                </div>
                {elseif $aPlayer.custom_overlay_3_type == 3}
                {if $aPlayer.custom_overlay_3_text != ''}
                 <div id="dvs_overlay_3" class="dvs_overlay" style="left:0;width:84% !important;">
                 <a href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/preroll/{$aPlayer.custom_overlay_3_text}"></a>
                 </div>
                {/if}
				{else}
                <div id="dvs_overlay_3" class="dvs_overlay" >
				<a href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_3_text}</a>
                </div>
				{/if}
			
			{/if}
			{/if}
        {/if}
        <object id="myExperience" class="BrightcoveExperience">
            <param name="bgcolor" value="#FFFFFF" />
            <param name="wmode" value="transparent" />
            <param name="width" value="{if $sBrowser == 'mobile'}{$iPlayerWidth}{else}720{/if}" />
            <param name="height" value="{if $sBrowser == 'mobile'}{$iPlayerHeight}{else}405{/if}" />
            <param name="playerID" value="1418431455001" />
            <param name="playerKey" value="AQ~~,AAAAjVS9InE~,8mX2MExmDXXSn4MgkQm1tvvNX5cQ4cW" />
            <param name="isVid" value="true" />
            <param name="isUI" value="true" />
            <param name="dynamicStreaming" value="true" />
            <param name="accountID" value="{$aDvs.dvs_google_id}" />
            <param name="showNoContentMessage" value="false" />
            {if (isset($bSecureConnection) && ($bSecureConnection))}
            <param name="secureConnections" value="true" />
            <param name="secureHTMLConnections" value="true" />
            {/if}
            {if $sBrowser == 'mobile' || $sBrowser == 'ipad' || $aDvs.player_type}
            <param name="@videoPlayer" value="" />
            <param id="forceHTML" name="forceHTML" value="true" />
            <param name="includeAPI" value="true" />
            <param name="templateLoadHandler﻿" value="onTemplateLoad" />
            <param name="templateLoadHandler" value="onTemplateLoaded" />
            <param name="templateReadyHandler" value="onTemplateReady" />
            {/if}
            <param name="linkBaseURL" value="{$sLinkBase}" id="bc_player_param_linkbase" />
        </object>

        {literal}
        <script type="text/javascript">
            if(!bIsSupportVideo){
                (elem=document.getElementById("forceHTML")).parentNode.removeChild(elem);
            }
            $Behavior.brightCoveCreateExp = function()
            {
                brightcove.createExperiences();
            }
        </script>
        {/literal}
        </section>{else}<div class="player_error">{phrase var='dvs.no_videos_error'}</div>{/if}
        {if $sBrowser != 'mobile'}<section id="chapter_buttons">
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
        {/if}
        <p id="video_warning_text" style="padding-top:10px;color:#{$aPlayer.player_text};font-size:{$iWarningTextFontSize}px;">Video may reflect features, options or conditions that are different from the vehicle for sale and does not depict actual vehicle for sale.</p>
    </section>
</article>
{/if}
<iframe src="{$sVdpIframeUrl}" height="1" width="1"></iframe>
{if !$aDvs.is_active}
{template file='dvs.block.deactive'}
{/if}