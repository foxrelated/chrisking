<?php
require_once realpath(dirname(__FILE__).'/fpdf.php');

class Dvs_Service_Analytics_Export extends Phpfox_Service {
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

    function __construct() {

    }

    public function exportOverall($sImagePrefix, $iDays = 30, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 4);
        $pdf->SetFontSize(15);
        $pdf->Write(5, $aDvs["dealer_name"] . ' Report');
        $pdf->SetXY(5, 12);
        $pdf->Write(5, 'Overall Stats');
        $pdf->Ln(10);
        // Show Circle Graph Image
        $pdf->Image($sImagePrefix.'1.png', 5, 20, 200, 40);
        // Show Main Session
        $pdf->Image($sImagePrefix.'2.png', 5, 65, 200, 40);
        // Show Mini Images
        $pdf->Image($sImagePrefix.'3.png', 5, 110, 45, 22);
        $pdf->Image($sImagePrefix.'4.png', 55, 110, 45, 22);
        $pdf->Image($sImagePrefix.'5.png', 105, 110, 45, 22);
        $pdf->Image($sImagePrefix.'6.png', 5, 135, 45, 22);
        $pdf->Image($sImagePrefix.'7.png', 55, 135, 45, 22);
        $pdf->Image($sImagePrefix.'8.png', 105, 135, 45, 22);
        $pdf->Image($sImagePrefix.'9.png', 155, 110, 45, 50);

        // Draw Sessions by City
        $pdf->SetXY(5, 165);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Write(5, 'Sessions by City');
        $oSessionCityTableRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:city','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:sessions','max-results'=>10), $sDateFrom);
        $pdf->SetXY(5, 175);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(5, 7, '', 1, 0, 'C');
        $pdf->Cell(70, 7, 'City', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Sessions', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $iPointY = 175;
        foreach($oSessionCityTableRequest->rows as $iKey => $aRow) {
            $iPointY += 7;
            $pdf->SetXY(5, $iPointY);
            $pdf->Cell(5, 7, $iKey+1, 1, 0);
            $pdf->Cell(70, 7, $aRow[0], 1, 0);
            $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
        }

        $pdf->Ln(10);
        $sNewFile = $aDvs['title_url'] . '_' . date('Ymd') . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
        for($i=1; $i<=9; $i++) {
            unlink($sImagePrefix.$i.'.png');
        }
        return $sNewFile;
    }

    public function exportVideo($sImagePrefix, $iDays = 30, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 4);
        $pdf->SetFontSize(15);
        $pdf->Write(5, $aDvs["dealer_name"] . ' Report');
        $pdf->SetXY(5, 12);
        $pdf->Write(5, 'Videos Stats');
        $pdf->Ln(10);
        // Show Circle Graph Image
        $pdf->Image($sImagePrefix.'1.png', 5, null, 200, 40);
        $pdf->Ln(40);

        // Draw Most Watched Videos Table
        $pdf->SetXY(5, 75);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Write(5, 'Most Watched Videos');
        $oTopVideoRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:customVarValue1','filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $pdf->SetXY(5, 85);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 7, 'Video Reference ID', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Views', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $iPointY = 85;
        foreach($oTopVideoRequest->rows as $aRow) {
            $iPointY += 7;
            $pdf->SetXY(5, $iPointY);
            $pdf->Cell(70, 7, $aRow[0], 1, 0);
            $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
        }

        // Most Clicked Chapters
        $pdf->SetXY(105, 75);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Write(5, 'Most Clicked Chapters');
        $oTopChapterRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:eventLabel','filters'=>'ga:eventLabel=~^Chapter Clicked:;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $pdf->SetXY(105, 85);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 7, 'Chapter', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Clicks', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $iPointY = 85;
        foreach($oTopChapterRequest->rows as $aRow) {
            $iPointY += 7;
            $pdf->SetXY(105, $iPointY);
            $pdf->Cell(70, 7, $aRow[0], 1, 0);
            $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
        }

        $sNewFile = $aDvs['title_url'] . '_' . date('Ymd') . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
        unlink($sImagePrefix.'1.png');
        return $sNewFile;
    }

    public function exportSharing($sImagePrefix, $iDays = 30, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 4);
        $pdf->SetFontSize(15);
        $pdf->Write(5, $aDvs["dealer_name"] . ' Report');
        $pdf->SetXY(5, 12);
//        $pdf->Write(5, 'Email Share Conversions');
//        $pdf->Ln(10);
//        // Show Circle Graph Image
//        $pdf->Image($sImagePrefix.'1.png', 5, null, 200, 40);
//        $pdf->Ln(40);

        $aDefaultValue = array(
            'Email' => 0,
            'Text Message' => 0,
            'CRM Embed' => 0,
            'Facebook' => 0,
            'Twitter' => 0,
            'Google+' => 0,
            'Direct Link' => 0,
            'QR Code' => 0,
            'CRM Video Email' => 0,
        );
        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$aDvs['dealer_name'],'sort'=>'-ga:sessions'), $sDateFrom);
        if ($oShareViewRequest->rows) {
            // Draw Most Watched Videos Table
            $pdf->SetXY(5, 25);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Write(5, 'Most Shares Viewed');
            $pdf->SetXY(5, 35);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, 7, 'Share Type', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Views', 1, 0, 'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 8);
            $iPointY = 35;
            foreach($oShareViewRequest->rows as $aRow) {
                $iPointY += 7;
                $pdf->SetXY(5, $iPointY);
                $pdf->Cell(70, 7, $aRow[0], 1, 0);
                $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
                if (isset($aDefaultValue[$aRow[0]])) {
                    unset($aDefaultValue[$aRow[0]]);
                }
            }
            foreach($aDefaultValue as $sKey => $sValue) {
                $iPointY += 7;
                $pdf->SetXY(5, $iPointY);
                $pdf->Cell(70, 7, $sKey, 1, 0);
                $pdf->Cell(20, 7, $sValue, 1, 0, 'C');
            }
            $pdf->Image($sImagePrefix.'2.png', 105, 25, 100, 40);
        }

        $sNewFile = $aDvs['title_url'] . '_' . date('Ymd') . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
//        unlink($sImagePrefix.'1.png');
        if ($oShareViewRequest->rows) {
            unlink($sImagePrefix.'2.png');
        }
        return $sNewFile;
    }

    public function exportOverallCSV($iDays = 30, $aDvs) {
        $sDateFrom = $iDays . 'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');

        $sNewFile = Phpfox::getParam('core.dir_cache') . $aDvs['title_url'] . '_' . date('Ymd') . '.csv';
        $oFileHandler = fopen($sNewFile, 'w+');
        fputcsv($oFileHandler, array($aDvs['dvs_name'], $iDays . ' days from ' . date('m/d/Y'), "", "", "", "", "", "", "", "", "", ""));

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
        $oSessionLineRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iSessionTotal = $oSessionLineRequest->totalsForAllResults['ga:sessions'];

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
        $oAvgTimePageLineRequest = $oGAService->makeRequest('ga:avgTimeOnPage', array('dimensions'=>'ga:date','filters'=>'ga:source=~^'.$aDvs['title_url']), $sDateFrom);
        list($sAvgTimePageLineData, $iAvgTimePageTotal, $iAvgTimePageMaxValue) = $oGAService->getChartData($oAvgTimePageLineRequest->rows, 'time', 'avg');

        // Bounce Rate
        $oBounceRateLineRequest = $oGAService->makeRequest('ga:bounceRate', array('dimensions'=>'ga:date','filters'=>'ga:source=~^'.$aDvs['dealer_name']), $sDateFrom);
        list($sBounceRateLineData, $iBounceRateTotal, $iBounceRateMaxValue) = $oGAService->getChartData($oBounceRateLineRequest->rows, 'number', 'avg');

        // New User Percent
        $oNewVisitorPieRequest = $oGAService->makeRequest('ga:percentNewSessions', array('filters'=>'ga:source=~^'.$aDvs['dealer_name']), $sDateFrom);
        $iNewSession = (float)$oNewVisitorPieRequest->totalsForAllResults['ga:percentNewSessions'];
        $iOldSession = 100 - $iNewSession;
        $iNewSession = number_format($iNewSession, 2);
        $iOldSession = number_format($iOldSession, 2);
        fputcsv($oFileHandler, array("", "", "", "", "", "", "", "", "", "", "", ""));
        fputcsv($oFileHandler, array("Sessions", "Users", "Pageviews", "New Visitors", "Returning Visitors", "Pages/Session", "Avg. Time on Page", "Bounce Rate", "Leads Sent", "Inventory Clicks", "Special Offer Clicks", "Conversion Rate"));
        fputcsv($oFileHandler, array($iSessionTotal, $iUserTotal, $iPageViewTotal, $iNewSession."%", $iOldSession."%", $iPagePerSessionTotal, $iAvgTimePageTotal, $iBounceRateTotal, $iLeadSentEvent, $iInventoryClickEvent, $iSpecialOfferClicksEvent, $sConversionRate . "%"));

        fputcsv($oFileHandler, array("", "", "", "", "", "", "", "", "", "", "", ""));
        fputcsv($oFileHandler, array("City", "Sessions", "", "", "", "", "", "", "", "", "", ""));
        $oSessionCityTableRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:city','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:sessions','max-results'=>10), $sDateFrom);
        foreach($oSessionCityTableRequest->rows as $aDataRow) {
            fputcsv($oFileHandler, array($aDataRow[0], $aDataRow[1], "", "", "", "", "", "", "", "", "", ""));
        }

        fclose($oFileHandler);
    }

    public function exportVideoCSV($iDays = 30, $aDvs) {
        $sDateFrom = $iDays . 'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');

        $sNewFile = Phpfox::getParam('core.dir_cache') . $aDvs['title_url'] . '_' . date('Ymd') . '.csv';
        $oFileHandler = fopen($sNewFile, 'w+');
        fputcsv($oFileHandler, array($aDvs['dvs_name'], $iDays . ' days from ' . date('m/d/Y'), "", ""));

        // Video Views
        $oVideoViewRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iVideoViewEvent = (int)$oVideoViewRequest->totalsForAllResults['ga:totalEvents'];

        // Player Loads
        $oPlayerLoadRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Player Loaded;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
        $iPlayerLoadEvent = (int)$oPlayerLoadRequest->totalsForAllResults['ga:totalEvents'];

        // Play Rate
        $iPlayRate = (int)$iVideoViewEvent * 100 / (int)$iPlayerLoadEvent;
        $iPlayRate = number_format($iPlayRate, 0);

        fputcsv($oFileHandler, array("", "", "", ""));
        fputcsv($oFileHandler, array("Video Views", "Player Loads", "Play Rate", ""));
        fputcsv($oFileHandler, array($iVideoViewEvent, $iPlayerLoadEvent, $iPlayRate . "%", ""));

        // Top Video
        $oTopVideoRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:customVarValue1','filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $aTopVideoTableData = $oTopVideoRequest->rows;

        // Top Chapter
        $oTopChapterRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:eventLabel','filters'=>'ga:eventLabel=~^Chapter Clicked:;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom);
        $aTopChapterTableData = $oTopChapterRequest->rows;

        fputcsv($oFileHandler, array("", "", "", ""));
        fputcsv($oFileHandler, array("Most Watched Videos", "", "Most Clicked Chapters", ""));
        for ($i=0; $i<10; $i++) {
            $aLine = array();
            if (isset($aTopVideoTableData[$i])) {
                $aLine = $aTopVideoTableData[$i];
            } else {
                $aLine = array("", "");
            }

            if (isset($aTopChapterTableData[$i])) {
                $aLine[2] = $aTopChapterTableData[$i][0];
                $aLine[3] = $aTopChapterTableData[$i][1];
            } else {
                $aLine[2] = "";
                $aLine[3] = "";
            }
            fputcsv($oFileHandler, $aLine);
        }

        fclose($oFileHandler);
    }

    public function exportSharingCSV($iDays = 30, $aDvs) {
        $sDateFrom = $iDays . 'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');

        $sNewFile = Phpfox::getParam('core.dir_cache') . $aDvs['title_url'] . '_' . date('Ymd') . '.csv';
        $oFileHandler = fopen($sNewFile, 'w+');
        fputcsv($oFileHandler, array($aDvs['dvs_name'], $iDays . ' days from ' . date('m/d/Y'), ""));

//        // Emails Sent
//        $oEmailSentRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Email Share Sent;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
//        $iEmailSentEvent = (int)$oEmailSentRequest->totalsForAllResults['ga:totalEvents'];
//
//        // Emails Clicked
//        $oEmailClickedRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:campaign==DVS Share Links;ga:medium==Email;ga:source=~^'.$aDvs['dealer_name']), $sDateFrom);
//        $iEmailClickedEvent = (int)$oEmailClickedRequest->totalsForAllResults['ga:sessions'];
//
//        // Click-Through Rate
//        if ($iEmailSentEvent > 0) {
//            $iCTRate = (int)$iEmailClickedEvent * 100 / (int)$iEmailSentEvent;
//            $iCTRate = number_format($iCTRate, 0);
//        } else {
//            $iCTRate = 0;
//        }
//
//        fputcsv($oFileHandler, array("", "", ""));
//        fputcsv($oFileHandler, array("Emails Sent", "Emails Clicked", "Click-Through Rate"));
//        fputcsv($oFileHandler, array($iEmailSentEvent, $iEmailClickedEvent, $iCTRate . "%"));

        // Most Shares Viewed
        $aDefaultValue = array(
            'Email' => 0,
            'Text Message' => 0,
            'CRM Embed' => 0,
            'Facebook' => 0,
            'Twitter' => 0,
            'Google+' => 0,
            'Direct Link' => 0,
            'QR Code' => 0,
            'CRM Video Email' => 0
        );
        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$aDvs['dealer_name'],'sort'=>'-ga:sessions'), $sDateFrom);

        fputcsv($oFileHandler, array("", "", ""));
        fputcsv($oFileHandler, array("Most Shares Viewed", "", ""));
        fputcsv($oFileHandler, array("Share Type", "Views", ""));
        if ($oShareViewRequest->rows) {
            foreach($oShareViewRequest->rows as $aDataRow) {
                fputcsv($oFileHandler, array($aDataRow[0], $aDataRow[1]));
                if (isset($aDefaultValue[$aDataRow[0]])) {
                    unset($aDefaultValue[$aDataRow[0]]);
                }
            }
            foreach($aDefaultValue as $sKey => $sValue) {
                fputcsv($oFileHandler, array($sKey, $sValue));
            }
        }

        fclose($oFileHandler);
    }
}
?>