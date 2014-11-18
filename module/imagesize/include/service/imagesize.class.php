<?php

class Imagesize_Service_Imagesize extends Phpfox_Service {

    /**
     * Holds the final path of a file that was uploaded
     *
     * @var string
     */
    private $_sDestination;

    /**
     * Holds meta information about a file that was uploaded. Information includes $_FORM
     *
     * @var array
     */
    private $_aFile = array();

    /**
     * Holds the file extension of the file that was uploaded.
     *
     * @var string
     */
    private $_sExt;

    /**
     * Holds an ARRAY of all the supported file types identified by the routine
     *
     * @var array
     */
    private $_aSupported = array();

    /**
     * Holds the max size of what is allowed by the routine in bytes. Note that this
     * is also checked by the system to make sure it can handle such a size.
     *
     * @var int
     */
    private $_iMaxSize = null;

    function __construct() {
        $this->_sTable = Phpfox::getT('ko_brightcove');

        Phpfox::getLib('setting')->setParam('brightcove.old_dir_image', PHPFOX_DIR_FILE . 'brightcove' . PHPFOX_DS);

        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');
    }

    public function getBrightcove($iBrightcoveId) {
        $aRow = $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('ko_id = ' . (int)$iBrightcoveId)
            ->execute('getRow');
        return $aRow;
    }

    public function download($sUrl, $sDestinationFileName) {
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

    public function upload($iBrightcoveId, $sDestination, $bIsUpdate) {
        $oFile = Phpfox::getLib('file');
        $aBrightcove = $this->getBrightcove($iBrightcoveId);
        if(!$aBrightcove) {
            return false;
        }

        if($aBrightcove['is_resize'] && !$bIsUpdate) {
            return false;
        }

        $this->_sDestination = $oFile->getBuiltDir(Phpfox::getParam('brightcove.dir_image'));

        /** Move/create old image file */
        if($aBrightcove['video_still_image'] && file_exists(Phpfox::getParam('brightcove.old_dir_image') . $aBrightcove['video_still_image'])) {
            $sOldFile = Phpfox::getParam('brightcove.old_dir_image') . $aBrightcove['video_still_image'];
        } elseif($aBrightcove['videoStillURL'] && $aBrightcove['video_title_url']) {
            $sThumbnailImage = Phpfox::getService('kobrightcove.image')->download($aBrightcove['thumbnailURL'], $aBrightcove['video_title_url'] . '_thumb');
            $sVideoStillImage = Phpfox::getService('kobrightcove.image')->download($aBrightcove['videoStillURL'], $aBrightcove['video_title_url'] . '_still');
            if(file_exists(Phpfox::getParam('brightcove.old_dir_image') . $sVideoStillImage)) {
                $this->database()
                    ->update($this->_sTable,
                        array(
                            'video_still_image' => $sVideoStillImage,
                            'thumbnail_image' => $sThumbnailImage
                        ), 'ko_id = ' . $aBrightcove['ko_id']);
                $sOldFile = Phpfox::getParam('brightcove.old_dir_image') . $sVideoStillImage;
            } else {
                return false;
            }
        } else {
            return false;
        }

        if(!$aMeta = $oFile->getMeta($sOldFile)) {
            return false;
        }
        $this->_sExt = $aMeta['fileformat'];


        /** Build sFileName **/
        $sFileName = md5($aBrightcove['ko_id'] . PHPFOX_TIME . uniqid());
        if (Phpfox::getParam(array('balancer', 'enabled'))) {
            if (Phpfox::getLib('image')->isImageExtension($aMeta['fileformat'])) {
                list($iWidth, $iHeight) = getimagesize($sOldFile);
                $sFileName = $iWidth . '-' . $iHeight . '-' . Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID') . '_' . $sFileName;
            } else {
                $sFileName = Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID') . '_' . $sFileName;
            }
        }

        /** build destination with file name */
        $sDest = $this->_sDestination . $sFileName . '.' . $this->_sExt;

        @copy($sOldFile, $sDest);

        if (stristr(PHP_OS, "win")) {
            @copy($sDest, $sDest . '.cache');
            @unlink($sDest);
            @copy($sDest . '.cache', $sDest);
            @unlink($sDest . '.cache');
        } else {
            @chmod($sDest, 0644);
        }

        if (Phpfox::getParam('core.allow_cdn'))
        {
            $bReturn = Phpfox::getLib('cdn')->put($sDestination . str_replace('\\', '/', str_replace($sDestination, '', $this->_sDestination) . $sFileName . '.' . $this->_sExt));

            if ($bReturn === false) {
                return false;
            }
        }

        return str_replace('\\', '/', str_replace($sDestination, '', $this->_sDestination) . $sFileName . '%s.' . $this->_sExt);
    }

    public function createImage($iBrightcoveId, $bIsUpdate = false) {
        $aSql = array();
        $oFile = Phpfox::getLib('file');
        $sFileName = $this->upload($iBrightcoveId, Phpfox::getParam('brightcove.dir_image'), $bIsUpdate);

        if($sFileName) {
            $oImage = Phpfox::getLib('image');
            $aSql['image_path'] = $sFileName;
            $aSql['image_server_id'] = Phpfox::getLib('request')->getServer('PHPFOX_SERVER_ID');

            $aSizes = Phpfox::getParam('imagesize.bc_image_sizes');
            foreach ($aSizes as $iSize) {
                $oImage->createThumbnail(Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_' . $iSize), $iSize, $iSize);
                $this->createEmailThumb(Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_' . $iSize), Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_email_' . $iSize), $iSize);
            }

            /** BUILD EMAIL THUMBNAIL IMAGE */
            /*$oImage->createThumbnail(Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, ''), Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_300'), 300, 300);
            $this->createEmailThumb(Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_300'), Phpfox::getParam('brightcove.dir_image') . sprintf($sFileName, '_email'));*/


            $aSql['is_resize'] = 2;
        } else {
            $aSql['is_resize'] = 2;
        }
        /**
         * $aSql['is_resize']
         * 1: Successful
         * 2: No old image or no image in server
         */
        $this->database()->update($this->_sTable, $aSql, 'ko_id = ' . (int)$iBrightcoveId);

        return $aSql['is_resize'];
    }

    public function createEmailImage($iBrightcoveId, $bIsUpdate = false) {
        $aBrightCove = $this->getBrightcove($iBrightcoveId);
        $aSizes = Phpfox::getParam('imagesize.bc_image_sizes');
        foreach ($aSizes as $iSize) {
            $sFileFullPath = Phpfox::getParam('brightcove.dir_image') . sprintf($aBrightCove['image_path'], '_' . $iSize);
            if(file_exists($sFileFullPath)) {
                $this->createEmailThumb($sFileFullPath, Phpfox::getParam('brightcove.dir_image') . sprintf($aBrightCove['image_path'], '_email_' . $iSize), $iSize);
            }
        }

        $this->database()->update($this->_sTable, array('is_resize' => 2), 'ko_id = ' . (int)$iBrightcoveId);

        return true;
    }

    public function getCount($bForEmail = false) {
        if($bForEmail) {
            $sWhere = 'is_resize > 1';
        } else {
            $sWhere = 'is_resize > 0';
        }

        $iTotal = $this->database()
            ->select('COUNT(ko_id)')
            ->from($this->_sTable)
            ->execute('getField');

        $iCompleted = $this->database()
            ->select('COUNT(ko_id)')
            ->from($this->_sTable)
            ->where($sWhere)
            ->execute('getField');

        return array($iTotal, $iCompleted);
    }

    public function getNextItem($bForEmail = false) {
        if($bForEmail) {
            $sWhere = 'is_resize = 1';
        } else {
            $sWhere = 'is_resize = 0';
        }

        $aRow = $this->database()
            ->select('ko_id, name')
            ->from($this->_sTable)
            ->where($sWhere)
            ->execute('getRow');
        return $aRow;
    }

    public function createEmailThumb($sFile, $sNewFile, $iSize = 300) {
        $oFile = Phpfox::getLib('file');
        if($iSize <= 100) {
            $oStamp = imagecreatefrompng(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'static' . PHPFOX_DS . 'image' .PHPFOX_DS . 'play_btn_20.png');
        } elseif($iSize <= 300) {
            $oStamp = imagecreatefrompng(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'static' . PHPFOX_DS . 'image' .PHPFOX_DS . 'play_btn_50.png');
        } else {
            $oStamp = imagecreatefrompng(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'static' . PHPFOX_DS . 'image' .PHPFOX_DS . 'play_btn_75.png');
        }


        if ($this->_sExt) {
            if(!$aMeta = $oFile->getMeta($sFile)) {
                return false;
            }
            $this->_sExt = $aMeta['fileformat'];
        }

        if (!PHPFOX_SAFE_MODE) {
            @ini_set('memory_limit', '500M');
        }

        switch ($this->_sExt)
        {
            case 'gif':
                $oImage = @imageCreateFromGif($sFile);
                break;
            case 'png':
                $oImage = @imageCreateFromPng($sFile);
                break;
            default:
                $oImage = @imageCreateFromJpeg($sFile);
                break;
        }

        $iImageW = imagesx($oImage);
        $iImageH = imagesy($oImage);

        $iStampW = imagesx($oStamp);
        $iStampH = imagesy($oStamp);

        @imagecopy($oImage, $oStamp, (int)(($iImageW - $iStampW) / 2), (int)(($iImageH - $iStampH) / 2), 0, 0, $iStampW, $iStampH);

        if (file_exists($sNewFile))
        {
            if (@unlink($sNewFile) != true)
            {
                @rename($sNewFile, $sNewFile . '_' . rand(10,99));
            }
        }

        switch ($this->_sExt) {
            case 'gif':
                @imagegif($oImage, $sNewFile);
                break;
            case 'png':
                @imagepng($oImage, $sNewFile);
                break;
            default:
                @imagejpeg($oImage, $sNewFile);
                break;
        }
        imagedestroy($oImage);
    }
}
?>