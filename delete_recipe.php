<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM recipes WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Recipe deleted successfully!"]);
        } else {
            echo json_encode(["message" => "Error deleting recipe."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["message" => "Recipe ID is required."]);
    }
}

$conn->close();
?>
