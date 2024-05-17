<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Participant</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Insert New Participant</h1>
    <form action="insert_participant.php" method="POST">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="eventId">number:</label>
        <input type="number" id="eventId" name="eventId" required><br>
        <input type="submit" value="Insert">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];

        $sql = "INSERT INTO participant (firstName, lastName, email, numero) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $numero);

        if ($stmt->execute()) {
            header("Location: index.php?message=Participant inserted successfully");
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
