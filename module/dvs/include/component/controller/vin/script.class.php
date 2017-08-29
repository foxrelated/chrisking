<?php

class Dvs_Component_Controller_VIN_Script extends Phpfox_Component {
    public function process() {
        $sBrowser = Phpfox::getService('dvs')->getBrowser();
        $iScreenHeight = $this->request()->get('height');
        $iScreenWidth = $this->request()->get('width');
        $iDvsId = $this->request()->get('id');
        $bLoadByCdk = false;
        if ($iDvsId == '') {
            $sDvsCdk = $this->request()->get('cdk');
            $iDvsId = Phpfox::getService('dvs')->getIdByCdk($sDvsCdk);
            $bLoadByCdk = true;
        }
        $sAllVin = $this->request()->get('vin');
        $sAllEdStyle = $this->request()->get('edstyle');
        $aRows = array();
        $aVins = array();
        $aEdStyles = array();
        if ($sAllVin) {
            $aVins = explode(',', $sAllVin);
            list($aRows, $aDvs) = Phpfox::getService('dvs.vin')->getVins($aVins, $iDvsId, $iScreenWidth, $iScreenHeight, $bLoadByCdk);
        }

        if ($sAllEdStyle) {
            $aEdStyles = explode(',', $sAllEdStyle);
            list($aNewRows, $aDvs) = Phpfox::getService('dvs.vin')->getEdStyles($aEdStyles, $iDvsId, $iScreenWidth, $iScreenHeight);
            foreach($aNewRows as $sKey => $aRow) {
                $aRows[$sKey] = $aRow;
            }
        }

        if (!$sAllVin && !$sAllEdStyle) {
            echo('');
            exit;
        }


        // Load wtvVideo
        $sIframeUrl = '';
        if (isset($aDvs['modal_player']) && ($aDvs['modal_player'] == 1) && $sWtvVideo = $this->request()->get('wtvVideo', '')) {
            if (Phpfox::getParam('dvs.enable_subdomain_mode')) {
                $sIframeUrl = Phpfox::getLib('url')->makeUrl($aDvs['title_url'],  array('dvs-vdp-iframe', $sWtvVideo, 'width_' . $iScreenWidth, 'height_' . $iScreenHeight, 'cdk_' . ($bLoadByCdk ? '1' : '0')));
            } else {
                $sIframeUrl = Phpfox::getLib('url')->makeUrl('dvs', array($aDvs['title_url'], 'dvs-vdp-iframe', $sWtvVideo, 'width_' . $iScreenWidth, 'height_' . $iScreenHeight, 'cdk_' . ($bLoadByCdk ? '1' : '0')));
            }
        }


        $this->template()->assign(array(
            'aDvs' => $aDvs,
            'aRows' => $aRows,
            'iTotalVin' => count($aVins) + count($aEdStyles),
            'sButtonText' => str_replace("'", "\\'", $aDvs['vin_button_label']),
            'bLoadByCdk' => $bLoadByCdk,
            'sIframeUrl' => $sIframeUrl
        ));

        if($aDvs['vdp_file_name']) {
            $this->template()->assign(array(
                'vdp_background' => Phpfox::getLib('image.helper')->display(array(
                    'server_id' => $aDvs['vdp_file_server_id'],
                    'path' => 'core.url_file',
                    'file' => 'dvs/vdp/' . $aDvs['vdp_file_name'],
                    'return_url' => 'true'
                ))
            ));
        }

        $lastModified = filemtime(PHPFOX_DIR . 'module' . PHPFOX_DS . 'dvs' . PHPFOX_DS . 'include' . PHPFOX_DS . 'component' . PHPFOX_DS . 'controller' . PHPFOX_DS . 'vin' . PHPFOX_DS . 'script.class.php');
//        header('Content-type: text/javascript;charset=utf-8');
//        header('Cache-Control: max-age=259200');
//        header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//        header('Expires: '.gmdate("D, d M Y H:i:s", time() + 3600*24*365).' GMT');

        echo $this->template()->getTemplate('dvs.controller.vin.script', true);
        exit;
    }
}
?>