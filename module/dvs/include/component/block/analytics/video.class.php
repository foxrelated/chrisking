<?php

class Dvs_Component_Block_Analytics_Video extends Phpfox_Component {
    public function process() {
        $aDvs = $this->getParam('aDvs');
        $sDateFrom = $this->getParam('sDateFrom');

        $oGAService = Phpfox::getService('dvs.analytics');

        // Video Views
        $oVideoViewRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iVideoViewEvent = (int)$oVideoViewRequest->totalsForAllResults['ga:totalEvents'];

        // Player Loads
        $oPlayerLoadRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel=~^Player Loaded;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iPlayerLoadEvent = (int)$oPlayerLoadRequest->totalsForAllResults['ga:totalEvents'];

        // Play Rate
        $iPlayRate = (int)$iVideoViewEvent * 100 / (int)$iPlayerLoadEvent;
        $iPlayRate = number_format($iPlayRate, 0);

        // Top Video
        $oTopVideoRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:customVarValue1','filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $sTopVideoTableData = $oGAService->getTableData($oTopVideoRequest->rows);

        // Top Chapter
        $oTopChapterRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:eventLabel','filters'=>'ga:eventLabel=~^Chapter Clicked:;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $sTopChapterTableData = $oGAService->getTableData($oTopChapterRequest->rows);

        $this->template()
            ->assign(array(
                'sJavascript' =>
                    '<script type="text/javascript">' .
                    'var iVideoViewEvent = "' .  $iVideoViewEvent . '";' .
                    'var iPlayerLoadEvent = "' . $iPlayerLoadEvent . '"; ' .
                    'var iPlayRate = "' . $iPlayRate . '%"; ' .
                    'var topVideoDataRaw = ' . $sTopVideoTableData . ';' .
                    'var topChapterDataRaw = ' . $sTopChapterTableData . ';' .
                    '</script>'
            ));
    }
}
?>