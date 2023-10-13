<!--coded by Eunji--->

<?php
include('db_conn.php');

//below is if trigger works in netfirm's db
// function add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12,
//     $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $formCreated, $consent)
// {
//     global $db;
//     try {
//         $letter = 'A';
//         $query = "INSERT INTO participants (letter, participantID, firstName, lastName, dateOfBirth, numberOfHousehold, numberOfAdults, NumberOfChildrenUnder12,
//         NumberOfChildrenOver12, email, streetAddress, phone, city, province, postalCode, currentHousingSituation, howDidYouFindProgram, formCreated, consent) 
//         VALUES ('$letter', NULL, '$firstName', '$lastName', '$dateOfBirth',  '$numberOfHousehold', '$numberOfAdults', '$NumberOfChildrenUnder12',
//         '$NumberOfChildrenOver12', '$email', '$address',  '$phone', '$city', '$province', '$postalCode', '$housing_situation', '$combinedFoundProgram', '$formCreated', '$consent')";

//         $result = $db->query($query);

//         if ($result) {
//             // Retrieve the auto-generated participantID
//             $participantID = $db->lastInsertId();

//             // Fetch the participantReference from the database based on participantID
//             $referenceQuery = "SELECT participantReference FROM participants WHERE participantID = $participantID";
//             $referenceResult = $db->query($referenceQuery);

//             if ($referenceResult) {
//                 $referenceData = $referenceResult->fetch(PDO::FETCH_ASSOC);
//                 $participantReference = $referenceData['participantReference'];
//                 return array("participantID" => $participantID, "participantReference" => $participantReference);
//             } else {
//                 throw new Exception("Error fetching participantReference: " . $db->errorInfo()[2]);
//             }
//         } else {
//             throw new Exception("Error inserting participant: " . $db->errorInfo()[2]);
//         }
//     } catch (Exception $e) {
//         // Handle the exception (e.g., log the error, display a user-friendly message)
//         echo "An error occurred: " . $e->getMessage();
//         return false; // Indicate that the insertion or retrieval failed
//     }
//}



//this is if trigger doesnt work in netfirm, retrieving email instead of unique reference.
function add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12,
    $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $formCreated, $consent)
{
    global $db;
    try {
        $query = "INSERT INTO participants (firstName, lastName, dateOfBirth, numberOfHousehold, numberOfAdults, NumberOfChildrenUnder12,
        NumberOfChildrenOver12, email, streetAddress, phone, city, province, postalCode, currentHousingSituation, howDidYouFindProgram, formCreated, consent) 
        VALUES ('$firstName', '$lastName', '$dateOfBirth',  '$numberOfHousehold', '$numberOfAdults', '$NumberOfChildrenUnder12',
        '$NumberOfChildrenOver12', '$email', '$address',  '$phone', '$city', '$province', '$postalCode', '$housing_situation', '$combinedFoundProgram', '$formCreated', '$consent')";

        $result = $db->query($query);

        if ($result) {
            // Retrieve the auto-generated participantID
            $participantID = $db->lastInsertId();

            return array("participantID" => $participantID, "email" => $email);
        } else {
            throw new Exception("Error inserting participant: " . $db->errorInfo()[2]);
        }
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return false; // Indicate that the insertion failed
    }
}



?>