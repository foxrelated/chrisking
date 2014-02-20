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
class Dvs_Component_Controller_Branding_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}

		if (!isset($_FILES['branding_file']['name']))
		{
			Phpfox::getService('dvs.file.process')->removeBranding($this->request()->get('branding_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_branding_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo 'window.parent.document.getElementById(\'js_branding_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_process\').style.display = \'none\';';
			echo '</script>';
			exit;
		}

		if ($iBrandingFileId = Phpfox::getService('dvs.file')->addBrandingFile($this->request()->get('branding_file_id')))
		{
			$sBrandingFilePath = Phpfox::getService('dvs.file')->getBrandingFile($iBrandingFileId);

			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_branding_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'branding_file_preview\').innerHTML = \'<input type="hidden" name="branding_file_id" value="' . $iBrandingFileId . '" /><img src="' . Phpfox::getParam('core.url_file') . 'dvs/branding/', sprintf($sBrandingFilePath, '') . '" width="180" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'branding_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_branding_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'branding_file_preview\\\').style.display = \\\'none\\\';">' . Phpfox::getPhrase('dvs.change_branding_image') . '</a> - <a href="#" onclick="if (confirm(\\\'Are you sure?\\\')){window.parent.document.getElementById(\\\'branding_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_branding_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'branding_file_preview\\\').style.display = \\\'none\\\';window.parent.document.getElementById(\\\'branding_file_id\\\').value = 0;$.ajaxCall(\\\'dvs.removeBrandingFile\\\',\\\'iBrandingFileId=' . $iBrandingFileId . '\\\')}">' . Phpfox::getPhrase('dvs.remove_branding_image') . '</a>\';';
			echo 'window.parent.document.getElementById(\'branding_file_label\').innerHTML = \'' . Phpfox::getPhrase('dvs.current_image') . ':\';';
			echo 'window.parent.document.getElementById(\'branding_file_id\').value = \'' . $iBrandingFileId . '\';';
			echo 'window.parent.document.getElementById(\'branding_file_preview\').style.display = \'block\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.branding-file-form', array('current-branding-id' => $iBrandingFileId)) . '">';
			exit;
		}
		else
		{
			Phpfox::getService('dvs.file.process')->removeBranding($this->request()->get('branding_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_branding_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo 'window.parent.document.getElementById(\'js_branding_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_branding_file_process\').style.display = \'none\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.branding-file-form') . '">';
			exit;
		}
	}


}

?>