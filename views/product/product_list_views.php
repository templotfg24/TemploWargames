<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Productos</title>

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
                <h1 class="mt-4">Gestión de Productos</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <!-- Título y botón para nuevo producto -->
                        <h3 class="card-title">Lista de Productos</h3>
                        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalProducto"><i class="fas fa-plus"></i> Nuevo Producto</button>
                    </div>
                    <div class="card-body">
                        <!-- Tabla de productos -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoría</th>
                                    <th>Subcategoría</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto) : ?>
                                    <tr>
                                        <td><?php echo $producto['ID_Producto']; ?></td>
                                        <td><?php echo $producto['Nombre']; ?></td>
                                        <td><?php echo $producto['Descripcion']; ?></td>
                                        <td><?php echo $producto['Precio']; ?></td>
                                        <td><?php echo $producto['Stock']; ?></td>
                                        <td><?php echo $producto['category_name']; ?></td>
                                        <td><?php echo $producto['subcategory_name']; ?></td>
                                        <td><img src="../Assets/images/uploads/<?php echo $producto['imagen1']; ?>" alt="<?php echo $producto['Nombre']; ?>" width="50"></td>
                                        <td>
                                            <!-- Botones para editar y eliminar productos -->
                                            <a href="Product_Controller.php?action=editProduct&id=<?php echo $producto['ID_Producto']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $producto['ID_Producto']; ?>')"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                        <a class="page-link" href="Product_Controller.php?action=listProducts&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear/Editar Producto -->
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductoLabel">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <input type="text" class="form-control" id="precio" name="precio" required pattern="^\d+(\.\d{1,2})?$" title="Por favor, ingrese un número con hasta 2 decimales.">
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
                        <!-- Campos para imágenes del producto -->
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

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/product_list_views.js"></script>
</body>

</html>
