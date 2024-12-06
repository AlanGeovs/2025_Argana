<?php
session_start();
require_once "../model/model.php";
require_once "../model/carrito.php";

$idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : null;
$cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;
$idUser = $_SESSION['idUser'];
// Validación básica para asegurarse de que se reciben datos válidos
if ($idProducto !== null && $cantidad > 0) {
    $respuesta = Carrito::agregarProducto(session_id(), $idProducto, $cantidad, $idUser);

    if ($respuesta) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el producto al carrito.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
}
?>

