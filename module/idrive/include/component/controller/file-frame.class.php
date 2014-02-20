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
class Idrive_Component_Controller_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}
		if (!isset($_FILES['file']['name']))
		{

			Phpfox::getService('idrive.file.process')->remove($this->request()->get('file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo 'window.parent.document.getElementById(\'js_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_file_process\').style.display = \'none\';';
			echo '</script>';
			exit;
		}

		if ($iFileId = Phpfox::getService('idrive.file')->addFile($this->request()->get('file_id')))
		{
			$sFilePath = Phpfox::getService('idrive.file')->getFile($iFileId);

			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'file_preview\').innerHTML = \'<img src="' . Phpfox::getParam('core.url_file') . 'idrive/', $sFilePath . '" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('idrive.select_file') . '\\\';window.parent.document.getElementById(\\\'js_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'file_preview\\\').style.display = \\\'none\\\';">' . Phpfox::getPhrase('idrive.change_logo_branding_image') . '</a>\';';
			echo 'window.parent.document.getElementById(\'file_label\').innerHTML = \'' . Phpfox::getPhrase('idrive.current_image') . ':\';';
			echo 'window.parent.document.getElementById(\'file_id\').value = \'' . $iFileId . '\';';
			echo 'window.parent.document.getElementById(\'file_preview\').style.display = \'block\';';
			echo '</script>';
		}
		else
		{
			Phpfox::getService('idrive.file.process')->remove($this->request()->get('file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo 'window.parent.document.getElementById(\'js_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_file_process\').style.display = \'none\';';
			echo '</script>';
		}

		echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('idrive.file-form') . '">';
		exit;

	}

}

?>