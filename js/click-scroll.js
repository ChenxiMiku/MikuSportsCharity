document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // 当用户滚动页面时显示或隐藏按钮
    window.addEventListener('scroll', function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            scrollToTopBtn.style.display = 'block'; // 显示按钮
        } else {
            scrollToTopBtn.style.display = 'none';  // 隐藏按钮
        }
    });

    // 点击按钮时滚动到顶部
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'  // 平滑滚动
        });
    });
});
