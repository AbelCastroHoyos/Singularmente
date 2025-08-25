<?php
// Habilitar la visualización de errores para depuración (QUITAR EN PRODUCCIÓN)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la base de datos (¡CAMBIA ESTO CON TUS DATOS REALES!)
define('DB_SERVER', 'localhost'); // En local es 'localhost', en Hostinger será diferente (Host del MySQL)
define('DB_USERNAME', 'root');   // En local es 'root', en Hostinger será tu usuario de BD
define('DB_PASSWORD', '');       // En local puede estar vacío, en Hostinger será tu contraseña de BD
define('DB_NAME', 'singularmente_db'); // El nombre de la BD que creaste

// Correo electrónico de Singularmente para recibir las notificaciones de citas
define('SINGULARMENTE_EMAIL', 'abelcastrohoyos@gmail.com'); // ¡CAMBIA ESTO! tu_correo@singularmente.com.co

// Ruta a la librería PHPMailer (descárgala e inclúyela)
// Puedes descargarla desde https://github.com/PHPMailer/PHPMailer/archive/refs/tags/v6.9.1.zip
// Descomprime y coloca la carpeta 'PHPMailer-6.9.1/src' en una subcarpeta 'phpmailer' de tu proyecto
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// ------------------------------------------------------------------------------------------------
// Función de Conexión a la Base de Datos
// ------------------------------------------------------------------------------------------------
function getDbConnection() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        // En un entorno de producción, loguear este error en lugar de mostrarlo
        die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos: ' . $conn->connect_error]));
    }
    $conn->set_charset("utf8mb4"); // Importante para caracteres especiales
    return $conn;
}

// ------------------------------------------------------------------------------------------------
// Función para enviar correos electrónicos
// ------------------------------------------------------------------------------------------------
function sendEmail($toEmail, $toName, $subject, $bodyHtml, $bodyText) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (¡CAMBIA ESTO CON LOS DATOS DE TU SERVIDOR SMTP!)
        // Si usas un servicio como SendGrid, Mailgun, Brevo, AWS SES, ellos te darán estos datos.
        // Ejemplo para SMTP de Google (Gmail, requiere que la seguridad de app sea menor o contraseña de app):
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'tu_correo@gmail.com'; // Tu correo completo
        // $mail->Password = 'tu_contraseña_o_contraseña_de_app'; // Tu contraseña o contraseña de aplicación
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SMTPS (465)
        // $mail->Port = 465;

        // EJEMPLO GENERAL (AJUSTAR SEGÚN TU PROVEEDOR HOSTINGER O SMTP EXTERNO)
        // Probablemente Hostinger tenga sus propios detalles SMTP para enviar desde PHP
        // O si usas un servicio como SendGrid:
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Ejemplo para Brevo (Sendinblue)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@singularmente.com.co'; // Tu usuario SMTP del proveedor (ej. SendGrid, Mailgun, Brevo)
        $mail->Password   = 'Singularmente2024@'; // Tu contraseña SMTP del proveedor
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;//ENCRYPTION_STARTTLS; // o PHPMailer::ENCRYPTION_SMTPS si usas 465
        $mail->Port       = 465; // o 465 si usas SMTPS
        $mail->CharSet = 'UTF-8'; // Asegurar codificación UTF-8 para caracteres especiales

        // Remitente (¡CAMBIA ESTO!)
        $mail->setFrom('info@singularmente.com.co', 'Singularmente');
        $mail->addReplyTo('info@singularmente.com.co', 'Contacto Singularmente');

        // Destinatario
        $mail->addAddress($toEmail, $toName);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyHtml;
        //$mail->addEmbeddedImage('logo.png', 'logo_singularmente', 'logo.png', 'base64', 'image/png');
        $mail->AltBody = $bodyText; // Versión de texto plano para clientes sin HTML

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo a {$toEmail}: {$mail->ErrorInfo}");
        return false;
    }
}

// ------------------------------------------------------------------------------------------------
// Configuración de la cabecera para CORS (IMPORTANTE para peticiones desde JS)
// ------------------------------------------------------------------------------------------------
header("Access-Control-Allow-Origin: *"); // Permite peticiones desde cualquier origen (AJUSTAR EN PRODUCCIÓN)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Manejo de la petición OPTIONS (preflight request de CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Obtener los datos JSON de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Asegurarse de que los datos están presentes
if (!isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Acción no especificada.']);
    exit();
}

$action = $data['action'];
$conn = getDbConnection(); // Obtener la conexión a la BD al principio

// ------------------------------------------------------------------------------------------------
// Lógica para diferentes acciones
// ------------------------------------------------------------------------------------------------

switch ($action) {
    case 'check_consent':
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email inválido.']);
            exit();
        }
        $email = $conn->real_escape_string($data['email']);

        $stmt = $conn->prepare("SELECT aceptado FROM consentimientos WHERE correo_electronico = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'has_consent' => $row['aceptado']]);
        } else {
            echo json_encode(['success' => true, 'has_consent' => false]);
        }
        $stmt->close();
        break;

    case 'record_consent':
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || !isset($data['accepted'])) {
            echo json_encode(['success' => false, 'message' => 'Datos de consentimiento inválidos.']);
            exit();
        }

        $email = $conn->real_escape_string($data['email']);
        $accepted = (bool)$data['accepted'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $policy_version = '1.0'; // ¡ACTUALIZA ESTO CADA VEZ QUE CAMBIES TU POLÍTICA DE PRIVACIDAD!

        // Generar hash para no repudio
        $consent_string = $email . date('Y-m-d H:i:s') . $ip_address . $user_agent . $policy_version . ($accepted ? 'true' : 'false');
        $hash = hash('sha256', $consent_string);

        // Intentar insertar o actualizar el consentimiento
        // Usamos INSERT ... ON DUPLICATE KEY UPDATE para manejar re-consentimientos
        $stmt = $conn->prepare("INSERT INTO consentimientos (correo_electronico, aceptado, direccion_ip, user_agent, version_politica, hash_consentimiento) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE aceptado = VALUES(aceptado), fecha_hora_consentimiento = VALUES(fecha_hora_consentimiento), direccion_ip = VALUES(direccion_ip), user_agent = VALUES(user_agent), version_politica = VALUES(version_politica), hash_consentimiento = VALUES(hash_consentimiento)");
        
        $stmt->bind_param("sissss", $email, $accepted, $ip_address, $user_agent, $policy_version, $hash);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Consentimiento registrado.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar consentimiento: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    case 'submit_appointment':
        // Validar que todos los campos necesarios estén presentes
        if (!isset($data['fullName'], $data['phone'], $data['email'], $data['date'], $data['serviceType'])) { 
            echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios para la cita.']);
            exit();
        }

        $fullName = $conn->real_escape_string($data['fullName']);
        $phone = $conn->real_escape_string($data['phone']);
        $email = $conn->real_escape_string($data['email']);
        $date = $conn->real_escape_string($data['date']); 
        $serviceType = $conn->real_escape_string($data['serviceType']);

        // Verificar si el consentimiento ha sido dado para este email
        $stmtConsent = $conn->prepare("SELECT aceptado FROM consentimientos WHERE correo_electronico = ?");
        $stmtConsent->bind_param("s", $email);
        $stmtConsent->execute();
        $resultConsent = $stmtConsent->get_result();
        $consentRow = $resultConsent->fetch_assoc();
        $stmtConsent->close();

        if (!$consentRow || !$consentRow['aceptado']) {
            echo json_encode(['success' => false, 'message' => 'Se requiere consentimiento de datos para solicitar una cita.']);
            exit();
        }

        // Insertar los datos de la cita en la base de datos
        $stmt = $conn->prepare("INSERT INTO citas (nombre_completo, telefono, correo_electronico, tipo_servicio ,fecha_cita) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $phone, $email, $serviceType, $date);

        if ($stmt->execute()) {
            // Envío de correos
            $successUserEmail = false;
            $successSingularmenteEmail = false;

            // 1. Correo de confirmación al usuario
            $subjectUser = 'Solicitud de cita en Singularmente recibida';
            $bodyHtmlUser = "
                <p>Hola <strong>{$fullName}</strong>,</p>
                <p>Hemos recibido tu solicitud de cita para el servicio de <strong>{$serviceType}</strong> para la fecha <strong>{$date}</strong>.</p>
                <p>Pronto nos pondremos en contacto contigo al número <strong>{$phone}</strong> o al correo <strong>{$email}</strong> para confirmar la hora y el profesional asignado.</p>
                <p>¡Gracias por confiar en Singularmente!</p>
                <p>Atentamente,</p>
                <p>El equipo de Singularmente</p>
                <img src='https://singularmente.com.co/logo.png' alt='Logo Singularmente' style='max-width: 150px; height: auto;'>
            ";
            $bodyTextUser = "Hola {$fullName},\nHemos recibido tu solicitud de cita para el servicio de {$serviceType} para la fecha {$date}.\nPronto nos pondremos en contacto contigo para confirmar la hora y el profesional asignado.\nGracias por confiar en Singularmente!\nAtentamente,\nEl equipo de Singularmente";
            $successUserEmail = sendEmail($email, $fullName, $subjectUser, $bodyHtmlUser, $bodyTextUser);

            // 2. Correo a Singularmente
            $subjectSingularmente = 'Nueva Solicitud de Cita Recibida';
            $bodyHtmlSingularmente = "
                <p>Se ha recibido una nueva solicitud de cita a través del sitio web:</p>
                <ul>
                    <li><strong>Nombre:</strong> {$fullName}</li>
                    <li><strong>Teléfono:</strong> {$phone}</li>
                    <li><strong>Correo:</strong> {$email}</li>
                    <li><strong>Servicio Solicitado:</strong> {$serviceType}</li> <li><strong>Fecha solicitada:</strong> {$date}</li>
                </ul>
                <p>Por favor, contactar al usuario para confirmar y asignar la cita.</p>
                <img src='https://singularmente.com.co/logo.png' alt='Logo Singularmente' style='max-width: 150px; height: auto;'>
            ";
            $bodyTextSingularmente = "Nueva Solicitud de Cita Recibida:\nNombre: {$fullName}\nTeléfono: {$phone}\nCorreo: {$email}\nServicio Solicitado: {$serviceType}\nFecha solicitada: {$date}\nPor favor, contactar al usuario.";
            $successSingularmenteEmail = sendEmail(SINGULARMENTE_EMAIL, 'Equipo Singularmente', $subjectSingularmente, $bodyHtmlSingularmente, $bodyTextSingularmente);

            echo json_encode([
                'success' => true,
                'message' => 'Solicitud de cita enviada exitosamente.',
                'email_user_sent' => $successUserEmail,
                'email_singularmente_sent' => $successSingularmenteEmail
            ]);

        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar la cita: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
        break;
}

$conn->close();
?>