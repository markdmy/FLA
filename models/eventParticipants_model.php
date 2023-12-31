<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eventID = $_POST['event-for-participant'];
    $participantID = $_POST['participant_id'];
    $costOfWash = $_POST['cost_of_wash'];
    $costOfDry = $_POST['cost_of_dry'];
    $productCost = $_POST['product_cost'];
    $totalCost = $costOfWash + $costOfDry + $productCost;

    // Insert data into the eventParticipants table
    $result = add_eventParticipants($eventID, $participantID, $costOfWash, $costOfDry, $productCost, $totalCost);

    if ($result) {
        // If the insertion is successful, retrieve firstname and email
        $participantData = getParticipantData($participantID);
        
        if ($participantData) {
            $eventParticipantName = $participantData['firstName'];
            $eventParticipantEmail = $participantData['email'];

            $eventData = getEventData($eventID);

            if ($eventData) {
                $eventDate = $eventData['eventDate'];
                $nameOfLaundromat = $eventData['nameOfLaundromat'];
                $streetAddress = $eventData['streetAddress'];
                $totalCost = $costOfWash + $costOfDry + $productCost;
                
                // Redirect to another page with query parameters
                $redirectUrl = "../submitSuccess.php?eventParticipantName=" . urlencode($eventParticipantName) .
                               "&eventParticipantEmail=" . urlencode($eventParticipantEmail) .
                               "&partnerEventDate=" . urlencode($eventDate) .
                               "&partnerNameOfLaundromat=" . urlencode($nameOfLaundromat) .
                               "&partnerStreetAddress=" . urlencode($streetAddress) .
                               "&totalCost=" . urlencode($totalCost);

                echo "<script>window.location.href='$redirectUrl';</script>";
                exit();
            } else {
                echo "Event data retrieval failed.";
            }
        } else {
            echo "Participant data retrieval failed.";
        }
    } else {
        echo "participant to the event not registered properly.";
    }
}



function add_eventParticipants($eventID, $participantID, $costOfWash, $costOfDry, $productCost, $totalCost)
{
    global $db;

    try {
        $query = "INSERT INTO eventparticipants (eventID, participantID, costOfWash, costOfDry, productCost, totalCost) 
                  VALUES (:eventID, :participantID, :costOfWash, :costOfDry, :productCost, :totalCost)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':participantID', $participantID, PDO::PARAM_INT);
        $stmt->bindParam(':costOfWash', $costOfWash, PDO::PARAM_STR);
        $stmt->bindParam(':costOfDry', $costOfDry, PDO::PARAM_STR);
        $stmt->bindParam(':productCost', $productCost, PDO::PARAM_STR);
        $stmt->bindParam(':totalCost', $totalCost, PDO::PARAM_STR);

        return $stmt->execute();
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return false; // Indicate that the insertion failed
    }
}


function getParticipantData($participantID)
{
    global $db;

    try {
        $query = "SELECT firstName, email FROM participants WHERE participantID = :participantID";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':participantID', $participantID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return null; // Participant not found
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return null; // Indicate that the retrieval failed
    }
}

function getEventData($eventID) {
    global $db;

    try {
        $query = "SELECT e.eventDate, e.nameOfLaundromat, p.streetAddress
          FROM events e
          JOIN partnership p ON e.partnerID = p.partnerID
          WHERE e.eventID = :eventID"; // Assuming nameOfLaundromat is in the 'events' table

        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return null; // Event not found
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error, display a user-friendly message)
        echo "An error occurred: " . $e->getMessage();
        return null; // Indicate that the retrieval failed
    }
}


?>