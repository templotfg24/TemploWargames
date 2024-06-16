function showDeleteModal(tournamentId) {
    // Configura el formulario del modal para enviar la eliminación con el ID correcto
    var deleteButton = document.getElementById('confirmDelete');
    deleteButton.onclick = function() {
        var form = document.createElement('form');
        form.action = 'Tournament_Controller.php?action=deleteTournament';
        form.method = 'post';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = tournamentId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    };

    // Muestra el modal
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    deleteModal.show();
}