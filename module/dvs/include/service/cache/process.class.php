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
class Dvs_Service_Cache_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tDvs = Phpfox::getT('ko_dvs');
	}


	public function updateGeoCode($aDvs)
	{
		$sAddress = Phpfox::getService('dvs')->makeAddress($aDvs['country_child_id'], $aDvs['city'], $aDvs['postal_code'], $aDvs['address']);
		$aGeoCode = Phpfox::getService('dvs')->geoCode($sAddress);

		$this->database()->update($this->_tDvs, array(
			'latitude' => $aGeoCode['latitude'],
			'longitude' => $aGeoCode['longitude'],
			), 'dvs_id = ' . (int) $aDvs['dvs_id']);
	}


}

?>