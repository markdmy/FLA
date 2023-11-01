<?php

session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    // Display a message and a button to go to admin_login.php
    echo "This page needs to be authenticated by the administrator first.<br>";
    echo '<a href="admin_login.php">Go to admin_login.php</a>';
    echo " and after successfully logged in, click on Create an account(for volunteers/staff) to access this page.";
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Volunteers and staff can create an account to log in" />
    <meta name="keywords" content="free laundry access, admin signup form, volunteers and staff signup page" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/event.css" />
    <title>Volunteer/Staff Admin Signup</title>
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-tcqMJjKw5J7BKMoYMl3OfBOC2ZP1mNRMp8o5PY82npncYen+kCAUpB5XsUfDL5wM" crossorigin="anonymous">

</head>

<body>

    <?php include('components/header.php'); ?>
    <section class="container">
        <div id="signup_admin">
            <form action="models/event_admin_signup_model.php" method="post" id="add-volun-form" class="form">
                <h2 class=" signup-h2">Create an account for volunteer/staff</h2>
                <div class="form-container">
                    <p class="signup-phrase">Please search reference to find your number and email that are registered
                        in our databse. Not
                        registered? Click <a href="volunteer.php" target="_blank">here</a>.
                    </p>
                    <button type="button" id="searchVolunteerReference">Search Reference</button>

                    <div class="column">
                        <div class="input-box">
                            <label for="volunteer_number">References Number</label>
                            <input type="text" id="volunteer_number" name="volunteer_number" disabled><br>

                        </div>
                        <div class="input-box">
                            <label for="volunteer_email">Email:</label>
                            <input type="email" id="signup_email" name="signup_email" disabled><br>
                        </div>

                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="volunteer_id">Create Password</label>
                            <p class="password-requirement">Create Password (8-12 characters):</p>
                            <div class="password-container">
                                <input type="password" name="password_input" id="password_input" required minlength="8"
                                    maxlength="12">
                                <span id="toggle_password1"><img class="pw-eye" src="assets/images/eye-solid.svg"
                                        alt="password-see-eye" /></span>

                            </div><br>
                            <div id="password-strength">
                                Password Strength: <span id="strength-text"></span>
                            </div>
                            <div id="password-length">
                                Password Length: <span id="length-text"></span>
                            </div>
                        </div>
                        <div class="input-box">
                            <label for="volunteer_id">Confirm Password</label>
                            <p class="password-requirement">Re-type Password:</p>
                            <div class="password-container">
                                <input type="password" name="confirm_password_input" id="confirm_password_input"
                                    required>
                                <span id="toggle_password2"><img class="pw-eye" src="assets/images/eye-solid.svg"
                                        alt="password-see-eye" /></span>
                            </div><br>
                        </div>
                    </div>
                    <p id="pw_not_matched">
                    </p>
                    <p id="pw_length_error"></p>

                    <button type="submit" id="volunteerSignupSubmit" class="btn-container" onclick="">
                        <div class="btn btn-submit">
                            <span>SUBMIT</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>




        <div id="popup-search-volunteer-email" class="popup" style="display: none;">
            <div id="volunteerEmailSearch">
                <form action="models/search_volunteer.php" method="post" class="searchForm">

                    <div class="input-box">
                        <label for="fname-searchVolunteer">First Name:</label><br>
                        <input type="text" id="fname-searchVolunteer" name="fname-searchVolunteer" required="">
                    </div><br>
                    <div class="input-box">
                        <label for="lname-searchVolunteer">Last Name:</label>
                        <input type="text" id="lname-searchVolunteer" name="lname-searchVolunteer" required=""><br>
                    </div>
                    <br>


                    <button type="button" id="searchVolunteerEmailButton">Search</button>
                </form>
                <div id="volunteerEmailResult"></div>
            </div>
        </div>


        <div id="popup_volunteer_email_result" class="popup" style="display: none;">
            <div id="volunteerQueryResult">
                <p class="search-result-phrase">Click on the row that matches your query.</p>
                <table>
                    <thead class="table-heading">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Street Address</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row">
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




    </section>



    <?php
include('components/footer.php'); 

?>

    <script src="js/app.js"></script>
    <script src="js/signup.js"></script>


</body>

</html>