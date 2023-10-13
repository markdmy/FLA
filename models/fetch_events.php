<?php
include('db_conn.php');

$query = "SELECT e.eventID, e.eventDate, e.nameOfLaundromat, p.streetAddress
          FROM events e
          JOIN partnership p ON e.partnerID = p.partnerID";


$result = $db->query($query);

$data = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>