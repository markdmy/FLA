<!--coded by Eunji--- volunteer pages done by Enobong -->
<?php

$message = "";
$isEventPage = false;

//this is valid code if we arent using trigger (so no reference )
if (isset($_GET['participantEmail']) && isset($_GET['firstName'])) {
    $email = $_GET['participantEmail'];
    $firstName = $_GET['firstName'];
    $message = "You have successfully submitted the registration form";
} elseif (isset($_GET['partnerEmail']) && isset($_GET['laundromatName']) && isset($_GET['partnerFirstName'])) {
    $email = $_GET['partnerEmail'];
    $laundromatName = $_GET['laundromatName'];
    $firstName = $_GET['partnerFirstName'];
    $message = "You have successfully submitted the partnership form";
} elseif (isset($_GET['contactName'])){
    $firstName = $_GET['contactName'];
    $message = "We'll be in touch shortly.";
}//volunteer pages done by Enobong
elseif (isset($_GET['volunteerEmail']) && isset($_GET['volunteerFirstName'])) {
    $email = $_GET['volunteerEmail'];
    $firstName = $_GET['volunteerFirstName'];
    $message = "You have successfully submitted the volunteer form";
} elseif(isset($_GET['eventDate']) && isset($_GET['nameOfLaundromat']) && isset($_GET['streetAddress'])) {
    $isEventPage = true;
    $eventDate = $_GET['eventDate'];
    $nameOfLaundromat = $_GET['nameOfLaundromat'];
    $streetAddress = $_GET['streetAddress'];
    $message = "Event for <b>$nameOfLaundromat</b><br> Created at <b>$streetAddress</b><br> on <b>$eventDate</b>";
}elseif(isset($_GET['eventParticipantName']) && isset($_GET['eventParticipantEmail']) && isset($_GET['partnerNameOfLaundromat']) && isset($_GET['partnerEventDate']) && isset($_GET['partnerStreetAddress']) &&isset($_GET['totalCost'])) {
    $isEventPage = true;
    $eventParticipantName = $_GET['eventParticipantName'];
    $eventParticipantEmail = $_GET['eventParticipantEmail'];
    $eventDate = $_GET['partnerEventDate'];
    $nameOfLaundromat = $_GET['partnerNameOfLaundromat'];
    $streetAddress = $_GET['partnerStreetAddress'];
    $totalCost = $_GET['totalCost'];
    $message = "Participant(<b>$eventParticipantName</b>)<br> with email <b>$eventParticipantEmail</b><br> added to the event at <b>$nameOfLaundromat</b><br>
    at location($streetAddress)<br> on <b>$eventDate</b><br><br>
    Cost of wash + dry + products = <b> $$totalCost</b>";
} elseif(isset($_GET['eventVolunteerName']) && isset($_GET['eventVolunteerEmail']) && isset($_GET['volunteerNameOfLaundromat']) && isset($_GET['volunteerEventDate']) && isset($_GET['volunteerStreetAddress'])){
    $isEventPage = true;
    $eventVolunteerName = $_GET['eventVolunteerName'];
    $eventVolunteerEmail = $_GET['eventVolunteerEmail'];
    $eventDate = $_GET['volunteerEventDate'];
    $nameOfLaundromat = $_GET['volunteerNameOfLaundromat'];
    $streetAddress = $_GET['volunteerStreetAddress'];
    $message = "Volunteer(<b>$eventVolunteerName</b>)<br> with email <b>$eventVolunteerEmail</b><br> added to the event at <b>$nameOfLaundromat</b><br>
    at location($streetAddress)<br> on <b>$eventDate</b><br><br>";
}elseif(isset($_GET['signup_email']) && isset($_GET['signup_firstname'])){
    $isEventPage = true;
    $admin_signup_email = $_GET['signup_email'];
    $admin_signup_name = $_GET['signup_firstname'];
    $message = "Volunteer/staff name(<b>$admin_signup_name</b>)<br> Sign-up Email: <b>$admin_signup_email</b><br><br> Please login with your email address and password when you access event.php<br>";
}
else {
    $message = "Error: No form has been submitted. ";
}

$showThankYouMessage = !empty($firstName);
$buttonText = $isEventPage ? "Go to event.php" : "Go Home";
$buttonLink = $isEventPage ? "event.php" : "index.html";


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Form successfully submitted" />
    <meta name="keywords" content="form completed">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Form Submitted</title>
    <!--google tag manager script-->
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());
    gtag("config", "G-JDKE8RQXYH");
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JDKE8RQXYH"></script>

</head>

<body>
    <?php 
    include('components/header.php')?>


    <section class="container">
        <div class="submission-success-message">
            <!-- Display the "Thank you" message and $firstName only when $showThankYouMessage is true -->
            <?php if ($showThankYouMessage) : ?>
            <h2 class="thankyou-name">Thank you, <?php echo $firstName; ?> !</h2>
            <?php endif ?>

            <!-- Display different messages based on the presence of firstName and email -->
            <div class="reference-box">
                <?php if (!empty($firstName) && !empty($email)) : ?>
                <p class="success-phrase"><?php echo $message; ?>
                    with your email: <b><?php echo $email; ?></b></p>
                <?php else : ?>
                <p class="success-phrase"><?php echo $message; ?></p>
                <?php endif ?>
            </div>

            <button class="btn-container" onclick="window.location.href='<?php echo $buttonLink; ?>'">
                <div class="btn <?php echo $buttonText === "Go to event.php" ? "btn-goevent" : "btn-gohome"; ?>">
                    <span><?php echo $buttonText; ?></span>
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