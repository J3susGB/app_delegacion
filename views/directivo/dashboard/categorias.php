<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/categorias/añadir">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir
    </a>
    <a class="dashboard__boton--panel" href="/directivo/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div id="recuento-miembros" class="dashboard__recuento"></div>

<div class="dashboard__contenedor">
    <?php if( !empty($categorias)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($categorias as $miembro) { ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro->nombre; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/directivo/categorias/editar?id=<?php echo $miembro->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                
                            </a>
                            <form method="POST" action="/directivo/categorias/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $miembro->id ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </form>
                        </td>
                    </tr> 
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen datos en este momento</p>
    <?php } ?>
</div>