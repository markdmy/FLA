<?php
include('db_conn.php');

if (isset($_GET['event_start_date']) && isset($_GET['event_finish_date'])) {
    $startDate = $_GET['event_start_date'];
    $finishDate = $_GET['event_finish_date'];

    $query = "SELECT ep.eventID, ep.participantID, p.firstName, p.lastName, e.eventDate, ep.costOfWash, ep.costOfDry, ep.productCost, ep.totalCost, pt.nameOfLaundromat 
              FROM events AS e 
              JOIN eventparticipants AS ep ON e.eventID = ep.eventID 
              JOIN participants AS p ON ep.participantID = p.participantID 
              JOIN partnership AS pt ON e.partnerID = pt.partnerID 
              WHERE e.eventDate >= :startDate AND e.eventDate <= :finishDate";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $stmt->bindParam(':finishDate', $finishDate, PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} else {
    echo json_encode([]);
}
?>