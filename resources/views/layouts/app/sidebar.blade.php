<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#f5f6f8] text-[#27313a] dark:bg-[#171c20] dark:text-zinc-100">
        <flux:sidebar sticky collapsible="mobile" class="institution-sidebar sticky border-e border-[#d8dee8] bg-white text-[#27313a] dark:border-[#39434b] dark:bg-[#27313a] dark:text-white">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group heading="INSTITUCION" class="grid text-[#c7d0df]">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        Inicio
                    </flux:sidebar.item>

                    @if (strtolower(trim((string) (auth()->user()?->role ?? auth()->user()?->nom_rol))) === 'administrador')
                        <flux:sidebar.item icon="shield-check" :href="route('dashboardAdmin')" :current="request()->routeIs('dashboardAdmin')" wire:navigate>
                            Panel administrativo
                        </flux:sidebar.item>
                    @endif
                </flux:sidebar.group>

                <flux:sidebar.group heading="GESTION ACADEMICA" class="grid text-[#c7d0df]">
                    @foreach([
                        ['estudiantes.index', 'Estudiantes', 'academic-cap'],
                        ['profesores.index', 'Profesores', 'user-group'],
                        ['cursos.index', 'Cursos', 'rectangle-stack'],
                        ['grados.index', 'Grados', 'bookmark'],
                        ['asignaturas.index', 'Asignaturas', 'book-open'],
                        ['acudientes.index', 'Acudientes', 'users'],
                    ] as [$routeName, $label, $icon])
                        @if (Route::has($routeName))
                            <flux:sidebar.item icon="{{ $icon }}" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate>
                                {{ $label }}
                            </flux:sidebar.item>
                        @endif
                    @endforeach
                </flux:sidebar.group>

                <flux:sidebar.group heading="EVALUACION" class="grid text-[#c7d0df]">
                    @foreach([
                        ['periodos.index', 'Periodos'],
                        ['indicadores.index', 'Indicadores'],
                        ['escalas.index', 'Escalas de valoracion'],
                    ] as [$routeName, $label])
                        @if (Route::has($routeName))
                            <flux:sidebar.item icon="clipboard-document-list" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate>
                                {{ $label }}
                            </flux:sidebar.item>
                        @endif
                    @endforeach
                </flux:sidebar.group>

                @if (strtolower(trim((string) (auth()->user()?->role ?? auth()->user()?->nom_rol))) === 'administrador')
                    <flux:sidebar.group heading="ADMINISTRACION" class="grid text-[#c7d0df]">
                        @foreach([
                            ['usuarios.index', 'Usuarios'],
                            ['roles.index', 'Roles'],
                            ['instituciones.index', 'Instituciones'],
                            ['sedes.index', 'Sedes'],
                        ] as [$routeName, $label])
                            @if (Route::has($routeName))
                                <flux:sidebar.item icon="cog-6-tooth" :href="route($routeName)" :current="request()->routeIs($routeName)" wire:navigate>
                                    {{ $label }}
                                </flux:sidebar.item>
                            @endif
                        @endforeach
                    </flux:sidebar.group>
                @endif
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav class="border-t border-white/10 pt-4">
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    Ayuda del sistema
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    Documentacion
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

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

        {{ $slot }}

        <footer class="border-t border-[#d8dee8] bg-white px-6 py-6 text-sm text-[#66717b] dark:border-[#39434b] dark:bg-[#171c20] dark:text-zinc-400 lg:pl-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div><p class="font-semibold text-[#27313a] dark:text-zinc-100">Institución Educativa Salvatore</p><p class="mt-1">Sistema de gestión académica y escolar</p></div>
                <div class="flex gap-5"><a href="{{ route('dashboard') }}" class="transition hover:text-[#9a761f]">Inicio</a><a href="{{ route('profile.edit') }}" class="transition hover:text-[#9a761f]">Mi perfil</a><span>© {{ date('Y') }} Salvatore</span></div>
            </div>
        </footer>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
