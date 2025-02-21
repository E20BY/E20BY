<?php
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;
require_once 'conexion.php';
class ModeloFactura
{
    public $tabla = "factura";

    function agregarFacturaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(token,envio,total) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['token'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['envio'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['total'], PDO::PARAM_INT);
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

    function obtenerUltimoId()
    {
        $sql = "SELECT MAX(id_factura) FROM $this->tabla";
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

    function listarFactura($dato){
        $sql = "SELECT * FROM $this->tabla WHERE fecha = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if($dato != ''){
            $fecha = $dato;
        }else{
            $fecha = Date('Y-m-d');
        }
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
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
