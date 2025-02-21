<?php
class ControladorFotosProductos
{
    function agregarFotosProductos($dato)
    {
        $agrear = new ModeloFotosProductos();
        $res = $agrear->agregarFotosProductosModelo($dato);
        return $res;
    }

    function actualizarFotosProductos($dato){
        $agrear = new ModeloFotosProductos();
        $res = $agrear->agctualizarFotosProductosModelo($dato);
        return $res;
    }
}

