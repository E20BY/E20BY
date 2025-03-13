<?php
session_start();
//controlador
foreach (glob("../controllers/*.php") as $filename) {
    require_once $filename;
}

// Requiere todos los archivos en la carpeta 'models'
foreach (glob("../models/*.php") as $filename) {
    require_once $filename;
}

class Ajax
{
    public $producto;
    public $categoria;
    public $id_producto;
    public $id_reviews;
    public $id_carrito;
    public $cantidad;

    function consultarProductoAjax()
    {
        $listar = new ControladorProducto();
        $res = $listar->consultarProductoAjaxControlador($this->producto);
        header('Content-Type: text/html; charset=UTF-8');
        foreach ($res as $key => $value) {
            $dato[] = array(
                'id' => $value['id_producto'],
                'label' => $value['producto'],
                'nom_es' => $value['nombre_es'],
                'precio' => $value['precio'],
                'canti_flores' => $value['cantidad_flores'],
                'cant' => $value['cantidad'],
                'desc' => $value['descripcion'],
                'desc_es' => $value['descripcion_es'],
                'id_categoria' => $value['id_categoria'],
                'protada' => $value['foto_protada'],
                'foto1' => $value['foto1'],
                'boxFlower' => $value['box'],
                'boxColor' => $value['boxColor'],
                'flowersColor' => $value['flowersColor']
            );
        }
        print json_encode($dato);
    }
    function consultarCategoriaAjax()
    {
        $listar = new ControladorCategoria();
        $res = $listar->consultarCategoriaAjaxControlador($this->categoria);
        header('Content-Type: text/html; charset=UTF-8');
        foreach ($res as $key => $value) {
            $dato[] = array(
                'id' => $value['id_categoria'],
                'label' => $value['nombre']
            );
        }
        print json_encode($dato);
    }
    function eliminarLocalIdMasivo($id)
    {
        $listar = new ModeloProducto();
        $res = $listar->listarTablasProducto();
        foreach ($res as $key => $value) {
            $listar->obtenerTablasPorID($value['table_name'], $id);
        }
    }
    function eliminarReviewsIdMasivo($id)
    {
        $listar = new ModeloReview();
        $res = $listar->listarTablasReviews();
        foreach ($res as $key => $value) {
            $listar->obtenerTablasPorID($value['table_name'], $id);
        }
    }
    function eliminarCarritoIdMasivo($id)
    {
        $listar = new ModeloCarrito();
        $res = $listar->listarTablasCarrito();
        foreach ($res as $key => $value) {
            $listar->obtenerTablasPorID($value['table_name'], $id);
        }
    }

    function actualizarCantidadProductoCarrito($id, $cant)
    {
        $act = new ControladorCarrito();
        $res = $act->actualizarCantCarritoProducto($id, $cant);
    }
    function actualizarCliente($dato)
    {
        $actu = new ModeloCliente();
        $res = $actu->actualizarCLienteAjax($dato);
    }

    function registrarConsultarCLienteAjax($dato)
    {
        $actu = new ModeloCliente();
        $res = $actu->registrarConsultarCLienteAjax($dato);
    }
    function eliminarClienteIdMasivo($dato)
    {
        $actu = new ModeloCliente();
        $res = $actu->eliminarClienteIdMasivo($dato);
    }
}

$ajax = new Ajax();

if (isset($_GET['producto'])) {
    $ajax->producto = $_GET['producto'];
    $ajax->consultarProductoAjax();
}
if (isset($_GET['categoria'])) {
    $ajax->categoria = $_GET['categoria'];
    $ajax->consultarCategoriaAjax();
}
if (isset($_POST['id_producto_eliminar'])) {
    $id_producto = $_POST['id_producto_eliminar'];
    $red = $ajax->eliminarLocalIdMasivo($id_producto);
}
if (isset($_POST['id_reviews_eliminar'])) {
    $id_reviews = $_POST['id_reviews_eliminar'];
    $red = $ajax->eliminarReviewsIdMasivo($id_reviews);
}

if (isset($_POST['id_carrito_eliminar'])) {
    $id_carrito = $_POST['id_carrito_eliminar'];
    $red = $ajax->eliminarCarritoIdMasivo($id_carrito);
}
if (isset($_POST['id_cliente_eliminar'])) {
    $id_cliente = $_POST['id_cliente_eliminar'];
    $red = $ajax->eliminarClienteIdMasivo($id_cliente);
}
if (isset($_POST['id_carrito']) && isset($_POST['nueva_cantidad'])) {
    $id_carrito = $_POST['id_carrito'];
    $cantidad = $_POST['nueva_cantidad'];
    $red = $ajax->actualizarCantidadProductoCarrito($id_carrito, $cantidad);
}

if (isset($_GET['id_cliente'])) {
    $dato = array(
        'id_cliente' => $_GET['id_cliente'],
        'nombres' => $_GET['nombres'],
        'apellidos' => $_GET['apellidos'],
        'correo' => $_GET['correo'],
        'telefono' => $_GET['telefono'],
        'direccion1' => $_GET['direccion1'],
        'direccion2' => $_GET['direccion2'],
        'ciudad' => $_GET['ciudad'],
        'barrio' => $_GET['barrio'],
        'codigoPostal' => $_GET['codigoPostal']
    );
    $red = $ajax->actualizarCliente($dato);
}

if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['telefono'])) {
    $dato = array(
        'nombres' => $_POST['nombres'],
        'apellidos' => $_POST['apellidos'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono']
    );
    $red = $ajax->registrarConsultarCLienteAjax($dato);
}
