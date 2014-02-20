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
class Idrive_Component_Block_Plugins_Register extends Phpfox_Component {

	public function process()
	{
		$this->template()
			->assign(array(
				'aUserTypes' => Phpfox::getService('idrive')->getUserGroups(),
				'iSalesTeamUserGroup' => Phpfox::getParam('dvs.salesteam_usergroup_id'),
				'iDealerUserGroup' => Phpfox::getParam('dvs.dealer_usergroup_id'),
				'bSalesTeamInvite' => $this->request()->get('salesteam')
		));
	}


}

?>