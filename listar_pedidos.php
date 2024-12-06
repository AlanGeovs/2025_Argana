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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            <!-- Buscardor y barra superiro -->
            <div class="container-fluid animatedParent animateOnce">
                <div class="tab-content my-3" id="v-pills-tabContent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card no-b">
                                <div class="card-body p-0">
                                    <div class="card-body b-b">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <h3>Listado de Operaciones</h3>
                                                </div>
                                                <!-- RecuerdaDESPUES agregar el BUSCADOR DE OPERACIONES -->
                                                <!-- <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-lg" type="text" placeholder="Buscar productos" id="filtro">
                                                    </div>

                                                </div> -->

                                                <!-- <div class="col-md-2 mb-3 ">
                                                    <button type="button" class="btn btn-primary mt-2" onclick="buscarProductos()">
                                                        <i class="icon-search3 mr-2"></i>Buscar
                                                    </button>
                                                </div> -->
                                                <!-- <div class="col-md-3 mb-3 ">
                                                <a href="registrar_producto.php" class="btn btn-primary btn-lg r-20"><i
                                                        class="icon-plus-circle mr-2"></i>Agregar producto</a>
                                            </div> -->
                                                <!-- <div class="col-md-3 mb-3 mt-5">
                                                <a href="includes/exporta.php" class="btn btn-primary btn-lg r-20"><i
                                                        class="icon-download mr-2"></i>Descargar datos</a>
                                            </div> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuevo diseño listar productos -->
            <div class="container-fluid animatedParent animateOnce">
                <div class="tab-content my-3" id="v-pills-tabContent">
                    <div class="tab-pane animated fadeInUpShort show active go" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="card r-0 shadow">
                                    <div class="table-responsive">
                                        <form>
                                            <table class="table table-striped table-hover r-0">
                                                <thead>
                                                    <tr class="no-b">
                                                        <th style="width: 30px">
                                                        </th>
                                                        <th>ID operación</th>
                                                        <th>Vendedor</th>
                                                        <th>Comprador</th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Fecha</div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Costo Intercambio </div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Costo Efectivo </div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Status</div>
                                                        </th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <nav class="my-3" aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Anterior</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Agregar  -->
            <?php if ($_SESSION["tipoUsuario"] == "admin" || $_SESSION["tipoUsuario"] == "supervisor") { ?>
                <a href="registrar_operacion.php" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i class="icon-add"></i></a>
            <?php } ?>

            <!-- fin app -->
        </div>

        <!-- modales -->
        <!-- Modal -->
        <div class="modal fade" id="detallesProductoModal" tabindex="-1" role="dialog" aria-labelledby="detallesProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detallesProductoModalLabel">Detalles del Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí van los detalles del Producto -->
                        <div id="detallesProducto"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para cambiar Status de la operación -->
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Cambiar Estado de la Operación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="statusForm">
                            <input type="hidden" id="modalOperationId"> <!-- Campo oculto para el operation_id -->
                            <div class="form-group">
                                <label for="statusSelect">Seleccionar nuevo estado</label>
                                <select class="form-control" id="statusSelect">
                                    <option value="0">Cancelada</option>
                                    <option value="1">Completado</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        <!-- <?php //include 'right_sidebar_bitacora.php'; 
                ?> -->

        <!--/#app -->
        <!-- Versión anteriore SWAL -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          -->
        <!-- Versión NUeva SWAL -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



        <!-- Función listar las operaciones funciona sin ajuste de acceso de usuario-->
        <!-- <script type="text/javascript">
            function cargarProductos(pagina, filtro = '') {
                fetch(`includes/obtenerOperaciones.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.querySelector('.table-responsive tbody');
                        tbody.innerHTML = ''; // Limpiar tabla actual

                        // Asegúrate de que 'data.operaciones' es un array antes de llamar a forEach
                        if (Array.isArray(data.operaciones)) {
                            data.operaciones.forEach(operacion => {
                                let statusText = '';
                                let statusColor = '';
                                var status_old = operacion.status;

                                switch (status_old) {
                                    case '0':
                                        statusText = 'Cancelado';
                                        statusColor = 'text-danger';
                                        break;
                                    case '1':
                                        statusText = 'Completado';
                                        statusColor = 'text-success';
                                        break;
                                    case '2':
                                        statusText = 'Pendiente';
                                        statusColor = 'text-warning';
                                        break;
                                }

                                const tr = document.createElement('tr');
                                tr.innerHTML = ` 
                        <td><span class="s-24 icon-${operacion.operation_id > '1' ? 'check' : 'close2'}"></span></td>
                        <td><strong>${operacion.operation_id}</strong></td>
                        <td> ${operacion.seller_info.trading_name}</td>
                        <td> ${operacion.buyer_info.trading_name}</td>
                        <td>${operacion.transaction_date}</td>
                        <td>$${operacion.exchange_amount} MXN</td>
                        <td>$${operacion.cash_amount} MXN</td>
                        <td><span class="icon icon-circle s-12 mr-2 ${statusColor}"></span>${statusText} - ${operacion.status}</td>
                        <td>
                            <a href="#" onclick="actualizarStatus('${operacion.operation_id}')" data-toggle="modal" data-target="#statusModal">
                                <i class="icon-pencil mr-2"></i>
                            </a>
                             <a onclick="eliminarProducto('${operacion.operation_id}');" href="#"><i class="icon-trash"></i></a>  
                        </td>
                    `;
                                tbody.appendChild(tr);
                            });
                        }

                        actualizarPaginador(data.totalPaginas, pagina);
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script> -->

        <script>
            var tipoUsuario = '<?php echo $_SESSION["tipoUsuario"]; ?>';
        </script>

        <!-- Función para listar las operaciones -->
        <script>
            function cargarProductos(pagina, filtro = '') {
                fetch(`includes/obtenerOperaciones.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.querySelector('.table-responsive tbody');
                        tbody.innerHTML = ''; // Limpiar tabla actual

                        // Asegúrate de que 'data.operaciones' es un array antes de llamar a forEach
                        if (Array.isArray(data.operaciones)) {
                            data.operaciones.forEach(operacion => {
                                let statusText = '';
                                let statusColor = '';
                                var status_old = operacion.status;

                                switch (operacion.status) {
                                    case 0:
                                        statusText = 'Cancelado';
                                        statusColor = 'text-danger';
                                        break;
                                    case 1:
                                        statusText = 'Completado';
                                        statusColor = 'text-success';
                                        break;
                                    case 2:
                                        statusText = 'Pendiente';
                                        statusColor = 'text-warning';
                                        break;
                                    default:
                                        statusText = 'Desconocido';
                                        statusColor = 'text-secondary';
                                        break;
                                }

                                const tr = document.createElement('tr');
                                tr.innerHTML = ` 
                        <td><span class="s-24 icon-${operacion.operation_id > '1' ? 'check' : 'close2'}"></span></td>
                        <td><strong>${operacion.operation_id}</strong></td>
                        <td> ${operacion.seller_info.trading_name}</td>
                        <td> ${operacion.buyer_info.trading_name}</td>
                        <td>${operacion.transaction_date}</td>
                        <td>$${operacion.exchange_amount} MXN</td>
                        <td>$${operacion.cash_amount} MXN</td>
                        <td><span class="icon icon-circle s-12 mr-2 ${statusColor}"></span>${statusText} </td>
                        <td>`;

                                // Verificar si el tipo de usuario es 'admin' o 'supervisor' para mostrar el botón de cambiar status
                                if (tipoUsuario === 'admin' || tipoUsuario === 'supervisor') {
                                    tr.innerHTML += `
                            <a href="#" onclick="actualizarStatus('${operacion.operation_id}')" data-toggle="modal" data-target="#statusModal">
                                <i class="icon-pencil mr-2"></i>
                            </a>`;
                                }

                                tr.innerHTML += `</td>`;
                                tbody.appendChild(tr);
                            });
                        }

                        actualizarPaginador(data.totalPaginas, pagina);
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>


        <!-- Función cambiar Status funciona sin ajuste de acceso de usuario -->
        <script>
            function actualizarStatus(operationId) {
                $('#modalOperationId').val(operationId); // Cargar operationId en el campo oculto del modal
                $('#statusModal').modal('show'); // Mostrar el modal
            }

            $(document).ready(function() {
                // Manejo del evento submit
                $('#statusForm').on('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario recargue la página

                    var operationId = $('#modalOperationId').val();
                    var newStatus = $('#statusSelect').val();
                    var status_old = status_old;

                    $.ajax({
                        url: '/includes/update_operation_status.php',
                        type: 'POST',
                        data: {
                            operation_id: operationId,
                            status: newStatus,
                            old_status: status_old
                        },
                        success: function(response) {
                            // console.log('Success response:', response); // Debug
                            $('#statusModal').modal('hide'); // Cierra el modal
                            Swal.fire({
                                icon: 'success',
                                title: 'Estado actualizado',
                                text: 'El estado de la operación ha sido actualizado correctamente.',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                cargarProductos(1); // Recarga la lista de operaciones en la primera página
                            });
                        },
                        error: function(error) {
                            // console.log('Error response:', error); // Debug
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al actualizar el estado. Por favor, inténtelo de nuevo.',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
                });
            });
        </script>





        <!-- Eliminar Producto -->
        <script>
            function eliminarProducto(id) {
                var fila = $("#eliminar" + id);
                console.log("fila", fila);
                swal({
                    title: "¿Deseas eliminar al producto  ?" + id,
                    text: "Una vez eliminado, no es posible recuperar el registro.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Este producto ha sido eliminado correctamente!", {
                            icon: "success",
                        })
                        //$("#eliminar"+id).hide();
                        $.ajax({
                            type: "POST",
                            url: "includes/eliminarProducto_db.php",
                            data: {
                                idd: id
                            },
                            success: function(respuesta) {
                                $("#eliminar" + id).hide();
                                swal("Este producto ha sido eliminado correctamente!", {
                                    icon: "success",
                                }).then(() => {
                                    actualizarProductos();
                                });
                            }
                        });
                    } else {
                        swal("No se llevo a cabo la operación")
                    }

                });


            }
        </script>

        <!-- Listar Operaciones -->
        <script>
            // Función buscar Producto
            function buscarProductos() {
                var filtro = document.getElementById('filtro').value;
                cargarProductos(1, filtro); // Carga la primera página con el filtro aplicado
            }
            //Actualiza Producto para el caso de cuando se borra un producto


            // Función actualizada para actualizarProductos
            function actualizarProductos() {
                var filtro = document.getElementById('filtro').value;
                // Obtiene el número de página de la URL, o usa 1 por defecto
                cargarProductos(1, filtro); // Carga la página actual con el filtro aplicado
            }


            // Función para Cargar y Mostrar los Detalles del Producto
            function verDetallesProducto(idUser) {
                fetch('includes/mostrarDetallesProducto_db.php?id=' + idUser)
                    .then(response => response.json())
                    .then(data => {
                        var detalles = document.getElementById('detallesProducto');
                        detalles.innerHTML = `
                        <table class="table table-bordered">
                    <tbody>
                        <tr><th>ID Usuario</th><td>${data.id_user}</td></tr>
                        <tr><th>Nombre</th><td>${data.name}</td></tr>
                        <tr><th>Apellido Paterno</th><td>${data.last_name}</td></tr>
                        <tr><th>Apellido Materno</th><td>${data.last_name_second}</td></tr>
                        <tr><th>Email</th><td>${data.email}</td></tr>
                        <tr><th>Teléfono</th><td>${data.phone}</td></tr>
                        <tr><th>Celular</th><td>${data.mobile}</td></tr>
                        <tr><th>Dirección</th><td>${data.address}, ${data.num_int}, ${data.num_ext}</td></tr>
                        <tr><th>Colonia</th><td>${data.town}</td></tr>
                        <tr><th>Ciudad</th><td>${data.city}</td></tr>
                        <tr><th>Estado</th><td>${data.state}</td></tr>
                        <tr><th>Código Postal</th><td>${data.cp}</td></tr>
                        <tr><th>Descuentos en Libros</th><td>${data.discounts_books}%</td></tr>
                        <tr><th>Descuentos en Biblias</th><td>${data.discounts_bibles}%</td></tr>
                        <tr><th>Descuentos en Regalos</th><td>${data.discounts_gifts}%</td></tr>
                        <tr><th>Notificaciones</th><td>${data.notifications == '1' ? 'Sí' : 'No'}</td></tr>
                        <tr><th>Tipo de Usuario</th><td>${data.type_user}</td></tr>
                        <tr><th>Notas</th><td>${data.notes}</td></tr>
                        <tr><th>Género</th><td>${data.gender == '1' ? 'Hombre' : 'Mujer'}</td></tr>
                        <tr><th>Cargo</th><td>${data.position}</td></tr>
                    </tbody>
                </table>
                        `;
                        $('#detallesProductoModal').modal('show');

                    })
                    .catch(error => console.error('Error:', error));
            }




            // Función para generar enlaces depaginación
            // pagina dor OPTIMIZADO, muestra TODOS los resultados de paginas << ANT 1  ... 10 11 12 ...  45 SIG >>
            function actualizarPaginador(totalPaginas, paginaActual) {
                const paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpiar paginador actual
                const rango = 3; // Número de páginas a mostrar antes y después de la página actual

                // Enlace "Previous"
                const prevLi = document.createElement('li');
                prevLi.className = `page-item ${paginaActual === 1 ? 'disabled' : ''}`;
                prevLi.innerHTML =
                    `<a class="page-link" href="#" ${paginaActual > 1 ? `onclick="cargarProductos(${paginaActual - 1})"` : ''}>Anterior</a>`;
                paginador.appendChild(prevLi);

                // Bucle para Incluir Puntos Suspensivos
                for (let i = 1; i <= totalPaginas; i++) {
                    if (i == paginaActual || i <= rango || (i >= paginaActual - rango && i <= paginaActual + rango) || i >
                        totalPaginas - rango) {
                        const li = document.createElement('li');
                        li.className = 'page-item' + (i == paginaActual ? ' active' : '');
                        li.innerHTML = `<a class="page-link" href="#" onclick="cargarProductos(${i})">${i}</a>`;
                        paginador.appendChild(li);
                    } else if (i == paginaActual - rango - 1 || i == paginaActual + rango + 1) {
                        const li = document.createElement('li');
                        li.className = 'page-item';
                        li.innerHTML = '<a class="page-link" href="#">...</a>';
                        paginador.appendChild(li);
                    }
                }

                // Enlace "Next"
                const nextLi = document.createElement('li');
                nextLi.className = `page-item ${paginaActual === totalPaginas ? 'disabled' : ''}`;
                nextLi.innerHTML =
                    `<a class="page-link" href="#" ${paginaActual < totalPaginas ? `onclick="cargarProductos(${paginaActual + 1})"` : ''}>Siguiente</a>`;
                paginador.appendChild(nextLi);
            }

            document.addEventListener('DOMContentLoaded', function() {
                cargarProductos(1);
            });
        </script>
        <!--/#app -->
        <script src="assets/js/app.js"></script>
    </body>

    </html>

<?php
}//termina else