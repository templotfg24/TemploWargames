// product_list_views.js

$(document).ready(function() {
    $('#categoria').change(function() {
        var selectedCategory = $(this).val();
        $('#subcategoria option').each(function() {
            var subcategory = $(this);
            if (subcategory.data('category') == selectedCategory) {
                subcategory.show();
            } else {
                subcategory.hide();
            }
        });
        $('#subcategoria').val('');
    }).change();
});

function showDeleteModal(productId) {
    // Configura el formulario del modal para enviar la eliminación con el ID correcto
    var deleteButton = document.getElementById('confirmDelete');
    deleteButton.onclick = function() {
        var form = document.createElement('form');
        form.action = 'Product_Controller.php?action=deleteProduct';
        form.method = 'post';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = productId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    };

    // Muestra el modal
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    deleteModal.show();
}
