<?php
session_start();
require_once "../model/model.php";

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$numItems = 20;

// $totalClientes = Consultas::obtenerNumeroTotalClientes();
// $totalPaginas = ceil($totalClientes / $numItems);

// $clientes = Consultas::obtenerClientes($pagina, $numI    tems);

$productos = Consultas::obtenerProductos($pagina, $numItems, $filtro);
$totalProductos = Consultas::obtenerNumeroTotalProductosConFiltro($filtro);
$totalPaginas = ceil($totalProductos / $numItems);

echo json_encode([
    'productos' => $productos,
    'totalPaginas' => $totalPaginas
]);