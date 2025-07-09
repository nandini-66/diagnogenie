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

// Fetch list of feedback from the database
$query = "SELECT * FROM feedback";
$result = mysqli_query($conn, $query);

// Check if there are any feedback entries
if (mysqli_num_rows($result) > 0) {
    // Feedback entries found, fetch and display them
    $feedback_entries = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // No feedback entries found
    $feedback_entries = [];
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Feedback</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-u-fb.css">
</head>
<body>
    <header>
        <h1>Manage User Feedback</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
        <h2>View Feedback</h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Feedback</th>
                    <th>Submission Date/Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback_entries as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['name']; ?></td>
                    <td><?php echo $feedback['message']; ?></td>
                    <td><?php echo $feedback['submission_date']; ?></td>
                    <td>
                        <a href="php/delete-feedback.php?id=<?php echo $feedback['feedback_id']; ?>" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php  } else { 
            echo "<p>No feedback entries found.</p>";
        }?>

    </main>

    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
