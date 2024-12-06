<?php
session_start();
require_once "../model/model.php";
require_once "../model/Order.php";

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$numItems = 20;

// $totalClientes = Consultas::obtenerNumeroTotalClientes();
// $totalPaginas = ceil($totalClientes / $numItems);

// $clientes = Consultas::obtenerClientes($pagina, $numI    tems); ---

$operaciones = Consultas::obtenerOperaciones($pagina, $numItems, $filtro);
$totalProductos = Consultas::obtenerNumeroTotalProductosConFiltro($filtro);
$totalPaginas = ceil($totalProductos / $numItems);

foreach ($operaciones as $key => $operacion) {
    $buyerId = $operacion['buyer_id'];
    $sellerId = $operacion['seller_id'];

    // Obtener información del comprador y vendedor
    $buyerInfo = Consultas::obtenerNombreCliente($buyerId);
    $sellerInfo = Consultas::obtenerNombreCliente($sellerId);

    // Agregar información al array de operaciones
    $operaciones[$key]['buyer_info'] = $buyerInfo;
    $operaciones[$key]['seller_info'] = $sellerInfo;
}

echo json_encode([
    'operaciones' => $operaciones,
    'totalPaginas' => $totalPaginas
]);
