<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../model/model.php";
require_once "../model/Order.php";

header('Content-Type: application/json'); // Indica que la respuesta será JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comprador = $_POST['comprador'];
    $comprador_comision = $_POST['comprador_comision'];
    $vendedor = $_POST['vendedor'];
    $vendedor_comision = $_POST['vendedor_comision'];
    $intercambio = $_POST['intercambio'];
    $efectivo = $_POST['efectivo'];
    $fecha_transaccion = $_POST['fecha_transaccion'];
    $fecha_deposito = $_POST['fecha_deposito'];
    $nota = $_POST['nota'];

    // Registrar operación
    $result = Order::registerOperation($comprador, $comprador_comision, $vendedor, $vendedor_comision, $intercambio, $efectivo, $fecha_transaccion, $fecha_deposito, $nota);


    if ($result) {
        // Obtener username de comprador y vendedor (puedes ajustarlo si ya tienes esta información)
        $comprador_username = Consultas::obtenerUsername($comprador);
        $vendedor_username = Consultas::obtenerUsername($vendedor);

        // Calcular comisiones
        $cash_commission_vendedor = ($vendedor_comision / 100) * $intercambio;
        $cash_commission_comprador = ($comprador_comision / 100) * $intercambio;

        // Insertar balance para el vendedor
        $balance_vendedor = [
            'id_user' => $vendedor,
            'username' => $vendedor_username,
            'type_operation' => 'Venta',
            'name_transaction' => $nota,
            'date_transaction' => $fecha_transaccion,
            'trade_sales' => $intercambio,
            'cash_sales' => $efectivo,
            'trade_purchases' => 0,
            'cash_purchases' => 0,
            'trade_commission' => 0,
            'cash_commission' => $cash_commission_vendedor,
            'trade_balance' => $intercambio, // Suma el valor de la venta al balance por Ser vendedor
            'cash_balance' => 0,   // Calcula o ajusta si es necesario
            'operation_id' => $result // Puedes obtener el operation_id de la variable $result
        ];
        Consultas::insertarBalance($balance_vendedor);

        // Insertar balance para el comprador
        $balance_comprador = [
            'id_user' => $comprador,
            'username' => $comprador_username,
            'type_operation' => 'Compra',
            'name_transaction' => $nota,
            'date_transaction' => $fecha_transaccion,
            'trade_sales' => 0,
            'cash_sales' => 0,
            'trade_purchases' => $intercambio,
            'cash_purchases' => $efectivo,
            'trade_commission' => 0,
            'cash_commission' => $cash_commission_comprador,
            'trade_balance' => -$intercambio, // Resta el valor de la compra al balance por Ser comprador
            'cash_balance' => 0,   // Calcula o ajusta si es necesario
            'operation_id' => $result// Puedes obtener el operation_id de la variable $result
        ];
        Consultas::insertarBalance($balance_comprador);

        // Registrar en bitácora las operaciones
        Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Agregó la operación " . $result);
        Consultas::enviarCorreoOperaciones($_SESSION["usuario"], $comprador_username, $vendedor_username, $intercambio,  $fecha_transaccion, $nota);


        // $result ahora contiene el operation_id
        echo json_encode(['status' => 'success', 'operation_id' => $result]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error']);
    }
}




// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// session_start();
// require_once "../model/model.php";
// require_once "../model/Order.php";

// header('Content-Type: application/json'); // Indica que la respuesta será JSON

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $comprador = $_POST['comprador'];
//     $comprador_comision = $_POST['comprador_comision'];
//     $vendedor = $_POST['vendedor'];
//     $vendedor_comision = $_POST['vendedor_comision'];
//     $intercambio = $_POST['intercambio'];
//     $efectivo = $_POST['efectivo'];
//     $fecha_transaccion = $_POST['fecha_transaccion'];
//     $fecha_deposito = $_POST['fecha_deposito'];
//     $nota = $_POST['nota'];

//     $result = Order::registerOperation($comprador, $comprador_comision, $vendedor, $vendedor_comision, $intercambio, $efectivo, $fecha_transaccion, $fecha_deposito, $nota);

//     if ($result) {
//         echo json_encode(['status' => 'success']);
//     } else {
//         http_response_code(500);
//         echo json_encode(['status' => 'error']);
//     }
// }
