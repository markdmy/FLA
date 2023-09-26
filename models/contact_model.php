<!--coded by eunji : right now because I cant test the mail server, when the user filled out and submit the form 
it will led to contact_model.php page showing the error message and it will redirect the page to the home page 
but once we can figure out mail server works, we can just simple reponse to the user with a pop up window or 
alert message ---->

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["contact-name"];
    $email = $_POST["contact-email"];
    $phoneNumber = $_POST["contact-phone"];
    $comments = $_POST["contact-comments"];

    //this try and catch block will execute and show what we need to change fopr mail server to connet
    //eunji

    try {
        $to = "info@freelaundryaccess.com"; 
        $subject = "Contact Form Submission from $name";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $emailMessage = "Name: $name\n";
        $emailMessage .= "Email: $email\n";
        $emailMessage .= "Phone: $phoneNumber\n";
        $emailMessage .= "Message:\n$comments";

        $mailSuccess = mail($to, $subject, $emailMessage, $headers);

        //we could change this block of code to direct the page to contactSubmit.html or contactSubmit.php.
        if ($mailSuccess) {
            echo "Thank you for your message. We will get back to you shortly.";
        } else {
            echo "Sorry, there was an error sending your message. Please try again later.";
        }
        
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }


    //temporary solution 
    echo ' <p>Redirecting to home page....</p>';
   
    echo '<script>
        setTimeout(function() {
            location.href = "../index.html"; 
        }, 10000);
    </script>';
}
?>