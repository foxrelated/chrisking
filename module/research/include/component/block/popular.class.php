<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('DRINK SLICE!');

/**
 *
 *
 * @copyright	Konsort.org 
 * @author  		Konsort.org
 * @package 		Research
 */
class Research_Component_Block_Popular extends Phpfox_Component {

	public function process()
	{
		if ($sName = $this->request()->get(Phpfox::getParam('research.video_url_prefix'))) {
			$this->template()->assign(array(
				'aPopularVideos' => Phpfox::getService('research')->getPopularVideosByName($sName)
			));
		} else {
			$sYear = $this->request()->get('year', '');
			$sMake = $this->request()->get('make', '');
			$sModel = $this->request()->get('model', '');
			$sBodyStyle = $this->request()->get('bodyStyle', '');

			$this->template()->assign(array(
				'aPopularVideos' => Phpfox::getService('research')->getPopularVideosBySearch($sYear, $sMake, $sModel, $sBodyStyle)
			));
		}
	}

}

?>