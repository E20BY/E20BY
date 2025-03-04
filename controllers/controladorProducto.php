<?php
class ControladorProducto
{
    function agregarProducto()
    {
        if (isset($_POST['agregarProducto'])) {
            if ($_POST['id'] > 0) {
                $dato = array(
                    'id' => $_POST['id'],
                    'nom' => $_POST['nombre'],
                    'nom_es' => $_POST['nombre_es'],
                    'prefijo_nom' => str_replace(' ', '_', $_POST['nombre_es']),
                    'precio' => str_replace(',', '', $_POST['precio']),
                    'precioPromo' => 0,
                    'cantiFlores' => $_POST['canti_flores'],
                    'cant' => $_POST['cant'],
                    'id_categoria' => $_POST['id_categoria']
                );
                $agregar = new ModeloProducto();
                $res = $agregar->actualizarProductoModelo($dato);
                if ($res == true) {
                    $datoInfo = array(
                        'id_producto' => $_POST['id'],
                        'descrip' => $_POST['descrip'],
                        'descrip_es' => $_POST['descrip_es'],
                        'prefijo_des' => str_replace(' ', '_', $_POST['descrip_es'])
                    );
                    $agregarDescripcion = new ControladorDescripcionProducto();
                    $resDescrip = $agregarDescripcion->actualizarDescripcionProducto($datoInfo);
                    if ($resDescrip == true) {
                        $targetDir = 'views/img/productos/';
                        // Inicializar el array de imágenes
                        $datoImagenes = [
                            'id_producto' => $_POST['id'],
                            'portada' => $_POST['portadaEdit'] ?? null,
                            'foto1' => $_POST['foto1Edit'] ?? null,
                        ];

                        // Campos de archivo
                        $files = ['portada', 'foto1'];

                        foreach ($files as $fileKey) {
                            if (isset($_FILES[$fileKey]['name']) && $_FILES[$fileKey]['name'] != "") {
                                // Obtenemos información del archivo
                                $archivo = $_FILES[$fileKey]['name'];
                                $tipo = $_FILES[$fileKey]['type'];
                                $tamano = $_FILES[$fileKey]['size'];
                                $temp = $_FILES[$fileKey]['tmp_name'];

                                // Validar tipo y tamaño
                                if ((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000)) {
                                    // Generar un nombre único para evitar conflictos
                                    $nombreUnico = uniqid($fileKey . '_') . '.' . pathinfo($archivo, PATHINFO_EXTENSION);

                                    // Intentar subir el archivo
                                    if (move_uploaded_file($temp, $targetDir . $nombreUnico)) {
                                        chmod($targetDir . $nombreUnico, 0777); // Cambiar permisos
                                        $datoImagenes[$fileKey] = 'views/img/productos/' . $nombreUnico; // Guardar el nombre en el array
                                    } else {
                                        echo '<div><b>Error al subir el archivo "' . $archivo . '".</b></div>';
                                    }
                                } else {
                                    echo '<div><b>Error: El archivo "' . $archivo . '" no cumple con los requisitos.</b></div>';
                                }
                            } else {
                                // Si no se subió un archivo, usar el valor existente
                                //echo '<div><b>Usando imagen preexistente para "' . $fileKey . '".</b></div>';
                            }
                            $agregarFotos = new ControladorFotosProductos();
                            $resFotos = $agregarFotos->actualizarFotosProductos($datoImagenes);
                            if ($resFotos == true) {
                                echo "<script type='text/javascript'>window.location.href = 'agctualizarProductp';</script>";
                            } else {
                                echo "<script type='text/javascript'>window.location.href = 'falloProducto';</script>";
                            }
                        }
                    }
                }
            } else {
                $dato = array(
                    'nom' => $_POST['nombre'],
                    'nom_es' => $_POST['nombre_es'],
                    'prefijo_nom' => str_replace(' ', '_', $_POST['nombre_es']),
                    'precio' => str_replace(',', '', $_POST['precio']),
                    'precioPromo' => 0,
                    'cantiFlores' => $_POST['canti_flores'],
                    'cant' => $_POST['cant'],
                    'id_categoria' => $_POST['id_categoria']
                );
                $agregar = new ModeloProducto();
                $res = $agregar->agregarProductoModelo($dato);
                if ($res == true) {
                    $ultimoId = $agregar->obtenerUltimoIdProducto();
                    $datoInfo = array(
                        'id_producto' => $ultimoId[0]['MAX(id_producto)'],
                        'descrip' => $_POST['descrip'],
                        'descrip_es' => $_POST['descrip_es'],
                        'prefijo_des' => str_replace(' ', '_', $_POST['descrip_es'])
                    );
                    $agregarDescripcion = new ControladorDescripcionProducto();
                    $resDescrip = $agregarDescripcion->agregarDescripcionProducto($datoInfo);
                    if ($resDescrip == true) {
                        $targetDir = 'views/img/productos/';
                        // Inicializar el array de imágenes
                        $datoImagenes = [
                            'id_producto' => $ultimoId[0]['MAX(id_producto)'],
                            'portada' => null,
                            'foto1' => null,
                        ];

                        // Campos de archivo
                        $files = ['portada', 'foto1'];

                        foreach ($files as $fileKey) {
                            if (isset($_FILES[$fileKey]['name']) && $_FILES[$fileKey]['name'] != "") {
                                // Obtenemos información del archivo
                                $archivo = $_FILES[$fileKey]['name'];
                                $tipo = $_FILES[$fileKey]['type'];
                                $tamano = $_FILES[$fileKey]['size'];
                                $temp = $_FILES[$fileKey]['tmp_name'];

                                // Validar tipo y tamaño
                                if ((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000)) {
                                    // Generar un nombre único para evitar conflictos
                                    $nombreUnico = uniqid($fileKey . '_') . '.' . pathinfo($archivo, PATHINFO_EXTENSION);

                                    // Intentar subir el archivo
                                    if (move_uploaded_file($temp, $targetDir . $nombreUnico)) {
                                        chmod($targetDir . $nombreUnico, 0777); // Cambiar permisos
                                        $datoImagenes[$fileKey] = 'views/img/productos/' . $nombreUnico; // Guardar el nombre en el array
                                    } else {
                                        echo '<div><b>Error al subir el archivo "' . $archivo . '".</b></div>';
                                    }
                                } else {
                                    echo '<div><b>Error: El archivo "' . $archivo . '" no cumple con los requisitos.</b></div>';
                                }
                            } else {
                                echo '<div><b>No se seleccionó ningún archivo para el campo "' . $fileKey . '".</b></div>';
                            }
                        }
                        $agregarFotos = new ControladorFotosProductos();
                        $resFotos = $agregarFotos->agregarFotosProductos($datoImagenes);
                        if ($resFotos == true) {
                            echo "<script type='text/javascript'>window.location.href = 'agregarProductp';</script>";
                        } else {
                            echo "<script type='text/javascript'>window.location.href = 'falloProducto';</script>";
                        }
                    }
                }
            }
        }
        $listar = new ModeloProducto();
        $res = $listar->listarProductosModelo();
        return $res;
    }

    function listarPrecioFiltro()
    {
        $listar = new ModeloProducto();
        $res = $listar->listarPrecioFiltroModelo();
        return $res;
    }

    function consultarProductoAjaxControlador($dato)
    {
        $lis = new ModeloProducto();
        $res = $lis->consultarProductoAjaxModelo($dato);
        return $res;
    }

    function listarProductoIdControlador()
    {
        if (isset($_GET['id'])) {
            $lis = new ModeloProducto();
            $res = $lis->listarProductoIdModelo($_GET['id']);
            return $res;
        }
    }
}
