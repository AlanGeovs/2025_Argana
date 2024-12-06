<?php
session_start();

require_once "model/model.php";
require_once "model/carrito.php";
require_once "model/Stats.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
    exit;
} else {
    $totalArticulos = Stats::getTotalArticulos();
    $totalBiblias = Stats::getTotalArticulosPorCategoria('Biblias');
    $totalRegalos = Stats::getTotalArticulosPorCategoria('Regalos');
    $totalLibros = Stats::getTotalArticulosPorCategoria('Libros');
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
                <div class="row row-eq-height my-3 mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <!-- Botón -->
                            <!-- <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='registrar_encuesta.php'">
                                    <i class="icon-plus mr-2"></i> Agregar cliente</button>
                            </div> -->


                            <div class="col-md-6 col-sm-6">


                                <div class="card no-b mb-3 bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <!--<div><i class="icon-package s-18"></i></div>-->
                                            <div class="text-success"><i class="icon-data_usage s-48"></i></div>

                                        </div>
                                        <div class="text-center">
                                            <div><span class="s-48 my-3 font-weight-lighter"><?= $totalArticulos ?></span><br>
                                            </div>
                                            <h2>Total de Productos</h2>
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

                                                <div><i class="icon-book-bookmark2 s-48  "></i></div>
                                                <!--<div><span class="text-danger">50</span></div>-->
                                            </div>
                                            <div class="text-center">
                                                <div class="s-48 my-3 font-weight-lighter"><?= $totalBiblias ?>
                                                </div>
                                                Biblias
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

                                                <div><i class="icon-book s-48"></i></div>
                                                <!--<div><span class="badge badge-pill badge-danger">4:30</span></div>-->
                                            </div>
                                            <div class="text-center">

                                                <div class="s-48 my-3 font-weight-lighter"><?= $totalLibros ?></div>
                                                Libros
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-6">
                                    <div class="card no-b mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <div><i class="icon-gift s-48"></i></div>
                                                <!--<div><span class="badge badge-pill badge-primary">4:30</span></div>-->
                                            </div>

                                            <div class="text-center">
                                                <div class="s-48 my-3 font-weight-lighter"><?= $totalRegalos ?>
                                                </div>
                                                Regalos
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        <?php
                        }
                        ?>
                        <!--Contadores-->

                    </div>

                    <!-- Grafica de pastel -->
                    <?php
                    if ($_SESSION["tipoUsuario"] == "admin") {

                    ?>
                        <div class="col-md-6">
                            <div class="card no-b p-2 b-2">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="height-300">
                                            <canvas data-chart="chartJs" data-chart-type="doughnut" data-dataset="[
                                                [<?= $totalLibros ?>, <?= $totalBiblias ?>, <?= $totalRegalos ?>]
                                                
                                                ]" data-labels="[['Libros'],['Biblias'],['Regalos']]" data-dataset-options="[
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
                            <!-- descargar base de datos  -->
                            <?php
                            if ($_SESSION["tipoUsuario"] == "admin") {
                            ?>
                                <div class="col-md-12 col-sm-12 p-2" style="padding-bottom: 15px;">
                                    <button type="button" class="btn btn-info btn-lg btn-block" id="update-button">
                                        <i class="icon-update mr-2"></i> Actualizar base de datos
                                    </button>
                                </div>
                            <?php
                            }
                            ?>


                        </div>
                    <?php
                    }
                    ?>

                </div>
                <!--<div class="card no-b my-3">
                        <div class="card-body">
                            <div class="my-2 height-300">
                                <canvas
                                        data-chart="bar"
                                        data-dataset="[
                                                    [21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12,21, 90, 55, 0, 59, 77, 12],
                                                    [12, 40, 16, 17, 89, 0, 12,12, 0, 55, 60, 79, 99, 12,12, 0, 55, 60, 79, 99, 12],
                                                    [12, 40, 16, 17, 89, 0,12, 40, 16, 17, 89, 0, 12,12, 40, 16, 17, 89, 0, 12],
                                                    ]"
                                        data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo','Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                        data-dataset-options="[
                                                {
                                                    label: 'HTML',
                                                    backgroundColor: '#7986cb',
                                                    borderWidth: 0,
            
                                                },
                                                {
                                                     label: 'Wordpress',
                                                     backgroundColor: '#88e2ff',
                                                     borderWidth: 0,
            
                                                 },
                                                {
                                                      label: 'Laravel',
                                                      backgroundColor: '#e2e8f0',
                                                      borderWidth: 0,
            
                                                  }
                                                ]"
                                        data-options="{
                                                  legend: { display: true,},
                                                  scales: {
                                                    xAxes: [{
                                                        stacked: true,
                                                         barThickness:5,
                                                         gridLines: {
                                                            zeroLineColor: 'rgba(255,255,255,0.1)',
                                                             color: 'rgba(255,255,255,0.1)',
                                                             display: false,},
                                                         }],
                                                    yAxes: [{
                                                            stacked: true,
                                                                 gridLines: {
                                                                    zeroLineColor: 'rgba(255,255,255,0.1)',
                                                                    color: 'rgba(255,255,255,0.1)',
                                                                }
                                                   }]
            
                                                  }
                                            }"
                                >
                                </canvas>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row my-3 no-gutters">
                                <div class="col-md-3">
                                    <h1>Tasks</h1>
                                    Currently assigned tasks to team.
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u12.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u2.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-indigo" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <div class="avatar-group">
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u4.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u11.png" alt=""></figure>
                                                    <figure class="avatar">
                                                        <img src="assets/img/dummy/u1.png" alt=""></figure>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar yellow" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <h6>New Layout</h6>
                                                    <small>75% Completed</small>
                                                </div>
                                                <figure class="avatar">
                                                    <img src="assets/img/dummy/u5.png" alt=""></figure>
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"
                                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                <!--<div class=" row my-3">
                        <div class="col-md-6">
                            <div class=" card b-0">
                                <div class="card-body p-5">
                                    <canvas id="gradientChart" width="600" height="340"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" card no-b">
                                <div class="card-body">
                                    <table class="table table-hover earning-box">
                                        <tbody>
                                        <tr class="no-b">
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u6.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u9.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u11.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u12.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10">
                                                <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                    <img src="assets/img/dummy/u5.png" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <h6>Sara Kamzoon</h6>
                                                <small class="text-muted">Marketing Manager</small>
                                            </td>
                                            <td>25</td>
                                            <td>$250</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->

            </div>
        </div>
        <!-- Right Sidebar -->
        <?php include_once "right_sidebar_cart.php"; ?>
        <!-- End Right Sidebar -->

    </body>

    <!--/#app -->
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Actualziar DB  -->
    <script>
        document.getElementById('update-button').addEventListener('click', function() {
            Swal.fire({
                title: 'Actualizando...',
                text: 'Por favor espere mientras se actualiza la base de datos',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            fetch('includes/importar_datos_json.php')
                .then(response => response.text()) // Cambiado a text() para depuración
                .then(text => {
                    console.log('Response text:', text); // Mostrar la respuesta en la consola
                    try {
                        const data = JSON.parse(text); // Convertir el texto en JSON
                        if (data.success) {
                            Swal.fire({
                                title: 'Actualización Completa',
                                text: `Se actualizaron ${data.updatedRows} filas correctamente.`,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Recargar la página al cerrar el swal de éxito
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message || 'Hubo un problema al actualizar la base de datos.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al procesar la respuesta del servidor.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al actualizar la base de datos.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>

    </html>

<?php
}//termina else