(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const filtroMod = document.getElementById('FilterModa');
        const filtroCateg = document.getElementById('filterCat');
        const filtroMes = document.getElementById('filterMes');

        // Grupos de tablas
        const tablasProv = [
            document.getElementById('prov-sept'), document.getElementById('prov-oct'),
            document.getElementById('prov-nov'), document.getElementById('prov-dic'),
            document.getElementById('prov-ene'), document.getElementById('prov-feb'),
            document.getElementById('prov-mar'), document.getElementById('prov-abr'),
            document.getElementById('prov-may')
        ];

        const tablasOfi = [
            document.getElementById('ofi-sept'), document.getElementById('ofi-oct'),
            document.getElementById('ofi-nov'), document.getElementById('ofi-dic'),
            document.getElementById('ofi-ene'), document.getElementById('ofi-feb'),
            document.getElementById('ofi-mar'), document.getElementById('ofi-abr'),
            document.getElementById('ofi-may')
        ];

        const tablasAux = [
            document.getElementById('aux-sept'), document.getElementById('aux-oct'),
            document.getElementById('aux-nov'), document.getElementById('aux-dic'),
            document.getElementById('aux-ene'), document.getElementById('aux-feb'),
            document.getElementById('aux-mar'), document.getElementById('aux-abr'),
            document.getElementById('aux-may')
        ];

        const tablasFbf = [
            document.getElementById('fbf-sept'), document.getElementById('fbf-oct'),
            document.getElementById('fbf-nov'), document.getElementById('fbf-dic'),
            document.getElementById('fbf-ene'), document.getElementById('fbf-feb'),
            document.getElementById('fbf-mar'), document.getElementById('fbf-abr'),
            document.getElementById('fbf-may')
        ];

        const tablasRg = [
            document.getElementById('rg-sept'), document.getElementById('rg-oct'),
            document.getElementById('rg-nov'), document.getElementById('rg-dic'),
            document.getElementById('rg-ene'), document.getElementById('rg-feb'),
            document.getElementById('rg-mar'), document.getElementById('rg-abr'),
            document.getElementById('rg-may')
        ];

        const tablasNac = [
            document.getElementById('nac-sept'), document.getElementById('nac-oct'),
            document.getElementById('nac-nov'), document.getElementById('nac-dic'),
            document.getElementById('nac-ene'), document.getElementById('nac-feb'),
            document.getElementById('nac-mar'), document.getElementById('nac-abr'),
            document.getElementById('nac-may')
        ];

        const tablasNi = [
            document.getElementById('ni-sept'), document.getElementById('ni-oct'),
            document.getElementById('ni-nov'), document.getElementById('ni-dic'),
            document.getElementById('ni-ene'), document.getElementById('ni-feb'),
            document.getElementById('ni-mar'), document.getElementById('ni-abr'),
            document.getElementById('ni-may')
        ];

        const tablasInf = [
            document.getElementById('inf-sept'), document.getElementById('inf-oct'),
            document.getElementById('inf-nov'), document.getElementById('inf-dic'),
            document.getElementById('inf-ene'), document.getElementById('inf-feb'),
            document.getElementById('inf-mar'), document.getElementById('inf-abr'),
            document.getElementById('inf-may')
        ];

        const tablasFem = [
            document.getElementById('fem-sept'), document.getElementById('fem-oct'),
            document.getElementById('fem-nov'), document.getElementById('fem-dic'),
            document.getElementById('fem-ene'), document.getElementById('fem-feb'),
            document.getElementById('fem-mar'), document.getElementById('fem-abr'),
            document.getElementById('fem-may')
        ];

        const tablasPlaya = [
            document.getElementById('playa-sept'), document.getElementById('playa-oct'),
            document.getElementById('playa-nov'), document.getElementById('playa-dic'),
            document.getElementById('playa-ene'), document.getElementById('playa-feb'),
            document.getElementById('playa-mar'), document.getElementById('playa-abr'),
            document.getElementById('playa-may')
        ];

        const tablas = [tablasProv, tablasOfi, tablasAux, tablasFbf, tablasRg, tablasNac, tablasNi, tablasInf, tablasFem, tablasPlaya];

        function ocultarTodasLasTablas() {
            tablas.forEach(grupo => {
                grupo.forEach(tabla => {
                    if (tabla) {
                        tabla.classList.add('invisible');
                    }
                });
            });
        }

        function mostrarTabla(tabla) {
            if (tabla) {
                tabla.classList.remove('invisible');
            }
        }

        function actualizarVisibilidadTablas(mod, cat, mes) {
            ocultarTodasLasTablas();
            let tablaSeleccionada = null;

            // Ajuste del índice del mes para que 09 sea 0, 10 sea 1, ..., 05 sea 8.
            const meses = ['09', '10', '11', '12', '01', '02', '03', '04', '05'];
            const mesIndex = meses.indexOf(mes);

            if (mod === '1') {
                switch (cat) {
                    case '1':
                        tablaSeleccionada = tablasProv[mesIndex];
                        break;
                    case '2':
                        tablaSeleccionada = tablasOfi[mesIndex];
                        break;
                    case '3':
                        tablaSeleccionada = tablasAux[mesIndex];
                        break;
                    case '4':
                        tablaSeleccionada = tablasFbf[mesIndex];
                        break;
                }
            } else if (mod === '2') {
                switch (cat) {
                    case '5':
                        tablaSeleccionada = tablasRg[mesIndex];
                        break;
                    case '6':
                        tablaSeleccionada = tablasNac[mesIndex];
                        break;
                    case '7':
                        tablaSeleccionada = tablasNi[mesIndex];
                        break;
                }
            } else if (mod === '4') {
                tablaSeleccionada = tablasFem[mesIndex];
            } else if (mod === '5') {
                tablaSeleccionada = tablasPlaya[mesIndex];
            }

            // Manejo del valor 9 para informadores, solo si modalidad 1 o 2
            if (cat === '9') {
                if (mod === '1' || mod === '2') {
                    tablaSeleccionada = tablasInf[mesIndex];
                } else {
                    tablaSeleccionada = null; // No hay tabla para informadores en modalidad 4 o 5
                }
            }

            mostrarTabla(tablaSeleccionada);
        }

        filtroMod.addEventListener('change', function() {
            filtroCateg.innerHTML = '<option selected value="">Ver todos</option>';
            categorias.forEach(function(categoria) {
                if (categoria.id_modalidad == filtroMod.value || categoria.id_modalidad === null) {
                    const option = document.createElement('option');
                    option.value = categoria.id;
                    option.textContent = categoria.nombre;
                    filtroCateg.appendChild(option);
                }
            });

            const selectedMod = filtroMod.value;
            const selectedCat = filtroCateg.value;
            const selectedMes = filtroMes.value;
            actualizarVisibilidadTablas(selectedMod, selectedCat, selectedMes);
        });

        filtroCateg.addEventListener('change', function() {
            const selectedMod = filtroMod.value;
            const selectedCat = filtroCateg.value;
            const selectedMes = filtroMes.value;
            actualizarVisibilidadTablas(selectedMod, selectedCat, selectedMes);
        });

        filtroMes.addEventListener('change', function() {
            const selectedMod = filtroMod.value;
            const selectedCat = filtroCateg.value;
            const selectedMes = filtroMes.value;
            actualizarVisibilidadTablas(selectedMod, selectedCat, selectedMes);
        });
    });
})();
