<?php

class Dvs_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        //Phpfox::getService('dvs.inventory')->importFile();

        Phpfox::getService('dvs.inventory')->updateEdStyleId();

        //Phpfox::getService('dvs.inventory')->updateReferenceId();
    }
}
?>