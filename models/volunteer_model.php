<!--coded by Enobong--->

<?php
include('db_conn.php');


//coded by Enobong and this is for using volunteerReference with trigger
// function add_volunteer($volunteerFirstName, $lastName, $email, $phone, $address, $city, $province, $postalCode, $formCreated)

// {
//     global $db;
//     try {
//         $query = "INSERT INTO volunteers(volunteerID, firstName, lastName, email, phone, streetAddress, city, province, postalCode, formCreated) 
//         VALUES (NULL, '$volunteerFirstName', '$lastName', '$email', '$phone', '$address', '$city', '$province', '$postalCode', '$formCreated')";

//         $result = $db->query($query);

//         if ($result) {
//             $volunteerID = $db->lastInsertId();

//             $referenceQuery = "SELECT volunteerReference FROM volunteers WHERE volunteerID = $volunteerID";
//             $referenceResult = $db->query($referenceQuery);

//             if ($referenceResult) {
//                 $referenceData = $referenceResult->fetch(PDO::FETCH_ASSOC);
//                 $volunteerReference = $referenceData['volunteerReference'];
//                 return $volunteerReference;
//             } else {
//                 throw new Exception("Error fetching volunteerReference: " . $db->errorInfo()[2]);
//             }
//         } else {
//             throw new Exception("Error inserting volunteer: " . $db->errorInfo()[2]);
//         }
//     } catch (Exception $e) {
//         // Handle the exception (e.g., log the error, display a user-friendly message)
//         echo "An error occurred: " . $e->getMessage();
//         return false; 
//         // Indicate that the insertion or retrieval failed
//     }
// }

//this code is to use function returning email address of volunteer instead of reference
function add_volunteer($volunteerFirstName, $lastName, $email, $phone, $address, $city, $province, $postalCode, $formCreated)
{
    global $db;
    try {
        $query = "INSERT INTO volunteers (firstName, lastName, email, phone, streetAddress, city, province, postalCode, formCreated) 
        VALUES ('$volunteerFirstName', '$lastName', '$email', '$phone', '$address', '$city', '$province', '$postalCode', '$formCreated')";

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