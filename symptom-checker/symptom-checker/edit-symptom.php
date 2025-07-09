<?php
// Include database connection
include_once "php/db.php";

// Initialize variables
$id = $_GET['id'] ?? null;
$name = '';

// Check if ID is provided
if ($id !== null) {
    // Prepare and execute SQL query to fetch symptom information
    $stmt = $conn->prepare("SELECT * FROM symptoms WHERE symptom_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if symptom exists
    if ($result->num_rows > 0) {
        // Fetch symptom information
        $row = $result->fetch_assoc();
        $name = $row['name'];
    } else {
        // Symptom not found, redirect to error page or handle accordingly
        echo '<script> alert("  Symptom not found "); </script>';
        exit;
    }

    // Close statement
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"] ?? '';

    // Prepare and execute SQL query to update symptom information
    $stmt = $conn->prepare("UPDATE symptoms SET `name` = ? WHERE symptom_id = ?");
    $stmt->bind_param("si", $name, $id);
    if($stmt->execute()){
        echo '<script> alert("  Symptom updated successfully "); location.href ="update-select-diseases.php?symptom_id= '.$id.' "; </script>';

    }else{
        echo '<script> alert("  Error updating symptom "); </script>';
    }
    
    // Close statement
    $stmt->close();
    exit;
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Symptom</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/m-s.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <header>
        <h1>Edit Symptom</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </main>

    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
