<?php

include 'config.php';


if (isset($_GET['id'])) {
    $venueId = $_GET['id'];

    
    $sql = "DELETE FROM venue WHERE venueId = ?";

  
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("i", $venueId);

    
    if ($stmt->execute()) {
        
        header("Location: index.php?message=venue deleted successfully");
        exit();
    } else {
       
        header("Location: index.php?error=Error deleting venue: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: index.php?error=venue ID not provided");
    exit();
}

// Close the prepared statement
$stmt->close();


$conn->close();
?>
