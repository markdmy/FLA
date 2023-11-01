<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $query = "SELECT * FROM partnership ORDER BY nameOfLaundromat";
        $stmt = $db->query($query);
        $partners = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($partners)) {
            echo json_encode($partners);
        } else {
            echo json_encode(["No partners found."]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(["An error occurred while fetching partners."]);
    }
}
?>