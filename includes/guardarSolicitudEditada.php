<?php
session_start();
require_once "../model/Order.php";

header('Content-Type: application/json');


$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_order']) && isset($data['productos'])) {
    $idOrder = $data['id_order'];
    $productos = $data['productos'];

    $result = Order::saveOrderDetails($idOrder, $productos);

    // Actualizar status en tabla orders
    // Ejemplo de cómo usar la función
    $order = new Order($idOrder); // Aquí pasas el id_order correspondiente
    $order->changeStatusOrder('Editada'); // Cambia el estado a 'En Proceso'

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}
