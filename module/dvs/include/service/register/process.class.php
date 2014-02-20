<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org
 * @author  		James
 * @package 		DVS
 */
class Dvs_Service_Register_Process extends Phpfox_Service {

	public function __construct()
	{
		$this->_sTable = Phpfox::getT('ko_register');
	}


	public function add($aVals)
	{
		$oParseInput = Phpfox::getLib('parse.input');

		$iRegisterId = $this->database()
			->insert($this->_sTable, array(
			'user_id' => (int) $aVals['dvs_id'],
			'website_rep' => $oParseInput->clean($aVals['website_rep'], 255),
			'contact_name' => $oParseInput->clean($aVals['contact_name'], 255),
			'contact_phone' => $oParseInput->clean($aVals['contact_phone'], 32),
			'billing_name' => $oParseInput->clean($aVals['billing_name'], 255),
			'billing_address_1' => $oParseInput->clean($aVals['billing_address_1'], 255),
			'billing_address_2' => $oParseInput->clean($aVals['billing_address_2'], 255),
			'billing_city' => $oParseInput->clean($aVals['billing_city'], 255),
			'billing_state' => $oParseInput->clean($aVals['billing_state'], 16),
			'billing_zip_code' => $oParseInput->clean($aVals['billing_zip_code'], 16)
		));
		
		return $iRegisterId;
	}


}

?>