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
class Idrive_Component_Controller_Player extends Phpfox_Component {

	public function process()
	{
		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');
		
		$iPlayerId = $this->request()->getInt('id');
		if (!empty($iPlayerId))
		{
			$aPlayer = Phpfox::getService('idrive.player')->get($iPlayerId);
		}
		else
		{
			$aPlayer['player_name'] = $this->request()->get('player-name');
			$aPlayer['player_type'] = $this->request()->get('player-type');
		}
		
		
		// If this is the static player, load up the static controller.
		if ($aPlayer['player_name'] == Phpfox::getParam('idrive.static_player_slug'))
		{
			return Phpfox::getLib('module')->setController('idrive.player-static');
		}

		$iWidth = $this->request()->getInt('width');
		$iHeight = $this->request()->getInt('height');

		if (!$iWidth || !$iHeight)
		{
			$iWidth = 880;
			$iHeight = 510;
		}

		$iPlayerWidth = $iWidth - 160;
		$iPlayerHeight = $iHeight - 100;

		$iPlaylistThumbnails = floor(($iPlayerWidth - 98 ) / 155);
		if ($iPlaylistThumbnails > 1)
		{
			$iScrollAmt = $iPlaylistThumbnails - 1;
		}
		else
		{
			$iScrollAmt = 1;
		}

		if ($aPlayer['featured_model'])
		{
			$aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
		}
		else
		{
			$aFeaturedVideo = array();
		}

		//Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
		$aVideos = Phpfox::getService('idrive.player')->getVideos($iPlayerId);
		
		// Determine the number of extra li's to add.
		$iExtraLi = (count($aVideos) - $iPlaylistThumbnails) % $iScrollAmt;
		$sExtraLi = '';
		for ($i=0; $i < $iExtraLi; $i++)
		{
			$sExtraLi .= '<li style="display: none;"></li>';
		}
		
		array_unshift($aVideos, '');
		unset($aVideos[0]);

		if ($aFeaturedVideo)
		{
			$aFirstVideo = $aFeaturedVideo;
		}
		else
		{
			$aFirstVideo = $aVideos[1];
		}

		//Dupe check
		if (!empty($aFeaturedVideo))
		{
			foreach ($aVideos as $iKey => $aVideo)
			{
				if ($iKey == 0)
				{
					//Don't unset the featured video
					continue;
				}

				if ($aVideo['id'] == $aFeaturedVideo['id'])
				{
					//Remove dupe
					unset($aVideos[$iKey]);
				}
			}
		}
		$aFirstVideoMeta = array(
			'url' => Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $aFirstVideo['video_title_url']),
			'thumbnail_url' => Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.brightcove') . $aFirstVideo['thumbnail_image'],
			'upload_date' => date('Y-m-d', (int) ($aFirstVideo['publishedDate'] / 1000)),
			'duration' => 'PT' . (int) ($aFirstVideo['length'] / 1000) . 'S',
			'name' => $aFirstVideo['name'],
			'year' => $aFirstVideo['year'],
			'make' => $aFirstVideo['make'],
			'model' => $aFirstVideo['model'],
			'description' => Phpfox::getLib('parse.output')->clean($aFirstVideo['longDescription']),
			'referenceId' => $aFirstVideo['referenceId']
		);

		$sLinkBase = Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'));
		$sLinkBase .= $aFirstVideo['video_title_url'];

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		if ($aPlayer['google_id'])
		{
			$iDriveJs = 'var _gaq = _gaq || [];' .
				'_gaq.push([\'_setAccount\', \'' . $aPlayer['google_id'] . '\']);' .
				'_gaq.push([\'_trackPageview\']);' .
				'(function() {' .
				'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;' .
				'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';' .
				'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);' .
				'})();';

			$iDriveJs .= 'window.sDvsGoogleId = "' . $aPlayer['google_id'] . '";';
			$iDriveJs .= 'window.sGlobalGoogleId = "";';
		}
		else
		{
			$iDriveJs = 'window.sDvsGoogleId = "";';
			$iDriveJs = 'window.sGlobalGoogleId = "";';
		}

		
		
		$this->template()
			->setTemplate('blank')
			->setHeader(array(
//				'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
//				($sBrowser == 'mobile' ? 'player-mobile.css' : 'player.css') => 'module_dvs',
//				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
//				'<script type="text/javascript">var bIsDvs = false</script>',
//				'<script type="text/javascript">' . $iDriveJs . '</script>',
				'player.js' => 'module_dvs',
				'jcarousellite.js' => 'module_dvs',
//				'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
//				'<script type="text/javascript">var bGoogleAnalytics = ' . ($aPlayer['google_id'] ? "true" : "false") . ';</script>',
				'google_analytics.js' => 'module_dvs',
//				'<style type="text/css">' . Phpfox::getService('dvs.player')->getCss($aPlayer) . '</style>',
				'get_price.css' => 'module_dvs',
				'share_email.css' => 'module_dvs',
				'showroom.css' => 'module_dvs',
				'chapter_buttons.css' => 'module_dvs'
			))
			->assign(array(
					'aPlayer' => $aPlayer,
					'sPrerollXmlUrl' => substr_replace(Phpfox::getLib('url')->makeUrl('idrive.prxml', array('id' => $iPlayerId)), '', -1) . '?',
					'aVideos' => $aVideos,
					'bPreview' => false,
					'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
					'aFeaturedVideo' => $aFeaturedVideo,
					'bIsDvs' => false,
					'bIsExternal' => false,
					'aFirstVideoMeta' => $aFirstVideoMeta,
					'sLinkBase' => $sLinkBase,
					'sBrowser' => $sBrowser,
					'iPlayerWidth' => $iPlayerWidth,
					'iPlayerHeight' => $iPlayerHeight,
					'iChapterButtonLeft' => $iPlayerWidth + 10,
					'iBackgroundWidth' => $iWidth,
					'iBackgroundHeight' => $iPlayerHeight + 100,
					'iPlaylistThumbnails' => $iPlaylistThumbnails,
					'iScrollAmt' => $iScrollAmt,
					'sExtraLi' => $sExtraLi,
					'sJavascript' => '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>'
				. '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>'
				. '<script type="text/javascript">var bIsDvs = false</script>'
				. '<script type="text/javascript">' . $iDriveJs . '</script>'
				. '<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>'
				. '<script type="text/javascript">var bGoogleAnalytics = ' . ($aPlayer['google_id'] ? "true" : "false") . ';</script>'
				));
	}


}

?>