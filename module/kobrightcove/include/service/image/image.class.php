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
 * @package 		KOBrightcove
 */
class Kobrightcove_Service_Image_Image extends Phpfox_Service {

	public function __construct()
	{
		
	}


	/**
	 * Download an image and store it locally
	 * 
	 * @param string $sUrl
	 * @param string $sDestinationFileName
	 * @return boolean|string
	 */
	public function download($sUrl, $sDestinationFileName)
	{
		$aUrl = parse_url($sUrl);

		if (!isset($aUrl['path']))
		{
			return false;
		}

		$sDestinationFileName .= '.' . pathinfo($aUrl['path'], PATHINFO_EXTENSION);
		$sFullPath = Phpfox::getParam('core.dir_file') . 'brightcove/' . $sDestinationFileName;
		$sFileData = Phpfox::getLib('phpfox.request')->send($sUrl, array(), 'GET');

		if (Phpfox::getLib('file')->write($sFullPath, $sFileData))
		{
			chmod($sFullPath, 0644);
			return $sDestinationFileName;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Deletes an image file
	 * 
	 * @param type $sFileName
	 * @return boolean
	 */
	public function delete($sFileName)
	{
		if (file_exists(Phpfox::getParam('core.dir_file') . 'brightcove/' . $sFileName))
		{
			if (Phpfox::getLib('file')->unlink(Phpfox::getParam('core.dir_file') . 'brightcove/' . $sFileName))
			{
				return true;
			}
		}

		return false;
	}


}

?>