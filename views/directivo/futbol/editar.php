<?php
    if(!is_directivo()) {
        header('Location: /');
    }
?>

<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard/futbol">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" enctype="multipart/form-data" class="formulario" novalidate>
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" placeholder="Introduce nombre" id="nombre" name="nombre" value="<?php echo $arbitro->nombre ?? ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido1" class="formulario__label">Primer apellido</label>
            <input type="text" class="formulario__input" placeholder="Introduce primer apellido" id="apellido1" name="apellido1" value="<?php echo $arbitro->apellido1 ?? ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="apellido2" class="formulario__label">Segundo apellido</label>
            <input type="text" class="formulario__input" placeholder="Introduce segundo apellido" id="apellido2" name="apellido2" value="<?php echo $arbitro->apellido2 ?? ''; ?>" />
        </div>
        <div class="formulario__campo">
            <label for="categoria" class="formulario__label">Modalidad</label>
            <select class="formulario__label--select" name="modalidad" id="modalidad">
                <option selected disabled value="">--Seleccione--</option>
                <option selected disabled value="">-- Seleccione --</option>
                <?php foreach ($modalidad as $moda) { ?>
                    <option <?php echo intval($arbitro->id_modalidad) === intval($moda->id) ? 'selected' : '' ?> value="<?php echo $moda->id; ?>"><?php echo $moda->nombre; ?>
                <?php  } ?>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="categoria" class="formulario__label">Categoría</label>
            <select class="formulario__label--select" name="categoria" id="categoria">
                <option selected disabled value="">-- Seleccione --</option>
                <?php foreach ($categoria as $cat) { ?>
                    <option <?php echo intval($arbitro->id_categoria) === intval($cat->id) ? 'selected' : '' ?> value="<?php echo $cat->id; ?>"><?php echo $cat->nombre; ?>
                    <?php  } ?>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="femenino" class="formulario__label">Fútbol Femenino</label>
            <select class="formulario__label--select" name="femenino" id="femenino">
                <option selected value="<?php echo $arbitro->femenino; ?>"><?php echo $arbitro->femenino == "1" ? "Sí" : "No"; ?> </option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="playa" class="formulario__label">Fútbol Playa</label>
            <select class="formulario__label--select" name="playa" id="playa">
            <option selected value="<?php echo $arbitro->playa; ?>"><?php echo $arbitro->playa == "1" ? "Sí" : "No"; ?> </option>
            <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="formulario__campo">
            <label for="foto" class="formulario__label formulario__label--file">Foto</label>
            <div class="formulario__file-container">
                <input type="file" class="formulario__input formulario__input--file" id="foto" name="foto" value="<?php echo $arbitro->foto ?? ''; ?>" />
            </div>

            <?php if (isset($arbitro->foto_actual)) { ?>
                <p class="formulario__texto">Foto actual</p>
                <div class="formulario__imagen">
                    <picture>
                        <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $arbitro->foto; ?>.webp" type="image/webp">
                        <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $arbitro->foto; ?>.png" type="image/png">
                        <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $arbitro->foto; ?>.avif" type="image/avif">
                        <img src="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $arbitro->foto; ?>.png" alt="Imagen del miembro">
                    </picture>
                </div>
            <?php } ?>
        </div>
        <input type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Editar">
    </form>
</div>