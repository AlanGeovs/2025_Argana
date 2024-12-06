<?php
session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {

?>
    <!DOCTYPE html>
    <html lang="es">

    <!-- Header -->
    <?php require_once "header.php"; ?>

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
                                                    <div class="form-group">
                                                        <input class="form-control form-control-lg" type="text" placeholder="Buscar productos" id="filtro">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3 ">
                                                    <button type="button" class="btn btn-primary mt-2" onclick="buscarProductos()">
                                                        <i class="icon-search3 mr-2"></i>Buscar
                                                    </button>
                                                </div>
                                                <div class="col-md-3 mb-3 ">
                                                    <a href="registrar_producto.php" class="btn btn-primary btn-lg r-20"><i class="icon-plus-circle mr-2"></i>Agregar producto</a>
                                                </div>
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
                                            <!-- <table class="table table-bordered table-hover data-tables dataTable"
                                            data-options="{&quot;searching&quot;:false}" id="DataTables_Table_0"
                                            role="grid" aria-describedby="DataTables_Table_0_info"> -->
                                            <table class="table table-striped table-hover r-0">
                                                <thead>
                                                    <tr class="no-b">
                                                        <th style="width: 30px">
                                                        </th>
                                                        <th>Nombre</th>
                                                        <th>
                                                            <div class="d-none d-lg-block">SKU </div>
                                                        </th>

                                                        <th>
                                                            <div class="d-none d-lg-block">Stock</div>
                                                        </th>
                                                        <th>
                                                            <div class="d-none d-lg-block">Precio</div>
                                                        </th>
                                                        <th>Acciones</th>
                                                        <th>Cantidad</th>

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
            <a href="registrar_producto.php" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i class="icon-add"></i></a>

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



        <!-- Right Sidebar -->
        <?php include_once "right_sidebar_cart.php"; ?>
        <!-- End Right Sidebar -->

        <!--/#app -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">
            // Eliminar Producto
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
            // Editar Producto
            function editarProducto(id) {
                window.location.href = 'editar_producto.php?id=' + id;
            }
        </script>

        <!-- Listar productos -->
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



            // Función cargar productos
            function cargarProductos(pagina, filtro = '') {
                fetch(`includes/obtenerProductos.php?pagina=${pagina}&filtro=${encodeURIComponent(filtro)}`)
                    .then(response => response.json())
                    .then(data => {
                            const tbody = document.querySelector('.table-responsive tbody');
                            tbody.innerHTML = ''; // Limpiar tabla actual

                            // Asegúrate de que 'data.productos' es un array antes de llamar a forEach
                            if (Array.isArray(data.productos)) {
                                data.productos.forEach(producto => {
                                            const tr = document.createElement('tr');
                                            tr.innerHTML = ` 
                        <td><span class="s-24 icon-${producto.stock > '1' ? 'check':'close2'}"></span></td>
                        <td>
                            <div class="d-flex">
                                <!-- Avatar y Nombre -->
                                <div>
                                    <strong>${producto.description} </strong> 
                                    <br>${producto.author}
                                </div>
                            </div>
                        </td>
                        
                        <td>SKU: ${producto.SKU}  </td>
                                                
 
                        <td>
                            ${
                                producto.stock == 0
                                ? '<span class="icon icon-circle s-12 mr-2 text-danger"></span> ' + producto.stock
                                : producto.stock > 0 && producto.stock <= 10
                                    ? '<span class="icon icon-circle s-12 mr-2 text-warning"></span> ' + producto.stock
                                    : '<span class="icon icon-circle s-12 mr-2 text-success"></span> ' + producto.stock
                            }
                        </td>

                        <td>$ ${producto.price_public} MXN</td>
                        <td>                         
                            <a onclick="verDetallesProducto('${producto.id_user}');" href="#"><i class="icon-eye mr-2"></i></a> 
                            <a onclick="editarProducto('${producto.id_user}');" href="#"><i class="icon-pencil mr-2"></i></a> 
                            <a onclick="eliminarProducto('${producto.id_user}');" href="#" ><i class="icon-trash "></i></a> 
                        </td>  `;


                                            // Asegurándonos de que el select tenga el ID correcto y de que lo utilizamos correctamente en agregarAlCarrito
                                            tr.innerHTML += `
                                <td>
                                    <select class="form-control cantidad" id="cantidad-${producto.id_product}">
                                        ${Array.from({ length: producto.stock }, (_, i) => ` < option value = "${i + 1}" > $ {
                                                i + 1
                                            } < /option>`).join('')} < /
                                            select > <
                                                /td> <
                                            td >
                                                <
                                                button class = "btn btn-primary btn-sm"
                                            onclick = "agregarAlCarrito('${producto.id_product}', document.getElementById('cantidad-${producto.id_product}').value);" > Agregar < /button> < /
                                            td >
                                                `;

                                // Asegúrate de asignar un ID único al select para evitar conflictos al seleccionar el elemento
                                // Modificación en la línea de select para incluir un ID único basado en el ID del producto
                                 tr.querySelector('select.cantidad').setAttribute('id', `
                                            cantidad - $ {
                                                producto.id_product
                                            }
                                            `);

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
                    case '0':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-light "> Público en general </span></div>';
                    case '1':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-primary "> Iglesias </span></div>';
                    case '2':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-success "> Patrocinio </span></div>';
                    case '3':
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-warning "> Seminarios </span></div>';
                    default:
                        return '<div class="d-none d-lg-block"><span class="r-3 badge badge-dark "> Desconocido </span></div>';
                }
            }

            // Función para generar enlaces depaginación
            // pagina dor OPTIMIZADO, muestra TODOS los resultados de paginas << ANT 1  ... 10 11 12 ...  45 SIG >>
            function actualizarPaginador(totalPaginas, paginaActual) {
                const paginador = document.querySelector('.pagination');
                paginador.innerHTML = ''; // Limpiar paginador actual
                const rango = 3; // Número de páginas a mostrar antes y después de la página actual

// Enlace "Previous"
const prevLi = document.createElement('li');
                prevLi.className = `page - item ${ paginaActual === 1 ? 'disabled' : '' }
                                            `;
                prevLi.innerHTML = `<a class = "page-link" href = "#"
                                            ${ paginaActual > 1 ? `onclick="cargarProductos(${paginaActual - 1}, '${filtro}')"` : '' } > Anterior </a>`;
                                            paginador.appendChild(prevLi);

                                            // Bucle para Incluir Puntos Suspensivos
                                            for (let i = 1; i <= totalPaginas; i++) {
                                                if (i == paginaActual || i <= rango || (i >= paginaActual - rango && i <=
                                                        paginaActual + rango) || i >
                                                    totalPaginas - rango) {
                                                    const li = document.createElement('li');
                                                    li.className = 'page-item' + (i == paginaActual ? ' active' : '');
                                                    li.innerHTML =
                                                        `<a class="page-link" href="#" onclick="cargarProductos(${i})">${i}</a>`;
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

        <!-- Funcoin agregar al carrito -->
        <script>
            function agregarAlCarrito(idProducto, cantidad) {
                fetch('includes/agregarAlCarrito.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `idProducto=${encodeURIComponent(idProducto)}&cantidad=${encodeURIComponent(cantidad)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Producto agregado al carrito');
                            // Actualiza la interfaz del carrito aquí, si es necesario
                        } else {
                            console.error('No se pudo agregar el producto al carrito');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>
    </body>

    </html>

<?php
}//termina else