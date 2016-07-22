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
 * @package 		DVS
 */
class Dvs_Component_Controller_Gallery extends Phpfox_Component {

	public function process()
	{
		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

		$sDvsTitle = $this->request()->get(($bSubdomainMode ? 'req1' : 'req2'));

		$aDvs = Phpfox::getService('dvs')->get($sDvsTitle, true, true);
		Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);

		//Load player data
		$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

		// Load the videos for the DVS
		$aDvsVideos = Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']);
		/*phpmasterminds Edited for sort in gallery starts*/
		
		foreach($aDvsVideos as $ik=>$aVal)
		{
			$exp = explode(" ",$aVal['name']);

			$aDvsVideos[$ik]['my_find'] = $exp[0];
			
			$aDvsVideos[$ik]['targer_href'] = $aDvs['gallery_target_setting'];
			
		}
		$aDvsVideos = Phpfox::getService('dvs')->aasort($aDvsVideos,"my_find");

		/*phpmasterminds Edited for sort in gallery ends*/
		if ($aPlayer['featured_model'])
		{
			$aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
			array_unshift($aDvsVideos, '');
			$aDvsVideos[0] = $aFeaturedVideo;
            $aDvsVideos[0]['targer_href'] = $aDvs['gallery_target_setting'];

			// Make sure the featured video is not duped
			foreach ($aDvsVideos as $iKey => $aVideo)
			{
				if ($iKey == 0)
				{
					//Don't unset the featured video
					continue;
				}

				if ($aVideo['id'] == $aFeaturedVideo['id'])
				{
					//Remove dupe
					unset($aDvsVideos[$iKey]);

					//Reset keys
					$aDvsVideos = array_values($aDvsVideos);
				}
			}
		}
		else
		{
			$aFeaturedVideo = array();
		}

		$aFirstVideo = $aDvsVideos[0];

		//Limit videos
		$iTotalVideos = Phpfox::getParam('dvs.gallery_rows') * Phpfox::getParam('dvs.gallery_columns');
		$aDvsVideos = array_slice($aDvsVideos, 0, $iTotalVideos - 1);

		/*usort($aDvsVideos, function($a, $b) {
			return strcasecmp($a['name'], $b['name']);
		});
		*/
		$sDvsGAJs = '';

		if ($aDvs['dvs_google_id'] || Phpfox::getParam('dvs.global_google_id'))
		{
			$sDvsGAJs .= 'var _gaq = _gaq || [];' .
				'_gaq.push([\'_setAccount\', \'' . $aDvs['dvs_google_id'] . '\']);' .
				'_gaq.push([\'_trackPageview\']);' .
				'(function() {' .
				'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;' .
				'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';' .
				'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);' .
				'})();';
		}

		if ($aDvs['dvs_google_id'])
		{
			$sDvsGAJs .= 'window.sDvsGoogleId = "' . $aDvs['dvs_google_id'] . '";';
		}
		else
		{
			$sDvsGAJs .= 'window.sDvsGoogleId = "";';
		}

		if (Phpfox::getParam('dvs.global_google_id'))
		{
			$sDvsGAJs .= 'window.sGlobalGoogleId = "' . Phpfox::getParam('dvs.global_google_id') . '";';
		}
		else
		{
			$sDvsGAJs .= 'window.sGlobalGoogleId = "";';
		}

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

        if(!$aDvs['is_active']) {
            $this->template()->setHeader('cache', array(
                'deactive.css' => 'module_dvs'
            ));
        }
		$aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);
		$this->template()
			->setTemplate('blank')
			->setTitle($aDvs['phrase_overrides']['override_page_title_display'])
			->setMeta(array(
				'description' => $aDvs['phrase_overrides']['override_meta_description_meta'],
				'keywords' => $aDvs['phrase_overrides']['override_meta_keywords_meta'],
			))
			->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'))
			->setHeader(array(
				'<style type="text/css">' . Phpfox::getService('dvs')->getCss($aDvs, $bSubdomainMode) . '</style>',
				'<style type="text/css">' . Phpfox::getService('dvs.player')->getCss($aPlayer) . '</style>',
				'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'<script type="text/javascript">var sDvsTitleUrl = "' . $aDvs['title_url'] . '";</script>',
				'<script type="text/javascript">var bGoogleAnalytics = true;</script>',
				'<script type="text/javascript">' . $sDvsGAJs . '</script>',
				'google_analytics.js' => 'module_dvs',
				'gallery.css' => 'module_dvs'
			))
			->assign(array(
				'bSubdomainMode' => $bSubdomainMode,
				'aDvs' => $aDvs,
				'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'aPlayer' => $aPlayer,
				'aDvsVideos' => $aDvsVideos,
				'aFeaturedVideo' => $aFeaturedVideo,
				'bDebug' => (Phpfox::getParam('dvs.javascript_debug_mode') ? true : false),
				'sBrowser' => $sBrowser,
				'iColumns' => Phpfox::getParam('dvs.gallery_columns')
		));
	}


}

?>