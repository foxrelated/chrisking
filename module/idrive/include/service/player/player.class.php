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
class Idrive_Service_Player_Player extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_idrive_players');
		$this->_tBrightcove = Phpfox::getT('ko_brightcove');
	}


	/**
	 * Get videos based on AdminCP settings
	 * 
	 * @param type $iPlayerId
	 * @return type array
	 */
	public function getExternalVideos($sVideoRefId, $bAllowNew2U, $bAllow1onOne, $bAllowTop200, $bAllowPOV)
	{
		$aVideo = Phpfox::getService('dvs.video')->get($sVideoRefId);
		if (!empty($aVideo))
		{
			return array($aVideo);
		}

		$aMakes = array();
		$aMakes[]['make'] = $aVideo['make'];

		$aFilters = array();

		$aAllowedYears = Phpfox::getParam('idrive.vf_playlist_allowed_years');
		if ($aAllowedYears)
		{
			$iLoops = 0;
			$sWhere = '(';
			foreach ($aAllowedYears as $sYear)
			{
				$iLoops++;
				$sWhere .= 'year = "' . $sYear . '"';
				if (count($aAllowedYears) > $iLoops)
				{
					$sWhere .= ' OR ';
				}
				else
				{
					$sWhere .= ')';
				}
			}
			$aFilters[] = $sWhere;
		}

		if (!$bAllow1onOne)
		{
			$aFilters[] = 'AND referenceId NOT LIKE "1onONE%"';
		}

		if (!$bAllowTop200)
		{
			$aFilters[] = 'AND referenceId NOT LIKE "Top200%"';
		}

		if (!$bAllowPOV)
		{
			$aFilters[] = 'AND referenceId NOT LIKE "POV%"';
		}

		if (!$bAllowNew2U)
		{
			$aFilters[] = 'AND referenceId NOT LIKE "New2U%"';
		}

		$aVideos = array();

		foreach ($aMakes as $aMake)
		{
			$aWhere = array_merge($aFilters, array('AND make = "' . $this->preParse()->clean($aMake['make']) . '"'));

			$aRows = $this->database()
				->select('*')
				->from($this->_tBrightcove)
				->order('year DESC')
				->where($aWhere)
				->limit(Phpfox::getParam('idrive.vf_playlist_max_videos_per_make'))
				->execute('getRows');

			if ($aRows)
			{
				$aVideos[] = $aRows;
			}
		}

		$aExternalVideos = Phpfox::getService('dvs.video')->limitVideos($aVideos, Phpfox::getParam('idrive.vf_playlist_max_videos'));
		return Phpfox::getService('dvs.video')->sortVideos($aExternalVideos, Phpfox::getParam('idrive.vf_playlist_round_robin'));
	}


	/**
	 * Get videos based on AdminCP settings
	 * 
	 * @param type $iPlayerId
	 * @return type array
	 */
	public function getVideos($iPlayerId, $aSelectedMakes = null)
	{
		if ($aSelectedMakes)
		{
			$aMakes = array();
			foreach ($aSelectedMakes as $sMake)
			{
				$aMakes[]['make'] = $sMake;
			}
		}
		else
		{
			$aPlayer = $this->get($iPlayerId);
			$aMakes = $aPlayer['makes'];
		}

		$aFilters = array();

		$aAllowedYears = Phpfox::getParam('idrive.vf_playlist_allowed_years');
		if ($aAllowedYears)
		{
			$iLoops = 0;
			$sWhere = '(';
			foreach ($aAllowedYears as $sYear)
			{
				$iLoops++;
				$sWhere .= 'year = "' . $sYear . '"';
				if (count($aAllowedYears) > $iLoops)
				{
					$sWhere .= ' OR ';
				}
				else
				{
					$sWhere .= ')';
				}
			}
			$aFilters[] = $sWhere;
		}

		if (!Phpfox::getParam('idrive.vf_playlist_allow_1onone'))
		{
			$aFilters[] = 'AND referenceId NOT LIKE "1onONE%"';
		}

		if (!Phpfox::getParam('idrive.vf_playlist_allow_top200'))
		{
			$aFilters[] = 'AND referenceId NOT LIKE "Top200%"';
		}

		if (!Phpfox::getParam('idrive.vf_playlist_allow_pov'))
		{
			$aFilters[] = 'AND referenceId NOT LIKE "POV%"';
		}

		if (!Phpfox::getParam('idrive.vf_playlist_allow_new2u'))
		{
			$aFilters[] = 'AND referenceId NOT LIKE "New2U%"';
		}

		$aVideos = array();

		foreach ($aMakes as $aMake)
		{
			$aWhere = array_merge($aFilters, array('AND make = "' . $this->preParse()->clean($aMake['make']) . '"'));

			$aRows = $this->database()
				->select('*')
				->from($this->_tBrightcove)
				->order('year DESC')
				->where($aWhere)
				->limit(Phpfox::getParam('idrive.vf_playlist_max_videos_per_make'))
				->execute('getRows');

			if ($aRows)
			{
				$aVideos[] = $aRows;
			}
		}
		$aOverviewVideos = Phpfox::getService('dvs.video')->limitVideos($aVideos, Phpfox::getParam('idrive.vf_playlist_max_videos'));
		return Phpfox::getService('dvs.video')->sortVideos($aOverviewVideos, Phpfox::getParam('idrive.vf_playlist_round_robin'));
	}


	public function listPlayers($iPage, $iPageSize, $iUserId, $bPaginate = true)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$iUserId = (int) $iUserId;

		if ($bPaginate)
		{
			if ($iUserId)
			{
				$this->database()->where('user_id =' . $iUserId);
			}
			$iCnt = $this->database()->select('COUNT(*)')
				->from($this->_sTable)
				->execute('getField');

			$this->database()->limit($iPage, $iPageSize, $iCnt);
		}

		if ($iUserId)
		{
			$this->database()->where('p.user_id =' . $iUserId);
		}

		$aPlayers = $this->database()
			->select('*, ' . Phpfox::getUserField())
			->from($this->_sTable, 'p')
			->leftjoin(Phpfox::getT('ko_idrive_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_idrive_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = p.user_id')
			->execute('getRows');

		if ($aPlayers)
		{
			foreach ($aPlayers as $iKey => $aPlayer)
			{
				$aPlayers[$iKey]['makes'] = $this->database()
					->select('*')
					->from(Phpfox::getT('ko_idrive_player_makes'), 'm')
					->where('m.player_id =' . (int) $aPlayer['player_id'])
					->execute('getRows');
			}
		}

		if ($bPaginate)
		{
			return array($aPlayers, $iCnt);
		}
		else
		{
			return $aPlayers;
		}
	}


	/**
	 * Returns a player by Player ID
	 * 
	 * @param type $iPlayerId
	 * @return type
	 */
	public function get($iPlayerId)
	{
		$iPlayerId = (int) $iPlayerId;

		$aPlayer = $this->database()
			->select('*')
			->from($this->_sTable, 'p')
			->leftjoin(Phpfox::getT('ko_idrive_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_idrive_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->where('p.player_id =' . (int) $iPlayerId)
			->execute('getRow');

		// Does this player have a preroll file?
		// This table should have been set to null
		if($aPlayer['preroll_file_id'] == 0){
			$aPlayer['preroll_file_id'] = null;
		}
		
		if ($aPlayer)
		{
			$aPlayer['makes'] = $this->database()
				->select('*')
				->from(Phpfox::getT('ko_idrive_player_makes'), 'm')
				->where('m.player_id =' . (int) $iPlayerId)
				->execute('getRows');
		}

		return $aPlayer;
	}


}

?>