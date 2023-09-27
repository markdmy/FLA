<?php

$name = $_POST["contact-name"];
$email = $_POST["contact-email"];
$phoneNumber = $_POST["contact-phone"];
$comments = $_POST["contact-comments"];

require "mail_library/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "mysticalmole@gmail.com";
$mail->Password = "lnew qjps rbsv miri";

$mail->setFrom($email, $name);
$mail->addAddress("markdmy@hotmail.com", "Mark");

$mail->Subject = "FLA Contact Us";

$mail->Body = "Name: $name | Email: $email | Phone Number: $phoneNumber | Comments: $comments";

$mail->AltBody = "Name: $name | Email: $email | Phone Number: $phoneNumber | Comments: $comments";
if ($mail->send()) {
    echo "Email sent successfully";
} else {
    echo "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
}
