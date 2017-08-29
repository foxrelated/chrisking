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
class Dvs_Component_Controller_Vdp_File_Frame extends Phpfox_Component {
    public function process() {
        if (!Phpfox::isUser()) {
            exit;
        }

        if (!isset($_FILES['vdp_file']['name'])) {
            Phpfox::getService('dvs.file.process')->removeVdp($this->request()->get('vdp_file_id'));
            echo '<script type="text/javascript">';
            echo 'window.parent.document.getElementById(\'js_vdp_file_upload_error\').style.display = \'block\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_upload_message\').innerHTML = \'Failed to upload file. File is too large.\';';
            echo 'window.parent.document.getElementById(\'js_vdp_upload_inner_form\').style.display = \'block\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_detail\').style.display = \'none\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_process\').style.display = \'none\';';
            echo '</script>';
            exit;
        }

        if ($iVdpFileId = Phpfox::getService('dvs.file')->addVdpFile($this->request()->get('vdp_file_id'))) {
            $sVdpFilePath = Phpfox::getService('dvs.file')->getVdpFile($iVdpFileId);
            $sImageUrl = Phpfox::getLib('image.helper')->display(array(
                'server_id' => Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID'),
                'path' => 'core.url_file',
                'file' => 'dvs/vdp/' . $sVdpFilePath,
                'return_url' => 'true'
            ));
            echo '<script type="text/javascript">';
            echo 'window.parent.document.getElementById(\'js_vdp_upload_frame\').style.display = \'none\';';
            echo 'window.parent.document.getElementById(\'vdp_file_preview\').innerHTML = \'<input type="hidden" name="vdp_file_id" value="' . $iVdpFileId . '" /><img src="' . $sImageUrl . '" width="180" /><br /><a href="#" onclick="window.parent.document.getElementById(\\\'vdp_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_vdp_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'vdp_file_preview\\\').style.display = \\\'none\\\';">Change Vdp Image</a> - <a href="#" onclick="if (confirm(\\\'Are you sure?\\\')){window.parent.document.getElementById(\\\'vdp_file_label\\\').innerHTML = \\\'' . Phpfox::getPhrase('dvs.select_file') . '\\\';window.parent.document.getElementById(\\\'js_vdp_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'vdp_file_preview\\\').style.display = \\\'none\\\';window.parent.document.getElementById(\\\'vdp_file_id\\\').value = 0;$.ajaxCall(\\\'dvs.removeVdpFile\\\',\\\'iVdpFileId=' . $iVdpFileId . '\\\')}">Remove VDP Image</a>\';';
            echo 'window.parent.document.getElementById(\'vdp_file_label\').innerHTML = \'' . Phpfox::getPhrase('dvs.current_image') . ':\';';
            echo 'window.parent.document.getElementById(\'vdp_file_id\').value = \'' . $iVdpFileId . '\';';
            echo 'window.parent.document.getElementById(\'vdp_file_preview\').style.display = \'block\';';
            echo '</script>';

            echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.vdp-file-form', array('current-vdp-id' => $iVdpFileId)) . '">';
            exit;
        }
        else
        {
            Phpfox::getService('dvs.file.process')->removeVdp($this->request()->get('vdp_file_id'));
            echo '<script type="text/javascript">';
            echo 'window.parent.document.getElementById(\'js_vdp_file_upload_error\').style.display = \'block\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
            echo 'window.parent.document.getElementById(\'js_vdp_upload_inner_form\').style.display = \'block\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_detail\').style.display = \'none\';';
            echo 'window.parent.document.getElementById(\'js_vdp_file_process\').style.display = \'none\';';
            echo '</script>';

            echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.vdp-file-form') . '">';
            exit;
        }

    }

}

?>