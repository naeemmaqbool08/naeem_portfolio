<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/Libraries/PHPMailer/src/Exception.php';
require 'assets/Libraries/PHPMailer/src/PHPMailer.php';
require 'assets/Libraries/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$name = $_POST['full-name'];
$email = $_POST['email'];
$phone = $_POST['phone-number'];
$message = $_POST['message'];

try {

    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'abd768061293b4';                     //SMTP username
    $mail->Password   = '429f4f2e0aa3e1';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Naeem Maqbool');

    //Content
    $mail->isHTML(true);
    $mail->Body    = "
        Name : $name </br>
        Email : $email </br>
        Phone : $phone </br>
        Message : $message </br>
    ";

    $mail->send();
    ob_clean();
    echo json_encode(['status' => 200, 'msg' => 'Message has been sent']);
} catch (Exception $e) {
    echo json_encode(['status' => 400, 'msg' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}

?>