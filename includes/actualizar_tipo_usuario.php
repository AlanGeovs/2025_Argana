<?php
session_start();
require_once "../model/model.php";

if ($_SESSION["tipoUsuario"] != 'admin') {
    echo json_encode(['success' => false, 'message' => 'No tienes permisos para realizar esta acción.']);
    exit;
}

if (isset($_POST['id']) && isset($_POST['tipo'])) {
    $id = intval($_POST['id']);
    $nuevoTipo = $_POST['tipo'];

    // Llamar a la función para actualizar el tipo de usuario
    $resultado = Consultas::actualizarTipoUsuario($id, $nuevoTipo);

    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Todo ok.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar el usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
