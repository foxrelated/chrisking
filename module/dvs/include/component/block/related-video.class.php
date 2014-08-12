<?php

class Dvs_Component_Block_Related_Video extends Phpfox_Component {
    public function process() {
        $bSubdomainMode = Phpfox::getParam('dvs.enable_subdomain_mode');

        $aDvs = $this->getParam('aDvs');
        $aVideo = $this->getParam('aVideo');

        $aFooterLinks = Phpfox::getService('dvs.video')->getRelatedVideo($aVideo, $aDvs['dvs_id']);

        $this->template()->assign(array(
            'bSubdomainMode' => $bSubdomainMode,
            'aDvs' => $aDvs,
            'aFooterLinks' => $aFooterLinks
        ));
    }
}
?>