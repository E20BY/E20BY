function previewImage1(nb) {
    var reader = new FileReader();
    reader.readAsDataURL(document.getElementById('uploadImage' + nb).files[0]);
    reader.onload = function (e) {
        document.getElementById('uploadPreview' + nb).src = e.target.result;
    };

}
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.eliminar-button-local');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Realiza una llamada AJAX para eliminar el registro
                fetch('views/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_locaEliminar=' + id
                })
                    .then(response => response.json())
                    .then(data => {
                        // Verifica si la eliminación fue exitosa
                        if (data.success) {
                            alert('Registro eliminado correctamente.');
                            location.reload(); // Recarga la página
                        } else {
                            alert('Error al eliminar el registro.');
                            location.reload(); // Recarga la página
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Registro eliminado correctamente.');
                        location.reload(); // Recarga la página
                    });
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('keydown', '.precio', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];

        let cantidad = document.getElementById('precio_' + index + '');
        cantidad.addEventListener("keyup", function () {
            // Eliminar caracteres no numéricos
            let value = cantidad.value.replace(/\D/g, '');

            // Añadir coma para separar miles
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Agregar el símbolo de la moneda o unidad
            value = value; // Puedes cambiar 'kg' por el símbolo que desees

            // Establecer el valor formateado en el campo de entrada
            cantidad.value = value;
        });
    });
});

//Autocomplete
$("#producto").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: 'views/ajax.php',
            type: 'get',
            dataType: 'json',
            data: { producto: request.term },
            success: function (data) {
                response(data);
                //console.log("el dato", data);

            }

        });
    },
    minLength: 1,
    select: function (event, ui) {
        $(this).val(ui.item.label);
        value = ui.item.precio;

        // Agregar el símbolo de la moneda o unidad
        precio = value; // Puedes cambiar 'kg' por el símbolo que desees
        value1 = ui.item.desc;

        // Agregar el símbolo de la moneda o unidad
        desc = value1; // Puedes cambiar 'kg' por el símbolo que desees

        document.querySelector('input[name="id"]').value = ui.item.id;
        document.querySelector('input[name="nombre_es"]').value = ui.item.nom_es;
        document.querySelector('input[name="precio"]').value = precio;
        document.querySelector('input[name="cant"]').value = ui.item.cant;
        document.querySelector('input[name="canti_flores"]').value = ui.item.canti_flores;
        document.querySelector('textarea[name="descrip"]').value = ui.item.desc;
        document.querySelector('textarea[name="descrip_es"]').value = ui.item.desc_es;
        const id_categoria = document.querySelector('select[name="id_categoria"]');
        id_categoria.value = ui.item.id_categoria;
        document.querySelector('input[name="portadaEdit"]').value = ui.item.protada;
        document.querySelector('input[name="foto1Edit"]').value = ui.item.foto1;
        document.getElementById('uploadPreview1').src = ui.item.protada;
        document.getElementById('uploadPreview2').src = ui.item.foto1;
        return false;
    }

});
//categoria
$("#categoria").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: 'views/ajax.php',
            type: 'get',
            dataType: 'json',
            data: { categoria: request.term },
            success: function (data) {
                response(data);
                //console.log("el dato", data);

            }

        });
    },
    minLength: 1,
    select: function (event, ui) {
        $(this).val(ui.item.label);
        document.querySelector('input[name="id"]').value = ui.item.id;
        return false;
    }

});
//eliminar todos los productos
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.eliminar-button-producto');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Realiza una llamada AJAX para eliminar el registro
                fetch('views/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_producto_eliminar=' + id
                })
                    .then(response => response.json())
                    .then(data => {
                        // Verifica si la eliminación fue exitosa
                        if (data.success) {
                            alert('Registro eliminado correctamente.');
                            location.reload(); // Recarga la página
                        } else {
                            alert('Error al eliminar el registro.');
                            location.reload(); // Recarga la página
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Registro eliminado correctamente.');
                        location.reload(); // Recarga la página
                    });
            }
        });
    });
});
//eliminar reviews
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.eliminar-button-reviews');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Realiza una llamada AJAX para eliminar el registro
                fetch('views/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_reviews_eliminar=' + id
                })
                    .then(response => response.json())
                    .then(data => {
                        // Verifica si la eliminación fue exitosa
                        if (data.success) {
                            alert('Registro eliminado correctamente.');
                            location.reload(); // Recarga la página
                        } else {
                            alert('Error al eliminar el registro.');
                            location.reload(); // Recarga la página
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Registro eliminado correctamente.');
                        location.reload(); // Recarga la página
                    });
            }
        });
    });
});

//eliminar carrito
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.eliminar-button-carrito');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Realiza una llamada AJAX para eliminar el registro
                fetch('views/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_carrito_eliminar=' + id
                })
                    .then(response => response.json())
                    .then(data => {
                        // Verifica si la eliminación fue exitosa
                        if (data.success) {
                            //alert('Registro eliminado correctamente.');
                            location.reload(); // Recarga la página
                        } else {
                            alert('Error al eliminar el registro.');
                            location.reload(); // Recarga la página
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Registro eliminado correctamente.');
                        location.reload(); // Recarga la página
                    });
            }
        });
    });
});

//eliminar cliente
document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.eliminar-button-cliente');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Realiza una llamada AJAX para eliminar el registro
                fetch('views/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_cliente_eliminar=' + id
                })
                    .then(response => response.json())
                    .then(data => {
                        // Verifica si la eliminación fue exitosa
                        if (data.success) {
                            //alert('Registro eliminado correctamente.');
                            location.reload(); // Recarga la página
                        } else {
                            alert('Error al eliminar el registro.');
                            location.reload(); // Recarga la página
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Registro eliminado correctamente.');
                        location.reload(); // Recarga la página
                    });
            }
        });
    });
});

$(document).ready(function () {
    // Variables para almacenar los valores iniciales
    let initialData = {
        nombres: '',
        apellidos: '',
        correo: '',
        telefono: ''
    };

    // Detectar cuando el campo de teléfono pierde el foco (evento blur)
    $("input[name='telefono']").on('blur', function () {
        // Obtener los valores actuales de los primeros 4 campos
        let nombres = $("input[name='nombres']").val();
        let apellidos = $("input[name='apellidos']").val();
        let correo = $("input[name='correo']").val();
        let telefono = $("input[name='telefono']").val();

        // Verificar si el campo teléfono está vacío
        if (telefono === '') {
            return;  // No hacer nada si el teléfono está vacío
        }

        // Si los primeros 4 campos coinciden con los valores iniciales, buscar o crear cliente
        if (nombres !== initialData.nombres || apellidos !== initialData.apellidos || correo !== initialData.correo || telefono !== initialData.telefono) {
            initialData = { nombres, apellidos, correo, telefono };

            // Realizar la búsqueda o creación del cliente
            $.ajax({
                url: 'views/ajax.php', // PHP script para obtener los datos del cliente
                type: 'POST',
                data: { nombres, apellidos, correo, telefono },
                success: function (response) {
                    // Verifica si la respuesta es válida y tiene el campo 'found'
                    try {
                        var data = JSON.parse(response);  // Intentamos parsear la respuesta JSON
                        if (data.found !== undefined) {
                            if (data.found) {
                                // Si se encuentra el cliente, llenar los campos con los datos
                                $("input[name='id_cliente']").val(data.id_cliente);  // Asignar el id_cliente encontrado
                                $("input[name='direccion1']").val(data.direccion1);
                                $("input[name='billingAddress']").val(data.direccion1);
                                $("input[name='direccion2']").val(data.direccion2);
                                $("input[name='billingAddress2']").val(data.direccion2);
                                $("input[name='ciudad']").val(data.ciudad);
                                $("input[name='billingCity']").val(data.ciudad);
                                $("input[name='shippingCity']").val(data.ciudad);
                                $("input[name='barrio']").val(data.barrio);
                                $("input[name='codigoPostal']").val(data.codigoPostal);
                                $("input[name='zipCode']").val(data.codigoPostal);
                                $("input[name='buyerEmail']").val(data.correo);
                                //$("input[name='payerEmail']").val(data.correo);
                                $("input[name='telephone']").val(data.tel);
                                $("input[name='payerPhone']").val(data.tel);
                                $("input[name='payerOfficePhone']").val(data.tel);
                                $("input[name='payerMobilePhone']").val(data.tel);
                                $("input[name='buyerFullName']").val(data.buyerFullName);
                                $("input[name='payerFullName']").val(data.buyerFullName);
                            } else {
                                // Si no se encuentra el cliente, asignar el id_cliente generado y limpiar los demás campos
                                $("input[name='id_cliente']").val(data.id_cliente);  // Mostrar el id_cliente recién creado
                                //alert('No se encontró un cliente, se ha creado uno nuevo con el ID: ' + data.id_cliente);
                            }
                        } else {
                            console.log('Respuesta no contiene el campo "found".');
                        }
                    } catch (error) {
                        console.error('Error al procesar la respuesta JSON: ', error);
                    }
                }
            });
        }
    });

    // Detectar cambios en los otros campos y actualizar los datos del cliente
    $("input[name='direccion1'], input[name='direccion2'], input[name='ciudad'], input[name='barrio'], input[name='codigoPostal']").on('input', function () {
        // Obtener todos los datos del formulario
        let formData = {
            id_cliente: $("input[name='id_cliente']").val(), // El id_cliente, ya sea creado o encontrado
            nombres: $("input[name='nombres']").val(),
            apellidos: $("input[name='apellidos']").val(),
            correo: $("input[name='correo']").val(),
            telefono: $("input[name='telefono']").val(),
            direccion1: $("input[name='direccion1']").val(),
            direccion2: $("input[name='direccion2']").val(),
            ciudad: $("input[name='ciudad']").val(),
            barrio: $("input[name='barrio']").val(),
            codigoPostal: $("input[name='codigoPostal']").val()
        };

        // Enviar los datos al servidor para actualizar el cliente
        if (formData.id_cliente) {
            $.ajax({
                url: 'views/ajax.php', // PHP script para procesar los datos
                type: 'GET',
                data: formData,
                success: function (response) {
                    try {
                        var data = JSON.parse(response);  // Intentamos parsear la respuesta JSON

                        if (data.success) {
                            console.log('Información actualizada con éxito');
                        } else {
                            console.log('Hubo un error al actualizar los datos');
                        }
                    } catch (error) {
                        console.error('Error al parsear la respuesta del servidor:', error);
                        console.error('Respuesta recibida:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }

    });
});



/*document.addEventListener("DOMContentLoaded", function () {
    const filterContainer = document.querySelector(".filter-container");
    const productContainer = document.querySelector(".pro");
    const paginationContainer = document.querySelector(".pagination");

    let currentFilter = {
        price: []
    };
    let currentPage = 1;

    // Función para cargar productos
    function loadProducts(filter, page = 1) {
        const formData = new FormData();
        formData.append("filter", JSON.stringify(filter));
        formData.append("page", page);

        fetch("views/productos.php", {
            method: "POST",
            body: formData
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    renderProducts(data.products);
                    renderPagination(data.pagination);
                } else {
                    productContainer.innerHTML = "<p>No se encontraron productos.</p>";
                }
            })
            .catch((error) => {
                console.error("Error al cargar los productos:", error);
                productContainer.innerHTML = "<p>Error al cargar los productos.</p>";
            });
    }

    // Función para renderizar los productos
    function renderProducts(products) {
        productContainer.innerHTML = products
            .map(
                (product) => `
            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="${product.foto_protada}" alt="${product.nombre}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="index.php?action=cart&id=${product.id_producto}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="index.php?action=detail&id=${product.id_producto}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="#">${product.nombre}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            ${product.precio_descuento > 0
                        ? `<h5>$${product.precio_descuento.toLocaleString()}</h5>
                                   <h6 class="text-muted ml-2"><del>$${product.precio.toLocaleString()}</del></h6>`
                        : `<h5>$${product.precio.toLocaleString()}</h5>`}
                        </div>
                    </div>
                </div>
            </div>`
            )
            .join("");
    }

    // Función para renderizar la paginación
    function renderPagination(pagination) {
        paginationContainer.innerHTML = `
        <li class="page-item ${pagination.previousPage ? "" : "disabled"}">
            <a class="page-link" href="#" data-page="${pagination.previousPage}">Anterior</a>
        </li>
        ${pagination.pages
                .map(
                    (page) => `
            <li class="page-item ${page.active ? "active" : ""}">
                <a class="page-link" href="#" data-page="${page.number}">${page.number}</a>
            </li>`
                )
                .join("")}
        <li class="page-item ${pagination.nextPage ? "" : "disabled"}">
            <a class="page-link" href="#" data-page="${pagination.nextPage}">Próximo</a>
        </li>`;
    }

    // Manejar clics en paginación
    paginationContainer.addEventListener("click", function (event) {
        event.preventDefault();
        const target = event.target;
        if (target.tagName === "A" && target.dataset.page) {
            currentPage = parseInt(target.dataset.page);
            loadProducts(currentFilter, currentPage);
        }
    });

    // Manejar cambios en los filtros
    filterContainer.addEventListener("change", function () {
        const selectedPrices = Array.from(
            filterContainer.querySelectorAll("input[name='price-filter']:checked")
        ).map((checkbox) => checkbox.value);

        currentFilter.price = selectedPrices;
        currentPage = 1; // Reiniciar a la primera página
        loadProducts(currentFilter, currentPage);
    });

    // Cargar productos iniciales (todos los productos)
    loadProducts(currentFilter, currentPage);
});*/

document.addEventListener("DOMContentLoaded", function () {
    // Manejar el clic en botones de aumentar o disminuir cantidad
    document.querySelectorAll('.btn-plus, .btn-minus').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.quantity').querySelector('input');
            const carritoId = this.closest('tr').querySelector('.eliminar-button-carrito').getAttribute('data-id');

            let cantidadActual = parseInt(input.value) || 0;

            // Determinar si es suma o resta
            if (this.classList.contains('btn-plus')) {
                cantidadActual++;
            } else if (this.classList.contains('btn-minus')) {
                cantidadActual = Math.max(1, cantidadActual - 1); // Evitar que baje de 1
            }

            // Actualizar el input con la nueva cantidad
            input.value = cantidadActual;

            // Enviar la solicitud AJAX para actualizar la cantidad en el servidor
            const formData = new FormData();
            formData.append('id_carrito', carritoId);
            formData.append('nueva_cantidad', cantidadActual);

            fetch('views/ajax.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Error al actualizar la cantidad');
                    } else {
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Manejar el clic en botones de aumentar o disminuir cantidad
    document.querySelectorAll('.btn-sumar, .btn-restar').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.agregar-carrito').querySelector('input');

            let cantidadActual = parseInt(input.value) || 0;

            // Determinar si es suma o resta
            if (this.classList.contains('btn-sumar')) {
                cantidadActual++;
            } else if (this.classList.contains('btn-restar')) {
                cantidadActual = Math.max(1, cantidadActual - 1); // Evitar que baje de 1
            }

            // Actualizar el input con la nueva cantidad
            input.value = cantidadActual;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los elementos con la clase 'product'
    const what = document.querySelectorAll(".url");
    // Agrega un evento de clic a cada producto
    what.forEach(what => {
        what.addEventListener("click", function () {
            // Redirige a la página de detalles
            const url = `https://wa.me/+17863974240`;
            window.location.href = url;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los elementos con la clase 'product'
    const productos = document.querySelectorAll(".product");

    // Agrega un evento de clic a cada producto
    productos.forEach(producto => {
        producto.addEventListener("click", function () {
            // Obtiene el ID del producto seleccionado
            const id = this.querySelector('input[name="id"]').value;
            // Redirige a la página de detalles con el ID correspondiente
            const url = `index.php?action=detalles&id=${encodeURIComponent(id)}`;
            window.location.href = url;
        });
    });
});


//enviar cantidad y id producto a carrito
document.getElementById('btnAgregarCarrito').addEventListener('click', function (event) {
    event.preventDefault(); // Evitar comportamiento predeterminado

    // Obtener los valores de los inputs
    const id = document.querySelector('input[name="id"]').value.trim();
    const cantidad = document.querySelector('input[name="cant"]').value.trim();
    const mess = document.querySelector('textarea[name="mensaje"]').value.trim();
    const date = document.querySelector('input[name="fecha"]').value.trim();
    const time = document.querySelector('select[name="hora"]').value.trim();
    const box = document.querySelector('textarea[name="box"]').value.trim();

    let missingFields = [];

    // Verificar cada campo y agregar a la lista si está vacío
    if (!id) missingFields.push("ID");
    if (!cantidad) missingFields.push("Cant");
    if (!date) missingFields.push("Date");
    if (!time) missingFields.push("Time");

    if (missingFields.length > 0) {
        alert("Please complete the following fields before continuing:\n- " + missingFields.join("\n- "));
        return; // Detener la ejecución si falta información
    }

    // Crear la URL con los parámetros GET
    const url = `index.php?action=cart&id=${encodeURIComponent(id)}&cant=${encodeURIComponent(cantidad)}&mess=${encodeURIComponent(mess)}&date=${encodeURIComponent(date)}&time=${encodeURIComponent(time)}&box=${encodeURIComponent(box)}`;

    // Redirigir al usuario
    window.location.href = url;
});




