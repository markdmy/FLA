<?php 
session_start();

if (!isset($_SESSION["admin_authenticated"]) || $_SESSION["admin_authenticated"] !== true) {
    echo "<script>window.location.href='admin_login.php';</script>";
    // header("Location: admin_login.php");
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
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
</head>

<body>
    <?php include('components/header.php'); ?>

    <div class="event-navigation">
        <button class="event-nav-button clicked" data-form="add-event">Add Events</button>
        <button class="event-nav-button" data-form="add-participant">Add Participants</button>
        <button class="event-nav-button" data-form="add-volunteer">Add Volunteers</button>
        <button class="event-nav-button" data-form="event_record_retrieval">Search Record</button>
    </div>
    <div class="signup-box">
        <p><span id="signup_link" class="underline-text"><a href="event_admin_signup.php" target="_blank">Create
                    an
                    account</a></span>(for
            volunteers/staff)</p>
    </div>

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
                    <input type="text" name="partner_id" disabled>
                    <button type="button" id="searchPartnerButton">Search Reference</button>
                </div>
                <p>Partner not registered - click <a href="partnership.php" target="_blank">here</a> to register.
                </p>
            </div>


            <button type="submit" id="eventSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>


        <div id="popup-search-partner" class="popup" style="display: none;">
            <div id="partnerSearch">
                <form class="searchForm">
                    <div class="input-box">
                        <label for="name-of-laundromat">Enter Name of Laundromat:</label><br>
                        <input type="text" id="laundromat-name" name="laundromat-name" required>
                    </div>
                    <br>
                    <button type="button" id="searchPartnerIDButton">Search</button>
                </form>
                <div id="partnerIDResult"></div>
            </div>
        </div>
    </section>

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
                    <input type="text" name="participant_id" disabled>
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
                    <div class="input-box">
                        <label for="product_cost">Product Cost:</label>
                        <input type="number" name="product_cost" step="0.01" required><br>
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
                <form class="searchForm">
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
                        <br>

                    </div>
                    <button type="button" id="searchParticipantIDButton">Search</button>
                </form>
                <div id="participantIDResult"></div>
            </div>
        </div>



        <div id="popup_participant_search_result" class="popup" style="display: none;">
            <div id="participantSearchResult">
                <p class="search-result-phrase">Click on the row that matches your query.</p>
                <table>
                    <thead class="table-heading">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date Of Birth</th>
                            <th>Street Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
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
                    <input type="text" name="volunteer_id" disabled><br>
                    <button type="button" id="searchVolunteerButton">Search Reference</button>
                </div>
                <p>Volunteer not registered - Click <a href="volunteer.php" target="_blank">here</a>.
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
                <form class="searchForm">
                    <div class="column">
                        <div class="input-box">
                            <label for="fname-eventParticipant">First Name:</label><br>
                            <input type="text" id="fname-eventVolunteer" name="fname-eventParticipant" required>
                        </div><br>
                        <div class="input-box">
                            <label for="lname-eventVolunteer">Last Name:</label>
                            <input type="text" id="lname-eventVolunteer" name="lname-eventVolunteer" required><br>
                        </div>
                        <br>

                    </div>
                    <button type="button" id="searchVolunteerIDButton">Search</button>
                </form>
                <div id="volunteerIDResult"></div>
            </div>
        </div>

        <div id="popup_volunteer_search_result" class="popup" style="display: none;">
            <div id="volunteerSearchResult">
                <p class="search-result-phrase">Click on the row that matches your query.</p>
                <table>
                    <thead class="table-heading">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date Of Birth</th>
                            <th>Street Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </section>


    <!---adding volunteer--->
    <section id="event_record_retrieval" class="record-container container">
        <form id="event_record_form" class="form">
            <h2>Search Event Records</h2>
            <div class="form-container">
                <div class="select-box">
                    <select id="event-for-record" name="event-for-record" required>
                        <option hidden>Choose Laundromat/Event Date/Address </option>
                    </select>
                </div>
            </div>
            <div id="event_record_result" class="table-container" style="display: none;">
                <div class="laundromat-info" style="display: none;">
                    <h5>Laundromat Name : <span id="record_laundromat_name"></span></h5>
                    <h5>Address : <span id="record_laundromat_address"></span></h5>
                    <h5>Event Date : <span id="record_laundromat_eventdate"></span></h5>
                </div>
                <button id="download-event-button" class="download-button">Download CSV</button>
                <table class="event-record-table">
                    <thead class="record-table-heading">
                        <tr>
                            <th id="name-column">Participant Name</th>
                            <th>Cost Of Wash</th>
                            <th>Cost of Dry</th>
                            <th>Product Cost</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody class="participant-table">
                        <tr class="participant-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table class="event-record-table">
                    <thead>
                        <tr class="calculate-total">
                            <th id="total-title">Calculate Total</th>
                            <th id="total-wash-cost">0.00</th>
                            <th id="total-dry-cost">0.00</th>
                            <th id="total-product-cost">0.00</th>
                            <th id="total-total-cost">0.00</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </form>



        <form id="volulnteer_by_city_form" class="form">
            <h2>Search Volunteer by City</h2>
            <div class="form-container">
                <div class="select-box">
                    <select id="volunteers_city" name="volunteers_city_data" required>
                        <option hidden>Choose a city</option>
                    </select>
                </div>
            </div>
            <div id="volunteer_record_result" style="display: none;">
                <div id="volunteer_record_table_wrapper" class="table-container">
                    <button id="download-vol-rec-button" class="download-button">Download CSV</button>
                    <table id="volunteer_record_table">
                        <thead class="vol-table-heading">
                            <tr>
                                <th>Name</th>
                                <th>Date Of Birth</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Postal Code</th>
                            </tr>
                        </thead>
                        <tbody class="volunteer-table">
                            <tr class="volunteer-row">
                                <td data-label="Name"></td>
                                <td data-label="Date Of Birth"></td>
                                <td data-label="Email"></td>
                                <td data-label="Phone"></td>
                                <td data-label="Street Address"></td>
                                <td data-label="City"></td>
                                <td data-label="Province"></td>
                                <td data-label="Postal Code"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        <form id="fetch_partner" class="form">
            <h2>Search All Partners</h2>
            <div class="partner-record-button-container">
                <button type="button" id="bring_partners">Click to display partners</button>
            </div>
            <div id="partner_record_result" style="display: none;">
                <div id="partner_record_table_wrapper" class="table-container">
                    <button id="download-partner-button" class="download-button">Download CSV</button>
                    <table id="partner_record_table">
                        <thead class="partner-table-heading">
                            <tr>
                                <th>Name</th>
                                <th>Name of Laundromat</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Postal Code</th>
                                <th>Number of washers</th>
                                <th>Number of dryers</th>
                                <th>has attendant?</th>
                            </tr>
                        </thead>
                        <tbody class="partner-table">
                            <tr class="partner-row">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

    </section>




    <?php include('components/footer.php'); ?>
    <script src="js/event.js"></script>
    <script src="js/app.js"></script>


</body>

</html>