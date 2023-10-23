<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fnameEventParticipant = $_POST["fname-eventParticipant"];
    $lnameEventParticipant = $_POST["lname-eventParticipant"];
    $dobEventParticipant = $_POST['dob-eventParticipant'];
    echo json_encode(search_participant($fnameEventParticipant, $lnameEventParticipant, $dobEventParticipant));
}

function search_participant($fnameEventParticipant, $lnameEventParticipant, $dobEventParticipant) {
    global $db;

    try {
        $query = "SELECT participantID, streetAddress FROM participants WHERE firstName = :fname AND lastName = :lname AND
        dateOfBirth = :dateOfBirth";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventParticipant);
        $stmt->bindParam(':lname', $lnameEventParticipant);
        $stmt->bindParam(':dateOfBirth', $dobEventParticipant);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = array(
                "participantID" => $result["participantID"],
                "streetAddress" => $result["streetAddress"]
            );
        } else {
            $response = "Participant information not found";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the participant number.";
    }

    return $response;
}

?>