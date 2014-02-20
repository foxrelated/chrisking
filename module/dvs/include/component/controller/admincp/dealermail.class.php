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
class Dvs_Component_Controller_Admincp_Dealermail extends Phpfox_Component {

	public function process()
	{
		$iPage = $this->request()->getInt('page');
		$iPageSize = 10;

		list($aStats, $iCnt) = Phpfox::getService('dvs')->listDvss($iPage, $iPageSize, 0, true);

		$this->template()
				->assign(array(
					'aStats' => $aStats
				))
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
				))
				->setBreadcrumb(Phpfox::getPhrase('dvs.contact_stats'));

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));

	}

}

?>