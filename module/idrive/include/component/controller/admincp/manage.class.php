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
 * @package 		iDrive
 */
class Idrive_Component_Controller_Admincp_Manage extends Phpfox_Component {

	public function process()
	{
		$iPage = $this->request()->getInt('page');
		$iPageSize = 10;

		list($aPlayers, $iCnt) = Phpfox::getService('idrive.player')->listPlayers($iPage, $iPageSize, 0, true);

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
					'sIdriveUrl' => Phpfox::getParam('core.url_file') . 'idrive/'
				))
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
				))
				->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'));

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));
	}


}

?>