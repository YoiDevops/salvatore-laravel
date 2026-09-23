<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - Institución Salvatore</title>

        <link rel="icon" href="/images/logopequeno.ico" sizes="any">
        <link rel="apple-touch-icon" href="/images/logopequeno.ico">

        @fonts

        <!-- Script anti-parpadeo sincrónico -->
        <script>
            (function() {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>

        <style>
            @layer theme {
                :root, :host {
                    --font-sans: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
                }
            }
            @layer base {
                *, :after, :before, ::backdrop {
                    box-sizing: border-box;
                    border: 0 solid;
                    margin: 0;
                    padding: 0;
                }
                html, :host {
                    font-family: var(--font-sans);
                    line-height: 1.5;
                    -webkit-text-size-adjust: 100%;
                }
            }
            
            /* Animación suave para la forma del carrusel */
            .blob-shape {
                border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
                transition: all 1s ease-in-out;
                animation: morph 5s ease-in-out infinite;
            }

            @keyframes morph {
                0% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
                34% { border-radius: 70% 30% 50% 50% / 30% 30% 70% 70%; }
                67% { border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%; }
                100% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
            }

            /* Animación de lluvia diagonal amplia */
            @keyframes lluviaDiagonal {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                    opacity: 0;
                }
                10% { opacity: 0.5; }
                90% { opacity: 0.5; }
                100% {
                    transform: translate(120vw, 120vh) rotate(360deg);
                    opacity: 0;
                }
            }
            
            .lluvia-item {
                position: absolute;
                z-index: 0;
                animation: lluviaDiagonal linear infinite;
                pointer-events: none;
            }
        </style>
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class', 
            }
        </script>
    </head>
    <body class="bg-white dark:bg-[#20282e] text-[#27313a] dark:text-zinc-100 flex flex-col min-h-screen relative overflow-x-hidden transition-colors duration-300">
        
        <!-- FONDO ANIMADO -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-40 text-4xl" style="top: -10%; left: 5%; animation-duration: 14s; animation-delay: -2s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-25 text-5xl" style="top: -10%; left: 25%; animation-duration: 19s; animation-delay: -10s;">▲</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-30 text-3xl" style="top: -10%; left: 45%; animation-duration: 15s; animation-delay: -5s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-20 text-6xl" style="top: -10%; left: 65%; animation-duration: 22s; animation-delay: -12s;">⬤</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-35 text-4xl" style="top: -10%; left: 85%; animation-duration: 17s; animation-delay: -7s;">★</div>
            
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-20 text-3xl" style="top: 15%; left: -10%; animation-duration: 16s; animation-delay: -14s;">■</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-30 text-5xl" style="top: 35%; left: -10%; animation-duration: 20s; animation-delay: -3s;">✚</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-40 text-2xl" style="top: 55%; left: -10%; animation-duration: 13s; animation-delay: -8s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-25 text-4xl" style="top: 75%; left: -10%; animation-duration: 18s; animation-delay: -15s;">⬢</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-15 text-5xl" style="top: 90%; left: -10%; animation-duration: 24s; animation-delay: -6s;">✦</div>

            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-30 text-2xl" style="top: -10%; left: 15%; animation-duration: 12s; animation-delay: -9s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-25 text-4xl" style="top: 40%; left: -10%; animation-duration: 21s; animation-delay: -1s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-35 text-xl" style="top: -10%; left: 75%; animation-duration: 16s; animation-delay: -18s;">★</div>
            <div class="lluvia-item text-[#c49a35] dark:text-[#9b51e0] opacity-20 text-3xl" style="top: 65%; left: -10%; animation-duration: 19s; animation-delay: -11s;">★</div>

            <img src="{{ asset('images/pintura1.png') }}" class="lluvia-item w-32 opacity-25 dark:opacity-15" style="top: -10%; left: 30%; animation-duration: 25s; animation-delay: -4s;" alt="Mancha decorativa">
            <img src="{{ asset('images/pintura2.png') }}" class="lluvia-item w-40 opacity-25 dark:opacity-15" style="top: 50%; left: -10%; animation-duration: 28s; animation-delay: -12s;" alt="Mancha decorativa">
            <img src="{{ asset('images/manos1.png') }}" class="lluvia-item w-28 opacity-30 dark:opacity-20" style="top: -10%; left: 70%; animation-duration: 22s; animation-delay: -8s;" alt="Manos pintadas">
            <img src="{{ asset('images/manos2.png') }}" class="lluvia-item w-36 opacity-30 dark:opacity-20" style="top: 20%; left: -10%; animation-duration: 26s; animation-delay: -16s;" alt="Manos pintadas"> 
        </div>

        <!-- HEADER -->
        <header class="w-full flex justify-between items-center p-4 lg:px-12 relative z-50 bg-[#f5f6f8]/80 dark:bg-[#171c20]/80 backdrop-blur-sm border-b border-[#d8dee8] dark:border-[#39434b]">
            <div class="flex items-center gap-3 cursor-pointer">
                <img src="{{ asset('images/LogoSv.png') }}" alt="Logo Institución Salvatore" class="w-10 h-10 lg:w-12 lg:h-12 object-contain">
                <span class="font-bold text-lg lg:text-xl leading-tight">
                    Institución <br> Salvatore
                </span>
            </div>

            <div class="flex items-center gap-2 lg:gap-4">
                <!-- Botón Modo Oscuro/Claro -->
                <button id="theme-toggle" type="button" class="text-[#27313a] dark:text-[#d8b85c] hover:bg-[#eef1f5] dark:hover:bg-[#27313a] focus:outline-none rounded-lg text-sm p-2 transition-colors">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.22a1 1 0 011.415 0l.708.707a1 1 0 01-1.414 1.414l-.708-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-2.22 4.22a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-2.22a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.22-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 6a4 4 0 100 8 4 4 0 000-8z"></path>
                    </svg>
                </button>

                @if (Route::has('login'))
                    <nav class="hidden lg:flex items-center gap-4 text-sm font-medium">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-block px-5 py-2 border border-[#d8dee8] dark:border-[#39434b] hover:border-[#c49a35] rounded-md transition-colors">
                                Panel principal
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-[#9a761f] dark:hover:text-[#d8b85c] transition-colors">
                                Ingresar
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('formulario') }}" class="inline-block px-5 py-2 bg-[#27313a] text-white dark:bg-[#d8b85c] dark:text-[#20282e] rounded-md hover:bg-[#20282e] dark:hover:bg-[#c49a35] transition-colors">
                                    Registrar usuario
                                </a>
                            @endif
                        @endauth
                    </nav>

                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-[#27313a] dark:text-[#d8b85c] hover:bg-[#eef1f5] dark:hover:bg-[#27313a] rounded-md transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                @endif
            </div>

            @if (Route::has('login'))
                <div id="mobile-menu-panel" class="hidden flex-col w-full bg-white dark:bg-[#20282e] border-b border-[#d8dee8] dark:border-[#39434b] absolute top-full left-0 shadow-lg">
                    <nav class="flex flex-col px-6 py-6 gap-4 text-base font-medium">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block text-center px-5 py-3 border border-[#d8dee8] dark:border-[#39434b] rounded-md transition-colors hover:bg-gray-50 dark:hover:bg-[#171c20]">Panel principal</a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center hover:text-[#9a761f] dark:hover:text-[#d8b85c] py-2 transition-colors">Ingresar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block text-center px-5 py-3 bg-[#27313a] text-white dark:bg-[#d8b85c] dark:text-[#20282e] rounded-md transition-colors">Registrar usuario</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </header>

        <!-- SECCIÓN 1: INICIO (HERO) -->
        <main class="w-full max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-center p-4 sm:p-6 lg:p-12 gap-6 lg:gap-12 relative z-10 flex-shrink-0 min-h-[80vh]">
            <div class="flex-1 text-center lg:text-left mt-2 lg:mt-0">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-3 sm:mb-4 tracking-tight drop-shadow-sm leading-tight">
                    Bienvenidos a Institución <br class="hidden lg:block"> Salvatore
                </h1>
                <p class="text-base sm:text-xl lg:text-2xl text-[#66717b] dark:text-zinc-400 font-light">
                    Descubre un entorno de aprendizaje excepcional
                </p>
            </div>

            <div class="flex-1 w-full flex justify-center items-center relative mt-4 lg:mt-0">
                <div id="carousel" class="w-full max-w-[280px] sm:max-w-[350px] lg:max-w-md aspect-square relative overflow-hidden blob-shape shadow-2xl bg-white dark:bg-[#20282e]">
                    <img src="{{ asset('images/niño1.png') }}" class="carousel-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100" alt="Escuela 1">
                    <img src="{{ asset('images/niño2.png') }}" class="carousel-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" alt="Niños jugando">
                    <img src="{{ asset('images/niño3.png') }}" class="carousel-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" alt="Instalaciones">
                </div>
            </div>
        </main>

        <!-- SECCIÓN 2: ENFOQUE -->
        <section class="w-full py-16 relative z-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-[#27313a] dark:text-zinc-100">
                    Nuestro Enfoque
                </h2>
                <p class="max-w-3xl mx-auto text-[#53606b] dark:text-zinc-300 text-lg leading-relaxed mb-10">
                    En la Institución Salvatore nos dedicamos a formar estudiantes íntegros mediante metodologías innovadoras y un entorno lúdico. Fomentamos el desarrollo creativo, tecnológico y analítico para preparar a los líderes del mañana.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-[#20282e] rounded-xl shadow-sm border border-[#d8dee8] dark:border-[#39434b] overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                        <img src="{{ asset('images/enfoque1.jpg') }}" class="w-full h-48 object-cover" alt="Desarrollo Creativo">
                        <div class="p-6 flex-1 flex flex-col text-left">
                            <h3 class="text-xl font-semibold mb-2 text-[#27313a] dark:text-zinc-100">Desarrollo Creativo</h3>
                            <p class="text-[#66717b] dark:text-zinc-400 text-sm">Fomentamos el arte y la expresión como pilares fundamentales en las primeras etapas del aprendizaje.</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-[#20282e] rounded-xl shadow-sm border border-[#d8dee8] dark:border-[#39434b] overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                        <img src="{{ asset('images/enfoque2.jpg') }}" class="w-full h-48 object-cover" alt="Innovación Digital">
                        <div class="p-6 flex-1 flex flex-col text-left">
                            <h3 class="text-xl font-semibold mb-2 text-[#27313a] dark:text-zinc-100">Innovación Digital</h3>
                            <p class="text-[#66717b] dark:text-zinc-400 text-sm">Integramos la tecnología en las aulas para garantizar un aprendizaje moderno y adaptado al mundo actual.</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-[#20282e] rounded-xl shadow-sm border border-[#d8dee8] dark:border-[#39434b] overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                        <img src="{{ asset('images/enfoque3.jpg') }}" class="w-full h-48 object-cover" alt="Crecimiento Integral">
                        <div class="p-6 flex-1 flex flex-col text-left">
                            <h3 class="text-xl font-semibold mb-2 text-[#27313a] dark:text-zinc-100">Crecimiento Integral</h3>
                            <p class="text-[#66717b] dark:text-zinc-400 text-sm">Nos preocupamos por el bienestar emocional, social y académico de todos nuestros estudiantes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="w-full bg-white dark:bg-[#20282e] pt-12 pb-8 mt-auto relative z-10 border-t border-[#d8dee8] dark:border-[#39434b] transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/LogoSv.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        <span class="font-bold text-lg text-[#27313a] dark:text-zinc-100">Institución Salvatore</span>
                    </div>
                    <p class="text-sm text-[#66717b] dark:text-zinc-400 mb-2">
                        Portal administrativo para la gestión de usuarios, profesores y estudiantes.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-[#53606b] dark:text-zinc-300 mt-2">
                        <span class="text-[#c49a35] dark:text-[#9b51e0] font-bold">@</span>
                        <a href="mailto:colegio@salvatore.edu.co" class="hover:underline">colegio@salvatore.edu.co</a>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-[#53606b] dark:text-zinc-300 mt-2">
                        <span class="text-[#c49a35] dark:text-[#9b51e0]">📞</span>
                        <span>(601) 742 5893</span>
                    </div>
                </div>

                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4 text-[#27313a] dark:text-zinc-100">Síguenos</h3>
                    <div class="flex gap-4 text-[#c49a35] dark:text-[#9b51e0]">
                        <a href="#" class="p-2 border-2 border-[#c49a35] dark:border-[#9b51e0] rounded-full hover:bg-[#c49a35] dark:hover:bg-[#9b51e0] hover:text-white dark:hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="#" class="p-2 border-2 border-[#c49a35] dark:border-[#9b51e0] rounded-full hover:bg-[#c49a35] dark:hover:bg-[#9b51e0] hover:text-white dark:hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                        </a>
                        <a href="#" class="p-2 border-2 border-[#c49a35] dark:border-[#9b51e0] rounded-full hover:bg-[#c49a35] dark:hover:bg-[#9b51e0] hover:text-white dark:hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4 text-[#27313a] dark:text-zinc-100">Convenios Institucionales</h3>
                    <ul class="space-y-2 text-sm text-[#66717b] dark:text-zinc-400">
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="w-2 h-2 bg-[#c49a35] dark:bg-[#9b51e0] rounded-full"></span> SENA
                        </li>
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Secretaría de Educación
                        </li>
                        <li class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span> Ministerio de las TIC
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-10 text-center text-xs text-[#66717b] dark:text-zinc-500">
                &copy; {{ date('Y') }} Institución Salvatore. Todos los derechos reservados.
            </div>
        </footer>

        <!-- Scripts de interacción -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                /* --- LÓGICA DEL CARRUSEL --- */
                const images = document.querySelectorAll('.carousel-img');
                let currentIndex = 0;
                setInterval(() => {
                    images[currentIndex].classList.remove('opacity-100');
                    images[currentIndex].classList.add('opacity-0');
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].classList.remove('opacity-0');
                    images[currentIndex].classList.add('opacity-100');
                }, 10000);

                /* --- LÓGICA UNIFICADA MODO OSCURO/CLARO ('theme') --- */
                const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
                const themeToggleBtn = document.getElementById('theme-toggle');

                function updateIcons() {
                    const isDark = document.documentElement.classList.contains('dark');
                    if (isDark) {
                        themeToggleLightIcon.classList.remove('hidden');
                        themeToggleDarkIcon.classList.add('hidden');
                    } else {
                        themeToggleDarkIcon.classList.remove('hidden');
                        themeToggleLightIcon.classList.add('hidden');
                    }
                }

                updateIcons();

                themeToggleBtn.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                    updateIcons();
                });

                /* --- LÓGICA MENÚ HAMBURGUESA (MÓVIL) --- */
                const mobileMenuBtn = document.getElementById('mobile-menu-btn');
                const mobileMenuPanel = document.getElementById('mobile-menu-panel');

                if(mobileMenuBtn && mobileMenuPanel) {
                    mobileMenuBtn.addEventListener('click', () => {
                        mobileMenuPanel.classList.toggle('hidden');
                        mobileMenuPanel.classList.toggle('flex'); 
                    });
                }
            });
        </script>
    </body>
</html>