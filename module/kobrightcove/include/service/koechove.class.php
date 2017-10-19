<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('GO MICE!');

/**
 *
 *
 * @copyright	TheBigDev.com
 * @author		Ninh Nguyen
 * @package 		KOBrightcove
 */
class Kobrightcove_Service_Koechove extends Phpfox_Service {
    private $_clientId = NULL;
    private $_clientSecret = NULL;
    private $_accountId = NULL;

	/**
	 * The constructor for the Echove class.
	 * @access Public
	 * @since 0.1.0
	 * @param string [$token_read] The read API token for the Brightcove account
	 * @param string [$token_write] The write API token for the Brightcove account
	 */
	public function __construct($clientId = NULL, $clientSecret = NULL) {
		$this->_clientId = '0bcd20f4-746f-4063-bdda-ced0cd42840a';
        $this->_clientSecret = '89-JA45F-S_1pdnHBNCKwNpJ1fEKmhxWcb-BJRlVYXA4i_YFfFL8HYY-9BpZHMhVtF1Loa0WjZLcwTG3ZJTPSA';
        $this->_accountId = '607012070001';
	}

	/**
	 * Sets a property of the Echove class.
	 * @access Public
	 * @since 1.0.0
	 * @param string [$key] The property to set
	 * @param mixed [$value] The new value for the property
	 * @return mixed The new value of the property
	 */
	public function __set($key, $value) {
		if (isset($this->$key) || is_null($this->$key)) {
			$this->$key = $value;
		} else {
			return Phpfox_Error::set('ERROR_INVALID_PROPERTY');
		}
	}

	/**
	 * Retrieves a property of the Echove class.
	 * @access Public
	 * @since 1.0.0
	 * @param string [$key] The property to retrieve
	 * @return mixed The value of the property
	 */
	public function __get($key) {
		if (isset($this->$key) || is_null($this->$key)) {
			return $this->$key;
		} else {
			return Phpfox_Error::set('ERROR_INVALID_PROPERTY');
		}
	}

    private function getAccessToken() {
        $oData = array();
        $sAuthString   = $this->_clientId . ":" . $this->_clientSecret;
        $sRequest       = "https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials";
        $oCh            = curl_init($sRequest);
        curl_setopt_array($oCh, array(
            CURLOPT_POST           => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_USERPWD        => $sAuthString,
            CURLOPT_HTTPHEADER     => array(
                'Content-type: application/x-www-form-urlencoded',
            ),
            CURLOPT_POSTFIELDS => $oData
        ));
        $oResponse = curl_exec($oCh);
        curl_close($oCh);

        // Check for errors
        if ($oResponse === FALSE) {
            die(curl_error($oCh));
        }

        // Decode the response
        $oResponseData = json_decode($oResponse, TRUE);
        $sAccessToken = $oResponseData['access_token'];

        return $sAccessToken;
    }

    private function makeRequest($sUrl, $aBody = array(), $sMethod='GET') {
        if (strpos($sUrl, 'api.brightcove.com') == false) {
            exit('Only requests to Brightcove APIs are accepted by this proxy');
        }
        $sAccessToken = $this->getAccessToken();

        //send the http request
        $oCh = curl_init($sUrl);
        curl_setopt_array($oCh, array(
            CURLOPT_CUSTOMREQUEST  => $sMethod,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER     => array(
                'Content-type: application/json',
                "Authorization: Bearer {$sAccessToken}",
            ),
            CURLOPT_POSTFIELDS => json_encode($aBody)
        ));
        $oResponse = curl_exec($oCh);
        curl_close($oCh);

        // Check for errors
        if ($oResponse === FALSE) {
            echo "Error: there was a problem with your API call" + die(curl_error($oCh));
        }

        return json_decode($oResponse, TRUE);
    }

    public function getTotal() {
        $sRequest = "https://cms.api.brightcove.com/v1/accounts/{$this->_accountId}/counts/videos";
        $oResponseData = $this->makeRequest($sRequest);

        return $oResponseData['count'];
    }

    public function findUpdate($iPageNumber, $sCustomFields = '', $iPageSize = 100) {
        $sRequest = "https://cms.api.brightcove.com/v1/accounts/{$this->_accountId}/videos";
        $aData = array(
            'limit' => $iPageSize,
            'offset' => $iPageNumber
        );

        $sRequest .= '?' . http_build_query($aData);

        $oResponseData = $this->makeRequest($sRequest);

        $aVideos = array();
        if (is_array($oResponseData) && count($oResponseData) > 0) {
            foreach($oResponseData as $aVideo) {
                if (isset($aVideo['custom_fields']) && count($aVideo['custom_fields']) > 0) {
                    $aVideos[] = $aVideo;
                }
            }
        }

        return $aVideos;
    }
}

?>