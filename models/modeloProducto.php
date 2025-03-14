<?php
require_once 'conexion.php';
class ModeloProducto
{
    public $tabla = "productos";
    function agregarProductoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(nombre,nombre_es,prefijoi_nom,precio,precio_descuento,cantidad_flores,cantidad,id_categoria,box,boxColor,flowersColor) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nom'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nom_es'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['prefijo_nom'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['precio'], PDO::PARAM_INT);
            $stms->bindParam(5, $dato['precioPromo'], PDO::PARAM_INT);
            $stms->bindParam(6, $dato['cantiFlores'], PDO::PARAM_INT);
            $stms->bindParam(7, $dato['cant'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['id_categoria'], PDO::PARAM_INT);
            $stms->bindParam(9, $dato['boxFlower'], PDO::PARAM_INT);
            $stms->bindParam(10, $dato['box'], PDO::PARAM_INT);
            $stms->bindParam(11, $dato['flowersColor'], PDO::PARAM_INT);
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

    function obtenerUltimoIdProducto()
    {
        $sql = "SELECT MAX(id_producto) FROM $this->tabla";
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

    function listarProductosModelo()
    {
        $sql = "SELECT *, categoria.nombre AS categoria, productos.nombre AS producto FROM $this->tabla INNER JOIN descripcion_producto ON descripcion_producto.id_producto = productos.id_producto INNER JOIN categoria ON categoria.id_categoria = productos.id_categoria INNER JOIN fotos_producto ON fotos_producto.id_producto = productos.id_producto ORDER BY `productos`.`id_producto` ASC";
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

    function listarPrecioFiltroModelo(){
        $sql = "SELECT DISTINCT precio FROM $this->tabla ORDER BY $this->tabla.precio ASC";
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

    function consultarProductoAjaxModelo($dato)
    {
        $sql = "SELECT *, categoria.nombre AS categoria, productos.nombre AS producto FROM $this->tabla INNER JOIN categoria ON categoria.id_categoria = productos.id_categoria INNER JOIN descripcion_producto ON descripcion_producto.id_producto = productos.id_producto INNER JOIN fotos_producto ON fotos_producto.id_producto = productos.id_producto WHERE productos.nombre like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $nom = "%" . $dato . "%";
            $stms->bindParam(1, $nom, PDO::PARAM_STR);
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

    function actualizarProductoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre= ?,nombre_es =?, prefijoi_nom = ?, precio= ?,precio_descuento= ?,cantidad_flores=?,cantidad= ?,id_categoria= ?, box = ?, boxColor = ?, flowersColor = ? WHERE id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nom'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nom_es'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['prefijo_nom'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['precio'], PDO::PARAM_INT);
            $stms->bindParam(5, $dato['precioPromo'], PDO::PARAM_INT);
            $stms->bindParam(6, $dato['cantiFlores'], PDO::PARAM_INT);
            $stms->bindParam(7, $dato['cant'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['id_categoria'], PDO::PARAM_INT);
            $stms->bindParam(9, $dato['boxFlower'], PDO::PARAM_INT);
            $stms->bindParam(10, $dato['box'], PDO::PARAM_INT);
            $stms->bindParam(11, $dato['flowersColor'], PDO::PARAM_INT);
            $stms->bindParam(12, $dato['id'], PDO::PARAM_INT);
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

    function listarTablasProducto()
    {
        $sql = "SELECT table_name FROM information_schema.columns WHERE column_name = 'id_producto' AND table_schema = 'eflowers_tiendae20flowers'";
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

    function obtenerTablasPorID($tabla, $id_producto)
    {
        $sql = "DELETE FROM $tabla WHERE id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id_producto, PDO::PARAM_INT);

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

    function listarProductoIdModelo($id)
    {
        $sql = "SELECT *, categoria.nombre AS categoria, productos.nombre AS producto FROM $this->tabla INNER JOIN categoria ON categoria.id_categoria = productos.id_categoria INNER JOIN fotos_producto ON fotos_producto.id_producto = productos.id_producto INNER JOIN descripcion_producto ON descripcion_producto.id_producto = productos.id_producto WHERE productos.id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_STR);

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
