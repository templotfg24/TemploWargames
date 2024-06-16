<?php

namespace models;

use \PDO;
use \PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Utils
{
    // Conectar a la base de datos
    public static function conectar()
    {
        global $DB_SERVER, $DB_SCHEMA, $DB_USER, $DB_PASSWD;

        $conPDO = null;
        try {
            require_once("../config/global.php");
            $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
            $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conPDO;
        } catch (PDOException $e) {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return null;
        }
    }

    // Limpiar datos de entrada
    public static function limpiar_datos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Generar código de activación aleatorio
    public static function generar_codigo_activacion()
    {
        return rand(1111, 9999);
    }

    // Enviar correo de activación de cuenta
    public static function enviarCorreoActivacion($email, $codigoActivacion)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Deshabilitar salida de depuración detallada

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            // Recipientes
            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            // Cargar la plantilla HTML
            $template = file_get_contents('../Assets/templates/email_codigo.html');

            // Reemplazar placeholders con valores reales
            $template = str_replace('{{codigoActivacion}}', $codigoActivacion, $template);
            $template = str_replace('{{activationLink}}', "http://localhost/temploWargames/views/activate_account.php?email=" . $email, $template);

            // Configuración del contenido
            $mail->isHTML(true);
            $mail->Subject = 'Activación de cuenta - TemploWargames';
            $mail->Body    = $template;
            $mail->CharSet = 'UTF-8';  // Asegurar que el charset esté configurado a UTF-8

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }

    // Enviar correo de factura de pedido
    public static function enviarCorreoFactura($email, $orderData, $cart)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Deshabilitar salida de depuración detallada

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            // Recipientes
            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            // Cargar la plantilla HTML
            ob_start();
            include '../views/order/factura.php';  //plantilla de factura
            $template = ob_get_clean();

            // Reemplazar los placeholders en la plantilla con los datos reales
            $template = str_replace('{{nombre}}', $orderData['nombre'], $template);
            $template = str_replace('{{email}}', $orderData['email'], $template);
            $template = str_replace('{{telefono}}', $orderData['telefono'], $template);
            $template = str_replace('{{direccion}}', $orderData['direccion'], $template);
            $template = str_replace('{{ciudad}}', $orderData['ciudad'], $template);
            $template = str_replace('{{region}}', $orderData['region'], $template);
            $template = str_replace('{{codigo_postal}}', $orderData['codigo_postal'], $template);
            $template = str_replace('{{order_id}}', $orderData['order_id'], $template);
            $template = str_replace('{{total}}', $orderData['total'], $template);

            // Generar detalles de productos
            $productRows = '';
            foreach ($cart as $product) {
                $productRows .= '<tr>';
                $productRows .= '<td>' . $product['Nombre'] . '</td>';
                $productRows .= '<td>' . $product['quantity'] . '</td>';
                $productRows .= '<td>' . $product['Precio'] . '€</td>';
                $productRows .= '<td>' . ($product['Precio'] * $product['quantity']) . '€</td>';
                $productRows .= '</tr>';
            }
            $template = str_replace('{{product_rows}}', $productRows, $template);

            // Configurar contenido
            $mail->isHTML(true);
            $mail->Subject = 'Factura de tu pedido - TemploWargames';
            $mail->Body = $template;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }

    // Enviar correo de confirmación de inscripción a torneo
    public static function enviarConfirmacionInscripcion($email, $inscripcionData)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Deshabilitar salida de depuración detallada

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            // Recipientes
            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            // Cargar la plantilla HTML
            ob_start();
            include '../views/tournament/confirmacion_inscripcion.php';
            $template = ob_get_clean();

            // Reemplazar los placeholders en la plantilla con los datos reales
            $template = str_replace('{{nombre}}', $inscripcionData['nombre'], $template);
            $template = str_replace('{{email}}', $inscripcionData['email'], $template);
            $template = str_replace('{{torneo}}', $inscripcionData['torneo'], $template);
            $template = str_replace('{{fecha}}', $inscripcionData['fecha'], $template);
            $template = str_replace('{{id_aplicacion}}', $inscripcionData['id_aplicacion'], $template);
            $template = str_replace('{{telefono}}', $inscripcionData['telefono'], $template);

            // Configurar contenido
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Inscripción - TemploWargames';
            $mail->Body = $template;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }

    // Enviar correo de recuperación de contraseña
    public static function enviarCorreoRecuperacion($email, $resetToken)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;

        try {
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            $resetLink = "http://localhost/temploWargames/controllers/Auth_Controller.php?action=resetPassword&token=$resetToken";

            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de Contraseña - TemploWargames';
            $mail->Body = "Haga clic en el siguiente enlace para restablecer su contraseña: <a href='$resetLink'>Restablecer Contraseña</a>";
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }

    // Enviar correo de contacto
    public static function enviarCorreoContacto($userName, $userEmail, $subject, $message)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Deshabilitar salida de depuración detallada

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            // Recipientes
            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress('templotfg24@gmail.com');

            // Cargar la plantilla HTML
            ob_start();
            include '../views/contact/contact_email_template.php'; //plantilla de correo de contacto
            $template = ob_get_clean();

            // Reemplazar los placeholders en la plantilla con los datos reales
            $template = str_replace('{{nombre}}', htmlspecialchars($userName), $template);
            $template = str_replace('{{email}}', htmlspecialchars($userEmail), $template);
            $template = str_replace('{{subject}}', htmlspecialchars($subject), $template);
            $template = str_replace('{{message}}', nl2br(htmlspecialchars($message)), $template);

            // Configurar contenido
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo mensaje de contacto - ' . htmlspecialchars($subject);
            $mail->Body = $template;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }

    // Enviar correo de activación de cuenta para administradores
    public static function enviarCorreoActivacionAdmin($email, $codigoActivacion, $passwordTemporal)
    {
        require_once("../vendor/autoload.php");
        $config = require("../config/email_config.php");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Deshabilitar salida de depuración detallada

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host = $config['HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['SMTP_USER'];
            $mail->Password = $config['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['SMTP_PORT'];

            // Recipientes
            $mail->setFrom($config['SMTP_EMAIL'], $config['SMTP_NAME']);
            $mail->addAddress($email);

            // Cargar la plantilla HTML
            $template = file_get_contents('../Assets/templates/email_codigo_admin.html');

            // Reemplazar placeholders con valores reales
            $template = str_replace('{{codigoActivacion}}', $codigoActivacion, $template);
            $template = str_replace('{{activationLink}}', "http://localhost/temploWargames/views/activate_account.php?email=" . $email, $template);
            $template = str_replace('{{passwordTemporal}}', $passwordTemporal, $template);

            // Configuración del contenido
            $mail->isHTML(true);
            $mail->Subject = 'Activación de cuenta - TemploWargames (Admin)';
            $mail->Body    = $template;
            $mail->CharSet = 'UTF-8';  // Asegurar que el charset esté configurado a UTF-8

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            return false;
        }
    }


    // Generar contraseña aleatoria
    public static function generateRandomPassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
