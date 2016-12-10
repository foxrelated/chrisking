<?php
defined('PHPFOX') or exit('NO DICE!');

class Share_Component_Controller_Index extends Phpfox_Component {
    public function process() {
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');
        $sShareRequest = $this->request()->get('req2');
        $bIsOldShareSystem = false;

        if ($sShareRequest) {
            if ($this->request()->get('parent')) {
                if ($aDvs = Phpfox::getService('dvs')->get($sShareRequest, true)) {
                    $bIsOldShareSystem = true;
                    $sShare = $this->request()->get('share', '');

                    $sParentUrl = urldecode(base64_decode($this->request()->get('parent')));
                    $sOverride = $this->request()->get('video');
                    $sRedirectUrl = str_replace('WTVDVS_VIDEO_TEMP', $sOverride, $sParentUrl);
                    if ($sShare != '') {
                        $sRedirectUrl .= '&share=' . $sShare;
                    }

                    Phpfox::getService('dvs.video')->setDvs($aDvs['dvs_id']);

                    $aOverviewVideos = Phpfox::getService('dvs.video')->getOverviewVideos($aDvs['dvs_id']);

                    //Here we shift array keys to start at 1 so thumbnails play the proper videos when we load a featured video or override video on to the front of the array
                    array_unshift($aOverviewVideos, '');
                    unset($aOverviewVideos[0]);

                    if ($sOverride) {
                        $aOverrideVideo = Phpfox::getService('dvs.video')->get($sOverride, true);
                    } else {
                        $aOverrideVideo = array();
                    }

                    //Dupe check
                    if (!empty($aOverrideVideo)) {
                        foreach ($aOverviewVideos as $iKey => $aVideo) {
                            if ($iKey == 0) {
                                continue;
                            }
                        }
                    }

                    if ($aOverrideVideo) {
                        $aFirstVideo = $aOverrideVideo;
                    } else {
                        $aFirstVideo = $aOverviewVideos[1];
                    }

                    $aCurrentVideo = 0;
                    foreach ($aOverviewVideos as $iKey => $aVideo) {
                        if (($aFirstVideo['year'] == $aVideo['year']) AND ($aFirstVideo['make'] == $aVideo['make']) AND ($aFirstVideo['model'] == $aVideo['model'])) {
                            $aCurrentVideo = $iKey;
                            break;
                        }
                    }

//                    if (file_exists(PHPFOX_DIR_FILE . "brightcove" . PHPFOX_DS . $aFirstVideo['thumbnail_image'])) {
//                        $sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'file.brightcove') . $aFirstVideo['thumbnail_image'];
//                    } else {
//                        $sThumbnailUrl = Phpfox::getLib('url')->makeUrl(($bSubdomainMode ? 'www.' : '') . 'theme.frontend.default.style.default.image.noimage') . 'item.png';
//                    }
//                    $sThumbnailUrl = str_replace('index.php?do=/', '', $sThumbnailUrl);

                    $sThumbnailUrl = Phpfox::getLib('image.helper')->display(array(
                        'img server_id' => $aFirstVideo['image_server_id'],
                        'path' => 'brightcove.url_image',
                        'file' => $aFirstVideo['image_path'],
//                        'suffix' => '_email_300',
                        'suffix' => '_500',
                        'return_url' => true
                    ));

                    $sTwitterThumbnailUrl = Phpfox::getLib('image.helper')->display(array(
                        'img server_id' => $aVideo['image_server_id'],
                        'path' => 'brightcove.url_image',
                        'file' => $aVideo['image_path'],
                        'suffix' => '_email_500',
                        'return_url' => true
                    ));

                    $aFirstVideoMeta = array(
                        'url' => Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $aFirstVideo['video_title_url']),
                        'thumbnail_url' => $sThumbnailUrl,
                        'upload_date' => date('Y-m-d', (int)($aFirstVideo['publishedDate'] / 1000)),
                        'duration' => 'PT' . (int)($aFirstVideo['length'] / 1000) . 'S',
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
                            'sRedirectUrl' => $sRedirectUrl,
                            'sTwitterThumbnailUrl' => $sTwitterThumbnailUrl
                        ));
                }
            }
            
            if (!$bIsOldShareSystem) {
                $oShareService = Phpfox::getService('dvs.share');
                $iVideoId = $oShareService->convertHashCodeToNumber(substr($sShareRequest, 0, 5));
                $iDvs = $oShareService->convertHashCodeToNumber(substr($sShareRequest, 5, 3));
                $iShareType = substr($sShareRequest, 8, 1);
                if ($aDvs = Phpfox::getService('dvs')->get($iDvs)) {
                    Phpfox::getService('dvs.video')->setDvs($iDvs);
                    $aVideo = Phpfox::getService('dvs.video')->getVideoByKoId($iVideoId);
                    if ($aDvs['sitemap_parent_url'] && $aDvs['parent_video_url']) {
                        $sRedirectUrl = str_replace('WTVDVS_VIDEO_TEMP', $aVideo['video_title_url'], $aDvs['parent_video_url']);
                        if (isset($aDvs['modal_player']) && ($aDvs['modal_player'] == 1)) {
                            $sRedirectUrl = str_replace('?video=', '?wtvVideo=', $sRedirectUrl);
                        }
                        switch ($iShareType) {
                            case '0':
                                $sRedirectUrl .= '&share=facebook';
                                break;
                            case '1':
                                $sRedirectUrl .= '&share=twitter';
                                break;
                            case '2':
                                $sRedirectUrl .= '&share=google';
                                break;
                            case '3':
                                $sRedirectUrl .= '&share=crm';
                                break;
                            case '4':
                                $sRedirectUrl .= '&share=direct';
                                break;
                            case '5':
                                $sRedirectUrl .= '&share=qrcode';
                                break;
                            case '6':
                                $sRedirectUrl .= '&share=email';
                                break;
                            case '7':
                                $sRedirectUrl .= '&share=text';
                                break;
                            case '8':
                                $sRedirectUrl .= '&share=video-email';
                                break;    
                        }
                    } else {
                        $sRedirectUrl = Phpfox::getLib('url')->makeUrl($aDvs['title_url']) . $aVideo['video_title_url'];
                        switch ($iShareType) {
                            case '0':
                                $sRedirectUrl .= '/share_facebook/';
                                break;
                            case '1':
                                $sRedirectUrl .= '/share_twitter/';
                                break;
                            case '2':
                                $sRedirectUrl .= '/share_google/';
                                break;
                            case '3':
                                $sRedirectUrl .= '/share_crm/';
                                break;
                            case '4':
                                $sRedirectUrl .= '/share_direct/';
                                break;
                            case '5':
                                $sRedirectUrl .= '/share_qrcode/';
                                break;
                            case '6':
                                $sRedirectUrl .= '/share_email/';
                                break;
                            case '7':
                                $sRedirectUrl .= '/share_text/';
                                break;
                            case '8':
                                $sRedirectUrl .= '&share=video-email';
                                break;        
                        }
                    }

                    $sThumbnailUrl = Phpfox::getLib('image.helper')->display(array(
                        'img server_id' => $aVideo['image_server_id'],
                        'path' => 'brightcove.url_image',
                        'file' => $aVideo['image_path'],
//                        'suffix' => '_email_300',
                        'suffix' => '_500',
                        'return_url' => true
                    ));

                    $sTwitterThumbnailUrl = Phpfox::getLib('image.helper')->display(array(
                        'img server_id' => $aVideo['image_server_id'],
                        'path' => 'brightcove.url_image',
                        'file' => $aVideo['image_path'],
                        'suffix' => '_email_500',
                        'return_url' => true
                    ));

                    $aVideoMeta = array(
                        'url' => Phpfox::getLib('url')->makeUrl((Phpfox::getService('dvs')->getCname() ? Phpfox::getService('dvs')->getCname() : 'dvs'), $aVideo['video_title_url']),
                        'thumbnail_url' => $sThumbnailUrl,
                        'upload_date' => date('Y-m-d', (int)($aVideo['publishedDate'] / 1000)),
                        'duration' => 'PT' . (int)($aVideo['length'] / 1000) . 'S',
                        'name' => $aVideo['name'],
                        'year' => $aVideo['year'],
                        'make' => $aVideo['make'],
                        'model' => $aVideo['model'],
                        'description' => Phpfox::getLib('parse.output')->clean($aVideo['longDescription']),
                        'referenceId' => $aVideo['referenceId']
                    );

                    $this->template()
                        ->setTemplate('redirect-template')
                        ->assign(array(
                            'aDvs' => $aDvs,
                            'aFirstVideo' => $aVideo,
                            'aFirstVideoMeta' => $aVideoMeta,
                            'sRedirectUrl' => $sRedirectUrl,
                            'sTwitterThumbnailUrl' => $sTwitterThumbnailUrl
                        ));
                } else {
                    $this->url()->send('');
                }
            }
        } else {
            $this->url()->send('');
        }
    }
}

?>