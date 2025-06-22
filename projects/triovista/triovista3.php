<?php

session_start();

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/swiper@9nd/swiper-bule.min.css"  "stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/triovista.css">
  <link rel="stylesheet" href="css/style.css">
  <title>TrioVista Heights – Makati</title>
</head>
<body>
<!-- Fixed Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand text-logo" href="#">
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
        <h1>TrioVista Heights – Makati</h1>
        <p><i class="bi bi-geo-alt-fill me-1"></i>5 Jupiter St., Makati City, Metro Manila, Philippines</p>
      </div>
      <h3 class="section-heading mt-5">Image Gallery</h3>
      <div class="heading-underline"></div>
      <!-- Image Viewer -->
      <div class="position-relative d-flex justify-content-center align-items-center mt-0 mb-3">
        <button class="btn btn-sm position-absolute start-0 top-50 translate-middle-y ms-4" onclick="prevImage()">‹</button>
        <div class="image-frame">
          <!-- Main Image -->
        <img id="mainImage" src="assets/building/bldg3.jpg" style="width: 400px; height:350px; object-fit: cover; cursor:pointer;" onclick="openModal(this.src)" />
        </div>
        <button class="btn btn-sm position-absolute end-0 top-50 translate-middle-y me-4" onclick="nextImage()">›</button>
      </div>
      <!-- Thumbnails -->
      <div class="d-flex justify-content-center gap-2 flex-wrap mb-3 mt-3" id="thumbnails">
          <img src="assets/building/bldg3.jpg" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Unit/unit3.webp" class="thumbnail-img active" onclick="changeImage(this)" />
          <img src="assets/Unit/unit3a.webp" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Unit/unit3b.webp" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Amenities/amenitiesa.jpg" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Amenities/amenitiesw.jpg" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Amenities/amenitiesr.jpg" class="thumbnail-img" onclick="changeImage(this)" />
          <img src="assets/Location/location3.png" class="thumbnail-img" onclick="changeImage(this)" />
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
            <li></i> <i class="fa-solid fa-peso-sign"></i> 2,500,000</li>
            <li></i> <i class="fa-solid fa-peso-sign"></i> 15,000/month (5 years)</li>
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
                      <p>Monthly Rent: ₱15,000.00</p>
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
                          <div class="mb-2">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Enter your full name" required />
                          </div>
                          <div class="mb-2">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" placeholder="Enter your phone number" required />
                          </div>
                          <div class="mb-2">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required />
                          </div>
                          <div class="mb-2">
                            <label for="preferredDate" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="preferredDate" required />
                          </div>
                          <div class="mt-4 mb-2">
                            <label for="timeSlot" class="form-label ">Preferred Time</label>
                            <select  class="termyearsSelect" class="form-control" id="timeSlot" required>Select
                              <option selected disabled>Choose Timeslot</option>
                              <option value="10AM-11AM">10:00 AM - 11:00 AM</option>
                              <option value="10AM-11AM">03:00 PM - 04:00 PM</option>
                            </select>
                          </div>
                          <button type="submit" class="btn btn-outline-theme mt-3" id="apptSubmitBtn">Submit</button>
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
        <h5 class="modal-title">TrioVista Heights – Makati</h5>
        <button type="button" class="btn-close btn-close-dark" aria-label="Close" onclick="closeModal()"></button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="row g-4">
            <!-- LEFT: Text Content -->
            <div class="col-lg-7 pt-0">
              <p class="text-justify">
                Located in the heart of the metro’s financial and lifestyle district, <strong>TrioVista Heights – Makati</strong> 
                sits along the prestigious Jupiter Street. This upscale residential tower offers Trio sophistication, 
                with seamless connectivity to business centers, luxury dining, cultural venues, and public transit—perfect 
                for professionals, creatives, and modern families.
              </p>
              <hr class="my-4" />
              <!-- Amenities -->
              <h6 class="fw-semibold mb-3">Amenities</h6>
              <div class="row gy-2">
                <div class="col-6"><i class="bi bi-tree-fill me-2"></i>Private dog park</div>
                <div class="col-6"><i class="bi bi-droplet me-2"></i>Infinity swimming pool</div>
                <div class="col-6"><i class="bi bi-circle me-2"></i>Full-size basketball court</div>
                <div class="col-6"><i class="bi bi-camera-video me-2"></i>24/7 CCTV surveillance</div>
                <div class="col-6"><i class="bi bi-wifi me-2"></i>High-speed internet-ready</div>
                <div class="col-6"><i class="bi bi-building-check me-2"></i>Secure lobby with concierge</div>
              </div>
              <!-- Nearby Locations -->
              <h6 class="fw-semibold mt-4 mb-3">Nearby Landmarks</h6>
              <div class="row gy-2">
                  <div class="col-12"><i class="bi bi-briefcase me-2"></i>Makati Central Business District – 5 mins</div>
                <div class="col-12"><i class="bi bi-music-note-beamed me-2"></i>Rockwell Center – 4 mins</div>
                <div class="col-12"><i class="bi bi-bag me-2"></i>Century City Mall – 3 mins</div>
                <div class="col-12"><i class="bi bi-hospital me-2"></i>Makati Medical Center – 7 mins</div>
                <div class="col-12"><i class="bi bi-train-front me-2"></i>MRT Buendia Station – 6 mins</div>
              </div>
              <!-- Location -->
              <h6 class="fw-semibold mt-4 mb-2">Location</h6>
              <p class="text-justify mb-0">
                <strong>TrioVista Heights – Makati</strong><br />
                5 Jupiter St., Makati City, Metro Manila, Philippines
              </p>
            </div>
            <!-- RIGHT: Image -->
              <div class="col-lg-5 text-center">
              <img id="modalImage" src="" class="img-fluid rounded shadow" alt="TrioVista Heights – Makati" />
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="jscript/triovista.js"></script>
</body>
</html>
