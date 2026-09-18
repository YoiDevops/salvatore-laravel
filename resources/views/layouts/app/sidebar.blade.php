<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        @include('partials.head')

    </head>
<<<<<<< HEAD
    <body class="min-h-screen bg-[#f5f6f8] text-[#27313a] dark:bg-[#151515] dark:text-zinc-100">
        <x-static-stars />
        <flux:sidebar sticky collapsible="mobile" class="institution-sidebar sticky border-e border-[#d8dee8] bg-white text-[#27313a] dark:border-[#2b2b2b] dark:bg-[#212121] dark:text-white">
=======

    <body class="min-h-screen overflow-x-hidden bg-[#f5f6f8] text-[#27313a] dark:bg-[#171c20] dark:text-zinc-100">

        <div class="flex min-h-screen">

            <flux:sidebar sticky collapsible="desktop" persist="false" class="institution-sidebar sticky min-h-screen shrink-0 border-e border-[#d8dee8] bg-white text-[#27313a] dark:border-[#39434b] dark:bg-[#27313a] dark:text-white">

>>>>>>> a34f59318df4ca1997cfcb0fdc34c43b263c986e
            <flux:sidebar.header>

                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />

                <flux:sidebar.collapse class="!ml-auto hidden lg:flex" />

            </flux:sidebar.header>



            @php($rolActual = strtolower((string) auth()->user()?->effective_role))



            <flux:sidebar.nav>

                <flux:sidebar.group heading="INSTITUCION" class="grid text-[#c7d0df]">

<flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate title="Inicio">

                        Inicio

                    </flux:sidebar.item>

                </flux:sidebar.group>



                @if ($rolActual === 'profesor')

                    {{-- GESTION ACADEMICA: todo anidado y escalonado hacia la derecha,

                         siempre visible, sin desplegable --}}

                    <flux:sidebar.group heading="GESTION ACADEMICA" class="grid text-[#c7d0df]">

                        <flux:sidebar.item icon="squares-2x2" :href="route('profesor.dashboard')" :current="request()->routeIs('profesor.dashboard')" wire:navigate>

                            Panel del docente

                        </flux:sidebar.item>



                        {{-- Panel del docente: subtitulo fijo, no es link ni desplegable --}}

                        <div class="mt-3 flex items-center gap-2 pl-3 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon.shield-check class="size-4" />

                            Área Operativa

                        </div>



                        {{-- GESTION: mis estudiantes, cursos y estructura academica --}}

                        <div class="mt-2 flex items-center gap-2 pl-6 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon name="academic-cap" class="size-4" />
                            Gestion

                        </div>

                        @foreach([

                            ['profesor.estudiantes.index', 'Estudiantes', 'academic-cap'],

                            ['profesor.cursos.index', 'Cursos', 'rectangle-stack'],

                            ['profesor.grados.index', 'Grados', 'bookmark'],

                            ['profesor.asignaturas.index', 'Asignaturas', 'book-open'],

                        ] as [$routeName, $label, $icon])

                            @if (Route::has($routeName))

                                <flux:sidebar.item class="pl-9" icon="{{ $icon }}" :href="route($routeName)" :current="request()->routeIs($routeName.'*')" wire:navigate title="{{ $label }}">

                                    {{ $label }}

                                </flux:sidebar.item>

                            @endif

                        @endforeach



                        {{-- EVALUACION: indicadores y escalas de valoracion --}}

                        <div class="mt-2 flex items-center gap-2 pl-6 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon name="clipboard-document-list" class="size-4" />
                            Evaluacion

                        </div>

                        @foreach([

                            ['profesor.indicadores.index', 'Indicadores de logro'],

                            ['profesor.escalas.index', 'Escalas de valoracion'],

                        ] as [$routeName, $label])

                            @if (Route::has($routeName))

                                <flux:sidebar.item class="pl-9" icon="clipboard-document-list" :href="route($routeName)" :current="request()->routeIs($routeName.'*')" wire:navigate title="{{ $label }}">

                                    {{ $label }}

                                </flux:sidebar.item>

                            @endif

                        @endforeach

                    </flux:sidebar.group>

                @elseif ($rolActual === 'administrador')

                    {{-- GESTION ACADEMICA: todo anidado y escalonado hacia la derecha,

                         siempre visible, sin desplegable --}}

                    <flux:sidebar.group heading="GESTION ACADEMICA" class="grid text-[#c7d0df]">

                        <flux:sidebar.item icon="squares-2x2" :href="route('dashboardAdmin')" :current="request()->routeIs('dashboardAdmin')" wire:navigate>

                            Panel administrativo

                        </flux:sidebar.item>



                        {{-- Panel administrativo: subtitulo fijo, no es link ni desplegable --}}

                        <div class="mt-3 flex items-center gap-2 pl-3 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon.shield-check class="size-4" />

                            Gestion institucional

                        </div>



                        {{-- GESTION: matriculas, personas y estructura academica --}}

                        <div class="mt-2 flex items-center gap-2 pl-6 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon name="academic-cap" class="size-4" />
                            Gestion

                        </div>

                        @foreach([

                            ['estudiantes.index', 'Estudiantes', 'academic-cap'],

                            ['profesores.index', 'Profesores', 'user-group'],

                            ['cursos.index', 'Cursos', 'rectangle-stack'],

                            ['grados.index', 'Grados', 'bookmark'],

                            ['asignaturas.index', 'Asignaturas', 'book-open'],

                            ['acudientes.index', 'Acudientes', 'users'],

                        ] as [$routeName, $label, $icon])

                            @if (Route::has($routeName))

                                <flux:sidebar.item class="pl-9" icon="{{ $icon }}" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate>

                                    {{ $label }}

                                </flux:sidebar.item>

                            @endif

                        @endforeach



                        {{-- EVALUACION: periodos, indicadores y escalas de valoracion --}}

                        <div class="mt-2 flex items-center gap-2 pl-6 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon name="clipboard-document-list" class="size-4" />
                            Evaluacion

                        </div>

                        @foreach([

                            ['periodos.index', 'Periodos'],

                            ['indicadores.index', 'Indicadores'],

                            ['escalas.index', 'Escalas de valoracion'],

                        ] as [$routeName, $label])

                            @if (Route::has($routeName))

                                <flux:sidebar.item class="pl-9" icon="clipboard-document-list" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate>

                                    {{ $label }}

                                </flux:sidebar.item>

                            @endif

                        @endforeach



                        {{-- ADMINISTRACION: usuarios, roles y sedes --}}

                        <div class="mt-2 flex items-center gap-2 pl-6 text-xs font-semibold uppercase tracking-wide text-[#8b96a3] dark:text-zinc-400">

                            <flux:icon name="cog-6-tooth" class="size-4" />
                            Administracion

                        </div>

                        @foreach([

                            ['usuarios.index', 'Usuarios'],

                            ['roles.index', 'Roles'],

                            ['sedes.index', 'Sedes'],

                        ] as [$routeName, $label])

                            @if (Route::has($routeName))

                                <flux:sidebar.item class="pl-9" icon="cog-6-tooth" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate title="{{ $label }}">

                                    {{ $label }}

                                </flux:sidebar.item>

                            @endif

                        @endforeach

                    </flux:sidebar.group>

                @endif

            </flux:sidebar.nav>

            <div class="institution-sidebar-collapsed-nav" aria-label="Navegacion compacta">
                <flux:tooltip content="Inicio" position="right">
                    <a href="{{ route('dashboard') }}" wire:navigate title="Inicio">
                        <flux:icon name="home" class="size-5" />
                    </a>
                </flux:tooltip>

                @if ($rolActual === 'profesor')
                    <flux:tooltip content="Panel del docente" position="right">
                        <a href="{{ route('profesor.dashboard') }}" wire:navigate title="Panel del docente">
                            <flux:icon name="squares-2x2" class="size-5" />
                        </a>
                    </flux:tooltip>

                    <flux:tooltip content="Gestion" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Gestion"><flux:icon name="academic-cap" class="size-5" /></span>
                    </flux:tooltip>

                    <flux:tooltip content="Evaluacion" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Evaluacion"><flux:icon name="clipboard-document-list" class="size-5" /></span>
                    </flux:tooltip>
                @elseif ($rolActual === 'administrador')
                    <flux:tooltip content="Panel administrativo" position="right">
                        <a href="{{ route('dashboardAdmin') }}" wire:navigate title="Panel administrativo">
                            <flux:icon name="squares-2x2" class="size-5" />
                        </a>
                    </flux:tooltip>

                    <flux:tooltip content="Gestion institucional" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Gestion institucional"><flux:icon name="shield-check" class="size-5" /></span>
                    </flux:tooltip>

                    <flux:tooltip content="Gestion" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Gestion"><flux:icon name="academic-cap" class="size-5" /></span>
                    </flux:tooltip>

                    <flux:tooltip content="Evaluacion" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Evaluacion"><flux:icon name="clipboard-document-list" class="size-5" /></span>
                    </flux:tooltip>

                    <flux:tooltip content="Administracion" position="right">
                        <span role="button" tabindex="0" x-on:click="$dispatch('flux-sidebar-toggle')" title="Administracion"><flux:icon name="cog-6-tooth" class="size-5" /></span>
                    </flux:tooltip>
                @endif
            </div>



            <flux:spacer />



            <flux:sidebar.nav class="border-t border-white/10 pt-4">

                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank" title="Ayuda del sistema">

                    Ayuda del sistema

                </flux:sidebar.item>



                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank" title="Documentacion">

                    Documentacion

                </flux:sidebar.item>

            </flux:sidebar.nav>



            </flux:sidebar>

            <div class="flex min-h-screen flex-1 flex-col">

        <div class="hidden border-b border-[#d8dee8] bg-[#f3f4f5] px-4 py-3 shadow-sm lg:flex dark:border-[#39434b] dark:bg-[#1d2227]">

            <flux:sidebar.toggle class="institution-sidebar-expand-toggle" icon="bars-2" aria-label="Abrir barra lateral" />

            <div class="ml-auto flex items-center gap-3">
                <x-desktop-user-menu />
            </div>
        </div>

        <!-- Mobile User Menu -->

                <flux:header class="lg:hidden">

            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />



            <flux:spacer />



            <flux:dropdown position="top" align="end">

                <flux:profile

                    :initials="auth()->user()->initials()"

                    icon-trailing="chevron-down"

                />



                <flux:menu>

                    <flux:menu.radio.group>

                        <div class="p-0 text-sm font-normal">

                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                                <flux:avatar

                                    :name="auth()->user()->name"

                                    :initials="auth()->user()->initials()"

                                />



                                <div class="grid flex-1 text-start text-sm leading-tight">

                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>

                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>

                                </div>

                            </div>

                        </div>

                    </flux:menu.radio.group>



                    <flux:menu.separator />



                    <flux:menu.radio.group>

                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>

                            {{ __('Settings') }}

                        </flux:menu.item>

                    </flux:menu.radio.group>



                    <flux:menu.separator />



                    <form method="POST" action="{{ route('logout') }}" class="w-full">

                        @csrf

                        <flux:menu.item

                            as="button"

                            type="submit"

                            icon="arrow-right-start-on-rectangle"

                            class="w-full cursor-pointer"

                            data-test="logout-button"

                        >

                            {{ __('Log out') }}

                        </flux:menu.item>

                    </form>

                </flux:menu>

            </flux:dropdown>

                </flux:header>

<<<<<<< HEAD
        <footer class="border-t border-[#d8dee8] bg-white px-6 py-6 text-sm text-[#66717b] dark:border-[#2b2b2b] dark:bg-[#151515] dark:text-zinc-400 lg:pl-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div><p class="font-semibold text-[#27313a] dark:text-zinc-100">Institución Educativa Salvatore</p><p class="mt-1">Sistema de gestión académica y escolar</p></div>
                <div class="flex gap-5"><a href="{{ route('dashboard') }}" class="transition hover:text-[#9a761f]">Inicio</a><a href="{{ route('profile.edit') }}" class="transition hover:text-[#9a761f]">Mi perfil</a><span>© {{ date('Y') }} Salvatore</span></div>
=======
                <div class="flex-1">
                    {{ $slot }}
                </div>

                <footer class="app-footer mt-auto w-full">
                    <div class="app-footer-inner">
                        <div class="app-footer-brand">
                            <div class="app-footer-logo" aria-hidden="true">
                                <img src="{{ asset('images/LogoSv.png') }}" alt="Logo Institución Salvatore" class="h-full w-full object-contain" />
                            </div>
                            <div>
                                <h3>Institución Salvatore</h3>
                                <p>Portal administrativo para la gestión de usuarios, profesores y estudiantes.</p>
                            </div>
                        </div>

                        <div class="app-footer-column">
                            <h3>Síguenos</h3>
                            <div class="app-footer-socials" aria-label="Redes sociales">
                                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm5 3.5A5.5 5.5 0 1 1 6.5 13 5.5 5.5 0 0 1 12 7.5Zm0 2A3.5 3.5 0 1 0 15.5 13 3.5 3.5 0 0 0 12 9.5Zm5.25-3.25a1.25 1.25 0 1 1-1.25 1.25 1.25 1.25 0 0 1 1.25-1.25Z" fill="currentColor"/></svg>
                                </a>
                                <a href="https://x.com" target="_blank" rel="noopener noreferrer" aria-label="X">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 2h3.7l-8.1 9.3L23 22h-7.3l-5.7-8.3L3.5 22H-0l8.7-10L1 2h7.5l5.2 7.5L18.9 2Zm-1.3 18h2l-12.6-17h-2.2l12.8 17Z" fill="currentColor"/></svg>
                                </a>
                                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 22v-8h2.7l.4-3.2h-3.1V7.4c0-.9.3-1.6 1.6-1.6h1.7V2.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.4H7v3.2h2.8v8h3.7Z" fill="currentColor"/></svg>
                                </a>
                            </div>
                        </div>

                        <div class="app-footer-column">
                            <h3>Convenios Institucionales</h3>
                            <ul class="app-footer-list">
                                <li><span class="app-footer-dot app-footer-dot-sena"></span>SENA</li>
                                <li><span class="app-footer-dot app-footer-dot-edu"></span>Secretaría de Educación</li>
                                <li><span class="app-footer-dot app-footer-dot-tic"></span>Ministerio de las TIC</li>
                            </ul>
                        </div>
                    </div>

                    <div class="app-footer-bottom">
                        © {{ date('Y') }} Institución Salvatore. Todos los derechos reservados.
                    </div>
                </footer>
>>>>>>> a34f59318df4ca1997cfcb0fdc34c43b263c986e
            </div>

        </div>

        @persist('toast')

            <flux:toast.group>

                <flux:toast />

            </flux:toast.group>

        @endpersist



        @fluxScripts

    </body>

</html>