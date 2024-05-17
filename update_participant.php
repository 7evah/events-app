<?php

include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $participantId = $_POST['participantId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];

    
    $sql = "UPDATE participant SET firstName=?, lastName=?, email=?, numero=? WHERE participantId=?";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $firstName, $lastName, $email, $numero, $participantId);

    
    if ($stmt->execute()) {
        
        header("Location: index.php?message=Participant updated successfully");
        exit();
    } else {
        
        header("Location: index.php?error=Error updating participant: " . $conn->error);
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}


$stmt->close();


$conn->close();
?>
