<?php
session_start();
include 'config.php';

$user_id = $_SESSION['username'] ?? null;

if (!$user_id) {
    echo '<p>Please log in to view your recipes.</p>';
    exit;
}

$stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="recipe-item">
                <h4>' . htmlspecialchars($row['title']) . '</h4>
                <p>' . htmlspecialchars($row['description']) . '</p>
                <p class="posted-by"><strong>You posted this.</strong></p>
                <button class="editRecipe" data-id="' . $row['id'] . '" data-title="' . htmlspecialchars($row['title']) . '" data-description="' . htmlspecialchars($row['description']) . '">✏️ Edit</button>
                <button class="deleteRecipe" data-id="' . $row['id'] . '">🗑️ Delete</button>
              </div>';
    }
} else {
    echo '<p>No recipes found.</p>';
}

$stmt->close();
$conn->close();
?>
