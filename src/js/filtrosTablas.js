(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar elementos del DOM
        const filtroPack = document.getElementById('filtroPack');
        const nombreInput = document.getElementById('nombre');
        const restablecerFiltros = document.getElementById('restablecerFiltros');
        const tabla = document.querySelector('.table__tbody');
        const modalidadSelect = document.getElementById('FilterModa'); // Seleccionar el select de modalidad
        const categoriaSelect = document.getElementById('filterCat'); // Seleccionar el select de categoría
    
        if (tabla) { // Verificar si la tabla existe
            const filas = tabla.querySelectorAll('.table__tr');
    
            // Función para normalizar texto removiendo acentos y caracteres especiales
            function normalizarTexto(texto) {
                return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
            }
    
            // Función para filtrar por categoría
            function filtrarPorCategoria() {
                const categoriaSeleccionada = filtroPack.value;
                filas.forEach(fila => {
                    const categoria = fila.querySelector('#cat').dataset.idCategoria;
                    if (categoriaSeleccionada === "" || categoria === categoriaSeleccionada) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }
    
            // Función para filtrar por texto
            function filtrarPorTexto() {
                const textoBusqueda = normalizarTexto(nombreInput.value);
                filas.forEach(fila => {
                    const nombreCompleto = normalizarTexto(fila.querySelector('td[data-label="Nombre"]').textContent);
                    if (nombreCompleto.includes(textoBusqueda)) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }
    
            // Función para restablecer filtros
            function restablecerFiltrosFunc() {
                filtroPack.value = "";
                nombreInput.value = "";
                modalidadSelect.value = ""; // Restablecer el select de modalidad
                categoriaSelect.value = ""; // Restablecer el select de categoría
                categoriaSelect.disabled = false; // Habilitar el select de categoría
                filas.forEach(fila => {
                    fila.style.display = "";
                });
            }
    
            // Función para habilitar o deshabilitar el select de categoría según la modalidad seleccionada
            function verificarModalidad() {
                const modalidadSeleccionada = modalidadSelect.value;
                if (modalidadSeleccionada === "4" || modalidadSeleccionada === "5") {
                    categoriaSelect.setAttribute('disabled', 'true'); // Agregar el atributo disabled
                } else {
                    categoriaSelect.removeAttribute('disabled'); // Quitar el atributo disabled
                }
            }
    
            // Event Listeners
            filtroPack.addEventListener('change', filtrarPorCategoria);
            nombreInput.addEventListener('input', filtrarPorTexto);
            restablecerFiltros.addEventListener('click', restablecerFiltrosFunc);
            modalidadSelect.addEventListener('change', verificarModalidad); // Agregar el listener para verificar la modalidad
        }
    });
})();
