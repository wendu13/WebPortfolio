<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'fname' => $row['fname'],
                'lname' => $row['lname'],
                'email' => $row['email']
            ];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}

?>

<!-- HTML FORM -->
<!DOCTYPE html>
<html>
<head>
    <title>Login | TrioVista</title>
    <link rel="stylesheet" href="css/auth.css">

</head>
<body>
<div class="container">
    <div class="left">
        <div class="logo-wrapper">
            <img src="assets/NAVLOGO.png" alt="TrioVista Logo" class="logo-center">
        </div>
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <label><input type="checkbox" onclick="togglePassword()"> Show Password</label>
            <button type="submit">Login</button>
            <p><a href="forgot.php">Forgot Password?</a></p>
            <p>No account yet? <a href="register.php">Register</a></p>
        </form>
    </div>
    <div class="right">
        <div class="intro-text">
            <h1>Welcome!</h1>
            <p>TrioVista Heights is a dynamic real estate web platform that showcases ten premier condominium buildings. 
                Designed to make urban home-hunting seamless, this site provides in-depth details about each property, 
                with tools to help users explore, compare, and decide—whether they’re renting or buying.</p>
        </div>
        <div class="slideshow">
        <img id="slide" src="assets/slideshow/unit1.webp">
        </div>
    </div>
</div>
<script src="jscript/slideshow.js"></script>
<script>
function togglePassword() {
    var input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>
</body>
</html>
