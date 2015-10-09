<?php

class Dvs_Component_Controller_Analytics_Export extends Phpfox_Component {
    public function process() {
        $sDvsTitleUrl = $this->request()->get('id', '');
        $sFileType = $this->request()->get('file', 'pdf');

        $sNewFile = Phpfox::getParam('core.dir_cache') . trim($sDvsTitleUrl) . '_' . date('Ymd') . '.' . $sFileType;
        if (file_exists($sNewFile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename='.basename($sNewFile));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($sNewFile));
            ob_clean();
            flush();
            readfile($sNewFile);
            @unlink($sNewFile);
        }
        exit();
    }
}
?>