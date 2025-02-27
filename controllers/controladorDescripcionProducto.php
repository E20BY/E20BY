<?php
class ControladorDescripcionProducto
{
    function agregarDescripcionProducto($dato)
    {
        $agregar = new ModeloDescripcionProducto();
        $res = $agregar->agregarDescripcionProductoModelo($dato);
        return $res;
    }
    function actualizarDescripcionProducto($dato)
    {
        $agregar = new ModeloDescripcionProducto();
        $res = $agregar->actualizarDescripcionProductoModelo($dato);
        return $res;
    }
}
