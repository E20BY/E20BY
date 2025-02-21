<?php

$reviews = new ControladorReview();
$res = $reviews->agregarReview();

?>
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="table-responsive">
                <table id="productos" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Mensaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id_reviews'] ?></td>
                                <td><?php echo $value['producto'] ?></td>
                                <td><?php echo $value['reviews'] ?></td>
                                <td><?php echo $value['correo'] ?></td>
                                <td><?php echo $value['info'] ?></td>
                                <td><a class="eliminar-button-reviews" data-id="<?php print $value['id_reviews']; ?>"><i class="fas fa-trash-alt fa-lg"></i></a></a></td>
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