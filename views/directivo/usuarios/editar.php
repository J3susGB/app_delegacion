<?php
    if(!is_directivo()) {
        header('Location: /');
    }
?>

<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard/usuarios">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input disabled type="text" class="formulario__input" placeholder="Introduce nombre" id="nombre" name="nombre" value="<?php echo $usuario->nombre ? $usuario->nombre : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido1" class="formulario__label">Primer apellido</label>
            <input disabled type="text" class="formulario__input" placeholder="Introduce primer apellido" id="apellido1" name="apellido1" value="<?php echo $usuario->apellido1 ? $usuario->apellido1 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido2" class="formulario__label">Segundo apellido</label>
            <input disabled type="text" class="formulario__input" placeholder="Introduce segundo apellido" id="apellido2" name="apellido2" value="<?php echo $usuario->apellido2 ? $usuario->apellido2 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="usuario" class="formulario__label">Usuario</label>
            <input type="text" class="formulario__input" placeholder="Introduce usuario" id="usuario" name="usuario" value="<?php echo $usuario->user ? $usuario->user : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="directivo" class="formulario__label">Directivo</label>
            <select class="formulario__label--select" name="directivo" id="directivo">
                <option value="1" <?php echo $usuario->directivo === '1' ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo $usuario->directivo === '0' ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="colaborador" class="formulario__label">Colaborador</label>
            <select class="formulario__label--select" name="colaborador" id="colaborador">
                <option value="1" <?php echo $usuario->colaborador === '1' ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo $usuario->colaborador === '0' ? 'selected' : ''; ?>>No</option>
            </select>
        </div>
        <input id="crear_member" type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Editar">
    </form>
</div>