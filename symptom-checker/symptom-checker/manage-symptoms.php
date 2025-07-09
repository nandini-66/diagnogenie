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

// Fetch list of symptoms from the database
$query = "SELECT * FROM symptoms";
$result = mysqli_query($conn, $query);

// Check if there are any symptoms
if (mysqli_num_rows($result) > 0) {
    // Symptoms found, fetch and display them
    $symptoms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // No symptoms found
    $symptoms = [];
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Symptoms</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-s.css">
</head>
<body>
    <header>
        <h1>Manage Symptoms</h1>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <h2>Add Symptom</h2>
        <form action="php/add-symptom.php" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <button type="submit" class="btn">Add Symptom</button>
        </form>
        <h2>View Symptoms</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($symptoms as $symptom): ?>
                <tr>
                    <td><?php echo $symptom['name']; ?></td>
                    <td>
                        <a href="edit-symptom.php?id=<?php echo $symptom['symptom_id']; ?>">Edit</a>
                        <a href="php/delete-symptom.php?id=<?php echo $symptom['symptom_id']; ?>" onclick="return confirm('Are you sure you want to delete this symptom?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy;Diagnogenie.</p>
    </footer>
</body>
</html>
