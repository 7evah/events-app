<?php

include 'config.php';


function insertParticipant($first_name, $last_name, $email, $number, $event_id, $conn) {
    
    $stmt = $conn->prepare("INSERT INTO Participant (firstName, lastName, email, numero) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $number);
    $stmt->execute();
    
    // Get the last inserted participant ID
    $participant_id = $conn->insert_id;

   
    $stmt = $conn->prepare("INSERT INTO Inscription (eventid, participantid) VALUES (?, ?)");
    $stmt->bind_param("ii", $event_id, $participant_id);
    $stmt->execute();
    
   
    $stmt->close();
    
    return $participant_id;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $event_id = intval($_POST['eventId']);

    
    $participant_id = insertParticipant($first_name, $last_name, $email, $number, $event_id, $conn);

    // Send confirmation email
    $to = $email;
    $subject = "Event Registration Confirmation";
    $message = "Dear $first_name $last_name,\n\nThank you for registering for the event. Your registration details are as follows:\n\nEvent ID: $event_id\nName: $first_name $last_name\nEmail: $email\nNumber: $number\n\nWe look forward to seeing you at the event.\n\nBest regards,\nEventManager";
    $headers = "From: no-reply@eventmanager.com";

    if (mail($to, $subject, $message, $headers)) {
        
        header("Location: confirmation.php?eventId=$event_id&message=Participant added successfully and confirmation email sent");
    } else {
        
        header("Location: confirmation.php?eventId=$event_id&message=Participant added successfully but failed to send confirmation email");
    }
    exit();
}


$conn->close();
?>
