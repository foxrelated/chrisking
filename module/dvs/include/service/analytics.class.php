<?php

require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');

class Dvs_Service_Analytics extends Phpfox_Service {
    private $_sClientEmail;
    private $_sPrivateKey;
    private $_sScope = 'https://www.googleapis.com/auth/analytics.readonly';

    function __construct() {
        $jsonData = file_get_contents(dirname(__FILE__) . PHPFOX_DS . 'client_secrets.json');
        $aClientData = json_decode($jsonData, true);
        $this->_sClientEmail = $aClientData['client_email'];
        $this->_sPrivateKey = $aClientData['private_key'];
    }

    function getAccess() {
        $credentials = new Google_Auth_AssertionCredentials(
            $this->_sClientEmail,
            $this->_sScope,
            $this->_sPrivateKey
        );

        $client = new Google_Client();
        $client->setAssertionCredentials($credentials);
        //if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion();
        //}

        $aAccessToken = json_decode($client->getAccessToken());
        return $aAccessToken->access_token;
    }
}
?>