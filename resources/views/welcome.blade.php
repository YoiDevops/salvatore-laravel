<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - Institución Salvatore</title>

        <link rel="icon" href="/images/logopequeno.ico" sizes="any">
        <link rel="apple-touch-icon" href="/images/logopequeno.ico">

        @fonts
        @include('partials.theme')

        <style>
            @media (prefers-reduced-motion: reduce) {
                *,
                *::before,
                *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    scroll-behavior: auto !important;
                }
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="flex min-h-screen flex-col overflow-x-hidden bg-[#fffdf8] text-[#27313a] transition-colors duration-500 dark:bg-[#121212] dark:text-[#e8eaed]">
        <header class="sticky top-0 z-50 border-b border-[#eee8dc]/90 bg-[#fffdf8]/95 backdrop-blur-xl transition-colors duration-300 dark:border-[#3c4043] dark:bg-[#1e1f20]/95">
            <div class="flex min-h-16 w-full items-center justify-between gap-3 px-5 sm:min-h-[4.5rem] sm:px-8 lg:px-12 2xl:px-16">
                <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3 rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#d6ad4b]" aria-label="Institución Salvatore, inicio">
                    <img src="{{ asset('images/LogoSv.png') }}" alt="" class="size-10 shrink-0 object-contain sm:size-12">
                    <span class="text-sm font-bold leading-tight text-[#27313a] sm:text-base dark:text-zinc-100">
                        Institución<br class="sm:hidden"> Salvatore
                    </span>
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium text-[#59636c] lg:flex dark:text-zinc-300" aria-label="Secciones de la página">
                    <a href="#inicio" class="transition hover:text-[#9a761f] dark:hover:text-[#e6c96f]">Inicio</a>
                    <a href="#propuesta" class="transition hover:text-[#9a761f] dark:hover:text-[#e6c96f]">Nuestra propuesta</a>
                    <a href="#experiencias" class="transition hover:text-[#9a761f] dark:hover:text-[#e6c96f]">Experiencias</a>
                    <a href="#contacto" class="transition hover:text-[#9a761f] dark:hover:text-[#e6c96f]">Contacto</a>
                </nav>

                <div class="flex shrink-0 items-center gap-1.5 sm:gap-3">
                    <button id="theme-toggle" type="button" aria-label="Cambiar tema" class="inline-flex size-10 items-center justify-center rounded-full text-[#59636c] transition hover:bg-[#f3eee4] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#d6ad4b] dark:text-zinc-300 dark:hover:bg-[#2b2c2e]">
                        <svg id="theme-toggle-dark-icon" class="hidden size-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M17.293 13.293A8 8 0 0 1 6.707 2.707a8.001 8.001 0 1 0 10.586 10.586Z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden size-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M10 2a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1Zm4.22 2.22a1 1 0 0 1 1.415 0l.708.707a1 1 0 0 1-1.414 1.414l-.708-.707a1 1 0 0 1 0-1.414ZM18 10a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm-2.22 4.22a1 1 0 0 1 0 1.415l-.707.707a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 0ZM10 16a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1Zm-4.22-2.22a1 1 0 0 1-1.415 0l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 0 1.414ZM2 10a1 1 0 0 1 1-1h1a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm2.22-4.22a1 1 0 0 1 0-1.415l.707-.707a1 1 0 1 1 1.414 1.414l-.707.707a1 1 0 0 1-1.414 0ZM10 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"></path>
                        </svg>
                    </button>

                    @if (Route::has('login'))
                        <nav class="hidden items-center gap-2 text-sm font-semibold sm:flex" aria-label="Navegación principal">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex min-h-10 items-center rounded-full px-4 text-[#46515b] transition hover:bg-[#f3eee4] dark:text-zinc-200 dark:hover:bg-[#2b2c2e]">
                                    Panel principal
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex min-h-10 items-center rounded-full px-4 text-[#46515b] transition hover:bg-[#f3eee4] dark:text-zinc-200 dark:hover:bg-[#2b2c2e]">
                                    Ingresar
                                </a>
                                @if (Route::has('formulario'))
                                    <a href="{{ route('formulario') }}" class="inline-flex min-h-10 items-center rounded-full bg-[#d8b85c] px-5 font-semibold text-[#27313a] shadow-sm transition hover:-translate-y-0.5 hover:bg-[#e6c96f]">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </nav>

                        <button id="mobile-menu-btn" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu-panel" class="inline-flex size-10 items-center justify-center rounded-full text-[#46515b] transition hover:bg-[#f3eee4] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#d6ad4b] dark:text-zinc-200 dark:hover:bg-[#2b2c2e] sm:hidden">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            @if (Route::has('login'))
                <div id="mobile-menu-panel" class="absolute inset-x-0 top-full hidden border-b border-[#eee8dc] bg-[#fffdf8] px-4 pb-4 shadow-xl dark:border-[#3c4043] dark:bg-[#1e1f20] sm:hidden">
                    <nav class="mx-auto flex w-full max-w-7xl flex-col gap-2 pt-3 text-sm font-semibold" aria-label="Navegación móvil">
                        <a href="#inicio" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Inicio</a>
                        <a href="#propuesta" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Nuestra propuesta</a>
                        <a href="#experiencias" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Experiencias</a>
                        <a href="#contacto" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Contacto</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-2xl border border-[#e7dfd0] px-4 py-3 text-center dark:border-[#3c4043]">Panel principal</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Ingresar</a>
                            @if (Route::has('formulario'))
                                <a href="{{ route('formulario') }}" class="rounded-2xl bg-[#d8b85c] px-4 py-3 text-center text-[#27313a] transition hover:bg-[#e6c96f]">Registrarse</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </header>

        <main class="flex-1 overflow-hidden bg-[#fbfaf7] dark:bg-[#121212]">
            <section id="inicio" class="scroll-mt-24 px-3 pt-3 sm:px-6 sm:pt-5">
                <div class="mx-auto grid max-w-[1600px] overflow-hidden rounded-[1.75rem] bg-[#f2f0e9] dark:bg-[#1e1f20] lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="flex flex-col justify-center px-6 py-10 sm:px-10 sm:py-14 lg:px-14 xl:px-20">
                        <p class="inline-flex w-fit items-center gap-2 rounded-full bg-white/70 px-3 py-2 text-[0.68rem] font-bold uppercase tracking-[0.16em] text-[#82631d] dark:bg-white/10 dark:text-[#e6c96f]">
                            <span aria-hidden="true">✦</span> Institución Educativa Salvatore
                        </p>
                        <h1 class="mt-6 max-w-xl text-4xl font-semibold leading-[1.08] tracking-tight text-[#27313a] sm:text-5xl xl:text-6xl dark:text-[#f1f3f4]">
                            Aprender hoy,
                            <span class="text-[#8a681b] dark:text-[#e6c96f]">soñar en grande.</span>
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-7 text-[#59636c] sm:text-lg sm:leading-8 dark:text-[#bdc1c6]">
                            Un lugar para imaginar, descubrir el mundo y crecer con alegría, acompañado por una comunidad que aprende unida.
                        </p>
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            @if (Route::has('formulario'))
                                <a href="{{ route('formulario') }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full bg-[#d8b85c] px-6 py-3 text-sm font-bold text-[#27313a] shadow-sm transition hover:-translate-y-0.5 hover:bg-[#e6c96f] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#9a761f]">
                                    Conoce el proceso de inscripción <span aria-hidden="true">→</span>
                                </a>
                            @endif
                            <a href="#propuesta" class="inline-flex min-h-12 items-center justify-center rounded-full border border-[#c7c2b8] bg-white/60 px-6 py-3 text-sm font-semibold text-[#35414d] transition hover:border-[#d6ad4b] hover:bg-white dark:border-[#56585a] dark:bg-[#292a2c] dark:text-zinc-200 dark:hover:bg-[#333537]">
                                Explorar la propuesta
                            </a>
                        </div>
                        <div class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-xs font-medium text-[#59636c] dark:text-zinc-300">
                            <span class="inline-flex items-center gap-2"><span class="size-2 rounded-full bg-[#d8b85c]"></span> Aprendizaje activo</span>
                            <span class="inline-flex items-center gap-2"><span class="size-2 rounded-full bg-[#d8b85c]"></span> Crecimiento en comunidad</span>
                        </div>
                    </div>

                    <div class="relative min-h-[360px] overflow-hidden sm:min-h-[460px] lg:min-h-[600px]">
                        <img src="{{ asset('images/colegioinicio.jpg') }}" alt="Salón de clases preparado para el aprendizaje" class="absolute inset-0 size-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#172028]/55 via-transparent to-transparent"></div>
                        <div class="absolute inset-x-4 bottom-4 grid gap-3 sm:inset-x-6 sm:bottom-6 sm:grid-cols-2">
                            <div class="rounded-2xl border border-white/60 bg-white/90 p-4 shadow-lg backdrop-blur-md dark:border-white/10 dark:bg-[#1e1f20]/90">
                                <p class="text-xs font-bold uppercase tracking-wider text-[#8a681b] dark:text-[#e6c96f]">Nuestra comunidad</p>
                                <p class="mt-1 text-sm font-semibold text-[#27313a] dark:text-zinc-100">Un espacio para aprender y compartir.</p>
                            </div>
                            <div class="rounded-2xl border border-white/60 bg-white/90 p-4 shadow-lg backdrop-blur-md dark:border-white/10 dark:bg-[#1e1f20]/90">
                                <p class="text-xs font-bold uppercase tracking-wider text-[#8a681b] dark:text-[#e6c96f]">Cada día cuenta</p>
                                <p class="mt-1 text-sm font-semibold text-[#27313a] dark:text-zinc-100">Curiosidad, creatividad y nuevas ideas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="propuesta" class="scroll-mt-24 px-3 py-12 sm:px-6 sm:py-16">
                <div class="mx-auto grid max-w-[1600px] gap-7 rounded-[1.75rem] bg-[#f4f4f1] p-5 sm:p-8 lg:grid-cols-[0.78fr_1.72fr] lg:items-center lg:gap-10 lg:p-10 dark:bg-[#1a1b1c]">
                    <div class="flex flex-col items-start justify-center px-1 py-3 sm:px-3 lg:px-5">
                        <p class="inline-flex items-center gap-2 text-[0.68rem] font-bold uppercase tracking-[0.16em] text-[#82631d] dark:text-[#e6c96f]">
                            <span aria-hidden="true">✦</span> Nuestra propuesta
                        </p>
                        <h2 class="mt-4 max-w-sm text-3xl font-semibold leading-tight tracking-tight text-[#27313a] sm:text-4xl dark:text-[#f1f3f4]">
                            Formamos para aprender, convivir y crecer.
                        </h2>
                        <p class="mt-4 max-w-md text-sm leading-6 text-[#66717b] dark:text-zinc-400">
                            Acompañamos a cada estudiante para que explore sus ideas, desarrolle sus capacidades y encuentre su manera de aportar.
                        </p>
                        <a href="#experiencias" class="mt-6 inline-flex min-h-10 items-center gap-2 rounded-full bg-[#647c48] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#52683b] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#647c48]">
                            Conoce nuestras experiencias <span aria-hidden="true">→</span>
                        </a>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <article class="group relative min-h-[300px] overflow-hidden rounded-2xl sm:min-h-[360px]">
                            <img src="{{ asset('images/enfoque1.jpg') }}" alt="Estudiante creando una obra de arte" class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                                <span class="mb-3 inline-grid size-9 place-items-center rounded-full bg-white/90 text-lg text-[#647c48]" aria-hidden="true">✿</span>
                                <h3 class="text-lg font-semibold leading-tight">Imaginamos y creamos</h3>
                                <p class="mt-2 text-xs leading-5 text-white/85">El arte y el juego abren caminos para expresarnos.</p>
                            </div>
                        </article>

                        <article class="group relative min-h-[300px] overflow-hidden rounded-2xl sm:min-h-[360px]">
                            <img src="{{ asset('images/enfoque2.jpg') }}" alt="Estudiante explorando contenidos digitales" class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                                <span class="mb-3 inline-grid size-9 place-items-center rounded-full bg-white/90 text-lg text-[#647c48]" aria-hidden="true">✧</span>
                                <h3 class="text-lg font-semibold leading-tight">Exploramos con curiosidad</h3>
                                <p class="mt-2 text-xs leading-5 text-white/85">Cada pregunta invita a investigar y descubrir.</p>
                            </div>
                        </article>

                        <article class="group relative min-h-[300px] overflow-hidden rounded-2xl sm:min-h-[360px]">
                            <img src="{{ asset('images/ninos-aula.jpg') }}" alt="Estudiantes aprendiendo juntos en el aula" class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                                <span class="mb-3 inline-grid size-9 place-items-center rounded-full bg-white/90 text-lg text-[#647c48]" aria-hidden="true">♡</span>
                                <h3 class="text-lg font-semibold leading-tight">Crecemos en comunidad</h3>
                                <p class="mt-2 text-xs leading-5 text-white/85">Aprendemos a convivir, colaborar y compartir.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section id="experiencias" class="scroll-mt-24 px-3 pb-12 sm:px-6 sm:pb-16">
                <div class="mx-auto grid max-w-[1600px] gap-6 rounded-[1.75rem] border border-[#eee9df] bg-white p-5 sm:p-8 lg:grid-cols-[1.35fr_0.65fr] lg:items-center lg:gap-10 lg:p-10 dark:border-[#3c4043] dark:bg-[#1e1f20]">
                    <div>
                        <p class="text-[0.68rem] font-bold uppercase tracking-[0.16em] text-[#82631d] dark:text-[#e6c96f]">Una comunidad que acompaña</p>
                        <h2 class="mt-3 max-w-2xl text-2xl font-semibold leading-tight tracking-tight text-[#27313a] sm:text-3xl dark:text-[#f1f3f4]">Cada historia de aprendizaje empieza con una oportunidad.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-[#66717b] dark:text-zinc-400">Conoce más sobre nuestra institución y los pasos para acercarte a la comunidad Salvatore.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                        @if (Route::has('formulario'))
                            <a href="{{ route('formulario') }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full bg-[#d8b85c] px-5 py-3 text-sm font-bold text-[#27313a] transition hover:bg-[#e6c96f]">
                                Conoce el proceso de inscripción <span aria-hidden="true">→</span>
                            </a>
                        @endif
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex min-h-11 items-center justify-center rounded-full border border-[#d8dee8] px-5 py-3 text-sm font-semibold text-[#27313a] transition hover:bg-[#f5f6f8] dark:border-[#3c4043] dark:text-zinc-100 dark:hover:bg-[#292a2c]">Ir al panel</a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex min-h-11 items-center justify-center rounded-full border border-[#d8dee8] px-5 py-3 text-sm font-semibold text-[#27313a] transition hover:bg-[#f5f6f8] dark:border-[#3c4043] dark:text-zinc-100 dark:hover:bg-[#292a2c]">Ingresar al sistema</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer id="contacto" class="relative isolate mt-auto scroll-mt-24 overflow-hidden border-t border-[#e8e0d0] bg-[#f5f1e8] transition-colors duration-500 dark:border-[#3c4043] dark:bg-[#1e1f20]">
            <svg class="pointer-events-none absolute -right-10 top-0 h-72 w-72 text-[#111827]/20 dark:text-[#d8b85c]/25" viewBox="0 0 300 300" fill="none" aria-hidden="true">
                <path d="m24 58 62 42 58-58 62 70 54-37m-174 25 25 87 57-62 45 51" stroke="currentColor" stroke-width="1.4"/>
                <g fill="currentColor"><circle cx="24" cy="58" r="3"/><circle cx="86" cy="100" r="3"/><circle cx="144" cy="42" r="3"/><circle cx="206" cy="112" r="3"/><circle cx="260" cy="75" r="3"/><circle cx="115" cy="187" r="3"/><circle cx="172" cy="125" r="3"/></g>
                <path d="m91 210 4 10 10 4-10 4-4 10-4-10-10-4 10-4 4-10Zm157-143 3 7 7 3-7 3-3 7-3-7-7-3 7-3 3-7Z" fill="currentColor"/>
            </svg>
            <div class="relative grid w-full grid-cols-1 gap-9 px-5 py-10 sm:px-8 sm:py-12 md:grid-cols-3 lg:px-12 2xl:px-16">
                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <a href="{{ route('home') }}" class="mb-4 flex items-center gap-3">
                        <img src="{{ asset('images/LogoSv.png') }}" alt="" class="size-10 object-contain">
                        <span class="text-lg font-bold text-[#27313a] dark:text-zinc-100">Institución Salvatore</span>
                    </a>
                    <p class="max-w-sm text-sm leading-6 text-[#66717b] dark:text-zinc-400">
                        Un lugar para aprender, imaginar y crecer. ¡Cada día comienza una nueva aventura!
                    </p>
                </div>

                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <h2 class="mb-4 text-sm font-bold uppercase tracking-[0.16em] text-[#82631d] dark:text-[#e6c96f]">Hablemos</h2>
                    <a href="mailto:colegio@salvatore.edu.co" class="text-sm text-[#53606b] transition hover:text-[#27313a] hover:underline dark:text-zinc-300 dark:hover:text-white">colegio@salvatore.edu.co</a>
                    <p class="mt-2 text-sm text-[#53606b] dark:text-zinc-300">(601) 742 5893</p>
                </div>

                <div class="flex flex-col items-center text-center md:items-start md:text-left">
                    <h2 class="mb-4 text-sm font-bold uppercase tracking-[0.16em] text-[#82631d] dark:text-[#e6c96f]">Explora</h2>
                    <a href="#propuesta" class="text-sm text-[#53606b] transition hover:text-[#27313a] hover:underline dark:text-zinc-300 dark:hover:text-white">Nuestra propuesta educativa</a>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="mt-2 text-sm text-[#53606b] transition hover:text-[#27313a] hover:underline dark:text-zinc-300 dark:hover:text-white">Ingresar al sistema</a>
                    @endif
                    <div class="mt-4 flex items-center gap-2 text-sm text-[#53606b] dark:text-zinc-300">
                        <span class="font-medium">Síguenos</span>
                        <a href="#" aria-label="Instagram" class="grid size-9 place-items-center rounded-xl border border-[#d6ad4b]/50 text-[#82631d] transition hover:bg-[#d8b85c] hover:text-[#27313a] dark:text-[#e6c96f]" >
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="#" aria-label="Facebook" class="grid size-9 place-items-center rounded-xl border border-[#d6ad4b]/50 text-[#82631d] transition hover:bg-[#d8b85c] hover:text-[#27313a] dark:text-[#e6c96f]">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative mx-auto max-w-7xl border-t border-[#e0d8c8] px-4 py-5 text-center text-xs text-[#66717b] dark:border-[#3c4043] dark:text-zinc-500 sm:px-6 lg:px-12">
                &copy; {{ date('Y') }} Institución Salvatore. Todos los derechos reservados.
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const darkIcon = document.getElementById('theme-toggle-dark-icon');
                const lightIcon = document.getElementById('theme-toggle-light-icon');
                const themeToggle = document.getElementById('theme-toggle');
                const mobileMenuButton = document.getElementById('mobile-menu-btn');
                const mobileMenuPanel = document.getElementById('mobile-menu-panel');

                const updateThemeIcon = () => {
                    const isDark = document.documentElement.classList.contains('dark');
                    darkIcon?.classList.toggle('hidden', isDark);
                    lightIcon?.classList.toggle('hidden', !isDark);
                };

                const closeMobileMenu = () => {
                    mobileMenuButton?.setAttribute('aria-expanded', 'false');
                    mobileMenuButton?.setAttribute('aria-label', 'Abrir menú');
                    mobileMenuPanel?.classList.add('hidden');
                };

                updateThemeIcon();
                themeToggle?.addEventListener('click', () => {
                    const nextTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
                    window.applyTheme?.(nextTheme);
                    updateThemeIcon();
                });

                mobileMenuButton?.addEventListener('click', () => {
                    const isOpen = mobileMenuButton.getAttribute('aria-expanded') !== 'true';
                    mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
                    mobileMenuButton.setAttribute('aria-label', isOpen ? 'Cerrar menú' : 'Abrir menú');
                    mobileMenuPanel?.classList.toggle('hidden', !isOpen);
                });

                mobileMenuPanel?.querySelectorAll('a').forEach((link) => {
                    link.addEventListener('click', closeMobileMenu);
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeMobileMenu();
                    }
                });
            });
        </script>
    </body>
</html>
