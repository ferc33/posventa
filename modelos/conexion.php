<?php

class Conexion
{

	static public function conectar()
	{

		//$link = new PDO("mysql:host=localhost;port=3306;dbname=pos", //xampp
		$link = new PDO(
			"mysql:host=localhost;port=3306;dbname=pos", //wamp
			"root", //Usuario
			""
		); //Contraseña

		$link->exec("set names utf8");

		return $link;
	}
}
