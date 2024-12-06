<?php
error_reporting(0);

session_start();
require_once "../model/model.php";
require_once "../model/Order.php";


if (isset($_GET['id_pedido'])) {
    $idPedido = $_GET['id_pedido'];
    $detallesPedido = Order::ObtenDetallesPedido($idPedido);
    echo json_encode($detallesPedido);
} else {
    echo json_encode(array("error" => "Falta el ID del pedido"));
}
