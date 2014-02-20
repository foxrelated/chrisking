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
class Idrive_Component_Controller_Code extends Phpfox_Component {

	public function process()
	{
		$iId = $this->request()->getInt('id');
		$sAction = $this->request()->get('action', false);

		if ($sAction == 'add')
		{
			$sMessage = Phpfox::getPhrase('idrive.player_added_successfully');
		}
		else if ($sAction == 'save')
		{
			$sMessage = Phpfox::getPhrase('idrive.player_saved_successfully');
		}
		else
		{
			$sMessage = null;
		}

		$aPlayer = Phpfox::getService('idrive.player')->get($iId);

		$this->template()
				->assign(array(
					'aPlayer' => $aPlayer,
					'sMessage' => $sMessage
				))
				->setBreadcrumb(Phpfox::getPhrase('idrive.my_players'), Phpfox::getLib('url')->makeUrl('idrive'))
				->setBreadcrumb($aPlayer['player_name'], false)
				->setBreadcrumb(Phpfox::getPhrase('idrive.get_code'));

	}

}

?>