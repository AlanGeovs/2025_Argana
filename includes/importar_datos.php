<?php
require '../vendor/autoload.php';
require 'get_sheet_data.php'; // Asegúrate de que la ruta es correcta
require '../model/conexion.php';

function updateDatabase($data)
{
    // Conectar a la base de datos
    $db = Conexion::conectar();

    // Preparar la consulta de inserción/actualización
    $stmt = $db->prepare("INSERT INTO products_import (SKU, ISBN, price_public, price_supplier, stock, description, author, category) 
                          VALUES (:SKU, :ISBN, :price_public, :price_supplier, :stock, :description, :author, :category)
                          ON DUPLICATE KEY UPDATE 
                          SKU = VALUES(SKU),
                          price_public = VALUES(price_public), 
                          price_supplier = VALUES(price_supplier), 
                          stock = VALUES(stock), 
                          description = VALUES(description), 
                          author = VALUES(author), 
                          category = VALUES(category)");

    // Recorrer los datos y ejecutar la consulta
    foreach ($data as $row) {
        try {
            // Imprimir datos para depuración
            // echo "Procesando: ";
            // print_r($row);

            // Ejecutar la consulta
            $stmt->execute([
                ':SKU' => $row[0],
                ':ISBN' => $row[1],
                ':price_public' => $row[5],
                ':price_supplier' => null, // Ajusta según sea necesario
                ':stock' => $row[6],
                ':description' => $row[2],
                ':author' => $row[3],
                ':category' => $row[4],
            ]);

            // echo "Fila procesada correctamente.\n";
        } catch (PDOException $e) {
            echo 'Error al procesar la fila: ', $e->getMessage(), "\n";
        }
    }
}

// Obtener los datos de la hoja de cálculo
$spreadsheetId = '1pK2EzjzwV98DDoKrbE1AtoLUP756JpW1lcBRPj0IhZw';
$range = 'inventario!A2:G120'; // Ajusta el rango según tu hoja de cálculo

$data = getGoogleSheetData($spreadsheetId, $range);

if (!empty($data)) {
    updateDatabase($data);
    echo "Datos actualizados correctamente.";
} else {
    echo "No data found.";
}
