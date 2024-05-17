<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Edit Venue</h1>

    <?php
    
    include 'config.php';

  
    if(isset($_GET['id'])) {
        $venueId = $_GET['id'];

        
        $sql = "SELECT * FROM venue WHERE venueId = $venueId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="update_venue.php" method="POST">
        <input type="hidden" name="venueId" value="<?php echo $row['venueId']; ?>">
        <label for="venueName">Venue Name:</label>
        <input type="text" id="venueName" name="venueName" value="<?php echo $row['venueName']; ?>" required><br>
        <label for="venueAddress">Venue Address:</label>
        <input type="text" id="venueAddress" name="venueAddress" value="<?php echo $row['venueAddress']; ?>" required><br>
        <label for="venueType">Venue Type:</label>
        <input type="text" id="venueType" name="venueType" value="<?php echo $row['venueType']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
    <?php
        } else {
            echo "Venue not found.";
        }
    } else {
        echo "Venue ID not provided.";
    }

    
    $conn->close();
    ?>

</body>
</html>
