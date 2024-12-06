<?php
session_start();
require_once "../model/model.php";


if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $cliente = Consultas::obtenerClientePorId($id_user);
    echo json_encode($cliente);
}
