<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Condo Website</title>
<!-- Bootstrap CSS (latest version only) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
<!-- Swiper CSS (if you're using Swiper) -->
<link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet"/>
<!-- Bootstrap JS Bundle (latest version only) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="css/style.css">
  
</head>
<body>

  <!-- Fixed Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow" >
    <div class="container-fluid">
      <a class="navbar-brand text-logo" href="#"><img src="assets/NAVLOGO.png" alt="Triovista Logo"/>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item me-3"><a class="nav-link" href="#about">About Us</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="#location">Location</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="#amenities">Amenities</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="#blog">Blog</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="#contact">Contact Us</a></li>
          <li class="nav-item me-3"><a class="nav-link" href="account.php">Account</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <a id="top"></a>
  <!-- Hero Cover Section -->
  <section class="hero-cover">
    <div class="container-fluid p-0">
      <section style="margin-top: -80px;">
      <img src="assets/cover5.jpg" alt="Cover Image" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
    </section>
    </div>
  </section>

  <!-- About Us -->
  <section class="section" id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="assets/aboutus1.jpg" class="section-img" alt="About Image" />
        </div>
        <div class="col-md-6" style="text-align: justify;">
          <h2>About Us</h2>
          <p class="py-3">At Triovista, we believe your home should offer comfort, style, and convenience.
            As a trusted name in modern condominium living, we build thoughtfully designed communities 
            in prime city locations—blending elegant architecture, quality amenities, and smart planning. 
            <blockquote>
              Whether you’re starting fresh or investing for the future, Triovista is here to bring you home—where everything begins.
            </blockquote>
          </p>
        </div>
      </div>
    </div>
  </section>


<div class="top-barrier"></div>

<!-- Location -->
<section class="section bg-light" id="location">
  <div class="container">
    <div class="row align-items-center flex-row-reverse">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="assets/locationImage.jpg" class="section-img" alt="Location Image" />
      </div>
      <div class="col-md-6" style="text-align: justify;">
        <h2>Triovista’s Prime Locations</h2> 
        <p class="py-3">
          Live where it matters most. Triovista condominiums are perfectly positioned in the heart of 
          the city—offering unmatched access to workplaces, schools, lifestyle hubs, and transport terminals.
          Enjoy modern living with the convenience of everything just steps away.
        </p>

        <!-- Dropdown for Locations -->
        <div class="mt-4 mb-3">
          <select class="form-select" id="locationSelect">
            <option selected disabled>Choose a Location</option>
            <div class="option">
            <option value="triovista1.php">TrioVista Tower 1, 888 Aurora Blvd, Quezon City</option>
            <option value="triovista2.php">UrbanVista Residences, 21 Bayview St., Pasay City</option>
            <option value="triovista3.php">UrbanVista Heights, 5 Jupiter St., Makati City</option>
            <div class="text-danger small mt-1" id="locationError" style="display: none;">Please choose a location.</div>
          </div>
          </select>
        </div>
      <button class="btn btn-outline-theme" onclick="goToSelectedCondo()">View</button>
      </div>
    </div>
  </div>
</section>


<div class="top-barrier"></div>
  <!-- Amenities -->
<section class="section" id="amenities">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-6 mb-4 mb-lg-0">
        <div id="carouselExampleIndicators" style=" border-radius: 15px;" class="carousel slide carousel-fade" data-bs-ride="carousel">
          
          <div class="carousel-indicators" style=" border-radius: 15px;">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/Amenities/amenities01.jpg" class="d-block" alt="amenities1">
              <div class="carousel-caption d-none d-md-block">
                <h5>Outdoor terrace or rooftop garden</h5>
                <p>Enjoy breathtaking views and fresh air in our lush rooftop garden.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/Amenities/amenities2.jpg" class="d-block" alt="amenities2">
              <div class="carousel-caption d-none d-md-block">
                <h5>Water feature or decorative pond</h5>
                <p>Relax by a serene water feature that enhances the beauty of your surroundings.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/Amenities/amenities3.jpg" class="d-block" alt="amenities3">
              <div class="carousel-caption d-none d-md-block">
                <h5>Game room (BILLIARDS)</h5>
                <p>Challenge friends and unwind in our modern game room with billiards.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/Amenities/amenities4.jpg" class="d-block" alt="amenities4">
              <div class="carousel-caption d-none d-md-block">
                <h5>Party room</h5>
                <p>Celebrate special moments or sing your heart out in our fun-filled party space</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/Amenities/amenities05.jpg" class="d-block" alt="amenities5">
              <div class="carousel-caption d-none d-md-block">
                <h5>Daycare or childcare center</h5>
                <p> A safe and engaging space for children while parents enjoy peace of mind.</p>
              </div>
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>

        </div>
      </div>

      <div class="col-md-6 mb-4 mb-lg-0" style="text-align: justify;">
        <h2>Exceptional Amenities for Elevated Living</h2>
          <p class="py-3">Experience a lifestyle of comfort and convenience with our world-class amenities.
            From a refreshing pool and fully-equipped gym to serene gardens and entertainment spaces, everything you need is right at your doorstep. 
            Live, relax, and thrive in a community designed with you in mind.
          </p>
      </div>

    </div>
  </div>
</section>


<div class="top-barrier"></div>

<section id="blog" class="bg-light py-5">
  <div class="container" style="text-align: justify;">
    <div class="row g-4 align-items-start" >

      <!-- LEFT: Blog Posts (4 cards) -->
      <div class="col-12 col-lg-8">
        <h2 class="mb-4">Latest Blog Posts</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <!-- Blog Card 1 -->
          <div class="col">
            <div class="card h-100 shadow-sm blog-card">
              <img src="assets/blog/blog1.jpg" class="card-img-top" alt="Blog Image 1">
              <div class="card-body">
                <h5 class="card-title">5 Tips for First-Time Home Buyers</h5>
                <p class="card-text">Buying your first home? Here are some essential tips to help you navigate the process with confidence.</p>
              </div>
            </div>
          </div>
          <!-- Blog Card 2 -->
          <div class="col">
            <div class="card h-100 shadow-sm blog-card">
              <img src="assets//blog/blog2.jpg" class="card-img-top" alt="Blog Image 2">
              <div class="card-body">
                <h5 class="card-title">How to Choose the Right Condo</h5>
                <p class="card-text">Discover the top factors to consider when selecting a condo that suits your lifestyle and budget.</p>
              </div>
            </div>
          </div>
          <!-- Blog Card 3 -->
          <div class="col">
            <div class="card h-100 shadow-sm blog-card">
              <img src="assets/blog/blog3.jpg" class="card-img-top" alt="Blog Image 3">
              <div class="card-body">
                <h5 class="card-title">Top Real Estate Trends in 2025</h5>
                <p class="card-text">Get updated with the latest market trends and how they might impact your buying or selling decisions this year.</p>
              </div>
            </div>
          </div>
          <!-- Blog Card 4 -->
          <div class="col">
            <div class="card h-100 shadow-sm blog-card">
              <img src="assets/blog/blog4.jpg" class="card-img-top" alt="Blog Image 4">
              <div class="card-body">
                <h5 class="card-title">Understanding Mortgage Rates</h5>
                <p class="card-text">Learn how mortgage rates work and what you should know before locking in your home loan.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT: Reviews Carousel -->
      <div class="col-12 col-lg-4" style="text-align: justify;">
        <h3 class="mb-4 text-center">What Our Customers Say</h3>
       <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" style="padding:0 40px; max-width: 320px; margin:auto;">
        <div class="carousel-inner position-relative" style="height: 320px; overflow: hidden;">
          <div class="carousel-item active">
            <div class="review-card">
              <strong>Luis, 33</strong> <span class="text-muted">- March 12, 2025</span>
              <p>"Helpful checklist. It really guided me step-by-step on what to prepare."</p>
              <small class="text-secondary">Location: Manila, Philippines</small>
              <div class="text-icon fs-4 mt-2">★★★★☆</div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="review-card">
              <strong>Jessa, 27</strong> <span class="text-muted">- April 4, 2025</span>
              <p>"Great for first timers. Made the process stress-free and clear."</p>
              <small class="text-secondary">Location: Cebu City, Philippines</small>
              <div class="text-icon fs-4 mt-2">★★★★★</div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="review-card">
              <strong>Marco, 25</strong> <span class="text-muted">- May 1, 2025</span>
              <p>"Smart space tips helped me maximize my small condo space efficiently."</p>
              <small class="text-secondary">Location: Davao City, Philippines</small>
              <div class="text-icon fs-4 mt-2">★★★★☆</div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>

      </div>

    </div>
  </div>
</section>


<div class="top-barrier"></div>

<!-- Contact Us Section -->
<section class="section" id="contact">
  <h2 class="text-center pb-3">Have Questions? Let’s Talk!</h2>
  <div class="container">
    <div class="row justify-content-center gx-5">
      <div class="contact-info col-12 col-md-6  px-4 px-sm-5 my-3">
        <h2>Your Perfect Home Awaits — Find It With Ease!</h2>
        <p>Please fill-up our inquiry form for:</p>
        <ul class="inquiry-list">
          <li>☑ Your Inquiries</li>
          <li>☑ Schedule Showroom Visit</li>
          <li>☑ Quote Requests</li>
          <li>☑ Comments & Suggestions</li>
        </ul>
      </div>
      <div class="col-12 col-md-6 my-3">
        <div class="inquiry-box p-4">
          <h2>Send Inquiry</h2>
          <form action="inquiry.php" method="POST">
            <!-- Hidden Full Name -->
            <input type="hidden" name="name" value="<?= htmlspecialchars($fullname) ?>">
            
            <!-- Hidden Email -->
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

            <!-- Message Textarea -->
            <div class="mb-3">
              <textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea>
            </div>

            <button type="submit" class="btn btn-outline-theme">Submit Inquiry</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Footer Top Section -->
<section class="footer-top">
  <div class="container">
    <div class="row justify-content-center text-start text-md-start">

      <!-- Column 1 -->
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <h3>Contact Info.</h3>
        <p>
          TrioVista Consultants<br>
          In-House Property Consultant<br>
          Sales Group: Division 3<br>
          In-House ID Number: 38421<br>
          Mobile: (+63) 926-555-7843 (Globe/Viber/WhatsApp)<br>
          Business Hours: 9:00 AM – 6:00 PM<br><br>
          Office: Triovista Heights Sales Lounge<br>
          888 Skyline Avenue<br>
          New Metro City, Philippines.
        </p>
      </div>

      <!-- Column 2 -->
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <h3>Browse by Location.</h3>
        <p>
          <a href="triovista1.php" class="footer-link">UrbanVista Tower 1</a><br>
          <a href="triovista2.php" class="footer-link">UrbanVista Residences</a><br> 
          <a href="triovista3.php" class="footer-link">UrbanVista Heights</a><br>


        </p>
      </div>

      <!-- Column 3 -->
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <h3>Quick Links.</h3>
        <p>
          <a href="#location" class="footer-link">Home</a><br>
          <a href="#about" class="footer-link">About Us</a><br>
          <a href="#amenities" class="footer-link">Amenities</a><br>
          <a href="#contact" class="footer-link">Contact Us</a><br>
          <a href="policy.php" class="footer-link">Privacy and Terms</a>
        </p>
      </div>

    </div>
  </div>
</section>


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

<!-- MODALS FOR TERMS AND PRIVACY -->
<!-- Terms and Privacy Modal with Tabs -->
<div class="modal fade" id="policyTermsModal" tabindex="-1" aria-labelledby="policyTermsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Policies</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="policyTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy" type="button" role="tab" aria-controls="privacy" aria-selected="true">Privacy Policy</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="terms-tab" data-bs-toggle="tab" data-bs-target="#terms" type="button" role="tab" aria-controls="terms" aria-selected="false">Terms of Service</button>
          </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content pt-3" id="policyTabsContent">
          <div class="tab-pane fade show active" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
            <!-- Insert Privacy Content Here -->
            <p><strong>Effective Date:</strong> May 22, 2025</p>
            <p><strong>TrioVista Consultants</strong>... [privacy content]</p>
          </div>
          <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
            <!-- Insert Terms Content Here -->
            <p><strong>Effective Date:</strong> May 22, 2025</p>
            <p><strong>TrioVista Consultants</strong>... [terms content]</p>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-outline-theme" id="agreeBtnInsideModal">I Agree</button>
      </div>
    </div>
  </div>
</div>

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="thankYouLabel">Thank You!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You have accepted the Privacy Policy and Terms of Service.</p>
        <p>Redirecting to homepage...</p>
      </div>
    </div>
  </div>
</div>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="jscript/script.js"></script>
</body>
</html>
