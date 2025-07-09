<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Validate form data (you can add more validation as needed)
    if (empty($name) || empty($email) || empty($message)) {
        // Handle empty fields
        echo "Please fill in all fields.";
    } else {
        // Insert feedback into the database
       include "db.php";

        // Prepare and execute SQL statement to insert feedback
        $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);
        
        if ($stmt->execute()) {
            echo "<h2>Thank you for your feedback, $name!</h2>";
            echo "<p>We appreciate your input.</p>";
            echo "<a href ='../feedback.php'> Click To Back </a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
} else {
    // Redirect to the feedback page if accessed directly without form submission
    header("Location: ../feedback.php");
    exit;
}
?>
