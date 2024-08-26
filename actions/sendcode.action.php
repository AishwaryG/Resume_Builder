<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require './assets/class/database.php';
require './assets/class/function.class.php';

require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';


if ($_POST) {

    $post = $_POST;

    if ($post['email_id']) {



        // For security encryption
        $email_id = $db->real_escape_string($post['email_id']);
        





        // Check if the user already exists
        $result = $db->query("SELECT id,full_name FROM users WHERE (email_id = '$email_id')");

        $result = $result->fetch_assoc();
        

            if ($result) {
              $otp =rand(1000000,999999)

              $mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Resume builder');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo 'Message has been sent';
} catch (Exception $e) {
    $fn->setError($email_id.'is not registered');
    $fn->redirect('../forgot-password.php');
}


            } else{
               $fn->setError($email_id.'is not registered');
                $fn->redirect('../forgot-password.php');
            }


    } else {
        $fn->setError('Please Enter Email ID!');
        $fn->redirect('../forgot-password.php');
    }
} else {
    $fn->redirect('../forgot-password.php');
}

?>
