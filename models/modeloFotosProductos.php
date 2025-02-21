<?php
require_once 'conexion.php';
class ModeloFotosProductos
{
    public $tabla = "fotos_producto";
    function agregarFotosProductosModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_producto,foto_protada,foto1) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_producto'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['portada'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['foto1'], PDO::PARAM_STR);
        }
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function agctualizarFotosProductosModelo($dato){
        $sql = "UPDATE $this->tabla SET foto_protada= ?,foto1= ? WHERE id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['portada'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['foto1'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['id_producto'], PDO::PARAM_INT);
        }
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
