<?php
// Include database connection
include_once "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if symptom ID and selected diseases are provided
    if (isset($_POST["symptom_id"]) && isset($_POST["diseases"])) {
        // Sanitize inputs
        $symptomID = $_POST["symptom_id"];
        $selectedDiseases = $_POST["diseases"];

        // Prepare SQL statement to insert selected diseases for the symptom into the disease_symptoms table
        $sql = "INSERT INTO disease_symptoms (disease_id, symptom_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement for each selected disease
        foreach ($selectedDiseases as $diseaseID) {
            $stmt->bind_param("ii", $diseaseID, $symptomID);
            $stmt->execute();
        }

        // Close statement
        $stmt->close();

        // Close database connection
        $conn->close();

        // Redirect back to the page where symptom was added
        header("Location: ../manage-symptoms.php"); // Replace "your-original-page.php" with the actual page URL
        exit;
    } else {
        // If required parameters are missing, redirect back to the previous page
        header("Location: ../manage-symptoms.php"); // Replace "your-original-page.php" with the actual page URL
        exit;
    }
} else {
    // If accessed directly without form submission, redirect back to the previous page
    header("Location: ../manage-symptoms.php"); // Replace "your-original-page.php" with the actual page URL
    exit;
}
?>
