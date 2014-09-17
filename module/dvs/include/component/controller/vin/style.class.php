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

        echo $this->template()->getTemplate('dvs.controller.vin.style', true);
        exit;
    }
}
?>