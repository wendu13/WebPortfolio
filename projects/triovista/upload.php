<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {  // match account.php session check
    header("Location: login.php");
    exit;
}

$userEmail = $_SESSION['user']['email'];

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileSize = $_FILES['profile_pic']['size'];
    $fileType = $_FILES['profile_pic']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = 'uploads/profile_pics/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE email = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("ss", $dest_path, $userEmail);
            if ($stmt->execute()) {
                // Reload updated user info to session
                $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $userEmail);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 1) {
                    $_SESSION['user'] = $result->fetch_assoc(); // update session user with latest data
                }
                header("Location: account.php?upload=success");
                exit;
            } else {
                echo "Error updating profile picture in database.";
            }
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Upload failed. Allowed file types: " . implode(', ', $allowedfileExtensions);
    }
} else {
    echo "No file uploaded or upload error.";
}
?>
