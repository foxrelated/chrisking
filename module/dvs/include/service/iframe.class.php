<?php

class Dvs_Service_Iframe extends Phpfox_Service {
    public function parseUrl($sParentUrl) {
        $video = '';

        $aUrlData = parse_url($sParentUrl);

        if(isset($aUrlData['query']) && ($aUrlData['query'])) {
            parse_str($aUrlData['query']);
            if($video) {
                $sNewUrl = str_replace($video, 'WTVDVS_VIDEO_TEMP', $sParentUrl);
            } else {
                $sNewUrl = $sParentUrl . '&video=WTVDVS_VIDEO_TEMP';
            }
        } else {
            $sNewUrl = $sParentUrl . '?video=WTVDVS_VIDEO_TEMP';
        }

        return array($video, $sNewUrl);
    }
}
?>