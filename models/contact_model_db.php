<!--coded by Mark and Eunji. -->
<?php
include('db_conn.php');

//this function will be called from contact.php
function add_contactFormData($contactName, $contactEmail, $contactPhoneNumber, $contactComments, $contactFormCreated, $emailSent){

    global $db;
    
    try {
        $contactID = '1';
        $query = "INSERT INTO contactform (contactID, contactName, contactEmail, contactPhone, comments, formCreated, emailSent) 
        VALUES ('$contactID', '$contactName', '$contactEmail', '$contactPhoneNumber', '$contactComments', '$contactFormCreated', '$emailSent')";

        $result = $db->query($query);

        if ($result) {
            return true; 
        } else {
            throw new Exception("Database query failed: " . $db -> error);
        }

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return false; 
    }
    
}

?>