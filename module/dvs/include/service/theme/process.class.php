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
class Dvs_Service_Theme_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_themes');
	}


	public function add($aTheme)
	{
		$this->database()->insert($this->_sTable, array(
			'theme_name' => $this->preParse()->clean($aTheme['theme_name']),
			'theme_menu_background' => $this->preParse()->clean($aTheme['theme_menu_background']),
			'theme_menu_link' => $this->preParse()->clean($aTheme['theme_menu_link']),
			'theme_page_background' => $this->preParse()->clean($aTheme['theme_page_background']),
			'theme_page_text' => $this->preParse()->clean($aTheme['theme_page_text']),
			'theme_button_background' => $this->preParse()->clean($aTheme['theme_button_background']),
			'theme_button_text' => $this->preParse()->clean($aTheme['theme_button_text']),
			'theme_button_top_gradient' => $this->preParse()->clean($aTheme['theme_button_top_gradient']),
			'theme_button_bottom_gradient' => $this->preParse()->clean($aTheme['theme_button_bottom_gradient']),
			'theme_button_border' => $this->preParse()->clean($aTheme['theme_button_border']),
			'theme_text_link' => $this->preParse()->clean($aTheme['theme_text_link']),
			'theme_footer_link' => $this->preParse()->clean($aTheme['theme_footer_link']),
            'player_background' => $this->preParse()->clean($aTheme['player_background']),
            'player_text' => $this->preParse()->clean($aTheme['player_text']),
            'player_buttons' => $this->preParse()->clean($aTheme['player_buttons']),
            'player_icons' => $this->preParse()->clean($aTheme['player_button_icons']),
            'player_progress_bar' => $this->preParse()->clean($aTheme['player_progress_bar']),
            'player_arrows' => $this->preParse()->clean($aTheme['player_thumbnail_arrows']),
            'player_thumbnail_border' => $this->preParse()->clean($aTheme['player_thumbnail_border']),
            'iframe_background' => $this->preParse()->clean($aTheme['iframe_background']),
            'iframe_text' => $this->preParse()->clean($aTheme['iframe_text']),
            'iframe_contact_background' => $this->preParse()->clean($aTheme['iframe_contact_background']),
            'iframe_contact_text' => $this->preParse()->clean($aTheme['iframe_contact_text']),
            'vin_top_gradient' => $this->preParse()->clean($aTheme['vin_top_gradient']),
            'vin_bottom_gradient' => $this->preParse()->clean($aTheme['vin_bottom_gradient']),
            'vin_text_color' => $this->preParse()->clean($aTheme['vin_text_color'])
		));
	}


	public function update($aTheme)
	{
		$this->database()->update($this->_sTable, array(
			'theme_name' => $this->preParse()->clean($aTheme['theme_name']),
			'theme_menu_background' => $this->preParse()->clean($aTheme['theme_menu_background']),
			'theme_menu_link' => $this->preParse()->clean($aTheme['theme_menu_link']),
			'theme_page_background' => $this->preParse()->clean($aTheme['theme_page_background']),
			'theme_page_text' => $this->preParse()->clean($aTheme['theme_page_text']),
			'theme_button_background' => $this->preParse()->clean($aTheme['theme_button_background']),
			'theme_button_text' => $this->preParse()->clean($aTheme['theme_button_text']),
			'theme_button_top_gradient' => $this->preParse()->clean($aTheme['theme_button_top_gradient']),
			'theme_button_bottom_gradient' => $this->preParse()->clean($aTheme['theme_button_bottom_gradient']),
			'theme_button_border' => $this->preParse()->clean($aTheme['theme_button_border']),
			'theme_text_link' => $this->preParse()->clean($aTheme['theme_text_link']),
			'theme_footer_link' => $this->preParse()->clean($aTheme['theme_footer_link']),
            'player_background' => $this->preParse()->clean($aTheme['player_background']),
            'player_text' => $this->preParse()->clean($aTheme['player_text']),
            'player_buttons' => $this->preParse()->clean($aTheme['player_buttons']),
            'player_icons' => $this->preParse()->clean($aTheme['player_button_icons']),
            'player_progress_bar' => $this->preParse()->clean($aTheme['player_progress_bar']),
            'player_arrows' => $this->preParse()->clean($aTheme['player_thumbnail_arrows']),
            'player_thumbnail_border' => $this->preParse()->clean($aTheme['player_thumbnail_border']),
            'iframe_background' => $this->preParse()->clean($aTheme['iframe_background']),
            'iframe_text' => $this->preParse()->clean($aTheme['iframe_text']),
            'iframe_contact_background' => $this->preParse()->clean($aTheme['iframe_contact_background']),
            'iframe_contact_text' => $this->preParse()->clean($aTheme['iframe_contact_text']),
            'vin_top_gradient' => $this->preParse()->clean($aTheme['vin_top_gradient']),
            'vin_bottom_gradient' => $this->preParse()->clean($aTheme['vin_bottom_gradient']),
            'vin_text_color' => $this->preParse()->clean($aTheme['vin_text_color'])
				), 'theme_id = ' . (int) $aTheme['theme_id']);
	}


	public function remove($iThemeId)
	{

		$this->database()->delete($this->_sTable, 'theme_id = ' . (int) $iThemeId);
	}


}

?>