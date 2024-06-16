<div class="container mt-5">
    <div class="row">
        <!-- Iterar sobre la lista de productos y generar una tarjeta para cada producto -->
        <?php foreach ($productos as $producto) : ?>
            <div class="col-md-4 mb-4 d-flex">
                <!-- Tarjeta del producto -->
                <div class="product-card card">
                    <!-- Imagen del producto -->
                    <img src="../Assets/images/uploads/<?php echo $producto['imagen1']; ?>" class="card-img-top" alt="<?php echo $producto['Nombre']; ?>">
                    <div class="card-body">
                        <!-- Título del producto -->
                        <h5 class="card-title"><?php echo $producto['Nombre']; ?></h5>
                        <!-- Descripción del producto -->
                        <p class="card-text"><?php echo substr($producto['Descripcion'], 0, 100); ?>...</p>
                        <!-- Precio del producto -->
                        <div class="price">€<?php echo $producto['Precio']; ?></div>
                        <!-- Botones de la tarjeta -->
                        <div class="card-buttons">
                            <!-- Botón para ver más detalles del producto -->
                            <a href="../controllers/Tienda_Controller.php?action=viewProductDetail&id=<?php echo $producto['ID_Producto']; ?>" class="btn btn-primary">Ver más</a>
                            <!-- Botón para añadir al carrito, deshabilitado si no hay stock -->
                            <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $producto['ID_Producto']; ?>" data-product-name="<?php echo $producto['Nombre']; ?>" data-product-price="<?php echo $producto['Precio']; ?>" data-product-image="<?php echo $producto['imagen1']; ?>" <?php echo ($producto['Stock'] <= 0) ? 'disabled' : ''; ?>>Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
