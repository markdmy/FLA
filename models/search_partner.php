<?php
include("db_conn.php");
//coded by eunji
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameToBeSearched = $_POST["laundromat-name"];
    echo json_encode(search_partner($nameToBeSearched));
}

function search_partner($nameToBeSearched) {
    global $db;
    
    //this is to use reference (if trigger works)
    // try {
    //     $query = "SELECT partnerReference FROM partnership WHERE nameOfLaundromat = :nameOfLaundromat";
    //     $stmt = $db->prepare($query);
    //     $stmt->bindParam(':nameOfLaundromat', $nameToBeSearched);
    //     $stmt->execute();

    //     if ($stmt->rowCount() > 0) {
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //         $response = $result["partnerReference"];
    //     } else {
    //         $response = "Reference not found";
    //     }

    // } catch (PDOException $e) {
    //     error_log("Database error: " . $e->getMessage());
    //     $response = "An error occurred while searching for the reference.";
    // }


    //this is to use partnerID if trigger doesnt work 
    try {
        $query = "SELECT partnerID FROM partnership WHERE nameOfLaundromat = :nameOfLaundromat";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nameOfLaundromat', $nameToBeSearched);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = $result["partnerID"];
        } else {
            $response = "Partner Number not found";
        }

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $response = "An error occurred while searching for the partner number.";
    }




    return $response;
}
?>