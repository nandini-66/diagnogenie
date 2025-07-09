<?php
// Include database connection
include_once "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (e.g., name of the symptom)
    $name = $_POST["name"]; // Assuming "name" is the name of the input field for the symptom name

    // Perform validation and sanitization as needed

    // Insert the new symptom into the symptoms table
    $sql = "INSERT INTO symptoms (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();

    // Get the ID of the newly added symptom
    $newSymptomID = $stmt->insert_id;

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect the user to select associated diseases for the newly added symptom
    header("Location: ../select-diseases.php?symptom_id=$newSymptomID");
    exit;
} else {
    // If the form is not submitted, redirect the user to the appropriate page
    header("Location: ../admin-dashboard.php"); // Replace "your-original-page.php" with the actual page URL
    exit;
}
?>
