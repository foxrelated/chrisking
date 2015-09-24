<?php

class Dvs_Component_Block_Analytics_Sharing extends Phpfox_Component {
    public function process() {
        $aDvs = $this->getParam('aDvs');
        $sDateFrom = $this->getParam('sDateFrom');

        $oGAService = Phpfox::getService('dvs.analytics');

        // Emails Sent
        $oEmailSentRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Email Share Sent;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iEmailSentEvent = (int)$oEmailSentRequest->totalsForAllResults['ga:totalEvents'];

        // Emails Clicked
        $oEmailClickedRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Email Share Clicked;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iEmailClickedEvent = (int)$oEmailClickedRequest->totalsForAllResults['ga:totalEvents'];

        // Click-Through Rate
        if ($iEmailSentEvent > 0) {
            $iCTRate = (int)$iEmailClickedEvent * 100 / (int)$iEmailSentEvent;
            $iCTRate = number_format($iCTRate, 0);
        } else {
            $iCTRate = 0;
        }

        // Most Shares Viewed
//        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$aDvs['dealer_name'],'sort'=>'-ga:sessions'), $sDateFrom);
        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links','sort'=>'-ga:sessions'), $sDateFrom);
        if ($oShareViewRequest->rows) {
            $sShareViewData = "[";
            foreach($oShareViewRequest->rows as $aDataRow) {
                $sShareViewData .= "['" . $aDataRow[0] . "', " . $aDataRow[1] . "],";
            }
            $sShareViewData = substr($sShareViewData, 0, -1);
            $sShareViewData .= "]";
        } else {
            $sShareViewData = "null";
        }

        $this->template()
            ->assign(array(
                'sJavascript' =>
                    '<script type="text/javascript">' .
                    'var iEmailSentEvent = "' . $iEmailSentEvent . '";' .
                    'var iEmailClickedEvent = "' . $iEmailClickedEvent . '";' .
                    'var iCTRate = "' . $iCTRate . '%";' .
                    'var shareViewDataRaw = ' . $sShareViewData . ';' .
                    '</script>'
            ));
    }
}
?>