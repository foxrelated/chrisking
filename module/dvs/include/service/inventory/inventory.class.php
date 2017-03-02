<?php

class Dvs_Service_Inventory_Inventory extends Phpfox_Service {
    //private $_sHost = 'sftp.dmotorworks.com';
    //private $_sPort = '22';
    //private $_sUsername = 'WTVMain';
    //private $_sPassword = '$new123';

	private $_sHost = 'dealervideoshowroom.com';
    private $_sPort = '22';
    private $_sUsername = 'dvs';
    private $_sPassword = 'wh33l5tvh0trod';
	
    function __construct() {
        $this->_sTable = Phpfox::getT('tbd_dvs_inventory');
        Phpfox::getLib('setting')->setParam('dvs.csv_folder', PHPFOX_DIR . 'file' . PHPFOX_DS . 'inventory' . PHPFOX_DS);
    }

    public function importFile() {
        $this->database()->update($this->_sTable, array('is_updated' => 0, 'total' => 0, 'is_video_updated' => 0), '1');
        $this->database()->update($this->_sTable, array('ed_style_id' => 0), 'ed_style_id < 10');

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

        $this->database()->delete($this->_sTable, 'is_updated = 0');
        return true;
    }

    public function importRow($aData) {
        $aVals = array(
            'dealer_id' => $aData['DEALER_ID'],
            'vin_id' => $aData['VIN'],
            'squish_vin_id' => $this->getSquishVinCode($aData['VIN']),
            'make' => $aData['MAKE'],
            'model' => $aData['MODEL'],
            'year' => $aData['MODEL_YEAR'],
            'ed_style_id' => 0,
            'is_updated' => 1,
            'total' => 1
        );

        if(!$aData['DEALER_ID']) {
            return false;
        }

        $aRow = $this->database()
            ->select('inventory_id, total')
            ->from($this->_sTable)
            ->where('vin_id = \'' . $aVals['vin_id'] . '\' AND dealer_id = \'' . $aVals['dealer_id'] . '\'')
            ->execute('getRow');

        if($aRow) {
            $this->database()->update($this->_sTable, array(
                    'is_updated' => 1,
                    'total' => (int)$aRow['total'] + 1
                ), 'inventory_id = ' . (int)$aRow['inventory_id']);
            return $aRow['inventory_id'];
        }

        $iId = $this->database()->insert($this->_sTable, $aVals);
        return $iId;
    }

    public function updateEdStyleId($iLimit = 20) {
        $aRows = $this->database()
            ->select('i.inventory_id, i.squish_vin_id, i.ed_style_id,i.vin_id, vin.ed_style_id AS ed_style_id_parsed')
            ->from($this->_sTable, 'i')
            ->leftJoin(Phpfox::getT('ko_dvs_vin_parsed'), 'vin', 'i.squish_vin_id = vin.squish_vin_id')
            ->where('i.ed_style_id < 5')
            ->group('i.squish_vin_id')
            ->limit($iLimit)
            ->order('i.inventory_id')
            ->execute('getRows');

        foreach($aRows as $aRow) {                   
            if($aRow['ed_style_id_parsed'] > 0) {    
                $this->database()->update($this->_sTable, array('ed_style_id' => $aRow['ed_style_id_parsed']), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
            } else {
                $qsvin = $aRow['squish_vin_id'];
                $qvin = $aRow['vin_id'];
                
                
                $ch = substr($qvin,6,1);

                if (is_numeric($ch)) {
                    $type = "num";
                } else {
                    $type = "alpha";
                }
                
                $aLookupYear = $this->database()
                    ->select('b.year')
                    ->from(Phpfox::getT('dvs_vin_year_lookup'), 'b')
                    ->where("b.vin_digit = '".$ch."' AND b.type = '".$type."'")
                    ->execute('getRow');

                $qsyear = isset($aLookupYear['year']) ? intval($aLookupYear['year']) : 0;
                if($qsyear < 2008) {
                    $this->database()->update($this->_sTable, array('ed_style_id' => 5), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
                } else {
                    $aVinnf = $this->database()
                        ->select('b.*')
                        ->from(Phpfox::getT('ko_dvs_vin_parsed_notfound'), 'b')
                        ->where("b.vin = '".$qvin."' AND b.squishvin = '".$qsvin."'")
                        ->execute('getRows');
                    $rowCount = count($aVinnf);

                    if ($rowCount > 0) {
                        $this->database()->update($this->_sTable, array('ed_style_id' => 5), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
                    } else {
                        list($aStyles, $aParams) = $this->getStyleByVin($aRow['squish_vin_id'],$aRow['vin_id']);

                        if(isset($aStyles[0]['id'])) {
                            $this->database()->insert(Phpfox::getT('ko_dvs_vin_parsed'), array(
                                'squish_vin_id' => $aRow['squish_vin_id'],
                                'ed_style_id' => $aStyles[0]['id']
                            ));
                            $this->database()->update($this->_sTable, array('ed_style_id' => $aStyles[0]['id']), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
                        } else {
                            // MARK THIS INVENTORY
                            $this->database()->update($this->_sTable, array('ed_style_id' => (int)$aRow['ed_style_id'] + 1), 'squish_vin_id = \'' . $aRow['squish_vin_id'] . '\'');
                        }
                   }
                }
            }
        }

        return $aRows;
    }

    public function updateReferenceId($iLimit = 20) {
        $aRows = $this->database()
            ->select('i.inventory_id, i.squish_vin_id, i.ed_style_id, i.referenceId')
            ->from($this->_sTable, 'i')
            ->where('i.ed_style_id > 5 AND i.referenceId IS NULL AND i.is_video_updated = 0')
            ->group('i.ed_style_id')
            ->limit($iLimit)
            ->execute('getRows');

        $aEdStyleIds = array();
        foreach($aRows as $aRow) {
            $aEdStyleIds[] = $aRow['ed_style_id'];
        }

        if(!count($aEdStyleIds)) {
            return false;
        }

        list($aData, $aReferenceIds) = $this->getAllVideoIdByEdStyles($aEdStyleIds);
        foreach($aEdStyleIds as $iEdStyleId) {
            if(isset($aData[$iEdStyleId])) {
                $this->database()->update($this->_sTable, array('referenceId' => $aData[$iEdStyleId]['videoId']), 'ed_style_id = ' . (int)$iEdStyleId);
            } else {
                $this->database()->update($this->_sTable, array('is_video_updated' => 1), 'ed_style_id = ' . (int)$iEdStyleId);
            }
        }

        return true;
    }

    public function getPending($sType = 'style') {
        if($sType == 'style') {
            $sWhere = 'ed_style_id < 5';
        } else {
            $sWhere = 'ed_style_id > 5 AND referenceId IS NULL AND is_video_updated = 0';
        }

        $iTotal = $this->database()
            ->select('COUNT(*)')
            ->from($this->_sTable)
            ->where($sWhere)
            ->execute('getField');
        return $iTotal;
    }

    public function getSquishVinCode($sVin) {
        if(strlen($sVin) > 10) {
            $sQuishVin = substr($sVin, 0, 8) . substr($sVin, 9, 2);
            return $sQuishVin;
        }
        return false;
    }

    public function getAllVideoIdByEdStyles($aEdStyleIds) {
        $sEdStyleIds = implode('/', $aEdStyleIds) . '/';
        $sTargetUrl = 'http://api.wheelstv.co/v1/edstyleid/' . $sEdStyleIds;
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

    public function getStyleByVin($sVin,$cstvin = '') {
        $aParams = array();
        $aStyles = array();
        $sApiKey = 'wztmmwrvnegb6b547asz8u2a';

        $sTargetUrl = "https://api.edmunds.com/api/vehicle/v2/squishvins/" . trim($sVin) . "/?fmt=json&api_key=" . $sApiKey;
        $ch = curl_init($sTargetUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $oResponse = curl_exec($ch);

        $oOutput= @json_decode($oResponse);
        $logg = 0;

        if (isset($oOutput->status) && ($oOutput->status == "NOT_FOUND")) {
            $referer = "Inventory Cron";
            
            $q = $this->database()->insert(Phpfox::getT('ko_dvs_vin_parsed_notfound'), array(
                'vin' => $cstvin,
                'squishvin' => $sVin,
                'source' => $referer,
            ));
            
            if($logg == 1) {
                $log_file =  PHPFOX_DIR.'module/dvs/vin_log.txt';
                $log_data = "[".date('Y/m/d h:i:s a', time())."] 404 Error for squish VIN :" . $sVin . ". API source : Inventory Update \n";
            
                $f = fopen($log_file,'a');
                fwrite($f, $log_data);
                fclose($f);
            }
            
        }

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

    public function downloadZipFile() {
        if (!function_exists("ssh2_connect")) {
            die('Function ssh2_connect not found, you cannot use ssh2 here');
            return false;
        }

        if (!$oConnection = ssh2_connect($this->_sHost, $this->_sPort)) {
            die('Unable to connect');
            return false;
        }


        if (!ssh2_auth_password($oConnection, $this->_sUsername, $this->_sPassword)) {
            die('Unable to authenticate.');
            return false;
        }


        if (!$oStream = ssh2_sftp($oConnection)) {
            die('Unable to create a stream.');
            return false;
        }


        if (!$oDir = opendir("ssh2.sftp://{$oStream}/./home/dvs/public_html/feeds/output/")) {
            die('Could not open the directory');
            return false;
        }

         
        $sFile = '';
        while (false !== ($sTempFile = readdir($oDir))) {
            if ($sTempFile == "." || $sTempFile == "..")
                continue;
            if(strpos($sTempFile, 'VINVENTORY') === 0) {
                $sFile = $sTempFile;
                break;
            }
        }
        
        if(!$sFile) {   
            die('Could not find VINVENTORY.zip');
            return false;
        }

        if (!$fRemote = @fopen("ssh2.sftp://{$oStream}/./home/dvs/public_html/feeds/output/{$sFile}", 'r')) {
            die('Could not open VINVENTORY.zip');
            return false;
        }
         
        if (!$fLocal = @fopen(Phpfox::getParam('dvs.csv_folder') . $sFile, 'w')) {
            die('Could not open VINVENTORY.zip');
            return false;
        }
       
        $iRead = 0;
        $iFilesize = filesize("ssh2.sftp://{$oStream}/./home/dvs/public_html/feeds/output/{$sFile}");
        while ($iRead < $iFilesize && ($iBuffer = fread($fRemote, $iFilesize - $iRead))) {
            $iRead += strlen($iBuffer);
            if (fwrite($fLocal, $iBuffer) === FALSE) {
                die("Unable to write to local file: $sFile");
                return false;
            }
        }
        fclose($fLocal);
        fclose($fRemote);

        return $sFile;
    }

    public function extracFile($sFile) {
        $oZip = new ZipArchive;
        $oRes = $oZip->open(Phpfox::getParam('dvs.csv_folder') . $sFile);
        if ($oRes === TRUE) {
            $oZip->extractTo(Phpfox::getParam('dvs.csv_folder'));
            $oZip->close();
            if (file_exists(Phpfox::getParam('dvs.csv_folder') . str_replace('.zip', '.txt', $sFile))) {
                if (!rename(Phpfox::getParam('dvs.csv_folder') . str_replace('.zip', '.txt', $sFile), Phpfox::getParam('dvs.csv_folder') . 'inventory.csv')) {
                    return false;
                }
            }
            @unlink(Phpfox::getParam('dvs.csv_folder') . $sFile);
            return true;
        } else {
            return false;
        }
    }

    // public function runCronjob() {
//         if($sFile = $this->downloadZipFile()) {
//             if ($this->extracFile($sFile)) {
//                 $this->importFile();
//             }
//             return true;
//         }
//         return false;
//     }
    
    public function runCronjob() {
    	$this->importFile();
    }
    
}

?>