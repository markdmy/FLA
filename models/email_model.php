<!--
    this is alternated from contact_model.php
    coded by Mark to connect email server
    function created by eunji. PLEASE REMOVE (test) before the email subject for the real deployment !!!!!!!-->
<?php
use PHPMailer\PHPMailer\PHPMailer;

//this function will be called when a user submit a contact from from contact.php
function send_email_from_contact_form($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated)
{

    try {
        require "mail_library/vendor/autoload.php";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.netfirms.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->Username = "contact@freelaundryaccess.com";
        $mail->Password = "Freelaundryaccess4168441484";

        $mail->setFrom("contact@freelaundryaccess.com", $contactName);
        $mail->addAddress("contact@freelaundryaccess.com", "Nancy");

        $mail->Subject = "(test)FLA Contact Us";

        //this line (isHTML true ) will format the content in html format so we can add line break<br>--eunji--
        $mail->IsHTML(true);
        $mail->Body = "Name: $contactName<br>Email: $contactEmail<br>Phone Number: $contactPhoneNumber<Br>Comments: $contactComments";
        $mail->AltBody = "Name: $contactName\nEmail: $contactEmail\nPhone Number: $contactPhoneNumber\nComments: $contactComments";

        if ($mail->send()) {
           $redirectUrl = "submitSuccess.php?contactName=$contactName';</script>"; 
           return $redirectUrl;
        } else {
            $_SESSION['email_error'] = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

}


//this function will be called when a user submit a registration from from registration.php
function send_email_from_reg_form($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12, $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram,  $additionalNote, $formCreated, $id_file_path, $income_proof_file_path, array $familyMemberInfo)
{
   
    try {
        require "mail_library/vendor/autoload.php";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.netfirms.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        //in the future, email address can be changed depending on the form
        $mail->Username = "contact@freelaundryaccess.com";
        $mail->Password = "Freelaundryaccess4168441484";

        $mail->setFrom("contact@freelaundryaccess.com", $firstName . ' ' . $lastName);
        $mail->addAddress("contact@freelaundryaccess.com", "Nancy");

        $mail->Subject = "(test)FLA Registration(participant)Form Submitted";
        
        $mail->IsHTML(true);
        $mail->Body = "
        Name: $firstName $lastName<br>
        Email: $email<br>Phone Number: $phone<br>
        Registration details:<br>
        Date of Birth: $dateOfBirth<br>
        Number of Household: $numberOfHousehold<br>
        Number of Adults: $numberOfAdults<br>
        Number of Children Under 12: $NumberOfChildrenUnder12<br>
        Number of Children Over 12: $NumberOfChildrenOver12<br>
        Address: $address<br>
        City: $city<br>
        Province: $province<br>
        Postal Code: $postalCode<br>
        Housing Situation: $housing_situation<br>
        Found Program: $combinedFoundProgram<br>
        Form Created: $formCreated<br>
        Additional Note: $additionalNote<br>
        identification file info: $id_file_path<br>
        income proof file info: $income_proof_file_path<br>
        Family Member Details:<br>" . implode("<br>", $familyMemberInfo);
        
        $mail->AltBody = "Name: $firstName $lastName\nEmail: $email\nPhone Number: $phone\nRegistration details:\n
        Date of Birth: $dateOfBirth\nNumber of Household: $numberOfHousehold\nNumber of Adults: $numberOfAdults\n
        Number of Children Under 12: $NumberOfChildrenUnder12\nNumber of Children Over 12: $NumberOfChildrenOver12\n
        Address: $address\ncity: $city\nProvince: $province\nPostal Code: $postalCode\n
        Housing Situation: $housing_situation\nFound Program: $combinedFoundProgram\nForm Created: $formCreated\nAdditional Note: $additionalNote\n
        Family Member Details:\n" . implode("\n", $familyMemberInfo);
        

        if ($mail->send()) {
            $redirectUrl = "../submitSuccess.php?participantEmail=$email&firstName=$firstName";
            return $redirectUrl; 
        } else {
            $_SESSION['email_error'] = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

}


//this function will be called when a user submit a partnership from from partnership.php
function send_email_from_partnership_form($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated)
{
   
    try {
        require "mail_library/vendor/autoload.php";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.netfirms.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        //in the future, email address can be changed depending on the form
        $mail->Username = "contact@freelaundryaccess.com";
        $mail->Password = "Freelaundryaccess4168441484";

        $mail->setFrom("contact@freelaundryaccess.com", $partnerFirstName . ' from ' . $laundromatName);
        $mail->addAddress("contact@freelaundryaccess.com", "Nancy");

        $mail->Subject = "(test)FLA Partnership Form Submitted";

        $mail->IsHTML(true);
        $mail->Body = "Name: $partnerFirstName $lastName<br>Name of Laundromat: $laundromatName<br>Email Address: $email<br>Phone Number: $phone<br>Street Address: $address<br>City: $city<br>Province: $province<br>Postal Code: $postalCode<br>Number of Washers: $numberOfWashers<br>Number of Dryers: $NumberOfDryers<br>Has Attendant: $hasAttendant<br>Form Created: $formCreated";
        $mail->AltBody = "Name: $partnerFirstName $lastName\nName of Laundromat: $laundromatName\nEmail Address: $email\nPhone Number: $phone\nStreet Address: $address\ncity: $city\nProvince: $province\nPostal Code: $postalCode\nNumber of Washers: $numberOfWashers\nNumber of Dryers: $NumberOfDryers\nHas Attendant: $hasAttendant\nForm Created: $formCreated";


        if ($mail->send()) {
            $redirectUrl = "../submitSuccess.php?partnerEmail=$email&partnerFirstName=$partnerFirstName&laundromatName=$laundromatName";
            return $redirectUrl; 
        } else {
            $_SESSION['email_error'] = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

}



//this function will be called when a user submit a volunteer from from volunteer.php
function send_email_from_volunteer_form($volunteerFirstName, $lastName, $dateOfBirth, $isAge18AndOver, $email, $phone, $address, $city, $province, $postalCode, $formCreated) 
{
   
    try {
        require "mail_library/vendor/autoload.php";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.netfirms.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        //in the future, email address can be changed depending on the form
        $mail->Username = "contact@freelaundryaccess.com";
        $mail->Password = "Freelaundryaccess4168441484";

        $mail->setFrom("contact@freelaundryaccess.com",  $volunteerFirstName . ' ' . $lastName);
        $mail->addAddress("contact@freelaundryaccess.com", "Nancy");

        $mail->Subject = "(test)FLA Volunteer Form Submitted";

        $mail->IsHTML(true);
        $mail->Body = "Name: $volunteerFirstName $lastName<br>
        Birth Date: $dateOfBirth<br>
        isAge18AndOver?: $isAge18AndOver<br>
        Email Address: $email<br>
        Phone Number: $phone<br>
        Street Address: $address<br>
        City: $city<br>
        Province: $province<br>
        Postal Code: $postalCode<br>
        Form Created: $formCreated";
        $mail->AltBody = "Name: $volunteerFirstName $lastName\n
        Birth Date: $dateOfBirth\n
        isAge18AndOver?: $isAge18AndOver\n
        Email Address: $email\n
        Phone Number: $phone\n
        Street Address: $address\ncity: $city\nProvince: $province\nPostal Code: $postalCode\nForm Created: $formCreated";


        if ($mail->send()) {
            $redirectUrl = "../submitSuccess.php?volunteerEmail=$email&volunteerFirstName=$volunteerFirstName";
            return $redirectUrl; 
        } else {
            $_SESSION['email_error'] = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

}

?>