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
        const readTheme = () => {
            const storedTheme = localStorage.getItem(storageKey);
            if (storedTheme === 'dark' || storedTheme === 'light') {
                return storedTheme;
            }

            const fluxTheme = localStorage.getItem('flux.appearance');
            if (fluxTheme === 'dark' || fluxTheme === 'light') {
                return fluxTheme;
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const applyTheme = (theme) => {
            const isDark = theme === 'dark';
            const normalizedTheme = isDark ? 'dark' : 'light';
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = normalizedTheme;
            localStorage.setItem(storageKey, normalizedTheme);
            localStorage.setItem('flux.appearance', normalizedTheme);
            if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                window.Flux.applyAppearance(normalizedTheme);
            }
        };

        applyTheme(readTheme());
        window.applyTheme = applyTheme;
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance