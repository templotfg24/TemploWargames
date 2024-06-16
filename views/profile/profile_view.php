<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>

    <!-- Enlaces a CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/menu_main.css">
    <link rel="stylesheet" href="../Assets/css/profile_view.css">
</head>

<body>
    <!-- Inclusión del menú principal -->
    <?php include '../views/includes/menu_main.php'; ?>
    <div id="wrapper" class="d-flex">
        <!-- Inclusión de la barra lateral del cliente -->
        <?php include '../views/includes/sidebar_cliente.php'; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Perfil del Usuario</h1>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información de la Cuenta</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <h5 class="card-title">Información de la Cuenta</h5>
                                <div class="profile-image-wrapper" style="text-align:justify;">
                                    <img src="../Assets/images/uploads/<?php echo $user['imagen_perfil']; ?>" alt="Imagen de perfil" class="profile-image" style="max-width: 150px; border-radius: 50%;">
                                </div>
                                <p><strong>Nombre:</strong> <?php echo $user['Nombre']; ?></p>
                                <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
                                <p><strong>Teléfono:</strong> <?php echo $user['Telefono']; ?></p>

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAccountModal">Editar Cuenta</button>
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">Dirección de Facturación</h5>
                                <p><strong>Dirección:</strong> <?php echo $user['Direccion']; ?></p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAddressModal">Editar Dirección</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Seguridad</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Cambiar Contraseña</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclusión del pie de página -->
    <?php include '../views/includes/footer.php'; ?>

    <!-- Modales -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">Editar Cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAccountForm" enctype="multipart/form-data">
                        <!-- Campos para editar la cuenta -->
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editName" name="nombre" value="<?php echo $user['Nombre']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo $user['Email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="editPhone" name="telefono" value="<?php echo $user['Telefono']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProfileImage" class="form-label">Imagen de Perfil</label>
                            <input type="file" class="form-control" id="editProfileImage" name="imagen_perfil" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel">Editar Dirección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAddressForm">
                        <!-- Campos para editar la dirección -->
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="editAddress" name="direccion" value="<?php echo $user['Direccion']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para alertas -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Alerta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alertModalBody">
                    <!-- Mensaje de alerta -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/menu_main.js"></script>
    <script src="../Assets/js/carrito.js"></script>
    <script src="../Assets/js/profile_view.js"></script>
</body>

</html>
