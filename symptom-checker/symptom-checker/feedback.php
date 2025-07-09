<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/feedback.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Feedback</h1>
        <p>We value your feedback!</p>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <div class="feedback">
            <form action="php/feedback.php" method="POST">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>

                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy;Diagnogenie.</p>
    </footer>
</body>
</html>
