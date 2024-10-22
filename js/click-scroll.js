document.addEventListener('DOMContentLoaded', function() {
    "use strict";
  
    // Define the sections
    var sectionArray = [1, 2, 3, 4, 5, 6];
  
    // For each section in the array, handle scroll and click events
    sectionArray.forEach(function(value, index) {
        // Scroll event for activating links
        document.addEventListener('scroll', function() {
            var offsetSection = document.getElementById('section_' + value).offsetTop - 90;
            var docScroll = window.pageYOffset || document.documentElement.scrollTop;
            var docScroll1 = docScroll + 1;

            if (docScroll1 >= offsetSection) {
                var links = document.querySelectorAll('.navbar-nav .nav-item .nav-link');
                
                links.forEach(function(link) {
                    link.classList.remove('active');
                    link.classList.add('inactive');
                });

                links[index].classList.add('active');
                links[index].classList.remove('inactive');
            }
        });

        // Click event for smooth scrolling
        var clickScrolls = document.querySelectorAll('.click-scroll');
        if (clickScrolls.length > index) {  // Check if the element exists
            var clickScroll = clickScrolls[index];
            clickScroll.addEventListener('click', function(e) {
                var offsetClick = document.getElementById('section_' + value).offsetTop - 90;
                e.preventDefault();

                window.scrollTo({
                    top: offsetClick,
                    behavior: 'smooth'
                });
            });
        }
    });

    // Set initial active/inactive states
    var navLinks = document.querySelectorAll('.navbar-nav .nav-item .nav-link');
    navLinks.forEach(function(link) {
        link.classList.add('inactive');
    });
    
    // Activate the first link initially
    navLinks[0].classList.add('active');
    navLinks[0].classList.remove('inactive');
});
