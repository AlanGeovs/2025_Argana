
<?php 
session_start();
require_once "../model/model.php";
require_once "../model/carrito.php";

$idSesion = session_id();
// $idUser = $_SESSION["idUser"]; // Corregir la sintaxis aquí, estaba $idSESSION['idUser'];

 


$productosCarrito = Carrito::obtenerProductosCarrito($idSesion);

echo json_encode($productosCarrito);