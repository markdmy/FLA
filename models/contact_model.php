<!--coded by Mark and Eunji. DB by eunji, mail server by Mark-->

<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //had to change variable names because they are key words in SGL or php
    $contactName = $_POST["contact-name"];
    $contactEmail = $_POST["contact-email"];
    $contactPhoneNumber = $_POST["contact-phone"];
    $contactComments = $_POST["contact-comments"];
    $contactFormCreated = date('Y-m-d H:i:s');
    

try {
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

$mail->setFrom("contact@freelaundryaccess.com", $contactName);
$mail->addAddress("contact@freelaundryaccess.com", "Nancy");

$mail->Subject = "FLA Contact Us";

$mail->Body = "Name: $contactName\nEmail: $contactEmail\nPhone Number: $contactPhoneNumber\nComments: $contactComments";

$mail->AltBody = "Name: $contactName\nEmail: $contactEmail\nPhone Number: $contactPhoneNumber\nComments: $contactComments";

if ($mail->send()) {
    $emailSent = true;
    header("Location: contactsubmit.html");
    exit();
} else {
    echo "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
    $emailSent = false;
}

//pushing posted data to database even when the mail server is down.
add_contactFormData($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated, $emailSent);
        
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

}



function add_contactFormData($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated, $emailSent){

    global $db;
    try {
        $query = "INSERT INTO contactform (contactID, contactName, contactEmail, contactPhone, comments, formCreated, emailSent) 
        VALUES (NULL, '$contactName', '$contactEmail', '$contactPhoneNumber', '$contactComments', '$contactFormCreated', '$emailSent')";

        $result = $db->query($query);

        if ($result) {
            return true; 
        } else {
            throw new Exception("Database query failed: " . $db->error);
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return false; 
    }
    
}

?>