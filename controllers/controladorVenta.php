<?php
class ControladorVenta{
    function agregarVenta($dato){
        $agre = new ModeloVenta();
        $res = $agre->agregarVentaModelo($dato);
        return $res;
    }

    function listarVentaFactura($id){
        $lis = new ModeloVenta();
        $res = $lis->listarVentaFacturaModelo($id);
        return $res;
    }
}