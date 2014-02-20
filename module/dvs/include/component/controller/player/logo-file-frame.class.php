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
 * @package 		DVS
 */
class Dvs_Component_Controller_Player_Logo_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}
		if (!isset($_FILES['logo_file']['name']))
		{

			Phpfox::getService('dvs.file.process')->removeLogo($this->request()->get('logo_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo 'window.parent.document.getElementById(\'js_logo_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_process\').style.display = \'none\';';
			echo '</script>';
			exit;
		}

		if ($iLogoFileId = Phpfox::getService('dvs.file')->addLogoFile($this->request()->get('logo_file_id')))
		{
			$sLogoFilePath = Phpfox::getService('dvs.file')->getLogoFile($iLogoFileId);

			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'logo_file_preview\').innerHTML = \'<input type="hidden" name="logo_file_id" value="' . $iLogoFileId . '" /><img src="' . Phpfox::getParam('core.url_file') . 'dvs/logo/', $sLogoFilePath . '" width="180" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'logo_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_logo_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'logo_file_preview\\\').style.display = \\\'none\\\';">' . Phpfox::getPhrase('dvs.change_logo_image') . '</a> - <a href="#" onclick="if (confirm(\\\'Are you sure?\\\')){window.parent.document.getElementById(\\\'logo_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_logo_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'logo_file_preview\\\').style.display = \\\'none\\\';window.parent.document.getElementById(\\\'logo_file_id\\\').value = 0;$.ajaxCall(\\\'dvs.removeLogoFile\\\',\\\'iLogoFileId=' . $iLogoFileId . '\\\')}">' . Phpfox::getPhrase('dvs.remove_logo_image') . '</a>\';';
			echo 'window.parent.document.getElementById(\'logo_file_label\').innerHTML = \'' . Phpfox::getPhrase('dvs.current_image') . ':\';';
			echo 'window.parent.document.getElementById(\'logo_file_id\').value = \'' . $iLogoFileId . '\';';
			echo 'window.parent.document.getElementById(\'logo_file_preview\').style.display = \'block\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.player.logo-file-form', array('current-logo-id' => $iLogoFileId)) . '">';
			exit;
		}
		else
		{
			Phpfox::getService('dvs.file.process')->removeLogo($this->request()->get('logo_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo 'window.parent.document.getElementById(\'js_logo_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_logo_file_process\').style.display = \'none\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.player.logo-file-form') . '">';
			exit;
		}

	}

}

?>