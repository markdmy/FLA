<!--coded by Eunji--->
<?php
include('models/email_model.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contactName = $_POST["contact-name"];
    $contactEmail = $_POST["contact-email"];
    $contactPhoneNumber = $_POST["contact-phone"];
    $contactComments = $_POST["contact-comments"];
    $contactFormCreated = date('Y-m-d H:i:s');
    $redirectUrl = send_email_from_contact_form($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated);
   
    if($redirectUrl){
        echo "<script>window.location.href='$redirectUrl';</script>";
        exit();
    }
}    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Contact Free Laundry Access for any inquiries." />
    <meta name="keywords" content="free laundry access, contact form, email form" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Contact Us</title>
</head>

<body>
    <?php include('components/header.php'); ?>
    <section class="container">
        <form action="contact.php" method="POST" id="contactForm" class="form">
            <h2 class="h2ContactUs">Contact Us</h2>
            <div class="form-content">
                <div class="input-box">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="contact-name" placeholder="Your Name" name="contact-name" class="form-input"
                        required>
                </div>
                <div class="input-box">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="contact-email" placeholder="Your Email" name="contact-email"
                        class="form-input" required>
                </div>
                <div class="input-box">
                    <label for="phone" class="form-label">phone number(Optional)</label>
                    <input type="tel" id="contact-phone" name="contact-phone" placeholder="Format: 123-456-7890"
                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-input">


                </div>
                <div class="input-box">
                    <label for="message" class="form-label">Message:</label>
                </div>

                <textarea name="contact-comments" rows="5" required class="form-textarea"></textarea>

            </div>

            <button type="submit" id="contactSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>





    </section>

    <?php
include('components/footer.php'); ?>

    <script src="js/app.js"></script>
</body>

</html>