<?php

class Dvs_Service_Iframe extends Phpfox_Service {
    public function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs');
    }

    public function parseUrl($sParentUrl) {
        $share = '';
        $video = '';
        $sOriginParent = $sParentUrl;

        $aUrlData = parse_url($sParentUrl);

        if(isset($aUrlData['query']) && ($aUrlData['query'])) {
            parse_str($aUrlData['query']);
            if($share) {
                $sParentUrl = str_replace('&share=' . $share, '', $sParentUrl);
            }

            if($video) {
                $sNewUrl = str_replace($video, 'WTVDVS_VIDEO_TEMP', $sParentUrl);
                $sOriginParent = str_replace('video=' . $video, '', $sParentUrl);
                if(in_array(substr($sOriginParent, -1), array('?', '&'))) {
                    $sOriginParent = substr($sOriginParent, 0, -1);
                }
            } else {
                $sNewUrl = $sParentUrl . '&video=WTVDVS_VIDEO_TEMP';
                $sOriginParent = $sParentUrl;
            }
        } else {
            $sNewUrl = $sParentUrl . '?video=WTVDVS_VIDEO_TEMP';
        }

        return array($video, $sNewUrl, $sOriginParent, array(
            'share' => $share
        ));
    }

    public function updateSitemapUrl($iDvsId, $sParentVideoUrl, $sParentUrl) {
        $this->database()
            ->update($this->_sTable,
                array(
                    'parent_url' => $sParentUrl,
                    'parent_video_url' => $sParentVideoUrl
                ),
            'dvs_id = ' . (int)$iDvsId);
        return true;
    }
}
?>