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