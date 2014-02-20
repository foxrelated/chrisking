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
		{foreach from=$aDvsVideos key=iKey item=aVideo name=videos}
			<div class="dvs_share_thumbnail_image_container">
				<div class="dvs_share_thumbnail_image_container_inner">
					<div class="dvs_share_image">
						{img path='core.url_file' file='brightcove/'.$aVideo.thumbnail_image}
					</div>
					<div class="dvs_share_text">
						{$aVideo.year} {$aVideo.make} {$aVideo.model}
					</div>
					<div class="dvs_share_controls_container">
						<div class="dvs_share_control">
							<div class="dvs_share_text_box_container">
								<input class="dvs_share_text_box" type="text" id="share_text_box_facebook_{$iKey}">
							</div>
							<div class="dvs_share_button_container">
								<input type="button" class="dvs_share_button" value="Get Facebook Link" onclick="$.ajaxCall('dvs.generateShortUrl', 'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=facebook&return_id=share_text_box_facebook_{$iKey}');"">
							</div>
						</div>
				
						<div class="dvs_share_control">
							<div class="dvs_share_text_box_container">
								<input class="dvs_share_text_box" type="text" id="share_text_box_google_{$iKey}">
							</div>
							<div class="dvs_share_button_container">
								<input type="button" class="dvs_share_button" value="Get Google Link" onclick="$.ajaxCall('dvs.generateShortUrl', 'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=google&return_id=share_text_box_google_{$iKey}');"">
							</div>
						</div>
						
						<div class="dvs_share_control">
							<div class="dvs_share_text_box_container">
								<input class="dvs_share_text_box" type="text" id="share_text_box_twitter_{$iKey}">
							</div>
							<div class="dvs_share_button_container">
								<input type="button" class="dvs_share_button" value="Get Twitter Link" onclick="$.ajaxCall('dvs.generateShortUrl', 'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=twitter&return_id=share_text_box_twitter_{$iKey}');"">
							</div>
						</div>
						
						<div class="dvs_share_control">
							<div class="dvs_share_text_box_container">
								<input class="dvs_share_text_box" type="text" id="share_text_box_email_{$iKey}">
							</div>
							<div class="dvs_share_button_container">
								<input type="button" class="dvs_share_button" value="Get Email Link" onclick="$.ajaxCall('dvs.generateShortUrl', 'dvs_id={$aDvs.dvs_id}&video_ref_id={$aVideo.referenceId}&service=email&return_id=share_text_box_email_{$iKey}');"">
							</div>
						</div>
						
					</div>
				</div>
			</div>
		{/foreach}
	</div>
</div>