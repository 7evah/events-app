<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventManager</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <header>
        <div class="container">
            <h1>EventManager</h1>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#login">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
   
    <main>
        <section id="hero">
            <div class="container">
                <h2>Discover Amazing Events</h2>
                <p>Find and book tickets for concerts, sports, theater, and more!</p>
                <form method="GET" action="#events">
                    <input type="text" name="search" placeholder="Search for events...">
                    <button type="submit">Search</button>
                </form>
            </div>
        </section>

        <section id="events">
            <div class="container">
                <h2>Upcoming Events</h2>

                <?php
                include 'config.php';

                
                $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

                
                if (!empty($searchQuery)) {
                    $sql = $conn->prepare("SELECT eventId, eventName, eventDate, eventType, photo FROM event WHERE eventName LIKE ?");
                    $searchTerm = "%" . $searchQuery . "%";
                    $sql->bind_param("s", $searchTerm);
                } else {
                    $sql = $conn->prepare("SELECT eventId, eventName, eventDate, eventType, photo FROM event ");
                }

              
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="event-card">';
                        echo '<img style="max-width: 100%; max-height: 200px; width: auto; height: auto; border-radius: 5px;" class="event-photo" src="' . $row["photo"] . '" alt="' . $row["eventName"] . '">';
                        echo '<h3>' . $row["eventName"] . '</h3>';
                        echo '<p>Date: ' . $row["eventDate"] . '</p>';
                        echo '<p>Type: ' . $row["eventType"] . '</p>';
                        echo '<a href="eventsp.php?eventId=' . $row["eventId"] . '"><button>Book Now</button></a>';
                        echo '</div>';
                    }
                } else {
                    echo "No events found.";
                }

                $sql->close();
                $conn->close();
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
