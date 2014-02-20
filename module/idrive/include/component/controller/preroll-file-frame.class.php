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
class Idrive_Component_Controller_Preroll_File_Frame extends Phpfox_Component {

	public function process()
	{
		if (!Phpfox::isUser())
		{
			exit;
		}
		if (!isset($_FILES['preroll_file']['name']))
		{
			Phpfox::getService('idrive.file.process')->removePreroll($this->request()->getPreroll('preroll_file_id'));
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_preroll_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_preroll_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
			echo '</script>';
			exit;
		}

		if ($iPrerollFileId = Phpfox::getService('idrive.file')->addPrerollFile($this->request()->get('preroll_file_id')))
		{
			$sPrerollFilePath = Phpfox::getService('idrive.file')->getPrerollFile($iPrerollFileId);

			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_preroll_upload_frame\').style.display = \'none\';';
			echo 'window.parent.document.getElementById(\'js_preroll_file_upload_error\').style.display = \'none\';';

			//Change preview frame contents
			echo 'window.parent.document.getElementById(\'preroll_file_preview\').innerHTML = \'' .
			//The preview
			'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">' .
			'<param name="allowfullscreen" value="true" />' .
			(Phpfox::getParam('dvs.enable_subdomain_mode') ? '<param name="movie" value="' . Phpfox::getLib('url')->makeUrl('www.module.dvs.static.swf') . 'player.swf" />' : '<param name="movie" value="../../../module/dvs/static/swf/player.swf" />') .
			'<param name="flashvars" value="' . Phpfox::getParam('core.url_file') . 'idrive/preroll/' . $sPrerollFilePath . '" />' .
			'<param name="wmode" value="opaque" />' .
			(Phpfox::getParam('dvs.enable_subdomain_mode') ? '<embed wmode="opaque" allowfullscreen="true" type="application/x-shockwave-flash" src="' . Phpfox::getLib('url')->makeUrl('www.module.dvs.static.swf') . 'player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file=' . Phpfox::getParam('core.url_file') . 'dvs/preroll/' . $sPrerollFilePath . '" />' : '<embed wmode="opaque" allowfullscreen="true" type="application/x-shockwave-flash" src="../../../../module/dvs/static/swf/player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="file=' . Phpfox::getParam('core.url_file') . 'dvs/preroll/' . $sPrerollFilePath . '" />' ) .
			'</object>' .
			'<br />' .
			//Link to change again
			'<a href="#" onclick="' .
			//Link: Change text
			'window.parent.document.getElementById(\\\'preroll_file_label\\\').innerHTML = \\\'' .
			//Link: The text
			Phpfox::getPhrase('idrive.select_file') .
			'\\\';' .
			//Link: Show the upload form
			'window.parent.document.getElementById(\\\'js_preroll_upload_frame\\\').style.display = \\\'block\\\';' .
			//Link: Hide the preview
			'window.parent.document.getElementById(\\\'preroll_file_preview\\\').style.display = \\\'none\\\';">' .
			//Link text
			Phpfox::getPhrase('idrive.change_pre_roll_swf') .
			'</a>\';';

			echo 'window.parent.document.getElementById(\'preroll_file_label\').innerHTML = \'' . Phpfox::getPhrase('idrive.current_pre_roll_swf') . ':\';';
			echo 'window.parent.document.getElementById(\'preroll_file_id\').value = \'' . $iPrerollFileId . '\';';
			echo 'window.parent.document.getElementById(\'preroll_duration\').value = \'\';';
			echo 'window.parent.document.getElementById(\'preroll_file_preview\').style.display = \'block\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('idrive.preroll-file-form', array('current-preroll-id' => $iPrerollFileId)) . '">';
			exit;
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'window.parent.document.getElementById(\'js_preroll_file_upload_error\').style.display = \'block\';';
			echo 'window.parent.document.getElementById(\'js_preroll_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
			echo '</script>';

			echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('idrive.preroll-file-form') . '">';
			exit;
		}
	}


}

?>