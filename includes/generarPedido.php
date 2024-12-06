<?php
session_start();
require_once "../model/carrito.php";
require_once "../model/Order.php";

if (!isset($_SESSION["idUser"]) || empty($_POST["idUsuario"])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no identificado.']);
    exit;
}

$idUsuario = $_POST["idUsuario"];
$productosCarrito = Carrito::obtenerProductosCarrito(session_id());

// Asumiendo que tienes métodos para insertar en orders y order_details
$response = Order::crearPedido($idUsuario, $productosCarrito);

if ($response['success']) {
    // Opcional: limpiar el carrito después de generar el pedido
    Carrito::limpiarCarrito(session_id());
}

echo json_encode($response);
