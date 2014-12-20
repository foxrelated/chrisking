<?php

class Dvs_Component_Controller_Vin_Style extends Phpfox_Component {
    public function process() {
        $aStyle = array(
            'vin_top_gradient' => '#A764C5',
            'vin_bottom_gradient' => '#451656',
            'vin_font_size' => '12px',
            'loading_image' => Phpfox::getLib('image.helper')->display(array(
                'theme' => 'ajax/add.gif',
                'return_url' => true
            )),
            'close_btn' => Phpfox::getLib('image.helper')->display(array(
                'theme' => 'layout/modal_close_icon.png',
                'return_url' => true
            ))
        );

        $iDvsId = $this->request()->get('id');
        if ($aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            $aStyle['vin_top_gradient'] = '#' . $aDvs['vin_top_gradient'];
            $aStyle['vin_bottom_gradient'] = '#' . $aDvs['vin_bottom_gradient'];
            $aStyle['vin_font_size'] = $aDvs['vin_font_size'];
            $aStyle['vin_text_color'] = '#' . $aDvs['vin_text_color'];
            if($aDvs['vdp_file_name']) {
                $aStyle['vdp_background'] = Phpfox::getParam('core.url_file') . 'dvs/vdp/' . $aDvs['vdp_file_name'];
            }
        }
        $this->template()->assign(array(
            'aStyle' => $aStyle,
            'sPopupBg' => Phpfox::getLib('image.helper')->display(array(
                'theme' => 'layout/thickbox_bg.png',
                'return_url' => true
            )),
            'aDvs' => $aDvs
        ));

        $lastModified = filemtime(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'include' . PHPFOX_DS . 'component' . PHPFOX_DS . 'controller' . PHPFOX_DS . 'vin' . PHPFOX_DS . 'style.class.php');

        header('Content-type: text/css;charset=utf-8');
        header('Cache-Control: max-age=259200');
        header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
        header('Expires: '.gmdate("D, d M Y H:i:s", time() + 3600*24*365).' GMT');

        echo $this->template()->getTemplate('dvs.controller.vin.style', true);
        exit;
    }
}
?>