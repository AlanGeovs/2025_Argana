<?php

include "../model/model.php";

$usuario = $_POST["usuario"];
$password = md5($_POST["password"]);

$respuesta = Consultas::validarLoginUsuario($usuario, $password);

if ($respuesta == "") {
	header("Location: ../index.php?error=100");
} else {
	session_start();
	$_SESSION["idUser"] = $respuesta["id"];
	$_SESSION["usuario"] = $respuesta["usuario"];
	$_SESSION["tipoUsuario"] = $respuesta["tipo"];

	// Registrar en la bitácora
	$res = Consultas::registrarBitacora($respuesta["usuario"], "bitacora", "Inició Sesión");

	if ($res == "ok") {
		// Enviar correo con los datos de inicio de sesión
		$fechaInicio = date("Y-m-d H:i:s");
		Consultas::enviarCorreoInicioSesion($respuesta["usuario"], $respuesta["tipo"], $fechaInicio);
		header("Location: ../site.php");
	} else {
		header("Location: ../index.php?error=1");
	}
}
