<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $comments = $_POST["comments"];



// Please insert the email address to test 
    $to = ""; 
    $subject = "Contact Form Submission from $name";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
 
    $sendmailPath = "/usr/sbin/sendmail";

    $emailMessage = "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Phone: $phoneNumber\n";
    $emailMessage .= "Message:\n$comments";

    $mailSuccess = mail($to, $subject, $emailMessage, $headers);

    if ($mailSuccess) {
        echo "Thank you for your message. We will get back to you shortly.";
    } else {
        echo "Sorry, there was an error sending your message. Please try again later.";
    }

    echo ' <p>Redirecting to home page...</p>'
   

echo '<script>
    setTimeout(function() {
        location.href = "../index.html"; 
    }, 3000);
</script>';
}
?>