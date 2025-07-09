<?php 
// Connect to your database (replace placeholders with actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "symptoms_checker_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>