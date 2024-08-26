<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// validation data
$name = trim(htmlspecialchars(mb_strimwidth($_POST['name'], 0, 255, '...')));
$organization = trim(htmlspecialchars(mb_strimwidth($_POST['nameoftheorganization'], 0, 255, '...')));
$phone = trim(filter_var($_POST['number'], FILTER_SANITIZE_NUMBER_INT));

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     //SMTP username
    // $mail->Password   = 'secret';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('damirsabitov2905@yandex.com', 'FromFrom');
    $mail->addAddress('ramzilhalitov44@gmail.com', 'ToTo');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Пользователь {$name} оставил заявку на подключение";
    $mail->Body    = "Пользователь {$name} оставил заявку на подключение. Его данные: <br>ФИО: {$name}<br>Название организации: {$organization}<br>Номер телефона: {$phone}";
    $mail->AltBody = "Пользователь {$name} оставил заявку на подключение. Его данные: \nФИО: {$name}\nНазвание организации: {$organization}\nНомер телефона: {$phone}";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}