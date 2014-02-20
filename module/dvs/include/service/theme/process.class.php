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
			'theme_footer_link' => $this->preParse()->clean($aTheme['theme_footer_link'])
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
			'theme_footer_link' => $this->preParse()->clean($aTheme['theme_footer_link'])
				), 'theme_id = ' . (int) $aTheme['theme_id']);
	}


	public function remove($iThemeId)
	{

		$this->database()->delete($this->_sTable, 'theme_id = ' . (int) $iThemeId);
	}


}

?>