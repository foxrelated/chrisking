<?php

class Customerio_Component_Block_Display extends Phpfox_Component {
    public function process() {
        $bLoadData = true;
        $aCustomerIo = array();
        if (!Phpfox::isUser() || ($this->request()->get('req1') == 'admincp')) {
            $bLoadData = false;
        } else {
            $aCustomerIo = Phpfox::getService('customerio')->get(Phpfox::getUserId());
        }

        $this->template()->assign(array(
            'bLoadData' => $bLoadData,
            'aCustomerIo' => $aCustomerIo
        ));
    }
}
?>