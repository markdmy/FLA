<!--coded by Eunji--- db not set up-->
<?php
include('db_conn.php');


//Use below code if using trigger (reference)
//   if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $event_date = $_POST['event_date'];
//     $partner_reference = $_POST['partner_reference'];
//     $eventCreated = date('Y-m-d H:i:s');

//     $result = add_events($event_date, $partner_reference, $eventCreated);

//     if ($result && isset($result['eventDate']) && isset($result['nameOfLaundromat']) && isset($result['streetAddress'])) {
//         $eventDate = $result['eventDate'];
//         $nameOfLaundromat = $result['nameOfLaundromat'];
//         $streetAddress = $result['streetAddress'];
//         $redirectURL = "../submitSuccess.php?eventDate=" . urlencode($eventDate) . "&streetAddress=" . urlencode($streetAddress) . "&nameOfLaundromat=" . urlencode($nameOfLaundromat);
//         // header("Location: $redirectURL");
//         echo "<script>window.location.href='$redirectURL';</script>";
//         exit();
//     } else {
//         echo "Event not created properly.";
//     }
//    }
   

// function add_events($event_date, $partner_reference, $eventCreated){

//     global $db;
//     try {

//         $partnerID = findPartnerID($partner_reference);
//         $nameOfLaundromat = getNameOfLaundromat($partnerID);
       
//         if ($partnerID) {

//         $query = "INSERT INTO events (eventID, eventDate, nameOfLaundromat, partnerID, partnerReference, eventCreated) 
//         VALUES (NULL, '$event_date', '$nameOfLaundromat','$partnerID', '$partner_reference', '$eventCreated')";

//         $result = $db->query($query);

//         if ($result) {
          
//             $eventID = $db->lastInsertId();
//             $eventDate = getEventDate($eventID);
//             $streetAddress = getStreetAddress($partnerID);
            
//             return ["eventDate" => $eventDate, "nameOfLaundromat" => $nameOfLaundromat, "streetAddress" => $streetAddress];
//         }
//     } else {
//         return ["error" => "Invalid partnerReference"];
//     }     

//         }catch (Exception $e) {
//         echo "An error occurred: " . $e->getMessage();
//         return false; 
//     }

// }

// function findPartnerID($partner_reference) {
//     global $db;

//     $query = "SELECT partnerID FROM partnership WHERE partnerReference = :partner_reference";
//     $stmt = $db->prepare($query);
//     $stmt->bindParam(':partner_reference', $partner_reference);
//     $stmt->execute();
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $result ? $result['partnerID'] : null;
// }



// function getEventDate($eventID) {
//     global $db;

//     $query = "SELECT eventDate FROM events WHERE eventID = :eventID";
//     $stmt = $db->prepare($query);
//     $stmt->bindParam(':eventID', $eventID);
//     $stmt->execute();
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $result['eventDate'];
// }

// function getNameOfLaundromat($partnerID) {
//     global $db;

//     $query = "SELECT nameOfLaundromat FROM partnership WHERE partnerID = :partnerID";
//     $stmt = $db->prepare($query);
//     $stmt->bindParam(':partnerID', $partnerID);
//     $stmt->execute();
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $result['nameOfLaundromat'];
// }



// function getStreetAddress($partnerID) {
//     global $db;

//     $query = "SELECT streetAddress FROM partnership WHERE partnerID = :partnerID";
//     $stmt = $db->prepare($query);
//     $stmt->bindParam(':partnerID', $partnerID);
//     $stmt->execute();
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $result['streetAddress'];
// }




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $event_date = $_POST['event_date'];
    $partner_id = $_POST['partner_id'];
    $eventCreated = date('Y-m-d H:i:s');

    $result = add_events($event_date, $partner_id, $eventCreated);

    if ($result && isset($result['eventDate']) && isset($result['nameOfLaundromat']) && isset($result['streetAddress'])) {
        $eventDate = $result['eventDate'];
        $nameOfLaundromat = $result['nameOfLaundromat'];
        $streetAddress = $result['streetAddress'];
        $redirectURL = "../submitSuccess.php?eventDate=" . urlencode($eventDate) . "&streetAddress=" . urlencode($streetAddress) . "&nameOfLaundromat=" . urlencode($nameOfLaundromat);
        // header("Location: $redirectURL");
        echo "<script>window.location.href='$redirectURL';</script>";
        exit();
    } else {
        echo "Event not created properly.";
    }
   }
   

function add_events($event_date, $partner_id, $eventCreated){

    global $db;
    try {

        $partnerID = findPartnerID($partner_id);
        $nameOfLaundromat = getNameOfLaundromat($partnerID);
       
        if ($partnerID) {

        $query = "INSERT INTO events (eventDate, nameOfLaundromat, partnerID, eventCreated) 
        VALUES ('$event_date', '$nameOfLaundromat','$partnerID', '$eventCreated')";

        $result = $db->query($query);

        if ($result) {
          
            $eventID = $db->lastInsertId();
            $eventDate = getEventDate($eventID);
            $streetAddress = getStreetAddress($partnerID);
            
            return ["eventDate" => $eventDate, "nameOfLaundromat" => $nameOfLaundromat, "streetAddress" => $streetAddress];
        }
    } else {
        return ["error" => "Invalid partnerReference"];
    }     

        }catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return false; 
    }

}

function findPartnerID($partner_id) {
    global $db;

    $query = "SELECT partnerID FROM partnership WHERE partnerID = :partner_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':partner_id', $partner_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['partnerID'] : null;
}



function getEventDate($eventID) {
    global $db;

    $query = "SELECT eventDate FROM events WHERE eventID = :eventID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':eventID', $eventID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['eventDate'];
}

function getNameOfLaundromat($partnerID) {
    global $db;

    $query = "SELECT nameOfLaundromat FROM partnership WHERE partnerID = :partnerID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':partnerID', $partnerID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['nameOfLaundromat'];
}



function getStreetAddress($partnerID) {
    global $db;

    $query = "SELECT streetAddress FROM partnership WHERE partnerID = :partnerID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':partnerID', $partnerID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['streetAddress'];
}





?>