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
class Dvs_Service_Shorturl_Shorturl extends Phpfox_Service {

	/**
	 * Set table variables
	 */
	public function __construct()
	{
		$this->_tShortUrl = Phpfox::getT('ko_shorturls');
	}


	/**
	 * Returns a specific shorturl
	 *
	 * @param string $sShortUrl
	 * @return array
	 */
	public function get($sShortUrl)
	{
		$aShorturlVals = $this->database()->select('*')
			->from($this->_tShortUrl)
			->where('shorturl = "' . $this->preParse()->clean($sShortUrl) . '"')
			->execute('getRow');

		return $aShorturlVals;
	}


	/**
	 * Generate an 8 character short URL based on the ID.  Valid up to just over 2.8 trillion keys.
	 *
	 * @param int $iShorturlId
	 * @return string
	 */
	public function generate($iDvsId, $sVideoRefId, $sService, $iUserId = 0, $bIsHidden = 0)
	{
		$iShorturlId = Phpfox::getService('dvs.shorturl.process')->add($iDvsId, $sVideoRefId, $sService, $iUserId, $bIsHidden);
		$sShortUrl = base_convert($iShorturlId, 10, 36);

		if (strlen($sShortUrl) < 80)
		{
			$iPadding = (8 - strlen($sShortUrl));
			$aSeed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
			if ($iPadding == 1)
			{
				$sShortUrl .= $aSeed[array_rand($aSeed, $iPadding)];
			}
			else
			{
				foreach (array_rand($aSeed, $iPadding) as $k)
				{
					$sShortUrl .= $aSeed[$k];
				}
			}
		}

		Phpfox::getService('dvs.shorturl.process')->updateShortUrl($iShorturlId, $sShortUrl);

		return $sShortUrl;
	}


}

?>
