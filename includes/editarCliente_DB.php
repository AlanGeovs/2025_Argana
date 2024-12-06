<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

if (isset($_POST['id_user'])) { // Asegúrate de recibir el ID del cliente
    $id_user = $_POST['id_user'];
    $data = [
        'name' => $_POST['name'],
        'last_name' => $_POST['last_name'],
        'last_name_second' => $_POST['last_name_second'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'mobile' => $_POST['mobile'],
        'address' => $_POST['address'],
        'town' => $_POST['town'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'cp' => $_POST['cp'],
        'notes' => $_POST['notes'],
    ];

    // Validar y sanear datos aquí...

    // Actualizar datos
    if (Consultas::actualizarCliente($id_user, $data)) {
        $response['success'] = true;
        $response['message'] = 'Cliente actualizado con éxito.';
    } else {
        $response['message'] = 'Error al actualizar el cliente.';
    }
} else {
    $response['message'] = 'ID de cliente no proporcionado.';
}

echo json_encode($response);
