<?php
class ControladorUsuario
{
    function loginControlador()
    {

        if (isset($_POST['login'])) {

            $dato = array(
                'user' => $_POST['user'],
                'clave' => $_POST['clave']
            );
            $consultarUsuario = new ModeloUsuario();
            $resPagina = $consultarUsuario->ModeloLoginIngresarPagina($dato);
            if ($resPagina != []) {
                if ($resPagina[0]['usuario'] == $_POST['user'] && $resPagina[0]['clave'] == $_POST['clave']) {
                    $_SESSION['validarPagina'] = true;
                    echo "<script type='text/javascript'>window.location.href = 'producto';</script>";
                } else {
                    header('Location: ingresar?action=loginFallido');
                    exit;
                }
            } else {
                header('Location: ingresar?action=loginFallido');
                exit;
            }
        }
    }
}
