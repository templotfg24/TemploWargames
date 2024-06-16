<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximos Eventos</title>
    
    <!-- Enlaces a CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/menu_main.css">
    <link rel="stylesheet" href="../Assets/css/tournaments_list_view.css">
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Próximos Eventos</h2>
            <input type="date" class="form-control date-picker" id="dateFilter">
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="eventsContainer">
            <!-- Listado de torneos -->
            <?php foreach ($tournaments as $tournament) : ?>
                <div class="col">
                    <!-- Tarjeta de evento -->
                    <div class="card" onclick="window.location.href='Tienda_Controller.php?action=inscripcionTorneo&id=<?php echo $tournament['id']; ?>';" style="cursor:pointer;">
                        <img src="../Assets/images/uploads/<?php echo $tournament['imagen']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($tournament['nombre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($tournament['nombre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($tournament['descripcion']); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo date('Y-m-d H:i', strtotime($tournament['fecha'])); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <!-- Botón para cargar más eventos -->
            <button class="btn btn-primary" type="button" id="loadMore">Ver más</button>
        </div>
    </div>

    <!-- Inclusión del pie de página -->
    <?php include '../views/includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/menu_main.js"></script>
    <script src="../Assets/js/events.js"></script>
</body>

</html>


