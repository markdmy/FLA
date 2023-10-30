<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['city'])) {
        $city = $_GET["city"];
        $response = search_volunteer_by_city($city);
    } else {
        $response = ["No city specified."];
    }

    echo json_encode($response);
}

function search_volunteer_by_city($cityName) {
    global $db;

    try {
        $query = "SELECT firstName, lastName, dateOfBirth, email, phone, streetAddress, city, province, postalcode FROM volunteers WHERE city = :city ORDER BY lastName";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':city', $cityName);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $volunteers = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $volunteer = array(
                    "firstName" => $row["firstName"],
                    "lastName" => $row["lastName"],
                    "dateOfBirth" => $row["dateOfBirth"],
                    "email" => $row["email"],
                    "phone" => $row["phone"],
                    "streetAddress" => $row["streetAddress"],
                    "city" => $row["city"],
                    "province" => $row["province"],
                    "postalcode" => $row["postalcode"]
                );
                $volunteers[] = $volunteer;
            }
            return $volunteers;
        } else {
            return ["No volunteers found in the selected city."];
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return ["An error occurred while searching for volunteers in the selected city."];
    }
}
?>