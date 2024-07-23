(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Datos de categorías
        const categorias = [
            { id: 1, nombre: 'Provincial fútbol', id_modalidad: 1 },
            { id: 2, nombre: 'Oficial fútbol', id_modalidad: 1 },
            { id: 3, nombre: 'Auxiliar fútbol', id_modalidad: 1 },
            { id: 4, nombre: 'Fútbol base fútbol', id_modalidad: 1 },
            { id: 5, nombre: 'Regional futsal', id_modalidad: 2 },
            { id: 6, nombre: 'Nacional futsal', id_modalidad: 2 },
            { id: 7, nombre: 'Nuevo ingreso futsal', id_modalidad: 2 },
            { id: 9, nombre: 'Informador', id_modalidad: 1 }
        ];

        const filtroModalidad = document.getElementById('FiltroModalidad');
        const filtroCate = document.getElementById('filtroCate');
        const miembrosTbody = document.getElementById('miembros-tbody');
        const formAsistencia = document.getElementById('form-asistencia');

        // Agregar campos hidden para filtros en el formulario
        const inputFiltroModalidad = document.createElement('input');
        inputFiltroModalidad.type = 'hidden';
        inputFiltroModalidad.name = 'filtroModalidad';
        formAsistencia.appendChild(inputFiltroModalidad);

        const inputFiltroCate = document.createElement('input');
        inputFiltroCate.type = 'hidden';
        inputFiltroCate.name = 'filtroCate';
        formAsistencia.appendChild(inputFiltroCate);

        filtroModalidad.addEventListener('change', function() {
            const modalidadSeleccionada = parseInt(this.value);
            inputFiltroModalidad.value = modalidadSeleccionada; // Actualizar el input hidden

            // Limpiar las opciones de categorías
            filtroCate.innerHTML = '<option selected value="">Ver todos</option>';

            // Filtrar y agregar las opciones correspondientes
            const categoriasFiltradas = categorias.filter(categoria => categoria.id_modalidad === modalidadSeleccionada);

            categoriasFiltradas.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nombre;
                filtroCate.appendChild(option);
            });
        });

        filtroCate.addEventListener('change', function() {
            const categoriaSeleccionada = this.value;
            inputFiltroCate.value = categoriaSeleccionada; // Actualizar el input hidden

            // Mostrar todas las filas si no hay categoría seleccionada
            if (categoriaSeleccionada === "") {
                document.querySelectorAll('#miembros-tbody tr').forEach(row => {
                    row.style.display = '';
                });
                return;
            }

            // Filtrar las filas en función de la categoría seleccionada
            document.querySelectorAll('#miembros-tbody tr').forEach(row => {
                const rowCategoria = row.getAttribute('data-categoria-id');
                if (rowCategoria === categoriaSeleccionada) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Funcionalidad para seleccionar asistencia (Sí/No)
        document.querySelectorAll('.btn-asiste').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                const value = this.getAttribute('data-value');
                const hiddenInput = document.getElementById(`asiste_${index}`);

                // Actualizar el valor del input hidden
                hiddenInput.value = value;

                // Cambiar estilos de los botones
                const botonesAsiste = this.parentElement.querySelectorAll('.btn-asiste');
                botonesAsiste.forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    });
})();
