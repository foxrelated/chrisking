<?php

class Dvs_Component_Controller_VIN_Script extends Phpfox_Component {
    public function process() {
        $iDvsId = $this->request()->get('id');
        $sAllVin = $this->request()->get('vin');
        $aVins = explode(',', $sAllVin);
        list($aRows, $aDvs) = Phpfox::getService('dvs.vin')->getVins($aVins, $iDvsId);

        $this->template()->assign(array(
            'aDvs' => $aDvs,
            'aRows' => $aRows,
            'sButtonText' => str_replace("'", "\\'", $aDvs['vin_button_label'])
        ));

        $lastModified = filemtime(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'include' . PHPFOX_DS . 'component' . PHPFOX_DS . 'controller' . PHPFOX_DS . 'vin' . PHPFOX_DS . 'script.class.php');
        header('Content-type: text/javascript;charset=utf-8');
        header('Cache-Control: max-age=259200');
        header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
        header('Expires: '.gmdate("D, d M Y H:i:s", time() + 3600*24*365).' GMT');

        echo $this->template()->getTemplate('dvs.controller.vin.script', true);
        exit;
    }
}
?>