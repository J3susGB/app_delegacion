<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/colaborador/perfil?id=<?php echo $usuario->id; ?>">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña actual</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Introduce tu contraseña actual"
                id="password"
                name="password"
            />
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Nueva contraseña</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Introduce la nueva contraseña"
                id="password2"
                name="password2"
            />
        </div>
        
        <input type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Guardar">
    </form>
</div>