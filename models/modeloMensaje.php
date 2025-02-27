<?php

class ModeloMensaje
{
    public $tabla = "mensaje_carta";
    function agregarCarritoMensajeModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_carrito,token,mensaje,fecha,hora,box) VALUES (?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['token'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['men'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['date'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['time'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['box'], PDO::PARAM_STR);
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

    function listarMensajeTokenModelo($token)
    {
        $sql = "SELECT * FROM `mensaje_carta` INNER JOIN carrito ON carrito.id_carrito = mensaje_carta.id_carrito WHERE mensaje_carta.token = ? AND carrito.pago = 1";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $token, PDO::PARAM_STR);
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
