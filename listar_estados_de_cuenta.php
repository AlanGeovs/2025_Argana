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


            <div class="container animatedParent animateOnce">
                <div class="invoice white shadow">
                    <div class="p-5">
                        <div class="row">
                            <div class="col-12">
                                <h4>Estado de Cuenta</h4><br>
                                <button type="button" class="btn btn-primary" onclick="window.location.href='generar_pdf.php?u=<?= $_GET['u']; ?>'">
                                    Descargar PDF
                                </button>

                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-normal">Nombre de cliente:</td>
                                            <td id="name">Cargando...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-normal">ID de Usuario:</td>
                                            <td id="id_user">Cargando...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-normal">Clave de cliente:</td>
                                            <td id="username">Cargando...</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-normal">Fecha del estado de cuenta:</td>
                                            <td id="date_transaction">Cargando...</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row my-3 ">
                            <div class="col-12">
                                <h5>Detalles de Transacciones</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tipo de Operación</th>
                                                <th>Nombre de la Transacción</th>
                                                <th>Fecha</th>
                                                <th>Ventas en Intercambio</th>
                                                <th>Ventas en Efectivo</th>
                                                <th>Compras en Intercambio</th>
                                                <th>Compras en Efectivo</th>
                                                <th>Comisión en Intercambio</th>
                                                <th>Comisión en Efectivo</th>
                                                <th>Balance en Intercambio</th>
                                                <th>Balance en Efectivo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="balance-table-body">
                                            <!-- Datos de balances se cargarán aquí -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- fin app -->
        </div>

        <!-- modales -->




        <!-- <?php //include 'right_sidebar_bitacora.php'; 
                ?> -->

        <!--/#app -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Script para obtener los estados de cuenta de un usuario    --------------------------- -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                const userId = urlParams.get('u');

                if (userId) {
                    fetch(`includes/obtener_balance.php?u=${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                document.getElementById('name').textContent = data[0].trading_name;
                                document.getElementById('username').textContent = data[0].username;
                                document.getElementById('id_user').textContent = data[0].id_user;
                                document.getElementById('date_transaction').textContent = data[0].date_transaction;

                                // Opcional: puedes agregar un campo para el email en el HTML y mostrarlo aquí
                                const emailElement = document.createElement('tr');
                                emailElement.innerHTML = `<td class="font-weight-normal">Correo Electrónico:</td><td>${data[0].email}</td>`;
                                document.querySelector('table tbody').appendChild(emailElement);

                                const tbody = document.getElementById('balance-table-body');
                                tbody.innerHTML = '';

                                let totalTradeBalance = 0;
                                let totalCashBalance = 0;

                                data.forEach(balance => {
                                    totalTradeBalance += parseFloat(balance.trade_balance);
                                    totalCashBalance += parseFloat(balance.cash_balance);

                                    const tr = document.createElement('tr');
                                    tr.innerHTML = `
                                <td>${balance.type_operation}</td>
                                <td>${balance.name_transaction}</td>
                                <td>${balance.date_transaction}</td>
                                <td>$${parseFloat(balance.trade_sales).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.cash_sales).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.trade_purchases).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.cash_purchases).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.trade_commission).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.cash_commission).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.trade_balance).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>$${parseFloat(balance.cash_balance).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            `;
                                    tbody.appendChild(tr);
                                });

                                // Agregar fila para mostrar el total
                                const totalRow = document.createElement('tr');
                                totalRow.innerHTML = `
                            <td colspan="9" class="text-right"><strong>Total</strong></td>
                            <td><strong>$${totalTradeBalance.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong></td>
                            <td><strong>$${totalCashBalance.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong></td>
                        `;
                                tbody.appendChild(totalRow);
                            } else {
                                alert('No se encontraron datos para este usuario.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    alert('ID de usuario no proporcionado en la URL.');
                }
            });
        </script>




        <!--/#app -->
        <script src="assets/js/app.js"></script>
    </body>

    </html>

<?php
}//termina else