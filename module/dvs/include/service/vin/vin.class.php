<?php

//require_once('ga/autoload.php');
//use UnitedPrototype\GoogleAnalytics;

class Dvs_Service_Vin_Vin extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs_vin_parsed');
    }

    function getEdStyles($aEdStyles, $iDvsId, $iWidth, $iHeight) {
        $aCompletedRows = array();
        foreach($aEdStyles as $sEdStyleId) {
            $aCompletedRows[$sEdStyleId] = array(
                'url' => ''
            );
        }

        if (!$aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            return array($aCompletedRows, array());
        }

        list($aData, $aReferenceIds) = $this->getAllVideoIdByEdStyles($aEdStyles);
        $aVideos = $this->database()
            ->select('b.ko_id, b.referenceId, b.video_title_url, b.year, b.make')
            ->from(Phpfox::getT('ko_brightcove'), 'b')
            ->where("b.referenceId IN ('" . implode("','", $aReferenceIds) . "')")
            ->execute('getRows');
        $aVideos2 = array();
        foreach($aVideos as $aVideo) {
            $aVideos2[$aVideo['referenceId']] = $aVideo['video_title_url'];
        }

        foreach($aData as $sKey => $aRow) {
            if(isset($aVideos2[$aRow['videoId']])) {
                $aData[$sKey]['video_title_url'] = $aVideos2[$aRow['videoId']];
            } else {
                $aData[$sKey]['video_title_url'] = '';
            }
        }

        foreach($aCompletedRows as $sKey => $aCompletedRow) {
            if (isset($aData[$sKey])) {
                $aCompletedRows[$sKey]['url'] = $aData[$sKey]['video_title_url'];
            } else {
                $aCompletedRows[$sKey]['url'] = '';
            }
        }

        foreach($aCompletedRows as $iKey => $aCompletedRow) {
            if(!$aCompletedRow['url']) {
                continue;
            }

            $aFind = array(
                'overview',
                'used-car-report',
                'test-drive'
            );

            $aReplace = array(
                ($aDvs['1onone_override'] ? $aDvs['1onone_override'] : (Phpfox::getParam('dvs.1onone_video_url_replacement') ? Phpfox::getParam('dvs.1onone_video_url_replacement') : 'overview')),
                ($aDvs['new2u_override'] ? $aDvs['new2u_override'] : (Phpfox::getParam('dvs.new2u_video_url_replacement') ? Phpfox::getParam('dvs.new2u_video_url_replacement') : 'used-car-report')),
                ($aDvs['top200_override'] ? $aDvs['top200_override'] : (Phpfox::getParam('dvs.top200_video_url_replacement') ? Phpfox::getParam('dvs.top200_video_url_replacement') : 'test-drive'))
            );

            $aCompletedRow['url'] = str_replace($aFind, $aReplace, $aCompletedRow['url']);

            if (Phpfox::getParam('dvs.dvs_info_video_url_replacement')) {
                $aCompletedRow['url'] .= '-' . $aDvs['title_url'] . '-' . strtolower(str_replace(' ', '-', $aDvs['city'])) . '-' . strtolower(str_replace(' ', '-', $aDvs['state_string']));
            }
            if($aDvs['vpd_popup']) {
                if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('dvs-vdp-iframe', $aCompletedRow['url'], 'width_' . $iWidth, 'height_' . $iHeight));
                } else {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], 'dvs-vdp-iframe', $aCompletedRow['url'], 'width_' . $iWidth, 'height_' . $iHeight));
                }
            } else {
                if ($aDvs['sitemap_parent_url'] && $aDvs['parent_video_url']) {
                    $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aCompletedRow['url'], $aDvs['parent_video_url']) . '&vdp=1';
                } else {
                    if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                        $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array($aCompletedRow['url'])) . 'vdp_1/';
                    } else {
                        $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aCompletedRow['url'])) . 'vdp_1/';
                    }
                }
            }

            $aCompletedRows[$iKey]['url'] = $sOverrideLink;
            $aCompletedRows[$iKey]['title_url'] = $aCompletedRow['url'];
        }

        return array($aCompletedRows, $aDvs);
    }

    public function getVins($aVins, $iDvsId, $iWidth, $iHeight, $bLoadCdk = false) {
        $aQuishVin = array();
        $aFullRows = array();
        $aCompletedRows = array();
        foreach($aVins as $sVin) {
            if($sQuishVin = $this->getQuishVin($sVin)) {
                $aFullRows[$sQuishVin]['ed_style_id'] = '';
                if(!isset($aFullRows[$sQuishVin])) {
                    $aFullRows[$sQuishVin]['vin'] = array();
                }

                $aQuishVin[] = $sQuishVin;
                $aFullRows[$sQuishVin]['vin'][] = $sVin;
                $aCompletedRows[$sVin] = array('squish_vin_id' => $sQuishVin, 'url' => '');
            }
        }

        if (!$aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            return array($aCompletedRows, array());
        }

        $aPlayer = Phpfox::getService('dvs.player')->get($iDvsId);
        $aMakes = array();
        foreach($aPlayer['makes'] as $aMake) {
            $aMakes[] = $aMake['make'];
        }

        $aAllowedYears = Phpfox::getParam('dvs.vf_overview_allowed_years');
        if(!$aDvs['new_car_videos']) {
            $sYears = Phpfox::getParam('research.new_model_year');
            $aYears = explode(',', $sYears);
            foreach($aAllowedYears as $iKey => $sYear) {
                if(in_array($sYear, $aYears)) {
                    unset($aAllowedYears[$iKey]);
                }
            }
        }

        if(!$aDvs['used_car_videos']) {
            $sYears = Phpfox::getParam('research.used_model_year_exclusion');
            $aYears = explode(',', $sYears);
            foreach($aAllowedYears as $iKey => $sYear) {
                if(!in_array($sYear, $aYears)) {
                    unset($aAllowedYears[$iKey]);
                }
            }
        }

        $aRows = $this->database()
            ->select('v.squish_vin_id, v.ed_style_id')
            ->from($this->_sTable, 'v')
            ->where('v.squish_vin_id IN (\'' . implode('\', \'', $aQuishVin) . '\')')
            ->execute('getRows');
        $aEdStyleIds = array();
        foreach($aRows as $aRow) {
            $aEdStyleIds[] = $aRow['ed_style_id'];
            $aFullRows[$aRow['squish_vin_id']]['ed_style_id'] = $aRow['ed_style_id'];
        }
        $aQuishVin = array();
        foreach($aFullRows as $sKey => $aFullRow) {
            if(!$aFullRow['ed_style_id']) {
                $aQuishVin[] = $sKey;
            }
        }

        foreach($aQuishVin as $sVin) {
            list($aStyles, $aParams) = $this->getStyleByVin($sVin);
            if(isset($aStyles[0]['id'])) {
                $this->database()->insert($this->_sTable, array(
                    'squish_vin_id' => $sVin,
                    'ed_style_id' => (int)$aStyles[0]['id']
                ));
                $aEdStyleIds[] = (string)$aStyles[0]['id'];
                $aFullRows[$sVin]['ed_style_id'] = (string)$aStyles[0]['id'];
            }
        }

        list($aData, $aReferenceIds) = $this->getAllVideoIdByEdStyles($aEdStyleIds);

        $aVideos = $this->database()
            ->select('b.ko_id, b.referenceId, b.video_title_url, b.year, b.make')
            ->from(Phpfox::getT('ko_brightcove'), 'b')
            ->where("b.referenceId IN ('" . implode("','", $aReferenceIds) . "')")
            ->execute('getRows');
        $aVideos2 = array();
        foreach($aVideos as $aVideo) {
            $aVideos2[$aVideo['referenceId']] = $aVideo['video_title_url'];
        }

        foreach($aData as $sKey => $aRow) {
            if(isset($aVideos2[$aRow['videoId']])) {
                $aData[$sKey]['video_title_url'] = $aVideos2[$aRow['videoId']];
            }
        }

        foreach($aFullRows as $sKey => $aFullRow) {
            if(isset($aData[$aFullRow['ed_style_id']])) {
                foreach($aFullRow['vin'] as $sVin) {
                    if(isset($aData[$aFullRow['ed_style_id']]['video_title_url'])) {
                        $aCompletedRows[$sVin]['url'] = $aData[$aFullRow['ed_style_id']]['video_title_url'];
                    } else {
                        $aCompletedRows[$sVin]['url'] = '';
                    }

                }
            }
        }

        foreach($aCompletedRows as $iKey => $aCompletedRow) {
            if(!$aCompletedRow['url']) {
                continue;
            }

            $aFind = array(
                'overview',
                'used-car-report',
                'test-drive'
            );

            $aReplace = array(
                ($aDvs['1onone_override'] ? $aDvs['1onone_override'] : (Phpfox::getParam('dvs.1onone_video_url_replacement') ? Phpfox::getParam('dvs.1onone_video_url_replacement') : 'overview')),
                ($aDvs['new2u_override'] ? $aDvs['new2u_override'] : (Phpfox::getParam('dvs.new2u_video_url_replacement') ? Phpfox::getParam('dvs.new2u_video_url_replacement') : 'used-car-report')),
                ($aDvs['top200_override'] ? $aDvs['top200_override'] : (Phpfox::getParam('dvs.top200_video_url_replacement') ? Phpfox::getParam('dvs.top200_video_url_replacement') : 'test-drive'))
            );

            $aCompletedRow['url'] = str_replace($aFind, $aReplace, $aCompletedRow['url']);

            if (Phpfox::getParam('dvs.dvs_info_video_url_replacement')) {
                $aCompletedRow['url'] .= '-' . $aDvs['title_url'] . '-' . strtolower(str_replace(' ', '-', $aDvs['city'])) . '-' . strtolower(str_replace(' ', '-', $aDvs['state_string']));
            }
            if($aDvs['vpd_popup']) {
                if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('dvs-vdp-iframe', $aCompletedRow['url'], 'width_' . $iWidth, 'height_' . $iHeight, 'cdk_' . ($bLoadCdk ? '1' : '0')));
                } else {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], 'dvs-vdp-iframe', $aCompletedRow['url'], 'width_' . $iWidth, 'height_' . $iHeight, 'cdk_' . ($bLoadCdk ? '1' : '0')));
                }
            } else {
                if ($aDvs['sitemap_parent_url'] && $aDvs['parent_video_url']) {
                    $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aCompletedRow['url'], $aDvs['parent_video_url']) . '&vdp=1&cdk=' . ($bLoadCdk ? '1' : '0');
                } else {
                    if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                        $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array($aCompletedRow['url'])) . 'vdp_1/cdk_' . ($bLoadCdk ? '1/' : '0/');
                    } else {
                        $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], $aCompletedRow['url'])) . 'vdp_1/cdk_' . ($bLoadCdk ? '1/' : '0/');
                    }
                }
            }

            $aCompletedRows[$iKey]['url'] = $sOverrideLink;
            $aCompletedRows[$iKey]['title_url'] = $aCompletedRow['url'];
        }


        /** SEND GA EVENT */

        /*if($aDvs['dvs_google_id']) {
            $tracker = new GoogleAnalytics\Tracker($aDvs['dvs_google_id'], 'domain.com');
        } else {
        $tracker = new GoogleAnalytics\Tracker(Phpfox::getParam('dvs.global_google_id'), 'wtvdvs.com');
        }
        $visitor = new GoogleAnalytics\Visitor();
        $visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
        $visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $session = new GoogleAnalytics\Session();
        $event = new GoogleAnalytics\Event();
        $event->setCategory($aDvs['dvs_name'] . ' DVS Site');
        $event->setAction('Inventory Page');
        $event->setLabel('Inventory Pageviews');
        $event->setValue('1');
        $tracker->trackEvent($event, $session, $visitor);*/
        return array($aCompletedRows, $aDvs);
    }

    public function getQuishVin($sVin) {
        if(strlen($sVin) > 10) {
            $sQuishVin = substr($sVin, 0, 8) . substr($sVin, 9, 2);
            return $sQuishVin;
        }
        return false;
    }

    public function getVideoIdByEdStyle($iEdStyleId) {
        $aVideo = $this->database()
            ->select('v.video_id, b.ko_id, b.referenceId, b.video_title_url, b.year, b.make')
            ->from(Phpfox::getT('ko_dvs_vin'), 'v')
            ->leftJoin(Phpfox::getT('ko_brightcove'), 'b', 'v.video_id = b.referenceId')
            ->where('v.ed_style_id = ' . (int)$iEdStyleId)
            ->execute('getRow');
        return $aVideo;
    }

    public function getAllVideoIdByEdStyles($aEdStyleIds) {
        $sEdStyleIds = implode('/', $aEdStyleIds) . '/';
        $sTargetUrl = 'http://api.wheelstv.co/v1/edstyleId/' . $sEdStyleIds;
        $ch = curl_init($sTargetUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $oResponse = curl_exec($ch);
        $oOutput= @json_decode($oResponse);

        $aData = array();
        $aReferenceIds = array();
        foreach($oOutput->items as $aItem) {
            $aData[$aItem->edStyleId] = array(
                'videoId' => $aItem->videoId,
                'wtvId' => $aItem->wtvId
            );
            $aReferenceIds[] = $aItem->videoId;
        }
        return array($aData, $aReferenceIds);
    }

    public function getYearFromVin($sVin) {
        $sYearChar = substr($sVin,6,1);

        if (is_numeric($sYearChar)) {
            $sType = 'num';
        } else {
            $sType = 'alpha';
        }

        $aLookupYear = $this->database()
            ->select('b.year')
            ->from(Phpfox::getT('dvs_vin_year_lookup'), 'b')
            ->where('b.vin_digit = "' . $sYearChar . '" AND b.type = "' . $sType . '"')
            ->execute('getRow');

        $iYear = isset($aLookupYear['year']) ? intval($aLookupYear['year']) : 0;

        return $iYear;
    }


    public function getStyleByVin($sVin) {
        $aParams = array();
        $aStyles = array();

        // Exit if VIN year < 2008
        if ($this->getYearFromVin($sVin) < 2008) {
            return array($aStyles, $aParams);
        }

        // Check from Parsed_Notfound
        $aVinnf = $this->database()
            ->select('b.*')
            ->from(Phpfox::getT('ko_dvs_vin_parsed_notfound'), 'b')
            ->where('b.squishvin = "' . $sVin . '"')
            ->execute('getRows');
        if (count($aVinnf) > 0) {
            return array($aStyles, $aParams);
        }

        $sApiKey = 'wztmmwrvnegb6b547asz8u2a';
        //https://api.edmunds.com/api/vehicle/v2/squishvins/SQUISHVIN/?fmt=json&api_key=wztmmwrvnegb6b547asz8u2a
        $sTargetUrl = "https://api.edmunds.com/api/vehicle/v2/squishvins/" . trim($sVin) . "/?fmt=json&api_key=" . $sApiKey;
        $ch = curl_init($sTargetUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $oResponse = curl_exec($ch);

        $oOutput= @json_decode($oResponse);

        if ($oOutput === null || !isset($oOutput->make)) {
            // Track error VIN
            $this->database()->insert(Phpfox::getT('ko_dvs_vin_parsed_notfound'), array(
                'vin' => '',
                'squishvin' => $sVin,
                'source' => 'VDP or VIN Embed'
            ));
            return array($aStyles, $aParams);
        }

        if(isset($oOutput->make)) {
            $aParams['make'] = $oOutput->make->name;
        }

        if(isset($oOutput->make)) {
            $aParams['model'] = $oOutput->model->name;
        }

        $aParams['year'] = array();
        if(isset($oOutput->years)) {
            foreach($oOutput->years as $oYear) {
                $aParams['year'][] = $oYear->year;
            }
        }

        if(isset($oOutput->categories->vehicleStyle)) {
            $aParams['bodyStyle'] = $oOutput->categories->vehicleStyle;
        }

        $aYears = $this->objectToArray($oOutput->years);

        if (isset($aYears[0]['styles'])) {
            $aStyles = $aYears[0]['styles'];
        } else {
            return array($aStyles, $aParams);
        }

        return array($aStyles, $aParams);
    }

    function objectToArray( $object ) {
        if( !is_object( $object ) && !is_array( $object ) ) {
            return $object;
        }
        if( is_object( $object ) ) {
            $object = (array) $object;
        }

        foreach($object as $iKey => $aObject) {
            $object[$iKey] = $this->objectToArray($aObject);
        }

        return $object;
    }
}
?>