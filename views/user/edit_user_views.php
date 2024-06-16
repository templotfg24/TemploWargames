<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la hoja de estilos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Enlace a la hoja de estilos personalizada -->
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>

<body>
    <div id="wrapper">
        <!-- Barra de navegación lateral -->
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <!-- Contenido principal -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Editar Usuario</h1>
                <div class="card mt-4">
                    <div class="card-body">
                        <!-- Formulario para editar el usuario -->
                        <form action="User_Controller.php?action=updateUser" method="post" enctype="multipart/form-data">
                            <!-- Campo oculto para el ID del usuario -->
                            <input type="hidden" name="id" value="<?php echo $usuario['ID_Usuario']; ?>">
                            
                            <!-- Campo para el nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['Nombre']; ?>" required>
                            </div>

                            <!-- Campo para el apellido -->
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario['Apellido']; ?>" required>
                            </div>

                            <!-- Campo para la dirección -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $usuario['Direccion']; ?>" required>
                            </div>

                            <!-- Campo para el teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['Telefono']; ?>" required>
                            </div>

                            <!-- Campo para el email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['Email']; ?>" required>
                            </div>

                            <!-- Campo para el rol -->
                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select id="rol" name="rol" class="form-select" required>
                                    <option value="admin" <?php if ($usuario['Rol'] == 'admin') echo 'selected'; ?>>Administrador</option>
                                    <option value="empleado" <?php if ($usuario['Rol'] == 'empleado') echo 'selected'; ?>>Empleado</option>
                                    <option value="cliente" <?php if ($usuario['Rol'] == 'cliente') echo 'selected'; ?>>Cliente</option>
                                </select>
                            </div>

                            <!-- Campo para el estado -->
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-select" required>
                                    <option value="activo" <?php if ($usuario['Estado'] == 'activo') echo 'selected'; ?>>Activo</option>
                                    <option value="baneado" <?php if ($usuario['Estado'] == 'baneado') echo 'selected'; ?>>Baneado</option>
                                </select>
                            </div>

                            <!-- Campo para la imagen de perfil -->
                            <div class="mb-3">
                                <label for="imagen_perfil" class="form-label">Imagen de Perfil</label>
                                <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil">
                            </div>

                            <!-- Botón para guardar los cambios -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
