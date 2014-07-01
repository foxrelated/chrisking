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
class Dvs_Service_Style_Style extends Phpfox_Service {

    private $_aFontFamilies = array(
        0 => 'Georgia, serif',
        1 => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
        2 => '"Times New Roman", Times, serif',
        3 => 'Arial, Helvetica, sans-serif',
        4 => '"Arial Black", Gadget, sans-serif',
        5 => '"Comic Sans MS", cursive, sans-serif',
        6 => 'Impact, Charcoal, sans-serif',
        7 => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
        8 => 'Tahoma, Geneva, sans-serif',
        9 => '"Trebuchet MS", Helvetica, sans-serif',
        10 => 'Verdana, Geneva, sans-serif',
        11 => '"Courier New", Courier, monospace',
        12 => '"Lucida Console", Monaco, monospace'
    );

    private $_aFontRepresents = array(
        0 => 'Georgia',
        1 => 'Palatino Linotype',
        2 => 'Times New Roman',
        3 => 'Arial',
        4 => 'Arial Black',
        5 => 'Comic Sans MS',
        6 => 'Impact',
        7 => 'Lucida Sans Unicode',
        8 => 'Tahoma',
        9 => 'Trebuchet MS',
        10 => 'Verdana',
        11 => 'Courier New',
        12 => 'Lucida Console'
    );

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_style');
	}


	public function get($iDvsId)
	{
		$iDvsId = (int) $iDvsId;

		$aRow = $this->database()->select('*')
						->from($this->_sTable, 's')
						->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
						->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
						->where('s.dvs_id =' . $iDvsId)
						->execute('getRow');

        if(isset($aRow['font_family_id'])) {
            $aRow['font_family'] = $this->_aFontFamilies[$aRow['font_family_id']];
        }

        return $aRow;
	}

    public function getFontFamilies() {
        return $this->_aFontFamilies;
    }

    public function getFontFamily($iId) {
        return $this->_aFontFamilies[$iId];
    }
}

?>