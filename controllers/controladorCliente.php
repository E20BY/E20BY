<?php
class ControladorCliente
{
    function listarCliente()
    {
        $lis = new ModeloCliente();
        $res = $lis->listarClientes();
        return $res;
    }
    function listarclientetoken($token)
    {
        $listar = new ModeloCliente();
        $res = $listar->listarclientetokenModelo($token);
        return $res;
    }
}
