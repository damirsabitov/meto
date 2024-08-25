<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $nameoftheorganization = $_POST['nameoftheorganization'];
    $number = $_POST['number'];

    $to = 'damirsabitov2905@yandex.ru'; // замените на ваш электронный адрес
    $subject = 'New application from website';

    $body = "Name: $name\n";
    $body .= "Name of the organization: $nameoftheorganization\n";
    $body .= "Number: $number\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    echo 'Application sent successfully!';
} else {
    echo 'Error sending application!';
}
?>