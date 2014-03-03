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
class Dvs_Service_Player_Player extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_players');
	}


	public function listPlayers($iPage, $iPageSize, $iDvsId, $bPaginate = true)
	{
		$iPage = (int) $iPage;
		$iPageSize = (int) $iPageSize;
		$iDvsId = (int) $iDvsId;

		if ($bPaginate)
		{
			if ($iDvsId)
			{
				$this->database()->where('dvs_id =' . $iDvsId);
			}

			$iCnt = $this->database()->select('COUNT(*)')
				->from($this->_sTable)
				->execute('getField');

			$this->database()->limit($iPage, $iPageSize, $iCnt);
		}

		if ($iDvsId)
		{
			$this->database()->where('p.dvs_id =' . $iDvsId);
		}

		$aPlayers = $this->database()
			->select('*')
			->from($this->_sTable, 'p')
			->leftjoin(Phpfox::getT('ko_dvs'), 'd', 'd.dvs_id = p.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->join(Phpfox::getT('user'), 'u', 'u.user_id = d.user_id')
			->execute('getRows');

		if ($aPlayers)
		{
			foreach ($aPlayers as $iKey => $aPlayer)
			{
				$aPlayers[$iKey]['makes'] = $this->database()
					->select('*')
					->from(Phpfox::getT('ko_dvs_player_makes'), 'm')
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
	 * Returns a player by DVS id
	 * 
	 * @param type $iDvsId
	 * @return type
	 */
	public function get($iDvsId)
	{
		$iDvsId = (int) $iDvsId;

		$aPlayer = $this->database()
			->select('*')
			->from($this->_sTable, 'p')
			->leftjoin(Phpfox::getT('ko_dvs'), 'd', 'd.dvs_id = p.dvs_id')
			->leftjoin(Phpfox::getT('ko_dvs_logo_files'), 'l', 'l.logo_id = p.logo_file_id')
			->leftjoin(Phpfox::getT('ko_dvs_preroll_files'), 'pr', 'pr.preroll_id = p.preroll_file_id')
			->where('p.dvs_id =' . (int) $iDvsId)
			->execute('getRow');

		if ($aPlayer)
		{
			$aPlayer['makes'] = $this->database()
				->select('make')
				->from(Phpfox::getT('ko_dvs_player_makes'), 'm')
				->where('m.player_id =' . (int) $aPlayer['player_id'])
				->execute('getRows');
		}
		
		return $aPlayer;
	}


	function hex2rgb($sHex)
	{
		$sHex = str_replace("#", "", $sHex);

		if (strlen($sHex) == 3)
		{
			$iRed = hexdec(substr($sHex, 0, 1) . substr($sHex, 0, 1));
			$iGreen = hexdec(substr($sHex, 1, 1) . substr($sHex, 1, 1));
			$iBlue = hexdec(substr($sHex, 2, 1) . substr($sHex, 2, 1));
		}
		else
		{
			$iRed = hexdec(substr($sHex, 0, 2));
			$iGreen = hexdec(substr($sHex, 2, 2));
			$iBlue = hexdec(substr($sHex, 4, 2));
		}
		$aRGB = array('r' => $iRed, 'g' => $iGreen, 'b' => $iBlue);
		return implode(",", $aRGB); // returns the rgb values separated by commas
	}


	public function getCss($aPlayer)
	{
		$oDvs = Phpfox::getService('dvs');

		$sCss = $oDvs->buildCss('.playlist-button', array(
			'background' => '#' . $aPlayer['playlist_arrows'],
		));

		$sCss .= $oDvs->buildCss('.playlist-button:hover', array(
			'background' => 'rgba(' . $this->hex2rgb($aPlayer['player_buttons']) . ',0.5)'
		));

		$sCss .= $oDvs->buildCss('.playlist-button:active', array(
			'background' => '#' . $aPlayer['player_buttons'],
		));

		$sCss .= $oDvs->buildCss('.playlist_carousel li', array(
			'background' => '#' . $aPlayer['player_background'],
			), true);

		$sCss .= $oDvs->buildCss('.playlist_container', array(
			'background' => '#' . $aPlayer['player_background'],
		));

		$sCss .= $oDvs->buildCss('#logo_branding_image', array(
			'background' => '#' . $aPlayer['player_background'],
		));

		$sCss .= $oDvs->buildCss('#chapter_buttons', array(
			'background' => '#' . $aPlayer['player_background'],
		));

		$sCss .= $oDvs->buildCss('#dvs_player_container', array(
			'width' => ($aPlayer['player_type'] ? '600' : '880') . 'px',
			'height' => ($aPlayer['player_type'] ? '340' : '522') . 'px',
			'background' => '#' . $aPlayer['player_background']
		));

		$sCss .= $oDvs->buildCss('.playlist_thumbnail_image_container', array(
			'background' => '#' . $aPlayer['playlist_border']
			), false, true);

		return $sCss;
	}

}

?>