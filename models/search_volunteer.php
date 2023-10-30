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
        $query = "SELECT volunteerID, firstName, lastName, dateOfBirth, streetAddress, email FROM volunteers WHERE firstName = :fname AND lastName = :lname";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':fname', $fnameEventVolunteer);
        $stmt->bindParam(':lname', $lnameEventVolunteer);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $volunteer = array(
                    "volunteerID" => $row["volunteerID"],
                    "firstName" => $row["firstName"],
                    "lastName" => $row["lastName"],
                    "dateOfBirth" => $row["dateOfBirth"],
                    "streetAddress" => $row["streetAddress"],
                    "email" => $row["email"]
                );
                $volunteers[] = $volunteer;
            }
            $response = $volunteers;
        } else {
            $response = "No volunteers found with the given names.";
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the volunteer number.";
    }

    return $response;
}








?>