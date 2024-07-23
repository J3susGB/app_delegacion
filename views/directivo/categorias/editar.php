<?php
    if(!is_directivo()) {
        header('Location: /');
    }
?>

<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard/categorias">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" placeholder="Introduce nombre de modalidad" id="nombre" name="nombre" value="<?php echo $categoria->nombre ? $categoria->nombre : ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="modalidad" class="formulario__label">Modalidad</label>
            <select class="formulario__label--select" name="modalidad" id="modalidad">
            <?php foreach($modalidades as $modalidad) { ?>
                <option value="<?php echo $modalidad->id?>" <?php echo $categoria->id_modalidad === $modalidad->id ? 'selected' : ''; ?>><?php echo $modalidad->nombre ?></option>
            <?php } ?>
            </select>
        </div>

        <input id="crear_member" type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Editar">
    </form>
</div>