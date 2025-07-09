<?php
// Include database connection
include_once "db.php";

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID parameter
    $id = $_GET['id'];

    // Prepare and execute SQL query to delete the symptom
    $stmt = $conn->prepare("DELETE FROM symptoms WHERE symptom_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        // Redirect to view symptoms page or any other suitable page
        echo '<script>alert("deletion was successful"); location.href="../manage-symptoms.php";</script>';
        exit;
    } else {
        // Error occurred during deletion
        echo '<script>alert("Error: Unable to delete symptom. Please try again later."); location.href="../manage-symptoms.php";</script>';
    }

    // Close statement
    $stmt->close();
} else {
    // ID parameter is missing
    echo '<script>alert("Error: Missing ID parameter."); location.href="../manage-symptoms.php";</script>';
}

// Close database connection
$conn->close();
?>
