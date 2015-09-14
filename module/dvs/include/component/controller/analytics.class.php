<?php

class Dvs_Component_Controller_Analytics extends Phpfox_Component {
    public function process() {
        $this->template()->assign(array(
            'sGaAccessToken' => Phpfox::getService('dvs.analytics')->getAccess()
        ));
    }
}

?>