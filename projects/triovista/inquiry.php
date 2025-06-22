<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo "You must be logged in.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$message = $_POST['message'] ?? '';

if (empty($message)) {
    http_response_code(400);
    echo "Message is required.";
    exit;
}

$sql = "INSERT INTO inquiry (user_id, message, created_at) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $message);

if ($stmt->execute()) {
    // Redirect back to index.php after success
    header("Location: index.php");
    exit;
} else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
}
?>
