<?php
defined('PHPFOX') or exit('NO DICE!');

class Newapi_Component_Controller_Method extends Phpfox_Component {
    public function process() {
        Phpfox::getService('newapi')->process();
        exit;
    }
}

?>