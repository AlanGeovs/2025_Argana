<?php
session_start();

require_once "model/model.php";
require_once "model/carrito.php";
require_once "model/Order.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {

    $idPedido = $_GET['p'];
    $detallesPedido = Order::listarPedido($idPedido);
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
            <?php include "menu.php" ?>
            <!--Proyectos-->
            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort mb-1">

                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card no-b">


                                <div class="row justify-content-between mb-0 mt-15">
                                    <div class="col-md-6">
                                        <div class="card-header white b-0 p-3">
                                            <h4 class="card-title">Detalles de la Solicitud</h4>
                                            <p>Pedido #: <b><?php echo $detallesPedido['id_order'] ?></b>
                                                <br>Fecha de solicitud #: <b><?php echo $detallesPedido['order_date'] ?></b>
                                                <br>Cliente: <b><?php echo $detallesPedido['name'] . " " . $detallesPedido['last_name'] . " " . $detallesPedido['last_name_second'] ?></b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <!-- <a class="btn btn-primary btn-xs r-20" href="crear_proyecto.php"><i class="icon-plus-circle mr-2"></i>Crear Proyecto</a> -->
                                        <p>Status del pedido: en proceso</br>
                                            Vendedor: Ricardo Castilla<br>

                                        </p>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>


                </div>


                <!-- Card para mostrar poryectos de Crowdfunding -->
                <div id="container-proyectos">
                    <!-- Aquí se cargarán las tarjetas de proyectos -->
                    <div class="row justify-content-center mb-3 mt-15">
                        <div class="col-12 col-xl-12">
                            <div class="card no-b">
                                <div class="card-header white pb-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="align-self-center">
                                            <ul class="nav nav-pills mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link r-20 active show" id="w3--tab1" data-toggle="tab" href="#w3-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">Solicitud</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab2" data-toggle="tab" href="#w3-tab2" role="tab" aria-controls="tab2" aria-selected="false">Autorización</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab3" data-toggle="tab" href="#w3-tab3" role="tab" aria-controls="tab3" aria-selected="false">Proceso</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab4" data-toggle="tab" href="#w3-tab4" role="tab" aria-controls="tab4" aria-selected="false">Logística</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link r-20" id="w3--tab5" data-toggle="tab" href="#w3-tab5" role="tab" aria-controls="tab5" aria-selected="false">Finalizar</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="align-self-center">
                                            <h5>Avance del pedido: 20%</h5>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" style="width: 20%"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body no-p">
                                    <div class="tab-content">

                                        <!-- Tab 1 - Crear Proyecto -->
                                        <div class="tab-pane fade text-center active show p-1" id="w3-tab1" role="tabpanel" aria-labelledby="w3-tab1">
                                            <div class="card-body">

                                                <?php
                                                echo 'Status: ' . $detallesPedido['status'];

                                                if ($detallesPedido['status'] == 'Pendiente') {


                                                ?>
                                                    <button type="button" id="agregarFila" class="btn btn-primary">Agregar Fila</button>

                                                    <form id="formCrearSolicitud" method="post">
                                                        <input type="hidden" id="id_order" name="id_order" value="<?php echo $idPedido; ?>">
                                                        <div class="form-row">
                                                            <!-- Tabla con el contenido editable de los libros solicitados -->
                                                            <div class="box-body no-padding col-md-12">
                                                                <table id="tablaProductos" class="table table-striped">
                                                                    <tbody>
                                                                        <tr>

                                                                            <!-- <th>ISBN / SKU</th> -->
                                                                            <th>ID</th>
                                                                            <th>Nombre</th>
                                                                            <th>Precio Púb. </th>
                                                                            <th>Cantidad</th>
                                                                            <th>% Descuento</th>
                                                                            <th>Disp.</th>
                                                                            <th>Total</th>
                                                                            <th>Por surtir</th>
                                                                            <th>Proveedor</th>
                                                                            <th>Código de Reserv.</th>

                                                                        </tr>
                                                                        <tr>

                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>
                                                                            <td>Update soft</td>

                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>


                                                            <!-- Pedidos por surtir -->
                                                            <div class="box-body no-padding col-md-12">
                                                                <h3>Pedidos por surtir</h3>
                                                                <table id="pedidosPorSurtir" class="table table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>ISBN / SKU</th>
                                                                            <th>Nombre</th>
                                                                            <th>Precio Púb. </th>
                                                                            <th>Cantidad</th>
                                                                            <th>% Descuento</th>
                                                                            <th>Total</th>
                                                                            <th>Proveedor</th>
                                                                            <th>NOTA</th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>




                                                            <div class="col-md-12 mb-3">
                                                                <label for="price_shipment" class="form-label fw-bold">Costo de envío</label>
                                                                <input type="number" id="shipment" name="shipment">
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="prDescription_Input" class="form-label fw-bold">Notas de la solicitud</label>
                                                                <textarea class="form-control" name="notes" id="notes" placeholder="Detalles o notas sobre la solicitud actual del cliente" rows="6" maxlength="500"></textarea>
                                                                <div class="form-text" id="caracteresRestantes">500 caracteres restantes</div>
                                                            </div>


                                                            <div class="d-flex justify-content-center gap-2">
                                                                <button id="projectEditMain_submit" class="btn btn-primary">
                                                                    <i class="icon-plus-circle"></i> Generar orden
                                                                </button>
                                                            </div>


                                                        </div>
                                                    </form>

                                                <?php
                                                } else {

                                                    echo "<h2>Pedido envíado al cliente para revisión. </h2><hr/>";
                                                    echo '<a href="#" id="activarEdicionPedido" class="btn btn-primary">Activar edición de pedido</a>
                                                    ';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Tab 2 - Crear Montos y Plazos -->
                                        <div class="tab-pane fade text-center p-1" id="w3-tab2" role="tabpanel" aria-labelledby="w3-tab2">
                                            <div class="card-body">

                                                <?php

                                                if ($detallesPedido['status'] != 'Pendiente') {

                                                    // Ejemplo de cómo usar la función 
                                                    $orderDetails = Order::consultOrderDetailsEdit($idPedido);

                                                    // Verificar si la consulta fue exitosa
                                                    // Verificar si la consulta fue exitosa
                                                    if ($orderDetails !== false) {
                                                        echo '<div class="container mt-4">';
                                                        echo '<table class="table table-striped table-bordered">';
                                                        echo '<thead class="thead-dark">';
                                                        echo '<tr>
                                                                <th>id</th>
                                                                <th>id_order</th>
                                                                <th>SKU</th>
                                                                <th>description</th>
                                                                <th>price_public</th>
                                                                <th>quantity</th>
                                                                <th>discount</th>
                                                                <th>total</th>
                                                                <th>publisher</th>
                                                                <th>reservation_code</th>
                                                                <th>note</th>
                                                            </tr>';
                                                        echo '</thead>';
                                                        echo '<tbody>';

                                                        // Recorrer los datos y generar las filas de la tabla
                                                        foreach ($orderDetails as $detail) {
                                                            echo '<tr>';
                                                            echo '<td>' . htmlspecialchars($detail['id']) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['id_order']) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['SKU']) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['description']) . '</td>';
                                                            echo '<td>$' . number_format($detail['price_public'], 2) . '</td>';
                                                            echo '<td>' . intval($detail['quantity']) . '</td>';
                                                            echo '<td>' . number_format($detail['discount'], 2) . '%</td>';
                                                            echo '<td>$' . number_format($detail['total'], 2) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['publisher']) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['reservation_code']) . '</td>';
                                                            echo '<td>' . htmlspecialchars($detail['note']) . '</td>';
                                                            echo '</tr>';
                                                        }

                                                        echo '</tbody>';
                                                        echo '</table>';
                                                        echo '</div>';
                                                    } else {
                                                        echo '<div class="container mt-4">';
                                                        echo '<div class="alert alert-danger" role="alert">Error al consultar los detalles de la orden</div>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                ?>
                                                    <h3>Pedido sin enviar al cliente</h3>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>

                                        <!-- Tab 3 - Crear Recoempensas -->
                                        <div class="tab-pane fade text-center p-5" id="w3-tab3" role="tabpanel" aria-labelledby="w3-tab3">
                                            <h4 class="card-title">Tab 3</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                                content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>

                                        <!-- Tab 4 - Crear Multimedia -->
                                        <div class="tab-pane fade text-center p-5" id="w3-tab4" role="tabpanel" aria-labelledby="w3-tab4">
                                            <h4 class="card-title">Tab 4</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                                content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>

                                        <!-- Tab 5 - Crear Multimedia -->
                                        <div class="tab-pane fade text-center p-5" id="w3-tab5" role="tabpanel" aria-labelledby="w3-tab5">
                                            <h4 class="card-title">Tab 4</h4>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional
                                                content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
        <!-- Right Sidebar -->
        <?php include_once "right_sidebar_cart.php"; ?>
        <!-- End Right Sidebar -->

    </body>

    <!--/#app -->
    <script src="assets/js/app.js"></script>

    <!-- Integra SwitAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- mostrar los detalles del pedido -->
    <!-- Este código funciona, ya duplicar y borrar filas  en la función function updatePedidosPorSurtir(producto, toSupply, descuento) { en la sección de los botones de duplicar y borrar, cambie :  ${uniqueId} por  ${producto.id_detail} -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var idPedido = <?php echo $idPedido; ?>;
            var descuentoLibros = <?php echo $detallesPedido['discounts_books']; ?>;

            fetch('includes/obtiene_productos_pedido.php?id_pedido=' + idPedido)
                .then(response => response.json())
                .then(data => {
                    var tabla = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
                    while (tabla.rows.length > 1) {
                        tabla.deleteRow(1);
                    }

                    data.forEach((producto, index) => {
                        let fila = tabla.insertRow();
                        let totalId = `total-${index}`;
                        let pricePublicId = `price_public-${index}`;
                        let quantityId = `quantity-${index}`;
                        let toSupplyId = `toSupply-${index}`;
                        let stockId = `stock-${index}`;
                        let discountId = `discount_${producto.id_detail}`;

                        fila.innerHTML = `
                    <td>${producto.SKU} / ${producto.ISBN}</td>
                    <td>${producto.description}</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="hidden" id="id_detail-${index}" name="id_detail-${index}" value="${producto.id_detail}" class="form-control" required>
                            <input type="number" class="form-control price_public" id="${pricePublicId}" name="price_public-${index}" value="${producto.price_public}" step="any" required>
                        </div>                                
                    </td>                                
                    <td>   
                        <input type="number" id="${quantityId}" name="quantity-${index}" class="form-control quantity" value="${producto.quantity}" required>
                    </td>
                    <td id="${discountId}">${seleccionaDescuento(descuentoLibros)}</td> 
                    <td id="${stockId}"><span class="badge badge-pill badge-success">${producto.stock}</span></td>
                    <td id="${totalId}">$${(producto.quantity * producto.price_public * (100 - descuentoLibros) / 100).toFixed(2)}</td>
                    <td id="${toSupplyId}">0</td>
                    <td>${producto.publisher}</td>
                    <td><input type="text" class="form-control" id="reservation_code-${index}" name="reservation_code-${index}"></td>
                `;

                        document.getElementById(pricePublicId).addEventListener('input', () => updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto));
                        document.getElementById(quantityId).addEventListener('input', () => updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto));
                        document.getElementById(discountId).querySelector('.discounts-select').addEventListener('change', function() {
                            let discountValue = parseFloat(this.value) || 0;
                            updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto, discountValue);
                        });
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            // Solo envia pedidos por surtin sin renglones nuevos
            // document.getElementById('formCrearSolicitud').addEventListener('submit', function(event) {
            //     event.preventDefault(); // Evitar el envío del formulario por defecto

            //     let productos = [];

            //     // Recorre cada fila de productos
            //     let tablaProductos = document.querySelectorAll('#tablaProductos tbody tr');
            //     tablaProductos.forEach((fila, index) => {
            //         if (index === 0) return; // Saltar la fila del encabezado

            //         let producto = {};
            //         producto.SKU = fila.cells[0].textContent.trim();
            //         producto.description = fila.cells[1].textContent.trim();
            //         let pricePublicInput = fila.querySelector('.price_public');
            //         let quantityInput = fila.querySelector('.quantity');
            //         let discountSelect = fila.querySelector('.discounts-select');
            //         if (pricePublicInput && quantityInput && discountSelect) {
            //             producto.price_public = pricePublicInput.value;
            //             producto.quantity = quantityInput.value;
            //             producto.discount = discountSelect.value;
            //             producto.total = fila.querySelector(`[id^="total-"]`).textContent.replace('$', '').trim();
            //             producto.publisher = fila.cells[8].textContent.trim();
            //             producto.reservation_code = fila.querySelector(`[id^="reservation_code-"]`).value;
            //             producto.note = document.getElementById('notes').value; // Obtener el valor del textarea con id="notes"
            //             producto.shipment = document.getElementById('shipment').value;
            //             productos.push(producto);
            //         }
            //     });

            //     // Recorre cada fila de "Pedidos por surtir"
            //     let tablaSurtir = document.querySelectorAll('#pedidosPorSurtir tbody tr');
            //     tablaSurtir.forEach((fila, index) => {
            //         if (index === 0) return; // Saltar la fila del encabezado

            //         let producto = {};
            //         producto.SKU = fila.cells[0].textContent.trim();
            //         producto.description = fila.cells[1].textContent.trim();
            //         let pricePublicInput = fila.querySelector('.price_public');
            //         let quantityInput = fila.querySelector('.quantity');
            //         let discountInput = fila.querySelector('.discount');
            //         let publisherInput = fila.querySelector('.publisher-select');
            //         if (pricePublicInput && quantityInput && discountInput && publisherInput) {
            //             producto.price_public = pricePublicInput.value;
            //             producto.quantity = quantityInput.value;
            //             producto.discount = discountInput.value;
            //             producto.total = fila.querySelector(`[id^="total_"]`).textContent.replace('$', '').trim();
            //             producto.publisher = publisherInput.value;
            //             producto.reservation_code = ''; // No hay campo de reservation_code en "Pedidos por surtir"
            //             producto.note = document.getElementById('notes').value; // Obtener el valor del textarea con id="notes"
            //             producto.shipment = document.getElementById('shipment').value;
            //             productos.push(producto);
            //         }
            //     });

            //     // Debugging: mostrar los datos en la consola
            //     console.log({
            //         id_order: idPedido,
            //         productos: productos
            //     });

            //     fetch('includes/guardarSolicitudEditada.php', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify({
            //                 id_order: idPedido,
            //                 productos
            //             })
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 Swal.fire('Éxito', 'Datos guardados correctamente', 'success').then(() => {
            //                     location.reload();
            //                 });
            //             } else {
            //                 Swal.fire('Error', 'Error al guardar los datos: ' + (data.message || 'Error desconocido'), 'error');
            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //             Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
            //         });
            // });

            // Para enviar Renglon Nuevo
            document.getElementById('formCrearSolicitud').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario por defecto

                let productos = [];

                // Recorre cada fila de productos existentes
                let tablaProductos = document.querySelectorAll('#tablaProductos tbody tr');
                tablaProductos.forEach((fila, index) => {
                    if (index === 0) return; // Saltar la fila del encabezado

                    let producto = {};
                    producto.SKU = fila.cells[0].textContent.trim();
                    producto.description = fila.cells[1].textContent.trim();
                    let pricePublicInput = fila.querySelector('.price_public');
                    let quantityInput = fila.querySelector('.quantity');
                    let discountSelect = fila.querySelector('.discounts-select');
                    if (pricePublicInput && quantityInput && discountSelect) {
                        producto.price_public = pricePublicInput.value;
                        producto.quantity = quantityInput.value;
                        producto.discount = discountSelect.value;
                        producto.total = fila.querySelector(`[id^="total-"]`).textContent.replace('$', '').trim();
                        producto.publisher = fila.cells[8].textContent.trim();
                        producto.reservation_code = fila.querySelector(`[id^="reservation_code-"]`).value;
                        producto.note = document.getElementById('notes').value; // Obtener el valor del textarea con id="notes"
                        producto.shipment = document.getElementById('shipment').value;
                        productos.push(producto);
                    }
                });

                // Recorre cada fila de "Pedidos por surtir"
                let tablaSurtir = document.querySelectorAll('#pedidosPorSurtir tbody tr');
                tablaSurtir.forEach((fila, index) => {
                    if (index === 0) return; // Saltar la fila del encabezado

                    let producto = {};
                    let SKUInput = fila.querySelector('[id^="SKU_"]');
                    let descriptionInput = fila.querySelector('[id^="description_"]');
                    let pricePublicInput = fila.querySelector('[id^="price_"]');
                    let quantityInput = fila.querySelector('[id^="quantity_"]');
                    let discountInput = fila.querySelector('[id^="discount_"]');
                    let publisherInput = fila.querySelector('[id^="publisher_"]');
                    let reservationCodeInput = fila.querySelector('[id^="reservation_code_"]');
                    let noteInput = fila.querySelector('[id^="note_"]');

                    if (SKUInput && descriptionInput && pricePublicInput && quantityInput && discountInput && publisherInput) {
                        producto.SKU = SKUInput.value.trim();
                        producto.description = descriptionInput.value.trim();
                        producto.price_public = pricePublicInput.value;
                        producto.quantity = quantityInput.value;
                        producto.discount = discountInput.value;
                        producto.total = fila.querySelector(`[id^="total_"]`).textContent.replace('$', '').trim();
                        producto.publisher = publisherInput.value.trim();
                        producto.reservation_code = reservationCodeInput ? reservationCodeInput.value.trim() : '';
                        producto.note = noteInput ? noteInput.value.trim() : document.getElementById('notes').value;
                        producto.shipment = document.getElementById('shipment').value;
                        productos.push(producto);
                    }
                });

                // Debugging: mostrar los datos en la consola
                console.log({
                    id_order: idPedido,
                    productos: productos
                });

                fetch('includes/guardarSolicitudEditada.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_order: idPedido,
                            productos
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Éxito', 'Datos guardados correctamente', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Error al guardar los datos: ' + (data.message || 'Error desconocido'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
                    });
            });


            // Agregar fina NUEVA
            document.getElementById('agregarFila').addEventListener('click', function() {
                agregarNuevaFila();
            });

            // Función Agregar fina neuva
            function agregarNuevaFila() {
                let tablaSurtir = document.getElementById('pedidosPorSurtir').getElementsByTagName('tbody')[0];
                let uniqueId = `new_${Date.now()}`;

                let nuevaFila = tablaSurtir.insertRow();
                nuevaFila.setAttribute('id', `surtir-${uniqueId}`);

                nuevaFila.innerHTML = `
                            <td><input type="text" class="form-control" id="SKU_${uniqueId}" name="SKU_${uniqueId}" required></td>
                            <td><input type="text" class="form-control" id="description_${uniqueId}" name="description_${uniqueId}" required></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control price_public" id="price_${uniqueId}" name="price_${uniqueId}" step="any" required>
                                </div>
                            </td>
                            <td><input type="number" class="form-control quantity" id="quantity_${uniqueId}" name="quantity_${uniqueId}" required></td>
                            <td><input type="number" class="form-control discount" id="discount_${uniqueId}" name="discount_${uniqueId}" required></td>
                            <td id="total_${uniqueId}">$0.00</td>
                            <td><input type="text" class="form-control" id="publisher_${uniqueId}" name="publisher_${uniqueId}" required></td>
                            <td><input type="text" class="form-control" id="reservation_code_${uniqueId}" name="reservation_code_${uniqueId}"></td>
                            <td><input type="text" class="form-control" id="note_${uniqueId}" name="note_${uniqueId}" placeholder="Ingrese nota aquí"></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="duplicateRow('${uniqueId}');">Duplicar</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeRow('${uniqueId}');">Eliminar</button>
                            </td>
                        `;

                nuevaFila.querySelector(`#price_${uniqueId}`).addEventListener('input', () => calculateTotal(uniqueId));
                nuevaFila.querySelector(`#quantity_${uniqueId}`).addEventListener('input', () => calculateTotal(uniqueId));
                nuevaFila.querySelector(`#discount_${uniqueId}`).addEventListener('input', () => calculateTotal(uniqueId));
            }

            function updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, descuento) {
                let priceInput = document.getElementById(priceId);
                let quantityInput = document.getElementById(quantityId);
                let discountId = `discount_${producto.id_detail}`;
                let discountSelect = document.getElementById(discountId).querySelector('.discounts-select');
                if (priceInput && quantityInput && discountSelect) {
                    let price = parseFloat(priceInput.value);
                    let quantity = parseInt(quantityInput.value);
                    let discount = typeof descuento !== 'undefined' ? descuento : (parseFloat(discountSelect.value) || 0);
                    let total = (price * quantity * (100 - discount) / 100).toFixed(2);
                    document.getElementById(totalId).innerText = `$${total}`;

                    let toSupply = quantity > originalStock ? quantity - originalStock : 0;
                    document.getElementById(toSupplyId).innerText = toSupply;

                    let stockBadgeClass = quantity > originalStock ? "badge-danger" : "badge-success";
                    document.getElementById(stockId).innerHTML = `<span class="badge badge-pill ${stockBadgeClass}">${originalStock}</span>`;

                    updatePedidosPorSurtir(producto, toSupply, discount);
                }
            }

            function updatePedidosPorSurtir(producto, toSupply, descuento) {
                let tablaSurtir = document.getElementById('pedidosPorSurtir').getElementsByTagName('tbody')[0];
                let filaExistente = document.getElementById(`surtir-${producto.id_detail || producto.SKU}`);

                if (toSupply > 0) {
                    if (!filaExistente) {
                        filaExistente = tablaSurtir.insertRow();
                        filaExistente.setAttribute('id', `surtir-${producto.id_detail || producto.SKU}`);
                    }

                    let pricePublicNum = parseFloat(producto.price_public);
                    let uniqueId = `${producto.id_detail}_${Date.now()}`;

                    let totalId = `total_${uniqueId}`;
                    let priceId = `price_${uniqueId}`;
                    let quantityId = `quantity_${uniqueId}`;
                    let discountId = `discount_${uniqueId}`;
                    let reservationCodeId = `reservation_code_${uniqueId}`;

                    filaExistente.innerHTML = `
                <td>${producto.SKU} / ${producto.ISBN}</td>
                <td>${producto.description}</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control price_public" id="${priceId}" name="price_${uniqueId}" value="${pricePublicNum.toFixed(2)}" step="any" required>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control quantity" id="${quantityId}" name="quantity_${uniqueId}" value="${toSupply}" required>
                </td>
                <td>
                    <input type="number" class="form-control discount" id="${discountId}" name="discount_${uniqueId}" value="${descuento}" required>
                </td>
                <td id="${totalId}">$${(pricePublicNum * toSupply * (100 - descuento) / 100).toFixed(2)}</td>
                <td>${generarSelectPublisher(producto.publisher)}</td>
                <td><input type="text" class="form-control" id="${reservationCodeId}" name="reservation_code_${uniqueId}"></td>
                <td>
                    <input type="text" class="form-control" name="nota_${uniqueId}" placeholder="Ingrese nota aquí">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="duplicateRow('${producto.id_detail}');">Duplicar</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow('${producto.id_detail}');">Eliminar</button>
                </td>
            `;

                    filaExistente.querySelector(`#${priceId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
                    filaExistente.querySelector(`#${quantityId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
                    filaExistente.querySelector(`#${discountId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
                } else if (filaExistente) {
                    filaExistente.remove();
                }
            }

            // function calculateTotal(idDetail) {
            //     let price = parseFloat(document.getElementById(`price_${idDetail}`).value);
            //     let quantity = parseInt(document.getElementById(`quantity_${idDetail}`).value);
            //     let discount = parseFloat(document.getElementById(`discount_${idDetail}`).value) || 0;
            //     let total = price * quantity * (100 - discount) / 100;
            //     document.getElementById(`total_${idDetail}`).innerText = `$${total.toFixed(2)}`;
            // }
            function calculateTotal(idDetail) {
                let price = parseFloat(document.getElementById(`price_${idDetail}`).value) || 0;
                let quantity = parseInt(document.getElementById(`quantity_${idDetail}`).value) || 0;
                let discount = parseFloat(document.getElementById(`discount_${idDetail}`).value) || 0;
                let total = price * quantity * (100 - discount) / 100;
                document.getElementById(`total_${idDetail}`).innerText = `$${total.toFixed(2)}`;
            }

            // function duplicateRow(detailId) {
            //     let originalRow = document.getElementById(`surtir-${detailId}`);
            //     if (!originalRow) return;

            //     let newRow = originalRow.cloneNode(true); // Duplica toda la fila

            //     let newIdDetail = `${detailId}_${Date.now()}`;
            //     newRow.setAttribute('id', `surtir-${newIdDetail}`);

            //     newRow.querySelectorAll('[id]').forEach(element => {
            //         let baseId = element.id.split('_')[0];
            //         element.id = `${baseId}_${newIdDetail}`;
            //         element.name = `${baseId}_${newIdDetail}`;

            //         if (element.type === 'number') {
            //             element.value = element.value;
            //         }
            //     });

            //     newRow.querySelector(`#price_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
            //     newRow.querySelector(`#quantity_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
            //     newRow.querySelector(`#discount_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));

            //     newRow.querySelector('.btn-secondary').setAttribute('onclick', `duplicateRow('${newIdDetail}');`);
            //     newRow.querySelector('.btn-danger').setAttribute('onclick', `removeRow('${newIdDetail}');`);

            //     originalRow.parentNode.insertBefore(newRow, originalRow.nextSibling);
            // }
            // Funciones duplicateRow y removeRow deben estar definidas
            function duplicateRow(detailId) {
                let originalRow = document.getElementById(`surtir-${detailId}`);
                if (!originalRow) return;

                let newRow = originalRow.cloneNode(true); // Duplica toda la fila

                let newIdDetail = `new_${Date.now()}`;
                newRow.setAttribute('id', `surtir-${newIdDetail}`);

                newRow.querySelectorAll('[id]').forEach(element => {
                    let baseId = element.id.split('_')[0];
                    element.id = `${baseId}_${newIdDetail}`;
                    element.name = `${baseId}_${newIdDetail}`;

                    if (element.type === 'number' || element.type === 'text') {
                        element.value = element.value;
                    }
                });

                newRow.querySelector(`#price_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
                newRow.querySelector(`#quantity_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
                newRow.querySelector(`#discount_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));

                newRow.querySelector('.btn-secondary').setAttribute('onclick', `duplicateRow('${newIdDetail}');`);
                newRow.querySelector('.btn-danger').setAttribute('onclick', `removeRow('${newIdDetail}');`);

                originalRow.parentNode.insertBefore(newRow, originalRow.nextSibling);
            }

            // function removeRow(detailId) {
            //     let row = document.getElementById(`surtir-${detailId}`);
            //     if (row) {
            //         row.parentNode.removeChild(row);
            //     }
            // }
            function removeRow(detailId) {
                let row = document.getElementById(`surtir-${detailId}`);
                if (row) {
                    row.parentNode.removeChild(row);
                }
            }

            function generarSelectPublisher(publisherActual) {
                const publishers = ["ARIEL", "CLC", "ARCOIRIS", "MARANATHA MAQ", "MARANATHA BOLIVAR", "PAPIRO 52", "ARIEL MTY"];
                let selectHTML = `<select class="form-control publisher-select">`;

                publishers.forEach(publisher => {
                    selectHTML += `<option value="${publisher}" ${publisher === publisherActual ? 'selected' : ''}>${publisher}</option>`;
                });

                selectHTML += `</select>`;
                return selectHTML;
            }

            function seleccionaDescuento(descuentoActual) {
                const descuentos = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65];
                let selectHTML = `<select class="form-control discounts-select">`;
                descuentos.forEach(descuento => {
                    selectHTML += `<option value="${descuento}" ${descuento === descuentoActual ? 'selected' : ''}>${descuento}</option>`;
                });

                selectHTML += `</select>`;
                return selectHTML;
            }

            document.querySelectorAll('.discounts-select').forEach(select => {
                select.addEventListener('change', function() {
                    let row = this.closest('tr');
                    let priceId = row.querySelector('.price_public').id;
                    let quantityId = row.querySelector('.quantity').id;
                    let totalId = row.querySelector('[id^="total"]').id;
                    let toSupplyId = row.querySelector('[id^="toSupply"]').id;
                    let stockId = row.querySelector('[id^="stock"]').id;
                    let originalStock = parseInt(row.querySelector('[id^="stock"]').innerText);
                    let producto = {
                        id_detail: row.querySelector('input[type="hidden"]').value,
                        stock: originalStock
                    };
                    updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, this.value);
                });
            });

            // Aseguramos que las funciones sean accesibles en el ámbito global
            window.updateRow = updateRow;
            window.duplicateRow = duplicateRow;
            window.removeRow = removeRow;
            window.generarSelectPublisher = generarSelectPublisher;
            window.seleccionaDescuento = seleccionaDescuento;
        });
    </script>

    <!-- Cambiar Status de Pedido -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('activarEdicionPedido').addEventListener('click', function(event) {
                event.preventDefault();
                changeOrderStatus();
            });

            function changeOrderStatus() {
                fetch('includes/cambiar_estado_pedido.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_order: <?php echo $idPedido; ?>,
                            status: 'Pendiente'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Éxito', 'El estado del pedido ha sido actualizado a Pendiente', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'No se pudo actualizar el estado del pedido: ' + (data.message || 'Error desconocido'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
                    });
            }
        });
    </script>




    <!-- Funcionando Pero sin duplicar y borrar filas -->
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var idPedido = <?php echo $idPedido; ?>;
            var descuentoLibros = <?php echo $detallesPedido['discounts_books']; ?>;

            fetch('includes/obtiene_productos_pedido.php?id_pedido=' + idPedido)
                .then(response => response.json())
                .then(data => {
                    var tabla = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
                    while (tabla.rows.length > 1) {
                        tabla.deleteRow(1);
                    }

                    data.forEach((producto, index) => {
                        let fila = tabla.insertRow();
                        let totalId = `total-${index}`;
                        let pricePublicId = `price_public-${index}`;
                        let quantityId = `quantity-${index}`;
                        let toSupplyId = `toSupply-${index}`;
                        let stockId = `stock-${index}`;
                        let discountId = `discount_${producto.id_detail}`;

                        fila.innerHTML = `
                            <td>${producto.SKU} / ${producto.ISBN}</td>
                            <td>${producto.description}</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="hidden" id="id_detail-${index}" name="id_detail-${index}" value="${producto.id_detail}" class="form-control" required>
                                    <input type="number" class="form-control price_public" id="${pricePublicId}" name="price_public-${index}" value="${producto.price_public}" step="any" required>   
                                </div>                                
                            </td>                                
                            <td>   
                                <input type="number" id="${quantityId}" name="quantity-${index}" class="form-control quantity" value="${producto.quantity}" required>
                            </td>
                            <td id="${discountId}">${seleccionaDescuento(descuentoLibros)}</td> 
                            <td id="${stockId}"><span class="badge badge-pill badge-success">${producto.stock}</span></td>
                            <td id="${totalId}">$${(producto.quantity * producto.price_public * (100 - descuentoLibros) / 100).toFixed(2)}</td>
                            <td id="${toSupplyId}">0</td>
                            <td>${producto.publisher}</td>
                            <td><input type="text" class="form-control" id="reservation_code-${index}" name="reservation_code-${index}" ></td>
                        `;

                        document.getElementById(pricePublicId).addEventListener('input', () => updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto));
                        document.getElementById(quantityId).addEventListener('input', () => updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto));
                        document.getElementById(discountId).querySelector('.discounts-select').addEventListener('change', function() {
                            let discountValue = parseFloat(this.value) || 0;
                            updateRow(pricePublicId, quantityId, totalId, toSupplyId, stockId, producto.stock, producto, discountValue);
                        });
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            // document.getElementById('formCrearSolicitud').addEventListener('submit', function(event) {
            //     event.preventDefault(); // Evitar el envío del formulario por defecto

            //     let productos = [];

            //     // Recorre cada fila de productos
            //     let tablaProductos = document.querySelectorAll('#tablaProductos tbody tr');
            //     tablaProductos.forEach((fila, index) => {
            //         if (index === 0) return; // Saltar la fila del encabezado

            //         let producto = {};
            //         producto.SKU = fila.cells[0].textContent.trim();
            //         producto.description = fila.cells[1].textContent.trim();
            //         let pricePublicInput = fila.querySelector('.price_public');
            //         let quantityInput = fila.querySelector('.quantity');
            //         let discountSelect = fila.querySelector('.discounts-select');
            //         if (pricePublicInput && quantityInput && discountSelect) {
            //             producto.price_public = pricePublicInput.value;
            //             producto.quantity = quantityInput.value;
            //             producto.discount = discountSelect.value;
            //             producto.total = fila.querySelector(`[id^="total-"]`).textContent.replace('$', '').trim();
            //             producto.publisher = fila.cells[8].textContent.trim();
            //             producto.reservation_code = fila.querySelector(`[id^="reservation_code-"]`).value;
            //             producto.note = ''; // Asigna el valor de nota si está presente
            //             productos.push(producto);
            //         }
            //     });

            //     // Recorre cada fila de "Pedidos por surtir"
            //     let tablaSurtir = document.querySelectorAll('#pedidosPorSurtir tbody tr');
            //     tablaSurtir.forEach((fila, index) => {
            //         if (index === 0) return; // Saltar la fila del encabezado

            //         let producto = {};
            //         producto.SKU = fila.cells[0].textContent.trim();
            //         producto.description = fila.cells[1].textContent.trim();
            //         let pricePublicInput = fila.querySelector('.price_public');
            //         let quantityInput = fila.querySelector('.quantity');
            //         let discountInput = fila.querySelector('.discount');
            //         let publisherInput = fila.querySelector('.publisher-select');
            //         if (pricePublicInput && quantityInput && discountInput && publisherInput) {
            //             producto.price_public = pricePublicInput.value;
            //             producto.quantity = quantityInput.value;
            //             producto.discount = discountInput.value;
            //             producto.total = fila.querySelector(`[id^="total_"]`).textContent.replace('$', '').trim();
            //             producto.publisher = publisherInput.value;
            //             producto.reservation_code = ''; // No hay campo de reservation_code en "Pedidos por surtir"
            //             producto.note = fila.querySelector('input[name^="nota_"]').value;
            //             productos.push(producto);
            //         }
            //     });

            //     // Debugging: mostrar los datos en la consola
            //     console.log({
            //         id_order: idPedido,
            //         productos: productos
            //     });

            //     fetch('includes/guardarSolicitudEditada.php', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify({
            //                 id_order: idPedido,
            //                 productos
            //             })
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 Swal.fire('Éxito', 'Datos guardados correctamente', 'success');
            //             } else {
            //                 Swal.fire('Error', 'Error al guardar los datos: ' + (data.message || 'Error desconocido'), 'error');
            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //             Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
            //         });
            // });
            document.getElementById('formCrearSolicitud').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario por defecto

                let productos = [];

                // Recorre cada fila de productos
                let tablaProductos = document.querySelectorAll('#tablaProductos tbody tr');
                tablaProductos.forEach((fila, index) => {
                    if (index === 0) return; // Saltar la fila del encabezado

                    let producto = {};
                    producto.SKU = fila.cells[0].textContent.trim();
                    producto.description = fila.cells[1].textContent.trim();
                    let pricePublicInput = fila.querySelector('.price_public');
                    let quantityInput = fila.querySelector('.quantity');
                    let discountSelect = fila.querySelector('.discounts-select');
                    if (pricePublicInput && quantityInput && discountSelect) {
                        producto.price_public = pricePublicInput.value;
                        producto.quantity = quantityInput.value;
                        producto.discount = discountSelect.value;
                        producto.total = fila.querySelector(`[id^="total-"]`).textContent.replace('$', '').trim();
                        producto.publisher = fila.cells[8].textContent.trim();
                        producto.reservation_code = fila.querySelector(`[id^="reservation_code-"]`).value;
                        producto.note = document.getElementById('notes').value; // Obtener el valor del textarea con id="notes"
                        productos.push(producto);
                    }
                });

                // Recorre cada fila de "Pedidos por surtir"
                let tablaSurtir = document.querySelectorAll('#pedidosPorSurtir tbody tr');
                tablaSurtir.forEach((fila, index) => {
                    if (index === 0) return; // Saltar la fila del encabezado

                    let producto = {};
                    producto.SKU = fila.cells[0].textContent.trim();
                    producto.description = fila.cells[1].textContent.trim();
                    let pricePublicInput = fila.querySelector('.price_public');
                    let quantityInput = fila.querySelector('.quantity');
                    let discountInput = fila.querySelector('.discount');
                    let publisherInput = fila.querySelector('.publisher-select');
                    if (pricePublicInput && quantityInput && discountInput && publisherInput) {
                        producto.price_public = pricePublicInput.value;
                        producto.quantity = quantityInput.value;
                        producto.discount = discountInput.value;
                        producto.total = fila.querySelector(`[id^="total_"]`).textContent.replace('$', '').trim();
                        producto.publisher = publisherInput.value;
                        producto.reservation_code = ''; // No hay campo de reservation_code en "Pedidos por surtir"
                        producto.note = document.getElementById('notes').value; // Obtener el valor del textarea con id="notes"
                        productos.push(producto);
                    }
                });

                // Debugging: mostrar los datos en la consola
                console.log({
                    id_order: idPedido,
                    productos: productos
                });

                fetch('includes/guardarSolicitudEditada.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_order: idPedido,
                            productos
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Éxito', 'Datos guardados correctamente', 'success');
                        } else {
                            Swal.fire('Error', 'Error al guardar los datos: ' + (data.message || 'Error desconocido'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
                    });
            });


        });



        // function updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, descuento) {
        //     let priceInput = document.getElementById(priceId);
        //     let quantityInput = document.getElementById(quantityId);
        //     let discountId = `discount_${producto.id_detail}`;
        //     let discountSelect = document.getElementById(discountId).querySelector('.discounts-select');
        //     if (priceInput && quantityInput && discountSelect) {
        //         let price = parseFloat(priceInput.value);
        //         let quantity = parseInt(quantityInput.value);
        //         let discount = typeof descuento !== 'undefined' ? descuento : (parseFloat(discountSelect.value) || 0);
        //         let total = (price * quantity * (100 - discount) / 100).toFixed(2);
        //         document.getElementById(totalId).innerText = `$${total}`;

        //         let toSupply = quantity > originalStock ? quantity - originalStock : 0;
        //         document.getElementById(toSupplyId).innerText = toSupply;

        //         let stockBadgeClass = quantity > originalStock ? "badge-danger" : "badge-success";
        //         document.getElementById(stockId).innerHTML = `<span class="badge badge-pill ${stockBadgeClass}">${originalStock}</span>`;

        //         updatePedidosPorSurtir(producto, toSupply, discount);
        //     }
        // }
        function updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, descuento) {
            let priceInput = document.getElementById(priceId);
            let quantityInput = document.getElementById(quantityId);
            let discountId = `discount_${producto.id_detail}`;
            let discountSelect = document.getElementById(discountId).querySelector('.discounts-select');
            if (priceInput && quantityInput && discountSelect) {
                let price = parseFloat(priceInput.value);
                let quantity = parseInt(quantityInput.value);
                let discount = typeof descuento !== 'undefined' ? descuento : (parseFloat(discountSelect.value) || 0);
                let total = (price * quantity * (100 - discount) / 100).toFixed(2);
                document.getElementById(totalId).innerText = `$${total}`;

                let toSupply = quantity > originalStock ? quantity - originalStock : 0;
                document.getElementById(toSupplyId).innerText = toSupply;

                let stockBadgeClass = quantity > originalStock ? "badge-danger" : "badge-success";
                document.getElementById(stockId).innerHTML = `<span class="badge badge-pill ${stockBadgeClass}">${originalStock}</span>`;

                updatePedidosPorSurtir(producto, toSupply, discount);
            }
        }


        // Función que crea un nuevo renglón para los pedidos por sertir  
        // function updatePedidosPorSurtir(producto, toSupply, descuento) {
        //     let tablaSurtir = document.getElementById('pedidosPorSurtir').getElementsByTagName('tbody')[0];
        //     let filaExistente = document.getElementById(`surtir-${producto.id_detail || producto.SKU}`);

        //     if (toSupply > 0) {
        //         if (!filaExistente) {
        //             filaExistente = tablaSurtir.insertRow();
        //             filaExistente.setAttribute('id', `surtir-${producto.id_detail || producto.SKU}`);
        //         }

        //         let pricePublicNum = parseFloat(producto.price_public);
        //         let uniqueId = `${producto.id_detail}_${Date.now()}`;

        //         let totalId = `total_${uniqueId}`;
        //         let priceId = `price_${uniqueId}`;
        //         let quantityId = `quantity_${uniqueId}`;
        //         let discountId = `discount_${uniqueId}`;
        //         let reservationCodeId = `reservation_code_${uniqueId}`;

        //         filaExistente.innerHTML = `
        // <td>${producto.SKU} / ${producto.ISBN}</td>
        // <td>${producto.description}</td>
        // <td>
        //     <div class="input-group">
        //         <div class="input-group-prepend">
        //             <span class="input-group-text">$</span>
        //         </div>
        //         <input type="number" class="form-control price_public" id="${priceId}" name="price_${uniqueId}" value="${pricePublicNum.toFixed(2)}" >
        //     </div>
        // </td>
        // <td>
        //     <input type="number" class="form-control quantity" id="${quantityId}" name="quantity_${uniqueId}" value="${toSupply}" required>
        // </td>
        // <td>
        //     <input type="number" class="form-control discount" id="${discountId}" name="discount_${uniqueId}" value="${descuento}" required>
        // </td>
        // <td id="${totalId}">$${(pricePublicNum * toSupply * (100 - descuento) / 100).toFixed(2)}</td>
        // <td>
        //     <input type="text" class="form-control publisher-select" name="publisher_${uniqueId}" value="${producto.publisher}" required>
        // </td>
        // <td><input type="text" class="form-control" id="${reservationCodeId}" name="reservation_code_${uniqueId}"></td>
        // <td>
        //     <input type="text" class="form-control" name="nota" placeholder="Ingrese nota aquí">
        // </td>
        // `;

        //         filaExistente.querySelector(`#${priceId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
        //         filaExistente.querySelector(`#${quantityId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
        //         filaExistente.querySelector(`#${discountId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
        //     } else if (filaExistente) {
        //         filaExistente.remove();
        //     }
        // }
        function updatePedidosPorSurtir(producto, toSupply, descuento) {
            let tablaSurtir = document.getElementById('pedidosPorSurtir').getElementsByTagName('tbody')[0];
            let filaExistente = document.getElementById(`surtir-${producto.id_detail || producto.SKU}`);

            if (toSupply > 0) {
                if (!filaExistente) {
                    filaExistente = tablaSurtir.insertRow();
                    filaExistente.setAttribute('id', `surtir-${producto.id_detail || producto.SKU}`);
                }

                let pricePublicNum = parseFloat(producto.price_public);
                let uniqueId = `${producto.id_detail}_${Date.now()}`;

                let totalId = `total_${uniqueId}`;
                let priceId = `price_${uniqueId}`;
                let quantityId = `quantity_${uniqueId}`;
                let discountId = `discount_${uniqueId}`;
                let reservationCodeId = `reservation_code_${uniqueId}`;

                filaExistente.innerHTML = `
            <td>${producto.SKU} / ${producto.ISBN}</td>
            <td>${producto.description}</td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control price_public" id="${priceId}" name="price_${uniqueId}" value="${pricePublicNum.toFixed(2)}" step="any" required>
                </div>
            </td>
            <td>
                <input type="number" class="form-control quantity" id="${quantityId}" name="quantity_${uniqueId}" value="${toSupply}" required>
            </td>
            <td>
                <input type="number" class="form-control discount" id="${discountId}" name="discount_${uniqueId}" value="${descuento}" required>
            </td>
            <td id="${totalId}">$${(pricePublicNum * toSupply * (100 - descuento) / 100).toFixed(2)}</td>
            <td>${generarSelectPublisher(producto.publisher)}</td>
            <td><input type="text" class="form-control" id="${reservationCodeId}" name="reservation_code_${uniqueId}"></td>
            <td>
                <input type="text" class="form-control" name="nota_${uniqueId}" placeholder="Ingrese nota aquí">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-secondary" onclick="duplicateRow('${uniqueId}');">Duplicar</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeRow('${uniqueId}');">Eliminar</button>
            </td>
        `;

                filaExistente.querySelector(`#${priceId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
                filaExistente.querySelector(`#${quantityId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
                filaExistente.querySelector(`#${discountId}`).addEventListener('input', () => updateRow(priceId, quantityId, totalId, '', '', producto.stock, producto, descuento));
            } else if (filaExistente) {
                filaExistente.remove();
            }
        }



        // Además, vincula el evento de cambio en los selects de descuentos
        // event listener para los select de descuentos esté configurado correctamente para actualizar el total cuando el valor del descuento cambie:
        // document.querySelectorAll('.discounts-select').forEach(select => {
        //     select.addEventListener('change', function() {
        //         let row = this.closest('tr');
        //         let priceId = row.querySelector('.price_public').id;
        //         let quantityId = row.querySelector('.quantity').id;
        //         let totalId = row.querySelector('[id^="total"]').id;
        //         let toSupplyId = row.querySelector('[id^="toSupply"]').id;
        //         let stockId = row.querySelector('[id^="stock"]').id;
        //         let originalStock = parseInt(row.querySelector('[id^="stock"]').innerText);
        //         let producto = {
        //             id_detail: row.querySelector('input[type="hidden"]').value,
        //             stock: originalStock
        //         };
        //         updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, this.value);
        //     });
        // });
        document.querySelectorAll('.discounts-select').forEach(select => {
            select.addEventListener('change', function() {
                let row = this.closest('tr');
                let priceId = row.querySelector('.price_public').id;
                let quantityId = row.querySelector('.quantity').id;
                let totalId = row.querySelector('[id^="total"]').id;
                let toSupplyId = row.querySelector('[id^="toSupply"]').id;
                let stockId = row.querySelector('[id^="stock"]').id;
                let originalStock = parseInt(row.querySelector('[id^="stock"]').innerText);
                let producto = {
                    id_detail: row.querySelector('input[type="hidden"]').value,
                    stock: originalStock
                };
                updateRow(priceId, quantityId, totalId, toSupplyId, stockId, originalStock, producto, this.value);
            });
        });






        // Calcula el total actualziado
        // function calculateTotal(idDetail) {
        //     let price = parseFloat(document.getElementById(`price_${idDetail}`).value);
        //     let quantity = parseInt(document.getElementById(`quantity_${idDetail}`).value);
        //     let discount = parseFloat(document.getElementById(`discount_${idDetail}`).value) || 0;
        //     let total = price * quantity * (100 - discount) / 100;
        //     document.getElementById(`total_${idDetail}`).innerText = `$${total.toFixed(2)}`;
        // }
        function calculateTotal(idDetail) {
            let price = parseFloat(document.getElementById(`price_${idDetail}`).value);
            let quantity = parseInt(document.getElementById(`quantity_${idDetail}`).value);
            let discount = parseFloat(document.getElementById(`discount_${idDetail}`).value) || 0;
            let total = price * quantity * (100 - discount) / 100;
            document.getElementById(`total_${idDetail}`).innerText = `$${total.toFixed(2)}`;
        }


        // Duplicar renglón       
        // function duplicateRow(detailId) {
        //     let originalRow = document.getElementById(`surtir-${detailId}`);
        //     if (!originalRow) return;

        //     let newRow = originalRow.cloneNode(true); // Duplica toda la fila

        //     let newIdDetail = `${detailId}_${Date.now()}`;
        //     newRow.setAttribute('id', `surtir-${newIdDetail}`);

        //     newRow.querySelectorAll('[id]').forEach(element => {
        //         let baseId = element.id.split('_')[0];
        //         element.id = `${baseId}_${newIdDetail}`;
        //         element.name = `${baseId}_${newIdDetail}`;

        //         if (element.type === 'number') {
        //             element.value = element.value;
        //         }
        //     });

        //     newRow.querySelector(`#price_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
        //     newRow.querySelector(`#quantity_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
        //     newRow.querySelector(`#discount_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));

        //     newRow.querySelector('.btn-secondary').setAttribute('onclick', `duplicateRow('${newIdDetail}');`);
        //     newRow.querySelector('.btn-danger').setAttribute('onclick', `removeRow('${newIdDetail}');`);

        //     originalRow.parentNode.insertBefore(newRow, originalRow.nextSibling);
        // }
        function duplicateRow(detailId) {
            let originalRow = document.getElementById(`surtir-${detailId}`);
            if (!originalRow) return;

            let newRow = originalRow.cloneNode(true); // Duplica toda la fila

            let newIdDetail = `${detailId}_${Date.now()}`;
            newRow.setAttribute('id', `surtir-${newIdDetail}`);

            newRow.querySelectorAll('[id]').forEach(element => {
                let baseId = element.id.split('_')[0];
                element.id = `${baseId}_${newIdDetail}`;
                element.name = `${baseId}_${newIdDetail}`;

                if (element.type === 'number') {
                    element.value = element.value;
                }
            });

            newRow.querySelector(`#price_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
            newRow.querySelector(`#quantity_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));
            newRow.querySelector(`#discount_${newIdDetail}`).addEventListener('input', () => calculateTotal(newIdDetail));

            newRow.querySelector('.btn-secondary').setAttribute('onclick', `duplicateRow('${newIdDetail}');`);
            newRow.querySelector('.btn-danger').setAttribute('onclick', `removeRow('${newIdDetail}');`);

            originalRow.parentNode.insertBefore(newRow, originalRow.nextSibling);
        }




        // Nueva función para Eliminar Renglón
        function removeRow(detailId) {
            let row = document.getElementById(`surtir-${detailId}`);
            if (row) {
                row.parentNode.removeChild(row);
            }
        }


        // Función para  para seleccionar al proveedor
        // function generarSelectPublisher(publisherActual) {
        //     const publishers = ["ARIEL", "CLC", "ARCOIRIS", "MARANATHA MAQ", "MARANATHA BOLIVAR", "PAPIRO 52", "ARIEL MTY"];
        //     let selectHTML = `<select class="form-control publisher-select">`;

        //     publishers.forEach(publisher => {
        //         selectHTML += `<option value="${publisher}" ${publisher === publisherActual ? 'selected' : ''}>${publisher}</option>`;
        //     });

        //     selectHTML += `</select>`;
        //     return selectHTML;
        // }
        function generarSelectPublisher(publisherActual) {
            const publishers = ["ARIEL", "CLC", "ARCOIRIS", "MARANATHA MAQ", "MARANATHA BOLIVAR", "PAPIRO 52", "ARIEL MTY"];
            let selectHTML = `<select class="form-control publisher-select">`;

            publishers.forEach(publisher => {
                selectHTML += `<option value="${publisher}" ${publisher === publisherActual ? 'selected' : ''}>${publisher}</option>`;
            });

            selectHTML += `</select>`;
            return selectHTML;
        }


        // Función para seleccionar descuento
        // function seleccionaDescuento(descuentoActual) {
        //     const descuentos = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65];
        //     let selectHTML = `<select class="form-control discounts-select">`;
        //     descuentos.forEach(descuento => {
        //         selectHTML += `<option value="${descuento}" ${descuento === descuentoActual ? 'selected' : ''}>${descuento}</option>`;
        //     });

        //     selectHTML += `</select>`;
        //     return selectHTML;
        // }
        function seleccionaDescuento(descuentoActual) {
            const descuentos = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65];
            let selectHTML = `<select class="form-control discounts-select">`;
            descuentos.forEach(descuento => {
                selectHTML += `<option value="${descuento}" ${descuento === descuentoActual ? 'selected' : ''}>${descuento}</option>`;
            });

            selectHTML += `</select>`;
            return selectHTML;
        }



        // Código modificado para el FORM 
        // Manejar el envío del formulario
        // document.getElementById('formCrearSolicitud').addEventListener('submit', function(event) {
        //     event.preventDefault();

        //     let productos = [];

        //     // Recorre cada fila de productos y crea un objeto para cada producto
        //     let tablaProductos = document.querySelectorAll('#tablaProductos tbody tr');
        //     tablaProductos.forEach((fila, index) => {
        //         let producto = {};
        //         let SKUCell = fila.querySelector('td:nth-child(1)');
        //         let descriptionCell = fila.querySelector('td:nth-child(2)');
        //         let priceInput = fila.querySelector('.price_public');
        //         let quantityInput = fila.querySelector('.quantity');
        //         let discountSelect = fila.querySelector('.discounts-select');
        //         let totalCell = fila.querySelector(`#total-${index}`);
        //         let publisherCell = fila.querySelector('td:nth-child(9)');
        //         let reservationCodeInput = fila.querySelector(`#reservation_code-${index}`);

        //         if (SKUCell && descriptionCell && priceInput && quantityInput && discountSelect && totalCell && publisherCell && reservationCodeInput) {
        //             producto.SKU = SKUCell.textContent.trim();
        //             producto.description = descriptionCell.textContent.trim();
        //             producto.price_public = priceInput.value;
        //             producto.quantity = quantityInput.value;
        //             producto.discount = discountSelect.value;
        //             producto.total = totalCell.textContent.replace('$', '').trim();
        //             producto.publisher = publisherCell.textContent.trim();
        //             producto.reservation_code = reservationCodeInput.value;
        //             producto.note = fila.querySelector('input[name="nota"]') ? fila.querySelector('input[name="nota"]').value : '';
        //             productos.push(producto);
        //         }
        //     });

        //     // Recorre cada fila de "Pedidos por surtir" y crea un objeto para cada producto
        //     let tablaSurtir = document.querySelectorAll('#pedidosPorSurtir tbody tr');
        //     tablaSurtir.forEach((fila, index) => {
        //         let producto = {};
        //         let SKUCell = fila.querySelector('td:nth-child(1)');
        //         let descriptionCell = fila.querySelector('td:nth-child(2)');
        //         let priceInput = fila.querySelector('.price_public');
        //         let quantityInput = fila.querySelector('.quantity');
        //         let discountInput = fila.querySelector('.discount');
        //         let totalCell = fila.querySelector(`#total_${index}`);
        //         let publisherSelect = fila.querySelector('.publisher-select');
        //         let noteInput = fila.querySelector('input[name="nota"]');

        //         if (SKUCell && descriptionCell && priceInput && quantityInput && discountInput && totalCell && publisherSelect && noteInput) {
        //             producto.SKU = SKUCell.textContent.trim();
        //             producto.description = descriptionCell.textContent.trim();
        //             producto.price_public = priceInput.value;
        //             producto.quantity = quantityInput.value;
        //             producto.discount = discountInput.value;
        //             producto.total = totalCell.textContent.replace('$', '').trim();
        //             producto.publisher = publisherSelect.value;
        //             producto.reservation_code = ''; // No hay campo de reservation_code en "Pedidos por surtir"
        //             producto.note = noteInput.value;
        //             productos.push(producto);
        //         }
        //     });

        //     fetch('includes/guardarSolicitudEditada.php', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify({
        //                 id_order: idPedido,
        //                 productos
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 Swal.fire('Éxito', 'Datos guardados correctamente', 'success');
        //             } else {
        //                 Swal.fire('Error', 'Error al guardar los datos: ' + (data.message || 'Error desconocido'), 'error');
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             Swal.fire('Error', 'Error de comunicación con el servidor', 'error');
        //         });
        // });
    </script> -->








    </html>

<?php
}//termina else