<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>



<div id="filtros" class="dashboard__filtros">
    <h3 id="filtro_ppal" class="grid-item-full">Filtros:</h3>
    <div id="b_nombre" class="dashboard__inputs dashboard__inputs--text grid-item-row2-col1">
        <h4>Buscar:</h4>
        <div class="dashboard__campo">
            <input 
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Busca por nombre o apellidos"
                value=""
            />
        </div>
    </div>
    <div id="b_pack" class="dashboard__inputs dashboard__inputs--text grid-item-row2-col2">
        <h4>Categoría:</h4>
        <div class="dashboard__campo">
            <select class="dashboard__campo" name="filtroPack" id="filtroPack">
                <option selected value="">Ver todos</option>
                <?php foreach($categorias as $categoria) { ?>
                    <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="grid-item-full grid-item-full--boton text-center">
        <button id="restablecerFiltros" class="dashboard__boton--panel ">
            <i class="fa-solid fa-refresh"></i>
            Restablecer Filtros
        </button>
    </div>
</div>

<div id="recuento-miembros" class="dashboard__recuento"></div>

<div class="dashboard__contenedor">
    <?php if( !empty($arbitros)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <!-- <th scope="col" class="table__th"></th> -->
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($arbitros as $miembro) { ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro->apellido1 . " " . $miembro->apellido2 . ", " . $miembro->nombre; ?>
                        </td>
                        <td id="cat" class="table__td" data-label="Categoría" data-id-categoria="<?php echo $miembro->id_categoria; ?>">
                            <?php foreach($categorias as $categoria) { ?>
                                <?php if($miembro->id_categoria === $categoria->id) { ?>
                                    <?php echo $categoria->nombre; ?>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr> 
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen datos en este momento</p>
    <?php } ?>
</div>