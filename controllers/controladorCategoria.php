<?php
class ControladorCategoria
{
    function agregarCategoria()
    {
        if (isset($_POST['agregarCategoria'])) {
            if ($_POST['id'] > 0) {
                $dato = array(
                    'id' => $_POST['id'],
                    'nom' => $_POST['nombre']
                );
                $agregar = new ModeloCategoria();
                $res = $agregar->actualizarCategoria($dato);
                if ($res == true) {
                    echo "<script type='text/javascript'>window.location.href = 'actualizarCategoria';</script>";
                }
            } else {
                $nombre = $_POST['nombre'];
                $agregar = new ModeloCategoria();
                $res = $agregar->agregarCategoria($nombre);
                if ($res == true) {
                    echo "<script type='text/javascript'>window.location.href = 'agregarCategoria';</script>";
                }
            }
        }
        $lis = new ModeloCategoria();
        $res = $lis->listarCategoria();
        return $res;
    }

    function consultarCategoriaAjaxControlador($dato)
    {
        $lis = new ModeloCategoria();
        $res = $lis->consultarCategoriaAjaxModelo($dato);
        return $res;
    }

    function eliminarCategoria()
    {
        if (isset($_GET['id'])) {
            $lis = new ModeloCategoria();
            $res = $lis->eliminarCategoriaModelo($_GET['id']);
            if ($res == true) {
                echo "<script type='text/javascript'>window.location.href = 'eliminarCategoria';</script>";
            }
        }
    }
}
