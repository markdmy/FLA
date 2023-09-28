<!--coded by Eunji--->

<?php
include('db_conn.php');


function add_partner($partnerFirstName, $lastName, $email, $phone, $address, $city, $province, $postalCode, $numberOfWashers, $NumberOfDryers, $hasAttendant, $formCreated)

{
    global $db;
    try {
        $query = "INSERT INTO partnership (partnerID, firstName, lastName, email, phone, streetAddress, city, province, postalCode, numberOfWashers, numberOfDryers, hasAttendant, formCreated) 
        VALUES (NULL, '$partnerFirstName', '$lastName', '$email', '$phone', '$address', '$city', '$province', '$postalCode', '$numberOfWashers', '$NumberOfDryers', '$hasAttendant', '$formCreated')";

        $result = $db->query($query);

        if ($result) {
            $partnerID = $db->lastInsertId();

            $referenceQuery = "SELECT partnerReference FROM partnership WHERE partnerID = $partnerID";
            $referenceResult = $db->query($referenceQuery);

            if ($referenceResult) {
                $referenceData = $referenceResult->fetch(PDO::FETCH_ASSOC);
                $partnerReference = $referenceData['partnerReference'];
                return $partnerReference;
            } else {
                throw new Exception("Error fetching partnerReference: " . $db->errorInfo()[2]);
            }
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