<?php
session_start();
require_once "../model/model.php";

$response = ['success' => false, 'message' => ''];

// Verificar si los datos esenciales están presentes
if (empty($_POST['name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
    $response['message'] = 'Datos incompletos. Por favor, verifica el formulario.';
    echo json_encode($response);
    exit;
}

//Condiciòn para que si no tiene trading_name o nombre de marca poner en este campo el nombre y apellidos 
if (empty($_POST['trading_name'])) {
    $NewTradingName = $_POST['name'] . " " . $_POST['last_name'] . " " . $_POST['last_name_second'];
} else {
    $NewTradingName =  $_POST['trading_name'];
}

// Recibir datos y asignar valores por defecto a campos faltantes
$data = [
    'name' => $_POST['name'],
    'last_name' => $_POST['last_name'],
    'last_name_second' => $_POST['last_name_second'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'mobile' => $_POST['mobile'],
    'trading_name' => $NewTradingName,
    'legal_name' => $_POST['legal_name'],
    'address' => $_POST['address'],
    'town' => $_POST['town'],
    'city' => $_POST['city'],
    'state' => $_POST['state'],
    'cp' => $_POST['cp'],
    'notes' => $_POST['notes'],
    'status' => 1, // Asignar valor por defecto de status
];

// Calcular el `username` basado en el último registro en la tabla
$data['username'] = Consultas::calcularNuevoUsername();

// Guardar datos del cliente y obtener el `id_user` recién creado
$id_user = Consultas::guardarCliente($data);

if ($id_user) {
    // Insertar el balance para el nuevo usuario
    if (Consultas::registrarNuevoUsuarioEnBalance($id_user, $data['username'])) {
        $response['success'] = true;
        $response['message'] = 'Usuario registrado con éxito.';
        Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Creó un cliente y se registró el balance inicial.");
    } else {
        $response['message'] = 'Usuario registrado, pero hubo un error al registrar el balance.';
    }
} else {
    // Verificar si hubo un error y mostrarlo
    $response['message'] = 'Error al registrar el usuario. Verifica los logs para más detalles.';
}

// Enviar respuesta
echo json_encode($response);
