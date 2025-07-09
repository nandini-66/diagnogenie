<?php
// Include the database connection
include "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $treatment_options = trim($_POST["treatment_options"]);

    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $treatment_options = mysqli_real_escape_string($conn, $treatment_options);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO diseases (name, description, treatment_options) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $treatment_options);

    if ($stmt->execute()) {
        echo '<script>alert("Disease added successfully."); location.href="../manage-diseases.php";</script>';
    } else {
        echo '<script>alert("Failed to add disease."); location.href="../manage-diseases.php";'.$conn->error.'</script>';
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect if accessed directly
    header("Location: index.php");
    exit;
}

// Close the database connection
$conn->close();
?>
