google.load("visualization", "1", {packages:["table"]});
google.setOnLoadCallback(drawChart);

var canvas = null;

function drawChart() {
    drawCircleGraph(window.iVideoViewEvent, window.iPlayerLoadEvent, window.iPlayRate);
    drawTopVideoChart();
    drawTopChapterChart();
}

function exportAllChart() {
    var circleGraphImage = (canvas.toDataURL("image/png"));
    $.ajaxCall('dvs.analyticExportPdf', 'tab=video&day='+window.iExportDay+'&dvsId='+window.iDvsId+'&circleGraphImg='+circleGraphImage);
}

function drawCircleGraph(videoView, playerLoad, playRate) {
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
        ctx.fillText("Video Views", 245, 30);
        ctx.fillText("Player Loads", 245 * 2, 30);
        ctx.fillText("Play Rate", 245 * 3, 30);

        // Draw Content
        ctx.font = "normal 38px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = "#FFFFFF";
        ctx.fillText(videoView, 245, 135);
        ctx.fillText(playerLoad, 245 * 2, 135);
        ctx.fillText(playRate, 245 * 3, 135);
    }
}

function drawTopVideoChart() {
    var topVideoData = new google.visualization.DataTable();
    topVideoData.addColumn('string', 'Video Reference ID');
    topVideoData.addColumn('number', 'Views');
    topVideoData.addRows(window.topVideoDataRaw);

    var topVideoTable = new google.visualization.Table(document.getElementById('top-video-table'));
    topVideoTable.draw(topVideoData, {showRowNumber: false, width: '100%', height: '100%'});
}

function drawTopChapterChart() {
    var topChapterData = new google.visualization.DataTable();
    topChapterData.addColumn('string', 'Chapter');
    topChapterData.addColumn('number', 'Views');
    topChapterData.addRows(window.topChapterDataRaw);

    var topChapterTable = new google.visualization.Table(document.getElementById('top-chapter-table'));
    topChapterTable.draw(topChapterData, {showRowNumber: true, width: '100%', height: '100%'});
}