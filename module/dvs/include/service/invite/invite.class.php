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
class Dvs_Service_Invite_Invite extends Phpfox_Service {

	public function __construct()
	{
		$this->_tInvite = Phpfox::getT('ko_dvs_salesteam_invites');
	}


	/**
	 * Get invites for a sales team member
	 * 
	 * @param int $sEmailAddress
	 * @param $iDvsId, look up by dvs id and user_id
	 * @return array, team member
	 */
	public function getAll($sEmailAddress)
	{
		return $this->database()->select('i.*')
				->from($this->_tInvite, 'i')
				->where('i.email_address = "' . $this->preParse()->clean($sEmailAddress) . '"')
				->execute('getRows');
	}


	/**
	 * Get a specific invite for a sales team member
	 * 
	 * @param int $iDvsId
	 * @param string  $sEmailAddress
	 * @return array, invite
	 */
	public function get($iDvsId, $sEmailAddress)
	{
		return $this->database()->select('i.*')
				->from($this->_tInvite, 'i')
				->where('i.email_address = "' . $this->preParse()->clean($sEmailAddress) . '" AND i.dvs_id = ' . (int) $iDvsId)
				->execute('getRows');
	}


	public function onRegister($iUserId)
	{
		$sEmailAddress = $this->database()->select('u.email')
			->from(Phpfox::getT('user'), 'u')
			->where('u.user_id = ' . (int) $iUserId)
			->execute('getField');

		// Get any invites user might have

		$aInvites = $this->getAll($sEmailAddress);

		// Add member to the DVSs if he's not already a member
		foreach ($aInvites as $aInvite)
		{
			$aTeamMember = Phpfox::getService('dvs.salesteam')->get($iUserId, $aInvite['dvs_id']);
			if (empty($aTeamMember))
			{
				Phpfox::getService('dvs.salesteam.process')->add($aInvite['dvs_id'], $iUserId);
			}
		}
	}


}

?>