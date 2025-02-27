<?php
require_once 'conexion.php';
class ModeloDescripcionProducto
{
    public $tabla = "descripcion_producto";
    function agregarDescripcionProductoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_producto,descripcion,informacion_adicional) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_producto'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['descrip'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['infoAdd'], PDO::PARAM_STR);
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

    function actualizarDescripcionProductoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET descripcion= ?,informacion_adicional= ? WHERE id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['descrip'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['infoAdd'], PDO::PARAM_STR);
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
