<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Subcategoría</title>
    <!-- Enlaces a Bootstrap y FontAwesome para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Inclusión del menú lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal de la página -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Editar Subcategoría</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para editar subcategoría -->
                        <form action="Subcategory_Controller.php?action=editSubcategory" method="post">
                            <!-- Campo oculto para el ID de la subcategoría -->
                            <input type="hidden" name="id" value="<?php echo $subcategory['id']; ?>">
                            <div class="mb-3">
                                <label for="subcategory_name" class="form-label">Nombre</label>
                                <!-- Campo de entrada para el nombre de la subcategoría -->
                                <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="<?php echo $subcategory['name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Categoría</label>
                                <!-- Select para elegir la categoría asociada -->
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option selected disabled>Selecciona una categoría</option>
                                    <!-- Iterar sobre las categorías para llenar el select -->
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $subcategory['category_id'] ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a scripts de jQuery, Popper.js y Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
