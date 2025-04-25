import 'http://localhost:5173/@vite/client';

document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem('theme');
    const icon = document.getElementById('theme-icon');

    if (localStorage.getItem('theme') === 'dark') {
        icon.src = '/app_media/sun.png';
    } else {
        icon.src = '/app_media/moon.png';
    }

    if (currentTheme) {
        document.body.classList.add(currentTheme);
    }

    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        if (currentTheme) return;
        document.body.classList.add('dark');
    } else {
        if (currentTheme) return;
        document.body.classList.add('light');
    }
});

document.getElementById('theme-toggle').addEventListener('click', function () {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const icon = document.getElementById('theme-icon');

    console.log('Changing theme');
    console.log('Current theme from local storage: ' + currentTheme)

    const newTheme = currentTheme === 'light' ? 'dark' : 'light';

    console.log('New theme from local storage: ' + newTheme)

    document.body.classList.remove(currentTheme);
    document.body.classList.add(newTheme);

    localStorage.setItem('theme', newTheme);

    if (icon.className === 'heroicon-s-moon') {
        icon.className = 'heroicon-s-sun';
    } else {
        icon.className = 'heroicon-s-moon';
    }

    location.reload();
});
