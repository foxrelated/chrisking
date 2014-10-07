<?php

class Dvs_Component_Block_Share_Video extends Phpfox_Component {
    public function process() {
        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $aDvs = $this->getParam('aDvs');
        $aShareVideos = $this->getParam('aShareVideos');
        $sDvsTitle = $aDvs['title_url'];

        if( stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false or stripos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false ) {
            $bIsIPhone = 1;
        } else {
            $bIsIPhone = 0;
        }

        $sVideoViewUrl = '';
        if($aDvs['sitemap_parent_url']) {
            foreach($aShareVideos as $iKey => $aShareVideo) {
                $aShareVideos[$iKey]['parent_video_url'] = str_replace('WTVDVS_VIDEO_TEMP', $aShareVideo['video_title_url'], $aDvs['parent_video_url']);
            }
        } else {
            if( $bSubdomainMode ) {
                $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( 'www' );//$sDvsTitle );
            } else {
                $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( '' ) . $sDvsTitle;
            }
        }


        $this->template()
        ->assign(array(
            'aShareVideos' => $aShareVideos,
            'aDvs' => $aDvs,
            'sDvsUrl' => Phpfox::getLib('url')->makeUrl($aDvs['title_url']),
            'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
            'bDebug' => (Phpfox::getParam('dvs.javascript_debug_mode') ? true : false),
            'bIsIPhone' => $bIsIPhone,
            'sVideoViewUrl' => $sVideoViewUrl
        ));
    }
}
?>