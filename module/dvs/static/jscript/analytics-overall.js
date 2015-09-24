google.load("visualization", "1", {packages:["corechart", "table"]});
google.setOnLoadCallback(drawChart);

var sessionMainChart = null;
var sessionMiniChart = null;
var userMiniChart = null;
var pageViewMiniChart = null;
var pagePerSessionMiniChart = null;
var avgTimePageMiniChart = null;
var bounceRateMiniChart = null;
var visitorPercentChart = null;
var sessionCityTable = null;
var canvas = null;

function drawChart() {
    drawCircleGraph(window.iLeadSentEvent, window.iInventoryClickEvent, window.iSpecialOfferClicksEvent, window.sConversionRate);
    drawMainSession();
    drawMiniSession();
    drawMiniUser();
    drawMiniPageView();
    drawMiniPagePerSession();
    drawMiniAvgTimePage();
    drawMiniBounceRate();
    drawVisitorPercent();
    drawSessionByCity();
}

function exportAllChart() {
    var circleGraphImage = (canvas.toDataURL("image/png"));
    var sessionMainChartImg = (sessionMainChart.getImageURI());
    var sessionMiniChartImage = (sessionMiniChart.getImageURI());
    var userMiniChartImage = (userMiniChart.getImageURI());
    var pageViewMiniChartImage = (pageViewMiniChart.getImageURI());
    var pagePerSessionMiniChartImage = (pagePerSessionMiniChart.getImageURI());
    var avgTimePageMiniChartImage = (avgTimePageMiniChart.getImageURI());
    var bounceRateMiniChartImage = (bounceRateMiniChart.getImageURI());
    var visitorPercentChartImage = (visitorPercentChart.getImageURI());

    $.ajaxCall('dvs.analyticExportPdf', 'tab=overall&sessionMainChartImg='+circleGraphImage);
}

function drawCircleGraph(leadSent, inventoryClick, specialOfferClick, conversionRate) {
    canvas = document.getElementById('circle-stats-canvas');
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#E5E5E5';
        ctx.fillRect(0, 0, 980, 200);

        // Draw Circle
        for (var i = 0; i<=3; i++) {
            var startX = 245 * i;
            var startY = 0;
            if (i == 3) {
                ctx.fillStyle = "#4EB526";
            } else {
                ctx.fillStyle = "#018dca";
            }
            ctx.beginPath();
            ctx.arc(122 + startX, 114 + startY, 64, 0, 2*Math.PI);
            ctx.fill();
        }

        // Draw Title
        ctx.font = "bold 15px Arial";
        ctx.textAlign = "center";
        ctx.fillStyle = "#000000";
        ctx.fillText("Leads Sent", 122, 30);
        ctx.fillText("Inventory Clicks", 122 + 245, 30);
        ctx.fillText("Special Offer Clicks", 122 + 245 * 2, 30);
        ctx.fillText("Conversion Rate", 122 + 245 *  3, 30);

        // Draw Content
        ctx.font = "normal 38px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";
        ctx.fillStyle = "#FFFFFF";
        ctx.fillText(leadSent, 122, 135);
        ctx.fillText(inventoryClick, 122 + 245, 135);
        ctx.fillText(specialOfferClick, 122 + 245 * 2, 135);
        ctx.fillText(conversionRate, 122 + 245 * 3, 135);
    }
}

function drawMainSession() {
    var sessionData = new google.visualization.DataTable();
    sessionData.addColumn('date', 'Date');
    sessionData.addColumn('number', 'Sessions');
    sessionData.addRows(window.sessionDataRaw);
    var options = {
        chartArea: {left: 0, width: '100%'},
        legend: {position: 'top'},
        vAxis: {textPosition: 'in', gridlines: {count: 3}},
        hAxis: {gridlines: {color: 'transparent'}},
        lineWidth: 3,
        pointSize: 5,
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    sessionMainChart = new google.visualization.AreaChart(document.getElementById('session-line-chart'));
    sessionMainChart.draw(sessionData, options);
}

function drawMiniSession() {
    var sessionData = new google.visualization.DataTable();
    sessionData.addColumn('date', 'Date');
    sessionData.addColumn('number', 'Sessions');
    sessionData.addRows(window.sessionDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.sessionMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    sessionMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-session-content'));
    sessionMiniChart.draw(sessionData, options);
    document.getElementById('mini-chart-session-total').style.display = 'block';
}

function drawMiniUser() {
    var userData = new google.visualization.DataTable();
    userData.addColumn('date', 'Date');
    userData.addColumn('number', 'Users');
    userData.addRows(window.userDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.userMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    userMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-user-content'));
    userMiniChart.draw(userData, options);
    document.getElementById('mini-chart-user-total').style.display = 'block';
}

function drawMiniPageView() {
    var pageViewData = new google.visualization.DataTable();
    pageViewData.addColumn('date', 'Date');
    pageViewData.addColumn('number', 'Pageviews');
    pageViewData.addRows(window.pageViewDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.pageViewMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    pageViewMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-pageview-content'));
    pageViewMiniChart.draw(pageViewData, options);
    document.getElementById('mini-chart-pageview-total').style.display = 'block';
}

function drawMiniPagePerSession() {
    var pagePerSessionData = new google.visualization.DataTable();
    pagePerSessionData.addColumn('date', 'Date');
    pagePerSessionData.addColumn('number', 'Pages / Session');
    pagePerSessionData.addRows(window.pagePerSessionDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.pagePerSessionMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    pagePerSessionMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-pagepersession-content'));
    pagePerSessionMiniChart.draw(pagePerSessionData, options);
    document.getElementById('mini-chart-pagepersession-total').style.display = 'block';
}

function drawMiniAvgTimePage() {
    var avgTimePageData = new google.visualization.DataTable();
    avgTimePageData.addColumn('date', 'Date');
    avgTimePageData.addColumn('number', 'Pages / Session');
    avgTimePageData.addRows(window.avgTimePageDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.avgTimePageMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    avgTimePageMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-avgtimepage-content'));
    avgTimePageMiniChart.draw(avgTimePageData, options);
    document.getElementById('mini-chart-avgtimepage-total').style.display = 'block';
}

function drawMiniBounceRate() {
    var bounceRateData = new google.visualization.DataTable();
    bounceRateData.addColumn('date', 'Date');
    bounceRateData.addColumn('number', 'Bounce Rate');
    bounceRateData.addRows(window.bounceRateDataRaw);
    var options = {
        height: 105,
        chartArea: {left: 0, width: '100%', height: 75, top: 20},
        legend: {position: 'top', textStyle: { color: '#000000', fontSize: 14}},
        vAxis: {gridlines: {count: 0}, baselineColor: 'transparent', maxValue: window.bounceRateMaxValue},
        hAxis: {gridlines: {count: 0}, baselineColor: 'transparent'},
        series: {0: {color: '#059EDA', areaOpacity: 0.1}}
    };
    bounceRateMiniChart = new google.visualization.AreaChart(document.getElementById('mini-chart-bouncerate-content'));
    bounceRateMiniChart.draw(bounceRateData, options);
    document.getElementById('mini-chart-bouncerate-total').style.display = 'block';
}

function drawVisitorPercent() {
    var visitorPercentData = google.visualization.arrayToDataTable([
        ['Title', 'Percent'],
        ['New Visitor', window.newVisitor],
        ['Returning Visitor', window.oldVisitor]
    ]);

    var options = {
        legend: {
            position: 'top',
            alignment: 'center'
        },
        chartArea: {
            width: '230',
            height: '230',
            top: '30'
        },
        height: '280',
        colors: ['#008CC9', '#4DB425']
    };

    visitorPercentChart = new google.visualization.PieChart(document.getElementById('new-visitor-chart'));
    visitorPercentChart.draw(visitorPercentData, options);
}

function drawSessionByCity() {
    var sessionCityData = new google.visualization.DataTable();
    sessionCityData.addColumn('string', 'City');
    sessionCityData.addColumn('number', 'Sessions');
    sessionCityData.addRows(window.sessionCityDataRaw);

    sessionCityTable = new google.visualization.Table(document.getElementById('session-city-chart'));
    sessionCityTable.draw(sessionCityData, {showRowNumber: true, width: '40%', height: '100%'});
}