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
class Dvs_Component_Controller_Background_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}

		if (!isset($_FILES['background_file']['name']))
		{
			Phpfox::getService('dvs.file.process')->removeBackground($this->request()->get('background_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_background_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_background_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo 'window.parent.document.getElementById(\'js_background_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_background_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_background_file_process\').style.display = \'none\';';
			echo '</script>';
			exit;
		}

		if ($iBackgroundFileId = Phpfox::getService('dvs.file')->addBackgroundFile($this->request()->get('background_file_id')))
		{
			$sBackgroundFilePath = Phpfox::getService('dvs.file')->getBackgroundFile($iBackgroundFileId);
            $sImageUrl = Phpfox::getLib('image.helper')->display(array(
                'server_id' => Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID'),
                'path' => 'core.url_file',
                'file' => 'dvs/background/' . $sBackgroundFilePath,
                'return_url' => 'true'
            ));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_background_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'background_file_preview\').innerHTML = \'<input type="hidden" name="background_file_id" value="' . $iBackgroundFileId . '" /><img src="' . $sImageUrl . '" width="180" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'background_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_background_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'background_file_preview\\\').style.display = \\\'none\\\';">' . Phpfox::getPhrase('dvs.change_background_image') . '</a> - <a href="#" onclick="if (confirm(\\\'Are you sure?\\\')){window.parent.document.getElementById(\\\'background_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_background_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'background_file_preview\\\').style.display = \\\'none\\\';window.parent.document.getElementById(\\\'background_file_id\\\').value = 0;$.ajaxCall(\\\'dvs.removeBackgroundFile\\\',\\\'iBackgroundFileId=' . $iBackgroundFileId . '\\\')}">' . Phpfox::getPhrase('dvs.remove_background_image') . '</a>\';';
			echo 'window.parent.document.getElementById(\'background_file_label\').innerHTML = \'' . Phpfox::getPhrase('dvs.current_image') . ':\';';
			echo 'window.parent.document.getElementById(\'background_file_id\').value = \'' . $iBackgroundFileId . '\';';
			echo 'window.parent.document.getElementById(\'background_file_preview\').style.display = \'block\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.background-file-form', array('current-background-id' => $iBackgroundFileId)) . '">';
			exit;
		}
		else
		{
			Phpfox::getService('dvs.file.process')->removeBackground($this->request()->get('background_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_background_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_background_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo 'window.parent.document.getElementById(\'js_background_upload_inner_form\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_background_file_detail\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_background_file_process\').style.display = \'none\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.background-file-form') . '">';
			exit;
		}

	}

}

?>