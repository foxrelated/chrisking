<?php
require_once realpath(dirname(__FILE__).'/fpdf.php');

class Dvs_Service_Analytics_Export_Email extends Phpfox_Service {
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

    private $_sArialFont = '';
    private $_sArialBoldFont = '';

    function __construct() {
        $this->_sTable = Phpfox::getT('ko_dvs');
        $this->_sArialFont = dirname(__FILE__) . PHPFOX_DS . 'arial.ttf';
        $this->_sArialBoldFont = dirname(__FILE__) . PHPFOX_DS . 'arial-bold.ttf';
    }

    public function drawCircle($sFilePath, $aData = array(), $aSetting = array()) {
        $iWidth = 980;
        $iHeight = 200;
        $iSpace = 245;

        $oImage = @imagecreatetruecolor($iWidth, $iHeight);
        imageantialias($oImage, true);
        imagefilledrectangle($oImage, 0, 0, 980, 200, imagecolorallocate($oImage, 229, 229, 229));

        $iFirstX = ($iWidth - $iSpace * (count($aData) - 1)) / 2;

        $iCount = 0;
        foreach($aData as $aItem) {
            $iCount++;
            if ($iCount == count($aData)) {
                imagefilledarc($oImage, $iFirstX, 114, 128, 128, 0, 360, imagecolorallocate($oImage, 78, 181, 38), IMG_ARC_ROUNDED);
            } else {
                imagefilledarc($oImage, $iFirstX, 114, 128, 128, 0, 360, imagecolorallocate($oImage, 1, 141, 202), IMG_ARC_ROUNDED);
            }

            if ($aTitleSize = imagettfbbox(11, 0, $this->_sArialBoldFont, $aItem['title'])) {
                imagettftext($oImage, 11, 0, $iFirstX - $aTitleSize[2] / 2, 30, imagecolorallocate($oImage, 0, 0, 0), $this->_sArialBoldFont, $aItem['title']);
            }

            if ($aValueSize = imagettfbbox(30, 0, $this->_sArialFont, $aItem['value'])) {
                imagettftext($oImage, 30, 0, $iFirstX - $aValueSize[2] / 2, 128, imagecolorallocate($oImage, 255, 255, 255), $this->_sArialFont, $aItem['value']);
            }

            $iFirstX += $iSpace;
        }

        imagepng($oImage, $sFilePath);
        imagedestroy($oImage);

        return $sFilePath;
    }

    public function drawGraph($sFilePath, $aData = array(), $sTitle = '', $aSettings = array()) {
        $iWidth = $aSettings['width'];
        $iHeight = $aSettings['height'];

        $oImage = @imagecreatetruecolor($iWidth, $iHeight);
        imageantialias($oImage, true);

        if (isset($aSettings['is_mini'])) {
            imagefilledrectangle($oImage, 0, 0, $iWidth, $iHeight, imagecolorallocate($oImage, 245, 245, 245));
        } else {
            imagefilledrectangle($oImage, 0, 0, $iWidth, $iHeight, imagecolorallocate($oImage, 255, 255, 255));
        }

        // Find min, max value
        $iMinValue = $iMaxValue = $aData[0][1];
        foreach($aData as $aItem) {
            $iMinValue = $iMinValue > $aItem[1] ? $aItem[1] : $iMinValue;
            $iMaxValue = $iMaxValue < $aItem[1] ? $aItem[1] : $iMaxValue;
        }

        $iH = ($iMaxValue - $iMinValue);
        $iRound = 10;
        if ($iH < 50) {
            $iRound = 5;
        }
        if ($iH % $iRound != 0) {
            $iH = ((int)($iH / $iRound) + 1) * $iRound;
        }
        $iAvgValue = (int)($iMaxValue / $iH) * $iH;
        $iMaxValue = $iAvgValue + $iH;
        $iMinValue = $iAvgValue - $iH;

        // Setup Point
        $iTotalPoint = max(count($aData) - 1, 1);
        $iCount = 0;
        $iChartHeight = $iHeight * 3 / 5;
        $iStartPointY = $iHeight * 4 / 5;
        $iTotalValue = 0;
        $aPoints = array();
        foreach($aData as $aItem) {
            $iTotalValue += $aItem[1];
            $iPointX = (int)($iCount * $iWidth / $iTotalPoint);
            $iPointY = (int)($iStartPointY - ($aItem[1] - $iMinValue)  * $iChartHeight / ($iMaxValue - $iMinValue));
            $aPoints[] = array($iPointX, $iPointY);
            $iCount++;
        }

        // Draw polygon
        $aNewPoints = array();
        foreach ($aPoints as $aPoint) {
            $aNewPoints[] = $aPoint[0];
            $aNewPoints[] = $aPoint[1];
        }
        $aNewPoints[] = $iWidth;
        $aNewPoints[] = $iHeight * 4 / 5;
        $aNewPoints[] = 0;
        $aNewPoints[] = $iHeight * 4 / 5;
        imagefilledpolygon($oImage, $aNewPoints, count($aPoints) + 2, imagecolorallocate($oImage, 229, 245, 251));

        // Draw axis
        if (isset($aSettings['draw_axis'])) {
            imageline($oImage, 0, 4 * $iHeight / 5, $iWidth, 4 * $iHeight / 5, imagecolorallocate($oImage, 0, 0, 0));
            imageline($oImage, 0, $iHeight / 5, $iWidth, $iHeight / 5, imagecolorallocate($oImage, 206, 206, 206));
            imageline($oImage, 0, $iHeight / 2, $iWidth, $iHeight / 2, imagecolorallocate($oImage, 206, 206, 206));
        }

        // Draw points and lines
        $iPointWidth = isset($aSettings['is_mini']) ? 4 : 8;
        if (count($aPoints) > 1) {
            for($i = 0; $i < count($aPoints) - 1; $i++) {
                imageline($oImage, $aPoints[$i][0], $aPoints[$i][1], $aPoints[$i + 1][0], $aPoints[$i + 1][1], imagecolorallocate($oImage, 5, 158, 218));
                imagefilledarc($oImage, $aPoints[$i][0], $aPoints[$i][1], $iPointWidth, $iPointWidth, 0, 360, imagecolorallocate($oImage, 5, 158, 218), IMG_ARC_ROUNDED);
            }
        }
        if (count($aPoints) > 0) {
            imagefilledarc($oImage, $aPoints[count($aPoints) - 1][0], $aPoints[count($aPoints) - 1][1], $iPointWidth, $iPointWidth, 0, 360, imagecolorallocate($oImage, 5, 158, 218), IMG_ARC_ROUNDED);
        }

        // Write Axis Point
        if (isset($aSettings['result_type']) && $aSettings['result_type'] == 'avg') {
            $iTotalValue = number_format((float)$iTotalValue / (float)(count($aData)), 2);
        }
        if (isset($aSettings['data_type']) && $aSettings['data_type'] == 'time') {
            $iTotalValue = gmdate("H:i:s", (int)$iTotalValue);
        }
        if (isset($aSettings['data_type']) && $aSettings['data_type'] == 'percent') {
            $iTotalValue = $iTotalValue . '%';
        }
        if (isset($aSettings['draw_axis']) && !isset($aSettings['is_mini'])) {
            imagettftext($oImage, 10, 0, 3, $iHeight / 5 + 15, imagecolorallocate($oImage, 0, 0, 0), $this->_sArialFont, $iMaxValue);
            imagettftext($oImage, 10, 0, 3, $iHeight / 2 + 15, imagecolorallocate($oImage, 0, 0, 0), $this->_sArialFont, $iAvgValue);
        }

        // Write Title
        imagettftext($oImage, 10, 0, 10, 20, imagecolorallocate($oImage, 0, 0, 0), isset($aSettings['is_mini']) ? $this->_sArialFont : $this->_sArialBoldFont, $sTitle);

        // Write Total
        if (isset($aSettings['add_total'])) {
            $aBoxSize = imagettfbbox(10, 0, $this->_sArialFont, $iTotalValue);
            imagettftext($oImage, 10, 0, $iWidth - $aBoxSize[2] - 10, 10 - $aBoxSize[5], imagecolorallocate($oImage, 0, 0, 0), $this->_sArialFont, $iTotalValue);
        }

        imagepng($oImage, $sFilePath);
        imagedestroy($oImage);

        return $sFilePath;
    }

    public function drawPie($sFilePath, $aData = array(), $aSettings = array()) {
        $iWidth = $aSettings['width'];
        $iHeight = $aSettings['height'];
        $aDefaultColors = array(
            '#008CC9', '#4DB425', '#3366CC', '#DC3912', '#FF9900', '#2980b9', '#c0392b', '#1abc9c', '#f1c40f', '#E87E04',
            '#2c3e50', '#663399', '#663399', '#f1c40f', '#1abc9c', '#4ECDC4', '#2c3e50', '#4ECDC4', '#9b59b6', '#663399',
            '#663399', '#1abc9c', '#2980b9', '#663399', '#d35400', '#2980b9', '#f1c40f', '#c0392b', '#d35400', '#81CFE0',
            '#2c3e50', '#9b59b6', '#1abc9c', '#7f8c8d', '#2c3e50', '#2c3e50', '#2980b9', '#F62459', '#F62459'
        );

        $oImage = @imagecreatetruecolor($iWidth, $iHeight);
        imageantialias($oImage, true);

        // Fill background color
        imagefilledrectangle($oImage, 0, 0, $iWidth, $iHeight, imagecolorallocate($oImage, 255, 255, 255));

        $iTotal = 0;
        $aValues = array();
        foreach ($aData as $aItem) {
            $iTotal += $aItem['value'];
        }

        // Draw Pie
        $iCount = 0;
        $iBegin = 0;
        $iEnd = 0;
        foreach ($aData as $aItem) {
            $iCount++;
            $iEnd = $iEnd + (int)((float)$aItem['value']  * 360.0 / (float)$iTotal);
            if ($iCount == count($aData)) {
                $iEnd = 360;
            }
            imagefilledarc($oImage, $aSettings['cx'], $aSettings['cy'], $aSettings['c_width'], $aSettings['c_width'], $iBegin, $iEnd, $this->getHexColor($aDefaultColors[$iCount % 39], $oImage), IMG_ARC_ROUNDED);
            $iBegin = $iEnd;
        }

        // Draw Title
        $iCount = 0;
        foreach ($aData as $aItem) {
            $iCount++;
            imagefilledarc($oImage, $aSettings['title_x'], $aSettings['title_y'] + 15 * ($iCount - 1), 10, 10, 0, 360, $this->getHexColor($aDefaultColors[$iCount % 39], $oImage), IMG_ARC_ROUNDED);
            imagettftext($oImage, 7, 0, $aSettings['title_x'] + 10, $aSettings['title_y'] + 15 * ($iCount - 1) + 3, $this->getHexColor('#000', $oImage), $this->_sArialFont, $aItem['title']);
        }

        imagepng($oImage, $sFilePath);
        imagedestroy($oImage);

        return $sFilePath;
    }

    public function getHexColor($sColor, $oImage) {
        $hex1 = 0;
        $hex2 = 0;
        $hex3 = 0;
        if (substr($sColor, 0, 1) == '#') {
            if (strlen($sColor) == 7) {
                $hex1 = hexdec(substr($sColor, 1, 2));
                $hex2 = hexdec(substr($sColor, 3, 2));
                $hex3 = hexdec(substr($sColor, 5, 2));
            } elseif (strlen($sColor) == 4) {
                $hex1 = hexdec(substr($sColor, 1, 1) . substr($sColor, 1, 1));
                $hex2 = hexdec(substr($sColor, 2, 1) . substr($sColor, 2, 1));
                $hex3 = hexdec(substr($sColor, 3, 1) . substr($sColor, 3, 1));
            }
        }
        return imagecolorallocate($oImage, $hex1, $hex2, $hex3);
    }

    public function exportOverall($aDvs, $sDateFrom = '', $sDateTo = '') {
        try {
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

            $sImagePrefix = Phpfox::getParam('core.dir_cache') . md5($aDvs['dvs_id'] . '-overall-' . $sDateFrom . '-' . $sDateTo);

            // Leads Sent
            $oLeadSentRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Lead Sent;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iLeadSentEvent = (int)$oLeadSentRequest->totalsForAllResults['ga:totalEvents'];

            // Inventory Clicks
            $oInventoryClicksRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Show Inventory;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iInventoryClickEvent = (int)$oInventoryClicksRequest->totalsForAllResults['ga:totalEvents'];

            // Special Offer Clicks
            $oSpecialOfferClicksRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Special Offers;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iSpecialOfferClicksEvent = (int)$oSpecialOfferClicksRequest->totalsForAllResults['ga:totalEvents'];

            // Conversion Rate
            $oConversionRateRequest = $oGAService->makeRequest('ga:sessions', array('filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iConversionRate = (int)$oConversionRateRequest->totalsForAllResults['ga:sessions'];
            if ($iConversionRate > 0) {
                $sConversionRate = number_format(($iLeadSentEvent + $iInventoryClickEvent + $iSpecialOfferClicksEvent) * 100 / $iConversionRate, 0);
            } else {
                $sConversionRate = 0;
            }
            // Draw Circle
            $this->drawCircle($sImagePrefix.'1.png', array(
                array('title' => 'Leads Sent', 'value' => $iLeadSentEvent),
                array('title' => 'Inventory Clicks', 'value' => $iInventoryClickEvent),
                array('title' => 'Special Offer Clicks', 'value' => $iSpecialOfferClicksEvent),
                array('title' => 'Conversion Rate', 'value' => $sConversionRate . '%')
            ));
            $pdf->Image($sImagePrefix.'1.png', 5, 20, 200, 40);


            // Show Main Session
            $oSessionLineRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $this->drawGraph($sImagePrefix.'2.png', $oSessionLineRequest->rows, 'Sessions', array(
                'width' => 980,
                'height' => 200,
                'draw_axis' => true
            ));
            $pdf->Image($sImagePrefix.'2.png', 5, 65, 200, 40);


            // Session Mini
            $this->drawGraph($sImagePrefix.'3.png', $oSessionLineRequest->rows, 'Sessions', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true
            ));
            $pdf->Image($sImagePrefix.'3.png', 5, 110, 45, 22);


            // User Mini
            $oUserLineRequest = $oGAService->makeRequest('ga:users', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $this->drawGraph($sImagePrefix.'4.png', $oUserLineRequest->rows, 'Users', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true
            ));
            $pdf->Image($sImagePrefix.'4.png', 55, 110, 45, 22);

            // Page View
            $oPageViewLineRequest = $oGAService->makeRequest('ga:pageviews', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
            $this->drawGraph($sImagePrefix.'5.png', $oPageViewLineRequest->rows, 'Page View', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true
            ));
            $pdf->Image($sImagePrefix.'5.png', 105, 110, 45, 22);

            // Pages / Session
            $oPagePerSessionLineRequest = $oGAService->makeRequest('ga:pageviewsPerSession', array('dimensions'=>'ga:date','filters'=>'ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom);
            $this->drawGraph($sImagePrefix.'6.png', $oPagePerSessionLineRequest->rows, 'Pages / Session', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true,
                'data_type' => 'number',
                'result_type' => 'avg'
            ));
            $pdf->Image($sImagePrefix.'6.png', 5, 135, 45, 22);

            // Avg. Time on Page
            $oAvgTimePageLineRequest = $oGAService->makeRequest('ga:avgTimeOnPage', array('dimensions'=>'ga:date','filters'=>'ga:source=~^'.$aDvs['title_url']), $sDateFrom);
            $this->drawGraph($sImagePrefix.'7.png', $oAvgTimePageLineRequest->rows, 'Avg. Time on Page', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true,
                'data_type' => 'time',
                'result_type' => 'avg'
            ));
            $pdf->Image($sImagePrefix.'7.png', 55, 135, 45, 22);

            // Bounce Rate
            $oBounceRateLineRequest = $oGAService->makeRequest('ga:bounceRate', array('dimensions'=>'ga:date','filters'=>'ga:source=~^'.$this->prepareName(['dealer_name'])), $sDateFrom);
            $this->drawGraph($sImagePrefix.'8.png', $oBounceRateLineRequest->rows, 'Bounce Rate', array(
                'width' => 221,
                'height' => 105,
                'add_total' => true,
                'draw_axis' => true,
                'is_mini' => true,
                'data_type' => 'percent',
                'result_type' => 'avg'
            ));
            $pdf->Image($sImagePrefix.'8.png', 105, 135, 45, 22);

            // New User Percent - Pie Chart
            $oNewVisitorPieRequest = $oGAService->makeRequest('ga:percentNewSessions', array('filters'=>'ga:source=~^'.$this->prepareName(['dealer_name'])), $sDateFrom);
            $iNewSession = (float)$oNewVisitorPieRequest->totalsForAllResults['ga:percentNewSessions'];
            $iOldSession = 100 - $iNewSession;
            $iNewSession = number_format($iNewSession, 2);
            $iOldSession = number_format($iOldSession, 2);
            $this->drawPie($sImagePrefix.'9.png',
                array(
                    array('title' => 'New Visitor', 'value' => $iNewSession),
                    array('title' => 'Returning Visitor', 'value' => $iOldSession),
                ),
                array(
                    'width' => 245,
                    'height' => 280,
                    'cx' => 122,
                    'cy' => 160,
                    'c_width' => 231,
                    'title_x' => 80,
                    'title_y' => 15
                )
            );
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
            $sNewFile = $aDvs['title_url'] . '_overall_'. date('Ymd') . '.pdf';
            $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
            for($i=1; $i<=9; $i++) {
                @unlink($sImagePrefix.$i.'.png');
            }
            return $sNewFile;
        }
        catch (\Exception $e) {
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

    public function exportVideo($aDvs, $sDateFrom = '', $sDateTo = '') {
        try {
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

            $sImagePrefix = Phpfox::getParam('core.dir_cache') . md5($aDvs['dvs_id'] . '-overall-' . $sDateFrom . '-' . $sDateTo);

            // Video Views
            $oVideoViewRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iVideoViewEvent = (int)$oVideoViewRequest->totalsForAllResults['ga:totalEvents'];

            // Player Loads
            $oPlayerLoadRequest = $oGAService->makeRequest('ga:totalEvents', array('filters'=>'ga:eventLabel==Player Loaded;ga:eventCategory=~^{'.$aDvs['title_url'].'}'), $sDateFrom, $sDateTo);
            $iPlayerLoadEvent = (int)$oPlayerLoadRequest->totalsForAllResults['ga:totalEvents'];

            // Play Rate
            $iPlayRate = (int)$iVideoViewEvent * 100 / (int)$iPlayerLoadEvent;
            $iPlayRate = number_format($iPlayRate, 0);

            // Show Circle Graph Image
            $this->drawCircle($sImagePrefix.'1.png', array(
                array('title' => 'Video Views', 'value' => $iVideoViewEvent),
                array('title' => 'Player Loads', 'value' => $iPlayerLoadEvent),
                array('title' => 'Play Rate', 'value' => $iPlayRate . '%')
            ));
            $pdf->Image($sImagePrefix.'1.png', 5, null, 200, 40);
            $pdf->Ln(40);

            // Draw Most Watched Videos Table
            $pdf->SetXY(5, 75);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Write(5, 'Most Watched Videos');
            $oTopVideoRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:customVarValue1','filters'=>'ga:eventLabel==Media Begin;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom, $sDateTo);
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
            $oTopChapterRequest = $oGAService->makeRequest('ga:totalEvents', array('dimensions'=>'ga:eventLabel','filters'=>'ga:eventLabel=~^Chapter Clicked:;ga:eventCategory=~^{'.$aDvs['title_url'].'}','sort'=>'-ga:totalEvents','max-results'=>10), $sDateFrom, $sDateTo);
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

            $sNewFile = $aDvs['title_url'] . '_video_'. date('Ymd') . '.pdf';

            $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
            unlink($sImagePrefix.'1.png');
            return $sNewFile;
        } catch (\Exception $e) {
            Phpfox::getLib('file')->write(PHPFOX_DIR_FILE . 'log' . PHPFOX_DS . 'analytics_error_overall'  . PHPFOX_TIME . uniqid() . '.log', $e->getMessage() . "\n" . $e->getTraceAsString());

        }

    }

    public function exportSharing($aDvs, $sDateFrom = '', $sDateTo = '') {
        try {
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
            $pdf->Write(5, 'Sharing Stats');

            $sImagePrefix = Phpfox::getParam('core.dir_cache') . md5($aDvs['dvs_id'] . '-sharing-' . $sDateFrom . '-' . $sDateTo);

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
            $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links;ga:source=~^'.$this->prepareName(['dealer_name']),'sort'=>'-ga:sessions'), $sDateFrom);
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
                $aData = array();
                foreach($oShareViewRequest->rows as $aRow) {
                    $iPointY += 7;
                    $pdf->SetXY(5, $iPointY);
                    $pdf->Cell(70, 7, $aRow[0], 1, 0);
                    $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
                    $aData[] = array(
                        'title' => $aRow[0],
                        'value' => $aRow[1]
                    );
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

                $this->drawPie($sImagePrefix.'2.png', $aData,
                    array(
                        'width' => 490,
                        'height' => 200,
                        'cx' => 200,
                        'cy' => 100,
                        'c_width' => 150,
                        'title_x' => 300,
                        'title_y' => 50
                    )
                );
                $pdf->Image($sImagePrefix.'2.png', 105, 25, 100, 40);
            }

            $sNewFile = $aDvs['title_url'] . '_sharing_'. date('Ymd') . '.pdf';

            $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');

            if ($oShareViewRequest->rows) {
//            unlink($sImagePrefix.'2.png');
            }
            return $sNewFile;
        } catch (\Exception $e) {
            Phpfox::getLib('file')->write(PHPFOX_DIR_FILE . 'log' . PHPFOX_DS . 'analytics_error_export_email'  . PHPFOX_TIME . uniqid() . '.log', $e->getMessage() . "\n" . $e->getTraceAsString());

        }

    }

    public function runCron() {
        if ($this->runCronWeekly()) {
            return true;
        }

        if ($this->runCronMonthly()) {
            return true;
        }
    }

    public function runCronWeekly() {
        $iTimeStamp = mktime(0, 0, 0, date("n"), date("j") - date("N") + 1);
        $sFromDate = date('Y-m-d', $iTimeStamp - 7 * 24 * 3600);
        $sToDate = date('Y-m-d', $iTimeStamp - 1);

        if (PHPFOX_TIME < $iTimeStamp) {
            return false;
        }

        $aDvs = $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('reporting = 1 AND reporting_email != \'\' AND reporting_time = \'weekly\' AND last_reporting < ' . $iTimeStamp)
            ->execute('getRow');

        if ($aDvs) {
            $sOverallFile = $this->exportOverall($aDvs, $sFromDate, $sToDate);
            $sVideoFile = $this->exportVideo($aDvs, $sFromDate, $sToDate);
            $sSharingFile = $this->exportSharing($aDvs, $sFromDate, $sToDate);

            Phpfox::getLibClass('phpfox.mail.interface');
            $oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sOverallFile, $sOverallFile);
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sVideoFile, $sVideoFile);
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sSharingFile, $sSharingFile);
            $oMail->send($aDvs['reporting_email'], 'Your Weekly DVS Report', 'Hello, please find your latest DVS Report attached for the past 7 days. If you have any questions about this report, please reply to this email. Thanks! - DVS Team', 'Hello, please find your latest DVS Report attached for the past 7 days. If you have any questions about this report, please reply to this email. Thanks! - DVS Team');

            $this->database()
                ->update($this->_sTable, array('last_reporting' => PHPFOX_TIME), 'dvs_id = ' . $aDvs['dvs_id']);

            return true;
        }

        return false;
    }

    public function runCronMonthly() {
        $iTimeStamp = strtotime( 'first day of ' . date( 'F Y'));
        $sToDate = date('Y-m-d', $iTimeStamp - 1);
        $iToTimeStamp = strtotime($sToDate);
        $iYear = date('Y', $iToTimeStamp);
        $iMonth = date('m', $iToTimeStamp);
        $sFromDate = $iYear . '-' . $iMonth . '-01';

        if (PHPFOX_TIME < $iTimeStamp) {
            return false;
        }

        $aDvs = $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('reporting = 1 AND reporting_email != \'\' AND reporting_time = \'monthly\' AND last_reporting < ' . $iTimeStamp)
            ->execute('getRow');

        if ($aDvs) {
            $sOverallFile = $this->exportOverall($aDvs, $sFromDate, $sToDate);
            $sVideoFile = $this->exportVideo($aDvs, $sFromDate, $sToDate);
            $sSharingFile = $this->exportSharing($aDvs, $sFromDate, $sToDate);

            Phpfox::getLibClass('phpfox.mail.interface');
            $oMail = Phpfox::getLib('mail.driver.phpmailer.' . Phpfox::getParam('core.method'));
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sOverallFile, $sOverallFile);
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sVideoFile, $sVideoFile);
            $oMail->addAttachment(Phpfox::getParam('core.dir_cache') . $sSharingFile, $sSharingFile);
            $oMail->send($aDvs['reporting_email'], 'Your Monthly DVS Report', 'Hello, please find your latest DVS Report attached for the past 30 days. If you have any questions about this report, please reply to this email. Thanks! - DVS Team', 'Hello, please find your latest DVS Report attached for the past 30 days. If you have any questions about this report, please reply to this email. Thanks! - DVS Team');

            $this->database()
                ->update($this->_sTable, array('last_reporting' => PHPFOX_TIME), 'dvs_id = ' . $aDvs['dvs_id']);

            return true;
        }

        return false;
    }
}
?>