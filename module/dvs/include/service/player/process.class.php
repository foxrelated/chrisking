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
class Dvs_Service_Player_Process extends Phpfox_Service
{

	public function __construct()
	{
        $this->_sTable = Phpfox::getT('ko_dvs_players');
		$this->_stTable = Phpfox::getT('ko_dvs');
	}

	public function add($aVals)
	{
		$oParseInput = Phpfox::getLib('parse.input');
        
        $aValst['player_type'] = $aVals['player_st_type'];
        $this->database()->update($this->_stTable, $aValst, 'dvs_id = ' . (int) $aVals['dvs_id']);
        
        if($aVals['custom_overlay_1_type'] == 3){
            $aVals['custom_overlay_1_text'] = $aVals['image_overlay1_file_path'];
        }
        if($aVals['custom_overlay_2_type'] == 3){
            $aVals['custom_overlay_2_text'] = $aVals['image_overlay2_file_path'];
        }
        if($aVals['custom_overlay_3_type'] == 3){
            $aVals['custom_overlay_3_text'] = $aVals['image_overlay3_file_path'];
        }
        
		$iPlayerId = $this->database()
				->insert($this->_sTable, array(
			'dvs_id' => (int) $aVals['dvs_id'],
//			'player_name' => $oParseInput->clean($aVals['player_name'], 255),
            'player_type' => (int) $aVals['player_type'],
			'domain' => $oParseInput->clean($aVals['domain'], 255),
//			'logo_file_id' => (int) $aVals['logo_file_id'],
			'preroll_file_id' => (int) $aVals['preroll_file_id'],
//			'logo_branding_url' => $oParseInput->clean($aVals['logo_branding_url'], 255),
			'preroll_url' => $oParseInput->clean($aVals['preroll_url'], 255),
			'player_background' => $oParseInput->clean($aVals['player_background'], 6),
			'player_text' => $oParseInput->clean($aVals['player_text'], 6),
			'player_buttons' => $oParseInput->clean($aVals['player_buttons'], 6),
			'player_progress_bar' => $oParseInput->clean($aVals['player_progress_bar'], 6),
			'player_button_icons' => $oParseInput->clean($aVals['player_button_icons'], 6),
			'playlist_arrows' => $oParseInput->clean($aVals['playlist_arrows'], 6),
			'playlist_border' => $oParseInput->clean($aVals['playlist_border'], 6),
			'featured_make' => $oParseInput->clean($aVals['featured_make'], 64),
			'featured_year' => $oParseInput->clean($aVals['featured_year'], 4),
			'featured_model' => $oParseInput->clean($aVals['featured_model'], 64),
			'autoplay' => (isset($aVals['autoplay']) && $aVals['autoplay'] ? 1 : 0),
			'autoplay_baseurl' => (isset($aVals['autoplay_baseurl']) && $aVals['autoplay_baseurl'] ? 1 : 0),//phpmasterminds
			'autoplay_videourl' => (isset($aVals['autoplay_videourl']) && $aVals['autoplay_videourl'] ? 1 : 0),//phpmasterminds
			'autoadvance' => (isset($aVals['autoadvance']) && $aVals['autoadvance'] ? 1 : 0),
			'custom_overlay_1_type' => (int) $aVals['custom_overlay_1_type'],
			'custom_overlay_1_text' => $oParseInput->clean($aVals['custom_overlay_1_text'], 255),
			'custom_overlay_1_url' => $oParseInput->clean($aVals['custom_overlay_1_url'], 255),
			'custom_overlay_1_start' => (int) $aVals['custom_overlay_1_start'],
			'custom_overlay_1_duration' => (int) $aVals['custom_overlay_1_duration'],
			'custom_overlay_2_type' => (int) $aVals['custom_overlay_2_type'],
			'custom_overlay_2_text' => $oParseInput->clean($aVals['custom_overlay_2_text'], 255),
			'custom_overlay_2_url' => $oParseInput->clean($aVals['custom_overlay_2_url'], 255),
			'custom_overlay_2_start' => (int) $aVals['custom_overlay_2_start'],
			'custom_overlay_2_duration' => (int) $aVals['custom_overlay_2_duration'],
			'custom_overlay_3_type' => (int) $aVals['custom_overlay_3_type'],
			'custom_overlay_3_text' => $oParseInput->clean($aVals['custom_overlay_3_text'], 255),
			'custom_overlay_3_url' => $oParseInput->clean($aVals['custom_overlay_3_url'], 255),
			'custom_overlay_3_start' => (int) $aVals['custom_overlay_3_start'],
			'custom_overlay_3_duration' => (int) $aVals['custom_overlay_3_duration'],
            'video_endscreen_iframe' => (int) $aVals['video_endscreen_iframe'],
            'video_endscreen_iframe_cform' => (int) $aVals['video_endscreen_iframe_cform'],
            'video_endscreen_iframe_inventory' => (int) $aVals['video_endscreen_iframe_inventory'],
            'video_endscreen_overlay' => (int) $aVals['video_endscreen_overlay'],
            'video_endscreen_overlay_cform' => (int) $aVals['video_endscreen_overlay_cform'],
            'video_endscreen_overlay_inventory' => (int) $aVals['video_endscreen_overlay_inventory'],
            'video_endscreen_inventory' => (int) $aVals['video_endscreen_inventory'],
            'video_endscreen_inventory_cform' => (int) $aVals['video_endscreen_inventory_cform'],
            'video_endscreen_inventory_inventory' => (int) $aVals['video_endscreen_inventory_inventory'],
            'video_endscreen_mobile' => (int) $aVals['video_endscreen_mobile'],
            'video_endscreen_mobile_cform' => (int) $aVals['video_endscreen_mobile_cform'],
            'video_endscreen_mobile_inventory' => (int) $aVals['video_endscreen_mobile_inventory'],
            'video_endscreen_player' => (int) $aVals['video_endscreen_player'],
            'video_endscreen_player_cform' => (int) $aVals['video_endscreen_player_cform'],
            'video_endscreen_player_inventory' => (int) $aVals['video_endscreen_player_inventory'],
			'timestamp' => PHPFOX_TIME
		));




		if ($aVals['preroll_duration'])
		{
			$this->database()
					->update(Phpfox::getT('ko_dvs_preroll_files'), array(
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
        
		$aPlayer = Phpfox::getService('dvs.player')->get((int) $aVals['player_id']);
        $aValst['player_type'] = $aVals['player_st_type'];
        $this->database()->update($this->_stTable, $aValst, 'dvs_id = ' . (int) $aVals['dvs_id']);
		
		//if ($aPlayer['user_id'] != Phpfox::getUserId() && !Phpfox::isAdmin()) return false;
		// Do we need to remove our old logo file?
		if (!empty($aPlayer['logo_file_id']) && !empty($aVals['logo_file_id']) && $aPlayer['logo_file_id'] != (int) $aVals['logo_file_id'])
		{
			Phpfox::getService('dvs.file.process')->removeLogo($aPlayer['logo_file_id']);
		}

		if (isset($aPlayer['preroll_file_id']) && $aPlayer['preroll_file_id'] != (int) $aVals['preroll_file_id'])
		{
			Phpfox::getService('dvs.file.process')->removePreroll($aPlayer['preroll_file_id']);
		}
        
        if($aVals['custom_overlay_1_type'] == 3){
            $aVals['custom_overlay_1_text'] = $aVals['image_overlay1_file_path'];
        }
        if($aVals['custom_overlay_2_type'] == 3){
            $aVals['custom_overlay_2_text'] = $aVals['image_overlay2_file_path'];
        }
        if($aVals['custom_overlay_3_type'] == 3){
            $aVals['custom_overlay_3_text'] = $aVals['image_overlay3_file_path'];
        }
		$oParseInput = Phpfox::getLib('parse.input');
		$this->database()
				->update($this->_sTable, array(
					'dvs_id' => (int) $aVals['dvs_id'],
//				'player_name' => $oParseInput->clean($aVals['player_name'], 255),
                    'player_type' => (int) $aVals['player_type'],
					'domain' => $oParseInput->clean($aVals['domain'], 255),
//				'logo_file_id' => (int) $aVals['logo_file_id'],
					'preroll_file_id' => (int) $aVals['preroll_file_id'],
//				'logo_branding_url' => $oParseInput->clean($aVals['logo_branding_url'], 255),
					'preroll_url' => $oParseInput->clean($aVals['preroll_url'], 255),
					'player_background' => $oParseInput->clean($aVals['player_background'], 6),
					'player_text' => $oParseInput->clean($aVals['player_text'], 6),
					'player_buttons' => $oParseInput->clean($aVals['player_buttons'], 6),
					'player_progress_bar' => $oParseInput->clean($aVals['player_progress_bar'], 6),
					'player_button_icons' => $oParseInput->clean($aVals['player_button_icons'], 6),
					'playlist_arrows' => $oParseInput->clean($aVals['playlist_arrows'], 6),
					'playlist_border' => $oParseInput->clean($aVals['playlist_border'], 6),
					'featured_make' => $oParseInput->clean($aVals['featured_make'], 64),
					'featured_year' => $oParseInput->clean($aVals['featured_year'], 4),
					'featured_model' => $oParseInput->clean($aVals['featured_model'], 64),
					'autoplay' => (isset($aVals['autoplay']) && $aVals['autoplay'] ? 1 : 0),
					'autoplay_baseurl' => (isset($aVals['autoplay_baseurl']) && $aVals['autoplay_baseurl'] ? 1 : 0),//phpmasterminds
					'autoplay_videourl' => (isset($aVals['autoplay_videourl']) && $aVals['autoplay_videourl'] ? 1 : 0),//phpmasterminds
					'autoadvance' => (isset($aVals['autoadvance']) && $aVals['autoadvance'] ? 1 : 0),
					'custom_overlay_1_type' => (int) $aVals['custom_overlay_1_type'],
					'custom_overlay_1_text' => $oParseInput->clean($aVals['custom_overlay_1_text'], 255),
					'custom_overlay_1_url' => $oParseInput->clean($aVals['custom_overlay_1_url'], 255),
					'custom_overlay_1_start' => (int) $aVals['custom_overlay_1_start'],
					'custom_overlay_1_duration' => (int) $aVals['custom_overlay_1_duration'],
					'custom_overlay_2_type' => (int) $aVals['custom_overlay_2_type'],
					'custom_overlay_2_text' => $oParseInput->clean($aVals['custom_overlay_2_text'], 255),
					'custom_overlay_2_url' => $oParseInput->clean($aVals['custom_overlay_2_url'], 255),
					'custom_overlay_2_start' => (int) $aVals['custom_overlay_2_start'],
					'custom_overlay_2_duration' => (int) $aVals['custom_overlay_2_duration'],
					'custom_overlay_3_type' => (int) $aVals['custom_overlay_3_type'],
					'custom_overlay_3_text' => $oParseInput->clean($aVals['custom_overlay_3_text'], 255),
					'custom_overlay_3_url' => $oParseInput->clean($aVals['custom_overlay_3_url'], 255),
					'custom_overlay_3_start' => (int) $aVals['custom_overlay_3_start'],
					'custom_overlay_3_duration' => (int) $aVals['custom_overlay_3_duration'],
                    'video_endscreen_iframe' => (int) $aVals['video_endscreen_iframe'],
                    'video_endscreen_iframe_cform' => (int) $aVals['video_endscreen_iframe_cform'],
                    'video_endscreen_iframe_inventory' => (int) $aVals['video_endscreen_iframe_inventory'],
                    'video_endscreen_overlay' => (int) $aVals['video_endscreen_overlay'],
                    'video_endscreen_overlay_cform' => (int) $aVals['video_endscreen_overlay_cform'],
                    'video_endscreen_overlay_inventory' => (int) $aVals['video_endscreen_overlay_inventory'],
                    'video_endscreen_inventory' => (int) $aVals['video_endscreen_inventory'],
                    'video_endscreen_inventory_cform' => (int) $aVals['video_endscreen_inventory_cform'],
                    'video_endscreen_inventory_inventory' => (int) $aVals['video_endscreen_inventory_inventory'],
                    'video_endscreen_mobile' => (int) $aVals['video_endscreen_mobile'],
                    'video_endscreen_mobile_cform' => (int) $aVals['video_endscreen_mobile_cform'],
                    'video_endscreen_mobile_inventory' => (int) $aVals['video_endscreen_mobile_inventory'],
                    'video_endscreen_player' => (int) $aVals['video_endscreen_player'],
                    'video_endscreen_player_cform' => (int) $aVals['video_endscreen_player_cform'],
                    'video_endscreen_player_inventory' => (int) $aVals['video_endscreen_player_inventory'],
					'timestamp' => PHPFOX_TIME
						), 'player_id =' . (int) $aVals['player_id']);

		if (!empty($aVals['preroll_duration']))
		{
			$this->database()
					->update(Phpfox::getT('ko_dvs_preroll_files'), array(
						'preroll_duration' => (int) $aVals['preroll_duration']), 
						'preroll_id =' . (int) $aVals['preroll_file_id']
					);
		}


		//Update makes
		
		foreach ($aVals['selected_makes'] as $sMake => $bSelected)
		{
			
			
			if ($bSelected)
			{
				$iPlayerMakeId = $this->database()->select('pmake_id')
						->from(Phpfox::getT('ko_dvs_player_makes'))
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

	public function remove($iDvsId)
	{
		$iDvsId = (int) $iDvsId;

		$aPlayer = Phpfox::getService('dvs.player')->get($iDvsId);

		if ($aPlayer)
		{
			if ($aPlayer['logo_file_id'])
			{
				Phpfox::getService('dvs.file.process')->removeLogo($aPlayer['logo_file_id']);
			}
			if ($aPlayer['preroll_file_id'])
			{
				Phpfox::getService('dvs.file.process')->removePreroll($aPlayer['preroll_file_id']);
			}

			$this->database()->delete($this->_sTable, 'dvs_id =' . $iDvsId);

			$this->database()->delete(Phpfox::getT('ko_dvs_player_makes'), 'player_id =' . $aPlayer['player_id']);
		}

		return true;
	}

	public function addMakeToPlayer($iPlayerId, $sMake)
	{
		return $this->database()->insert(Phpfox::getT('ko_dvs_player_makes'), array(
					'player_id' => (int) $iPlayerId,
					'make' => Phpfox::getLib('parse.input')->clean($sMake)
		));
	}

	public function removeMakeFromPlayer($iPlayerId, $sMake)
	{
		return $this->database()->delete(Phpfox::getT('ko_dvs_player_makes'), 'player_id = ' . (int) $iPlayerId . ' AND make = "' . Phpfox::getLib('parse.input')->clean($sMake) . '"');
	}

}

?>