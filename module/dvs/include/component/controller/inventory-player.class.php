<?php
defined('PHPFOX') or exit('NO DICE!');

class Dvs_Component_Controller_Inventory_Player extends Phpfox_Component {
    public function process() {
        $sOverride = false;
        $iDvsId = $this->request()->get('id');
        $sVin = $this->request()->get('vin');
        $sEdStyleId = $this->request()->get('edstyleid', null);
        $iMaxWidth = $this->request()->get('maxwidth', 580) - 32;
        $iMaxHeight = (int)($iMaxWidth / 29 * 16);

        if ($sVin) {
            $aVins = explode(',', $sVin);
            list($aRows, $aDvs) = Phpfox::getService('dvs.vin')->getVins($aVins, $iDvsId, $iMaxWidth, $iMaxHeight);
        } elseif ($sEdStyleId) {
            $sVin = $sEdStyleId;
            $aEdStyles = explode(',', $sEdStyleId);
            list($aRows, $aDvs) = Phpfox::getService('dvs.vin')->getEdStyles($aEdStyles, $iDvsId, $iMaxWidth, $iMaxHeight);
        }

        $bNoVideo = false;
        if(!$aRows || !$aRows[$sVin]['url'] || $aRows[$sVin]['title_url'] == 'no-video'){
            $bNoVideo = true;
        }
        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $sDvsRequest = $aDvs['title_url'];

        $bPreview = false;


        $aDvs = Phpfox::getService('dvs')->get($sDvsRequest, true);

        if (isset($aRows[$sVin]['title_url'])) {
            $sOverride = $aRows[$sVin]['title_url'];
        }

        Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);

        //Load player data
        $aPlayer = Phpfox::getService('dvs.player')->get($aDvs['dvs_id']);

        if ($aPlayer['featured_model']) {
            $aFeaturedVideo = Phpfox::getService('dvs.video')->get('', false, $aPlayer['featured_year'], $aPlayer['featured_make'], $aPlayer['featured_model']);
        } else {
            $aFeaturedVideo = array();
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

        $bIsSetFirstVideo = false;

        if ($aFeaturedVideo) {
            $bIsSetFirstVideo = true;
            array_unshift($aOverviewVideos, $aFeaturedVideo);
            $aFirstVideo = $aFeaturedVideo;
        }

        if ($aOverrideVideo) {
            $bIsSetFirstVideo = true;
            array_unshift($aOverviewVideos, $aOverrideVideo);
            $aFirstVideo = $aOverrideVideo;
        }

        if(!$bIsSetFirstVideo) {
            $aFirstVideo = $aOverviewVideos[0];
        }

        $aCurrentVideo = 0;
        foreach ($aOverviewVideos as $iKey => $aVideo) {
            if( ($aFirstVideo['year'] == $aVideo['year']) AND ($aFirstVideo['make'] == $aVideo['make']) AND ($aFirstVideo['model'] == $aVideo['model'])) {
                $aCurrentVideo = $iKey;
                break;
            }
        }

        $sLinkBase = Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'));
        $sLinkBase .= $aFirstVideo['video_title_url'];

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
            'window.aSettings[\'infoWindow\']=\'<div id="google_maps_info_window_contents"><strong>' . $aDvs['dealer_name'] . '</strong><br/>' . $aDvs['address'] . '<br/>' . $aDvs['city'] . ', ' . $aDvs['state_string'] . '<br/>Phone: ' . $aDvs['phone'] . '<br/>Website: <a href="' . $aDvs['url'] . '">' . $aDvs['url'] . '</a></div>\';';

        if ($aDvs['dvs_google_id'] || Phpfox::getParam('dvs.global_google_id')) {
            $sDvsJs .= 'var _gaq = _gaq || [];' .
                '_gaq.push([\'_setAccount\', \'' . $aDvs['dvs_google_id'] . '\']);' .
                '_gaq.push([\'_trackPageview\']);' .
                '(function() {' .
                'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;' .
                'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';' .
                'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);' .
                '})();';
        }

        if ($aDvs['dvs_google_id']) {
            $sDvsJs .= 'window.sDvsGoogleId = "' . $aDvs['dvs_google_id'] . '";';
        } else {
            $sDvsJs .= 'window.sDvsGoogleId = "";';
        }

        if (Phpfox::getParam('dvs.global_google_id')) {
            $sDvsJs .= 'window.sGlobalGoogleId = "' . Phpfox::getParam('dvs.global_google_id') . '";';
        } else {
            $sDvsJs .= 'window.sGlobalGoogleId = "";';
        }

        $sBrowser = Phpfox::getService('dvs')->getBrowser();

        $aDvs['phrase_overrides'] = Phpfox::getService('dvs.override')->getAll($aDvs, $aFirstVideo);

        $sDvsJs .= 'var sShareLink = "' . $sLinkBase . '";';

        // Do we have an opacity set?
        if (!empty($aDvs['background_opacity'])) {
            $iBackgroundAlpha = intval($aDvs['background_opacity']);
        } else {
            $iBackgroundAlpha = 100;
        }

        // Was the opacity set at 0?
        if ($iBackgroundAlpha === 0) {
            $iBackgroundAlpha = 100;
        }

        $iBackgroundOpacity = $iBackgroundAlpha / 100;

        // Resize player for mobile device
        $sBrowser = Phpfox::getService('dvs')->getBrowser();
        $iScreenHeight = $iMaxHeight;
        $iScreenWidth = $iMaxWidth;

        $iWarningTextFontSize = 11;
        $iHeaderTextFontSize = 15;
        if ($sBrowser == 'mobile') {
            $iPopupWidth = (int)($iScreenWidth * 0.9);
            if ($iPopupWidth > 930) {
                $iPopupWidth = 930;
            }
            $iPlayerWidth = (int)($iPopupWidth * 0.9);
            $iPlayerHeight = (int)($iPlayerWidth * 405 / 720);
            $iPopupHeight = $iPlayerHeight + 80;
            $this->template()->assign(array(
                'iPopupWidth' => $iPopupWidth,
                'iPopupHeight' => $iPopupHeight,
                'iPlayerWidth' => $iPlayerWidth,
                'iPlayerHeight' => $iPlayerHeight
            ));
            $iWarningTextFontSize = 8;
            if ($iPlayerWidth > 670) {
                $iWarningTextFontSize = 12;
            } elseif ($iPlayerWidth > 600) {
                $iWarningTextFontSize = 11;
            } elseif ($iPlayerWidth > 585) {
                $iWarningTextFontSize = 10;
            } elseif ($iPlayerWidth > 530) {
                $iWarningTextFontSize = 9;
            }

            $iHeaderTextFontSize = 15;
            if ($iPlayerWidth > 520) {
                $iHeaderTextFontSize = 20;
            } elseif ($iPlayerWidth > 450) {
                $iHeaderTextFontSize = 19;
            } elseif ($iPlayerWidth > 380) {
                $iHeaderTextFontSize = 18;
            } elseif ($iPlayerWidth > 350) {
                $iHeaderTextFontSize = 17;
            } elseif ($iPlayerWidth > 310) {
                $iHeaderTextFontSize = 16;
            }
        }

        // Template specific JS and CSS
        if ($sBrowser == 'mobile') {
            $this->template()
                ->setHeader(array(
//					'dvs-mobile.css' => 'module_dvs',
//					'player-mobile.css' => 'module_dvs'
                    'mobile.css' => 'module_dvs',
                    'get_price_mobile.css' => 'module_dvs',
                    'share_email_mobile.css' => 'module_dvs',
                ));
        } else {
            $this->template()
                ->setHeader(array(
                    'jcarousellite.js' => 'module_dvs',
//					'dvs.css' => 'module_dvs',
//					'player.css' => 'module_dvs',
//					'google_maps.js' => 'module_dvs',
                    'overlay.js' => 'module_dvs',
//					'jquery.dropdown.js' => 'module_dvs',
//					'jquery.dropdown.css' => 'module_dvs',
                    'get_price.css' => 'module_dvs',
                    'share_email.css' => 'module_dvs',
                    'iframe-showroom.css' => 'module_dvs',
                ));
        }

        $sVdpIframeUrl = $this->url()->makeUrl('dvs.utm') . '?utm_source=' . str_replace('&', '', $aDvs['dealer_name']) . ' DVS';
        $sVdpIframeUrl .= '&utm_medium=VIN URL Player';
        $sVdpIframeUrl .= '&utm_content=' . str_replace('&', '', $aFirstVideo['name']);
        $sVdpIframeUrl .= '&utm_campaign=DVS Inventory';
        $sVdpIframeUrl = str_replace('http://', '//', $sVdpIframeUrl);
        $sVdpIframeUrl = str_replace('https://', '//', $sVdpIframeUrl);
        if(!$aDvs['is_active']) {
            $this->template()->setHeader('cache', array(
                'deactive.css' => 'module_dvs'
            ));
        }

        $sJavascript = '<script type="text/javascript">var sBrowser = "' . $sBrowser . '"</script>'
            . '<script type="text/javascript">var bDebug = ' . (Phpfox::getParam('dvs.javascript_debug_mode') ? 'true' : 'false') . '</script>'
            . '<script type="text/javascript">var bIsDvs = true</script>'
            . '<script type="text/javascript">var sFirstVideoTitleUrl = "' . $aFirstVideo['video_title_url'] . '";</script>'
            . '<script type="text/javascript">var sDvsTitleUrl = "' . $aDvs['title_url'] . '";</script>'
            . '<script type="text/javascript">var bGoogleAnalytics = true;</script>'
            . '<script type="text/javascript">var aCurrentVideoMetaData = [];</script>'
            . '<script type="text/javascript">aCurrentVideoMetaData.referenceId ="' . $aFirstVideo['referenceId'] . '";aCurrentVideoMetaData.year ="' . $aFirstVideo['year'] . '";aCurrentVideoMetaData.make ="' . $aFirstVideo['make'] . '";aCurrentVideoMetaData.model ="' . $aFirstVideo['model'] . '";</script> '
            . '<script type="text/javascript">' . $sDvsJs . '</script>'
            . '<script type="text/javascript">var bUpdatedShareUrl = true;</script>';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $this->template()->assign(array('bSecureConnection' => true));
            $sJavascript .= '<script type="text/javascript" src="//sadmin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>';
        } else {
            $sJavascript .= '<script type="text/javascript" src="//admin.brightcove.com/js/BrightcoveExperiences' . ($sBrowser == 'mobile' || $sBrowser == 'ipad' ? '' : '_all') . '.js"></script>';
        }

        $this->template()
            ->setTemplate('dvs-iframe-view')
            ->setTitle(($aOverrideVideo ? $aDvs['phrase_overrides']['override_page_title_display_video_specified'] : $aDvs['phrase_overrides']['override_page_title_display']))
            ->setMeta(array(
                'description' => ($aOverrideVideo ? $aDvs['phrase_overrides']['override_meta_description_meta_video_specified'] : $aDvs['phrase_overrides']['override_meta_description_meta']),
                'keywords' => ($aOverrideVideo ? $aDvs['phrase_overrides']['override_meta_keywords_meta_video_specified'] : $aDvs['phrase_overrides']['override_meta_keywords_meta']),
            ))
            ->setBreadcrumb(Phpfox::getPhrase('dvs.my_dealer_video_showrooms'))
            ->setHeader(array(
                //'player.js' => 'module_dvs',
                'iframe-player.js' => 'module_dvs',
                'shorten.js' => 'module_dvs',
//				'modernizr.js' => 'module_dvs',
                'google_analytics.js' => 'module_dvs',
                //'dvs.js' => 'module_dvs',
                'iframe-dvs.js' => 'module_dvs',
                '<meta property = "og:image" content = "' . $sThumbnailUrl . '"/>',
                // New css + js files added 2/14
                'chapter_buttons.css' => 'module_dvs',
                'dropdown.js' => 'module_dvs',
                'jquery.placeholder.js' => 'module_dvs'
            ))
            ->assign(array(
                'sVdpIframeUrl' => $sVdpIframeUrl,
                'sDvsRequest' => $sDvsRequest,
                'sVideoUrl' => $aVideo['video_title_url'],
                'sVideoThumb' => Phpfox::getLib('image.helper')->display(array(
                    'server_id' => $aVideo['server_id'],
                    'path' => 'core.url_file',
                    'file' => 'brightcove/' . $aVideo['thumbnail_image'],
                    'return_url' => true
                )),

                'aDvs' => $aDvs,
                'aCurrentVideo' => $aCurrentVideo,
                'aFirstVideo' => $aFirstVideo,
                'bc' => $this->request()->get('bc'),
                //'sBackgroundPath' => Phpfox::getParam('core.url_file') . 'dvs/background/' . $aDvs['background_file_name'],
                //'iBackgroundOpacity' => $iBackgroundOpacity,
                //'iBackgroundAlpha' => $iBackgroundAlpha,
                'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
                'aPlayer' => $aPlayer,
                'iDvsId' => $aDvs['dvs_id'],
                'sPrerollXmlUrl' => substr_replace(Phpfox::getLib('url')->makeUrl('dvs.player.prxml', array('id' => $aDvs['dvs_id'])), '', -1) . '  ? ',
                'aOverviewVideos' => $aOverviewVideos,
                'bPreview' => $bPreview,
                'bNoVideo' => $bNoVideo,
                'bIsDvs' => true,
                'bIsExternal' => false,
                'aFeaturedVideo' => $aFeaturedVideo,
                'aOverrideVideo' => $aOverrideVideo,
                'sLinkBase' => $sLinkBase,
                'aFirstVideoMeta' => $aFirstVideoMeta,
                'bOverrideOpenGraph' => true,
                'iLongDescLimit' => Phpfox::getParam('dvs.long_desc_limit'),
                'bSubdomainMode' => $bSubdomainMode,
                //'aFooterLinks' => $aFooterLinks,
                'sBrowser' => $sBrowser,
                'iWarningTextFontSize' => $iWarningTextFontSize,
                'iHeaderTextFontSize' => $iHeaderTextFontSize,
                'sCurrentUrlEncoded' => (Phpfox::getParam('dvs.enable_subdomain_mode') ? urlencode(Phpfox::getLib('url')->makeUrl($aDvs['title_url'], $aVideo['video_title_url'])) : urlencode(Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aVideo['video_title_url'])))),
                'sStaticPath' => Phpfox::getParam('core.path') . 'module/dvs/static/',
                'sJavascript' => $sJavascript,
                'aBaseUrl' => false
            ));
    }
}