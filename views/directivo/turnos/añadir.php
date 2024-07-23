<?php
    if(!is_directivo()) {
        header('Location: /');
    }
?>

<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard/turnos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" action="/directivo/turnos/añadir" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" placeholder="Introduce nombre de turno" id="nombre" name="nombre" value="<?php echo $turno->nombre ? $turno->nombre : ''; ?>" />
        </div>

        <input id="crear_member" type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Registrar">
    </form>
</div>