<?php

require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');

class Dvs_Service_Analytics_Analytics extends Phpfox_Service {
    private $_sClientEmail;
    private $_sPrivateKey;
    private $_sScope = 'https://www.googleapis.com/auth/analytics.readonly';
    private $_oClient;
    private $_oAnalytics;
    private $_oCred;

    function __construct() {
        $jsonData = file_get_contents(dirname(__FILE__) . PHPFOX_DS . 'client_secrets.json');
        $aClientData = json_decode($jsonData, true);
        $this->_sClientEmail = $aClientData['client_email'];
        $this->_sPrivateKey = $aClientData['private_key'];

        $this->_oClient = new Google_Client();
        $this->_oClient->setApplicationName("DVS Reporting");
        $this->_oAnalytics = new Google_Service_Analytics($this->_oClient);

        $this->_oCred = new Google_Auth_AssertionCredentials(
            $this->_sClientEmail,
            $this->_sScope,
            $this->_sPrivateKey
        );
        $this->_oClient->setAssertionCredentials($this->_oCred);
        if($this->_oClient->getAuth()->isAccessTokenExpired()) {
            $this->_oClient->getAuth()->refreshTokenWithAssertion($this->_oCred);
        }
    }

    function getAccess() {
        if($this->_oClient->getAuth()->isAccessTokenExpired()) {
            $this->_oClient->getAuth()->refreshTokenWithAssertion($this->_oCred);
        }
        $aAccessToken = json_decode($this->_oClient->getAccessToken());
        return $aAccessToken->access_token;
    }

    function makeRequest($sMetrics, $aOptParams = array(), $sStartDate = '7daysAgo', $sEndDate = 'yesterday', $sId = 'ga:60794198') {
        $oData = $this->_oAnalytics->data_ga->get($sId, $sStartDate, $sEndDate, $sMetrics, $aOptParams);
        return $oData;
    }

    function getChartData($aDataRows, $sType = 'number', $sResultType = 'total') {
        $sLineData = "[";
        $iTotal = 0;
        $iMaxValue = 0;

        foreach($aDataRows as $aRow) {
            $sLineData .= "[new Date(".substr($aRow[0], 0, 4).",".substr($aRow[0], 4, 2)."-1,".substr($aRow[0], 6, 2)."),".$aRow[1]."],";
            $iTotal += (int)$aRow[1];
            if ($iMaxValue < (int)$aRow[1]) {
                $iMaxValue = (int)$aRow[1];
            }
        }
        $sLineData = substr($sLineData, 0, -1);
        $sLineData .= "]";
        if ($sResultType == 'avg') {
            $iTotal /= count($aDataRows);
            $iTotal = number_format($iTotal, 2);
        }

        if ($sType == 'time') {
            $iTotal = gmdate("H:i:s", (int)$iTotal);
        }

        $iMaxValue = (int)(2 * $iMaxValue);

        return array($sLineData, $iTotal, $iMaxValue);
    }

    function getTableData($aDataRows) {
        $sRawData = "[";
        if (is_array($aDataRows)) {
            foreach($aDataRows as $aRow) {
                $sRawData .= "['" . str_replace("'","\'",$aRow[0]) . "', ".$aRow[1]."],";
            }
            $sRawData = substr($sRawData, 0, -1);
        }
        $sRawData .= "]";
        return $sRawData;
    }
}
?>