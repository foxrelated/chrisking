<?php

class Dvs_Component_Controller_Vin extends Phpfox_Component {
    public function process() {
        $sVin = $this->request()->get('vin');
        $iDvsId = $this->request()->get('dvs');

        if(!$sVin || !$iDvsId) {
            Phpfox_Error::set('Please provide VIN and DVS Id');
            return false;
        }

        /** DISABLE HEADER & FOOTER **/
        $aLocale = Phpfox::getLib('locale')->getLang();
        $this->template()->assign(array(
                'sLocaleDirection' => $aLocale['direction'],
                'sLocaleCode' => $aLocale['language_code'],
                'sLocaleFlagId' => $aLocale['image'],
                'sLocaleName' => $aLocale['title']
            )
        );

        $sVideoRef = Phpfox::getService('dvs.vin')->getVideoRefByVin($sVin, $iDvsId);

        Phpfox::getService('dvs.video')->setDvs($iDvsId);
        $aVideo = Phpfox::getService('dvs.video')->get($sVideoRef);
        $aDvs = Phpfox::getService('dvs')->get($iDvsId);

        if(!$aVideo || !$aDvs) {
            return false;
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

        $aDvs['vin_font_size'] = '12px';
        $aDvs['vin_btn_color'] = 'FFFFFF';
        $aDvs['vin_top_gradient'] = 'a764c5';
        $aDvs['vin_bottom_gradient'] = '451656';

        $this->template()
            ->setHeader('cache', array(
                'vin.css' => 'module_dvs'
            ))
            ->assign(array(
                'sHeight' => $this->request()->get('height', '29'),
                'sVideoUrl' => $sOverrideLink,
                'aDvs' => $aDvs
            ));

        echo $this->template()->getTemplate('dvs.controller.vin', true);
        exit;
    }
}
?>