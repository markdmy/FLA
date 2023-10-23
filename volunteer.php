<!-- coded by Enobong -->
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
    <title>Join Volunteers Team</title>
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
</head>

<body>
    <?php include('components/header.php'); ?>
    <section class="container">

        <form action="models/volunteer_model.php" method="POST" class="form" id="volunteer-form">
            <h2>Volunteer Signup Form</h2>
            <div class="form-content">
                <div class="column">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name" required name="vl_first_name" />
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" required name="vl_last_name" />
                    </div>
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email address" required name="vl_email" />
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="vl_phone" name="vl_phoneNumber" placeholder="Format: 123-456-7890"
                            class="form-input">
                    </div>
                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" placeholder="Date of Birth" name="vl_birth_date" required />
                    </div>
                </div>

                <div class="input-box address">
                    <label>Address</label>
                    <input type="text" placeholder="Enter street address" required name="vl_address" />

                    <div class="column">

                        <input type="text" placeholder="Enter your city" required name="vl_city" />
                        <div class="select-box">
                            <select name="vl_province">
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
                    <input type="text" pattern="[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d" placeholder="Enter postal code"
                        name="vl_postalCode" required />

                </div>

            </div>
            <button type="submit" id="volunteerSubmit" class="btn-container">
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