<div class="contenedor olvide">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <div class="contenedor-sm">

        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/olvide" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    placeholder="Introduce tu email"
                    name="email"
                />
            </div>
            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="acciones">
            <a href="/">¿Recordaste tu clave? Iniciar Sesión</a>
        </div>
    </div> <!--Fin .contenedor-sm-->
</div>