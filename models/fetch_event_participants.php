<?php
include('db_conn.php');

if (isset($_GET['eventID'])) {
    $eventID = $_GET['eventID'];

    
    try {

        $query = "SELECT
            p.firstName,
            p.lastName, 
            ep.costOfWash,
            ep.costOfDry,
            ep.productCost,
            ep.totalCost,
            prt.nameOfLaundromat AS partnerName,
            prt.streetAddress AS partnerStreetAddress,
            prt.city AS partnerCity,
            prt.province AS partnerProvince,
            prt.postalcode AS partnerPostalCode,
            e.eventDate
        FROM eventParticipants AS ep
        INNER JOIN participants AS p ON ep.participantID = p.participantID
        LEFT JOIN events AS e ON ep.eventID = e.eventID
        LEFT JOIN partnership AS prt ON e.partnerID = prt.partnerID
        WHERE ep.eventID = :eventID
        ORDER BY p.lastName
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    } catch (PDOException $e) {
        // Handle any database-related exceptions here
        // You can log the error, return an error response, or take appropriate action.
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo json_encode([]);
}
?>