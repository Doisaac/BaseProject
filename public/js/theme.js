//local storage esta aca 
document.addEventListener('DOMContentLoaded', () => {
    const theme = localStorage.getItem('theme');
    const toggle = document.getElementById('theme-toggle');

    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
    }
});

function toggleTheme() {
    const toggle = document.getElementById('theme-toggle');
    const isDark = toggle.checked;
    document.body.classList.toggle('dark-mode', isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}
