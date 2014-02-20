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
class Dvs_Service_Theme_Theme extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_themes');

	}

	public function get($iThemeId)
	{
		$iThemeId = (int) $iThemeId;

		return $this->database()->select('*')
						->from($this->_sTable, 't')
						->where('t.theme_id =' . $iThemeId)
						->execute('getRow');

	}

	public function listThemes($bListUses = false)
	{
		$aThemes = $this->database()->select('*')
				->from($this->_sTable, 't')
				->execute('getRows');

		if ($bListUses)
		{
			
		}

		return $aThemes;

	}

}

?>