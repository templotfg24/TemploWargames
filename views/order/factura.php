<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - TemploWargames</title>
    <!-- Fuente Poppins desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #252525;
        }

        .invoice-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #f2f2f2;
        }

        .header img {
            height: 70px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .invoice-details {
            padding: 20px 0;
        }

        .invoice-details h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #f2f2f2;
            text-align: left;
        }

        .invoice-table th {
            background-color: #FF4F11;
            color: #fff;
        }

        .total {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total div {
            width: 200px;
            padding: 10px;
            border: 1px solid #f2f2f2;
            background-color: #f9f9f9;
            text-align: right;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            border-top: 2px solid #f2f2f2;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Encabezado de la factura -->
        <div class="header">
            <h1>Factura</h1>
        </div>

        <!-- Detalles del cliente -->
        <div class="invoice-details">
            <h2>Detalles del Cliente</h2>
            <p><strong>Nombre:</strong> {{nombre}}</p>
            <p><strong>Email:</strong> {{email}}</p>
            <p><strong>Teléfono:</strong> {{telefono}}</p>
            <p><strong>Dirección:</strong> {{direccion}}, {{ciudad}}, {{region}}, {{codigo_postal}}</p>
        </div>

        <!-- Detalles del pedido -->
        <div class="invoice-details">
            <h2>Detalles del Pedido</h2>
            <p><strong>ID del Pedido:</strong> {{order_id}}</p>
        </div>

        <!-- Tabla de productos -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{product_rows}}
            </tbody>
        </table>

        <!-- Total del pedido -->
        <div class="total">
            <div>
                <p><strong>Total:</strong> {{total}}€</p>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>Gracias por tu compra en TemploWargames</p>
        </div>
    </div>
</body>

</html>
