document.addEventListener('DOMContentLoaded', function() {
    
    const darkModeToggles = document.querySelectorAll('.darkModeToggle');

    darkModeToggles.forEach(darkModeToggle => {
        const icon = darkModeToggle.querySelector('i');

        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
            icon.classList.remove('bi-moon-fill');
            icon.classList.add('bi-sun-fill'); 
        }

        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');

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
});
