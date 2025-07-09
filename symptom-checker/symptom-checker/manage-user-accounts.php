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

// Fetch list of user accounts from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if there are any user accounts
if (mysqli_num_rows($result) > 0) {
    // User accounts found, fetch and display them
    $user_accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // No user accounts found
    $user_accounts = [];
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Accounts</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->    
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-u-fb.css">
</head>
<body>
    <header>
        <h1>Manage User Accounts</h1>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <h2>View User Accounts</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_accounts as $user): ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['registration_date']; ?></td>
                    <td>
                        <a href="edit-user-account.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete-user-account.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user account?')">Delete</a>
                    </td>
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
