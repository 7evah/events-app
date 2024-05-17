<?php

include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $eventId = $_POST['eventId'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];
    $eventDescription = $_POST['eventDescription'];
    $eventType = $_POST['eventType'];
    $organizerId = $_POST['organizerId'];
    $venueId = $_POST['venueId'];

   
    $sql = "UPDATE event SET eventName=?, eventDate=?, eventTime=?, eventDescription=?, eventType=?, organizerId=?, venueId=? WHERE eventId=?";

    
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("ssssssii", $eventName, $eventDate, $eventTime, $eventDescription, $eventType, $organizerId, $venueId, $eventId);

    
    if ($stmt->execute()) {
        
        header("Location: index.php?message=Event updated successfully");
        exit();
    } else {
       
        header("Location: index.php?error=Error updating event: " . $conn->error);
        exit();
    }
} else {
   
    header("Location: index.php");
    exit();
}


$stmt->close();


$conn->close();
?>
