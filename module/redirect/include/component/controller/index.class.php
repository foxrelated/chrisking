<?php

class Redirect_Component_Controller_Index extends Phpfox_Component {
    public function process() {
        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $sDvsRequest = $this->request()->get('req2');

        if ($aDvs = Phpfox::getService('dvs')->get($sDvsRequest, true)) {
            $sParentUrl = base64_decode($this->request()->get('parent'));
            $sOverride = $this->request()->get('video');

            $sRedirectUrl = str_replace('WTVDVS_VIDEO_TEMP', $sOverride, $sParentUrl);

            Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);

            $aOverviewVideos = Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']);

            //Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
            array_unshift($aOverviewVideos, '');
            unset($aOverviewVideos[0]);

            if ($sOverride)
            {
                $aOverrideVideo = Phpfox::getService('dvs.video')->get($sOverride, true);
            }
            else
            {
                $aOverrideVideo = array();
            }

            //Dupe check
            if (!empty($aOverrideVideo) || !empty($aFeaturedVideo))
            {
                foreach ($aOverviewVideos as $iKey => $aVideo)
                {
                    if ($iKey == 0)
                    {
                        //Don't unset the featured video
                        continue;
                    }

                    if ((!empty($aFeaturedVideo) && $aVideo['id'] == $aFeaturedVideo['id']) || (!empty($aOverrideVideo) && $aVideo['id'] == $aOverrideVideo['id']))
                    {
                        //Remove dupe
                        //unset($aOverviewVideos[$iKey]);
                    }
                }
            }

            if ($aOverrideVideo)
            {
                $aFirstVideo = $aOverrideVideo;
            }
            else if ($aFeaturedVideo)
            {
                $aFirstVideo = $aFeaturedVideo;
            }
            else
            {
                $aFirstVideo = $aOverviewVideos[1];
            }

            $aCurrentVideo = 0;
            foreach ($aOverviewVideos as $iKey => $aVideo)
            {
                if( ($aFirstVideo['year'] == $aVideo['year']) AND ($aFirstVideo['make'] == $aVideo['make']) AND ($aFirstVideo['model'] == $aVideo['model']))
                {
                    $aCurrentVideo = $iKey;
                    break;
                }
            }

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

            $this->template()
                ->setTemplate('redirect-template')
                ->assign(array(
                    'aDvs' => $aDvs,
                    'aFirstVideo' => $aFirstVideo,
                    'aFirstVideoMeta' => $aFirstVideoMeta,
                    'sRedirectUrl' => $sRedirectUrl
            ));

        } else {
            $this->url()->send('');
        }
    }
}

//http://localhost/dvs/redirect/showroomtest/parent_aHR0cDovL2xvY2FsaG9zdC9kdnMuaHRtbD92aWRlbz1XVFZEVlNfVklERU9fVEVNUA==/video_2014-bmw-x3-new-car-showroomtest-deland-florida

//http://localhost/dvs/redirect/showroomtest/parent_aHR0cDovL2xvY2FsaG9zdC9kdnMvZHZzL3Nob3dyb29tdGVzdC9pZnJhbWUvV1RWRFZTX1ZJREVPX1RFTVA=/video_2014-bmw-x3-new-car-showroomtest-deland-florida
?>