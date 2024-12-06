<?php
session_start();
require_once "../model/Order.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_order']) && isset($data['status'])) {
    $idOrder = $data['id_order'];
    $status = $data['status'];

    $result = Order::changeStatusOrder($idOrder, $status);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el estado del pedido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}
