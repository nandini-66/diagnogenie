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

// Fetch list of users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if there are any users
if (mysqli_num_rows($result) > 0) {
    // Users found, display user management table
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // No users found
    $users = [];
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-u-fb.css">
</head>
<body>
    <header>
        <h1>User Management</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
        <h2>View Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
