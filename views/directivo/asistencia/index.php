<h2 id="heading" class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton--panel" href="/directivo/dashboard">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__filtros">
    <h3 class="grid-item-full">Filtros:</h3>
    <div id="a_pack" class="dashboard__inputs dashboard__inputs--text grid-item-row2-col1 ">
        <h4>Modalidad:</h4>
        <div class="dashboard__campo">
            <select class="dashboard__campo" name="filterModa" id="FilterModa">
                <option selected disabled value="">--Seleccione--</option>
                <?php foreach ($modalidades as $modalidad) { ?>
                    <option value="<?php echo $modalidad->id; ?>"><?php echo $modalidad->nombre; ?></option>
                <?php } ?>
                <option value="4">Femenino</option>
                <option value="5">Playa</option>
            </select>
        </div>
    </div>
    <div  class="dashboard__inputs dashboard__inputs--text grid-item-row2-col2 ">
        <h4>Categoría:</h4>
        <div class="dashboard__campo">
            <select class="dashboard__campo" name="filterCat" id="filterCat">
                <option selected disabled value="">--Seleccione</option>
                <!-- Las opciones de categoría se agregarán dinámicamente -->
            </select>
        </div>
    </div>
    <div  class="dashboard__inputs dashboard__inputs--text grid-item-row3-col1 ">
        <h4>Mes:</h4>
        <div class="dashboard__campo">
            <select class="dashboard__campo" name="filterMes" id="filterMes">
                <option selected disabled value="">--Seleccione--</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <!-- Las opciones de categoría se agregarán dinámicamente -->
            </select>
        </div>
    </div>
</div>

<!-- PROVINCIALES -->
<!-- Septiembre -->
<div id="prov-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Septiembre</h4>
    <?php if (!empty($septiembre_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="prov-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Octubre</h4>
    <?php if (!empty($octubre_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="prov-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Noviembre</h4>
    <?php if (!empty($noviembre_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="prov-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Diciembre</h4>
    <?php if (!empty($diciembre_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="prov-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Enero</h4>
    <?php if (!empty($enero_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="prov-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Febrero</h4>
    <?php if (!empty($febrero_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="prov-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Marzo</h4>
    <?php if (!empty($marzo_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="prov-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Abril</h4>
    <?php if (!empty($abril_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="prov-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Provinciales - Mayo</h4>
    <?php if (!empty($mayo_provinciales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_provinciales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_provinciales['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_provinciales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!-- OFICIALES -->
<!-- Septiembre -->
<div id="ofi-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Septiembre</h4>
    <?php if (!empty($septiembre_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="ofi-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Octubre</h4>
    <?php if (!empty($octubre_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="ofi-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Noviembre</h4>
    <?php if (!empty($noviembre_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="ofi-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Diciembre</h4>
    <?php if (!empty($diciembre_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="ofi-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Enero</h4>
    <?php if (!empty($enero_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="ofi-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Febrero</h4>
    <?php if (!empty($febrero_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="ofi-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Marzo</h4>
    <?php if (!empty($marzo_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="ofi-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Abril</h4>
    <?php if (!empty($abril_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="ofi-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Oficiales - Mayo</h4>
    <?php if (!empty($mayo_oficiales['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_oficiales['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_oficiales['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_oficiales['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!-- AUXILIARES -->
<!-- Septiembre -->
<div id="aux-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Septiembre</h4>
    <?php if (!empty($septiembre_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="aux-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Octubre</h4>
    <?php if (!empty($octubre_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="aux-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Noviembre</h4>
    <?php if (!empty($noviembre_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="aux-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Diciembre</h4>
    <?php if (!empty($diciembre_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="aux-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Enero</h4>
    <?php if (!empty($enero_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="aux-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Febrero</h4>
    <?php if (!empty($febrero_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="aux-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Marzo</h4>
    <?php if (!empty($marzo_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="aux-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Abril</h4>
    <?php if (!empty($abril_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="aux-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Auxiliares - Mayo</h4>
    <?php if (!empty($mayo_aux['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_aux['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_aux['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_aux['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!-- FUTBOL BASE FÚTBOL -->
<!-- Septiembre -->
<div id="fbf-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Septiembre</h4>
    <?php if (!empty($septiembre_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="fbf-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Octubre</h4>
    <?php if (!empty($octubre_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="fbf-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Noviembre</h4>
    <?php if (!empty($noviembre_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="fbf-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Diciembre</h4>
    <?php if (!empty($diciembre_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="fbf-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Enero</h4>
    <?php if (!empty($enero_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="fbf-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Febrero</h4>
    <?php if (!empty($febrero_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="fbf-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Marzo</h4>
    <?php if (!empty($marzo_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="fbf-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Abril</h4>
    <?php if (!empty($abril_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="fbf-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Base - Mayo</h4>
    <?php if (!empty($mayo_fbf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_fbf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_fbf['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_fbf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--REGIONAL FUTSAL -->
<!-- Septiembre -->
<div id="rg-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Septiembre</h4>
    <?php if (!empty($septiembre_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="rg-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Octubre</h4>
    <?php if (!empty($octubre_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="rg-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Noviembre</h4>
    <?php if (!empty($noviembre_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="rg-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Diciembre</h4>
    <?php if (!empty($diciembre_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="rg-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Enero</h4>
    <?php if (!empty($enero_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="rg-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Febrero</h4>
    <?php if (!empty($febrero_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="rg-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Marzo</h4>
    <?php if (!empty($marzo_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="rg-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Abril</h4>
    <?php if (!empty($abril_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="rg-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Regional Futsal - Mayo</h4>
    <?php if (!empty($mayo_rg['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_rg['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_rg['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_rg['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--NACIONAL FUTSAL -->
<!-- Septiembre -->
<div id="nac-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Septiembre</h4>
    <?php if (!empty($septiembre_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="nac-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Octubre</h4>
    <?php if (!empty($octubre_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="nac-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Noviembre</h4>
    <?php if (!empty($noviembre_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="nac-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Diciembre</h4>
    <?php if (!empty($diciembre_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="nac-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Enero</h4>
    <?php if (!empty($enero_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="nac-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Febrero</h4>
    <?php if (!empty($febrero_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="nac-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Marzo</h4>
    <?php if (!empty($marzo_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="nac-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Abril</h4>
    <?php if (!empty($abril_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="nac-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nacional Futsal - Mayo</h4>
    <?php if (!empty($mayo_nac['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_nac['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_nac['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_nac['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--Nuevo Ingreso FUTSAL -->
<!-- Septiembre -->
<div id="ni-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Septiembre</h4>
    <?php if (!empty($septiembre_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="ni-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Octubre</h4>
    <?php if (!empty($octubre_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="ni-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Noviembre</h4>
    <?php if (!empty($noviembre_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="ni-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Diciembre</h4>
    <?php if (!empty($diciembre_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="ni-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Enero</h4>
    <?php if (!empty($enero_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="ni-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Febrero</h4>
    <?php if (!empty($febrero_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="ni-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Marzo</h4>
    <?php if (!empty($marzo_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="ni-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Abril</h4>
    <?php if (!empty($abril_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="ni-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Nuevo Ingreso - Mayo</h4>
    <?php if (!empty($mayo_ni['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_ni['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_ni['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_ni['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--INFORMADORES -->
<!-- Septiembre -->
<div id="inf-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Septiembre</h4>
    <?php if (!empty($septiembre_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="inf-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Octubre</h4>
    <?php if (!empty($octubre_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="inf-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Noviembre</h4>
    <?php if (!empty($noviembre_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="inf-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Diciembre</h4>
    <?php if (!empty($diciembre_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="inf-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Enero</h4>
    <?php if (!empty($enero_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="inf-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Febrero</h4>
    <?php if (!empty($febrero_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="inf-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Marzo</h4>
    <?php if (!empty($marzo_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="inf-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Abril</h4>
    <?php if (!empty($abril_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="inf-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Informadores - Mayo</h4>
    <?php if (!empty($mayo_inf['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_inf['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_inf['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_inf['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--FEMENINO -->
<!-- Septiembre -->
<div id="fem-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Septiembre</h4>
    <?php if (!empty($septiembre_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="fem-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Octubre</h4>
    <?php if (!empty($octubre_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="fem-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Noviembre</h4>
    <?php if (!empty($noviembre_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="fem-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Diciembre</h4>
    <?php if (!empty($diciembre_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="fem-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Enero</h4>
    <?php if (!empty($enero_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="fem-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Febrero</h4>
    <?php if (!empty($febrero_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="fem-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Marzo</h4>
    <?php if (!empty($marzo_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="fem-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Abril</h4>
    <?php if (!empty($abril_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="fem-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Femenino - Mayo</h4>
    <?php if (!empty($mayo_fem['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_fem['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_fem['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_fem['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<!--PLAYA -->
<!-- Septiembre -->
<div id="playa-sept" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Septiembre</h4>
    <?php if (!empty($septiembre_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($septiembre_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($septiembre_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($septiembre_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Octubre -->
<div id="playa-oct" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Octubre</h4>
    <?php if (!empty($octubre_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($octubre_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($octubre_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($octubre_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Noviembre -->
<div id="playa-nov" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Noviembre</h4>
    <?php if (!empty($noviembre_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($noviembre_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($noviembre_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($noviembre_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Diciembre -->
<div id="playa-dic" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Diciembre</h4>
    <?php if (!empty($diciembre_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($diciembre_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($diciembre_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($diciembre_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Enero -->
<div id="playa-ene" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Enero</h4>
    <?php if (!empty($enero_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($enero_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($enero_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($enero_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Febrero -->
<div id="playa-feb" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Febrero</h4>
    <?php if (!empty($febrero_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($febrero_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($febrero_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($febrero_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Marzo -->
<div id="playa-mar" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Marzo</h4>
    <?php if (!empty($marzo_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($marzo_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($marzo_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($marzo_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Abril -->
<div id="playa-abr" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Abril</h4>
    <?php if (!empty($abril_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($abril_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($abril_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($abril_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>
<!-- Mayo -->
<div id="playa-may" class="invisible dashboard__contenedor dashboard__contenedor--scroll">
    <h4>Fútbol Playa - Mayo</h4>
    <?php if (!empty($mayo_playa['Dias'])) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Árbitro/a</th>
                    <?php foreach (array_keys($mayo_playa['Dias']) as $dia) { ?>
                        <th scope="col" class="table__th"><?php echo $dia; ?></th>
                    <?php } ?>
                    <th scope="col" class="table__th">Total</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php 
                $todos_arbitros = [];
                $dias_array = array_keys($mayo_playa['Dias']);

                // Recolectar todos los árbitros
                foreach ($mayo_playa['Dias'] as $dia => $data) {
                    foreach ($data['arbitros'] as $arbitro_id => $miembro) {
                        $todos_arbitros[$arbitro_id]['info'] = $miembro;
                        $todos_arbitros[$arbitro_id]['asistencias'][$dia] = $miembro['asiste'];
                    }
                }

                // Mostrar todos los árbitros
                foreach ($todos_arbitros as $arbitro_id => $data) { 
                    $miembro = $data['info'];
                    $total_asistencias = 0;
                ?>
                    <tr class="table__tr">
                        <td class="table__td" data-label="Nombre">
                            <?php echo $miembro['apellido1'] . " " . $miembro['apellido2'] . ", " . $miembro['nombre']; ?>
                        </td>
                        <?php foreach ($dias_array as $dia) { 
                            $asistencia = isset($data['asistencias'][$dia]) ? $data['asistencias'][$dia] : 0;
                            $valor = ($asistencia == 2) ? 0 : $asistencia;
                            $total_asistencias += $valor;
                        ?>
                            <td class="table__td" data-label="<?php echo $dia; ?>">
                                <?php echo $valor; ?>
                            </td>
                        <?php } ?>
                        <td class="table__td" data-label="Total">
                            <?php echo $total_asistencias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center padding">No existen asistencias en este momento</p>
    <?php } ?>
</div>

<script>
    let categorias = {};
    categorias = <?php echo json_encode($categorias); ?>;
    // console.log(categorias);
</script>