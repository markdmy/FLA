<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $query = "SELECT DISTINCT city FROM volunteers";
        $stmt = $db->query($query);
        $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($cities)) {
            echo json_encode($cities);
        } else {
            echo json_encode(["No cities found."]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(["An error occurred while fetching cities."]);
    }
}
?>