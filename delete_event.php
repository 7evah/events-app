<?php

include 'config.php';


if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    
    $sql = "DELETE FROM event WHERE eventId = ?";

    
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("i", $eventId);

   
    if ($stmt->execute()) {
       
        header("Location: index.php?message=Event deleted successfully");
        exit();
    } else {
       
        header("Location: index.php?error=Error deleting event: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: index.php?error=Event ID not provided");
    exit();
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
