<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright		Konsort.org 
 * @author  		Konsort.org
 * @package 		iDrive
 */
class Idrive_Component_Controller_Logo_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}
		if (!isset($_FILES['logo_file']['name']))
		{

			Phpfox::getService('idrive.file.process')->removeLogo($this->request()->getLogo('logo_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo 'window.parent.document.getElementById(\'js_logo_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_process\').style.display = \'none\';';
			echo '</script>';
			exit;
		}

		if ($iLogoFileId = Phpfox::getService('idrive.file')->addLogoFile($this->request()->get('logo_file_id')))
		{
			$sLogoFilePath = Phpfox::getService('idrive.file')->getLogoFile($iLogoFileId);

			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'logo_file_preview\').innerHTML = \'<input type="hidden" name="logo_file_id" value="' . $iLogoFileId . '" /><img src="' . Phpfox::getParam('core.url_file') . 'idrive/logo/', $sLogoFilePath . '" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'logo_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('idrive.select_file') . '\\\';window.parent.document.getElementById(\\\'js_logo_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'logo_file_preview\\\').style.display = \\\'none\\\';">' . Phpfox::getPhrase('idrive.change_logo_branding_image') . '</a>\';';
			echo 'window.parent.document.getElementById(\'logo_file_label\').innerHTML = \'' . Phpfox::getPhrase('idrive.current_image') . ':\';';
			echo 'window.parent.document.getElementById(\'logo_file_id\').value = \'' . $iLogoFileId . '\';';
			echo 'window.parent.document.getElementById(\'logo_file_preview\').style.display = \'block\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('idrive.logo-file-form', array('current-logo-id' => $iLogoFileId)) . '">';
			exit;
		}
		else
		{
			Phpfox::getService('idrive.file.process')->removeLogo($this->request()->get('logo_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo 'window.parent.document.getElementById(\'js_logo_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_process\').style.display = \'none\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('idrive.logo-file-form') . '">';
			exit;
		}

	}

}

?>