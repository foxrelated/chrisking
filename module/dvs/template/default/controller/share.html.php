<?php
/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		Konsort.org
 * @package 		DVS
 */

?>
<div id="dvs_share_wrapper">
	<div id="dvs_share_container">
		<input class="dvs_share_text_box" type="hidden" id="share_link_box">

		{assign var='baseUrl' value=''}
    {if $baseUrl = Phpfox::getParam('core.path')}{/if}
		<script type="text/javascript" src="{$baseUrl}module/dvs/static/jscript/clipboard/ZeroClipboard.js"></script>

		{foreach from=$aDvsVideos key=iKey item=aVideo name=videos}

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
										tb_show('Preview', $.ajaxBox('dvs.showMiniPreview', 'height=640&amp;width=900&amp;val[dvs_id]={$aDvs.dvs_id}&amp;val[shorturl]={$aVideo.shorturl}'));
										return false;">
										<img src="{$baseUrl}module/dvs/static/image/play_btn_75.png" class="dvs_share_button_overlay" />
										{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image width="100%"}
									</a>
								</div>
							</td>
							<td>
								<div class="dvs_share_buttons_holder">
									<a href="#" onclick="tb_show('{phrase var='dvs.share_via_email'}', $.ajaxBox('dvs.emailForm', 'height=400&amp;width=360&amp;iDvsId={$aDvs.dvs_id}&amp;&dvs_title={$aDvs.title_url}&amp;sRefId={$aVideo.referenceId}')); return false;">
										<img src="{$baseUrl}module/dvs/static/image/email-share.png" alt="Share Via Email"/>
									</a>

									<a href="#" onclick="
										var params = 'dvs_id={$aDvs.dvs_id}&dvs_title={$aDvs.title_url}&video_ref_id={$aVideo.referenceId}&service=facebook&return_id=share_link_box';
										$.ajaxCall('dvs.generateShortUrl', params).done(function(){l}
											if( {$bIsIPhone} ) {l}
												window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent($('#share_link_box').val());
											{r} else {l}
												window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400');
											{r}
											return false;
								  	{r});
								  	return false;">
										<img src="{$baseUrl}module/dvs/static/image/facebook-share.png" alt="Share to Facebook"/>
									</a>

									<span id="twitter_button_wrapper">
										<a href="#" onclick="
											var params = 'dvs_id={$aDvs.dvs_id}&dvs_title={$aDvs.title_url}&video_ref_id={$aVideo.referenceId}&service=twitter&return_id=share_link_box';
											var text = 'Check out this \'{$aVideo.name}\' video test drive from Test Dealership.';

											$.ajaxCall('dvs.generateShortUrl', params).done(function(){l}
												if( {$bIsIPhone} ) {l}
													window.location.href = 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent($('#share_link_box').val());
												{r} else {l}
													window.open( 'https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400' );
												{r}
												return false;
									  	{r});
									  	return false;">
											<img src="{$baseUrl}module/dvs/static/image/twitter-button.png" alt="Tweet" style="margin: 3px;" />
										</a>
									</span>

									<a href="#" onclick="
											var params = 'dvs_id={$aDvs.dvs_id}&dvs_title={$aDvs.title_url}&video_ref_id={$aVideo.referenceId}&service=google&return_id=share_link_box';
											$.ajaxCall('dvs.generateShortUrl', params).done(function(){l}
												if( {$bIsIPhone} ) {l}
													window.location.href = 'https://plus.google.com/share?url=' + encodeURIComponent( $('#share_link_box').val() );
												{r} else {l}
													window.open( 'https://plus.google.com/share?url=' + encodeURIComponent($('#share_link_box').val()), '', 'width=600,height=400' );
												{r}
												return false;
									  	{r});
									  	return false;">
										<img src="{$baseUrl}module/dvs/static/image/google-share.png" alt="Google+" title="Google+"/>
									</a>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								CRM Email Embed Code
								<input class="dvs_share_text_box" type="text" id="embed_code_{$iKey}"
											 value='
<div style="position:relative;width:300px;overflow:hidden">
<a href="{$sVideoViewUrl}{$aVideo.shorturl}"><span style="text-decoration:none;font-weight:bold;">{$aVideo.name}</span></a>
<div>{img path="core.url_file" file="brightcove/".$aVideo.video_still_image style="vertical-align:middle;" width="300" alt=$aVideo.name}</div>
<div style="height:100%;left:0;position:absolute;top:0;width:300px;">
<a href="{$sVideoViewUrl}{$aVideo.shorturl}"><img src="{$baseUrl}module/dvs/static/image/play_btn_75.png" style="display:block;margin-left:auto;margin-right:auto;padding-top:60px;"/></a>
</div>
</div>'
								/>
							</td>
							<td><br/>
								{if !$bIsIPhone}
									<div id="dvs_share_copy_button_holder_{$iKey}" class="dvs_share_copy_button_holder">
										<button id="copy_button_{$iKey}">Copy</button>
									</div>
									<script type="text/javascript">
									    var clip_{$iKey} = new ZeroClipboard.Client();
									    clip_{$iKey}.setHandCursor(true);
									    clip_{$iKey}.setText( document.getElementById('embed_code_{$iKey}').value );
									    clip_{$iKey}.glue('copy_button_{$iKey}', "dvs_share_copy_button_holder_{$iKey}");
									    clip_{$iKey}.addEventListener('onComplete', function(){l}
									    	$.ajaxCall('dvs.copyCRM', 'shorturl={$aVideo.shorturl}');
									    	alert('Text has been copied to clipboard!');
								    	{r});
									</script>
								{/if}
							</td>
						</tr>
					</table>

				</div>
			</div>
		{/foreach}
	</div>
</div>