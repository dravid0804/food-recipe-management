<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $user_id = $_SESSION['username'] ?? null;

    if (!empty($title) && !empty($description) && !empty($user_id)) {
        $stmt = $conn->prepare("INSERT INTO recipes (title, description, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $user_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Recipe added."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add recipe."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Missing fields or not logged in."]);
    }
}

$conn->close();
?>
