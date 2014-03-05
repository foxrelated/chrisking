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
class Idrive_Component_Controller_Player_Static extends Phpfox_Component {

	public function process()
	{
		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

		$iPlayerId = $this->request()->getInt('id');
		$aPlayer = Phpfox::getService('idrive.player')->get($iPlayerId);

		// If this is the static player, load up the static controller.
		if ($aPlayer['player_name'] != Phpfox::getParam('idrive.static_player_slug'))
		{
			//Something is terribly wrong.
			return false;
		}

		$iWidth = $this->request()->getInt('width');
		$iHeight = $this->request()->getInt('height');

		if (!$iWidth || !$iHeight)
		{
			$iWidth = 880;
			$iHeight = 510;
		}

		$iPlayerWidth = $iWidth - 160;
		$iPlayerHeight = $iHeight - 105;

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		if ($aPlayer['google_id'])
		{
			$iDriveJs = 'var _gaq = _gaq || [];' .
				'_gaq.push([\'_setAccount\', \'' . $aPlayer['dvs_google_id'] . '\']);' .
				'_gaq.push([\'_trackPageview\']);' .
				'(function() {' .
				'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;' .
				'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';' .
				'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);' .
				'})();';

			$iDriveJs .= 'window.sDvsGoogleId = "' . $aPlayer['dvs_google_id'] . '";';
			$iDriveJs = 'window.sGlobalGoogleId = "";';
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
				($sBrowser == 'mobile' ? 'player-static.css' : 'player-static.css') => 'module_dvs',
//				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
//				'<script type="text/javascript">var bIsDvs = false</script>',
//				'<script type="text/javascript">' . $iDriveJs . '</script>',
				'player-static.js' => 'module_dvs',
//				'<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>',
//				'<script type="text/javascript">var bGoogleAnalytics = true;</script>',
				'google_analytics.js' => 'module_dvs',
				'jcarousellite.js' => 'module_dvs'
			))
			->assign(array(
				'aPlayer' => $aPlayer,
				'sPrerollXmlUrl' => substr_replace(Phpfox::getLib('url')->makeUrl('idrive.prxml', array('id' => $iPlayerId)), '', -1) . '?',
				'bPreview' => false,
				'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'bIsDvs' => false,
				'bIsExternal' => false,
				'sBrowser' => $sBrowser,
				'iPlayerWidth' => $iPlayerWidth,
				'iPlayerHeight' => $iPlayerHeight,
				'sReferenceId' => Phpfox::getParam('idrive.static_player_reference_id'),
				'sJavascript' => '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>'
				. '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>'
				. '<script type="text/javascript">var bIsDvs = false</script>'
				. '<script type="text/javascript">' . $iDriveJs . '</script>'
				. '<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>'
				. '<script type="text/javascript">var bGoogleAnalytics = true;</script>'
		));
	}


}

?>