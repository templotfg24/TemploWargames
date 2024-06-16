<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/checkout.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Sección de formulario de checkout -->
            <div class="col-md-8">
                <div class="form-section">
                    <h4>Información del pedido</h4>
                    <form id="checkoutForm" action="../controllers/CheckoutController.php?action=hacerPedido" method="POST">
                        <!-- Campos de información del usuario -->
                        <div class="mb-3">
                            <label>Nombre y apellidos</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label>Dirección</label>
                            <input type="text" class="form-control" name="direccion" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>País</label>
                                <select class="form-control" name="pais" id="pais" required>
                                    <option value="España">España</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Región</label>
                                <select class="form-control" name="region" id="region" required>
                                    <option value="">Seleccione...</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Ciudad</label>
                                <select class="form-control" name="ciudad" id="ciudad" required>
                                    <option value="">Seleccione...</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Código Postal</label>
                                <input type="text" class="form-control" name="codigo_postal" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Número de teléfono</label>
                            <input type="text" class="form-control" name="telefono" required>
                        </div>
                        <!-- Opciones de pago -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Opciones de Pago</h4>
                                    <div class="payment-options">
                                        <!-- Generar dinámicamente las opciones de pago -->
                                        <?php foreach ($paymentMethods as $method): ?>
                                            <div class="col">
                                                <div class="payment-option form-check">
                                                    <label class="form-check-label" for="paymentMethod_<?php echo $method['ID_FormaPago']; ?>">
                                                        <img src="../Assets/images/PNG/<?php echo strtolower($method['Descripcion']); ?>.png" alt="<?php echo $method['Descripcion']; ?>">
                                                        <?php echo $method['Descripcion']; ?>
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod_<?php echo $method['ID_FormaPago']; ?>" value="<?php echo $method['ID_FormaPago']; ?>" <?php if ($method['ID_FormaPago'] == 1) echo 'checked'; ?>>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Notas para repartidores -->
                        <div class="mb-3">
                            <label>Notas para Repartidores (Opcional)</label>
                            <textarea class="form-control" rows="3" name="notas"></textarea>
                        </div>
                        <!-- Campo oculto para productos -->
                        <input type="hidden" name="products" id="products">
                        <button type="submit" class="btn btn-orange">Hacer Pedido</button>
                    </form>
                </div>
            </div>
            <!-- Sección de resumen del pedido -->
            <div class="col-md-4">
                <div class="order-summary">
                    <h4>Resumen del Pedido</h4>
                    <div id="productSummary"></div>
                    <p>Sub-total: <span id="subtotal">0</span>€</p>
                    <p>Descuento: 0€</p>
                    <p>Gastos de envío: Gratis</p>
                    <p>Total: <span id="total">0</span>€</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de pago -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Confirmación de Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Por favor ingresa los detalles de tu pago.
                    <div class="mb-3">
                        <label>Número de Tarjeta / ID de PayPal / Número de Teléfono Bizum</label>
                        <input type="text" class="form-control" id="paymentDetails">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-orange" id="confirmPayment">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Archivo JavaScript del checkout -->
    <script src="../Assets/js/checkout.js"></script>
</body>

</html>

