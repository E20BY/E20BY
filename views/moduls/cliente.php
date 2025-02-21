<?php
if (!isset($_SESSION['validarPagina'])) {
    echo "<script type='text/javascript'>window.location.href = 'inicio';</script>";
}
$reviews = new ControladorCliente();
$res = $reviews->listarCliente();

?>
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="table-responsive">
                <table id="productos" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                            <th>Barrio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id_cliente'] ?></td>
                                <td><?php echo $value['nombres'] ." ".$value['apellidos'] ?></td>
                                <td><?php echo $value['correo'] ?></td>
                                <td><?php echo $value['tel'] ?></td>
                                <td><?php echo $value['dire1'] ?></td>
                                <td><?php echo $value['ciudad'] ?></td>
                                <td><?php echo $value['barrio'] ?></td>
                                <td><a class="eliminar-button-
                                " data-id="<?php print $value['id_cliente']; ?>"><i class="fas fa-trash-alt fa-lg"></i></a></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Precio Promocion</th>
                            <th>Cantidad</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>