document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.play();
      } else {
        entry.target.pause();
      }
    });
  }, { threshold: 0.1 }); // Adjust the threshold as needed

  const observeElements = (elements) => {
    elements.forEach(el => {
      observer.observe(el);
    });
  };
  
  const heroVideo = document.querySelectorAll("#hero-video");
  observeElements(heroVideo);
});
  

