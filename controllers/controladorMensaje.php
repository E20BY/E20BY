<?php

class ControladorMensaje
{
    function agregarCarritoMensaje($dato)
    {
        $men = new ModeloMensaje();
        $res = $men->agregarCarritoMensajeModelo($dato);
        return $res;
    }

    function listarMensajeToken($dato){
        $me = new ModeloMensaje();
        $res = $me->listarMensajeTokenModelo($dato);
        return $res;
    }
}
