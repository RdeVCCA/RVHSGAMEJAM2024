document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove("paused");
      }
    });
  }, { threshold: 0.5 }); // Adjust the threshold as needed

  const observeElements = (elements) => {
      elements.forEach(el => {
        observer.observe(el);
      });
    };
  
  const paused = document.querySelectorAll('.paused');

  observeElements(paused);
  document.getElementById('hero-video').play();
  
  const carouselItems = document.querySelectorAll('.carousel-item');
  var curItem = 0;
  const carouselLength = carouselItems.length;
  function nextItem() {
      // console.log(curItem)
      carouselItems[curItem].classList.remove('active');
      curItem = (curItem + 1) % carouselLength;
      carouselItems[curItem].classList.add('active');
      setTimeout(nextItem, 3000);
  }
  nextItem();
});
  

