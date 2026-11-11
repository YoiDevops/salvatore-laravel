<x-layouts::app.sidebar title="Panel del administrativo">
    <flux:main>
        <div class="mx-auto w-full max-w-6xl space-y-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión de usuarios</p>
                <flux:heading size="xl" class="mt-2">Panel del administrativo</flux:heading>
                <flux:subheading class="mt-1">Crea y administra las cuentas de profesores y estudiantes.</flux:subheading>
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                @foreach ([['Usuarios registrados', $totalUsuarios, 'users'], ['Profesores', $totalProfesores, 'user-group'], ['Estudiantes', $totalEstudiantes, 'academic-cap']] as [$label, $total, $icon])
                    <div class="rounded-2xl border border-[#e5e7eb] bg-white p-6 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20]">
                        <flux:icon :name="$icon" class="size-6 text-[#c49a35] dark:text-[#d8b85c]" />
                        <p class="mt-5 text-3xl font-bold text-[#27313a] dark:text-white">{{ $total }}</p>
                        <p class="mt-1 text-sm text-[#6b7280] dark:text-zinc-400">{{ $label }}</p>
                    </div>
                @endforeach
            </div>

            <section class="rounded-2xl border border-[#e5e7eb] bg-white p-6 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20]">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="font-semibold text-[#27313a] dark:text-white">Crear en gestión institucional</h2>
                        <p class="mt-1 text-sm text-[#6b7280] dark:text-zinc-400">Usa los mismos formularios institucionales para profesores y estudiantes.</p>
                    </div>
                    <flux:button variant="primary" href="{{ route('administrativo.usuarios.index') }}">Ver cuentas</flux:button>
                </div>
                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <a href="{{ route('profesores.create') }}" class="rounded-xl border border-[#e5e7eb] bg-[#fbfcfd] p-4 text-[#27313a] transition hover:border-[#d8b85c] hover:bg-[#fffdf7] dark:border-[#3c4043] dark:bg-[#242526] dark:text-white dark:hover:border-[#d8b85c]">
                        <span class="font-semibold">Registrar profesor</span>
                        <p class="mt-1 text-sm text-[#6b7280] dark:text-zinc-400">Abrir el formulario completo de Gestión Institucional.</p>
                    </a>
                    <a href="{{ route('estudiantes.create') }}" class="rounded-xl border border-[#e5e7eb] bg-[#fbfcfd] p-4 text-[#27313a] transition hover:border-[#d8b85c] hover:bg-[#fffdf7] dark:border-[#3c4043] dark:bg-[#242526] dark:text-white dark:hover:border-[#d8b85c]">
                        <span class="font-semibold">Registrar estudiante</span>
                        <p class="mt-1 text-sm text-[#6b7280] dark:text-zinc-400">Abrir el formulario completo de Gestión Institucional.</p>
                    </a>
                </div>
            </section>

            <section class="rounded-2xl border border-[#e5e7eb] bg-white p-6 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20]">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h2 class="font-semibold text-[#27313a] dark:text-white">Cuentas recientes</h2>
                        <p class="mt-1 text-sm text-[#6b7280] dark:text-zinc-400">Las últimas cuentas creadas en la institución.</p>
                    </div>
                    <span class="rounded-full bg-[#f7f1df] px-3 py-1 text-xs font-semibold text-[#9a761f] dark:bg-[#3a3322] dark:text-[#d8b85c]">{{ $usuariosRecientes->count() }} cuentas</span>
                </div>

                <div class="mt-5 space-y-2">
                    @forelse ($usuariosRecientes as $usuario)
                        @php $initial = mb_strtoupper(mb_substr($usuario->name ?? '?', 0, 1)); @endphp
                        <div class="group flex items-center justify-between gap-4 rounded-xl border border-[#edf0f2] bg-[#fbfcfd] px-4 py-3 transition hover:border-[#d8b85c] hover:bg-[#fffdf7] dark:border-[#2b2923] dark:bg-[#1e1f20] dark:hover:border-[#d8b85c] dark:hover:bg-[#242526]">
                            <div class="flex min-w-0 items-center gap-3">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-[#c49a35]/20 text-sm font-bold text-[#9a761f] dark:bg-[#c49a35]/20 dark:text-[#e3c66d]">{{ $initial }}</span>
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-[#27313a] dark:text-zinc-100">{{ $usuario->name }}</p>
                                    <p class="mt-0.5 text-xs text-[#8b96a3] dark:text-zinc-500">Cuenta institucional</p>
                                </div>
                            </div>
                            <span class="shrink-0 rounded-full bg-[#eaf6fb] px-3 py-1 text-xs font-semibold text-[#24708c] dark:bg-[#183746] dark:text-[#8bd4ed]">{{ $usuario->effective_role }}</span>
                        </div>
                    @empty
                        <p class="rounded-xl border border-dashed border-[#d8dee8] bg-[#fbfcfd] px-4 py-6 text-center text-sm text-[#6b7280] dark:border-[#3c4043] dark:bg-[#242526] dark:text-zinc-500">No hay cuentas recientes.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
