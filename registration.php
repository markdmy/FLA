<!--coded by eunji-->
<?php


include('models/participant_model.php');
include('models/familyMembers_model.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if(isset($_POST['p_first_name'])){
        $firstName = $_POST['p_first_name'];
    }
    
    if(isset($_POST['p_last_name'])){
        $lastName = $_POST['p_last_name'];
    }
    
    if(isset($_POST['p_birthDate'])){
        $dateOfBirth = $_POST['p_birthDate'];
    }
    
    if(isset($_POST['numberOfHousehold'])){
        $numberOfHousehold = $_POST['numberOfHousehold'];
    }
    
    if(isset($_POST['numberOfAdults'])){
        $numberOfAdults = $_POST['numberOfAdults'];
    }
    
    if(isset($_POST['children_under12'])){
        $NumberOfChildrenUnder12 = $_POST['children_under12'];
    }
    
    if(isset($_POST['children_over12'])){
        $NumberOfChildrenOver12 = $_POST['children_over12'];
    }
    
    if(isset($_POST['p_email'])){
        $email = $_POST['p_email'];
    }
    
    if(isset($_POST['p_address'])){
        $address = $_POST['p_address'];
    }
    
    if(isset($_POST['p_phoneNumber'])){
        $phone = $_POST['p_phoneNumber'];
    }
    
    if(isset($_POST['p_city'])){
        $city = $_POST['p_city'];
    }
    if(isset($_POST['province'])){
        $province = $_POST['province'];
    }
    
    if(isset($_POST['p_postalCode'])){
        $postalCode = $_POST['p_postalCode'];
    }

    
    //use $housing_situation variable
    if (isset($_POST['housing_situation'])) {
        $currentHousingSituation = $_POST['housing_situation'];
    }

    if ($_POST["housing_situation"] == "Other") {
        $housing_situation = $_POST["housing_situation_other"];
    } else {
        $housing_situation = $_POST["housing_situation"];
    }

    //use $combinedFoundProgram
    $foundProgram = isset($_POST["found_program"]) ? $_POST["found_program"] : array();
    $foundProgramOther = isset($_POST["found_program_other"]) ? $_POST["found_program_other"] : "";
    $combinedFoundProgram = implode(", ", $foundProgram);
    if (!empty($foundProgramOther)) {
        $combinedFoundProgram .= ", " . $foundProgramOther;
    }

    $consent = isset($_POST["consent_box"]) ? 1 : 0;
    $formCreated = date('Y-m-d H:i:s');


    $participantInfo = add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12, $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $formCreated, $consent);
    
    //use below code if trigger works in netfirm
    // if ($participantInfo) {
    //     $participantID = $participantInfo['participantID'];
    //     $participantReference = $participantInfo['participantReference'];
    
    //     if($participantID){
            //this is a code to see the posted data
            // var_dump($_POST);
            
            // if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_date']) && isset($_POST['relationship']) && isset($_POST['gender']))
            // {
            //     $firstNames = $_POST['first_name'];
            //     $lastNames = $_POST['last_name'];
            //     $birthDates = $_POST['birth_date'];
            //     $relationships	 = $_POST['relationship'];
            //     $genders = $_POST['gender'];
    
            //     for ($i = 0; $i < count($firstNames); $i++) {
            //         $familyFirstName = $firstNames[$i];
            //         $familyLastName = $lastNames[$i];
            //         $familyDateOfBirth = $birthDates[$i];
            //         $relationshipToParticipant = $relationships[$i];
            //         $gender = $genders[$i];
    
            //         add_family_member($participantID, $familyFirstName, $familyLastName, $familyDateOfBirth, $relationshipToParticipant, $gender);
            //     }
            // }

            // header("Location: submitSuccess.php?participantReference=$participantReference&firstName=$firstName");
    //         echo "<script>window.location.href='submitSuccess.php?participantReference=$participantReference&firstName=$firstName';</script>";
    //         exit();
    // }

    // }


    if ($participantInfo) {
        $participantID = $participantInfo['participantID'];
        $participantEmail = $participantInfo['email'];
    
        if($participantID){
            //this is a code to see the posted data
            // var_dump($_POST);
            
            if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_date']) && isset($_POST['relationship']) && isset($_POST['gender']))
            {
                $firstNames = $_POST['first_name'];
                $lastNames = $_POST['last_name'];
                $birthDates = $_POST['birth_date'];
                $relationships	 = $_POST['relationship'];
                $genders = $_POST['gender'];
    
                for ($i = 0; $i < count($firstNames); $i++) {
                    $familyFirstName = $firstNames[$i];
                    $familyLastName = $lastNames[$i];
                    $familyDateOfBirth = $birthDates[$i];
                    $relationshipToParticipant = $relationships[$i];
                    $gender = $genders[$i];
    
                    add_family_member($participantID, $familyFirstName, $familyLastName, $familyDateOfBirth, $relationshipToParticipant, $gender);
                }
            }

            // header("Location: submitSuccess.php?participantEmail=$participantEmail&firstName=$firstName");
            echo "<script>window.location.href='submitSuccess.php?participantEmail=$participantEmail&firstName=$firstName';</script>";
            exit();
    }

    }

   
}  

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Register for Free Laundry Access - Sign up for free laundry access" />
    <meta name="keywords" content="registration, sign up, Free Laundry Access">
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Registration</title>
</head>

<body>
    <?php 
    include('components/header.php')?>

    <section class="container">
        <!-- <header>Registration Form</header> -->

        <form action="registration.php" method="POST" class="form" id="registration-form">
            <h2>Registration Form</h2>
            <div class="form-content">
                <div class="column">
                    <div class="input-box">
                        <label>First Name</label>
                        <input type="text" placeholder="Enter first name" required name="p_first_name" />
                    </div>
                    <div class="input-box">
                        <label>Last Name</label>
                        <input type="text" placeholder="Enter last name" required name="p_last_name" />
                    </div>
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter email address" required name="p_email" />
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="p_phone" name="p_phoneNumber" placeholder="Format: 123-456-7890"
                            class="form-input">
                    </div>
                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" name="p_birthDate" placeholder="Enter birth date" required />
                    </div>
                </div>

                <div class="input-box address">
                    <label>Address</label>
                    <input type="text" placeholder="Enter street address" required name="p_address" />

                    <div class="column">

                        <input type="text" placeholder="Enter your city" required name="p_city" />
                        <div class="select-box">
                            <select name="province">
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
                        name="p_postalCode" />



                </div>

                <div class="input-box">
                    <label>Total number of individuals in your household using this program:</label>
                    <input type="number" placeholder="Enter total number" name="numberOfHousehold" min="0" />
                </div>

                <div class="column">
                    <div class="input-box">
                        <label>Number of Adults (18 yrs and older):</label>
                        <input type="number" placeholder="Enter number" name="numberOfAdults" min="0" />
                    </div>
                    <div class="input-box">
                        <label>Number of Children (Under 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_under12" min="0" />
                    </div>
                    <div class="input-box">
                        <label>Number of Children (Over 12 yrs old):</label>
                        <input type="number" placeholder="Enter number" name="children_over12" min="0" />
                    </div>
                </div>

                <div class="input-box" id="additional-members-container">
                    <label>ADDITIONAL HOUSEHOLD MEMBERS</label>
                    <div class="additional-member-template" data-original="true">
                        <div class="column">
                            <input type="text" placeholder="First Name" name="first_name[]" />
                            <input type="text" placeholder="Last Name" name="last_name[]" />
                        </div>
                        <div class="input-box">
                            <label>Birth Date</label>
                            <input type="date" placeholder="Date of Birth" name="birth_date[]" />
                        </div>
                        <div class="column">
                            <input type="text" placeholder="Relationship To Applicant" name="relationship[]" />
                            <input type="text" placeholder="Gender (Optional)" name="gender[]" />
                        </div>
                        <div class="button-row column">
                            <button type="button" class="add-member-button">Add More +</button>
                            <button type="button" class="remove-member-button">Remove -</button>
                        </div>
                    </div>
                </div>


                <div class="housing-box">
                    <label>CURRENT HOUSING SITUATION(OPTIONAL)</label>

                    <div class="housing-option">
                        <div class="housing">
                            <input type="radio" id="rental" name="housing_situation" value="Rental">
                            <label for="rental">Rental</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="social_housing" name="housing_situation" value="Social Housing">
                            <label for="social_housing">Social Housing (Group home/ Youth home)</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="emergency_shelter" name="housing_situation"
                                value="Emergency Shelter">
                            <label for="emergency_shelter">Emergency Shelter</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="family_friends" name="housing_situation"
                                value="With Family/Friends">
                            <label for="family_friends">With Family/Friends</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="unhoused" name="housing_situation" value="Unhoused">
                            <label for="unhoused">Unhoused</label>
                        </div>
                        <div class="housing">
                            <input type="radio" id="other" name="housing_situation" value="Other">
                            <label for="other">Other (Please Specify)</label>
                            <input type="text" id="other_specify" class="other-housing-situation"
                                name="housing_situation_other" placeholder="Specify">
                        </div>
                    </div>
                </div>



                <div class="program-box housing-box">
                    <label>HOW DID YOU FIND OUR PROGRAM (Please select all applicable)</label>
                    <div class="program-option">


                        <div class="program">
                            <input type="checkbox" id="immigration" name="found_program[]"
                                value="Immigration/ Newcomer Services">
                            <label for="immigration">Immigration/ Newcomer Services</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="client_family_friend" name="found_program[]"
                                value="Client/Family/Friend">
                            <label for="client_family_friend">Client/Family/Friend</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="employment_insurance" name="found_program[]"
                                value="Employment Insurance">
                            <label for="employment_insurance">Employment Insurance</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="media_news_outreach" name="found_program[]"
                                value="Media/News/Outreach">
                            <label for="media_news_outreach">Media/News/Outreach</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="unions" name="found_program[]" value="Unions">
                            <label for="unions">Unions</label><br>
                        </div>

                        <div class="program">
                            <input type="checkbox" id="social_agency" name="found_program[]" value="Social Agency">
                            <label for="social_agency">Social Agency</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="wsib" name="found_program[]" value="WSIB">
                            <label for="wsib">WSIB</label><br>
                        </div>
                        <div class="program">
                            <input type="checkbox" id="none" name="found_program[]" value="None">
                            <label for="none">None</label><br>
                        </div>


                        <div class="program other-specify">
                            <input type="text" id="other_specify" class="other-source" name="found_program_other"
                                placeholder="Other (Please Specify)">
                        </div>
                    </div>
                </div>


                <div class="privacy">
                    <h3>Privacy Notice and Consent</h3>
                    <div class="privacy-body">
                        <p>At Free Laundry Access, we collect and use your personal information to manage our programs,
                            assess your eligibility for support, understand the needs of those we serve and improve our
                            services. On an as-needed basis, we also share your personal information with other agencies
                            to
                            provide more complete support, eliminate duplication of efforts or fulfill our commitments
                            to
                            those who fund our programs. We obey strict standards of confidentiality when collecting,
                            using
                            and sharing or disclosing your personal information. Tell us if you would like to receive a
                            copy
                            of our Privacy Policy.</p>
                        <br>
                        <ul class="privacy-right">
                            <li>You have the right to receive a copy of the information about you that is stored in the
                                Free
                                Laundry Access Client Management System and/or the Free Laundry Access Intake software.
                            </li>
                            <li>You have the right to correct mistakes in information about you.</li>
                        </ul>
                        <br>
                        <p>Our resources and ability to serve your community depend in part on the information provided
                            by
                            our participants.</p> <br>
                        <p>I have read and understood the information above and by signing this document I agree that
                            Free
                            Laundry Access Inc. may collect, use and disclose my personal information for the purposes
                            mentioned above. I also agree that my personal information may be entered into the Free
                            Laundry
                            Access Client Management System and/or the Free Laundry Access Intake software.</p> <br>
                        <p>In applying for assistance from Free Laundry Access Inc. on behalf of myself and/or my
                            household, and sharing information about myself and/or my family members, I confirm that I
                            am
                            sharing this information with the knowledge and permission of all household members age 18
                            and
                            over (AB, SK, MB, ON, PE, QC) or age 19 and over (BC, NT, NU, YT, NB, NL, NS).</p> <br>
                        <p>I attest all information provided in the registration form is true to the best of my
                            knowledge.
                            I understand the program services are only available to me on event dates, times and
                            locations
                            announced. Outside of these event dates the program services will not be available to me.
                        </p> <br>
                        <p>I understand I may be denied access to the program if the information provided herein is
                            false,
                            and/or if on the event date I am not sober/coherent or under the influence of any substance
                            and/or use aggressive/abusive language and/or aggressive action(s) towards staff and/or
                            volunteers of Free Laundry Access Inc. and/or any individual(s) in or around the laundromat
                            were
                            the program services are being provided.</p>
                    </div>
                    <label for="consent-checkbox" class="center-checkbox-label">
                        <input type="checkbox" id="consent-checkbox" required name="consent_box">
                        <span class="checkbox-text">I consent to the privacy notice</span>
                    </label>
                </div>

            </div>
            <button type="submit" id="registrationSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>
    </section>



    <?php
include('components/footer.php'); ?>



    <script src="js/app.js"></script>
    <script src="js/form.js"></script>
</body>

</html>