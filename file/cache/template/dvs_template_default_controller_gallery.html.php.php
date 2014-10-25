<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: October 21, 2014, 9:01 pm */ ?>
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
<?php if (count((array)$this->_aVars['aDvsVideos'])):  $this->_aPhpfoxVars['iteration']['videos'] = 0;  foreach ((array) $this->_aVars['aDvsVideos'] as $this->_aVars['iKey'] => $this->_aVars['aVideo']):  $this->_aPhpfoxVars['iteration']['videos']++; ?>

			<div class="dvs_gallery_thumbnail_image_container<?php if (is_int ( $this->_aPhpfoxVars['iteration']['videos'] / $this->_aVars['iColumns'] )): ?> dvs_gallery_thumbnail_image_container_end<?php endif; ?>">
				<div class="dvs_gallery_thumbnail_image_container_inner">
					<a href="<?php if ($this->_aVars['bSubdomainMode']):  echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aDvs']['title_url'].'.'.$this->_aVars['aVideo']['video_title_url']);  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('dvs.'.$this->_aVars['aDvs']['title_url'].'.'.$this->_aVars['aVideo']['video_title_url']);  endif; ?>" class="dvs_footer_link" <?php if ($this->_aVars['aVideo']['targer_href'] == 1): ?>target="_blank"<?php else: ?>target="_parent"<?php endif; ?> > <!--phpmasterminds edited this code for parent (self) or blank -->
						<div class="dvs_gallery_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('path' => 'core.url_file','file' => 'brightcove/'.$this->_aVars['aVideo']['thumbnail_image'])); ?>
						</div>
						<div class="dvs_footer_link" style="text-align:center;font-weight:bold;">
<?php echo $this->_aVars['aVideo']['year']; ?> <?php echo $this->_aVars['aVideo']['make']; ?> <?php echo $this->_aVars['aVideo']['model']; ?>
						</div>
						<div class="dvs_gallery_thumbnail_image_overlay">
							<img src="<?php echo $this->_aVars['sImagePath']; ?>play_btn_50.png" />
						</div>
					</a>
				</div>
			</div>
<?php endforeach; endif; ?>
	</div>
</div>
