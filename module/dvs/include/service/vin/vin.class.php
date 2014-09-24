<?php

class Dvs_Service_Vin_Vin extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs_vin_parsed');
    }

    public function getVins($aVins, $iDvsId) {
        $aQuishVin = array();
        $aFullRows = array();
        $aCompletedRows = array();
        foreach($aVins as $sVin) {
            if($sQuishVin = $this->getQuishVin($sVin)) {
                $aQuishVin[] = $sQuishVin;
                $aFullRows[$sQuishVin] = array('vin' => $sVin);
                $aCompletedRows[$sVin] = array('quish_vin_id' => $sQuishVin, 'url' => '');
            }
        }

        if (!$aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            return $aCompletedRows;
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
            ->select('v.quish_vin_id, b.referenceId, b.video_title_url, b.make, b.year')
            ->from($this->_sTable, 'v')
            ->leftJoin(Phpfox::getT('ko_brightcove'), 'b', 'b.ko_id = v.ko_id')
            ->where('v.quish_vin_id IN (\'' . implode('\', \'', $aQuishVin) . '\')')
            ->execute('getRows');

        foreach($aRows as $aRow) {
            if(in_array($aRow['quish_vin_id'], $aQuishVin)) {
                if(!in_array($aRow['year'], explode(',', Phpfox::getParam('research.used_model_year_exclusion'))) || (in_array($aRow['year'], $aAllowedYears) && in_array($aRow['make'], $aMakes))) {
                    $aCompletedRows[$aFullRows[$aRow['quish_vin_id']]['vin']]['url'] = $aRow['video_title_url'];
                }
                unset($aFullRows[$aRow['quish_vin_id']]);
            }
        }

        foreach($aFullRows as $sKey => $aFullRow) {
            $aRow = $this->database()
                ->select('v.quish_vin_id, b.referenceId, b.video_title_url, b.make, b.year')
                ->from($this->_sTable, 'v')
                ->leftJoin(Phpfox::getT('ko_brightcove'), 'b', 'b.ko_id = v.ko_id')
                ->where('v.quish_vin_id = \'' . $sKey . '\'')
                ->execute('getRow');

            if($aRow) {
                if(!in_array($aRow['year'], explode(',', Phpfox::getParam('research.used_model_year_exclusion'))) || (in_array($aRow['year'], $aAllowedYears) && in_array($aRow['make'], $aMakes))) {
                    $aCompletedRows[$aFullRow['vin']]['url'] = $aRow['video_title_url'];
                }
                continue;
            }

            list($aStyles, $aParams) = $this->getStyleByVin($sKey);
            if(isset($aStyles[0]['id']) && $aVideo = $this->getVideoIdByEdStyle($aStyles[0]['id'])) {
                if(isset($aVideo['ko_id']) && $aVideo['ko_id']) {
                    $this->database()->insert($this->_sTable, array(
                        'quish_vin_id' => $sKey,
                        'ed_style_id' => (int)$aStyles[0]['id'],
                        'ko_id' => (int)$aVideo['ko_id'],
                        'referenceId' => $aVideo['referenceId']
                    ));
                    if (!in_array($aVideo['year'], explode(',', Phpfox::getParam('research.used_model_year_exclusion'))) || (in_array($aVideo['year'], $aAllowedYears) && in_array($aVideo['make'], $aMakes))) {
                        $aCompletedRows[$aFullRow['vin']]['url'] = $aVideo['video_title_url'];
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
            
            if ($aDvs['sitemap_parent_url'] && $aDvs['parent_video_url']) {
                $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aCompletedRow['url'], $aDvs['parent_video_url']);
            } else {
                if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('iframe', $aCompletedRow['url']));
                } else {
                    $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs.iframe', array($aDvs['title_url'], $aCompletedRow['url']));
                }
            }

            $aCompletedRows[$iKey]['url'] = $sOverrideLink;
        }

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

    public function getStyleByVin($sVin) {
        $aParams = array();
        $aStyles = array();
        $sApiKey = 'wztmmwrvnegb6b547asz8u2a';

        $sTargetUrl = "https://api.edmunds.com/api/vehicle/v2/squishvins/" . trim($sVin) . "/?fmt=json&api_key=" . $sApiKey;
        $ch = curl_init($sTargetUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $oResponse = curl_exec($ch);

        $oOutput= @json_decode($oResponse);

        if ($oOutput === null || !isset($oOutput->make)) {
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