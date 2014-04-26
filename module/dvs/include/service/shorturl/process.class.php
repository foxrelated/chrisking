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
class Dvs_Service_Shorturl_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_tShortUrl = Phpfox::getT('ko_shorturls');
	}


	/**
	 * Adds a shorturl row to the db
	 *
	 * @param array $aVals
	 * @return string shorturl key
	 */
	public function add($iDvsId, $sVideoRefId, $sService, $iUserId, $bIsHidden = 0)
	{
		$iShortUrlId = $this->database()->insert($this->_tShortUrl, array(
			'user_id' => (int) $iUserId,
			'dvs_id' => (int) $iDvsId,
			'video_ref_id' => $this->preParse()->clean($sVideoRefId),
			'service' => $this->preParse()->clean($sService),
			'timestamp' => PHPFOX_TIME,
			'hidden' => $bIsHidden,
		));

		return $iShortUrlId;
	}


	public function updateShortUrl($iShortUrlId, $sShortUrl)
	{
		return $this->database()->update($this->_tShortUrl, array(
				'shorturl' => $this->preParse()->clean($sShortUrl)
				), 'shorturl_id = ' . (int) $iShortUrlId);
	}

	public function hideShortUrl( $sShortUrl )
	{
		return $this->database()->update( $this->_tShortUrl, array('hidden' => 1), "shorturl = '" . $this->preParse()->clean($sShortUrl) . "'");
	}

	public function unhideShortUrl( $sShortUrl )
	{
		return $this->database()->update( $this->_tShortUrl, array('hidden' => '0'), "shorturl = '" . $this->preParse()->clean($sShortUrl) . "'");
	}


	public function click($sShortUrl)
	{
		return $this->database()->update($this->_tShortUrl, array(
				'clicks' => array('= clicks +', 1)
				), 'shorturl = "' . $this->preParse()->clean($sShortUrl) . '"');
	}


}

?>