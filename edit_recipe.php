<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (!empty($id) && !empty($title) && !empty($description)) {
        $stmt = $conn->prepare("UPDATE recipes SET title=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $description, $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Recipe updated successfully!"]);
        } else {
            echo json_encode(["message" => "Error updating recipe."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["message" => "All fields are required."]);
    }
}

$conn->close();
?>
