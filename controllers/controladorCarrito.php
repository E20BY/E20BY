<?php
class ControladorCarrito
{
    function agregarProductoCarrito()
    {
        if (isset($_GET['id'])) {
            $lis = new ModeloProducto();
            $res = $lis->listarProductoIdModelo($_GET['id']);
            $precio = $res[0]['precio'];
            if (isset($_GET['cant'])) {
                $cant = $_GET['cant'];
            } else {
                $cant = 1;
            }
            $dato = array(
                'id' => $_GET['id'],
                'precio' => $precio,
                'cant' => $cant,
                'token' => $GLOBALS['codigo_global'],
                'id_cliente' => 0
            );
            $agregar = new ModeloCarrito();
            $res = $agregar->agregarProductoCarritoModelo($dato);
            if ($res == true) {
                
                $ultimoid = $agregar->obtenerUltimoIdModelo();
                $dato = array(
                    'id' => $ultimoid[0]['MAX(id_carrito)'],
                    'token' => $GLOBALS['codigo_global'],
                    'men' => $_GET['mess'],
                    'date' => $_GET['date'],
                    'time' => $_GET['time'],
                    'box' => $_GET['box'],
                    'boxName' => $_GET['boxName'],
                    'flowerName' => $_GET['flowerName']
                );
                $mensaje = new ControladorMensaje();
                $res_mensaje = $mensaje->agregarCarritoMensaje($dato);
                if ($res_mensaje == true) {
                    echo "<script type='text/javascript'>window.location.href = 'cart';</script>";
                }
            }
        }

        $lis =  new ModeloCarrito();
        $res = $lis->listarProductoCarrito();
        return $res;
    }

    function totalCarrito()
    {
        $con =  new ModeloCarrito();
        $res = $con->totalCarrito();
        return $res;
    }

    function actualizarCantCarritoProducto($id, $cant)
    {
        $actu = new ModeloCarrito();
        $res = $actu->actualizarCantCarritoProductoModelo($id, $cant);
        return $res;
    }

    function actualizarPagoCarrito()
    {
        $cart = new ModeloCarrito();
        $res = $cart->actualizarPagoCarrito();
    }
}
