<?php

/**
 * [PHPFOX_HEADER]
 */
defined('PHPFOX') or exit('No direct script access allowed.');

/**
 *
 *
 * @copyright        Konsort.org 
 * @author          Konsort.org
 * @package         DVS
 */
class Dvs_Component_Controller_Player_Image_Overlay_Frame extends Phpfox_Component {

    public function process()
    {
        
        if (!Phpfox::isUser())
        {
            exit;
        }
        
        $overlay_id = $this->request()->get('image_overlay');
        $sOverlayFile = $this->request()->get('image_overlay'.$overlay_id.'_file');
        
                $aPathParts = pathinfo($sOverlayFile['name']);
               
                //PHP 5.1 fix
                if (!isset($aPathParts['filename']))
                {
                    $aPathParts['filename'] = basename($_FILES['image']['name'][0], '.' . $aPathParts['extension']);
                }

                $sUploadFileName = $aPathParts['filename'] . md5(PHPFOX_TIME);
                
                if($aPathParts['filename'] != '' && $overlay_id > 0){
                    
                $tmp_name = $sOverlayFile['tmp_name'];
                                
                if(!in_array($aPathParts['extension'],Phpfox::getParam('dvs.allowed_file_types'))){
                    echo '<script type="text/javascript">';
                    echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_error\').style.display = \'block\';';
                    echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_message\').innerHTML = \'Invalid file. Please try again. We accept only '.implode(', ',Phpfox::getParam('dvs.allowed_file_types')).' files.\';';
                    echo '</script>';
                    echo '<script type="text/javascript">window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_upload_frame\').src=window.parent.document.getElementById(\'overlay'.$overlay_id.'_target\').value;</script>';
                    
                    exit;   
                }
                
                $image_size = getimagesize($tmp_name);
                $width = $image_size[0];
                $height = $image_size[1];
                
                if(($width < 100 || $width > 600) || ($height < 50 || $height > 75)){
                     echo '<script type="text/javascript">';
                    echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_error\').style.display = \'block\';';
                    echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_message\').innerHTML = \'Image dimensions should be minimum of 100*50 and maximum of 600*75\';';
                    echo '</script>';
                    echo '<script type="text/javascript">window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_upload_frame\').src=window.parent.document.getElementById(\'overlay'.$overlay_id.'_target\').value;</script>';
                    
                    exit;   
                }
                
                
                
                $aOverlayFile = Phpfox::getLib('file')->load('image_overlay'.$overlay_id.'_file', Phpfox::getParam('dvs.allowed_file_types'), Phpfox::getUserParam('dvs.file_size_limit'));
                
                
                 $sOverlayFilePath = Phpfox::getLib('file')->upload('image_overlay'.$overlay_id.'_file', Phpfox::getParam('core.dir_file') . 'dvs' . PHPFOX_DS . 'preroll' . PHPFOX_DS, $sUploadFileName);
                 
                 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ){
                     $ref = "https://";
                 }else{
                     $ref = "http://";
                 }
         
               echo '<script type="text/javascript">';
            echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_upload_frame\').style.display = \'none\';';
            echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_error\').style.display = \'none\';';

            $sOverlayFilePath = str_replace('%s','',$sOverlayFilePath);
            
            //Change preview frame contents
            echo 'window.parent.document.getElementById(\'image_overlay'.$overlay_id.'_preview\').innerHTML = \'' .
            //The preview
            '<img src="'.$ref.Phpfox::getParam('core.host') . '/file/dvs' . PHPFOX_DS . 'preroll' . PHPFOX_DS.$sOverlayFilePath.'" id="overlay_'.$overlay_id.'_img"><br>'.
            //Link to change again
            '<a href="javascript:void(0);" onclick="' .
            //Link: Show the upload form
            'window.parent.document.getElementById(\\\'js_image_overlay'.$overlay_id.'_upload_frame\\\').style.display = \\\'block\\\';' .
            //Link: Hide the preview
            'window.parent.document.getElementById(\\\'image_overlay'.$overlay_id.'_preview\\\').style.display = \\\'none\\\';">' .
            //Link text
            
            'Change Overlay Image </a> - <a href="javascript:void(0);" onclick="'.
            
            'window.parent.document.getElementById(\\\'js_image_overlay'.$overlay_id.'_upload_frame\\\').style.display = \\\'block\\\';window.parent.document.getElementById(\\\'image_overlay'.$overlay_id.'_preview\\\').style.display = \\\'none\\\';window.parent.document.getElementById(\\\'image_overlay'.$overlay_id.'_file_path\\\').value = \\\'\\\';window.parent.document.getElementById(\\\'overlay_'.$overlay_id.'_img\\\').src=\\\'\\\';"> Remove Overlay Image</a>\';';

            
            echo 'window.parent.document.getElementById(\'image_overlay'.$overlay_id.'_file_path\').value = \'' . $sOverlayFilePath . '\';';
            echo 'window.parent.document.getElementById(\'image_overlay'.$overlay_id.'_preview\').style.display = \'inline-block\';';
            echo '</script>';
              

               echo '<script type="text/javascript">window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_upload_frame\').src=window.parent.document.getElementById(\'overlay'.$overlay_id.'_target\').value;</script>';

            //echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.player.preroll-file-form', array('current-preroll-id' => $iImageOverlayFileId)) . '">';
            exit;
        //}
       
            //echo '<script type="text/javascript">';
//            echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_error\').style.display = \'block\';';
//            echo 'window.parent.document.getElementById(\'js_image_overlay'.$overlay_id.'_file_upload_message\').innerHTML = \'' . implode('<br />', Phpfox_Error::get()) . '\';';
//            echo '</script>';
//
//            echo'<meta http-equiv="refresh" content="0; url=' . Phpfox::getLib('url')->makeUrl('dvs.player.preroll-file-form') . '">';
//            exit;
        
    }
    }


}

?>