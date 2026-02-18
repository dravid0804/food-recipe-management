<?php
include "config.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Prepare SQL Query to Insert Data
    $stmt = $conn->prepare("INSERT INTO queries (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Your query has been submitted successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error submitting your query. Please try again!'); window.location.href='contact.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
