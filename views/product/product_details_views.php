<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['Nombre']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Assets/css/menu_main.css">
    <link rel="stylesheet" href="../Assets/css/product_details.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Carousel para las imágenes del producto -->
            <div class="col-md-8">
                <div id="productCarousel" class="carousel slide carousel-thumbnails" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <?php if (!empty($producto['imagen' . $i])) : ?>
                                <div class="carousel-item <?php echo $i == 1 ? 'active' : ''; ?>">
                                    <img src="../Assets/images/uploads/<?php echo $producto['imagen' . $i]; ?>" class="d-block w-100" alt="Imagen <?php echo $i; ?>">
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <!-- Thumbnails como controles -->
                    <div class="carousel-indicators d-flex">
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <?php if (!empty($producto['imagen' . $i])) : ?>
                                <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="<?php echo $i - 1; ?>" class="<?php echo $i == 1 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $i; ?>">
                                    <img src="../Assets/images/uploads/<?php echo $producto['imagen' . $i]; ?>" class="img-fluid" alt="...">
                                </button>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <!-- Detalles del producto -->
            <div class="col-md-4">
                <h2><?php echo $producto['Nombre']; ?></h2>
                <p><strong>ID:</strong> <?php echo $producto['ID_Producto']; ?></p>
                <p><strong>Precio:</strong> <?php echo $producto['Precio']; ?> €</p>
                <p><strong>Disponibilidad:</strong> <?php echo ($producto['Stock'] > 0) ? 'Hay stock' : 'No hay stock'; ?></p>
                <p><strong>Categoría:</strong> <?php echo $categoriesById['name']; ?></p>
                <p><strong>SubCategoría:</strong> <?php echo $subcategoriesById['name']; ?></p>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $producto['ID_Producto']; ?>" data-product-name="<?php echo $producto['Nombre']; ?>" data-product-price="<?php echo $producto['Precio']; ?>" data-product-image="<?php echo $producto['imagen1']; ?>" <?php echo ($producto['Stock'] <= 0) ? 'disabled' : ''; ?>>Añadir al carrito</button>
                    <!--<button class="btn btn-success" type="button" <?php //echo ($producto['Stock'] <= 0) ? 'disabled' : ''; //?>>Compra Ahora</button>-->
                </div>
            </div>
        </div>
        <!-- Sección de Descripción -->
        <div class="row mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="descripcion-tab" data-bs-toggle="tab" data-bs-target="#descripcion" type="button" role="tab" aria-controls="descripcion" aria-selected="true">Descripción</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="descripcion" role="tabpanel" aria-labelledby="descripcion-tab">
                                <p><?php echo $producto['Descripcion']; ?></p>
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../views/includes/footer.php'; ?>
    <!-- Bootstrap JavaScript -->
    <script src="../Assets/js/carrito.js"></script>
    <script src="../Assets/js/menu_main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/product_details.js"></script>
</body>

</html>
