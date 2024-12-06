<?php
session_start();
require_once "../model/model.php";

header('Content-Type: application/json'); // Indica que la respuesta será JSON

$nombre = $_POST["userName"];
$correo = $_POST["correo"];
$password = $_POST["password"];
$tipo = $_POST["tipo"];

$datosModel = array($nombre, $correo, $password, $tipo);
$tabla = "usuarios";

$validar = Consultas::validarRegistroUsuario($datosModel, $tabla);

$response = []; // Inicializa el array de respuesta

if ($validar == "") {
	$respuesta = Consultas::registrarUsuarios($datosModel, $tabla);
	if ($respuesta == "error") {
		$response = ['success' => false, 'message' => 'Hubo un error al registrar al usuario.'];
	} elseif ($respuesta == "ok") {
		// ... (el resto de tu código PHP)

		if ($respuesta == "ok") {
			// Registrar en bitácora y luego enviar correo electrónico
			$res = Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Registró un Usuario");
			if ($res == "ok") {
				// Envío de correo electrónico
				$para = $correo;
				$asunto = "Registro como cliente en Tradex";
				$mensaje = "Te hemos registrado como cliente en nuestra plataforma. Ya puedes ingresar para ver tu estado de cuenta.\n\n";
				$mensaje .= "Tus datos de acceso son:\n";
				$mensaje .= "Link a plataforma: https://sistema.tradexmexico.com.mx\n";
				$mensaje .= "Usuario: " . $correo . "\n";
				$mensaje .= "Contraseña: " . $password . "\n\n";
				$mensaje .= "Dudas o comentarios escribir a contacto@tradexmexico.com.mx.";

				// Para enviar un correo HTML, la cabecera Content-type debe definirse
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
				$cabeceras .= 'From: contacto@tradexmexico.com.mx' . "\r\n";

				if (mail($para, $asunto, $mensaje, $cabeceras)) {
					$response = ['success' => true, 'message' => 'Usuario registrado con éxito y correo enviado.'];
				} else {
					$response = ['success' => false, 'message' => 'Usuario registrado pero el correo no se pudo enviar.'];
				}
			} elseif ($res == "error") {
				$response = ['success' => false, 'message' => 'Error al registrar en bitácora.'];
			}
		}
		// ... (el resto de tu código PHP)

	}
} else {
	$response = ['success' => false, 'message' => 'El usuario ya existe.'];
}

echo json_encode($response); // Devuelve la respuesta como JSON
