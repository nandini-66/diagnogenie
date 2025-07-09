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

// Fetch list of diseases from the database
$query = "SELECT * FROM diseases";
$result = mysqli_query($conn, $query);

// Check if there are any diseases
if (mysqli_num_rows($result) > 0) {
    // Diseases found, fetch and display them
    $diseases = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // No diseases found
    $diseases = [];
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Diseases</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-d.css">
</head>
<body>
    <header>
        <h1>Manage Diseases</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
    <h2>Add Disease</h2>
        <form action="php/add-disease.php" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br>
            
            <label for="treatment_options">Treatment Options:</label><br>
            <textarea id="treatment_options" name="treatment_options" required></textarea><br>
            
            <button type="submit" class="btn">Add Disease</button>
        </form>
        
        <h2>View Diseases</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Treatment Options</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diseases as $disease): ?>
                <tr>
                    <td><?php echo $disease['name']; ?></td>
                    <td><?php echo $disease['description']; ?></td>
                    <td><?php echo $disease['treatment_options']; ?></td>
                    <td>
                        <a href="edit-disease.php?id=<?php echo $disease['disease_id']; ?>">Edit</a>
                        <a href="php/delete-disease.php?id=<?php echo $disease['disease_id']; ?>" onclick="return confirm('Are you sure you want to delete this disease?')">Delete</a>
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
