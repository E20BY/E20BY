<?php
require_once 'conexion.php';
class ModeloCategoria
{
    public $tabla = "categoria";
    function agregarCategoria($nom)
    {
        $sql = "INSERT INTO $this->tabla (nombre) VALUE (?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $nom, PDO::PARAM_STR);
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

    function listarCategoria()
    {
        $sql = "SELECT * FROM $this->tabla";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
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

    function actualizarCategoria($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre = ? WHERE id_categoria = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $dato['nom'], PDO::PARAM_STR);
        $stms->bindParam(2, $dato['id'], PDO::PARAM_INT);
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

    function consultarCategoriaAjaxModelo($dato)
    {
        $sql = "SELECT * FROM $this->tabla WHERE nombre like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $nom = "%".$dato."%";
        $stms->bindParam(1, $nom, PDO::PARAM_STR);
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

    function eliminarCategoriaModelo($id){
        $sql = "DELETE FROM $this->tabla WHERE id_categoria = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
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
