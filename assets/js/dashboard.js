//== Class definition
var Dashboard = function() {

    var demo1 = function() {
        function generateChartData(local) {
            var chartData = [];
            $.ajax({
                method: "GET",
                url: "../controller/inicio.php",
                data: {'idLocal': local},
                dataType: 'json',
                context: document.body,
                global: false,
                async: true,
                success: function(data) {
                    jQuery.each( data, function( i, val ) {
                            
                        chartData.push({
                            "dia": val.dia_venta,
                            "monto": val.monto,
                            "mesa": val.cantMesas
                        });
                        
                    });
                }
            });

            return chartData;
        }
        $("#locales").change(function(){
            $(this).val();
            
            
            var data = generateChartData();
            drawChart(data);
        });
        var local = "2";
        var data = generateChartData(local);
        drawChart(data);
        function drawChart(data){
            var chart = AmCharts.makeChart("m_amcharts_1", {
                "type": "serial",
                "theme": "light",
                "dataProvider":data,
                "valueAxes": [{
                    "id": "distanceAxis",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left"
                }, {
                    "id": "latitudeAxis",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "labelsEnabled": false,
                    "position": "right"
                }, {
                    "id": "durationAxis",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "inside": true,
                    "position": "right"
                }],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [{
                    "id": "graph1",
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "title": "Mesas",
                    "valueField": "mesa",
                    "valueAxis": "distanceAxis"
                }, {
                    "id": "graph2",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "bullet": "round",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "Ventas",
                    "valueField": "monto",
                    "dashLengthField": "dashLengthLine",
                    "valueAxis": "durationAxis"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "legend": {
                  "useGraphSettings": true,
                  "position": "top"
                },
                "categoryField": "dia",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }
    
            });

        }
    }

    return {
        //== Init demos
        init: function() {
            demo1();
            $("#salir").off().on('click',function(){
                location.href="../controller/logoutUser.php";
            });
        }
    };
}();

//== Class initialization on page load
jQuery(document).ready(function() {
    Dashboard.init();
});