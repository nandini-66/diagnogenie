<?php
// Include the database connection
include "php/db.php";

// Check if the ID parameter is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID parameter from the URL
    $id = $_GET['id'];

    // Fetch the disease record from the database
    $sql = "SELECT * FROM diseases WHERE disease_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Disease record found, display the edit form
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
        $treatment_options = $row['treatment_options'];

        // Close the statement
        $stmt->close();
    } else {
        echo '<script> alert(" No disease found with the given ID. "); </script>';
        exit;
    }
} else {
    echo '<script> alert(" ID parameter is missing in the URL. "); </script>';
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $treatment_options = trim($_POST["treatment_options"]);

    // Update the disease record in the database
    $sql = "UPDATE diseases SET name = ?, description = ?, treatment_options = ? WHERE disease_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $treatment_options, $id);

    if ($stmt->execute()) {
        echo '<script> alert(" Disease updated successfully. "); </script>';
    } else {
        echo '<script> alert(" Error updating disease: "); </script>';
        echo " " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Disease</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/m-d.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Edit Disease</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
        <h2>Edit Disease Information</h2>
        <form action="" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required><?php echo $description; ?></textarea><br>
            
            <label for="treatment_options">Treatment Options:</label><br>
            <textarea id="treatment_options" name="treatment_options" required><?php echo $treatment_options; ?></textarea><br>
            
            <button type="submit" class="btn">Update Disease</button>
        </form>
    </main>

    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
