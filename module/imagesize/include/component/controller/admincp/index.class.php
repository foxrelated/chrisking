<?php

class Imagesize_Component_Controller_Admincp_Index extends Phpfox_Component {
    public function process() {
        list($iTotal, $iCompleted) = Phpfox::getService('imagesize')->getCount();

        $this->template()
            ->setBreadCrumb('Build Images for Brightcove Item', null, true)
            ->assign(array(
                'iTotal' => $iTotal,
                'iCompleted' => $iCompleted
            ));
    }
}
?>