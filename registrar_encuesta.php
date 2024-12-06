<?php
session_start();
require_once "model/model.php";

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

        <style>
            .sangria {
                padding-left: 25px;
            }

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
                /*height:auto;*/
                border: 2px dashed #999;
            }

            #imgSlide ul li span {
                position: absolute;
                top: 0;
                right: 0;
                cursor: pointer;
                width: 30px;
                height: 30px;
                text-align: center;
                line-height: 30px;
                background: white;
                z-index: 1;
                color: white;
                background: red;
            }

            .hr-mobile {
                display: none;
            }

            @media only screen and (max-width: 768px) {
                .hr-mobile {
                    display: block;
                }
            }

            /* Para el select define clases CSS para los estados de seleccionado (verde) y no seleccionado (rojo): */
            .input-no-text,
            .select-no-option {
                border: 2px solid red !important;
                background-image: none !important;
            }

            .input-has-text,
            .select-has-option {
                border: 2px solid green !important;
                background-image: url('./assets/img/icon-check.png') !important;
                background-repeat: no-repeat !important;
                background-position: left center !important;
                background-size: 15px 15px !important;
                /*padding-right: 20px !important;*/
                /* Ajusta el padding para hacer espacio para el icono */
            }

            .form-control {
                display: block;
                width: 100%;
                padding: 0.375rem 0.95rem;
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
                                <h4>Registrar Cliente</h4>

                                <form method="post" action="includes/registrarEncuesta_db.php" class="form-material">
                                    <div class="row">
                                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>">
                                        <div class="col-md-12">
                                            <!--Datos Dirección Del Encuestado-->
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Ciudad</label>
                                                    <select id="alc" name="alc" class="form-control select-control select-no-option" required>
                                                        <option id='alc' name='alc' value=""> Alcaldía</option>
                                                        <option id='alc' name='alc' value="1">Azcapotzalco</option>
                                                        <option id='alc' name='alc' value="2">Benito Juárez</option>
                                                        <option id='alc' name='alc' value="3">Coyoacán</option>
                                                        <option id='alc' name='alc' value="4">Cuajimalpa de Morelos</option>
                                                        <option id='alc' name='alc' value="5">Gustavo A. Madero</option>
                                                        <option id='alc' name='alc' value="6">Iztacalco</option>
                                                        <option id='alc' name='alc' value="7">Iztapalapa</option>
                                                        <option id='alc' name='alc' value="8">Magdalena Contreras</option>
                                                        <option id='alc' name='alc' value="9">Milpa Alta</option>
                                                        <option id='alc' name='alc' value="10">Álvaro Obregón</option>
                                                        <option id='alc' name='alc' value="11">Tláhuac</option>
                                                        <option id='alc' name='alc' value="12">Tlalpan</option>
                                                        <option id='alc' name='alc' value="13">Xochimilco -- </option>
                                                        <option id='alc' name='alc' value="14">Venustiano Carranza</option>
                                                        <option id='alc' name='alc' value="15">Cuauhtémoc</option>
                                                        <option id='alc' name='alc' value="16" selected>Miguel Hidalgo
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Calle</label>
                                                    <input type="text" class="form-control input-control input-no-text" id="calle" name="calle" placeholder="Calle" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Número Ext</label>
                                                    <input type="text" class="form-control input-control input-no-text" id="next" name="next" placeholder="Número Ext" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Número Int</label>
                                                    <input type="text" class="form-control input-control input-no-text" id="nint" name="nint" placeholder="Número Int" required>
                                                </div>

                                            </div>
                                            <!--Datos Cred Elector Encuestado-->
                                            <div class="row">

                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Nombre</label>
                                                    <input type="text" class="form-control input-control input-no-text" id="col" name="col" placeholder="Colonia" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Apellidos</label>
                                                    <input type="text" class="form-control input-control input-no-text" id="sec" name="sec" placeholder="Sección" required>
                                                </div>

                                                <!-- <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Tiene credencial de elector</label>
                                                    <select id="cred" name="cred" class="form-control select-control select-no-option" required>
                                                        <option id="cred" name="cred" value="">Selecciona Opción</option>
                                                        <option id="cred" name="cred" value="0">No</option>
                                                        <option id="cred" name="cred" value="1">Si</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="descripcion">Género</label>
                                                    <select id="gen" name="gen" class="form-control select-control select-no-option" required>
                                                        <option id="gen" name="gen" value="">Selecciona género</option>
                                                        <option id="gen" name="gen" value="0">Hombre</option>
                                                        <option id="gen" name="gen" value="1">Mujer</option>
                                                    </select>
                                                </div> -->
                                            </div>
                                            <hr>


                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="note">Detalles</label>
                                                    <textarea class="form-control r-0" id="note" name="note" rows="5" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="observaciones">Observaciones</label>
                                                    <textarea class="form-control r-0" id="observaciones" name="observaciones" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <!--                                    <div id="imgSlide" class="row col-12">
                                        <p><span class="icon-arrow_downward"></span>  Arrastra aquí tu imagen, tamaño recomendado: 1600px * 600px</p>
        
                                        <ul id="columnasSlide" class="col-12">   
                                            
                                        </ul>
                                        <textarea name="datosImagen" id="datosImagen" style="display: none;"></textarea>
                                    </div>-->
                                        </div>
                                    </div>

                                    <!-- Campos ocultos para las coordenadas -->
                                    <input type="hidden" name="latitud" id="latitud">
                                    <input type="hidden" name="longitud" id="longitud">


                                    <button class="btn btn-primary waves-effect" type="submit">Guardar</button>
                                    <button class="btn btn-danger waves-effect" type="reset">Limpiar</button>
                                </form>
                                <?php

                                if (@$_GET["e"] == "error") {
                                    echo "<div class='alert alert-danger'>Hubo un error al guardar datos...</div>";
                                }

                                ?>
                            </div>
                            <!--termina .card-body -->
                        </div>
                        <!--termina .card -->
                    </div><!-- termina .col-md-12 -->
                </div><!-- termina .row -->



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
            var infoDatos = [];

            $("#columnasSlide").css({
                "height": "100px"
            });
            if ($("#columnasSlide").height() > 0) {

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
                    $("#columnasSlide").before(
                        '<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 200kb</div>'
                    )
                } else {
                    $(".alerta").remove();
                }

                // Validar tipo de la imagen
                var imagenType = imagen.type;
                if (imagenType == "image/jpeg" || imagenType == "image/png") {
                    $(".alerta").remove();
                } else {
                    $("#columnasSlide").before(
                        '<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>'
                    )
                }

                //Subir imagen al servidor
                if (Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png") {

                    //$("#denom").change(function(){
                    //jalo el nombre del ID del Auto
                    var nombre = document.getElementById("car_id").value;
                    //})

                    var datos = new FormData();

                    datos.append("imagen", imagen);
                    datos.append("nombre", nombre);

                    $.ajax({
                        url: "includes/gestorSlide.php",
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

                            infoDatos.push(respuesta);
                            //console.log("infoDatos", infoDatos);

                            $("#columnasSlide").css({
                                "height": "auto"
                            });

                            //$("#columnasSlide").append('<li class="bloqueSlide"><span class="icon-trash-can eliminarSlide"></span><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');

                            $("#columnasSlide").append('<li class="bloqueSlide"><img src="' + respuesta
                                .slice(3) + '" width="40%" class="handleImg"></li>');

                            swal("¡OK!", "¡La imagen se subió correctamente!", "success");

                            urlImagenes();

                            //}

                        }

                    });

                }

            });

            function urlImagenes() {
                var datosImages = "";
                for (var i = 0; i < infoDatos.length; i++) {

                    datosImages += infoDatos[i];
                    datosImages += "|";
                }
                document.getElementById("datosImagen").value = datosImages;
            }
        </script>


        <!-- Función para localización  -->
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(setPosition);
                } else {
                    alert("La Geolocalización no es soportada por este navegador.");
                }
            }

            function setPosition(position) {
                document.getElementById('latitud').value = position.coords.latitude;
                document.getElementById('longitud').value = position.coords.longitude;
            }

            // Llama a la función cuando la página se carga
            window.onload = getLocation;
        </script>

        <!-- Agrega un script JavaScript para cambiar las clases basado en el evento change del select: -->
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const selectElements = document.querySelectorAll('.select-control');
                const inputElements = document.querySelectorAll('.input-control');

                selectElements.forEach(selectElement => {
                    selectElement.addEventListener('change', (event) => {
                        if (selectElement.value === "") {
                            selectElement.classList.remove('select-has-option');
                            selectElement.classList.add('select-no-option');
                        } else {
                            selectElement.classList.remove('select-no-option');
                            selectElement.classList.add('select-has-option');
                        }
                    });
                });

                inputElements.forEach(inputElement => {
                    inputElement.addEventListener('input', (event) => {
                        if (inputElement.value.trim() === "") {
                            inputElement.classList.remove('input-has-text');
                            inputElement.classList.add('input-no-text');
                        } else {
                            inputElement.classList.remove('input-no-text');
                            inputElement.classList.add('input-has-text');
                        }
                    });
                });
            });
        </script>




    </body>

    </html>

<?php
}//termina else