<?php
defined('PHPFOX') or exit('NO DICE!');

class Newapi_Service_Newapi extends Phpfox_Service {
    private $_aApi = array();
    private $_bError = false;
    private $_sFormat = 'xml';
    private $_aOutput = array();
    private $_iTotal = 0;
    private $_aOpenSSLConfig = array();
    private $_oService = null;
    private $_sMethod = '';
    private $_sModule = '';

    public function __construct() {
        $this->_sTable = Phpfox::getT('app');

        if ($this->get('format') != '') {
            $this->_sFormat = $this->get('format');
        }

        if (!defined('OPENSSL_KEYTYPE_RSA')) {
            return false;
        }

        $this->_aOpenSSLConfig = array(
            'digest_alg' => 'md5',
            'x509_extensions' => 'v3_ca',
            'req_extensions'   => 'v3_req',
            'private_key_bits' => 666,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'encrypt_key' => false
        );

        if (Phpfox::getParam('apps.openssl_config_path') != '') {
            $this->_aOpenSSLConfig['config'] = Phpfox::getParam('apps.openssl_config_path');
        }
    }

    public function test() {
        if (!function_exists('openssl_pkey_new')) {
            return Phpfox_Error::set('OpenSSL does not seem to be installed on your server.');
        }

        $res = openssl_pkey_new($this->_aOpenSSLConfig);

        if (!$res) {
            return Phpfox_Error::set('Unable to create a new private key. Please check OpenSSL configuration.');
        }

        return true;
    }

    public function process() {
        if (!Phpfox::getParam('apps.enable_api_support')) {
            $this->error('api.enable_api_support', 'API support for this community is currently disabled.');
            return $this->_sendResponse();
        }

        $_SERVER['HTTP_USER_AGENT'] = 'phpfox';

        if ($this->get('method') == '') {
            $this->error('api.method_not_defined', 'Method not defined.');
            return $this->_sendResponse();
        }

        $aParts = explode('.', $this->get('method'));

        if (!isset($aParts[1])) {
            $this->error('api.method_not_correctly_defined', 'Method not correctly defined.');
            return $this->_sendResponse();
        }

        $sModule = $aParts[0];
        $sMethod = $aParts[1];
        $this->_sModule = $sModule;
        $this->_sMethod = $sMethod;

        if (!Phpfox::isModule($sModule)) {
            $this->error('5', 'Module does not exist.');
            return $this->_sendResponse();
        }

        // Used to skip passing params everywhere
        define('PHPFOX_APP_ID', 1);

        $this->_oService = Phpfox::getService('newapi.' . $sModule);
        if (!method_exists($this->_oService, $sMethod)) {
            $this->error('api.method_not_valid_for_module', 'Method for this module does not exist.');
            return $this->_sendResponse();
            /*$this->_oService = Phpfox::getService($sModule . '.api');
            if (!method_exists($this->_oService, $sMethod)) {
                $this->error('api.method_not_valid_for_module', 'Method for this module does not exist.');
                return $this->_sendResponse();
            }*/
        }

        $mOutput = $this->_oService->$sMethod();

        if ($this->isPassed()) {
            $this->_aOutput = $mOutput;

            return $this->_sendResponse();
        }

        if (empty($this->_aOutput)) {
            $this->_bError = true;
            $this->_aOutput = array('error_message' => implode('', Phpfox_Error::get()));
        }
        $this->_aOutput = array_merge(array('error' => $this->_bError), $this->_aOutput);

        return $this->_sendResponse();
    }

    public function getUserId() {
        return (int) $this->_aApi['target_user_id'];
    }

    public function setTotal($iTotal) {
        $this->_iTotal = (int) $iTotal;
    }

    public function isAllowed($sVariable, $iUserId = null, $iAppId = null) {
        static $aPrivileges;

        if ($iAppId === null) {
            $iAppId = $this->_aApi['app_id'];
        }

        if ($iUserId === null) {
            $iUserId = $this->_aApi['target_user_id'];
        }

        if (!isset($aPrivileges[$iAppId]) && !isset($aPrivileges[$iAppId][$iUserId])) {
            $aRows = $this->database()->select('var_name')
                ->from(Phpfox::getT('app_disallow'))
                ->where('app_id = ' . (int)$iAppId . ' AND user_id = ' . (int)$iUserId . '')
                ->execute('getSlaveRows');

            $aPrivileges[$iAppId][$iUserId] = array();
            foreach ($aRows as $aRow)
            {
                $aPrivileges[$iAppId][$iUserId][$aRow['var_name']] = true;
            }
        }

        return (isset($aPrivileges[$iAppId][$iUserId][$sVariable]) ? false : true);
    }

    public function get($sRequest) {
        return Phpfox::getLib('request')->get($sRequest);
    }

    public function isPassed() {
        if (!Phpfox_Error::isPassed()) {
            return false;
        }

        return ($this->_bError ? false : true);
    }

    public function error($iErrorId, $sErrorMessage) {
        $this->_bError = true;
        $this->_aOutput = array(
            'error_id' => $iErrorId,
            'error_message' => (empty($sErrorMessage) ? implode('', Phpfox_Error::get()) : $sErrorMessage)
        );

        return false;
    }

    private function _sendResponse() {
        $sOutput = json_encode(array(
                'api' => array(
                    'total' => $this->_iTotal,
                    'current_page' => $this->get('page')
                ),
                'output' => $this->_aOutput
            )
        );
        echo $sOutput;
    }
}


?>