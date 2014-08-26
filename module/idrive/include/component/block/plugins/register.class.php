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
		/*phpmasterminds Customization on June 5th 2014*/
		$salesteam_invite = false;
		if (!Phpfox::getCookie('salesteam_invite')) {
			/*$iExpire = (Phpfox::getParam('invite.invite_expire') > 0 ? (Phpfox::getParam('invite.invite_expire')*60*60*24) : (7*60*60*24));
					
			Phpfox::setCookie('salesteam_invite', null, PHPFOX_TIME + $iExpire);
			$salesteam_invite = true;*/
		} else {
			$salesteam_invite = true;
		}

        if (!Phpfox::getCookie('managersteam_invite')) {
            $iExpire = (Phpfox::getParam('invite.invite_expire') > 0 ? (Phpfox::getParam('invite.invite_expire')*60*60*24) : (7*60*60*24));

            Phpfox::setCookie('managersteam_invite', null, PHPFOX_TIME + $iExpire);
            $managersteam_invite = true;
        } else {
            $managersteam_invite = true;
        }
		/*phpmasterminds Customization on June 5th 2014*/
		$this->template()
			->assign(array(
				'aUserTypes' => Phpfox::getService('idrive')->getUserGroups(),
				'iSalesTeamUserGroup' => Phpfox::getParam('dvs.salesteam_usergroup_id'),
                'iManagerTeamUserGroup' => Phpfox::getParam('dvs.managerteam_usergroup_id'),
				'iDealerUserGroup' => Phpfox::getParam('dvs.dealer_usergroup_id'),
				'bSalesTeamInvite' => $this->request()->get('salesteam'),
                'bManagerTeamInvite' => $this->request()->get('managersteam'),
				'salesteam_invite' => $salesteam_invite,
                'managersteam_invite' => $managersteam_invite
		));
	}


}

?>