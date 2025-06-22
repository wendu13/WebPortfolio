
//MORTGAGE CALCULATOR
const downPaymentInput = document.getElementById('downPaymentAmount');
const termSelect = document.querySelector('select[name="termYears"]');
const computeBtn = document.getElementById('computeBtn');

function checkMortgageInputs() {
  // Require term to be selected and downpayment > 0 (optional: or allow 0)
  const termSelected = termSelect.value !== "";
  // Enable button only if term is selected
  computeBtn.disabled = !termSelected;
}

termSelect.addEventListener('change', checkMortgageInputs);
downPaymentInput.addEventListener('input', () => {
  // Update downpayment display
  document.getElementById('dpDisplay').innerText = '₱' + parseInt(downPaymentInput.value).toLocaleString();
});

checkMortgageInputs();  // Initial check

function goToLocation() {
  const url = document.getElementById('locationSelect').value;
  if (url) window.location.href = url;
}

const thumbnails = document.querySelectorAll('.thumbnail-img');
const mainImage = document.getElementById('mainImage');
let currentIndex = 0;
const images = Array.from(thumbnails).map(img => img.src);

function changeImage(img) {
  mainImage.src = img.src;
  thumbnails.forEach(t => t.classList.remove('active'));
  img.classList.add('active');
  currentIndex = images.indexOf(img.src);
}

function prevImage() {
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  mainImage.src = images[currentIndex];
  updateActiveThumbnail();
}

function nextImage() {
  currentIndex = (currentIndex + 1) % images.length;
  mainImage.src = images[currentIndex];
  updateActiveThumbnail();
}

function updateActiveThumbnail() {
  thumbnails.forEach((thumb, index) => {
    thumb.classList.toggle('active', index === currentIndex);
  });
}

function resetMortgageForm() {
  // Optional: Add logic if you'd like to reset the form or keep previous values
}

function printComputation() {
  const printContent = document.getElementById('printableArea').innerHTML;
  const win = window.open('', '', 'height=600,width=800');
  win.document.write('<html><head><title>Computation Result</title>');
  win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">');
  win.document.write('</head><body>');
  win.document.write(printContent);
  win.document.write('</body></html>');
  win.document.close();
  win.focus();
  win.print();
  win.close();
}

const locationSelect = document.getElementById('locationSelect');
const locationGoBtn = document.getElementById('locationGoBtn');

locationSelect.addEventListener('change', () => {
  locationGoBtn.disabled = !locationSelect.value;
});

locationGoBtn.addEventListener('click', () => {
  if(locationSelect.value) {
    window.location.href = locationSelect.value;
  }
});

const apptSubmitBtn = document.getElementById('apptSubmitBtn');
const appointmentForm = document.getElementById('appointmentForm');

appointmentForm.addEventListener('input', () => {
  const valid = [...appointmentForm.elements].every(el => el.checkValidity());
  apptSubmitBtn.disabled = !valid;
});

appointmentForm.addEventListener('submit', function(e) {
  e.preventDefault();
  document.getElementById('confirmationMsg').classList.remove('d-none');
  appointmentForm.classList.add('d-none');
});


function toggleResult() {
const resultDetails = document.getElementById('resultDetails');
const toggleBtn = document.getElementById('toggleBtn');

if (resultDetails.style.display === 'none') {
  resultDetails.style.display = 'block';
  toggleBtn.innerHTML = '<i class="bi bi-chevron-up"></i>';
} else {
  resultDetails.style.display = 'none';
  toggleBtn.innerHTML = '<i class="bi bi-chevron-down"></i>';
}
}

const availableDates = [
"2025-05-25",
"2025-05-27",
"2025-06-01",
"2025-06-05",
];

flatpickr("#preferredDate", {
enable: availableDates,
dateFormat: "Y-m-d",
minDate: availableDates[0],
maxDate: availableDates[availableDates.length - 1],
});

function changeImage(img) {
// Update main image src
const mainImg = document.getElementById("mainImage");
mainImg.src = img.src;

// Update active thumbnail style
document.querySelectorAll('.thumbnail-img').forEach(el => el.classList.remove('active'));
img.classList.add('active');
}


//FOR MODALIMAGE
function openModal(src) {
const modalImage = document.getElementById("modalImage");
modalImage.src = src;

const modal = new bootstrap.Modal(document.getElementById('imageModal'));
modal.show();
}

function closeModal() {
const modalElement = document.getElementById('imageModal');
const modal = bootstrap.Modal.getInstance(modalElement);
if (modal) modal.hide();
}

function checkInputs() {
const dp = parseFloat(downPaymentInput.value);
const term = termSelect.value;
computeBtn.disabled = !(dp > 0 && term);
}
downPaymentInput.addEventListener('input', checkInputs);
termSelect.addEventListener('change', checkInputs);

//FOR LOCATION DROPDOWN
const dropdown = document.getElementById("locationDropdown");
if (dropdown) {
  dropdown.addEventListener("click", () => {
    console.log("Dropdown clicked!");
  });
}