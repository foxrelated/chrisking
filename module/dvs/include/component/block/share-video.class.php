<?php

class Dvs_Component_Block_Share_Video extends Phpfox_Component {
    public function process() {
        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $aDvs = $this->getParam('aDvs');
        $aShareVideos = $this->getParam('aShareVideos');
        $sDvsTitle = $aDvs['title_url'];

        if( stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false or stripos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false ) {
            $bIsIPhone = 1;
        } else {
            $bIsIPhone = 0;
        }

        if( $bSubdomainMode ) {
            $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( 'www' );//$sDvsTitle );
        } else {
            $sVideoViewUrl = Phpfox::getLib('url')->makeUrl( '' ) . $sDvsTitle;
        }

        $this->template()
        	->assign(array(
				'aShareVideos' => $aShareVideos,
				'aVideo' => Phpfox::getService('dvs.video')->get($sReferenceId),
				'aDvs' => $aDvs,
				'sDvsUrl' => Phpfox::getLib('url')->makeUrl($aDvs['title_url']),
				//'sImagePath' => ($bSubdomainMode ? Phpfox::getLib('url')->makeUrl('www.module.dvs.static.image') : Phpfox::getLib('url')->makeUrl('module.dvs.static.image')),
				'sImagePath' => $this->getParam('sImagePath'),
				'bDebug' => (Phpfox::getParam('dvs.javascript_debug_mode') ? true : false),
				'bIsIPhone' => $bIsIPhone,
				'sVideoViewUrl' => $sVideoViewUrl
        ));
    }
}
?>