<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once "db.php";

    // Get form data
    $login_username = $_POST["login_username"];
    $login_password = $_POST["login_password"];

    // Validate form data (you can add more validation as needed)
    if (empty($login_username) || empty($login_password)) {
        // Handle empty fields
        echo "Please fill in all fields.";
    } else {
        // Check if username or email exists
        $check_query = "SELECT * FROM users WHERE username = '$login_username' OR email = '$login_username'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) == 1) {
            // User exists, verify password
            $user_data = mysqli_fetch_assoc($check_result);
            $hashed_password = $user_data['password'];
            
            if (password_verify($login_password, $hashed_password)) {
                // Password is correct, login successful
                // Store user data in session for future use (optional)
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['username'] = $user_data['username'];

                // Redirect to the user dashboard or any other page
                header("Location: ../index.php");
                exit;
            } else {
                // Password is incorrect
                echo "Incorrect password. Please try again.";
            }
        } else {
            // User does not exist
            echo "User does not exist. Please register an account.";
        }
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to the login page if accessed directly without form submission
    header("Location: ../register.php");
    exit;
}
?>
