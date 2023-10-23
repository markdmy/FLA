<!--coded by Eunji--->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sign up to be a partner of free laundry access" />
    <meta name="keywords" content="partner registration form, partnership, partner" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/partnership_php.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Partner With Us</title>
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
</head>

<body>
    <?php include('components/header.php'); ?>
    <section class="container">



        <form action="models/partnership_model.php" method="POST" class="form" id="partnership-form">
            <h2>Partnership Signup Form</h2>
            <div class="form-content">
                <div class="column">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name" required name="pt_first_name" />
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" required name="pt_last_name" />
                    </div>
                </div>
                <div class="input-box">
                    <label>Name Of Laundromat</label>
                    <input type="text" placeholder="Enter name of laundromat" required name="laundromat_name" />
                </div>

                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email address" required name="pt_email" />
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="pt_phone" name="pt_phoneNumber" placeholder="Format: 123-456-7890"
                            class="form-input">
                    </div>

                </div>

                <div class="input-box address">
                    <label>Address</label>
                    <input type="text" placeholder="Enter street address" required name="pt_address" />

                    <div class="column">

                        <input type="text" placeholder="Enter your city" required name="pt_city" />
                        <div class="select-box">
                            <select name="pt_province">
                                <option hidden>Province</option>
                                <option>Alberta</option>
                                <option>British Columbia</option>
                                <option>Manitoba</option>
                                <option>New Brunswick</option>
                                <option>Newfoundland</option>
                                <option>Labrador</option>
                                <option>Nova Scotia</option>
                                <option>Ontario</option>
                                <option>PEI</option>
                                <option>Quebec</option>
                                <option>Saskatchewan</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" pattern="[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d" placeholder="Enter postal code" required
                        name="pt_postalCode" />



                </div>


                <div class="column">
                    <div class="input-box">
                        <label>Number of Washers:</label>
                        <input type="number" placeholder="Enter number" name="numberOfWashers" min="0" />
                    </div>
                    <div class="input-box">
                        <label>Number of Dryers:</label>
                        <input type="number" placeholder="Enter number" name="numberOfDryers" min="0" />
                    </div>


                </div>
                <div class="input-box">
                    <label>Has a attendant(s)?</label>
                    <div class="attendant-check">
                        <div class="check-answer">
                            <input type="radio" id="hasAttendant-yes" name="hasAttendant" value="yes"
                                class="radio-attendant" checked>
                            <label for="hasAttendant-yes">Yes</label>
                        </div>
                        <div class="check-answer">
                            <input type="radio" id="hasAttendant-no" name="hasAttendant" value="no"
                                class="radio-attendant">
                            <label for="hasAttendant-no">No</label>
                        </div>
                    </div>
                </div>





            </div>
            <button type="submit" id="partnershipSubmit" class="btn-container">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>
    </section>

    <?php
include('components/footer.php'); ?>
    <script src="js/app.js"></script>
</body>

</html>