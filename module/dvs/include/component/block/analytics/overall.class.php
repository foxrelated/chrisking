<?php

class Dvs_Component_Block_Analytics_Overall extends Phpfox_Component {
    public function process() {
        $aDvs = $this->getParam('aDvs');
        $sDateFrom = $this->getParam('sDateFrom');

        $oGAService = Phpfox::getService('dvs.analytics');
        // Leads Sent
        $oLeadSentRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Lead Sent;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iLeadSentEvent = (int)$oLeadSentRequest->totalsForAllResults['ga:totalEvents'];

        // Inventory Clicks
        $oInventoryClicksRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Show Inventory;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iInventoryClickEvent = (int)$oInventoryClicksRequest->totalsForAllResults['ga:totalEvents'];

        // Special Offer Clicks
        $oSpecialOfferClicksRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Special Offers;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iSpecialOfferClicksEvent = (int)$oSpecialOfferClicksRequest->totalsForAllResults['ga:totalEvents'];

        // Conversion Rate
        $oConversionRateRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iConversionRate = (int)$oConversionRateRequest->totalsForAllResults['ga:sessions'];
        $sConversionRate = number_format(($iLeadSentEvent + $iInventoryClickEvent + $iSpecialOfferClicksEvent) * 100 / $iConversionRate, 0);

        // Session Line
        $oSessionLineRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        list($sSessionLineData, $iSessionTotal, $iSessionMaxValue) = $oGAService->getChartData($oSessionLineRequest->rows);

        // User Line
        $oUserLineRequest = $oGAService->makeRequest('ga:users', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        list($sUserLineData, $iUserTotal, $iUserMaxValue) = $oGAService->getChartData($oUserLineRequest->rows);

        // Page View
        $oPageViewLineRequest = $oGAService->makeRequest('ga:pageviews', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        list($sPageViewLineData, $iPageViewTotal, $iPageViewMaxValue) = $oGAService->getChartData($oPageViewLineRequest->rows);

        // Pages / Session
        $oPagePerSessionLineRequest = $oGAService->makeRequest('ga:pageviewsPerSession', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        list($sPagePerSessionLineData, $iPagePerSessionTotal, $iPagePerSessionMaxValue) = $oGAService->getChartData($oPagePerSessionLineRequest->rows, 'number', 'avg');

        // Avg. Time on Page
        $oAvgTimePageLineRequest = $oGAService->makeRequest('ga:avgTimeOnPage', 
        array('dimensions'=>'ga:date','filters'=>'ga:hostname=~^'.$aDvs['title_url'].''), $sDateFrom);        
        list($sAvgTimePageLineData, $iAvgTimePageTotal, $iAvgTimePageMaxValue) = $oGAService->getChartData($oAvgTimePageLineRequest->rows, 'time', 'avg');

        // Bounce Rate
        $oBounceRateLineRequest = $oGAService->makeRequest('ga:bounceRate', 
        array('dimensions'=>'ga:date','filters'=>'ga:hostname=~^'.$aDvs['title_url'].''), $sDateFrom);        
        list($sBounceRateLineData, $iBounceRateTotal, $iBounceRateMaxValue) = $oGAService->getChartData($oBounceRateLineRequest->rows, 'number', 'avg');

        // New User Percent
        $oNewVisitorPieRequest = $oGAService->makeRequest('ga:percentNewSessions', array('filters'=>'ga:source=~^'.$this->prepareName($aDvs['dealer_name'])), $sDateFrom);
        $iNewSession = (float)$oNewVisitorPieRequest->totalsForAllResults['ga:percentNewSessions'];
        $iOldSession = 100 - $iNewSession;
        $iNewSession = number_format($iNewSession, 2);
        $iOldSession = number_format($iOldSession, 2);

        // Session By City
        $oSessionCityTableRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:city','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:sessions','max-results'=>10), $sDateFrom);
        $sSessionCityTableData = $oGAService->getTableData($oSessionCityTableRequest->rows);

        $this->template()
            ->assign(array(
                // Mini Charts
                'iSessionTotal' => $iSessionTotal,
                'iUserTotal' => $iUserTotal,
                'iPageViewTotal' => $iPageViewTotal,
                'iPagePerSessionTotal' => $iPagePerSessionTotal,
                'iAvgTimePageTotal' => $iAvgTimePageTotal,
                'iBounceRateTotal' => $iBounceRateTotal,

                'sJavascript' =>
                    '<script type="text/javascript">' .
                    'var iLeadSentEvent = "' . $iLeadSentEvent . '";' .
                    'var iInventoryClickEvent = "' . $iInventoryClickEvent . '";' .
                    'var iSpecialOfferClicksEvent = "' . $iSpecialOfferClicksEvent . '";' .
                    'var sConversionRate = "' .  $sConversionRate . '";' .
                    'var sessionDataRaw = ' . $sSessionLineData . ';' .
                    'var sessionTotal = "' . $iSessionTotal . '";' .
                    'var sessionMaxValue = ' . $iSessionMaxValue . ';' .
                    'var userDataRaw = ' . $sUserLineData . ';' .
                    'var userTotal = "' . $iUserTotal . '";' .
                    'var userMaxValue = ' . $iUserMaxValue . ';' .
                    'var pageViewDataRaw = ' . $sPageViewLineData . ';' .
                    'var pageViewTotal = "' . $iPageViewTotal . '";' .
                    'var pageViewMaxValue = ' . $iPageViewMaxValue . ';' .
                    'var pagePerSessionDataRaw = ' . $sPagePerSessionLineData . ';' .
                    'var pagePerSessionTotal = "' . $iPagePerSessionTotal . '";' .
                    'var pagePerSessionMaxValue = ' . $iPagePerSessionMaxValue . ';' .
                    'var avgTimePageDataRaw = ' . $sAvgTimePageLineData . ';' .
                    'var avgTimePageTotal = "' . $iAvgTimePageTotal . '";' .
                    'var avgTimePageMaxValue = ' . $iAvgTimePageMaxValue . ';' .
                    'var bounceRateDataRaw = ' . $sBounceRateLineData . ';' .
                    'var bounceRateTotal = "' . $iBounceRateTotal . '%";' .
                    'var bounceRateMaxValue = ' . $iBounceRateMaxValue . ';' .
                    'var newVisitor = ' . $iNewSession . ';' .
                    'var oldVisitor = ' . $iOldSession . ';' .
                    'var sessionCityDataRaw = ' . $sSessionCityTableData . ';' .
                    '</script>'
            ));
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