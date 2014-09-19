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
            ))
        );

        $iDvsId = $this->request()->get('id');
        if ($aDvs = Phpfox::getService('dvs')->get($iDvsId)) {
            $aStyle['vin_top_gradient'] = '#' . $aDvs['vin_top_gradient'];
            $aStyle['vin_bottom_gradient'] = '#' . $aDvs['vin_bottom_gradient'];
            $aStyle['vin_font_size'] = $aDvs['vin_font_size'];
        }
        $this->template()->assign(array(
            'aStyle' => $aStyle
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