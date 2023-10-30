<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $volunteer_number = $_POST["volunteer_number"];
    $signup_email = $_POST["signup_email"];
    $password = $_POST["password_input"];
    $confirm_password = $_POST["confirm_password_input"];
    $volunteerData = get_email_and_firstname_by_volunteer_number($volunteer_number);
    date_default_timezone_set('America/Toronto');
    $formCreated = date('Y-m-d H:i:s');


    if ($volunteerData) {
        $correct_email = $volunteerData['email'];
        $signup_firstName = $volunteerData['firstName'];
    } else {
        echo "no matching record found";
        exit();
    }

    if ($password === $confirm_password && $signup_email === $correct_email) {
       
        $hashed_password = password_hash($confirm_password, PASSWORD_BCRYPT);

        // Execute the SQL query
        try {
            
            $user_email = signup_volunteers_staff($volunteer_number, $signup_email, $hashed_password, $formCreated); 
            if ($user_email) {
                $redirectUrl = "../submitSuccess.php?signup_email=$user_email&signup_firstname=$signup_firstName";
                if ($redirectUrl) {
                    echo "<script>window.location.href='$redirectUrl';</script>";
                    exit();
                }
            } else {
                
                echo "User registration failed.";
                exit();
            }

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            $response = "An error occurred while trying to sign up for volunteer/staff.";
        }
    } else {
        // Passwords do not match; display an error
        $response = "Passwords do not match.";
    } 
}

function signup_volunteers_staff($volunteer_number,  $signup_email, $hashed_password, $formCreated) {
    global $db;

    try {
        
        $query = "INSERT INTO auth_others (volunteerID, useremail, userpassword, formCreated) VALUES (:volunteerID, :useremail, :userpassword, :formCreated)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':volunteerID', $volunteer_number, PDO::PARAM_INT);
        $stmt->bindParam(':useremail', $signup_email, PDO::PARAM_STR);
        $stmt->bindParam(':userpassword', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':formCreated', $formCreated, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $signup_email; 
        } else {
            return "An error occurred while trying to sign up for volunteer/staff.";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return "An error occurred while trying to sign up for volunteer/staff.";
    }

}


function get_email_and_firstname_by_volunteer_number($volunteer_number) {
    global $db;

    try {
        $query = "SELECT email, firstName FROM volunteers WHERE VolunteerID = :volunteer_number";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':volunteer_number', $volunteer_number, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result; // Return an associative array containing email and FirstName
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return null;
    }
}





?>