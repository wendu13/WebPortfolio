<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['user']['email'];

$stmt = $conn->prepare("SELECT id, fname, lname, email, birthday, profile_pic, created_at FROM users WHERE email = ?");
if (!$stmt) {
    die("Prepare failed for user query: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$userId = $user['id'];

$stmt = $conn->prepare("SELECT appointment.created_at, appointment.contact, appointment.preferred_date, appointment.preferred_time 
                        FROM appointment 
                        WHERE appointment.user_id = ? 
                        ORDER BY appointment.created_at DESC");
if (!$stmt) {
    die("Prepare failed for appointment query: " . $conn->error);
}
$stmt->bind_param("i", $userId);
$stmt->execute();
$appointments = $stmt->get_result();

$stmt = $conn->prepare("SELECT inquiry.created_at, inquiry.message 
                        FROM inquiry 
                        WHERE inquiry.user_id = ? 
                        ORDER BY inquiry.created_at DESC");
if (!$stmt) {
    die("Prepare failed for inquiry query: " . $conn->error);
}
$stmt->bind_param("i", $userId);
$stmt->execute();
$inquiries = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Account | TrioVista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
  <!-- Fixed Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand text-logo" href="index.php">
        <img src="assets/NAVLOGO.png" alt="Triovista Logo"/>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item me-3"><a class="nav-link" href="index.php#about">About Us</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="index.php#location">Location</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="index.php#amenities">Amenities</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="index.php#blog">Blog</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="index.php#contact">Contact Us</a></li>
          <li class="nav-item me-3"><a class="nav-link active" href="account.php">Account</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="account-container">
    <!-- LEFT SIDE -->
    <div class="account-left">
        <div class="account-section">
            <h2>Appointment History</h2>
            <div class="details-box table-container">
                <table class="table table-striped fixed-header">
                    <thead>
                        <tr>
                            <th>Date Created</th>
                            <th>Contact</th>
                            <th>Preferred Date</th>
                            <th>Preferred Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $appointments->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td><?= htmlspecialchars($row['contact']) ?></td>
                            <td><?= htmlspecialchars($row['preferred_date']) ?></td>
                            <td><?= htmlspecialchars($row['preferred_time']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if ($appointments->num_rows === 0): ?>
                        <tr><td colspan="4">No appointment history found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="account-section">
            <h2>Inquiry History</h2>
            <div class="details-box table-container">
                <table class="table table-striped fixed-header">
                    <thead>
                        <tr>
                            <th>Date Created</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $inquiries->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if ($inquiries->num_rows === 0): ?>
                        <tr><td colspan="2">No inquiry history found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Logout button outside the sections, always visible at bottom -->
        <div class="logout-container">
            <form action="logout.php" method="post">
                <button class="btn btn-danger logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>


    <!-- RIGHT SIDE -->
    <div class="account-right" style="min-width: 320px; max-width: 380px;">
        <img src="<?= htmlspecialchars($user['profile_pic'] ?? 'assets/default-user.png') ?>" alt="Profile Picture" class="profile-pic rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">

        <form class="profile-form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="profile_pic" accept="image/*" required>
            <button type="submit" class="btn btn-primary mt-2 w-100">Update Profile Picture</button>
        </form>

        <form class="profile-form mt-4">
            <label>Full Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?>" readonly>

            <label class="mt-3">Email</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>

            <label class="mt-3">Birthday</label>
            <input type="date" class="form-control" value="<?= htmlspecialchars($user['birthday']) ?>" readonly>
        </form>

        <form class="profile-form mt-4" action="change_password.php" method="post">
        <label>New Password</label>
        <input type="password" class="form-control" name="new_password" id="new_password" required>

        <label class="mt-3">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
        
        <div class="show-password-wrapper">
            <input type="checkbox" id="showPassword" />
            <label for="showPassword">Show Password</label>
        </div>

        <button type="submit" class="btn btn-success mt-2 w-100">Change Password</button>
            </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if (isset($_SESSION['swal'])): ?>
  Swal.fire({
    icon: <?= json_encode($_SESSION['swal']['type']) ?>,
    title: <?= json_encode($_SESSION['swal']['title']) ?>,
    text: <?= json_encode($_SESSION['swal']['text']) ?>,
    showCancelButton: <?= isset($_SESSION['swal']['showCancelButton']) && $_SESSION['swal']['showCancelButton'] ? 'true' : 'false' ?>,
    confirmButtonText: <?= json_encode($_SESSION['swal']['confirmButtonText'] ?? 'OK') ?>,
    cancelButtonText: <?= json_encode($_SESSION['swal']['cancelButtonText'] ?? 'Cancel') ?>,
    allowOutsideClick: false,
    allowEscapeKey: false,
  }).then((result) => {
    if (result.isConfirmed) {
      // User clicked Yes - do nothing (stay logged in)
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // User clicked No - redirect to logout
      window.location.href = <?= json_encode($_SESSION['swal']['redirectOnCancel'] ?? 'logout.php') ?>;
    }
  });
<?php unset($_SESSION['swal']); endif; ?>

function toggleChangePassword() {
    const newPw = document.getElementById('new_password');
    const confirmPw = document.getElementById('confirm_password');
    const type = newPw.type === 'password' ? 'text' : 'password';
    newPw.type = type;
    confirmPw.type = type;
}

const showPasswordCheckbox = document.getElementById('showPassword');
const newPasswordInput = document.getElementById('new_password');
const confirmPasswordInput = document.getElementById('confirm_password');

showPasswordCheckbox.addEventListener('change', function() {
  const type = this.checked ? 'text' : 'password';
  newPasswordInput.type = type;
  confirmPasswordInput.type = type;
});

</script>

</body>
</html>
