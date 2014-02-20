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
class Dvs_Component_Controller_Admincp_Manage extends Phpfox_Component {

	public function process()
	{
		$iPage = $this->request()->getInt('page');
		$iPageSize = 10;

		list($aPlayers, $iCnt) = Phpfox::getService('dvs.player')->listPlayers($iPage, $iPageSize, 0, true);

		if (Phpfox::getParam('dvs.enable_subdomain_mode'))
		{
			$sSwfUrl = Phpfox::getLib('url')->makeUrl('www.module.dvs.static.swf');
		}
		else
		{
			$sSwfUrl = Phpfox::getLib('url')->makeUrl('module.dvs.static.swf');
		}

		$this->template()
				->assign(array(
					'aPlayers' => $aPlayers,
					'sSwfUrl' => $sSwfUrl,
					'sDvsUrl' => Phpfox::getParam('core.url_file') . 'dvs/'
				))
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
				))
				->setBreadcrumb(Phpfox::getPhrase('dvs.my_players'), Phpfox::getLib('url')->makeUrl('dvs'));

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));
	}


}

?>