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
class Dvs_Service_Invite_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tInvite = Phpfox::getT('ko_dvs_salesteam_invites');
	}


	/**
	 * Add a sales team invite
	 * 
	 * @param int $iDvsId
	 * @param int $sEmail
	 * @return int, invite id
	 */
	public function add($iDvsId, $sEmail)
	{
		$iInviteId = $this->database()->insert($this->_tInvite, array(
			'dvs_id' => (int) $iDvsId,
			'email_address' => $this->preParse()->clean($sEmail)
		));

		return $iInviteId;
	}


	/**
	 * Removes a sales team invite from the list of invites as well as from any user who has selected this invite
	 * 
	 * @param int $iInviteId
	 */
	public function remove($iInviteId)
	{
		$this->database()->delete($this->_tInvite, 'invite_id = ' . (int) $iInviteId);
	}


}

?>