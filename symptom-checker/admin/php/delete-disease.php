<?php
// Include the database connection
include "db.php";

// Check if the ID parameter is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID parameter from the URL
    $id = $_GET['id'];

    // Delete the disease record from the database
    $sql = "DELETE FROM diseases WHERE disease_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Disease deleted successfully."); location.href="../manage-diseases.php";</script>';
    } else {
        echo "Error deleting disease: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "ID parameter is missing in the URL.";
    exit;
}

// Close the database connection
$conn->close();
?>
