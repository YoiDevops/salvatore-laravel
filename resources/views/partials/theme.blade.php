<script>
    (() => {
        const storageKey = 'theme';
        const fluxStorageKey = 'flux.appearance';
        const validThemes = ['light', 'dark', 'system'];
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

        const readTheme = () => {
            const fluxTheme = localStorage.getItem(fluxStorageKey);
            if (validThemes.includes(fluxTheme)) {
                return fluxTheme;
            }

            const storedTheme = localStorage.getItem(storageKey);
            return validThemes.includes(storedTheme) ? storedTheme : 'system';
        };

        const applyTheme = (theme) => {
            const preference = validThemes.includes(theme) ? theme : 'system';
            const isDark = preference === 'dark'
                || (preference === 'system' && mediaQuery.matches);

            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
            localStorage.setItem(storageKey, preference);
            localStorage.setItem(fluxStorageKey, preference);

            if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                window.Flux.applyAppearance(preference);
            }
        };

        window.applyTheme = applyTheme;
        window.getThemePreference = readTheme;
        applyTheme(readTheme());

        window.addEventListener('storage', (event) => {
            if (event.key === storageKey || event.key === fluxStorageKey) {
                applyTheme(readTheme());
            }
        });

        mediaQuery.addEventListener('change', () => {
            if (readTheme() === 'system') {
                applyTheme('system');
            }
        });
    })();
</script>
