<?php
if (!isset($_SESSION['validarPagina'])) {
    echo "<script type='text/javascript'>window.location.href = 'inicio';</script>";
}
$agregar = new ControladorProducto();
$res = $agregar->agregarProducto();
$cat = new ControladorCategoria();
$resCat = $cat->agregarCategoria();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Button trigger modal -->
            <button id="openModalBtn" class="btn-modal">
                <i class="fas fa-plus fa-lg"></i>
            </button>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <div class="table-responsive">
                <table id="productos" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id_producto'] ?></td>
                                <td><img src="<?php echo $value['foto_protada'] ?>" width="100px" height="100px" alt=""></td>
                                <td><?php echo $value['producto'] ?></td>
                                <td><?php echo number_format($value['precio'], 0) ?></td>
                                <td><?php echo $value['categoria'] ?></td>
                                <td><a class="eliminar-button-producto" data-id="<?php print $value['id_producto']; ?>"><i class="fas fa-trash-alt fa-lg"></i></a></a></td>
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
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar Productos-->
<div id="productModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Agregar Producto</h5>
            <span id="closeModalBtn" class="close-btn">&times;</span>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombre</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nombre" id="producto" class="form-control" placeholder="Nombre Producto">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Precio</label>
                        <input type="text" name="precio" id="precio_1" class="form-control precio" placeholder="Precio Producto">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Cantidad Flores</label>
                        <input type="text" name="canti_flores" class="form-control" placeholder="Cantidad Flores">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Cantidad</label>
                        <input type="text" name="cant" class="form-control" placeholder="Cantidad Producto">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Categoria</label>
                        <select name="id_categoria" class="form-control">
                            <option value="">--Seleccione Categoria--</option>
                            <?php
                            foreach ($resCat as $key => $value) {
                            ?>
                                <option value="<?php echo $value['id_categoria'] ?>"><?php echo $value['nombre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <h3 class="mt-2">Imagenes</h3>
                <div class="row mt-2">
                    <div class="col-md-6 form-group">
                        <label>Portada</label>
                        <input type="hidden" name="portadaEdit">
                        <input type="file" id="uploadImage1" name="portada" class="form-control" onchange="previewImage1(1);">
                        <img id="uploadPreview1" width="350" height="200" class="mb-3" src="views/img/img.jpg" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Foto1</label>
                        <input type="hidden" name="foto1Edit">
                        <input type="file" id="uploadImage2" name="foto1" class="form-control" onchange="previewImage1(2);">
                        <img id="uploadPreview2" width="350" height="200" class="mb-3" src="views/img/img.jpg" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="agregarProducto" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>