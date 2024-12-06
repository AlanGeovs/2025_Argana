<?php

session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {

    $alcaldias = array(
        'Azcapotzalco',
        'Benito Juárez',
        'Coyoacán',
        'Cuajimalpa de Morelos',
        'Gustavo A. Madero',
        'Iztacalco',
        'Iztapalapa',
        'Magdalena Contreras',
        'Milpa Alta',
        'Álvaro Obregón',
        'Tláhuac',
        'Tlalpan',
        'Xochimilco',
        'Venustiano Carranza',
        'Cuauhtémoc',
        'Miguel Hidalgo',
    );

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
            <?php include "menu.php"; ?>
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card no-b">
                                <div class="card-body p-0">
                                    <div class="card-body b-b">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p>Realizar busqueda</p>
                                                    <div class="form-group">
                                                        <input class="form-control form-control-lg" type="text" placeholder="Buscar cliente" id="filtro">
                                                    </div>
                                                    <button type="button" class="btn btn-primary mt-2" onclick="filtrarInventario()" disabled><i class="icon-search3 mr-2"></i>Buscar
                                                    </button>
                                                </div>
                                                <div class="col-md-3 mb-3 mt-5">
                                                    <a href="registrar_encuesta.php" class="btn btn-primary btn-lg r-20"><i class="icon-plus-circle mr-2"></i>Agregar cliente</a>
                                                </div>
                                                <div class="col-md-3 mb-3 mt-5">
                                                    <a href="includes/exporta.php" class="btn btn-primary btn-lg r-20"><i class="icon-download mr-2"></i>Descargar datos</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php

                                                if ($_SESSION["tipoUsuario"] == "admin") {
                                                    $respuesta = Consultas::listarEncuesta();
                                                } else {
                                                    $respuesta = Consultas::listarEncuestaCapturista($_SESSION["idUser"]);
                                                }

                                                for ($i = 0; $i < count($respuesta); $i++) {
                                                    if (preg_match("/|\b/", $respuesta[$i]["IMG"])) {
                                                        $fotos = explode("|", $respuesta[$i]["IMG"]);
                                                        //var_dump($fotos);
                                                        $total = count($fotos) - 1;
                                                        $indice = mt_rand(0, intval($total));
                                                        $img = substr($fotos[0], 3);
                                                        //echo $img."<br>";
                                                        //echo "verdadero";
                                                    } else {
                                                        $img = substr($respuesta[$i]["IMG"], 3);
                                                        //echo "falso";
                                                    }
                                                    echo '<tr id="eliminar' . $respuesta[$i]["id"] . '" class="no-b" >
                                                <!--<td class="table-img">
                                                    <img src="' . $img . '" alt="" >
                                                </td>-->
                                                <td>
                                                    <h4>Alcaldía: ' . $alcaldias[$respuesta[$i]["alc"] - 1] . '</h4>     
                                                    ';
                                                    if (($respuesta[$i]["geoloc"]) != ", ") {
                                                        // Suponiendo que $respuesta["geoloc"] es una cadena como "37.4219999,-122.0840575"
                                                        $coordenadas = explode(",", $respuesta[$i]["geoloc"]);

                                                        // Ahora $coordenadas es un array donde $coordenadas[0] es "37.4219999" y $coordenadas[1] es "-122.0840575"
                                                        $latitud = $coordenadas[0];
                                                        $longitud = $coordenadas[1];

                                                        // Imprimir las coordenadas
                                                        echo "Latitud: " . $latitud . ", Longitud: " . $longitud;
                                                        echo "<p><i class=\"icon icon-add_location\"></i><a href=\"https://www.google.com/maps?q=$latitud,$longitud\" target=\"_blank\">Ver Mapa</a></p>";
                                                    }
                                                    echo '                                                                                            
                                                </td>
                                                <td><div class="d-none d-lg-block">';
                                                    $t = explode(",", $respuesta[$i]["ano"]);
                                                    $r = "";
                                                    for ($j = 0; $j < count($t); $j++) {
                                                        $tags = Consultas::tagCategorias($t[$j]);
                                                        $r .= $tags["tag"] . " | ";
                                                    }
                                                    echo substr($r, 0, -2);

                                                    if ($respuesta[$i]["gen"] == 0) {
                                                        $genero = "Hombre";
                                                        $iconoGen = 'icon-mars';
                                                    } else {
                                                        $genero = "Mujer";
                                                        $iconoGen = 'icon-venus';
                                                    }

                                                    echo '</div></td>                                                    
                                                <td>
                                                    <div class="d-none d-lg-block">
                                                     <h6>Colonia: ' . $respuesta[$i]["col"] . ', Sección: ' . $respuesta[$i]["sec"] . '</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-none d-lg-block">
                                                     <h6 class="text-muted">Calle: ' . $respuesta[$i]["calle"] . ', No ' . $respuesta[$i]["next"] . ', Int ' . $respuesta[$i]["nint"] . '</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-none d-lg-block">
                                                    <span><i class="icon ' . $iconoGen . '"></i>  ' . $genero . '</span> 
                                                    </div>
                                                </td>
                                                 ';

                                                    if ($_SESSION["tipoUsuario"] == "admin") {
                                                        echo '
                                                    <td >
                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="ver_encuesta.php?im=' . $respuesta[$i]["id"] . '"><i class="icon-file-text"></i></a>
                                                    </td>
                                                    <td >
                                                        <a class="btn-fab btn-fab-sm btn-danger shadow text-white" onclick="eliminarEncuesta(' . $respuesta[$i]["id"] . ');"><i class="icon-trash"></i></a>
                                                    </td>';

                                                        //                                                    echo '
                                                        //                                                    <td >
                                                        //                                                        <a class="btn-fab btn-fab-sm btn-primary shadow text-white" href="editar_inventario.php?im='.$respuesta[$i]["id"].'"><i class="icon-pencil"></i></a>
                                                        //                                                    </td> ';
                                                    }

                                                    echo '
                                            </tr>';
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<nav class="pt-3" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>-->
                </div>
            </div>
        </div>
        <!-- Right Sidebar -->
        <aside class="control-sidebar fixed white ">
            <div class="slimScroll">
                <div class="sidebar-header">
                    <h4>Bitácora</h4>
                    <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-3">
                    <!-- The time line -->
                    <ul class="timeline">
                        <?php
                        $hoyCorto = date("Y-m-d");
                        $hoyFin = date("Y-m-d") . " 23:59:59";
                        $hoyInicio = date("Y-m-d") . " 00:00:00";

                        $fechas = Consultas::bitacoraFechas("bitacora");
                        $respuesta = Consultas::bitacora("bitacora");
                        for ($j = 0; $j < 3; $j++) {
                            if ($fechas[$j]["fechas"] == $hoyCorto) {
                                //<!-- timeline time label -->
                                echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hoy
                        </span>
                    </li>';
                                //<!-- /.timeline-label -->
                                for ($i = 0; $i < count($respuesta); $i++) {
                                    if ($respuesta[$i]["fecha"] <= $hoyFin && $respuesta[$i]["fecha"] >= $hoyInicio) {
                                        if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        }
                                    }
                                }
                            } else {
                                $date1 = new DateTime($fechas[$j]["fechas"]);
                                //var_dump($date1);
                                $date2 = new DateTime("now");
                                $diff = $date1->diff($date2);
                                //<!-- timeline time label -->
                                echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hace ' . $diff->days . ' día(s)
                        </span>
                    </li>';
                                //<!-- /.timeline-label --> 

                                for ($i = 0; $i < count($respuesta); $i++) {
                                    //echo substr($respuesta[$i]["fecha"],0,10);
                                    if ($diff->days != 0 && substr($respuesta[$i]["fecha"], 0, 10) == $fechas[$j]["fechas"]) {

                                        if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                            //<!-- timeline item -->
                                            echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                            //<!-- END timeline item -->
                                        } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                            echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                </div>
            </div>
        </aside>
        <!-- /.right-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
        </div>
        <!--/#app -->
        <script src="assets/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">
            function filtrarInventario() {
                var filtro = document.getElementById("filtro").value;
                var xmlhttp;

                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //document.getElementById("bodyEditar").innerHTML=xmlhttp.responseText;
                        $(".table-responsive").html(xmlhttp.responseText);
                    }
                }

                xmlhttp.open("POST", "includes/filtrarInventario.php", true);

                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xmlhttp.send("inventario=" + filtro);
            }

            function eliminarEncuesta(id) {
                var fila = $("#eliminar" + id);
                console.log("fila", fila);
                swal({
                    title: "¿Deseas eliminar esta encuesta?",
                    text: "Una vez eliminado, no es posible recuperar el registro.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Esta encuesta ha sido eliminada correctamente!", {
                            icon: "success",
                        })
                        //$("#eliminar"+id).hide();
                        $.ajax({
                            type: "POST",
                            url: "includes/eliminarEncuesta_db.php",
                            data: {
                                idd: id
                            },
                            success: function(respuesta) {
                                $("#eliminar" + id).hide();
                            }
                        })
                    } else {
                        swal("No se llevo a cabo la operación")
                    }

                });


            }
        </script>

    </body>

    </html>

<?php
}//termina else