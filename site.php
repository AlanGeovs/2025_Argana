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
            <div class="container-fluid relative animatedParent animateOnce my-3">
                <!-- <div class="row row-eq-height my-3 mt-3">
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3 bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <?php
                                            $respuesta = Consultas::listarEncuestasCapturista($_SESSION["idUser"]);
                                            ?>

                                            <div class="text-success"><i class="icon-data_usage s-48"></i></div>

                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-48 my-3 font-weight-lighter"><?php echo count($respuesta); ?></span><br>
                                            </div>
                                            Clientes activos
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <?php
                            if ($_SESSION["tipoUsuario"] == "admin") {
                            ?>

                                <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <?php
                                                $totalEncuestas = Consultas::cuentaEncuestas();

                                                //                                                $totalCategorias = Consultas::listarCategorias();

                                                //                                                $datosGrafica = count($totalMarcas) . "," . count($totalUsuarios) . "," . count($totalCategorias);
                                                $datosGrafica = "50" . "," . "60";

                                                //                                                $totalREst[]= Consultas::listarCategorias();
                                                //                                                echo "Datos ".$totalREst[0][1];
                                                ?>
                                                <div><i class="icon-user-plus s-48  "></i></div> 
                                            </div>
                                            <div class="text-center">
                                                <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalEncuestas); ?>
                                                </div>
                                                Total de clientes registrados
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <?php
                        if ($_SESSION["tipoUsuario"] == "admin") {
                        ?>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <div><i class="icon-vcard s-48"></i></div> 
                                            </div>
                                            <div class="text-center">
                                                <?php
                                                $totalCapturistas = Consultas::listarCapturistas();
                                                ?>
                                                <div class="s-48 my-3 font-weight-lighter">
                                                    <?php echo count($totalCapturistas); ?></div>
                                                Operaciones realizadas
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <div><i class="icon-group_add s-48"></i></div> 
                                            </div>

                                            <div class="text-center">
                                                <?php
                                                $totalUsuarios = Consultas::listarUsuarios();
                                                ?>
                                                <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalUsuarios); ?>
                                                </div>
                                                Usuarios del sistema
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        <?php
                        }
                        ?> 

                    </div>

                   Grafica de pastel 
                    <?php
                    if ($_SESSION["tipoUsuario"] == "admin") {
                        $porGenero = Consultas::encuestadosGenero();
                        $hombres = $porGenero[0]['TOTAL'];
                        $mujeres = $porGenero[1]['TOTAL'];
                        // print_r($porGenero);
                    ?>
                        <div class="col-md-6">
                            <div class="card no-b p-2">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="height-300">
                                            <canvas data-chart="chartJs" data-chart-type="doughnut" data-dataset="[
                                                [100, 150]
                                                
                                                ]" data-labels="[['Clientes Activos'],['Inactivos'] ]" data-dataset-options="[
                                                {
                                                label: 'Totales',
                                                backgroundColor: [
                                                '#03a9f4',
                                                '#8f5caf',
                                                '#3f51b5'
                                                ],

                                                },


                                                ]" data-options="{legend: {display: !0,position: 'bottom',labels: {fontColor: '#7F8FA4',usePointStyle: !0}},
                                                }">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='registrar_cliente.php'">
                                    <i class="icon-plus mr-2"></i> Agregar cliente</button>
                            </div>
                            <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='registrar_producto.php'">
                                    <i class="icon-plus mr-2"></i> Agregar producto</button>
                            </div>

                          descargar base de datos  
                            <?php
                            if ($_SESSION["tipoUsuario"] == "admin") {
                            ?>
                                <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                    <button type="button" class="btn btn-info btn-lg btn-block" onclick="window.location.href='includes/exporta.php'">
                                        <i class="icon-download mr-2"></i> Descargar datos de clientes</button>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    <?php
                    }
                    ?>



                </div> -->

                <div class="row row-eq-height my-3 mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3 bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="icon-verified_user s-48"></i></div>
                                        </div>
                                        <div class="text-center">
                                            <div><span id="clientes-activos" class="s-48 my-3 font-weight-lighter">0</span><br>
                                            </div>
                                            Clientes activos
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="icon-users s-48"></i></div>
                                        </div>
                                        <div class="text-center">
                                            <div><span id="total-clientes" class="s-48 my-3 font-weight-lighter">0</span><br>
                                            </div>
                                            Total de clientes registrados
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="icon-note-list2 s-48"></i></div>
                                        </div>
                                        <div class="text-center">
                                            <div><span id="total-operaciones" class="s-48 my-3 font-weight-lighter">0</span>
                                            </div>
                                            <br>
                                            Operaciones realizadas
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Usuarios del sistema -->
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div><i class="icon-user-circle s-48"></i></div>
                                        </div>

                                        <div class="text-center">
                                            <?php
                                            $totalUsuarios = Consultas::listarUsuarios();
                                            ?>
                                            <div class="s-48 my-3 font-weight-lighter"><?php echo count($totalUsuarios); ?>
                                            </div>
                                            Usuarios del sistema
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Gráfica -->
                            <div class="col-md-6 col-sm-6">
                                <div class="card no-b mb-3">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <canvas id="clientsChart" height="200"></canvas>
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


        <!--/#app -->
        <script src="assets/js/app.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Cargar los Datos -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('includes/dashboard_data.php')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('clientes-activos').textContent = data.clientesActivos;
                        document.getElementById('total-clientes').textContent = data.totalClientes;
                        document.getElementById('total-operaciones').textContent = data.totalOperaciones;

                        // Actualizar gráfica de pastel
                        var ctx = document.getElementById('clientsChart').getContext('2d');
                        var clientsChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Clientes Activos', 'Inactivos'],
                                datasets: [{
                                    data: [data.clientesActivos, data.totalClientes - data.clientesActivos],
                                    backgroundColor: ['#03a9f4', '#8f5caf'],
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    position: 'bottom',
                                },
                                title: {
                                    display: true,
                                    text: 'Distribución de Clientes'
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>


    </body>

    </html>

<?php
}//termina else