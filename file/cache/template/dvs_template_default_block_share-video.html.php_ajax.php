<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 22, 2014, 6:37 pm */ ?>
<?php $this->assign('baseUrl', '');  if ($this->_aVars['baseUrl'] = Phpfox ::getParam('core.path')):  endif; ?>

<?php if (count((array)$this->_aVars['aShareVideos'])):  $this->_aPhpfoxVars['iteration']['videos'] = 0;  foreach ((array) $this->_aVars['aShareVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']):  $this->_aPhpfoxVars['iteration']['videos']++; ?>


<div class="dvs_share_thumbnail_image_container">
    <div class="dvs_share_thumbnail_image_container_inner">
        <table width="100%">
            <tr>
                <td colspan="2">
                    <h3><?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['make']; ?> <?php echo $this->_aVars['aVideo']['model']; ?></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="dvs_share_image_holder">
                        <a href="#" onclick="
						tb_show('Preview', $.ajaxBox('dvs.showMiniPreview', 'height=640&amp;width=900&amp;val[dvs_id]=<?php echo $this->_aVars['aDvs']['dvs_id']; ?>&video_title_url=<?php echo $this->_aVars['aVideo']['video_title_url']; ?>')); return false;">
                            <img src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/image/play_btn_75.png" class="dvs_share_button_overlay" />
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'brightcove/'.$this->_aVars['aVideo']['thumbnail_image'],'width' => "100%")); ?>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="dvs_share_buttons_holder">
                        <a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('dvs.share_via_email'); ?>', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId=<?php echo $this->_aVars['aDvs']['dvs_id']; ?>&amp;&dvs_title=<?php echo $this->_aVars['aDvs']['title_url']; ?>&amp;sRefId=<?php echo $this->_aVars['aVideo']['referenceId']; ?>&amp;bSaveGa=2')); return false;">
                            <img src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/image/email-share.png" alt="Share Via Email"/>
                        </a>

                        <a href="#" onclick="
<?php if ($this->_aVars['aDvs']['sitemap_parent_url']): ?>
<?php if ($this->_aVars['bIsIPhone']): ?>
                                window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>');
<?php else: ?>
                                window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>'), '', 'width=600,height=400');
<?php endif; ?>
<?php else: ?>
                            var params = 'dvs_id=<?php echo $this->_aVars['aDvs']['dvs_id']; ?>&dvs_title=<?php echo $this->_aVars['aDvs']['title_url']; ?>&video_ref_id=<?php echo $this->_aVars['aVideo']['referenceId']; ?>&service=facebook&return_id=share_link_box';
                            $.ajaxCall('dvs.generateShortUrl', params).done(function(){
<?php if ($this->_aVars['bIsIPhone']): ?>
                                    window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent($('#share_link_box').val());
<?php else: ?>
                                    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400');
<?php endif; ?>
                                return false;
                            });
<?php endif; ?>
					    return false;">
                            <img src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/image/facebook-share.png" alt="Share to Facebook"/>
                        </a>

                        <span id="twitter_button_wrapper">
                            <a href="#" onclick="
<?php if ($this->_aVars['aDvs']['sitemap_parent_url']): ?>
<?php if ($this->_aVars['bIsIPhone']): ?>
                                        window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>');
<?php else: ?>
                                        window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>'), '', 'width=600,height=400' );
<?php endif; ?>
<?php else: ?>
                                var params = 'dvs_id=<?php echo $this->_aVars['aDvs']['dvs_id']; ?>&dvs_title=<?php echo $this->_aVars['aDvs']['title_url']; ?>&video_ref_id=<?php echo $this->_aVars['aVideo']['referenceId']; ?>&service=twitter&return_id=share_link_box';
                                var text = 'Check out this <?php echo $this->_aVars['aVideo']['name']; ?> video from <?php echo $this->_aVars['aDvs']['dealer_name']; ?>! %23<?php echo $this->_aVars['aVideo']['make']; ?> %23<?php echo $this->_aVars['aVideo']['model']; ?> %23VirtualTestDrive %23<?php echo $this->_aVars['aDvs']['title_url']; ?>';

                                $.ajaxCall('dvs.generateShortUrl', params).done(function(){
<?php if ($this->_aVars['bIsIPhone']): ?>
                                        window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent($('#share_link_box').val());
<?php else: ?>
                                        window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400' );
<?php endif; ?>
                                    return false;
                                });
<?php endif; ?>
                            return false;">
                                <img src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/image/twitter-button.png" alt="Tweet" style="margin: 3px;" />
                            </a>
                        </span>

                        <a href="#" onclick="
<?php if ($this->_aVars['aDvs']['sitemap_parent_url']): ?>
<?php if ($this->_aVars['bIsIPhone']): ?>
                                window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>');
<?php else: ?>
                                window.open( 'https://plus.google.com/share?url=' + encodeURIComponent('<?php echo $this->_aVars['aVideo']['parent_video_url']; ?>'), '', 'width=600,height=400' );
<?php endif; ?>
<?php else: ?>
                            var params = 'dvs_id=<?php echo $this->_aVars['aDvs']['dvs_id']; ?>&dvs_title=<?php echo $this->_aVars['aDvs']['title_url']; ?>&video_ref_id=<?php echo $this->_aVars['aVideo']['referenceId']; ?>&service=google&return_id=share_link_box';
                            $.ajaxCall('dvs.generateShortUrl', params).done(function(){
<?php if ($this->_aVars['bIsIPhone']): ?>
                                    window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent( $('#share_link_box').val() );
<?php else: ?>
                                    window.open( 'https://plus.google.com/share?url=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400' );
<?php endif; ?>
                                return false;
                            });
<?php endif; ?>
                        return false;">
                            <img src="<?php echo $this->_aVars['baseUrl']; ?>module/dvs/static/image/google-share.png" alt="Google+" title="Google+"/>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    CRM Email Embed Code
                    <input class="dvs_share_text_box" type="text" id="embed_code_<?php echo $this->_aVars['iKey']; ?>"
                           value='
<div style="position:relative;width:300px;overflow:hidden;text-align:center;">
<a href="<?php if ($this->_aVars['aDvs']['sitemap_parent_url']):  echo $this->_aVars['aVideo']['parent_video_url'];  else:  echo $this->_aVars['sVideoViewUrl'];  echo $this->_aVars['aVideo']['shorturl']; ?>?utm_source=ShareLinks&amp;utm_medium=CRM_Embed&amp;utm_content=<?php echo $this->_aVars['aVideo']['year']; ?>_<?php echo $this->_aVars['aVideo']['make']; ?>_<?php echo $this->_aVars['aVideo']['model']; ?>&amp;utm_campaign=<?php echo $this->_aVars['aDvs']['dealer_name']; ?> DVS<?php endif; ?>"><span style="text-decoration:none;font-weight:bold;"><?php echo $this->_aVars['aVideo']['name']; ?></span></a>
<div style="height:100%;left:0;top:0;width:300px;">
<a href="<?php if ($this->_aVars['aDvs']['sitemap_parent_url']):  echo $this->_aVars['aVideo']['parent_video_url'];  else:  echo $this->_aVars['sVideoViewUrl'];  echo $this->_aVars['aVideo']['shorturl']; ?>?utm_source=ShareLinks&amp;utm_medium=CRM_Embed&amp;utm_content=<?php echo $this->_aVars['aVideo']['year']; ?>_<?php echo $this->_aVars['aVideo']['make']; ?>_<?php echo $this->_aVars['aVideo']['model']; ?>&amp;utm_campaign=<?php echo $this->_aVars['aDvs']['dealer_name']; ?> DVS<?php endif; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aVideo']['image_server_id'],'path' => "brightcove.url_image",'file' => $this->_aVars['aVideo']['image_path'],'suffix' => "_email",'max_width' => 300,'max_height' => 300,'title' => $this->_aVars['aVideo']['name'])); ?></a>
</div>
</div>
'
                </td>
                <td><br/>
<?php if (! $this->_aVars['bIsIPhone']): ?>
                    <div id="dvs_share_copy_button_holder1_<?php echo $this->_aVars['iKey']; ?>" class="dvs_share_copy_button_holder">
                        <button id="copy_button1_<?php echo $this->_aVars['iKey']; ?>">Copy Code</button>
                    </div>
                    <script type="text/javascript">
                        var clip1_<?php echo $this->_aVars['iKey']; ?> = new ZeroClipboard.Client();
                        clip1_<?php echo $this->_aVars['iKey']; ?>.setHandCursor(true);
                        clip1_<?php echo $this->_aVars['iKey']; ?>.setText( document.getElementById('embed_code_<?php echo $this->_aVars['iKey']; ?>').value );
                        clip1_<?php echo $this->_aVars['iKey']; ?>.glue('copy_button1_<?php echo $this->_aVars['iKey']; ?>', "dvs_share_copy_button_holder1_<?php echo $this->_aVars['iKey']; ?>");
                        clip1_<?php echo $this->_aVars['iKey']; ?>.addEventListener('onComplete', function(){
                        $.ajaxCall('dvs.copyCRM', 'shorturl=<?php echo $this->_aVars['aVideo']['shorturl']; ?>');
                        alert('HTML code has been copied to your clipboard! Now paste it into your HTML editor of choice.');
                        });
                    </script>
<?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Direct Video Link
                    <input class="dvs_share_text_box" type="text" id="link_code_<?php echo $this->_aVars['iKey']; ?>" value='<?php if ($this->_aVars['aDvs']['sitemap_parent_url']):  echo $this->_aVars['aVideo']['parent_video_url'];  else:  echo $this->_aVars['sVideoViewUrl'];  echo $this->_aVars['aVideo']['shorturl']; ?>?utm_source=ShareLinks&amp;utm_medium=Direct_Link&amp;utm_content=<?php echo $this->_aVars['aVideo']['year']; ?>_<?php echo $this->_aVars['aVideo']['make']; ?>_<?php echo $this->_aVars['aVideo']['model']; ?>&amp;utm_campaign=<?php echo $this->_aVars['aDvs']['dealer_name']; ?> DVS<?php endif; ?>' />
                </td>
                <td><br/>
<?php if (! $this->_aVars['bIsIPhone']): ?>
                    <div id="dvs_share_copy_button_holder2_<?php echo $this->_aVars['iKey']; ?>" class="dvs_share_copy_button_holder">
                        <button id="copy_button2_<?php echo $this->_aVars['iKey']; ?>">Copy Link</button>
                    </div>
                    <script type="text/javascript">
                        var clip2_<?php echo $this->_aVars['iKey']; ?> = new ZeroClipboard.Client();
                        clip2_<?php echo $this->_aVars['iKey']; ?>.setHandCursor(true);
                        clip2_<?php echo $this->_aVars['iKey']; ?>.setText( document.getElementById('link_code_<?php echo $this->_aVars['iKey']; ?>').value );
                        clip2_<?php echo $this->_aVars['iKey']; ?>.glue('copy_button2_<?php echo $this->_aVars['iKey']; ?>', "dvs_share_copy_button_holder2_<?php echo $this->_aVars['iKey']; ?>");
                        clip2_<?php echo $this->_aVars['iKey']; ?>.addEventListener('onComplete', function(){
                        $.ajaxCall('dvs.copyCRM', 'shorturl=<?php echo $this->_aVars['aVideo']['shorturl']; ?>');
                        alert('Link has been copied to clipboard!');
                        });
                    </script>
<?php endif; ?>
                </td>
            </tr>
        </table>

    </div>
</div>
<?php endforeach; endif; ?>
