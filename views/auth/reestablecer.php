<div class="contenedor reestablecer">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <div class="contenedor-sm">

        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        <?php if($mostrar) { ?>

        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    placeholder="Introduce tu nueva contraseña"
                    name="password"
                />
            </div>
            <input type="submit" class="boton" value="Guardar constraseña">
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/">¿Recordaste tu clave? Iniciar Sesión</a>
        </div>
    </div> <!--Fin .contenedor-sm-->
</div>