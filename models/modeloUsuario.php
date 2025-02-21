<?php
require_once 'conexion.php';
class ModeloUsuario
{
    public $tabla = "usuario";

    function ModeloLoginIngresarPagina($dato)
    {
        $sql = "SELECT * FROM $this->tabla WHERE usuario = ? AND clave = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['user'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['clave'], PDO::PARAM_STR);
        }
        try {
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
