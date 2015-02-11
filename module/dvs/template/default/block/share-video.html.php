{assign var='baseUrl' value=''}
{if $baseUrl = Phpfox::getParam('core.path')}{/if}

{foreach from=$aShareVideos key=iKey item=aVideo name=videos}

<div class="dvs_share_thumbnail_image_container">
    <div class="dvs_share_thumbnail_image_container_inner">
        <table width="100%">
            <tr>
                <td colspan="2">
                    <h3>{$aVideo.year} {$aVideo.make} {$aVideo.model}</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="dvs_share_image_holder">
                        <a href="#" onclick="
						tb_show('Preview', $.ajaxBox('dvs.showMiniPreview', 'height=640&amp;width=900&amp;val[dvs_id]={$aDvs.dvs_id}&video_title_url={$aVideo.video_title_url}')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/play_btn_75.png" class="dvs_share_button_overlay" />
                            {img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image width="100%"}
                        </a>
                    </div>
                </td>

                <td>
                    <div class="dvs_share_buttons_holder">
                        <a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}&amp;bSaveGa=2')); return false;">
                            <img src="{$baseUrl}module/dvs/static/image/email-share.png" alt="Share Via Email"/>
                        </a>

                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}');
                        {else}
                            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'0'}'), '', 'width=600,height=400');
                        {/if}

					    return false;">
                            <img src="{$baseUrl}module/dvs/static/image/facebook-share.png" alt="Share to Facebook"/>
                        </a>

                        <span id="twitter_button_wrapper">
                            <a href="#" onclick="
                            var text = 'Take a {$aVideo.year} %23{$aVideo.make} %23{$aVideo.model} Virtual Test Drive from %23{$aDvs.title_url}';
                            {if $bIsIPhone}
                                window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}');
                            {else}
                                window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'1'}'), '', 'width=600,height=400' );
                            {/if}
                            return false;">
                                <img src="{$baseUrl}module/dvs/static/image/twitter-button.png" alt="Tweet" style="margin: 3px;" />
                            </a>
                        </span>

                        <a href="#" onclick="
                        {if $bIsIPhone}
                            window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}');
                        {else}
                            window.open( 'https://plus.google.com/share?url=' + encodeURIComponent('{url link='share.'$aVideo.share_hash_code'2'}'), '', 'width=600,height=400' );
                        {/if}
                        return false;">
                            <img src="{$baseUrl}module/dvs/static/image/google-share.png" alt="Google+" title="Google+"/>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    CRM Embed Code
                    <input class="dvs_share_text_box" type="text" id="embed_code_{$iKey}"
                           value='
<div style="position:relative;width:300px;overflow:hidden;text-align:center;">
<a href="{url link='share.'$aVideo.share_hash_code'3'}"><span style="text-decoration:none;font-weight:bold;">{$aVideo.name}</span></a>
<div style="height:100%;left:0;top:0;width:300px;">
<a href="{url link='share.'$aVideo.share_hash_code'3'}">{img server_id=$aVideo.image_server_id path="brightcove.url_image" file=$aVideo.image_path suffix="_email_300" max_width=300 max_height=300 title=$aVideo.name}</a>
</div>
</div>
'
                </td>
                <td><br/>
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
                <br/>
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
                <br/>
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
            {/if}
        </table>

    </div>
</div>
{/foreach}