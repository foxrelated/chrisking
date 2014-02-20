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
 * @package 		iDrive
 */
class Idrive_Service_Idrive extends Phpfox_Service {

	public function __construct()
	{
		
	}


	public function getUserGroups()
	{
		$aConds = array(
			'title != "Administrator" AND ',
			'title != "Registered User" AND',
			'title != "Staff" AND',
			'title != "Banned" AND',
			'title != "Musician" AND',
			'title != "Guest"'
		);
		$aUserGroups = Phpfox::getService('user.group')->get($aConds);

		$aReturn = array();
		foreach ($aUserGroups as $aUserGroup)
		{
			$aReturn[$aUserGroup['user_group_id']] = $aUserGroup['title'];
		}
		return $aReturn;
	}


	public function getMakes()
	{
		return $this->database()
				->select('DISTINCT make')
				->from(Phpfox::getT('ko_brightcove'))
				->order('make')
				->execute('getRows');
	}


	public function hasAccess($iId, $iUserId, $sIdSource = '')
	{
		if (Phpfox::isAdmin())
		{
			return true;
		}

		if (!$iId || !$iUserId)
		{
			return false;
		}

		if ($sIdSource == '')
		{
			$aDvs = $this->get($iId, false);

			if ($aDvs['user_id'] == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'logo')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_idrive_logo_files'))
				->where('logo_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		if ($sIdSource == 'preroll')
		{
			$iOwnerId = $this->database()
				->select('user_id')
				->from(Phpfox::getT('ko_idrive_preroll_files'))
				->where('preroll_id = ' . (int) $iId)
				->execute('getField');

			if ($iOwnerId == $iUserId)
			{
				return true;
			}
		}

		return false;
	}


}

?>