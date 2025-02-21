<div class="login-container">
    <h2>🌸 Iniciar Sesión 🌸</h2>
    <form method="post">
        <div class="input-group">
            <input type="text" name="user" id="username" required>
            <label for="username">Usuario</label>
            <span class="focus-effect"></span>
        </div>

        <div class="input-group">
            <input type="password" name="clave" id="password" required>
            <label for="password">Contraseña</label>
            <span class="focus-effect"></span>
        </div>

        <button type="submit" name="login">Ingresar</button>
    </form>

    <div class="animated-background">
        <div class="flower"></div>
        <div class="flower flower2"></div>
        <div class="flower flower3"></div>
        <div class="bubble bubble1"></div>
        <div class="bubble bubble2"></div>
        <div class="bubble bubble3"></div>
    </div>
</div>
<?php
    $res = new ControladorUsuario();
    $res->loginControlador();
?>
