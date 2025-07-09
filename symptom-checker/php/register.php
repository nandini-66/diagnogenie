<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once "db.php";

    // Get form data
    $username = $_POST["reg_username"];
    $email = $_POST["reg_email"];
    $password = $_POST["reg_password"];
    $full_name = $_POST["reg_full_name"];

    // Validate form data (you can add more validation as needed)
    if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
        // Handle empty fields
        echo "Please fill in all fields.";
    } else {
        // Check if username or email already exists
        $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Username or email already exists
            echo "Username or email already exists. Please choose a different one.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database
            $insert_query = "INSERT INTO users (username, email, password, full_name) VALUES ('$username', '$email', '$hashed_password', '$full_name')";
            
            if (mysqli_query($conn, $insert_query)) {
                // Registration successful
                echo "Registration successful. You can now <a href='login.php'>login</a>.";
            } else {
                // Error inserting user
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to the registration page if accessed directly without form submission
    header("Location: ../register.php");
    exit;
}
?>
