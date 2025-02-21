<?php
require_once 'conexion.php';
class ModeloVenta
{
    public $tabla = "venta";
    function agregarVentaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_factura,id_producto,precio, cantidad, precio_cantidad) VALUES (?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_fac'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['id_pro'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['precio'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['cant'], PDO::PARAM_INT);
            $stms->bindParam(5, $dato['total'], PDO::PARAM_INT);
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

    function listarVentaFacturaModelo($id)
    {
        $sql = "SELECT *, venta.precio AS precio_venta, venta.cantidad AS canti_venta FROM $this->tabla INNER JOIN productos ON productos.id_producto = venta.id_producto WHERE id_factura = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
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

