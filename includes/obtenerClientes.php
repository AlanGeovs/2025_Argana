<?php
session_start();
require_once "../model/model.php";

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$numItems = 150;

// $totalClientes = Consultas::obtenerNumeroTotalClientes();
// $totalPaginas = ceil($totalClientes / $numItems);

// $clientes = Consultas::obtenerClientes($pagina, $numI    tems);

$clientes = Consultas::obtenerClientes($pagina, $numItems, $filtro);
$totalClientes = Consultas::obtenerNumeroTotalClientesConFiltro($filtro);
$totalPaginas = ceil($totalClientes / $numItems);

echo json_encode([
    'clientes' => $clientes,
    'totalPaginas' => $totalPaginas
]);
