<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/dashboard.css">
</head>
<body>
    <div id="wrapper">
        <?php include '../views/includes/sidebar_menu.php'; ?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Gestión de Usuarios</h1>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Usuarios</h3>
                        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalUsuario"><i class="fas fa-plus"></i> Nuevo Usuario</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo $usuario['ID_Usuario']; ?></td>
                                    <td><?php echo $usuario['Nombre']; ?></td>
                                    <td><?php echo $usuario['Email']; ?></td>
                                    <td><?php echo $usuario['Rol']; ?></td>
                                    <td><span class="badge bg-<?php echo $usuario['Estado'] == 'activo' ? 'success' : 'danger'; ?>"><?php echo ucfirst($usuario['Estado']); ?></span></td>
                                    <td>
                                        <a href="User_Controller.php?action=editUser&id=<?php echo $usuario['ID_Usuario']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-<?php echo $usuario['Estado'] == 'activo' ? 'danger' : 'success'; ?> btn-sm" data-bs-toggle="modal" data-bs-target="#modalBan" data-user="<?php echo $usuario['ID_Usuario']; ?>" data-action="<?php echo $usuario['Estado'] == 'activo' ? 'ban' : 'unban'; ?>"><i class="fas fa-<?php echo $usuario['Estado'] == 'activo' ? 'ban' : 'check'; ?>"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('<?php echo $usuario['ID_Usuario']; ?>')"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                        <a class="page-link" href="User_Controller.php?action=listUsers&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUsuarioLabel">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formUsuario" action="User_Controller.php?action=register" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select id="rol" name="rol" class="form-select" required>
                                <option selected disabled>Selecciona un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="empleado">Empleado</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select" required>
                                <option selected disabled>Selecciona un estado</option>
                                <option value="activo">Activo</option>
                                <option value="baneado">Baneado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagen_perfil" class="form-label">Imagen de Perfil</label>
                            <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBan" tabindex="-1" aria-labelledby="modalBanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBanLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres <span id="banAction"></span> al usuario <span id="banUser"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmBan">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/user_list_views.js"></script>
</body>
</html>


