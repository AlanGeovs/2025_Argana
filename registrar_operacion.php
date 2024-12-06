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
            <!-- nuevo diseño  -->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort">
                    <h4>Registrar operación</h4>

                    <form id="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="comprador">Comprador</label>
                                        <input type="text" class="form-control" id="comprador" placeholder="Buscar comprador por nombre o ID" required>
                                        <select id="comprador_result" class="custom-select form-control mt-2" size="5" style="display: none;"></select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="comprador_comision">Comisión (%)</label>
                                        <select id="comprador_comision" class="custom-select form-control" required>
                                            <option value="0">0%</option>
                                            <option value="1">1%</option>
                                            <option value="2">2%</option>
                                            <option value="3">3%</option>
                                            <option value="4">4%</option>
                                            <option value="5" selected>5%</option>
                                            <option value="6">6%</option>
                                            <option value="7">7%</option>
                                            <option value="8">8%</option>
                                            <option value="9">9%</option>
                                            <option value="10">10%</option>
                                            <option value="11">11%</option>
                                            <option value="12">12%</option>
                                            <option value="13">13%</option>
                                            <option value="14">14%</option>
                                            <option value="15">15%</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="vendedor">Vendedor</label>
                                        <input type="text" class="form-control" id="vendedor" placeholder="Buscar vendedor por nombre o ID" required>
                                        <select id="vendedor_result" class="custom-select form-control mt-2" size="5" style="display: none;"></select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="vendedor_comision">Comisión (%)</label>
                                        <select id="vendedor_comision" class="custom-select form-control" required>
                                            <option value="0">0%</option>
                                            <option value="1">1%</option>
                                            <option value="2">2%</option>
                                            <option value="3">3%</option>
                                            <option value="4">4%</option>
                                            <option value="5" selected>5%</option>
                                            <option value="6">6%</option>
                                            <option value="7">7%</option>
                                            <option value="8">8%</option>
                                            <option value="9">9%</option>
                                            <option value="10">10%</option>
                                            <option value="11">11%</option>
                                            <option value="12">12%</option>
                                            <option value="13">13%</option>
                                            <option value="14">14%</option>
                                            <option value="15">15%</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5>Cantidad</h5>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="intercambio">Intercambio ($)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" id="intercambio" placeholder="Monto en intercambio" required>
                                            <div class="invalid-feedback">
                                                Por favor, proporciona un monto válido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="efectivo">Efectivo ($)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" id="efectivo" placeholder="Monto en efectivo" value="0" required>
                                            <div class="invalid-feedback">
                                                Por favor, proporciona un monto válido.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5>Fechas</h5>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_transaccion">Fecha de transacción</label>
                                        <input type="date" class="form-control" id="fecha_transaccion" value="<?php echo date('Y-m-d'); ?>" required>
                                        <div class="invalid-feedback">
                                            Por favor, proporciona una fecha válida.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_deposito">Fecha de depósito</label>
                                        <input type="date" class="form-control" id="fecha_deposito" value="<?php echo date('Y-m-d'); ?>" required>
                                        <div class="invalid-feedback">
                                            Por favor, proporciona una fecha válida.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nota">Descripción de la operación</label>
                                    <textarea class="form-control" id="nota" placeholder="Escribe los detalles de la operación" rows="5" required></textarea>
                                    <div class="invalid-feedback">
                                        Por favor, proporciona detalles de la operación.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mt-4">
                                    <h6 class="card-header bg-primary text-white">Publicar</h6>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Confirmar datos</label>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <button class="btn btn-primary btn-sm" type="submit">Publicar operación</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>




        <?php include 'right_sidebar_bitacora.php'; ?>

        <!--/#app -->
        <script src="assets/js/app.js"></script>
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- JS para gaurdar datos de clientes -->

        <!-- Registrar operación -->
        <script>
            // $(document).ready(function() {
            //     function searchClient(inputId, resultId) {
            //         const query = $(inputId).val();
            //         if (query.length < 3) {
            //             $(resultId).hide();
            //             return;
            //         }

            //         $.ajax({
            //             url: 'includes/search_clients.php',
            //             type: 'GET',
            //             data: {
            //                 query: query
            //             },
            //             success: function(data) {
            //                 const results = JSON.parse(data);
            //                 let options = '';
            //                 results.forEach(client => {
            //                     options +=
            //                         `<option value="${client.id_user}">${client.name} ${client.last_name} (${client.username})</option>`;
            //                 });
            //                 $(resultId).html(options).show();
            //             }
            //         });
            //     }

            //     $('#comprador').on('input', function() {
            //         searchClient('#comprador', '#comprador_result');
            //     });

            //     $('#vendedor').on('input', function() {
            //         searchClient('#vendedor', '#vendedor_result');
            //     });

            //     $('#comprador_result').on('change', function() {
            //         const selectedText = $(this).find('option:selected').text();
            //         $('#comprador').val(selectedText);
            //         $(this).hide();
            //     });

            //     $('#vendedor_result').on('change', function() {
            //         const selectedText = $(this).find('option:selected').text();
            //         $('#vendedor').val(selectedText);
            //         $(this).hide();
            //     });
            //     $('#needs-validation').on('submit', function(event) {
            //         event.preventDefault();
            //         if (this.checkValidity() === false) {
            //             event.stopPropagation();
            //             $(this).addClass('was-validated');
            //             return;
            //         }

            //         // Recopilar datos del formulario
            //         const formData = {
            //             comprador: $('#comprador_result').val(),
            //             comprador_comision: $('#comprador_comision').val(),
            //             vendedor: $('#vendedor_result').val(),
            //             vendedor_comision: $('#vendedor_comision').val(),
            //             intercambio: $('#intercambio').val(),
            //             efectivo: $('#efectivo').val(),
            //             fecha_transaccion: $('#fecha_transaccion').val(),
            //             fecha_deposito: $('#fecha_deposito').val(),
            //             nota: $('#nota').val()
            //         };

            //         // Enviar datos a través de AJAX
            //         $.ajax({
            //             url: '/includes/register_operation.php',
            //             type: 'POST',
            //             data: formData,
            //             success: function(response) {
            //                 alert('Operación registrada con éxito');
            //                 // Resetear el formulario después de un registro exitoso
            //                 $('#needs-validation')[0].reset();
            //                 $('#comprador_result').hide();
            //                 $('#vendedor_result').hide();
            //                 $(this).removeClass('was-validated');
            //             },
            //             error: function() {
            //                 alert('Error al registrar la operación');
            //             }
            //         });
            //     });
            // });
            $(document).ready(function() {
                function searchClient(inputId, resultId) {
                    const query = $(inputId).val();
                    if (query.length < 3) {
                        $(resultId).hide();
                        return;
                    }

                    $.ajax({
                        url: 'includes/search_clients.php',
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const results = JSON.parse(data);
                            let options = '';
                            results.forEach(client => {
                                options += `<option value="${client.id_user}">${client.name} ${client.last_name} (${client.username})</option>`;
                            });
                            $(resultId).html(options).show();
                        }
                    });
                }

                $('#comprador').on('input', function() {
                    searchClient('#comprador', '#comprador_result');
                });

                $('#vendedor').on('input', function() {
                    searchClient('#vendedor', '#vendedor_result');
                });

                $('#comprador_result').on('change', function() {
                    const selectedText = $(this).find('option:selected').text();
                    $('#comprador').val(selectedText);
                    $(this).hide();
                });

                $('#vendedor_result').on('change', function() {
                    const selectedText = $(this).find('option:selected').text();
                    $('#vendedor').val(selectedText);
                    $(this).hide();
                });

                $('#needs-validation').on('submit', function(event) {
                    event.preventDefault(); // Evita el envío de formulario por defecto

                    if (this.checkValidity() === false) {
                        event.stopPropagation();
                        $(this).addClass('was-validated');
                        return;
                    }

                    // Recopilar datos del formulario
                    const formData = {
                        comprador: $('#comprador_result').val(),
                        comprador_comision: $('#comprador_comision').val(),
                        vendedor: $('#vendedor_result').val(),
                        vendedor_comision: $('#vendedor_comision').val(),
                        intercambio: $('#intercambio').val(),
                        efectivo: $('#efectivo').val(),
                        fecha_transaccion: $('#fecha_transaccion').val(),
                        fecha_deposito: $('#fecha_deposito').val(),
                        nota: $('#nota').val()
                    };

                    // Enviar datos a través de AJAX
                    $.ajax({
                        url: '/includes/register_operation.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Operación registrada con éxito',
                                    text: `La operación ha sido registrada correctamente con ID: ${response.operation_id}.`,
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'listar_pedidos.php';
                                    }
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al registrar la operación. Por favor, inténtalo de nuevo.',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
                });

            });
        </script>




        <!-- Buscar Clientes y Vendedor -->
        <script>
            $(document).ready(function() {
                function searchClient(inputId, resultId) {
                    const query = $(inputId).val();
                    if (query.length < 3) {
                        $(resultId).hide();
                        return;
                    }

                    $.ajax({
                        url: 'includes/search_clients.php',
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const results = JSON.parse(data);
                            let options = '';
                            results.forEach(client => {
                                options +=
                                    `<option value="${client.id_user}"> ${client.trading_name} / ${client.username} / ${client.legal_name}  </option>`;
                            });
                            $(resultId).html(options).show();
                        }
                    });
                }

                $('#comprador').on('input', function() {
                    searchClient('#comprador', '#comprador_result');
                });

                $('#vendedor').on('input', function() {
                    searchClient('#vendedor', '#vendedor_result');
                });

                $('#comprador_result').on('change', function() {
                    const selectedText = $(this).find('option:selected').text();
                    $('#comprador').val(selectedText);
                    $(this).hide();
                });

                $('#vendedor_result').on('change', function() {
                    const selectedText = $(this).find('option:selected').text();
                    $('#vendedor').val(selectedText);
                    $(this).hide();
                });
            });
        </script>








        <!-- ----------------script s anterioeres -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('formRegistroProductos').addEventListener('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    fetch('includes/registrarProducto_DB.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal("Registro exitoso", data.message, "success")
                                    .then((value) => {
                                        window.location.href =
                                            'listar_productos.php'; // Redirigir al usuario
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