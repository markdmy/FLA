<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fnameEventVolunteer = $_POST["fname-eventVolunteer"];
    $lnameEventVolunteer = $_POST["lname-eventVolunteer"];
    $dobEventVolunteer = $_POST["dob-eventVolunteer"];
    echo json_encode(search_volunteer($fnameEventVolunteer, $lnameEventVolunteer, $dobEventVolunteer));
}

function search_volunteer($fnameEventVolunteer, $lnameEventVolunteer, $dobEventVolunteer) {
    global $db;

    try {
        $query = "SELECT volunteerID, streetAddress FROM volunteers WHERE firstName = :fname AND lastName = :lname AND
        dateOfBirth = :dateOfBirth";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventVolunteer);
        $stmt->bindParam(':lname', $lnameEventVolunteer);
        $stmt->bindParam(':dateOfBirth', $dobEventVolunteer);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = array(
                "volunteerID" => $result["volunteerID"],
                "streetAddress" => $result["streetAddress"]
            );
        } else {
            $response = "Volunteer information not found";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the volunteer number.";
    }

    return $response;
}

?>