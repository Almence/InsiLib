import './bootstrap';

import.meta.glob([
    '../fonts/**'
]);

const themeToggle = document.getElementById('theme-toggle');

function updateThemeToggle(theme) {
    const isDark = theme === 'dark';

    themeToggle?.setAttribute('aria-label', `Aktifkan tema ${isDark ? 'terang' : 'gelap'}`);
    themeToggle?.setAttribute('title', `Aktifkan tema ${isDark ? 'terang' : 'gelap'}`);
    themeToggle?.setAttribute('aria-pressed', String(isDark));
    themeToggle?.querySelector('[data-theme-icon="moon"]')?.classList.toggle('hidden', isDark);
    themeToggle?.querySelector('[data-theme-icon="sun"]')?.classList.toggle('hidden', !isDark);
}

updateThemeToggle(document.documentElement.dataset.theme);

themeToggle?.addEventListener('click', () => {
    const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';

    document.documentElement.dataset.theme = nextTheme;
    localStorage.setItem('insilib-theme', nextTheme);
    updateThemeToggle(nextTheme);
});
