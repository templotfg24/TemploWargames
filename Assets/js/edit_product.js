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
