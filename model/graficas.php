<?php

require_once "conexion.php";

class Graficas extends Conexion
{
    // Gráficas con Google
    public static function graficaDonaG($resultados, $items, $titulo, $colores, $ancho)
    {
        if ($ancho == 550) {
            $legend = "legend: {position: 'labeled', alignment: 'center'},";
        } else {
            $legend = "";
        }
        $graficaG = "
        <!-- Script Chart Dona Google -->
        <script type=\"text/javascript\">
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Categoría', 'Porcentaje'], ";

        for ($i = 0; $i < count($resultados); $i++) {
            if ($i == count($resultados) - 1) {
                $graficaG .=  "['$items[$i]', " . $resultados[$i]['TOTAL'] . "]";
            } else {
                $graficaG .=  "['$items[$i]', " . $resultados[$i]['TOTAL'] . "],";
            }
        }

        $graficaG .=       "  ]);

                var options = { 
                    pieHole: 0.4,
                    colors: [";
        for ($i = 0; $i < count($colores); $i++) {
            if ($i == count($colores) - 1) {
                $graficaG .=  " '$colores[$i]' ";
            } else {
                $graficaG .=  " '$colores[$i]' ,";
            }
        }
        $graficaG .=
            "],
                    chartArea: {width: '100%', height: '100%'},
                    $legend
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_$titulo'));

                chart.draw(data, options);
            }
        </script>

        <div id=\"piechart_$titulo\" style=\"width: " . $ancho . "px; height: 300px;\"></div>        
        ";
        return $graficaG;
    }

    public static function graficaBarrasG($resultados, $items, $titulo, $color)
    {
        $graficaG = "
        <!-- Script Chart Barras Google -->
        <script type=\"text/javascript\">
            google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Element', 'Density', { role: 'style' } ],  ";

        for ($i = 0; $i < count($resultados); $i++) {
            if ($i == count($resultados) - 1) {
                $graficaG .=  "['$items[$i]', " . $resultados[$i]['TOTAL'] . ", '$color[$i]' ]";
            } else {
                $graficaG .=  "['$items[$i]', " . $resultados[$i]['TOTAL'] . ", '$color[$i]' ],";
            }
        }

        $graficaG .= " ]);
            
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                                { calc: 'stringify',
                                    sourceColumn: 1,
                                    type: 'string',
                                    role: 'annotation' },
                                2]);
            
                var options = { 
                    width: 550,
                    height: 300,
                    bar: {groupWidth: '70%'},     
                    legend: { position: 'none' }, 
                };
                var chart = new google.visualization.BarChart(document.getElementById('barchart_$titulo'));
                chart.draw(view, options);
            }
        </script>

        <div id=\"barchart_$titulo\" style=\"width: 550px; height: 300px;\"></div>        
        ";
        return $graficaG;
    }

    // Gráficas con ChartJS
    public static function graficaDona($resultados, $items)
    {
        $grafica1 = "
                    <canvas
                        data-chart=\"chartJs\"
                        data-chart-type=\"doughnut\"
                        data-dataset=\"[
                            [ ";

        for ($i = 0; $i < count($resultados); $i++) {
            if ($i == count($resultados) - 1) {
                $grafica1 .=  "[" . $resultados[$i]['TOTAL'] . "]";
            } else {
                $grafica1 .=  "[" . $resultados[$i]['TOTAL'] . "],";
            }
        }

        $grafica1 .= "  ]  ]\"
                        data-labels=\"[ $items ]\" 
                        data-dataset-options=\"[
                            {
                            label: 'Totales',
                            backgroundColor: [
                                '#28A745',
                                '#8CC63F',
                                '#F5F5DC',
                                '#E74C3C',
                                '#C0392B',
                                '#BDC3C7'
                                ],
                            },
                        ]\"
                        
                        data-options=\"{legend: {display: !0,position: 'bottom',labels: {fontColor: '#7F8FA4',usePointStyle: !0}},
                        }\"
                            >
                    </canvas>   ";

        return $grafica1;
    }

    public static function graficaBarras($resultados, $items)
    {
        $grafica2 = "
            <canvas
                data-chart=\"bar\"
                data-dataset=\"[[ ";

        for ($i = 0; $i < count($resultados); $i++) {
            if ($i == count($resultados)) {
                $grafica2 .=  $resultados[$i]['TOTAL'];
            } else {
                $grafica2 .=  $resultados[$i]['TOTAL'] . ",";
            }
        }
        $grafica2 .= "                  
                            ]] \"
                data-labels=\"[ $items ]\"
                data-dataset-options=\"[{ label:'Titulo', borderColor:  'rgba(255,99,132,1)', 
                backgroundColor: [
                '#28A745',
                '#8CC63F',
                '#F5F5DC',
                '#E74C3C',
                '#C0392B',
                '#BDC3C7'
                ] }] \"
                data-options=\"{
                        legend: { display: false,},
                        scales: {
                            xAxes: [{
                                stacked: false,
                                barThickness:50,
                                gridLines: {
                                    zeroLineColor: 'rgba(255,255,255,0.1)',
                                    color: 'rgba(255,255,255,0.1)',
                                    display: false,},
                                }],
                            yAxes: [{
                                    stacked: false,
                                        gridLines: {
                                            zeroLineColor: 'rgba(255,255,255,0.1)',
                                            color: 'rgba(255,255,255,0.1)',
                                        }
                        }]

                        }
                    } \"
                >
        </canvas>        
        ";
        return $grafica2;
    }
}
