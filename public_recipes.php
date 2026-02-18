<?php
include 'config.php';
$sql = "SELECT r.*, u.username FROM recipes r JOIN users u ON r.user_id = u.id ORDER BY r.id DESC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<div class="recipe-item"><h4>' . htmlspecialchars($row['title']) . ' <small>by ' . htmlspecialchars($row['username']) . '</small></h4><p>' . htmlspecialchars($row['description']) . '</p></div>';
}
