<!--coded by Eunji--->

<?php
include('db_conn.php');
include('email_model.php');

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



    date_default_timezone_set('America/Toronto');
    $formCreated = date('Y-m-d H:i:s');

    $partnerInfo = add_partner($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated);
    if ($partnerInfo) {
    $laundromatName = $partnerInfo['laundromatName'];
    $email = $partnerInfo['email'];
    $redirectUrl = send_email_from_partnership_form($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated);

    if ($redirectUrl) {
        // Redirect to success page
        echo "<script>window.location.href='$redirectUrl';</script>";
        exit();
    }
    }

    
  }

//this below is for retrieving name of laundromat and email address 
function add_partner($partnerFirstName, $lastName, $laundromatName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated)
{
    global $db;
    try {
        $query = "INSERT INTO partnership (firstName, lastName, nameOfLaundromat, email, phone, streetAddress, city, province, postalCode, numberOfWashers, numberOfDryers, hasAttendant, formCreated) 
        VALUES ('$partnerFirstName', '$lastName', '$laundromatName', '$email', '$phone', '$address', '$city', '$province', '$postalCode', '$numberOfWashers', '$NumberOfDryers', '$hasAttendant', '$formCreated')";

        $result = $db->query($query);

        if ($result) {
            $partnerID = $db->lastInsertId();

            return ["laundromatName" => $laundromatName, "email" => $email];
        } else {
            throw new Exception("Error inserting partner: " . $db->errorInfo()[2]);
        }
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return false; // Indicate that the insertion or retrieval failed
    }
}




?>