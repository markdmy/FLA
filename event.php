<?php 
session_start();

// Add this line to inspect the session data
var_dump($_SESSION);

//if the user has NOT logged in successfully, it will show admin_login page. Typically when first goes to event.php
if (!isset($_SESSION["admin_authenticated"]) || $_SESSION["admin_authenticated"] !== true) {
    echo "<script>window.location.href='admin_login.php';</script>";
    exit();
}
include("models/events_model.php");
include("models/search_partner.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Admin page for entering data." />
    <meta name="keywords" content="Administrators, data entry" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/event.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Events Process form</title>
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="event-navigation">
        <button class="event-nav-button clicked" data-form="add-event">Add Events</button>
        <button class="event-nav-button" data-form="add-participant">Add Participants</button>
        <button class="event-nav-button" data-form="add-volunteer">Add Volunteers</button>
    </div>


    <!-- <section id="add-event" class="container event-container">
        <form action="models/events_model.php" method="post" id="eventForm" class="form">
            <h2>Add Events</h2>
            <div class="form-container">
                <div class="input-box">
                    <label for="event_date">Event Date:</label>
                    <input type="date" name="event_date" required><br>
                </div>
                <div class="input-box">
                    <label for="partner_reference">Partnership(Laundromat) Reference:</label>
                    <input type="text" name="partner_reference" required>
                </div>
                <button type="button" id="searchButton">Search Laudromat</button>

            </div>

            <button type="submit" id="eventSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>


        <div id="popup-search-partner" class="popup" style="display: none;">
            <div id="partnerSearch">
                <form action="models/search_partner.php" method="post" class="searchForm">
                    <div class="input-box">
                        <label for="name-of-laundromat">Enter Name of Laundromat:</label><br>
                        <input type="text" id="laundromat-name" name="laundromat-name" required>
                    </div>
                    <button type="button" id="searchPartnerButton">Search</button>
                </form>
                <div id="partnerReferenceResult"></div>
            </div>
        </div>




    </section> -->


    <!---this is to use partner ID  to add avents --->
    <section id="add-event" class="container event-container">
        <form action="models/events_model.php" method="post" id="eventForm" class="form">
            <h2>Add Events</h2>
            <div class="form-container">
                <div class="input-box">
                    <label for="event_date">Event Date:</label>
                    <input type="date" name="event_date" required><br>
                </div>
                <div class="input-box">
                    <label for="partner_id">Partnership Reference Number:</label>
                    <input type="text" name="partner_id" required>
                </div>
                <button type="button" id="searchPartnerButton">Search Reference</button>

            </div>

            <button type="submit" id="eventSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>


        <div id="popup-search-partner" class="popup" style="display: none;">
            <div id="partnerSearch">
                <form action="models/search_partner.php" method="post" class="searchForm">
                    <div class="input-box">
                        <label for="name-of-laundromat">Enter Name of Laundromat:</label><br>
                        <input type="text" id="laundromat-name" name="laundromat-name" required>
                    </div>
                    <button type="button" id="searchPartnerIDButton">Search</button>
                </form>
                <div id="partnerIDResult"></div>
            </div>
        </div>




    </section>


    <!---this is to use reference -->
    <!-- <section id="add-event" class="container event-container">
        <form action="models/events_model.php" method="post" id="eventForm" class="form">
            <h2>Add Events</h2>
            <div class="form-container">
                <div class="input-box">
                    <label for="event_date">Event Date:</label>
                    <input type="date" name="event_date" required><br>
                </div>
                <div class="input-box">
                    <label for="partner_reference">Partnership(Laundromat) Reference:</label>
                    <input type="text" name="partner_reference" required>
                </div>
                <button type="button" id="searchPartnerButton">Search Laundromat</button>

            </div>

            <button type="submit" id="eventSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>


        <div id="popup-search-partner" class="popup" style="display: none;">
            <div id="partnerSearch">
                <form action="models/search_partner.php" method="post" class="searchForm">
                    <div class="input-box">
                        <label for="name-of-laundromat">Enter Name of Laundromat:</label><br>
                        <input type="text" id="laundromat-name" name="laundromat-name" required>
                    </div>
                    <button type="button" id="searchPartnerButton">Search</button>
                </form>
                <div id="partnerReferenceResult"></div>
            </div>
        </div>




    </section> -->

    <section id="add-participant" class="container event-container">
        <form action="models/eventParticipants_model.php" method="post" id="add-participant-form" class="form">
            <h2>Add Participants</h2>
            <div class="form-container">
                <div class="select-box">

                    <select id="event-for-participant" name="event-for-participant" id="event-for-participant" required>
                        <option hidden>Choose Laundromat/Event Date/Address</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="participant_id">Participant References Number:</label>
                    <input type="text" name="participant_id" required>
                    <button type="button" id="searchParticipantButton">Search Reference</button>
                </div>
                <p>Participant not registered - click <a href="registration.php" target="_blank">here</a> to register.
                </p>


                <div class="column">
                    <div class="input-box">
                        <label for="cost_of_wash">Cost of Wash:</label>
                        <input type="number" name="cost_of_wash" step="0.01" required><br>
                    </div>
                    <div class="input-box">
                        <label for="cost_of_dry">Cost of Dry:</label>
                        <input type="number" name="cost_of_dry" step="0.01" required><br>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="detergent_amount">Detergent Amount:</label>
                        <input type="text" name="detergent_amount" required><br>
                    </div>
                    <div class="input-box">
                        <label for="dryersheet_amount">Dryersheet Amount:</label>
                        <input type="text" name="dryersheet_amount" required><br>
                    </div>
                </div>


            </div>
            <button type="submit" id="eventParticipantSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>

        <!----search  pop up for adding event participant -->
        <div id="popup-search-participant" class="popup" style="display: none;">
            <div id="participantSearch">
                <form action="models/search_participant.php" method="post" class="searchForm">
                    <div class="column">
                        <div class="input-box">
                            <label for="fname-eventParticipant">First Name:</label><br>
                            <input type="text" id="fname-eventParticipant" name="fname-eventParticipant" required>
                        </div>
                        <br>
                        <div class="input-box">
                            <label for="lname-eventParticipant">Last Name:</label>
                            <input type="text" id="lname-eventParticipant" name="lname-eventParticipant" required><br>
                        </div>
                    </div>
                    <button type="button" id="searchParticipantIDButton">Search</button>
                </form>
                <div id="participantIDResult"></div>
            </div>
        </div>
    </section>





    <!---adding volunteer--->
    <section id="add-volunteer" class="container event-container">
        <form action="models/eventVolunteers_model.php" method="post" id="add-volun-form" class="form">
            <h2>Add volunteers</h2>
            <div class="form-container">
                <div class="select-box">

                    <select id="event-for-volunteer" name="event-for-volunteer" required>
                        <option hidden>Choose Laundromat/Event Date/Address</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="volunteer_id">Volunteer References Number:</label>
                    <input type="text" name="volunteer_id" required><br>
                    <button type="button" id="searchVolunteerButton">Search Reference</button>
                </div>
                <p>Volunteer not registered - Click <a href="volunteer.php" target="_blank">here</a>.
                </p>
                </p>
            </div>

            <button type="submit" id="eventVolunteerSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>

        <!----search  pop up for adding event volunteer -->
        <div id="popup-search-volunteer" class="popup" style="display: none;">
            <div id="volunteerSearch">
                <form action="models/search_volunteer.php" method="post" class="searchForm">
                    <div class="column">
                        <div class="input-box">
                            <label for="fname-eventParticipant">First Name:</label><br>
                            <input type="text" id="fname-eventVolunteer" name="fname-eventParticipant" required>
                        </div><br>
                        <div class="input-box">
                            <label for="lname-eventVolunteer">Last Name:</label>
                            <input type="text" id="lname-eventVolunteer" name="lname-eventVolunteer" required><br>
                        </div>
                    </div>
                    <button type="button" id="searchVolunteerIDButton">Search</button>
                </form>
                <div id="volunteerIDResult"></div>
            </div>
        </div>



    </section>
    <?php include('components/footer.php'); ?>
    <script src="js/event.js"></script>
    <script src="js/app.js"></script>


</body>

</html>