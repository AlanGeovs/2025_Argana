<?php

class Conexion
{
	public static function conectar()
	{
		//$link= new PDO("mysql:host=localhost; dbname=trademar_tmk","root","");
		$link = new PDO('mysql:host=localhost; dbname=dbgbugrafge90d', 'uqoksoigmvtky', 'zpw5ffyf2l04');
		return $link;
	}
}
