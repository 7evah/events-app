<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Edit Event</h1>

    <?php
    
    include 'config.php';

  
    if(isset($_GET['id'])) {
        $eventId = $_GET['id'];

        
        $sql = "SELECT * FROM event WHERE eventId = $eventId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="update_event.php" method="POST">
        <input type="hidden" name="eventId" value="<?php echo $row['eventId']; ?>">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" value="<?php echo $row['eventName']; ?>" required><br>
        <label for="eventDate">Event Date:</label>
        <input type="date" id="eventDate" name="eventDate" value="<?php echo $row['eventDate']; ?>" required><br>
        <label for="eventTime">Event Time:</label>
        <input type="time" id="eventTime" name="eventTime" value="<?php echo $row['eventTime']; ?>" required><br>
        <label for="eventDescription">Event Description:</label>
        <textarea id="eventDescription" name="eventDescription" required><?php echo $row['eventDescription']; ?></textarea><br>
        <label for="eventType">Event Type:</label>
        <input type="text" id="eventType" name="eventType" value="<?php echo $row['eventType']; ?>" required><br>
        <label for="organizerId">Organizer ID:</label>
        <input type="number" id="organizerId" name="organizerId" value="<?php echo $row['organizerId']; ?>" required><br>
        <label for="venueId">Venue ID:</label>
        <input type="number" id="venueId" name="venueId" value="<?php echo $row['venueId']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
    <?php
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Event ID not provided.";
    }

    
    $conn->close();
    ?>

</body>
</html>
