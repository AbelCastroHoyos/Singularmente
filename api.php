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

// Primero, intenta obtener la acción de los parámetros GET (para peticiones simples como get_events)
$action = $_GET['action'] ?? null;

// Si no se encuentra en GET, intenta obtenerla del cuerpo JSON de la petición (para peticiones POST/complejas)
if ($action === null) {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $action = $data['action'] ?? null;
}

// Asegurarse de que la acción está presente
if (!isset($action)) {
    echo json_encode(['success' => false, 'message' => 'Acción no especificada o no válida.']);
    exit();
}

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

    case 'get_events':
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 3; // Límite para la página principal
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
        $search_term = isset($_GET['search_term']) ? $conn->real_escape_string($_GET['search_term']) : '';
        $upcoming_only = isset($_GET['upcoming_only']) ? filter_var($_GET['upcoming_only'], FILTER_VALIDATE_BOOLEAN) : false; // Para "Ver más eventos"

        $sql = "SELECT event_id, event_code, title, event_type, event_date_time, duration_hours, location, event_modality, connection_url, is_registrable, registration_limit FROM events WHERE is_active = 1";

        $params = [];
        $types = "";

        if ($upcoming_only) {
            $sql .= " AND event_date_time >= NOW()"; // Solo eventos futuros
        }

        if (!empty($search_term)) {
            $sql .= " AND (title LIKE ? OR location LIKE ? OR event_type LIKE ?)";
            $params[] = "%" . $search_term . "%";
            $params[] = "%" . $search_term . "%";
            $params[] = "%" . $search_term . "%";
            $types .= "sss";
        }

        $sql .= " ORDER BY event_date_time ASC"; // Ordenar por fecha, los más próximos primero

        // Añadir límite y offset solo si no es una búsqueda completa sin paginación específica
        if ($limit > 0) { // Si limit es 0, se entienden todos los eventos
            $sql .= " LIMIT ? OFFSET ?";
            $params[] = $limit;
            $params[] = $offset;
            $types .= "ii";
        }
        
        $stmt = $conn->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        echo json_encode(['success' => true, 'events' => $events]);
        $stmt->close();
        break;

    case 'get_person_data_for_event_reg':
        // Este endpoint es para pre-llenar el formulario y verificar consentimiento
        $document_type = $_POST['document_type'] ?? '';
        $document_number = $_POST['document_number'] ?? '';
        $email = $_POST['email'] ?? '';

        if (empty($document_number) && empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Número de documento o email es requerido.']);
            break;
        }

        $sql = "SELECT p.*, (SELECT MAX(c.created_at) FROM privacy_consents c WHERE c.person_id = p.person_id AND c.is_active = 1) AS last_consent_date
                FROM persons p
                WHERE (p.document_type = ? AND p.document_number = ?) OR p.email = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $document_type, $document_number, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $person_data = $result->fetch_assoc();
        $stmt->close();

        if ($person_data) {
            $person_data['has_active_consent'] = !empty($person_data['last_consent_date']);
            echo json_encode(['success' => true, 'person' => $person_data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Persona no encontrada.']);
        }
        break;


    case 'register_event':
        // Obtener y sanitizar datos del formulario
        $event_code = $conn->real_escape_string($_POST['event_code'] ?? '');
        $document_type = $conn->real_escape_string($_POST['document_type'] ?? '');
        $document_number = $conn->real_escape_string($_POST['document_number'] ?? '');
        $full_name = $conn->real_escape_string($_POST['full_name'] ?? '');
        $address = $conn->real_escape_string($_POST['address'] ?? '');
        $phone = $conn->real_escape_string($_POST['phone'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $profession = $conn->real_escape_string($_POST['profession'] ?? '');
        $city_of_residence = $conn->real_escape_string($_POST['city_of_residence'] ?? '');
        $privacy_consent_accepted = filter_var($_POST['privacy_consent_accepted'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $registration_ip = $_SERVER['REMOTE_ADDR'];

        // 1. Validar datos mínimos
        if (empty($event_code) || empty($document_type) || empty($document_number) || empty($full_name) || empty($phone) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos obligatorios.']);
            break;
        }

        // 2. Verificar si el evento existe y es registrable
        $stmt = $conn->prepare("SELECT event_id, is_registrable, registration_limit FROM events WHERE event_code = ? AND is_active = 1");
        $stmt->bind_param("s", $event_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $event_data = $result->fetch_assoc();
        $stmt->close();

        if (!$event_data || !$event_data['is_registrable']) {
            echo json_encode(['success' => false, 'message' => 'El evento no existe o no permite inscripciones.']);
            break;
        }
        $event_id = $event_data['event_id'];
        $registration_limit = $event_data['registration_limit'];

        // 3. Verificar límite de cupos si aplica
        if ($registration_limit !== null) {
            $stmt = $conn->prepare("SELECT COUNT(*) AS registered_count FROM event_registrations WHERE event_id = ? AND status = 'registered'");
            $stmt->bind_param("i", $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $registered_count = $row['registered_count'];
            $stmt->close();

            if ($registered_count >= $registration_limit) {
                echo json_encode(['success' => false, 'message' => 'Lo sentimos, los cupos para este evento se han agotado.']);
                break;
            }
        }

        // 4. Procesar o crear la persona
        $person_id = null;
        $stmt = $conn->prepare("SELECT person_id FROM persons WHERE document_number = ? AND document_type = ?");
        $stmt->bind_param("ss", $document_number, $document_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $existing_person = $result->fetch_assoc();
        $stmt->close();

        if ($existing_person) {
            $person_id = $existing_person['person_id'];
            // Actualizar datos de la persona si ya existe
            $stmt = $conn->prepare("UPDATE persons SET full_name=?, address=?, phone=?, email=?, profession=?, city_of_residence=?, updated_at=NOW() WHERE person_id=?");
            $stmt->bind_param("ssssssi", $full_name, $address, $phone, $email, $profession, $city_of_residence, $person_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Crear nueva persona
            $stmt = $conn->prepare("INSERT INTO persons (document_type, document_number, full_name, address, phone, email, profession, city_of_residence) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $document_type, $document_number, $full_name, $address, $phone, $email, $profession, $city_of_residence);
            $stmt->execute();
            $person_id = $stmt->insert_id;
            $stmt->close();
        }

        if (!$person_id) {
            echo json_encode(['success' => false, 'message' => 'Error al procesar los datos de la persona.']);
            break;
        }

        // 5. Procesar consentimiento de privacidad
        $has_active_consent = false;
        $stmt = $conn->prepare("SELECT consent_id FROM privacy_consents WHERE person_id = ? AND is_active = 1");
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->fetch_assoc()) {
            $has_active_consent = true;
        }
        $stmt->close();

        if (!$has_active_consent && !$privacy_consent_accepted) {
            echo json_encode(['success' => false, 'message' => 'Debe aceptar la política de tratamiento de datos personales para registrarse.']);
            break;
        } elseif (!$has_active_consent && $privacy_consent_accepted) {
            // Registrar nuevo consentimiento si no existe y fue aceptado
            $consent_hash = hash('sha256', $document_number . $email . $registration_ip . time()); // Genera un hash para el consentimiento
            $stmt = $conn->prepare("INSERT INTO privacy_consents (person_id, consent_ip, consent_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $person_id, $registration_ip, $consent_hash);
            $stmt->execute();
            $stmt->close();
        }

        // 6. Registrar la inscripción al evento
        // Primero verificar si ya está registrado para este evento
        $stmt = $conn->prepare("SELECT registration_id FROM event_registrations WHERE event_id = ? AND person_id = ?");
        $stmt->bind_param("ii", $event_id, $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $existing_registration = $result->fetch_assoc();
        $stmt->close();

        if ($existing_registration) {
            echo json_encode(['success' => false, 'message' => 'Ya estás registrado para este evento.']);
            break;
        }

        $registration_hash = hash('sha256', $event_id . $person_id . $registration_ip . time()); // Genera un hash para la inscripción
        $stmt = $conn->prepare("INSERT INTO event_registrations (event_id, person_id, registration_ip, registration_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $event_id, $person_id, $registration_ip, $registration_hash);

        if ($stmt->execute()) {
            // Envío de correo al usuario (Opcional, pero recomendado)
            // Puedes personalizar este correo para el evento
            $event_title = $conn->real_escape_string($event_data['title']); // Obtener título del evento
            $event_date = date('d/m/Y H:i', strtotime($event_data['event_date_time'])); // Formatear fecha
            $event_location = $conn->real_escape_string($event_data['location']);
            $event_modality = $conn->real_escape_string($event_data['event_modality']);
            $event_connection_url = $conn->real_escape_string($event_data['connection_url']);

            $subjectUser = "Confirmación de tu inscripción al evento: " . $event_title;
            $bodyHtmlUser = "
                <p>Hola {$full_name},</p>
                <p>¡Gracias por inscribirte a nuestro evento **\"{$event_title}\"**!</p>
                <p>Aquí tienes los detalles:</p>
                <ul>
                    <li><strong>Evento:</strong> {$event_title}</li>
                    <li><strong>Fecha y Hora:</strong> {$event_date}</li>
                    <li><strong>Modalidad:</strong> {$event_modality}</li>
                    <li><strong>Ubicación:</strong> {$event_location}</li>";
            if (!empty($event_connection_url) && ($event_modality == 'virtual' || $event_modality == 'mixed')) {
                $bodyHtmlUser .= "<li><strong>Enlace de Conexión:</strong> <a href=\"{$event_connection_url}\">Haz clic aquí para unirte</a></li>";
            }
            $bodyHtmlUser .= "
                </ul>
                <p>Te esperamos.</p>
                <p>Atentamente,<br>El equipo de Singularmente</p>
                <img src='https://singularmente.com.co/logo.png' alt='Logo Singularmente' style='max-width: 150px; height: auto;'>
            ";
            $bodyTextUser = "Hola {$full_name},\n¡Gracias por inscribirte a nuestro evento \"{$event_title}\"!\n\nAquí tienes los detalles:\nEvento: {$event_title}\nFecha y Hora: {$event_date}\nModalidad: {$event_modality}\nUbicación: {$event_location}";
            if (!empty($event_connection_url) && ($event_modality == 'virtual' || $event_modality == 'mixed')) {
                $bodyTextUser .= "\nEnlace de Conexión: {$event_connection_url}";
            }
            $bodyTextUser .= "\n\nTe esperamos.\nAtentamente,\nEl equipo de Singularmente";

            $successUserEmail = sendEmail($email, $full_name, $subjectUser, $bodyHtmlUser, $bodyTextUser);

            echo json_encode([
                'success' => true,
                'message' => '¡Inscripción al evento exitosa! Te hemos enviado un correo de confirmación.',
                'email_user_sent' => $successUserEmail
            ]);

        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar la inscripción: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
        break;
}

$conn->close();
?>