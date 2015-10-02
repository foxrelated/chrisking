<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        $aDvs = array();
        $aDvs['title_url'] = 'sierratoyota';
        $aDvs['dealer_name'] = 'Commonwealth Honda';
        $aDvs['dvs_name'] = 'Testing DVS';
        Phpfox::getService('dvs.analytics.export')->exportOverallCSV(7, $aDvs);
    }
}
?>