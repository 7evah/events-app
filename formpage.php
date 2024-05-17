<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link rel="stylesheet" href="formpage.css"> 
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
        <section id="order-form">
            <div class="container">
                <h1>Order Form</h1>

                <?php
                if (isset($_GET['eventId'])) {
                    $eventId = intval($_GET['eventId']);
                ?>

                <form action="forminsert_participant.php" method="POST">
                    <input type="hidden" name="eventId" value="<?php echo $eventId; ?>">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required><br>
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="number">number:</label>
                    <input type="number" id="number" name="number" required><br>
                    <input type="submit" value="Submit" style="padding: 10px 20px;background-color: #333;color: #fff;border: none;cursor: pointer;display: inline-block;text-decoration: none;"onmouseover="this.style.backgroundColor='#e8491d'" onmouseout="this.style.backgroundColor='#333'">

                </form>

                <?php
                } else {
                    echo "<p>Invalid event ID.</p>";
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
