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
class Idrive_Component_Controller_Index extends Phpfox_Component {

	public function process()
	{
		Phpfox::isUser(true);

		$iPage = $this->request()->getInt('page');
		$iPageSize = 20;

		list($aPlayers, $iCnt) = Phpfox::getService('idrive.player')->listPlayers($iPage, $iPageSize, Phpfox::getUserId());

		if ($iCnt < Phpfox::getUserParam('idrive.players'))
		{
			$bCanAddPlayers = true;
		}
		else
		{
			$bCanAddPlayers = false;
		}

		$this->template()
				->assign(array(
					'aPlayers' => $aPlayers,
					'bCanAddPlayers' => $bCanAddPlayers
				))
				->setBreadcrumb('My Players')
				->setHeader(
						'cache', array(
					'pager.css' => 'style_css'
				));

		Phpfox::getLib('pager')->set(array('page' => $iPage, 'size' => $iPageSize, 'count' => $iCnt));

	}

}

?>