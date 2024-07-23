<?php
    if(!is_directivo()) {
        header('Location: /');
    }
?>

<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/perfil/cambiar_contraseña?id=<?php echo $usuario->id; ?>">
        <i class="fa-solid fa-key"></i>
        Contraseña
    </a>
    <a class="dashboard__boton--panel" href="/directivo/dashboard/perfil?id=<?php echo $usuario->id; ?>">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input  type="text" class="formulario__input" placeholder="Introduce nombre" id="nombre" name="nombre" value="<?php echo $usuario->nombre ? $usuario->nombre : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido1" class="formulario__label">Primer apellido</label>
            <input  type="text" class="formulario__input" placeholder="Introduce primer apellido" id="apellido1" name="apellido1" value="<?php echo $usuario->apellido1 ? $usuario->apellido1 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido2" class="formulario__label">Segundo apellido</label>
            <input  type="text" class="formulario__input" placeholder="Introduce segundo apellido" id="apellido2" name="apellido2" value="<?php echo $usuario->apellido2 ? $usuario->apellido2 : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" placeholder="Introduce email" id="email" name="email" value="<?php echo $usuario->email ? $usuario->email : ''; ?>" />
        </div>
        <input id="crear_member" type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Editar">
    </form>
</div>