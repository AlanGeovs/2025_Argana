<?php
session_start();

require_once "model/model.php";
require_once "model/graficas.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php require  'includes/favicon.php'; ?>
        <title>Admin | Operaciones Tradex</title>
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/app.css">

        <!-- Script nueva gráfica Apexcharts https://apexcharts.com/docs/installation/ -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->

        <!--Google Chart-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
        </script>

    </head>

    <body class="light sidebar-mini sidebar-collapse">
        <!-- Pre loader -->
        <div id="loader" class="loader">
            <div class="plane-container">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="app">
            <?php include "menu.php" ?>
            <div class="container-fluid relative animatedParent animateOnce my-3">

                <div class="row row-eq-height my-3 mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Botón -->
                            <!-- <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='registrar_encuesta.php'">
                                    <i class="icon-plus mr-2"></i> Agregar encuestado</button>                                    
                                </div> -->

                            <!-- descargar base de datos  -->

                            <!-- <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                    <button type="button" class="btn btn-info btn-lg btn-block" onclick="window.location.href='includes/exporta.php'">
                                    <i class="icon-download mr-2"></i> Descargar datos</button>                                    
                                </div>  -->
                            <div class="col-md-6 col-sm-6">


                                <div class="card no-b mb-3 bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <?php
                                            $respuesta = Consultas::listarEncuestasCapturista($_SESSION["idUser"]);
                                            ?>
                                            <div><i class="icon-package s-18"></i></div>
                                            <div class="text-success"><i class="icon-data_usage s-48"></i></div>

                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-24 my-3 font-weight-lighter">Alc. Miguel Hidalgo</span></div>
                                            <br><br> Encuestas creadas 9 y 10 sept 2023.
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($_SESSION["tipoUsuario"] == "admin") {
                            ?>

                                <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3 text-white bg-info">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <?php
                                                $totalEncuestas = Consultas::cuentaEncuestas();

                                                //                                                $totalCategorias = Consultas::listarCategorias();

                                                //                                                $datosGrafica = count($totalMarcas) . "," . count($totalUsuarios) . "," . count($totalCategorias);
                                                $datosGrafica = "50" . "," . "60";

                                                //                                                $totalREst[]= Consultas::listarCategorias();
                                                //                                                echo "Datos ".$totalREst[0][1];
                                                ?>
                                                <div><i class="icon-user-plus s-48  "></i></div>
                                                <!--<div><span class="text-danger">50</span></div>-->
                                            </div>
                                            <div class="text-center">
                                                <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalEncuestas); ?></div>
                                                Total de encuestas levantadas
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <?php
                        if ($_SESSION["tipoUsuario"] == "admin") {
                        ?>
                            <!-- <div class="row"> -->
                            <!-- <div class="col-md-6 col-sm-6"> -->
                            <!-- <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                
                                                <div><i class="icon-vcard s-48"></i></div> 
                                            </div>
                                            <div class="text-center">
                                                <?php
                                                $totalCapturistas = Consultas::listarCapturistas();
                                                ?>
                                                <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalCapturistas); ?></div>
                                                Total de capturitas
                                            </div>                                            

                                        </div>
                                    </div> -->
                            <!-- </div> -->


                            <!-- <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                
                                                <div><i class="icon-group_add s-48"></i></div> 
                                            </div>
                                            
                                            <div class="text-center">
                                                <?php
                                                $totalUsuarios = Consultas::listarUsuarios();
                                                ?>
                                                <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalUsuarios); ?></div>
                                                Total de usuarios
                                            </div>

                                        </div>
                                    </div> -->
                            <!-- </div> -->

                            <!-- </div> -->

                        <?php
                        }
                        ?>
                        <!--Contadores-->

                    </div>


                    <!-- Obtienes Datos -->
                    <?php

                    $porGenero = Consultas::encuestaPreguntas('gen');
                    $hombres = $porGenero[0]['TOTAL'];
                    $mujeres = $porGenero[1]['TOTAL'];

                    ?>

                    <!-- Grafica de género -->
                    <div class="col-md-6">
                        <div class="card no-b p-2">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="height-300">
                                        <!-- Script Chart Demo Google -->
                                        <script type="text/javascript">
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {

                                                var data = google.visualization.arrayToDataTable([
                                                    ['Género', 'Porcentaje'],
                                                    ['Hombres', <?php echo  $hombres; ?>],
                                                    ['Mujeres', <?php echo  $mujeres; ?>]
                                                ]);

                                                var options = {
                                                    title: 'Género en porcentaje',
                                                    colors: ['#0000FF', '#FF69B4', '#ec8f6e', '#f3b49f', '#f6c7b6'],
                                                    chartArea: {
                                                        width: '100%',
                                                        height: '95%'
                                                    },
                                                    legend: {
                                                        position: 'labeled',
                                                        alignment: 'center'
                                                    },
                                                };

                                                var chart = new google.visualization.PieChart(document.getElementById('piechart_genero'));

                                                chart.draw(data, options);
                                            }
                                        </script>

                                        <div id="piechart_genero" style="width: 500px; height: 350px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Obtención de datos -->
                <?php
                $resultadosP1 = Consultas::encuestaPreguntas('p_1');
                $resultados = Consultas::encuestaResultados();

                $resultadosP2_a = Consultas::encuestaPreguntas('p_2_a');
                $resultadosP2_b = Consultas::encuestaPreguntas('p_2_b');
                $resultadosP2_c = Consultas::encuestaPreguntas('p_2_c');
                $resultadosP3 =     Consultas::encuestaPreguntas('p_3');
                $resultadosP4 = Consultas::encuestaPreguntas('p_4');
                $resultadosP5 = Consultas::encuestaPreguntas('p_5');

                $resultadosP9 = Consultas::encuestaPreguntas('p_9');
                $resultadosP10 = Consultas::encuestaPreguntas('p_10');
                $resultadosP11 = Consultas::encuestaPreguntas('p_11');
                $resultadosP12 = Consultas::encuestaPreguntas('p_12');

                $resultadosP13 = Consultas::encuestaPreguntas('p_13');
                $resultadosP14 = Consultas::encuestaPreguntas('p_14');
                $resultadosP15 = Consultas::encuestaPreguntas('p_15');
                $resultadosP16 = Consultas::encuestaPreguntas('p_16');
                $resultadosP17 = Consultas::encuestaPreguntas('p_17');
                $resultadosP18 = Consultas::encuestaPreguntas('p_18');
                $resultadosP19 = Consultas::encuestaPreguntas('p_19');

                $resultadosP20 = Consultas::encuestaPreguntas('p_20');
                $resultadosP21 = Consultas::encuestaPreguntas('p_21');
                $resultadosP22 = Consultas::encuestaPreguntas('p_22');
                $resultadosP23 = Consultas::encuestaPreguntas('p_23');

                $colores = array('#28A745', '#8CC63F', '#e4e4ac', '#E74C3C', '#C0392B', '#BDC3C7', '#AAB2B6', '#979C9F', '#84898C', '#707376');

                $p1_items =  array('Muy satisfecho', 'Algo satisfecho', 'Ni satisfecho ni insatisfecho', 'Algo insatisfecho', 'Muy insatisfecho', 'Ns/Nc');
                $p2_items =  array('Aprueba mucho', 'Aprueba algo', 'Ni aprueba ni desaprueba', 'Desaprueba algo', 'Desaprueba mucho', 'Ns/Nc');
                $p3_items =  array('Muy buen camino', 'Buen camino', 'Ni buen ni mal camino', 'Mal camino', 'Muy mal camino', 'Ns/Nc');
                $p4_items =  array('Alumbrado Público', 'Pavimentación', 'Drenaje', 'Abastecimiento de Agua', 'Transporte Público', 'Seguridad', 'Recolección de Basura', 'Otro', 'Ns/Nc');
                $p5_items =  array('Víctor Romo', 'Ninguno de los dos', 'Mauricio Tabe', 'Ns/Nc');
                $p6_items =  array('Muy buena', 'Buena', 'Regular', 'Mala', 'Muy mala', 'No lo conozco', 'Ns/Nc');
                $p7_items =  array('Si', 'No');
                $p8_items =  array('Muy buena', 'Buena', 'Ni buena ni mala', 'Mala', 'Muy mala', 'No lo conozco', 'Ns/Nc');
                $p9_items =  array('Que siguiera el PAN', 'Que hubiera un cambio de partido', 'Sería lo mismo', 'Ns/Nc');
                $p10_items = array('PAN', 'Morena', 'PRD', 'PRI', 'PT', 'PVEM', 'Otro', 'Ninguno', 'Ns/Nc');
                $p11_items = array('Claudia Sheinbaum, por Morena-PT-Partido Verde', 'Xóchitl Gálvez, por PAN-PRI-PRD', 'Samuel García, por Movimiento Ciudadano', 'Eduardo Verástegui, como independiente.', 'Ninguno (esp)', 'Ns/Nc');
                $p12_items = array('Clara Brugada, por Morena-PT-Partido Verde', 'Santiago Taboada, por PAN-PRI-PRD', 'Salomón Chertorivski, por Movimiento Ciudadano',  'Otro', 'Ninguno (esp)', 'Ns/Nc');
                $p13_items = array('Mauricio Tabe', 'Otro candidato del PAN', 'Ns/Nc');
                $p14_items = array('Víctor Romo', 'Ulises Labrador', 'Claudia Galaviz', 'Mariana Boy', 'Gustavo García', 'Martin Padilla', 'Cristina Cruz ', 'Miguel Torruco', 'Otro', 'Ns/Nc');
                $p15_items = array('Ulises Labrador', 'Claudia Galaviz', 'Mariana Boy', 'Gustavo García', 'Martin Padilla', 'Cristina Cruz ', 'Miguel Torruco', 'Otro', 'Ns/Nc');
                $p16_items = array('PAN',  'PRI', 'PRD', 'Morena', 'MC', 'PT', 'PVEM', 'Otro',  'Ns/Nc');
                $p17_items = array('PAN',  'PRI', 'PRD', 'Morena', 'MC', 'PT', 'PVEM', 'Otro',  'Ns/Nc');
                $p18_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Víctor Romo, por MORENA', 'Antonio Carbia por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $p19_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Ulises Labrador, por MORENA', 'Antonio Carbia por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $p20_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Claudia Galaviz, por MORENA', 'Antonio Carbia por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $p21_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Mariana Boy, por MORENA',    'Antonio Carbia por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $p22_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Miguel Torruco, por MORENA', 'Antonio Carbia por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $p23_items = array('Mauricio Tabe por PAN-PRI-PRD', 'Mariana Boy, por MORENA', 'Alessandra Rojo de la Vega por Movimiento Ciudadano', 'Otro', 'Ns/Nc');
                $preguntas = [
                    '1)	En términos generales, ¿qué tan satisfecho(a) diría usted que está con su vida en Miguel Hidalgo?',
                    '2)	En general, ¿usted aprueba o desaprueba la forma en que trabaja (a, b o c)? Diría usted que aprueba mucho, aprueba algo, desaprueba algo o desaprueba mucho',
                    '3)	¿Usted considera que la Alcaldía Miguel Hidalgo va por buen camino o considera que va por mal camino? Diría usted que…',
                    '4)	En su opinión ¿cuál es el principal servicio público que debe mejorarse en Miguel Hidalgo?',
                    '5)	Considerando al actual alcalde, Mauricio Tabe, y al que fue el primer alcalde de Miguel Hidalgo, Víctor Romo, ¿quién considera que ha realizado un mejor gobierno al frente de la alcaldía?',
                    '6)	De los siguientes partidos, dígame por favor ¿cuál es su opinión sobre el (…) : Muy buena, buena, mala o muy mala?',
                    '7)	¿Conoce a (…)? ',
                    '8)	En general, ¿qué opinión ',
                    '9)	En su opinión ¿qué sería mejor para la alcaldía Miguel Hidalgo, que siguiera gobernando el PAN o que hubiera un cambio de partido?',
                    '10)	En 2021 hubo elecciones para elegir alcalde en Miguel Hidalgo, ¿recuerda usted qué partido votó?  ',
                    '11)	En 2024 habrá elecciones para elegir diferentes cargos, como Presidente de la República, Jefe de Gobierno de la Ciudad de México y alcaldes. Pensando en la elección presidencial, de los precandidatos actuales, ¿por cuál votaría usted?',
                    '12)	Para la Ciudad de México, ya se han definido precandidatos. De entre los siguientes que se postulan, ¿por quién votaría usted?',
                    '13)	Pensando en el candidato del PAN, en Miguel Hidalgo, ¿usted cree que debería presentarse a la reelección el actual alcalde Mauricio Tabe, o debería ser el candidato panista otra persona',
                    '14)	De entre los nombres que le voy a decir a continuación, ¿quién cree que debería encabezar la candidatura a alcalde de Miguel Hidalgo por el partido Morena?',
                    '15)	Y si los nombres fueran los siguientes, ¿quién cree que debería encabezar la candidatura a alcalde de Miguel Hidalgo por el partido Morena?',
                    '16)	Preferencia Partidos. Independientemente de los candidatos que finalmente se postulen, pensando únicamente en los partidos, ¿por cuál votaría usted para la alcaldía de Miguel Hidalgo?',
                    '17)	Rechazo Partidos. Y ahora, dígame, ¿por cuál partido nunca votaría para la alcaldía de Miguel Hidalgo?',
                    '18)	Preferencia Electoral 1. Si los candidatos fueran los siguientes, ¿por quién votaría?',
                    '19)	Preferencia Electoral 2. Si los candidatos fueran los siguientes, ¿por quién votaría?',
                    '20)	Preferencia Electoral 3. Si los candidatos fueran los siguientes, ¿por quién votaría?',
                    '21)	Preferencia Electoral 4. Si los candidatos fueran los siguientes, ¿por quién votaría?',
                    '22)	Preferencia Electoral 5. Si los candidatos fueran los siguientes, ¿por quién votaría?',
                ];

                // echo "Total: ".count($resultadosP1);
                // print_r($resultadosP1); 
                //  echo "<br>Res: ".$resultadosP2[0]['TOTAL']."<br><br>";
                // echo "Res: ".$resultadosP1[1]['TOTAL']."<br><br>";
                // echo "Res: ".$resultadosP1[2]['TOTAL']."<br><br>";
                // print_r($resultadosP1);
                ?>

                <!-- Pregunta 1 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[0]; ?></h4>
                    </div>

                    <!-- p_1_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <!-- Grafica por CLase -->
                                    <?php
                                    // echo Graficas::graficaDona($resultadosP1, $p1_items);
                                    echo Graficas::graficaDonaG($resultadosP1, $p1_items, 'p_1', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP1, $p1_items, 'p_1', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[1]; ?></h4>
                    </div>

                    <!-- p_2_a     -->
                    <div class="col-md-4">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <h4>a) El presidente, Andrés Manuel López Obrador</h4>
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP2_a, $p2_items, 'p_2_a', $colores, '270');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- p_2_b     -->
                    <div class="col-md-4">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <h4>b) El jefe de gobierno Martí Batres</h4>
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP2_b, $p2_items, 'p_2_b', $colores, '270');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- p_2_c    -->
                    <div class="col-md-4">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <h4>c) El alcalde Mauricio Tabe</h4>
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP2_c, $p2_items, 'p_2_c', $colores, '270');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pregunta 3 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[2]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP3, $p3_items, 'p_3', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP3, $p3_items, 'p_3', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pregunta 4 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[3]; ?></h4>
                    </div>

                    <!-- p_4_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP4, $p4_items, 'p_4', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP4, $p4_items, 'p_4', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pregunta 5 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[4]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP5, $p5_items, 'p_5', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP5, $p5_items, 'p_5', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 9 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[8]; ?></h4>
                    </div>

                    <!-- p_9_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP9, $p9_items, 'p_9', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP9, $p9_items, 'p_9', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 10 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[9]; ?></h4>
                    </div>

                    <!-- p_10_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP10, $p10_items, 'p_10', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP10, $p10_items, 'p_10', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 11 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[10]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP11, $p11_items, 'p_11', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP11, $p11_items, 'p_11', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 12 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[11]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP12, $p12_items, 'p_12', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP12, $p12_items, 'p_12', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pregunta 13 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[12]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP13, $p13_items, 'p_13', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP13, $p13_items, 'p_13', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pregunta 14 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[13]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP14, $p14_items, 'p_14', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP14, $p14_items, 'p_14', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 15 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[14]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP15, $p15_items, 'p_15', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP15, $p15_items, 'p_15', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 16 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[15]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP16, $p16_items, 'p_16', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP16, $p16_items, 'p_16', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 17 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[16]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP17, $p17_items, 'p_17', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP17, $p17_items, 'p_17', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 18 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[17]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP18, $p18_items, 'p_18', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP18, $p18_items, 'p_18', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 19 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[18]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP19, $p19_items, 'p_19', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP19, $p19_items, 'p_19', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Pregunta 20 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[19]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP20, $p20_items, 'p_20', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP20, $p20_items, 'p_20', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 21 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[20]; ?></h4>
                    </div>

                    <!-- p_3_ -->
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP21, $p21_items, 'p_21', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP21, $p21_items, 'p_21', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 22 -->
                <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[21]; ?></h4>
                    </div>


                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP22, $p22_items, 'p_22', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP22, $p22_items, 'p_22', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pregunta 23 -->
                <!-- <div class=" row my-3">
                    <div class="col-md-12">
                        <h4><?php echo $preguntas[22]; ?></h4>
                    </div>

                     
                    <div class="col-md-6">
                        <div class=" card b-0">
                            <div class="card-body p-3">
                                <div class="height-300">
                                    <?php
                                    echo Graficas::graficaDonaG($resultadosP23, $p23_items, 'p_23', $colores, '550');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" card no-b">
                            <div class="card-body p-3">
                                <div class="my-2 height-300">
                                    <?php
                                    echo Graficas::graficaBarrasG($resultadosP23, $p23_items, 'p_23', $colores);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->











                <!-- Ejemplos    ----------------------------------------------------------------------------                           -->
                <!-- Pregunta 2 -->
                <!-- <div class="card no-b my-3"> 
                        <div class="col-md-12">
                            <h4>2) En general, ¿usted aprueba o desaprueba la forma en que trabaja (a, b o c)? Diría usted que aprueba mucho, aprueba algo, desaprueba algo o desaprueba mucho.</h4>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="my-2 height-300">
                                    <h4>1. En términos generales, ¿qué tan satisfecho(a) diría usted que está con su vida en Miguel Hidalgo?</h4>
                                    <canvas
                                            data-chart="bar"
                                            data-dataset="[
                                                        [21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12],
                                                        [12, 40, 16, 17, 89, 0, 12,12, 0, 55, 60, 79, 99, 12,12, 0, 55, 60, 79, 99, 12],
                                                        [12, 40, 16, 17, 89, 0,12, 40, 16, 17, 89, 0, 12,12, 40, 16, 17, 89, 0, 12],
                                                        ]"
                                            data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                            data-dataset-options="[
                                                    {
                                                        label: 'HTML',
                                                        backgroundColor: '#7986cb',
                                                        borderWidth: 0,
                
                                                    },
                                                    {
                                                        label: 'Wordpress',
                                                        backgroundColor: '#88e2ff',
                                                        borderWidth: 0,
                
                                                    },
                                                    {
                                                        label: 'Laravel',
                                                        backgroundColor: '#e2e8f0',
                                                        borderWidth: 0,
                
                                                    }
                                                    ]"
                                            data-options="{
                                                    legend: { display: true,},
                                                    scales: {
                                                        xAxes: [{
                                                            stacked: true,
                                                            barThickness:5,
                                                            gridLines: {
                                                                zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                color: 'rgba(255,255,255,0.1)',
                                                                display: false,},
                                                            }],
                                                        yAxes: [{
                                                                stacked: true,
                                                                    gridLines: {
                                                                        zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                        color: 'rgba(255,255,255,0.1)',
                                                                    }
                                                    }]
                
                                                    }
                                                }"
                                    >
                                    </canvas>
                                </div>
                            </div> 
                        </div>
                    </div>                     -->

                <!-- Grafica  6 + 6 -->
                <!-- <div class="card no-b my-3"> 
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="my-2 height-300">
                                    <h4>1. En términos generales, ¿qué tan satisfecho(a) diría usted que está con su vida en Miguel Hidalgo?</h4>
                                    <canvas
                                            data-chart="bar"
                                            data-dataset="[
                                                        [21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12],
                                                        [12, 40, 16, 17, 89, 0, 12,12, 0, 55, 60, 79, 99, 12,12, 0, 55, 60, 79, 99, 12],
                                                        [12, 40, 16, 17, 89, 0,12, 40, 16, 17, 89, 0, 12,12, 40, 16, 17, 89, 0, 12],
                                                        ]"
                                            data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                            data-dataset-options="[
                                                    {
                                                        label: 'HTML',
                                                        backgroundColor: '#7986cb',
                                                        borderWidth: 0,
                
                                                    },
                                                    {
                                                        label: 'Wordpress',
                                                        backgroundColor: '#88e2ff',
                                                        borderWidth: 0,
                
                                                    },
                                                    {
                                                        label: 'Laravel',
                                                        backgroundColor: '#e2e8f0',
                                                        borderWidth: 0,
                
                                                    }
                                                    ]"
                                            data-options="{
                                                    legend: { display: true,},
                                                    scales: {
                                                        xAxes: [{
                                                            stacked: true,
                                                            barThickness:5,
                                                            gridLines: {
                                                                zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                color: 'rgba(255,255,255,0.1)',
                                                                display: false,},
                                                            }],
                                                        yAxes: [{
                                                                stacked: true,
                                                                    gridLines: {
                                                                        zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                        color: 'rgba(255,255,255,0.1)',
                                                                    }
                                                    }]
                
                                                    }
                                                }"
                                    >
                                    </canvas>
                                </div>
                            </div> 
                        </div>
                    </div> -->


                <!-- Grafica   Barras  12 w -->
                <!-- <div class="card no-b my-3">                                               
                        <div class="card-body">
                            <div class="my-2 height-300">
                                <h4>1. En términos generales, ¿qué tan satisfecho(a) diría usted que está con su vida en Miguel Hidalgo?</h4>
                                <canvas
                                        data-chart="bar"
                                        data-dataset="[
                                                    [21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12],
                                                    [12, 40, 16, 17, 89, 0, 12,12, 0, 55, 60, 79, 99, 12,12, 0, 55, 60, 79, 99, 12],
                                                    [12, 40, 16, 17, 89, 0,12, 40, 16, 17, 89, 0, 12,12, 40, 16, 17, 89, 0, 12],
                                                    ]"
                                        data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                        data-dataset-options="[
                                                {
                                                    label: 'HTML',
                                                    backgroundColor: '#7986cb',
                                                    borderWidth: 0,
            
                                                },
                                                {
                                                    label: 'Wordpress',
                                                    backgroundColor: '#88e2ff',
                                                    borderWidth: 0,
            
                                                },
                                                {
                                                    label: 'Laravel',
                                                    backgroundColor: '#e2e8f0',
                                                    borderWidth: 0,
            
                                                }
                                                ]"
                                        data-options="{
                                                legend: { display: true,},
                                                scales: {
                                                    xAxes: [{
                                                        stacked: true,
                                                        barThickness:5,
                                                        gridLines: {
                                                            zeroLineColor: 'rgba(255,255,255,0.1)',
                                                            color: 'rgba(255,255,255,0.1)',
                                                            display: false,},
                                                        }],
                                                    yAxes: [{
                                                            stacked: true,
                                                                gridLines: {
                                                                    zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                    color: 'rgba(255,255,255,0.1)',
                                                                }
                                                }]
            
                                                }
                                            }"
                                >
                                </canvas>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3 no-gutters">
                                <div class="col-md-3">
                                    <h1>Tasks</h1>
                                    Currently assigned tasks to team.
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u12.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u2.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-indigo" role="progressbar" style="width: 75%;"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <div class="avatar-group">
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u4.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u11.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u1.png" alt=""></figure>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar yellow" role="progressbar" style="width: 75%;"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u5.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                    </div> -->

                <!-- Gráficas 6 + 6  -->
                <!-- <div class=" row my-3"> 
                        <div class="col-md-12"><h3>dasda sdsad</h3></div>
                        <div class="col-md-6">
                            <div class=" card b-0">
                                <div class="card-body p-5">
                                    <canvas id="gradientChart" width="600" height="340"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" card no-b">
                                <div class="card-body">
                                    <table class="table table-hover earning-box">
                                        <tbody>
                                        <tr class="no-b">
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u6.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u9.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u11.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u12.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u5.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->

            </div>
        </div>
        <!-- Right Sidebar -->

        <?php
        if ($_SESSION["tipoUsuario"] == "admin") {
        ?>

            <!-- /.right-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
            <div class="control-sidebar-bg shadow white fixed"></div>

        <?php
        }
        ?>
        </div>
        <!--/#app -->
        <script src="assets/js/app.js"></script>

    </body>

    </html>

<?php
}//termina else