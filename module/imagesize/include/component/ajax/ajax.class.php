<?php

class Imagesize_Component_Ajax_Ajax extends Phpfox_Ajax {
    public function buildNextItem() {
        $oImageSize = Phpfox::getService('imagesize');
        if ($aItem = $oImageSize->getNextItem()) {
            $this->html('#current_item', '#' . $aItem['ko_id'] . ' : ' . $aItem['name']);
            if($oImageSize->createImage($aItem['ko_id'])) {
                list($iTotal, $iCompleted) = Phpfox::getService('imagesize')->getCount();
                $this->call('iContinue = 1;')
                    ->html('#completed_total', $iCompleted)
                    ->html('#item_total', $iTotal)
                    ->val('#completed_total_value', $iCompleted);
            }
        } else {
            $this->call('iContinue = 0;');
            $this->alert('Completed');
        }
        $this->hide('#build_ajax_processing');
    }
}
?>