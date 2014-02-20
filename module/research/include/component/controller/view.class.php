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
class Research_Component_Controller_View extends Phpfox_Component {

	public function process()
	{
		$oResearch = Phpfox::getService('research');

		$sName = $this->request()->get(Phpfox::getParam('research.video_url_prefix'));

		if (!$sName) {
			$sType = $this->request()->get('type', '');
			$sYear = $this->request()->get('year', '');
			$sMake = $this->request()->get('make', '');
			$sModel = $this->request()->get('model', '');
			$sBodyStyle = $this->request()->get('bodyStyle', '');

			if ($sMake == 'undefined')
				$sMake = '';
			if ($sModel == 'undefined')
				$sModel = '';

			if ($sType && $sYear && $sMake && $sModel) {
				//Search for a specific car
				$aVideos[] = $oResearch->getVideoBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);
				$aVideos = array_merge($aVideos, $oResearch->getRelatedByName(false, $aVideos[0], Phpfox::getParam('research.related_limit')));
			} else {
				//List by search

				$aVideos = array_merge($oResearch->searchVideosByFields($sYear, $sMake, $sModel, $sBodyStyle, $sType), $oResearch->getRelatedBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType, Phpfox::getParam('research.related_limit')));
			}
		} else {
			//Specific car by name
			$aVideos[] = $oResearch->getVideoByName($sName);
			$aVideos = array_merge($aVideos, $oResearch->getRelatedByName(false, $aVideos[0], Phpfox::getParam('research.related_limit')));
		}

		$this->template()
				->setHeader(array(
					'jquery.expander.js' => 'module_research',
					'playlist.js' => 'module_research'
				))
				->assign(array(
					'sVideoIds' => $oResearch->createPlaylist($aVideos)
				));
	}

}

?>

