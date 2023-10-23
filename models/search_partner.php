<?php
include("db_conn.php");
//coded by eunji
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameToBeSearched = $_POST["laundromat-name"];
    echo json_encode(search_partner($nameToBeSearched));
}

function search_partner($nameToBeSearched) {
    global $db;
    
    try {
        $query = "SELECT partnerID, streetAddress FROM partnership WHERE nameOfLaundromat = :nameOfLaundromat";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nameOfLaundromat', $nameToBeSearched);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = array(
                "partnerID" => $result["partnerID"],
                "streetAddress" => $result["streetAddress"]
            );
        } else {
            $response = "Partner information not found";
        }

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the partner number.";
    }




    return $response;
}
?>