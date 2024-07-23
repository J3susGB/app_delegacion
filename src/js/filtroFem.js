(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const formAsistencia = document.getElementById('form-asistencia');
        const miembrosTbody = document.getElementById('miembros-tbody');

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
