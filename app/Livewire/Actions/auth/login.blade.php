<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public string $usuario = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $usernameColumn = Schema::hasColumn('users', 'usuario') ? 'usuario' : 'name';
        $emailColumn = Schema::hasColumn('users', 'correo') ? 'correo' : 'email';
        $user = User::where($usernameColumn, $this->usuario)
            ->orWhere($emailColumn, $this->usuario)
            ->first();

        if (! $user) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        $status = $user->status ?? $user->estado;
        if ($status !== null && $status !== 'Activo') {
            $this->addError('usuario', 'El usuario se encuentra inactivo.');
            return;
        }

        $loginColumn = filter_var($this->usuario, FILTER_VALIDATE_EMAIL)
            ? $emailColumn
            : $usernameColumn;

        $password = $user->getRawOriginal('password');
        $validPassword = false;

        try {
            $validPassword = Hash::check($this->password, $password);
        } catch (RuntimeException) {
            $validPassword = password_verify($this->password, $password)
                || hash_equals((string) $password, $this->password);

            if ($validPassword) {
                $user->forceFill(['password' => Hash::make($this->password)])->save();
            }
        }

        if (! $validPassword) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        Auth::login($user);

        request()->session()->regenerate();

        $role = strtolower($user->effective_role);
        $this->redirect(match ($role) {
            'administrador' => '/administrador/dashboard',
            'profesor', '2' => '/profesor/dashboard',
            'estudiante', '3' => '/estudiante/dashboard',
            default => '/',
        }, navigate: true);
    }
}; ?>

<div class="relative w-full"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            const theme = this.darkMode ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
            localStorage.setItem('flux.appearance', theme);
            this.applyTheme();
        },
        applyTheme() {
            const theme = this.darkMode ? 'dark' : 'light';
            document.documentElement.classList.toggle('dark', this.darkMode);
            document.documentElement.style.colorScheme = theme;
            localStorage.setItem('theme', theme);
            if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                window.Flux.applyAppearance(theme);
            }
        }
    }"
    x-init="applyTheme()"
>
    <!-- 1. IMAGEN DE FONDO PANTALLA COMPLETA (Fixed) -->
    <div 
        class="fixed inset-0 w-screen h-screen bg-cover bg-center bg-no-repeat z-0"
        style="background-image: url('{{ asset('images/colegioinicio.jpg') }}');"
    ></div>

    <!-- 2. CAPA DE CONTRASTE SOBRE LA IMAGEN -->
    <div class="fixed inset-0 w-screen h-screen bg-stone-900/40 dark:bg-black/75 backdrop-blur-xs z-10 transition-colors duration-300"></div>
    <!-- 4. CONTENEDOR CENTRAL DEL FORMULARIO -->
    <div class="relative z-20 min-h-screen w-full flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white/95 dark:bg-stone-900/95 backdrop-blur-md rounded-2xl shadow-2xl border border-stone-200/80 dark:border-stone-800 p-8 mx-auto transition-colors duration-300">

            <!-- Botón Conmutador de Modo Claro / Oscuro -->
            <div class="absolute top-4 right-4">
                <button 
                    type="button" 
                    @click="toggleTheme()" 
                    class="p-2 rounded-xl bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-[#D4A017]/50"
                    title="Cambiar tema"
                >
                    <!-- Icono Sol (Modo Oscuro activo) -->
                    <svg x-show="darkMode" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Icono Luna (Modo Claro activo) -->
                    <svg x-show="!darkMode" class="w-5 h-5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            <!-- Encabezado Institucional -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-amber-50 dark:bg-amber-950/40 rounded-2xl mb-3 border border-amber-200/60 dark:border-amber-800/40 shadow-xs">
                    <svg class="w-8 h-8 text-[#D4A017]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-stone-900 dark:text-stone-100 tracking-tight">Institución Educativa Salvatore</h1>
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-700/80 dark:text-amber-500 mt-1">Sistema de gestión académica</p>
            </div>

            <!-- Formulario -->
            <form wire:submit="login" class="space-y-5">
                <!-- Campo Usuario o Correo -->
                <div>
                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">
                        Usuario o correo
                    </label>
                    <input 
                        type="text" 
                        wire:model="usuario" 
                        required 
                        autofocus
                        placeholder="ejemplo@colegio.edu.co"
                        class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] dark:focus:border-[#D4A017] focus:ring-2 focus:ring-[#D4A017]/20 transition-all text-stone-800 dark:text-stone-100 placeholder-stone-400 dark:placeholder-stone-500"
                    >
                    @error('usuario') 
                        <span class="text-xs text-red-500 dark:text-red-400 mt-1.5 block font-medium">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Campo Contraseña -->
                <div x-data="{ showPassword: false }">
                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input 
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password" 
                            required
                            placeholder="••••••••"
                            class="w-full pr-11 px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] dark:focus:border-[#D4A017] focus:ring-2 focus:ring-[#D4A017]/20 transition-all text-stone-800 dark:text-stone-100 placeholder-stone-400 dark:placeholder-stone-500"
                        >
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-3 flex items-center justify-center text-stone-500 hover:text-stone-700 dark:text-stone-400 dark:hover:text-stone-200 transition-colors"
                            aria-label="Mostrar u ocultar contraseña"
                            title="Mostrar u ocultar contraseña"
                        >
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.707 7.336 5 12 5s8.577 2.707 9.964 6.678a1.012 1.012 0 010 .644C20.577 16.293 16.664 19 12 19s-8.577-2.707-9.964-6.678z"/>
                                <circle cx="12" cy="12" r="3.2" stroke-width="1.8"/>
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3l18 18M10.5 10.5A3 3 0 0013.5 13.5M9.88 5.08A10.94 10.94 0 0112 5c4.664 0 8.577 2.707 9.964 6.678a1.012 1.012 0 01-.054.168M6.61 6.61A12.09 12.09 0 002.036 12.322a1.012 1.012 0 000 .644C3.423 16.293 7.336 19 12 19c1.665 0 3.21-.32 4.597-.89"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') 
                        <span class="text-xs text-red-500 dark:text-red-400 mt-1.5 block font-medium">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Botón de Ingreso -->
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-[#D4A017] hover:bg-[#B8860B] active:bg-[#996515] text-white font-semibold text-sm rounded-xl shadow-md transition-all duration-200 cursor-pointer mt-2"
                >
                    Ingresar al sistema
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-stone-200/80 dark:border-stone-700/80 text-center">
                <p class="text-xs text-stone-400 dark:text-stone-500">&copy; {{ date('Y') }} Salvatore</p>
            </div>
        </div>
    </div>
</div>