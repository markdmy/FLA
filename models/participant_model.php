<?php
include('db_conn.php');

function add_participant($firstName, $lastName, $dateOfBirth, $numberOfHousehold, $numberOfAdults, $NumberOfChildrenUnder12,
    $NumberOfChildrenOver12, $email, $address, $phone, $city, $province, $postalCode, $housing_situation, $combinedFoundProgram, $formCreated, $consent)
{
    global $db;
    try {
        $query = "INSERT INTO participants (participantID, firstName, lastName, dateOfBirth,  numberOfHousehold, numberOfAdults, NumberOfChildrenUnder12,
        NumberOfChildrenOver12, email, streetAddress,  phone, city, province, postalCode, currentHousingSituation, howDidYouFindProgram, formCreated, consent) 
        VALUES (NULL, '$firstName', '$lastName', '$dateOfBirth',  '$numberOfHousehold', '$numberOfAdults', '$NumberOfChildrenUnder12',
        '$NumberOfChildrenOver12', '$email', '$address',  '$phone', '$city', '$province', '$postalCode', '$housing_situation','$combinedFoundProgram', '$formCreated', '$consent')";
        
        $result = $db->query($query);

        if ($result) {
            // Retrieve the auto-generated userID
            $participantID = $db->lastInsertId();
            return $participantID;
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