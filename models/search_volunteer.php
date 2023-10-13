<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fnameEventVolunteer = $_POST["fname-eventVolunteer"];
    $lnameEventVolunteer = $_POST["lname-eventVolunteer"];
    echo json_encode(search_volunteer($fnameEventVolunteer, $lnameEventVolunteer));
}

function search_volunteer($fnameEventVolunteer, $lnameEventVolunteer) {
    global $db;

    try {
        $query = "SELECT volunteerID FROM volunteers WHERE firstName = :fname AND lastName = :lname";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventVolunteer);
        $stmt->bindParam(':lname', $lnameEventVolunteer);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = $result["volunteerID"];
        } else {
            $response = "Volunteer Number not found";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the volunteer number.";
    }

    return $response;
}

?>