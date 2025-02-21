<?php
require_once 'conexion.php';
class ModeloCarrito
{
    public $tabla = "carrito";

    function agregarProductoCarritoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_producto, precio, cantidad, token, pago) VALUE (?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != null) {
            $stms->bindParam(1, $dato['id'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['precio'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['cant'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['token'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['id_cliente'], PDO::PARAM_INT);
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

    function listarProductoCarrito()
    {
        $sql = "SELECT *, carrito.precio AS precio_carrito, carrito.cantidad AS cant_carrito FROM $this->tabla INNER JOIN productos ON productos.id_producto = carrito.id_producto INNER JOIN fotos_producto ON fotos_producto.id_producto = productos.id_producto WHERE token = ? AND pago = 0";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $GLOBALS['codigo_global'], PDO::PARAM_STR);
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

    function listarTablasCarrito()
    {
        $sql = "SELECT table_name FROM information_schema.columns WHERE column_name = 'id_carrito' AND table_schema = 'eflowers_tiendae20flowers'";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);

        try {
            if ($stms->execute()) {
                return $stms->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function obtenerTablasPorID($tabla, $id_carrito)
    {
        $sql = "DELETE FROM $tabla WHERE id_carrito = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id_carrito, PDO::PARAM_INT);

        try {
            if ($stms->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function totalCarrito()
    {
        $sql = "SELECT SUM(precio*cantidad) FROM $this->tabla WHERE token = ? AND pago = 0";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $GLOBALS['codigo_global'], PDO::PARAM_STR);
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

    function countCarrito()
    {
        $sql = "SELECT COUNT(precio) FROM $this->tabla WHERE token = ? AND pago = 0";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $GLOBALS['codigo_global'], PDO::PARAM_STR);
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

    function actualizarCantCarritoProductoModelo($id, $cant)
    {
        $sql = "UPDATE $this->tabla SET cantidad = ? WHERE id_carrito = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $cant, PDO::PARAM_INT);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
        try {
            if ($stms->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "No se pudo actualizar."]);
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarPagoCarrito()
    {
        $sql = "UPDATE $this->tabla SET pago = 1 WHERE token = ? AND pago = 0";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $GLOBALS['codigo_global'], PDO::PARAM_STR);
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
