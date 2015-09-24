<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        $aDvs = array();
        $aDvs['title_url'] = 'sierratoyota';
        $aDvs['dealer_name'] = 'Commonwealth Honda';
        Phpfox::getService('dvs.analytics.export')->exportOverall(Phpfox::getParam('core.dir_cache'), 7, $aDvs);
    }
}
?>