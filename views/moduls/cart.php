<?php
$agre = new ControladorCarrito();
$res = $agre->agregarProductoCarrito();
$cont = $agre->totalCarrito();
?>
<div class="cart-container">
    <h2 id="moduloCarrito">Carrito de Compras</h2>
    <table>
        <thead>
            <tr>
                <th id="tableProduc">Producto</th>
                <th id="tablePre">Precio</th>
                <th id="tableCats">Cantidad</th>
                <th id="tableTotal">Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            <!-- Los productos se agregarán dinámicamente aquí -->
        </tbody>
    </table>
    <div class="cart-summary">
        <h3>Total: <span id="cart-total">$0.00</span></h3>
        <button id="confirm-purchase">Confirmar Compra</button>
    </div>
</div>

<script>
    // Generar el array de objetos usando PHP y JSON
    const cartItems = <?php echo json_encode(array_map(function ($item) {
                            return [
                                'nombre' => $item['nombre'],
                                'precio' => $item['precio_carrito'],
                                'cantidad' => $item['cant_carrito'],
                                'id' => $item['id_carrito']
                            ];
                        }, $res)); ?>;
    
    console.log(cartItems); // Verifica los valores generados


    function renderCart() {
        const cartTable = document.getElementById("cart-items");
        cartTable.innerHTML = "";
        let total = 0;

        cartItems.forEach((item, index) => {
            const precio = parseFloat(item.precio) || 0; // Convertir a número
            const cantidad = parseInt(item.cantidad) || 0; // Convertir a entero
            const subtotal = precio * cantidad;
            total += subtotal;

            // Formatear números con separador de miles y dos decimales
            const precioFormateado = precio.toLocaleString('es-ES', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            const subtotalFormateado = subtotal.toLocaleString('es-ES', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${item.nombre}</td>
            <td>$${precioFormateado}</td>
            <td>
                <div class="quantity">
                    <button class="btn-minus">-</button>
                    <input type="hidden" class="form-control" value="${cantidad}">
                    ${cantidad}
                    <button class="btn-plus">+</button>
                </div>
            </td>
            <td>$${subtotalFormateado}</td>
            <td class="align-middle">
                <button class="btn btn-sm btn-danger eliminar-button-carrito" data-id="${item.id}">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        `;
            cartTable.appendChild(row);
        });

        // Formatear el total con separadores de miles
        document.getElementById("cart-total").textContent = `$${total.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }

    document.getElementById("confirm-purchase").addEventListener("click", () => {
        window.location = "pedido";
    });


    renderCart();
</script>