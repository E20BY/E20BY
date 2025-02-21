<?php
if (!isset($_SESSION['validarPagina'])) {
    echo "<script type='text/javascript'>window.location.href = 'inicio';</script>";
}
$cat = new ControladorCategoria();
$resCat = $cat->agregarCategoria();
$cat->eliminarCategoria();
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
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resCat as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id_categoria'] ?></td>
                                <td><?php echo $value['nombre'] ?></td>
                                <td><a href="index.php?action=categoria&id=<?php echo $value['id_categoria'] ?>"><i class="fas fa-trash-alt fa-lg"></i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
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
            <h5>Agregar Categoria</h5>
            <span id="closeModalBtn" class="close-btn">&times;</span>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombre</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nombre" id="categoria" class="form-control" placeholder="Nombre Categoria">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="agregarCategoria" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>