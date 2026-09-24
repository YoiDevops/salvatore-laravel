<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="/images/logopequeno.ico" sizes="any">
<link rel="apple-touch-icon" href="/images/logopequeno.ico">

@fonts

<script>
    (function () {
        const storageKey = 'theme';
        const validThemes = ['light', 'dark', 'system'];
        const readTheme = () => {
            const fluxTheme = localStorage.getItem('flux.appearance');
            if (validThemes.includes(fluxTheme)) {
                return fluxTheme;
            }

            const storedTheme = localStorage.getItem(storageKey);
            if (validThemes.includes(storedTheme)) {
                return storedTheme;
            }

            return 'system';
        };

        const applyTheme = (theme) => {
            const normalizedTheme = validThemes.includes(theme) ? theme : 'system';
            const isDark = normalizedTheme === 'dark'
                || (normalizedTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            const resolvedTheme = isDark ? 'dark' : 'light';
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = resolvedTheme;
            localStorage.setItem(storageKey, normalizedTheme);
            localStorage.setItem('flux.appearance', normalizedTheme);
            if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                window.Flux.applyAppearance(normalizedTheme);
            }
        };

        applyTheme(readTheme());
        window.applyTheme = applyTheme;
        window.getThemePreference = readTheme;

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (readTheme() === 'system') {
                applyTheme('system');
            }
        });
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance