<?php

class Dvs_Component_Block_Analytics_Sharing extends Phpfox_Component {
    public function process() {
        try {
            $aDvs = $this->getParam('aDvs');
            $sDateFrom = $this->getParam('sDateFrom');

            $oGAService = Phpfox::getService('dvs.analytics');

            // Emails Sent
            //$oEmailSentRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:eventLabel==Email Share Sent;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
            //$iEmailSentEvent = (int)$oEmailSentRequest->totalsForAllResults['ga:totalEvents'];

            // Emails Clicked
            //$oEmailClickedRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:campaign==DVS Share Links;ga:medium==Email;ga:source=~^'.$aDvs['dealer_name']), $sDateFrom);
            //$iEmailClickedEvent = (int)$oEmailClickedRequest->totalsForAllResults['ga:sessions'];

            //CRM Video Email Open
            $oEmailOpenRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:campaign==DVS Share Links;ga:medium==CRM Video Email Open;ga:source=~^'.$this->prepareName(['dealer_name'])), $sDateFrom);
            $iEmailOpenEvent = (int)$oEmailOpenRequest->totalsForAllResults['ga:sessions'];


            //CRM Video Email Click
            $oEmailClickRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:campaign==DVS Share Links;ga:medium==CRM Video Email Click;ga:source=~^'.$this->prepareName(['dealer_name'])), $sDateFrom);
            $iEmailClickEvent = (int)$oEmailClickRequest->totalsForAllResults['ga:sessions'];

            // Click-Through Rate
            if ($iEmailOpenEvent > 0) {
                $iCTRate = (int)$iEmailClickEvent * 100 / (int)$iEmailOpenEvent;
                $iCTRate = number_format($iCTRate, 0);
            } else {
                $iCTRate = 0;
            }

            // Most Shares Viewed
            $aDefaultValue = array(
                'Email' => 0,
                'Text Message' => 0,
                'CRM Embed' => 0,
                'Facebook' => 0,
                'Twitter' => 0,
                'Google' => 0,
                'Direct Link' => 0,
                'QR Code' => 0,
                'CRM Video Email Open' => 0,
                'CRM Video Email Click' => 0
            );
            $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$this->prepareName(['dealer_name']),'sort'=>'-ga:sessions'), $sDateFrom);
            if ($oShareViewRequest->rows) {
                $sShareViewData = "[";
                foreach($oShareViewRequest->rows as $aDataRow) {
                    $sShareViewData .= "['" . $aDataRow[0] . "', " . $aDataRow[1] . "],";
                    if (isset($aDefaultValue[$aDataRow[0]])) {
                        unset($aDefaultValue[$aDataRow[0]]);
                    }
                }
                foreach($aDefaultValue as $sKey => $sValue) {
                    $sShareViewData .= "['" . $sKey . "', " . $sValue . "],";
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
                        'var iEmailOpenEvent = "' . $iEmailOpenEvent . '";' .
                        'var iEmailClickEvent = "' . $iEmailClickEvent . '";' .
                        'var iCTRate = "' . $iCTRate . '%";' .
                        'var shareViewDataRaw = ' . $sShareViewData . ';' .
                        '</script>'
                ));
        } catch (\Exception $e) {
            Phpfox::getLib('file')->write(PHPFOX_DIR_FILE . 'log' . PHPFOX_DS . 'analytics_error_overall'  . PHPFOX_TIME . uniqid() . '.log', $e->getMessage() . "\n" . $e->getTraceAsString());

        }

    }
    function prepareName($dealerName) {
        $dealerName = str_replace("&#039;","'", $dealerName);
        $dealerName = str_replace("&amp;", "%26",$dealerName);
        $dealerName = str_replace(";", "\;",$dealerName);
        $dealerName = str_replace(",", "\,",$dealerName);

        return $dealerName;
    }
}
?>