const APP_THEME_STORAGE_KEY = 'app.appearance';

function getStoredAppearance() {
    return localStorage.getItem(APP_THEME_STORAGE_KEY)
        || localStorage.getItem('flux.appearance')
        || window.Flux?.appearance
        || 'system';
}

function prefersDarkScheme() {
    return window.matchMedia?.('(prefers-color-scheme: dark)').matches ?? false;
}

function resolveEffectiveAppearance(appearance) {
    if (appearance === 'system') {
        return prefersDarkScheme() ? 'dark' : 'light';
    }

    if (appearance === 'rmmc') {
        return 'light';
    }

    return appearance;
}

function applyRootAppearance(appearance) {
    const root = document.documentElement;
    const isRmmc = appearance === 'rmmc';
    const effectiveAppearance = resolveEffectiveAppearance(appearance);

    root.classList.toggle('dark', effectiveAppearance === 'dark');
    root.classList.toggle('theme-rmmc', isRmmc);
}

function applyAppearance(appearance) {
    const fluxAppearance = appearance === 'rmmc' ? 'light' : appearance;

    localStorage.setItem(APP_THEME_STORAGE_KEY, appearance);
    localStorage.setItem('flux.appearance', fluxAppearance);
    applyRootAppearance(appearance);

    if (window.Flux?.applyAppearance) {
        window.Flux.applyAppearance(fluxAppearance);
    }
}

function syncAppearance() {
    const appearance = getStoredAppearance();
    const fluxAppearance = appearance === 'rmmc' ? 'light' : appearance;

    applyRootAppearance(appearance);

    if (window.Flux?.applyAppearance) {
        window.Flux.applyAppearance(fluxAppearance);
    }
}

window.AppTheme = {
    get: getStoredAppearance,
    apply: applyAppearance,
    sync: syncAppearance,
};

document.addEventListener('DOMContentLoaded', syncAppearance);
document.addEventListener('livewire:navigated', syncAppearance);
window.addEventListener('pageshow', syncAppearance);
