<?php
// error_reporting();
session_start();
require_once "../model/model.php";

//$vigencia=preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $vigencia);
//$contacto=$_POST["contacto"];
//$ultimaCertificacion=preg_replace('/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/', "\\3-\\2-\\1", $ultimaCertificacion);

$encuesta_code = 1;
$id_asociado = 1;

$alc =  $_POST["alc"];
$calle = $_POST["calle"];
$next = $_POST["next"];
$nint = $_POST["nint"];
$col =  $_POST["col"];
$sec =  $_POST["sec"];
$cred = $_POST["cred"];
$gen =  $_POST["gen"];

$p_1 = $_POST["p_1"];
$p_2 = 0;
$p_2_a = $_POST["p_2_a"];
$p_2_b = $_POST["p_2_b"];
$p_2_c = $_POST["p_2_c"];
$p_3 = $_POST["p_3"];
$p_4 = $_POST["p_4"];
$p_5 = $_POST["p_5"];
$p_6 = 0;
$p_6_a = $_POST["p_6_a"];
$p_6_b = $_POST["p_6_b"];
$p_6_c = $_POST["p_6_c"];
$p_6_d = $_POST["p_6_d"];
$p_6_e = $_POST["p_6_e"];
$p_6_f = $_POST["p_6_f"];
$p_6_g = $_POST["p_6_g"];
$p_6_h = $_POST["p_6_h"];
$p_7 = 0;
$p_7_a = $_POST["p_7_a"];
$p_7_b = $_POST["p_7_b"];
$p_7_c = $_POST["p_7_c"];
$p_7_d = $_POST["p_7_d"];
$p_7_e = $_POST["p_7_e"];
$p_7_f = $_POST["p_7_f"];
$p_7_g = $_POST["p_7_g"];
$p_7_h = $_POST["p_7_h"];
$p_7_i = $_POST["p_7_i"];
$p_7_j = $_POST["p_7_j"];
$p_7_k = $_POST["p_7_k"];
$p_7_l = $_POST["p_7_l"];
$p_7_m = $_POST["p_7_m"];
$p_7_n = $_POST["p_7_n"];
$p_7_o = $_POST["p_7_o"];
$p_8 = 0;
$p_8_a = $_POST["p_8_a"];
$p_8_b = $_POST["p_8_b"];
$p_8_c = $_POST["p_8_c"];
$p_8_d = $_POST["p_8_d"];
$p_8_e = $_POST["p_8_e"];
$p_8_f = $_POST["p_8_f"];
$p_8_g = $_POST["p_8_g"];
$p_8_h = $_POST["p_8_h"];
$p_8_i = $_POST["p_8_i"];
$p_8_j = $_POST["p_8_j"];
$p_8_k = $_POST["p_8_k"];
$p_8_l = $_POST["p_8_l"];
$p_8_m = $_POST["p_8_m"];
$p_8_n = $_POST["p_8_n"];
$p_8_o = $_POST["p_8_o"];
$p_9 = $_POST["p_9"];
$p_10 = $_POST["p_10"];
$p_11 = $_POST["p_11"];
$p_12 = $_POST["p_12"];
$p_13 = $_POST["p_13"];
$p_13_a = 0;
$p_13_b = 0;
$p_13_c = 0;
$p_13_d = 0;
$p_14 = $_POST["p_14"];
$p_14_a = 0;
$p_14_b = 0;
$p_14_c = 0;
$p_14_d = 0;
$p_15 = $_POST["p_15"];
$p_15_a = 0;
$p_15_b = 0;
$p_15_c = 0;
$p_15_d = 0;
$p_16 = $_POST["p_16"];
$p_16_a = 0;
$p_16_b = 0;
$p_16_c = 0;
$p_16_d = 0;
$p_17 = $_POST["p_17"];
$p_17_a = 0;
$p_17_b = 0;
$p_17_c = 0;
$p_17_d = 0;
$p_18 = $_POST["p_18"];
$p_18_a = 0;
$p_18_b = 0;
$p_18_c = 0;
$p_18_d = 0;
$p_19 = $_POST["p_19"];
$p_19_a = 0;
$p_19_b = 0;
$p_19_c = 0;
$p_19_d = 0;
$p_20 = $_POST["p_20"];
$p_21 = $_POST["p_21"];
$p_22 = $_POST["p_22"];
$p_23 =  0;

// Localización
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$geoloc = $latitud . ", " . $longitud;

$note = $_POST["note"];
$observaciones = $_POST["observaciones"];
//$img=$_POST["datosImagen"];
//$img=substr($img, 0, -1);
$id_usuario = $_SESSION["idUser"];

//if (preg_match("/\s/", $img)) {
//	$img=preg_replace("/\s/", "", $img);
//}

/*=============================================
=            codigo para cuando se usa checkboxesk            =
=============================================*/

/*if(!empty($_POST['clases'])) {
	$clases=$_POST['clases'];
	$c="";
    for ($i=0; $i < count($clases); $i++) { 
    	$c.=$clases[$i].", ";
    }
    $c=substr($c, 0, -2);
    //echo $c;
}

$datosModel=array($denominacion,$titular,$c,$pais,$numRegistro,$numSol,$vigencia,$contacto,$correo,$tel,$fax,$link,$fuente,$servicio,$observaciones);*/

/*=====  codigo para cuando se usa checkboxes  ======*/

//encuesta_code	id_asociado	p_1	p_2	p_3	p_4	p_5	p_6	p_7	p_8	p_9	p_10	 	note	observaciones	 	id_usuario	
//$datosModel=array($car_code, $asociado, $condicion, $tipo, $marca, $modelo, $version, $ano, $precio, $transmision, $combustible, $kilometraje, $color_int, $color_ext, $tam_motor, $cilindros, $note, $observaciones, $img, $idUsuario);
//$elementos = "encuesta_code, id_asociado, p_1, p_2, p_3, p_4, p_5, p_6, p_7, p_8, p_9, p_10, note, observaciones, id_usuario";

$datosModel = array(
    $note,
    $observaciones,
    $id_usuario,
    $geoloc,
    $encuesta_code,
    $id_asociado,
    $alc,
    $calle,
    $next,
    $nint,
    $col,
    $sec,
    $cred,
    $gen,
    $p_1,
    $p_2,
    $p_2_a,
    $p_2_b,
    $p_2_c,
    $p_3,
    $p_4,
    $p_5,
    $p_6,
    $p_6_a,
    $p_6_b,
    $p_6_c,
    $p_6_d,
    $p_6_e,
    $p_6_f,
    $p_6_g,
    $p_6_h,
    $p_7,
    $p_7_a,
    $p_7_b,
    $p_7_c,
    $p_7_d,
    $p_7_e,
    $p_7_f,
    $p_7_g,
    $p_7_h,
    $p_7_i,
    $p_7_j,
    $p_7_k,
    $p_7_l,
    $p_7_m,
    $p_7_n,
    $p_8,
    $p_8_a,
    $p_8_b,
    $p_8_c,
    $p_8_d,
    $p_8_e,
    $p_8_f,
    $p_8_g,
    $p_8_h,
    $p_8_i,
    $p_8_j,
    $p_9,
    $p_10,
    $p_11,
    $p_12,
    $p_13,
    $p_13_a,
    $p_13_b,
    $p_13_c,
    $p_13_d,
    $p_14,
    $p_14_a,
    $p_14_b,
    $p_14_c,
    $p_14_d,
    $p_15,
    $p_15_a,
    $p_15_b,
    $p_15_c,
    $p_15_d,
    $p_16,
    $p_16_a,
    $p_16_b,
    $p_16_c,
    $p_16_d,
    $p_17,
    $p_17_a,
    $p_17_b,
    $p_17_c,
    $p_17_d,
    $p_18,
    $p_18_a,
    $p_18_b,
    $p_18_c,
    $p_18_d,
    $p_19,
    $p_19_a,
    $p_19_b,
    $p_19_c,
    $p_19_d,
    $p_20,
    $p_21,
    $p_22,
    $p_23,

    $p_8_k,
    $p_8_l,
    $p_8_m,
    $p_8_n,

    $p_7_o,
    $p_8_o,

);

$tabla = "encuestas";

var_dump($datosModel);
//Consultas::registrarMarcas($denominacion,$titular,$c,$pais,$numRegistro,$numSol,$vigencia,$contacto,$correo,$tel,$fax,$link,$fuente,$servicio,$observaciones);
//header("Location: ../site.php");
//move_uploaded_file($_FILES['foto']['tmp_name'],"../images/obras/".$nom.".jpg");

// echo    $encuesta_code . '<br>';
// echo    $id_asociado . '<br>';
// echo    $p_1 . '<br>';
// echo    $p_2 . '<br>';
// echo    $p_3 . '<br>';
// echo    $p_4 . '<br>';
// echo    $p_5 . '<br>';
// echo    $p_6 . '<br>';
// echo    $p_7 . '<br>';
// echo    $p_8 . '<br>';
// echo    $p_9 . '<br>';
// echo    $p_10 . '<br>';
// echo    $note . '<br>';
// echo    $observaciones . '<br>';
// echo    'user: ' . $id_usuario . '<br>';


$respuesta = Consultas::registraEncuesta($datosModel, $tabla);

if ($respuesta == "error") {
    header("Location: https://beraca.mx/registrar_encuesta.php?e=error");
    echo '<br>Error 1';
} elseif ($respuesta == "ok") {
    $res = Consultas::registrarBitacora($_SESSION["usuario"], "bitacora", "Registró Un encuestado");
    if ($res == "ok") {
        header("Location: https://beraca.mx/listar_encuestas.php");
        echo '<br>OK 1';
    } elseif ($res == "error") {
        header("Location: https://beraca.mx/registrar_encuesta.php?e=error");
        echo '<br>Error 2';
    }
}