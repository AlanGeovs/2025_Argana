<?php
session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {


    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
        $cliente = Consultas::obtenerClientePorId($id_user);
    }

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
            <!-- nuevo diseño  -->
            <div class="container-fluid animatedParent animateOnce">
                <div class="animated fadeInUpShort go">
                    <div class="row my-3">
                        <div class="col-md-8 offset-md-2">

                            <form id="formRegistroUsuario" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control input-control input-no-text" id="id_user" name="id_user" value="<?php echo isset($cliente['name']) ? htmlspecialchars($cliente['id_user']) : ''; ?>">
                                <div class="card no-b">
                                    <div class="card-body">
                                        <h3 class="text-center">EDITAR AL CLIENTE <?php echo $id_user; ?></h3>
                                        <HR>
                                        <h5 class="card-title">ACERCA DEL CLIENTE</h5>
                                        <div class="form-row">
                                            <div class="col-md-12">


                                                <div class="form-row">
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Nombre (s)</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="name" name="name" value="<?php echo isset($cliente['name']) ? htmlspecialchars($cliente['name']) : ''; ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Apellido Paterno</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="last_name" name="last_name" value="<?php echo isset($cliente['last_name']) ? htmlspecialchars($cliente['last_name']) : ''; ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Apellido Materno</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="last_name_second" name="last_name_second" value="<?php echo isset($cliente['last_name_second']) ? htmlspecialchars($cliente['last_name_second']) : ''; ?>" required>
                                                    </div>


                                                </div>

                                                <!-- <div class="form-group m-0">
                                                    <label for="dob" class="col-form-label s-12">Género</label>
                                                    <br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="male" name="gender" class="custom-control-input" <?php echo (isset($cliente['gender']) && $cliente['gender'] == '0') ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="male">Hombre</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="female" name="gender" class="custom-control-input" <?php echo (isset($cliente['gender']) && $cliente['gender'] == '1') ? 'checked' : ''; ?>>
                                                        <label class="custom-control-label" for="female">Mujer</label>
                                                    </div>

                                                </div> -->
                                            </div>

                                        </div>

                                        <div class="form-row mt-1">
                                            <div class="form-group col-md-4 m-0">
                                                <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                                <input type="text" class="form-control input-control input-no-text" id="email" name="email" value="<?php echo isset($cliente['email']) ? htmlspecialchars($cliente['email']) : ''; ?>" required>
                                            </div>

                                            <div class="form-group col-md-4 m-0">
                                                <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Teléfono</label>
                                                <input type="text" class="form-control input-control input-no-text" id="phone" name="phone" value="<?php echo isset($cliente['phone']) ? htmlspecialchars($cliente['phone']) : ''; ?>">
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>Celular</label>
                                                <input type="text" class="form-control input-control input-no-text" id="mobile" name="mobile" value="<?php echo isset($cliente['mobile']) ? htmlspecialchars($cliente['mobile']) : ''; ?>">
                                            </div>
                                            <!-- <div class="form-group col-md-4 m-0">
                                                <label for="birthday" class="col-form-label s-12"><i class="icon-calendar mr-2"></i>Fecha de nacimiento</label>
                                                <input type="date" class="form-control input-control" id="birthday" name="birthday" value="<?php echo isset($cliente['birthday']) ? htmlspecialchars($cliente['birthday']) : ''; ?>">
                                            </div> -->


                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <h5 class="card-title">DIRECCIÓN</h5>
                                        <div class="form-row">

                                            <div class="form-group col-md-12 m-0">
                                                <label for="descripcion">Calle y número </label>
                                                <input type="text" class="form-control input-control input-no-text" id="address" name="address" value="<?php echo isset($cliente['address']) ? htmlspecialchars($cliente['address']) : ''; ?>" required>
                                            </div>
                                            <!-- <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Número Ext</label>
                                                <input type="text" class="form-control input-control input-no-text" id="num_ext" name="num_ext" value="<?php echo isset($cliente['num_ext']) ? htmlspecialchars($cliente['num_ext']) : ''; ?>" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Número Int</label>
                                                <input type="text" class="form-control input-control input-no-text" id="num_int" name="num_int" value="<?php echo isset($cliente['num_int']) ? htmlspecialchars($cliente['num_int']) : ''; ?>">
                                            </div> -->
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">CP</label>
                                                <input type="text" class="form-control input-control input-no-text" id="cp" name="cp" value="<?php echo isset($cliente['cp']) ? htmlspecialchars($cliente['cp']) : ''; ?>" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Colonia</label>
                                                <input type="text" class="form-control input-control input-no-text" id="town" name="town" value="<?php echo isset($cliente['town']) ? htmlspecialchars($cliente['town']) : ''; ?>" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Ciudad</label>
                                                <input type="text" class="form-control input-control input-no-text" id="city" name="city" value="<?php echo isset($cliente['city']) ? htmlspecialchars($cliente['city']) : ''; ?>" required>
                                            </div>

                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Estado</label>
                                                <input type="text" class="form-control input-control input-no-text" id="state" name="state" value="<?php echo isset($cliente['state']) ? htmlspecialchars($cliente['state']) : ''; ?>" required>
                                            </div>

                                            <!-- <div class="form-group col-md-12 m-0">
                                                <label for="observaciones">Referencias</label>
                                                <textarea class="form-control r-0" id="ref" name="ref" rows="5" class="form-control"><?php echo isset($cliente['ref']) ? htmlspecialchars($cliente['ref']) : ''; ?></textarea>
                                            </div> -->

                                        </div>


                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <h5 class="card-title">DETALLES</h5>
                                        <div class="form-row">
                                            <!-- <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Libros </label>
                                                <select id="discounts_books" name="discounts_books" class="form-control select-control select-no-option" required>
                                                    <option value="0" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] ==  '0') ? 'selected' : ''; ?>>
                                                        Sin descuento</option>
                                                    <option value="5" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] ==  '5') ? 'selected' : ''; ?>>
                                                        5%</option>
                                                    <option value="10" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '10') ? 'selected' : ''; ?>>
                                                        10%</option>
                                                    <option value="15" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '15') ? 'selected' : ''; ?>>
                                                        15%</option>
                                                    <option value="20" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '20') ? 'selected' : ''; ?>>
                                                        20%</option>
                                                    <option value="25" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '25') ? 'selected' : ''; ?>>
                                                        25%</option>
                                                    <option value="30" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '30') ? 'selected' : ''; ?>>
                                                        30%</option>
                                                    <option value="35" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '25') ? 'selected' : ''; ?>>
                                                        35%</option>
                                                    <option value="40" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '40') ? 'selected' : ''; ?>>
                                                        40%</option>
                                                    <option value="45" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '45') ? 'selected' : ''; ?>>
                                                        45%</option>
                                                    <option value="50" <?php echo (isset($cliente['discounts_books']) && $cliente['discounts_books'] == '50') ? 'selected' : ''; ?>>
                                                        50%</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Biblias </label>
                                                <select id="discounts_bibles" name="discounts_bibles" class="form-control select-control select-no-option" required>
                                                    <option value="0" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '0') ? 'selected' : ''; ?>>
                                                        Sin descuento</option>
                                                    <option value="5" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '5') ? 'selected' : ''; ?>>
                                                        5%</option>
                                                    <option value="10" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '10') ? 'selected' : ''; ?>>
                                                        10%</option>
                                                    <option value="15" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '15') ? 'selected' : ''; ?>>
                                                        15%</option>
                                                    <option value="20" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '20') ? 'selected' : ''; ?>>
                                                        20%</option>
                                                    <option value="25" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '25') ? 'selected' : ''; ?>>
                                                        25%</option>
                                                    <option value="30" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '30') ? 'selected' : ''; ?>>
                                                        30%</option>
                                                    <option value="35" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '35') ? 'selected' : ''; ?>>
                                                        35%</option>
                                                    <option value="40" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '40') ? 'selected' : ''; ?>>
                                                        40%</option>
                                                    <option value="45" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '45') ? 'selected' : ''; ?>>
                                                        45%</option>
                                                    <option value="50" <?php echo (isset($cliente['discounts_bibles']) && $cliente['discounts_bibles'] == '50') ? 'selected' : ''; ?>>
                                                        50%</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Regalos </label>
                                                <select id="discounts_gifts" name="discounts_gifts" class="form-control select-control select-no-option" required>
                                                    <option value="0" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '0') ? 'selected' : ''; ?>>
                                                        Sin descuento</option>
                                                    <option value="5" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '5') ? 'selected' : ''; ?>>
                                                        5%</option>
                                                    <option value="10" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '10') ? 'selected' : ''; ?>>
                                                        10%</option>
                                                    <option value="15" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '15') ? 'selected' : ''; ?>>
                                                        15%</option>
                                                    <option value="20" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '20') ? 'selected' : ''; ?>>
                                                        20%</option>
                                                    <option value="25" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '25') ? 'selected' : ''; ?>>
                                                        25%</option>
                                                    <option value="30" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '30') ? 'selected' : ''; ?>>
                                                        30%</option>
                                                    <option value="35" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '35') ? 'selected' : ''; ?>>
                                                        35%</option>
                                                    <option value="40" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '40') ? 'selected' : ''; ?>>
                                                        40%</option>
                                                    <option value="45" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '45') ? 'selected' : ''; ?>>
                                                        45%</option>
                                                    <option value="50" <?php echo (isset($cliente['discounts_gifts']) && $cliente['discounts_gifts'] == '50') ? 'selected' : ''; ?>>
                                                        50%</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Tipo de usuario</label>
                                                <select id="type_user" name="type_user" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='0' name='0' value="0" <?php echo (isset($cliente['type_user']) && $cliente['type_user'] == '0') ? 'selected' : ''; ?>>
                                                        Público en general</option>
                                                    <option id='1' name='1' value="1" <?php echo (isset($cliente['type_user']) && $cliente['type_user'] == '1') ? 'selected' : ''; ?>>
                                                        Iglesias</option>
                                                    <option id='2' name='2' value="2" <?php echo (isset($cliente['type_user']) && $cliente['type_user'] == '2') ? 'selected' : ''; ?>>
                                                        Patrocinio</option>
                                                    <option id='3' name='3' value="3" <?php echo (isset($cliente['type_user']) && $cliente['type_user'] == '3') ? 'selected' : ''; ?>>
                                                        Seminarios</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Cargo</label>
                                                <select id="position" name="position" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='1' name='1' value="1" <?php echo (isset($cliente['position']) && $cliente['position'] == '1') ? 'selected' : ''; ?>>
                                                        Pastor (a)</option>
                                                    <option id='2' name='2' value="2" <?php echo (isset($cliente['position']) && $cliente['position'] == '2') ? 'selected' : ''; ?>>
                                                        Líder</option>
                                                    <option id='3' name='3' value="3" <?php echo (isset($cliente['position']) && $cliente['position'] == '3') ? 'selected' : ''; ?>>
                                                        Anciano</option>
                                                    <option id='4' name='4' value="4" <?php echo (isset($cliente['position']) && $cliente['position'] == '4') ? 'selected' : ''; ?>>
                                                        Servidor (a)</option>
                                                    <option id='5' name='5' value="5" <?php echo (isset($cliente['position']) && $cliente['position'] == '5') ? 'selected' : ''; ?>>
                                                        Diácono (a)</option>
                                                    <option id='6' name='6' value="6" <?php echo (isset($cliente['position']) && $cliente['position'] == '6') ? 'selected' : ''; ?>>
                                                        Maestro (a)</option>
                                                    <option id='7' name='7' value="7" <?php echo (isset($cliente['position']) && $cliente['position'] == '7') ? 'selected' : ''; ?>>
                                                        Asistente</option>
                                                    <option id='8' name='8' value="8" <?php echo (isset($cliente['position']) && $cliente['position'] == '8') ? 'selected' : ''; ?>>
                                                        Responsable de librería</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Notificaciones</label>
                                                <select id="notifications" name="notifications" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='0' name='0' value="1" <?php echo (isset($cliente['notifications']) && $cliente['notifications'] == '1') ? 'selected' : ''; ?>>
                                                        Si</option>
                                                    <option id='1' name='1' value="2" <?php echo (isset($cliente['notifications']) && $cliente['notifications'] == '2') ? 'selected' : ''; ?>>
                                                        No</option>
                                                </select>
                                            </div> -->

                                            <div class="col-md-12 mb-12">
                                                <label for="observaciones">Observaciones</label>
                                                <textarea class="form-control r-0" id="notes" name="notes" rows="5" class="form-control"><?php echo isset($cliente['notes']) ? htmlspecialchars($cliente['notes']) : ''; ?></textarea>

                                            </div>

                                        </div>


                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <button class="btn btn-primary waves-effect" type="submit"><i class="icon-save mr-2"></i>Guardar</button>
                                        <button class="btn btn-danger waves-effect" type="reset"><i class="icon-trash mr-2"></i>Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php include 'right_sidebar_bitacora.php'; ?>

        <!--/#app -->
        <script src="assets/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        // JS para actualizar datos de clientes
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('formRegistroUsuario').addEventListener('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    fetch('includes/editarCliente_DB.php', { // Cambia la URL al nuevo endpoint
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal("Actualización exitosa", data.message, "success")
                                    .then(() => {
                                        window.location.href = 'listar_clientes.php';
                                    });
                            } else {
                                swal("Error", data.message, "error");
                            }
                        })
                        .catch(error => {
                            swal("Error", "Error al procesar la solicitud: " + error, "error");
                        });
                });
            });
        </script>


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