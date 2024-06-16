<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Editar Producto</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para editar producto -->
                        <form id="formProducto" action="Product_Controller.php?action=updateProduct" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $producto['ID_Producto']; ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['Nombre']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $producto['Descripcion']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo number_format($producto['Precio'], 2); ?>" pattern="^\d+(\.\d{1,2})?$" title="Por favor, ingrese un número con hasta 2 decimales." required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['Stock']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select id="categoria" name="categoria" class="form-select" required>
                                    <option selected disabled>Selecciona una categoría</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $producto['category_id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategoria" class="form-label">Subcategoría</label>
                                <select id="subcategoria" name="subcategoria" class="form-select" required>
                                    <option selected disabled>Selecciona una subcategoría</option>
                                    <?php foreach ($subcategories as $subcategory) : ?>
                                        <option value="<?php echo $subcategory['id']; ?>" data-category="<?php echo $subcategory['category_id']; ?>" <?php echo $subcategory['id'] == $producto['subcategory_id'] ? 'selected' : ''; ?>><?php echo $subcategory['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php for ($i = 1; $i <= 6; $i++) : ?>
                                <div class="mb-3">
                                    <label for="imagen<?php echo $i; ?>">Imagen <?php echo $i; ?></label>
                                    <?php
                                    $imagenKey = "imagen" . $i;
                                    if (!empty($producto[$imagenKey])) : ?>
                                        <img src="../Assets/images/uploads/<?php echo htmlspecialchars($producto[$imagenKey]); ?>" alt="Imagen <?php echo $i; ?>" height="100">
                                    <?php endif; ?>
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
    <script src="../Assets/js/edit_product.js"></script>
</body>

</html>
