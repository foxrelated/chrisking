<?php

class Dvs_Service_Vin_Vin extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs_vin');
    }

    public function getVideoRefByVin($sVin, $iDvsId) {
        $sQuishVin = $sVin;
        if(strlen($sVin) > 10) {
            $sQuishVin = substr($sVin, 0, 8) . substr($sVin, 9, 2);
        }

        list($aStyles, $aParams) = $this->getStyleByVin($sQuishVin);
        if(isset($aStyles[0]['id']) && $sVideoId = $this->getVideoIdByEd($aStyles[0]['id'])) {
            return $sVideoId;
        } else {
            return '';
        }

        return '';
    }

    public function getVideoIdByEd($iEdStyleId) {
        $sVideoId = $this->database()
            ->select('video_id')
            ->from($this->_sTable)
            ->where('ed_style_id = ' . (int)$iEdStyleId)
            ->execute('getField');
        return $sVideoId;
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