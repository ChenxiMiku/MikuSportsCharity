(function () {
  "use strict";

  // COUNTER NUMBERS
  document.addEventListener('DOMContentLoaded', function() {
    // Detect when elements are visible on the screen (replaces jQuery .appear)
    const counterThumbs = document.querySelectorAll('.counter-thumb');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counters = document.querySelectorAll('.counter-number');
          counters.forEach(counter => countTo(counter));
        }
      });
    });

    counterThumbs.forEach(thumb => observer.observe(thumb));
  });

  // CUSTOM LINK (smooth scroll)
  const smoothScrollLinks = document.querySelectorAll('.smoothscroll');
  smoothScrollLinks.forEach(link => {
    link.addEventListener('click', function (event) {
      event.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      const headerHeight = document.querySelector('.navbar').offsetHeight;

      if (targetElement) {
        scrollToDiv(targetElement, headerHeight);
      }
    });
  });

  function scrollToDiv(element, navHeight) {
    const offsetTop = element.offsetTop;
    const totalScroll = offsetTop - navHeight;

    window.scrollTo({
      top: totalScroll,
      behavior: 'smooth'
    });
  }
})();
