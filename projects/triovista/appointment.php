<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo "Not logged in.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$contact = htmlspecialchars(trim($_POST['contact'] ?? ''));
$preferred_date = $_POST['preferred_date'] ?? '';
$preferred_time = $_POST['preferred_time'] ?? '';

// Validate data
if (empty($contact) || empty($preferred_date) || empty($preferred_time)) {
    http_response_code(400);
    echo "Missing required fields.";
    exit;
}

// Prepare and execute query
$sql = "INSERT INTO appointment (user_id, contact, preferred_date, preferred_time, created_at)
        VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $contact, $preferred_date, $preferred_time);

if ($stmt->execute()) {
    echo "Success";
} else {
    http_response_code(500);
    echo "Error: " . $stmt->error;
}
?>
