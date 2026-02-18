<?php
include 'config.php';
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT COUNT(*) AS total FROM recipes WHERE user_id = $user_id");
$row = $result->fetch_assoc();
echo "<h3>You have posted " . $row['total'] . " recipes.</h3>";
