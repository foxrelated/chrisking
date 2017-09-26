{assign var='baseUrl' value=''}
{if $baseUrl = Phpfox::getParam('core.path')}{/if}
{if !$bIsIPhone}
<script type="text/javascript">
</script>
{/if}
{foreach from=$aShareVideos key=iKey item=aVideo name=videos}

<div class="dvs_share_thumbnail_image_container">
    <div class="dvs_share_thumbnail_image_container_inner">
        <table width="100%">
            <tr>
                <td>
                    <h3 align="center">{$aVideo.year} {$aVideo.make} {$aVideo.model}</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="dvs_share_image_holder">
                        <a href="#" onclick="
                        tb_show('Preview', $.ajaxBox('dvs.showMiniPreview', 'height=640&amp;width={if $sBrowser == 'mobile'}600{else}900{/if}&amp;val[dvs_id]={$aDvs.dvs_id}&video_title_url={$aVideo.video_title_url}')); return false;">
                            {img server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_300' max_width=280 max_height=280}
                        </a>
                    </div>
                </td>
            </tr>
            </table>
            <table style="width:100%;">
            <tr>
                <td style="text-align:center;">
                    <div class="dvs_share_buttons_holder">
                        <!-- text button -->
                        <span>
                        <a href="#" onclick="tb_show('Text to a Friend', $.ajaxBox('dvs.textForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}&amp;bSaveGa=2')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/text-medium.png" height="40px" alt="Share via Text" border="0"/>
                        </a>
                        </span>
                        
                        <!-- email button -->
                        <span>
                        <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}&amp;bSaveGa=2')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/email-medium.png" height="40px" alt="Share Via Email" border="0"/>
                        </a>
                        </span>
                        
                        <!-- facebook button -->
                        <span>
                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}');
                        {else}
                            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}'), '', 'width=600,height=400');
                        {/if}

                        return false;">
                            <img src="{$baseUrl}module/dvs/static/image/facebook-medium.png" height="40px" alt="Share to Facebook" border="0"/>
                        </a>
                        </span>
                        
                        <!-- twitter button -->
                        <span id="twitter_button_wrapper">
                            <a href="#" onclick="
                            var text = 'Take a {$aVideo.year} %23{$aVideo.make} %23{$aVideo.model} Virtual Test Drive from %23{$aDvs.title_url}';
                            {if $bIsIPhone}
                                window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}');
                            {else}
                                window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}'), '', 'width=600,height=400' );
                            {/if}
                            return false;">
                                <img src="{$baseUrl}module/dvs/static/image/twitter-medium.png" height="40px" alt="Tweet" border="0"/>
                            </a>
                        </span>
                        
                        <!-- google+ button -->
                        <span>
                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}');
                        {else}
                            window.open( 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}'), '', 'width=600,height=400' );
                        {/if}
                        return false;">
                            <img src="{$baseUrl}module/dvs/static/image/google-medium.png" height="40px" alt="Google+" title="Google+" border="0"/>
                        </a>
                        </span>
                    </div>
                </td>
            </tr>
            </table>
            <table>
            <!-- CRM code -->
            <tr><td>
                    CRM Email Code
                    <input class="dvs_share_text_box" type="text" id="link_code4_{$iKey}" value='<div style="text-align: center;"><a href="{url link='share.'$aVideo.share_hash_code'8'}"> {if $aDvs.branding_file_name}{img server_id=$aDvs.branding_file_server_id title=$aDvs.dvs_name path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name suffix=_600}{else}<h1>{$aDvs.dealer_name}</h1>{/if}</a></div><img src="http://www.google-analytics.com/collect?v=1&tid={$globalDvsId}&cid={$aDvs.dvs_id}&cn=DVS Share Links&cs={$aDvs.dealer_name} DVS&cm=CRM Video Email Open&cc={$aVideo.name}&t=event&ec={'{'}{$aDvs.title_url\}}: CRM Video Email&ea=Share Links&el=CRM Video Email Open"><div align="center"><div style="position:relative;width:500px;overflow:hidden;text-align:center;"><h2 style="text-align:center;"><a href="{url link='share.'$aVideo.share_hash_code'8'}">{$aVideo.name}</a></h2><div style="height:281px;left:0;top:0;width:500px;"><a href="{url link='share.'$aVideo.share_hash_code'8'}">{img server_id=$aVideo.image_server_id server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_500' title=$aVideo.name height="281" width="500"}</a></div></div></div><p align="center"><span style="font-family: Arial;">Hi ~First Name~,</span><br style="font-family: Arial;" /><br style="font-family: Arial;" /><span style="font-family: Arial;">Thanks for your interest in the {$aVideo.year} {$aVideo.make} {$aVideo.model}! Please take this interactive Virtual Test Drive and then let us know when you would like to stop by the dealership for an in-person test drive.</span><br style="font-family: Arial;" /><br style="font-family: Arial;" /><span style="font-family: Arial;">Talk soon!</span><br style="font-family: Arial;" /><span style="font-family: Arial;">~Sales Person~</span><br style="font-family: Arial;" /><span style="font-family: Arial;">~Dealer Phone~</span><br /></p>' />
                </td>
                <td>     
                	<div id="dvs_share_copy_button_holder4_{$iKey}" class="dvs_share_copy_button_holder">
                	<button id="copy_button4_{$iKey}" class="copybtn" data-clipboard-target="#link_code4_{$iKey}">Copy Code</button>
                        </div>
                        <script type="text/javascript">
                            var embed4_{$iKey} = new Clipboard('#copy_button4_{$iKey}');
                                 embed4_{$iKey}.on('success', function(e) {l}
                                    setTooltip('#copy_button4_{$iKey}','Copied!');
                                    hideTooltip('#copy_button4_{$iKey}');
                                {r});

                                embed4_{$iKey}.on('error', function(e) {l}
                                  setTooltip('#copy_button4_{$iKey}','Failed!');
                                  hideTooltip('#copy_button4_{$iKey}');
                                {r});  

                        </script>
				</td></tr>
            <!-- thumbnail code -->
            <tr>
                <td>
                        Thumbnail Code
                        <input class="dvs_share_text_box" type="text" id="embed_code_{$iKey}" value='<div align="center"><div style="position:relative;width:500px;overflow:hidden;text-align:center;"><h2 style="text-align:center;"><a href="{url link='share.'$aVideo.share_hash_code'3'}">{$aVideo.name}</a></h2><div style="height:281px;left:0;top:0;width:500px;"><a href="{url link='share.'$aVideo.share_hash_code'3'}">{img server_id=$aVideo.image_server_id path="brightcove.url_image" file=$aVideo.image_path suffix="_500" max_width=500 max_height=281 title=$aVideo.name}</a></div></div></div>' />
                </td>
                <td>
                    <div id="dvs_share_copy_button_holder1_{$iKey}" class="dvs_share_copy_button_holder">
                    <button id="copy_button1_{$iKey}" class="copybtn" data-clipboard-target="#embed_code_{$iKey}">Copy Code</button>
                    </div>
                    <script type="text/javascript">
                              var embed_{$iKey} = new Clipboard('#copy_button1_{$iKey}');
                                 embed_{$iKey}.on('success', function(e) {l}
                                    setTooltip('#copy_button1_{$iKey}','Copied!');
                                    hideTooltip('#copy_button1_{$iKey}');
                                {r});

                                embed_{$iKey}.on('error', function(e) {l}
                                  setTooltip('#copy_button1_{$iKey}','Failed!');
                                  hideTooltip('#copy_button1_{$iKey}');
                                {r});
                        </script>
                </td></tr>
            <!-- direct link -->
            <tr>
                <td>
                Direct Video Link
                <input class="dvs_share_text_box" type="text" id="link_code2_{$iKey}" value='{url link='share.'$aVideo.share_hash_code'4'}' />
                </td>
                <td>
                	<div id="dvs_share_copy_button_holder2_{$iKey}" class="dvs_share_copy_button_holder">
                    <button id="copy_button2_{$iKey}" class="copybtn" data-clipboard-target="#link_code2_{$iKey}">Copy Link</button>
                    </div>
                        <script type="text/javascript">
                                var embed2_{$iKey} = new Clipboard('#copy_button2_{$iKey}');
                                 embed2_{$iKey}.on('success', function(e) {l}
                                    setTooltip('#copy_button2_{$iKey}','Copied!');
                                    hideTooltip('#copy_button2_{$iKey}');
                                {r});

                                embed2_{$iKey}.on('error', function(e) {l}
                                  setTooltip('#copy_button2_{$iKey}','Failed!');
                                  hideTooltip('#copy_button2_{$iKey}');
                                {r});    
                        </script>   
                </td>
                </tr>
            <!-- QR code link -->    
            <!--<tr>
                <td>
                	QR Code Link
                	<input class="dvs_share_text_box" type="text" id="link_code3_{$iKey}" value='{url link='share.'$aVideo.share_hash_code'5'}' />
                </td>
                <td>
                	<div id="dvs_share_copy_button_holder3_{$iKey}" class="dvs_share_copy_button_holder">
                    <button id="copy_button3_{$iKey}" class="copybtn" data-clipboard-target="#link_code3_{$iKey}">Copy QR</button>
                        </div>
                        <script type="text/javascript">
                            var embed3_{$iKey} = new Clipboard('#copy_button3_{$iKey}');
                                 embed3_{$iKey}.on('success', function(e) {l}
                                    setTooltip('#copy_button3_{$iKey}','Copied!');
                                    hideTooltip('#copy_button3_{$iKey}');
                                {r});

                                embed3_{$iKey}.on('error', function(e) {l}
                                  setTooltip('#copy_button3_{$iKey}','Failed!');
                                  hideTooltip('#copy_button3_{$iKey}');
                                {r});  

                        </script>
                </td>
                </tr>-->                  
        	
            </table>
            </td>
            </tr>
        </table>

    </div>
</div>
{/foreach}