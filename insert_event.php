<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insert New Event</h1>
    <form action="insert_event.php" method="POST">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" required><br>
        <label for="eventDate">Event Date:</label>
        <input type="date" id="eventDate" name="eventDate" required><br>
        <label for="eventTime">Event Time:</label>
        <input type="time" id="eventTime" name="eventTime" required><br>
        <label for="eventDescription">Event Description:</label>
        <input type="text" id="eventDescription" name="eventDescription" required><br>
        <label for="eventType">Event Type:</label>
        <input type="text" id="eventType" name="eventType" required><br>
        <label for="photo">Photo:</label>
        <input type="text" id="photo" name="photo" required><br>
        <label for="organizerId">Organizer ID:</label>
        <input type="number" id="organizerId" name="organizerId" required><br>
        <label for="venueId">Venue ID:</label>
        <input type="number" id="venueId" name="venueId" required><br>
        <input type="submit" value="Insert">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';

        $eventName = $_POST['eventName'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $eventDescription = $_POST['eventDescription'];
        $eventType = $_POST['eventType'];
        $photo = $_POST['photo'];
        $organizerId = $_POST['organizerId'];
        $venueId = $_POST['venueId'];

        $sql = "INSERT INTO event (eventName, eventDate, eventTime, eventDescription, eventType, photo, organizerId, venueId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssii", $eventName, $eventDate, $eventTime, $eventDescription, $eventType, $photo, $organizerId, $venueId);

        if ($stmt->execute()) {
            header("Location: index.php?message=Event inserted successfully");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
