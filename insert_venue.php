<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Venue</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Insert New Venue</h1>
    <form action="insert_venue.php" method="POST">
        <label for="venueName">Venue Name:</label>
        <input type="text" id="venueName" name="venueName" required><br>
        <label for="venueAddress">Venue Address:</label>
        <input type="text" id="venueAddress" name="venueAddress" required><br>
        <label for="venueType">Venue Type:</label>
        <input type="text" id="venueType" name="venueType" required><br>
        <input type="submit" value="Insert">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';

        $venueName = $_POST['venueName'];
        $venueAddress = $_POST['venueAddress'];
        $venueType = $_POST['venueType'];

        $sql = "INSERT INTO venue (venueName, venueAddress, venueType) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $venueName, $venueAddress, $venueType);

        if ($stmt->execute()) {
            header("Location: index.php?message=Venue inserted successfully");
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
