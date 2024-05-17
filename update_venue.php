<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $venueId = $_POST['venueId'];
    $venueName = $_POST['venueName'];
    $venueAddress = $_POST['venueAddress'];
    $venueType = $_POST['venueType'];

    
    $sql = "UPDATE venue SET venueName=?, venueAddress=?, venueType=? WHERE venueId=?";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $venueName, $venueAddress, $venueType, $venueId);

  
    if ($stmt->execute()) {
        
        header("Location: index.php?message=Venue updated successfully");
        exit();
    } else {
        
        header("Location: index.php?error=Error updating venue: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}


$stmt->close();


$conn->close();
?>
