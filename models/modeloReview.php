<?php
require_once 'conexion.php';
class ModeloReview
{
    public $tabla = "reviews";
    function agregarReviewsModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_producto, nombre,info,correo) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['opinion'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['correo'], PDO::PARAM_STR);
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

    function listarReviews(){
        $sql = "SELECT *,productos.nombre AS producto, reviews.nombre AS reviews FROM $this->tabla INNER JOIN productos ON reviews.id_producto = productos.id_producto";
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

    function listarReviewsId($id){
        $sql = "SELECT * FROM $this->tabla WHERE id_producto = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $id, PDO::PARAM_INT);
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

    function listarTablasReviews()
    {
        $sql = "SELECT table_name FROM information_schema.columns WHERE column_name = 'id_reviews' AND table_schema = 'eflowers_tiendae20flowers'";
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

    function obtenerTablasPorID($tabla, $id_reviews)
    {
        $sql = "DELETE FROM $tabla WHERE id_reviews = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id_reviews, PDO::PARAM_INT);

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

    function listarReviewsInfoModelo(){
        $sql = "SELECT fotos_producto.foto_protada, reviews.nombre, reviews.info FROM $this->tabla INNER JOIN fotos_producto ON fotos_producto.id_producto = reviews.id_producto;";
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
}
