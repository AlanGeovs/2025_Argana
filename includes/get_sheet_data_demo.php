<?php
require '../vendor/autoload.php';

function getGoogleSheetData($spreadsheetId, $range)
{
    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS_READONLY]);
    $client->setAuthConfig('beraca-compartehoja-2c61561615ca.json'); // Ruta al archivo de credenciales
    $client->setAccessType('offline');

    $service = new \Google_Service_Sheets($client);

    try {
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        return $values;
    } catch (Google_Service_Exception $e) {
        //echo 'Google Service Exception: ', $e->getMessage(), "\n"; // Comentado para evitar salida no JSON
        return null;
    } catch (Exception $e) {
        //echo 'Exception: ', $e->getMessage(), "\n"; // Comentado para evitar salida no JSON
        return null;
    }
}

// Código siguiente es solo para pruebas y debería ser comentado o removido en producción
// $spreadsheetId = '1pK2EzjzwV98DDoKrbE1AtoLUP756JpW1lcBRPj0IhZw';
// $range = 'inventario!A2:G12000'; // Ajusta el rango según tu hoja de cálculo
// $data = getGoogleSheetData($spreadsheetId, $range);

// if (!empty($data)) {
//     //echo "<pre>";
//     //print_r($data);
//     //echo "</pre>"; 
// } else {
//     echo "No data found.";
// }
