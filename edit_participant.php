<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Participant</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Edit Participant</h1>

    <?php
    
    include 'config.php';

    
    if (isset($_GET['id'])) {
        $participantId = $_GET['id'];

        
        $sql = "SELECT * FROM participant WHERE participantId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $participantId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="update_participant.php" method="POST">
        <input type="hidden" name="participantId" value="<?php echo $row['participantId']; ?>">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $row['firstName']; ?>" required><br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $row['lastName']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="eventId">Event ID:</label>
        <input type="text" id="eventId" name="numero" value="<?php echo $row['numero']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
    <?php
        } else {
            echo "Participant not found.";
        }
    } else {
        echo "Participant ID not provided.";
    }

    
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
