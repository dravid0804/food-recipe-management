<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Login required";
    exit;
}

$recipe_id = $_POST['recipe_id'];
$user_id = $_SESSION['user_id'];
$action = $_POST['action']; // 'like' or 'dislike'

// Prevent duplicate likes
$conn->query("DELETE FROM recipe_likes WHERE recipe_id=$recipe_id AND user_id=$user_id");

$stmt = $conn->prepare("INSERT INTO recipe_likes (recipe_id, user_id, action) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $recipe_id, $user_id, $action);
$stmt->execute();
$stmt->close();

header("Location: public_recipes.php");
?>
