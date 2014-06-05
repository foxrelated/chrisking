<?php

class Mailchimp_Service_Log_Process extends Phpfox_Service
{

	function __construct()
	{
		$this -> _sTable = Phpfox::getT('mailchimp_log');
	}

	/**
	 * Add log message.
	 * @param type $sLogMessage
	 * @return type
	 */
	public function add($sLogMessage)
	{
		$iId = Phpfox::getLib('database') -> insert($this -> _sTable, array(
			'description' => $sLogMessage,
			'created_at' => PHPFOX_TIME
		));

		return $iId;
	}

	/**
	 * Delete all logs.
	 * @return bool
	 */
	public function deleteAll()
	{
		return Phpfox::getLib('database') -> delete($this -> _sTable, TRUE);
	}

	public function addMultiRecode($aValues = array())
	{
		$aFields = array(
			'description',
			'created_at'
		);

		$iId = Phpfox::getLib('database') -> multiInsert($this -> _sTable, $aFields, $aValues);

		return $iId;
	}

}
