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

    <form method="POST" action="/directivo/usuarios/añadir" class="formulario">
        <div class="formulario__campo">
            <label for="usuario" class="formulario__label">Usuario</label>
            <input type="text" class="formulario__input" placeholder="Introduce usuario" id="usuario" name="usuario" value="<?php echo $usuario->user ? $usuario->user : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" placeholder="Introduce nombre" id="nombre" name="nombre" value="<?php echo $usuario->nombre ? $usuario->nombre : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido1" class="formulario__label">Primer apellido</label>
            <input type="text" class="formulario__input" placeholder="Introduce primer apellido" id="apellido1" name="apellido1" value="<?php echo $usuario->apellido1 ? $usuario->apellido1 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido2" class="formulario__label">Segundo apellido</label>
            <input type="text" class="formulario__input" placeholder="Introduce segundo apellido" id="apellido2" name="apellido2" value="<?php echo $usuario->apellido2 ? $usuario->apellido2 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" placeholder="Introduce email" id="email" name="email" value="<?php echo $usuario->email ? $usuario->email : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input type="password" class="formulario__input" placeholder="Introduce contraseña" id="password" name="password" />
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Confirmar contraseña</label>
            <input type="password" class="formulario__input" placeholder="Repite la contraseña" id="password2" name="password2" />
        </div>
        <div class="formulario__campo">
            <label for="directivo" class="formulario__label">Directivo</label>
            <select class="formulario__label--select" name="directivo" id="directivo">
                <option selected disabled value="">--Seleccione--</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="colaborador" class="formulario__label">Colaborador</label>
            <select class="formulario__label--select" name="colaborador" id="colaborador">
                <option selected disabled value="">--Seleccione--</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="informador" class="formulario__label">Informador</label>
            <select class="formulario__label--select" name="informador" id="informador">
                <option selected disabled value="">--Seleccione--</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>

        <input id="crear_member" type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Registrar">
    </form>
</div>