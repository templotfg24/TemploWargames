<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - TemploWargames</title>
    <!-- Enlace a Google Fonts para la familia de fuentes 'Poppins' -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales del cuerpo */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #252525;
        }
        /* Contenedor principal del formulario de contacto */
        .contact-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Encabezado del formulario */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #f2f2f2;
        }
        /* Imagen del encabezado */
        .header img {
            height: 70px;
        }
        /* Título del encabezado */
        .header h1 {
            font-size: 24px;
            font-weight: 700;
        }
        /* Sección de detalles de contacto */
        .contact-details {
            padding: 20px 0;
        }
        /* Título de detalles de contacto */
        .contact-details h2 {
            font-size: 20px;
            font-weight: 700;
        }
        /* Párrafos de detalles de contacto */
        .contact-details p {
            margin: 5px 0;
        }
        /* Sección del mensaje */
        .message {
            padding: 20px 0;
        }
        /* Pie de página */
        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 2px solid #f2f2f2;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <div class="header">
            <h1>Contacto</h1>
        </div>
        <div class="contact-details">
            <h2>Detalles del Contacto</h2>
            <!-- Detalles del contacto utilizando placeholders para reemplazar con datos reales -->
            <p><strong>Nombre:</strong> {{nombre}}</p>
            <p><strong>Email:</strong> {{email}}</p>
            <p><strong>Asunto:</strong> {{subject}}</p>
        </div>
        <div class="message">
            <h2>Mensaje</h2>
            <!-- Mensaje del contacto utilizando placeholders para reemplazar con datos reales -->
            <p>{{message}}</p>
        </div>
        <div class="footer">
            <!-- Recordatorio en el pie de página -->
            <p>Recordario responder al cliente lo antes posible</p>
        </div>
    </div>
</body>
</html>

