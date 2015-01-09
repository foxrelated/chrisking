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
class Dvs_Service_File_File extends Phpfox_Service {

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

		$iId = Phpfox::getService('dvs.file.process')->addLogoFile($sLogoFileName);

		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldLogoId) Phpfox::getService('dvs.file.process')->removeLogo($iOldLogoId);
			return $iId;
		}
	}


	public function brandingFileProcess($sBrandingFileName, $iOldBrandingId)
	{
		$iOldBrandingId = (int) $iOldBrandingId;

		if (empty($sBrandingFileName))
		{
			return Phpfox_Error::set('Please select an image to upload');
		}

		$aPathParts = pathinfo($sBrandingFileName);

		//PHP 5.1 fix
		if (!isset($aPathParts['filename']))
		{
			$aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
		}

		$sBrandingFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);

		$iId = Phpfox::getService('dvs.file.process')->addBrandingFile($sBrandingFileName);

		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldBrandingId) Phpfox::getService('dvs.file.process')->removeBranding($iOldBrandingId);
			return $iId;
		}
	}


	public function backgroundFileProcess($sBackgroundFileName, $iOldBackgroundId)
	{
		$iOldBackgroundId = (int) $iOldBackgroundId;

		if (empty($sBackgroundFileName))
		{
			return Phpfox_Error::set('Please select an image to upload');
		}

		$aPathParts = pathinfo($sBackgroundFileName);

		//PHP 5.1 fix
		if (!isset($aPathParts['filename']))
		{
			$aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
		}

		$sBackgroundFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);

		$iId = Phpfox::getService('dvs.file.process')->addBackgroundFile($sBackgroundFileName);

		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldBackgroundId) Phpfox::getService('dvs.file.process')->removeBackground($iOldBackgroundId);
			return $iId;
		}
	}


	public function addLogoFile($iLogoFileId)
	{
		$iLogoFileId = (int) $iLogoFileId;

		$sLogoFileName = $this->database()
			->select('logo_file_name')
			->from(Phpfox::getT('ko_dvs_logo_files'))
			->where('logo_id =' . $iLogoFileId)
			->execute('getField');

		$aLogoFile = Phpfox::getLib('file')->load('logo_file', Phpfox::getParam('dvs.allowed_file_types'), Phpfox::getUserParam('dvs.file_size_limit'));

		$sLogoFilePath = Phpfox::getLib('file')->upload('logo_file', Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'logo' . PHPFOX_DS, $sLogoFileName);

		Phpfox::getService('dvs.file.process')->updateLogoFileName($iLogoFileId, $sLogoFilePath);

		return $iLogoFileId;
	}


	public function getLogoFile($iFileId)
	{
		return $this->database()
				->select('logo_file_name')
				->from(Phpfox::getT('ko_dvs_logo_files'))
				->where('logo_id =' . $iFileId)
				->execute('getField');
	}


	public function addBrandingFile($iBrandingFileId)
	{
		$iBrandingFileId = (int) $iBrandingFileId;
		$sPath = Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'branding' . PHPFOX_DS;

		$sBrandingFileName = $this->database()
			->select('branding_file_name')
			->from(Phpfox::getT('ko_dvs_branding_files'))
			->where('branding_id =' . $iBrandingFileId)
			->execute('getField');

		$aBrandingFile = Phpfox::getLib('file')->load('branding_file', Phpfox::getParam('dvs.allowed_file_types'), Phpfox::getUserParam('dvs.file_size_limit'));

		$sBrandingFilePath = Phpfox::getLib('file')->upload('branding_file', $sPath, $sBrandingFileName);

		foreach (Phpfox::getParam('dvs.banner_sizes') as $iSize)
		{
			Phpfox::getLib('image')->createThumbnail($sPath . sprintf($sBrandingFilePath, ''), $sPath . sprintf($sBrandingFilePath, '_' . $iSize), $iSize, $iSize);
		}

		Phpfox::getService('dvs.file.process')->updateBrandingFileName($iBrandingFileId, $sBrandingFilePath);

		return $iBrandingFileId;
	}


	public function addBackgroundFile($iBackgroundFileId)
	{
		$iBackgroundFileId = (int) $iBackgroundFileId;

		$sBackgroundFileName = $this->database()
			->select('background_file_name')
			->from(Phpfox::getT('ko_dvs_background_files'))
			->where('background_id =' . $iBackgroundFileId)
			->execute('getField');

		$aBackgroundFile = Phpfox::getLib('file')->load('background_file', Phpfox::getParam('dvs.allowed_file_types'), Phpfox::getUserParam('dvs.file_size_limit'));

		$sBackgroundFilePath = Phpfox::getLib('file')->upload('background_file', Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'background' . PHPFOX_DS, $sBackgroundFileName);

		Phpfox::getService('dvs.file.process')->updateBackgroundFileName($iBackgroundFileId, $sBackgroundFilePath);

		return $iBackgroundFileId;
	}


	public function getBrandingFile($iFileId)
	{
		return $this->database()
				->select('branding_file_name')
				->from(Phpfox::getT('ko_dvs_branding_files'))
				->where('branding_id =' . $iFileId)
				->execute('getField');
	}


	public function getBackgroundFile($iFileId)
	{
		return $this->database()
				->select('background_file_name')
				->from(Phpfox::getT('ko_dvs_background_files'))
				->where('background_id =' . $iFileId)
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

		$iId = Phpfox::getService('dvs.file.process')->addPrerollFile($sPrerollFileName);

		if (!$iId)
		{
			return false;
		}
		else
		{
			if ($iOldPrerollId) Phpfox::getService('dvs.file.process')->removePreroll($iOldPrerollId);
			return $iId;
		}
	}


	public function addPrerollFile($iPrerollFileId)
	{
		$iPrerollFileId = (int) $iPrerollFileId;

		$sPrerollFileName = $this->database()
			->select('preroll_file_name')
			->from(Phpfox::getT('ko_dvs_preroll_files'))
			->where('preroll_id =' . $iPrerollFileId)
			->execute('getField');

		if (!$aPrerollFile = Phpfox::getLib('file')->load('preroll_file', Phpfox::getParam('dvs.allowed_preroll_file_types'), Phpfox::getUserParam('dvs.max_preroll_size'))) return false;

		$sPrerollFilePath = Phpfox::getLib('file')->upload('preroll_file', Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'preroll' . PHPFOX_DS, $sPrerollFileName);

		Phpfox::getService('dvs.file.process')->updatePrerollFileName($iPrerollFileId, $sPrerollFilePath);

		return $iPrerollFileId;
	}


	public function getPrerollFile($iFileId)
	{

		return $this->database()
				->select('preroll_file_name')
				->from(Phpfox::getT('ko_dvs_preroll_files'))
				->where('preroll_id =' . $iFileId)
				->execute('getField');
	}

    public function VdpFileProcess($sVdpFileName, $iOldVdpId) {
        $iOldVdpId = (int) $iOldVdpId;

        if (empty($sVdpFileName)) {
            return Phpfox_Error::set('Please select an image to upload');
        }

        $aPathParts = pathinfo($sVdpFileName);

        if (!isset($aPathParts['filename'])) {
            $aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
        }

        $sVdpFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);

        $iId = Phpfox::getService('dvs.file.process')->addVdpFile($sVdpFileName);

        if (!$iId) {
            return false;
        } else {
            if ($iOldVdpId) Phpfox::getService('dvs.file.process')->removeVdp($iOldVdpId);
            return $iId;
        }
    }

    public function getVdpFile($iFileId) {
        return $this->database()
            ->select('vdp_file_name')
            ->from(Phpfox::getT('tbd_dvs_vdp_files'))
            ->where('vdp_id =' . $iFileId)
            ->execute('getField');
    }

    public function addVdpFile($iVdpFileId) {
        $iVdpFileId = (int) $iVdpFileId;

        $sVdpFileName = $this->database()
            ->select('vdp_file_name')
            ->from(Phpfox::getT('tbd_dvs_vdp_files'))
            ->where('vdp_id =' . $iVdpFileId)
            ->execute('getField');

        $aVdpFile = Phpfox::getLib('file')->load('vdp_file', Phpfox::getParam('dvs.allowed_file_types'), Phpfox::getUserParam('dvs.file_size_limit'));

        $sVdpFilePath = Phpfox::getLib('file')->upload('vdp_file', Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'vdp' . PHPFOX_DS, $sVdpFileName);

        Phpfox::getService('dvs.file.process')->updateVdpFileName($iVdpFileId, $sVdpFilePath);

        return $iVdpFileId;
    }
}

?>