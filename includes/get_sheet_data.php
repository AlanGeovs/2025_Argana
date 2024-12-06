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
        return null;
    } catch (Exception $e) {
        return null;
    }
}
