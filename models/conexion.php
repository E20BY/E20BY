<?php
class Conexion{
	public function conectar(){
		$pdo = new PDO("mysql:host=148.113.168.24;dbname=eflowers_tiendae20flowers","eflowers_root","?9m%~vSVmVx#");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Configura la codificación de caracteres para la conexión
		$pdo->exec("set names utf8mb4");
		return $pdo;
	}
}