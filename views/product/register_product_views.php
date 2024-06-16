<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>

    <!-- Enlaces a CSS de Bootstrap y Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Registrar Producto</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para registrar producto -->
                        <form id="formProducto" action="Product_Controller.php?action=registerProduct" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" pattern="^\d+(\.\d{1,2})?$" title="Por favor, ingrese un número con hasta 2 decimales." required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select id="categoria" name="categoria" class="form-select" required>
                                    <option selected disabled>Selecciona una categoría</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategoria" class="form-label">Subcategoría</label>
                                <select id="subcategoria" name="subcategoria" class="form-select" required>
                                    <option selected disabled>Selecciona una subcategoría</option>
                                    <?php foreach ($subcategories as $subcategory) : ?>
                                        <option value="<?php echo $subcategory['id']; ?>" data-category="<?php echo $subcategory['category_id']; ?>"><?php echo $subcategory['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Campos para subir imágenes del producto -->
                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                <div class="mb-3">
                                    <label for="imagen<?php echo $i; ?>" class="form-label">Imagen <?php echo $i; ?></label>
                                    <input type="file" class="form-control" id="imagen<?php echo $i; ?>" name="imagen<?php echo $i; ?>">
                                </div>
                            <?php endfor; ?>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/register_product_views.js"></script>
</body>

</html>
