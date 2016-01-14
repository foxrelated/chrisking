google.load("visualization", "1", {packages:["corechart", "table"]});
google.setOnLoadCallback(drawChart);

var canvas = null;
var shareViewTable = null;
var shareViewPie = null;

function drawChart() {
    var chartLoading = document.getElementById('reporting-loading');
    chartLoading.style.display = 'none';

    drawCircleGraph(window.iEmailOpenEvent, window.iEmailClickEvent, window.iCTRate);
    if (window.shareViewDataRaw) {
        drawShareViewTable();
        drawShareViewPie();
    }
}

function exportAllChart() {
    if (window.shareViewDataRaw) {
        var shareViewPieImage = (shareViewPie.getImageURI());
        $.ajaxCall('dvs.analyticExportPdf', 'tab=sharing&day='+window.iExportDay+'&dvsId='+window.iDvsId+'&shareViewPieImage='+shareViewPieImage);
    } else {
        $.ajaxCall('dvs.analyticExportPdf', 'tab=sharing&day='+window.iExportDay+'&dvsId='+window.iDvsId);
    }
}

function exportCSV() {
    $.ajaxCall('dvs.analyticsExportCSV',
        'tab=sharing'+
        '&day='+window.iExportDay+
        '&dvsId='+window.iDvsId
    );
}

function drawCircleGraph(emailOpen, emailClick, CTRate) {
    canvas = document.getElementById('circle-stats-canvas');
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#E5E5E5';
        ctx.fillRect(0, 0, 980, 200);

        // Draw Circle
        for (var i = 0; i<=2; i++) {
            var startX = 245 * (i+1);
            if (i == 2) {
                ctx.fillStyle = "#4EB526";
            } else {
                ctx.fillStyle = "#018dca";
            }
            ctx.beginPath();
            ctx.arc(startX, 114, 64, 0, 2*Math.PI);
            ctx.fill();
        }

        // Draw Title
        ctx.font = "bold 15px Arial";
        ctx.textAlign = "center";
        ctx.fillStyle = "#000000";
        ctx.fillText("Emails Opened", 245, 30);
        ctx.fillText("Emails Clicked", 245 * 2, 30);
        ctx.fillText("Click-Through Rate", 245 * 3, 30);

        // Draw Content
        ctx.font = "normal 38px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = "#FFFFFF";
        ctx.fillText(emailSent, 245, 135);
        ctx.fillText(emailClicked, 245 * 2, 135);
        ctx.fillText(CTRate, 245 * 3, 135);
    }
}

function drawShareViewTable() {
    var shareViewData = new google.visualization.DataTable();
    shareViewData.addColumn('string', 'Share Type');
    shareViewData.addColumn('number', 'Views');
    shareViewData.addRows(window.shareViewDataRaw);

    shareViewTable = new google.visualization.Table(document.getElementById('share-table-chart'));
    shareViewTable.draw(shareViewData, {showRowNumber: false, width: '100%', height: '100%'});
}

function drawShareViewPie() {
    var shareViewData = new google.visualization.DataTable();
    shareViewData.addColumn('string', 'Share Type');
    shareViewData.addColumn('number', 'Views');
    shareViewData.addRows(window.shareViewDataRaw);

    var options = {
        pieHole: 0.25
    };

    shareViewPie = new google.visualization.PieChart(document.getElementById('share-pie-chart'));
    shareViewPie.draw(shareViewData, options);
}