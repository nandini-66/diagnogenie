<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once "php\db.php";

    // Get form data
    $login_username = $_POST["login_username"];
    $login_password = $_POST["login_password"];

    // Validate form data (you can add more validation as needed)
    if (empty($login_username) || empty($login_password)) {
        // Handle empty fields
        echo '<script> alert("Please fill in all fields."); </script>';
    } else {
        // Query to check if admin exists
        $query = "SELECT * FROM admins WHERE username = '$login_username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Admin exists, verify password
            $admin_data = mysqli_fetch_assoc($result);
            if ($admin_data['password'] == $login_password) {
                // Password is correct, set session variables
                $_SESSION['admin_id'] = $admin_data['admin_id'];
                $_SESSION['username'] = $admin_data['username'];

                // Redirect to admin dashboard or another page
                echo '<script> alert("Wellcome Admin!"); 
                location.href = "admin-dashboard.php";
                </script>';
                exit;
            } else {
                // Incorrect password
                echo '<script> alert("Incorrect password. Please try again."); </script>';
            }
        } else {
            // Admin does not exist
                echo '<script> alert("Admin not found. Please check your credentials."); </script>';
        }
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Show admin login form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/admin-login.css">
</head>
<body>
    <header>
        <h1>Admin Login</h1>
    </header>
    <?php include "nav.php"; ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="login_username">Username:</label><br>
            <input type="text" id="login_username" name="login_username" required><br>
            
            <label for="login_password">Password:</label><br>
            <input type="password" id="login_password" name="login_password" required><br>
            
            <button type="submit" class="btn">Login</button>
        </form>
    </main>

    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
<?php 
}

 ?>
