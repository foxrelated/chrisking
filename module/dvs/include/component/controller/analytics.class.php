<?php

class Dvs_Component_Controller_Analytics extends Phpfox_Component {
    public function process() {
        if (($iDvsId = $this->request()->getInt('id'))) {
            if (!Phpfox::getService('dvs')->hasAccess($iDvsId, Phpfox::getUserId())) {
                $this->url()->send('');
                return false;
            }
            $aDvs = Phpfox::getService('dvs')->get($iDvsId);
        } else {
            $this->url()->send('');
            return false;
        }
        //$aDvs['title_url'] = 'commonwealthhonda';

        $this->template()
            ->setHeader(array(
                'analytics.css' => 'module_dvs'
            ))
            ->assign(array(
                'sSitePath' => Phpfox::getParam('core.path'),
                'sJavascript' =>
                    '<script type="text/javascript">
                        var sDvsTitleUrl = "' . $aDvs['title_url'] . '";
                        var sGaAccessToken = "' . Phpfox::getService('dvs.analytics')->getAccess() . '";
                        var sGaIds = "ga:60794198";
                    </script>'
        ));
    }
}

?>