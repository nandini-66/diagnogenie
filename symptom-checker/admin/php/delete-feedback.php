<?php
// Include the database connection
include "db.php";

// Check if the ID parameter is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID parameter from the URL
    $id = $_GET['id'];

    // Delete the feedback record from the database
    $sql = "DELETE FROM feedback WHERE feedback_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Feedback deleted successfully."); location.href="../manage-user-feedback.php";</script>';
    } else {
        echo "Error deleting feedback: " . $conn->error;
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
