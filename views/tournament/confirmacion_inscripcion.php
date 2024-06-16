<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #252525;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilo del contenedor principal */
        .container {
            max-width: 600px;
            padding: 20px;
        }

        /* Estilo del mensaje de confirmación */
        .confirmation-message {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Estilo del título del mensaje de confirmación */
        .confirmation-message h1 {
            color: #F24F17;
            margin-bottom: 20px;
        }

        /* Estilo de la lista de detalles de la inscripción */
        .confirmation-message ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
            margin-bottom: 20px;
        }

        .confirmation-message ul li {
            margin-bottom: 10px;
        }

        /* Estilo de los párrafos del mensaje de confirmación */
        .confirmation-message p {
            margin-bottom: 20px;
        }

        /* Estilo del botón de regreso a la tienda */
        .btn-orange {
            background-color: #F24F17;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }

        .btn-orange:hover {
            background-color: #e64a19;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="confirmation-message">
            <!-- Título del mensaje de confirmación -->
            <h1>Confirmación de Inscripción</h1>
            
            <!-- Mensaje de saludo -->
            <p>Hola {{nombre}},</p>
            
            <!-- Mensaje de confirmación -->
            <p>Te has inscrito con éxito en el siguiente torneo:</p>
            
            <!-- Detalles de la inscripción -->
            <ul>
                <li><strong>Torneo:</strong> {{torneo}}</li>
                <li><strong>Fecha:</strong> {{fecha}}</li>
                <li><strong>ID de Aplicación:</strong> {{id_aplicacion}}</li>
                <li><strong>Teléfono:</strong> {{telefono}}</li>
            </ul>
            
            <!-- Mensaje de agradecimiento -->
            <p>Gracias por tu inscripción. ¡Nos vemos en el torneo!</p>
            <p>Saludos,</p>
            <p>Equipo de TemploWargames</p>
            
            <!-- Botón para regresar a la tienda -->
            <a href="http://localhost/temploWargames/public/index.php" class="btn btn-orange">Volver a la tienda</a>
        </div>
    </div>
</body>

</html>

