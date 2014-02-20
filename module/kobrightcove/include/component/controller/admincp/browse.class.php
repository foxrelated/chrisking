<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	Konsort.org
 * @author  		Konsort.org
 * @package 		KOBrightcove
 */
class Kobrightcove_Component_Controller_Admincp_Browse extends Phpfox_Component {

	public function process()
	{
		$iPage = $this->request()->getInt('page');

		$iPageBc = $iPage;

		if ($iPage > 0) $iPageBc = $iPage - 1;

		$iPageSize = 10;

		$aVideos = array();

		list($aVideosRaw, $iCnt) = Phpfox::getService('kobrightcove')->browse($iPage, $iPageSize);

		foreach ($aVideosRaw as $key => $aValue)
		{
			$aTemp = $aValue;
			$aTemp['creationDate'] = date('m/d/Y H:i:s', substr($aTemp['creationDate'], 0, -3));
			$aTemp['tags'] = str_replace(',', '<br /><br />', $aTemp['tags']);
			$aVideos[$key] = $aTemp;
		}

		$this->template()
				->setBreadcrumb('Browse Videos')
				->assign(array(
					'aVideos' => $aVideos))
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
						)
		);

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));

	}

}

?>