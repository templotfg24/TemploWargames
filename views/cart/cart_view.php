<?php
// Iniciar la sesión si aún no se ha iniciado
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado y almacenar la información del usuario en un array
$usuario = null;
if (isset($_SESSION['user_id'])) {
    $usuario = [
        'ID_Usuario' => $_SESSION['user_id'],
        'Nombre' => $_SESSION['user_name'],
        'Email' => $_SESSION['email'],
        'Rol' => $_SESSION['rol'],
        'imagen_perfil' => $_SESSION['imagen_perfil']
    ];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/cart.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="shopping-cart">
                    <h4>Carrito de Compras</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <!-- Productos añadidos dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="totals">
                    <h4>Totales del Carrito</h4>
                    <p>Subtotal: <span id="subtotal">0€</span></p>
                    <p>Descuento: <span id="discount">0€</span></p>
                    <p>Gasto de envío: <span id="shipping">Gratis</span></p>
                    <p>Total: <span id="total">0€</span></p>
                    <button id="proceedToCheckoutButton" class="btn btn-orange">Proceder al pago</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pasar datos PHP a JavaScript -->
    <script>
        // Verificar si el usuario está logueado y pasar el valor a JavaScript
        const isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>

    <!-- Incluir el archivo JavaScript del carrito de compras -->
    <script src="../../Assets/js/cart.js"></script>
    <!-- Incluir Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

