<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../model/model.php";

header('Content-Type: application/json');

$clientes = Consultas::obtenerClientesSinComision();
$fecha_actual = date('Y-m-d');
$success = true;
$total_cargos_mensuales = 0;  // Inicializamos la variable para contar los cargos

foreach ($clientes as $cliente) {
    $balance_data = [
        'id_user' => $cliente['id_user'],
        'username' => $cliente['username'],
        'type_operation' => 'Comisión mensual',
        'name_transaction' => 'Comisión de mantenimiento mensual',
        // 'date_transaction' => $fecha_actual,
        'date_transaction' => "2024-11-28",
        'trade_sales' => 0,
        'cash_sales' => 0,
        'trade_purchases' => 0,
        'cash_purchases' => 0,
        'trade_commission' => 150,
        'cash_commission' => 0,
        'trade_balance' => -150, //Se actualiza valor para restar de la comisión mensual del balance de cada cliente
        'cash_balance' => 0,   // Si se necesita actualizar, calcular aquí
        'operation_id' => 0
    ];

    $resultado = Consultas::insertarBalance($balance_data);

    if (!$resultado) {
        $success = false;
        error_log('Error al insertar balance para el cliente ID: ' . $cliente['id_user']);
    } else {
        // Sumamos el cargo hecho a este cliente al total acumulado
        $total_cargos_mensuales += 150;
    }
}

// Verificamos si la operación fue exitosa
if ($success) {
    // Insertar el total de cargos en el balance del cliente con ID 3719
    insertarCargosAcumulados(3719, $total_cargos_mensuales, $fecha_actual);

    // Registrar en bitácora las operaciones
    Consultas::registrarBitacora("Sistema", "bitacora", "Agregó comisión mensual a todos los clientes");

    echo json_encode(['status' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error']);
}

// Función para insertar los cargos acumulados en el balance del cliente con ID 3719
function insertarCargosAcumulados($id_user, $total_cargos, $fecha_actual)
{
    $balance_data_3719 = [
        'id_user' => $id_user,
        'username' => '520000034',  // Cambiar si es necesario
        'type_operation' => 'Comisión mensual',
        'name_transaction' => 'Comisión acumulada mensual ++',
        //'date_transaction' => $fecha_actual,
        'date_transaction' => "2024-11-28",
        'trade_sales' => 0,
        'cash_sales' => 0,
        'trade_purchases' => 0,
        'cash_purchases' => 0,
        'trade_commission' => 0,
        'cash_commission' => 0,
        'trade_balance' => $total_cargos, // Sumar todos los cargos acumulados
        'cash_balance' => 0,
        'operation_id' => 0
    ];

    // Insertar en el balance
    $resultado = Consultas::insertarBalance($balance_data_3719);

    // Registrar en bitácora las operaciones
    Consultas::registrarBitacora("Sistema", "bitacora", "Agregó comisión mensual a cuenta Tradex Mexico Script Inventory | 520000034 | 3719, monto: $total_cargos");

    if (!$resultado) {
        error_log('Error al insertar cargos acumulados en el balance para el cliente ID: ' . $id_user);
        return false;
    }

    return true;
}
