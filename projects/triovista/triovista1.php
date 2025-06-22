<?php
session_start();
if (!isset($_SESSION['user'])) {
  // Redirect to login page if not logged in
  header('Location: login.php');
  exit();
}

// Get user info from session
$fname = $_SESSION['user']['fname'];
$lname = $_SESSION['user']['lname'];
$email = $_SESSION['user']['email'];
$user_id = $_SESSION['user']['id'];
$fullname = trim($fname . ' ' . $lname);


$purchasePrice = 2500000;
$annualTaxes = $purchasePrice * 0.02;
$termOptions = range(1, 10);

// Initialize variables with defaults or from POST
$termYears = 0;
$downPaymentAmount = 0;
$interestRate = 6.5;
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get inputs safely
    $termYears = isset($_POST['termYears']) ? intval($_POST['termYears']) : 0;
    $downPaymentAmount = isset($_POST['downPaymentAmount']) ? floatval($_POST['downPaymentAmount']) : 0;
    $interestRate = isset($_POST['interestRate']) ? floatval($_POST['interestRate']) : 6.5;

    // Calculation
    $loanAmount = $purchasePrice - $downPaymentAmount;
    $monthlyInterestRate = ($interestRate / 100) / 12;
    $totalMonths = $termYears * 12;

    if ($monthlyInterestRate > 0) {
        $monthlyPrincipalInterest = $loanAmount *
          ($monthlyInterestRate * pow(1 + $monthlyInterestRate, $totalMonths)) /
          (pow(1 + $monthlyInterestRate, $totalMonths) - 1);
    } else {
        $monthlyPrincipalInterest = $loanAmount / $totalMonths;
    }

    $monthlyTaxes = $annualTaxes / 12;
    $monthlyPayment = $monthlyPrincipalInterest + $monthlyTaxes;

    $result = [
        'downPaymentAmount' => $downPaymentAmount,
        'loanAmount' => $loanAmount,
        'monthlyPrincipalInterest' => $monthlyPrincipalInterest,
        'monthlyTaxes' => $monthlyTaxes,
        'monthlyPayment' => $monthlyPayment,
    ];

    // Save result and inputs to session
    $_SESSION['result'] = $result;
    $_SESSION['termYears'] = $termYears;
    $_SESSION['downPaymentAmount'] = $downPaymentAmount;
    $_SESSION['interestRate'] = $interestRate;

    // Redirect to clear POST data and avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// On GET, load from session if available, then clear
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];
    $termYears = $_SESSION['termYears'];
    $downPaymentAmount = $_SESSION['downPaymentAmount'];
    $interestRate = $_SESSION['interestRate'];

    unset($_SESSION['result'], $_SESSION['termYears'], $_SESSION['downPaymentAmount'], $_SESSION['interestRate']);
}

// Down payment percentage for display
$downPaymentPercent = ($purchasePrice > 0) ? ($downPaymentAmount / $purchasePrice) * 100 : 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Bootstrap 5.3.3 CSS (latest version only) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
<!-- Swiper CSS -->
<link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet" />
<!-- Flatpickr CSS (only once) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

  <link rel="stylesheet" href="css/triovista.css">
  <link rel="stylesheet" href="css/style.css">
  <title>TrioVista Tower 1</title>
</head>
<body>
<!-- Fixed Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand text-logo" href="index.php">
      <img src="assets/NAVLOGO.png" alt="Triovista Logo" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item me-3"><a class="nav-link" href="index.php#about">About Us</a></li>
        <li class="nav-item me-3 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="locationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Location
          </a>
          <ul class="dropdown-menu" aria-labelledby="locationDropdown">
            <li><a class="dropdown-item" href="triovista1.php">TrioVista Tower 1</a></li>
            <li><a class="dropdown-item" href="triovista2.php">TrioVista Residences</a></li>
            <li><a class="dropdown-item" href="triovista3.php">TrioVista Heights</a></li>
            <li><a class="dropdown-item" href="triovista4.php">TrioVista Green</a></li>
            <li><a class="dropdown-item" href="triovista5.php">TrioVista Prime</a></li>
            <li><a class="dropdown-item" href="triovista6.php">TrioVista Oasis</a></li>
            <li><a class="dropdown-item" href="triovista7.php">TrioVista Skyline</a></li>
            <li><a class="dropdown-item" href="triovista8.php">TrioVista Parklane</a></li>
            <li><a class="dropdown-item" href="triovista9.php">TrioVista Central</a></li>
            <li><a class="dropdown-item" href="triovista10.php">TrioVista Ridge</a></li>
          </ul>
        </li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php#amenities">Amenities</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php#blog">Blog</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php#contact">Contact Us</a></li>
                  <li class="nav-item me-3"><a class="nav-link" href="account.php">Account</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main Section -->
<div class="container border rounded shadow-sm px-0">
  <div class="row">
    <!-- Left Column -->
    <div class="col-lg-8 mb-4">
      <!-- Dropdown -->
      <div class="heading1 mb-2 px-2">
        <h1>TrioVista Tower 1</h1>
        <p><i class="bi bi-geo-alt-fill me-1"></i>888 Aurora Blvd, Quezon City,  Metro Manila, Philippines</p>
      </div>
      <h3 class="section-heading mt-5">Image Gallery</h3>
      <div class="heading-underline"></div>
      <!-- Image Viewer -->
      <div class="position-relative d-flex justify-content-center align-items-center mt-0 mb-3">
        <button class="btn btn-sm position-absolute start-0 top-50 translate-middle-y ms-4" onclick="prevImage()">‹</button>
        <div class="image-frame">
          <!-- Main Image -->
        <img id="mainImage" src="assets/building/bldg1.jpg" style="width: 400px; height:350px; object-fit: cover; cursor:pointer;" onclick="openModal(this.src)" />
        </div>
        <button class="btn btn-sm position-absolute end-0 top-50 translate-middle-y me-4" onclick="nextImage()">›</button>
      </div>
      <!-- Thumbnails -->
      <div class="d-flex justify-content-center gap-2 flex-wrap mb-3 mt-3" id="thumbnails">
        <img src="assets/building/bldg1.jpg" class="thumbnail-img active" onclick="changeImage(this)" />
        <img src="assets/Unit/unit1.webp" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Unit/unit1a.webp" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Unit/unit1b.webp" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Unit/unit1c.webp" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Unit/unit1d.webp" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Amenities/amenities6.jpg" class="thumbnail-img" onclick="changeImage(this)" />
        <img src="assets/Location/location1.png" class="thumbnail-img" onclick="changeImage(this)" />
      </div>
    </div>

<!-- Right Column -------------------->
<div class="col-lg-4 mb-4">
  <div class="right-container">
      <!-- Description-->
    <div class="condo-card">
      <h3 class="section-heading">Description</h3>
        <div class="heading-underline"></div>
          <h5>Easy Terms Available</h5>
          <ul class="condo-info">
            <li><i class="fa-solid fa-door-open"></i> Studio Unit (25 sqm)</li>
            <li></i> <i class="fa-solid fa-peso-sign"></i> 2,500,000 (Unit)</li>
            <li></i> <i class="fa-solid fa-peso-sign"></i> 15,000/month (Rent/Monthly)</li>
          </ul>
        </div>

      <!-- Mortgage Calculator -->
      <div class="appointment">
       <button class="btn btn-outline-theme w-100 mt-4" type="button"
          data-bs-toggle="collapse" data-bs-target="#mortgageCalculator"
          aria-expanded="<?= $result ? 'true' : 'false' ?>"
          onclick="resetMortgageForm()">
          <h4>Mortgage Calculator</h4>
        </button>
        <div class="collapse mt-2 <?= $result ? 'show' : '' ?>" id="mortgageCalculator">
        <?php if ($result): ?>
          <div class="position-relative mb-3" style="max-width: 400px;">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="mb-0">Computation Result</h3>
                <button onclick="toggleResult()" id="toggleBtn" class="btn p-0 bg-transparent border-0" style="font-size: 1.1rem; line-height: 1;">
                  <i class="bi bi-chevron-up"></i>
                </button>
                  </div>
                  <div id="resultDetails" style="display: block;">
                    <div id="printableArea" class="mt-2">
                      <p><strong>Unit Price:</strong> ₱<?= number_format($purchasePrice, 2) ?></p>
                      <p><strong>Downpayment:</strong> ₱<?= number_format($result['downPaymentAmount'], 2) ?> (<?= number_format($downPaymentPercent, 2) ?>%)</p>
                      <p><strong>Loan Amount:</strong> ₱<?= number_format($result['loanAmount'], 2) ?></p>
                      <p><strong>Annual Interest Rate:</strong> <?= number_format($interestRate, 2) ?>%</p>
                      <p><strong>Monthly Principal & Interest:</strong> ₱<?= number_format($result['monthlyPrincipalInterest'], 2) ?></p>
                      <p><strong>Monthly Taxes:</strong> ₱<?= number_format($result['monthlyTaxes'], 2) ?></p>
                      <p><strong>Total Monthly Payment:</strong> ₱<?= number_format($result['monthlyPayment'], 2) ?></p>
                      <button onclick="printComputation()" class="btn btn-outline-theme mt-2">Print Result</button>
                      <hr class="mt-3">
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <form method="POST">
                  <h5><strong>Unit Price: ₱<?= number_format($purchasePrice, 2) ?></strong></h5>
                      <label for="downPaymentAmount">Downpayment:</label>
                      <input type="range" id="downPaymentAmount" name="downPaymentAmount"
                        min="0" max="<?= $purchasePrice ?>" step="50000"
                        value="<?= $downPaymentAmount ?>" oninput="document.getElementById('dpDisplay').innerText = '₱' + parseInt(this.value).toLocaleString()">
                      <span id="dpDisplay">₱<?= number_format($downPaymentAmount, 0) ?></span>
                      <br>
                      <br>
                      <div class="mt-4 mb-2">
                        <label for="termYears">Term (Years):</label>
                        <select class="termyearsSelect" name="termYears" required>
                          <option disabled selected value="">Select term</option>
                            <?php foreach ($termOptions as $term): ?>
                              <option value="<?= $term ?>" <?= $term == $termYears ? 'selected' : '' ?>><?= $term ?> year(s)</option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                      <br>
                      <button type="submit" class="btn btn-outline-theme" id="computeBtn" disabled>Compute</button>
                    </form>
                  </div>
                </div>

                 <!-- Appointment Booking -->
                <div class="container mt-4">
                  <button class="btn btn-outline-theme w-100" type="button" data-bs-toggle="collapse" data-bs-target="#appointmentSection">
                    <h4>Book an Appointment</h4>
                  </button>

                  <div class="collapse mt-2" id="appointmentSection">
                    <div class="appoint-box card-body">
                      <div class="appointment">
                        <form id="appointmentForm">
                          <!-- Full Name (readonly) -->
                          <div class="mb-2">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($fullname) ?>" readonly>
                          </div>

                          <!-- Contact Number -->
                          <div class="mb-2">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" name="contact"
                              placeholder="Enter your phone number" required />
                          </div>

                          <!-- Email Address (readonly) -->
                          <div class="mb-2">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" readonly>
                          </div>

                          <!-- Preferred Date -->
                          <div class="mb-2">
                            <label for="preferredDate" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="preferredDate" name="preferred_date" required />
                          </div>

                          <!-- Preferred Time -->
                          <div class="mt-4 mb-2">
                            <label for="timeSlot" class="form-label">Preferred Time</label>
                            <select class="form-control" id="timeSlot" name="preferred_time" required>
                              <option value="" disabled selected>Choose Timeslot</option>
                              <option value="10AM-11AM">10:00 AM - 11:00 AM</option>
                              <option value="3PM-4PM">03:00 PM - 04:00 PM</option>
                            </select>
                          </div>

                          <button type="submit" id="apptSubmitBtn" class="btn btn-outline-theme mt-3">Submit</button>
                        </form>

                        <!-- Confirmation message -->
                        <div id="confirmationMsg" class="mt-3 d-none mb-3">
                          <h5>Appointment Confirmed!</h5>
                          <p><strong>Agent Name:</strong> Maria Santos</p>
                          <p><strong>Contact:</strong> 0917-123-4567</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- End Right Column -->
              </div>
            </div>
          </div>                        
<!-- Footer -->
<footer class="footer-wrapper">
  <div class="container">
    <!-- LEFT: Social Icons in a row -->
    <div class="social-icons">
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-pinterest"></i></a>
      <a href="#"><i class="bi bi-envelope"></i></a>
      <a href="#"><i class="bi bi-linkedin"></i></a>
    </div>
    <!-- RIGHT: Footer Text -->
    <div class="footer-container">
      <h5>© TRIOVISTA HEIGHTS | All Right Reserved 2025</h5>
      <small>Materials like Images/Photos used here are for marketing purposes only.</small>
      <small>No copyright infringement intended.
        <strong>T R I O V I S T A . P H</strong> is the official website.
      </small>
    </div>
  </div>
</footer>

<!-- PLEASE, DONT ERASE PO--BOOTSTRAP MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content gradient-bg text-light">
      <div class="modal-header border-0">
        <h5 class="modal-title">TrioVista Tower 1 - Aurora Boulevard</h5>
        <button type="button" class="btn-close btn-close-dark" aria-label="Close" onclick="closeModal()"></button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="row g-4">
            <!-- LEFT: Text Content -->
            <div class="col-lg-7 pt-0">
              <p class="text-justify">
                Situated in the vibrant center of the city, <strong>TrioVista Tower 1 - Aurora Boulevard</strong> is a modern 
                residential enclave located along Aurora Boulevard. This contemporary development offers 
                unparalleled access to public transport, shopping malls, universities, and essential services—perfect 
                for professionals and families alike.
              </p>
              <hr class="my-4" />
              <!-- Amenities -->
              <h6 class="fw-semibold mb-3">Amenities</h6>
              <div class="row gy-2">
                <div class="col-6"><i class="bi bi-droplet me-2"></i>Swimming pool with sun deck</div>
                <div class="col-6"><i class="bi bi-heart-pulse me-2"></i>Fitness gym</div>
                <div class="col-6"><i class="bi bi-tree me-2"></i>Landscaped gardens</div>
                <div class="col-6"><i class="bi bi-people me-2"></i>Function & co-working rooms</div>
                <div class="col-6"><i class="bi bi-emoji-smile me-2"></i>Children’s play area</div>
                <div class="col-6"><i class="bi bi-shield-lock me-2"></i>24/7 Security & CCTV</div>
              </div>
              <!-- Nearby Locations -->
              <h6 class="fw-semibold mt-4 mb-3">Nearby Landmarks</h6>
              <div class="row gy-2">
                <div class="col-12"><i class="bi bi-mortarboard me-2"></i>Ateneo de Manila University – 10 mins</div>
                <div class="col-12"><i class="bi bi-bag me-2"></i>Gateway Mall – 5 mins</div>
                <div class="col-12"><i class="bi bi-train-front me-2"></i>LRT 2 Anonas Station – 3 mins</div>
                <div class="col-12"><i class="bi bi-hospital me-2"></i>World Citi Medical Center – 6 mins</div>
                <div class="col-12"><i class="bi bi-bus-front me-2"></i>Transport Terminals – Walking distance</div>
              </div>
              <!-- Location -->
              <h6 class="fw-semibold mt-4 mb-2">Location</h6>
              <p class="text-justify mb-0">
                <strong>TrioVista Tower 1</strong><br />
                Aurora Boulevard, Quezon City, Metro Manila, Philippines
              </p>
            </div>
            <!-- RIGHT: Image -->
              <div class="col-lg-5 text-center">
              <img id="modalImage" src="" class="img-fluid rounded shadow" alt="TrioVista Tower 1" />
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="jscript/triovista.js"></script>
  <!-- JavaScript for AJAX -->
<script>
  document.getElementById('appointmentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('appointment.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      console.log('Server response:', data); // This will help you see errors from PHP
      if (data.trim() === "Success") {
        document.getElementById('appointmentForm').classList.add('d-none');
        document.getElementById('confirmationMsg').classList.remove('d-none');
      } else {
        alert("Error: " + data);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert("There was an error submitting your appointment. Please try again.");
    });
  });

</script>
</body>
</html>
