<?php
session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {

?>
    <!DOCTYPE html>
    <html lang="es-MX">

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
                                                    <div class="form-group">
                                                        <input class="form-control form-control-lg" type="text" placeholder="Buscar cliente" id="filtro">
                                                    </div>

                                                </div>
                                                <div class="col-md-3 mb-3 ">
                                                    <button type="button" class="btn btn-primary mt-2" onclick="buscarClientes()">
                                                        <i class="icon-search3 mr-2"></i>Buscar
                                                    </button>
                                                </div>
                                                <!-- <div class="col-md-3 mb-3 mt-5">
                                                <a href="includes/exporta.php" class="btn btn-primary btn-lg r-20"><i
                                                        class="icon-download mr-2"></i>Descargar datos</a>
                                            </div> -->

                                                <!-- Botón para exportar a CSV -->
                                                <div class="col-md-3 mb-3">
                                                    <a href="includes/exportarBalances_csv.php" class="btn btn-primary btn-lg r-20">
                                                        <i class="icon-download mr-2"></i>Descargar datos
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nuevo diseño listar usuarios -->
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
                                                        <th>Nombre</th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Empresa </div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Contacto</div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Estado de Cuenta</div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Acciones</div>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input checkSingle" id="user_id_32" required=""><label class="custom-control-label" for="user_id_1"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="avatar avatar-md mr-3 mb-2 mt-1">
                                                                    <span class="avatar-letter avatar-letter-d  avatar-md circle"></span>
                                                                </div>
                                                                <div>
                                                                    <div>
                                                                        <strong>Alexander Pierce</strong>
                                                                    </div>
                                                                    <small> alexander@paper.com</small>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-none d-lg-block">2</div>
                                                        </td>
                                                        <td>
                                                            <div class="d-none d-lg-block">256</div>
                                                        </td>

                                                        <td>
                                                            <div class="d-none d-lg-block">+92 333 123 136</div>
                                                        </td>
                                                        <td>
                                                            <div class="d-none d-lg-block"><span class="icon icon-circle s-12  mr-2 text-warning"></span>
                                                                Inactive</div>
                                                        </td>
                                                        <td>
                                                            <div class="d-none d-lg-block"><span class="r-3 badge badge-success ">Administrator</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="panel-page-profile.html"><i class="icon-eye mr-3"></i></a>
                                                            <a href="panel-page-profile.html"><i class="icon-pencil"></i></a>
                                                        </td>
                                                    </tr>

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

            <!-- Agregar botón de Agregar usuario -->
            <a href="registrar_cliente.php" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i class="icon-add"></i></a>

            <!-- fin app -->
        </div>

        <!-- modales -->
        <!-- Modal -->
        <div class="modal fade" id="detallesClienteModal" tabindex="-1" role="dialog" aria-labelledby="detallesClienteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detallesClienteModalLabel">Detalles del Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí van los detalles del cliente -->
                        <div id="detallesCliente"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Genera Usuario -->

        <div class="modal fade" id="hacerUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="hacerUsuarioModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Dar acceso Clientes a la plataforma</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>ID: <span id="modalIdUsuario"></span></p>
                        <!-- <p>Nombre: <span id="modalNombreCompleto"></span></p> -->
                        <p>Email: <span id="modalEmail"></span></p>
                        <p>Contraseña: <input type="text" id="modalPassword" readonly></p>
                        <button onclick="copiarAlPortapapeles()">Copiar Contraseña</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="registrarCliente()">Dar acceso a la plataforma</button>
                    </div>
                </div>

            </div>
        </div>




        <?php include 'right_sidebar_bitacora.php'; ?>


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

            // Eliminar cliente
            function eliminarCliente(id) {
                var fila = $("#eliminar" + id);
                console.log("fila", fila);
                swal({
                    title: "¿Deseas eliminar al cliente  ?" + id,
                    text: "Una vez eliminado, no es posible recuperar el registro.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Este cliente ha sido eliminado correctamente!", {
                            icon: "success",
                        })
                        //$("#eliminar"+id).hide();
                        $.ajax({
                            type: "POST",
                            url: "includes/eliminarCliente_db.php",
                            data: {
                                idd: id
                            },
                            success: function(respuesta) {
                                $("#eliminar" + id).hide();
                                swal("Este cliente ha sido eliminado correctamente!", {
                                    icon: "success",
                                }).then(() => {
                                    actualizarClientes();
                                });
                            }
                        });
                    } else {
                        swal("No se llevo a cabo la operación")
                    }

                });


            }
            // Editar Cliente
            function editarCliente(id) {
                window.location.href = 'editar_cliente.php?id=' + id;
            }
        </script>

        <!-- Listar clientes -->
        <script>
            // Función buscar clientes
            function buscarClientes() {
                var filtro = document.getElementById('filtro').value;
                cargarClientes(1, filtro); // Carga la primera página con el filtro aplicado
            }
            //Actualiza clientes para el caso de cuando se borra un cliente


            // Función actualizada para actualizarClientes
            function actualizarClientes() {
                var filtro = document.getElementById('filtro').value;
                // Obtiene el número de página de la URL, o usa 1 por defecto
                cargarClientes(1, filtro); // Carga la página actual con el filtro aplicado
            }


            // Función para Cargar y Mostrar los Detalles del Cliente
            function verDetallesCliente(idUser) {
                fetch('includes/mostrarDetallesCliente_db.php?id=' + idUser)
                    .then(response => response.json())
                    .then(data => {
                        var detalles = document.getElementById('detallesCliente');
                        detalles.innerHTML = `
                        <table class="table table-bordered">
                    <tbody>
                        <tr><th>ID Usuario</th><td>${data.id_user}</td></tr>
                        <tr><th>ID cliente</th><td>${data.username}</td></tr>
                        <tr><th>Nombre</th><td>${data.name}</td></tr> 
                        <tr><th>Apellido Paterno</th><td>${data.last_name}</td></tr>
                        <tr><th>Apellido Materno</th><td>${data.last_name_second}</td></tr>
                        <tr><th>Balance en efectivo</th><td>${data.cash_balance}</td></tr>
                        <tr><th>Balance de intercambio</th><td>${data.trade_balance}</td></tr>                        
                        <tr><th>Email</th><td>${data.email}</td></tr>
                        <tr><th>Teléfono</th><td>${data.phone}</td></tr>
                        <tr><th>Celular</th><td>${data.mobile}</td></tr>
                        <tr><th>Dirección</th><td>${data.address}, ${data.num_int}, ${data.num_ext}</td></tr>
                        <tr><th>Colonia</th><td>${data.town}</td></tr>
                        <tr><th>Ciudad</th><td>${data.city}</td></tr>
                        <tr><th>Estado</th><td>${data.state}</td></tr>
                        <tr><th>Código Postal</th><td>${data.cp}</td></tr> 
                        <tr><th>Tipo de Usuario</th><td>${data.status}</td></tr> 
                        <tr><th>Comisión compra</th><td>${data.commission_purchase}</td></tr>
                        <tr><th>Comisión venta</th><td>${data.commission_sale}</td></tr>
                        <tr><th>Notas</th><td>${data.notes}</td></tr>
                    </tbody>
                </table>
                        `;
                        $('#detallesClienteModal').modal('show');

                    })
                    .catch(error => console.error('Error:', error));
            }



            // Función cargar clientes sin formato de datos de balance
            // function cargarClientes(pagina, filtro = '') {
            //     fetch(`includes/obtenerClientes.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
            //         .then(response => response.json())
            //         .then(data => {
            //             const tbody = document.querySelector('.table-responsive tbody');
            //             tbody.innerHTML = ''; // Limpiar tabla actual

            //             // Asegúrate de que 'data.clientes' es un array antes de llamar a forEach
            //             if (Array.isArray(data.clientes)) {
            //                 data.clientes.forEach(cliente => {
            //                     // Formatear números con separación de miles y dos decimales
            //                     const cashBalanceFormatted = cliente.cash_balance.toLocaleString('es-MX', {
            //                         minimumFractionDigits: 2,
            //                         maximumFractionDigits: 2
            //                     });
            //                     const tradeBalanceFormatted = cliente.trade_balance.toLocaleString('es-MX', {
            //                         minimumFractionDigits: 2,
            //                         maximumFractionDigits: 2
            //                     });

            //                     const tr = document.createElement('tr');
            //                     tr.innerHTML = `
            //             <td><span class="s-24 icon-male"></span></td>
            //             <td>
            //                 <div class="d-flex">
            //                     <!-- Avatar y Nombre -->
            //                     <div>
            //                         <strong>${cliente.name} ${cliente.last_name} <br> 
            //                         Cliente: ${cliente.username} </strong>   <br>
            //                         ${obtenerTipoUsuario(cliente.status)}                             
            //                     </div>
            //                 </div>
            //             </td>
            //             <td> 
            //                 <strong>${cliente.trading_name} / ${cliente.legal_name}   </strong><br>
            //                 ${cliente.address}, ${cliente.town},<br>${cliente.city}, ${cliente.state}, CP: ${cliente.cp}
            //             </td>

            //             <td>
            //                 <i class="icon-envelope mr-2"></i><small>${cliente.email}</small> <br>
            //                 <i class="icon-phone mr-2"></i>${cliente.phone}<br>
            //                 <i class="icon-whatsapp mr-2"></i>${cliente.mobile}</td>

            //             <td> 
            //                 ${cliente.cash_balance < 0 ? `<span class="badge badge-danger r-3">Saldo:  ${cashBalanceFormatted}</span>` : ''}
            //                 ${cliente.cash_balance > 0 ? `<span class="badge badge-success r-3">Saldo: ${cashBalanceFormatted}</span>` : ''}
            //                 ${cliente.trade_balance < 0 ? `<span class="badge badge-danger r-3">Balance: ${tradeBalanceFormatted}</span>` : ''}
            //                 ${cliente.trade_balance > 0 ? `<span class="badge badge-success r-3">Balance: ${tradeBalanceFormatted}</span>` : ''}
            //                 ${cliente.cash_balance === 0 && cliente.trade_balance === 0 ? `<span class="badge badge-info r-3">${cashBalanceFormatted}</span>` : ''}
            //                 <hr>
            //                 <a type="button" class="btn btn-info btn-xs" href="listar_estados_de_cuenta.php?u=${cliente.id_user}"><i class="icon-document-text4 mr-2"></i> Detalles Edo. Cta.</a>
            //             </td>                          

            //             <td>                         
            //                 <a onclick="verDetallesCliente('${cliente.id_user}');" href="#"><i class="icon-eye mr-2"></i>  </a>  
            //                 <a onclick="editarCliente('${cliente.id_user}');" href="#"><i class="icon-pencil mr-2"></i></a> 
            //                 <a onclick="eliminarCliente('${cliente.id_user}');" href="#" ><i class="icon-trash mr-2"></i></a> 
            //                 <a onclick="hacerUsuario('${cliente.id_user}', '${cliente.email}');" href="#"><i class="icon-user "></i></a>
            //                 <!--<a onclick="hacerUsuario('${cliente.id_user}', '${cliente.email}');" href="#" data-toggle="modal" data-target="#hacerUsuarioModal"><i class="icon-user "></i></a>-->
            //             </td>
            //         `;
            //                     tbody.appendChild(tr);
            //                 });
            //             }

            //             actualizarPaginador(data.totalPaginas, pagina);
            //         })
            //         .catch(error => console.error('Error:', error));
            // }


            // Función cargar clientes con formato de datos de balancecon formato
            // Función para formatear números
            function formatNumber(value) {
                return Number(value).toLocaleString('es-MX', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            var tipoUsuario = '<?php echo $_SESSION["tipoUsuario"]; ?>';


            // Función para cargar clientes  si funciona
            // function cargarClientes(pagina, filtro = '') {
            //     fetch(`includes/obtenerClientes.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
            //         .then(response => response.json())
            //         .then(data => {
            //             const tbody = document.querySelector('.table-responsive tbody');
            //             tbody.innerHTML = ''; // Limpiar tabla actual

            //             // Asegúrate de que 'data.clientes' es un array antes de llamar a forEach
            //             if (Array.isArray(data.clientes)) {
            //                 data.clientes.forEach(cliente => {
            //                     // Formatear los balances
            //                     const cashBalanceFormatted = formatNumber(cliente.cash_balance);
            //                     const tradeBalanceFormatted = formatNumber(cliente.trade_balance);

            //                     const tr = document.createElement('tr');
            //                     tr.innerHTML = `
            //             <td><span class="s-24 icon-male"></span></td>
            //             <td>
            //                 <div class="d-flex">
            //                     <!-- Avatar y Nombre -->
            //                     <div>
            //                         <strong>${cliente.name} ${cliente.last_name} <br> 
            //                         Cliente: ${cliente.username} </strong>   <br>
            //                         ${obtenerTipoUsuario(cliente.status)}                             
            //                     </div>
            //                 </div>
            //             </td>
            //             <td> 
            //                 <strong>${cliente.trading_name} / ${cliente.legal_name}   </strong><br>
            //                 ${cliente.address}, ${cliente.town},<br>${cliente.city}, ${cliente.state}, CP: ${cliente.cp}
            //             </td>

            //             <td>
            //                 <i class="icon-envelope mr-2"></i><small>${cliente.email}</small> <br>
            //                 <i class="icon-phone mr-2"></i>${cliente.phone}<br>
            //                 <i class="icon-whatsapp mr-2"></i>${cliente.mobile}</td>

            //             <td> 
            //                 ${cliente.cash_balance < 0 ? `<span class="badge badge-danger r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
            //                 ${cliente.cash_balance > 0 ? `<span class="badge badge-success r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
            //                 ${cliente.trade_balance < 0 ? `<span class="badge badge-danger r-3">Balance: $ ${tradeBalanceFormatted}</span>` : ''}
            //                 ${cliente.trade_balance > 0 ? `<span class="badge badge-success r-3">Balance: $ ${tradeBalanceFormatted}</span>` : ''}
            //                 ${cliente.cash_balance === 0 && cliente.trade_balance === 0 ? `<span class="badge badge-info r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
            //                 <hr>
            //                 <a type="button" class="btn btn-info btn-xs" href="listar_estados_de_cuenta.php?u=${cliente.id_user}"><i class="icon-document-text4 mr-2"></i> Detalles Edo. Cta.</a>
            //             </td>                          

            //             <td>                         
            //                 <a onclick="verDetallesCliente('${cliente.id_user}');" href="#"><i class="icon-eye mr-2"></i>  </a>  
            //                 <a onclick="editarCliente('${cliente.id_user}');" href="#"><i class="icon-pencil mr-2"></i></a> 
            //                 <a onclick="eliminarCliente('${cliente.id_user}');" href="#" ><i class="icon-trash mr-2"></i></a> 
            //                 <a onclick="hacerUsuario('${cliente.id_user}', '${cliente.email}');" href="#"><i class="icon-user "></i></a>
            //             </td>
            //         `;
            //                     tbody.appendChild(tr);
            //                 });
            //             }

            //             actualizarPaginador(data.totalPaginas, pagina);
            //         })
            //         .catch(error => console.error('Error:', error));
            // }

            // Función para cargar clientes con validación de usuario para Acciones
            function cargarClientes(pagina, filtro = '') {
                fetch(`includes/obtenerClientes.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.querySelector('.table-responsive tbody');
                        tbody.innerHTML = ''; // Limpiar tabla actual

                        // Asegúrate de que 'data.clientes' es un array antes de llamar a forEach
                        if (Array.isArray(data.clientes)) {
                            data.clientes.forEach(cliente => {
                                // Formatear los balances
                                const cashBalanceFormatted = formatNumber(cliente.cash_balance);
                                const tradeBalanceFormatted = formatNumber(cliente.trade_balance);

                                let accionesHTML = '';

                                // Agregar acciones de acuerdo al tipo de usuario
                                accionesHTML += `<a onclick="verDetallesCliente('${cliente.id_user}');" href="#"><i class="icon-eye mr-2"></i>  </a><br>`;

                                if (tipoUsuario === 'admin' || tipoUsuario === 'supervisor') {
                                    accionesHTML += `<a onclick="editarCliente('${cliente.id_user}');" href="#"><i class="icon-pencil mr-2"></i></a>`;
                                    accionesHTML += `<a onclick="eliminarCliente('${cliente.id_user}');" href="#" ><i class="icon-trash mr-2"></i></a><br>`;
                                }

                                accionesHTML += `<a onclick="hacerUsuario('${cliente.id_user}', '${cliente.email}');" href="#"><i class="icon-user "></i></a>`;

                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                        <td><span class="s-24 icon-male"></span></td>
                        <td>
                            <div class="d-flex">
                                <!-- Avatar y Nombre -->
                                <div>
                                    <strong>${cliente.name} ${cliente.last_name} <br> 
                                    Cliente: ${cliente.username} </strong>   <br>
                                    ${obtenerTipoUsuario(cliente.status)}                             
                                </div>
                            </div>
                        </td>
                        <td> 
                            <strong>${cliente.trading_name} / ${cliente.legal_name}   </strong><br>
                            ${cliente.address}, ${cliente.town},<br>${cliente.city}, ${cliente.state}, CP: ${cliente.cp}
                        </td>
                        
                        <td>
                            <i class="icon-envelope mr-2"></i><small>${cliente.email}</small> <br>
                            <i class="icon-phone mr-2"></i>${cliente.phone}<br>
                            <i class="icon-whatsapp mr-2"></i>${cliente.mobile}</td>
                        
                        <td> 
                            ${cliente.cash_balance < 0 ? `<span class="badge badge-danger r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
                            ${cliente.cash_balance > 0 ? `<span class="badge badge-success r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
                            ${cliente.trade_balance < 0 ? `<span class="badge badge-danger r-3">Balance: $ ${tradeBalanceFormatted}</span>` : ''}
                            ${cliente.trade_balance > 0 ? `<span class="badge badge-success r-3">Balance: $ ${tradeBalanceFormatted}</span>` : ''}
                            ${cliente.cash_balance === 0 && cliente.trade_balance === 0 ? `<span class="badge badge-info r-3">Saldo: $ ${cashBalanceFormatted}</span>` : ''}
                            <hr>
                            <a type="button" class="btn btn-info btn-xs" href="listar_estados_de_cuenta.php?u=${cliente.id_user}"><i class="icon-document-text4 mr-2"></i> Detalles Edo. Cta.</a>
                        </td>                          
                         
                        <td>                         
                            ${accionesHTML}
                        </td>
                    `;
                                tbody.appendChild(tr);
                            });
                        }

                        actualizarPaginador(data.totalPaginas, pagina);
                    })
                    .catch(error => console.error('Error:', error));
            }





            // Función para tipo de usuarios
            function obtenerTipoUsuario(tipo) {
                switch (tipo) {
                    case 'A':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-light "> A</span></div>';
                    case 'F':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-primary "> F</span></div>';
                    case 'I':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-success "> I</span></div>';
                    case 'S':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-warning "> S </span></div>';
                    case 'T':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-dark "> T </span></div>';
                    default:
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-dark "> Desconocido </span></div>';
                }
            }

            // Función para generar enlaces depaginación
            // pagina dor NO OPTIMIZADO, muestra TODOS los resultados de paginas << ANT 1 2 3 4 5 6 7 8 9 SIG >>
            function actualizarPaginador(totalPaginas, paginaActual) {
                const paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpiar paginador actual

                // Crear enlace "Previous"
                const prevLi = document.createElement('li');
                prevLi.className = 'page-item';
                prevLi.innerHTML = `<a class="page-link" href="#" onclick="cargarClientes(${paginaActual - 1})">Anterior</a>`;
                paginador.appendChild(prevLi);

                for (let i = 1; i <= totalPaginas; i++) {
                    const li = document.createElement('li');
                    li.className = 'page-item';
                    li.innerHTML = `<a class="page-link" href="#" onclick="cargarClientes(${i})">${i}</a>`;
                    paginador.appendChild(li);
                }

                // Crear enlace "Next"
                const nextLi = document.createElement('li');
                nextLi.className = 'page-item';
                nextLi.innerHTML = `<a class="page-link" href="#" onclick="cargarClientes(${paginaActual + 1})">Siguiente</a>`;
                paginador.appendChild(nextLi);
            }

            document.addEventListener('DOMContentLoaded', function() {
                cargarClientes(1);
            });
        </script>

        <!-- Función Hacer cliente -->
        <script>
            function hacerUsuario(idUser, email2) {
                // Llenar la información en el modal
                document.getElementById('modalIdUsuario').innerText = idUser;
                // document.getElementById('modalNombreCompleto').innerText = cliente.name + ' ' + cliente.last_name + ' ' + cliente.last_name_second;
                document.getElementById('modalEmail').innerText = email2;

                // Generar contraseña aleatoria
                let password = generarContrasena();
                document.getElementById('modalPassword').value = password;

                // Mostrar el modal
                $('#hacerUsuarioModal').modal('show');
            }

            function generarContrasena() {
                let caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                let contrasena = "";
                for (let i = 0; i < 8; i++) {
                    contrasena += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
                }
                return contrasena;
            }

            function copiarAlPortapapeles() {
                let passwordField = document.getElementById('modalPassword');
                passwordField.select();
                document.execCommand('copy');
            }

            function registrarCliente() {
                let userName = document.getElementById('modalEmail').innerText.replace(/\s+/g, '');
                let correo = document.getElementById('modalEmail').innerText;
                let password = document.getElementById('modalPassword').value;
                let tipo = "cliente";

                // Aquí haces la llamada AJAX al endpoint
                fetch('includes/registrarUsuario_db.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `userName=${encodeURIComponent(userName)}&correo=${encodeURIComponent(correo)}&password=${encodeURIComponent(password)}&tipo=${encodeURIComponent(tipo)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("¡Registro exitoso!", "El usuario ha sido registrado correctamente.", "success")
                                .then((value) => {
                                    $('#hacerUsuarioModal').modal('hide');
                                    // Aquí puedes recargar la página o hacer alguna otra acción
                                });
                        } else {
                            swal("Error", "Hubo un error al registrar al usuario. " + data.message, "error");
                        }
                    })
                    .catch(error => {
                        swal("Error", "Hubo un error al procesar la solicitud: " + error.message, "error");
                    });
            }
        </script>



        <!--/#app -->
        <script src="assets/js/app.js"></script>
    </body>

    </html>

<?php
}//termina else