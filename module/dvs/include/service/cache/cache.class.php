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
class Dvs_Service_Cache_Cache extends Phpfox_Service {

	public function __construct()
	{
		$this->_tDvs = Phpfox::getT('ko_dvs');
	}


	public function getTotal($bLocation = null)
	{
		$aWhere = array();

		if ($bLocation === true)
		{
			$aWhere[] = 'latitude != "" AND longitude != ""';
		}
		else if ($bLocation === false)
		{
			$aWhere[] = 'latitude = "" OR longitude = ""';
		}

		return $this->database()->select('COUNT(*)')
				->from($this->_tDvs, 'd')
				->where($aWhere)
				->execute('getField');
	}


	public function rebuild()
	{
		$aDvss = $this->database()->select('dvs_id, country_child_id, city, postal_code, address')
			->from($this->_tDvs, 'd')
			->where('latitude = "" OR longitude = ""')
			->execute('getRows');

		foreach ($aDvss as $aDvs)
		{
			Phpfox::getService('dvs.cache.process')->updateGeoCode($aDvs);
		}

		return true;
	}


}

?>