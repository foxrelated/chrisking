<?php

class Imagesize_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

        //Phpfox::getService('imagesize')->createEmailThumb();

        $oImageSize = Phpfox::getService('imagesize');
        $aItem = $oImageSize->getNextItem(true);
        $oImageSize->createEmailImage($aItem['ko_id']);
        vdd(1);
    }
}
?>