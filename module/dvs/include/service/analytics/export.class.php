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

    public function exportOverall($sImagePrefix, $iDays = 7, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 5);
        $pdf->SetFontSize(15);
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
        $sNewFile = 'exporting-' . md5($aDvs['dvs_id'].'-overall-'.$iDays.'-'.uniqid()) . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
        for($i=1; $i<=9; $i++) {
            unlink($sImagePrefix.$i.'.png');
        }
        return $sNewFile;
    }

    public function exportVideo($sImagePrefix, $iDays = 7, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 5);
        $pdf->SetFontSize(15);
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
        $pdf->Cell(20, 7, 'Views', 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);
        $iPointY = 85;
        foreach($oTopChapterRequest->rows as $aRow) {
            $iPointY += 7;
            $pdf->SetXY(105, $iPointY);
            $pdf->Cell(70, 7, $aRow[0], 1, 0);
            $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
        }

        $sNewFile = 'exporting-' . md5($aDvs['dvs_id'].'-video-'.$iDays.'-'.uniqid()) . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
        unlink($sImagePrefix.'1.png');
        return $sNewFile;
    }

    public function exportSharing($sImagePrefix, $iDays = 7, $aDvs) {
        $sDateFrom = $iDays.'daysAgo';
        $oGAService = Phpfox::getService('dvs.analytics');
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(5, 5);
        $pdf->SetFontSize(15);
        $pdf->Write(5, 'Videos Stats');
        $pdf->Ln(10);
        // Show Circle Graph Image
        $pdf->Image($sImagePrefix.'1.png', 5, null, 200, 40);
        $pdf->Ln(40);

        $oShareViewRequest = $oGAService->makeRequest('ga:sessions', array('dimensions'=>'ga:medium','filters'=>'ga:campaign==DVS Share Links','sort'=>'-ga:sessions'), $sDateFrom);
        if ($oShareViewRequest->rows) {
            // Draw Most Watched Videos Table
            $pdf->SetXY(5, 75);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Write(5, 'Most Shares Viewed');
            $pdf->SetXY(5, 85);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(70, 7, 'City', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Sessions', 1, 0, 'C');
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 8);
            $iPointY = 85;
            foreach($oShareViewRequest->rows as $aRow) {
                $iPointY += 7;
                $pdf->SetXY(5, $iPointY);
                $pdf->Cell(70, 7, $aRow[0], 1, 0);
                $pdf->Cell(20, 7, $aRow[1], 1, 0, 'C');
            }
            $pdf->Image($sImagePrefix.'2.png', 105, 75, 100, 40);
        }

        $sNewFile = 'exporting-' . md5($aDvs['dvs_id'].'-sharing-'.$iDays.'-'.uniqid()) . '.pdf';
        $pdf->Output(Phpfox::getParam('core.dir_cache') . $sNewFile, 'F');
        unlink($sImagePrefix.'1.png');
        if ($oShareViewRequest->rows) {
            unlink($sImagePrefix.'2.png');
        }
        return $sNewFile;
    }
}
?>