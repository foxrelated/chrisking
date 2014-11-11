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
class Dvs_Component_Controller_View extends Phpfox_Component
{
	public function process()
	{
		// Are subdomains enabled? If yes, our dealer title url is in a different place.
		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');
		if ($bSubdomainMode)
		{
			$sDvsRequest = $this->request()->get('req1');
		}
		else
		{
			$sDvsRequest = $this->request()->get('req2');
		}
        $sVdpEmbed = $this->request()->get('vdp', false);
		$bPreview = false;
		
		/*phpmasterminds*/
		$aBaseUrl = false;
		if ($this->request()->get('req2'))
		{
			$aBaseUrl = true;
		}
		/*phpmasterminds*/
		// Are we loading this as an iFrame?
		if ($this->request()->get('req3') === 'preview')
		{
			$bPreview = true;
			$this->template()->setHeader(array('preview.css' => 'module_dvs'));
			$aDvs = Phpfox::getService('dvs')->get($this->request()->get('req4'), false);
			if( $this->request()->get('req5') ) {
				$aDvs = null;
				$sDvsRequest = $this->request()->get('req5');
			} else {
				$aDvs = Phpfox::getService('dvs')->get($this->request()->get('req4'), false);
			}
		}
		else
		{
			$aDvs = Phpfox::getService('dvs')->get($sDvsRequest, true);
		}

		// Try a short URL
		if (empty($aDvs))
		{
			$aShortUrl = Phpfox::getService('dvs.shorturl')->get($sDvsRequest);
			// Even with ShortURL mode on, the short url should come in as req2
			if (empty($aShortUrl))
			{
				$aShortUrl = Phpfox::getService('dvs.shorturl')->get($this->request()->get('req2'));
			}

			$aDvs = Phpfox::getService('dvs')->get($aShortUrl['dvs_id']);

			if ($aShortUrl['video_ref_id'])
			{
				$aVideo = Phpfox::getService('dvs.video')->get($aShortUrl['video_ref_id']);
				$sOverride = $aVideo['video_title_url'];
			}
			else
			{
				$sOverride = '';
			}

      Phpfox::getService('dvs.shorturl.clicks.process')->click($aShortUrl['shorturl_id'], Phpfox::getUserId());
		}
		else
		{
			$sOverride = ($bSubdomainMode ? $this->request()->get('req2') : $this->request()->get('req3'));
		}

        if($bPreview && $this->request()->get('video-title-url', false)) {
            $sOverride = $this->request()->get('video-title-url');
        }

		Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);
		
		//Load player data
		$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

		if ($aPlayer['featured_model']) {
			$aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
		} else {
			$aFeaturedVideo = array();
		}

		$aValidVSYears = Phpfox::getService('dvs.video')->getValidVSYears($aPlayer['makes'], $aDvs['dvs_id']);

		$aVideoSelect = array();
		$aValidVSMakes = array();

		if (!empty($aValidVSYears) && count($aValidVSYears) == 1) {
			$aValidVSMakes = Phpfox::getService('dvs.video')->getValidVSMakes($aValidVSYears[0], $aPlayer['makes']);

			if (!empty($aValidVSMakes) && count($aValidVSMakes == 1)) {
				$aVideoSelect = Phpfox::getService('dvs.video')->getVideoSelect('', $aValidVSMakes[0]['make'], '', true);
			}
		}

		$aOverviewVideos = Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']);

		//Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
		//array_unshift($aOverviewVideos, '');
		//unset($aOverviewVideos[0]);

		if ($sOverride) {
			$aOverrideVideo = Phpfox::getService('dvs.video')->get($sOverride, true);
		} else {
			$aOverrideVideo = array();
		}
 
		//Dupe check
		if (!empty($aOverrideVideo) || !empty($aFeaturedVideo)) {
			foreach ($aOverviewVideos as $iKey => $aVideo) {
				if ((!empty($aFeaturedVideo) && $aVideo['id'] == $aFeaturedVideo['id']) || (!empty($aOverrideVideo) && $aVideo['id'] == $aOverrideVideo['id'])) {
					unset($aOverviewVideos[$iKey]);
				}
			}
		}

		if ($aOverrideVideo) {
            array_unshift($aOverviewVideos, $aOverrideVideo);
			$aFirstVideo = $aOverrideVideo;
		} else if ($aFeaturedVideo) {
            array_unshift($aOverviewVideos, $aFeaturedVideo);
			$aFirstVideo = $aFeaturedVideo;
		} else {
			$aFirstVideo = $aOverviewVideos[0];
		}
		/*phpmasterminds Edited for sort in gallery and footer starts*/
		/*foreach($aOverviewVideos as $ik=>$aVal)
		{
			$exp = explode(" ",$aVal['name']);
			

			$aOverviewVideos[$ik]['my_find'] = $exp[0];
			
		}
		
		$aOverviewVideos = Phpfox::getService('dvs')->aasort($aOverviewVideos,"ko_id");
		*/
		
		/*phpmasterminds added below code for player next video*/
		$aCurrentVideo = 0;
		foreach ($aOverviewVideos as $iKey => $aVideo)
		{
			if( ($aFirstVideo['year'] == $aVideo['year']) AND ($aFirstVideo['make'] == $aVideo['make']) AND ($aFirstVideo['model'] == $aVideo['model']))
			{
				$aCurrentVideo = $iKey;
				break;
			}
		}
		/*phpmasterminds added below code for player next video*/
		/*phpmasterminds Edited for sort in gallery and footer ends*/
		
	
 
			

 
		// Sort videos by name for footer links

	
		/*foreach($aFooterLinks as $ik=>$aVal)
		{
			$exp = explode(" ",$aVal['name']);
			

			$aFooterLinks[$ik]['my_find'] = $exp[0];
			
		}
		
		$aFooterLinks = Phpfox::getService('dvs')->aasort($aFooterLinks,"ko_id");*/
		
		/*usort($aFooterLinks, function($a, $b)
		{
			return strcasecmp($a['name'], $b['name']);
		});*/
	
		

		$sLinkBase = Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'));
		$sLinkBase .= $aFirstVideo['video_title_url'];

		//$sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.brightcove') . $aFirstVideo['thumbnail_image'];

		/* new thumb path */
		if( file_exists(PHPFOX_DIR_FILE . "brightcove" . PHPFOX_DS . $aFirstVideo['thumbnail_image']) ) {
			$sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.brightcove') . $aFirstVideo['thumbnail_image'];
		} else {
			$sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'theme.frontend.default.style.default.image.noimage') . 'item.png';
		}
		$sThumbnailUrl = str_replace('index.php?do=/', '', $sThumbnailUrl);

		$aFirstVideoMeta = array(
			'url' => Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $aFirstVideo['video_title_url']),
			'thumbnail_url' => $sThumbnailUrl,
			'upload_date' => date('Y-m-d', (int) ($aFirstVideo['publishedDate'] / 1000)),
			'duration' => 'PT' . (int) ($aFirstVideo['length'] / 1000) . 'S',
			'name' => $aFirstVideo['name'],
			'year' => $aFirstVideo['year'],
			'make' => $aFirstVideo['make'],
			'model' => $aFirstVideo['model'],
			'description' => Phpfox::getLib('parse.output')->clean($aFirstVideo['longDescription']),
			'referenceId' => $aFirstVideo['referenceId']
		);

		$sDvsJs = 'window.aSettings = [];' .
			'window.aSettings[\'latitude\']=\'' . $aDvs['latitude'] . '\';' .
			'window.aSettings[\'longitude\']=\'' . $aDvs['longitude'] . '\';' .
			'window.aSettings[\'zoom\']=\'' . Phpfox::getParam('dvs.google_maps_default_zoom') . '\';' .
			'window.aSettings[\'infoWindow\']=\'<div id="google_maps_info_window_contents"><strong>' . $aDvs['dealer_name'] . '</strong><br/>' . $aDvs['address'] . '<br/>' . $aDvs['city'] . ', ' . $aDvs['state_string'] . '</div>\';';

		// Set inventory URL
		$aDvs['inventory_url'] = str_replace('{$sMake}', urlencode($aFirstVideo['make']), $aDvs['inventory_url']);
		$aDvs['inventory_url'] = str_replace('{$sModel}', urlencode($aFirstVideo['model']), $aDvs['inventory_url']);
		$aDvs['inventory_url'] = str_replace('{$iYear}', urlencode($aFirstVideo['year']), $aDvs['inventory_url']);

		if ($aDvs['dvs_google_id'] || Phpfox::getParam('dvs.global_google_id'))
		{
			$sDvsJs .= 'var _gaq = _gaq || [];' .
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
			$sDvsJs .= 'window.sDvsGoogleId = "' . $aDvs['dvs_google_id'] . '";';
		}
		else
		{
			$sDvsJs .= 'window.sDvsGoogleId = "";';
		}

		if (Phpfox::getParam('dvs.global_google_id'))
		{
			$sDvsJs .= 'window.sGlobalGoogleId = "' . Phpfox::getParam('dvs.global_google_id') . '";';
		}
		else
		{
			$sDvsJs .= 'window.sGlobalGoogleId = "";';
		}

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		$aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);

		$sDvsJs .= 'var sShareLink = "' . $sLinkBase . '";';

		// Do we have an opacity set?
		if (!empty($aDvs['background_opacity']))
		{
			$iBackgroundAlpha = intval($aDvs['background_opacity']);
		}
		else
		{
			$iBackgroundAlpha = 100;
		}

		// Was the opacity set at 0?
		if ($iBackgroundAlpha === 0)
		{
			$iBackgroundAlpha = 100;
		}

		$iBackgroundOpacity = $iBackgroundAlpha / 100;

		// Template specific JS and CSS
		if ($sBrowser == 'mobile')
		{
			$this->template()
				->setHeader(array(
//					'dvs-mobile.css' => 'module_dvs',
//					'player-mobile.css' => 'module_dvs'
					'mobile.css' => 'module_dvs',
					'get_price_mobile.css' => 'module_dvs',
					'share_email_mobile.css' => 'module_dvs',
			));
		}
		else
		{
			$this->template()
				->setHeader(array(
					'jcarousellite.js' => 'module_dvs',
//					'dvs.css' => 'module_dvs',
//					'player.css' => 'module_dvs',
					'google_maps.js' => 'module_dvs',
					'overlay.js' => 'module_dvs',
//					'jquery.dropdown.js' => 'module_dvs',
//					'jquery.dropdown.css' => 'module_dvs',
					'showroom.css' => 'module_dvs',
					'get_price.css' => 'module_dvs',
					'share_email.css' => 'module_dvs',
			));
		}

		$inventoryList = Phpfox::getService('dvs')->getModelInventory($aFirstVideo['ko_id']);

        $sVdpIframeUrl = '';
        if($sVdpEmbed) {
            $sVdpIframeUrl = $this->url()->makeUrl('dvs.utm') . '?utm_source=' . str_replace('&', '', $aDvs['dealer_name']) . ' DVS';
            $sVdpIframeUrl .= '&utm_medium=VDP Button';
            $sVdpIframeUrl .= '&utm_content=' . str_replace('&', '', $aFirstVideo['name']);
            $sVdpIframeUrl .= '&utm_campaign=DVS Inventory';
        }

		$this->template()
			->setTemplate('dvs-view')
			->setTitle(($aOverrideVideo ? $aDvs['phrase_overrides']['override_page_title_display_video_specified'] : $aDvs['phrase_overrides']['override_page_title_display']))
			->setMeta(array(
				'description' => ($aOverrideVideo ? $aDvs['phrase_overrides']['override_meta_description_meta_video_specified'] : $aDvs['phrase_overrides']['override_meta_description_meta']),
				'keywords' => ($aOverrideVideo ? $aDvs['phrase_overrides']['override_meta_keywords_meta_video_specified'] : $aDvs['phrase_overrides']['override_meta_keywords_meta']),
			))
			->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'))
			->setHeader(array(
				'<style type="text/css">' . Phpfox::getService('dvs')->getinvCss($aDvs) . '</style>',
//				'<style type="text/css">' . Phpfox::getService('dvs')->getCss($aDvs, $bSubdomainMode) . '</style>',
//				'<style type="text/css">' . Phpfox::getService('dvs.player')->getCss($aPlayer) . '</style>',
				'player.js' => 'module_dvs',
				'shorten.js' => 'module_dvs',
//				'modernizr.js' => 'module_dvs',
				'google_analytics.js' => 'module_dvs',
//				'<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>',
//				'<script type="text/javascript">var jqDvs = jQuery.noConflict();</script>',
				'dvs.js' => 'module_dvs',
				'<meta property = "og:image" content = "' . $sThumbnailUrl . '"/>',
				// New css + js files added 2/14
				'chapter_buttons.css' => 'module_dvs',

				'dropdown.js' => 'module_dvs',
				'jquery.placeholder.js' => 'module_dvs'
			))
			->assign(array(
                'sVdpIframeUrl' => $sVdpIframeUrl,
				'aDvs' => $aDvs,
				'aBaseUrl' => $aBaseUrl,
				'aCurrentVideo' => $aCurrentVideo,
				'aFirstVideo' => $aFirstVideo,
				'inventoryList' => $inventoryList,
				'bc' => $this->request()->get('bc'),
				'sBackgroundPath' => Phpfox::getParam('core.url_file') . 'dvs/background/' . $aDvs['background_file_name'],
				'iBackgroundOpacity' => $iBackgroundOpacity,
				'iBackgroundAlpha' => $iBackgroundAlpha,
				'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'aVideoSelectModels' => $aVideoSelect,
				'aPlayer' => $aPlayer,
				'iDvsId' => $aDvs['dvs_id'],
				'sPrerollXmlUrl' => substr_replace(Phpfox::getLib('url')->makeUrl('dvs.player.prxml', array('id' => $aDvs['dvs_id'])), '', -1) . '  ? ',
				'aOverviewVideos' => $aOverviewVideos,
				'bPreview' => $bPreview,
				'bIsDvs' => true,
				'bIsExternal' => false,
				'aFeaturedVideo' => $aFeaturedVideo,
				'aOverrideVideo' => $aOverrideVideo,
				'sLinkBase' => $sLinkBase,
				'aFirstVideoMeta' => $aFirstVideoMeta,
				'sBrowser' => $sBrowser,
				'bOverrideOpenGraph' => true,
				'aVideoSelectYears' => $aValidVSYears,
				'aValidVSMakes' => $aValidVSMakes,
				'iLongDescLimit' => Phpfox::getParam('dvs.long_desc_limit'),
				'bSubdomainMode' => $bSubdomainMode,
				'sBrowser' => $sBrowser,
				'sCurrentUrlEncoded' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? urlencode(Phpfox::getLib('url')->makeUrl($aDvs['title_url'], $aVideo['video_title_url'])) : urlencode(Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aVideo['video_title_url'])))),
				'sStaticPath' => Phpfox::getParam('core.path') . 'module/dvs/static/',
				'sJavascript' => '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>'
				. '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>'
				. '<script type="text/javascript">var bIsDvs = true</script>'
				. '<script type="text/javascript">var sFirstVideoTitleUrl = "' . $aFirstVideo['video_title_url'] . '";</script>'
				. '<script type="text/javascript">var sDvsTitleUrl = "' . $aDvs['title_url'] . '";</script>'
				. '<script type="text/javascript">var bGoogleAnalytics = true;</script>'
				. '<script type="text/javascript">var aCurrentVideoMetaData = [];</script>'
				. '<script type="text/javascript">aCurrentVideoMetaData.referenceId ="' . $aFirstVideo['referenceId'] . '";aCurrentVideoMetaData.year ="' . $aFirstVideo['year'] . '";aCurrentVideoMetaData.make ="' . $aFirstVideo['make'] . '";aCurrentVideoMetaData.model ="' . $aFirstVideo['model'] . '";</script> '
				. '<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>'
				. '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;key=' . Phpfox::getParam('dvs.google_maps_api_key') . '"></script>'
				. '<script type="text/javascript">' . $sDvsJs . '</script>'
		));

	}
}
?>