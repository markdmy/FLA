<!--coded by Eunji--->
<?php

if (isset($_GET['participantReference']) && isset($_GET['firstName'])) {
    $reference = $_GET['participantReference'];
    $firstName = $_GET['firstName'];
    $message = "You have successfully submitted the registration form.";
} elseif (isset($_GET['partnerReference']) && isset($_GET['partnerFirstName'])) {
    $reference = $_GET['partnerReference'];
    $firstName = $_GET['partnerFirstName'];
    $message = "You have successfully submitted the partnership form.";
} elseif (isset($_GET['contactName'])) {
    $firstName = $_GET['contactName'];
    $message = "We'll be in touch shortly.";
} else {
    $message = "Error: Form information not found.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JDKE8RQXYH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-JDKE8RQXYH');
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Form successfully submitted" />
    <meta name="keywords" content="form completed">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Form Submitted</title>
</head>

<body>
    <?php
    include('components/header.php') ?>


    <section class="container">
        <div class="submission-success-message">
            <h2 class="thankyou-name">Thank you, <?php echo $firstName; ?> !</h2>
            <p class="success-phrase"><?php echo $message; ?></p>

            <?php if (isset($_GET['participantReference']) || isset($_GET['partnerReference'])) : ?>
                <div class="reference-box">
                    <p class="reference-phrase">Your
                        <?php echo isset($_GET['participantReference']) ? "participant" : "partnership"; ?> reference is
                        <b><?php echo $reference; ?>.</b>
                    </p>
                    <p class="reference-reason">*Please keep the reference for event signup.</p>
                </div>
            <?php endif; ?>


            <button class="btn-container" onclick="window.location.href='index.html' ">
                <div class="btn btn-gohome">
                    <span>GO HOME</span>
                </div>
            </button>

        </div>



    </section>




    <?php
    include('components/footer.php'); ?>


    <script src="js/app.js"></script>

    <!-- <script src="js/form.js"></script> -->
</body>

</html>