<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías y Subcategorías</title>
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
                <h1 class="mt-4">Gestión de Categorías y Subcategorías</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Categorías y Subcategorías</h3>
                        <!-- Botones para abrir los modales de creación de categoría y subcategoría -->
                        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalSubcategoria"><i class="fas fa-plus"></i> Nueva Subcategoría</button>
                        <button class="btn btn-primary btn-sm float-end me-2" data-bs-toggle="modal" data-bs-target="#modalCategoria"><i class="fas fa-plus"></i> Nueva Categoría</button>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de categorías -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Iterar sobre las categorías y mostrarlas en la tabla -->
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <td><?php echo $category['id']; ?></td>
                                        <td><?php echo $category['name']; ?></td>
                                        <td>
                                            <!-- Botones de acción para editar, eliminar y ver subcategorías -->
                                            <a href="Category_Controller.php?action=editCategory&id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="Category_Controller.php?action=deleteCategory&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#subcategories_<?php echo $category['id']; ?>"><i class="fas fa-eye"></i> Ver Subcategorías</button>
                                        </td>
                                    </tr>
                                    <!-- Tabla anidada para mostrar subcategorías -->
                                    <tr class="collapse" id="subcategories_<?php echo $category['id']; ?>">
                                        <td colspan="3">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Iterar sobre las subcategorías y mostrarlas en la tabla anidada -->
                                                    <?php foreach ($subcategories as $subcategory) : ?>
                                                        <?php if ($subcategory['category_id'] == $category['id']) : ?>
                                                            <tr>
                                                                <td><?php echo $subcategory['id']; ?></td>
                                                                <td><?php echo $subcategory['name']; ?></td>
                                                                <td>
                                                                    <!-- Botones de acción para editar y eliminar subcategorías -->
                                                                    <a href="Subcategory_Controller.php?action=editSubcategory&id=<?php echo $subcategory['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                                    <a href="Subcategory_Controller.php?action=deleteSubcategory&id=<?php echo $subcategory['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear/Editar Categoría -->
    <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCategoriaLabel">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear/editar categoría -->
                    <form id="formCategoria" action="Category_Controller.php?action=createCategory" method="post">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear/Editar Subcategoría -->
    <div class="modal fade" id="modalSubcategoria" tabindex="-1" aria-labelledby="modalSubcategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSubcategoriaLabel">Nueva Subcategoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear/editar subcategoría -->
                    <form id="formSubcategoria" action="Subcategory_Controller.php?action=createSubcategory" method="post">
                        <div class="mb-3">
                            <label for="subcategory_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option selected disabled>Selecciona una categoría</option>
                                <!-- Iterar sobre las categorías para llenar el select -->
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
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

