<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $birthday = $_POST['birthday'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            // Insert new user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, birthday, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fname, $lname, $email, $birthday, $hashed);

            if ($stmt->execute()) {
                $_SESSION['swal'] = [
                    'type' => 'success',
                    'title' => 'Registered!',
                    'text' => 'Your account has been created.',
                    'redirect' => 'login.php'
                ];
                header("Location: register.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!-- HTML FORM -->
<!DOCTYPE html>
<html>
<head>
    <title>Register | TrioVista</title>
    <link rel="stylesheet" href="css/auth.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div class="container">
<div class="left register-left">
    <div class="logo-wrapper">
        <img src="assets/NAVLOGO.png" alt="TrioVista Logo" class="logo-center">
    </div>
        <h2>Register</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="birthday" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required>

            <!-- Show Password Checkbox -->
            <div style="margin: 8px 0;">
                <input type="checkbox" id="showPassword" onclick="togglePassword()"> 
                <label for="showPassword">Show Password</label>
            </div>

            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
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
    // Set max date to 18 years ago from today
    window.onload = function() {
        const today = new Date();
        const year = today.getFullYear() - 18;
        const month = ('0' + (today.getMonth() + 1)).slice(-2);
        const day = ('0' + today.getDate()).slice(-2);
        const maxDate = `${year}-${month}-${day}`;
        document.querySelector('input[name="birthday"]').max = maxDate;
    };

    // Toggle password visibility
    function togglePassword() {
        const pw = document.getElementById("password");
        const confirm = document.getElementById("confirm");
        const type = pw.type === "password" ? "text" : "password";
        pw.type = type;
        confirm.type = type;
    }
</script>

<?php if (isset($_SESSION['swal']) && $_SESSION['swal']['type'] === 'success'): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: '<?= $_SESSION['swal']['type'] ?>',
        title: '<?= $_SESSION['swal']['title'] ?>',
        text: '<?= $_SESSION['swal']['text'] ?>',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= $_SESSION['swal']['redirect'] ?>'; // ✅ Goes to login.php
        }
    });
</script>
<?php unset($_SESSION['swal']); endif; ?>



</body>
</html>
