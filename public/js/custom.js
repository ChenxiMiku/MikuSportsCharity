(function () {
  "use strict";

  document.getElementById('send-button').addEventListener('click', function (event) {
    event.preventDefault(); 
    alert('Not implemented yet.');
  });

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
