<?php
$lis = new ControladorFactura();
$res = $lis->listarFactura();
if (isset($_GET['id'])) {
    $lis = new ControladorVenta();
    $resventa = $lis->listarVentaFactura($_GET['id']);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="" method="post" class="form-container">
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" id="fecha">
                </div>
                <button name="buscar" class="btn btn-primary w-100 mt-2">Buscar</button>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <div class="table-responsive">
                <table id="productos" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Envio</th>
                            <th>Total Factura</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['id_factura'] ?></td>
                                <td><?php echo $value['token'] ?></td>
                                <td><?php echo $value['fecha'] ?></td>
                                <td><?php echo number_format($value['envio'], 0) ?></td>
                                <td><?php echo number_format($value['total'], 0) ?></td>
                                <td><a href="index.php?action=ventas&id=<?php echo $value['id_factura'] ?>">Ver</a></td>
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
            <h5>Factura <?php echo $_GET['id'] ?></h5>
            <span id="closeModalBtn" class="close-btn">&times;</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Envio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($resventa as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['nombre'] ?></td>
                            <td><?php echo number_format($value['precio_venta'], 0) ?></td>
                            <td><?php echo $value['canti_venta'] ?></td>
                            <td><?php echo number_format(5000, 0) ?></td>
                            <td><?php echo number_format($value['precio_cantidad'] + 5000, 0) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const params = new URLSearchParams(window.location.search);

        // Verificar si existe el parámetro 'id' en la URL
        if (params.has('id')) {
            const modal = document.getElementById('productModal');
            modal.style.display = "block"; // Mostrar el modal
        }

        // Evento para cerrar el modal al hacer clic en la 'X'
        const closeModalBtn = document.getElementById('closeModalBtn');
        closeModalBtn.addEventListener('click', function() {
            const modal = document.getElementById('productModal');
            window.location.href = 'ventas';
        });

        // Cerrar el modal si el usuario hace clic fuera del modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('productModal');
            if (event.target === modal) {
                modal.style.display = "none"; // Ocultar el modal si se hace clic fuera de él
            }
        });
    });
</script>