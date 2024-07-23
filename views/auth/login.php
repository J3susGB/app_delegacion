<main>
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>
    
    <form class="formulario" method="POST" action="/">
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input
                type="text"
                id="usuario"
                placeholder="Introduce tu usuario"
                name="usuario"
            />
        </div>
        <div class="campo">
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                placeholder="Introduce tu constraseña"
                name="password"
            />
        </div>

        <input type="submit" class="boton" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</main>