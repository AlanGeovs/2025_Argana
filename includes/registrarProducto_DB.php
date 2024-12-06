<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// Recibir datos
$data = [
    'product_name' => $_POST['product_name'],
    'author' => $_POST['author'],
    'description' => $_POST['description'],
    'SKU' => $_POST['SKU'],
    'price_public' => $_POST['price_public'],
    'price_supplier' => $_POST['price_supplier'],
    'stock' => $_POST['stock'],
    // 'gender' => isset($_POST['gender']) ? ($_POST['gender'] == 'male' ? 0 : 1) : null, // Asumiendo que el valor por defecto es null si no se recibe nada

];

// Validar y sanear datos aquí...
// echo "Name: " . $_POST['name'];
// echo "<br>Name: " . $_POST['name'];
// echo "<br>type_user: " . $_POST['type_user'];
// echo "<br>mobile: " . $_POST['mobile'];
// echo "<br>notifications: " . $_POST['notifications'];
// echo "<br>notes: " . $_POST['notes'];

// Guardar datos
if (Consultas::guardarProducto($data)) {
    $response['success'] = true;
    $response['message'] = 'Producto registrado con éxito.';
    $res = Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Creó un cliente");
} else {
    $response['message'] = 'Error al registrar el producto.';
}

// Enviar respuesta
echo json_encode($response);
