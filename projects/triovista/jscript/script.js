//PRIVACY TERMS
document.addEventListener('DOMContentLoaded', () => {
  // Your existing code here
  const btnPrivacy = document.getElementById('btnPrivacy');
  const btnTerms = document.getElementById('btnTerms');
  const privacyContent = document.getElementById('privacyContent');
  const termsContent = document.getElementById('termsContent');
  const agreeBtn = document.getElementById('agree');
  const agreeModal = new bootstrap.Modal(document.getElementById('agreeModal'), {});

  btnPrivacy.addEventListener('click', () => showSection('privacy'));
  btnTerms.addEventListener('click', () => showSection('terms'));
  agreeBtn.addEventListener('click', () => agreeModal.show());

  const modalElement = document.getElementById('agreeModal');
  modalElement.addEventListener('hidden.bs.modal', () => {
    window.location.href = 'index.php';
  });

  function showSection(section) {
    if(section === 'privacy') {
      privacyContent.classList.remove('d-none');
      termsContent.classList.add('d-none');
      btnPrivacy.classList.add('active');
      btnPrivacy.setAttribute('aria-selected', 'true');
      btnPrivacy.tabIndex = 0;
      btnTerms.classList.remove('active');
      btnTerms.setAttribute('aria-selected', 'false');
      btnTerms.tabIndex = -1;
    } else {
      privacyContent.classList.add('d-none');
      termsContent.classList.remove('d-none');
      btnTerms.classList.add('active');
      btnTerms.setAttribute('aria-selected', 'true');
      btnTerms.tabIndex = 0;
      btnPrivacy.classList.remove('active');
      btnPrivacy.setAttribute('aria-selected', 'false');
      btnPrivacy.tabIndex = -1;
    }
  }

  // Show privacy section by default on page load
  showSection('privacy');
});


// Optional: Enhance user feedback
document.getElementById("inquiryForm").addEventListener("submit", function(e) {
    document.getElementById("formResponse").textContent = "Submitting...";
  });
  

//CHOOSE SELECTION BUTTON
  function goToSelectedCondo() {
    var select = document.getElementById("locationSelect");
    var selectedValue = select.value;
    var errorMsg = document.getElementById("locationError");

    if (select.selectedIndex === 0) {
      // Show error message
      errorMsg.style.display = "block";
    } else {
      // Hide error and redirect
      errorMsg.style.display = "none";
      window.location.href = selectedValue;
    }
  }


//Navbarlink
  document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.querySelector(".navbar-toggler");
    const collapse = document.querySelector("#navbarNav");
    let isOpen = false;

    toggler.addEventListener("click", function () {
      if (isOpen) {
        collapse.classList.remove("show");
        isOpen = false;
      } else {
        collapse.classList.add("show");
        isOpen = true;
      }
    });
    // Optional: prevent link clicks from auto-collapsing
    document.querySelectorAll(".nav-link").forEach(link => {
      link.addEventListener("click", function (e) {
        e.preventDefault(); // remove this if you want it to jump to section
        // keep menu open until manually closed
      });
    });
  });



