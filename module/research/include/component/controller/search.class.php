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
class Research_Component_Controller_Search extends Phpfox_Component {

	public function process()
	{
		$iPage = $this->request()->getInt('page');

		$iPageSize = Phpfox::getParam('research.max_search_results_per_page');

		$sType = $this->request()->get('type', 'all');
		$sText = $this->request()->get('text', '');

		if (!$sText)
		{
			$sYear = $this->request()->get('year', '');
			$sMake = $this->request()->get('make', '');
			$sModel = $this->request()->get('model', '');
			$sBodyStyle = $this->request()->get('bodyStyle', '');

			list($aVideos, $iCnt) = Phpfox::getService('research')->searchVideosByFields($sYear, $sMake, $sModel, $sBodyStyle, $sType, $iPage, $iPageSize);
		}
		else
		{
			list($aVideos, $iCnt) = Phpfox::getService('research')->searchVideos($iPage, $iPageSize, $sText, $sType);
			
		}

		$this->template()
				->assign(array(
					'aVideos' => $aVideos))
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
				));

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));

	}

}

?>