<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		DVS
 */
class Dvs_Service_Salesteam_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tSalesTeam = Phpfox::getT('ko_dvs_salesteam');
	}


	/**
	 * Add a sales team member
	 * 
	 * @param int $iDvsId
	 * @param int $iUserId
	 * @return int, salesteam id
	 */
	public function inviteSalesChange($iUserId,$Email)
	{
		$aInvites = $this->database()->select('i.*')
				->from(Phpfox::getT('ko_dvs_salesteam_invites'),'i')
				->where('i.email_address = "'. $Email.'" AND i.manager_invite = 0')
				->execute('getSlaveRow');
				
		$iSalesteamId = $this->database()->insert($this->_tSalesTeam, array(
			'dvs_id' => (int) $aInvites['dvs_id'],
			'user_id' => (int) $iUserId
		));
		
		$this->database()->delete(Phpfox::getT('ko_dvs_salesteam_invites'), 'invite_id = ' . (int) $aInvites['invite_id']);
		
		Phpfox::setCookie('salesteam_invite', 0, '-1');
		return true;
	}
	public function add($iDvsId, $iUserId)
	{
		$iSalesteamId = $this->database()->insert($this->_tSalesTeam, array(
			'dvs_id' => (int) $iDvsId,
			'user_id' => (int) $iUserId
		));

		return $iSalesteamId;
	}


	/**
	 * Removes a sales team member from the list of salesteams as well as from any user who has selected this salesteam
	 * 
	 * @param int $iTeamMemberId
	 */
	public function remove($iTeamMemberId)
	{
		$this->database()->delete($this->_tSalesTeam, 'salesteam_id = ' . (int) $iTeamMemberId);
	}


}

?>