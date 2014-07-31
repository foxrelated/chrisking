<?php

class Imagesize_Component_Controller_Test extends Phpfox_Component {
    public function process() {
        Phpfox::getLib('setting')->setParam('brightcove.dir_image', PHPFOX_DIR_FILE . 'pic' . PHPFOX_DS . 'brightcove' . PHPFOX_DS);
        Phpfox::getLib('setting')->setParam('brightcove.url_image', Phpfox::getParam('core.url_pic') . 'brightcove/');

        $sFile = Phpfox::getParam('brightcove.dir_image') . '2014/07/c3d17384c050003940ff06a221e7469e' . '_300.jpg';
        $sNewFile = Phpfox::getParam('brightcove.dir_image') . '2014/07/c3d17384c050003940ff06a221e7469e' . '_email.jpg';

        Phpfox::getService('imagesize')->createEmailThumb($sFile, $sNewFile);
    }
}
?>