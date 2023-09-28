<?php

$name = $_POST["contact-name"];
$email = $_POST["contact-email"];
$phoneNumber = $_POST["contact-phone"];
$comments = $_POST["contact-comments"];

require "mail_library/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.netfirms.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;

$mail->Username = "contact@freelaundryaccess.com";
$mail->Password = "Freelaundryaccess4168441484";

$mail->setFrom("contact@freelaundryaccess.com", $name);
$mail->addAddress("contact@freelaundryaccess.com", "Nancy");

$mail->Subject = "FLA Contact Us";

$mail->Body = "Name: $name\nEmail: $email\nPhone Number: $phoneNumber\nComments: $comments";

$mail->AltBody = "Name: $name\nEmail: $email\nPhone Number: $phoneNumber\nComments: $comments";

if ($mail->send()) {
    echo "Email sent successfully";
} else {
    echo "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
}
?>
