// inscripcion_form_view.js

$(document).ready(function() {
    $("#usuario_email").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: searchUsuariosUrl,
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.Email,
                            value: item.ID_Usuario
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $("#usuario_email").val(ui.item.label);
            $("#usuario_id").val(ui.item.value);
            return false;
        }
    });
});

function validateForm() {
    var usuario_id = $("#usuario_id").val();
    if (!usuario_id) {
        alert("Por favor, seleccione un usuario válido.");
        return false;
    }
    return true;
}
