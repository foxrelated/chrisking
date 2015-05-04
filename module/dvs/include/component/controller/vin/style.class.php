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

        // Resize player for mobile device
        $sBrowser = Phpfox::getService('dvs')->getBrowser();
        $iScreenHeight = $this->request()->get('height');
        $iScreenWidth = $this->request()->get('width');

        if ($sBrowser == 'mobile') {
            $iPopupWidth = (int)($iScreenWidth * 0.9);
            if ($iPopupWidth > 930) {
                $iPopupWidth = 930;
            }
            $iPlayerWidth = (int)($iPopupWidth * 0.9);
            $iPlayerHeight = (int)($iPlayerWidth * 405 / 720);
            $iPopupHeight = $iPlayerHeight + 80;
            $this->template()->assign(array(
                'iPopupWidth' => $iPopupWidth,
                'iPopupHeight' => $iPopupHeight,
                'iPlayerWidth' => $iPlayerWidth,
                'iPlayerHeight' => $iPlayerHeight
            ));
        }

        $this->template()->assign(array(
            'sBrowser' => $sBrowser,
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