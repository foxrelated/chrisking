<style type="text/css">
    #player {l}
        padding:{if $sBrowser == 'ipad'} 6px 0px !important{else}3px 10px 5px 10px !important{/if};
    {r}
    #dvs_bc_player {l}
        width: {if $sBrowser == 'mobile'}{$iPlayerWidth}px{else}720px{/if};
        height: {if $sBrowser == 'mobile'}{$iPlayerHeight}px{else}405px{/if};
    {r}

    body {l}
        background-color: #{$aDvs.player_background};
        padding-top: {if $sBrowser == 'mobile'}0px{else}5px{/if};
    {r}
    
    #site_content {l} 
        margin: {if $sBrowser == 'mobile'}0px !important{/if};
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
    max-height: 68%;
{r}
.vjs-ended video{l}
 visibility:hidden;
{r}
.endscr_title,.endscr_bottom_nvideo{l}
color:#fff !important;
font-size:20px;    
margin-bottom:10px;
{r}
.vjs-custom-overlay{l}
margin-top:85px;
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
width: 40%;
float: right;
text-align:left;
{r}
.cdfields input, #contact_dealer .cdfields textarea{l}
     width:100%;
     color:#333;
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

    .js_box {l}
       border-radius: 0;
       -webkit-border-radius: 0;
       width: 300px;
    {r}
    
    .bookTestDriveButton:hover, .getBestDealButton:hover, .meetSalesAdvisorButton:hover {l} 
        background-color: #308c4a !important;
    {r}
    
    .bookTestDriveButton, .getBestDealButton, .meetSalesAdvisorButton {l}
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
    
    .getBestDealButton, .meetSalesAdvisorButton {l}
        text-align: left;
        padding-left: 10px;
    {r}

    .meetSalesAdvisorButton {l} 
        font-size: 14px !important;
        font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        height: 26px;        
    {r}
    
    .modal {l}
        width:38%; 
        height:35%; 
        margin:10px; 
        margin-right: 6px; 
        float:right; 
        background-color:rgba(0,0,0,0.65); 
        min-height:66px;
        max-width: 270px;
        min-width: 250px; 
    {r}
    
    .getPreApprovedModal {l} 
        min-width: 225px;
        width: 32%;
    {r}
    
    .bookTestDriveModal {l} 
        max-width: 275px;
        width: 40%;
    {r}

    
    .meetSalesmodal {l} 
        max-width: 350px;
        min-width: 350px; 
        min-height: 150px;
    {r}
        
    .closeButton {l} 
        float:right; 
        position: relative;
        top: 3px;
        right: 2px;        
    {r}
    
    span#closeIcon {l} color: gray !important; {r}
    
    span#closeIcon:hover {l} color: white !important; {r}
    
    .leftColModalForImgContainer {l} width:21.33333333%; float:left; {r}
    
    .rightColModalContainer {l} width:78.66666667%; float:right; {r}
    
    .salesLeftContainer {l} width: 30%; {r}
    
    .salesRightContainer {l} width: 70%; {r}
    
    .leftColModalForImgContent {l} 
        display:flex; 
        justify-content:center; 
        align-items:center; 
        min-height: 75px;
    {r}
    
    #steeringwheelImg, #iconPurchaseImg, .avatar {l}
        margin-left: 15px; 
        margin-top: 22px; 
        margin-bottom: 15px;
    {r}
    
    #iconPurchaseImg, .avatar {l} width: 80%; {r}
    
    .rightColModalForTxtContainer {l}
        font-family:Verdana, Geneva, sans-serif; 
        text-align: left; 
        margin-left: 15px; 
        margin-top: 3px; 
        margin-bottom: 10px; 
        font-size:12px;
    {r}
    
    .rightColGetPreApproved {l} 
        font-size:14px;
        font-weight: bold;
    {r}
    
    .rightColBookTestDrive {l} 
        font-weight: bold;
    {r}
    
    .bookTDbtnConatiner, .getBestDealNowBtnConatiner, .meetSalesBtnConatiner {l}
        float: left; 
        margin-left: 15px; 
        margin-bottom: 10px;
    {r}
    
    .getBestDealNowBtnConatiner {l} 
        width: 100px;
    {r}
        
    .meetSalesBtnConatiner {l} 
        padding-top: 5px;
        width: 206px;
        
    {r}
    
    .meetSalesText {l} 
        line-height: 20px;
        font-weight: bold;
        font-size: 15px;
        margin-left: 12px;
        font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    {r}
    
    .avatar {l} 
        min-width: 90px;
        max-width: 90px;
        width: 90px;
        min-height: 120px;
        max-height: 120px;
        height: 120px;
        position: relative;
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
        border-radius: 3%;
        border: 2px solid #ffffff;
        overflow: hidden;
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
<article>
    <section id="player">
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
                
            {if $aPlayer.video_endscreen_overlay == 1}
                endscreen_player = 1;
                var endscreen_cform = {$aPlayer.video_endscreen_overlay_cform};
                var endscreen_inventory = {$aPlayer.video_endscreen_overlay_inventory};
                {if $aPlayer.video_endscreen_overlay_cform == 1}
                    var cdContent = '<p><a href="#" id="endscr_cform" class="endscr_btn gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));endscreenContact(\'Video End Screen\');">Contact Dealer</a></p>';
                {/if}
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
                {if $sBrowser == 'desktop'}
                    {if $aPlayer.custom_overlay_1_type}
                        if (bDebug) console.log('Overlay: Overlay 1 is active. Type: {$aPlayer.custom_overlay_1_type}. Start: {$aPlayer.custom_overlay_1_start}. Duration: {$aPlayer.custom_overlay_1_duration}.');
                        var bCustomOverlay1 = true;
                        var bOverlay1Type = '{$aPlayer.custom_overlay_1_type}';

                        {if $aPlayer.custom_overlay_1_type == 1}
                         var bCustomOverlay1Content = '<a href="#" class="gp_ov" onclick="tb_show(\''+contact_dealer+'\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();"><img src="{$sImagePath}overlay.png" alt="Contact Dealer" /></a>';

                        //=== Schedule Test Drive Overlay
                        {elseif $aPlayer.custom_overlay_1_type == 4 }
                            if (bDebug) console.log("Book an actual test drive!");

                            var bCustomOverlay1Content = 
                                    '<div class="modal bookTestDriveModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="steeringwheelImg" src="{$sImagePath}icon-steeringwheel-button.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColBookTestDrive">Book an Actual Test Drive</div>\n\
                                            <div>\n\
                                                <div href="#" class="bookTDbtnConatiner" onclick="tb_show(\'Book an actual test drive\', $.ajaxBox(\'dvs.showGetContactFormForTestDrive\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="bookTestDriveButton">Schedule your test drive &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        //=== End of Schedule Test Drive Overlay

                        //=== Get Pre-Approved Overlay
                        {elseif $aPlayer.custom_overlay_1_type == 5 }
                            if (bDebug) console.log("Get Pre-Approved!!");
                            $textForBestDeal = "Get Pre-Approved";

                            var bCustomOverlay1Content = 
                                    '<div class="modal getPreApprovedModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="iconPurchaseImg" src="{$sImagePath}icon-purchase.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColGetPreApproved">Get Pre-Approved</div>\n\
                                            <div>\n\
                                                <div href="#" class="getBestDealNowBtnConatiner" onclick="tb_show($textForBestDeal, $.ajaxBox(\'dvs.showGetContactFormForGetPreApproved\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="getBestDealButton">Start Here &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        //=== End of Get Pre-Approved Overlay   

                        //=== Get Meet Sales Advisor
                       {elseif $aPlayer.custom_overlay_1_type == 6 }
                           if (bDebug) console.log("Meet our top sales advisor!");
                           $textForMeetSales = "Meet our top sales advisor";

                           {if $aPlayer.custom_overlay_1_text != ''}

                               var bCustomOverlay1Content = 
                                   '<div class="modal meetSalesmodal" id="modal">\n\
                                       <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                       <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                           <div class="leftColModalForImgContent">\n\
                                               <label class="avatar" style="background:url({$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_1_text}) no-repeat center center">\n\
                                           </div>\n\
                                       </div>\n\
                                       <div class="rightColModalContainer salesRightContainer">\n\
                                           <div class="rightColModalForTxtContainer meetSalesText">Hi, I\'m {$aPlayer.custom_overlay_1_salesname}, Sales Professional at {$aPlayer.custom_overlay_1_dealername}.<br/> I would love to help find <br/>the perfect car for you!</div>\n\
                                           <div>\n\
                                               <div href="#" class="meetSalesBtnConatiner" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                   <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                               </div>\n\
                                           </div>\n\
                                       </div>\n\
                                   </div>';
                           {else}
                               if (bDebug) console.log("No image is loaded for the profile picture.");
                               var bCustomOverlay1Content = 
                                   '<div class="modal meetSalesmodal" id="modal">\n\
                                       <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                       <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                           <div class="leftColModalForImgContent">\n\
                                               <label class="avatar" id="iconPurchaseImg" style="background:url({$sImagePath}salesperson_150x200.png) no-repeat center center">\n\
                                           </div>\n\
                                       </div>\n\
                                       <div class="rightColModalContainer salesRightContainer">\n\
                                           <div class="rightColModalForTxtContainer meetSalesText">Meet our top sales advisor <br/> who will help find the<br/>perfect car for you!</div>\n\
                                           <div>\n\
                                               <div href="#" class="meetSalesBtnConatiner" style="margin-top:5px; height: 30px;" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                   <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                               </div>\n\
                                           </div>\n\
                                       </div>\n\
                                   </div>';
                           {/if}
                       //=== End of Get Meet Sales Advisor  
                
                        // Image Overlay
                        {elseif $aPlayer.custom_overlay_1_type == 3}
                            {if $aPlayer.custom_overlay_1_text != ''}
                                var bCustomOverlay1Content = '<a class="imageOverlay" href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_1_text}"></a>';
                            {else}
                               var bCustomOverlay1Content = '';
                               bCustomOverlay1 = false;
                            {/if}
                        {else}
                            var bCustomOverlay1Content = '<a class="linkOverlay" href="{$aPlayer.custom_overlay_1_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_1_text}</a>';
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

                        //=== Schedule Test Drive Overlay
                        {elseif $aPlayer.custom_overlay_2_type == 4 }
                            if (bDebug) console.log("Book an actual test drive!");

                            var bCustomOverlay2Content = 
                                    '<div class="modal bookTestDriveModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="steeringwheelImg" src="{$sImagePath}icon-steeringwheel-button.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColBookTestDrive">Book an Actual Test Drive</div>\n\
                                            <div>\n\
                                                <div href="#" class="bookTDbtnConatiner" onclick="tb_show(\'Book an actual test drive\', $.ajaxBox(\'dvs.showGetContactFormForTestDrive\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="bookTestDriveButton">Schedule your test drive &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>';
                        //=== End of Schedule Test Drive Overlay

                        //=== Get Pre-Approved Overlay
                        {elseif $aPlayer.custom_overlay_2_type == 5 }
                            if (bDebug) console.log("Get Pre-Approved!!");
                            $textForBestDeal = "Get Pre-Approved";

                            var bCustomOverlay2Content = 
                                    '<div class="modal getPreApprovedModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="iconPurchaseImg" src="{$sImagePath}icon-purchase.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColGetPreApproved">Get Pre-Approved</div>\n\
                                            <div>\n\
                                                <div href="#" class="getBestDealNowBtnConatiner" onclick="tb_show($textForBestDeal, $.ajaxBox(\'dvs.showGetContactFormForGetPreApproved\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="getBestDealButton">Start Here &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        //=== End of Get Pre-Approved Overlay          

                         //=== Get Meet Sales Advisor
                        {elseif $aPlayer.custom_overlay_2_type == 6 }
                            if (bDebug) console.log("Meet our top sales advisor!");
                            $textForMeetSales = "Meet our top sales advisor";

                            {if $aPlayer.custom_overlay_2_text != ''}

                                var bCustomOverlay2Content = 
                                    '<div class="modal meetSalesmodal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <label class="avatar" style="background:url({$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_2_text}) no-repeat center center">\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer salesRightContainer">\n\
                                            <div class="rightColModalForTxtContainer meetSalesText">Hi, I\'m {$aPlayer.custom_overlay_2_salesname}, Sales Professional at {$aPlayer.custom_overlay_2_dealername}.<br/> I would love to help find <br/>the perfect car for you!</div>\n\
                                            <div>\n\
                                                <div href="#" class="meetSalesBtnConatiner" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                            {else}
                                if (bDebug) console.log("No image is loaded for the profile picture.");
                                var bCustomOverlay2Content = 
                                    '<div class="modal meetSalesmodal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <label class="avatar" id="iconPurchaseImg" style="background:url({$sImagePath}salesperson_150x200.png) no-repeat center center">\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer salesRightContainer">\n\
                                            <div class="rightColModalForTxtContainer meetSalesText">Meet our top sales advisor <br/> who will help find the<br/>perfect car for you!</div>\n\
                                            <div>\n\
                                                <div href="#" class="meetSalesBtnConatiner" style="margin-top:5px; height: 30px;" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                            {/if}
                        //=== End of Get Meet Sales Advisor  
                
                        {elseif $aPlayer.custom_overlay_2_type == 3}
                            {if $aPlayer.custom_overlay_2_text != ''}
                             var bCustomOverlay2Content = '<a class="imageOverlay" href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_2_text}"></a>';
                             {else}
                             var bCustomOverlay2Content = '';
                             bCustomOverlay2 = false;
                             {/if}

                        {else}
                            var bCustomOverlay2Content = '<a class="linkOverlay" href="{$aPlayer.custom_overlay_2_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_2_text}</a>';
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

                        //=== Schedule Test Drive Overlay
                        {elseif $aPlayer.custom_overlay_3_type == 4 }
                            if (bDebug) console.log("Book an actual test drive!");

                            var bCustomOverlay3Content = 
                                    '<div class="modal bookTestDriveModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="steeringwheelImg" src="{$sImagePath}icon-steeringwheel-button.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColBookTestDrive">Book an Actual Test Drive</div>\n\
                                            <div>\n\
                                                <div href="#" class="bookTDbtnConatiner" onclick="tb_show(\'Book an actual test drive\', $.ajaxBox(\'dvs.showGetContactFormForTestDrive\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="bookTestDriveButton">Schedule your test drive &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        //=== End of Schedule Test Drive Overlay

                        //=== Get Pre-Approved Overlay
                        {elseif $aPlayer.custom_overlay_3_type == 5 }
                            if (bDebug) console.log("Get Pre-Approved!!");
                            $textForBestDeal = "Get Pre-Approved";

                            var bCustomOverlay3Content = 
                                    '<div class="modal getPreApprovedModal" id="modal">\n\
                                        <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                        <div class="leftColModalForImgContainer">\n\
                                            <div class="leftColModalForImgContent">\n\
                                                <img id="iconPurchaseImg" src="{$sImagePath}icon-purchase.png"/>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class="rightColModalContainer">\n\
                                            <div class="rightColModalForTxtContainer rightColGetPreApproved">Get Pre-Approved</div>\n\
                                            <div>\n\
                                                <div href="#" class="getBestDealNowBtnConatiner" onclick="tb_show($textForBestDeal, $.ajaxBox(\'dvs.showGetContactFormForGetPreApproved\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                    <button class="getBestDealButton">Start Here &nbsp;<i class="fa fa-angle-down"></i></button>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        //=== End of Get Pre-Approved Overlay   

                        //=== Get Meet Sales Advisor
                       {elseif $aPlayer.custom_overlay_3_type == 6 }
                           if (bDebug) console.log("Meet our top sales advisor!");
                           $textForMeetSales = "Meet our top sales advisor";

                           {if $aPlayer.custom_overlay_3_text != ''}

                               var bCustomOverlay3Content = 
                                   '<div class="modal meetSalesmodal" id="modal">\n\
                                       <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                       <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                           <div class="leftColModalForImgContent">\n\
                                               <label class="avatar" style="background:url({$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_3_text}) no-repeat center center">\n\
                                           </div>\n\
                                       </div>\n\
                                       <div class="rightColModalContainer salesRightContainer">\n\
                                           <div class="rightColModalForTxtContainer meetSalesText">Hi, I\'m {$aPlayer.custom_overlay_3_salesname}, Sales Professional at {$aPlayer.custom_overlay_3_dealername}.<br/> I would love to help find <br/>the perfect car for you!</div>\n\
                                           <div>\n\
                                               <div href="#" class="meetSalesBtnConatiner" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                   <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                               </div>\n\
                                           </div>\n\
                                       </div>\n\
                                   </div>';
                           {else}
                               if (bDebug) console.log("No image is loaded for the profile picture.");
                               var bCustomOverlay3Content = 
                                   '<div class="modal meetSalesmodal" id="modal">\n\
                                       <button type="button" class="close closeButton" aria-label="Close" onclick="overlayClose();"><span aria-hidden="true" id="closeIcon">&times;</span></button>\n\
                                       <div class="leftColModalForImgContainer salesLeftContainer">\n\
                                           <div class="leftColModalForImgContent">\n\
                                               <label class="avatar" id="iconPurchaseImg" style="background:url({$sImagePath}salesperson_150x200.png) no-repeat center center">\n\
                                           </div>\n\
                                       </div>\n\
                                       <div class="rightColModalContainer salesRightContainer">\n\
                                           <div class="rightColModalForTxtContainer meetSalesText">Meet our top sales advisor <br/> who will help find the<br/>perfect car for you!</div>\n\
                                           <div>\n\
                                               <div href="#" class="meetSalesBtnConatiner" style="margin-top:5px; height: 30px;" onclick="tb_show($textForMeetSales, $.ajaxBox(\'dvs.showGetContactFormForMeetSalesAdvisor\', \'height=400&amp;width=360&amp;iDvsId={$iDvsId}&amp;sRefId= '+aCurrentVideoMetaData.referenceId+'\'));getPriceOverlayClick();">\n\
                                                   <button class="meetSalesAdvisorButton">Let\'s Connect &nbsp;<i class="fa fa-angle-down" style="float: right;"></i></button>\n\
                                               </div>\n\
                                           </div>\n\
                                       </div>\n\
                                   </div>';
                           {/if}
                       //=== End of Get Meet Sales Advisor  
                
                        {elseif $aPlayer.custom_overlay_3_type == 3}
                            {if $aPlayer.custom_overlay_3_text != ''}
                             var bCustomOverlay3Content = '<a class="imageOverlay" href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="customImageOverlayClick();"><img src="{$ref}{$core_url}/file/dvs/'+ovdr+'/{$aPlayer.custom_overlay_3_text}"></a>';
                            {else}
                            var bCustomOverlay3Content = ''; 
                        bCustomOverlay3 = false;
                            {/if}
                        {else}
                        var bCustomOverlay3Content = '<a class="linkOverlay" href="{$aPlayer.custom_overlay_3_url}" target="_blank" onclick="textOverlayClick();">{$aPlayer.custom_overlay_3_text}</a>';
                        {/if}
                        var iCustomOverlay3Start = {$aPlayer.custom_overlay_3_start};
                        var iCustomOverlay3Duration = {$aPlayer.custom_overlay_3_duration};
                    {else}
                        var bCustomOverlay3 = false;
                        if (bDebug) console.log('Overlay: Overlay 3 is inactive.');
                    {/if}
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
        
	<input type="hidden" id="bc_ref" value="{*aCurrentVideoMetaData.referenceId*}">
        <input type="hidden" id="bc_oimgpath" value="{$sImagePath}">
        <input type="hidden" id="bc_dvs" value="{$iDvsId}">
       	<video id="bcv2" data-account="607012070001" data-player="BkZuQtXDz" data-embed="default" data-application-id class="video-js"   controls ></video>
       
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
        <p id="video_warning_text" style="padding-top:1px;color:#{$aPlayer.player_text};font-size:{$iWarningTextFontSize}px;">Video may reflect features, options or conditions that are different from the vehicle for sale and does not depict actual vehicle for sale.</p>
    </section>
    <section id="share_links" style="margin-left:10px;margin-top:10px;">
            <input type="hidden" value="{$sNewParentUrl}" id="parent_url">
            <input type="hidden" value="{$sVideoUrl}" id="video_url">
            <input type="hidden" value="{$sVideoHashCode}" id="video_hash_code">
            <input type="hidden" value="{phrase var='dvs.twitter_default_share_text' video_year=$aDvs.featured_year video_make=$aDvs.featured_make video_model=$aDvs.featured_model dvs_dealer_name=$aDvs.dealer_name}" id="share_title">
            <input type="hidden" value="{$sVideoThumb}" id="video_thumbnail">
            <table cellpadding="4" cellspacing="4" border="0">
                <tr>
                    <td style="vertical-align:middle;">
                        <!--Share This:-->
                        <p style="font-size:14px;color:#{$aPlayer.player_text};"><b></b>&nbsp;</p>
                    </td>
                    <!--
                    <td style="vertical-align:middle;">
                        <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailFormIframe', 'height=400&amp;width=360&amp;sParentUrl=' + encodeURIComponent($('#parent_url').val().replace('WTVDVS_VIDEO_TEMP', $('#video_url').val())) + '&amp;longurl=1&amp;iDvsId={$iDvsId}&amp;sRefId=' + aCurrentVideoMetaData.referenceId));  showEmailShare(); return false;">
                            <img src="{$sImagePath}email-share.png" alt="Share Via Email"/>
                        </a>
                    </td>
                    -->
                   {*
                    {if Phpfox::isModule('redirect')}
                   <td style="vertical-align:middle;">
                        <a href="#" onclick="window.open('https://www.facebook.com/share.php?u=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}0'), 'Facebook Share', 'width=626,height=436'); facebookShareClick('Share Links'); return false;">
                            <img src="{$sImagePath}facebook-share.png" alt="Share to Facebook"/>
                        </a>
                    </td>
                    {/if}
                    <td style="vertical-align:middle;padding-left:2px;padding-right:2px;">
                        <span id="twitter_button_wrapper">
                        <a href="https://twitter.com/intent/tweet?text={phrase var='dvs.twitter_default_share_text' video_year=$aFirstVideo.year video_make=$aFirstVideo.make video_model=$aFirstVideo.model dvs_dealer_name=$aDvs.dealer_name}&url={$sShareCode}1" id="twitter_share" target="_blank"><img src="{$sImagePath}twitter-button.png" alt="Tweet" /></a>
                        </span>
                    </td>
                    {if Phpfox::isModule('redirect')}
                    <td style="vertical-align:middle;">
                        <a href="#" onclick="window.open('https://plus.google.com/share?url=' + encodeURI('{url link='share'}' + $('#video_hash_code').val() + '{$sDvsHashCode}2')); googleShareClick('Share Links'); return false;">
                            <img src="{$sImagePath}google-share.png" alt="Google+" title="Google+"/>
                        </a>
                    </td>
                    {/if}
                    *}
                </tr>
            </table>
        </section>
</article>
<script src="//players.brightcove.net/607012070001/BkZuQtXDz_default/index.min.js" allowfullscreen webkitallowfullscreen mozallowfullscreen style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; height: 100%;"></script> 
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
        <p id="video_warning_text" style="padding-top:1px;color:#{$aPlayer.player_text};font-size:{$iWarningTextFontSize}px;">Video may reflect features, options or conditions that are different from the vehicle for sale and does not depict actual vehicle for sale.</p>
    </section>
</article>
{/if}

<iframe src="{$sVdpIframeUrl}" id="vdpiframe1" height="1" width="1" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>

{if !$aDvs.is_active}
{template file='dvs.block.deactive'}
{/if}