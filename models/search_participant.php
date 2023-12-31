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
        $query = "SELECT participantID, firstName, lastName, dateOfBirth, streetAddress FROM participants WHERE firstName = :fname AND lastName = :lname";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventParticipant);
        $stmt->bindParam(':lname', $lnameEventParticipant);
        $stmt->execute();
        $participants = array();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $participant = array(
                    "participantID" => $row["participantID"],
                    "firstName" => $row["firstName"],
                    "lastName" => $row["lastName"],
                    "dateOfBirth" => $row["dateOfBirth"],
                    "streetAddress" => $row["streetAddress"]
                );
                $participants[] = $participant;
            }
            $response = $participants;
        } else {
            $response = "No participants found with the given names.";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the participant number.";
    }

    return $response;
}

?>