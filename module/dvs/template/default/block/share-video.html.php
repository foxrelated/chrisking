{assign var='baseUrl' value=''}
{if $baseUrl = Phpfox::getParam('core.path')}{/if}

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
                            {img path='brightcove.url_image' file=$aVideo.image_path suffix='_email_300' max_width=280 max_height=280}
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="dvs_share_buttons_holder">
                        {if Phpfox::isAdmin()}
                        <span>
                        <a href="#" onclick="tb_show('Text to a Friend', $.ajaxBox('dvs.textForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}&amp;bSaveGa=2')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/text-medium.png" height="40px" alt="Share via Text"/>
                        </a>
                        </span>
                        {/if}
                        <span>
                        <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}&amp;bSaveGa=2')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/email-medium.png" height="40px" alt="Share Via Email"/>
                        </a>
                        </span>
                        &nbsp;
                        <span>
                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}');
                        {else}
                            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}'), '', 'width=600,height=400');
                        {/if}

                        return false;">
                            <img src="{$baseUrl}module/dvs/static/image/facebook-medium.png" height="40px" alt="Share to Facebook"/>
                        </a>
                        </span>
                        &nbsp;
                        <span id="twitter_button_wrapper">
                            <a href="#" onclick="
                            var text = 'Take a {$aVideo.year} %23{$aVideo.make} %23{$aVideo.model} Virtual Test Drive from %23{$aDvs.title_url}';
                            {if $bIsIPhone}
                                window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}');
                            {else}
                                window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}'), '', 'width=600,height=400' );
                            {/if}
                            return false;">
                                <img src="{$baseUrl}module/dvs/static/image/twitter-medium.png" height="40px" alt="Tweet" />
                            </a>
                        </span>
                        &nbsp;
                        <span>
                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}');
                        {else}
                            window.open( 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}'), '', 'width=600,height=400' );
                        {/if}
                        return false;">
                            <img src="{$baseUrl}module/dvs/static/image/google-medium.png" height="40px" alt="Google+" title="Google+" />
                        </a>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                    <td>
                        CRM/Email Embed Code
                        <input class="dvs_share_text_box" type="text" id="embed_code_{$iKey}" value='<div align="center"><div style="position:relative;width:500px;overflow:hidden;text-align:center;"><h2 style="text-align:center;"><a href="{url link='share.'$aVideo.share_hash_code'3'}">{$aVideo.name}</a></h2><div style="height:281px;left:0;top:0;width:500px;"><a href="{url link='share.'$aVideo.share_hash_code'3'}">{img server_id=$aVideo.image_server_id path="brightcove.url_image" file=$aVideo.image_path suffix="_email_500" max_width=500 max_height=281 title=$aVideo.name}</a></div></div></div>' />
                    </td>
                    <td>
                        {if !$bIsIPhone}
                        <div id="dvs_share_copy_button_holder1_{$iKey}" class="dvs_share_copy_button_holder">
                            <button id="copy_button1_{$iKey}">Copy Code</button>
                        </div>
                        <script type="text/javascript">
                            var clip1_{$iKey} = new ZeroClipboard.Client();
                            clip1_{$iKey}.setHandCursor(true);
                            clip1_{$iKey}.setText( document.getElementById('embed_code_{$iKey}').value );
                            clip1_{$iKey}.glue('copy_button1_{$iKey}', "dvs_share_copy_button_holder1_{$iKey}");
                            clip1_{$iKey}.addEventListener('onComplete', function(){l}
                            $.ajaxCall('dvs.copyCRM', 'shorturl={$aVideo.shorturl}');
                            alert('HTML code has been copied to your clipboard! Now paste it into your HTML editor of choice.');
                            {r});
                        </script>
                        {/if}
                    </td>
                    </tr>
                    <tr>
                    <td>
                        Direct Video Link
                        <input class="dvs_share_text_box" type="text" id="link_code2_{$iKey}" value='{url link='share.'$aVideo.share_hash_code'4'}' />
                    </td>
                    <td>
                        {if !$bIsIPhone}
                        <div id="dvs_share_copy_button_holder2_{$iKey}" class="dvs_share_copy_button_holder">
                            <button id="copy_button2_{$iKey}">Copy Link</button>
                        </div>
                        <script type="text/javascript">
                            var clip2_{$iKey} = new ZeroClipboard.Client();
                            clip2_{$iKey}.setHandCursor(true);
                            clip2_{$iKey}.setText( document.getElementById('link_code2_{$iKey}').value );
                            clip2_{$iKey}.glue('copy_button2_{$iKey}', "dvs_share_copy_button_holder2_{$iKey}");
                            clip2_{$iKey}.addEventListener('onComplete', function(){l}
                            $.ajaxCall('dvs.copyCRM', 'shorturl={$aVideo.shorturl}');
                            alert('Link has been copied to clipboard!');
                            {r});
                        </script>
                        {/if}
                    </td>
                    </tr>
                    {if Phpfox::isAdmin()}
                    <tr>
                    <td>
                        QR Code Link
                        <input class="dvs_share_text_box" type="text" id="link_code3_{$iKey}" value='{url link='share.'$aVideo.share_hash_code'5'}' />
                    </td>
                    <td>
                        {if !$bIsIPhone}
                        <div id="dvs_share_copy_button_holder3_{$iKey}" class="dvs_share_copy_button_holder">
                            <button id="copy_button3_{$iKey}">Copy QR</button>
                        </div>
                        <script type="text/javascript">
                            var clip3_{$iKey} = new ZeroClipboard.Client();
                            clip3_{$iKey}.setHandCursor(true);
                            clip3_{$iKey}.setText( document.getElementById('link_code3_{$iKey}').value );
                            clip3_{$iKey}.glue('copy_button3_{$iKey}', "dvs_share_copy_button_holder3_{$iKey}");
                            clip3_{$iKey}.addEventListener('onComplete', function(){l}
                            $.ajaxCall('dvs.copyCRM', 'shorturl={$aVideo.shorturl}');
                            alert('QR link has been copied to clipboard!');
                            {r});
                        </script>
                        {/if}
                    </td>
                    </tr>                    
                    <tr>
                        
                    <td>
                        Video Email Template
                        <input class="dvs_share_text_box" type="text" id="link_code4_{$iKey}" value='<div style="text-align: center;"><a href="{url link='share.'$aVideo.share_hash_code'8'}"> {if $aDvs.branding_file_name}{img title=$aDvs.dvs_name path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name suffix=_600}{else}<h1>{$aDvs.dealer_name}</h1>{/if}</a></div><img src="http://www.google-analytics.com/collect?v=1&tid={$globalDvsId}&cid={$aDvs.dvs_id}&cn=DVS Share Links&cs={$aDvs.dealer_name} DVS&cm=CRM Video Email Open&cc={$aVideo.name}&t=event&ec={'{'}{$aDvs.title_url\}}: CRM Video Email&ea=Share Links&el=CRM Video Email Open"><div align="center"><div style="position:relative;width:500px;overflow:hidden;text-align:center;"><h2 style="text-align:center;"><a href="{url link='share.'$aVideo.share_hash_code'8'}">{$aVideo.name}</a></h2><div style="height:281px;left:0;top:0;width:500px;"><a href="{url link='share.'$aVideo.share_hash_code'8'}">{img server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_email_500' title=$aVideo.name height="281" width="500"}</a></div></div></div><p align="center"><span style="font-family: Arial;">Hi ~First Name~,</span><br style="font-family: Arial;" /><br style="font-family: Arial;" /><span style="font-family: Arial;">Thanks for your interest in the {$aVideo.year} {$aVideo.make} {$aVideo.model}! Please take this interactive Virtual Test Drive and then let us know when you would like to stop by the dealership for an in-person test drive.</span><br style="font-family: Arial;" /><br style="font-family: Arial;" /><span style="font-family: Arial;">Talk soon!</span><br style="font-family: Arial;" /><span style="font-family: Arial;">~Sales Person~</span><br style="font-family: Arial;" /><span style="font-family: Arial;">~Dealer Phone~</span><br /></p>' />
                    </td>
                    <td>
                        {if !$bIsIPhone}
                        <div id="dvs_share_copy_button_holder4_{$iKey}" class="dvs_share_copy_button_holder">
                            <button id="copy_button4_{$iKey}">Copy Code</button>
                        </div>
                        <script type="text/javascript">
                            var clip4_{$iKey} = new ZeroClipboard.Client();
                            clip4_{$iKey}.setHandCursor(true);
                            clip4_{$iKey}.setText( document.getElementById('link_code4_{$iKey}').value );
                            clip4_{$iKey}.glue('copy_button4_{$iKey}', "dvs_share_copy_button_holder4_{$iKey}");
                            clip4_{$iKey}.addEventListener('onComplete', function(){l}
                            $.ajaxCall('dvs.copyCRM', 'shorturl={$aVideo.shorturl}');
                            alert('HTML code has been copied to clipboard!');
                            {r});
                        </script>
                        {/if}
                    </td>
                    </tr>
                    {/if}
                    </table>
                </td>
            </tr>
        </table>

    </div>
</div>
{/foreach}