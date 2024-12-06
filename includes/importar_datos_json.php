<?php
require '../vendor/autoload.php';
require 'get_sheet_data.php'; // Asegúrate de que la ruta es correcta
require '../model/conexion.php';

header('Content-Type: application/json');

function updateDatabase($data)
{
    $db = Conexion::conectar();
    $updatedRows = 0;

    $stmt = $db->prepare("INSERT INTO products (SKU, ISBN, price_public, price_supplier, stock, description, author, category) 
                          VALUES (:SKU, :ISBN, :price_public, :price_supplier, :stock, :description, :author, :category)
                          ON DUPLICATE KEY UPDATE 
                          ISBN = VALUES(ISBN),
                          price_public = VALUES(price_public), 
                          price_supplier = VALUES(price_supplier), 
                          stock = VALUES(stock), 
                          description = VALUES(description), 
                          author = VALUES(author), 
                          category = VALUES(category)");

    foreach ($data as $row) {
        try {
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
            $updatedRows++;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            return;
        }
    }

    echo json_encode(['success' => true, 'updatedRows' => $updatedRows]);
}

try {
    $spreadsheetId = '1pK2EzjzwV98DDoKrbE1AtoLUP756JpW1lcBRPj0IhZw';
    $range = 'inventario!A2:G12000'; // Ajusta el rango según tu hoja de cálculo

    $data = getGoogleSheetData($spreadsheetId, $range);

    if (!empty($data)) {
        updateDatabase($data);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
