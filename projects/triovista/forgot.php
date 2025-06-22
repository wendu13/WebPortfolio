<?php
session_start();
require 'db.php';

$step = 1;  // 1 = ask email + bday, 2 = set new password, 3 = success
$error = '';
$success = '';

// Step 1: User submits email + birthday (MMDDYY) to verify identity
if (isset($_POST['check'])) {
    $email = trim($_POST['email']);
    $mmddyy = trim($_POST['mmddyy']); // Expect 6-digit string MMDDYY

    // Query user by email, format stored birthday to MMDDYY
    $sql = "SELECT id, DATE_FORMAT(birthday,'%m%d%y') AS bday6 FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row && $row['bday6'] === $mmddyy) {
        // Birthday matches - allow password reset
        $_SESSION['reset_email'] = $email;
        $step = 2;
    } else {
        $error = "E-mail and birthday do not match our records.";
    }
}

// Step 2: User sets a new password
if (isset($_POST['reset'])) {
    if (!isset($_SESSION['reset_email'])) {
        header('Location: forgot.php');
        exit;
    }

    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
        $step = 2;
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password=? WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hash, $_SESSION['reset_email']);
        if ($stmt->execute()) {
            unset($_SESSION['reset_email']);
            $success = "Password updated! You may now log in.";
            $step = 3;
        } else {
            $error = "Error updating password, please try again.";
            $step = 2;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Forgot Password | TrioVista</title>
<link rel="stylesheet" href="css/auth.css"/>
</head>
<body>
<div class="container">
  <div class="left">
    <div class="logo-wrapper">
      <img src="assets/NAVLOGO.png" alt="TrioVista Logo" class="logo-center">
    </div>

    <?php if ($error): ?>
      <p class="error"><?=htmlspecialchars($error)?></p>
    <?php endif; ?>
    <?php if ($success): ?>
      <p class="success" style="color:green;"><?=htmlspecialchars($success)?></p>
    <?php endif; ?>

    <?php if ($step === 1): ?>
      <h2>Password Reset</h2>
      <form method="post">
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="text" name="mmddyy" placeholder="Birthday (MMDDYY)" maxlength="6" pattern="\d{6}" required />
        <button type="submit" name="check">Verify Birthday</button>
      </form>
      <p><a href="login.php">Back to Login</a></p>

    <?php elseif ($step === 2): ?>
      <h2>Set New Password</h2>
      <form method="post">
        <input type="password" id="password" name="password" placeholder="New Password" required />
        <input type="password" id="confirm_password" name="confirm" placeholder="Confirm Password" required />
        <label><input type="checkbox" onclick="togglePassword()"> Show Password</label>
        <button type="submit" name="reset">Save Password</button>
      </form>

      <script>
        function togglePassword() {
          ['password', 'confirm_password'].forEach(function(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
          });
        }
      </script>

    <?php else: ?>
      <h2>Success!</h2>
      <p>Your password has been updated.</p>
      <!-- Back to login as button -->
      <form action="login.php" method="get" style="margin-top: 12px;">
        <button type="submit" class="back-to-login-btn">Back to Login</button>
      </form>
    <?php endif; ?>
  </div>

  <div class="right">
    <div class="intro-text">
      <h1>Welcome!</h1>
        <p>TrioVista Heights is a dynamic real estate web platform that showcases ten premier condominium buildings. 
          Designed to make urban home-hunting seamless, this site provides in-depth details about each property, 
          with tools to help users explore, compare, and decide—whether they’re renting or buying.</p>
    </div>
    <div class="slideshow">
      <img id="slide" src="assets/slideshow/unit1.webp" alt="Condo unit slideshow">
    </div>
  </div>
</div>

<script src="jscript/slideshow.js"></script>
</body>
</html>
