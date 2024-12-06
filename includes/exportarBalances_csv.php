<?php
require_once "../model/model.php";

// Obtener los datos agrupados y sumados
$balances = Consultas::obtenerBalancesAgrupadosTotales();

// Crear el archivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=balances_agrupados.csv');
$output = fopen('php://output', 'w');

// Encabezados del CSV
fputcsv($output, [
    'ID de Usuario',
    'Usuario',
    'Nombre de Cliente',
    'Empresa',
    'Correo Electrónico',
    'Ventas en Intercambio',
    'Ventas en Efectivo',
    'Compras en Intercambio',
    'Compras en Efectivo',
    'Comisión en Intercambio',
    'Comisión en Efectivo',
    'Balance en Intercambio',
    'Balance en Efectivo'
]);

// Agregar filas de datos al CSV
foreach ($balances as $balance) {
    fputcsv($output, [
        $balance['id_user'],
        $balance['username'],
        $balance['trading_name'],
        $balance['legal_name'],
        $balance['email'],
        number_format($balance['total_trade_sales'], 2),
        number_format($balance['total_cash_sales'], 2),
        number_format($balance['total_trade_purchases'], 2),
        number_format($balance['total_cash_purchases'], 2),
        number_format($balance['total_trade_commission'], 2),
        number_format($balance['total_cash_commission'], 2),
        number_format($balance['total_trade_balance'], 2),
        number_format($balance['total_cash_balance'], 2)
    ]);
}

fclose($output);
