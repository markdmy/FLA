<?php
include('models/contact_model.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Free Laundry Access provides those in financial need living in Canada with access to clean laundry in self-service laundromats. " />
    <meta name="keywords"
        content="free laundry access, free laundry, laundromat, poverty, homelessness, charity laundry, Yummi Cafe Laundromat, free wash, free dry" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Free Laundry Access</title>
</head>

<body>
    <header>
        <a href="index.html" class="logo-link">
            <div class="logo">
                <img src="assets/images/logo.png" alt="Logo" />
                <h1 id="mainTitle">FREE LAUNDRY <strong>ACCESS</strong></h1>
            </div>
        </a>
        <div>
            <nav class="nav">
                <ul>
                    <li><a href="index.html">ABOUT US</a></li>
                    <li>
                        <a href="program.html">OUR PROGRAM</a>
                        <ul class="dropdown">
                            <li><a href="program.html">HOW IT WORKS</a></li>
                            <li><a href="program.html#eligible">WHO IS ELIGIBLE</a></li>
                            <li><a href="program.html#apply">HOW TO APPLY</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="help.html">YOUR HELP</a>
                        <ul class="dropdown">
                            <li><a href="help.html">DONATION</a></li>
                            <li><a href="volunteer.html">VOLUNTEER</a></li>
                        </ul>
                    </li>
                    <li><a href="partnership.html">PARTNERSHIP</a></li>
                    <li><a href="events.html">EVENTS</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="donation-bar">
        <div class="donation-text">
            <p>Your help will give HOPE, DIGNITY and HAPPINESS to those in need.</p>
        </div>
        <div id="donate-button-container">
            <div class="donate-btn" id="donate-btn"></div>
            <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
            <script>
            PayPal.Donation.Button({
                env: "production",
                hosted_button_id: "24NRC7PDKPWBC",
                image: {
                    src: "https://pics.paypal.com/00/s/YmIzYmNhYTktYzYwYi00MjI3LWEyNmUtZjU5NGViMzg0NmZm/file.PNG",
                    alt: "Donate with PayPal button",
                    title: "PayPal - The safer, easier way to pay online!",
                },
            }).render("#donate-btn");
            </script>
        </div>
    </div>

    <!-- Mobile Nav Bar: includes vertical menu and donate button -->
    <div class="mobileTopBar">
        <div class="mobile-icons">
            <div class="hamburger-icon">&#9776; MENU</div>

            <div id="donate-button-container">
                <div class="donateBtnMobile" id="donateBtnMobile"></div>
                <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                <script>
                PayPal.Donation.Button({
                    env: "production",
                    hosted_button_id: "24NRC7PDKPWBC",
                    image: {
                        src: "https://pics.paypal.com/00/s/YmIzYmNhYTktYzYwYi00MjI3LWEyNmUtZjU5NGViMzg0NmZm/file.PNG",
                        alt: "Donate with PayPal button",
                        title: "PayPal - The safer, easier way to pay online!",
                    },
                }).render("#donateBtnMobile");
                </script>
            </div>
        </div>
    </div>
    <div class="navMobile">
        <ul>
            <li><a href="index.html">ABOUT US</a></li>
            <li class="horizontal-line"></li>
            <li><a href="program.html">OUR PROGRAM</a></li>
            <li><a href="program.html" class="smaller-link">HOW IT WORKS</a></li>
            <li>
                <a href="program.html#eligible" class="smaller-link">WHO IS ELIGIBLE</a>
            </li>
            <li>
                <a href="program.html#apply" class="smaller-link">HOW TO APPLY</a>
            </li>
            <li class="horizontal-line"></li>
            <li><a href="help.html">YOUR HELP</a></li>
            <li><a href="help.html" class="smaller-link">DONATION</a></li>
            <li><a href="volunteer.html" class="smaller-link">VOLUNTEER</a></li>
            <li class="horizontal-line"></li>
            <li><a href="partnership.html">PARTNERSHIP</a></li>
            <li class="horizontal-line"></li>
            <li><a href="events.html">EVENTS</a></li>
            <li class="horizontal-line"></li>
            <li><a href="contact.php">CONTACT US</a></li>
        </ul>
    </div>
    <main>
        <div class="centerContactForm">

            <form action="models/contact_model.php" method="POST" id="contactForm" class="">
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

        </div>


    </main>

    <footer>
        <a href="https://www.facebook.com/profile.php?id=100094694715809"><img class="socialMediaIcons"
                src="assets/images/icon_facebook.png" alt="Facebook Profile" /></a>
        <a href="https://www.instagram.com/freelaundryaccess/?hl=en"><img class="socialMediaIcons"
                src="assets/images/icon_instagram.png" alt="Instagram Profile" /></a>
        <br />
        <p id="footerLinks">
            <a href="privacypolicy.html">Privacy Policy</a> &#124;
            <a href="termsandconditions.html">Terms &amp; Conditions</a>
        </p>
        <p>&copy; 2023 Free Laundry Access</p>
        <p>Charity Registration Number: 74952 8949 RR0001</p>
    </footer>
    <script type="application/javascript" src="js/app.js"></script>
    <script type="application/javascript" src="js/form.js"></script>
</body>

</html>