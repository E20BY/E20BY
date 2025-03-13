<?php
$reviews = new ControladorReview();
$reviews->agregarReview();
?>
<style>
    .col-md-6 {
        display: flex;
        justify-content: center;
    }

    /* Contenedor del formulario */
    .formulario {
        align-items: center;
        width: 100%;
        flex: 1;
        min-width: 300px;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Contenedor de producto */
    .producto-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Imagen del producto */
    .producto-imagen {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    /* Campos del formulario */
    .form-group {
        width: 100%;
        max-width: 500px;
        margin-bottom: 15px;
    }

    /* Input y textarea */
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    /* Botón */
    .btn-primary {
        width: 100%;
        max-width: 500px;
        padding: 10px;
        font-size: 16px;
    }

    /* 📱 Responsivo para pantallas menores a 768px */
    @media (max-width: 768px) {
        .formulario {
            width: 90%;
        }

        .form-group {
            max-width: 100%;
        }

        .btn-primary {
            max-width: 100%;
        }
    }

    /* 📱 Ajustes específicos para 390px o menos */
    @media (max-width: 390px) {
        .formulario {
            min-width: 60%;
            padding: 10px;
        }

        .small-textarea {
            min-width: 55px;
            height: 60px;
            /* 📏 Más pequeño en móviles */
        }

        .proucto-container {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .producto-imagen {
            width: 70px;
            height: 70px;
        }

        .form-group {
            width: 90%;
        }

        .btn-primary {
            width: 100%;
            font-size: 14px;
            padding: 8px;
        }

        h4 {
            font-size: 18px;
        }

        small {
            font-size: 12px;
            text-align: center;
        }
    }
</style>
<div class="col-md-6 formulario">
    <h4 class="mb-4" id="resena">Deja una reseña</h4>
    <small id="small">Tu dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con *</small>
    <form method="post">
        <div class="form-group">
            <label for="id" id="producto">Producto</label>
            <div class="producto-container">
                <img src="views/img/logo.png" alt="Producto" class="producto-imagen" id="producto-img">
                <input type="hidden" required class="form-control" name="id" id="id">
                <input type="text" required class="form-control" name="pro" id="pro">
            </div>
        </div>
        <div class="form-group">
            <label for="message" id="message">Tu opinión *</label>
            <textarea required name="message" cols="30" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="name" id="nombrefor">Su nombre *</label>
            <input type="text" required class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="email" id="email">Su correo electrónico *</label>
            <input type="email" required class="form-control" name="email">
        </div>
        <div class="form-group mb-0">
            <input type="submit" name="agregarReview" value="Deja tu opinión" id="opinion" class="btn btn-primary px-3">
        </div>
    </form>
</div>