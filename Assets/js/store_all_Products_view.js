// store_all_Products_view.js

$(document).ready(function() {
    function populateSubcategories(categoryId) {
        $('#subcategoryFilter').html('<option value="">Selecciona una subcategoría</option>');
        subcategories.forEach(function(subcategory) {
            if (subcategory.category_id == categoryId) {
                $('#subcategoryFilter').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
            }
        });
    }

    if (selectedCategory) {
        $('input[name="category"][value="' + selectedCategory + '"]').prop('checked', true);
        populateSubcategories(selectedCategory);
    }

    if (selectedSubcategory) {
        $('#subcategoryFilter').val(selectedSubcategory);
    }

    $('input[name="category"]').change(function() {
        var categoryId = $(this).val();
        populateSubcategories(categoryId);
        filterProducts();
    });

    $('#subcategoryFilter, #minPrice, #maxPrice').change(filterProducts);

    function filterProducts() {
        var category = $('input[name="category"]:checked').val();
        var subcategory = $('#subcategoryFilter').val();
        var minPrice = parseFloat($('#minPrice').val()) || 0;
        var maxPrice = parseFloat($('#maxPrice').val()) || Infinity;

        $('.product-card').each(function() {
            var productCategory = $(this).data('category');
            var productSubcategory = $(this).data('subcategory');
            var productPrice = parseFloat($(this).data('price'));

            var categoryMatch = !category || category == 'all' || productCategory == category;
            var subcategoryMatch = !subcategory || productSubcategory == subcategory;
            var priceMatch = productPrice >= minPrice && productPrice <= maxPrice;

            if (categoryMatch && subcategoryMatch && priceMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    filterProducts();
});
