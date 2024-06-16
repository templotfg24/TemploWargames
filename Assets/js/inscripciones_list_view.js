// inscripciones_list_view.js

function showDeleteModal(inscripcionId, torneoId) {
    // Configura el formulario del modal para enviar la eliminación con el ID correcto
    var deleteButton = document.getElementById('confirmDelete');
    deleteButton.onclick = function() {
        var form = document.createElement('form');
        form.action = deleteInscripcionUrl;
        form.method = 'post';

        var inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = inscripcionId;

        var inputTorneoId = document.createElement('input');
        inputTorneoId.type = 'hidden';
        inputTorneoId.name = 'torneo_id';
        inputTorneoId.value = torneoId;

        form.appendChild(inputId);
        form.appendChild(inputTorneoId);
        document.body.appendChild(form);
        form.submit();
    };

    // Muestra el modal
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    deleteModal.show();
}
