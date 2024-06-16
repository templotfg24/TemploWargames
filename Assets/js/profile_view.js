// profile_view.js

$(document).ready(function() {
    function showAlert(message) {
        $('#alertModalBody').text(message);
        $('#alertModal').modal('show');
        $('#alertModal').on('hidden.bs.modal', function() {
            location.reload(); // Recarga la página después de cerrar el modal
        });
    }

    $("#editAccountForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "../controllers/ProfileController.php?action=updateProfile",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showAlert(response);
            },
            error: function(response) {
                showAlert("Error al actualizar el perfil.");
            }
        });
    });

    $("#editAddressForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controllers/ProfileController.php?action=updateAddress",
            data: $(this).serialize(),
            success: function(response) {
                showAlert(response);
            },
            error: function(response) {
                showAlert("Error al actualizar la dirección.");
            }
        });
    });

    $("#changePasswordForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controllers/ProfileController.php?action=changePassword",
            data: $(this).serialize(),
            success: function(response) {
                showAlert(response);
            },
            error: function(response) {
                showAlert("Error al cambiar la contraseña.");
            }
        });
    });
});
