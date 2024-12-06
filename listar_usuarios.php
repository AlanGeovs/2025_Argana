<?php
session_start();

require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
}

if ($_SESSION["tipoUsuario"] == "capturista") {
    header("Location: site.php");
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
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <!-- Código del formulario -->
                                    <form>
                                        <table class="table table-striped table-hover r-0">
                                            <thead>
                                                <tr class="no-b">
                                                    <th style="width: 30px">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" id="checkedAll" class="custom-control-input"><label class="custom-control-label" for="checkedAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Usuario</th>
                                                    <th>
                                                        <div class="d-none d-lg-block">Télefono</div>
                                                    </th>
                                                    <th>
                                                        <div class="d-none d-lg-block">Role</div>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $respuesta = Consultas::listarUsuarios();
                                                for ($i = 0; $i < count($respuesta); $i++) {
                                                    echo '<tr id="eliminar' . $respuesta[$i]["id"] . '">
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input checkSingle" id="user_id_' . $respuesta[$i]["id"] . '" required><label class="custom-control-label" for="user_id_' . $respuesta[$i]["id"] . '"></label>
                    </div>
                </td>
                <td>
                    <div class="d-flex">
                        <div class="avatar avatar-md mr-3 mb-2 mt-1">
                            <span class="avatar-letter avatar-letter-' . substr($respuesta[$i]["usuario"], 0, 1) . ' avatar-md circle"></span>
                        </div>
                        <div>
                            <div>
                                <strong>' . $respuesta[$i]["usuario"] . '</strong>
                            </div>
                            <small> ' . $respuesta[$i]["correo"] . '</small>
                        </div>
                    </div>
                </td>
                <td> <div class="d-none d-lg-block">' . $respuesta[$i]["telefono"] . '</div></td>
                <td> <div class="d-none d-lg-block">';

                                                    if ($respuesta[$i]["tipo"] == "admin") {
                                                        echo '<span class="r-3 badge badge-success ">Administrador</span>';
                                                    } elseif ($respuesta[$i]["tipo"] == "supervisor") {
                                                        echo '<span class="r-3 badge badge-warning ">Supervisor </span>';
                                                    } elseif ($respuesta[$i]["tipo"] == "asesor") {
                                                        echo '<span class="r-3 badge badge-primary ">Asesor </span>';
                                                    } elseif ($respuesta[$i]["tipo"] == "cliente") {
                                                        echo '<span class="r-3 badge badge-secondary ">Cliente </span>';
                                                    }

                                                    echo '</div></td>';


                                                    echo '<td>';

                                                    // Botón para abrir modal solo para admin
                                                    if ($_SESSION["tipoUsuario"] == "admin") {
                                                        echo '<a href="#" onclick="abrirModalEditar(' . $respuesta[$i]["id"] . ', \'' . $respuesta[$i]["tipo"] . '\')" data-toggle="modal" data-target="#editarUsuarioModal"><i class="icon-pencil mr-3"></i></a>';
                                                        // echo '<a href="#" onclick="abrirModalEditarUsuario(' . $respuesta[$i]["id"] . ', \'' . $respuesta[$i]["tipo"] . '\')" data-toggle="modal" data-target="#editarUsuarioModal"><i class="icon-pencil mr-3"></i></a>';
                                                    }

                                                    echo '<a onclick="eliminarUsuario(' . $respuesta[$i]["id"] . ');"><i class="icon-trash mr-3"></i></a>
                                                    </td>
                </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="my-3" aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane animated fadeInUpShort" id="v-pills-buyers" role="tabpanel" aria-labelledby="v-pills-buyers-tab">
                    <div class="row">
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u2.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u5.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u6.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u7.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u8.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u9.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u9.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u10.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u11.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <div class="card no-b">
                                <div class="card-body text-center p-5">
                                    <div class="avatar avatar-xl mb-3">
                                        <img src="assets/img/dummy/u12.png" alt="User Image">
                                    </div>
                                    <div>
                                        <h6 class="p-t-10">Alexander Pierce</h6>
                                        alexander@paper.com
                                    </div>
                                    <a href="#" class="btn btn-success btn-sm mt-3">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane animated fadeInUpShort" id="v-pills-sellers" role="tabpanel" aria-labelledby="v-pills-sellers-tab">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u1.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <img src="assets/img/dummy/u4.png" alt="User Image">
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-a avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Alexander Pierce</strong>
                                        </div>
                                        <small> alexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card no-b p-3">
                                <div>
                                    <div class="image mr-3 avatar-lg float-left">
                                        <span class="avatar-letter avatar-letter-c avatar-lg  circle"></span>
                                    </div>
                                    <div class="mt-1">
                                        <div>
                                            <strong>Clexander Pierce</strong>
                                        </div>
                                        <small>clexander@paper.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add New Message Fab Button-->
        <a href="registrar_usuario.php" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i class="icon-add"></i></a>
    </div>
    <!-- Right Sidebar -->
    <aside class="control-sidebar fixed white ">
        <div class="slimScroll">
            <div class="sidebar-header">
                <h4>Bitácora</h4>
                <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
            </div>
            <div class="p-3">
                <!-- The time line -->
                <ul class="timeline">
                    <?php
                    $hoyCorto = date("Y-m-d");
                    $hoyFin = date("Y-m-d") . " 23:59:59";
                    $hoyInicio = date("Y-m-d") . " 00:00:00";

                    $fechas = Consultas::bitacoraFechas("bitacora");
                    $respuesta = Consultas::bitacora("bitacora");
                    for ($j = 0; $j < 3; $j++) {
                        if ($fechas[$j]["fechas"] == $hoyCorto) {
                            //<!-- timeline time label -->
                            echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hoy
                        </span>
                    </li>';
                            //<!-- /.timeline-label -->
                            for ($i = 0; $i < count($respuesta); $i++) {
                                if ($respuesta[$i]["fecha"] <= $hoyFin && $respuesta[$i]["fecha"] >= $hoyInicio) {
                                    if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                        //<!-- timeline item -->
                                        echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        //<!-- END timeline item -->
                                    } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                        //<!-- timeline item -->
                                        echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                        //<!-- END timeline item -->
                                    } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                        echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                    } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                        echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . substr($respuesta[$i]["fecha"], 11) . '</span></h6></div>
                                    </div>
                                </li>';
                                    }
                                }
                            }
                        } else {
                            $date1 = new DateTime($fechas[$j]["fechas"]);
                            //var_dump($date1);
                            $date2 = new DateTime("now");
                            $diff = $date1->diff($date2);
                            //<!-- timeline time label -->
                            echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hace ' . $diff->days . ' día(s)
                        </span>
                    </li>';
                            //<!-- /.timeline-label --> 

                            for ($i = 0; $i < count($respuesta); $i++) {
                                //echo substr($respuesta[$i]["fecha"],0,10);
                                if ($diff->days != 0 && substr($respuesta[$i]["fecha"], 0, 10) == $fechas[$j]["fechas"]) {

                                    if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                                        //<!-- timeline item -->
                                        echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        //<!-- END timeline item -->
                                    } elseif (preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                        //<!-- timeline item -->
                                        echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                        //<!-- END timeline item -->
                                    } elseif (preg_match("/Elimin\b/", $respuesta[$i]["accion"])) {
                                        echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                    } elseif (preg_match("/Modific\b/", $respuesta[$i]["accion"])) {
                                        echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>' . $respuesta[$i]["usuario"] . ' ' . $respuesta[$i]["accion"] . '    <span class="time float-right"><i class="ion icon-clock-o"></i> ' . fechaHora($respuesta[$i]["fecha"]) . '</span></h6></div>
                                    </div>
                                </li>';
                                    }
                                }
                            }
                        }
                    }
                    ?>
            </div>
        </div>
    </aside>
    <!-- /.right-sidebar -->


    <!-- Modales -->
    <!-- Modal para editar usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Tipo de Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarUsuarioForm">
                        <input type="hidden" id="modalUserId" name="id">
                        <div class="form-group">
                            <label for="modalTipoUsuario">Tipo de Usuario</label>
                            <select id="modalTipoUsuario" class="form-control" name="tipo">
                                <option value="admin">Administrador</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="asesor">Asesor</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
    <!--/#app -->
    <script src="assets/js/app.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Eliminar usuario -->
    <script type="text/javascript">
        function eliminarUsuario(id) {
            var fila = $("#eliminar" + id);
            swal({
                title: "¿Deseas eliminar este usuario?",
                text: "Una vez eliminado, no es posible recuperar el registro.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    swal("Este usuario ha sido eliminado correctamente!", {
                        icon: "success",
                    })
                    //$("#eliminar"+id).hide();
                    $.ajax({
                        type: "POST",
                        url: "includes/eliminarUsuario_db.php",
                        data: {
                            idd: id
                        },
                        success: function(respuesta) {
                            $("#eliminar" + id).hide();
                        }
                    })
                } else {
                    swal("No se llevo a cabo la operación")
                }

            });


        }
    </script>

    <!-- confirmar el cambio de tipo de usuario con Swal -->
    <script>
        function abrirModalEditar(id, tipoActual) {
            // Asigna el ID del usuario al campo oculto
            document.getElementById('modalUserId').value = id;
            // Selecciona el tipo actual en el select
            document.getElementById('modalTipoUsuario').value = tipoActual;
            // Mostrar el modal
            $('#editarUsuarioModal').modal('show');
        }

        $(document).ready(function() {
            $('#editarUsuarioForm').on('submit', function(event) {
                event.preventDefault();

                // Obtener el ID del usuario y el nuevo tipo de usuario
                var id = $('#modalUserId').val();
                var nuevoTipo = $('#modalTipoUsuario').val();

                // Verificar que se ha obtenido un valor de ID válido
                if (!id || id === '') {
                    swal({
                        title: "Error",
                        text: "No se ha proporcionado un ID de usuario válido.",
                        icon: "error",
                        buttons: "Aceptar"
                    });
                    return;
                }

                // Realizar la solicitud AJAX
                $.ajax({
                    url: 'includes/actualizar_tipo_usuario.php',
                    type: 'POST',
                    data: {
                        id: id,
                        tipo: nuevoTipo
                    },
                    success: function(response) {
                        // Asegúrate de que estás verificando el campo 'success' como un booleano
                        // if (response.success === true) {
                        swal({
                            title: "Éxito",
                            text: response.message || "El tipo de usuario ha sido actualizado correctamente.",
                            icon: "success",
                            buttons: "Aceptar"
                        }).then(() => {
                            location.reload(); // Recargar la página después de cerrar el SweetAlert
                        });
                        // } else {
                        //     swal({
                        //         title: "Error",
                        //         text: response.message || "Hubo un error al actualizar el tipo de usuario.",
                        //         icon: "error",
                        //         buttons: "Aceptar"
                        //     });
                        // }
                    },

                    error: function() {
                        swal({
                            title: "Error",
                            text: "No se pudo realizar la solicitud.",
                            icon: "error",
                            buttons: "Aceptar"
                        });
                    }
                });
            });
        });
    </script>


</body>

</html>