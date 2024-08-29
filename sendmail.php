<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Initialize variables
$name = '';
$organization = '';
$phone = '';
$errors = [];

// Validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars(mb_strimwidth($_POST['name'], 0, 255, '...')));
    $organization = trim(htmlspecialchars(mb_strimwidth($_POST['nameoftheorganization'], 0, 255, '...')));
    $phone = trim(filter_var($_POST['number'], FILTER_SANITIZE_NUMBER_INT));

    // 
    // If there are no errors, proceed to send the email
    if (empty($errors)) {
        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.hosting.reg.ru';                // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'no-reply@meto-group.ru';              // SMTP username
            $mail->Password   = '';                            // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           // Enable implicit TLS encryption
            $mail->Port       = 465;                                   // TCP port to connect to

            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom('damirsabitov2905@yandex.com', 'FromFrom');
            $mail->addAddress('no-reply@meto-group.ru', 'ToTo');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Пользователь {$name} оставил заявку на подключение";
            $mail->Body    = "Пользователь {$name} оставил заявку на подключение. Его данные: <br>ФИО: {$name}<br>Название организации: {$organization}<br>Номер телефона: {$phone}";
            $mail->AltBody = "Пользователь {$name} оставил заявку на подключение. Его данные: \nФИО: {$name}\nНазвание организации: {$organization}\nНомер телефона: {$phone}";

            $mail->send();
            header('Location: index.html');
            die();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
