<!--coded by Eunji--->
<?php
include('models/partnership_model.php');
$partnerReference = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['pt_first_name'])){
        $partnerFirstName = $_POST['pt_first_name'];
    }
    
    if(isset($_POST['pt_last_name'])){
        $lastName = $_POST['pt_last_name'];
    }

    if(isset($_POST['laundromat_name'])){
        $laundromatName = $_POST['laundromat_name'];
    }
    
     if(isset($_POST['pt_email'])){
        $email = $_POST['pt_email'];
    }


    if(isset($_POST['pt_phoneNumber'])){
        $phone = $_POST['pt_phoneNumber'];
    }


    if(isset($_POST['pt_address'])){
        $address = $_POST['pt_address'];
    }

    if(isset($_POST['pt_city'])){
        $city = $_POST['pt_city'];
    }
    if(isset($_POST['pt_province'])){
        $province = $_POST['pt_province'];
    }
    
    if(isset($_POST['pt_postalCode'])){
        $postalCode = $_POST['pt_postalCode'];
    }

    if(isset($_POST['numberOfWashers'])){
        $numberOfWashers = $_POST['numberOfWashers'];
    }
    
    if(isset($_POST['numberOfDryers'])){
        $NumberOfDryers = $_POST['numberOfDryers'];
    }


    if (isset($_POST['hasAttendant'])) {
        $hasAttendant = $_POST['hasAttendant']; 
    }




    $formCreated = date('Y-m-d H:i:s');

    //use this for using trigger
    // $partnerReference = add_partner($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated);
    // if($partnerReference){
    //     // header("Location: submitSuccess.php?partnerReference=$partnerReference&partnerFirstName=$partnerFirstName");
    //     echo "<script>window.location.href='submitSuccess.php?partnerReference=$partnerReference&partnerFirstName=$partnerFirstName';</script>";
    //     exit();
    // }

    //using this for not using trigger
    $partnerInfo = add_partner($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated);
    if ($partnerInfo) {
    $laundromatName = $partnerInfo['laundromatName'];
    $email = $partnerInfo['email'];
        echo "<script>window.location.href='submitSuccess.php?partnerEmail=$email&partnerFirstName=$partnerFirstName&laundromatName=$laundromatName';</script>";
        exit();
    }

    
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag("js", new Date());
  gtag("config", "G-JDKE8RQXYH");
</script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sign up to be a partner of free laundry access" />
    <meta name="keywords" content="partner registration form, partnership, partner" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/partnership_php.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Partner With Us</title>
</head>

<body>
    <?php include('components/header.php'); ?>
    <section class="container">



        <form action="partnership.php" method="POST" class="form" id="partnership-form">
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