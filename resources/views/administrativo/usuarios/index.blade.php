@php
    $activosEnPagina = $usuarios->getCollection()->filter(fn ($usuario) => ($usuario->status ?? $usuario->estado) === 'Activo')->count();
    $rolesEnPagina = $usuarios->getCollection()->pluck('effective_role')->unique()->count();
@endphp

<x-layouts::app.sidebar title="Cuentas del administrativo">
    <flux:main>
        <div class="mx-auto max-w-[96rem] space-y-6">
            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#c49a35]">Administración de cuentas</p>
                    <flux:heading size="xl" class="mt-2">Profesores y estudiantes</flux:heading>
                    <p class="mt-1 max-w-2xl text-sm text-zinc-500 dark:text-zinc-400">Administra el acceso de las cuentas vinculadas a la institución.</p>
                </div>
                <flux:button class="w-full sm:w-auto" variant="primary" icon="plus" href="{{ route('administrativo.usuarios.create') }}">
                    Crear cuenta
                </flux:button>
            </div>

            @if(session('success'))
                <div class="flex items-center gap-3 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-700 dark:text-emerald-300">
                    <flux:icon name="check-circle" class="size-5 shrink-0" />
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Cuentas registradas</p>
                        <span class="rounded-lg bg-[#c49a35]/15 p-2 text-[#c49a35]"><flux:icon name="users" class="size-5" /></span>
                    </div>
                    <p class="mt-3 text-2xl font-semibold text-zinc-900 dark:text-white">{{ $usuarios->total() }}</p>
                    <p class="mt-1 text-xs text-zinc-500">En todas las páginas</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Activas visibles</p>
                        <span class="rounded-lg bg-emerald-500/15 p-2 text-emerald-500"><flux:icon name="check-circle" class="size-5" /></span>
                    </div>
                    <p class="mt-3 text-2xl font-semibold text-zinc-900 dark:text-white">{{ $activosEnPagina }}</p>
                    <p class="mt-1 text-xs text-zinc-500">En la página actual</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Roles visibles</p>
                        <span class="rounded-lg bg-sky-500/15 p-2 text-sky-500"><flux:icon name="shield-check" class="size-5" /></span>
                    </div>
                    <p class="mt-3 text-2xl font-semibold text-zinc-900 dark:text-white">{{ $rolesEnPagina }}</p>
                    <p class="mt-1 text-xs text-zinc-500">Profesor y estudiante</p>
                </div>
            </div>

            <section class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex flex-col justify-between gap-4 border-b border-zinc-200 p-5 dark:border-zinc-800 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Listado de cuentas</h2>
                        <p class="mt-1 text-sm text-zinc-500">Busca por nombre de usuario o correo electrónico.</p>
                    </div>
                    <form method="GET" action="{{ route('administrativo.usuarios.index') }}" class="flex w-full gap-2 sm:w-auto">
                        <div class="relative min-w-0 flex-1 sm:w-72">
                            <flux:icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 z-10 size-4 -translate-y-1/2 text-[#c49a35]" />
                            <input name="search" type="search" value="{{ request('search') }}" placeholder="Buscar cuenta..." class="w-full rounded-xl border border-zinc-300 bg-white py-2.5 pl-10 pr-3 text-sm text-zinc-800 outline-none transition placeholder:text-zinc-400 focus:border-[#c49a35] focus:ring-2 focus:ring-[#c49a35]/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100" />
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-zinc-300 px-3 text-sm font-semibold text-zinc-700 transition hover:border-[#c49a35] hover:text-[#8a681b] dark:border-zinc-700 dark:text-zinc-200">
                            Buscar
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left text-sm">
                        <thead class="bg-zinc-50 text-xs uppercase tracking-wide text-zinc-500 dark:bg-zinc-950/60 dark:text-zinc-400">
                            <tr>
                                <th class="px-5 py-3 font-semibold">Cuenta</th>
                                <th class="px-5 py-3 font-semibold">Rol</th>
                                <th class="px-5 py-3 font-semibold">Estado</th>
                                <th class="px-5 py-3 text-right font-semibold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                            @forelse($usuarios as $usuario)
                                @php($estado = $usuario->status ?? $usuario->estado ?? 'Sin estado')
                                <tr class="group transition hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-[#c49a35]/20 text-sm font-bold text-[#9a761f] dark:bg-[#c49a35]/20 dark:text-[#e3c66d]">{{ $usuario->initials() }}</span>
                                            <div class="min-w-0">
                                                <p class="truncate font-semibold text-zinc-900 dark:text-zinc-100">{{ $usuario->name }}</p>
                                                <p class="truncate text-sm text-zinc-500 dark:text-zinc-400">{{ $usuario->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full bg-sky-500/10 px-2.5 py-1 text-xs font-semibold text-sky-700 dark:text-sky-300">{{ $usuario->effective_role }}</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center gap-1.5 text-sm {{ $estado === 'Activo' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                            <span class="size-2 rounded-full {{ $estado === 'Activo' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                            {{ $estado }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <flux:button class="crud-action-button" size="sm" href="{{ route('administrativo.usuarios.show', $usuario) }}">Ver</flux:button>
                                            <flux:button class="crud-action-button" size="sm" href="{{ route('administrativo.usuarios.edit', $usuario) }}">Editar</flux:button>
                                            <form method="POST" action="{{ route('administrativo.usuarios.destroy', $usuario) }}" class="inline-flex" onsubmit="return confirm('¿Está seguro de eliminar esta cuenta?');">
                                                @csrf
                                                @method('DELETE')
                                                <flux:button class="crud-action-button-danger" size="sm" variant="danger" type="submit">Eliminar</flux:button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-14 text-center">
                                        <flux:icon name="users" class="mx-auto size-10 text-zinc-400" />
                                        <p class="mt-3 font-semibold text-zinc-700 dark:text-zinc-200">No se encontraron cuentas</p>
                                        <p class="mt-1 text-sm text-zinc-500">Prueba con otra búsqueda o crea una cuenta nueva.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($usuarios->hasPages())
                    <div class="border-t border-zinc-200 px-5 py-4 dark:border-zinc-800">
                        {{ $usuarios->links() }}
                    </div>
                @endif
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
