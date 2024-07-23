<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/usuarios/añadir">
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
    <?php if( !empty($usuarios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Usuario</th>
                    <th scope="col" class="table__th">D</th>
                    <th scope="col" class="table__th">C</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($usuarios as $miembro) { ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro->apellido1 . " " . $miembro->apellido2 . ", " . $miembro->nombre; ?>
                        </td>
                        <td id="user" class="table__td" data-label="Usuario">
                            <?php echo $miembro->user; ?>
                        </td>
                        <td id="direc" class="table__td" data-label="Directivo">
                            <?php 
                                if($miembro->directivo == "1") { 
                                    echo "X";
                                } else {
                                    echo "—";
                                }
                            ?>
                        </td>
                        <td id="colab" class="table__td" data-label="Colaborador">
                            <?php 
                                if($miembro->colaborador == "1") { 
                                    echo "X";
                                } else {
                                    echo "—";
                                }
                            ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/directivo/usuarios/editar?id=<?php echo $miembro->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                
                            </a>
                            <form method="POST" action="/directivo/usuarios/eliminar" class="table__formulario">
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