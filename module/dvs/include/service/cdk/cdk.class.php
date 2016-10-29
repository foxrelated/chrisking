<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpseclib');

include('Crypt/RSA.php');
include('Net/SFTP.php');
//include('Net/SSH2.php');

class Dvs_Service_Cdk_Cdk extends Phpfox_Service {
    public function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs');
    }

    public function export($aDvs) {
        $sTodayTime = strtotime('00:00:00');
        $sYear = date('Y', $sTodayTime);
        $sMonth = date('m', $sTodayTime);

        $oGAService = Phpfox::getService('dvs.analytics');
        $sDateFrom = $sYear . '-' . $sMonth . '-01';

        // Player Loaded
        $oPlayerLoadedRequest = $oGAService->makeRequest('ga:sessions', array(
            'filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'};ga:eventLabel==Player%20Loaded'
        ), $sDateFrom);
        $aPlayerLoadedData = (array)($oPlayerLoadedRequest->rows);
        $iPlayerLoaded = 0;
        if (count($aPlayerLoadedData)) {
            $iPlayerLoaded = $aPlayerLoadedData[0][0];
        }

        // Video Views
        $oVideoViewRequest = $oGAService->makeRequest('ga:sessions', array(
            'filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'};ga:eventLabel==Media Begin'
        ), $sDateFrom);
        $aVideoViewData = (array)($oVideoViewRequest->rows);
        $iVideoView = 0;
        if (count($aVideoViewData)) {
            $iVideoView = $aVideoViewData[0][0];
        }

        // Play Rate
        $iPlayRate = 0;
        if ($iPlayerLoaded > 0) {
            $iPlayRate = (int)((float)$iVideoView * 100 / (float)$iPlayerLoaded);
        }

        // Chapter Clicks
        $oChapterClickedRequest = $oGAService->makeRequest('ga:sessions', array(
            'filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'};ga:eventLabel==Chapter Clicked'
        ), $sDateFrom);
        $aChapterClickedData = (array)($oChapterClickedRequest->rows);
        $iChapterClicked = 0;
        if (count($aChapterClickedData)) {
            $iChapterClicked = $aChapterClickedData[0][0];
        }

        // Chapter Watched
        $oChapterWatchedRequest = $oGAService->makeRequest('ga:sessions', array(
            'filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'};ga:eventLabel==Chapter Watched'
        ), $sDateFrom);
        $aChapterWatchedData = (array)($oChapterWatchedRequest->rows);
        $iChapterWatched = 0;
        if (count($aChapterWatchedData)) {
            $iChapterWatched = $aChapterWatchedData[0][0];
        }

        // Share
        $aDefaultValue = array(
            'Direct Link' => 0,
            'Text Message' => 0,
            'Facebook' => 0,
            'Twitter' => 0,
            'Google' => 0,
            'Email' => 0,
            'CRM Video Email Open' => 0,
            'CRM Video Email Click' => 0,
            'CRM Email CTR' => 0
        );
        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array(
            'dimensions'=>'ga:medium',
            'filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$aDvs['dealer_name'],'sort'=>'-ga:sessions'
        ), $sDateFrom);
        if ($oShareViewRequest->rows) {
            foreach($oShareViewRequest->rows as $aDataRow) {
                if (isset($aDefaultValue[$aDataRow[0]])) {
                    $aDefaultValue[$aDataRow[0]] = $aDataRow[1];
                }
            }
        }
        if ($aDefaultValue['CRM Video Email Open'] > 0) {
            $aDefaultValue['CRM Email CTR'] = (int)((float)$aDefaultValue['CRM Video Email Click'] * 100 / (float)$aDefaultValue['CRM Video Email Open']);
        }

        $sFileName = 'wheelstv_dvs_' . $aDvs['cdk_id'] .'_' . date('Ymd', time()) . '.csv';
        $sNewFile = Phpfox::getParam('core.dir_cache') . $sFileName;
        $oFileHandler = fopen($sNewFile, 'w+');
        fputcsv($oFileHandler, array(
            'wheelstv',
            'dvs',
            $aDvs['cdk_id'],
            $sMonth . '/1/' . $sYear,
            $iPlayerLoaded,
            $iVideoView,
            $iPlayRate,
            $iChapterClicked,
            $iChapterWatched,
            $aDefaultValue['Direct Link'],
            $aDefaultValue['Text Message'],
            $aDefaultValue['Facebook'],
            $aDefaultValue['Twitter'],
            $aDefaultValue['Google'],
            $aDefaultValue['Email'],
            $aDefaultValue['CRM Video Email Open'],
            $aDefaultValue['CRM Video Email Click'],
            $aDefaultValue['CRM Email CTR']
        ));
        fclose($oFileHandler);

        return $sFileName;
    }

    public function uploadToClient($sFileName) {
        $sftp = new Net_SFTP('sftp.bi.cdk.com');
        $Key = new Crypt_RSA();

        $Key->loadKey(file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'id_rsa'));

        if (!$sftp->login('wheelstv', $Key)) {
            return false;
        }

        $sftp->put("/home/websites/video/wheelstv/". $sFileName, Phpfox::getParam('core.dir_cache') . $sFileName, NET_SFTP_LOCAL_FILE);

        return true;
    }

    public function runCron() {
        $sTodayTime = strtotime('00:00:00');

        $aDvs = $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('cdk_id != \'\' AND cdk_id != \'0\' AND cdk_export_time < ' . $sTodayTime)
            ->execute('getRow');

        if (!isset($aDvs['dvs_id'])) {
            echo 'Completed';
            return false;
        }

        $sCsvFile = $this->export($aDvs);

        $this->uploadToClient($sCsvFile);

        unlink(Phpfox::getParam('core.dir_cache') . $sCsvFile);
        $this->database()->update($this->_sTable, array('cdk_export_time' => PHPFOX_TIME), 'dvs_id = ' . $aDvs['dvs_id']);
        echo 'Exported Data: ' . $aDvs['cdk_id'];
        return true;
    }
}
?>