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
class Research_Component_Block_Info extends Phpfox_Component {

	public function process()
	{
		$oResearch = Phpfox::getService('research');

		if ($sName = $this->request()->get(Phpfox::getParam('research.video_url_prefix'))) {
			$aStyleList = $oResearch->getStyleListByName($sName);

			$this->template()->assign(array(
				'aStyle' => $oResearch->getStyle($aStyleList[0]['style_id']),
				'aStyleList' => $aStyleList
			));
		} else {
			$sType = $this->request()->get('type', '');
			$sYear = $this->request()->get('year', '');
			$sMake = $this->request()->get('make', '');
			$sModel = $this->request()->get('model', '');
			$sBodyStyle = $this->request()->get('bodyStyle', '');

			$aStyleList = $oResearch->getStyleListBySearch($sYear, $sMake, $sModel, $sBodyStyle, $sType);

			$this->template()->assign(array(
				'aStyle' => $oResearch->getStyle($aStyleList[0]['style_id']),
				'aStyleList' => $aStyleList
			));
		}
	}

}

?>