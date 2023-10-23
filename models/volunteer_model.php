<!--coded by Enobong--->

<?php
include('db_conn.php');
include('email_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['vl_first_name'])){
        $volunteerFirstName = $_POST['vl_first_name'];
    }
    
    if(isset($_POST['vl_last_name'])){
        $lastName = $_POST['vl_last_name'];
    }
    
    if(isset($_POST['vl_email'])){
        $email = $_POST['vl_email'];
    }

    if(isset($_POST['vl_phoneNumber'])){
        $phone = $_POST['vl_phoneNumber'];
    }
    if(isset($_POST['vl_birth_date'])){
        $dateOfBirth = $_POST['vl_birth_date'];

        // Calculate age from the birth date
        $dob = new DateTime($dateOfBirth);
        $currentDate = new DateTime();
        $age = $currentDate->diff($dob)->y;

        // Check if age is 18 and over and set $isAge18AndOver
        if ($age >= 18) {
            $isAge18AndOver = "yes";
        } else {
            $isAge18AndOver = "no";
        }
    }

    if(isset($_POST['vl_address'])){
        $address = $_POST['vl_address'];
    }

    if(isset($_POST['vl_city'])){
        $city = $_POST['vl_city'];
    }

    if(isset($_POST['vl_province'])){
        $province = $_POST['vl_province'];
    }
    
    if(isset($_POST['vl_postalCode'])){
        $postalCode = $_POST['vl_postalCode'];
    }
    
    $formCreated = date('Y-m-d H:i:s');

    //this code below is not using reference. 
    $volunteerInfo = add_volunteer($volunteerFirstName, $lastName, $dateOfBirth,  $isAge18AndOver, $email, $phone, $address, $city, $province, $postalCode, $formCreated);
    if ($volunteerInfo) {
    $email = $volunteerInfo['email'];
    $redirectUrl = send_email_from_volunteer_form($volunteerFirstName, $lastName, $dateOfBirth, $isAge18AndOver, $email, $phone, $address, $city, $province, $postalCode, $formCreated);
    
    if ($redirectUrl) {
        // Redirect to success page
        echo "<script>window.location.href='$redirectUrl';</script>";
        exit();
    }
    
    }    
    
  }

function add_volunteer($volunteerFirstName, $lastName, $dateOfBirth, $isAge18AndOver, $email, $phone, $address, $city, $province, $postalCode, $formCreated)
{
    global $db;
    try {
        $query = "INSERT INTO volunteers (firstName, lastName, dateOfBirth, isAge18AndOver, email, phone, streetAddress, city, province, postalCode, formCreated) 
        VALUES ('$volunteerFirstName', '$lastName','$dateOfBirth', '$isAge18AndOver','$email', '$phone', '$address', '$city', '$province', '$postalCode', '$formCreated')";

        $result = $db->query($query);

        if ($result) {
            $volunteerID = $db->lastInsertId();
            return ["email" => $email];
        } else {
            throw new Exception("Error inserting volunteer: " . $db->errorInfo()[2]);
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return false;
    }
}


?>