<!--coded by Mark to connect email server
function created by eunji-->
<?php
use PHPMailer\PHPMailer\PHPMailer;

//this function will be called when a user submit a contact from from contact.php
function send_email($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated)
{

    try {
        require "mail_library/vendor/autoload.php";

        $mail = new PHPMailer(true);

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
            echo "<script>window.location.href='submitSuccess.php?contactName=$contactName';</script>"; 
        }
         
        else {
            $_SESSION['email_error'] = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }
    
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}


?>