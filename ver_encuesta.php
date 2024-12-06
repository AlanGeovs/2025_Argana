<?php
session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {
    if (!isset($_GET["im"])) {
        header("Location: listar_encuesta.php");
    } else {

        $id = $_GET["im"];
    } //termina else isset($_GET["im"])
} //termina else isset($_SESSION["idUser"])

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

    <style>
        #imgSlide {
            position: relative;
        }

        #imgSlide p {
            position: relative;
            text-align: center;
            width: 100%;
            margin-top: 10px;
        }

        #imgSlide ul {
            position: relative;
            margin: 20px;
            padding: 0px 10px;
            height: auto;
            border: 2px dashed #999;
        }

        #imgSlide ul li span {
            position: static;
            top: 0;
            right: 0;
            cursor: pointer;
            width: 70px !important;
            height: 70px !important;
            text-align: center;
            line-height: 70px;
            z-index: 1;
            color: white;
            background: red;
        }
    </style>

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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body b-b">
                            <?php
                            $respuesta = Consultas::detalleEncuesta($id);
                            $detalleUser = Consultas::datosUsuario($respuesta["id_usuario"], 'usuarios');


                            if ($respuesta[$i]["gen"] == 0) {
                                $genero = "Hombre";
                                $iconoGen = 'icon-mars';
                            } else {
                                $genero = "Mujer";
                                $iconoGen = 'icon-venus';
                            }

                            $alcaldias = array('Azcapotzalco', 'Benito Juárez',  'Coyoacán',  'Cuajimalpa de Morelos', 'Gustavo A. Madero', 'Iztacalco', 'Iztapalapa', 'Magdalena Contreras', 'Milpa Alta', 'Álvaro Obregón', 'Tláhuac', 'Tlalpan', 'Xochimilco', 'Venustiano Carranza', 'Cuauhtémoc', 'Miguel Hidalgo',);
                            ?>

                            <h2>Detalle de encuesta</h2>
                            <h5>Encuestador: (<?php echo $respuesta["id_usuario"] . ") " . $detalleUser["usuario"] . ' - ' . $detalleUser["correo"] . ' | Tipo:' . $detalleUser["tipo"]; ?></h5>
                            <h5>Fecha: <?php echo $respuesta["created_at"]; ?></h5>
                            <h5>Ubicación: <?php echo $respuesta["calle"]; ?></h5>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--Datos Dirección Del Encuestado-->
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">Alcaldía: <b><?php echo $alcaldias[$respuesta["alc"] - 1]; ?></b></h4>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">Calle: <b><?php echo $respuesta["calle"]; ?></b></h4>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">Número Ext: <b><?php echo $respuesta["next"]; ?></b></h4>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">Número Int: <b><?php echo $respuesta["nint"]; ?></b></h4>
                                        </div>

                                    </div>
                                    <!--Datos Cred Elector Encuestado-->
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <h4 for="alc">Colonia: <b><?php echo $respuesta["col"]; ?></b></h4>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <h4 for="alc">Sección: <b><?php echo $respuesta["sec"]; ?></b></h4>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <h4 for="alc">Género: <span><i class="icon <?php echo $iconoGen; ?>"></i> <b><?php echo  $genero; ?></b></span> </h4>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <?php

                                            // Suponiendo que $respuesta["geoloc"] es una cadena como "37.4219999,-122.0840575"
                                            $coordenadas = explode(",", $respuesta["geoloc"]);

                                            // Ahora $coordenadas es un array donde $coordenadas[0] es "37.4219999" y $coordenadas[1] es "-122.0840575"
                                            $latitud = $coordenadas[0];
                                            $longitud = $coordenadas[1];

                                            // Imprimir las coordenadas
                                            echo "Latitud: " . $latitud . ", Longitud: " . $longitud;

                                            ?>

                                            <h4 for="alc">Coordenadas de captura: <span> <b><?php echo  $respuesta["geoloc"]; ?></b></span> </h4>
                                            <a href="https://www.google.com/maps?q=<?php echo $latitud; ?>, <?php echo $longitud; ?>" target="_blank">Ver Mapa</a>
                                        </div>

                                        <script>
                                            function initMap() {
                                                var location = {
                                                    lat: 37.4219999,
                                                    lng: -122.0840575
                                                };
                                                var map = new google.maps.Map(document.getElementById('map'), {
                                                    zoom: 15,
                                                    center: location
                                                });
                                                var marker = new google.maps.Marker({
                                                    position: location,
                                                    map: map
                                                });
                                            }
                                        </script>

                                    </div>
                                    <hr>

                                    <p>Por favor, indica tu grado de acuerdo con cada afirmación en una escala de 1 a 5, donde 1 significa "Totalmente en desacuerdo" y 5 significa "Totalmente de acuerdo"</p>



                                    <!-- <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">1. ¿Crees qué el alcalde Mauricio Tabe ha hecho un buen trabajo durante su mandato? <br>Respuesta: <b><?php echo $respuesta["p_1"]; ?></b></h4>                                      
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">2. ¿El alcalde Mauricio Tabe  ha mejorado la calidad de vida de los habitantes de la alcaldía Miguel Hidalgo? <br>Respuesta:  <b><?php echo $respuesta["p_2"]; ?></b></h4>                                      
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">3. ¿Mauricio Tabe ha implementado políticas públicas efectivas para resolver los problemas de la alcaldía? <br>Respuesta:  <b><?php echo $respuesta["p_3"]; ?></b></h4>                                      
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">4. ¿La alcaldía Miguel Hidalgo ha sido transparente durante su gestión y ha rendido cuentas a la ciudadanía? <br>Respuesta:  <b><?php echo $respuesta["p_4"]; ?></b></h4>                                      
                                        </div>   
                                        
                                    </div>                                     
                                      
                                    <hr> 
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">5. ¿Mauricio Tabe ha fomentado la participación ciudadana en la toma de decisiones? <br>Respuesta: <b><?php echo $respuesta["p_5"]; ?></b></h4>                                      
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">6. En general, ¿cómo evalúas la gestión del alcalde Mauricio Tabe <br>Respuesta:  <b><?php echo $respuesta["p_6"]; ?></b></h4>                                      
                                        </div>  
                                        <div class="col-md-3 mb-3">
                                            <h4 for="alc">7. ¿Hay que revocar el mandato al alcalde de la alcaldía Miguel Hidalgo? <br>Respuesta:  <b><?php echo $respuesta["p_7"]; ?></b></h4>                                      
                                        </div>    
                                        
                                    </div>     -->

                                    <hr><!-- comment -->

                                    <div class="row">
                                        <div class="col-md-6 mb-6">
                                            <h4 for="alc">Detalles <br><br>Respuesta: <b><?php echo $respuesta["note"]; ?></b></h4>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <h4 for="alc">Observaciones <br><br>Respuesta: <b><?php echo $respuesta["observaciones"]; ?></b></h4>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div><!--termina .card-body -->
                    </div><!--termina .card -->
                </div><!-- termina .col-md-12 -->
            </div><!-- termina .row -->
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

    <script>
        var imagenes = document.getElementById("datosImagen").value;
        //imagenes=imagenes.substring(0,imagenes.length -1);
        var infoDatos = imagenes.split("|");

        $("#columnasSlide").css({
            "height": "auto"
        });
        if (imagenes.length == 0) {

            $("#columnasSlide").css({
                "height": "100px"
            });

        } else {

            $("#columnasSlide").css({
                "height": "auto"
            });

        }

        $("#columnasSlide").on("dragover", function(e) {

            e.preventDefault();
            e.stopPropagation();

            $("#columnasSlide").css({
                "background": "url(assets/img/fondo_cuadros.png)"
            })

        })

        $("#columnasSlide").on("drop", function(e) {

            e.preventDefault();
            e.stopPropagation();

            $("#columnasSlide").css({
                "background": "white"
            })

            var archivo = e.originalEvent.dataTransfer.files;
            var imagen = archivo[0];
            //console.log("imagen", imagen);

            // Validar tamaño de la imagen
            var imagenSize = imagen.size;

            if (Number(imagenSize) > 2000000) {

                $("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 200kb</div>')

            } else {

                $(".alerta").remove();

            }

            // Validar tipo de la imagen
            var imagenType = imagen.type;

            if (imagenType == "image/jpeg" || imagenType == "image/png") {

                $(".alerta").remove();

            } else {

                $("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>')

            }

            //Subir imagen al servidor
            if (Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png") {

                var imagenes = document.getElementById("datosImagen").value;
                var nombre = document.getElementById("denom").value;

                var datos = new FormData();

                datos.append("imagen", imagen);
                datos.append("imagenes", imagenes);
                datos.append("nombre", nombre);

                $.ajax({
                    url: "includes/editarGestorSlide.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    //dataType:"json",
                    beforeSend: function() {

                        $("#columnasSlide").before('<div class="text-center height-100" id="status">' +
                            '<div class="preloader-wrapper big active">' +
                            '<div class="spinner-layer spinner-blue-only">' +
                            '<div class="circle-clipper left">' +
                            '<div class="circle"></div>' +
                            '</div><div class="gap-patch">' +
                            '<div class="circle"></div>' +
                            '</div><div class="circle-clipper right">' +
                            '<div class="circle"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>');

                    },
                    success: function(respuesta) {

                        $("#status").remove();

                        //if(respuesta == 0){

                        //$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1600px * 600px</div>')

                        //}

                        //else{

                        //infoDatos.push(respuesta);
                        //console.log("infoDatos", infoDatos);

                        var datos = respuesta.split("**");

                        $("#columnasSlide").css({
                            "height": "auto"
                        });

                        //$("#columnasSlide").append('<li class="bloqueSlide"><span class="icon-trash-can eliminarSlide"></span><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');

                        //$("#columnasSlide").append('<li class="bloqueSlide"><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');
                        $("#columnasSlide").html(datos[0]);
                        document.getElementById("datosImagen").value = datos[1] + "|";

                        swal("¡OK!", "¡La imagen se subió correctamente!", "success");

                        //urlImagenes();

                        //}

                    }

                });

            }

        });

        /*=============================================
        Eliminar Item Slide
        =============================================*/

        $(".eliminarSlide").click(function() {

            if ($(".eliminarSlide").length == 1) {

                $("#columnasSlide").css({
                    "height": "100px"
                });

            }

            idSlide = $(this).parent().attr("id");
            console.log("idSlide", idSlide);
            rutaSlide = $(this).attr("ruta");


            $(this).parent().remove();
            $("#item" + idSlide).remove();

            var imagenes = document.getElementById("datosImagen").value;

            var borrarItem = new FormData();

            borrarItem.append("idSlide", idSlide);
            borrarItem.append("rutaSlide", rutaSlide);
            borrarItem.append("imagenes", imagenes);

            $.ajax({

                url: "includes/editarGestorSlide.php",
                method: "POST",
                data: borrarItem,
                cache: false,
                contentType: false,
                processData: false,
                //dataType:"json",
                success: function(respuesta) {
                    //infoDatos.splice(idSlide,1);
                    document.getElementById("datosImagen").value = respuesta;

                    //urlImagenes();
                    swal("¡OK!", "¡La imagen se ha eliminado correctamente!", "success");
                }

            })
        })

        /*=====  Eliminar Item Slide  ======*/

        function urlImagenes() {
            var datosImages = "";
            for (var i = 0; i < infoDatos.length; i++) {
                //infoDatos.splice(idSlide,1);

                datosImages += infoDatos[i];
                datosImages += "|";
            }

            document.getElementById("datosImagen").value = datosImages;
            //location.reload();
        }
    </script>



</body>

</html>