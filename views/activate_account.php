<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Activar Cuenta</title>
    <!-- Enlace a la fuente Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo del cuerpo del documento */
        body {
            background-color: #E2E7E7;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', Helvetica, Arial, sans-serif;
        }

        /* Estilo para las imágenes */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        /* Estilo para las tablas */
        table {
            border-collapse: collapse !important;
        }

        /* Estilo para los enlaces */
        a {
            color: inherit;
            text-decoration: none;
        }

        /* Estilo específico para enlaces detectados por Apple Mail */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Estilos para pantallas pequeñas */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* Eliminar márgenes no deseados */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body>
    <!-- Mensaje invisible para el pre-header -->
    <div style="display: none; font-size: 1px; color: #FFFFFF; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        ¡Estamos emocionados de tenerte aquí! Prepárate para sumergirte en tu nueva cuenta.
    </div>
    <!-- Tabla principal del correo -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#FF4E1F" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FF4E1F" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">¡Bienvenido!</h1>
                            <img src="../Assets/images/PNG/logo_email.png" width="125" height="120" style="display: block;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#E2E7E7" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 30px 30px;">
                                        <!-- Formulario para la activación de la cuenta -->
                                        <form action="http://localhost/temploWargames/controllers/User_Controller.php?action=activate" method="post">
                                            <div class="form-group">
                                                <label for="codigoActivacion">Código de Activación</label>
                                                <input type="text" class="form-control" id="codigoActivacion" name="codigoActivacion" required>
                                            </div>
                                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                                            <button type="submit" class="btn btn-primary mt-3" style="font-size: 20px; color: #ffffff; background-color: #FF4E1F; padding: 15px 25px; border-radius: 2px; border: 1px solid #FF4E1F; display: inline-block;">
                                                Activar Cuenta
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Si tienes alguna pregunta, responde a este correo&mdash;siempre estamos felices de ayudar.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Síguenos en:</p>
                            <div>
                                <a style="padding-right:10px" href="https://www.instagram.com/templo_wargames/?hl=en">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="25">
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#E2E7E7" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#FF4E1F" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px; color: #fff; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #fff; margin: 0;">¿Necesitas más ayuda?</h2>
                            <p style="margin: 0;"><a href="mailto:templotfg24@gmail.com" target="_blank" style="color: #fff;">Estamos aquí para ayudarte</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#E2E7E7" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#E2E7E7" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                            <p style="margin: 0;">Si estos correos se vuelven molestos, siéntete libre de <a href="#" target="_blank" style="color: #111111; font-weight: 700;">darte de baja</a>.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
