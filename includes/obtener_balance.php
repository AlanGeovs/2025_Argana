<?php
session_start();
require_once "../model/model.php";

$id_user = isset($_GET['u']) ? intval($_GET['u']) : null;

if ($id_user) {
    $balances = Consultas::obtenerBalancesPorUsuario($id_user);
    echo json_encode($balances);
} else {
    echo json_encode([]);
}
