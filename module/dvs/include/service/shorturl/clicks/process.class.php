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
class Dvs_Service_Shorturl_Clicks_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tClicks = Phpfox::getT('ko_shorturl_clicks');
	}


	public function click($iShortUrlId, $iUserId)
	{
		return $this->database()->insert($this->_tClicks, array(
				'shorturl_id' => (int) $iShortUrlId,
				'user_id' => (int) $iUserId,
				'ip_address' => Phpfox::getLib('request')->getServer('REMOTE_ADDR'),
				'timestamp' => PHPFOX_TIME
		));
	}


	public function remove($iShortUrlId)
	{
		return $this->database()->delete($this->_tClicks, 'dvs_id = ' . (int) $iDvsId);
	}


}

?>