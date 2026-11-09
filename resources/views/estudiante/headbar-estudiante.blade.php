@php
    $partesNombresEstudiante = preg_split(
        '/\s+/',
        trim((string) ($estudiante?->nombres_estudiante ?? '')),
        -1,
        PREG_SPLIT_NO_EMPTY
    ) ?: [];
    $partesApellidosEstudiante = preg_split(
        '/\s+/',
        trim((string) ($estudiante?->apellidos_estudiante ?? '')),
        -1,
        PREG_SPLIT_NO_EMPTY
    ) ?: [];
    $nombrePerfilEstudiante = trim(sprintf(
        '%s %s',
        $partesNombresEstudiante[0] ?? '',
        $partesApellidosEstudiante[0] ?? ''
    ));
    $nombrePerfilEstudiante = $nombrePerfilEstudiante !== ''
        ? $nombrePerfilEstudiante
        : auth()->user()->name;
@endphp

<style>
    html:has(.student-headbar),
    html:has(.student-headbar) body,
    html:has(.student-headbar) body > div.flex.min-h-screen.w-full,
    html:has(.student-headbar) .institution-app-content,
    html:has(.student-headbar) .institution-app-content > .min-w-0.flex-1,
    html:has(.student-headbar) .institution-app-content > .min-w-0.flex-1 > [data-flux-main] {
        margin: 0 !important;
        padding-top: 0 !important;
    }

    html:has(.student-headbar) body > div.flex.min-h-screen.w-full {
        display: block !important;
    }

    html:has(.student-headbar) .institution-sidebar,
    html:has(.student-headbar) .institution-app-content > .hidden,
    html:has(.student-headbar) .institution-app-content > [data-flux-header] {
        display: none !important;
    }

    html:has(.student-headbar) .institution-app-content {
        display: flex !important;
        width: 100% !important;
        min-height: 0 !important;
        flex-direction: column !important;
    }

    html:has(.student-headbar) .institution-app-content > .min-w-0.flex-1 {
        width: 100% !important;
        min-width: 0 !important;
        flex: 1 1 auto !important;
        overflow: visible !important;
    }

    .student-headbar {
        position: sticky;
        top: 0;
        z-index: 50;
        width: 100%;
        margin-top: 0 !important;
        border-bottom: 2px solid #cbb9ea;
        background: #f3edff;
        color: #493769;
        box-shadow: 0 6px 0 rgba(95, 72, 139, .08);
        font-family: 'Nunito', 'Comic Sans MS', ui-rounded, system-ui, sans-serif;
        transform: translateY(0);
        transition: transform .28s ease;
        will-change: transform;
    }

    .student-headbar.student-headbar--hidden {
        transform: translateY(-105%);
    }

    .student-headbar-inner {
        display: flex;
        width: 100%;
        min-height: 4.75rem;
        align-items: center;
        gap: 1rem;
        padding: .75rem clamp(1rem, 4vw, 3rem);
    }

    .student-headbar-brand {
        display: inline-flex;
        min-width: max-content;
        align-items: center;
        gap: .7rem;
        color: #493769;
        text-decoration: none;
    }

    .student-headbar-brand-mark {
        display: flex;
        width: 2.75rem;
        height: 2.75rem;
        align-items: center;
        justify-content: center;
        border: 2px solid #a98ce3;
        border-radius: .9rem 1.4rem .9rem 1.4rem;
        background: #c6afea;
        box-shadow: 4px 4px 0 #a98ce3;
    }

    .student-headbar-brand-mark img { width: 2rem; height: 2rem; object-fit: contain; }
    .student-headbar-brand-text { display: grid; line-height: 1.05; }
    .student-headbar-brand-text small { color: #8069a5; font-size: .68rem; font-weight: 800; }
    .student-headbar-brand-text strong { color: #493769; font-size: 1.05rem; font-weight: 950; }

    .student-headbar-links {
        display: flex;
        min-width: 0;
        flex: 1 1 auto;
        align-items: center;
        justify-content: center;
        gap: .55rem;
    }

    .student-headbar-link {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        border: 2px solid transparent;
        border-radius: .8rem 1.4rem .8rem 1.4rem;
        color: #5b467d;
        font-size: .86rem;
        font-weight: 900;
        padding: .55rem .85rem;
        text-decoration: none;
        transition: background-color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .student-headbar-link:hover,
    .student-headbar-link[aria-current="page"] {
        transform: translateY(-2px);
        border-color: #ad92dc;
        background: #e1d5f8;
        color: #493769;
    }

    .student-headbar-account {
        display: inline-flex;
        min-width: max-content;
        align-items: center;
        gap: .55rem;
        border: 2px solid #ad92dc;
        border-radius: 999px;
        background: #e1d5f8;
        color: #493769;
        padding: .35rem .75rem .35rem .4rem;
        font-size: .82rem;
        font-weight: 900;
        box-shadow: 0 4px 0 rgba(95, 72, 139, .14);
    }

    .student-headbar-account-mark {
        display: flex;
        width: 2rem;
        height: 2rem;
        align-items: center;
        justify-content: center;
        border: 2px solid #a98ce3;
        border-radius: 50%;
        background: #c6afea;
        color: #503477;
        font-size: .72rem;
    }

    .student-headbar-account-menu {
        border-color: #cbb9ea !important;
        background: #fbf9ff !important;
        color: #493769 !important;
    }

    .student-headbar-account-menu * {
        color: #493769 !important;
    }

    .student-headbar-account-menu [data-flux-menu-item]:hover,
    .student-headbar-account-menu [data-flux-menu-item]:focus {
        background: #e9defb !important;
        color: #35234f !important;
    }

    @media (max-width: 760px) {
        .student-headbar-inner { flex-wrap: wrap; justify-content: space-between; }
        .student-headbar-links { order: 3; flex-basis: 100%; justify-content: flex-start; overflow-x: auto; padding-bottom: .1rem; }
        .student-headbar-link { white-space: nowrap; font-size: .78rem; }
    }
</style>

<header class="student-headbar" aria-label="Navegaci&oacute;n del estudiante">
    <div class="student-headbar-inner">
        <a href="{{ route('estudiante.dashboard') }}" class="student-headbar-brand" wire:navigate.hover>
            <span class="student-headbar-brand-mark"><img src="{{ asset('images/LogoSv.png') }}" alt="Logo Salvatore"></span>
            <span class="student-headbar-brand-text"><small>Mi espacio</small><strong>Salvatore</strong></span>
        </a>

        <nav class="student-headbar-links" aria-label="Secciones del estudiante">
            <a href="{{ route('estudiante.dashboard') }}" class="student-headbar-link" aria-current="page" wire:navigate.hover><span>★</span> Mi espacio</a>
        </nav>

        <flux:dropdown position="bottom" align="end">
            <button type="button" class="student-headbar-account" aria-label="Cuenta de {{ $nombrePerfilEstudiante }}">
                <span class="student-headbar-account-mark">{{ auth()->user()->initials() }}</span>
                <span class="hidden sm:inline">{{ $nombrePerfilEstudiante }}</span>
                <span aria-hidden="true">⌄</span>
            </button>
            <flux:menu class="student-headbar-account-menu">
                <div class="px-3 py-2 text-sm font-bold text-[#493769]">{{ auth()->user()->email }}</div>
                <flux:menu.separator />
                <flux:menu.item :href="route('profile.edit')" icon="cog-6-tooth" wire:navigate>Configuraci&oacute;n</flux:menu.item>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full cursor-pointer">Cerrar sesi&oacute;n</flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </div>
</header>

<script>
    (() => {
        window.__studentHeadbarCleanup?.();

        const headbar = document.querySelector('.student-headbar');

        if (!headbar) {
            return;
        }

        let hideTimer = null;
        const idleDelay = 1400;
        const revealZoneHeight = 96;

        const showHeadbar = () => {
            headbar.classList.remove('student-headbar--hidden');
        };

        const scheduleHide = () => {
            window.clearTimeout(hideTimer);

            if (window.scrollY <= 0) {
                showHeadbar();
                return;
            }

            hideTimer = window.setTimeout(() => {
                if (window.scrollY > 0) {
                    headbar.classList.add('student-headbar--hidden');
                }
            }, idleDelay);
        };

        const handleScroll = () => {
            showHeadbar();
            scheduleHide();
        };

        const handlePointerMove = (event) => {
            if (event.clientY <= revealZoneHeight) {
                showHeadbar();
                scheduleHide();
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        window.addEventListener('pointermove', handlePointerMove, { passive: true });
        scheduleHide();

        window.__studentHeadbarCleanup = () => {
            window.removeEventListener('scroll', handleScroll);
            window.removeEventListener('pointermove', handlePointerMove);
            window.clearTimeout(hideTimer);
        };
    })();
</script>
