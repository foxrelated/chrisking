

function piechart2(email,fb,tw,google,embed){
    
 $(function () {
          /*  Highcharts.setOptions({
            colors: ['orange', 'yellow', 'red', 'blue', 'black']
            });*/
        $('#piechart2').highcharts({
             chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
            title: {
                text: ''
            },
            tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                     showInLegend: true,
                    depth: 35,
                    dataLabels: {
                        enabled: false,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'CTR',
                data: [

                    ['Email', email], 
                    ['Facebook', fb],
                    ['Twitter', tw],
                    ['Google+', google],
                    ['Embed', embed]
                ]
            }]
        });
    });
 }
 //line chart
 function linechart(time,shares,clicks){
 $(function () {
       /* for (var i = 0; i < time.length; i++){
            times += time[i]+',';
            shares_l += shares[i]+',';
            clicks_l += clicks[i]+',';
        }
        */
        $('#linechart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
          /*  subtitle: {
                text: 'Source: WorldClimate.com'
            },*/
            xAxis: {
                categories: time
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Shares',
                data: shares
            }, {
                name: 'Clicks',
                data: clicks
            }]
        });
    });
 }
    
