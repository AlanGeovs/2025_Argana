<?php

class Conexion
{
	public static function conectar()
	{
		//$link= new PDO("mysql:host=localhost; dbname=trademar_tmk","root","");
		$link = new PDO('mysql:host=localhost; dbname=dbi6bdhoqxrrng', 'uqnnskgagovis', 'kqgsgdipj2vs');
		return $link;
	}
}
