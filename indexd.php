
<html lang="en">
<head>
    <title>Por tu Salud</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/highcharts/css/highcharts.css">
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/highcharts/js/highcharts.js"></script>
    <script src="bower_components/highcharts/js/modules/exporting.js"></script>

    <!-- Bootstrap CSS -->

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body style="background: rgb(250,250,255);">
<div id="chart">


    <nav class="navbar navbar-inverse visible-xs">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Por tu Salud</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.html">Inicio</a></li>
                    <li><a class="btn btn-success" href="tabladedatos.html">
                        Tabla de Datos
                    </a></li>
                    <li><a class="btn btn-success" href="pages/contacto.html">
                        Contacto al paciente
                    </a></li>
                    <li><a class="btn btn-success" href="prueba.html">
                        Registro del paciente
                    </a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h2 align="center">Por tu Salud</h2>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a class="btn btn-success" href="index.html">Inicio</a></li>
                    <li><a class="btn btn-success" href="tabladedatos.html">
                        Tabla de Datos
                    </a></li>
                    <li><a class="btn btn-success" href="pages/contacto.html">
                        Contacto al paciente
                    </a></li>
                    <li><a class="btn btn-success" href="prueba.html">
                        Registro del paciente
                    </a></li>
                </ul>
                <br>

            </div>
            <br>

            <div align="center" class="col-sm-9">
                <div class="well" style="background-color: #3b5998">
                    <h1 style="color: #ffffff">Lectura de Estados en el Paciente</h1>
                </div>
                <script type="text/javascript">
                    var o = new Date();
                    o.setFullYear(2017);
                    document.write("Fecha: " + o + "<br\>");
                </script>
                <br>
            </div>

            <div align="center" class="col-sm-9">
                <div class="well">
                    <div id="container1"
                         style="width: auto; height: auto; margin: auto; ; border: 10px groove green"></div>
                </div>
                <div class="well">

                    <div id="container2"
                         style="width: auto; height: auto; margin: auto; border: 10px groove red"></div>

                </div>
                <div class="well">
                    <div id="container5"
                         style="width: auto; height: auto;  margin: auto; border: 10px groove orange"></div>
                </div>
            </div>


                </a>


        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        //var chart; // global
        var chart;
        /**
         * Request data from the server, add it to the graph and set a timeout to request again
         */
        /*        function requestData() {
         $.ajax({
         url: 'URL servidor',
         success: function (point) {
         var series = chart.series[0],
         shift = series.data.length > 20; // shift if the series is longer than 20

         // add the point
         chart.series[0].addPoint(eval(point), true, shift);

         // call it again after one second
         setTimeout(requestData, 1000);
         },
         cache: false
         });
         }*/

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        Highcharts.chart('container1', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var y, x = (new Date()).getTime(); // current time

                            $.getJSON("db/temperatura.php?option=update", function (result) {
                                        yy = parseInt(result.temperatura);
                                    }
                            );
                            //alert(y);
                            series.addPoint([x, yy], true, true);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Sensor de temperatura'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 20000
            },
            yAxis: {
                title: {
                    text: '°C'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                            Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Lectura',
                data: (function () {
                    var data = [];
                    $.getJSON("db/temperatura.php", function (result) {
                        var dataLength = result.length;
                        // var time = (new Date()).getTime();
                        if (dataLength !== 0) {
                            for (var i = dataLength - 1; i >= 0; i--) {
                                data.push({
                                    x: result[i].fecha,
                                    y: parseInt(result[i].temperatura)
                                });
                            }
                        }
                    });
                    alert(data);
                    return data;
                }())
            }]
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        /* // set up the updating of the chart each second
                         var series = this.series[0];
                         setInterval(function () {
                         var x = (new Date()).getTime(), // current time
                         y = Math.random();
                         series.addPoint([x, y], true, true);
                         }, 1000);*/
                    }
                }
            },
            title: {
                text: 'Sensor de Humedad'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 200
            },
            yAxis: {
                title: {
                    text: '%'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                            Highcharts.numberFormat(this.y, 2);
                }
                //%Y-%m-%d %H:%M:%S
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Lectura',
                data: (function () {
                    var data = [];
                    $.getJSON("db/humedad.php", function (result) {
                        var dataLength = result.length;
                        if (dataLength !== 0) {
                            for (var i = dataLength - 1; i >= 0; i--) {
                                data.push({
                                    x: new Date(result[i].fecha),
                                    y: parseInt(result[i].humedad)
                                });
                            }
                        }
                    });
                    //alert(data);
                    return data;
                }())
            }]
        });

        Highcharts.chart('container5', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                    y = Math.random();
                            series.addPoint([x, y], true, true);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Ritmo Cardiaco'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 200
            },
            yAxis: {
                title: {
                    text: '[latidos/s]'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                            Highcharts.dateFormat('%d-%m-%Y', this.x) + '<br/>' +
                            Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                            time = (new Date()).getTime(),
                            i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }]
        });
    });
</script>

</body>
</html>