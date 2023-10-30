<?php
include('db_conn.php');
//coded by eunji
$query = "SELECT e.eventID, e.eventDate, e.nameOfLaundromat, p.streetAddress
          FROM events e
          JOIN partnership p ON e.partnerID = p.partnerID ORDER BY e.nameOfLaundromat";


$result = $db->query($query);

$data = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>