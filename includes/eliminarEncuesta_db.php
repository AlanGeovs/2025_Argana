<?php

session_start();

require_once "../model/model.php";

$id=$_POST["idd"];
$tabla="encuestas";

$respuesta=Consultas::eliminarEncuesta($id,$tabla);

if ($respuesta=="ok") {
	$res=Consultas::registrarBitacora($_SESSION["usuario"],"bitacora","Eliminó un registro");
	if ($res=="ok") {
		echo "succes";
	}elseif ($res=="error") {
		echo $res;
	}
}