<?php

class Imagesize_Component_Controller_Admincp_Email extends Phpfox_Component {
    public function process() {
        list($iTotal, $iCompleted) = Phpfox::getService('imagesize')->getCount(true);

        $this->template()
            ->setBreadCrumb('Build Images for Brightcove Item', null, true)
            ->assign(array(
                'iTotal' => $iTotal,
                'iCompleted' => $iCompleted
            ));
    }
}
?>