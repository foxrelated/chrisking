<?php

class Dvs_Component_Controller_Vin extends Phpfox_Component {
    public function process() {
        $sVin = $this->request()->get('vin');
        $iDvsId = $this->request()->get('dvs');

        if (!$aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            $this->url()->send('');
        }

        if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
            $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('iframe'));
        } else {
            $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs.iframe', array($aDvs['title_url']));
        }

        if(!$sVin) {
            $this->url()->send($sOverrideLink);
        }

        $sVideoRef = Phpfox::getService('dvs.vin')->getVideoRefByVin($sVin, $iDvsId);
        Phpfox::getService('dvs.video')->setDvs($iDvsId);
        $aVideo = Phpfox::getService('dvs.video')->get($sVideoRef);

        if(!$aVideo) {
            $this->url()->send($sOverrideLink);
        }

        if ($aDvs['sitemap_parent_url'] && $aDvs['parent_video_url']) {
            $sOverrideLink = str_replace('WTVDVS_VIDEO_TEMP', $aVideo['video_title_url'], $aDvs['parent_video_url']);
        } else {
            if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('iframe', $aVideo['video_title_url']));
            } else {
                $sOverrideLink = Phpfox::getLib('url')->makeUrl('dvs.iframe', array($aDvs['title_url'], $aVideo['video_title_url']));
            }
        }
        $sOverrideLink = rtrim($sOverrideLink, '/');
        $this->url()->send($sOverrideLink);
    }
}
?>