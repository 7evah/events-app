<?php
session_start();
include 'config.php';

// Set the participant ID to 1
$userId = 7;


$sql = "SELECT e.eventId, e.eventName, e.eventDate, e.eventType, e.photo, p.firstName, p.lastName
        FROM event e 
        JOIN Inscription i ON e.eventId = i.eventid 
        JOIN Participant p ON i.participantid = p.participantId
        WHERE i.participantid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event History</title>
    <link rel="stylesheet" href="history.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>EventManager</h1>
            <nav>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#events">Events</a></li>
                    <li><a href="history.php">My Events</a></li>
                    <li><a href="account.php">Account Settings</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="event-history">
            <div class="container">
                <h2>My Event History</h2>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="event-card">';
                        echo '<img class="event-photo" src="' . $row["photo"] . '" alt="' . $row["eventName"] . '">';
                        echo '<div class="event-details">';
                        echo '<h3>' . $row["eventName"] . '</h3><br>';
                        echo '<p>Date: ' . $row["eventDate"] . '</p><br>';
                        echo '<p>Type: ' . $row["eventType"] . '</p><br>';
                        echo '<p>Participant: ' . $row["firstName"] . ' ' . $row["lastName"] . '</p><br>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No events found.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 EventManager. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
