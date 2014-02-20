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
class Dvs_Service_Shorturl_Clicks_Clicks extends Phpfox_Service {

	/**
	 * Set table variables
	 */
	public function __construct()
	{
		$this->_tClicks = Phpfox::getT('ko_shorturl_clicks');
	}


	/**
	 * Returns a specific click
	 * 
	 * @param string $iClickId
	 * @return array
	 */
	public function get($iClickId)
	{
		$aClick = $this->database()->select('*')
			->from($this->_tClicks)
			->where('click_id = ' . (int) $iClickId)
			->execute('getRow');

		return $aClick;
	}


}

?>
