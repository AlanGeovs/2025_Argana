<?php
session_start();
require_once "../model/model.php";
require_once "../model/Order.php";

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$numItems = 20;

// $totalClientes = Consultas::obtenerNumeroTotalClientes();
// $totalPaginas = ceil($totalClientes / $numItems);

// $clientes = Consultas::obtenerClientes($pagina, $numI    tems);

$productos = Consultas::obtenerPedidos($pagina, $numItems, $filtro);
$totalProductos = Consultas::obtenerNumeroTotalProductosConFiltro($filtro);
$totalPaginas = ceil($totalProductos / $numItems);

foreach ($productos as $key => $producto) {
    $idUser = $producto['id_user'];
    $datosCliente = Consultas::obtenerNombreCliente($idUser);
    $productos[$key]['datos_clientes'] = $datosCliente;
}

echo json_encode([
    'productos' => $productos,
    'totalPaginas' => $totalPaginas
]);
