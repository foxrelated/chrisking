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
class Idrive_Service_File_File extends Phpfox_Service {

	public function __construct()
	{
		
	}

	public function logoFileProcess($sLogoFileName, $iOldLogoId)
	{
		$iOldLogoId = (int) $iOldLogoId;

		if (empty($sLogoFileName))
		{
			return Phpfox_Error::set('Please select an image to upload');
		}

		$aPathParts = pathinfo($sLogoFileName);

		//PHP 5.1 fix
		if (!isset($aPathParts['filename']))
		{
			$aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
		}

		$sLogoFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);

		$iId = Phpfox::getService('idrive.file.process')->addLogoFile($sLogoFileName);

		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldLogoId) Phpfox::getService('idrive.file.process')->removeLogo($iOldLogoId);
			return $iId;
		}

	}

	public function addLogoFile($iLogoFileId)
	{
		$iLogoFileId = (int) $iLogoFileId;

		$sLogoFileName = $this->database()
				->select('logo_file_name')
				->from(Phpfox::getT('ko_idrive_logo_files'))
				->where('logo_id =' . $iLogoFileId)
				->execute('getField');

		$aLogoFile = Phpfox::getLib('file')->load('logo_file', Phpfox::getParam('idrive.allowed_file_types'), Phpfox::getUserParam('idrive.file_size_limit'));

		$sLogoFilePath = Phpfox::getLib('file')->upload('logo_file', Phpfox::getParam('core.dir_file') . 'idrive/logo/', $sLogoFileName);

		Phpfox::getService('idrive.file.process')->updateLogoFileName($iLogoFileId, $sLogoFilePath);

		return $iLogoFileId;

	}

	public function getLogoFile($iFileId)
	{
		return $this->database()
						->select('logo_file_name')
						->from(Phpfox::getT('ko_idrive_logo_files'))
						->where('logo_id =' . $iFileId)
						->execute('getField');

	}

	public function prerollFileProcess($sPrerollFileName, $iOldPrerollId)
	{
		$iOldPrerollId = (int) $iOldPrerollId;

		if (empty($sPrerollFileName))
		{
			return Phpfox_Error::set('Please select an image to upload');
		}

		$aPathParts = pathinfo($sPrerollFileName);

		//PHP 5.1 fix
		if (!isset($aPathParts['filename']))
		{
			$aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
		}

		$sPrerollFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);

		$iId = Phpfox::getService('idrive.file.process')->addPrerollFile($sPrerollFileName);
		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldPrerollId) Phpfox::getService('idrive.file.process')->removePreroll($iOldPrerollId);
			return $iId;
		}

	}

	public function addPrerollFile($iPrerollFileId)
	{
		$iPrerollFileId = (int) $iPrerollFileId;

		$sPrerollFileName = $this->database()
				->select('preroll_file_name')
				->from(Phpfox::getT('ko_idrive_preroll_files'))
				->where('preroll_id =' . $iPrerollFileId)
				->execute('getField');

		if (!$aPrerollFile = Phpfox::getLib('file')->load('preroll_file', Phpfox::getParam('idrive.allowed_preroll_file_types'), Phpfox::getUserParam('idrive.max_preroll_size'))) return false;

		$sPrerollFilePath = Phpfox::getLib('file')->upload('preroll_file', Phpfox::getParam('core.dir_file') . 'idrive/preroll/', $sPrerollFileName);

		Phpfox::getService('idrive.file.process')->updatePrerollFileName($iPrerollFileId, $sPrerollFilePath);

		return $iPrerollFileId;

	}

	public function getPrerollFile($iFileId)
	{
		return $this->database()
						->select('preroll_file_name')
						->from(Phpfox::getT('ko_idrive_preroll_files'))
						->where('preroll_id =' . $iFileId)
						->execute('getField');

	}

}

?>