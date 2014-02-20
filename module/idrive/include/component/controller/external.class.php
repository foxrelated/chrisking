<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		iDrive
 */
class Idrive_Component_Controller_External extends Phpfox_Component {

	public function process()
	{
		$sPlayerKey = $this->request()->get('key');
		$iPlayerId = $this->request()->get('id');
		$iWidth = $this->request()->getInt('width');
		$iHeight = $this->request()->getInt('height');
		$sPlaylist = $this->request()->get('playlist');
		$bAutoplay = ($this->request()->get('autoplay') == 'true' ? true : false);
		$bAllowNew2U = ($this->request()->get('new2u') == 'true' ? true : false);
		$bAllow1onOne = ($this->request()->get('1onone') == 'true' ? true : false);
		$bAllowTop200 = ($this->request()->get('top200') == 'true' ? true : false);
		$bAllowPOV = ($this->request()->get('pov') == 'true' ? true : false);
		$bShowPlaylist = ($this->request()->get('showplaylist') == 'true' ? true : false);
		$bShowGetPrice = ($this->request()->get('showgetprice') == 'true' ? true : false);
		$sEmail = $this->request()->get('email');
		$sReferenceId = $this->request()->get('refid');

		$iPlayerWidth = $iWidth - 160;

		if ($bShowPlaylist)
		{
			$iPlayerHeight = $iHeight - 90;
		}
		else
		{
			$iPlayerHeight = $iHeight;
		}


		$iPlayerWidth = $iWidth - 160;
		$iPlayerHeight = $iHeight - 100;

		$iPlaylistThumbnails = floor(($iPlayerWidth - 98 ) / 155);
		if ($iPlaylistThumbnails > 2)
		{
			$iScrollAmt = $iPlaylistThumbnails - 1;
		}
		else
		{
			$iPlaylistThumbnails = 2;
			$iScrollAmt = 1;
		}

		if ($sReferenceId)
		{
			//Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
			$aVideos = Phpfox::getService('idrive.player')->getExternalVideos($sReferenceId, $bAllowNew2U, $bAllow1onOne, $bAllowTop200, $bAllowPOV);
			array_unshift($aVideos, '');
			unset($aVideos[0]);
		}
		else
		{
			$aVideos = array();
		}

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		$this->template()
			->setTemplate('blank')
			->setHeader(array(
				'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
				($sBrowser == 'mobile' ? 'player-mobile.css' : 'player.css') => 'module_dvs',
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'<script type="text/javascript">var bIsDvs = false</script>',
				'player.js' => 'module_dvs',
				'jcarousellite.js' => 'module_dvs',
				'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
				'<script type="text/javascript">var bGoogleAnalytics = false;</script>',
				'google_analytics.js' => 'module_dvs'
			))
			->assign(array(
				'aVideos' => $aVideos,
				'bPreview' => false,
				'sImagePath' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'bIsDvs' => false,
				'bIsExternal' => true,
				'sPlayerKey' => $sPlayerKey,
				'iPlayerId' => $iPlayerId,
				'sReferenceId' => $sReferenceId,
				'iWidth' => $iWidth,
				'iHeight' => $iHeight,
				'sPlaylist' => $sPlaylist,
				'bAutoplay' => $bAutoplay,
				'bAllowNew2U' => $bAllowNew2U,
				'bAllow1onOne' => $bAllow1onOne,
				'bAllowTop200' => $bAllowTop200,
				'bAllowPOV' => $bAllowPOV,
				'bShowPlaylist' => $bShowPlaylist,
				'bShowGetPrice' => $bShowGetPrice,
				'sEmail' => $sEmail,
				'sBrowser' => $sBrowser,
				'iPlayerWidth' => $iPlayerWidth,
				'iPlayerHeight' => $iPlayerHeight,
				'iChapterButtonLeft' => $iPlayerWidth + 10,
				'iBackgroundWidth' => $iWidth,
				'iBackgroundHeight' => $iPlayerHeight + 100,
				'iPlaylistThumbnails' => $iPlaylistThumbnails,
				'iScrollAmt' => $iScrollAmt
		));
	}


}

?>

