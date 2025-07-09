<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // If not logged in, redirect to admin login page
    header("Location: admin-login.php");
    exit;
}
// Include database connection
include_once "php/db.php";
// If logged in, retrieve admin details
$admin_id = $_SESSION['admin_id'];
$username = $_SESSION['username'];
// You can perform additional admin-specific tasks here, such as fetching data or managing users
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/dash.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <h2>Admin Dashboard</h2>
        <p>This is the admin dashboard. You can perform administrative tasks here.</p>
        <!-- Add your dashboard content here -->
    </main>
    <section>
        <div class="btn">
            <div class="btn1">
                <button class="button" onclick="location.href='manage-symptoms.php';">Manage Symptoms</button>
            </div>
            <div class="btn1">
                <button class="button" onclick="location.href='manage-diseases.php';">Manage Diseases</button>
            </div>
            <div class="btn1">
                <button class="button" onclick="location.href='manage-user-feedback.php';">Manage User Feedback</button>
            </div>
            <div class="btn1">
                <button class="button" onclick="location.href='manage-user.php';">Manage User Accounts</button>
            </div>
            <div class="btn1">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<button class="button" onclick="location.href=\'php/logout.php\';">Log Out</button>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; Diagnogenie</p>
    </footer>
</body>
</html>
