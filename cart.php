<?php
session_start();

require_once "model/model.php";
require_once "model/carrito.php";

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
            <?php include "menu.php" ?>


            <!-- Inicia recibo -->
            <div class="container animatedParent animateOnce">
                <div class="invoice white shadow">
                    <div class="p-5">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <img class="w-80px mb-4" src="assets/img/dummy/bootstrap-social-logo.png" alt="">
                                <div class="float-right">
                                    <h4>Pedido #007612</h4><br>
                                    <table>
                                        <tr>
                                            <td class="font-weight-normal">fecha:</td>
                                            <td>2/10/2024</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-normal">Orden ID:</td>
                                            <td>4F3S8J</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-normal">Cliente:</td>
                                            <td>968-34567</td>
                                        </tr>
                                    </table>

                                </div>

                            </div>
                            <!-- /.col -->
                        </div>

                        <!-- info row -->
                        <!-- <div class="row my-3 ">
                    <div class="col-sm-4">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div> 
                    <div class="col-sm-4">
                        To
                        <address>
                            <strong>John Doe</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                    </div> 
                    <div class="col-sm-4">

                    </div> 
                </div> -->
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row my-3">
                            <div class="col-12 table-responsive">
                                <?php
                                $productosCarrito = Carrito::obtenerProductosCarrito($idSesion);

                                echo '<table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>ISBN</th>
                                                <th>Título</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                foreach ($productosCarrito as $producto) {
                                    // Asume que $producto contiene 'cantidad', 'nombre', 'ISBN', 'descripcion' y 'precio'
                                    $subtotal = $producto['cantidad'] * $producto['price_public']; // Calcula el subtotal por producto
                                    echo '<tr>
                                            <td>' . htmlspecialchars($producto['cantidad']) . '</td>
                                            <td>' . htmlspecialchars($producto['description']) . '</td>
                                            <td>' . htmlspecialchars($producto['ISBN']) . '</td>
                                            <td>' . htmlspecialchars($producto['descripcion']) . '</td>
                                            <td>$' . number_format($subtotal, 2) . '</td>
                                        </tr>';
                                }

                                echo '    </tbody>
                                    </table>';
                                ?>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <!-- <div class="col-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="assets/img/basic/visa.png" alt="Visa">
                        <img src="assets/img/basic/mastercard.png" alt="Mastercard">
                        <img src="assets/img/basic/american-express.png" alt="American Express">
                        <img src="assets/img/basic/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm no-shadow mt-3" >
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango
                            imeem plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div> -->
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Pedido creado el 2/22/2024</p>

                                <div class="table-responsive">
                                    <?php
                                    $productosCarrito = Carrito::obtenerProductosCarrito($idSesion);

                                    $subtotal = 0;

                                    foreach ($productosCarrito as $producto) {
                                        $subtotal += $producto['cantidad'] * $producto['price_public']; // Suma el subtotal de cada producto
                                    }

                                    $envio = 0.00; // Costo de envío
                                    $total = $subtotal + $envio; // Total final

                                    echo '<table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$' . number_format($subtotal, 2) . '</td>
                                            </tr>
                                            <tr>
                                                <th>Envío:</th>
                                                <td>$' . number_format($envio, 2) . ' (Por definir)</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$' . number_format($total, 2) . '</td>
                                            </tr>
                                        </tbody>
                                    </table>';
                                    ?>

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <!-- <a href="invoice-print.html" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i> Print</a> -->
                                <button type="button" class="btn btn-success btn-lg  float-right"><i class="icon icon-credit-card"></i> Generar solicitud
                                </button>
                                <!-- <button type="button" class="btn btn-primary btn-lg float-right mr-2">
                                    <i class="icon icon-cloud-download"></i> Generar PDF
                                </button> -->
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


        <!--/#app -->
        <script src="assets/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <!-- Scripts -->
        <!-- Función para el botón clic de Generar Solcititud -->
        <script>
            document.querySelector('.btn-success').addEventListener('click', function() {
                swal({
                        title: "¿Estás seguro?",
                        text: "Una vez generado el pedido, no podrás editar el carrito.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willGenerate) => {
                        if (willGenerate) {
                            generarPedido();
                        } else {
                            swal("El pedido no ha sido generado.");
                        }
                    });
            });

            function generarPedido() {
                fetch('includes/generarPedido.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: "idUsuario=" + encodeURIComponent(<?php echo $_SESSION["idUser"]; ?>)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal("¡Pedido generado!", "Tu pedido ha sido generado con éxito.", "success");
                            // Aquí podrías redirigir al usuario o actualizar la UI
                        } else {
                            swal("Error", "No se pudo generar el pedido: " + data.message, "error");
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