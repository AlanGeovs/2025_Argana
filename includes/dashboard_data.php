<?php
session_start();
require_once "../model/model.php";

$data = [
    'clientesActivos' => Consultas::obtenerClientesActivos(),
    'totalClientes' => Consultas::obtenerTotalClientesRegistrados(),
    'totalOperaciones' => Consultas::obtenerTotalOperaciones(),
];

echo json_encode($data);
