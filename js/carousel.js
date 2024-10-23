function initCarousel(carouselId, prevBtnId, nextBtnId) {
    let currentIndex = 0; // 当前显示的幻灯片索引
    const items = document.querySelectorAll(`#${carouselId} .carousel-item`); // 获取特定轮播的所有幻灯片

    // 设置初始状态
    function updateCarousel() {
        items.forEach((item, index) => {
            if (index === currentIndex) {
                item.classList.add('active'); // 添加 active 类
                
                item.style.opacity = 1; // 确保当前幻灯片可见
            } else {
                item.classList.remove('active'); // 移除非活动幻灯片的 active 类
                item.style.opacity = 0; // 隐藏非活动幻灯片
            }
        });
    }

    // 显示下一张幻灯片
    function showNext() {
        // updateCarousel();

        const previousIndex = currentIndex; // 保存当前索引
        currentIndex = (currentIndex + 1) % items.length; // 循环显示幻灯片

        // 应用动画类
        items[previousIndex].classList.add('carousel-item-prev'); // 当前幻灯片添加 prev 类
        items[currentIndex].classList.add('carousel-item-next'); // 下一张幻灯片添加 next 类

        // 更新轮播
        updateCarousel();

    }

    // 显示上一张幻灯片
    function showPrev() {
        // updateCarousel();

        const previousIndex = currentIndex; // 保存当前索引
        currentIndex = (currentIndex - 1 + items.length) % items.length; // 循环显示幻灯片

        // 应用动画类
        items[previousIndex].classList.add('carousel-item-next'); // 当前幻灯片添加 next 类
        items[currentIndex].classList.add('carousel-item-prev'); // 上一张幻灯片添加 prev 类

        // 更新轮播
        updateCarousel();

    }

    setInterval(showNext, 5000); // 每5秒自动切换到下一张幻灯片
    // 事件监听
    document.getElementById(nextBtnId).addEventListener('click', showNext);
    document.getElementById(prevBtnId).addEventListener('click', showPrev);

    updateCarousel();
    
    // 自动轮播（可选）
}

// 初始化每个轮播
document.addEventListener('DOMContentLoaded', () => {
    initCarousel('hero-slide', 'prevBtnHero', 'nextBtnHero');
});