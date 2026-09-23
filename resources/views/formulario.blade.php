<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth.card')] class extends Component {
    public int $pasoActual = 1;

    // --- DATOS ACUDIENTE ---
    public string $acudiente_tipo_documento = '';
    public string $acudiente_numero_documento = '';
    public string $acudiente_nombres = '';
    public string $acudiente_apellidos = '';
    public string $acudiente_fecha_nacimiento = '';
    public string $acudiente_dia_nacimiento = '';
    public string $acudiente_mes_nacimiento = '';
    public string $acudiente_anio_nacimiento = '';
    public string $acudiente_genero = '';
    public string $acudiente_parentesco = '';
    public string $acudiente_direccion = '';
    public string $acudiente_telefono = '';
    public string $acudientecontacto_correo = '';
    public string $acudiente_lugar_trabajo = '';
    public string $acudiente_ocupacion = '';

    // --- DATOS ESTUDIANTE ---
    public string $estudiante_tipo_documento = '';
    public string $estudiante_numero_documento = '';
    public string $estudiante_nombres = '';
    public string $estudiante_apellidos = '';
    public string $estudiante_fecha_nacimiento = '';
    public string $estudiante_dia_nacimiento = '';
    public string $estudiante_mes_nacimiento = '';
    public string $estudiante_anio_nacimiento = '';
    public string $estudiante_genero = '';
    public string $estudiante_tipo_sangre = '';
    public string $estudiante_lugar_nacimiento = '';
    public string $estudiante_eps = '';
    public string $estudiante_estado = 'Activo';
    public string $estudiante_tiene_discapacidad = '';
    public string $estudiante_tipo_discapacidad = '';
    public string $estudiante_diagnostico_discapacidad = '';
    public string $estudiante_grado_discapacidad = '';
    public string $estudiante_permanencia_discapacidad = '';
    public string $estudiante_grado_atencion = '';
    public bool $registroCompletado = false;

    public function cambiarPaso(int $paso): void
    {
        if ($paso === 2 && $this->pasoActual === 1) {
            $this->siguientePaso();
            return;
        }
        $this->pasoActual = $paso;
    }

    public function actualizarFechaAcudiente(): void
    {
        if ($this->acudiente_dia_nacimiento && $this->acudiente_mes_nacimiento && $this->acudiente_anio_nacimiento) {
            $this->acudiente_fecha_nacimiento = sprintf(
                '%s-%s-%s',
                $this->acudiente_anio_nacimiento,
                $this->acudiente_mes_nacimiento,
                $this->acudiente_dia_nacimiento,
            );
            $this->resetValidation('acudiente_fecha_nacimiento');
        }
    }

    public function actualizarFechaEstudiante(): void
    {
        if ($this->estudiante_dia_nacimiento && $this->estudiante_mes_nacimiento && $this->estudiante_anio_nacimiento) {
            $this->estudiante_fecha_nacimiento = sprintf(
                '%s-%s-%s',
                $this->estudiante_anio_nacimiento,
                $this->estudiante_mes_nacimiento,
                $this->estudiante_dia_nacimiento,
            );
            $this->resetValidation('estudiante_fecha_nacimiento');
        }
    }

    public function updated(string $property): void
    {
        if ($property === 'acudiente_telefono') {
            $this->acudiente_telefono = preg_replace('/\D+/', '', $this->acudiente_telefono) ?? '';
        }

        $this->resetValidation($property);
    }

    public function siguientePaso(): void
    {
        $this->validate([
            'acudiente_tipo_documento' => ['required', 'string'],
            'acudiente_numero_documento' => ['required', 'string', 'max:12'],
            'acudiente_nombres' => ['required', 'string', 'max:100'],
            'acudiente_apellidos' => ['required', 'string', 'max:100'],
            'acudiente_fecha_nacimiento' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(150)->format('Y-m-d'),
            ],
            'acudiente_genero' => ['required', 'string'],
            'acudiente_parentesco' => ['required', 'string'],
            'acudiente_direccion' => ['required', 'string', 'max:150'],
            'acudiente_telefono' => ['required', 'regex:/^[0-9]+$/', 'max:10'],
            'acudientecontacto_correo' => ['required', 'email', 'max:150'],
            'acudiente_lugar_trabajo' => ['nullable', 'string', 'max:150'],
            'acudiente_ocupacion' => ['nullable', 'string', 'max:100'],
        ], [
            'acudiente_fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe corresponder a una persona mayor de 18 años.',
            'acudiente_fecha_nacimiento.after_or_equal' => '¿Está seguro de que la fecha de nacimiento es correcta? No puede superar los 150 años.',
        ]);

        $this->pasoActual = 2;
    }

    public function pasoAnterior(): void
    {
        $this->pasoActual = 1;
    }

    public function validarEstudianteYContinuar(): void
    {
        $this->validate([
            'estudiante_tipo_documento' => ['required', 'string'],
            'estudiante_numero_documento' => ['required', 'string', 'max:12'],
            'estudiante_nombres' => ['required', 'string', 'max:100'],
            'estudiante_apellidos' => ['required', 'string', 'max:100'],
            'estudiante_fecha_nacimiento' => ['required', 'date_format:Y-m-d', 'before_or_equal:today', 'after_or_equal:' . now()->subYears(150)->format('Y-m-d')],
            'estudiante_genero' => ['required', 'string'],
            'estudiante_tipo_sangre' => ['required', 'string'],
            'estudiante_lugar_nacimiento' => ['required', 'string', 'max:100'],
            'estudiante_eps' => ['required', 'string', 'max:100'],
            'estudiante_estado' => ['required', 'string'],
            'estudiante_tiene_discapacidad' => ['required', 'in:Si,No'],
            'estudiante_tipo_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:100'],
            'estudiante_diagnostico_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:150'],
            'estudiante_grado_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:50'],
            'estudiante_permanencia_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:50'],
            'estudiante_grado_atencion' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:100'],
        ]);

        $this->pasoActual = 2;
    }

    public function guardarAcudiente(): void
    {
        $this->validate([
            'acudiente_tipo_documento' => ['required', 'string'],
            'acudiente_numero_documento' => ['required', 'string', 'max:12'],
            'acudiente_nombres' => ['required', 'string', 'max:100'],
            'acudiente_apellidos' => ['required', 'string', 'max:100'],
            'acudiente_fecha_nacimiento' => ['required', 'date_format:Y-m-d', 'before_or_equal:today', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d'), 'after_or_equal:' . now()->subYears(150)->format('Y-m-d')],
            'acudiente_genero' => ['required', 'string'],
            'acudiente_parentesco' => ['required', 'string'],
            'acudiente_direccion' => ['required', 'string', 'max:150'],
            'acudiente_telefono' => ['required', 'regex:/^[0-9]+$/', 'max:10'],
            'acudientecontacto_correo' => ['required', 'email', 'max:150'],
            'acudiente_lugar_trabajo' => ['nullable', 'string', 'max:150'],
            'acudiente_ocupacion' => ['nullable', 'string', 'max:100'],
        ]);

        $this->registroCompletado = true;
    }

    public function guardarFormulario(): void
    {
        $this->validate([
            'estudiante_tipo_documento' => ['required', 'string'],
            'estudiante_numero_documento' => ['required', 'string', 'max:12'],
            'estudiante_nombres' => ['required', 'string', 'max:100'],
            'estudiante_apellidos' => ['required', 'string', 'max:100'],
            'estudiante_fecha_nacimiento' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
                'after_or_equal:' . now()->subYears(150)->format('Y-m-d'),
            ],
            'estudiante_genero' => ['required', 'string'],
            'estudiante_tipo_sangre' => ['required', 'string'],
            'estudiante_lugar_nacimiento' => ['required', 'string', 'max:100'],
            'estudiante_eps' => ['required', 'string', 'max:100'],
            'estudiante_estado' => ['required', 'string'],
            'estudiante_tiene_discapacidad' => ['required', 'in:Si,No'],
            'estudiante_tipo_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:100'],
            'estudiante_diagnostico_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:150'],
            'estudiante_grado_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:50'],
            'estudiante_permanencia_discapacidad' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:50'],
            'estudiante_grado_atencion' => ['required_if:estudiante_tiene_discapacidad,Si', 'nullable', 'string', 'max:100'],
        ], [
            'estudiante_fecha_nacimiento.after_or_equal' => '¿Está seguro de que la fecha de nacimiento es correcta? No puede superar los 150 años.',
            'estudiante_tiene_discapacidad.required' => 'Indica si el estudiante tiene alguna discapacidad.',
            'estudiante_tipo_discapacidad.required_if' => 'Selecciona el tipo de discapacidad.',
            'estudiante_diagnostico_discapacidad.required_if' => 'Escribe el diagnóstico.',
            'estudiante_grado_discapacidad.required_if' => 'Selecciona el grado de discapacidad.',
            'estudiante_permanencia_discapacidad.required_if' => 'Selecciona la permanencia.',
            'estudiante_grado_atencion.required_if' => 'Selecciona el grado de atención.',
        ]);

        // Lógica para guardar acudiente y estudiante en BD...

        session()->flash('success', 'Registro completado exitosamente.');
        $this->registroCompletado = true;
    }
}; ?>

<div class="min-h-screen w-full bg-[#F8F9FA] dark:bg-stone-950 text-stone-800 dark:text-stone-100 p-4 sm:p-6 lg:p-8 transition-colors duration-300"
    x-data="{
        darkMode: document.documentElement.classList.contains('dark'),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            const theme = this.darkMode ? 'dark' : 'light';
            document.documentElement.classList.toggle('dark', this.darkMode);
            document.documentElement.style.colorScheme = theme;
            localStorage.setItem('theme', theme);
            localStorage.setItem('flux.appearance', theme);
            if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                window.Flux.applyAppearance(theme);
            }
        }
    }"
>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- CABECERA DE LA PÁGINA -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white/80 dark:bg-stone-900/80 backdrop-blur-md p-6 rounded-2xl border border-stone-200/80 dark:border-stone-800 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-50 dark:bg-amber-950/40 rounded-xl border border-amber-200/60 dark:border-amber-800/40 shadow-xs">
                    <svg class="w-7 h-7 text-[#D4A017]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-stone-900 dark:text-stone-100 tracking-tight">Registro de usuario</h1>
                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-700/80 dark:text-amber-500">Institución Educativa Salvatore</p>
                </div>
            </div>

            <!-- Botón Modo Claro / Oscuro -->
            <button 
                type="button" 
                @click="toggleTheme()" 
                class="p-2.5 rounded-xl bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-[#D4A017]/50"
                title="Cambiar tema"
            >
                <svg x-show="darkMode" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <svg x-show="!darkMode" class="w-5 h-5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
            </button>
        </div>

        @if ($registroCompletado)
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-8 text-center shadow-sm dark:border-emerald-900/50 dark:bg-emerald-950/20">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6"/></svg>
                </div>
                <h2 class="mt-5 text-2xl font-bold text-emerald-900 dark:text-emerald-100">Gracias por llenar sus datos</h2>
                <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-emerald-800 dark:text-emerald-200">Se confirmarán los datos del estudiante y del acudiente. Después de revisar la información, se le enviará un correo con los datos para iniciar su cuenta.</p>
                <a href="{{ route('home') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#D4A017] px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#B8860B]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 12 9-9 9 9M5 10v10h14V10"/></svg>
                    <span>Volver al inicio</span>
                </a>
            </div>
        @else
        <!-- INDICADOR DE PASOS -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Indicador Paso 1 -->
            <button type="button" wire:click="cambiarPaso(1)" class="w-full text-left flex items-center gap-3 p-4 rounded-xl border transition-all cursor-pointer {{ $pasoActual === 1 ? 'bg-amber-500/10 border-[#D4A017] text-[#D4A017]' : 'bg-white dark:bg-stone-900 border-stone-200 dark:border-stone-800 text-stone-400' }}">
                <span class="w-8 h-8 flex items-center justify-center rounded-lg font-bold text-sm {{ $pasoActual === 1 ? 'bg-[#D4A017] text-white' : 'bg-stone-200 dark:bg-stone-800 text-stone-600 dark:text-stone-400' }}">1</span>
                <div>
                    <p class="text-xs uppercase font-bold tracking-wider">Paso 1</p>
                    <p class="text-sm font-semibold hidden sm:block">Datos del Estudiante</p>
                </div>
            </button>

            <!-- Indicador Paso 2 -->
            <button type="button" wire:click="cambiarPaso(2)" class="w-full text-left flex items-center gap-3 p-4 rounded-xl border transition-all cursor-pointer {{ $pasoActual === 2 ? 'bg-amber-500/10 border-[#D4A017] text-[#D4A017]' : 'bg-white dark:bg-stone-900 border-stone-200 dark:border-stone-800 text-stone-400' }}">
                <span class="w-8 h-8 flex items-center justify-center rounded-lg font-bold text-sm {{ $pasoActual === 2 ? 'bg-[#D4A017] text-white' : 'bg-stone-200 dark:bg-stone-800 text-stone-600 dark:text-stone-400' }}">2</span>
                <div>
                    <p class="text-xs uppercase font-bold tracking-wider">Paso 2</p>
                    <p class="text-sm font-semibold hidden sm:block">Datos del Acudiente</p>
                </div>
            </button>
        </div>

        <!-- FORMULARIO PRINCIPAL -->
        <div class="bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/80 dark:border-stone-800 shadow-xl p-6 sm:p-8 transition-colors duration-300">

            @if ($pasoActual === 2)
                <!-- PASO 2: DATOS ACUDIENTE -->
                <div class="space-y-6">
                    <div class="border-b border-stone-100 dark:border-stone-800 pb-4">
                        <h2 class="text-lg font-bold text-stone-900 dark:text-stone-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D4A017]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Información del Acudiente
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Tipo de Documento Acudiente *</label>
                            <select wire:model.live="acudiente_tipo_documento" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione tipo...</option>
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="CE">Cédula de Extranjería (CE)</option>
                                <option value="PPT">Permiso por Protección Temporal (PPT)</option>
                                <option value="PASAPORTE">Pasaporte</option>
                            </select>
                            @error('acudiente_tipo_documento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Número de Documento Acudiente *</label>
                            <input type="number" 
                                   wire:model.live="acudiente_numero_documento" 
                                   oninput="if(this.value.length > 12) this.value = this.value.slice(0, 12);"
                                   placeholder="1000123456" 
                                   class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudiente_numero_documento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Nombres Acudiente *</label>
                            <input type="text" wire:model.live="acudiente_nombres" placeholder="Ej: Carlos Alberto" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudiente_nombres') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Apellidos Acudiente *</label>
                            <input type="text" wire:model.live="acudiente_apellidos" placeholder="Ej: Gómez Pérez" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudiente_apellidos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Fecha de Nacimiento Acudiente *</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-3">
                                <select wire:model.live="acudiente_dia_nacimiento" wire:change="actualizarFechaAcudiente" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Día</option>
                                    @for ($dia = 1; $dia <= 31; $dia++)
                                        <option value="{{ str_pad($dia, 2, '0', STR_PAD_LEFT) }}">{{ $dia }}</option>
                                    @endfor
                                </select>
                                <select wire:model.live="acudiente_mes_nacimiento" wire:change="actualizarFechaAcudiente" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Mes</option>
                                    @foreach ([1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'] as $mes => $nombreMes)
                                        <option value="{{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}">{{ $nombreMes }}</option>
                                    @endforeach
                                </select>
                                <select wire:model.live="acudiente_anio_nacimiento" wire:change="actualizarFechaAcudiente" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Año</option>
                                    @for ($anio = now()->subYears(18)->year; $anio >= now()->subYears(150)->year; $anio--)
                                        <option value="{{ $anio }}">{{ $anio }}</option>
                                    @endfor
                                </select>
                            </div>
                            @error('acudiente_fecha_nacimiento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Género Acudiente *</label>
                            <select wire:model.live="acudiente_genero" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione género...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('acudiente_genero') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Parentesco Acudiente *</label>
                            <select wire:model.live="acudiente_parentesco" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione parentesco...</option>
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                                <option value="Tutor Legal">Tutor Legal</option>
                                <option value="Abuelo/a">Abuelo/a</option>
                                <option value="Tío/a">Tío/a</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('acudiente_parentesco') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Teléfono Acudiente *</label>
                            <input type="number" 
                                   wire:model.live="acudiente_telefono" 
                                   oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);"
                                   placeholder="3001234567" 
                                   class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudiente_telefono') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Dirección Acudiente *</label>
                            <input type="text" wire:model.live="acudiente_direccion" placeholder="Calle 12 # 34 - 56, Barrio Centro" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudiente_direccion') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Lugar de Trabajo</label>
                            <input type="text" wire:model.live="acudiente_lugar_trabajo" placeholder="Empresa S.A.S." class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Ocupación</label>
                            <input type="text" wire:model.live="acudiente_ocupacion" placeholder="Comerciante, Ingeniero, etc." class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-4 pt-5 border-t border-stone-100 dark:border-stone-800">
                        <button 
                            type="button" 
                            wire:click="pasoAnterior" 
                            class="inline-flex justify-center items-center gap-2 py-3 px-6 bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-200 font-semibold text-sm rounded-xl transition-all duration-200 cursor-pointer w-full sm:w-auto"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            <span>Anterior</span>
                        </button>

                        <button 
                            type="button" 
                            wire:click="guardarAcudiente" 
                            class="inline-flex justify-center items-center gap-2 py-3.5 px-8 bg-[#D4A017] hover:bg-[#B8860B] active:bg-[#996515] text-white font-semibold text-sm rounded-xl shadow-lg transition-all duration-200 cursor-pointer w-full sm:w-auto"
                        >
                            <span>Finalizar Registro</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if ($pasoActual === 1)
                <!-- PASO 1: DATOS ESTUDIANTE -->
                <div class="space-y-6">
                    <div class="border-b border-stone-100 dark:border-stone-800 pb-4">
                        <h2 class="text-lg font-bold text-stone-900 dark:text-stone-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D4A017]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            Información del Estudiante
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Tipo de Documento *</label>
                            <select wire:model.live="estudiante_tipo_documento" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione tipo...</option>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="RC">Registro Civil (RC)</option>
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="PPT">Permiso por Protección Temporal (PPT)</option>
                            </select>
                            @error('estudiante_tipo_documento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Documento Estudiante *</label>
                            <input type="number" 
                                   wire:model.live="estudiante_numero_documento" 
                                   oninput="if(this.value.length > 12) this.value = this.value.slice(0, 12);"
                                   placeholder="1011223344" 
                                   class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('estudiante_numero_documento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Nombre Estudiante *</label>
                            <input type="text" wire:model.live="estudiante_nombres" placeholder="Ej: Mateo" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('estudiante_nombres') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Apellidos *</label>
                            <input type="text" wire:model.live="estudiante_apellidos" placeholder="Ej: Gómez López" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('estudiante_apellidos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Fecha de Nacimiento Estudiante*</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-3">
                                <select wire:model.live="estudiante_dia_nacimiento" wire:change="actualizarFechaEstudiante" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Día</option>
                                    @for ($dia = 1; $dia <= 31; $dia++)
                                        <option value="{{ str_pad($dia, 2, '0', STR_PAD_LEFT) }}">{{ $dia }}</option>
                                    @endfor
                                </select>
                                <select wire:model.live="estudiante_mes_nacimiento" wire:change="actualizarFechaEstudiante" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Mes</option>
                                    @foreach ([1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'] as $mes => $nombreMes)
                                        <option value="{{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}">{{ $nombreMes }}</option>
                                    @endforeach
                                </select>
                                <select wire:model.live="estudiante_anio_nacimiento" wire:change="actualizarFechaEstudiante" class="w-full px-3 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                    <option value="">Año</option>
                                    @for ($anio = 2021; $anio >= now()->subYears(150)->year; $anio--)
                                        <option value="{{ $anio }}">{{ $anio }}</option>
                                    @endfor
                                </select>
                            </div>
                            @error('estudiante_fecha_nacimiento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Lugar Nacimiento *</label>
                            <input type="text" wire:model.live="estudiante_lugar_nacimiento" placeholder="Ciudad / Municipio" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('estudiante_lugar_nacimiento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Género *</label>
                            <select wire:model.live="estudiante_genero" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione género...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('estudiante_genero') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Tipo de Sangre *</label>
                            <select wire:model.live="estudiante_tipo_sangre" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione grupo...</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                            @error('estudiante_tipo_sangre') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">EPS *</label>
                            <input type="text" wire:model.live="estudiante_eps" placeholder="Ej: Sanitas, Sura" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('estudiante_eps') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Correo Electrónico de Contacto *</label>
                            <input type="email" wire:model.live="acudientecontacto_correo" placeholder="acudiente@correo.com" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                            @error('acudientecontacto_correo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 border-t border-stone-100 dark:border-stone-800 pt-5">
                            <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">¿Tiene alguna discapacidad? *</label>
                            <select wire:model.live="estudiante_tiene_discapacidad" class="w-full px-4 py-3 text-sm bg-stone-50 dark:bg-stone-800/80 border border-stone-200 dark:border-stone-700 rounded-xl focus:bg-white dark:focus:bg-stone-800 focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                <option value="">Seleccione una opción...</option>
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                            @error('estudiante_tiene_discapacidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        @if ($estudiante_tiene_discapacidad === 'Si')
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-5 rounded-xl border border-amber-200 bg-amber-50/50 p-5 dark:border-amber-900/50 dark:bg-amber-950/20">
                                <div>
                                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Tipo de discapacidad *</label>
                                    <select wire:model.live="estudiante_tipo_discapacidad" class="w-full px-4 py-3 text-sm bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-xl focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                        <option value="">Seleccione tipo...</option><option value="Física">Física</option><option value="Visual">Visual</option><option value="Auditiva">Auditiva</option><option value="Intelectual">Intelectual</option><option value="Psicosocial">Psicosocial</option><option value="Múltiple">Múltiple</option><option value="Otra">Otra</option>
                                    </select>
                                    @error('estudiante_tipo_discapacidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Diagnóstico *</label>
                                    <input type="text" wire:model.live="estudiante_diagnostico_discapacidad" maxlength="150" placeholder="Escribe el diagnóstico" class="w-full px-4 py-3 text-sm bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-xl focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100 placeholder-stone-400">
                                    @error('estudiante_diagnostico_discapacidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Grado de discapacidad *</label>
                                    <select wire:model.live="estudiante_grado_discapacidad" class="w-full px-4 py-3 text-sm bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-xl focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                        <option value="">Seleccione grado...</option><option value="Leve">Leve</option><option value="Moderada">Moderada</option><option value="Severa">Severa</option>
                                    </select>
                                    @error('estudiante_grado_discapacidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Permanencia *</label>
                                    <select wire:model.live="estudiante_permanencia_discapacidad" class="w-full px-4 py-3 text-sm bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-xl focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                        <option value="">Seleccione permanencia...</option><option value="Temporal">Temporal</option><option value="Permanente">Permanente</option>
                                    </select>
                                    @error('estudiante_permanencia_discapacidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-semibold text-stone-600 dark:text-stone-300 uppercase tracking-wider mb-2">Grado de atención *</label>
                                    <select wire:model.live="estudiante_grado_atencion" class="w-full px-4 py-3 text-sm bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-xl focus:outline-none focus:border-[#D4A017] text-stone-800 dark:text-stone-100">
                                        <option value="">Seleccione grado de atención...</option><option value="Aula regular">Aula regular</option><option value="Apoyo especializado">Apoyo especializado</option><option value="Atención integral">Atención integral</option>
                                    </select>
                                    @error('estudiante_grado_atencion') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-4 pt-5 border-t border-stone-100 dark:border-stone-800">
                        <!-- El botón "Anterior" no es necesario en el Paso 1, pero si lo tuvieras, va aquí -->

                        <button 
                            type="button" 
                            wire:click="validarEstudianteYContinuar" 
                            class="inline-flex justify-center items-center gap-2 py-3.5 px-8 bg-[#D4A017] hover:bg-[#B8860B] active:bg-[#996515] text-white font-semibold text-sm rounded-xl shadow-lg transition-all duration-200 cursor-pointer w-full sm:w-auto"
                        >
                            <span>Siguiente: Datos Acudiente</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </div>
            @endif

        </div>
        @endif

    </div>
</div>