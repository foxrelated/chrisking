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
<div id="dvs_gallery_wrapper">
	<div id="dvs_gallery_container">
		{foreach from=$aDvsVideos key=iKey item=aVideo name=videos}
			<div class="dvs_gallery_thumbnail_image_container{if is_int($phpfox.iteration.videos/$iColumns)} dvs_gallery_thumbnail_image_container_end{/if}">
				<div class="dvs_gallery_thumbnail_image_container_inner">
					<a href="{if $bSubdomainMode}{url link=$aDvs.title_url.'.'.$aVideo.video_title_url}{else}{url link='dvs.'$aDvs.title_url.'.'.$aVideo.video_title_url}{/if}" class="dvs_footer_link" {if $aVideo.targer_href == 1}target="_blank"{else}target="_self"{/if} > <!--phpmasterminds edited this code for self or blank -->
						<div class="dvs_gallery_image">
							{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image}
						</div>
						<div class="dvs_footer_link" style="text-align:center;font-weight:bold;">
							{$aVideo.year} {$aVideo.make} {$aVideo.model}
						</div>
						<div class="dvs_gallery_thumbnail_image_overlay">
							<img src="{$sImagePath}play_btn_50.png" />
						</div>
					</a>
				</div>
			</div>
		{/foreach}
	</div>
</div>