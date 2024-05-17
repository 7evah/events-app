<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="eventspcss.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>EventManager</h1>
            <nav>
                <ul>
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#events">Events</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <li><a href="index.php#login">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="event-details">
            <div class="container">
                <?php
                include 'config.php';

                if (isset($_GET['eventId'])) {
                    $eventId = intval($_GET['eventId']);

                    $sql = "SELECT e.eventName, e.eventDate, e.eventTime, e.eventDescription, e.eventType, e.photo, v.venueName, v.venueAddress 
                            FROM event e 
                            JOIN venue v ON e.venueId = v.venueId 
                            WHERE e.eventId = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $eventId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<img src="' . $row["photo"] . '" alt="' . $row["eventName"] . '">';
                            echo '<h2>Event Name: ' . $row["eventName"] . '</h2>';
                            echo '<p>Date: ' . $row["eventDate"] . '</p>';
                            echo '<p>Time: ' . $row["eventTime"] . '</p>';
                            echo '<p>Location: ' . $row["venueName"] . ', ' . $row["venueAddress"] . '</p>';
                            echo '<p>Description: ' . $row["eventDescription"] . '</p>';
                        }
                    } else {
                        echo "<p>No event details found.</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p>Invalid event ID.</p>";
                }

                $conn->close();
                ?>
                <button id="order-now-button" onclick="redirectToOrderForm(<?php echo $eventId; ?>)">Order Now</button>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 EventManager. All rights reserved.</p>
        </div>
    </footer>

    <script>
       function redirectToOrderForm(eventId) {
        window.location.href = "formpage.php?eventId=" + eventId;
    }
    </script>
</body>
</html>
