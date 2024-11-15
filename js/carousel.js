function initCarousel(carouselId, prevBtnId, nextBtnId) {
    let currentIndex = 0;
    const items = document.querySelectorAll(`#${carouselId} .carousel-item`);

    function updateCarousel() {
        items.forEach((item, index) => {
            if (index === currentIndex) {
                item.classList.add('active');
                
                item.style.opacity = 1;
            } else {
                item.classList.remove('active');
                item.style.opacity = 0;
            }
        });
    }

    function showNext() {
        // updateCarousel();

        const previousIndex = currentIndex;
        currentIndex = (currentIndex + 1) % items.length;

        items[previousIndex].classList.add('carousel-item-prev'); 
        items[currentIndex].classList.add('carousel-item-next');


        updateCarousel();

    }

    function showPrev() {
        // updateCarousel();

        const previousIndex = currentIndex;
        currentIndex = (currentIndex - 1 + items.length) % items.length;


        items[previousIndex].classList.add('carousel-item-next');
        items[currentIndex].classList.add('carousel-item-prev');


        updateCarousel();

    }

    setInterval(showNext, 5000);

    document.getElementById(nextBtnId).addEventListener('click', showNext);
    document.getElementById(prevBtnId).addEventListener('click', showPrev);

    updateCarousel();
    

}


document.addEventListener('DOMContentLoaded', () => {
    initCarousel('hero-slide', 'prevBtnHero', 'nextBtnHero');
});