<!--coded by Eunji--->

<?php
include('db_conn.php');

function add_family_member($participantID, $familyFirstName, $familyLastName, $familyDateOfBirth, $relationshipToParticipant, $gender)
{
    global $db;
    try {
        $query = "INSERT INTO familymembers (participantID, firstName, lastName, dateOfBirth,  relationshipToParticipant, gender)
        VALUES ('$participantID', '$familyFirstName', '$familyLastName', '$familyDateOfBirth', '$relationshipToParticipant', '$gender')";
        
        $result = $db->query($query);

        if (!$result) {
            throw new Exception("Error inserting family member: " . $db->errorInfo()[2]);
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return false; 
    }


    
}


?>