$(document).ready(function() {
    $('#modalBan').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var user = button.data('user');
        var action = button.data('action');
        var modal = $(this);
        modal.find('#banUser').text(user);
        modal.find('#banAction').text(action === 'ban' ? 'banear' : 'desbanear');
        $('#confirmBan').data('action', action).data('user', user);
    });

    $('#confirmBan').click(function() {
        var action = $(this).data('action');
        var user = $(this).data('user');
        var form = document.createElement('form');
        form.action = 'User_Controller.php?action=banUser';
        form.method = 'post';

        var userInput = document.createElement('input');
        userInput.type = 'hidden';
        userInput.name = 'id';
        userInput.value = user;
        form.appendChild(userInput);

        var actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);

        document.body.appendChild(form);
        form.submit();

        $('#modalBan').modal('hide');
    });
});

function showDeleteModal(userId) {
    var deleteButton = document.getElementById('confirmDelete');
    deleteButton.onclick = function() {
        var form = document.createElement('form');
        form.action = 'User_Controller.php?action=deleteUser';
        form.method = 'post';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = userId;
        form.appendChild(input);

        // Crear un iframe oculto para recibir la respuesta del servidor
        var iframe = document.createElement('iframe');
        iframe.name = 'deleteFrame';
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        form.target = 'deleteFrame';
        document.body.appendChild(form);
        
        iframe.onload = function() {
            var response = iframe.contentDocument.body.innerText;
            if (response.includes('Usuario eliminado correctamente.')) {
                alert('Usuario eliminado correctamente.');
                location.reload(); // Recargar la página para actualizar la lista de usuarios
            } else {
                alert(response); // Mostrar el mensaje de error
            }
        };
        
        form.submit();
    };

    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    deleteModal.show();
}

