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

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_dvs_style');
	}


	public function get($iDvsId)
	{
		$iDvsId = (int) $iDvsId;

		return $this->database()->select('*')
						->from($this->_sTable, 's')
						->leftjoin(Phpfox::getT('ko_dvs_branding_files'), 'b', 'b.branding_id = s.branding_file_id')
						->leftjoin(Phpfox::getT('ko_dvs_background_files'), 'bg', 'bg.background_id = s.background_file_id')
						->where('s.dvs_id =' . $iDvsId)
						->execute('getRow');
	}


}

?>