<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eventID = $_POST['event-for-volunteer'];
    $volunteerID = $_POST['volunteer_id'];

    // Insert data into the eventParticipants table
    $result = add_eventVolunteers($eventID, $volunteerID);

    if ($result) {
        // If the insertion is successful, retrieve firstname and email
        $volunteerData = getVolunteerData($volunteerID);
        
        if ($volunteerData) {
            $eventVolunteerName = $volunteerData['firstName'];
            $eventVolunteerEmail = $volunteerData['email'];

            $eventData = getEventData($eventID);

            if ($eventData) {
                $eventDate = $eventData['eventDate'];
                $nameOfLaundromat = $eventData['nameOfLaundromat'];
                $streetAddress = $eventData['streetAddress'];
                // Redirect to another page with query parameters
                $redirectUrl = "../submitSuccess.php?eventVolunteerName=" . urlencode($eventVolunteerName) .
                               "&eventVolunteerEmail=" . urlencode($eventVolunteerEmail) .
                               "&volunteerEventDate=" . urlencode($eventDate) .
                               "&volunteerNameOfLaundromat=" . urlencode($nameOfLaundromat) .
                               "&volunteerStreetAddress=" . urlencode($streetAddress);
                               

                echo "<script>window.location.href='$redirectUrl';</script>";
                exit();
            } else {
                echo "Event data retrieval failed.";
            }
        } else {
            echo "Participant data retrieval failed.";
        }
    } else {
        echo "Event not created properly.";
    }
}



function add_eventVolunteers($eventID, $volunteerID)
{
    global $db;

    try {
        $query = "INSERT INTO eventVolunteers (eventID, volunteerID) 
                  VALUES (:eventID, :volunteerID)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':volunteerID', $volunteerID, PDO::PARAM_INT);
    

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
        return false; 
    }
}


function getVolunteerData($volunteerID)
{
    global $db;

    try {
        $query = "SELECT firstName, email FROM volunteers WHERE volunteerID = :volunteerID";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':volunteerID', $volunteerID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return null; // volunteer not found
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
        return null; 
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