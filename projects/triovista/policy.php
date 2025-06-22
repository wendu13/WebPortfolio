<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC&family=Figtree&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/policy.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Privacy & Terms</title>
</head>
<body>

  <!-- Navigation buttons -->
  <div class="nav-buttons" role="tablist" aria-label="Privacy and Terms navigation">
    <button type="button" id="btnPrivacy" class="active" aria-selected="true" aria-controls="privacyContent" role="tab" tabindex="0" title="Privacy Policy"></button>
    <button type="button" id="btnTerms" aria-selected="false" aria-controls="termsContent" role="tab" tabindex="-1" title="Terms of Service"></button>
  </div>

  <!-- Content Sections -->
  <section id="privacyContent" class="content-section" role="tabpanel" aria-labelledby="btnPrivacy">
    <h2>Privacy Policy</h2>
    <p><strong>Effective Date:</strong> May 22, 2025</p>
    <p>At <strong>TrioVista Consultants</strong>, your privacy is important to us. This Privacy Policy outlines how we collect, use, and protect your information when you use our website to explore or book condominium units.</p>
    
    <h4>1. Information We Collect</h4>
    <ul>
      <li><strong>Personal Information:</strong> Name, email, phone, contact preferences when you submit forms or book.</li>
      <li><strong>Property Interests:</strong> Your selected unit, location, preferences.</li>
      <li><strong>Technical Data:</strong> Browser, IP, device info via cookies and analytics.</li>
    </ul>
    
    <h4>2. How We Use Your Information</h4>
    <ul>
      <li>Respond to inquiries and schedule viewings</li>
      <li>Send updates on properties</li>
      <li>Improve website experience</li>
      <li>Comply with legal obligations</li>
    </ul>

    <h4>3. How We Protect Your Information</h4>
    <p>We use SSL encryption, secured servers, and limit access to authorized personnel only.</p>

    <h4>4. Sharing of Information</h4>
    <p>We do not sell or rent your data. Shared only with consultants, legal authorities, or third-party tools under strict agreements.</p>

    <h4>5. Your Rights</h4>
    <p>You can access, correct, delete your data, or withdraw consent anytime by contacting <a href="mailto:info@triovista.ph">info@triovista.ph</a>.</p>

    <h4>6. Cookies</h4>
    <p>Cookies enhance browsing. Manage via browser settings.</p>

    <h4>7. External Links</h4>
    <p>We aren’t responsible for third-party sites.</p>

    <h4>8. Updates to This Policy</h4>
    <p>Changes posted here with new effective date.</p>

    <h4>9. Contact Us</h4>
    <p>
      TrioVista Consultants<br>
      Email: <a href="mailto:info@triovista.ph">info@triovista.ph</a><br>
      Mobile: (+63) 926-555-7843<br>
      888 Skyline Avenue, New Metro City, Philippines
    </p>
  </section>

  <section id="termsContent" class="content-section d-none" role="tabpanel" aria-labelledby="btnTerms">
    <h2>Terms of Service</h2>
    <p><strong>Effective Date:</strong> May 22, 2025</p>
    <p>Welcome to <strong>TrioVista Consultants</strong>. By using our website, you agree to these terms. Please read carefully.</p>

    <h4>1. Use of the Website</h4>
    <p>Use our website lawfully for browsing, inquiries, or bookings. No unauthorized copying or harmful activities.</p>

    <h4>2. Booking and Inquiry Submissions</h4>
    <p>Provide accurate info. We may contact you. Submission does not guarantee unit reservation.</p>

    <h4>3. Intellectual Property</h4>
    <p>All content is our property. No reproduction without permission.</p>

    <h4>4. Property Listings Disclaimer</h4>
    <p>We strive for accuracy but listings may change. Sales subject to verification.</p>

    <h4>5. Third-Party Links</h4>
    <p>We are not responsible for external websites linked from our site.</p>

    <h4>6. Limitation of Liability</h4>
    <p>We are not liable for damages from site use, errors, or interruptions.</p>

    <h4>7. Privacy</h4>
    <p>Use of site means you agree to our <a href="#privacyContent" onclick="showSection('privacy')">Privacy Policy</a>.</p>

    <h4>8. Modifications to Terms</h4>
    <p>Terms may change. Continued use means acceptance.</p>

    <h4>9. Governing Law</h4>
    <p>Terms governed by the laws of the Republic of the Philippines.</p>

    <h4>10. Contact Us</h4>
    <p>
      TrioVista Consultants<br>
      Email: <a href="mailto:info@triovista.ph">info@triovista.ph</a><br>
      Mobile: (+63) 926-555-7843<br>
      888 Skyline Avenue, New Metro City, Philippines
    </p>
  </section>

  <!-- I Agree Button -->
   <div class="container-agree">
     <button class="btn btn-outline-theme" id="agree" aria-label="I agree to Privacy Policy and Terms of Service">
       I Agree
    </button>
   </div>

  <!-- Modal -->
  <div class="modal fade" id="agreeModal" tabindex="-1" aria-labelledby="agreeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agreeModalLabel">Thank You!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>You have accepted the Privacy Policy and Terms of Service.</p>
          <p>You will now be redirected to the homepage.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-theme" id="thanks" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="jscript/script.js"></script>
</body>
</html>
