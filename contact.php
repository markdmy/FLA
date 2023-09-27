<!--coded by Eunji--->
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
<form action="models/contact_model.php" method="POST" id="contactForm" class="">
                <h2 class="h2ContactUs">Contact Us</h2>
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="contact-name" placeholder="Your Name" name="contact-name" class="form-input"
                    required>

                <label for="email" class="form-label">Email:</label>
                <input type="email" id="contact-email" placeholder="Your Email" name="contact-email" class="form-input"
                    required>

                <label for="phone" class="form-label">phone number(Optional)</label>

                <input type="tel" id="contact-phone" name="contact-phone" placeholder="Format: 123-456-7890"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-input">

                <label for="message" class="form-label">Message:</label>
                <textarea name="contact-comments" rows="4" required class="form-textarea"></textarea>
                <button type="submit" id="contactSubmit" class="btn-container" onclick="">
                    <div class="btn btn-submit">
                        <span>SUBMIT</span>
                    </div>
                </button>
            </form>


    </main>

    <?php
include('components/footer.php'); ?>