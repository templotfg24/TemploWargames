<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    
    <!-- Enlaces a CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/menu_main.css">
    <link rel="stylesheet" href="../Assets/css/store_all_Products_view.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <aside class="col-md-3 sidebar">
                <h3>Categorías</h3>
                <!-- Filtro de categorías -->
                <label><input type="radio" name="category" value="all"> Ver todas</label><br>
                <?php foreach ($categories as $category) : ?>
                    <label><input type="radio" name="category" value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?></label><br>
                <?php endforeach; ?>
                
                <h3>Subcategorías</h3>
                <!-- Filtro de subcategorías -->
                <select id="subcategoryFilter" class="form-select">
                    <option value="">Selecciona una subcategoría</option>
                </select>
                
                <h3>Rango de Precio</h3>
                <!-- Filtro de rango de precio -->
                <input type="number" class="form-control mb-2" id="minPrice" placeholder="Precio Mínimo">
                <input type="number" class="form-control" id="maxPrice" placeholder="Precio Máximo">
            </aside>
            
            <div class="col-md-9">
                <div class="row" id="productContainer">
                    <!-- Listado de productos -->
                    <?php foreach ($productos as $producto) : ?>
                        <div class="col-md-4 mb-4 product-card" data-category="<?php echo $producto['category_id']; ?>" data-subcategory="<?php echo $producto['subcategory_id']; ?>" data-price="<?php echo $producto['Precio']; ?>">
                            <div class="card">
                                <img src="../Assets/images/uploads/<?php echo $producto['imagen1']; ?>" class="card-img-top" alt="<?php echo $producto['Nombre']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $producto['Nombre']; ?></h5>
                                    <p class="card-text"><?php echo substr($producto['Descripcion'], 0, 100); ?>...</p>
                                    <div class="price"><?php echo $producto['Precio']; ?> €</div>
                                    <div class="card-buttons">
                                        <a href="../controllers/Tienda_Controller.php?action=viewProductDetail&id=<?php echo $producto['ID_Producto']; ?>" class="btn btn-primary">Ver más</a>
                                        <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $producto['ID_Producto']; ?>" data-product-name="<?php echo $producto['Nombre']; ?>" data-product-price="<?php echo $producto['Precio']; ?>" data-product-image="<?php echo $producto['imagen1']; ?>">Añadir al carrito</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Paginación -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Inclusión del pie de página -->
    <?php include '../views/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Variables para subcategorías y categorías seleccionadas
        var subcategories = <?php echo json_encode($subcategories); ?>;
        var selectedCategory = <?php echo isset($_GET['category']) ? json_encode($_GET['category']) : 'null'; ?>;
        var selectedSubcategory = <?php echo isset($_GET['subcategory']) ? json_encode($_GET['subcategory']) : 'null'; ?>;
    </script>
    <script src="../Assets/js/menu_main.js"></script>
    <script src="../Assets/js/carrito.js"></script>
    <script src="../Assets/js/store_all_Products_view.js"></script>
</body>

</html>
