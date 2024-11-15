document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const icon = darkModeToggle.querySelector('i');

    // 检查本地存储中是否有保存的主题，或者根据系统的主题偏好设置初始状态
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.body.classList.add('dark-mode');
        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-sun-fill'); // 切换图标为太阳
    }

    // 切换深色模式
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');

        // 切换图标
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.remove('bi-moon-fill');
            icon.classList.add('bi-sun-fill');
            localStorage.setItem('theme', 'dark');
        } else {
            icon.classList.remove('bi-sun-fill');
            icon.classList.add('bi-moon-fill');
            localStorage.setItem('theme', 'light');
        }
    });
});
