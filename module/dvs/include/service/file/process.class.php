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
class Dvs_Service_File_Process extends Phpfox_Service {

	public function __construct()
	{
		
	}


	public function addLogoFile($sLogoFileName)
	{
		return $this->database()
				->insert(Phpfox::getT('ko_dvs_logo_files'), array(
					'logo_file_name' => $sLogoFileName,
					'user_id' => Phpfox::getUserId(),
					'timestamp' => PHPFOX_TIME
		));
	}


	public function updateLogoFileName($iLogoFileId, $sLogoFilePath)
	{
		$sLogoFilePath = str_replace('%s', '', $sLogoFilePath);
		return $this->database()
				->update(Phpfox::getT('ko_dvs_logo_files'), array(
					'logo_file_name' => $sLogoFilePath
					), 'logo_id =' . $iLogoFileId);
	}


	public function removeLogo($iLogoFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sLogoFilePath = Phpfox::getService('dvs.file')->getLogoFile($iLogoFileId);

		if ($sLogoFilePath)
		{
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'dvs/logo/' . $sLogoFilePath);
			$this->database()->delete(Phpfox::getT('ko_dvs_logo_files'), 'logo_id =' . $iLogoFileId);

			return true;
		}

		return false;
	}


	public function addBrandingFile($sBrandingFileName)
	{
		return $this->database()
				->insert(Phpfox::getT('ko_dvs_branding_files'), array(
					'branding_file_name' => $sBrandingFileName,
					'user_id' => Phpfox::getUserId(),
					'timestamp' => PHPFOX_TIME
		));
	}


	public function updateBrandingFileName($iBrandingFileId, $sBrandingFilePath)
	{
		return $this->database()
				->update(Phpfox::getT('ko_dvs_branding_files'), array(
					'branding_file_name' => $sBrandingFilePath
					), 'branding_id =' . $iBrandingFileId);
	}


	public function addPrerollFile($sPrerollFileName)
	{
		return $this->database()
				->insert(Phpfox::getT('ko_dvs_preroll_files'), array(
					'preroll_file_name' => $sPrerollFileName,
					'user_id' => Phpfox::getUserId(),
					'timestamp' => PHPFOX_TIME
		));
	}


	public function updatePrerollFileName($iPrerollFileId, $sPrerollFilePath)
	{
		$sPrerollFilePath = str_replace('%s', '', $sPrerollFilePath);
		return $this->database()
				->update(Phpfox::getT('ko_dvs_preroll_files'), array(
					'preroll_file_name' => $sPrerollFilePath
					), 'preroll_id =' . $iPrerollFileId);
	}


	public function removePreroll($iPrerollFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sPrerollFilePath = Phpfox::getService('dvs.file')->getPrerollFile($iPrerollFileId);

		if ($sPrerollFilePath)
		{
			$this->database()->delete(Phpfox::getT('ko_dvs_preroll_files'), 'preroll_id =' . $iPrerollFileId);
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'dvs/preroll/' . $sPrerollFilePath);

			return true;
		}

		return false;
	}


	public function removeBranding($iBrandingFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sBrandingFilePath = Phpfox::getService('dvs.file')->getBrandingFile($iBrandingFileId);
		$sPath = Phpfox::getParam('core.dir_file') . 'dvs/branding/';

		if ($sBrandingFilePath)
		{
			foreach (Phpfox::getParam('store.product_image_sizes') as $iSize)
			{
				if (file_exists($sPath . sprintf($sBrandingFilePath, '_' . $iSize)))
				{
					$oFile->unlink($sPath . sprintf($sBrandingFilePath, '_' . $iSize));
				}
			}

			if (file_exists($sPath . sprintf($sBrandingFilePath, '')))
			{
				$oFile->unlink($sPath . sprintf($sBrandingFilePath, ''));
			}

			$this->database()->delete(Phpfox::getT('ko_dvs_branding_files'), 'branding_id =' . $iBrandingFileId);

			return true;
		}

		return false;
	}


	public function addBackgroundFile($sBackgroundFileName)
	{
		return $this->database()
				->insert(Phpfox::getT('ko_dvs_background_files'), array(
					'background_file_name' => $sBackgroundFileName,
					'user_id' => Phpfox::getUserId(),
					'timestamp' => PHPFOX_TIME
		));
	}


	public function updateBackgroundFileName($iBackgroundFileId, $sBackgroundFilePath)
	{
		$sBackgroundFilePath = str_replace('%s', '', $sBackgroundFilePath);
		return $this->database()
				->update(Phpfox::getT('ko_dvs_background_files'), array(
					'background_file_name' => $sBackgroundFilePath
					), 'background_id =' . $iBackgroundFileId);
	}


	public function removeBackground($iBackgroundFileId)
	{
		$oFile = Phpfox::getLib('file');
		$sBackgroundFilePath = Phpfox::getService('dvs.file')->getBackgroundFile($iBackgroundFileId);

		if ($sBackgroundFilePath)
		{
			$oFile->unlink(Phpfox::getParam('core.dir_file') . 'dvs/background/' . $sBackgroundFilePath);
			$this->database()->delete(Phpfox::getT('ko_dvs_background_files'), 'background_id =' . $iBackgroundFileId);

			return true;
		}

		return false;
	}


}

?>