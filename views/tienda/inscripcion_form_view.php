<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción - <?php echo htmlspecialchars($tournament['nombre']); ?></title>
    
    <!-- Enlaces a CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/inscripcion_form_view.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <!-- Imagen de cabecera -->
                <div class="header-image" style="background-image: url('../Assets/images/uploads/<?php echo $tournament['imagen']; ?>');"></div>
                
                <!-- Detalles del evento -->
                <div class="event-details">
                    <h2>Inscripción - <?php echo htmlspecialchars($tournament['nombre']); ?></h2>
                    <p>Hora: <?php echo date('H:i', strtotime($tournament['fecha'])); ?> (Hora Peninsular)</p>
                </div>
                
                <!-- Mapa de ubicación -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6417.838153809564!2d-6.2057357054000875!3d36.45951188938474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dcdbba843903b%3A0x974c768b2d4db646!2sTemplo%20Wargames!5e0!3m2!1sen!2ses!4v1717669894256!5m2!1sen!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <!-- Dirección -->
                <div class="address">
                    <p>Dirección: Edificio de Capitanía, Antiguo, C. Escaño, s/n, 11100 San Fernando, Cádiz</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <!-- Sección de formulario -->
                <div class="form-section">
                    <h3>Registro Torneo</h3>
                    <form action="Tienda_Controller.php?action=inscripcionTorneo&id=<?php echo $tournament['id']; ?>" method="post">
                        
                        <!-- Nombre del jugador -->
                        <div class="mb-3">
                            <label for="playerName" class="form-label">Nombre del Jugador</label>
                            <input type="text" class="form-control" id="playerName" name="playerName" placeholder="Nombre del Jugador" value="<?php echo htmlspecialchars($userName); ?>" readonly>
                        </div>
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                        
                        <!-- ID de aplicación -->
                        <div class="mb-3">
                            <label for="applicationId" class="form-label">ID de Aplicación Warhammer 40K</label>
                            <input type="text" class="form-control" id="applicationId" name="applicationId" placeholder="ID de Aplicación Warhammer 40K">
                        </div>
                        
                        <!-- Código de país -->
                        <div class="mb-3">
                            <label for="phoneCode" class="form-label">Código de País</label>
                            <select class="form-control" id="phoneCode" name="phoneCode">
                                <option value="+34">+34 España</option>
                                <option value="+1">+1 USA</option>
                                <option value="+44">+44 UK</option>
                                <!-- Agregar más códigos de país según sea necesario -->
                            </select>
                        </div>
                        
                        <!-- Número de teléfono -->
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Número de Teléfono</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Número de Teléfono" required>
                        </div>
                        
                        <!-- Botón de inscripción -->
                        <button type="submit" class="btn btn-primary">Inscribir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

