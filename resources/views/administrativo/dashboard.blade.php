<x-layouts::app title="Panel administrativo">
    <div class="mx-auto w-full max-w-[96rem] space-y-6 px-4 py-5 sm:space-y-8 sm:px-6 sm:py-8 lg:px-8">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión de usuarios</p>
                <flux:heading size="xl" class="mt-2">Panel del administrativo</flux:heading>
                <flux:subheading class="mt-1">Registra y administra las cuentas de la comunidad educativa.</flux:subheading>
            </div>
            <div class="rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([
                ['Usuarios registrados', $totalUsuarios, 'users', 'bg-[#e8f2e8] text-[#2f6f48]'],
                ['Profesores', $totalProfesores, 'user-group', 'bg-[#edf1fa] text-[#526da8]'],
                ['Administradores', $totalAdministradores, 'shield-check', 'bg-[#fbf1df] text-[#a46b21]'],
                ['Estudiantes', $totalEstudiantes, 'academic-cap', 'bg-[#f5eaf2] text-[#985278]'],
            ] as [$label, $total, $icon, $color])
                <div class="rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
                    <span class="flex size-11 items-center justify-center rounded-xl {{ $color }}"><flux:icon :name="$icon" class="size-5" /></span>
                    <p class="mt-5 text-3xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $total }}</p>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $label }}</p>
                </div>
            @endforeach
        </div>

        <section class="rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] sm:p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Registrar una cuenta</h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Crea el acceso y asigna el rol correspondiente.</p>
                </div>
                <a href="{{ route('administrativo.usuarios.index') }}" wire:navigate.hover class="text-sm font-medium text-[#8a681b] hover:underline dark:text-[#d8b85c]">Ver todas las cuentas</a>
            </div>
            <div class="mt-5 grid gap-3 md:grid-cols-3">
                @foreach([
                    ['Profesor', 'Registra el acceso de un docente.', 'user-group'],
                    ['Administrador', 'Crea una cuenta con permisos administrativos.', 'shield-check'],
                    ['Estudiante', 'Crea el acceso de un estudiante.', 'academic-cap'],
                ] as [$role, $description, $icon])
                    <a href="{{ route('administrativo.usuarios.create', ['role' => $role]) }}" wire:navigate.hover class="group rounded-xl border border-zinc-200 p-4 transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:bg-[#fffaf0] dark:border-zinc-800 dark:hover:bg-zinc-800">
                        <div class="flex items-center gap-3"><span class="flex size-9 items-center justify-center rounded-lg bg-[#eef1f5] text-[#10213b] dark:bg-zinc-800 dark:text-[#d8b85c]"><flux:icon :name="$icon" class="size-4" /></span><span class="font-medium text-zinc-800 dark:text-zinc-100">{{ $role }}</span><flux:icon name="arrow-up-right" class="ml-auto size-4 text-zinc-400 transition group-hover:text-[#9a761f]" /></div>
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] sm:p-6 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center justify-between gap-4">
                <div><h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Cuentas recientes</h2><p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Últimos usuarios registrados en el sistema.</p></div>
                <a href="{{ route('administrativo.usuarios.index') }}" wire:navigate.hover class="text-sm font-medium text-[#8a681b] hover:underline dark:text-[#d8b85c]">Gestionar</a>
            </div>
            <div class="mt-5 overflow-x-auto">
                <table class="w-full min-w-[38rem] text-left text-sm">
                    <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500 dark:border-zinc-800"><tr><th class="px-3 py-3">Usuario</th><th class="px-3 py-3">Correo</th><th class="px-3 py-3">Rol</th><th class="px-3 py-3">Estado</th></tr></thead>
                    <tbody>
                        @forelse($usuariosRecientes as $usuario)
                            <tr class="border-b border-zinc-100 dark:border-zinc-800/70"><td class="px-3 py-3 font-medium text-zinc-800 dark:text-zinc-100">{{ $usuario->name }}</td><td class="px-3 py-3 text-zinc-500">{{ $usuario->email }}</td><td class="px-3 py-3">{{ $usuario->effective_role }}</td><td class="px-3 py-3">{{ $usuario->status ?? $usuario->estado ?? 'Activo' }}</td></tr>
                        @empty
                            <tr><td colspan="4" class="px-3 py-5 text-center text-zinc-500">No hay cuentas registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-layouts::app>
