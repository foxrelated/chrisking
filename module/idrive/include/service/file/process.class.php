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
 * @package 		iDrive
 */
class Idrive_Service_File_Process extends Phpfox_Service {

	public function __construct()
	{
		
	}

	public function addLogoFile($sLogoFileName)
	{
		return $this->database()
						->insert(Phpfox::getT('ko_idrive_logo_files'), array(
							'logo_file_name' => $sLogoFileName,
							'user_id' => Phpfox::getUserId(),
							'timestamp' => PHPFOX_TIME
						));

	}

	public function updateLogoFileName($iLogoFileId, $sLogoFilePath)
	{
		$sLogoFilePath = str_replace('%s', '', $sLogoFilePath);
		return $this->database()
						->update(Phpfox::getT('ko_idrive_logo_files'), array(
							'logo_file_name' => $sLogoFilePath
								), 'logo_id =' . $iLogoFileId);

	}

	public function removeLogo($iLogoFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sLogoFilePath = Phpfox::getService('idrive.file')->getLogoFile($iLogoFileId);

		if ($sLogoFilePath)
		{
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'idrive/logo/' . $sLogoFilePath);
			$this->database()->delete(Phpfox::getT('ko_idrive_logo_files'), 'logo_id =' . $iLogoFileId);
			return true;
		}
		return false;

	}
	
	public function addPrerollFile($sPrerollFileName)
	{
		return $this->database()
						->insert(Phpfox::getT('ko_idrive_preroll_files'), array(
							'preroll_file_name' => $sPrerollFileName,
							'user_id' => Phpfox::getUserId(),
							'timestamp' => PHPFOX_TIME
						));

	}

	public function updatePrerollFileName($iPrerollFileId, $sPrerollFilePath)
	{
		$sPrerollFilePath = str_replace('%s', '', $sPrerollFilePath);
		return $this->database()
						->update(Phpfox::getT('ko_idrive_preroll_files'), array(
							'preroll_file_name' => $sPrerollFilePath
								), 'preroll_id =' . $iPrerollFileId);

	}

	public function removePreroll($iPrerollFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sPrerollFilePath = Phpfox::getService('idrive.file')->getPrerollFile($iPrerollFileId);

		if ($sPrerollFilePath)
		{
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'idrive/preroll/' . $sPrerollFilePath);
			$this->database()->delete(Phpfox::getT('ko_idrive_preroll_files'), 'preroll_id =' . $iPrerollFileId);
			return true;
		}
		return false;

	}

}

?>