<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$userEmail = $_SESSION['user']['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($new_password) || empty($confirm_password)) {
        $error = "Please fill both password fields.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in DB
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $hashed_password, $userEmail);
        if ($stmt->execute()) {
            // Optional: update session user password (not recommended to store password in session)
            // Just show success message
            $_SESSION['swal'] = [
                'type' => 'success',
                'title' => 'Success',
                'text' => 'Password changed successfully.'
            ];
            header("Location: account.php");
            exit;
        } else {
            $error = "Failed to update password: " . $conn->error;
        }
    }
}

// If error occurs, you can store it in session or pass back to the form:
if (isset($error)) {
    $_SESSION['swal'] = [
        'type' => 'question',   // for question popup
        'title' => 'Password Changed',
        'text' => 'Do you want to stay logged in?',
        'showCancelButton' => true,
        'confirmButtonText' => 'Yes',
        'cancelButtonText' => 'No',
        'redirectOnCancel' => 'logout.php'  // custom key for redirect URL on No
    ];
    header("Location: account.php");
    exit;
}
?>
