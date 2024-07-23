<div class="contenedor reestablecer">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <div class="contenedor-sm">

        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        <?php if( isset($alertas['exito'])) { ?>
            <div class="acciones">
                <a href="/">Iniciar sesión</a>
            </div>
        <?php } ?>
    </div> <!--Fin .contenedor-sm-->
</div>