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
class Dvs_Component_Controller_Share extends Phpfox_Component {

	public function process()
	{
		Phpfox::isUser(true);

        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

		$bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

		$sDvsTitle = $this->request()->get(($bSubdomainMode ? 'req1' : 'req2'));

		$aDvs = Phpfox::getService('dvs')->get($sDvsTitle, true, true);
        $sDvsTitle = $aDvs['title_url'];
		//Load player data
		$aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

		// Load the videos for the DVS
		$aDvsVideos = Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']);

		if ($aPlayer['featured_model'])
		{
			$aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
			array_unshift($aDvsVideos, '');
			$aDvsVideos[0] = $aFeaturedVideo;

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

		$iUserId = Phpfox::getUserId();
		foreach ($aDvsVideos as $iKey => $aVideo) {
			$aDvsVideos[$iKey]['shorturl'] = Phpfox::getService('dvs.shorturl')->generate($aDvs['dvs_id'], $aVideo['referenceId'], 'embed', $iUserId, 1);

			if (Phpfox::getParam('dvs.enable_subdomain_mode')){
				$aDvsVideos[$iKey]['entire_shorturl'] = Phpfox::getLib('url')->makeUrl('') . $aDvsVideos[$iKey]['shorturl'];
			}else{
				$aDvsVideos[$iKey]['entire_shorturl'] = Phpfox::getLib('url')->makeUrl('dvs') . $aDvsVideos[$iKey]['shorturl'];
			}
		}
		
		/*phpmasterminds Sort*/
		$aDvsVideos = Phpfox::getService('dvs')->aaasort($aDvsVideos,"year");
		/*phpmasterminds Sort*/
		$aFirstVideo = $aDvsVideos[0];

		$sBrowser = Phpfox::getService('dvs')->getBrowser();

		if( stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false or stripos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false ) {
			$bIsIPhone = 1;
		} else {
			$bIsIPhone = 0;
		}

		if( $bSubdomainMode ) {
			$sVideoViewUrl = Phpfox::getLib('url')->makeUrl( 'www' );//$sDvsTitle );
		} else {
			$sVideoViewUrl = Phpfox::getLib('url')->makeUrl( '' ) . $sDvsTitle;
		}

		$aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);

		$aValidVSYears = Phpfox::getService('dvs.video')->getValidVSYears($aPlayer['makes'], $aDvs['dvs_id']);

        if(count($aValidVSYears)) {
            $iYear = $aValidVSYears[0];
			$aMakes = Phpfox::getService('dvs.video')->getValidVSMakesByDealer($iYear, $aPlayer['makes'], $aDvs['dvs_id']);
            if(count($aMakes)) {
                $sMake = $aMakes[0]['make'];
            }

            $aDvsVideos = Phpfox::getService('dvs.video')->getShareVideos($aDvs['dvs_id'], $iYear, $sMake);
        }

        $aFirstVideo = array();
        if(count($aDvsVideos)) {
            $aFirstVideo = $aDvsVideos[0];
        }

        if ($aPlayer['featured_model'])
        {
            $aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
            array_unshift($aDvsVideos, '');
            $aDvsVideos[0] = $aFeaturedVideo;

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

        $sBrowser = Phpfox::getService('dvs')->getBrowser();

        if( stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false or stripos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false ) {
            $bIsIPhone = 1;
        } else {
            $bIsIPhone = 0;
        }

        if( $bSubdomainMode ) {
            $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( 'www' );//$sDvsTitle );
        } else {
            $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( '' ) . $sDvsTitle;
        }

        //$aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);

		$this->template()
			//->setTitle($aDvs['phrase_overrides']['override_page_title_display'])
			->setTitle(Phpfox::getPhrase('dvs.share_links'))
			->setMeta(array(
				'description' => $aDvs['phrase_overrides']['override_meta_description_meta'],
				'keywords' => $aDvs['phrase_overrides']['override_meta_keywords_meta'],
			))
			//->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'), Phpfox::getLib('url')->makeUrl('dvs'))
			->setBreadcrumb(Phpfox::getPhrase('dvs.share_links'))
			->setHeader(array(
				'<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>',
				'<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>',
				'share.css' => 'module_dvs',
                'dropdown.js' => 'module_dvs',
                'placeholders.jquery.min.js' => 'module_dvs',
			))
			->assign(array(
				'aDvs' => $aDvs,
				'sDvsUrl' => Phpfox::getLib('url')->makeUrl($aDvs['title_url']),
				'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'aPlayer' => $aPlayer,
				'aDvsVideos' => $aDvsVideos,
				'aFeaturedVideo' => $aFeaturedVideo,
				'bDebug' => (Phpfox::getParam('dvs.javascript_debug_mode') ? true : false),
				'sBrowser' => $sBrowser,
				'bIsIPhone' => $bIsIPhone,
				'sVideoViewUrl' => $sVideoViewUrl,
                'aVideoSelectYears' => $aValidVSYears,

                'iYear' => $iYear,
                'sMake' => $sMake,
                'aMakes' => $aMakes
		));
	}


}

?>