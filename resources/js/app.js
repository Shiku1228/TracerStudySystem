const APP_THEME_STORAGE_KEY = 'app.appearance';

function getStoredAppearance() {
    return localStorage.getItem(APP_THEME_STORAGE_KEY) || window.Flux?.appearance || 'system';
}

function applyRmmcAppearance(enabled) {
    document.documentElement.classList.toggle('theme-rmmc', enabled);
}

function applyAppearance(appearance) {
    if (!window.Flux?.applyAppearance) {
        return;
    }

    if (appearance === 'rmmc') {
        localStorage.setItem(APP_THEME_STORAGE_KEY, 'rmmc');
        window.Flux.applyAppearance('light');
        applyRmmcAppearance(true);
        return;
    }

    localStorage.setItem(APP_THEME_STORAGE_KEY, appearance);
    applyRmmcAppearance(false);
    window.Flux.applyAppearance(appearance);
}

function syncAppearance() {
    const appearance = getStoredAppearance();

    if (appearance === 'rmmc') {
        applyRmmcAppearance(true);
        window.Flux?.applyAppearance('light');
        return;
    }

    applyRmmcAppearance(false);
    window.Flux?.applyAppearance(appearance);
}

window.AppTheme = {
    get: getStoredAppearance,
    apply: applyAppearance,
    sync: syncAppearance,
};

document.addEventListener('DOMContentLoaded', syncAppearance);
document.addEventListener('livewire:navigated', syncAppearance);
window.addEventListener('pageshow', syncAppearance);
