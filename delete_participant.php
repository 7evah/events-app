<?php

include 'config.php';


if (isset($_GET['id'])) {
    $participantId = $_GET['id'];

  
    $sql = "DELETE FROM participant WHERE participantId = ?";

    
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("i", $participantId);

    
    if ($stmt->execute()) {
        
        header("Location: index.php?message=Participant deleted successfully");
        exit();
    } else {
       
        header("Location: index.php?error=Error deleting participant: " . $conn->error);
        exit();
    }
} else {
   
    header("Location: index.php?error=Participant ID not provided");
    exit();
}


$stmt->close();


$conn->close();
?>
