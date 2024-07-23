<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/perfil/editar?id=<?php echo $usuario->id; ?>">
    <i class="fa-solid fa-user-pen"></i>
        Editar datos
    </a>
    <a class="dashboard__boton--panel" href="/directivo/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="perfil">
    <div class="perfil__title">
        <h4>Datos de usuario</h4>
    </div>
    <div class="perfil__contenido">
        
        <div class="perfil__dato">
            <p><span>Usuario:</span> <?php echo $usuario->user; ?></p>
        </div>
        <div class="perfil__dato">
            <p><span>Nombre:</span> <?php echo $usuario->nombre ." ". $usuario->apellido1 ." ". $usuario->apellido2; ?></p>
        </div>
        <div class="perfil__dato">
            <p><span>Email:</span> <?php echo $usuario->email; ?></p>
        </div>
        <div class="perfil__dato">
            <p><span>Permiso:</span> 
            <?php 
                if($usuario->directivo == "1") {
                    echo "Directivo";
                } else if($usuario->colaborador == "1") {
                    echo "Colaborador";
                }
             ?>
             </p>
        </div>
    </div>
</div>