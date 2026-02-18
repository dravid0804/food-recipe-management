<?php
$host = "localhost"; // Change if using an external database server
$user = "root"; // Your database username
$pass = ""; // Your database password (leave empty for default XAMPP/MAMP setups)
$db = "recipe_db"; // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
