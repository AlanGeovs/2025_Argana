<?php
// Incluir el autoload de Composer
require_once('vendor/autoload.php');
require_once "model/model.php"; // Incluye tu conexión y consultas a la base de datos

// Obtener el ID del usuario desde la URL
$id_user = isset($_GET['u']) ? intval($_GET['u']) : null;

if (!$id_user) {
    die("ID de usuario no proporcionado.");
}

// Obtener los datos del cliente y sus transacciones
$cliente = Consultas::obtenerClientePorId($id_user);
$transacciones = Consultas::obtenerBalancesPorUsuario($id_user);

// Definir el periodo fijo
$fechaInicio = '2024-07-31';
$fechaFin = date('Y-m-d'); // Fecha actual

// Crear nuevo PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tradex');
$pdf->SetTitle('Estado de Cuenta TRADEX MEXICO');

// Configuración de fuente y márgenes
$pdf->SetFont('helvetica', '', 10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->AddPage();

// Ruta al logo en el servidor
$logoPath = 'assets/img/logo-tradex.png';

// Encabezado con logo a la izquierda y texto a la derecha
$htmlHeader = '
<table width="100%">
    <tr>
        <td width="30%">
            <img src="' . $logoPath . '" width="50" />
        </td>
        <td width="70%" style="text-align: right;">
            <strong>TRADEX MEXICO</strong><br>
            Datos del asesor de intercambio: Abraham Cherem<br>
            Periodo: ' . $fechaInicio . ' a ' . $fechaFin . '
        </td>
    </tr>
</table><br><br>';

// Agregar encabezado al PDF
$pdf->writeHTML($htmlHeader, true, false, true, false, '');

// Información del cliente y periodo del estado de cuenta
$html = '
<h4>Estado de Cuenta</h4>
<table>
    <tr><td><strong>Nombre de cliente:</strong></td><td>' . $cliente['trading_name'] . '</td></tr>
    <tr><td><strong>ID de Usuario:</strong></td><td>' . $cliente['id_user'] . '</td></tr>
    <tr><td><strong>Clave de cliente:</strong></td><td>' . $cliente['username'] . '</td></tr>
    <tr><td><strong>Periodo del estado de cuenta:</strong></td><td>' . $fechaInicio . ' a ' . $fechaFin . '</td></tr>
</table><br><br>';

// Encabezado de la tabla de transacciones
$html .= '<table border="1" cellpadding="4" cellspacing="0" style="font-size: 7.5px;">
<thead>
    <tr style="background-color: #0000FF; color: #FFFFFF;">
        <th>Tipo de Operación</th>
        <th>Nombre de la Transacción</th>
        <th>Fecha</th>
        <th>Ventas en Intercambio</th>
        <th>Ventas en Efectivo</th>
        <th>Compras en Intercambio</th>
        <th>Compras en Efectivo</th>
        <th>Comisión en Intercambio</th>
        <th>Comisión en Efectivo</th>
        <th>Balance en Intercambio</th>
        <th>Balance en Efectivo</th>
    </tr>
</thead>
<tbody>';

// Transacciones y sumatorias
$totalTradeBalance = 0;
$totalCashBalance = 0;
foreach ($transacciones as $transaccion) {
    $totalTradeBalance += floatval($transaccion['trade_balance']);
    $totalCashBalance += floatval($transaccion['cash_balance']);
    $html .= '
    <tr style="font-size: 8px;">
        <td>' . $transaccion['type_operation'] . '</td>
        <td>' . $transaccion['name_transaction'] . '</td>
        <td>' . $transaccion['date_transaction'] . '</td>
        <td>$' . number_format($transaccion['trade_sales'], 2) . '</td>
        <td>$' . number_format($transaccion['cash_sales'], 2) . '</td>
        <td>$' . number_format($transaccion['trade_purchases'], 2) . '</td>
        <td>$' . number_format($transaccion['cash_purchases'], 2) . '</td>
        <td>$' . number_format($transaccion['trade_commission'], 2) . '</td>
        <td>$' . number_format($transaccion['cash_commission'], 2) . '</td>
        <td>$' . number_format($transaccion['trade_balance'], 2) . '</td>
        <td>$' . number_format($transaccion['cash_balance'], 2) . '</td>
    </tr>';
}

// Agregar fila total
$html .= '
<tr>
    <td colspan="9" style="text-align: right;"><strong>Total:</strong></td>
    <td><strong>$' . number_format($totalTradeBalance, 2) . '</strong></td>
    <td><strong>$' . number_format($totalCashBalance, 2) . '</strong></td>
</tr>';

// Cerrar la tabla
$html .= '</tbody></table>';

// Agregar el contenido HTML al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Definir el footer manualmente
$pdf->SetY(-35);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 10, 'www.tradexmexico.com.mx | Correo de contacto: contacto@tradexmexico.com.mx', 0, 0, 'C');

// Descargar el archivo PDF
$nombrePDF = 'edo_cta_tradex_' . $cliente['username'] . "_" . date('d-m-Y') . ".pdf";
$pdf->Output($nombrePDF, 'D');
