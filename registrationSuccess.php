<!--coded by Eunji--->
<?php

if (isset($_GET['participantReference']) && isset($_GET['firstName'])) {
    $participantReference = $_GET['participantReference'];
    $firstName = $_GET['firstName'];
} else {
   
    echo "Error: Participant information not found.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Register form successfully submitted" />
    <meta name="keywords" content="registration completed">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Registration submitted</title>

<body>
    <?php 
    include('components/header.php')?>


    <section class="container">
        <div class="registration-success-message">
            <h1 class="thankyou-name">Thank you, <?php echo $firstName; ?> !</h1>
            <p class="success-phrase">You have successfully submitted the registration form.</p>
            <p class="participant-reference">Your participant reference is <b><?php echo $participantReference; ?>.</b>
            </p>

            <!---- please change the href-->
            <button class="btn-container" onclick="window.location.href='/' ">
                <div class="btn btn-gohome">
                    <span>GO HOME</span>
                </div>
            </button>

        </div>



    </section>




    <?php
include('components/footer.php'); ?>