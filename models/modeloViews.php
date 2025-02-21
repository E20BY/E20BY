<?php
class ModeloViews
{

    private $directorioModulos = 'views/moduls/';
    private $modulosValidos = [];

    public function __construct()
    {
        $this->cargarModulosValidos($this->directorioModulos);
    }

    private function cargarModulosValidos($directorio)
    {
        // Abrir el directorio y leer los archivos
        if ($handle = opendir($directorio)) {
            while (false !== ($entry = readdir($handle))) {
                // Ignorar los directorios '.' y '..'
                if ($entry != '.' && $entry != '..' && pathinfo($entry, PATHINFO_EXTENSION) == 'php') {
                    // Agregar el nombre del archivo sin la extensión a la lista de módulos válidos
                    $this->modulosValidos[] = pathinfo($entry, PATHINFO_FILENAME);
                }
            }
            closedir($handle);
        }
    }


    public function enlacePagina($enlace)
    {
        $directorioBase = $this->directorioModulos;

        // Definir las rutas de redirección según el valor de $enlace
        switch ($enlace) {
            case 'loginFallido':
            case 'loginInactivo':
            case 'LoginSuspendidoPorPago':
                $modulo = 'ingresar.php';
                break;
            case 'agregarProductp':
            case 'agctualizarProductp':
            case 'falloProducto':
            case 'eliminarProducto';
                $modulo = 'producto.php';
                break;
            case 'agregarCategoria':
            case 'actualizarCategoria':
            case 'eliminarCategoria':
                $modulo = 'categoria.php';
                break;
            default:
                $modulo = $enlace . '.php';
                break;
        }

        // Construir la ruta completa del módulo
        $moduloRuta = $directorioBase . $modulo;
        // Verificar si el módulo existe en la lista de módulos válidos y en el directorio correspondiente
        if (in_array(pathinfo($modulo, PATHINFO_FILENAME), $this->modulosValidos) && file_exists($moduloRuta)) {
            return $moduloRuta;
        } else {
            // Retornar 404 si no se encuentra el módulo
            return $this->directorioModulos . 'inicio.php';
        }
    }
}
