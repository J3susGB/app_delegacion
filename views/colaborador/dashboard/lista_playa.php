<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/colaborador/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<form id="form-asistencia" method="POST" action="/colaborador/dashboard/lista_playa" enctype="multipart/form-data">
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <div  class="dashboard__filtros">
        <h3 id="filtro_ppal" class="grid-item-full">Filtros:</h3>
        <div  class="dashboard__inputs dashboard__inputs--text grid-item-row2-col1">
            <h4>Fecha:</h4>
            <div class="dashboard__campo">
                <input id="fecha" type="date" name="fecha" />
            </div>
        </div>
        <div class="dashboard__inputs dashboard__inputs--text grid-item-row2-col2 ">
            <h4>Turno:</h4>
            <div class="dashboard__campo">
                <select class="dashboard__campo" name="turno" id="turno">
                    <option disabled selected value="">Ver todos</option>
                    <?php foreach($turnos as $turno) { ?>
                        <option value="<?php echo $turno->id; ?>"><?php echo $turno->nombre; ?></option>
                    <?php } ?>
                    <!-- <option value="1">Teórica</option>
                    <option value="2">Práctica</option> -->
                </select>
            </div>
            <input type="hidden" name="id_responsable" value="<?php echo $usuario->id; ?>">
        </div>
    </div>

    <div class="dashboard__contenedor">
        <?php if (!empty($miembros)) { ?>
            <div class="dashboard__formulario">

                <table class="table-lista">
                    <thead class="table-lista__thead">
                        <tr>
                            <th scope="col" class="table-lista__th"></th>
                            <th scope="col" class="table-lista__th">Nombre</th>
                            <th scope="col" class="table-lista__th">Categoría</th>
                            <th scope="col" class="table-lista__th">Día</th>
                            <th scope="col" class="table-lista__th">Turno</th>
                            <th scope="col" class="table-lista__th">¿Asiste?</th>
                        </tr>
                    </thead>
                    <tbody id="miembros-tbody" class="table-lista__tbody">
                        <?php foreach ($miembros as $index => $miembro) { ?>
                            <tr class="table-lista__tr" data-categoria-id="<?php echo $miembro->id_categoria; ?>">
                                <td class="table-lista__td">
                                    <div class="formulario__imagen">
                                        <picture>
                                            <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $miembro->foto; ?>.webp" type="image/webp">
                                            <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $miembro->foto; ?>.png" type="image/png">
                                            <source srcset="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $miembro->foto; ?>.avif" type="image/avif">
                                            <img src="<?php echo $_ENV['HOST'] . '/img/arbitros/' . $miembro->foto; ?>.png" alt="Imagen del miembro">
                                        </picture>
                                    </div>
                                </td>
                                <td class="table-lista__td table-lista__td--nombre" data-label="Nombre">
                                    <?php echo $miembro->apellido1 . " " . $miembro->apellido2 . ", " . $miembro->nombre; ?>
                                    <input type="hidden" name="miembros[<?php echo $index; ?>][nombre]" value="<?php echo $miembro->nombre; ?>">
                                    <input type="hidden" name="miembros[<?php echo $index; ?>][apellido1]" value="<?php echo $miembro->apellido1; ?>">
                                    <input type="hidden" name="miembros[<?php echo $index; ?>][apellido2]" value="<?php echo $miembro->apellido2; ?>">
                                    <input type="hidden" name="miembros[<?php echo $index; ?>][id]" value="<?php echo $miembro->id; ?>">
                                </td>
                                <td class="table-lista__td categoria table-lista__td--categoria" data-label="Categoría">
                                    <?php foreach ($categorias as $categoria) {
                                        if ($miembro->id_categoria === $categoria->id) {
                                            echo $categoria->nombre;
                                        }
                                    } ?>
                                    <input type="hidden" name="miembros[<?php echo $index; ?>][categoria_id]" value="<?php echo $miembro->id_categoria; ?>">
                                </td>
                                <td class="table-lista__td table-lista__td--dia" data-label="Día">
                                    <!-- Día del miembro -->
                                </td>
                                <td class="table-lista__td table-lista__td--turno" data-label="Turno">
                                    <!-- Turno del miembro -->
                                </td>
                                <td class="table-lista__select" data-label="¿Asiste?">
                                    <?php
                                    $valor_asiste = $valores['miembros'][$index]['asiste'] ?? 2; // Valor predeterminado es 2 (No)
                                    $clase_si = $valor_asiste == 1 ? 'selected' : '';
                                    $clase_no = $valor_asiste == 2 ? 'selected' : '';
                                    ?>
                                    <input type="hidden" id="asiste_<?php echo $index; ?>" name="miembros[<?php echo $index; ?>][asiste]" value="<?php echo $valor_asiste; ?>">
                                    <button type="button" class="btn-asiste <?php echo $clase_si; ?>" data-value="1" data-index="<?php echo $index; ?>">Sí</button>
                                    <button type="button" class="btn-asiste <?php echo $clase_no; ?>" data-value="2" data-index="<?php echo $index; ?>">No</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div for="observaciones" class="formulario__campo">
                    <label class="formulario__label">Observaciones</label>
                    <textarea class="formulario__input" 
                        id="observaciones" 
                        name="observaciones" 
                        placeholder="Describe la situación"></textarea>
                </div>
                <input type="submit" class="alerta formulario__submit formulario__submit--registrar" value="Enviar asistencia">
</form>
</div>
<?php } else { ?>
    <p class="text-center">No hay miembros registrados</p>
<?php } ?>
</div>