<?php

class Kobrightcove_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        Phpfox::getService('kobrightcove')->import(0, 1);
        vdd(1);
    }
}
?>