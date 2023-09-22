<!--coded by eunji : right now because I cant test the mail server, when the user filled out and submit the form 
it will led to contact_model.php page showing the error message and it will redirect the page to the home page 
but once we can figure out mail server works, we can just simple reponse to the user with a pop up window or 
alert message ---->

<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $comments = $_POST["comments"];

    try {
        $to = "Info@freelaundryaccess.com"; 
        $subject = "Contact Form Submission from $name";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

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
        
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

    echo ' <p>Redirecting to home page....</p>';
   
    echo '<script>
        setTimeout(function() {
            location.href = "../index.html"; 
        }, 6000);
    </script>';
}
?>