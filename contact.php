<?php
include('models/contact_model.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Contact Free Laundry Access for any inquiries." />
    <meta name="keywords" content="free laundry access, contact form, email form" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Contact Us</title>
</head>

<body>
    <?php include('components/header.php'); ?>
    <main>
        <div class="centerContactForm">
            <!--coded by eunji-->
            <form action="models/send-email.php" method="POST" id="contactForm" class="">
                <h2 class="h2ContactUs">Contact Us</h2>
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" placeholder="Your Name" name="name" class="form-input" required>

                <label for="email" class="form-label">Email:</label>
                <input type="text" id="email" placeholder="Your Email" name="email" class="form-input" required>

                <label for="phone" class="form-label">phone number(Optional)</label>

                <input type="tel" id="phone" name="phoneNumber" placeholder="Format: 123-456-7890"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-input">

                <label for="message" class="form-label">Message:</label>
                <textarea name="comments" rows="4" required class="form-textarea"></textarea>
                <button type="submit" id="contactSubmit" class="btn-container" onclick="">
                    <div class="btn btn-submit">
                        <span>SUBMIT</span>
                    </div>
                </button>
            </form>
            <!--coded by eunji-->
        </div>


    </main>

    <?php
include('components/footer.php'); ?>