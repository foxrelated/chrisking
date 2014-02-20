<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox_Service
 * @version 		$Id: seo.class.php 4165 2012-05-14 10:43:25Z Raymond_Benc $
 */
class Admincp_Service_Seo_Seo extends Phpfox_Service 
{
	/**
	 * Class constructor
	 */	
	public function __construct()
	{	
		
	}
	
	public function setHeaders()
	{
		$sCacheId = $this->cache()->set('seo_nofollow');
		if (!($aNoFollows = $this->cache()->get($sCacheId)))
		{
			$aRows = $this->database()->select('*')
				->from(Phpfox::getT('seo_nofollow'))
				->execute('getSlaveRows');
			$aNoFollows = array();
			foreach ($aRows as $aRow)
			{
				$aNoFollows[$aRow['url']] = true;
			}

			$this->cache()->save($sCacheId, $aNoFollows);
		}
		
		if (count($aNoFollows))
		{
			$sUrl = trim(Phpfox::getLib('url')->getFullUrl(true), '/');
			if (isset($aNoFollows[$sUrl]))
			{
				Phpfox::getLib('template')->setHeader('<meta name="robots" content="nofollow" />');
			}
		}
		
		$sCacheId = $this->cache()->set('seo_meta');
		if (!($aMetas = $this->cache()->get($sCacheId)))
		{
			$aRows = $this->database()->select('*')
				->from(Phpfox::getT('seo_meta'))
				->execute('getSlaveRows');
			$aMetas = array();
			foreach ($aRows as $aRow)
			{
				$aMetas[$aRow['url']] = $aRow;
			}

			$this->cache()->save($sCacheId, $aMetas);
		}		
		
		if (count($aMetas))
		{
			$sUrl = trim(Phpfox::getLib('url')->getFullUrl(true), '/');
			if (isset($aMetas[$sUrl]))
			{
				Phpfox::getLib('template')->setMeta((!$aMetas[$sUrl]['type_id'] ? 'keywords' : 'description'), $aMetas[$sUrl]['content']);
			}
		}
	}
	
	public function getUrl($sUrl)
	{
		$sUrl = str_replace(Phpfox::getParam('core.path'), '', $sUrl);
		$sUrl = str_replace('index.php?' . PHPFOX_GET_METHOD . '=', '', $sUrl);
		$sUrl = trim($sUrl, '/');
		
		return $sUrl;
	}
	
	public function getNoFollows()
	{
		$aRows = $this->database()->select('*')
			->from(Phpfox::getT('seo_nofollow'))
			->order('time_stamp')
			->execute('getSlaveRows');
		
		return $aRows;
	}
	
	public function getSiteMetas()
	{
		$aRows = $this->database()->select('*')
			->from(Phpfox::getT('seo_meta'))
			->order('time_stamp')
			->execute('getSlaveRows');
		
		return $aRows;		
	}
}

?>