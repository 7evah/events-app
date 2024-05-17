<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Admin Panel</h1>

  
    <h2>Venues</h2>
    <a href="insert_venue.php" class="button" style="margin-bottom: 10px;">Insert New Venue</a>
    <table>
        <thead>
            <tr>
                <th>Venue ID</th>
                <th>Venue Name</th>
                <th>Venue Address</th>
                <th>Venue Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            include 'config.php';

            
            $sql = "SELECT * FROM venue";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
               
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["venueId"] . "</td>";
                    echo "<td>" . $row["venueName"] . "</td>";
                    echo "<td>" . $row["venueAddress"] . "</td>";
                    echo "<td>" . $row["venueType"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_venue.php?id=" . $row["venueId"] . "' class='button'>Update</a>";
                    echo "<a href='delete_venue.php?id=" . $row["venueId"] . "' class='button' style='background-color: #dc3545;'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No venues found</td></tr>";
            }

            
            $result->free();
            ?>
        </tbody>
    </table>

    
    <h2>Events</h2>
    <a href="insert_event.php" class="button" style="margin-bottom: 10px;">Insert New Event</a>
    <table>
    <table>
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Event Description</th>
                <th>Event Type</th>
                <th>Photo</th>
                <th>Organizer ID</th>
                <th>Venue ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT * FROM event";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["eventId"] . "</td>";
                    echo "<td>" . $row["eventName"] . "</td>";
                    echo "<td>" . $row["eventDate"] . "</td>";
                    echo "<td>" . $row["eventTime"] . "</td>";
                    echo "<td>" . $row["eventDescription"] . "</td>";
                    echo "<td>" . $row["eventType"] . "</td>";
                    echo "<td>" . $row["photo"] . "</td>";
                    echo "<td>" . $row["organizerId"] . "</td>";
                    echo "<td>" . $row["venueId"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_event.php?id=" . $row["eventId"] . "' class='button'>Update</a>";
                    echo "<a href='delete_event.php?id=" . $row["eventId"] . "' class='button' style='background-color: #dc3545;'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No events found</td></tr>";
            }

            // Free result set
            $result->free();
            ?>
        </tbody>
    </table>

    <!-- Participant Table -->
    <h2>Participants</h2>
    <a href="insert_participant.php" class="button" style="margin-bottom: 10px;">Insert New Participant</a>
    <table>
        <thead>
            <tr>
                <th>Participant ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>numero</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT * FROM participant";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["participantId"] . "</td>";
                    echo "<td>" . $row["firstName"] . "</td>";
                    echo "<td>" . $row["lastName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["numero"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_participant.php?id=" . $row["participantId"] . "' class='button'>Update</a>";
                    echo "<a href='delete_participant.php?id=" . $row["participantId"] . "' class='button' style='background-color: #dc3545;'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No participants found</td></tr>";
            }

            // Free result set
            $result->free();

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>



</body>
</html>
