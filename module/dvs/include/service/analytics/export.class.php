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

    public function exportOverall($sImagePrefix, $iDay = 7) {
        $pdf = new FPDF();
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
        $pdf->Write(5, 'Video Stats');
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

        $pdf->Ln(10);
        $pdf->Output(Phpfox::getParam('core.dir_cache') . '1.pdf', 'F');


    }

    public function exportSharing($sImagePrefix, $iDay = 7) {
        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        // Set up a page
        $pdf->AddPage('P');
        $pdf->SetDisplayMode('real', 'default');
        // Write 'Sharing Stats' Text
        $pdf->SetXY(10, 60);
        $pdf->SetFontSize(16);
        $pdf->Write(5, 'Sharing Stats');
        // Show Circle Graph Image
        $pdf->Image($sImagePrefix.'1.png', 10, 100, 980, 200);
        $pdf->Ln(230);
        $pdf->Output(Phpfox::getParam('core.dir_cache') . '1.pdf', 'F');
    }
}
?>