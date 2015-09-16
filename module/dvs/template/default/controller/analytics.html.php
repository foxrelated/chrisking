<div id="date-selector-container"></div>
<div id="circle-stats-wrapper">
    <div id="circle-leads-sent"></div>
    <div id="circle-inventory-clicks"></div>
    <div id="circle-offer-clicks"></div>
    <div id="circle-conversion-rate"></div>
    <div class="clear"></div>
</div>

<div id="main-session-wrapper">
    <div id="session-chart"></div>
</div>

<div id="mini-chart-wrapper">
    <div id="mini-chart-left">
        <div id="mini-chart-session" class="mini-chart">
            <div id="mini-chart-session-total" class="mini-chart-total"></div>
            <div id="mini-chart-session-content"></div>
        </div>
        <div id="mini-chart-user" class="mini-chart">
            <div id="mini-chart-user-total" class="mini-chart-total"></div>
            <div id="mini-chart-user-content"></div>
        </div>
        <div id="mini-chart-pageview" class="mini-chart">
            <div id="mini-chart-pageview-total" class="mini-chart-total"></div>
            <div id="mini-chart-pageview-content"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="mini-chart-right">

    </div>
</div>

{if !empty($sJavascript)}{$sJavascript}{/if}

{literal}
<script>
    (function(w,d,s,g,js,fs){
        g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
        js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
        js.src='https://apis.google.com/js/platform.js';
        fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
</script>
{/literal}
<script src="{$sSitePath}module/dvs/static/jscript/ga/date-selector.js"></script>
<script src="{$sSitePath}module/dvs/static/jscript/ga/circle-graph.js"></script>
{literal}


<script>
    gapi.analytics.ready(function() {
        gapi.analytics.auth.authorize({
            'serverAuth': {
                container: 'embed-api-auth-container',
                access_token: sGaAccessToken
            }
        });


        var totalEvents = 0;
        var totalEventsLoaded = 0;
        var dateSelector = new gapi.analytics.ext.DateSelector({
            container: 'date-selector-container'
        }).execute();

        // CIRCLE GRAPH
        var circleLeadsSent = new gapi.analytics.ext.CircleGraph({
            container: 'circle-leads-sent',
            title: 'Leads Sent',
            query: {
                'ids': sGaIds,
                'start-date': '7daysAgo',
                'end-date': 'yesterday',
                'metrics': 'ga:totalEvents',
                'filters' : 'ga:eventLabel==Lead Sent;ga:eventCategory=~^{' + sDvsTitleUrl + '}'
            }
        }).execute();

        var circleInventoryClick = new gapi.analytics.ext.CircleGraph({
            container: 'circle-inventory-clicks',
            title: 'Inventory Clicks',
            query: {
                'ids': sGaIds,
                'start-date': '7daysAgo',
                'end-date': 'yesterday',
                'metrics': 'ga:totalEvents',
                'filters' : 'ga:eventLabel==Show Inventory;ga:eventCategory=~^{' + sDvsTitleUrl + '}'
            }
        }).execute();

        var circleOfferClick = new gapi.analytics.ext.CircleGraph({
            container: 'circle-offer-clicks',
            title: 'Special Offer Clicks',
            query: {
                'ids': sGaIds,
                'start-date': '7daysAgo',
                'end-date': 'yesterday',
                'metrics': 'ga:totalEvents',
                'filters' : 'ga:eventLabel==Special Offers;ga:eventCategory=~^{' + sDvsTitleUrl + '}'
            }
        }).execute();

        var circleConversionRate = new gapi.analytics.ext.CircleGraph({
            container: 'circle-conversion-rate',
            title: 'Conversion Rate',
            number: '...',
            class: 'circle-graph-green',
            type: 'conversion',
            query: {
                'ids': sGaIds,
                'start-date': '7daysAgo',
                'end-date': 'yesterday',
                'metrics': 'ga:sessions',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}'
            }
        }).execute();

        circleLeadsSent.on('loadedData', function(count) {
            totalEvents += parseInt(count);
            totalEventsLoaded++;
            if (totalEventsLoaded == 3) {
                reloadConversion()
            }
        });

        circleInventoryClick.on('loadedData', function(count) {
            totalEvents += parseInt(count);
            totalEventsLoaded++;
            if (totalEventsLoaded == 3) {
                reloadConversion()
            }
        });

        circleOfferClick.on('loadedData', function(count) {
            totalEvents += parseInt(count);
            totalEventsLoaded++;
            if (totalEventsLoaded == 3) {
                reloadConversion()
            }
        });

        circleConversionRate.on('loadedData', function(count) {
            document.getElementById('mini-chart-session-total').innerHTML = count;
        });

        function reloadConversion() {
            circleConversionRate.set({totalEvents: totalEvents}).execute();
        }

        // MAIN SESSION CHART
        var dataChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:sessions',
                'dimensions': 'ga:date',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'session-chart',
                type: 'LINE',
                options: {
                    width: '100%'
                }
            }
        });
        dataChart.execute();

        // MINI CHARTS
        var miniSessionChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:sessions',
                'dimensions': 'ga:date',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'mini-chart-session-content',
                type: 'LINE',
                options: {
                    width: '100%',
                    height: '120',
                    title: 'Sessions',
                    curveType: 'function',
                    pointsVisible: false,
                    lineWidth: 1,
                    hAxis: { textPosition: 'none'}
                    //vAxis: { textPosition: 'none'}
                }
            }
        });
        miniSessionChart.execute();

        var miniUserChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:users',
                'dimensions': 'ga:date',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'mini-chart-user-content',
                type: 'LINE',
                options: {
                    width: '100%',
                    height: '120',
                    title: 'Users',
                    curveType: 'function',
                    pointsVisible: false,
                    lineWidth: 1,
                    hAxis: { textPosition: 'none'}
                    //vAxis: { textPosition: 'none'}
                }
            }
        });
        miniUserChart.execute();

        var userReport = new gapi.analytics.report.Data({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:users',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            }
        });

        userReport.on('success', function(response) {
            if (typeof response.rows != "undefined") {
                document.getElementById('mini-chart-user-total').innerHTML = response.rows[0][0];
            }
        });
        userReport.execute();

        var miniPageViewChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:pageviews',
                'dimensions': 'ga:date',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'mini-chart-pageview-content',
                type: 'LINE',
                options: {
                    width: '100%',
                    height: '120',
                    title: 'Pageviews',
                    curveType: 'function',
                    pointsVisible: false,
                    lineWidth: 1,
                    hAxis: { textPosition: 'none'}
                    //vAxis: { textPosition: 'none'}
                }
            }
        });
        miniPageViewChart.execute();

        var pageviewReport = new gapi.analytics.report.Data({
            query: {
                'ids': sGaIds,
                'metrics': 'ga:pageviews',
                'filters' : 'ga:eventCategory=~^{' + sDvsTitleUrl + '}',
                'start-date': '7daysAgo',
                'end-date': 'yesterday'
            }
        });

        pageviewReport.on('success', function(response) {
            if (typeof response.rows != "undefined") {
                document.getElementById('mini-chart-pageview-total').innerHTML = response.rows[0][0];
            }
        });
        pageviewReport.execute();

        dateSelector.on('change', function(dateRange) {
            totalEvents = 0;
            totalEventsLoaded = 0;
            circleConversionRate.set({query: dateRange}).clearTemplate();
            circleLeadsSent.set({query: dateRange}).execute();
            circleInventoryClick.set({query: dateRange}).execute();
            circleOfferClick.set({query: dateRange}).execute();
            dataChart.set({query: dateRange}).execute();

            miniSessionChart.set({query: dateRange}).execute();
            document.getElementById('mini-chart-session-total').innerHTML = '';

            miniUserChart.set({query: dateRange}).execute();
            document.getElementById('mini-chart-user-total').innerHTML = '';
            userReport.set({query: dateRange}).execute();

            miniPageViewChart.set({query: dateRange}).execute();
            document.getElementById('mini-chart-pageview-total').innerHTML = '';
            pageviewReport.set({query: dateRange}).execute();
        });
    });
</script>
{/literal}