const images = [
    'assets/slideshow/unit1.webp',
    'assets/slideshow/unit2.webp',
    'assets/slideshow/unit5.jpg'
  ];
  
  let current = 0;
  const slide = document.getElementById("slide");
  
  function showNextImage() {
    current = (current + 1) % images.length;
    slide.src = images[current];
  }
  
  setInterval(showNextImage, 3000); // change image every 3 seconds
  