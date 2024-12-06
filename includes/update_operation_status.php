<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
require_once "../model/model.php";

// header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$operationId = $_POST['operation_id'];
$newStatus = $_POST['status'];
$oldStatus = $_POST['old_status'];

$result = Consultas::actualizarEstadoOperacion($operationId, $newStatus);

if ($newStatus == 0) {
    $reversaResultado = Consultas::reversaBalance($operationId);
}


// Registrar en bitácora las operaciones
Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Modificó la operación " . $operationId . " de " . $oldStatus . " a " . $newStatus);

if ($result) {
    echo json_encode(['status' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error']);
}
// }
