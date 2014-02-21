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
class Idrive_Service_Player_Process extends Phpfox_Service
{

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_idrive_players');
	}

	public function add($aVals)
	{
		$oParseInput = Phpfox::getLib('parse.input');

		$iPlayerId = $this->database()
				->insert($this->_sTable, array(
			'user_id' => Phpfox::getUserId(),
			'player_name' => $oParseInput->clean($aVals['player_name'], 255),
			'player_type' => (int) $aVals['player_type'],
			'domain' => $oParseInput->clean($aVals['domain'], 255),
			'logo_file_id' => !empty($aVals['logo_file_id']) ? (int) $aVals['logo_file_id'] : 0,
			'preroll_file_id' => (int) $aVals['preroll_file_id'],
			'logo_branding_url' => !empty($aVals['logo_branding_url']) ? $oParseInput->clean($aVals['logo_branding_url'], 255) : 0,
			'preroll_url' => $oParseInput->clean($aVals['preroll_url'], 255),
			'player_background' => $oParseInput->clean($aVals['player_background'], 6),
			'player_text' => $oParseInput->clean($aVals['player_text'], 6),
			'player_buttons' => $oParseInput->clean($aVals['player_buttons'], 6),
			'player_progress_bar' => $oParseInput->clean($aVals['player_progress_bar'], 6),
			'player_button_icons' => $oParseInput->clean($aVals['player_button_icons'], 6),
			'playlist_arrows' => $oParseInput->clean($aVals['playlist_arrows'], 6),
			'playlist_border' => $oParseInput->clean($aVals['playlist_border'], 6),
			'google_id' => $oParseInput->clean($aVals['google_id'], 16),
			'email' => $oParseInput->clean($aVals['email'], 255),
			'featured_make' => $oParseInput->clean($aVals['featured_make'], 64),
			'featured_year' => $oParseInput->clean($aVals['featured_year'], 4),
			'featured_model' => $oParseInput->clean($aVals['featured_model'], 64),
			'autoplay' => (isset($aVals['autoplay']) && $aVals['autoplay'] ? 1 : 0),
			'autoadvance' => (isset($aVals['autoadvance']) && $aVals['autoadvance'] ? 1 : 0),
			'timestamp' => PHPFOX_TIME
		));

		if ($aVals['preroll_duration'])
		{
			$this->database()
					->update(Phpfox::getT('ko_idrive_preroll_files'), array(
						'preroll_duration' => (int) $aVals['preroll_duration']), 'preroll_id =' . (int) $aVals['preroll_file_id']);
		}

		//Add makes to player
		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
		{
			if ($bSelected)
			{
				$this->addMakeToPlayer($iPlayerId, $sMake);
			}
		}

		return $iPlayerId;
	}

	public function update($aVals)
	{
		$aPlayer = Phpfox::getService('idrive.player')->get((int) $aVals['player_id']);

		if ($aPlayer['user_id'] != Phpfox::getUserId() && !Phpfox::isAdmin())
			return false;

		if (!empty($aVals['logo_file_id']) && $aPlayer['logo_file_id'] != (int) $aVals['logo_file_id'])
		{
			Phpfox::getService('idrive.file.process')->removeLogo($aPlayer['logo_file_id']);
		}

		if ($aPlayer['preroll_file_id'] != (int) $aVals['preroll_file_id'])
		{
			Phpfox::getService('idrive.file.process')->removePreroll($aPlayer['preroll_file_id']);
		}

		$oParseInput = Phpfox::getLib('parse.input');

		$this->database()
				->update($this->_sTable, array(
					'user_id' => Phpfox::getUserId(),
					'player_name' => $oParseInput->clean($aVals['player_name'], 255),
					'player_type' => (int) $aVals['player_type'],
					'domain' => $oParseInput->clean($aVals['domain'], 255),
					'logo_file_id' => !empty($aVals['logo_file_id']) ? (int) $aVals['logo_file_id'] : 0,
					'preroll_file_id' => (int) $aVals['preroll_file_id'],
					'logo_branding_url' => !empty($aVals['logo_branding_url']) ? $oParseInput->clean($aVals['logo_branding_url'], 255) : 0,
					'preroll_url' => $oParseInput->clean($aVals['preroll_url'], 255),
					'player_background' => $oParseInput->clean($aVals['player_background'], 6),
					'player_text' => $oParseInput->clean($aVals['player_text'], 6),
					'player_buttons' => $oParseInput->clean($aVals['player_buttons'], 6),
					'player_progress_bar' => $oParseInput->clean($aVals['player_progress_bar'], 6),
					'player_button_icons' => $oParseInput->clean($aVals['player_button_icons'], 6),
					'playlist_arrows' => $oParseInput->clean($aVals['playlist_arrows'], 6),
					'playlist_border' => $oParseInput->clean($aVals['playlist_border'], 6),
					'google_id' => $oParseInput->clean($aVals['google_id'], 16),
					'email' => $oParseInput->clean($aVals['email'], 255),
					'featured_make' => $oParseInput->clean($aVals['featured_make'], 64),
					'featured_year' => $oParseInput->clean($aVals['featured_year'], 4),
					'featured_model' => $oParseInput->clean($aVals['featured_model'], 64),
					'autoplay' => (isset($aVals['autoplay']) && $aVals['autoplay'] ? 1 : 0),
					'autoadvance' => (isset($aVals['autoadvance']) && $aVals['autoadvance'] ? 1 : 0),
					'timestamp' => PHPFOX_TIME
						), 'player_id =' . (int) $aVals['player_id']);

		if ($aVals['preroll_duration'])
		{
			$this->database()
					->update(Phpfox::getT('ko_idrive_preroll_files'), array(
						'preroll_duration' => (int) $aVals['preroll_duration']), 'preroll_id =' . (int) $aVals['preroll_file_id']);
		}

		//Update makes
		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
		{
			if ($bSelected)
			{
				$iPlayerMakeId = $this->database()->select('pmake_id')
						->from(Phpfox::getT('ko_idrive_player_makes'))
						->where('player_id = ' . (int) $aVals['player_id'] . ' AND make = "' . $sMake . '"')
						->execute('getField');

				if (!$iPlayerMakeId)
				{
					$this->addMakeToplayer($aVals['player_id'], $sMake);
				}
			}
			else
			{
				$this->removeMakeFromPlayer($aVals['player_id'], $sMake);
			}
		}

		return true;
	}

	public function remove($iPlayerId)
	{
		$iPlayerId = (int) $iPlayerId;

		$aPlayer = Phpfox::getService('idrive.player')->get($iPlayerId);

		if ($aPlayer['user_id'] == Phpfox::getUserId() || Phpfox::isAdmin())
		{
			Phpfox::getService('idrive.file.process')->removeLogo($aPlayer['logo_file_id']);
			Phpfox::getService('idrive.file.process')->removePreroll($aPlayer['preroll_file_id']);

			$this->database()->delete($this->_sTable, 'player_id =' . $iPlayerId);

			$this->database()->delete(Phpfox::getT('ko_idrive_player_makes'), 'player_id =' . $iPlayerId);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function addMakeToPlayer($iPlayerId, $sMake)
	{
		return $this->database()->insert(Phpfox::getT('ko_idrive_player_makes'), array(
					'player_id' => (int) $iPlayerId,
					'make' => Phpfox::getLib('parse.input')->clean($sMake)
		));
	}

	public function removeMakeFromPlayer($iPlayerId, $sMake)
	{
		return $this->database()->delete(Phpfox::getT('ko_idrive_player_makes'), 'player_id = ' . (int) $iPlayerId . ' AND make = "' . Phpfox::getLib('parse.input')->clean($sMake) . '"');
	}

}

?>