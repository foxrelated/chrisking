<?php

class Dvs_Service_Inventory_Inventory extends Phpfox_Service {
    function __construct() {
        $this->_sTable = Phpfox::getT('tbd_dvs_inventory');
        Phpfox::getLib('setting')->setParam('dvs.csv_folder', PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'include' . PHPFOX_DS . 'service' . PHPFOX_DS . 'inventory' . PHPFOX_DS);
    }

    public function importFile() {
        $sFileName = Phpfox::getParam('dvs.csv_folder') . 'inventory.csv';
        $sDelimiter = ',';

        if (file_exists($sFileName) && is_readable($sFileName)) {
            $aHeader = null;
            if (($oOpenFileHandle = fopen($sFileName, 'r')) !== false) {
                while (($aRow = fgetcsv($oOpenFileHandle, 15000, $sDelimiter)) !== FALSE) {
                    if(!$aHeader) {
                        $aHeader = $aRow;
                    } else {
                        $aData = array_combine($aHeader, $aRow);
                        if (is_array($aRow)) {
                            $this->importRow($aData);
                        }
                    }
                }
                fclose($oOpenFileHandle);
            }
        }
        return true;
    }

    public function updateEdStyleId($iLimit = 20) {
        $aRows = $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('ed_style_id = 0')
            ->limit($iLimit)
            ->execute('getRows');

        foreach($aRows as $aRow) {
            list($aStyles, $aParams) = $this->getStyleByVin($aRow['squish_vin_id']);
            if(isset($aStyles[0]['id'])) {
                $this->database()->update($this->_sTable, array('ed_style_id' => $aStyles[0]['id']), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
            } else {
                $this->database()->update($this->_sTable, array('ed_style_id' => 1), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
            }
        }

        return $aRows;
    }

    public function importRow($aData) {
        $aVals = array(
            'dealer_id' => $aData['Dealer ID'],
            'squish_vin_id' => $this->getSquishVinCode($aData['VIN']),
            'make' => $aData['Make'],
            'model' => $aData['Model'],
            'year' => $aData['Model Year'],
            'ed_style_id' => 0
        );

        if(!$aData['Dealer ID']) {
            return false;
        }

        $aRow = $this->database()
            ->select('inventory_id, total')
            ->from($this->_sTable)
            ->where('squish_vin_id = \'' . $aVals['squish_vin_id'] . '\' AND dealer_id = \'' . $aVals['dealer_id'] . '\'')
            ->execute('getRow');

        if($aRow) {
            $this->database()->update($this->_sTable, array('total' => (int)$aRow['total'] + 1), 'inventory_id = ' . (int)$aRow['inventory_id']);
            return false;
        }

        $iId = $this->database()->insert($this->_sTable, $aVals);
        return $iId;
    }

    public function getSquishVinCode($sVin) {
        if(strlen($sVin) > 10) {
            $sQuishVin = substr($sVin, 0, 8) . substr($sVin, 9, 2);
            return $sQuishVin;
        }
        return false;
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