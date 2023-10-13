<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fnameEventParticipant = $_POST["fname-eventParticipant"];
    $lnameEventParticipant = $_POST["lname-eventParticipant"];
    echo json_encode(search_participant($fnameEventParticipant, $lnameEventParticipant));
}

function search_participant($fnameEventParticipant, $lnameEventParticipant) {
    global $db;

    try {
        $query = "SELECT participantID FROM participants WHERE firstName = :fname AND lastName = :lname";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventParticipant);
        $stmt->bindParam(':lname', $lnameEventParticipant);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = $result["participantID"];
        } else {
            $response = "Participant Number not found";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the participant number.";
    }

    return $response;
}

?>