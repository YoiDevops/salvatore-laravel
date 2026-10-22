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
            .welcome-twinkle {
                animation: welcome-twinkle 4s ease-in-out infinite alternate;
            }

            @keyframes welcome-twinkle {
                from { opacity: 0.3; }
                to { opacity: 0.95; }
            }

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
                                @if (Route::has('register'))
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
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-2xl border border-[#e7dfd0] px-4 py-3 text-center dark:border-[#3c4043]">Panel principal</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-2xl px-4 py-3 text-center transition hover:bg-[#f3eee4] dark:hover:bg-[#2b2c2e]">Ingresar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-2xl bg-[#d8b85c] px-4 py-3 text-center text-[#27313a] transition hover:bg-[#e6c96f]">Registrarse</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </header>

        <main class="flex-1 overflow-hidden">
            <section class="relative isolate overflow-hidden bg-[#f5f1e8] transition-colors duration-500 dark:bg-[#121212]">
                <div class="pointer-events-none absolute inset-0 text-[#111827]/45 dark:text-[#d8b85c]/55" aria-hidden="true">
                    <svg class="absolute -left-20 top-8 h-64 w-64 sm:h-80 sm:w-80" viewBox="0 0 300 300" fill="none">
                        <path d="m20 115 63-43 57 52 54-76 75 50m-129 26 7 83 54-83 68-26" stroke="currentColor" stroke-width="1.4"/>
                        <g fill="currentColor"><circle cx="20" cy="115" r="3"/><circle cx="83" cy="72" r="3"/><circle cx="140" cy="124" r="3"/><circle cx="194" cy="48" r="3"/><circle cx="269" cy="98" r="3"/><circle cx="147" cy="207" r="2"/></g>
                    </svg>
                    <svg class="absolute -right-12 top-2 h-60 w-60 sm:right-[8%] sm:top-5 sm:h-80 sm:w-80" viewBox="0 0 300 300" fill="none">
                        <path d="m30 123 48-72 52 46 61-37 79 64-54 74-69-32-63 45-54-88Z" stroke="currentColor" stroke-width="1.3"/>
                        <path d="m78 51 52 46 61-37-44 106 69 32m-123-85-9 133" stroke="currentColor" stroke-width="1.3"/>
                        <g fill="currentColor"><circle cx="30" cy="123" r="3"/><circle cx="78" cy="51" r="3"/><circle cx="130" cy="97" r="3"/><circle cx="191" cy="60" r="3"/><circle cx="270" cy="124" r="3"/><circle cx="216" cy="198" r="3"/><circle cx="147" cy="166" r="3"/><circle cx="84" cy="211" r="3"/></g>
                    </svg>
                    <span class="welcome-twinkle absolute left-[47%] top-[12%] text-2xl">✦</span>
                    <span class="welcome-twinkle absolute right-[36%] top-[26%] text-lg">✧</span>
                    <span class="welcome-twinkle absolute bottom-[18%] left-[29%] text-xl">✦</span>
                    <span class="welcome-twinkle absolute bottom-[23%] right-[8%] text-2xl">✦</span>
                    <span class="absolute left-[22%] top-[37%] text-xs">✦</span>
                    <span class="absolute right-[23%] top-[10%] text-xs">✧</span>
                </div>

                <div class="relative mx-auto grid min-h-[620px] w-full max-w-7xl items-center gap-8 px-5 py-14 sm:px-8 sm:py-20 lg:min-h-[660px] lg:grid-cols-2 lg:gap-10 lg:px-12">
                    <div class="relative z-10 mx-auto w-full max-w-xl text-center lg:mx-0 lg:text-left">
                        <p class="inline-flex items-center gap-2 border-b border-[#d6ad4b]/50 pb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#82631d] dark:text-[#e6c96f]">
                            <span class="text-base">✦</span> Institución Educativa Salvatore
                        </p>
                        <h1 class="mt-6 text-4xl font-extrabold leading-[1.08] tracking-tight text-[#27313a] sm:text-5xl lg:text-6xl dark:text-[#f1f3f4]">
                            Bienvenidos a
                            <span class="block text-[#9a761f] dark:text-[#e6c96f]">Institución Salvatore</span>
                        </h1>
                        <p class="mx-auto mt-5 max-w-lg text-base leading-7 text-[#53606b] sm:text-lg sm:leading-8 lg:mx-0 dark:text-[#bdc1c6]">
                            Un lugar para imaginar en grande, descubrir el mundo y crecer con alegría.
                        </p>
                        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('dashboard') }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full bg-[#d8b85c] px-7 py-3 font-bold text-[#27313a] shadow-lg shadow-[#d8b85c]/20 transition hover:-translate-y-0.5 hover:bg-[#e6c96f]">
                                        Ir a mi espacio <span aria-hidden="true">→</span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full bg-[#d8b85c] px-7 py-3 font-bold text-[#27313a] shadow-lg shadow-[#d8b85c]/20 transition hover:-translate-y-0.5 hover:bg-[#e6c96f]">
                                        Conoce tu espacio <span aria-hidden="true">→</span>
                                    </a>
                                @endauth
                            @endif
                            <a href="#aventura" class="inline-flex min-h-12 items-center justify-center rounded-full border border-[#c7c2b8] bg-white/60 px-7 py-3 font-semibold text-[#35414d] transition hover:border-[#d6ad4b] hover:bg-white dark:border-[#56585a] dark:bg-[#292a2c] dark:text-zinc-200 dark:hover:bg-[#333537]">
                                Explorar el colegio
                            </a>
                        </div>
                    </div>

                    <div class="relative mx-auto w-full max-w-[620px]">
                        <span class="pointer-events-none absolute -right-2 top-2 z-10 text-3xl text-[#a17b23] dark:text-[#e6c96f]" aria-hidden="true">✦</span>
                        <span class="pointer-events-none absolute -bottom-3 left-2 z-10 text-2xl text-[#a17b23] dark:text-[#e6c96f]" aria-hidden="true">✧</span>
                        <img src="{{ asset('images/aventura-salvatore.jpg') }}" alt="Niños leyendo, dibujando y explorando las estrellas junto a un telescopio" class="relative z-0 w-full rounded-[2rem] shadow-[0_24px_70px_rgba(39,49,58,0.20)] sm:rounded-[2.5rem]">
                    </div>
                </div>
            </section>

            <section id="aventura" class="scroll-mt-24 bg-[#fbfaf7] py-14 transition-colors duration-500 dark:bg-[#121212] sm:py-20">
                <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-10">
                    <div class="mx-auto mb-9 max-w-2xl text-center sm:mb-12">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#9a761f] dark:text-[#e6c96f]">Nuestra aventura de aprendizaje</p>
                        <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#27313a] sm:text-4xl dark:text-[#f1f3f4]">Un mundo por descubrir</h2>
                        <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-[#66717b] dark:text-[#9aa0a6]">
                            Cada día trae una nueva oportunidad para explorar, crear y aprender en comunidad.
                        </p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <article class="group overflow-hidden rounded-3xl border border-[#e8e2d8] bg-white shadow-[0_12px_35px_rgba(39,49,58,0.07)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgba(39,49,58,0.12)] dark:border-[#3c4043] dark:bg-[#1e1f20]">
                            <div class="relative h-52 overflow-hidden sm:h-56">
                                <img src="{{ asset('images/enfoque1.jpg') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="Niño expresándose a través del arte">
                                <span class="absolute left-4 top-4 rounded-xl bg-[#f6edcf] px-3 py-2 text-lg text-[#82631d] shadow-sm dark:bg-[#302d24] dark:text-[#e6c96f]" aria-hidden="true">✿</span>
                            </div>
                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg font-bold text-[#27313a] dark:text-zinc-100">Imaginamos y creamos</h3>
                                <p class="mt-2 text-sm leading-6 text-[#66717b] dark:text-zinc-400">El arte y el juego abren la puerta a nuevas ideas y formas de expresarnos.</p>
                            </div>
                        </article>

                        <article class="group overflow-hidden rounded-3xl border border-[#e8e2d8] bg-white shadow-[0_12px_35px_rgba(39,49,58,0.07)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgba(39,49,58,0.12)] dark:border-[#3c4043] dark:bg-[#1e1f20]">
                            <div class="relative h-52 overflow-hidden sm:h-56">
                                <img src="{{ asset('images/ninos-lectura.jpg') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="Estudiantes leyendo y descubriendo nuevas ideas">
                                <span class="absolute left-4 top-4 rounded-xl bg-[#e7edf4] px-3 py-2 text-lg text-[#50677f] shadow-sm dark:bg-[#272e36] dark:text-[#b1c6dc]" aria-hidden="true">✧</span>
                            </div>
                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg font-bold text-[#27313a] dark:text-zinc-100">Exploramos con curiosidad</h3>
                                <p class="mt-2 text-sm leading-6 text-[#66717b] dark:text-zinc-400">Cada pregunta es una oportunidad para investigar, probar y descubrir.</p>
                            </div>
                        </article>

                        <article class="group overflow-hidden rounded-3xl border border-[#e8e2d8] bg-white shadow-[0_12px_35px_rgba(39,49,58,0.07)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgba(39,49,58,0.12)] dark:border-[#3c4043] dark:bg-[#1e1f20] sm:col-span-2 lg:col-span-1">
                            <div class="relative h-52 overflow-hidden sm:h-56">
                                <img src="{{ asset('images/actividades-colegio.jpg') }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="Estudiantes compartiendo una actividad escolar">
                                <span class="absolute left-4 top-4 rounded-xl bg-[#e7f0e5] px-3 py-2 text-lg text-[#54744d] shadow-sm dark:bg-[#273127] dark:text-[#a4c49a]" aria-hidden="true">♡</span>
                            </div>
                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg font-bold text-[#27313a] dark:text-zinc-100">Crecemos en comunidad</h3>
                                <p class="mt-2 text-sm leading-6 text-[#66717b] dark:text-zinc-400">Aprendemos a convivir, colaborar y celebrar los logros de todos.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section class="relative isolate mx-auto my-14 w-full max-w-7xl overflow-hidden px-4 sm:my-20 sm:px-6 lg:px-10">
                <div class="relative overflow-hidden rounded-3xl border border-[#e7dfd0] bg-[#f4edda] px-5 py-8 dark:border-[#3c4043] dark:bg-[#1e1f20] sm:px-10 sm:py-10">
                    <div class="pointer-events-none absolute inset-y-0 right-0 w-1/2 text-[#111827]/20 dark:text-[#d8b85c]/20" aria-hidden="true">
                        <svg class="absolute -right-4 -top-16 h-64 w-64" viewBox="0 0 300 300" fill="none">
                            <path d="m24 112 68-54 61 67 49-82 73 56m-121 26 35 86 76-86" stroke="currentColor" stroke-width="1.5"/>
                            <g fill="currentColor"><circle cx="24" cy="112" r="4"/><circle cx="92" cy="58" r="4"/><circle cx="153" cy="125" r="4"/><circle cx="202" cy="43" r="4"/><circle cx="275" cy="99" r="4"/></g>
                        </svg>
                    </div>
                    <div class="relative flex flex-col items-start justify-between gap-5 sm:flex-row sm:items-center">
                        <div class="max-w-2xl">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8a681b] dark:text-[#e6c96f]">Un camino que recorremos juntos</p>
                            <h2 class="mt-2 text-2xl font-extrabold text-[#27313a] sm:text-3xl dark:text-zinc-100">El futuro empieza con una buena pregunta.</h2>
                            <p class="mt-2 text-sm leading-6 text-[#66717b] dark:text-zinc-400">Nos alegra acompañar a cada estudiante y a su familia en esta aventura de aprendizaje.</p>
                        </div>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex min-h-12 shrink-0 items-center justify-center rounded-full bg-[#27313a] px-6 py-3 font-semibold text-white transition hover:bg-[#3c4852] dark:bg-[#d8b85c] dark:text-[#27313a] dark:hover:bg-[#e6c96f]">Ir al panel</a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex min-h-12 shrink-0 items-center justify-center rounded-full bg-[#27313a] px-6 py-3 font-semibold text-white transition hover:bg-[#3c4852] dark:bg-[#d8b85c] dark:text-[#27313a] dark:hover:bg-[#e6c96f]">Ingresar al sistema</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer class="relative isolate mt-auto overflow-hidden border-t border-[#e8e0d0] bg-[#f5f1e8] transition-colors duration-500 dark:border-[#3c4043] dark:bg-[#1e1f20]">
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
                    <a href="#aventura" class="text-sm text-[#53606b] transition hover:text-[#27313a] hover:underline dark:text-zinc-300 dark:hover:text-white">Nuestra aventura de aprendizaje</a>
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
